<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\CustomerService;

/*
|--------------------------------------------------------------------------
| Rotas de Autenticação
|--------------------------------------------------------------------------
*/

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials, $request->boolean('remember'))) {
        $request->session()->regenerate();

        $user = Auth::user();
        $dashboard = $user->isAdmin()
            ? route('admin.dashboard.view')
            : ($user->isEmployee() ? route('employee.dashboard') : route('customer.dashboard'));

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'redirect' => $dashboard,
                'csrf_token' => csrf_token(),
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'nome' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role?->name ?? ($user->isAdmin() ? 'admin' : 'customer'),
                    'role_slug' => $user->role?->slug ?? ($user->isAdmin() ? 'super_admin' : 'customer'),
                    'tipo' => $user->isAdmin() ? 'admin' : ($user->isEmployee() ? 'funcionario' : 'cliente'),
                    'empresa' => $user->customer?->company_name ?? ($user->isAdmin() ? 'RACHI S.A.' : 'Cliente RACHI'),
                    'has_matricula' => $user->isAdmin(),
                ]
            ]);
        }

        if ($user->isAdmin()) {
            return redirect()->intended(route('admin.dashboard.view'));
        }
        if ($user->isEmployee()) {
            return redirect()->intended(route('employee.dashboard'));
        }
        return redirect()->intended(route('customer.dashboard'));
    }

    if ($request->expectsJson()) {
        return response()->json([
            'success' => false,
            'message' => 'As credenciais fornecidas não conferem com os nossos registos.',
            'csrf_token' => csrf_token(),
        ], 422);
    }

    return back()->withErrors([
        'email' => 'As credenciais fornecidas não conferem com nossos registros.',
    ])->onlyInput('email');
})->name('login.post');

Route::get('/registro', function () {
    return view('auth.register');
})->name('register');

Route::post('/registro', function (Request $request, CustomerService $customerService) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed|min:6',
        'type' => 'required|in:individual,company',
        'document' => 'required|string|max:30',
        'company_name' => 'nullable|string|max:255',
        'phone' => 'required|string|max:30',
    ]);

    $customer = $customerService->register($validated);
    Auth::login($customer->user);

    return redirect()->route('customer.dashboard')->with('success', 'Conta criada com sucesso!');
})->name('register.post');

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');
