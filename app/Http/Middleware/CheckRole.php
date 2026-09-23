<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            return $next($request);
        }

        $userRole = $user->role?->slug;

        // Permite sintaxe "admin|super_admin"
        $allowedRoles = [];
        foreach ($roles as $roleGroup) {
            foreach (explode('|', $roleGroup) as $role) {
                $allowedRoles[] = trim($role);
            }
        }

        if (in_array($userRole, $allowedRoles)) {
            return $next($request);
        }

        abort(403, 'Acesso não autorizado para o seu perfil de usuário.');
    }
}
