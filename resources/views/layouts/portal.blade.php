<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Painel') - RACHI</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 text-slate-800 antialiased font-sans">
    <div class="min-h-screen flex flex-col">
        <!-- Top Navbar -->
        <header class="bg-[#071326] text-white border-b border-slate-800 sticky top-0 z-50 shadow-2xl relative">
            <!-- Linha de Destaque Âmbar Superior Corporativo RACHI -->
            <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#071326] via-[#f5a800] to-[#071326]"></div>

            <div class="w-full px-6 sm:px-8 lg:px-12 min-h-[80px] flex items-center justify-between">
                <div class="flex items-center gap-5">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                        <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" alt="RACHI" class="h-10 sm:h-11 w-auto transition group-hover:scale-105">
                    </a>
                    <span class="text-xs uppercase tracking-wider px-3 py-1 rounded-full bg-[#f5a800]/20 text-[#f5a800] font-bold border border-[#f5a800]/40">
                        @yield('portal-type', 'Portal')
                    </span>
                </div>
                
                <div class="flex items-center gap-5">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-slate-300 hover:text-white flex items-center gap-2 px-3 py-2 rounded-xl hover:bg-white/5 transition">
                        <i data-lucide="globe" class="w-4 h-4 text-sky-400"></i>
                        <span class="hidden sm:inline">Ver Site</span>
                    </a>
                    
                    <div class="flex items-center gap-3.5 pl-5 border-l border-slate-800">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-[#f5a800] via-[#00a3e0] to-[#0050f0] text-[#071326] font-black flex items-center justify-center text-sm shadow ring-2 ring-white/10">
                            {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                        </div>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-bold text-white leading-tight">{{ auth()->user()->name ?? 'Utilizador' }}</div>
                            <div class="text-xs text-[#f5a800] font-medium">{{ auth()->user()->role->name ?? 'Membro' }}</div>
                        </div>
                        <form method="POST" action="{{ route('logout') }}" class="ml-2" onsubmit="syncPortalLogout()">
                            @csrf
                            <button type="submit" class="text-slate-400 hover:text-rose-400 p-2 rounded-xl hover:bg-rose-500/10 transition" title="Terminar sessão">
                                <i data-lucide="log-out" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <div class="flex-1 flex">
            <!-- Sidebar -->
            <aside class="w-64 bg-slate-900 border-r border-slate-800 flex-shrink-0 flex flex-col justify-between hidden md:flex">
                <nav class="p-4 space-y-1">
                    @yield('sidebar-menu')
                </nav>
                <div class="p-4 border-t border-slate-800 text-xs text-slate-500">
                    RACHI v1.0 &copy; 2026<br>
                    <span class="text-blue-400 font-medium">TEC • PRINT • ACADEMY • CAPITAL</span>
                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 bg-slate-100 p-6 md:p-8 overflow-y-auto">
                <!-- Breadcrumbs & Page Header -->
                <div class="mb-6">
                    <div class="text-xs text-slate-500 mb-1 flex items-center gap-2">
                        @yield('breadcrumbs')
                    </div>
                    <div class="flex items-center justify-between">
                        <h1 class="text-2xl font-bold text-slate-900">@yield('page-title')</h1>
                        <div>@yield('page-actions')</div>
                    </div>
                </div>

                <!-- Session Flash Messages -->
                @if (session('success'))
                    <div class="mb-6 bg-emerald-50 border-l-4 border-emerald-500 p-4 text-emerald-800 rounded shadow-sm flex items-center gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-600"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 text-red-800 rounded shadow-sm flex items-center gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-600"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif

                <!-- Body Content -->
                @yield('content')
            </main>
        </div>
    </div>

    <script>
        lucide.createIcons();

        function syncPortalLogout() {
            try {
                localStorage.removeItem('rachi_user_session');
                localStorage.removeItem('rachi_academy_auth');
                localStorage.setItem('rachi_user_session', JSON.stringify({ loggedIn: false, user: null }));
                if (typeof BroadcastChannel !== 'undefined') {
                    const bc = new BroadcastChannel('rachi_auth_channel');
                    bc.postMessage({ action: 'logout', timestamp: Date.now() });
                    bc.close();
                }
                localStorage.setItem('rachi_auth_sync', Date.now().toString());
            } catch(e) {}
        }

        try {
            if (typeof BroadcastChannel !== 'undefined') {
                const bc = new BroadcastChannel('rachi_auth_channel');
                bc.onmessage = (event) => {
                    if (event.data && event.data.action === 'logout') {
                        const logoutForm = document.querySelector('form[action="{{ route("logout") }}"]');
                        if (logoutForm) logoutForm.submit();
                    }
                };
            }
        } catch(e) {}
    </script>
    @stack('scripts')
</body>
</html>
