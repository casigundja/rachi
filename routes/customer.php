<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerRequestController;

/*
|--------------------------------------------------------------------------
| Rotas do Portal do Cliente
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('cliente')->name('customer.')->group(function () {
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])->name('dashboard');

    // Solicitações
    Route::get('/solicitacoes', [CustomerRequestController::class, 'index'])->name('requests');
    Route::get('/solicitacoes/nova', [CustomerRequestController::class, 'create'])->name('requests.create');
    Route::post('/solicitacoes', [CustomerRequestController::class, 'store'])->name('requests.store');
    Route::get('/solicitacoes/{serviceRequest}', [CustomerRequestController::class, 'show'])->name('requests.show');
    Route::post('/solicitacoes/{serviceRequest}/mensagem', [CustomerRequestController::class, 'sendMessage'])->name('requests.message');

    // Orçamentos
    Route::get('/orcamentos', [CustomerDashboardController::class, 'quotes'])->name('quotes');
    Route::post('/orcamentos/{quote}/aprovar', [CustomerDashboardController::class, 'approveQuote'])->name('quotes.approve');

    // Pedidos e Cursos
    Route::get('/pedidos', [CustomerDashboardController::class, 'orders'])->name('orders');
    Route::get('/pedidos/{order}', [CustomerDashboardController::class, 'showOrder'])->name('orders.show');
    Route::get('/cursos', [CustomerDashboardController::class, 'courses'])->name('courses');
});
