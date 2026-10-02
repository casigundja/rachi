<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Human Capital — Serviços Empresariais, Recursos Humanos &amp; Contabilidade</title>
    <meta name="description" content="RACHI Human Capital — Serviços empresariais, recursos humanos, contabilidade e regularização documental em Angola.">

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
        section[id], div[id] { scroll-margin-top: 85px; }

        body {
            font-family: 'Inter', sans-serif;
            color: #0b1a2e;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* DUAL THEME HEADER (Dark top -> Crisp on scroll) */
        .site-header {
            position: fixed !important;
            top: 0 !important; left: 0 !important; right: 0 !important;
            z-index: 1030 !important;
            width: 100% !important;
            transition: background-color 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        border-color 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        box-shadow 0.35s cubic-bezier(0.4, 0, 0.2, 1),
                        backdrop-filter 0.35s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }

        /* STATE 1: TOP (DARK) */
        .site-header.header-top-dark {
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.35) !important;
        }
        .site-header.header-top-dark .main-nav-capsule {
            display: flex; align-items: center; gap: 0.25rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 9999px; padding: 0.3rem 0.5rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2);
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link {
            position: relative; font-size: 0.88rem; font-weight: 500;
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.45rem 0.9rem !important; border-radius: 9999px;
            white-space: nowrap; text-decoration: none;
            transition: all 0.2s ease;
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link:hover {
            color: #ffffff !important; background: rgba(255, 255, 255, 0.08);
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
            font-weight: 700;
        }

        /* STATE 2: SCROLLED (LIGHT) */
        .site-header.header-scrolled-light {
            background: rgba(255, 255, 255, 0.96) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(11, 26, 46, 0.08) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.07) !important;
        }
        .site-header.header-scrolled-light .main-nav-capsule {
            display: flex; align-items: center; gap: 0.25rem;
            background: rgba(11, 26, 46, 0.04);
            border: 1px solid rgba(11, 26, 46, 0.08);
            border-radius: 9999px; padding: 0.3rem 0.5rem;
        }
        .site-header.header-scrolled-light .main-nav-capsule .nav-link {
            font-size: 0.88rem; font-weight: 600;
            color: #0b1a2e !important;
            padding: 0.45rem 0.9rem !important; border-radius: 9999px;
            transition: all 0.2s ease;
        }
        .site-header.header-scrolled-light .main-nav-capsule .nav-link:hover {
            color: #059669 !important; background: rgba(16, 185, 129, 0.08);
        }
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.active {
            color: #059669 !important;
            background: rgba(16, 185, 129, 0.12);
            border: 1px solid rgba(16, 185, 129, 0.3);
            font-weight: 700;
        }
        .site-header.header-scrolled-light .brand-logo-text {
            color: #071326 !important;
        }
        .site-header.header-scrolled-light .mobile-menu-btn {
            color: #0b1a2e !important;
            background: rgba(11, 26, 46, 0.05) !important;
        }

        /* Action Buttons */
        .btn-cta-emerald {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff;
            font-weight: 700;
            font-size: 0.85rem;
            padding: 0.75rem 1.6rem;
            border-radius: 0.75rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
            transition: all 0.25s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.35);
        }
        .btn-cta-emerald:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(16, 185, 129, 0.45);
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff;
        }

        /* Card Service */
        /* Card Service Modern Styling */
        .service-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            padding: 1.85rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-decoration: none !important;
            box-shadow: 0 2px 10px -2px rgba(11, 26, 46, 0.05);
        }
        .service-card:hover {
            transform: translateY(-6px);
        }

        /* Hover Accents Individualized per Service */
        .card-accent-emerald:hover {
            border-color: #10b981 !important;
            box-shadow: 0 20px 35px -10px rgba(16, 185, 129, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-blue:hover {
            border-color: #3b82f6 !important;
            box-shadow: 0 20px 35px -10px rgba(59, 130, 246, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-purple:hover {
            border-color: #a855f7 !important;
            box-shadow: 0 20px 35px -10px rgba(168, 85, 247, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-amber:hover {
            border-color: #f59e0b !important;
            box-shadow: 0 20px 35px -10px rgba(245, 158, 11, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-sky:hover {
            border-color: #0ea5e9 !important;
            box-shadow: 0 20px 35px -10px rgba(14, 165, 233, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-teal:hover {
            border-color: #14b8a6 !important;
            box-shadow: 0 20px 35px -10px rgba(20, 184, 166, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        /* Suporte Dark Mode RACHI Human Capital */
        html.dark body {
            background-color: #030813;
            color: #f8fafc;
        }
        html.dark .service-card {
            background: #071326;
            border-color: rgba(255, 255, 255, 0.08);
            color: #f8fafc;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
        }
        html.dark .card-accent-emerald:hover {
            border-color: #10b981 !important;
            box-shadow: 0 20px 40px -10px rgba(16, 185, 129, 0.28), 0 0 25px rgba(16, 185, 129, 0.12);
        }
        html.dark .card-accent-blue:hover {
            border-color: #3b82f6 !important;
            box-shadow: 0 20px 40px -10px rgba(59, 130, 246, 0.28), 0 0 25px rgba(59, 130, 246, 0.12);
        }
        html.dark .card-accent-purple:hover {
            border-color: #a855f7 !important;
            box-shadow: 0 20px 40px -10px rgba(168, 85, 247, 0.28), 0 0 25px rgba(168, 85, 247, 0.12);
        }
        html.dark .card-accent-amber:hover {
            border-color: #f59e0b !important;
            box-shadow: 0 20px 40px -10px rgba(245, 158, 11, 0.28), 0 0 25px rgba(245, 158, 11, 0.12);
        }
        html.dark .card-accent-sky:hover {
            border-color: #0ea5e9 !important;
            box-shadow: 0 20px 40px -10px rgba(14, 165, 233, 0.28), 0 0 25px rgba(14, 165, 233, 0.12);
        }
        html.dark .card-accent-teal:hover {
            border-color: #14b8a6 !important;
            box-shadow: 0 20px 40px -10px rgba(20, 184, 166, 0.28), 0 0 25px rgba(20, 184, 166, 0.12);
        }

        /* Category Badges */
        .badge-category {
            font-size: 10px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            border-width: 1px;
            display: inline-flex;
            align-items: center;
        }
        .badge-cat-emerald { background-color: #ecfdf5; color: #047857; border-color: #a7f3d0; }
        .badge-cat-blue    { background-color: #eff6ff; color: #1d4ed8; border-color: #bfdbfe; }
        .badge-cat-purple  { background-color: #faf5ff; color: #7e22ce; border-color: #e9d5ff; }
        .badge-cat-amber   { background-color: #fffbeb; color: #b45309; border-color: #fde68a; }
        .badge-cat-sky     { background-color: #f0f9ff; color: #0369a1; border-color: #bae6fd; }
        .badge-cat-teal    { background-color: #f0fdf4; color: #0f766e; border-color: #99f6e4; }

        html.dark .badge-cat-emerald { background-color: rgba(6, 78, 59, 0.4); color: #34d399; border-color: rgba(52, 211, 153, 0.3); }
        html.dark .badge-cat-blue    { background-color: rgba(30, 58, 138, 0.4); color: #60a5fa; border-color: rgba(96, 165, 250, 0.3); }
        html.dark .badge-cat-purple  { background-color: rgba(88, 28, 135, 0.4); color: #c084fc; border-color: rgba(192, 132, 252, 0.3); }
        html.dark .badge-cat-amber   { background-color: rgba(120, 53, 15, 0.4); color: #fbbf24; border-color: rgba(251, 191, 36, 0.3); }
        html.dark .badge-cat-sky     { background-color: rgba(12, 74, 110, 0.4); color: #38bdf8; border-color: rgba(56, 189, 248, 0.3); }
        html.dark .badge-cat-teal    { background-color: rgba(19, 78, 74, 0.4); color: #2dd4bf; border-color: rgba(45, 212, 191, 0.3); }

        /* Bullet Points */
        .card-bullet {
            width: 1.15rem;
            height: 1.15rem;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 900;
            flex-shrink: 0;
        }
        .bullet-emerald { background-color: #d1fae5; color: #059669; }
        .bullet-blue    { background-color: #dbeafe; color: #2563eb; }
        .bullet-purple  { background-color: #f3e8ff; color: #9333ea; }
        .bullet-amber   { background-color: #fef3c7; color: #d97706; }
        .bullet-sky     { background-color: #e0f2fe; color: #0284c7; }
        .bullet-teal    { background-color: #ccfbf1; color: #0d9488; }

        html.dark .bullet-emerald { background-color: rgba(6, 78, 59, 0.6); color: #34d399; }
        html.dark .bullet-blue    { background-color: rgba(30, 58, 138, 0.6); color: #60a5fa; }
        html.dark .bullet-purple  { background-color: rgba(88, 28, 135, 0.6); color: #c084fc; }
        html.dark .bullet-amber   { background-color: rgba(120, 53, 15, 0.6); color: #fbbf24; }
        html.dark .bullet-sky     { background-color: rgba(12, 74, 110, 0.6); color: #38bdf8; }
        html.dark .bullet-teal    { background-color: rgba(19, 78, 74, 0.6); color: #2dd4bf; }
    </style>
</head>
<body x-data="{ mobileMenuOpen: false }">

    <!-- ============================================================ -->
    <!-- DUAL THEME HEADER                                            -->
    <!-- ============================================================ -->
    <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-5 lg:py-6 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- Brand Logo Oficial RACHI Human Capital -->
            <a href="/" class="flex items-center gap-3 group text-decoration-none" title="Ir para a página inicial (Portal RACHI)">
                <div class="h-12 px-2 py-1 rounded-xl bg-white/[0.08] border border-white/10 group-hover:border-emerald-400/40 flex items-center justify-center transition-all duration-200 group-hover:scale-105 shadow-sm">
                    <picture class="flex items-center">
                        <source srcset="/images/areas/rachi-human-capital.webp" type="image/webp">
                        <img src="/images/areas/rachi-human-capital.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-human-capital.png'" 
                             alt="RACHI Human Capital" 
                             class="h-10 w-auto object-contain filter drop-shadow-[0_0_6px_rgba(255,255,255,0.35)]">
                    </picture>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-black text-lg tracking-wider text-white brand-logo-text flex items-center gap-1.5 transition-colors">
                        RACHI <span class="text-[#10b981] text-xs font-bold px-2 py-0.5 rounded-full bg-emerald-500/10 border border-emerald-500/20">HUMAN CAPITAL</span>
                    </span>
                    <span class="text-[10px] text-slate-400 tracking-widest uppercase font-medium">Recursos Humanos &amp; Gestão</span>
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
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="opacity-70 transition-transform duration-200" :class="openSol ? 'rotate-180 text-[#10b981]' : ''">
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
                        
                        <a href="/capital" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-emerald-500/15 text-emerald-400 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center font-black text-xs">01</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title text-emerald-300">RACHI Human Capital</div>
                                    <div class="text-[11px] text-emerald-400/80 dropdown-desc">Pessoas &amp; Gestão</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-100 transition"></i>
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

                        <a href="/tec" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl hover:bg-sky-500/15 text-slate-300 hover:text-sky-300 transition group">
                            <div class="flex items-center gap-3">
                                <span class="w-8 h-8 rounded-lg bg-sky-500/15 text-sky-400 flex items-center justify-center font-black text-xs">03</span>
                                <div>
                                    <div class="font-bold text-xs dropdown-title">RACHI Tec</div>
                                    <div class="text-[11px] text-slate-400 dropdown-desc">Sistemas &amp; TI</div>
                                </div>
                            </div>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5 opacity-0 group-hover:opacity-100 -translate-x-1 group-hover:translate-x-0 transition"></i>
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

                <a href="#servicos-capital" class="nav-link">
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

                <a href="/contacto" class="btn-cta-emerald group">
                    <i data-lucide="users" class="w-4 h-4"></i>
                    <span>Consultoria RH</span>
                </a>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl text-white hover:text-[#10b981] focus:outline-none" aria-label="Menu Principal">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak class="header-dropdown lg:hidden bg-[#071326]/98 backdrop-blur-2xl border-t border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">
            <a href="/" class="block font-medium py-1.5 text-white hover:text-[#10b981]">Home</a>
            <div class="border-t border-white/10 pt-2">
                <span class="text-xs uppercase font-bold text-[#10b981] tracking-wider">Soluções</span>
                <div class="pl-3 mt-1 space-y-1.5">
                    <a href="/capital" class="block text-sm text-emerald-400 font-bold">01 RACHI Human Capital</a>
                    <a href="/academy" class="block text-sm text-slate-400 hover:text-indigo-400">02 RACHI Academy</a>
                    <a href="/tec" class="block text-sm text-slate-400 hover:text-sky-400">03 RACHI Tec</a>
                    <a href="/print" class="block text-sm text-slate-400 hover:text-amber-400">04 RACHI Print</a>
                </div>
            </div>
            <div class="border-t border-white/10 pt-2 space-y-1">
                <a href="#servicos-capital" @click="mobileMenuOpen = false" class="block font-medium py-1 text-slate-300 hover:text-white">Os nossos serviços</a>
                <a href="/contacto" class="block font-medium py-1 text-[#10b981] font-bold">Pedir Proposta / Contacto</a>
            </div>
        </div>
    </header>

    <!-- Header Scroll Script -->
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

    <!-- ============================================================ -->
    <!-- MAIN CONTENT                                                 -->
    <!-- ============================================================ -->
    <main class="flex-1" style="padding-top: 75px;">
        
        <!-- ======================================================== -->
        <!-- 1. HERO BANNER: RACHI Human Capital                      -->
        <!-- ======================================================== -->
        <section class="bg-[#071326] text-white pt-16 pb-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <!-- Ambient Glow Gradients -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_60%_at_50%_-10%,rgba(16,185,129,0.22),transparent_70%)] pointer-events-none"></div>
            <div class="absolute top-1/3 -right-20 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-7xl mx-auto relative z-10">
                
                <!-- Breadcrumbs -->
                <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                    <a href="/" class="hover:text-white transition cursor-pointer">Início</a>
                    <span>/</span>
                    <span class="text-slate-500">Soluções</span>
                    <span>/</span>
                    <span class="text-[#10b981] font-semibold">RACHI Human Capital</span>
                </nav>

                <div class="max-w-4xl">
                    <!-- Pill Tag -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-500/30 text-emerald-300 text-xs font-bold uppercase tracking-wider mb-5">
                        <span class="w-2 h-2 rounded-full bg-[#10b981] animate-pulse"></span>
                        Pessoas, Gestão &amp; Apoio Empresarial
                    </div>

                    <!-- Main H1 -->
                    <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight">
                        RACHI Human Capital
                    </h1>

                    <!-- Main Subtitle requested by user -->
                    <p class="text-lg sm:text-2xl text-slate-200 mt-4 leading-relaxed font-normal">
                        Serviços empresariais, recursos humanos, contabilidade e regularização documental.
                    </p>

                    <!-- CTAs -->
                    <div class="mt-8 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="/contacto" class="btn-cta-emerald text-sm px-6 py-3.5 shadow-lg shadow-emerald-500/20">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            <span>Falar com um Consultor</span>
                        </a>
                        <a href="#servicos-capital" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/15 text-white font-semibold text-sm transition">
                            <i data-lucide="layers" class="w-4 h-4 text-emerald-400"></i>
                            <span>Explorar os Nossos Serviços</span>
                        </a>
                    </div>
                </div>

                <!-- 3 Pilares Oficiais: Segurança Garantida, Processo Rápido, Suporte Especializado -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mt-14 pt-10 border-t border-slate-800">
                    <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-900/60 border border-slate-800/80">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-white">Segurança Garantida</div>
                            <div class="text-xs text-slate-400">Rigor jurídico e fiscal para sua empresa</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-900/60 border border-slate-800/80">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="zap" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-white">Processo Rápido</div>
                            <div class="text-xs text-slate-400">Tramitação célere e prazos reduzidos</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-900/60 border border-slate-800/80">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/15 text-sky-400 flex items-center justify-center shrink-0">
                            <i data-lucide="headphones" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-white">Suporte Especializado</div>
                            <div class="text-xs text-slate-400">Consultores dedicados em Angola</div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 2. OS NOSSOS SERVIÇOS (As 6 Soluções Oficiais)          -->
        <!-- ======================================================== -->
        <section id="servicos-capital" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-[#10b981] font-bold text-xs uppercase tracking-widest bg-emerald-50 px-3.5 py-1.5 rounded-full border border-emerald-200">
                    Os nossos serviços
                </span>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 mt-4 tracking-tight">
                    Escolha o serviço ideal para impulsionar o seu negócio
                </h2>

                <p class="text-slate-600 text-base sm:text-lg mt-3.5 leading-relaxed">
                    Soluções completas e especializadas para apoiar todas as etapas da sua empresa. Selecione qualquer serviço para consultar a página com informações completas, preços e meios de solicitação.
                </p>

                <!-- Capsule de Garantias Oficiais -->
                <div class="inline-flex flex-wrap items-center justify-center gap-2 p-1.5 rounded-2xl bg-slate-100/80 dark:bg-slate-900/90 border border-slate-200/80 dark:border-slate-800 shadow-xs mt-6">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-emerald-500/10 text-emerald-800 dark:text-emerald-400 text-xs font-bold">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400"></i>
                        <span>Segurança Garantida</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-amber-500/10 text-amber-800 dark:text-amber-400 text-xs font-bold">
                        <i data-lucide="zap" class="w-3.5 h-3.5 text-amber-600 dark:text-amber-400"></i>
                        <span>Processo Rápido</span>
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1.5 rounded-xl bg-sky-500/10 text-sky-800 dark:text-sky-400 text-xs font-bold">
                        <i data-lucide="headphones" class="w-3.5 h-3.5 text-sky-600 dark:text-sky-400"></i>
                        <span>Suporte Especializado</span>
                    </span>
                </div>
            </div>

            <!-- Grade de 6 Serviços Oficiais Interativos -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- SERVIÇO 1: Cedência temporária de trabalhadores -->
                <a href="{{ route('capital.service.show', 'cedencia-temporaria') }}" class="service-card card-accent-emerald group text-decoration-none">
                    <div>
                        <!-- Imagem do Serviço -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-cedencia-temporaria.jpg') }}" alt="Cedência temporária de trabalhadores" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-emerald absolute top-3 right-3 shadow-md backdrop-blur-md">
                                01 • Gestão de Talentos
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-[#10b981] transition-colors">
                            Cedência temporária de trabalhadores
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Disponibilização de trabalhadores qualificados com gestão salarial, fiscal e jurídica assegurada.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-emerald">✓</span>
                                <span>Profissionais pré-avaliados</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-emerald">✓</span>
                                <span>Processo ágil e flexível</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-emerald">✓</span>
                                <span>Conformidade legal garantida</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">85.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">/ mês</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-[#10b981] group-hover:shadow-lg group-hover:shadow-emerald-500/25">
                            <span>Ver Detalhes &amp; Preços</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

                <!-- SERVIÇO 2: Constituição e legalização de empresas -->
                <a href="{{ route('capital.service.show', 'constituicao-legalizacao-empresas') }}" class="service-card card-accent-blue group text-decoration-none">
                    <div>
                        <!-- Imagem do Serviço -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-constituicao-empresas.jpg') }}" alt="Constituição e legalização de empresas" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-blue absolute top-3 right-3 shadow-md backdrop-blur-md">
                                02 • Legalização
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                            Constituição e legalização de empresas
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Apoio completo na abertura de sociedades comerciais, registo no GUE e enquadramento fiscal na AGT.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-blue">✓</span>
                                <span>Acompanhamento integral</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-blue">✓</span>
                                <span>Documentação e estatutos inclusos</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-blue">✓</span>
                                <span>Prazos reduzidos e sem burocracia</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">185.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">taxa única</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-blue-600 group-hover:shadow-lg group-hover:shadow-blue-500/25">
                            <span>Ver Detalhes &amp; Preços</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

                <!-- SERVIÇO 3: Consultoria em recursos humanos -->
                <a href="{{ route('capital.service.show', 'consultoria-recursos-humanos') }}" class="service-card card-accent-purple group text-decoration-none">
                    <div>
                        <!-- Imagem do Serviço -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-consultoria-rh.jpg') }}" alt="Consultoria em recursos humanos" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-purple absolute top-3 right-3 shadow-md backdrop-blur-md">
                                03 • Estratégia RH
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white mt-5 tracking-tight leading-snug group-hover:text-purple-600 dark:group-hover:text-purple-400 transition-colors">
                            Consultoria em recursos humanos
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Diagnóstico organizacional, planos de carreira (PCR), políticas internas e avaliação de desempenho.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-purple">✓</span>
                                <span>Diagnóstico e auditoria de RH</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-purple">✓</span>
                                <span>Plano de cargos e remunerações</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-purple">✓</span>
                                <span>Políticas internas e metas (KPIs)</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">150.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">projeto base</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-purple-600 group-hover:shadow-lg group-hover:shadow-purple-500/25">
                            <span>Ver Detalhes &amp; Preços</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

                <!-- SERVIÇO 4: Organização de contabilidade -->
                <a href="{{ route('capital.service.show', 'organizacao-contabilidade') }}" class="service-card card-accent-amber group text-decoration-none">
                    <div>
                        <!-- Imagem do Serviço -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-organizacao-contabilidade.jpg') }}" alt="Organização de contabilidade" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-amber absolute top-3 right-3 shadow-md backdrop-blur-md">
                                04 • Finanças &amp; Contas
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white mt-5 tracking-tight leading-snug group-hover:text-amber-600 dark:group-hover:text-amber-400 transition-colors">
                            Organização de contabilidade
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Contabilidade geral e analítica, apuramento mensal de impostos e fecho anual de contas.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-amber">✓</span>
                                <span>Apuramento mensal de IVA e IRT</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-amber">✓</span>
                                <span>Balancetes e demonstrações financeiras</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-amber">✓</span>
                                <span>Supervisão por contabilista certificado</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">95.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">/ mês</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-amber-600 group-hover:shadow-lg group-hover:shadow-amber-500/25">
                            <span>Ver Detalhes &amp; Preços</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

                <!-- SERVIÇO 5: Registo no INSS -->
                <a href="{{ route('capital.service.show', 'registo-inss') }}" class="service-card card-accent-sky group text-decoration-none">
                    <div>
                        <!-- Imagem do Serviço -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-registo-inss.jpg') }}" alt="Registo no INSS" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-sky absolute top-3 right-3 shadow-md backdrop-blur-md">
                                05 • Segurança Social
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white mt-5 tracking-tight leading-snug group-hover:text-sky-600 dark:group-hover:text-sky-400 transition-colors">
                            Registo no INSS
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Inscrição de empresas e trabalhadores, submissão de declarações e emissão de guias de pagamento.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-sky">✓</span>
                                <span>Inscrição da empresa e funcionários</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-sky">✓</span>
                                <span>Geração de guias mensais (8% + 3%)</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-sky">✓</span>
                                <span>Certidões de não devedor oficiais</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">65.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">taxa única</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-sky-600 group-hover:shadow-lg group-hover:shadow-sky-500/25">
                            <span>Ver Detalhes &amp; Preços</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

                <!-- SERVIÇO 6: Regularização documental empresarial -->
                <a href="{{ route('capital.service.show', 'regularizacao-documental') }}" class="service-card card-accent-teal group text-decoration-none">
                    <div>
                        <!-- Imagem do Serviço -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-regularizacao-documental.jpg') }}" alt="Regularização documental empresarial" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-teal absolute top-3 right-3 shadow-md backdrop-blur-md">
                                06 • Compliance &amp; Arquivo
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white mt-5 tracking-tight leading-snug group-hover:text-teal-600 dark:group-hover:text-teal-400 transition-colors">
                            Regularização documental empresarial
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Auditoria de licenças, emissão/renovação de Alvará Comercial pelo SILAC e organização documental.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-teal">✓</span>
                                <span>Emissão e renovação de Alvará Comercial</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-teal">✓</span>
                                <span>Certidões de não devedor AGT / INSS</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-teal">✓</span>
                                <span>Organização física e digital do arquivo</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">120.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">taxa base</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-teal-600 group-hover:shadow-lg group-hover:shadow-teal-500/25">
                            <span>Ver Detalhes &amp; Preços</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

            </div>

        </section>

        <!-- ======================================================== -->
        <!-- 3. CTA SECTION (Contacto & Proposta)                     -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
            <div class="relative rounded-3xl p-10 sm:p-14 bg-gradient-to-br from-[#071326] via-[#0d2238] to-[#071326] border border-emerald-500/30 overflow-hidden shadow-2xl text-center text-white">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#10b981] px-3.5 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-500/30">
                        Apoio Empresarial Estruturado
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white">
                        Pronto para organizar e impulsionar a gestão da sua empresa?
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Fale diretamente com os nossos consultores especializados em RH, contabilidade e legalização empresarial em Angola e garanta total conformidade.
                    </p>
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="/contacto" class="btn-cta-emerald text-sm px-6 py-3.5">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span>Falar Connosco / Pedir Proposta</span>
                        </a>
                        <a href="https://wa.me/244972888585?text=Ol%C3%A1!%20Gostaria%20de%20solicitar%20uma%20proposta%20de%20servi%C3%A7os%20com%20a%20RACHI%20Human%20Capital." target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 border border-white/20 text-white font-semibold text-sm transition">
                            <i data-lucide="message-circle" class="w-4 h-4 text-emerald-400"></i>
                            <span>WhatsApp Direto</span>
                        </a>
                    </div>
                </div>
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
                    <!-- Footer Logo Oficial RACHI Human Capital -->
                    <a href="/" class="inline-flex items-center gap-2.5 mb-4 group text-decoration-none">
                        <picture class="flex items-center">
                            <source srcset="/images/areas/rachi-human-capital.webp" type="image/webp">
                            <img src="/images/areas/rachi-human-capital.png" 
                                 onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-human-capital.png'" 
                                 alt="RACHI Human Capital" 
                                 class="h-8 w-auto object-contain filter drop-shadow-[0_0_4px_rgba(255,255,255,0.35)] group-hover:scale-105 transition-all">
                        </picture>
                        <span class="font-display font-bold text-base text-slate-900 dark:text-white">RACHI <span class="text-[#10b981]">Human Capital</span></span>
                    </a>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Serviços empresariais, recursos humanos, contabilidade e regularização documental com rigor institucional.
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#10b981] mb-3">Soluções RACHI</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/capital" class="hover:text-emerald-400 transition text-emerald-400 font-bold">01 RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-indigo-400 transition">02 RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-sky-400 transition">03 RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-400 transition">04 RACHI Print</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#10b981] mb-3">Navegação</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/" class="hover:text-slate-900 dark:hover:text-white transition">Portal RACHI</a></li>
                        <li><a href="#servicos-capital" class="hover:text-slate-900 dark:hover:text-white transition">Os nossos serviços</a></li>
                        <li><a href="/#sobre" class="hover:text-slate-900 dark:hover:text-white transition">Sobre a RACHI</a></li>
                        <li><a href="/contacto" class="hover:text-slate-900 dark:hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#10b981] mb-3">Contacto</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Luanda — Angola</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2">Consultoria presencial e suporte corporativo contínuo.</p>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-800/80 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 dark:text-slate-400 gap-4">
                <div>&copy; 2026 <strong class="text-slate-900 dark:text-white">RACHI Human Capital</strong>. Todos os direitos reservados.</div>
                <div class="flex gap-4">
                    <span class="text-[#10b981] font-bold">PT</span>
                    <span class="text-slate-600">|</span>
                    <span>EN</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
<script src="/worker-public.js"></script></body>
</html>