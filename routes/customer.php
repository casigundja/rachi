<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CloudApiController;

/*
|--------------------------------------------------------------------------
| Rotas do Portal do Cliente (Sincronizadas com Cloud / SPA)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('cliente')->name('customer.')->group(function () {
    Route::get('/dashboard', fn () => app(\App\Http\Controllers\CloudPageController::class)->page('portal'))->name('dashboard');

    // Solicitações
    Route::get('/solicitacoes', fn () => app(\App\Http\Controllers\CloudPageController::class)->page('portal'))->name('requests');
    Route::get('/solicitacoes/nova', fn () => app(\App\Http\Controllers\CloudPageController::class)->page('portal'))->name('requests.create');
    Route::post('/solicitacoes', [CloudApiController::class, 'createRequest'])->name('requests.store');
    Route::get('/solicitacoes/{serviceRequest}', fn () => redirect('/cliente/solicitacoes'))->name('requests.show');
    Route::post('/solicitacoes/{serviceRequest}/mensagem', [CloudApiController::class, 'message'])->name('requests.message');

    // Orçamentos
    Route::get('/orcamentos', fn () => app(\App\Http\Controllers\CloudPageController::class)->page('portal'))->name('quotes');
    Route::post('/orcamentos/{quote}/aprovar', [CloudApiController::class, 'approveQuote'])->name('quotes.approve');

    // Pedidos e Cursos
    Route::get('/pedidos', fn () => app(\App\Http\Controllers\CloudPageController::class)->page('portal'))->name('orders');
    Route::get('/pedidos/{order}', fn () => redirect('/cliente/pedidos'))->name('orders.show');
    Route::get('/cursos', fn () => app(\App\Http\Controllers\CloudPageController::class)->page('portal'))->name('courses');
});
