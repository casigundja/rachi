<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CloudApiController;

/*
|--------------------------------------------------------------------------
| Rotas do Portal do Cliente (Sincronizadas com Cloud / SPA)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->prefix('cliente')->name('customer.')->group(function () {
    Route::get('/dashboard', fn () => redirect('/portal#requests'))->name('dashboard');

    // Solicitações
    Route::get('/solicitacoes', fn () => redirect('/portal#requests'))->name('requests');
    Route::get('/solicitacoes/nova', fn () => redirect('/portal#requests'))->name('requests.create');
    Route::post('/solicitacoes', [CloudApiController::class, 'createRequest'])->name('requests.store');
    Route::get('/solicitacoes/{serviceRequest}', fn () => redirect('/portal#requests'))->name('requests.show');
    Route::post('/solicitacoes/{serviceRequest}/mensagem', [CloudApiController::class, 'message'])->name('requests.message');

    // Orçamentos
    Route::get('/orcamentos', fn () => redirect('/portal#quotes'))->name('quotes');
    Route::post('/orcamentos/{quote}/aprovar', [CloudApiController::class, 'approveQuote'])->name('quotes.approve');

    // Pedidos e Cursos
    Route::get('/pedidos', fn () => redirect('/portal#orders'))->name('orders');
    Route::get('/pedidos/{order}', fn () => redirect('/portal#orders'))->name('orders.show');
    Route::get('/cursos', fn () => redirect('/portal#courses'))->name('courses');
});
