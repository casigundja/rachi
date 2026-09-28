<?php

use App\Http\Controllers\CloudPageController;
use App\Http\Controllers\CloudApiController;
use Illuminate\Support\Facades\Route;

// Templates and route aliases from the deployed Cloudflare Worker.
foreach (['login' => 'login', 'registro' => 'register', 'academy/login' => 'academy-login',
    'academy-login' => 'academy-login', 'academy/matricula' => 'academy-login',
    'carrinho' => 'cart', 'checkout' => 'cart', 'academy/cursos' => 'courses',
    'tec/produtos' => 'products', 'tec/servicos' => 'services', 'print/servicos' => 'services',
    'print/produtos' => 'products', 'capital/servicos' => 'services', 'capital/produtos' => 'products'] as $path => $page) {
    $route = Route::get('/'.$path, fn () => app(CloudPageController::class)->page($page));
    $names = ['login'=>'login','registro'=>'register','academy/login'=>'academy.login','academy/matricula'=>'academy.enroll',
        'carrinho'=>'cart.index','checkout'=>'checkout.index','academy/cursos'=>'academy.courses',
        'tec/produtos'=>'tec.products','tec/servicos'=>'tec.services','print/servicos'=>'print.services','capital/servicos'=>'capital.services'];
    if (isset($names[$path])) $route->name($names[$path]);
}
Route::get('/academy/cursos/{slug}', [CloudPageController::class, 'course'])->name('academy.course.show');
Route::get('/loja/{slug}', fn () => redirect('/loja'));
Route::get('/solucoes/{unit}', fn (string $unit) => in_array($unit, ['tec', 'print', 'academy', 'capital'], true) ? redirect('/'.$unit) : abort(404));
Route::get('/portal', fn () => app(CloudPageController::class)->page('portal'))->middleware('auth');

foreach (['cliente/dashboard'=>'requests', 'funcionario/dashboard'=>'requests', 'cliente/cursos'=>'courses',
    'cliente/pedidos'=>'orders', 'funcionario/pedidos'=>'orders', 'cliente/orcamentos'=>'quotes',
    'funcionario/estoque'=>'stock', 'cliente/solicitacoes'=>'requests',
    'cliente/solicitacoes/nova'=>'requests', 'funcionario/solicitacoes'=>'requests'] as $path => $tab) {
    $route = Route::get('/'.$path, fn () => redirect('/portal#'.$tab))->middleware('auth');
    $names = ['cliente/dashboard'=>'customer.dashboard','funcionario/dashboard'=>'employee.dashboard',
        'cliente/cursos'=>'customer.courses','cliente/pedidos'=>'customer.orders','funcionario/pedidos'=>'employee.orders',
        'cliente/orcamentos'=>'customer.quotes','funcionario/estoque'=>'employee.stock','cliente/solicitacoes'=>'customer.requests',
        'cliente/solicitacoes/nova'=>'customer.requests.create','funcionario/solicitacoes'=>'employee.requests'];
    $route->name($names[$path]);
}
foreach (['utilizadores'=>'usuarios','funcionarios'=>'usuarios','clientes'=>'clientes','produtos'=>'loja-produtos',
    'servicos'=>'grafica-produtos','cursos'=>'academy-cursos','pedidos'=>'loja-pedidos','solicitacoes'=>'requests','relatorios'=>'relatorios'] as $path=>$tab) {
    Route::get('/admin/'.$path, fn () => redirect('/admin-dashboard#'.$tab))->middleware(['auth','role:admin|super_admin']);
}
foreach (['cliente','funcionario'] as $area) {
    Route::get('/'.$area.'/solicitacoes/{id}', fn () => redirect('/portal#requests'))->middleware('auth');
}
Route::get('/cliente/pedidos/{id}', fn () => redirect('/portal#orders'))->middleware('auth');
Route::get('/api/catalog', [CloudApiController::class,'catalog']);
Route::get('/api/courses/{slug}', [CloudApiController::class,'course']);
Route::get('/api/academy/enrollments', [CloudApiController::class,'enrollments'])->middleware(['auth','role:admin|super_admin']);
Route::middleware('auth')->group(function () {
    Route::post('/solicitacoes/nova', [CloudApiController::class,'createRequest']);
    Route::post('/cliente/solicitacoes', [CloudApiController::class,'createRequest']);
    Route::post('/solicitacoes/{id}/mensagem', [CloudApiController::class,'message']);
    Route::get('/api/my/courses', [CloudApiController::class,'myCourses']);
    Route::get('/api/lessons/{id}', [CloudApiController::class,'lesson']);
    Route::post('/api/lessons/{id}/progress', [CloudApiController::class,'progress']);
    Route::post('/api/account/password', [CloudApiController::class,'password']);
    Route::get('/api/orders', [CloudApiController::class,'orders']);
    Route::post('/checkout', [CloudApiController::class,'checkout']);
    Route::post('/api/orders/{id}/paid', [CloudApiController::class,'paid']);
    Route::get('/api/quotes', [CloudApiController::class,'quotes']);
    Route::post('/funcionario/orcamentos', [CloudApiController::class,'createQuote']);
    Route::post('/cliente/orcamentos/{id}/aprovar', [CloudApiController::class,'approveQuote']);
    Route::get('/api/requests/{id}', [CloudApiController::class,'requestDetail']);
    Route::post('/api/requests/{id}/status', [CloudApiController::class,'requestStatus']);
    Route::post('/api/requests/{id}/assign', [CloudApiController::class,'requestAssign']);
    Route::post('/api/requests/{id}/files', [CloudApiController::class,'upload']);
    Route::get('/api/files/{id}', [CloudApiController::class,'file']);
    Route::get('/api/stock', [CloudApiController::class,'stock']);
    Route::get('/admin/users', [CloudApiController::class,'users']);
    Route::post('/admin/users', [CloudApiController::class,'createUser']);
    Route::post('/admin/users/{id}/update', [CloudApiController::class,'updateUser']);
    Route::post('/admin/users/{id}/toggle-status', [CloudApiController::class,'toggleStatusUser']);
    Route::post('/admin/users/{id}/reset-password', [CloudApiController::class,'resetPasswordUser']);
    Route::match(['post', 'delete'], '/admin/users/{id}/delete', [CloudApiController::class,'deleteUser']);
    Route::get('/admin/academy/enrollments', [CloudApiController::class,'adminEnrollments']);
    Route::post('/admin/academy/enrollments/create', [CloudApiController::class,'createEnrollment']);
    Route::post('/admin/academy/enrollments/{id}/status', [CloudApiController::class,'updateEnrollmentStatus']);
    Route::match(['post', 'delete'], '/admin/academy/enrollments/{id}/delete', [CloudApiController::class,'deleteEnrollment']);
    Route::get('/admin/data/{entity}', [CloudApiController::class,'adminData']);

    // Aliases para mensagens e status de solicitações (paridade com o Worker)
    Route::get('/admin/solicitacoes/conversas', [\App\Http\Controllers\Public\SolicitacaoApiController::class, 'index']);
    Route::post('/cliente/solicitacoes/{id}/mensagem', [CloudApiController::class,'message']);
    Route::post('/cliente/solicitacoes/{id}/mensagens', [CloudApiController::class,'message']);
    Route::post('/funcionario/solicitacoes/{id}/mensagem', [CloudApiController::class,'message']);
    Route::post('/funcionario/solicitacoes/{id}/mensagens', [CloudApiController::class,'message']);
    Route::post('/admin/solicitacoes/{id}/mensagem', [CloudApiController::class,'message']);
    Route::post('/admin/solicitacoes/{id}/mensagens', [CloudApiController::class,'message']);
    Route::post('/funcionario/solicitacoes/{id}/status', [CloudApiController::class,'requestStatus']);
    Route::post('/admin/solicitacoes/{id}/status', [CloudApiController::class,'requestStatus']);
    Route::post('/funcionario/solicitacoes/{id}/assumir', [CloudApiController::class,'requestAssign']);
});

// Keep the existing local dashboards until their actual published templates can be verified.
// Apply the access checks enforced by the deployed Worker to all dashboard aliases.
foreach (Route::getRoutes() as $route) {
    $uri = $route->uri();
    if ($uri === 'admin-dashboard' || str_starts_with($uri,'admin/')) $route->middleware(['auth','role:admin|super_admin']);
    if (in_array($uri,['aluno-dashboard','dashboard','aluno','academy/dashboard'],true)) {
        $route->middleware(['auth', \App\Http\Middleware\RequireAcademyAccess::class]);
    }
}
Route::get('/admin-dashboard.html', fn () => redirect('/admin-dashboard'))->middleware(['auth','role:admin|super_admin']);
