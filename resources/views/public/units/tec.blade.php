<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Tec — Digitalização, Sistemas de Gestão, Websites &amp; Transformação Digital</title>
    <meta name="description" content="RACHI Tec — Digitalização, sistemas de gestão, websites, transformação digital e suporte técnico especializado em Angola.">

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

        /* DUAL THEME HEADER (Dark at top -> Crisp on scroll) */
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
            background: rgba(0, 163, 224, 0.2);
            border: 1px solid rgba(0, 163, 224, 0.4);
            box-shadow: 0 2px 8px rgba(0, 163, 224, 0.2);
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
            color: #0077c2 !important; background: rgba(0, 163, 224, 0.08);
        }
        .site-header.header-scrolled-light .main-nav-capsule .nav-link.active {
            color: #0077c2 !important;
            background: rgba(0, 163, 224, 0.12);
            border: 1px solid rgba(0, 163, 224, 0.3);
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
        .btn-cta-blue {
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
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
            box-shadow: 0 4px 15px rgba(0, 163, 224, 0.35);
        }
        .btn-cta-blue:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 22px rgba(0, 163, 224, 0.45);
            background: linear-gradient(135deg, #0092c8 0%, #0065a5 100%);
            color: #ffffff;
        }

        /* Card Service Hover Effects */
        .service-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-col: justify-between;
        }
        .service-card:hover {
            transform: translateY(-6px);
        }

        /* Hover Accents Individualized per Service */
        .card-accent-sky:hover {
            border-color: #00a3e0 !important;
            box-shadow: 0 20px 35px -10px rgba(0, 163, 224, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-indigo:hover {
            border-color: #6366f1 !important;
            box-shadow: 0 20px 35px -10px rgba(99, 102, 241, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-amber:hover {
            border-color: #f59e0b !important;
            box-shadow: 0 20px 35px -10px rgba(245, 158, 11, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-emerald:hover {
            border-color: #10b981 !important;
            box-shadow: 0 20px 35px -10px rgba(16, 185, 129, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        .card-accent-cyan:hover {
            border-color: #06b6d4 !important;
            box-shadow: 0 20px 35px -10px rgba(6, 182, 212, 0.22), 0 2px 8px rgba(0, 0, 0, 0.04);
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
        .badge-cat-sky     { background-color: #f0f9ff; color: #0284c7; border-color: #bae6fd; }
        .badge-cat-indigo  { background-color: #eef2ff; color: #4f46e5; border-color: #c7d2fe; }
        .badge-cat-amber   { background-color: #fffbeb; color: #b45309; border-color: #fde68a; }
        .badge-cat-emerald { background-color: #ecfdf5; color: #047857; border-color: #a7f3d0; }
        .badge-cat-cyan    { background-color: #ecfeff; color: #0e7490; border-color: #a5f3fc; }

        html.dark .badge-cat-sky     { background-color: rgba(2, 132, 199, 0.4); color: #38bdf8; border-color: rgba(56, 189, 248, 0.3); }
        html.dark .badge-cat-indigo  { background-color: rgba(79, 70, 229, 0.4); color: #818cf8; border-color: rgba(129, 140, 248, 0.3); }
        html.dark .badge-cat-amber   { background-color: rgba(180, 83, 9, 0.4); color: #fbbf24; border-color: rgba(251, 191, 36, 0.3); }
        html.dark .badge-cat-emerald { background-color: rgba(6, 78, 59, 0.4); color: #34d399; border-color: rgba(52, 211, 153, 0.3); }
        html.dark .badge-cat-cyan    { background-color: rgba(14, 116, 144, 0.4); color: #22d3ee; border-color: rgba(34, 211, 238, 0.3); }

        /* Bullets */
        .card-bullet {
            width: 1.25rem;
            height: 1.25rem;
            border-radius: 9999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            font-weight: 700;
            flex-shrink: 0;
        }
        .bullet-sky     { background-color: #e0f2fe; color: #0284c7; }
        .bullet-indigo  { background-color: #e0e7ff; color: #4f46e5; }
        .bullet-amber   { background-color: #fef3c7; color: #d97706; }
        .bullet-emerald { background-color: #d1fae5; color: #059669; }
        .bullet-cyan    { background-color: #cffafe; color: #0891b2; }

        html.dark .bullet-sky     { background-color: rgba(2, 132, 199, 0.35); color: #38bdf8; }
        html.dark .bullet-indigo  { background-color: rgba(79, 70, 229, 0.35); color: #818cf8; }
        html.dark .bullet-amber   { background-color: rgba(217, 119, 6, 0.35); color: #fbbf24; }
        html.dark .bullet-emerald { background-color: rgba(5, 150, 105, 0.35); color: #34d399; }
        html.dark .bullet-cyan    { background-color: rgba(8, 145, 178, 0.35); color: #22d3ee; }

        /* Suporte Dark Mode & Light Mode RACHI Tec */
        html.dark body {
            background-color: #030814 !important;
            color: #f8fafc !important;
        }
        
        /* Breadcrumbs bar */
        .breadcrumb-nav-bar {
            background-color: #f1f5f9;
            border-bottom: 1px solid #e2e8f0;
            color: #475569;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        html.dark .breadcrumb-nav-bar {
            background-color: #030d1c !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            color: #94a3b8 !important;
        }

        /* Hero Carousel Aspect Ratio */
        .hero-carousel-container {
            position: relative;
            width: 100%;
            aspect-ratio: 2048 / 710;
            overflow: hidden;
            background-color: #030d1c;
        }
        @supports not (aspect-ratio: 2048 / 710) {
            .hero-carousel-container {
                padding-top: 34.66%;
            }
        }

        /* 4 Feature Cards Strip */
        .feature-cards-strip {
            background-color: #ffffff;
            border-top: 1px solid #e2e8f0;
            border-bottom: 1px solid #e2e8f0;
            transition: background-color 0.3s ease, border-color 0.3s ease;
        }
        html.dark .feature-cards-strip {
            background-color: #071326 !important;
            border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        .feature-card-title {
            color: #0f172a;
            transition: color 0.3s ease;
        }
        html.dark .feature-card-title {
            color: #ffffff !important;
        }
        .feature-card-desc {
            color: #64748b;
            transition: color 0.3s ease;
        }
        html.dark .feature-card-desc {
            color: #94a3b8 !important;
        }
        .feature-card-divider {
            border-color: #e2e8f0;
        }
        html.dark .feature-card-divider {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }

        /* Services Section */
        html.dark #servicos-tec {
            background-color: #030814 !important;
        }
        html.dark #servicos-tec h2 {
            color: #ffffff !important;
        }
        html.dark #servicos-tec p {
            color: #94a3b8 !important;
        }
        html.dark .tag-services-pill {
            background-color: rgba(0, 163, 224, 0.15) !important;
            border-color: rgba(0, 163, 224, 0.35) !important;
            color: #38bdf8 !important;
        }
        html.dark .badge-trust-emerald {
            background-color: rgba(6, 78, 59, 0.4) !important;
            color: #34d399 !important;
            border-color: rgba(52, 211, 153, 0.3) !important;
        }
        html.dark .badge-trust-amber {
            background-color: rgba(180, 83, 9, 0.4) !important;
            color: #fbbf24 !important;
            border-color: rgba(251, 191, 36, 0.3) !important;
        }
        html.dark .badge-trust-sky {
            background-color: rgba(2, 132, 199, 0.4) !important;
            color: #38bdf8 !important;
            border-color: rgba(56, 189, 248, 0.3) !important;
        }

        html.dark .service-card {
            background: #071326 !important;
            border-color: rgba(255, 255, 255, 0.08) !important;
            color: #f8fafc !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4) !important;
        }
        html.dark .card-accent-sky:hover {
            border-color: #00a3e0 !important;
            box-shadow: 0 20px 45px -10px rgba(0, 163, 224, 0.35), 0 0 25px rgba(0, 163, 224, 0.15) !important;
        }
        html.dark .card-accent-indigo:hover {
            border-color: #818cf8 !important;
            box-shadow: 0 20px 45px -10px rgba(99, 102, 241, 0.35), 0 0 25px rgba(99, 102, 241, 0.15) !important;
        }
        html.dark .card-accent-amber:hover {
            border-color: #f59e0b !important;
            box-shadow: 0 20px 45px -10px rgba(245, 158, 11, 0.35), 0 0 25px rgba(245, 158, 11, 0.15) !important;
        }
        html.dark .card-accent-emerald:hover {
            border-color: #10b981 !important;
            box-shadow: 0 20px 45px -10px rgba(16, 185, 129, 0.35), 0 0 25px rgba(16, 185, 129, 0.15) !important;
        }
        html.dark .card-accent-cyan:hover {
            border-color: #06b6d4 !important;
            box-shadow: 0 20px 45px -10px rgba(6, 182, 212, 0.35), 0 0 25px rgba(6, 182, 212, 0.15) !important;
        }
        html.dark .service-card h3 {
            color: #ffffff !important;
        }
        html.dark .service-card p {
            color: #94a3b8 !important;
        }
        html.dark .service-card .text-slate-700 {
            color: #cbd5e1 !important;
        }
        html.dark .service-card .border-slate-100 {
            border-color: rgba(255, 255, 255, 0.08) !important;
        }
    </style>

</head>
<body x-data="{ mobileMenuOpen: false }">

    <!-- ============================================================ -->
    <!-- DUAL THEME HEADER (Dark top -> Light scrolled)               -->
    <!-- ============================================================ -->
    <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-5 lg:py-6 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- Brand Logo Oficial RACHI Tec -->
            <a href="/" class="flex items-center gap-3 group text-decoration-none" title="Ir para a página inicial (Portal RACHI)">
                <div class="h-12 px-2 py-1 rounded-xl bg-white/[0.08] border border-white/10 group-hover:border-sky-400/40 flex items-center justify-center transition-all duration-200 group-hover:scale-105 shadow-sm">
                    <picture class="flex items-center">
                        <source srcset="/images/areas/rachi-tec.webp" type="image/webp">
                        <img src="/images/areas/rachi-tec.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-tec.png'" 
                             alt="RACHI Tec" 
                             class="h-10 w-auto object-contain filter drop-shadow-[0_0_6px_rgba(255,255,255,0.35)]">
                    </picture>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-black text-lg tracking-wider text-white brand-logo-text flex items-center gap-1.5 transition-colors">
                        RACHI <span class="text-[#00a3e0] text-xs font-bold px-2 py-0.5 rounded-full bg-sky-500/10 border border-sky-500/20">TEC</span>
                    </span>
                    <span class="text-[10px] text-slate-400 tracking-widest uppercase font-medium">Tecnologia &amp; Sistemas</span>
                </div>
            </a>

            <!-- Main Navigation -->
            <nav class="hidden lg:flex items-center main-nav-capsule">
                <a href="/" class="nav-link cursor-pointer">
                    <span>Home</span>
                </a>
                
                <!-- Soluções Dropdown -->
                <div class="relative" x-data="{ openSol: false }" @mouseleave="openSol = false">
                    <button @mouseover="openSol = true" @click="openSol = !openSol" class="nav-link flex items-center gap-1.5 focus:outline-none active">
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

                <a href="#servicos-tec" class="nav-link">
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

                <a href="/contacto" class="btn-cta-blue group">
                    <i data-lucide="cpu" class="w-4 h-4"></i>
                    <span>Consultoria TI</span>
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
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak class="header-dropdown lg:hidden bg-[#071326]/98 backdrop-blur-2xl border-t border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">
            <a href="/" class="block font-medium py-1.5 text-white hover:text-[#00a3e0]">Home</a>
            <div class="border-t border-white/10 pt-2">
                <span class="text-xs uppercase font-bold text-[#00a3e0] tracking-wider">Soluções</span>
                <div class="pl-3 mt-1 space-y-1.5">
                    <a href="/capital" class="block text-sm text-slate-400 hover:text-emerald-400">01 RACHI Human Capital</a>
                    <a href="/academy" class="block text-sm text-slate-400 hover:text-indigo-400">02 RACHI Academy</a>
                    <a href="/tec" class="block text-sm text-sky-400 font-bold">03 RACHI Tec</a>
                    <a href="/print" class="block text-sm text-slate-400 hover:text-amber-400">04 RACHI Print</a>
                </div>
            </div>
            <div class="border-t border-white/10 pt-2 space-y-1">
                <a href="#servicos-tec" @click="mobileMenuOpen = false" class="block font-medium py-1 text-slate-300 hover:text-white">Os nossos serviços</a>
                <a href="/contacto" class="block font-medium py-1 text-[#00a3e0] font-bold">Pedir Proposta / Contacto</a>
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
        <!-- 1. HERO BANNER: RACHI TEC — TECNOLOGIA PARA CRESCER     -->
        <!-- ======================================================== -->
        <!-- Breadcrumbs Navigation Bar (Theme Adaptive) -->
        <div class="breadcrumb-nav-bar py-3 px-4 sm:px-6 lg:px-8">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <nav class="flex items-center gap-2 text-xs font-medium">
                    <a href="/" class="hover:text-sky-500 transition cursor-pointer">Início</a>
                    <span class="opacity-50">/</span>
                    <span class="opacity-70">Soluções</span>
                    <span class="opacity-50">/</span>
                    <span class="text-[#00a3e0] font-bold">RACHI Tec</span>
                </nav>
                <div class="hidden sm:inline-flex items-center gap-2 text-[11px] font-semibold opacity-85">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                    <span>Loja Oficial &amp; Soluções Corporativas</span>
                </div>
            </div>
        </div>

        <!-- ======================================================== -->
        <!-- 1. HERO CAROUSEL: SLIDE 1 & SLIDE 2 (LIGHT & DARK MODES)-->
        <!-- ======================================================== -->
        <section id="tec-hero-carousel" class="relative w-full bg-[#030d1c] overflow-hidden select-none"
                 x-data="{
                     currentSlide: 0,
                     totalSlides: 2,
                     autoplayTimer: null,
                     startAutoplay() {
                         this.stopAutoplay();
                         this.autoplayTimer = setInterval(() => {
                             this.nextSlide();
                         }, 6000);
                     },
                     stopAutoplay() {
                         if (this.autoplayTimer) clearInterval(this.autoplayTimer);
                     },
                     nextSlide() {
                         this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
                     },
                     prevSlide() {
                         this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
                     },
                     goToSlide(index) {
                         this.currentSlide = index;
                     }
                 }"
                 x-init="startAutoplay()"
                 @mouseenter="stopAutoplay()"
                 @mouseleave="startAutoplay()">

            <!-- 2048 x 710 Aspect Ratio Container -->
            <div class="hero-carousel-container w-full" style="aspect-ratio: 2048 / 710;">
                
                <!-- ============================================== -->
                <!-- SLIDE 1: TECNOLOGIA PARA CRESCER (LOJA TEC)    -->
                <!-- ============================================== -->
                <div x-show="currentSlide === 0"
                     x-transition:enter="transition-opacity duration-700 ease-in-out"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-700 ease-in-out"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="absolute inset-0 w-full h-full">
                    
                    <!-- Dark Mode Artwork (Default & Dark) -->
                    <img src="{{ asset('images/tec-hero-banner@2x.png') }}"
                         alt="TECNOLOGIA PARA CRESCER — AS MELHORES SOLUÇÕES PASSAM PELA RACHI TEC"
                         class="w-full h-full object-cover hidden dark:block select-none pointer-events-none">
                    
                    <!-- Light Mode Artwork -->
                    <img src="{{ asset('images/tec-hero-banner-light@2x.png') }}"
                         alt="TECNOLOGIA PARA CRESCER — AS MELHORES SOLUÇÕES PASSAM PELA RACHI TEC"
                         class="w-full h-full object-cover block dark:hidden select-none pointer-events-none">

                    <!-- Hotspot: VER LOJA RACHI TEC -->
                    <a href="/loja"
                       class="absolute z-20 group rounded-2xl transition-all duration-200 hover:scale-[1.02] active:scale-95 cursor-pointer"
                       style="left: 8.0%; top: 82.6%; width: 15.1%; height: 8.0%; outline: none !important; border: none !important; box-shadow: none !important; -webkit-tap-highlight-color: transparent;"
                       title="Explorar Loja RACHI Tec"
                       aria-label="Ver Loja RACHI Tec">
                        <span class="absolute inset-0 rounded-2xl transition-all duration-300 group-hover:shadow-[0_0_25px_rgba(212,238,48,0.7)] pointer-events-none"></span>
                    </a>
                </div>

                <!-- ============================================== -->
                <!-- SLIDE 2: TRANSFORMAÇÃO DIGITAL & ERP (SOLUÇÕES)-->
                <!-- ============================================== -->
                <div x-show="currentSlide === 1"
                     x-transition:enter="transition-opacity duration-700 ease-in-out"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition-opacity duration-700 ease-in-out"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     x-cloak
                     class="absolute inset-0 w-full h-full">
                    
                    <!-- Dark Mode Artwork -->
                    <img src="{{ asset('images/tec-hero-banner-slide2@2x.png') }}"
                         alt="TRANSFORMAÇÃO DIGITAL & ERP — SOLUÇÕES SOB MEDIDA PARA EMPRESAS"
                         class="w-full h-full object-cover hidden dark:block select-none pointer-events-none">
                    
                    <!-- Light Mode Artwork -->
                    <img src="{{ asset('images/tec-hero-banner-slide2-light@2x.png') }}"
                         alt="TRANSFORMAÇÃO DIGITAL & ERP — SOLUÇÕES SOB MEDIDA PARA EMPRESAS"
                         class="w-full h-full object-cover block dark:hidden select-none pointer-events-none">

                    <!-- Hotspot 1: PEDIR PROPOSTA DE TI -->
                    <a href="/contacto"
                       class="absolute z-20 group rounded-2xl transition-all duration-200 hover:scale-[1.02] active:scale-95 cursor-pointer"
                       style="left: 51.7%; top: 68.3%; width: 16.8%; height: 8.2%; outline: none !important; border: none !important; box-shadow: none !important; -webkit-tap-highlight-color: transparent;"
                       title="Pedir Proposta de TI"
                       aria-label="Pedir Proposta de TI">
                        <span class="absolute inset-0 rounded-2xl transition-all duration-300 group-hover:shadow-[0_0_25px_rgba(0,163,224,0.7)] pointer-events-none"></span>
                    </a>

                    <!-- Hotspot 2: VER OS SERVIÇOS -->
                    <a href="#servicos-tec"
                       class="absolute z-20 group rounded-2xl transition-all duration-200 hover:scale-[1.02] active:scale-95 cursor-pointer"
                       style="left: 69.8%; top: 68.3%; width: 14.2%; height: 8.2%; outline: none !important; border: none !important; box-shadow: none !important; -webkit-tap-highlight-color: transparent;"
                       title="Ver Serviços de Tecnologia"
                       aria-label="Ver Serviços">
                        <span class="absolute inset-0 rounded-2xl transition-all duration-300 group-hover:shadow-[0_0_20px_rgba(255,255,255,0.4)] pointer-events-none"></span>
                    </a>
                </div>

                <!-- ============================================== -->
                <!-- SHARED INTERACTIVE CONTROLS OVER ARTWORK       -->
                <!-- ============================================== -->
                <!-- Bottom Pagination Hotspot Clickers -->
                <div class="absolute z-25 flex items-center gap-2 cursor-pointer"
                     style="left: 46.5%; top: 93.6%; height: 3.0%;">
                    <!-- Slide 1 Indicator -->
                    <button type="button" 
                            @click="goToSlide(0)" 
                            class="h-full px-2 flex items-center justify-center cursor-pointer transition-transform hover:scale-125 focus:outline-none"
                            title="Slide 1: Loja e Equipamentos"
                            aria-label="Ir para Slide 1">
                        <span class="h-2 rounded-full transition-all duration-300"
                              :class="currentSlide === 0 ? 'bg-[#f5a800] w-8 shadow-sm' : 'bg-slate-400/50 hover:bg-slate-300 w-2.5'"></span>
                    </button>
                    <!-- Slide 2 Indicator -->
                    <button type="button" 
                            @click="goToSlide(1)" 
                            class="h-full px-2 flex items-center justify-center cursor-pointer transition-transform hover:scale-125 focus:outline-none"
                            title="Slide 2: Transformação Digital & ERP"
                            aria-label="Ir para Slide 2">
                        <span class="h-2 rounded-full transition-all duration-300"
                              :class="currentSlide === 1 ? 'bg-[#f5a800] w-8 shadow-sm' : 'bg-slate-400/50 hover:bg-slate-300 w-2.5'"></span>
                    </button>
                </div>

                <!-- Bottom Right Arrow Hotspots -->
                <button type="button" 
                        @click="prevSlide()"
                        class="absolute z-25 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-125 active:scale-95 cursor-pointer focus:outline-none"
                        style="left: 95.4%; top: 93.6%; width: 2.1%; aspect-ratio: 1; outline: none !important; -webkit-tap-highlight-color: transparent;"
                        title="Slide Anterior"
                        aria-label="Slide Anterior">
                    <span class="sr-only">Anterior</span>
                </button>
                <button type="button" 
                        @click="nextSlide()"
                        class="absolute z-25 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-125 active:scale-95 cursor-pointer focus:outline-none"
                        style="left: 97.1%; top: 93.6%; width: 2.1%; aspect-ratio: 1; outline: none !important; -webkit-tap-highlight-color: transparent;"
                        title="Próximo Slide"
                        aria-label="Próximo Slide">
                    <span class="sr-only">Próximo</span>
                </button>

            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 4 FEATURE CARDS: Suporte, Instalação, Entrega, Garantia -->
        <!-- ======================================================== -->
        <section class="feature-cards-strip w-full shadow-xs">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-5 sm:py-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 divide-y sm:divide-y-0 sm:divide-x feature-card-divider">
                    
                    <!-- 1. Suporte Técnico -->
                    <div class="flex items-center gap-4 px-4 sm:px-6 py-3.5 sm:py-2 group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105"
                             style="background-color: #d97706;">
                            <span style="display: block; width: 14px; height: 14px; border-radius: 9999px; border: 2.5px solid #ffffff;"></span>
                        </div>
                        <div class="min-w-0">
                            <div class="font-extrabold text-[15px] sm:text-base leading-tight font-heading feature-card-title">
                                Suporte Técnico
                            </div>
                            <div class="text-xs mt-1 truncate feature-card-desc">
                                Equipa RACHI Tec dedicada
                            </div>
                        </div>
                    </div>

                    <!-- 2. Instalação Incluída -->
                    <div class="flex items-center gap-4 px-4 sm:px-6 py-3.5 sm:py-2 group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105"
                             style="background-color: #00a3e0;">
                            <span style="display: block; width: 14px; height: 14px; border-radius: 9999px; border: 2.5px solid #ffffff;"></span>
                        </div>
                        <div class="min-w-0">
                            <div class="font-extrabold text-[15px] sm:text-base leading-tight font-heading feature-card-title">
                                Instalação Incluída
                            </div>
                            <div class="text-xs mt-1 truncate feature-card-desc">
                                Configuração no local
                            </div>
                        </div>
                    </div>

                    <!-- 3. Entrega em Luanda -->
                    <div class="flex items-center gap-4 px-4 sm:px-6 py-3.5 sm:py-2 group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105"
                             style="background-color: #d90466;">
                            <span style="display: block; width: 14px; height: 14px; border-radius: 9999px; border: 2.5px solid #ffffff;"></span>
                        </div>
                        <div class="min-w-0">
                            <div class="font-extrabold text-[15px] sm:text-base leading-tight font-heading feature-card-title">
                                Entrega em Luanda
                            </div>
                            <div class="text-xs mt-1 truncate feature-card-desc">
                                Em dias úteis
                            </div>
                        </div>
                    </div>

                    <!-- 4. Garantia RACHI -->
                    <div class="flex items-center gap-4 px-4 sm:px-6 py-3.5 sm:py-2 group">
                        <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform duration-300 group-hover:scale-105"
                             style="background-color: #16a34a;">
                            <span style="display: block; width: 14px; height: 14px; border-radius: 9999px; border: 2.5px solid #ffffff;"></span>
                        </div>
                        <div class="min-w-0">
                            <div class="font-extrabold text-[15px] sm:text-base leading-tight font-heading feature-card-title">
                                Garantia RACHI
                            </div>
                            <div class="text-xs mt-1 truncate feature-card-desc">
                                Assistência pós-venda
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 2. OS NOSSOS SERVIÇOS (As 5 Soluções Especializadas)    -->
        <!-- ======================================================== -->
        <section id="servicos-tec" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="tag-services-pill text-[#00a3e0] font-bold text-xs uppercase tracking-widest bg-sky-50 px-3.5 py-1.5 rounded-full border border-sky-200">
                    Os nossos serviços
                </span>
                
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 mt-4 tracking-tight">
                    Escolha o serviço ideal para impulsionar o seu negócio
                </h2>

                <p class="text-slate-600 text-base sm:text-lg mt-3.5 leading-relaxed">
                    Soluções completas e especializadas para apoiar todas as etapas da sua empresa.
                </p>

                <!-- 3 Badges de Destaque -->
                <div class="flex flex-wrap items-center justify-center gap-3 mt-6">
                    <span class="badge-trust-emerald inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-50 text-emerald-800 text-xs font-bold border border-emerald-200">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                        Segurança Garantida
                    </span>
                    <span class="badge-trust-amber inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-50 text-amber-800 text-xs font-bold border border-amber-200">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-amber-600"></i>
                        Processo Rápido
                    </span>
                    <span class="badge-trust-sky inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-sky-50 text-sky-800 text-xs font-bold border border-sky-200">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-sky-600"></i>
                        Suporte Especializado
                </div>
            </div>

            <!-- Grade de Serviços (5 Serviços Oficiais com Imagens e Personagens RACHI) -->
            <!-- Linha 1: 3 Serviços -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-stretch">

                <!-- SERVIÇO 1: Consultoria em transformação digital -->
                <a href="{{ route('tec.service.show', 'consultoria-transformacao-digital') }}" class="service-card card-accent-sky group text-decoration-none">
                    <div>
                        <!-- Imagem Oficial do Serviço com Logótipo RACHI no Fundo -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-consultoria-transformacao-digital.jpg') }}" alt="Consultoria em transformação digital" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-sky absolute top-3 right-3 shadow-md backdrop-blur-md">
                                01 • Estratégia
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-[#00a3e0] transition-colors">
                            Consultoria em transformação digital
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Apoio estratégico para modernizar a empresa com tecnologia, processos e cultura digital.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-sky">✓</span>
                                <span>Roteiro de transformação</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-sky">✓</span>
                                <span>Priorização de investimentos</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-sky">✓</span>
                                <span>Acompanhamento da implementação</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">120.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">projeto base</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-[#00a3e0] group-hover:shadow-lg group-hover:shadow-sky-500/25">
                            <span>Ver Detalhes &amp; Aderir</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

                <!-- SERVIÇO 2: Criação de websites -->
                <a href="{{ route('tec.service.show', 'criacao-websites') }}" class="service-card card-accent-indigo group text-decoration-none">
                    <div>
                        <!-- Imagem Oficial do Serviço com Logótipo RACHI no Fundo -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-criacao-websites.jpg') }}" alt="Criação de websites" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-indigo absolute top-3 right-3 shadow-md backdrop-blur-md">
                                02 • Presença Online
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-indigo-500 transition-colors">
                            Criação de websites
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Desenvolvimento de websites institucionais, páginas comerciais e lojas online responsivas.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-indigo">✓</span>
                                <span>Design moderno e responsivo</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-indigo">✓</span>
                                <span>SEO e performance</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-indigo">✓</span>
                                <span>Gestão de conteúdos simples</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">95.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">taxa única</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-[#6366f1] group-hover:shadow-lg group-hover:shadow-indigo-500/25">
                            <span>Ver Detalhes &amp; Aderir</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

                <!-- SERVIÇO 3: Digitalização de processos empresariais -->
                <a href="{{ route('tec.service.show', 'digitalizacao-processos') }}" class="service-card card-accent-amber group text-decoration-none">
                    <div>
                        <!-- Imagem Oficial do Serviço com Logótipo RACHI no Fundo -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-digitalizacao-processos.jpg') }}" alt="Digitalização de processos empresariais" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-amber absolute top-3 right-3 shadow-md backdrop-blur-md">
                                03 • Automação
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-amber-500 transition-colors">
                            Digitalização de processos empresariais
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Mapeamos e digitalizamos processos internos para reduzir papel, erros e tempos de operação.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-amber">✓</span>
                                <span>Diagnóstico de processos</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-amber">✓</span>
                                <span>Automação de fluxos</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-amber">✓</span>
                                <span>Ganho de eficiência operacional</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">140.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">projeto base</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-[#f59e0b] group-hover:shadow-lg group-hover:shadow-amber-500/25">
                            <span>Ver Detalhes &amp; Aderir</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

            </div>

            <!-- Linha 2: 2 Serviços Centralizados e Harmonizados -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto mt-8 items-stretch">

                <!-- SERVIÇO 4: Implementação de sistemas de gestão -->
                <a href="{{ route('tec.service.show', 'implementacao-sistemas-gestao') }}" class="service-card card-accent-emerald group text-decoration-none">
                    <div>
                        <!-- Imagem Oficial do Serviço com Logótipo RACHI no Fundo -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-implementacao-sistemas-gestao.jpg') }}" alt="Implementação de sistemas de gestão" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-emerald absolute top-3 right-3 shadow-md backdrop-blur-md">
                                04 • ERP &amp; Gestão
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-emerald-500 transition-colors">
                            Implementação de sistemas de gestão
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Implementação e configuração de sistemas de gestão adaptados à realidade da sua empresa.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-emerald">✓</span>
                                <span>Sistemas sob medida</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-emerald">✓</span>
                                <span>Integração com processos actuais</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-emerald">✓</span>
                                <span>Formação da equipa utilizadora</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">160.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">implantação base</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-[#10b981] group-hover:shadow-lg group-hover:shadow-emerald-500/25">
                            <span>Ver Detalhes &amp; Aderir</span>
                            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform duration-300 group-hover:translate-x-1.5"></i>
                        </div>
                    </div>
                </a>

                <!-- SERVIÇO 5: Suporte técnico especializado -->
                <a href="{{ route('tec.service.show', 'suporte-tecnico-especializado') }}" class="service-card card-accent-cyan group text-decoration-none">
                    <div>
                        <!-- Imagem Oficial do Serviço com Logótipo RACHI no Fundo -->
                        <div class="relative w-full h-48 rounded-2xl overflow-hidden mb-5 bg-slate-100 dark:bg-slate-800 border border-slate-200/60 dark:border-slate-800/80 shadow-xs">
                            <img src="{{ asset('images/services/service-suporte-tecnico-especializado.jpg') }}" alt="Suporte técnico especializado" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 via-transparent to-transparent"></div>
                            <span class="badge-category badge-cat-cyan absolute top-3 right-3 shadow-md backdrop-blur-md">
                                05 • Helpdesk &amp; Manutenção
                            </span>
                        </div>

                        <h3 class="text-xl font-black text-slate-900 dark:text-white tracking-tight leading-snug group-hover:text-cyan-500 transition-colors">
                            Suporte técnico especializado
                        </h3>

                        <p class="text-slate-600 dark:text-slate-400 text-xs sm:text-sm mt-2 leading-relaxed min-h-[44px]">
                            Assistência técnica contínua a sistemas, equipamentos e utilizadores para manter a operação estável.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 dark:border-slate-800/80 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-cyan">✓</span>
                                <span>Atendimento remoto e presencial</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-cyan">✓</span>
                                <span>Manutenção preventiva e corretiva</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 dark:text-slate-300 font-medium">
                                <span class="card-bullet bullet-cyan">✓</span>
                                <span>Segurança e cópias de segurança</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 pt-4 border-t border-slate-100 dark:border-slate-800/80">
                        <div class="flex items-baseline justify-between mb-3.5">
                            <span class="text-[11px] font-semibold text-slate-400 dark:text-slate-500 uppercase tracking-wider">A partir de</span>
                            <div class="text-right">
                                <span class="text-xl font-black text-slate-900 dark:text-white">75.000 Kz</span>
                                <span class="text-[11px] text-slate-500 dark:text-slate-400 font-medium">/ mês</span>
                            </div>
                        </div>

                        <div class="w-full py-3 px-4 rounded-xl bg-slate-900 dark:bg-slate-800 text-white font-bold text-xs transition-all duration-300 flex items-center justify-center gap-2 group-hover:bg-[#06b6d4] group-hover:shadow-lg group-hover:shadow-cyan-500/25">
                            <span>Ver Detalhes &amp; Aderir</span>
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
            <div class="relative rounded-3xl p-10 sm:p-14 bg-gradient-to-br from-[#071326] via-[#0d1f3d] to-[#071326] border border-sky-500/30 overflow-hidden shadow-2xl text-center text-white">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] px-3.5 py-1.5 rounded-full bg-sky-500/15 border border-sky-500/30">
                        Modernização Tecnológica
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white">
                        Pronto para transformar digitalmente a sua empresa?
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Converse com a equipa de engenheiros e consultores da RACHI Tec e receba um plano estruturado para modernizar sistemas, processos e presença online.
                    </p>
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="/contacto" class="btn-cta-blue text-sm px-6 py-3.5">
                            <i data-lucide="mail" class="w-4 h-4"></i>
                            <span>Falar Connosco / Pedir Proposta</span>
                        </a>
                        <a href="https://wa.me/244923000000?text=Ol%C3%A1!%20Gostaria%20de%20solicitar%20uma%20proposta%20de%20tecnologia%20com%20a%20RACHI%20Tec." target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 border border-white/20 text-white font-semibold text-sm transition">
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
    <footer class="bg-[#071326] text-white pt-16 pb-8 border-t border-slate-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <!-- Footer Logo Oficial RACHI Tec -->
                    <a href="/" class="inline-flex items-center gap-2.5 mb-4 group text-decoration-none">
                        <picture class="flex items-center">
                            <source srcset="/images/areas/rachi-tec.webp" type="image/webp">
                            <img src="/images/areas/rachi-tec.png" 
                                 onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-tec.png'" 
                                 alt="RACHI Tec" 
                                 class="h-8 w-auto object-contain filter drop-shadow-[0_0_4px_rgba(255,255,255,0.35)] group-hover:scale-105 transition-all">
                        </picture>
                        <span class="font-display font-bold text-base text-white">RACHI <span class="text-[#00a3e0]">Tec</span></span>
                    </a>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Digitalização, sistemas de gestão, websites, transformação digital e suporte técnico de padrão corporativo.
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#00a3e0] mb-3">Soluções RACHI</h4>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li><a href="/capital" class="hover:text-emerald-400 transition">01 RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-indigo-400 transition">02 RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-sky-400 transition text-sky-400 font-bold">03 RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-400 transition">04 RACHI Print</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#00a3e0] mb-3">Navegação</h4>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li><a href="/" class="hover:text-white transition">Portal RACHI</a></li>
                        <li><a href="#servicos-tec" class="hover:text-white transition">Os nossos serviços</a></li>
                        <li><a href="/#sobre" class="hover:text-white transition">Sobre a RACHI</a></li>
                        <li><a href="/contacto" class="hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#00a3e0] mb-3">Contacto</h4>
                    <p class="text-xs text-slate-400">Luanda — Angola</p>
                    <p class="text-xs text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
                    <p class="text-xs text-slate-400 mt-2">Atendimento remoto e presencial para empresas.</p>
                </div>
            </div>
            <div class="border-t border-slate-800/80 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <div>&copy; 2026 <strong class="text-white">RACHI Tec</strong>. Todos os direitos reservados.</div>
                <div class="flex gap-4">
                    <span class="text-[#00a3e0] font-bold">PT</span>
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