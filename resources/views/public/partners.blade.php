<!DOCTYPE html>
<html lang="pt">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Parceiros — RACHI</title>
    <meta name="description" content="RACHI — soluções inteligentes em tecnologia, educação e serviços empresariais.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preload" as="style" href="/build/assets/app-BmeisZIV.css" /><link rel="modulepreload" href="/build/assets/app-Dn06r9IG.js" /><link rel="stylesheet" href="/build/assets/app-BmeisZIV.css" />    <script defer src="/libs/alpine.js"></script>
    <script src="/libs/lucide.js"></script>
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
        html:not(.dark) .site-header .header-dropdown,
        html:not(.dark) .header-dropdown,
        .site-header.header-scrolled-light .header-dropdown {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.06) !important;
        }
        html:not(.dark) .site-header .header-dropdown a,
        html:not(.dark) .header-dropdown a,
        .site-header.header-scrolled-light .header-dropdown a {
            color: #334155 !important;
        }
        html:not(.dark) .site-header .header-dropdown a:hover,
        html:not(.dark) .header-dropdown a:hover,
        .site-header.header-scrolled-light .header-dropdown a:hover {
            background: #f1f5f9 !important;
            color: #0077c2 !important;
        }
        html:not(.dark) .site-header .header-dropdown .dropdown-title,
        html:not(.dark) .header-dropdown .dropdown-title,
        .site-header.header-scrolled-light .header-dropdown .dropdown-title {
            color: #0f172a !important;
        }
        html:not(.dark) .site-header .header-dropdown .dropdown-desc,
        html:not(.dark) .header-dropdown .dropdown-desc,
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
    <link rel="stylesheet" href="/css/site.css">
<link rel="stylesheet" href="/worker-marketing.css"></head>
<body x-data="{ currentTab: 'partners', mobileMenuOpen: false, solutionsOpen: false, solutionsOpen: false, goToHome() { location.href = '/'; }, scrollToSection(section) { location.href = '/' + section; }, openUnitPage(unit) { location.href = '/' + unit; }, openStore() { location.href = '/loja'; }, openContacto() { location.href = '/contacto'; } }" class="min-h-screen flex flex-col justify-between">
    <!-- EXACT NAV BAR -->
    <!-- HEADER DUAL-THEME: ESCURO NO TOPO, CLARO AO ROLAR (ESTILO KLASSE.AO) -->
        <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-5 lg:py-6 transition-all duration-300">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <!-- Coluna 1 (Esquerda): Logótipo RACHI -->
                <div class="flex-1 flex items-center justify-start min-w-0">
                    <a href="#home" @click.prevent="goToHome(); solutionsOpen = false" class="flex items-center group cursor-pointer transition-transform duration-200 hover:scale-[1.02]">
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
                    <a href="#home" @click.prevent="goToHome(); solutionsOpen = false" class="nav-link cursor-pointer" :class="currentTab === 'home' ? 'active' : ''">
                        <span>Home</span>
                    </a>
                    
                    <!-- Sobre Nós Dropdown -->
                    <div class="relative" x-data="{ open: false }" @click.outside="open = false; solutionsOpen = false" @keydown.escape.window="open = false; solutionsOpen = false" >
                        <button type="button" @click="open = !open; solutionsOpen = false" class="nav-link flex items-center gap-1.5 focus:outline-none" :class="open ? 'nav-link-open' : ''">
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
                             class="header-dropdown absolute top-full left-0 mt-2 w-56 bg-white/95 dark:bg-[#071326]/95 backdrop-blur-2xl border border-slate-200/90 dark:border-white/15 rounded-2xl shadow-xl dark:shadow-2xl p-2 z-50 text-sm space-y-1 before:absolute before:-top-3 before:left-0 before:right-0 before:h-3">
                            <a href="#sobre" @click.prevent="scrollToSection('sobre'); open = false; solutionsOpen = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Quem somos</span>
                            </a>
                            <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos'); open = false; solutionsOpen = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-cyan-500/15 text-cyan-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="layers" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O que fazemos</span>
                            </a>
                            <a href="#parceiros" @click.prevent="scrollToSection('parceiros'); open = false; solutionsOpen = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="handshake" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Parceiros</span>
                            </a>
                            <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos'); open = false; solutionsOpen = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-pink-500/15 text-pink-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Depoimentos</span>
                            </a>
                        </div>
                    </div>

                    <!-- Soluções (Mega Menu Ecossistema RACHI) -->
                    <button type="button"
                        id="btn-nav-solutions"
                        @click.stop="solutionsOpen = !solutionsOpen"
                        class="nav-link solutions-trigger-btn relative flex items-center gap-1.5 focus:outline-none cursor-pointer transition-all duration-200"
                        :class="solutionsOpen ? 'text-[#0077c2] dark:text-white font-semibold' : ''">
                        <span class="relative py-1">
                            Soluções
                            <!-- Linha ciano brilhante sob a palavra Soluções (idêntica à imagem) -->
                            <span x-show="solutionsOpen"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-x-0"
                                x-transition:enter-end="opacity-100 scale-x-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-x-100"
                                x-transition:leave-end="opacity-0 scale-x-0"
                                class="absolute -bottom-1.5 left-0 right-0 h-[2.5px] bg-[#00a3e0] rounded-full shadow-[0_0_8px_rgba(0,163,224,0.85)]"
                                style="display: none;"
                                x-cloak></span>
                        </span>
                    </button>

                    <a href="#etica" @click.prevent="scrollToSection('etica'); solutionsOpen = false" class="nav-link" :class="currentTab === 'etica' ? 'active' : ''">
                        <span>Ética e Compliance</span>
                    </a>
                    <a href="#loja" @click.prevent="openStore(); solutionsOpen = false" class="nav-link" :class="currentTab === 'loja' ? 'active' : ''">
                        <span>Loja</span>
                    </a>
                    <a href="/contacto" @click.prevent="openContacto(); solutionsOpen = false" class="nav-link" :class="currentTab === 'contacto' ? 'active' : ''">
                        <span>Contacto</span>
                    </a>
                </nav>
            </div>

            <!-- Coluna 3 (Direita): Autenticação e Ações Rápidas -->
            <div class="flex-1 flex items-center justify-end min-w-0 gap-2.5 sm:gap-3">
                

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
                <a href="#home" @click.prevent="goToHome(); solutionsOpen = false" class="block font-medium py-1.5 hover:text-[#00a3e0]">Home</a>
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
                    <a href="#etica" @click.prevent="scrollToSection('etica'); solutionsOpen = false" class="block font-medium py-1 hover:text-[#00a3e0]">Ética e Compliance</a>
                    <a href="#loja" @click.prevent="openStore(); mobileMenuOpen = false" class="block font-medium py-1 hover:text-[#00a3e0]">Loja</a>
                    <a href="/contacto" @click.prevent="openContacto(); mobileMenuOpen = false" class="block font-medium py-1 hover:text-[#00a3e0]" :class="currentTab === 'contacto' ? 'text-[#00a3e0]' : ''">Contacto</a>
                </div>
            </div>
        </header>

        <!-- MEGA PAINEL DE SOLUÇÕES (ECOSSISTEMA RACHI) -->
        @include('components.solutions-mega-menu')

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
        <div class="bg-[#071326] text-white py-16 px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto">
        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
            Alianças Estratégicas
        </span>
        <h1 class="text-4xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
            Nossos <span class="text-[#eba72d]">Parceiros</span>
        </h1>
        <div class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full my-6"></div>
        <p class="text-slate-300 text-lg md:text-xl max-w-3xl leading-relaxed">
            Marcas e instituições que caminham connosco para transformar o ecossistema empresarial em Angola.
        </p>
    </div>
</div>

<section class="py-16 sm:py-24 bg-white dark:bg-[#071326] transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-5 sm:gap-6 items-stretch">
            
            <!-- 01: INOV QUIMUA -->
            <div class="group relative bg-slate-50/80 dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 border border-slate-200/90 dark:border-white/10 hover:border-blue-400/50 dark:hover:border-blue-500/40 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-center min-h-[130px] sm:min-h-[150px] overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#00a3e0] to-[#0b4ea8] opacity-70"></div>
                <img src="/images/inov-quimua-tight.png" 
                     onerror="this.onerror=null; this.src='/images/inov-quimua-clean.png'"
                     alt="INOV QUIMUA" 
                     class="max-h-12 max-w-[85%] object-contain dark:hidden group-hover:scale-105 transition-transform duration-300">
                <img src="/images/inov-quimua-dark-tight.png" 
                     onerror="this.onerror=null; this.src='/images/inov-quimua-dark.png'"
                     alt="INOV QUIMUA" 
                     class="max-h-12 max-w-[85%] object-contain hidden dark:block group-hover:scale-105 transition-transform duration-300">
            </div>

            <!-- 02: HELTON PLUS -->
            <div class="group relative bg-slate-50/80 dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 border border-slate-200/90 dark:border-white/10 hover:border-amber-400/50 dark:hover:border-amber-500/40 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-center min-h-[130px] sm:min-h-[150px] overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#f5a800] to-amber-600 opacity-70"></div>
                <img src="/images/helton-plus-tight.png" 
                     onerror="this.onerror=null; this.src='/images/helton-plus-clean.png'"
                     alt="HELTON PLUS" 
                     class="max-h-16 max-w-[85%] object-contain dark:hidden group-hover:scale-105 transition-transform duration-300">
                <img src="/images/helton-plus-dark.png" 
                     onerror="this.onerror=null; this.src='/images/helton-plus-clean.png'"
                     alt="HELTON PLUS" 
                     class="max-h-16 max-w-[85%] object-contain hidden dark:block group-hover:scale-105 transition-transform duration-300">
            </div>

            <!-- 03: REPALANGA -->
            <div class="group relative bg-slate-50/80 dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 border border-slate-200/90 dark:border-white/10 hover:border-cyan-400/50 dark:hover:border-cyan-500/40 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-center min-h-[130px] sm:min-h-[150px] overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#00a3e0] to-cyan-600 opacity-70"></div>
                <img src="/images/repalanga-clean.png" 
                     onerror="this.onerror=null; this.src='/images/repalanga-tight.png'"
                     alt="REPALANGA" 
                     class="max-h-10 max-w-[85%] object-contain dark:hidden group-hover:scale-105 transition-transform duration-300">
                <img src="/images/repalanga-dark.png" 
                     onerror="this.onerror=null; this.src='/images/repalanga-clean.png'"
                     alt="REPALANGA" 
                     class="max-h-10 max-w-[85%] object-contain hidden dark:block group-hover:scale-105 transition-transform duration-300">
            </div>

            <!-- 04: REDE DO REINO -->
            <div class="group relative bg-slate-50/80 dark:bg-[#0c1829] rounded-2xl sm:rounded-3xl p-6 border border-slate-200/90 dark:border-white/10 hover:border-green-400/50 dark:hover:border-green-500/40 shadow-xs hover:shadow-md transition-all duration-300 flex items-center justify-center min-h-[130px] sm:min-h-[150px] overflow-hidden">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-green-500 to-emerald-700 opacity-70"></div>
                <img src="/images/rede-do-reino-clean.png" 
                     onerror="this.onerror=null; this.src='/images/rede-do-reino.png'"
                     alt="REDE DO REINO" 
                     class="max-h-15 max-w-[85%] object-contain dark:hidden group-hover:scale-105 transition-transform duration-300">
                <img src="/images/rede-do-reino-dark.png" 
                     onerror="this.onerror=null; this.src='/images/rede-do-reino-clean.png'"
                     alt="REDE DO REINO" 
                     class="max-h-15 max-w-[85%] object-contain hidden dark:block group-hover:scale-105 transition-transform duration-300">
            </div>

            <!-- 05: KLASSE (ÚNICO COM LINK OFICIAL) — col-span-2 lg:col-span-1 -->
            <a href="https://klasse.ao/" target="_blank" rel="noopener noreferrer" 
               class="col-span-2 sm:col-span-1 group relative bg-emerald-50/50 dark:bg-[#0c2230] rounded-2xl sm:rounded-3xl p-6 border border-emerald-400/50 dark:border-emerald-500/40 hover:border-emerald-500 shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 flex items-center justify-center min-h-[130px] sm:min-h-[150px] overflow-hidden cursor-pointer">
                <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-emerald-500 to-teal-600"></div>
                <div class="absolute top-2.5 right-2.5 text-emerald-600 dark:text-emerald-400 opacity-75 group-hover:opacity-100 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-all">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                </div>
                <div class="flex items-center gap-2.5">
                    <img src="/images/logo-klasse-clean.png" 
                         alt="KLASSE" 
                         class="max-h-12 w-auto object-contain group-hover:scale-105 transition-transform duration-300">
                    <div class="text-left">
                        <div class="text-base sm:text-lg font-[900] tracking-tight text-slate-900 dark:text-white leading-none">KLASSE</div>
                        <div class="text-[9px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400 mt-0.5">Gestão Escolar</div>
                    </div>
                </div>
            </a>

        </div>
    </div>
</section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-100 dark:bg-[#071326] text-slate-700 dark:text-slate-300 border-t border-slate-200 dark:border-slate-800 py-12 px-6 transition-colors duration-300">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <img src="/images/logo-rachi-light.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'" alt="RACHI" class="h-10 mb-4 hidden dark:block">
                        <img src="/images/logo-rachi.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi.png'" alt="RACHI" class="h-10 mb-4 dark:hidden">
                <p class="text-sm text-slate-400">
                    Soluções inteligentes em tecnologia, comunicação visual, formação profissional e recursos humanos.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Unidades</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="/solucoes/tec" class="hover:text-slate-900 dark:hover:text-white transition">RACHI Tec — Loja de TI</a></li>
                    <li><a href="/solucoes/print" class="hover:text-slate-900 dark:hover:text-white transition">RACHI Print — Artes &amp; Logótipos</a></li>
                    <li><a href="/solucoes/academy" class="hover:text-slate-900 dark:hover:text-white transition">RACHI Academy — Cursos</a></li>
                    <li><a href="/solucoes/capital" class="hover:text-slate-900 dark:hover:text-white transition">RACHI Capital — Sites &amp; Suporte TI</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Links Úteis</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="/loja" class="hover:text-slate-900 dark:hover:text-white transition">Loja Online</a></li>
                    <li><a href="#etica" class="hover:text-slate-900 dark:hover:text-white transition">Ética e Compliance</a></li>
                    <li><a href="/contacto" class="hover:text-slate-900 dark:hover:text-white transition">Contactos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Contacto</h4>
                <p class="text-sm text-slate-400">Luanda, Angola</p>
                <p class="text-sm text-slate-400 mt-1">geral@rachi.ao</p>
                <p class="text-sm text-slate-400 mt-1">+244 972 888 585</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-slate-200 dark:border-slate-800/80 text-xs text-slate-500 dark:text-slate-400 text-center">
            &copy; 2026 RACHI — Soluções Inteligentes. Todos os direitos reservados.
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    <script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>
</html>
