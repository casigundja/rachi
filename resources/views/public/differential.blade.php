<!DOCTYPE html>
<html lang="pt">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Que Fazemos ” RACHI</title>

    <link rel="canonical" href="https://rachi.ao/diferencial">
    <meta property="og:title" content="O Nosso Diferencial — RACHI">
    <meta property="og:description" content="Integramos soluções. Transformamos negócios. Saiba o que nos torna diferentes.">
    <meta property="og:url" content="https://rachi.ao/diferencial">
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://rachi.ao/images/differential-hero.png">
    <meta name="description" content="RACHI ” soluções inteligentes em tecnologia, educação e serviços empresariais.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preload" as="style" href="/build/assets/app-DkjvvEo1.css" /><link rel="modulepreload" href="/build/assets/app-Dn06r9IG.js" /><link rel="stylesheet" href="/build/assets/app-DkjvvEo1.css" />    <script defer src="/libs/alpine.js"></script>
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
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        html.dark body {
            color: #e2e8f0;
            background-color: #071326;
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
    <link rel="stylesheet" href="/css/site.css">
<link rel="stylesheet" href="/worker-marketing.css?v=20261030-2"></head>
<body x-data="{ currentTab: 'what-we-do', mobileMenuOpen: false, solutionsOpen: false, solutionsOpen: false, goToHome() { location.href = '/'; }, scrollToSection(section) { location.href = '/' + section; }, openUnitPage(unit) { location.href = '/' + unit; }, openStore() { location.href = '/loja'; }, openContacto() { location.href = '/contacto'; } }" class="min-h-screen flex flex-col justify-between">
    <!-- EXACT NAV BAR -->
    <!-- HEADER DUAL-THEME: ESCURO NO TOPO, CLARO AO ROLAR (ESTILO KLASSE.AO) -->
        <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-5 lg:py-6 transition-all duration-300">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <!-- Coluna 1 (Esquerda): Logótipo RACHI -->
                <div class="flex-1 flex items-center justify-start min-w-0">
                    <a href="#home" @click.prevent="goToHome(); solutionsOpen = false" class="flex items-center group cursor-pointer transition-transform duration-200 hover:scale-[1.02]">
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
                                                    <a href="/#diferencial" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-white hover:bg-slate-100/80 dark:hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O nosso diferencial</span>
                            </a>
                        <a href="/#missao" class="block text-sm text-slate-400 hover:text-white transition">Missão, visão e valores</a>
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

            <main class="diff-page flex-grow transition-colors duration-300">
        <style>
            .diff-page {
                background-color: #ffffff;
                color: #071326;
            }
            html.dark .diff-page {
                background-color: #071326 !important;
                color: #e2e8f0 !important;
            }

            .diff-hero-flex {
                display: flex;
                flex-direction: column;
                gap: 2.5rem;
                align-items: center;
            }
            @media (min-width: 1024px) {
                .diff-hero-flex {
                    flex-direction: row;
                    justify-content: space-between;
                    align-items: center;
                    gap: 3rem;
                }
                .diff-hero-text {
                    flex: 1 1 0%;
                    min-width: 0;
                }
                .diff-hero-image {
                    width: 50%;
                    max-width: 580px;
                    flex-shrink: 0;
                    display: flex;
                    justify-content: flex-end;
                }
            }

            .diff-main-title {
                font-family: 'Montserrat', sans-serif;
                line-height: 1.08;
                color: #071326;
            }
            html.dark .diff-main-title {
                color: #ffffff !important;
            }
            .diff-title-accent {
                color: #eba72d;
            }
            html.dark .diff-title-accent {
                color: #fbbf24 !important;
            }
            .diff-pill-blue {
                background-color: #0050f0 !important;
            }
            html.dark .diff-pill-blue {
                background-color: #00a3e0 !important;
                box-shadow: 0 0 12px rgba(0, 163, 224, 0.45);
            }
            .diff-pill-gold {
                background-color: #eba72d !important;
            }
            html.dark .diff-pill-gold {
                background-color: #fbbf24 !important;
                box-shadow: 0 0 12px rgba(251, 191, 36, 0.4);
            }
            .diff-hero-sub {
                color: #334155;
            }
            html.dark .diff-hero-sub {
                color: #e2e8f0 !important;
            }

            /* Dual-Theme Studio Visual Card */
            .diff-visual-wrap {
                width: 100%;
                max-width: 36rem;
            }
            .diff-visual-card {
                background-color: #ffffff !important;
                border: 1px solid rgba(226, 232, 240, 0.95) !important;
                box-shadow: 0 20px 45px -12px rgba(7, 19, 38, 0.10), 0 4px 14px -2px rgba(7, 19, 38, 0.04) !important;
                border-radius: 1rem;
                overflow: hidden;
                transition: background-color 0.3s ease, border-color 0.3s ease, box-shadow 0.3s ease;
            }
            html.dark .diff-visual-card {
                background-color: #071326 !important;
                border: 1px solid rgba(255, 255, 255, 0.10) !important;
                box-shadow: 0 24px 55px -12px rgba(0, 0, 0, 0.72), 0 0 32px rgba(0, 80, 240, 0.12) !important;
            }
            .diff-img-light {
                display: block !important;
                width: 100%;
                height: auto;
            }
            .diff-img-dark {
                display: none !important;
                width: 100%;
                height: auto;
            }
            html.dark .diff-img-light {
                display: none !important;
            }
            html.dark .diff-img-dark {
                display: block !important;
            }

            /* Middle Section */
            .diff-mid-section {
                background-color: rgba(248, 250, 252, 0.65);
                border-top: 1px solid #f1f5f9;
            }
            html.dark .diff-mid-section {
                background-color: #071326 !important;
                border-top-color: rgba(255, 255, 255, 0.08) !important;
            }
            .diff-content-grid {
                display: flex;
                flex-direction: column;
                gap: 2rem;
                align-items: flex-start;
                width: 100%;
            }
            @media (min-width: 768px) {
                .diff-content-grid {
                    flex-direction: row;
                    align-items: flex-start;
                    gap: 3.5rem;
                }
                .diff-tagline-col {
                    width: 240px;
                    flex-shrink: 0;
                }
                .diff-text-col {
                    flex: 1 1 0%;
                    min-width: 0;
                    width: 100%;
                }
            }
            .diff-target-badge {
                background-color: #eff6ff;
                border: 1px solid #bfdbfe;
                color: #0284c7;
                box-shadow: 0 2px 8px rgba(2, 132, 199, 0.08);
            }
            html.dark .diff-target-badge {
                background-color: rgba(0, 163, 224, 0.14) !important;
                border-color: rgba(56, 189, 248, 0.35) !important;
                color: #38bdf8 !important;
                box-shadow: 0 0 18px rgba(0, 163, 224, 0.18) !important;
            }
            .diff-tagline-title {
                color: #0f172a;
            }
            html.dark .diff-tagline-title {
                color: #ffffff !important;
            }
            .diff-text-col p {
                color: #475569;
            }
            html.dark .diff-text-col p {
                color: #cbd5e1 !important;
            }
            .diff-text-col strong {
                color: #0f172a;
            }
            html.dark .diff-text-col strong {
                color: #ffffff !important;
            }

            /* Pillars Box */
            .diff-pillars-box {
                margin-top: 4rem;
                background-color: #ffffff !important;
                border: 1px solid #e2e8f0 !important;
                border-radius: 1.5rem;
                padding: 2rem;
                box-shadow: 0 12px 32px -8px rgba(15, 23, 42, 0.05);
                transition: all 0.3s ease;
            }
            @media (min-width: 640px) {
                .diff-pillars-box {
                    margin-top: 5rem;
                    padding: 3rem;
                }
            }
            html.dark .diff-pillars-box {
                background: linear-gradient(145deg, rgba(12, 26, 51, 0.92) 0%, rgba(8, 19, 38, 0.96) 100%) !important;
                border: 1px solid rgba(255, 255, 255, 0.09) !important;
                box-shadow: 0 20px 45px -12px rgba(0, 0, 0, 0.6), inset 0 1px 0 rgba(255, 255, 255, 0.06) !important;
            }
            .diff-pillars-heading {
                color: #0f172a;
            }
            html.dark .diff-pillars-heading {
                color: #ffffff !important;
            }

            .diff-cards-grid {
                display: grid;
                grid-template-columns: repeat(1, minmax(0, 1fr));
                gap: 1.5rem;
                width: 100%;
            }
            @media (min-width: 640px) {
                .diff-cards-grid {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }
            @media (min-width: 1024px) {
                .diff-cards-grid {
                    grid-template-columns: repeat(5, minmax(0, 1fr));
                    gap: 1.25rem;
                }
            }

            .diff-pillar-item {
                border-radius: 1rem;
                padding: 1rem;
                border: 1px solid transparent;
                transition: background-color 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease, transform 0.22s ease;
            }
            .diff-pillar-item:hover {
                background-color: #f8fafc !important;
                border-color: #e2e8f0 !important;
                box-shadow: 0 10px 24px -6px rgba(15, 23, 42, 0.06);
                transform: translateY(-2px);
            }
            html.dark .diff-pillar-item:hover {
                background-color: rgba(255, 255, 255, 0.04) !important;
                border-color: rgba(255, 255, 255, 0.10) !important;
                box-shadow: 0 12px 28px -6px rgba(0, 0, 0, 0.45);
            }
            .diff-pillar-title {
                color: #0f172a;
            }
            html.dark .diff-pillar-title {
                color: #ffffff !important;
            }
            .diff-pillar-desc {
                color: #475569;
            }
            html.dark .diff-pillar-desc {
                color: #94a3b8 !important;
            }

            .diff-icon-blue {
                background-color: #eff6ff;
                border: 1px solid #bfdbfe;
                color: #0050f0;
            }
            html.dark .diff-icon-blue {
                background-color: rgba(37, 99, 235, 0.16) !important;
                border-color: rgba(96, 165, 250, 0.35) !important;
                color: #60a5fa !important;
            }
            .diff-icon-amber {
                background-color: #fffbeb;
                border: 1px solid #fde68a;
                color: #d97706;
            }
            html.dark .diff-icon-amber {
                background-color: rgba(245, 158, 11, 0.16) !important;
                border-color: rgba(251, 191, 36, 0.35) !important;
                color: #fbbf24 !important;
            }
            .diff-icon-emerald {
                background-color: #ecfdf5;
                border: 1px solid #a7f3d0;
                color: #059669;
            }
            html.dark .diff-icon-emerald {
                background-color: rgba(16, 185, 129, 0.16) !important;
                border-color: rgba(52, 211, 153, 0.35) !important;
                color: #34d399 !important;
            }
            .diff-icon-purple {
                background-color: #faf5ff;
                border: 1px solid #e9d5ff;
                color: #7c3aed;
            }
            html.dark .diff-icon-purple {
                background-color: rgba(168, 85, 247, 0.16) !important;
                border-color: rgba(192, 132, 252, 0.35) !important;
                color: #c084fc !important;
            }
            .diff-icon-cyan {
                background-color: #ecfeff;
                border: 1px solid #a5f3fc;
                color: #0891b2;
            }
            html.dark .diff-icon-cyan {
                background-color: rgba(6, 182, 212, 0.16) !important;
                border-color: rgba(34, 211, 238, 0.35) !important;
                color: #22d3ee !important;
            }

            /* Dual-Theme Footer on Standalone Page */
            .diff-footer {
                background-color: #f8fafc;
                color: #475569;
                border-top: 1px solid #e2e8f0;
            }
            html.dark .diff-footer {
                background-color: #040b17 !important;
                color: #94a3b8 !important;
                border-top-color: rgba(255, 255, 255, 0.08) !important;
            }
            .diff-footer h4 {
                color: #071326;
            }
            html.dark .diff-footer h4 {
                color: #fbbf24 !important;
            }
            .diff-footer ul li a {
                color: #475569;
            }
            .diff-footer ul li a:hover {
                color: #00a3e0;
            }
            html.dark .diff-footer ul li a {
                color: #cbd5e1 !important;
            }
            html.dark .diff-footer ul li a:hover {
                color: #ffffff !important;
            }
            .diff-footer p {
                color: #64748b;
            }
            html.dark .diff-footer p {
                color: #94a3b8 !important;
            }
        </style>

        <!-- ========================================================= -->
        <!-- SECTION 1: HERO - O NOSSO DIFERENCIAL                     -->
        <!-- ========================================================= -->
        <section class="pt-28 pb-12 sm:pt-32 sm:pb-16 lg:pt-36 lg:pb-20 overflow-hidden">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="diff-hero-flex mb-8">
                    
                    <!-- Left: Title, Decorative Pill Bar, Subtitle -->
                    <div class="diff-hero-text w-full">
                        <h1 class="diff-main-title text-4xl sm:text-5xl lg:text-6xl font-[850] uppercase tracking-tight">
                            O NOSSO<br>
                            <span class="diff-title-accent">DIFERENCIAL</span>
                        </h1>
                        
                        <!-- Decorative dual-color bar (Blue & Yellow) -->
                        <div class="flex items-center gap-1.5 mt-5 mb-6">
                            <span class="diff-pill-blue w-10 h-1.5 rounded-full"></span>
                            <span class="diff-pill-gold w-10 h-1.5 rounded-full"></span>
                        </div>

                        <!-- Subtitle -->
                        <div class="space-y-1">
                            <p class="diff-hero-sub text-xl sm:text-2xl font-semibold">
                                Integramos soluções.
                            </p>
                            <p class="diff-hero-sub text-xl sm:text-2xl font-semibold">
                                Transformamos negócios.
                            </p>
                        </div>
                    </div>

                    <!-- Right: Corporate Team Image Visual (Dual-Theme: Light & Dark) -->
                    <div class="diff-hero-image w-full">
                        <div class="diff-visual-wrap relative">
                            <div class="diff-visual-card relative">
                                <img src="/images/differential-team-clean.png?v=8"
                                     onerror="this.onerror=null; this.src='/images/differential-team.jpg'"
                                     alt="O Nosso Diferencial — Equipa RACHI"
                                     class="diff-img-light object-cover select-none">
                                <img src="/images/differential-team-dark.jpg?v=8"
                                     onerror="this.onerror=null; this.src='/images/differential-team-clean.png'"
                                     alt="O Nosso Diferencial — Equipa RACHI"
                                     class="diff-img-dark object-cover select-none">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- SECTION 2: CORE VALUE PROPOSITION                         -->
        <!-- ========================================================= -->
        <section class="diff-mid-section py-12 sm:py-16">
            <div class="max-w-7xl mx-auto px-6 lg:px-12">
                <div class="diff-content-grid pt-4">
                    
                    <!-- Left: Circular Icon Badge + Tagline -->
                    <div class="diff-tagline-col pt-2">
                        <div class="diff-target-badge w-14 h-14 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-7 h-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <circle cx="12" cy="12" r="6"></circle>
                                <circle cx="12" cy="12" r="2"></circle>
                            </svg>
                        </div>
                        <p class="diff-tagline-title font-extrabold text-base sm:text-lg leading-snug">
                            Foco no que<br>realmente importa
                        </p>
                    </div>

                    <!-- Right: 3 Text Paragraphs with Bold Emphasis -->
                    <div class="diff-text-col space-y-6 text-base sm:text-lg leading-relaxed">
                        <p>
                            O diferencial da RACHI está na capacidade de <strong class="font-bold">integrar</strong>, num só ecossistema, <strong class="font-bold">soluções essenciais</strong> para a estruturação, modernização e crescimento das empresas.
                        </p>
                        <p>
                            Não actuamos apenas sobre <strong class="font-bold">problemas isolados</strong>. Analisamos a realidade de cada negócio, identificamos os seus principais desafios e desenvolvemos <strong class="font-bold">soluções ajustadas</strong> às suas necessidades, combinando formalização empresarial, gestão, recursos humanos, formação, tecnologia e comunicação institucional.
                        </p>
                        <p>
                            A RACHI diferencia-se também, pela <strong class="font-bold">abordagem prática, integrada e orientada para resultados</strong>, oferecendo aos seus clientes uma resposta completa para transformar ideias em negócios estruturados e empresas tradicionais em organizações mais <strong class="font-bold">modernas, competitivas e sustentáveis</strong>.
                        </p>
                    </div>

                </div>

                <!-- ========================================================= -->
                <!-- SECTION 3: HIGHLIGHT CARD: O QUE NOS TORNA DIFERENTES    -->
                <!-- ========================================================= -->
                <div class="diff-pillars-box">
                    
                    <!-- Card Header -->
                    <div class="text-center max-w-xl mx-auto mb-12">
                        <h2 class="diff-pillars-heading text-xl sm:text-2xl font-[850] uppercase tracking-wider">
                            O QUE NOS TORNA DIFERENTES
                        </h2>
                        <div class="flex items-center justify-center gap-1.5 mt-2.5">
                            <span class="diff-pill-blue w-6 h-1 rounded-full"></span>
                            <span class="diff-pill-gold w-6 h-1 rounded-full"></span>
                        </div>
                    </div>

                    <!-- 5 Columns Grid -->
                    <div class="diff-cards-grid">
                        
                        <!-- 1. INTEGRAÇÃO -->
                        <div class="diff-pillar-item flex flex-col items-center text-center group">
                            <div class="diff-icon-blue w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                <i data-lucide="puzzle" class="w-6 h-6"></i>
                            </div>
                            <h3 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                INTEGRAÇÃO
                            </h3>
                            <p class="diff-pillar-desc text-xs leading-relaxed">
                                Todas as soluções que o seu negócio precisa, num só ecossistema.
                            </p>
                        </div>

                        <!-- 2. ABORDAGEM PRÁTICA -->
                        <div class="diff-pillar-item flex flex-col items-center text-center group">
                            <div class="diff-icon-amber w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                <i data-lucide="user" class="w-6 h-6"></i>
                            </div>
                            <h3 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                ABORDAGEM PRÁTICA
                            </h3>
                            <p class="diff-pillar-desc text-xs leading-relaxed">
                                Soluções aplicáveis à realidade do seu negócio.
                            </p>
                        </div>

                        <!-- 3. ORIENTAÇÃO PARA RESULTADOS -->
                        <div class="diff-pillar-item flex flex-col items-center text-center group">
                            <div class="diff-icon-emerald w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                <i data-lucide="trending-up" class="w-6 h-6"></i>
                            </div>
                            <h3 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                ORIENTAÇÃO PARA RESULTADOS
                            </h3>
                            <p class="diff-pillar-desc text-xs leading-relaxed">
                                Foco em gerar valor, eficiência e crescimento sustentável.
                            </p>
                        </div>

                        <!-- 4. SOLUÇÕES AJUSTADAS -->
                        <div class="diff-pillar-item flex flex-col items-center text-center group">
                            <div class="diff-icon-purple w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                <i data-lucide="user-check" class="w-6 h-6"></i>
                            </div>
                            <h3 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                SOLUÇÕES AJUSTADAS
                            </h3>
                            <p class="diff-pillar-desc text-xs leading-relaxed">
                                Analisamos o seu negócio e criamos soluções à medida.
                            </p>
                        </div>

                        <!-- 5. PARCEIRA DE CONFIANÇA -->
                        <div class="diff-pillar-item flex flex-col items-center text-center group">
                            <div class="diff-icon-cyan w-14 h-14 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-200 shadow-sm">
                                <i data-lucide="shield-check" class="w-6 h-6"></i>
                            </div>
                            <h3 class="diff-pillar-title font-[850] text-xs sm:text-sm tracking-wider uppercase mb-2">
                                PARCEIRA DE CONFIANÇA
                            </h3>
                            <p class="diff-pillar-desc text-xs leading-relaxed">
                                Compromisso com a transparência, ética e o sucesso dos nossos clientes.
                            </p>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- ========================================================= -->
        <!-- SECTION 4: CALL TO ACTION (CTA)                           -->
        <!-- ========================================================= -->
        <section class="py-16 sm:py-20 bg-gradient-to-br from-[#071326] via-[#0a1f3d] to-[#071326] text-white text-center">
            <div class="max-w-4xl mx-auto px-6">
                <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3.5 py-1 rounded-full border border-blue-800/60 inline-block mb-4">
                    Ecossistema Completo
                </span>
                <h2 class="text-3xl md:text-4xl font-[850] uppercase tracking-tight mb-4">
                    Pronto para impulsionar a sua empresa?
                </h2>
                <p class="text-slate-300 text-base md:text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
                    Descubra como o modelo integrado da RACHI pode simplificar a gestão, acelerar a digitalização e potencializar os resultados do seu negócio.
                </p>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <a href="/contacto" class="px-8 py-3.5 rounded-xl bg-[#0050f0] hover:bg-blue-600 text-white font-bold text-sm shadow-lg shadow-blue-600/30 transition transform hover:-translate-y-0.5">
                        Solicitar Proposta
                    </a>
                    <a href="https://wa.me/244972888585" target="_blank" rel="noopener noreferrer" class="px-8 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-lg shadow-emerald-600/20 transition flex items-center gap-2 transform hover:-translate-y-0.5">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                        Falar no WhatsApp
                    </a>
                </div>
            </div>
        </section>

    </main>
<footer class="diff-footer pt-12 pb-28 sm:pb-12 px-6 transition-colors duration-300">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <img src="/images/logo-rachi-light.png" onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'" alt="RACHI" class="h-10 mb-4 hidden dark:block">
                <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="h-10 mb-4 dark:hidden">
                <p class="text-sm">
                    Soluções inteligentes em tecnologia, comunicação visual, formação profissional e recursos humanos.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase mb-3">Unidades</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/solucoes/tec" class="transition">RACHI Tec — Loja de TI</a></li>
                    <li><a href="/solucoes/print" class="transition">RACHI Print — Artes &amp; Logótipos</a></li>
                    <li><a href="/solucoes/academy" class="transition">RACHI Academy — Cursos</a></li>
                    <li><a href="/solucoes/capital" class="transition">RACHI Capital — Sites &amp; Suporte TI</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase mb-3">Links Úteis</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/loja" class="transition">Loja Online</a></li>
                    <li><a href="/#etica" class="transition">Ética e Compliance</a></li>
                    <li><a href="/contacto" class="transition">Contactos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase mb-3">Contacto</h4>
                <p class="text-sm">Rua Ndunduma, Miramar — Luanda, Angola</p>
                <p class="text-sm mt-0.5">Por detrás do BFA</p>
                <p class="text-sm mt-1">geral@rachi.ao</p>
                <p class="text-sm mt-1">+244 972 888 585</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-slate-200 dark:border-slate-800/80 text-xs text-slate-500 dark:text-slate-400 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div>&copy; 2026 <strong class="text-slate-900 dark:text-white">RACHI</strong> ” Soluções Inteligentes. Todos os direitos reservados.</div>
            <div class="flex gap-3 items-center text-xs">
                        <button type="button" onclick="setRachiLanguage('pt')" data-rachi-lang="pt" class="cursor-pointer font-bold text-amber-500 dark:text-amber-400 hover:opacity-100 transition" title="Português">PT</button>
                        <span class="text-slate-500 opacity-60">|</span>
                        <button type="button" onclick="setRachiLanguage('en')" data-rachi-lang="en" class="cursor-pointer opacity-70 hover:opacity-100 hover:text-amber-500 dark:hover:text-amber-400 transition" title="English">EN</button>
                        <span class="text-slate-500 opacity-60">|</span>
                        <button type="button" onclick="setRachiLanguage('zh-CN')" data-rachi-lang="zh-CN" class="cursor-pointer opacity-70 hover:opacity-100 hover:text-amber-500 dark:hover:text-amber-400 transition" title="ä¸­æ–‡ (Mandarim)">ä¸­æ–‡</button>
                    </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    <script src="/worker-public.js"></script>    @include('components.theme-toggle-fab')
</body>
</html>
