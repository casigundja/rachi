<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminRequestController;

/*
|--------------------------------------------------------------------------
| Rotas de Administração (Sincronizadas com Cloud / SPA)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin|super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', fn () => redirect('/admin-dashboard'))->name('dashboard');

        // Recursos Administrativos mapeados para as abas do Painel Unificado
        Route::get('/utilizadores', fn () => redirect('/admin-dashboard#usuarios'))->name('users.index');
        Route::get('/funcionarios', fn () => redirect('/admin-dashboard#usuarios'))->name('employees.index');
        Route::get('/clientes', fn () => redirect('/admin-dashboard#clientes'))->name('customers.index');
        Route::get('/produtos', fn () => redirect('/admin-dashboard#loja-produtos'))->name('products.index');
        Route::get('/servicos', fn () => redirect('/admin-dashboard#grafica-produtos'))->name('services.index');
        Route::get('/cursos', fn () => redirect('/admin-dashboard#academy-cursos'))->name('courses.index');
        Route::get('/pedidos', fn () => redirect('/admin-dashboard#loja-pedidos'))->name('orders.index');
        Route::get('/solicitacoes', fn () => redirect('/admin-dashboard#requests'))->name('requests.index');
        Route::get('/solicitacoes/conversas', fn () => redirect('/admin-dashboard#requests'))->name('requests.conversations');
        Route::post('/solicitacoes/{serviceRequest}/mensagens', [AdminRequestController::class, 'sendMessage'])->name('requests.message');
        Route::post('/solicitacoes/{serviceRequest}/status', [AdminRequestController::class, 'updateStatus'])->name('requests.status');
        Route::get('/relatorios', fn () => redirect('/admin-dashboard#relatorios'))->name('reports.index');
    });
