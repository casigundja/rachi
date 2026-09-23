<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar Conta - RACHI</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4 font-sans text-slate-100">
    <div class="max-w-md w-full bg-slate-800/80 backdrop-blur border border-slate-700 p-8 rounded-2xl shadow-2xl my-8">
        <div class="text-center mb-6">
            <a href="{{ route('home') }}" class="inline-block mb-3">
                <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" alt="RACHI" class="h-12 mx-auto">
            </a>
            <h2 class="text-2xl font-bold text-white tracking-wide">Criar Nova Conta</h2>
            <p class="text-sm text-slate-400 mt-1">Junte-se ao ecossistema RACHI</p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-500/10 border border-red-500/30 text-red-400 p-3 rounded-lg text-sm">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register.post') }}" class="space-y-4" x-data="{ type: 'individual' }">
            @csrf
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Nome Completo</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required
                       class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">E-mail</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Tipo de Cliente</label>
                <div class="grid grid-cols-2 gap-3">
                    <label class="flex items-center justify-center p-2 rounded-lg border border-slate-700 cursor-pointer" :class="type === 'individual' ? 'bg-amber-500/20 border-amber-500' : 'bg-slate-900/40'">
                        <input type="radio" name="type" value="individual" x-model="type" class="hidden">
                        <span class="text-sm">Particular (Singular)</span>
                    </label>
                    <label class="flex items-center justify-center p-2 rounded-lg border border-slate-700 cursor-pointer" :class="type === 'company' ? 'bg-amber-500/20 border-amber-500' : 'bg-slate-900/40'">
                        <input type="radio" name="type" value="company" x-model="type" class="hidden">
                        <span class="text-sm">Empresarial (Colectivo)</span>
                    </label>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="document" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1" x-text="type === 'company' ? 'NIF Empresa' : 'BI / Passaporte'"></label>
                    <input type="text" id="document" name="document" value="{{ old('document') }}" required
                           class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>
                <div>
                    <label for="phone" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Telefone / WhatsApp</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required
                           class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div x-show="type === 'company'" class="space-y-3">
                <div>
                    <label for="company_name" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Razão Social</label>
                    <input type="text" id="company_name" name="company_name" value="{{ old('company_name') }}"
                           class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Palavra-passe</label>
                    <input type="password" id="password" name="password" required
                           class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>
                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-300 uppercase tracking-wider mb-1">Confirmar</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                           class="w-full px-4 py-2.5 bg-slate-900/50 border border-slate-700 rounded-lg text-white placeholder-slate-500 focus:outline-none focus:border-amber-400">
                </div>
            </div>

            <button type="submit" class="w-full py-3 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold rounded-lg shadow-lg shadow-amber-500/20 transition duration-200 mt-2">
                Criar Conta
            </button>
        </form>

        <div class="mt-6 text-center text-sm text-slate-400">
            Já tem uma conta?
            <a href="{{ route('login') }}" class="text-amber-400 font-semibold hover:underline">Entrar</a>
        </div>
    </div>
</body>
</html>
