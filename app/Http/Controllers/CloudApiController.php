<?php

namespace App\Http\Controllers;

use App\Models\{BusinessUnit, Category, Course, CourseEnrollment, CourseLesson, CourseProgress, Customer, Employee, File, Message, Order, Product, Quote, Role, Service, ServiceRequest, User};
use App\Services\{FileService, OrderService, QuoteService, ServiceRequestService};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Auth, DB, Hash, Storage};
use Illuminate\Validation\Rule;

// Local database adapter for the API contract used by the deployed Worker UI.
class CloudApiController extends Controller
{
    private function staff(): bool
    {
        return in_array(Auth::user()?->role?->slug, ['super_admin', 'admin', 'manager', 'employee', 'attendant'], true);
    }

    private function admin(): void
    {
        abort_unless(Auth::user()?->isAdmin(), 403, 'Acesso administrativo necessário.');
    }

    private function customer(): Customer
    {
        return Customer::firstOrCreate(['user_id' => Auth::id()], ['type' => 'individual', 'status' => 'active']);
    }

    public function catalog()
    {
        return response()->json([
            'products' => Product::where('status', 'active')->with('primaryImage')->orderByDesc('featured')->latest('id')->get()->map(function ($p) {
                return array_merge($p->only(['id','name','slug','description','short_description','price','stock_quantity','business_unit_id','category_id']), ['image' => $p->primaryImage?->path]);
            }),
            'courses' => Course::where('status','published')->latest('id')->get(['id','name','slug','description','short_description','price','duration_hours','level','thumbnail','business_unit_id']),
            'services' => Service::where('status','active')->orderBy('id')->get(['id','name','slug','description','short_description','base_price','pricing_type','business_unit_id']),
            'units' => BusinessUnit::where('status','active')->get(['id','name','slug']),
            'categories' => Category::all(['id','name','slug','type','business_unit_id']),
        ]);
    }

    public function course(string $slug)
    {
        $course = Course::where('slug',$slug)->where('status','published')->firstOrFail();
        return response()->json(['course' => $course->only(['id','name','slug','description','price','duration_hours','level','thumbnail']),
            'modules' => $course->modules()->where('status','active')->orderBy('sort_order')->with(['lessons' => fn ($q) => $q->where('status','active')->orderBy('sort_order')->select('id','course_module_id','title','duration_minutes')])->get(['id','course_id','title','sort_order'])]);
    }

    public function enrollments()
    {
        $this->admin();
        return response()->json(['enrollments' => CourseEnrollment::where('status','active')->whereHas('customer.user')->with(['customer.user','course'])->get()->map(fn ($e) => [
            'id'=>$e->id,'aluno_id'=>$e->customer_id,'nome'=>$e->customer->user->name,'email'=>strtolower($e->customer->user->email),
            'tipo'=>'aluno','status'=>'ativo','has_matricula'=>true,'matricula_status'=>'ativa',
            'matricula_codigo'=>'RAC-'.str_pad($e->id,5,'0',STR_PAD_LEFT),'curso_matriculado'=>$e->course?->name,
        ])]);
    }

    public function myCourses()
    {
        return response()->json(['courses' => CourseEnrollment::whereHas('customer',fn ($q) => $q->where('user_id',Auth::id()))->with('course')->latest('id')->get()->filter(fn ($e) => $e->course)->map(fn ($e) => array_merge(
            $e->course->only(['id','slug','name','description','thumbnail','duration_hours']),
            ['enrollment_id'=>$e->id,'enrollment_status'=>$e->status,'completed_lessons'=>CourseProgress::where('enrollment_id',$e->id)->where('completed',true)->count()]
        ))->values()]);
    }

    private function lessonEnrollment(int $id, bool $activeOnly = false): array
    {
        $lesson = CourseLesson::where('status','active')->with('module')->findOrFail($id);
        abort_unless($lesson->module?->status === 'active',403);
        $enrollment = CourseEnrollment::where('course_id',$lesson->module->course_id)
            ->whereIn('status',$activeOnly ? ['active'] : ['active','completed'])
            ->whereHas('customer',fn ($q) => $q->where('user_id',Auth::id()))->first();
        abort_unless($enrollment,403,'Matrícula ativa necessária.');
        return [$lesson,$enrollment];
    }

    public function lesson(int $id)
    {
        [$lesson] = $this->lessonEnrollment($id);
        return response()->json(['lesson'=>$lesson->only(['id','title','content','video_url','duration_minutes'])]);
    }

    public function progress(Request $request, int $id)
    {
        [, $enrollment] = $this->lessonEnrollment($id,true);
        $data = $request->validate(['completed'=>'sometimes|boolean','last_position'=>'sometimes|integer|min:0|max:86400']);
        $progress = CourseProgress::firstOrNew(['enrollment_id'=>$enrollment->id,'lesson_id'=>$id]);
        $progress->completed = $progress->completed || ($data['completed'] ?? false);
        if ($progress->completed && !$progress->completed_at) $progress->completed_at = now();
        $progress->last_position = $data['last_position'] ?? 0;
        $progress->save();
        return response()->json(['success'=>true]);
    }

    public function password(Request $request)
    {
        $data = $request->validate(['current_password'=>'required|current_password','password'=>'required|string|min:10|confirmed']);
        $request->user()->update(['password'=>Hash::make($data['password'])]);
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['success'=>true,'message'=>'Palavra-passe alterada. Inicie sessão novamente.']);
    }

    public function orders()
    {
        $query = Order::with('items')->latest('id');
        if (!Auth::user()->isAdmin()) $query->whereHas('customer',fn ($q) => $q->where('user_id',Auth::id()));
        return response()->json(['orders'=>$query->limit(200)->get()]);
    }

    public function checkout(Request $request)
    {
        $data = $request->validate(['items'=>'required|array|min:1|max:100','items.*.product_id'=>'required|integer|exists:products,id','items.*.quantity'=>'required|integer|min:1|max:1000']);
        $items = collect($data['items'])->groupBy('product_id')->map(fn ($group,$id) => ['product_id'=>(int)$id,'quantity'=>$group->sum('quantity')])->values()->all();
        $order = DB::transaction(function () use ($items) {
            $products = Product::whereIn('id',array_column($items,'product_id'))->where('status','active')->lockForUpdate()->get()->keyBy('id');
            foreach ($items as $item) {
                abort_unless(isset($products[$item['product_id']]),422,'Produto indisponível.');
                abort_if($products[$item['product_id']]->stock_quantity < $item['quantity'],409,'Estoque insuficiente.');
            }
            return app(OrderService::class)->createOrder($this->customer()->id,$products->first()->business_unit_id,$items,['payment_method'=>'multicaixa']);
        });
        return response()->json(['success'=>true,'message'=>'Pedido registado.','order'=>$order]);
    }

    public function paid(Request $request,int $id)
    {
        $this->admin();
        $data = $request->validate(['transaction_id'=>'nullable|string|max:255']);
        $order = Order::findOrFail($id);
        abort_if(in_array($order->status,['cancelled','refunded'],true),409);
        if ($order->payment_status !== 'paid') app(OrderService::class)->markAsPaid($order,$data['transaction_id'] ?? null);
        return response()->json(['success'=>true,'message'=>'Pagamento confirmado.']);
    }

    public function quotes()
    {
        $query = Quote::with('items')->latest('id');
        if (!Auth::user()->isAdmin()) $query->where(fn ($q) => $q->where('created_by',Auth::id())->orWhereHas('customer',fn ($c) => $c->where('user_id',Auth::id())));
        return response()->json(['quotes'=>$query->limit(200)->get()]);
    }

    public function createQuote(Request $request)
    {
        abort_unless($this->staff(),403);
        $data = $request->validate(['service_request_id'=>'required|integer','items'=>'required|array|min:1|max:100','items.*.description'=>'required|string|max:255','items.*.quantity'=>'required|integer|min:1|max:10000','items.*.unit_price'=>'required|numeric|min:0','discount'=>'nullable|numeric|min:0']);
        $service = $this->accessible($data['service_request_id']);
        $quote = app(QuoteService::class)->create(array_merge($data,['customer_id'=>$service->customer_id,'business_unit_id'=>$service->business_unit_id]),$data['items'],Auth::id());
        return response()->json(['success'=>true,'message'=>'Orçamento enviado.','quote'=>$quote]);
    }

    public function approveQuote(int $id)
    {
        $quote = Quote::findOrFail($id);
        abort_unless($quote->customer?->user_id === Auth::id(),403);
        abort_unless(in_array($quote->status,['sent','viewed'],true) && !$quote->isExpired(),409,'Orçamento indisponível para aprovação.');
        app(QuoteService::class)->approve($quote,$quote->customer_id);
        return response()->json(['success'=>true,'message'=>'Orçamento aprovado.']);
    }

    private function logActivity(string $action, ?string $modelType, ?int $modelId, string $description): void
    {
        try {
            DB::table('activity_logs')->insert([
                'user_id' => Auth::id() ?? 1,
                'action' => $action,
                'model_type' => $modelType,
                'model_id' => $modelId,
                'description' => $description,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
                'created_at' => now(),
            ]);
        } catch (\Throwable $e) {
            // Silently continue if audit logging fails
        }
    }

    private function accessible(string|int $id): ServiceRequest
    {
        $service = is_numeric($id)
            ? ServiceRequest::findOrFail($id)
            : ServiceRequest::where('protocol', $id)->firstOrFail();
        $employee = Auth::user()?->employee;
        $staffAccess = $this->staff() && $employee && ($service->assigned_to === $employee->id || $service->business_unit_id === $employee->business_unit_id);
        abort_unless(Auth::user()?->isAdmin() || $staffAccess || $service->customer?->user_id === Auth::id(), 403);
        return $service;
    }

    public function createRequest(Request $request)
    {
        $request->merge(['business_unit_id'=>$request->input('unit_id', $request->input('business_unit_id',1))]);
        $data = $request->validate(['title'=>'required|string|max:255','description'=>'required|string|max:3000',
            'business_unit_id'=>['required','integer',Rule::exists('business_units','id')->where('status','active')->whereNull('deleted_at')],
            'service_id'=>'nullable|integer|exists:services,id','priority'=>'nullable|in:low,normal,high,urgent']);
        if (!empty($data['service_id'])) abort_unless(Service::where('business_unit_id',$data['business_unit_id'])->where('status','active')->find($data['service_id']),422);
        $service = app(ServiceRequestService::class)->create($data,$this->customer()->id,$data['business_unit_id']);
        return response()->json(['success'=>true,'message'=>'Solicitação registada.','request'=>$service]);
    }

    public function message(Request $request, string|int $id)
    {
        $service = $this->accessible($id);
        $data = $request->validate(['message'=>'required|string|max:3000']);
        $message = $service->messages()->create(['user_id'=>Auth::id(),'message'=>$data['message']]);
        return response()->json(['success'=>true,'message'=>array_merge($message->toArray(),['text'=>$message->message,'sender'=>Auth::user()->name,'is_staff'=>$this->staff(),'fromUser'=>!$this->staff()])]);
    }

    public function requestDetail(string|int $id)
    {
        $service = $this->accessible($id);
        return response()->json([
            'request' => $service,
            'history' => $service->statusHistories()->orderBy('id')->get(),
            'messages' => $service->messages()->with('user')->orderBy('id')->get()->map(fn ($m) => ['id'=>$m->id,'name'=>$m->user?->name,'message'=>$m->message,'created_at'=>$m->created_at]),
            'files' => $service->files()->get()->map(fn ($f) => ['id'=>$f->id,'name'=>$f->original_name,'mime_type'=>$f->mime_type])
        ]);
    }

    public function requestStatus(Request $request, string|int $id)
    {
        abort_unless($this->staff(), 403);
        $data = $request->validate([
            'status' => 'required|string',
            'comment' => 'nullable|string|max:1000'
        ]);
        $statusMap = [
            'novo' => 'new',
            'analise' => 'in_analysis',
            'em análise' => 'in_analysis',
            'aguardando' => 'waiting_customer',
            'ag. cliente' => 'waiting_customer',
            'orcamento' => 'quoted',
            'orçamento' => 'quoted',
            'aprovado' => 'approved',
            'execucao' => 'in_progress',
            'em execução' => 'in_progress',
            'revisao' => 'in_review',
            'em revisão' => 'in_review',
            'concluido' => 'completed',
            'concluído' => 'completed',
            'cancelado' => 'cancelled',
        ];
        $status = $statusMap[strtolower($data['status'])] ?? $data['status'];
        app(ServiceRequestService::class)->updateStatus($this->accessible($id), $status, $data['comment'] ?? null, Auth::id());
        return response()->json(['success' => true, 'message' => 'Estado atualizado.']);
    }

    public function requestAssign(string|int $id)
    {
        abort_unless($this->staff(), 403);
        $employee = Auth::user()->employee;
        abort_unless($employee, 422, 'Utilizador sem perfil de funcionário.');
        app(ServiceRequestService::class)->assignToEmployee($this->accessible($id), $employee->id, Auth::id());
        return response()->json(['success' => true, 'message' => 'Atendimento atribuído.']);
    }

    public function upload(Request $request, string|int $id)
    {
        $service = $this->accessible($id);
        $request->validate(['file'=>'required|file|max:25600|mimes:jpg,jpeg,png,webp,pdf,docx,zip,ai,psd']);
        $file = app(FileService::class)->upload($request->file('file'),$service,Auth::id(),'local');
        return response()->json(['success'=>true,'file'=>['id'=>$file->id,'name'=>$file->original_name]]);
    }

    public function file(int $id)
    {
        $file = File::findOrFail($id);
        abort_unless($file->fileable_type === ServiceRequest::class,404);
        $this->accessible($file->fileable_id);
        return Storage::disk($file->disk)->download($file->path,$file->original_name,['X-Content-Type-Options'=>'nosniff']);
    }

    public function stock()
    {
        abort_unless($this->staff(),403);
        return response()->json(['products'=>Product::orderBy('name')->get(['id','name','sku','stock_quantity','minimum_stock'])]);
    }

    public function users()
    {
        $this->admin();
        return response()->json([
            'success' => true,
            'roles' => Role::all(['id', 'name', 'slug', 'description']),
            'users' => User::withTrashed()->with(['role', 'customer', 'employee'])->latest('id')->get()->map(fn ($u) => formatAdminUserRecord($u)),
        ]);
    }

    public function createUser(Request $request)
    {
        $this->admin();
        $raw = json_decode($request->getContent(), true);
        $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();
        $name = $data['nome'] ?? $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['telefone'] ?? $data['phone'] ?? null;
        $roleId = $data['role_id'] ?? null;
        $status = $data['status'] ?? 'active';
        $password = ($data['password'] ?? null) ?: '123456';

        if (!$name || !$email) {
            return response()->json(['success' => false, 'message' => 'Nome e e-mail são obrigatórios.'], 422);
        }

        if (User::where('email', $email)->exists()) {
            return response()->json(['success' => false, 'message' => 'Este e-mail já se encontra registado no sistema.'], 409);
        }

        $role = $roleId ? Role::find($roleId) : Role::where('slug', 'customer')->first();
        if ($role && $role->slug === 'super_admin' && Auth::user()->role?->slug !== 'super_admin') {
            abort(403, 'Apenas Admin Master pode atribuir este perfil.');
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'role_id' => $role?->id ?? 1,
            'password' => Hash::make($password),
            'status' => $status,
            'email_verified_at' => now(),
        ]);

        if (in_array($role?->slug, ['customer', 'student'], true)) {
            Customer::firstOrCreate(['user_id' => $user->id], [
                'type' => 'individual',
                'phone' => $phone,
                'whatsapp' => $phone,
                'status' => 'active',
            ]);
        }

        $user->load(['role', 'customer', 'employee']);
        $formatted = formatAdminUserRecord($user);
        $this->logActivity('user_created', User::class, $user->id, "Utilizador {$user->name} ({$user->email}) criado com o perfil {$role?->name}.");

        return response()->json([
            'success' => true,
            'message' => "Utilizador {$user->name} criado com sucesso!",
            'user' => $formatted,
            'temp_password' => $password,
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        $this->admin();
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        $raw = json_decode($request->getContent(), true);
        $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();
        $name = $data['nome'] ?? $data['name'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['telefone'] ?? $data['phone'] ?? null;
        $roleId = $data['role_id'] ?? null;
        $status = $data['status'] ?? null;
        $password = $data['password'] ?? null;

        if ($user->id === $currentUser->id && (($roleId && (int)$roleId !== (int)$user->role_id) || ($status && $status !== 'active'))) {
            return response()->json(['success' => false, 'message' => 'Não pode remover o seu próprio acesso.'], 422);
        }

        if ($email && $email !== $user->email) {
            if (User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
                return response()->json(['success' => false, 'message' => 'Este e-mail já pertence a outro utilizador.'], 422);
            }
            $user->email = $email;
        }

        if ($name) $user->name = $name;
        if ($phone !== null) {
            $user->phone = $phone;
            if ($user->customer) $user->customer->update(['phone' => $phone]);
        }
        if ($roleId) {
            $role = Role::find($roleId);
            if ($role && $role->slug === 'super_admin' && $currentUser->role?->slug !== 'super_admin') {
                abort(403);
            }
            $user->role_id = $roleId;
        }
        if ($status) $user->status = $status;
        if (!empty($password)) {
            $user->password = Hash::make($password);
        }

        $user->save();
        $user->load(['role', 'customer', 'employee']);
        $formatted = formatAdminUserRecord($user);
        $this->logActivity('user_updated', User::class, $user->id, "Dados do utilizador {$user->name} ({$user->email}) atualizados.");

        return response()->json([
            'success' => true,
            'message' => 'Dados do utilizador atualizados com sucesso!',
            'user' => $formatted,
        ]);
    }

    public function toggleStatusUser($id)
    {
        $this->admin();
        $user = User::findOrFail($id);
        $currentUser = Auth::user();

        if ($user->id === $currentUser->id || $user->role?->slug === 'super_admin') {
            return response()->json(['success' => false, 'message' => 'Utilizador protegido contra bloqueio.'], 403);
        }

        $current = strtolower($user->status ?? 'active');
        if (in_array($current, ['blocked', 'bloqueado', 'suspended'])) {
            $user->status = 'active';
            $msg = "O utilizador {$user->name} foi desbloqueado com sucesso!";
        } else {
            $user->status = 'blocked';
            $msg = "O utilizador {$user->name} foi bloqueado!";
        }

        $user->save();
        $user->load(['role', 'customer', 'employee']);
        $formatted = formatAdminUserRecord($user);
        $this->logActivity('status_changed', User::class, $user->id, "Estado do utilizador {$user->name} alterado para {$user->status}.");

        return response()->json([
            'success' => true,
            'message' => $msg,
            'user' => $formatted,
        ]);
    }

    public function resetPasswordUser(Request $request, $id)
    {
        $this->admin();
        $user = User::findOrFail($id);
        $raw = json_decode($request->getContent(), true);
        $password = $request->input('password') ?? ($raw['password'] ?? null) ?: 'Rachi@' . rand(1000, 9999);
        $user->password = Hash::make($password);
        $user->save();
        $this->logActivity('password_reset', User::class, $user->id, "Palavra-passe do utilizador {$user->name} redefinida pelo administrador.");

        return response()->json([
            'success' => true,
            'message' => "Palavra-passe de {$user->name} redefinida com sucesso!",
            'new_password' => $password,
        ]);
    }

    public function deleteUser($id)
    {
        $this->admin();
        $user = User::withTrashed()->findOrFail($id);
        $currentUser = Auth::user();

        if ($user->id === $currentUser->id || $user->id === 1 || in_array($user->email, ['admin@rachi.ao', 'casimirogundja@outlook.com']) || $user->role?->slug === 'super_admin') {
            return response()->json([
                'success' => false,
                'message' => 'Não é permitido excluir o Administrador Master do sistema por questões de segurança!'
            ], 403);
        }

        $name = $user->name;
        $customers = Customer::withTrashed()->where('user_id', $user->id)->get();
        foreach ($customers as $c) {
            $enrollmentIds = CourseEnrollment::where('customer_id', $c->id)->pluck('id');
            if ($enrollmentIds->isNotEmpty()) {
                CourseProgress::whereIn('enrollment_id', $enrollmentIds)->delete();
                CourseEnrollment::whereIn('id', $enrollmentIds)->delete();
            }
            $c->forceDelete();
        }
        Employee::where('user_id', $user->id)->delete();
        $user->forceDelete();

        $this->logActivity('user_deleted', User::class, (int)$id, "Utilizador {$name} excluído pelo administrador.");

        return response()->json([
            'success' => true,
            'message' => "O utilizador {$name} e todas as suas inscrições foram excluídos com sucesso!",
            'deleted_id' => (int)$id,
        ]);
    }

    public function adminEnrollments()
    {
        $this->admin();
        $enrollments = CourseEnrollment::whereHas('customer', function ($q) {
                $q->whereHas('user', function ($qu) {
                    $qu->whereNull('deleted_at');
                });
            })
            ->with(['customer.user', 'course'])
            ->latest('id')
            ->get()
            ->map(function ($e) {
                return [
                    'id' => $e->id,
                    'aluno_id' => $e->customer_id,
                    'user_id' => $e->customer?->user_id,
                    'nome' => $e->customer?->user?->name ?? $e->customer?->name ?? 'Candidato',
                    'email' => $e->customer?->user?->email ?? '',
                    'telefone' => $e->customer?->phone ?? $e->customer?->whatsapp ?? 'Não informado',
                    'curso' => $e->course?->name ?? 'Formação RACHI',
                    'curso_slug' => $e->course?->slug ?? '',
                    'curso_id' => $e->course_id,
                    'status' => $e->status,
                    'data' => $e->created_at ? $e->created_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i'),
                    'codigo' => 'RAC-' . str_pad($e->id, 5, '0', STR_PAD_LEFT),
                ];
            });

        return response()->json(['success' => true, 'enrollments' => $enrollments]);
    }

    public function createEnrollment(Request $request)
    {
        $this->admin();
        $raw = json_decode($request->getContent(), true);
        $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();

        $name = $data['name'] ?? $data['nome'] ?? null;
        $email = $data['email'] ?? null;
        $phone = $data['phone'] ?? $data['telefone'] ?? '+244 972 888 585';
        $courseId = $data['course_id'] ?? null;
        $status = $data['status'] ?? 'active';

        if (!$email || !$courseId) {
            return response()->json(['success' => false, 'message' => 'E-mail e Curso são obrigatórios.'], 422);
        }

        $course = Course::find($courseId);
        if (!$course) {
            return response()->json(['success' => false, 'message' => 'Curso inválido ou não encontrado.'], 422);
        }

        $user = !empty($data['user_id'])
            ? User::find($data['user_id'])
            : User::where('email', $email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $name ?: explode('@', $email)[0],
                'email' => $email,
                'phone' => $phone,
                'role_id' => Role::where('slug', 'student')->first()?->id ?? 2,
                'password' => Hash::make('123456'),
                'status' => 'active',
                'email_verified_at' => now(),
            ]);
        }

        $customer = Customer::firstOrCreate(['user_id' => $user->id], [
            'type' => 'individual',
            'phone' => $phone,
            'whatsapp' => $phone,
            'status' => 'active',
        ]);
        $customer->update(['phone' => $phone, 'whatsapp' => $phone]);

        $enrollment = CourseEnrollment::where('course_id', $courseId)
            ->where('customer_id', $customer->id)
            ->first();

        if ($enrollment && $enrollment->status !== 'cancelled') {
            return response()->json(['success' => false, 'message' => 'Este utilizador já está inscrito neste curso.'], 409);
        }

        if ($enrollment) {
            $enrollment->update(['status' => $status, 'enrolled_at' => now()]);
        } else {
            $enrollment = CourseEnrollment::create([
                'course_id' => $courseId,
                'customer_id' => $customer->id,
                'status' => $status,
                'enrolled_at' => now(),
            ]);
        }

        $enrollment->load(['customer.user', 'course']);
        $codigo = 'RAC-' . str_pad($enrollment->id, 5, '0', STR_PAD_LEFT);
        $this->logActivity('enrollment_created', CourseEnrollment::class, $enrollment->id, "Matrícula {$codigo} criada para {$user->name} no curso {$course->name}.");

        return response()->json([
            'success' => true,
            'message' => 'Aluno matriculado com sucesso na RACHI Academy!',
            'enrollment' => [
                'id' => $enrollment->id,
                'aluno_id' => $enrollment->customer_id,
                'user_id' => $user->id,
                'nome' => $enrollment->customer?->user?->name ?? $user->name,
                'email' => $enrollment->customer?->user?->email ?? $user->email,
                'telefone' => $enrollment->customer?->phone ?? $phone,
                'curso' => $enrollment->course?->name ?? $course->name,
                'curso_slug' => $enrollment->course?->slug ?? $course->slug,
                'curso_id' => $enrollment->course_id,
                'status' => $enrollment->status,
                'data' => now()->format('d/m/Y H:i'),
                'codigo' => $codigo,
            ]
        ]);
    }

    public function updateEnrollmentStatus(Request $request, $id)
    {
        $this->admin();
        $enrollment = CourseEnrollment::with(['customer.user', 'course'])->findOrFail($id);
        $raw = json_decode($request->getContent(), true);
        $status = $request->input('status') ?? ($raw['status'] ?? 'active');
        $enrollment->status = $status;
        $enrollment->save();

        if ($enrollment->customer?->user && $status === 'active') {
            $enrollment->customer->user->update(['status' => 'active']);
        }

        $this->logActivity('enrollment_status', CourseEnrollment::class, $enrollment->id, "Estado da matrícula #{$enrollment->id} alterado para {$status}.");

        return response()->json([
            'success' => true,
            'message' => $status === 'active' ? 'Matrícula aprovada! O aluno foi ativado com sucesso.' : 'Status da matrícula atualizado.',
            'enrollment' => [
                'id' => $enrollment->id,
                'status' => $enrollment->status,
            ]
        ]);
    }

    public function deleteEnrollment($id)
    {
        $this->admin();
        $enrollment = CourseEnrollment::findOrFail($id);
        $enrollment->progress()->delete();
        $enrollment->delete();
        $this->logActivity('enrollment_deleted', CourseEnrollment::class, (int)$id, "Matrícula #{$id} eliminada.");

        return response()->json([
            'success' => true,
            'message' => 'Registo de inscrição na RACHI Academy excluído com sucesso!'
        ]);
    }

    public function adminData(string $entity)
    {
        $this->admin();
        $items = match ($entity) {
            'employees' => Employee::with('user')->get()->map(fn ($e) => array_merge($e->only(['id','position','department','status']),['name'=>$e->user?->name,'email'=>$e->user?->email])),
            'customers' => Customer::with('user')->get()->map(fn ($c) => array_merge($c->only(['id','company_name','phone','status']),['name'=>$c->user?->name,'email'=>$c->user?->email])),
            'products' => Product::all(['id','name','sku','price','stock_quantity','minimum_stock','status']),
            'services' => Service::all(['id','name','base_price','status']),
            'courses', 'catalogcourses' => Course::all(['id','name','slug','price','status','duration_hours']),
            'contacts' => DB::table('worker_contacts')->latest('id')->limit(200)->get(),
            'audit' => DB::table('activity_logs as a')->leftJoin('users as u','u.id','=','a.user_id')->latest('a.id')->limit(100)->get(['a.id','a.action','a.description','a.created_at as data','u.name as autor','a.ip_address']),
            'reports' => [['users'=>User::count(),'requests'=>ServiceRequest::count(),'enrollments'=>CourseEnrollment::count(),'revenue'=>Order::where('payment_status','paid')->sum('total')]],
            default => abort(404),
        };
        return response()->json(['items'=>$items]);
    }
}
