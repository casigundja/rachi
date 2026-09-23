<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminRequestController;

/*
|--------------------------------------------------------------------------
| Rotas de Administração
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin|super_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Recursos Administrativos
        Route::get('/utilizadores', [AdminDashboardController::class, 'users'])->name('users.index');
        Route::get('/funcionarios', [AdminDashboardController::class, 'employees'])->name('employees.index');
        Route::get('/clientes', [AdminDashboardController::class, 'customers'])->name('customers.index');
        Route::get('/produtos', [AdminDashboardController::class, 'products'])->name('products.index');
        Route::get('/servicos', [AdminDashboardController::class, 'services'])->name('services.index');
        Route::get('/cursos', [AdminDashboardController::class, 'courses'])->name('courses.index');
        Route::get('/pedidos', [AdminDashboardController::class, 'orders'])->name('orders.index');
        Route::get('/solicitacoes', [AdminDashboardController::class, 'requests'])->name('requests.index');
        Route::get('/solicitacoes/conversas', [AdminRequestController::class, 'index'])->name('requests.conversations');
        Route::post('/solicitacoes/{serviceRequest}/mensagens', [AdminRequestController::class, 'sendMessage'])->name('requests.message');
        Route::post('/solicitacoes/{serviceRequest}/status', [AdminRequestController::class, 'updateStatus'])->name('requests.status');
        Route::get('/relatorios', [AdminDashboardController::class, 'reports'])->name('reports.index');
    });
