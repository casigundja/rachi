<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;

class SyncRachiSession
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Se não estiver autenticado pelo laravel_session, tenta autenticar pelo cookie rachi_session
        if (!Auth::check()) {
            $token = $request->cookie('rachi_session');
            if ($token && is_string($token) && preg_match('/^[a-f0-9]{64}$/', $token)) {
                try {
                    $hash = hash('sha256', $token);
                    $session = DB::table('worker_sessions')
                        ->where('token_hash', $hash)
                        ->where('expires_at', '>', now())
                        ->first();

                    if ($session) {
                        $user = User::where('id', $session->user_id)
                            ->where('status', 'active')
                            ->whereNull('deleted_at')
                            ->first();

                        if ($user) {
                            Auth::login($user);
                        }
                    }
                } catch (\Throwable $e) {
                    // Silently fail if table or query error
                }
            }
        }

        $response = $next($request);

        return $response;
    }
}
