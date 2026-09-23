<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RACHI — Soluções inteligentes')</title>
    <meta name="description" content="RACHI — soluções inteligentes em tecnologia, educação e serviços empresariais.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Script de Inicialização Imediata do Tema (Anti-Flash Dark Mode) -->
    <script>
        (function() {
            var theme = localStorage.getItem('rachi_theme');
            if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();

        window.toggleRachiTheme = function() {
            var isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('rachi_theme', isDark ? 'dark' : 'light');
            window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
            return isDark;
        };

        window.addEventListener('storage', function(e) {
            if (e.key === 'rachi_theme') {
                if (e.newValue === 'dark') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
                window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: e.newValue === 'dark' } }));
            }
        });
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Montserrat', sans-serif;
            color: #0b1a2e;
            background-color: #ffffff;
            margin: 0;
            padding: 0;
        }
        /* ============================================================ */
        /* DUAL THEME HEADER (Dark at top -> Light when scrolled)        */
        /* Exactly matching https://klasse.ao/                          */
        /* ============================================================ */

        .site-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1030 !important;
            width: 100% !important;
            transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        border-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        backdrop-filter 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        .brand-logo-img {
            height: 38px;
            width: auto;
            max-width: 200px;
            object-fit: contain;
            transition: transform 0.25s ease, filter 0.25s ease;
        }
        @media (min-width: 992px) {
            .brand-logo-img {
                height: 42px;
                max-width: 210px;
            }
        }

        /* ------------------------------------------------------------ */
        /* STATE 1: AT TOP (DARK LUXURY GLASS)                          */
        /* ------------------------------------------------------------ */
        .site-header.header-top-dark {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(24px) saturate(190%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(190%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
        }
        .site-header.header-top-dark .logo-light { display: block !important; }
        .site-header.header-top-dark .logo-dark { display: none !important; }

        /* Dark Nav Capsule */
        .site-header.header-top-dark .main-nav-capsule {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 9999px;
            padding: 0.3rem 0.55rem;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.25), inset 0 1px 0 rgba(255, 255, 255, 0.08);
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.835rem;
            font-weight: 500;
            letter-spacing: 0.015em;
            color: rgba(255, 255, 255, 0.82) !important;
            padding: 0.42rem 0.95rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link:hover,
        .site-header.header-top-dark .main-nav-capsule .nav-link.nav-link-open {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.12);
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0077c2 0%, #00a3e0 100%);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 2px 14px rgba(0, 163, 224, 0.45);
            font-weight: 600;
        }

        .site-header.header-top-dark .btn-entrar-nav {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            height: 38px;
            padding: 0 1.25rem;
            border-radius: 9999px;
            border: 1px solid rgba(0, 163, 224, 0.45);
            background: linear-gradient(135deg, rgba(0, 163, 224, 0.18) 0%, rgba(5, 25, 55, 0.5) 100%);
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 163, 224, 0.15), inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }
        .site-header.header-top-dark .btn-entrar-nav:hover {
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
            border-color: #00a3e0;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(0, 163, 224, 0.45);
        }
        .site-header.header-top-dark .mobile-menu-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.06) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            border-radius: 0.75rem;
            color: #ffffff !important;
            transition: all 0.2s ease;
        }
        .site-header.header-top-dark .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(0, 163, 224, 0.5) !important;
            color: #00a3e0 !important;
        }

        /* ------------------------------------------------------------ */
        /* STATE 2: SCROLLED DOWN (LIGHT / WHITE GLASS - KLASSE.AO STYLE)*/
        /* ------------------------------------------------------------ */
        .site-header.header-scrolled-light {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(11, 26, 46, 0.08) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.03) !important;
        }
        .site-header.header-scrolled-light .logo-light { display: none !important; }
        .site-header.header-scrolled-light .logo-dark { display: block !important; }

        /* Light Nav Capsule */
        .site-header.header-scrolled-light .main-nav-capsule {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            background: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
            border-radius: 9999px;
            padding: 0.3rem 0.55rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.04);
        }
        .site-header.header-scrolled-light .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.835rem;
            font-weight: 600;
            letter-spacing: 0.015em;
            color: #0b1a2e !important;
            padding: 0.42rem 0.95rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.22s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .site-header.header-scrolled-light .main-nav-capsule .nav-link:hover,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.nav-link-open {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.08);
        }
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0077c2 0%, #00a3e0 100%);
            border: 1px solid rgba(0, 163, 224, 0.3);
            box-shadow: 0 2px 10px rgba(0, 163, 224, 0.35);
            font-weight: 700;
        }
        .site-header.header-scrolled-light .nav-link svg {
            color: #475569;
        }

        /* Light Dropdowns */
        .site-header.header-scrolled-light .header-dropdown {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.06) !important;
        }
        .site-header.header-scrolled-light .header-dropdown a {
            color: #334155 !important;
        }
        .site-header.header-scrolled-light .header-dropdown a:hover {
            background: #f1f5f9 !important;
            color: #0077c2 !important;
        }
        .site-header.header-scrolled-light .header-dropdown .dropdown-title {
            color: #0f172a !important;
        }
        .site-header.header-scrolled-light .header-dropdown .dropdown-desc {
            color: #64748b !important;
        }

        .site-header.header-scrolled-light .btn-entrar-nav {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            height: 38px;
            padding: 0 1.25rem;
            border-radius: 9999px;
            border: 1px solid #00a3e0;
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
            color: #ffffff;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(0, 163, 224, 0.35);
        }
        .site-header.header-scrolled-light .btn-entrar-nav:hover {
            background: linear-gradient(135deg, #0092c8 0%, #0065a5 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 163, 224, 0.45);
        }
        .site-header.header-scrolled-light .mobile-menu-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            background: rgba(11, 26, 46, 0.05) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            border-radius: 0.75rem;
            color: #0b1a2e !important;
            transition: all 0.2s ease;
        }
        .site-header.header-scrolled-light .mobile-menu-btn:hover {
            background: rgba(0, 163, 224, 0.08) !important;
            border-color: #00a3e0 !important;
            color: #0077c2 !important;
        }
</style>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body class="min-h-screen flex flex-col justify-between">
    <!-- EXACT NAV BAR -->
    <!-- HEADER DUAL-THEME: ESCURO NO TOPO, CLARO AO ROLAR (ESTILO KLASSE.AO) -->
        <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-5 lg:py-6 transition-all duration-300">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <!-- Coluna 1 (Esquerda): Logótipo RACHI -->
                <div class="flex-1 flex items-center justify-start min-w-0">
                    <a href="#home" @click.prevent="goToHome()" class="flex items-center group cursor-pointer transition-transform duration-200 hover:scale-[1.02]">
                        <!-- Light Logo (for dark header at top) -->
                        <img src="/images/logo-rachi-light.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'"
                             alt="RACHI" 
                             class="brand-logo-img logo-light filter drop-shadow-sm group-hover:drop-shadow-[0_0_12px_rgba(0,163,224,0.3)] transition-all">
                        <!-- Dark Logo (for light header when scrolled) -->
                        <img src="/images/logo-rachi-dark.png" 
                             onerror="this.onerror=null; this.src='/images/logo-rachi.png'"
                             alt="RACHI" 
                             class="brand-logo-img logo-dark filter drop-shadow-sm group-hover:drop-shadow-[0_0_12px_rgba(0,163,224,0.2)] transition-all">
                    </a>
                </div>

                <!-- Coluna 2 (Centro): Navegação em Cápsula (Perfeitamente Centralizada) -->
                <div class="flex-shrink-0 flex items-center justify-center">
                    <nav class="hidden lg:flex items-center main-nav-capsule">
                    <a href="#home" @click.prevent="goToHome()" class="nav-link cursor-pointer" :class="currentTab === 'home' ? 'active' : ''">
                        <span>Home</span>
                    </a>
                    
                    <!-- Sobre Nós Dropdown -->
                    <div class="relative" x-data="{ open: false }" @mouseleave="open = false">
                        <button @mouseover="open = true" @click="open = !open" class="nav-link flex items-center gap-1.5 focus:outline-none" :class="open ? 'nav-link-open' : ''">
                            <span>Sobre Nós</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="opacity-70 transition-transform duration-200" :class="open ? 'rotate-180 text-[#00a3e0]' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="header-dropdown absolute top-full left-0 mt-3 w-56 bg-[#071326]/95 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl p-2 z-50 text-sm space-y-1">
                            <a href="#sobre" @click.prevent="scrollToSection('sobre'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Quem somos</span>
                            </a>
                            <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-cyan-500/15 text-cyan-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="layers" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O que fazemos</span>
                            </a>
                            <a href="#parceiros" @click.prevent="scrollToSection('parceiros'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="handshake" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Parceiros</span>
                            </a>
                            <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-pink-500/15 text-pink-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Depoimentos</span>
                            </a>
                        </div>
                    </div>

                    <!-- Soluções (4 Unidades) -->
                    <div class="relative" x-data="{ openSol: false }" @mouseleave="openSol = false">
                        <button @mouseover="openSol = true" @click="openSol = !openSol" class="nav-link flex items-center gap-1.5 focus:outline-none" :class="['capital','academy','tec','print'].includes(currentTab) || openSol ? 'active' : ''">
                            <span>Soluções</span>
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="opacity-70 transition-transform duration-200" :class="openSol ? 'rotate-180 text-[#00a3e0]' : ''">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                        </button>
                        <div x-show="openSol" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                             class="header-dropdown absolute top-full left-0 mt-3 w-80 bg-[#071326]/95 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl p-2.5 z-50 text-sm space-y-1.5">
                            
                            <a href="/capital" @click.prevent="openUnitPage('capital'); openSol = false" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-emerald-500/15 text-slate-300 hover:text-emerald-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center font-black text-xs">
                                        01
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Human Capital</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Pessoas &amp; Gestão</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/academy" @click.prevent="openUnitPage('academy'); openSol = false" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-indigo-500/15 text-slate-300 hover:text-indigo-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-indigo-500/15 text-indigo-400 flex items-center justify-center font-black text-xs">
                                        02
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Academy</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Capacitação &amp; Ensino</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/tec" @click.prevent="openUnitPage('tec'); openSol = false" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-sky-500/15 text-slate-300 hover:text-sky-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-sky-500/15 text-sky-400 flex items-center justify-center font-black text-xs">
                                        03
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Tec</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Tecnologia &amp; TI</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                            <a href="/print" @click.prevent="openUnitPage('print'); openSol = false" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-amber-500/15 text-slate-300 hover:text-amber-300 transition group">
                                <div class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center font-black text-xs">
                                        04
                                    </span>
                                    <div>
                                        <div class="font-bold text-xs dropdown-title">RACHI Print</div>
                                        <div class="text-[11px] text-slate-400 dropdown-desc">Gráfica &amp; Produção</div>
                                    </div>
                                </div>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                            </a>

                        </div>
                    </div>

                    <a href="#etica" @click.prevent="scrollToSection('etica')" class="nav-link" :class="currentTab === 'etica' ? 'active' : ''">
                        <span>Ética e Compliance</span>
                    </a>
                    <a href="#loja" @click.prevent="openStore()" class="nav-link" :class="currentTab === 'loja' ? 'active' : ''">
                        <span>Loja</span>
                    </a>
                    <a href="/contacto" @click.prevent="openContacto()" class="nav-link" :class="currentTab === 'contacto' ? 'active' : ''">
                        <span>Contacto</span>
                    </a>
                </nav>
            </div>

            <!-- Coluna 3 (Direita): Autenticação e Ações Rápidas -->
            <div class="flex-1 flex items-center justify-end min-w-0 gap-2.5 sm:gap-3">
                <!-- Botão Padronizado de Alternância de Tema (Dark / Light Mode) -->
                <button type="button"
                    onclick="window.toggleRachiTheme()"
                    class="theme-toggle-btn"
                    aria-label="Alternar Modo Escuro / Claro"
                    title="Alternar Modo Escuro / Claro">
                    <!-- Lua (Visível no modo claro -> ao clicar ativa escuro) -->
                    <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-slate-300 hover:text-white dark:hidden transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <!-- Sol (Visível no modo escuro -> ao clicar ativa claro) -->
                    <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-amber-400 hover:text-amber-300 hidden dark:block transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                    </svg>
                </button>

                <!-- Entrar button -->
                <a href="/?login=1" class="btn-entrar-nav group">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-0.5 transition-transform">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"/>
                        <polyline points="10 17 15 12 10 7"/>
                        <line x1="15" y1="12" x2="3" y2="12"/>
                    </svg>
                    <span>ENTRAR</span>
                </a>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl text-white hover:text-[#00a3e0] focus:outline-none" aria-label="Menu Principal">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak class="header-dropdown lg:hidden bg-[#071326]/95 backdrop-blur-2xl border-t border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">
                <a href="#home" @click.prevent="goToHome()" class="block font-medium py-1.5 hover:text-[#00a3e0]">Home</a>
                <div class="border-t border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-amber-400 tracking-wider">Sobre Nós</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="#sobre" @click.prevent="scrollToSection('sobre')" class="block text-sm text-slate-400 hover:text-white">Quem somos</a>
                        <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos')" class="block text-sm text-slate-400 hover:text-white">O que fazemos</a>
                        <a href="#parceiros" @click.prevent="scrollToSection('parceiros')" class="block text-sm text-slate-400 hover:text-white">Parceiros</a>
                        <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos')" class="block text-sm text-slate-400 hover:text-white">Depoimentos</a>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-[#00a3e0] tracking-wider">Soluções</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="/capital" @click.prevent="openUnitPage('capital')" class="block text-sm text-slate-400 hover:text-emerald-400">01 RACHI Human Capital (Pessoas &amp; Gestão)</a>
                        <a href="/academy" @click.prevent="openUnitPage('academy')" class="block text-sm text-slate-400 hover:text-indigo-400">02 RACHI Academy (Capacitação &amp; Ensino)</a>
                        <a href="/tec" @click.prevent="openUnitPage('tec')" class="block text-sm text-slate-400 hover:text-sky-400">03 RACHI Tec (Tecnologia &amp; TI)</a>
                        <a href="/print" @click.prevent="openUnitPage('print')" class="block text-sm text-slate-400 hover:text-amber-400">04 RACHI Print (Gráfica &amp; Produção)</a>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2 space-y-2">
                    <a href="#etica" @click.prevent="scrollToSection('etica')" class="block font-medium py-1 hover:text-[#00a3e0]">Ética e Compliance</a>
                    <a href="#loja" @click.prevent="openStore(); mobileMenuOpen = false" class="block font-medium py-1 hover:text-[#00a3e0]">Loja</a>
                    <a href="/contacto" @click.prevent="openContacto(); mobileMenuOpen = false" class="block font-medium py-1 hover:text-[#00a3e0]" :class="currentTab === 'contacto' ? 'text-[#00a3e0]' : ''">Contacto</a>
                </div>
            </div>
        </header>

        <!-- Script de Rolagem Inteligente (Estilo Klasse.ao): Escuro em cima, Claro ao rolar -->
        <script>
            (function() {
                function updateHeaderScroll() {
                    var header = document.getElementById('main-site-header') || document.querySelector('.site-header');
                    if (!header) return;
                    var isDark = document.documentElement.classList.contains('dark');
                    if (isDark) {
                        header.classList.remove('header-scrolled-light');
                        header.classList.add('header-top-dark');
                        return;
                    }
                    if (window.scrollY > 30) {
                        header.classList.remove('header-top-dark');
                        header.classList.add('header-scrolled-light');
                    } else {
                        header.classList.remove('header-scrolled-light');
                        header.classList.add('header-top-dark');
                    }
                }
                window.addEventListener('scroll', updateHeaderScroll, { passive: true });
                window.addEventListener('DOMContentLoaded', updateHeaderScroll);
                window.addEventListener('rachi-theme-changed', updateHeaderScroll);
                updateHeaderScroll();
            })();
        </script>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#071326] text-white border-t border-slate-800 py-12 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" 
                     onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'"
                     alt="RACHI" 
                     class="h-10 mb-4">
                <p class="text-sm text-slate-400">
                    Soluções inteligentes em tecnologia, comunicação visual, formação profissional e recursos humanos.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Unidades</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="{{ route('unit.show', 'tec') }}" class="hover:text-white">RACHI Tec — Loja de TI</a></li>
                    <li><a href="{{ route('unit.show', 'print') }}" class="hover:text-white">RACHI Print — Artes &amp; Logótipos</a></li>
                    <li><a href="{{ route('unit.show', 'academy') }}" class="hover:text-white">RACHI Academy — Cursos</a></li>
                    <li><a href="{{ route('unit.show', 'capital') }}" class="hover:text-white">RACHI Capital — Sites &amp; Suporte TI</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Links Úteis</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="{{ route('store.index') }}" class="hover:text-white">Loja Online</a></li>
                    <li><a href="#etica" class="hover:text-white">Ética e Compliance</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-white">Contactos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Contacto</h4>
                <p class="text-sm text-slate-400">Luanda, Angola</p>
                <p class="text-sm text-slate-400 mt-1">geral@rachi.ao</p>
                <p class="text-sm text-slate-400 mt-1">+244 923 000 000</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-slate-800/80 text-xs text-slate-500 text-center">
            &copy; 2026 RACHI — Soluções Inteligentes. Todos os direitos reservados.
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    @stack('scripts')
</body>
</html>
