<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service['title'] }} — RACHI Tec (Sistemas & TI)</title>
    <meta name="description" content="{{ $service['short_desc'] }}">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <link rel="stylesheet" href="/worker-marketing.css">
    <!-- Alpine.js -->
    <script defer src="/libs/alpine.js"></script>
    <!-- Lucide Icons -->
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

    <link rel="stylesheet" href="/css/site.css?v=1790340043">
    <style>
        [x-cloak] { display: none !important; }
        html { scroll-behavior: smooth; }
        section[id], div[id] { scroll-margin-top: 95px; }

        body {
            font-family: 'Inter', sans-serif;
            color: #0b1a2e;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        html.dark body {
            background-color: #030813;
            color: #f8fafc;
        }

        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* HEADER THEME SYSTEM (LIGHT & DARK MODES) */
        .site-header {
            position: fixed !important;
            top: 0 !important; left: 0 !important; right: 0 !important;
            z-index: 1030 !important;
            width: 100% !important;
            transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        border-color 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                        backdrop-filter 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        /* 1. DARK MODE (html.dark) */
        html.dark .site-header {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.35) !important;
        }
        html.dark .site-header.header-scrolled {
            background: rgba(7, 19, 38, 0.98) !important;
            box-shadow: 0 6px 35px rgba(0, 0, 0, 0.5) !important;
        }
        html.dark .site-header .brand-logo-box {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }
        html.dark .site-header .brand-logo-text {
            color: #ffffff !important;
        }
        html.dark .site-header .brand-subtitle {
            color: #94a3b8 !important;
        }
        html.dark .site-header .main-nav-capsule {
            display: flex; align-items: center; gap: 0.25rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 9999px; padding: 0.3rem 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        html.dark .site-header .main-nav-capsule .nav-link {
            position: relative; font-size: 0.88rem; font-weight: 500;
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.45rem 0.9rem !important; border-radius: 9999px;
            white-space: nowrap; text-decoration: none;
            transition: all 0.2s ease;
        }
        html.dark .site-header .main-nav-capsule .nav-link:hover {
            color: #ffffff !important; background: rgba(255, 255, 255, 0.08);
        }
        html.dark .site-header .main-nav-capsule .nav-link.active {
            color: #00a3e0 !important;
            background: rgba(0, 163, 224, 0.2);
            border: 1px solid rgba(0, 163, 224, 0.4);
            box-shadow: 0 2px 8px rgba(0, 163, 224, 0.2);
            font-weight: 700;
        }
        html.dark .site-header .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #f8fafc !important;
        }
        html.dark .site-header .mobile-menu-btn {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.08) !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
        }

        /* 2. LIGHT MODE (html:not(.dark)) */
        html:not(.dark) .site-header {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(11, 26, 46, 0.08) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.06) !important;
        }
        html:not(.dark) .site-header.header-scrolled {
            background: rgba(255, 255, 255, 0.98) !important;
            box-shadow: 0 4px 28px rgba(0, 0, 0, 0.1) !important;
        }
        html:not(.dark) .site-header .brand-logo-box {
            background: rgba(11, 26, 46, 0.04) !important;
            border: 1px solid rgba(11, 26, 46, 0.08) !important;
        }
        html:not(.dark) .site-header .brand-logo-text {
            color: #071326 !important;
        }
        html:not(.dark) .site-header .brand-subtitle {
            color: #64748b !important;
        }
        html:not(.dark) .site-header .main-nav-capsule {
            display: flex; align-items: center; gap: 0.25rem;
            background: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
            border-radius: 9999px; padding: 0.3rem 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.03);
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link {
            font-size: 0.88rem; font-weight: 600;
            color: #0b1a2e !important;
            padding: 0.45rem 0.9rem !important; border-radius: 9999px;
            white-space: nowrap; text-decoration: none;
            transition: all 0.2s ease;
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link:hover {
            color: #0089c2 !important; background: rgba(0, 163, 224, 0.08);
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link.active {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.12);
            border: 1px solid rgba(0, 163, 224, 0.3);
            font-weight: 700;
        }
        html:not(.dark) .site-header .theme-toggle-btn {
            background: rgba(11, 26, 46, 0.04) !important;
            border: 1px solid rgba(11, 26, 46, 0.08) !important;
            color: #0b1a2e !important;
        }
        html:not(.dark) .site-header .mobile-menu-btn {
            color: #0b1a2e !important;
            background: rgba(11, 26, 46, 0.05) !important;
            border: 1px solid rgba(11, 26, 46, 0.08) !important;
        }

        /* HEADER DROPDOWN */
        .header-dropdown {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.12);
        }
        html.dark .header-dropdown {
            background-color: rgba(7, 19, 38, 0.98) !important;
            border-color: rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 20px 40px -10px rgba(0, 0, 0, 0.6) !important;
        }

        /* FOOTER */
        .site-footer {
            background-color: #f1f5f9;
            border-top: 1px solid #e2e8f0;
            padding: 3rem 0;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        html.dark .site-footer {
            background-color: #050912 !important;
            border-top-color: rgba(255, 255, 255, 0.08) !important;
        }
        
        .btn-cta-blue {
            display: inline-flex; align-items: center; justify-content: center;
            gap: 0.5rem; padding: 0.5rem 1.25rem; font-size: 0.8125rem; font-weight: 700;
            border-radius: 9999px; color: #ffffff;
            background: linear-gradient(135deg, #00a3e0 0%, #0077b6 100%);
            box-shadow: 0 4px 14px rgba(0, 163, 224, 0.35);
            transition: all 0.25s ease;
        }
        .btn-cta-blue:hover {
            background: linear-gradient(135deg, #0284c7 0%, #0369a1 100%);
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 163, 224, 0.45);
        }

        /* ======================================================== */
        /* DARK MODE LUXURY DESIGN SYSTEM - RACHI TEC               */
        /* ======================================================== */
        html.dark body {
            background-color: #030814 !important;
            color: #f1f5f9 !important;
        }

        /* Surface containers & main cards */
        html.dark main .bg-white {
            background-color: #071326 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #f1f5f9 !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.35) !important;
        }

        /* Nested secondary strips & steps */
        html.dark main .bg-slate-50 {
            background-color: #0a1a33 !important;
            border-color: rgba(255, 255, 255, 0.07) !important;
            color: #e2e8f0 !important;
        }

        /* Headings & Text Colors */
        html.dark main .text-slate-900 {
            color: #ffffff !important;
        }
        html.dark main .text-slate-700 {
            color: #cbd5e1 !important;
        }
        html.dark main .text-slate-600 {
            color: #94a3b8 !important;
        }
        html.dark main .text-slate-500 {
            color: #94a3b8 !important;
        }

        /* Borders across sections */
        html.dark main .border-slate-100,
        html.dark main .border-slate-200,
        html.dark main .border-slate-300,
        html.dark main .border-slate-700,
        html.dark main .border-slate-800 {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Badges & Category Tags in Dark Mode */
        html.dark main .bg-sky-50 {
            background-color: rgba(0, 163, 224, 0.12) !important;
            border-color: rgba(0, 163, 224, 0.25) !important;
            color: #38bdf8 !important;
        }
        html.dark main .bg-indigo-50 {
            background-color: rgba(99, 102, 241, 0.15) !important;
            border-color: rgba(99, 102, 241, 0.3) !important;
            color: #a5b4fc !important;
        }
        html.dark main .bg-amber-50 {
            background-color: rgba(245, 158, 11, 0.15) !important;
            border-color: rgba(245, 158, 11, 0.3) !important;
            color: #fbbf24 !important;
        }
        html.dark main .bg-emerald-50 {
            background-color: rgba(16, 185, 129, 0.15) !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
            color: #34d399 !important;
        }

        /* Pricing Plan Cards */
        html.dark .ring-2.ring-\[\#00a3e0\],
        html.dark .border-\[\#00a3e0\] {
            background: linear-gradient(180deg, #0c203f 0%, #071326 100%) !important;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.6), 0 0 25px rgba(0, 163, 224, 0.25) !important;
            border-color: #00a3e0 !important;
        }

        /* Form Controls in Dark Mode */
        html.dark main input,
        html.dark main textarea,
        html.dark main select {
            background-color: #0b1a30 !important;
            border: 1px solid rgba(255, 255, 255, 0.12) !important;
            color: #ffffff !important;
            transition: all 0.2s ease !important;
        }
        html.dark main input::placeholder,
        html.dark main textarea::placeholder {
            color: #64748b !important;
        }
        html.dark main input:focus,
        html.dark main textarea:focus,
        html.dark main select:focus {
            background-color: #0f2444 !important;
            border-color: #00a3e0 !important;
            box-shadow: 0 0 0 3px rgba(0, 163, 224, 0.25) !important;
            outline: none !important;
        }

        /* Channel Quick Contact Links */
        html.dark .group:hover {
            border-color: rgba(0, 163, 224, 0.4) !important;
        }

        /* Info & Transparency Notices */
        html.dark main .bg-slate-100 {
            background-color: rgba(11, 26, 48, 0.75) !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #cbd5e1 !important;
        }
        html.dark main .bg-slate-100 strong {
            color: #ffffff !important;
        }
    </style>

</head>
<body x-data="rachiServicePage()" class="antialiased">

    <!-- ============================================================ -->
    <!-- DUAL THEME HEADER (Dark top -> Light scrolled)               -->
    <!-- ============================================================ -->
    <header id="navbar" class="site-header py-3.5 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- Brand Logo -->
            <a href="/tec" class="flex items-center gap-3 group focus:outline-none" title="RACHI Tec">
                <div class="brand-logo-box h-10 w-10 rounded-xl p-1.5 flex items-center justify-center transition-all duration-200 group-hover:scale-105 shadow-sm">
                    <picture>
                        <source srcset="/images/areas/rachi-tec.webp" type="image/webp">
                        <img src="/images/areas/rachi-tec.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-tec.png'" 
                             alt="RACHI Tec" 
                             class="h-7 w-auto object-contain filter drop-shadow-[0_0_6px_rgba(255,255,255,0.35)]">
                    </picture>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-black text-lg tracking-wider brand-logo-text flex items-center gap-1.5 transition-colors">
                        RACHI <span class="text-[#0077c2] dark:text-[#00a3e0] text-xs font-bold px-2 py-0.5 rounded-full bg-sky-500/10 border border-sky-500/20">TEC</span>
                    </span>
                    <span class="text-[10px] brand-subtitle tracking-widest uppercase font-medium">Tecnologia &amp; Sistemas</span>
                </div>
            </a>

            <!-- Main Navigation -->
            <nav class="hidden lg:flex items-center main-nav-capsule">
                <a href="/" class="nav-link cursor-pointer">
                    <span>Home</span>
                </a>
                
                <!-- Soluções Dropdown -->
                <div class="relative" x-data="{ openSol: false }" @click.outside="openSol = false" @keydown.escape.window="openSol = false" >
                    <button @click="openSol = !openSol" class="nav-link flex items-center gap-1.5 focus:outline-none active">
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
                         x-cloak
                         class="header-dropdown absolute top-full left-0 mt-3 w-80 bg-[#071326]/95 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl p-2.5 z-50 text-sm space-y-1.5">
                        
                        <a href="/capital" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-emerald-500/15 text-slate-300 hover:text-emerald-300 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-emerald-500/15 text-emerald-400 flex items-center justify-center font-black text-xs">01</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title">RACHI Human Capital</div>
                                    <div class="text-[11px] text-slate-400 dropdown-desc">Pessoas &amp; Gestão</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                        </a>

                        <a href="/academy" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-indigo-500/15 text-slate-300 hover:text-indigo-300 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-indigo-500/15 text-indigo-400 flex items-center justify-center font-black text-xs">02</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title">RACHI Academy</div>
                                    <div class="text-[11px] text-slate-400 dropdown-desc">Capacitação &amp; Ensino</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                        </a>

                        <a href="/tec" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-sky-500/15 text-sky-400 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-sky-500/20 text-sky-400 flex items-center justify-center font-black text-xs">03</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title text-sky-300">RACHI Tec</div>
                                    <div class="text-[11px] text-sky-400/80 dropdown-desc">Sistemas &amp; TI</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-100 transition"></i>
                        </a>

                        <a href="/print" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-amber-500/15 text-slate-300 hover:text-amber-300 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center font-black text-xs">04</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title">RACHI Print</div>
                                    <div class="text-[11px] text-slate-400 dropdown-desc">Gráfica &amp; Produção</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
                        </a>
                    </div>
                </div>

                <a href="/tec#servicos-tec" class="nav-link active">
                    <span>Serviços</span>
                </a>

                <a href="/loja" class="nav-link">
                    <span>Loja</span>
                </a>

                <a href="/contacto" class="nav-link">
                    <span>Contacto</span>
                </a>
            </nav>

            <!-- Header Actions -->
            <div class="flex items-center gap-2.5 sm:gap-3">
                

                <a href="#solicitar" class="btn-cta-blue group">
                    <i data-lucide="cpu" class="w-4 h-4"></i>
                    <span>Aderir Agora</span>
                </a>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl text-slate-800 dark:text-white hover:text-[#00a3e0] focus:outline-none" aria-label="Menu Principal">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" @click.outside="mobileMenuOpen = false" x-cloak class="header-dropdown lg:hidden px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">
            <a href="/" class="block font-medium py-1.5 text-slate-700 dark:text-white hover:text-[#00a3e0]">Home</a>
            <div class="border-t border-slate-200 dark:border-white/10 pt-2">
                <span class="text-xs uppercase font-bold text-[#0077c2] dark:text-[#00a3e0] tracking-wider">Soluções</span>
                <div class="pl-3 mt-1 space-y-1.5">
                    <a href="/capital" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-emerald-500">01 RACHI Human Capital</a>
                    <a href="/academy" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-indigo-500">02 RACHI Academy</a>
                    <a href="/tec" class="block text-sm text-[#0077c2] dark:text-sky-400 font-bold">03 RACHI Tec</a>
                    <a href="/print" class="block text-sm text-slate-600 dark:text-slate-400 hover:text-amber-500">04 RACHI Print</a>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-white/10 pt-2 space-y-1">
                <a href="/tec#servicos-tec" @click="mobileMenuOpen = false" class="block font-medium py-1 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">Os nossos serviços</a>
                <a href="/contacto" class="block font-medium py-1 text-[#0077c2] dark:text-[#00a3e0] font-bold">Pedir Proposta / Contacto</a>
            </div>
        </div>
    </header>

    <main class="pt-28 pb-16">

        <!-- ======================================================== -->
        <!-- BREADCRUMB                                               -->
        <!-- ======================================================== -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 overflow-x-auto whitespace-nowrap">
                <a href="/" class="hover:text-[#00a3e0] transition">Portal RACHI</a>
                <span class="text-slate-400">/</span>
                <a href="/tec" class="hover:text-[#00a3e0] transition">RACHI Tec</a>
                <span class="text-slate-400">/</span>
                <a href="/tec#servicos-tec" class="hover:text-[#00a3e0] transition">Os Nossos Serviços</a>
                <span class="text-slate-400">/</span>
                <span class="text-slate-900 dark:text-white font-semibold truncate">{{ $service['title'] }}</span>
            </nav>
        </div>

        <!-- ======================================================== -->
        <!-- 1. HERO DO SERVIÇO                                       -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
            <div class="relative rounded-3xl p-8 sm:p-12 lg:p-16 bg-gradient-to-br from-white via-sky-50/40 to-slate-50 border border-slate-200/90 shadow-2xl shadow-sky-950/5 text-slate-900 dark:from-[#071326] dark:via-[#092244] dark:to-[#071326] dark:border-sky-500/25 dark:text-white overflow-hidden transition-colors duration-300">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-sky-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-indigo-500/15 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="{{ !empty($service['image']) ? 'lg:col-span-7' : 'lg:col-span-8' }} space-y-6">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#0077c2] dark:text-[#00a3e0] px-3.5 py-1.5 rounded-full bg-sky-500/10 dark:bg-sky-500/15 border border-sky-500/20 dark:border-sky-500/30">
                                {{ $service['tag'] }}
                            </span>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-600 dark:text-slate-300 px-3 py-1 rounded-full bg-slate-100 dark:bg-white/10 border border-slate-200 dark:border-white/15">
                                RACHI Tec • Sistemas &amp; TI
                            </span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 dark:text-white tracking-tight leading-tight">
                            {{ $service['title'] }}
                        </h1>

                        <p class="text-slate-600 dark:text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl">
                            {{ $service['full_desc'] }}
                        </p>

                        <!-- Destaques Rápidos: Prazo, Garantia, Preço Base -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-slate-200/80 dark:border-white/10">
                            <div class="p-4 rounded-2xl bg-white/90 dark:bg-white/[0.04] border border-slate-200/80 dark:border-white/10 shadow-xs">
                                <div class="text-[11px] uppercase tracking-wider text-sky-600 dark:text-sky-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                    <span>Prazo de Execução</span>
                                </div>
                                <div class="font-bold text-sm text-slate-900 dark:text-white">{{ $service['prazo'] }}</div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/90 dark:bg-white/[0.04] border border-slate-200/80 dark:border-white/10 shadow-xs">
                                <div class="text-[11px] uppercase tracking-wider text-sky-600 dark:text-sky-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                    <span>Garantia &amp; SLA</span>
                                </div>
                                <div class="font-bold text-sm text-slate-900 dark:text-white">{{ $service['garantia'] }}</div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/90 dark:bg-white/[0.04] border border-slate-200/80 dark:border-white/10 shadow-xs">
                                <div class="text-[11px] uppercase tracking-wider text-sky-600 dark:text-sky-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                                    <span>Investimento Base</span>
                                </div>
                                <div class="font-bold text-sm text-slate-900 dark:text-white">
                                    <strong class="text-xl text-[#0077c2] dark:text-[#00a3e0]">{{ $service['starting_price'] }}</strong> 
                                    <span class="text-xs text-slate-500 dark:text-slate-300 font-normal">{{ $service['price_period'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação Imediata -->
                        <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
                            <a href="#solicitar" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl bg-gradient-to-r from-[#00a3e0] to-[#0284c7] hover:from-[#0284c7] hover:to-[#0369a1] text-white font-bold text-sm transition shadow-lg shadow-sky-500/25">
                                <i data-lucide="send" class="w-4 h-4"></i>
                                <span>Aderir / Solicitar Proposta</span>
                            </a>
                            <a href="https://wa.me/244972888585?text={{ urlencode($service['whatsapp_msg']) }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-sm transition shadow-lg shadow-green-500/20">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Falar no WhatsApp Directo</span>
                            </a>
                            <a href="/tec#servicos-tec" class="text-xs text-slate-500 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white transition flex items-center gap-1 py-2">
                                <span>&larr; Ver outros serviços</span>
                            </a>
                        </div>
                    </div>

                    <!-- Imagem Oficial ou Card Visual em Destaque -->
                    @if(!empty($service['image']))
                        <div class="lg:col-span-5">
                            <div class="relative rounded-2xl overflow-hidden shadow-xl border border-slate-200/80 dark:border-white/15 bg-white dark:bg-white/5 group">
                                <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}" class="w-full h-72 sm:h-96 object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-slate-950/70 via-transparent to-transparent dark:from-[#071326]/85"></div>
                                <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-slate-300">
                                    <span class="px-3 py-1.5 rounded-full bg-white/95 text-slate-900 dark:bg-black/60 dark:text-white backdrop-blur-md border border-slate-200/80 dark:border-white/10 font-bold flex items-center gap-1.5 shadow-sm">
                                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-[#0077c2] dark:text-[#00a3e0]"></i>
                                        Serviço Oficial RACHI Tec
                                    </span>
                                    <span class="text-[11px] text-sky-300 dark:text-sky-400 font-semibold tracking-wider uppercase drop-shadow-sm">Garantia Ativa</span>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="lg:col-span-4">
                            <div class="relative rounded-3xl p-8 bg-white/90 dark:bg-gradient-to-b dark:from-white/10 dark:to-white/5 border border-slate-200/80 dark:border-white/15 backdrop-blur-xl shadow-xl flex flex-col items-center text-center">
                                <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-[#00a3e0] to-[#0077c2] p-5 flex items-center justify-center shadow-lg border border-sky-400/30 mb-6 group-hover:scale-110 transition-transform">
                                    <i data-lucide="{{ $service['icon'] }}" class="w-12 h-12 text-white"></i>
                                </div>

                                <span class="text-xs font-bold text-sky-600 dark:text-sky-400 uppercase tracking-widest mb-1">Tecnologia Certificada</span>
                                <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-3">{{ $service['title'] }}</h3>
                                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                                    Suporte corporativo sob medida para empresas em Luanda e em todo o território nacional angolano.
                                </p>

                                <div class="w-full py-3 px-4 rounded-2xl bg-slate-50 dark:bg-white/[0.06] border border-slate-200 dark:border-white/10 flex items-center justify-between text-xs text-slate-700 dark:text-slate-200">
                                    <span class="flex items-center gap-1.5 font-semibold">
                                        <i data-lucide="shield-check" class="w-4 h-4 text-[#0077c2] dark:text-[#00a3e0]"></i>
                                        Atendimento Especializado
                                    </span>
                                    <span class="text-[#0077c2] dark:text-[#00a3e0] font-bold">100% Garantido</span>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 2. O QUE ESTÁ INCLUÍDO & ETAPAS DE EXECUÇÃO               -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- O Que Inclui (7 cols) -->
                <div class="lg:col-span-7 bg-white dark:bg-[#071326] p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 text-[#00a3e0] dark:bg-sky-950/60 dark:text-sky-400 flex items-center justify-center border border-sky-200 dark:border-sky-800">
                            <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-sky-600 dark:text-sky-400">Escopo Detalhado</span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">O que está incluído no serviço</h2>
                        </div>
                    </div>

                    <div class="space-y-3.5 pt-2">
                        @foreach($service['includes'] as $inc)
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-slate-50 dark:bg-[#0a1a33]/60 border border-slate-100 dark:border-slate-800/80">
                                <span class="w-5 h-5 rounded-full bg-sky-100 dark:bg-sky-950 text-sky-700 dark:text-sky-400 flex items-center justify-center text-xs shrink-0 font-bold mt-0.5">✓</span>
                                <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-medium">{{ $inc }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-4 rounded-2xl bg-sky-500/10 border border-sky-500/20 text-xs text-sky-900 dark:text-sky-300 flex items-start gap-2.5">
                        <i data-lucide="shield" class="w-4 h-4 text-[#00a3e0] shrink-0 mt-0.5"></i>
                        <div>
                            <strong>Padrão de Excelência RACHI:</strong> Todas as soluções de TI e software são homologadas e implementadas por engenheiros e consultores de sistemas qualificados, com rigor técnico e conformidade com as normas angolanas.
                        </div>
                    </div>
                </div>

                <!-- Como Funciona - Processo em 4 Etapas (5 cols) -->
                <div class="lg:col-span-5 bg-white dark:bg-[#071326] p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-950/60 dark:text-indigo-400 flex items-center justify-center border border-indigo-200 dark:border-indigo-800">
                            <i data-lucide="layers" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Fluxo Transparente</span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Como Funciona a Adesão</h2>
                        </div>
                    </div>

                    <div class="space-y-4 pt-2 relative">
                        @foreach($service['steps'] as $st)
                            <div class="flex items-start gap-3.5">
                                <div class="w-8 h-8 rounded-xl bg-sky-50 dark:bg-sky-500/15 text-[#0077c2] dark:text-[#00a3e0] font-black text-xs flex items-center justify-center shrink-0 border border-sky-200 dark:border-sky-500/25 shadow-xs">
                                    {{ $st['num'] }}
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-bold text-sm text-slate-900 dark:text-white">{{ $st['title'] }}</h3>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed">{{ $st['desc'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="pt-2">
                        <a href="#solicitar" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-[#00a3e0] text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                            <span>Aderir a este Serviço</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 3. TABELA DE PREÇOS & PACOTES EM KWANZAS                -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="text-center max-w-2xl mx-auto mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] px-3.5 py-1.5 rounded-full bg-sky-50 dark:bg-sky-950/60 border border-sky-200 dark:border-sky-800">
                    Planos e Opções de Adesão
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white mt-3 tracking-tight">
                    Valores transparentes e soluções escaláveis
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-2">
                    Cotações em Kwanzas (AOA) com emissão de factura proforma oficial e suporte garantido.
                </p>
            </div>

            <!-- Grade dos 3 Planos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($service['plans'] as $plan)
                    <div class="relative rounded-3xl p-6 sm:p-8 transition-all duration-300 flex flex-col justify-between border {{ $plan['popular'] ? 'bg-white dark:bg-[#071326] border-[#00a3e0] shadow-xl shadow-sky-500/10 ring-2 ring-[#00a3e0]' : 'bg-white dark:bg-[#071326] border-slate-200 dark:border-slate-800 shadow-sm' }}">
                        
                        @if($plan['popular'])
                            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-3.5 py-0.5 rounded-full bg-[#00a3e0] text-white text-[10px] font-extrabold uppercase tracking-wider shadow-sm">
                                Mais Recomendado
                            </div>
                        @endif

                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $plan['name'] }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 min-h-[34px]">{{ $plan['desc'] }}</p>

                            <div class="my-6 pt-4 border-t border-slate-100 dark:border-slate-800">
                                <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tight">{{ $plan['price'] }}</div>
                                <div class="text-xs text-slate-400 font-medium mt-0.5">{{ $plan['period'] }}</div>
                            </div>

                            <div class="space-y-2.5 mb-6">
                                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Inclui:</div>
                                @foreach($plan['features'] as $feat)
                                    <div class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300">
                                        <span class="w-4 h-4 rounded-full bg-sky-100 dark:bg-sky-950 text-sky-700 dark:text-sky-400 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <button type="button" 
                               @click="selectPlan('{{ $plan['name'] }}')"
                               class="w-full py-3 px-4 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer {{ $plan['popular'] ? 'bg-[#00a3e0] hover:bg-[#0284c7] text-white shadow-md shadow-sky-500/25' : 'bg-slate-900 hover:bg-[#00a3e0] text-white dark:bg-slate-800 dark:hover:bg-[#00a3e0]' }}">
                                <span>Aderir a este Plano</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Nota de Transparência -->
            <div class="mt-8 p-4 rounded-2xl bg-slate-100 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 flex items-start gap-3 text-xs text-slate-600 dark:text-slate-400 max-w-3xl mx-auto">
                <i data-lucide="info" class="w-4 h-4 text-[#00a3e0] shrink-0 mt-0.5"></i>
                <div>
                    <strong>Projetos Personalizados:</strong> Caso a sua empresa possua requisitos técnicos específicos ou volumes superiores, preparamos uma proposta técnica à medida com cronograma de implementação executivo.
                </div>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 4. MEIOS DE ADERIR & CONTACTAR                          -->
        <!-- ======================================================== -->
        <section id="solicitar" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pb-20">
            <div class="bg-white dark:bg-[#071326] rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl p-6 sm:p-10 lg:p-12">
                
                <div class="max-w-3xl mb-8">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] px-3.5 py-1.5 rounded-full bg-sky-50 dark:bg-sky-950/60 border border-sky-200 dark:border-sky-800">
                        Como Aderir &amp; Contactar
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 dark:text-white mt-3 tracking-tight">
                        Solicite a adesão ou fale com um consultor de TI
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-2">
                        Preencha o formulário abaixo para receber uma proposta oficial, ou inicie o atendimento imediato através dos nossos canais diretos.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                    
                    <!-- Formulário de Solicitação Direta (7 cols) -->
                    <div class="lg:col-span-7">
                        <form action="/contacto" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="assunto" value="Adesão ao Serviço: {{ $service['title'] }}">
                            
                            <div class="p-3 rounded-2xl bg-sky-500/10 border border-sky-500/20 text-xs text-sky-900 dark:text-sky-300 flex items-center justify-between">
                                <span><strong>Plano Selecionado:</strong> <span x-text="selectedPlan" class="font-bold text-[#00a3e0]"></span></span>
                                <input type="hidden" name="plano_selecionado" :value="selectedPlan">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">O Seu Nome *</label>
                                    <input type="text" name="name" required placeholder="Ex: Dr. António Silva" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#0a1a33] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#00a3e0]">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Empresa / Organização</label>
                                    <input type="text" name="empresa" placeholder="Ex: Empresa LDA" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#0a1a33] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#00a3e0]">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Email Corporativo *</label>
                                    <input type="email" name="email" required placeholder="antonio@empresa.ao" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#0a1a33] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#00a3e0]">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Telefone / WhatsApp *</label>
                                    <input type="tel" name="telefone" required placeholder="+244 972 888 585" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#0a1a33] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#00a3e0]">
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Detalhes da Demanda / Mensagem</label>
                                <textarea name="message" rows="4" placeholder="Descreva brevemente a sua necessidade ou particularidades da sua empresa..." class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#0a1a33] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#00a3e0]"></textarea>
                            </div>

                            <button type="submit" class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-[#00a3e0] to-[#0284c7] hover:from-[#0284c7] hover:to-[#0369a1] text-white font-bold text-sm transition shadow-lg shadow-sky-500/25 flex items-center justify-center gap-2 cursor-pointer">
                                <i data-lucide="check" class="w-4 h-4"></i>
                                <span>Enviar Pedido de Adesão &amp; Cotação</span>
                            </button>

                            <p class="text-[11px] text-slate-500 text-center">
                                Responderemos em menos de 2 horas úteis com a proposta formal e termos contratuais.
                            </p>
                        </form>
                    </div>

                    <!-- Canais de Atendimento Rápido (5 cols) -->
                    <div class="lg:col-span-5 space-y-4">
                        <div class="p-6 rounded-3xl bg-slate-50 dark:bg-[#0a1a33]/60 border border-slate-200 dark:border-slate-800 space-y-4">
                            <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <i data-lucide="zap" class="w-4 h-4 text-amber-500"></i>
                                Atendimento Imediato
                            </h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Prefere falar diretamente com um consultor técnico antes de submeter a adesão? Utilize os nossos canais dedicados:
                            </p>

                            <!-- WhatsApp Directo -->
                            <a href="https://wa.me/244972888585?text={{ urlencode($service['whatsapp_msg']) }}" target="_blank" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white dark:bg-[#071326] border border-slate-200 dark:border-slate-700 hover:border-green-500 transition group">
                                <div class="w-10 h-10 rounded-xl bg-[#25D366]/15 text-[#25D366] flex items-center justify-center shrink-0">
                                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-green-500 transition">WhatsApp Dedicado</div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400">Resposta em minutos • Dias úteis 8h-18h</div>
                                </div>
                                <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-400 group-hover:text-green-500 transition"></i>
                            </a>

                            <!-- Telefone Directo -->
                            <a href="tel:+244972888585" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white dark:bg-[#071326] border border-slate-200 dark:border-slate-700 hover:border-sky-500 transition group">
                                <div class="w-10 h-10 rounded-xl bg-sky-500/15 text-[#00a3e0] flex items-center justify-center shrink-0">
                                    <i data-lucide="phone-call" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-[#00a3e0] transition">Linha Telefónica Direta</div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400">+244 972 888 585 / Luanda, Angola</div>
                                </div>
                                <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-400 group-hover:text-[#00a3e0] transition"></i>
                            </a>

                            <!-- Email Directo -->
                            <a href="mailto:comercial@rachi.ao?subject={{ urlencode('Adesão: ' . $service['title']) }}" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white dark:bg-[#071326] border border-slate-200 dark:border-slate-700 hover:border-sky-500 transition group">
                                <div class="w-10 h-10 rounded-xl bg-indigo-500/15 text-indigo-500 flex items-center justify-center shrink-0">
                                    <i data-lucide="mail" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-indigo-400 transition">Email Comercial</div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400">comercial@rachi.ao</div>
                                </div>
                                <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-400 group-hover:text-indigo-400 transition"></i>
                            </a>
                        </div>

                        <!-- Card de Garantia de Confidencialidade -->
                        <div class="p-4 rounded-2xl bg-slate-100 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 text-xs text-slate-600 dark:text-slate-400 space-y-1.5">
                            <div class="font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                <i data-lucide="lock" class="w-3.5 h-3.5 text-[#00a3e0]"></i>
                                Acordo de Confidencialidade (NDA)
                            </div>
                            <p class="leading-relaxed">
                                Os dados, infraestruturas e processos da sua organização são tratados sob estrito sigilo corporativo garantido por cláusula contratual.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 5. OUTROS SERVIÇOS DO CATÁLOGO RACHI TEC                 -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-slate-200 dark:border-slate-800">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-[#00a3e0]">Catálogo Completo</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Outros Serviços RACHI Tec</h2>
                </div>
                <a href="/tec#servicos-tec" class="text-xs font-bold text-[#00a3e0] hover:underline flex items-center gap-1">
                    <span>Ver todos</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($otherServices as $other)
                    <a href="{{ route('tec.service.show', $other['slug']) }}" class="group block p-5 rounded-2xl bg-white dark:bg-[#071326] border border-slate-200 dark:border-slate-800 hover:border-sky-500/50 hover:shadow-lg transition-all duration-300">
                        <div class="w-10 h-10 rounded-xl bg-sky-50 dark:bg-sky-950/60 text-[#00a3e0] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <i data-lucide="{{ $other['icon'] }}" class="w-5 h-5"></i>
                        </div>
                        <span class="text-[10px] font-bold text-sky-600 dark:text-sky-400 uppercase tracking-wider">{{ $other['tag'] }}</span>
                        <h3 class="text-sm font-bold text-slate-900 dark:text-white mt-1 group-hover:text-[#00a3e0] transition line-clamp-1">{{ $other['title'] }}</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">{{ $other['short_desc'] }}</p>
                        <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
                            <span class="font-bold text-slate-900 dark:text-white">{{ $other['starting_price'] }}</span>
                            <span class="text-[#00a3e0] font-semibold flex items-center gap-0.5 group-hover:translate-x-1 transition-transform">
                                Ver &rarr;
                            </span>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

    </main>

        <!-- ============================================================ -->
    <!-- FOOTER                                                       -->
    <!-- ============================================================ -->
    <footer class="bg-slate-100 dark:bg-[#071326] text-slate-700 dark:text-slate-300 pt-16 pb-8 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <!-- Footer Logo Oficial RACHI Tec -->
                    <a href="/tec" class="inline-flex items-center gap-2.5 mb-4 group text-decoration-none">
                        <picture class="flex items-center">
                            <source srcset="/images/areas/rachi-tec.webp" type="image/webp">
                            <img src="/images/areas/rachi-tec.png" 
                                 onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-tec.png'" 
                                 alt="RACHI Tec" 
                                 class="h-8 w-auto object-contain filter drop-shadow-[0_0_4px_rgba(255,255,255,0.35)] group-hover:scale-105 transition-all">
                        </picture>
                        <span class="font-display font-bold text-base text-slate-900 dark:text-white">RACHI <span class="text-[#00a3e0]">Tec</span></span>
                    </a>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Digitalização, sistemas de gestão, websites, transformação digital e suporte técnico de padrão corporativo.
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#00a3e0] mb-3">Soluções RACHI</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/capital" class="hover:text-emerald-400 transition">01 RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-indigo-400 transition">02 RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-sky-400 transition text-sky-400 font-bold">03 RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-400 transition">04 RACHI Print</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#00a3e0] mb-3">Navegação</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/" class="hover:text-slate-900 dark:hover:text-white transition">Portal RACHI</a></li>
                        <li><a href="/tec#servicos-tec" class="hover:text-slate-900 dark:hover:text-white transition">Serviços Tec</a></li>
                        <li><a href="/#sobre" class="hover:text-slate-900 dark:hover:text-white transition">Sobre a RACHI</a></li>
                        <li><a href="/contacto" class="hover:text-slate-900 dark:hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#00a3e0] mb-3">Contacto</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Luanda — Angola</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2">Atendimento remoto e presencial para empresas.</p>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-800/80 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 dark:text-slate-400 gap-4">
                <div>&copy; {{ date('Y') }} <strong class="text-slate-900 dark:text-white">RACHI Tec</strong>. Todos os direitos reservados.</div>
                <div class="flex items-center gap-2.5">
                    <button type="button" onclick="setRachiLanguage('pt')" data-rachi-lang="pt" class="hover:text-[#00a3e0] transition font-bold text-[#00a3e0] cursor-pointer" title="Português">PT</button>
                    <span class="text-slate-400 opacity-60">|</span>
                    <button type="button" onclick="setRachiLanguage('en')" data-rachi-lang="en" class="hover:text-[#00a3e0] transition opacity-70 cursor-pointer" title="English">EN</button>
                    <span class="text-slate-400 opacity-60">|</span>
                    <button type="button" onclick="setRachiLanguage('zh-CN')" data-rachi-lang="zh-CN" class="hover:text-[#00a3e0] transition opacity-70 cursor-pointer" title="中文 (Mandarim)">中文</button>
                </div>
            </div>
        </div>
    </footer>

    <!-- Inicialização Lucide Icons -->
    <script>
        
        function rachiServicePage() {
            return {
                mobileMenuOpen: false,
                openSol: false,
                init() {
                    const handleScroll = () => {
                        const nav = document.getElementById('navbar');
                        if (nav) {
                            if (window.scrollY > 30) {
                                nav.classList.add('header-scrolled');
                            } else {
                                nav.classList.remove('header-scrolled');
                            }
                        }
                    };
                    window.addEventListener('scroll', handleScroll, { passive: true });
                    handleScroll();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
    @include('components.theme-toggle-fab')
</body>
</html>
