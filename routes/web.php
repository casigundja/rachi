<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\BusinessUnitController;
use App\Http\Controllers\Public\ProductController;
use App\Http\Controllers\Public\ServiceController;
use App\Http\Controllers\Public\CourseController;
use App\Http\Controllers\Public\ContactController;
use App\Http\Controllers\Public\ComplaintReportController;
use App\Http\Controllers\Admin\AdminRequestController;

/*
|--------------------------------------------------------------------------
| Web Routes - Área Pública
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sobre', [HomeController::class, 'about'])->name('about');
Route::get('/sobre-nos', [HomeController::class, 'about'])->name('about.alt');
Route::get('/diferencial', fn() => redirect('/#diferencial'))->name('differential');
Route::get('/o-nosso-diferencial', fn() => redirect('/#diferencial'))->name('differential.alt');
Route::get('/sobre/diferencial', fn() => redirect('/#diferencial'))->name('differential.sub');
Route::get('/missao', fn() => redirect('/#missao'))->name('missao');
Route::get('/visao', fn() => redirect('/#missao'))->name('visao');
Route::get('/valores', fn() => redirect('/#missao'))->name('valores');
Route::get('/identidade', fn() => redirect('/#missao'))->name('identidade');
Route::get('/missao-visao-valores', fn() => redirect('/#missao'))->name('missao.alt');
Route::get('/o-que-fazemos', [HomeController::class, 'whatWeDo'])->name('what-we-do');
Route::get('/parceiros', [HomeController::class, 'partners'])->name('partners');
Route::get('/depoimentos', [HomeController::class, 'testimonials'])->name('testimonials');
Route::get('/etica', [HomeController::class, 'ethics'])->name('ethics');

// Páginas de Conformidade Legal (Lei 22/11 e Lei 15/03 de Angola)
Route::get('/privacidade', fn() => view('public.legal.privacy'))->name('legal.privacy');
Route::get('/termos', fn() => view('public.legal.terms'))->name('legal.terms');
Route::get('/cookies', fn() => view('public.legal.cookies'))->name('legal.cookies');

// Canal Oficial de Reclamações e Denúncia (Ouvidoria & Compliance)
Route::get('/reclamacoes-e-denuncia', [ComplaintReportController::class, 'index'])->name('legal.complaints');
Route::post('/reclamacoes-e-denuncia', [ComplaintReportController::class, 'store'])->name('legal.complaints.store');
Route::post('/api/reclamacoes-denuncia', [ComplaintReportController::class, 'store'])->name('api.legal.complaints.store');
Route::get('/api/reclamacoes-denuncia/consultar', [ComplaintReportController::class, 'lookup'])->name('api.legal.complaints.lookup');
Route::redirect('/reclamacoes', '/reclamacoes-e-denuncia');
Route::redirect('/livro-de-reclamacoes', '/reclamacoes-e-denuncia?tipo=reclamacao');
Route::redirect('/denuncia', '/reclamacoes-e-denuncia?tipo=denuncia');
Route::redirect('/denuncias', '/reclamacoes-e-denuncia?tipo=denuncia');
Route::redirect('/canal-de-denuncia', '/reclamacoes-e-denuncia?tipo=denuncia');

Route::get('/contacto', [ContactController::class, 'index'])->name('contact');
Route::get('/contato', [ContactController::class, 'index'])->name('contact.alt');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');
Route::post('/api/crm/lead', [ContactController::class, 'crmLead'])->name('api.crm.lead');
Route::post('/api/chat', [ContactController::class, 'chatResponse'])->name('api.chat');

// Aliases para Serviços e Formações
Route::get('/servicos/{slug}', function (string $slug) {
    $tec = collect(\App\Http\Controllers\Public\BusinessUnitController::getTecServices())->firstWhere('slug', $slug);
    if ($tec) return redirect()->route('tec.service.show', $slug);

    $print = collect(\App\Http\Controllers\Public\BusinessUnitController::getPrintServices())->firstWhere('slug', $slug);
    if ($print) return redirect()->route('print.service.show', $slug);

    $capital = collect(\App\Http\Controllers\Public\BusinessUnitController::getCapitalServices())->firstWhere('slug', $slug);
    if ($capital) return redirect()->route('capital.service.show', $slug);

    abort(404);
});
Route::redirect('/formacoes', '/academy');
Route::redirect('/formacao', '/academy');
Route::redirect('/cursos', '/academy');
Route::redirect('/curso', '/academy');

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
    Route::get('/servicos', [BusinessUnitController::class, 'tec'])->name('services');
    Route::get('/servicos/{slug}', [BusinessUnitController::class, 'tecService'])->name('service.show');
});

Route::prefix('print')->name('print.')->group(function () {
    Route::get('/', [BusinessUnitController::class, 'print'])->name('index');
    Route::get('/servicos', [ServiceController::class, 'byUnit'])->defaults('unit', 'print')->name('services');
    Route::get('/servicos/{slug}', [BusinessUnitController::class, 'printService'])->name('service.show');
    Route::post('/solicitar-cotacao', [BusinessUnitController::class, 'requestQuote'])->name('quote.request');
});
Route::post('/api/print/solicitar-cotacao', [BusinessUnitController::class, 'requestQuote'])->name('api.print.quote');


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
    Route::get('/dashboard', [CourseController::class, 'dashboard'])->name('dashboard');
});

Route::get('/aluno-dashboard', [CourseController::class, 'dashboard'])->name('aluno.dashboard');
Route::get('/dashboard', [CourseController::class, 'dashboard']);
Route::get('/aluno', [CourseController::class, 'dashboard']);

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
Route::redirect('/home.html', '/');
Route::redirect('/about.html', '/sobre');
Route::redirect('/sobre.html', '/sobre');
Route::redirect('/sobre-nos.html', '/sobre');
Route::redirect('/what-we-do.html', '/o-que-fazemos');
Route::redirect('/o-que-fazemos.html', '/o-que-fazemos');
Route::redirect('/partners.html', '/parceiros');
Route::redirect('/parceiros.html', '/parceiros');
Route::redirect('/ethics.html', '/etica');
Route::redirect('/etica.html', '/etica');
Route::redirect('/testimonials.html', '/depoimentos');
Route::redirect('/depoimentos.html', '/depoimentos');
Route::redirect('/contact.html', '/contacto');
Route::redirect('/contacto.html', '/contacto');
Route::redirect('/contato.html', '/contacto');
Route::redirect('/loja.html', '/loja');
Route::redirect('/carrinho.html', '/carrinho');
Route::redirect('/checkout.html', '/checkout');
Route::redirect('/tec.html', '/tec');
Route::redirect('/print.html', '/print');
Route::redirect('/academy.html', '/academy');
Route::redirect('/capital.html', '/capital');
Route::redirect('/academy-login.html', '/academy/login');
Route::redirect('/aluno-dashboard.html', '/aluno-dashboard');
Route::redirect('/admin-dashboard.html', '/admin-dashboard');

// Services .html redirects
Route::redirect('/tec-service-consultoria-transformacao-digital.html', '/tec/servicos/consultoria-transformacao-digital');
Route::redirect('/tec-service-criacao-websites.html', '/tec/servicos/criacao-websites');
Route::redirect('/tec-service-digitalizacao-processos.html', '/tec/servicos/digitalizacao-processos');
Route::redirect('/tec-service-implementacao-sistemas-gestao.html', '/tec/servicos/implementacao-sistemas-gestao');
Route::redirect('/tec-service-suporte-tecnico-especializado.html', '/tec/servicos/suporte-tecnico-especializado');

Route::redirect('/capital-service-cedencia-temporaria.html', '/capital/servicos/cedencia-temporaria');
Route::redirect('/capital-service-constituicao-legalizacao-empresas.html', '/capital/servicos/constituicao-legalizacao-empresas');
Route::redirect('/capital-service-consultoria-recursos-humanos.html', '/capital/servicos/consultoria-recursos-humanos');
Route::redirect('/capital-service-organizacao-contabilidade.html', '/capital/servicos/organizacao-contabilidade');
Route::redirect('/capital-service-registo-inss.html', '/capital/servicos/registo-inss');
Route::redirect('/capital-service-regularizacao-documental.html', '/capital/servicos/regularizacao-documental');

Route::redirect('/print-service-documentos-institucionais.html', '/print/servicos/documentos-institucionais');
Route::redirect('/print-service-materiais-promocionais.html', '/print/servicos/materiais-promocionais');
Route::redirect('/print-service-producao-grafica-corporativa.html', '/print/servicos/producao-grafica-corporativa');
Route::redirect('/print-service-grafica-eventos.html', '/print/servicos/grafica-eventos');

// Dynamic fallbacks for any .html requests and /pages/*.html requests
Route::get('/tec-service-{slug}.html', fn(string $slug) => redirect('/tec/servicos/' . $slug, 301));
Route::get('/capital-service-{slug}.html', fn(string $slug) => redirect('/capital/servicos/' . $slug, 301));
Route::get('/print-service-{slug}.html', fn(string $slug) => redirect('/print/servicos/' . $slug, 301));
Route::get('/pages/{file}.html', function (string $file) {
    if (in_array($file, ['home', 'index'])) return redirect('/', 301);
    if ($file === 'about') return redirect('/sobre', 301);
    if ($file === 'what-we-do') return redirect('/o-que-fazemos', 301);
    if ($file === 'partners') return redirect('/parceiros', 301);
    if ($file === 'ethics') return redirect('/etica', 301);
    if ($file === 'testimonials') return redirect('/depoimentos', 301);
    if (in_array($file, ['contact', 'contacto'])) return redirect('/contacto', 301);
    if (str_starts_with($file, 'tec-service-')) return redirect('/tec/servicos/' . substr($file, 12), 301);
    if (str_starts_with($file, 'capital-service-')) return redirect('/capital/servicos/' . substr($file, 16), 301);
    if (str_starts_with($file, 'print-service-')) return redirect('/print/servicos/' . substr($file, 14), 301);
    return redirect('/' . $file, 301);
});
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

        $phone = $u->phone ?? $u->customer?->phone ?? $u->employee?->phone ?? '';

        return [
            'id' => $u->id,
            'name' => $u->name,
            'nome' => $u->name,
            'email' => $u->email,
            'phone' => $phone,
            'telefone' => $phone,
            'tipo' => $cfg['tipo'],
            'role' => $cfg['tipo'],
            'role_id' => $u->role_id,
            'role_slug' => $roleSlug,
            'tc' => $cfg['tc'],
            'status' => $statusLabel,
            'statusLabel' => $statusLabel,
            'raw_status' => $isDeleted ? 'deleted' : ($u->status ?? 'active'),
            'sk' => $statusKey,
            'is_deleted' => $isDeleted,
            'deleted_at' => $isDeleted ? $u->deleted_at->format('d/m/Y') : null,
            'ua' => $u->last_login_at ? $u->last_login_at->format('d/m/Y H:i') : ($u->created_at ? $u->created_at->format('d/m/Y H:i') : 'Recente'),
            'mod' => $cfg['mod'],
            'av' => $isDeleted ? 'bg-gradient-to-br from-slate-400 to-slate-500' : $cfg['av'],
            'ini' => $ini ?: 'US',
            'created_at' => $u->created_at ? $u->created_at->format('d/m/Y') : 'Recente',
            'data' => $u->created_at ? $u->created_at->format('d/m/Y') : 'Recente'
        ];
    }
}

Route::get('/admin-dashboard', [\App\Http\Controllers\Admin\AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin|super_admin'])
    ->name('admin.dashboard.view');

Route::get('/admin-dashboard.html', function () {
    return redirect('/admin-dashboard');
});

// AÇÕES ADMINISTRATIVAS DE CRIAÇÃO (ORDENS, VAGAS, PRODUTOS, IMPRESSÕES)
Route::post('/admin/requests/create', function (\Illuminate\Http\Request $request) {
    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();

    $unitId = (int)($data['business_unit_id'] ?? 1);
    $title = trim($data['title'] ?? '');
    $description = trim($data['description'] ?? '');
    $priority = in_array($data['priority'] ?? '', ['low', 'normal', 'high', 'urgent']) ? $data['priority'] : 'normal';
    $clientName = trim($data['customer_name'] ?? '');
    $clientEmail = trim($data['customer_email'] ?? '');
    $clientPhone = trim($data['customer_phone'] ?? '');

    if (!$title) {
        return response()->json(['success' => false, 'message' => 'O título da ordem/solicitação é obrigatório.'], 422);
    }

    $customer = null;
    if ($clientEmail) {
        $user = \App\Models\User::firstOrCreate(
            ['email' => $clientEmail],
            [
                'name' => $clientName ?: 'Cliente ' . explode('@', $clientEmail)[0],
                'password' => bcrypt(\Illuminate\Support\Str::random(12)),
                'role_id' => 3,
            ]
        );
        $customer = \App\Models\Customer::firstOrCreate(
            ['user_id' => $user->id],
            [
                'type' => 'individual',
                'phone' => $clientPhone,
                'status' => 'active',
            ]
        );
    } else {
        $customer = \App\Models\Customer::first();
    }

    $count = \App\Models\ServiceRequest::withTrashed()->count() + 1;
    $protocol = '#SOL-2026-' . str_pad($count, 6, '0', STR_PAD_LEFT);

    $serviceRequest = \App\Models\ServiceRequest::create([
        'protocol' => $protocol,
        'customer_id' => $customer?->id ?? 1,
        'business_unit_id' => $unitId,
        'title' => $title,
        'description' => $description ?: $title,
        'priority' => $priority,
        'status' => 'new',
        'requested_date' => now(),
    ]);

    \App\Models\ServiceRequestStatusHistory::create([
        'service_request_id' => $serviceRequest->id,
        'user_id' => auth()->id() ?? 1,
        'old_status' => null,
        'new_status' => 'new',
        'comment' => 'Ordem criada no painel administrativo',
        'created_at' => now(),
    ]);

    $ctrl = app(\App\Http\Controllers\Admin\AdminRequestController::class);
    $reflection = new \ReflectionMethod($ctrl, 'present');
    $reflection->setAccessible(true);
    $formatted = $reflection->invoke($ctrl, $serviceRequest->fresh(['customer.user', 'businessUnit', 'service', 'assignedEmployee.user', 'statusHistories.user', 'messages.user.role']));

    return response()->json([
        'success' => true,
        'message' => "Ordem {$protocol} registada com sucesso!",
        'request' => $formatted,
    ]);
})->middleware(['auth', 'role:admin|super_admin']);

Route::post('/admin/capital/jobs/create', function (\Illuminate\Http\Request $request) {
    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();

    $cargo = trim($data['cargo'] ?? '');
    $empresa = trim($data['empresa'] ?? '') ?: 'RACHI Human Capital';
    $local = trim($data['local'] ?? '') ?: 'Luanda';
    $mod = trim($data['mod'] ?? '') ?: 'Presencial';
    $sal = trim($data['sal'] ?? '') ?: 'Sob Proposta';
    $req = trim($data['req'] ?? '') ?: 'Consultoria & Alocação Especializada';
    $prazo = trim($data['prazo'] ?? '') ?: '30 dias';

    if (!$cargo) {
        return response()->json(['success' => false, 'message' => 'O título do cargo/vaga é obrigatório.'], 422);
    }

    $numPrice = preg_replace('/[^0-9.]/', '', str_replace(',', '.', $sal));

    $service = \App\Models\Service::create([
        'business_unit_id' => 4,
        'name' => $cargo,
        'slug' => \Illuminate\Support\Str::slug($cargo . '-' . rand(100, 999)),
        'short_description' => $req,
        'base_price' => is_numeric($numPrice) ? (float)$numPrice : null,
        'estimated_days' => 30,
        'status' => 'active',
    ]);

    $formattedJob = [
        'id' => $service->id,
        'cargo' => $cargo,
        'empresa' => $empresa,
        'local' => $local,
        'mod' => $mod,
        'sal' => $sal,
        'cands' => 0,
        'prazo' => $prazo,
        'req' => $req,
        'status' => 'Aberta',
    ];

    return response()->json([
        'success' => true,
        'message' => "Vaga '{$cargo}' publicada com sucesso no Human Capital!",
        'job' => $formattedJob,
    ]);
})->middleware(['auth', 'role:admin|super_admin']);

Route::post('/admin/tec/products/create', function (\Illuminate\Http\Request $request) {
    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();

    $nome = trim($data['nome'] ?? '');
    $sku = trim($data['sku'] ?? '');
    $cat = trim($data['cat'] ?? '') ?: 'Laptops & Computadores';
    $preco = (float)($data['preco'] ?? 0);
    $oldPrice = !empty($data['oldPrice']) ? (float)$data['oldPrice'] : null;
    $discountPercent = trim($data['discountPercent'] ?? '');
    $badge = trim($data['badge'] ?? 'Novo');
    $est = (int)($data['est'] ?? 10);
    $minEst = (int)($data['min_est'] ?? 3);
    $marca = trim($data['marca'] ?? '') ?: 'RACHI Tec';
    $image = trim($data['image'] ?? '') ?: '/images/hp-elitebook-studio.png';
    $shortDesc = trim($data['shortDesc'] ?? ($data['short_description'] ?? ''));
    $fullDesc = trim($data['fullDesc'] ?? ($data['description'] ?? ''));
    $specs = is_array($data['specs'] ?? null) ? $data['specs'] : [];
    $rating = trim($data['rating'] ?? '5.0');
    $reviews = (int)($data['reviews'] ?? 0);

    if (!$nome) {
        return response()->json(['success' => false, 'message' => 'O nome do produto é obrigatório.'], 422);
    }

    if (!$sku) {
        $sku = 'TEC-' . strtoupper(\Illuminate\Support\Str::random(6));
    }

    $category = \App\Models\Category::firstOrCreate(
        ['name' => $cat],
        ['slug' => \Illuminate\Support\Str::slug($cat)]
    );

    $product = \App\Models\Product::create([
        'business_unit_id' => 1,
        'category_id' => $category->id,
        'name' => $nome,
        'slug' => \Illuminate\Support\Str::slug($nome . '-' . rand(100, 999)),
        'sku' => $sku,
        'price' => $preco,
        'cost_price' => $oldPrice,
        'stock_quantity' => $est,
        'minimum_stock' => $minEst,
        'short_description' => $shortDesc,
        'description' => $fullDesc,
        'featured' => in_array($badge, ['Mais Vendido', 'Destaque', 'Lançamento']),
        'status' => 'active',
    ]);

    if ($image) {
        \App\Models\ProductImage::create([
            'product_id' => $product->id,
            'path' => $image,
            'alt' => $nome,
            'is_primary' => true,
            'sort_order' => 0,
        ]);
    }

    $formatted = [
        'id' => $product->id,
        'nome' => $product->name,
        'marca' => $marca,
        'sku' => $product->sku,
        'cat' => $cat,
        'preco' => 'AOA ' . number_format($product->price, 2, ',', '.'),
        'preco_raw' => (float)$product->price,
        'oldPrice' => $oldPrice ? ('AOA ' . number_format($oldPrice, 2, ',', '.')) : null,
        'discountPercent' => $discountPercent,
        'badge' => $badge,
        'est' => (int)$product->stock_quantity,
        'min_est' => (int)$product->minimum_stock,
        'vendas' => 0,
        'status' => 'Ativo',
        'image' => $image,
        'shortDesc' => $shortDesc,
        'fullDesc' => $fullDesc,
        'specs' => $specs,
        'rating' => $rating,
        'reviews' => $reviews,
    ];

    return response()->json([
        'success' => true,
        'message' => "Produto '{$nome}' adicionado ao catálogo com sucesso!",
        'product' => $formatted,
    ]);
})->middleware(['auth', 'role:admin|super_admin']);

Route::post('/admin/tec/stock/adjust', function (\Illuminate\Http\Request $request) {
    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();

    $productId = (int)($data['product_id'] ?? 0);
    $action = $data['action'] ?? 'add'; // 'add', 'remove', 'set'
    $quantity = (int)($data['quantity'] ?? 0);
    $reason = trim($data['reason'] ?? '') ?: 'Ajuste manual de inventário';
    $minStock = isset($data['minimum_stock']) ? (int)$data['minimum_stock'] : null;

    $product = \App\Models\Product::findOrFail($productId);
    $prevQuantity = (int)$product->stock_quantity;

    if ($action === 'add') {
        $newQuantity = $prevQuantity + max(0, $quantity);
        $type = 'entry';
    } elseif ($action === 'remove') {
        $newQuantity = max(0, $prevQuantity - max(0, $quantity));
        $type = 'exit';
    } else {
        $newQuantity = max(0, $quantity);
        $type = $newQuantity >= $prevQuantity ? 'entry' : 'exit';
    }

    $updateData = ['stock_quantity' => $newQuantity];
    if ($minStock !== null && $minStock >= 0) {
        $updateData['minimum_stock'] = $minStock;
    }
    if ($newQuantity === 0 && ($data['auto_disable'] ?? false)) {
        $updateData['status'] = 'inactive';
    }

    $product->update($updateData);

    \App\Models\StockMovement::create([
        'product_id' => $product->id,
        'user_id' => auth()->id() ?? 1,
        'type' => $type,
        'quantity' => abs($newQuantity - $prevQuantity),
        'previous_quantity' => $prevQuantity,
        'current_quantity' => $newQuantity,
        'reason' => $reason,
    ]);

    return response()->json([
        'success' => true,
        'message' => "Estoque do produto '{$product->name}' atualizado para {$newQuantity} un. com sucesso!",
        'product' => [
            'id' => $product->id,
            'nome' => $product->name,
            'marca' => 'RACHI Tec',
            'sku' => $product->sku,
            'cat' => $product->category?->name ?? 'Equipamentos TI',
            'preco' => 'AOA ' . number_format($product->price, 2, ',', '.'),
            'preco_raw' => (float)$product->price,
            'est' => (int)$product->stock_quantity,
            'min_est' => (int)$product->minimum_stock,
            'vendas' => (int)\App\Models\OrderItem::where('product_id', $product->id)->sum('quantity'),
            'status' => in_array(strtolower($product->status), ['active', 'ativo']) ? 'Ativo' : 'Inativo',
        ]
    ]);
})->middleware(['auth', 'role:admin|super_admin']);

Route::post('/admin/tec/stock/toggle-status', function (\Illuminate\Http\Request $request) {
    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();

    $productId = (int)($data['product_id'] ?? 0);
    $product = \App\Models\Product::findOrFail($productId);

    $currentStatus = strtolower($product->status);
    $newStatus = in_array($currentStatus, ['active', 'ativo']) ? 'inactive' : 'active';
    $product->update(['status' => $newStatus]);

    $statusLabel = $newStatus === 'active' ? 'Disponível na Loja' : 'Indisponível na Loja';

    return response()->json([
        'success' => true,
        'message' => "Produto '{$product->name}' agora está {$statusLabel}.",
        'product' => [
            'id' => $product->id,
            'nome' => $product->name,
            'marca' => 'RACHI Tec',
            'sku' => $product->sku,
            'cat' => $product->category?->name ?? 'Equipamentos TI',
            'preco' => 'AOA ' . number_format($product->price, 2, ',', '.'),
            'preco_raw' => (float)$product->price,
            'est' => (int)$product->stock_quantity,
            'min_est' => (int)$product->minimum_stock,
            'vendas' => (int)\App\Models\OrderItem::where('product_id', $product->id)->sum('quantity'),
            'status' => $newStatus === 'active' ? 'Ativo' : 'Inativo',
        ]
    ]);
})->middleware(['auth', 'role:admin|super_admin']);

Route::get('/admin/tec/requests', [AdminRequestController::class, 'tecIndex'])->middleware(['auth', 'role:admin|super_admin']);
Route::post('/tec/solicitar-proposta', [\App\Http\Controllers\Public\TecRequestController::class, 'store'])->name('tec.request.store');
Route::post('/api/tec/solicitar-proposta', [\App\Http\Controllers\Public\TecRequestController::class, 'store'])->name('api.tec.request');
Route::post('/api/loja/pedidos', [\App\Http\Controllers\Public\StoreOrderController::class, 'store'])->name('api.loja.order');
Route::get('/admin/tec/orders', [\App\Http\Controllers\Public\StoreOrderController::class, 'getTecOrders'])->middleware(['auth', 'role:admin|super_admin']);

Route::get('/admin/print/requests', [AdminRequestController::class, 'printIndex'])->middleware(['auth', 'role:admin|super_admin']);
Route::get('/admin/capital/requests', [AdminRequestController::class, 'capitalIndex'])->middleware(['auth', 'role:admin|super_admin']);
Route::post('/capital/solicitar-cotacao', [\App\Http\Controllers\Public\CapitalRequestController::class, 'store']);
Route::post('/api/capital/solicitar-cotacao', [\App\Http\Controllers\Public\CapitalRequestController::class, 'store']);

Route::post('/admin/print/orders/create', function (\Illuminate\Http\Request $request) {
    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();

    $nome = trim($data['nome'] ?? '');
    $desc = trim($data['desc'] ?? '');
    $mat = trim($data['mat'] ?? '') ?: 'Couché 300g Laminação Fosca';
    $tam = trim($data['tam'] ?? '') ?: 'Personalizado';
    $qtm = (int)($data['qtm'] ?? 1) ?: 1;
    $preco = (float)($data['preco'] ?? 0);
    $prazo = trim($data['prazo'] ?? '') ?: '2-3 dias úteis';

    if (!$nome) {
        return response()->json(['success' => false, 'message' => 'O nome do serviço/produto gráfico é obrigatório.'], 422);
    }

    $product = \App\Models\Product::create([
        'business_unit_id' => 2,
        'name' => $nome,
        'slug' => \Illuminate\Support\Str::slug($nome . '-' . rand(100, 999)),
        'short_description' => $desc ?: $mat,
        'price' => $preco,
        'stock_quantity' => $qtm,
        'status' => 'active',
    ]);

    $formatted = [
        'id' => 'p_' . $product->id,
        'nome' => $product->name,
        'desc' => $desc ?: 'Material Gráfico & Personalização',
        'mat' => $mat,
        'tam' => $tam,
        'qtm' => $qtm,
        'preco' => 'AOA ' . number_format($product->price, 2, ',', '.'),
        'prazo' => $prazo,
        'status' => 'Ativo',
    ];

    return response()->json([
        'success' => true,
        'message' => "Item gráfico '{$nome}' adicionado com sucesso!",
        'item' => $formatted,
    ]);
})->middleware(['auth', 'role:admin|super_admin']);

Route::post('/admin/academy/courses/create', function (\Illuminate\Http\Request $request) {
    $raw = json_decode($request->getContent(), true);
    $data = is_array($raw) ? array_merge($request->all(), $raw) : $request->all();

    $nome = trim($data['nome'] ?? '');
    $cat = trim($data['cat'] ?? '') ?: 'Tecnologia & Gestão';
    $dur = (int)($data['dur'] ?? 40) ?: 40;
    $preco = (float)($data['preco'] ?? 0);
    $level = in_array($data['level'] ?? '', ['beginner', 'intermediate', 'advanced']) ? $data['level'] : 'intermediate';
    $prof = trim($data['prof'] ?? '') ?: 'Corpo Docente RACHI';
    $modulos = (int)($data['modulos'] ?? 4) ?: 4;
    $desc = trim($data['desc'] ?? '');

    if (!$nome) {
        return response()->json(['success' => false, 'message' => 'O título da formação/curso é obrigatório.'], 422);
    }

    $category = \App\Models\Category::firstOrCreate(
        ['name' => $cat],
        ['slug' => \Illuminate\Support\Str::slug($cat)]
    );

    $course = \App\Models\Course::create([
        'business_unit_id' => 3, // RACHI Academy
        'category_id' => $category->id,
        'name' => $nome,
        'slug' => \Illuminate\Support\Str::slug($nome . '-' . rand(100, 999)),
        'description' => $desc ?: $nome,
        'short_description' => $desc ?: $nome,
        'price' => $preco,
        'duration_hours' => $dur,
        'level' => $level,
        'status' => 'published',
        'published_at' => now(),
    ]);

    if ($modulos > 0) {
        for ($i = 1; $i <= $modulos; $i++) {
            \App\Models\CourseModule::create([
                'course_id' => $course->id,
                'title' => "Módulo {$i}: Fundamentos e Prática",
                'description' => "Conteúdo programático do módulo {$i}",
                'sort_order' => $i,
            ]);
        }
    }

    $levelMap = ['beginner' => 'Iniciante', 'intermediate' => 'Intermédio', 'advanced' => 'Avançado'];

    $formattedCourse = [
        'id' => $course->id,
        'titulo' => $course->name,
        'slug' => $course->slug,
        'cat' => $cat,
        'preco' => 'AOA ' . number_format($course->price, 2, ',', '.'),
        'dur' => $dur . 'h',
        'nivel' => $levelMap[$course->level] ?? 'Intermédio',
        'status' => 'Ativo',
        'alunos' => 0,
        'taxa' => 100,
        'modulos' => $modulos,
        'prof' => $prof,
    ];

    return response()->json([
        'success' => true,
        'message' => "Curso '{$nome}' cadastrado com sucesso na Academy!",
        'course' => $formattedCourse,
    ]);
})->middleware(['auth', 'role:admin|super_admin']);

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

    if (in_array($user->role?->slug, ['customer', 'student'])) {
        \App\Models\Customer::firstOrCreate(
            ['user_id' => $user->id],
            [
                'type' => 'company',
                'company_name' => $user->name,
                'phone' => $user->phone,
                'status' => 'active',
            ]
        );
    }

    return response()->json([
        'success' => true,
        'message' => 'Utilizador ' . $user->name . ' criado com sucesso!',
        'user' => formatAdminUserRecord($user),
        'temp_password' => $password
    ]);
});

Route::get('/admin/clients', function () {
    $clients = \App\Models\Customer::with('user')
        ->withCount(['orders', 'serviceRequests'])
        ->latest()
        ->get()
        ->map(function ($c) {
            $isCompany = $c->type === 'company';
            return [
                'id' => $c->id,
                'nome' => $isCompany && !empty($c->company_name) ? $c->company_name : ($c->user?->name ?? 'Cliente #' . $c->id),
                'email' => $c->user?->email ?? '',
                'tipo' => $isCompany ? 'Empresa' : 'Particular',
                'tel' => $c->phone ?? $c->whatsapp ?? $c->user?->phone ?? '—',
                'tr' => (int)($c->orders_count + $c->service_requests_count),
                'status' => in_array(strtolower($c->status ?? 'active'), ['active', 'ativo']) ? 'Ativo' : 'Inativo',
                'sk' => in_array(strtolower($c->status ?? 'active'), ['active', 'ativo']) ? 'ativo' : 'inativo',
                'desde' => $c->created_at ? $c->created_at->format('M/Y') : 'Jan/2026',
            ];
        });

    return response()->json([
        'success' => true,
        'clients' => $clients,
        'stats' => [
            'total' => \App\Models\Customer::whereNull('deleted_at')->count(),
            'active' => \App\Models\Customer::where('status', 'active')->whereNull('deleted_at')->count(),
            'pending' => \App\Models\Customer::where('status', 'pending')->whereNull('deleted_at')->count(),
            'company' => \App\Models\Customer::where('type', 'company')->whereNull('deleted_at')->count(),
        ]
    ]);
})->middleware(['auth', 'role:admin|super_admin']);

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
    Route::get('/servicos', [BusinessUnitController::class, 'capital'])->name('services');
    Route::get('/servicos/{slug}', [BusinessUnitController::class, 'capitalService'])->name('service.show');
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
require __DIR__.'/cloud.php';
