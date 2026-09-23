<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\EmployeeDashboardController;
use App\Http\Controllers\Employee\EmployeeRequestController;

/*
|--------------------------------------------------------------------------
| Rotas do Portal do Funcionário
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:employee|manager|admin|super_admin'])
    ->prefix('funcionario')
    ->name('employee.')
    ->group(function () {
        Route::get('/dashboard', [EmployeeDashboardController::class, 'index'])->name('dashboard');

        // Atendimento de Solicitações
        Route::get('/solicitacoes', [EmployeeRequestController::class, 'index'])->name('requests');
        Route::get('/solicitacoes/{serviceRequest}', [EmployeeRequestController::class, 'show'])->name('requests.show');
        Route::post('/solicitacoes/{serviceRequest}/assumir', [EmployeeRequestController::class, 'assign'])->name('requests.assign');
        Route::post('/solicitacoes/{serviceRequest}/status', [EmployeeRequestController::class, 'updateStatus'])->name('requests.status');
        Route::post('/solicitacoes/{serviceRequest}/mensagem', [EmployeeRequestController::class, 'sendMessage'])->name('requests.message');

        // Orçamentos
        Route::post('/orcamentos', [EmployeeRequestController::class, 'storeQuote'])->name('quotes.store');

        // Pedidos & Estoque
        Route::get('/pedidos', [EmployeeDashboardController::class, 'orders'])->name('orders');
        Route::get('/estoque', [EmployeeDashboardController::class, 'stock'])->name('stock');
    });
