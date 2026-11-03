<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'RACHI ” Soluções inteligentes')</title>
    <meta name="description" content="RACHI — soluções inteligentes em tecnologia, educação e serviços empresariais.">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <link rel="stylesheet" href="/worker-marketing.css?v=20261030-2">
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
        html.dark .site-header,
        .site-header.header-top-dark {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(24px) saturate(190%) !important;
            -webkit-backdrop-filter: blur(24px) saturate(190%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
        }
        html.dark .site-header .logo-light,
        .site-header.header-top-dark .logo-light { display: block !important; }
        html.dark .site-header .logo-dark,
        .site-header.header-top-dark .logo-dark { display: none !important; }

        /* Dark Nav Capsule */
        html.dark .site-header .main-nav-capsule,
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
        html.dark .site-header .main-nav-capsule .nav-link,
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
        html.dark .site-header .main-nav-capsule .nav-link:hover,
        html.dark .site-header .main-nav-capsule .nav-link.nav-link-open,
        .site-header.header-top-dark .main-nav-capsule .nav-link:hover,
        .site-header.header-top-dark .main-nav-capsule .nav-link.nav-link-open {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.12);
        }
        html.dark .site-header .main-nav-capsule .nav-link.active,
        .site-header.header-top-dark .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0077c2 0%, #00a3e0 100%);
            border: 1px solid rgba(255, 255, 255, 0.25);
            box-shadow: 0 2px 14px rgba(0, 163, 224, 0.45);
            font-weight: 600;
        }

        html.dark .site-header .btn-entrar-nav,
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
        html.dark .site-header .btn-entrar-nav:hover,
        .site-header.header-top-dark .btn-entrar-nav:hover {
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
            border-color: #00a3e0;
            color: #ffffff;
            transform: translateY(-1px);
            box-shadow: 0 4px 20px rgba(0, 163, 224, 0.45);
        }
        html.dark .site-header .mobile-menu-btn,
        .site-header.header-top-dark .mobile-menu-btn {
            display: none;
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
        html.dark .site-header .mobile-menu-btn:hover,
        .site-header.header-top-dark .mobile-menu-btn:hover {
            background: rgba(255, 255, 255, 0.12) !important;
            border-color: rgba(0, 163, 224, 0.5) !important;
            color: #00a3e0 !important;
        }

        /* ------------------------------------------------------------ */
        /* STATE 2: SCROLLED DOWN (LIGHT / WHITE GLASS - KLASSE.AO STYLE)*/
        /* ------------------------------------------------------------ */
        html:not(.dark) .site-header,
        .site-header.header-scrolled-light {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(11, 26, 46, 0.08) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.07), 0 1px 3px rgba(0, 0, 0, 0.03) !important;
        }
        html:not(.dark) .site-header .logo-light,
        .site-header.header-scrolled-light .logo-light { display: none !important; }
        html:not(.dark) .site-header .logo-dark,
        .site-header.header-scrolled-light .logo-dark { display: block !important; }

        /* Light Nav Capsule */
        html:not(.dark) .site-header .main-nav-capsule,
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
        html:not(.dark) .site-header .main-nav-capsule .nav-link,
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
        html:not(.dark) .site-header .main-nav-capsule .nav-link:hover,
        html:not(.dark) .site-header .main-nav-capsule .nav-link.nav-link-open,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link:hover,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.nav-link-open {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.08);
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link.active,
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0077c2 0%, #00a3e0 100%);
            border: 1px solid rgba(0, 163, 224, 0.3);
            box-shadow: 0 2px 10px rgba(0, 163, 224, 0.35);
            font-weight: 700;
        }
        html:not(.dark) .site-header .nav-link svg,
        .site-header.header-scrolled-light .nav-link svg {
            color: #475569;
        }

        /* Light Dropdowns */
        html:not(.dark) .site-header .header-dropdown,
        .site-header.header-scrolled-light .header-dropdown {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.06) !important;
        }
        html:not(.dark) .site-header .header-dropdown a,
        .site-header.header-scrolled-light .header-dropdown a {
            color: #334155 !important;
        }
        html:not(.dark) .site-header .header-dropdown a:hover,
        .site-header.header-scrolled-light .header-dropdown a:hover {
            background: #f1f5f9 !important;
            color: #0077c2 !important;
        }
        html:not(.dark) .site-header .header-dropdown .dropdown-title,
        .site-header.header-scrolled-light .header-dropdown .dropdown-title {
            color: #0f172a !important;
        }
        html:not(.dark) .site-header .header-dropdown .dropdown-desc,
        .site-header.header-scrolled-light .header-dropdown .dropdown-desc {
            color: #64748b !important;
        }

        html:not(.dark) .site-header .btn-entrar-nav,
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
        html:not(.dark) .site-header .btn-entrar-nav:hover,
        .site-header.header-scrolled-light .btn-entrar-nav:hover {
            background: linear-gradient(135deg, #0092c8 0%, #0065a5 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 163, 224, 0.45);
        }
        html:not(.dark) .site-header .mobile-menu-btn,
        .site-header.header-scrolled-light .mobile-menu-btn {
            display: none;
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
        html:not(.dark) .site-header .mobile-menu-btn:hover,
        .site-header.header-scrolled-light .mobile-menu-btn:hover {
            background: rgba(0, 163, 224, 0.08) !important;
            border-color: #00a3e0 !important;
            color: #0077c2 !important;
        }

        /* Mobile Header Cohesive System */
        @media (max-width: 640px) {
            .site-header {
                padding: 0.5rem 0.85rem !important;
                min-height: 56px !important;
                height: auto !important;
            }
            .site-header .site-header-inner,
            .site-header > div,
            .site-header .max-w-7xl {
                min-height: 40px !important;
                height: auto !important;
                gap: 0.5rem !important;
            }
            .site-header .brand-logo-img {
                height: 28px !important;
                max-width: 120px !important;
                width: auto !important;
                object-fit: contain !important;
            }
            .site-header .btn-entrar-nav {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                height: 34px !important;
                padding: 0 0.85rem !important;
                font-size: 0.72rem !important;
                font-weight: 700 !important;
                letter-spacing: 0.05em !important;
                border-radius: 9999px !important;
                gap: 0.35rem !important;
                white-space: nowrap !important;
            }
            .site-header .btn-entrar-nav svg {
                width: 13px !important;
                height: 13px !important;
            }
            .site-header .mobile-menu-btn {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                width: 34px !important;
                height: 34px !important;
                min-width: 34px !important;
                min-height: 34px !important;
                padding: 0 !important;
                border-radius: 9999px !important;
                border: 1px solid rgba(255, 255, 255, 0.14) !important;
                background: rgba(255, 255, 255, 0.08) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
            }
            html:not(.dark) .site-header .mobile-menu-btn,
            .site-header.header-scrolled-light .mobile-menu-btn {
                background: rgba(11, 26, 46, 0.05) !important;
                border: 1px solid rgba(11, 26, 46, 0.1) !important;
                color: #0b1a2e !important;
            }
            .site-header .mobile-menu-btn svg {
                width: 18px !important;
                height: 18px !important;
            }
        }

</style>
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
</head>
<body class="min-h-screen flex flex-col justify-between" x-data="{ solutionsOpen: false, mobileMenuOpen: false, currentTab: '' }">
    <!-- EXACT NAV BAR -->
    <!-- HEADER DUAL-THEME: ESCURO NO TOPO, CLARO AO ROLAR (ESTILO KLASSE.AO) -->
        <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-5 lg:py-6 transition-all duration-300">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <!-- Coluna 1 (Esquerda): Logótipo RACHI & Voltar -->
                <div class="flex-1 flex items-center justify-start min-w-0 gap-2 sm:gap-3">
                    <a href="/" class="flex items-center justify-center w-8 h-8 rounded-lg bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 text-slate-500 dark:text-slate-400 hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors group" title="Voltar para a página inicial">
                        <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-0.5 transition-transform"></i>
                        <span class="sr-only">Voltar para Início</span>
                    </a>
                    <span class="h-5 w-px bg-slate-200 dark:bg-white/10 hidden sm:block"></span>
                    <a href="/" class="flex items-center group cursor-pointer transition-transform duration-200 hover:scale-[1.02]">
                        <!-- Light Logo (for dark header at top) -->
                        <img src="/images/logo-rachi-light.png" 
                             onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'"
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
                                                        <a href="/#diferencial" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O nosso diferencial</span>
                            </a>
                            <a href="/#missao" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-indigo-500/15 text-indigo-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="compass" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Missão, visão e valores</span>
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
                                <span class="font-medium text-xs dropdown-title">Testemunhos</span>
                            </a>
                        </div>
                    </div>

                    <!-- Soluções (Mega Menu Ecossistema RACHI) -->
                    <button type="button"
                        id="btn-nav-solutions"
                        @click.stop="solutionsOpen = !solutionsOpen"
                        class="nav-link solutions-trigger-btn relative flex items-center gap-1.5 focus:outline-none cursor-pointer transition-all duration-200"
                        :class="solutionsOpen ? 'text-white font-semibold' : ''">
                        <span class="relative py-1 inline-block">
                            Soluções
                            <!-- Linha ciano brilhante sob a palavra Soluções (idêntica à imagem de referência) -->
                            <span x-show="solutionsOpen"
                                x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 scale-x-0"
                                x-transition:enter-end="opacity-100 scale-x-100"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 scale-x-100"
                                x-transition:leave-end="opacity-0 scale-x-0"
                                style="position: absolute; bottom: -8px; left: 0; right: 0; height: 3px; background-color: #00a3e0; border-radius: 9999px; box-shadow: 0 0 10px rgba(0, 163, 224, 0.9);"
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
                <button @click.stop="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl text-white hover:text-[#00a3e0] focus:outline-none" aria-label="Menu Principal">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

            <!-- Mobile Menu Dropdown -->
            <div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false" x-cloak class="header-dropdown lg:hidden bg-[#071326]/95 backdrop-blur-2xl border-t border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">
                <a href="#home" @click.prevent="goToHome(); solutionsOpen = false" class="block font-medium py-1.5 hover:text-[#00a3e0]">Home</a>
                <div class="border-t border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-amber-400 tracking-wider">Sobre Nós</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="#sobre" @click.prevent="scrollToSection('sobre')" class="block text-sm text-slate-400 hover:text-white">Quem somos</a>
                        <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos')" class="block text-sm text-slate-400 hover:text-white">O que fazemos</a>
                        <a href="#parceiros" @click.prevent="scrollToSection('parceiros')" class="block text-sm text-slate-400 hover:text-white">Parceiros</a>
                        <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos')" class="block text-sm text-slate-400 hover:text-white">Testemunhos</a>
                    </div>
                </div>
                <div class="border-t border-white/10 pt-2">
                    <span class="text-xs uppercase font-bold text-[#00a3e0] tracking-wider">Soluções</span>
                    <div class="pl-3 mt-1 space-y-1.5">
                        <a href="/capital" @click.prevent="openUnitPage('capital')" class="block text-sm text-slate-400 hover:text-emerald-400">RACHI Human Capital</a>
                        <a href="/academy" @click.prevent="openUnitPage('academy')" class="block text-sm text-slate-400 hover:text-indigo-400">RACHI Academy</a>
                        <a href="/tec" @click.prevent="openUnitPage('tec')" class="block text-sm text-slate-400 hover:text-sky-400">RACHI Tec</a>
                        <a href="/print" @click.prevent="openUnitPage('print')" class="block text-sm text-slate-400 hover:text-amber-400">RACHI Print</a>
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
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer class="bg-slate-100 dark:bg-[#071326] text-slate-700 dark:text-slate-300 pt-10 sm:pt-14 pb-28 sm:pb-12 border-t border-slate-200 dark:border-white/10 transition-colors duration-300 mt-16 sm:mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                
                <!-- 1. BLOCO SUPERIOR: IDENTIDADE & APOIO AO CLIENTE -->
                <div class="space-y-3.5">
                    <div>
                        <div class="flex items-center gap-3">
                            <img src="/images/logo-rachi.png" alt="RACHI" class="h-8 sm:h-9 w-auto object-contain dark:hidden" onerror="this.onerror=null; this.src='/images/logo-rachi-dark.png'">
                            <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-8 sm:h-9 w-auto object-contain hidden dark:block" onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'">
                            <h3 class="font-bold text-base sm:text-lg text-slate-900 dark:text-white tracking-tight">RACHI — Soluções Inteligentes</h3>
                        </div>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2 max-w-2xl leading-relaxed">
                            Ecossistema integrado de soluções corporativas em Angola: tecnologia, produção gráfica, formação profissional e capital humano.
                        </p>
                    </div>

                    <div class="pt-1">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">Apoio ao Cliente</h4>
                        <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-1 flex flex-wrap items-center gap-x-4 gap-y-1">
                            <a href="https://wa.me/244923000001" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 font-semibold transition-colors">
                                <svg class="w-4 h-4 shrink-0 fill-current" viewBox="0 0 24 24"><path d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.019 3.287l-.582 2.128 2.182-.573c.978.58 1.911.928 3.145.929 3.178 0 5.767-2.587 5.768-5.766.001-3.187-2.575-5.77-5.764-5.771zm3.392 8.244c-.144.405-.837.774-1.17.824-.299.045-.677.063-1.092-.069-.252-.08-.575-.187-.988-.365-1.739-.751-2.874-2.502-2.961-2.617-.087-.116-.708-.94-.708-1.793s.448-1.273.607-1.446c.159-.173.346-.217.462-.217l.332.006c.106.005.249-.04.39.298.144.347.491 1.2.534 1.287.043.087.072.188.014.304-.058.116-.087.188-.173.289l-.26.304c-.087.086-.177.18-.076.354.101.174.449.741.964 1.201.662.591 1.221.774 1.394.86s.275.072.376-.043c.101-.116.433-.506.549-.68.116-.173.231-.145.39-.087s1.011.477 1.184.564.289.13.332.202c.045.072.045.419-.099.824zm-3.396-9.416c-4.284 0-7.766 3.481-7.766 7.766 0 1.371.357 2.658 1.018 3.782l-1.082 3.95 4.053-1.063c1.076.598 2.316.931 3.777.931 4.284 0 7.766-3.482 7.766-7.766 0-4.284-3.482-7.766-7.766-7.766z"/></svg>
                                <span>Suporte Técnico WhatsApp</span>
                            </a>
                            <span class="text-slate-400 dark:text-slate-600 hidden sm:inline">•</span>
                            <span class="text-slate-500 dark:text-slate-400">Segunda a Sexta, 08h às 17h</span>
                        </div>
                    </div>
                </div>

                <!-- LINHA DIVISÓRIA -->
                <div class="border-t border-slate-200/80 dark:border-white/10 my-6"></div>

                <!-- 2. BLOCO MÉDIO -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-7 sm:gap-8">
                    <!-- Sede & Contactos -->
                    <div class="space-y-3">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">Sede &amp; Contactos</h4>
                        <div class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                            <p class="flex items-start gap-2.5">
                                <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Rua Ndunduma, Miramar – Luanda, Angola (Por detrás do BFA)</span>
                            </p>
                            <p class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                <span>+244 972 888 585 / 923 000 001</span>
                            </p>
                            <p class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                <span>geral@rachi.ao</span>
                            </p>
                        </div>
                    </div>

                    <!-- Formas de Pagamento -->
                    <div class="space-y-3">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">Formas de Pagamento</h4>
                        <div class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                            <p class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                                <span>Multicaixa Express / TPA</span>
                            </p>
                            <p class="flex items-center gap-2.5">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z"/></svg>
                                <span>Transferência Bancária (IBAN)</span>
                            </p>
                            <p class="flex items-center gap-2.5 text-xs text-slate-500 dark:text-slate-400">
                                <svg class="w-4 h-4 text-amber-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Facturação a 30 dias (Empresas)</span>
                            </p>
                        </div>
                    </div>

                    <!-- Coluna 3 -->
                    <div class="space-y-3">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">Soluções RACHI</h4>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="/capital" class="hover:text-amber-500 dark:hover:text-amber-400 transition font-medium">RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-amber-500 dark:hover:text-amber-400 transition font-medium">RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-amber-500 dark:hover:text-amber-400 transition font-medium">RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-500 dark:hover:text-amber-400 transition font-medium">RACHI Print</a></li>
                        </ul>
                    </div>

                    <!-- Coluna 4 -->
                    <div class="space-y-3">
                        <h4 class="font-bold text-xs sm:text-sm text-slate-900 dark:text-white">Institucional & Legal</h4>
                        <ul class="space-y-2 text-xs sm:text-sm text-slate-600 dark:text-slate-400">
                        <li><a href="/privacidade" class="hover:text-slate-900 dark:hover:text-white transition">Política de Privacidade</a></li>
                        <li><a href="/termos" class="hover:text-slate-900 dark:hover:text-white transition">Termos &amp; Condições</a></li>
                        <li><a href="/reclamacoes-e-denuncia" class="hover:text-slate-900 dark:hover:text-white transition">Reclamações e Denúncia</a></li>
                        <li><a href="/loja" class="hover:text-slate-900 dark:hover:text-white transition">Loja Corporativa</a></li>
                        <li><a href="/contacto" class="hover:text-slate-900 dark:hover:text-white transition">Fale Connosco</a></li>
                        </ul>
                    </div>
                </div>

                <!-- LINHA DIVISÓRIA -->
                <div class="border-t border-slate-200/80 dark:border-white/10 my-6"></div>

                <!-- 3. BLOCO INFERIOR: COPYRIGHT CENTRADO -->
                <div class="flex flex-col items-center justify-center text-center gap-2 text-xs text-slate-500 dark:text-slate-400">
                    <p>&copy; 2026 <strong class="text-slate-800 dark:text-slate-200">RACHI</strong> — Soluções Inteligentes. Todos os direitos reservados.</p>
                    <div class="flex items-center justify-center gap-3 text-xs pt-1">
                        <button type="button" onclick="setRachiLanguage('pt')" data-rachi-lang="pt" class="cursor-pointer font-bold text-amber-500 dark:text-amber-400 hover:opacity-100 transition" title="Português">PT</button>
                        <span class="text-slate-400 opacity-60">|</span>
                        <button type="button" onclick="setRachiLanguage('en')" data-rachi-lang="en" class="cursor-pointer opacity-70 hover:opacity-100 hover:text-amber-500 dark:hover:text-amber-400 transition" title="English">EN</button>
                        <span class="text-slate-400 opacity-60">|</span>
                        <button type="button" onclick="setRachiLanguage('zh-CN')" data-rachi-lang="zh-CN" class="cursor-pointer opacity-70 hover:opacity-100 hover:text-amber-500 dark:hover:text-amber-400 transition" title="中文 (Mandarim)">中文</button>
                    </div>
                </div>

            </div>
        </footer>

    <script>
        lucide.createIcons();
    </script>
    <script src="/worker-public.js"></script>
    @stack('scripts')
    @include('components.theme-toggle-fab')
</body>
</html>
