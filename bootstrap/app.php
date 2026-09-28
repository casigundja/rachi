<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->encryptCookies(except: [
            'rachi_session',
        ]);
        $middleware->web(append: [
            \App\Http\Middleware\SyncRachiSession::class,
        ]);
        $middleware->alias([
            'role' => \App\Http\Middleware\CheckRole::class,
        ]);
        $middleware->validateCsrfTokens(except: [
            'login',
            'logout',
            'contacto',
            'contacto/*',
            'checkout',
            'solicitacoes',
            'solicitacoes/*',
            'cliente/solicitacoes',
            'cliente/solicitacoes/*',
            'funcionario/solicitacoes',
            'funcionario/solicitacoes/*',
            'admin/solicitacoes',
            'admin/solicitacoes/*',
            'admin/academy',
            'admin/academy/*',
            'admin/users',
            'admin/users/*',
            'api/*',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
