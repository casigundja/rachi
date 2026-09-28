<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireAcademyAccess
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        if (!$user?->isAdmin() && !$user?->customer?->enrollments()->whereIn('status',['active','completed'])->exists()) {
            return redirect('/academy/cursos');
        }
        return $next($request);
    }
}
