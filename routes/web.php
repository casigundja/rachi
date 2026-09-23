<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\BusinessUnitController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\CourseController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Admin\AdminRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes - Área Pública
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'about'])->name('about');
Route::get('/sobre-nos', [HomeController::class, 'about'])->name('about.alt');
Route::get('/o-que-fazemos', [HomeController::class, 'whatWeDo'])->name('what-we-do');
Route::get('/parceiros', [HomeController::class, 'partners'])->name('partners');
Route::get('/depoimentos', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/etica', [HomeController::class, 'ethics'])->name('ethics');

Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::get('/contato', [ContactController::class, 'index'])->name('contact.alt');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');

// Loja / Produtos
Route::get('/loja', [ProductController::class, 'index'])->name('store.index');
Route::get('/loja/{slug}', [ProductController::class, 'show'])->name('store.show');
Route::get('/carrinho', [ProductController::class, 'cart'])->name('cart.index');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout.index');
Route::post('/checkout', [ProductController::class, 'processCheckout'])->name('checkout.process');

// 4 Unidades de Negócio (Section 38)
Route::prefix('tec')->name('tec.')->group(function () {
    Route::get('/', [BusinessUnitController::class, 'tec'])->name('index');
    Route::get('/produtos', [ProductController::class, 'byUnit'])->defaults('unit', 'tec')->name('products');
    Route::get('/servicos', [ServiceController::class, 'byUnit'])->defaults('unit', 'tec')->name('services');
});

Route::prefix('print')->name('print.')->group(function () {
    Route::get('/', [BusinessUnitController::class, 'print'])->name('index');
    Route::get('/servicos', [ServiceController::class, 'byUnit'])->defaults('unit', 'print')->name('services');
});

Route::prefix('academy')->name('academy.')->group(function () {
    Route::get('/', [BusinessUnitController::class, 'academy'])->name('index');
    Route::get('/cursos', [CourseController::class, 'index'])->name('courses');
    Route::get('/cursos/{slug}', [CourseController::class, 'show'])->name('course.show');
    Route::post('/cursos/{slug}/matricula', [CourseController::class, 'enroll'])->name('course.enroll');
    Route::get('/login', function () {
        $dbEnrollments = \App\Models\CourseEnrollment::where('status', 'active')
            ->with(['customer.user', 'course'])
            ->get()
            ->map(function ($e) {
                return [
                    'id' => $e->customer->user_id ?? $e->id,
                    'aluno_id' => $e->customer_id ?? $e->id,
                    'nome' => $e->customer->user->name ?? $e->customer->name ?? 'Aluno RACHI',
                    'email' => strtolower($e->customer->user->email ?? ''),
                    'senha' => '123456',
                    'tipo' => 'aluno',
                    'status' => 'ativo',
                    'has_matricula' => true,
                    'matricula_status' => 'ativa',
                    'matricula_codigo' => 'RAC-' . str_pad($e->id, 5, '0', STR_PAD_LEFT),
                    'curso_matriculado' => $e->course->name ?? 'Formação RACHI'
                ];
            })
            ->filter(fn($u) => !empty($u['email']))
            ->values();

        return view('auth.academy-login', [
            'dbEnrollments' => $dbEnrollments
        ]);
    })->name('login');
    Route::get('/matricula', function () {
        return view('auth.academy-login');
    })->name('enroll');
    Route::get('/dashboard', function () {
        return view('public.aluno-dashboard');
    })->name('dashboard');
});

Route::get('/aluno-dashboard', function () {
    return view('public.aluno-dashboard');
})->name('aluno.dashboard');

Route::get('/dashboard', function () {
    return view('public.aluno-dashboard');
});

Route::get('/aluno', function () {
    return view('public.aluno-dashboard');
});

Route::get('/dashboard-aluno', function () {
    return redirect('/aluno-dashboard');
});

Route::get('/alunodashboard', function () {
    return redirect('/aluno-dashboard');
});

Route::get('/academy-dashboard', function () {
    return redirect('/aluno-dashboard');
});

Route::get('/aluno/dashboard', function () {
    return redirect('/aluno-dashboard');
});

Route::get('/dashboard/aluno', function () {
    return redirect('/aluno-dashboard');
});

Route::get('/academy-login', function () {
    return redirect('/academy/login');
});

// Redirecionamentos de compatibilidade para links .html
Route::redirect('/index.html', '/');
Route::redirect('/loja.html', '/loja');
Route::redirect('/contacto.html', '/contacto');
Route::redirect('/contato.html', '/contacto');
Route::redirect('/tec.html', '/tec');
Route::redirect('/print.html', '/print');
Route::redirect('/academy.html', '/academy');
Route::redirect('/capital.html', '/capital');
Route::redirect('/aluno-dashboard.html', '/aluno-dashboard');
// Helper para formatar utilizadores para o painel admin
if (!function_exists('formatAdminUserRecord')) {
    function formatAdminUserRecord($u) {
        $roleSlug = $u->role?->slug ?? 'customer';
        $roleMap = [
            'super_admin' => [
                'tipo' => 'Admin Master',
                'tc' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                'mod' => ['Todos os Módulos'],
                'av' => 'bg-gradient-to-br from-blue-600 to-indigo-700'
            ],
            'admin' => [
                'tipo' => 'Administrador',
                'tc' => 'bg-blue-100 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300',
                'mod' => ['Loja', 'Academy', 'Print', 'Human Capital'],
                'av' => 'bg-gradient-to-br from-blue-500 to-cyan-600'
            ],
            'manager' => [
                'tipo' => 'Gestor de Unidade',
                'tc' => 'bg-cyan-100 text-cyan-700 dark:bg-cyan-500/20 dark:text-cyan-300',
                'mod' => ['Loja', 'Print'],
                'av' => 'bg-gradient-to-br from-teal-500 to-cyan-600'
            ],
            'employee' => [
                'tipo' => 'Funcionário',
                'tc' => 'bg-purple-100 text-purple-700 dark:bg-purple-500/20 dark:text-purple-300',
                'mod' => ['Gráfica', 'Loja'],
                'av' => 'bg-gradient-to-br from-purple-600 to-violet-700'
            ],
            'rh_specialist' => [
                'tipo' => 'Especialista RH',
                'tc' => 'bg-amber-100 text-amber-800 dark:bg-orange-500/20 dark:text-orange-300',
                'mod' => ['Human Capital'],
                'av' => 'bg-gradient-to-br from-orange-600 to-amber-700'
            ],
            'instructor' => [
                'tipo' => 'Instrutora Academy',
                'tc' => 'bg-indigo-100 text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-300',
                'mod' => ['Academy'],
                'av' => 'bg-gradient-to-br from-indigo-600 to-blue-700'
            ],
            'student' => [
                'tipo' => 'Aluno / Cliente',
                'tc' => 'bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300',
                'mod' => ['Academy'],
                'av' => 'bg-gradient-to-br from-slate-600 to-slate-700'
            ],
            'customer' => [
                'tipo' => 'Cliente',
                'tc' => 'bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300',
                'mod' => ['Loja', 'Print'],
                'av' => 'bg-gradient-to-br from-slate-500 to-gray-600'
            ],
            'attendant' => [
                'tipo' => 'Atendente',
                'tc' => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-300',
                'mod' => ['Loja', 'Print'],
                'av' => 'bg-gradient-to-br from-emerald-600 to-teal-700'
            ],
        ];

        $cfg = $roleMap[$roleSlug] ?? [
            'tipo' => $u->role?->name ?? 'Utilizador',
            'tc' => 'bg-slate-100 text-slate-700 dark:bg-slate-500/20 dark:text-slate-300',
            'mod' => ['Geral'],
            'av' => 'bg-gradient-to-br from-slate-600 to-slate-700'
        ];

        $parts = explode(' ', trim($u->name ?? 'Utilizador'));
        $ini = count($parts) >= 2
            ? mb_strtoupper(mb_substr($parts[0], 0, 1) . mb_substr(end($parts), 0, 1))
            : mb_strtoupper(mb_substr($u->name ?? 'US', 0, 2));

        // Verificar se o utilizador está eliminado (soft delete)
        $isDeleted = !is_null($u->deleted_at);

        $statusStr = strtolower($u->status ?? 'active');
        $isBlocked = in_array($statusStr, ['blocked', 'bloqueado', 'suspended']);
        $isInactive = in_array($statusStr, ['inactive', 'inativo']);

        $statusLabel = 'Ativo';
        $statusKey = 'ativo';
        if ($isDeleted) {
            $statusLabel = 'Eliminado';
            $statusKey = 'deleted';
        } elseif ($isBlocked) {
            $statusLabel = 'Bloqueado';
            $statusKey = 'cancel';
        } elseif ($isInactive) {
            $statusLabel = 'Inativo';
            $statusKey = 'wait';
        }

        return [
            'id' => $u->id,
            'nome' => $u->name,
            'email' => $u->email,
            'telefone' => $u->phone ?? $u->customer?->phone ?? $u->employee?->phone ?? '',
            'tipo' => $cfg['tipo'],
            'role_id' => $u->role_id,
            'role_slug' => $roleSlug,
            'tc' => $cfg['tc'],
            'status' => $statusLabel,
            'raw_status' => $isDeleted ? 'deleted' : ($u->status ?? 'active'),
            'sk' => $statusKey,
            'is_deleted' => $isDeleted,
            'deleted_at' => $isDeleted ? $u->deleted_at->format('d/m/Y') : null,
            'ua' => $u->last_login_at ? $u->last_login_at->format('d/m/Y H:i') : ($u->created_at ? $u->created_at->format('d/m/Y H:i') : 'Recente'),
            'mod' => $cfg['mod'],
            'av' => $isDeleted ? 'bg-gradient-to-br from-slate-400 to-slate-500' : $cfg['av'],
            'ini' => $ini ?: 'US',
            'created_at' => $u->created_at ? $u->created_at->format('d/m/Y') : 'Recente'
        ];
    }
}

Route::get('/admin-dashboard', function () {
    $allRequests = app(AdminRequestController::class)->allRequests();
    $academyEnrollments = \App\Models\CourseEnrollment::whereHas('customer', function ($q) {
            $q->whereHas('user', function ($qu) {
                $qu->whereNull('deleted_at');
            });
        })
        ->with(['customer.user', 'course'])
        ->latest()
        ->get()
        ->map(function ($e) {
            return [
                'id' => $e->id,
                'aluno_id' => $e->customer_id,
                'user_id' => $e->customer?->user_id,
                'nome' => $e->customer->user->name ?? $e->customer->name ?? 'Candidato',
                'email' => $e->customer->user->email ?? '',
                'telefone' => $e->customer->phone ?? $e->customer->whatsapp ?? 'Não informado',
                'curso' => $e->course->name ?? 'Formação RACHI',
                'curso_slug' => $e->course->slug ?? '',
                'curso_id' => $e->course_id,
                'status' => $e->status, // 'pending', 'active', 'cancelled'
                'data' => $e->created_at ? $e->created_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i'),
                'codigo' => 'RAC-' . str_pad($e->id, 5, '0', STR_PAD_LEFT),
            ];
        });

    $coursesList = \App\Models\Course::where('status', 'published')->get(['id', 'name', 'slug']);
    $systemUsers = \App\Models\User::withTrashed()->with('role')->latest()->get()->map(fn($u) => formatAdminUserRecord($u));
    $systemRoles = \App\Models\Role::all(['id', 'name', 'slug', 'description']);

    return view('admin.dashboard', compact('allRequests', 'academyEnrollments', 'coursesList', 'systemUsers', 'systemRoles'));
})->middleware(['auth', 'role:admin|super_admin'])->name('admin.dashboard.view');

Route::get('/admin-dashboard.html', function () {
    return redirect('/admin-dashboard');
});

// ROTAS DE GESTÃO DE UTILIZADORES
Route::get('/admin/users', function () {
    $users = \App\Models\User::withTrashed()->with('role')->latest()->get()->map(fn($u) => formatAdminUserRecord($u));
    $roles = \App\Models\Role::all(['id', 'name', 'slug', 'description']);
    return response()->json([
        'success' => true,
        'users' => $users,
        'roles' => $roles
    ]);
});

Route::post('/admin/users', function (\Illuminate\Http\Request $request) {
    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();
    $name = $data['nome'] ?? $data['name'] ?? null;
    $email = $data['email'] ?? null;
    $phone = $data['telefone'] ?? $data['phone'] ?? null;
    $roleId = $data['role_id'] ?? null;
    $status = $data['status'] ?? 'active';
    $password = ($data['password'] ?? null) ?: '123456';

    if (!$name || !$email) {
        return response()->json([
            'success' => false,
            'message' => 'Nome e e-mail são obrigatórios.'
        ], 422);
    }

    if (\App\Models\User::where('email', $email)->exists()) {
        return response()->json([
            'success' => false,
            'message' => 'Este e-mail já se encontra registado no sistema.'
        ], 422);
    }

    $user = \App\Models\User::create([
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'role_id' => $roleId ?: (\App\Models\Role::where('slug', 'employee')->first()?->id ?? 1),
        'password' => \Illuminate\Support\Facades\Hash::make($password),
        'status' => $status,
        'email_verified_at' => now(),
    ]);

    $user->load('role');

    return response()->json([
        'success' => true,
        'message' => 'Utilizador ' . $user->name . ' criado com sucesso!',
        'user' => formatAdminUserRecord($user),
        'temp_password' => $password
    ]);
});

Route::post('/admin/users/{id}/update', function (\Illuminate\Http\Request $request, $id) {
    $user = \App\Models\User::findOrFail($id);

    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();
    $name = $data['nome'] ?? $data['name'] ?? null;
    $email = $data['email'] ?? null;
    $phone = $data['telefone'] ?? $data['phone'] ?? null;
    $roleId = $data['role_id'] ?? null;
    $status = $data['status'] ?? null;
    $password = $data['password'] ?? null;

    if ($email && $email !== $user->email) {
        if (\App\Models\User::where('email', $email)->where('id', '!=', $user->id)->exists()) {
            return response()->json([
                'success' => false,
                'message' => 'Este e-mail já pertence a outro utilizador.'
            ], 422);
        }
        $user->email = $email;
    }

    if ($name) $user->name = $name;
    if ($phone !== null) $user->phone = $phone;
    if ($roleId) $user->role_id = $roleId;
    if ($status) $user->status = $status;
    if (!empty($password)) {
        $user->password = \Illuminate\Support\Facades\Hash::make($password);
    }

    $user->save();
    $user->load('role');

    return response()->json([
        'success' => true,
        'message' => 'Dados do utilizador atualizados com sucesso!',
        'user' => formatAdminUserRecord($user)
    ]);
});

Route::post('/admin/users/{id}/toggle-status', function ($id) {
    $user = \App\Models\User::findOrFail($id);

    $current = strtolower($user->status ?? 'active');
    if (in_array($current, ['blocked', 'bloqueado', 'suspended'])) {
        $user->status = 'active';
        $msg = "O utilizador {$user->name} foi desbloqueado com sucesso!";
    } else {
        $user->status = 'blocked';
        $msg = "O utilizador {$user->name} foi bloqueado!";
    }

    $user->save();
    $user->load('role');

    return response()->json([
        'success' => true,
        'message' => $msg,
        'user' => formatAdminUserRecord($user)
    ]);
});

Route::post('/admin/users/{id}/reset-password', function (\Illuminate\Http\Request $request, $id) {
    $user = \App\Models\User::findOrFail($id);
    $newPass = $request->input('password') ?: 'Rachi@' . rand(1000, 9999);
    $user->password = \Illuminate\Support\Facades\Hash::make($newPass);
    $user->save();

    return response()->json([
        'success' => true,
        'message' => "Palavra-passe de {$user->name} redefinida com sucesso!",
        'new_password' => $newPass
    ]);
});

Route::match(['post', 'delete'], '/admin/users/{id}/delete', function ($id) {
    $user = \App\Models\User::withTrashed()->findOrFail($id);

    if ($user->id === 1 || in_array($user->email, ['admin@rachi.ao', 'casimirogundja@outlook.com'])) {
        return response()->json([
            'success' => false,
            'message' => 'Não é permitido excluir o Administrador Master do sistema por questões de segurança!'
        ], 403);
    }

    $name = $user->name;

    // Remover todos os clientes e matrículas da Academy vinculados a este utilizador
    $customers = \App\Models\Customer::withTrashed()->where('user_id', $user->id)->get();
    foreach ($customers as $c) {
        $enrollmentIds = \App\Models\CourseEnrollment::where('customer_id', $c->id)->pluck('id');
        if ($enrollmentIds->isNotEmpty()) {
            \App\Models\CourseProgress::whereIn('enrollment_id', $enrollmentIds)->delete();
            \App\Models\CourseEnrollment::whereIn('id', $enrollmentIds)->delete();
        }
        $c->forceDelete();
    }

    // Se tiver funcionário vinculado
    \App\Models\Employee::where('user_id', $user->id)->delete();

    // Excluir utilizador permanentemente
    $user->forceDelete();

    return response()->json([
        'success' => true,
        'message' => "O utilizador {$name} e todas as suas inscrições na Academy foram excluídos com sucesso!",
        'deleted_id' => (int)$id
    ]);
});

Route::get('/admin/academy/enrollments', function () {
    $enrollments = \App\Models\CourseEnrollment::whereHas('customer', function ($q) {
            $q->whereHas('user', function ($qu) {
                $qu->whereNull('deleted_at');
            });
        })
        ->with(['customer.user', 'course'])
        ->latest()
        ->get()
        ->map(function ($e) {
            return [
                'id' => $e->id,
                'aluno_id' => $e->customer_id,
                'user_id' => $e->customer?->user_id,
                'nome' => $e->customer->user->name ?? $e->customer->name ?? 'Candidato',
                'email' => $e->customer->user->email ?? '',
                'telefone' => $e->customer->phone ?? $e->customer->whatsapp ?? 'Não informado',
                'curso' => $e->course->name ?? 'Formação RACHI',
                'curso_slug' => $e->course->slug ?? '',
                'curso_id' => $e->course_id,
                'status' => $e->status,
                'data' => $e->created_at ? $e->created_at->format('d/m/Y H:i') : now()->format('d/m/Y H:i'),
                'codigo' => 'RAC-' . str_pad($e->id, 5, '0', STR_PAD_LEFT),
            ];
        });

    return response()->json(['enrollments' => $enrollments]);
});

Route::match(['post', 'delete'], '/admin/academy/enrollments/{id}/delete', function ($id) {
    $enrollment = \App\Models\CourseEnrollment::findOrFail($id);
    $enrollment->progress()->delete();
    $enrollment->delete();

    return response()->json([
        'success' => true,
        'message' => 'Registo de inscrição na RACHI Academy excluído com sucesso!'
    ]);
});

Route::post('/admin/academy/enrollments/{id}/status', function (\Illuminate\Http\Request $request, $id) {
    $enrollment = \App\Models\CourseEnrollment::with(['customer.user', 'course'])->findOrFail($id);
    $status = $request->input('status', 'active');
    $enrollment->status = $status;
    $enrollment->save();

    if ($enrollment->customer && $enrollment->customer->user) {
        $user = $enrollment->customer->user;
        if ($status === 'active') {
            $user->status = 'active';
            $user->save();
        }
    }

    return response()->json([
        'success' => true,
        'message' => $status === 'active' ? 'Matrícula aprovada! O aluno foi ativado com sucesso.' : 'Status da matrícula atualizado.',
        'enrollment' => [
            'id' => $enrollment->id,
            'status' => $enrollment->status,
        ]
    ]);
});

Route::post('/admin/academy/enrollments/create', function (\Illuminate\Http\Request $request) {
    $validated = $request->validate([
        'user_id' => 'nullable|integer|exists:users,id',
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:30',
        'course_id' => 'required|integer|exists:courses,id',
        'status' => 'nullable|in:active,pending',
    ]);
    $name = $validated['name'];
    $phone = $validated['phone'];
    $email = $validated['email'];
    $courseId = $validated['course_id'];
    $status = $validated['status'] ?? 'active';

    if (!$name || !$email || !$phone || !$courseId) {
        return response()->json([
            'success' => false,
            'message' => 'Campos obrigatórios em falta (Nome, E-mail, Telefone e Curso).'
        ], 422);
    }

    $user = !empty($validated['user_id'])
        ? \App\Models\User::findOrFail($validated['user_id'])
        : \App\Models\User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'password' => \Illuminate\Support\Facades\Hash::make('123456'),
                'status' => 'active'
            ]
        );

    $customer = \App\Models\Customer::firstOrCreate(
        ['user_id' => $user->id],
        [
            'phone' => $phone,
            'whatsapp' => $phone,
            'status' => 'active'
        ]
    );
    $customer->update(['phone' => $phone, 'whatsapp' => $phone]);

    $enrollment = \App\Models\CourseEnrollment::where('course_id', $courseId)
        ->where('customer_id', $customer->id)
        ->first();

    if ($enrollment && $enrollment->status !== 'cancelled') {
        return response()->json([
            'success' => false,
            'message' => 'Este utilizador ja esta inscrito neste curso.'
        ], 422);
    }

    if ($enrollment) {
        $enrollment->update(['status' => $status, 'enrolled_at' => now()]);
    } else {
        $enrollment = \App\Models\CourseEnrollment::create([
            'course_id' => $courseId,
            'customer_id' => $customer->id,
            'status' => $status,
            'enrolled_at' => now(),
        ]);
    }

    $enrollment->load(['customer.user', 'course']);

    return response()->json([
        'success' => true,
        'message' => 'Aluno matriculado com sucesso na RACHI Academy!',
        'enrollment' => [
            'id' => $enrollment->id,
            'aluno_id' => $enrollment->customer_id,
            'user_id' => $user->id,
            'nome' => $enrollment->customer->user->name ?? $validated['name'],
            'email' => $enrollment->customer->user->email ?? $validated['email'],
            'telefone' => $enrollment->customer->phone ?? $validated['phone'],
            'curso' => $enrollment->course->name ?? '',
            'curso_slug' => $enrollment->course->slug ?? '',
            'curso_id' => $enrollment->course_id,
            'status' => $enrollment->status,
            'data' => now()->format('d/m/Y H:i'),
            'codigo' => 'RAC-' . str_pad($enrollment->id, 5, '0', STR_PAD_LEFT),
        ]
    ]);
});

Route::prefix('capital')->name('capital.')->group(function () {
    Route::get('/', [BusinessUnitController::class, 'capital'])->name('index');
    Route::get('/servicos', [ServiceController::class, 'byUnit'])->defaults('unit', 'capital')->name('services');
});

Route::get('/solucoes/{unit}', [BusinessUnitController::class, 'show'])->name('unit.show');

// Solicitações e Atendimentos do Cliente (API Realtime)
Route::get('/solicitacoes/conversas', [\App\Http\Controllers\Public\SolicitacaoApiController::class, 'index'])->name('api.solicitacoes.index');
Route::post('/solicitacoes/{id}/mensagem', [\App\Http\Controllers\Public\SolicitacaoApiController::class, 'sendMessage'])->name('api.solicitacoes.message');
Route::post('/solicitacoes/nova', [\App\Http\Controllers\Public\SolicitacaoApiController::class, 'storeRequest'])->name('api.solicitacoes.store');

// Importação das rotas modulares
require __DIR__.'/auth.php';
require __DIR__.'/customer.php';
require __DIR__.'/employee.php';
require __DIR__.'/admin.php';
