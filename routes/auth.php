<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Services\CustomerService;

/*
|--------------------------------------------------------------------------
| Funções Auxiliares de Autenticação e Sessão
|--------------------------------------------------------------------------
*/

if (!function_exists('issueRachiSession')) {
    function issueRachiSession(User $user, ?string $previousToken = null): string {
        try {
            if ($previousToken && preg_match('/^[a-f0-9]{64}$/', $previousToken)) {
                DB::table('worker_sessions')
                    ->where('token_hash', hash('sha256', $previousToken))
                    ->delete();
            }
            $token = bin2hex(random_bytes(32));
            $hash = hash('sha256', $token);
            DB::table('worker_sessions')->insert([
                'token_hash' => $hash,
                'user_id' => $user->id,
                'expires_at' => now()->addHours(12),
                'created_at' => now(),
            ]);
            return $token;
        } catch (\Throwable $e) {
            return bin2hex(random_bytes(32));
        }
    }
}

if (!function_exists('formatPublicUser')) {
    function formatPublicUser(User $user): array {
        $isAdm = $user->isAdmin();
        $hasActive = $isAdm || ($user->customer?->enrollments()->where('status', 'active')->exists() ?? false);
        $canAluno = $isAdm || $hasActive;

        return [
            'id' => $user->id,
            'name' => $user->name,
            'nome' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone ?? '',
            'role' => $user->role?->name ?? ($isAdm ? 'Super Administrador' : 'Cliente'),
            'role_slug' => $user->role?->slug ?? ($isAdm ? 'super_admin' : 'customer'),
            'tipo' => $isAdm ? 'admin' : ($canAluno ? 'aluno' : ($user->isEmployee() ? 'funcionario' : 'cliente')),
            'empresa' => $user->customer?->company_name ?? ($isAdm ? 'RACHI S.A.' : 'Conta Particular'),
            'has_matricula' => $hasActive,
            'has_active_enrollment' => $hasActive,
            'can_admin' => $isAdm,
            'can_aluno' => $canAluno,
            'can_customer' => true,
        ];
    }
}

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    if (Auth::check()) {
        $user = Auth::user();
        return redirect($user->isAdmin() ? '/admin-dashboard' : '/portal');
    }
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $raw = json_decode($request->getContent(), true);
    if (is_array($raw)) $request->merge($raw);

    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $email = strtolower(trim($credentials['email']));
    $password = (string) $credentials['password'];

    $user = User::whereRaw('LOWER(email) = ?', [$email])
        ->whereNull('deleted_at')
        ->first();

    if ($user && $user->status !== 'active') {
        $msg = 'A sua conta encontra-se inativa ou bloqueada. Contacte a administração.';
        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json(['success' => false, 'message' => $msg, 'csrf_token' => csrf_token()], 422);
        }
        return back()->withErrors(['email' => $msg])->onlyInput('email');
    }

    $authenticated = false;
    if ($user) {
        $hash = str_replace('$2a$', '$2y$', (string) $user->password);
        if (password_verify($password, $hash)) {
            $authenticated = true;
        }
    }

    if ($authenticated) {
        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        $token = issueRachiSession($user, $request->cookie('rachi_session'));
        $user->update(['last_login_at' => now()]);

        $dashboard = $user->isAdmin()
            ? '/admin-dashboard'
            : ($user->isEmployee() ? route('employee.dashboard') : '/portal');

        $userPayload = formatPublicUser($user);
        $cookie = cookie('rachi_session', $token, 43200 / 60, '/', null, false, false, false, 'Lax');

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'success' => true,
                'redirect' => $dashboard,
                'csrf_token' => csrf_token(),
                'user' => $userPayload,
            ])->withCookie($cookie);
        }

        return redirect()->intended($dashboard)->withCookie($cookie);
    }

    $msg = 'As credenciais fornecidas não conferem com os nossos registos.';
    if ($request->expectsJson() || $request->is('api/*')) {
        return response()->json([
            'success' => false,
            'message' => $msg,
            'csrf_token' => csrf_token(),
        ], 422);
    }

    return back()->withErrors(['email' => $msg])->onlyInput('email');
})->name('login.post');

Route::get('/registro', function () {
    return view('auth.register');
})->name('register');

Route::post('/registro', function (Request $request, CustomerService $customerService) {
    $raw = json_decode($request->getContent(), true);
    if (is_array($raw)) $request->merge($raw);

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
        'type' => 'nullable|in:individual,company',
        'document' => 'nullable|string|max:30',
        'company_name' => 'nullable|string|max:255',
        'phone' => 'nullable|string|max:30',
    ]);
    if (empty($validated['type'])) $validated['type'] = 'individual';

    $customer = $customerService->register($validated);
    Auth::login($customer->user);
    $token = issueRachiSession($customer->user, $request->cookie('rachi_session'));
    $cookie = cookie('rachi_session', $token, 43200 / 60, '/', null, false, false, false, 'Lax');

    if ($request->expectsJson() || $request->is('api/*')) {
        return response()->json([
            'success' => true,
            'redirect' => '/portal',
            'csrf_token' => csrf_token(),
            'user' => formatPublicUser($customer->user)
        ])->withCookie($cookie);
    }

    return redirect('/portal')->withCookie($cookie)->with('success', 'Conta criada com sucesso!');
})->name('register.post');

Route::match(['get', 'post'], '/logout', function (Request $request) {
    $token = $request->cookie('rachi_session');
    if ($token && preg_match('/^[a-f0-9]{64}$/', $token)) {
        try {
            $hash = hash('sha256', $token);
            DB::table('worker_sessions')->where('token_hash', $hash)->delete();
        } catch (\Throwable $e) {}
    }
    if ($user = Auth::user()) {
        try {
            DB::table('worker_sessions')->where('user_id', $user->id)->delete();
        } catch (\Throwable $e) {}
    }

    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    $forgetCookie = cookie()->forget('rachi_session', '/');

    if ($request->expectsJson() || $request->is('api/*')) {
        return response()->json([
            'success' => true,
            'redirect' => '/',
            'message' => 'Sessão encerrada com sucesso.',
            'csrf_token' => csrf_token(),
        ])->withCookie($forgetCookie);
    }

    return redirect('/')->withCookie($forgetCookie);
})->name('logout');

Route::get('/api/session', function (Request $request) {
    if (!Auth::check()) {
        $token = $request->cookie('rachi_session');
        if ($token && preg_match('/^[a-f0-9]{64}$/', $token)) {
            try {
                $hash = hash('sha256', $token);
                $sessionRecord = DB::table('worker_sessions')
                    ->where('token_hash', $hash)
                    ->where('expires_at', '>', now())
                    ->first();

                if ($sessionRecord) {
                    $user = User::where('id', $sessionRecord->user_id)
                        ->where('status', 'active')
                        ->whereNull('deleted_at')
                        ->first();

                    if ($user) {
                        Auth::login($user);
                    }
                }
            } catch (\Throwable $e) {}
        }
    }

    if (!Auth::check()) {
        return response()->json(['user' => null]);
    }

    $user = Auth::user();
    return response()->json([
        'user' => formatPublicUser($user)
    ]);
});
