<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service['title'] }} — RACHI Print (Gráfica &amp; Produção)</title>
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
            background-color: #080c16;
            color: #f8fafc;
        }

        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* HEADER */
        .site-header {
            position: fixed !important;
            top: 0 !important; left: 0 !important; right: 0 !important;
            z-index: 1030 !important;
            width: 100% !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
        .site-header.header-top-dark {
            background: rgba(8, 12, 22, 0.94) !important;
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
        }
        .site-header.header-top-dark .nav-link {
            color: #cbd5e1 !important;
            padding: 0.4rem 0.85rem;
            font-size: 0.8125rem;
            font-weight: 500;
            border-radius: 9999px;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .site-header.header-top-dark .nav-link:hover,
        .site-header.header-top-dark .nav-link.active {
            color: #f5a800 !important;
            background: rgba(245, 168, 0, 0.12) !important;
        }
        .site-header.header-scrolled-light {
            background: rgba(255, 255, 255, 0.96) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(226, 232, 240, 0.9) !important;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.08) !important;
        }
        .site-header.header-scrolled-light .main-nav-capsule {
            display: flex; align-items: center; gap: 0.25rem;
            background: rgba(15, 23, 42, 0.05);
            border: 1px solid rgba(15, 23, 42, 0.08);
            border-radius: 9999px; padding: 0.3rem 0.5rem;
        }
        .site-header.header-scrolled-light .nav-link {
            color: #334155 !important;
            padding: 0.4rem 0.85rem;
            font-size: 0.8125rem;
            font-weight: 500;
            border-radius: 9999px;
            transition: all 0.2s ease;
            text-decoration: none;
        }
        .site-header.header-scrolled-light .nav-link:hover,
        .site-header.header-scrolled-light .nav-link.active {
            color: #d97706 !important;
            background: rgba(245, 168, 0, 0.12) !important;
        }
        .site-header.header-scrolled-light .brand-logo-text {
            color: #0b1a2e !important;
        }

        .btn-cta-amber {
            background: linear-gradient(135deg, #f5a800 0%, #e08b00 100%);
            color: #080c16;
            font-weight: 700;
            border-radius: 9999px;
            padding: 0.5rem 1.25rem;
            font-size: 0.8125rem;
            box-shadow: 0 4px 15px rgba(245, 168, 0, 0.35);
            transition: all 0.2s ease;
            display: inline-flex; align-items: center; gap: 0.5rem;
            text-decoration: none;
        }
        .btn-cta-amber:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(245, 168, 0, 0.5);
            color: #050d1a;
        }

        .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 9999px;
            padding: 0.5rem;
            cursor: pointer;
            display: inline-flex; align-items: center; justify-content: center;
            transition: all 0.2s;
        }
        .site-header.header-scrolled-light .theme-toggle-btn {
            background: rgba(15, 23, 42, 0.05);
            border-color: rgba(15, 23, 42, 0.12);
        }
    
        /* LIGHT MODE HEADER ELEVATION */
        html:not(.dark) .site-header {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(15, 23, 42, 0.08) !important;
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.03) !important;
        }
        html:not(.dark) .site-header .main-nav-capsule {
            background: rgba(15, 23, 42, 0.04) !important;
            border: 1px solid rgba(15, 23, 42, 0.08) !important;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.03) !important;
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link {
            color: #1e293b !important;
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link:hover,
        html:not(.dark) .site-header .main-nav-capsule .nav-link.nav-link-open {
            color: #0050f0 !important;
            background: rgba(0, 80, 240, 0.07) !important;
        }
        html:not(.dark) .site-header .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, #0050f0 0%, #00a3e0 100%) !important;
            border: 1px solid rgba(0, 80, 240, 0.3) !important;
            box-shadow: 0 2px 10px rgba(0, 80, 240, 0.35) !important;
        }
        html:not(.dark) .site-header .brand-logo-text {
            color: #071326 !important;
        }
        html:not(.dark) .site-header .logo-container-box {
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
        }
        html:not(.dark) .site-header .mobile-menu-btn {
            color: #1e293b !important;
            background: rgba(15, 23, 42, 0.05) !important;
            border-color: rgba(15, 23, 42, 0.1) !important;
        }
        html:not(.dark) .site-header .header-dropdown {
            background: #ffffff !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12) !important;
        }
        html:not(.dark) .site-header .header-dropdown a {
            color: #334155 !important;
        }
        html:not(.dark) .site-header .header-dropdown a:hover {
            background-color: #f8fafc !important;
        }
        html:not(.dark) .site-header .theme-toggle-btn {
            background: #f1f5f9 !important;
            border-color: #e2e8f0 !important;
            color: #0f172a !important;
        }

    </style>
</head>
<body x-data="{ mobileMenuOpen: false, solutionsOpen: false, selectedPlan: '{{ $service['plans'][1]['name'] ?? $service['plans'][0]['name'] }}' }" class="antialiased selection:bg-amber-500 selection:text-white">

    <!-- ============================================================ -->
    <!-- DUAL THEME HEADER                                            -->
    <!-- ============================================================ -->
    <header id="main-site-header" class="site-header header-top-dark py-3.5 px-4 sm:px-6 lg:px-8 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- Brand Logo RACHI Print -->
            <a href="/print" class="flex items-center gap-3 group focus:outline-none">
                <div class="h-10 w-10 rounded-xl bg-gradient-to-br from-[#f5a800]/20 to-[#080c16] p-1.5 flex items-center justify-center border border-[#f5a800]/30 shadow-md group-hover:scale-105 transition-transform duration-300">
                    <picture>
                        <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                        <img src="/images/areas/rachi-print.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-print.png'" 
                             alt="RACHI Print" 
                             class="h-9 w-auto object-contain filter drop-shadow-[0_0_6px_rgba(255,255,255,0.35)]">
                    </picture>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-black text-lg tracking-wider text-slate-900 dark:text-white brand-logo-text flex items-center gap-1.5 transition-colors">
                        RACHI <span class="text-[#f5a800] text-xs font-bold px-2 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20">PRINT</span>
                    </span>
                    <span class="text-[10px] text-slate-500 dark:text-slate-400 tracking-widest uppercase font-medium">Gráfica &amp; Produção</span>
                </div>
            </a>

            <!-- Main Navigation -->
            <nav class="hidden lg:flex items-center main-nav-capsule">
                <a href="/" class="nav-link cursor-pointer">
                    <span>Home</span>
                </a>
                
                                                        <!-- Soluções (Mega Menu Ecossistema RACHI) -->
                                        <!-- Soluções (Mega Menu Ecossistema RACHI) -->
                    <button type="button"
                        id="solutions-nav-btn"
                        @click="solutionsOpen = !solutionsOpen"
                        class="nav-link solutions-nav-trigger relative flex items-center gap-1.5 focus:outline-none cursor-pointer transition-all duration-200"
                        :class="solutionsOpen ? 'text-[#0077c2] dark:text-white font-semibold' : ''">
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

                <a href="/print#servicos-print" class="nav-link active">
                    <span>Serviços Gráficos</span>
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
                <button type="button"
                    onclick="window.toggleRachiTheme()"
                    class="theme-toggle-btn"
                    aria-label="Alternar Modo Escuro / Claro"
                    title="Alternar Modo Escuro / Claro">
                    <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-slate-300 hover:text-white dark:hidden transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-amber-400 hover:text-amber-300 hidden dark:block transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                    </svg>
                </button>

                <a href="#solicitar" class="btn-cta-amber group">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    <span>Solicitar Cotação</span>
                </a>

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="mobile-menu-btn lg:hidden p-2 rounded-xl text-white hover:text-amber-400 focus:outline-none" aria-label="Menu Principal">
                    <svg width="22" height="22" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak class="header-dropdown lg:hidden bg-[#080c16]/98 backdrop-blur-2xl border-t border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">
            <a href="/" class="block font-medium py-1.5 text-white hover:text-amber-400">Home</a>
            <div class="border-t border-white/10 pt-2">
                <span class="text-xs uppercase font-bold text-amber-400 tracking-wider">Soluções</span>
                <div class="pl-3 mt-1 space-y-1.5">
                    <a href="/capital" class="block text-sm text-slate-400 hover:text-emerald-400">01 RACHI Human Capital</a>
                    <a href="/academy" class="block text-sm text-slate-400 hover:text-indigo-400">02 RACHI Academy</a>
                    <a href="/tec" class="block text-sm text-slate-400 hover:text-sky-400">03 RACHI Tec</a>
                    <a href="/print" class="block text-sm text-amber-400 font-bold">04 RACHI Print</a>
                </div>
            </div>
            <div class="border-t border-white/10 pt-2 space-y-1">
                <a href="/print#servicos-print" @click="mobileMenuOpen = false" class="block font-medium py-1 text-slate-300 hover:text-white">Os nossos serviços</a>
                <a href="/contacto" class="block font-medium py-1 text-amber-400 font-bold">Pedir Cotação / Contacto</a>
            </div>
        </div>
    </header>

    <!-- MEGA PAINEL DE SOLUÇÕES (ECOSSISTEMA RACHI) -->
    @include('components.solutions-mega-menu')


    <main class="pt-28 pb-16">

        <!-- ======================================================== -->
        <!-- BREADCRUMB                                               -->
        <!-- ======================================================== -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400 overflow-x-auto whitespace-nowrap">
                <a href="/" class="hover:text-amber-400 transition">Portal RACHI</a>
                <span class="text-slate-400">/</span>
                <a href="/print" class="hover:text-amber-400 transition">RACHI Print</a>
                <span class="text-slate-400">/</span>
                <a href="/print#servicos-print" class="hover:text-amber-400 transition">Serviços Gráficos</a>
                <span class="text-slate-400">/</span>
                <span class="text-slate-900 dark:text-white font-semibold truncate">{{ $service['title'] }}</span>
            </nav>
        </div>

        <!-- ======================================================== -->
        <!-- 1. HERO DO SERVIÇO                                       -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-10">
            <div class="relative rounded-3xl p-8 sm:p-12 lg:p-16 bg-gradient-to-br from-[#080c16] via-[#101a2f] to-[#080c16] border border-amber-500/25 overflow-hidden shadow-2xl text-white">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-amber-500/15 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-orange-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-8 space-y-6">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-xs font-bold uppercase tracking-widest text-amber-400 px-3.5 py-1.5 rounded-full bg-amber-500/15 border border-amber-500/30">
                                {{ $service['tag'] }}
                            </span>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-300 px-3 py-1 rounded-full bg-white/10 border border-white/15">
                                RACHI Print • Gráfica &amp; Produção
                            </span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                            {{ $service['title'] }}
                        </h1>

                        <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl">
                            {{ $service['full_desc'] }}
                        </p>

                        <!-- Destaques Rápidos: Prazo, Garantia, Preço Base -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-white/10">
                            <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10">
                                <div class="text-[11px] uppercase tracking-wider text-amber-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                    <span>Prazo de Produção</span>
                                </div>
                                <div class="font-bold text-sm text-white">{{ $service['prazo'] }}</div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10">
                                <div class="text-[11px] uppercase tracking-wider text-amber-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                    <span>Garantia de Qualidade</span>
                                </div>
                                <div class="font-bold text-sm text-white">{{ $service['garantia'] }}</div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10">
                                <div class="text-[11px] uppercase tracking-wider text-amber-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                                    <span>Investimento Base</span>
                                </div>
                                <div class="font-bold text-sm text-white">
                                    <strong class="text-xl text-[#f5a800]">{{ $service['starting_price'] }}</strong> 
                                    <span class="text-xs text-slate-300 font-normal">{{ $service['price_period'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação Imediata -->
                        <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
                            <a href="#solicitar" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-4 rounded-xl bg-gradient-to-r from-[#f5a800] to-[#e08b00] hover:from-[#e08b00] hover:to-[#c67a00] text-[#080c16] font-bold text-sm transition shadow-lg shadow-amber-500/25">
                                <i data-lucide="send" class="w-4 h-4"></i>
                                <span>Solicitar Proposta / Cotação</span>
                            </a>
                            <a href="https://wa.me/244972888585?text={{ urlencode($service['whatsapp_msg']) }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-sm transition shadow-lg shadow-green-500/20">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Falar no WhatsApp Directo</span>
                            </a>
                            <a href="/print#servicos-print" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-1 py-2">
                                <span>&larr; Voltar aos serviços Print</span>
                            </a>
                        </div>
                    </div>

                    <!-- Card Visual em Destaque -->
                    <div class="lg:col-span-4">
                        <div class="relative rounded-3xl overflow-hidden p-6 bg-gradient-to-b from-white/10 to-white/5 border border-white/15 backdrop-blur-xl shadow-2xl flex flex-col items-center text-center group">
                            @if(!empty($service['image']))
                                <div class="w-full h-64 sm:h-72 rounded-2xl overflow-hidden mb-6 relative border border-white/10 shadow-lg">
                                    <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                                    <div class="absolute bottom-3 left-3 right-3 flex items-center justify-between">
                                        <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-[#f5a800] text-[#080c16] shadow">Oficial RACHI</span>
                                        <span class="text-[11px] font-semibold text-white/90 drop-shadow">Qualidade Offset/Digital</span>
                                    </div>
                                </div>
                            @else
                                <div class="w-24 h-24 rounded-3xl bg-gradient-to-br from-[#f5a800] to-[#080c16] p-5 flex items-center justify-center shadow-xl border border-amber-400/30 mb-6 group-hover:scale-110 transition-transform">
                                    <i data-lucide="{{ $service['icon'] }}" class="w-12 h-12 text-white"></i>
                                </div>
                            @endif

                            <span class="text-xs font-bold text-amber-400 uppercase tracking-widest mb-1">Produção Certificada</span>
                            <h3 class="text-xl font-bold text-white mb-3">{{ $service['title'] }}</h3>
                            <p class="text-xs text-slate-300 leading-relaxed mb-6">
                                Maquinário de ponta, calibração densitométrica e papéis nobres para as principais empresas de Luanda e de Angola.
                            </p>

                            <div class="w-full py-3 px-4 rounded-2xl bg-white/[0.06] border border-white/10 flex items-center justify-between text-xs text-slate-200">
                                <span class="flex items-center gap-1.5 font-semibold">
                                    <i data-lucide="check-circle-2" class="w-4 h-4 text-[#f5a800]"></i>
                                    Prova de Cor Gratuita
                                </span>
                                <span class="text-[#f5a800] font-bold">100% Garantido</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 2. O QUE ESTÁ INCLUÍDO & ETAPAS DE EXECUÇÃO               -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- O Que Inclui (7 cols) -->
                <div class="lg:col-span-7 bg-white dark:bg-[#0c1322] p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-[#d97706] dark:bg-amber-950/60 dark:text-amber-400 flex items-center justify-center border border-amber-200 dark:border-amber-800">
                            <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Escopo Detalhado</span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">O que está incluído no serviço</h2>
                        </div>
                    </div>

                    <div class="space-y-3.5 pt-2">
                        @foreach($service['includes'] as $inc)
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-slate-50 dark:bg-[#080c16]/70 border border-slate-100 dark:border-slate-800/80">
                                <span class="w-5 h-5 rounded-full bg-amber-100 dark:bg-amber-950 text-amber-800 dark:text-amber-400 flex items-center justify-center text-xs shrink-0 font-bold mt-0.5">✓</span>
                                <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-medium">{{ $inc }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Aplicações Comuns Box -->
                    <div class="p-4 rounded-2xl bg-white/[0.04] dark:bg-[#080c16]/90 border border-slate-200 dark:border-white/10 space-y-1.5">
                        <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400 flex items-center gap-1.5">
                            <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                            Aplicações Mais Comuns:
                        </span>
                        <p class="text-xs text-slate-700 dark:text-slate-300 leading-relaxed">
                            {{ $service['applications'] }}
                        </p>
                    </div>

                    <div class="p-4 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-900 dark:text-amber-300 flex items-start gap-2.5">
                        <i data-lucide="shield" class="w-4 h-4 text-[#f5a800] shrink-0 mt-0.5"></i>
                        <div>
                            <strong>Padrão de Excelência Gráfica RACHI:</strong> Todas as tiragens e produções passam por verificação técnica prévia de ficheiros (pre-flight), calibração densitométrica e prova digital de validação antes da rodagem definitiva.
                        </div>
                    </div>
                </div>

                <!-- Como Funciona - Processo em 4 Etapas (5 cols) -->
                <div class="lg:col-span-5 bg-white dark:bg-[#0c1322] p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-[#d97706] dark:bg-amber-950/60 dark:text-amber-400 flex items-center justify-center border border-amber-200 dark:border-amber-800">
                            <i data-lucide="workflow" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-amber-600 dark:text-amber-400">Fluxo Transparente</span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Como Funciona a Produção</h2>
                        </div>
                    </div>

                    <div class="space-y-4 pt-2 relative">
                        @foreach($service['steps'] as $st)
                            <div class="flex items-start gap-3.5">
                                <div class="w-8 h-8 rounded-xl bg-slate-900 dark:bg-amber-500/15 text-[#f5a800] font-black text-xs flex items-center justify-center shrink-0 border border-amber-500/25">
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
                        <a href="#solicitar" class="w-full py-3.5 px-4 rounded-xl bg-slate-900 hover:bg-[#f5a800] hover:text-[#080c16] text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                            <span>Solicitar Cotação para Este Serviço</span>
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
                <span class="text-xs font-bold uppercase tracking-widest text-amber-500 px-3.5 py-1.5 rounded-full bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800">
                    Planos e Opções de Produção
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white mt-3 tracking-tight">
                    Valores transparentes e tiragens sob medida
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-2">
                    Cotações em Kwanzas (AOA) com emissão de factura proforma oficial, dedução de impostos e entrega programada.
                </p>
            </div>

            <!-- Grade dos 3 Planos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($service['plans'] as $plan)
                    <div class="relative rounded-3xl p-6 sm:p-8 transition-all duration-300 flex flex-col justify-between border {{ $plan['popular'] ? 'bg-white dark:bg-[#0c1322] border-[#f5a800] shadow-xl shadow-amber-500/10 ring-2 ring-[#f5a800]' : 'bg-white dark:bg-[#0c1322] border-slate-200 dark:border-slate-800 shadow-sm' }}">
                        
                        @if($plan['popular'])
                            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-3.5 py-0.5 rounded-full bg-[#f5a800] text-[#080c16] text-[10px] font-extrabold uppercase tracking-wider shadow-sm">
                                Mais Solicitado
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
                                <div class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Inclui no Pacote:</div>
                                @foreach($plan['features'] as $feat)
                                    <div class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300">
                                        <span class="w-4 h-4 rounded-full bg-amber-100 dark:bg-amber-950 text-amber-700 dark:text-amber-400 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <button type="button" 
                               @click="selectedPlan = '{{ $plan['name'] }}'; document.getElementById('solicitar').scrollIntoView({ behavior: 'smooth' })"
                               class="w-full py-3 px-4 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer {{ $plan['popular'] ? 'bg-[#f5a800] hover:bg-[#e08b00] text-[#080c16] shadow-md shadow-amber-500/25' : 'bg-slate-900 hover:bg-[#f5a800] hover:text-[#080c16] text-white dark:bg-slate-800 dark:hover:bg-[#f5a800] dark:hover:text-[#080c16]' }}">
                                <span>Solicitar Este Pacote</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Nota de Propostas Customizadas -->
            <div class="mt-8 p-4 rounded-2xl bg-slate-100 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 flex items-start gap-3 text-xs text-slate-600 dark:text-slate-400 max-w-3xl mx-auto">
                <i data-lucide="info" class="w-4 h-4 text-[#f5a800] shrink-0 mt-0.5"></i>
                <div>
                    <strong>Tiragens Especiais ou Grandes Formatos:</strong> Para quantidades não listadas, materiais com certificação ecológica ou projetos de grande escala, emitimos uma proposta comercial detalhada com cronograma executivo em menos de 2 horas úteis.
                </div>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 4. MEIOS DE SOLICITAR & CONTACTAR                       -->
        <!-- ======================================================== -->
        <section id="solicitar" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 pb-20">
            <div class="bg-white dark:bg-[#0c1322] rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl p-6 sm:p-10 lg:p-12">
                
                <div class="max-w-3xl mb-8">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-500 px-3.5 py-1.5 rounded-full bg-amber-50 dark:bg-amber-950/60 border border-amber-200 dark:border-amber-800">
                        Como Solicitar &amp; Contactar
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 dark:text-white mt-3 tracking-tight">
                        Solicite a sua cotação gráfica ou fale diretamente com a nossa oficina
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-2">
                        Preencha o formulário abaixo para receber a proforma oficial por e-mail, ou aceda aos canais diretos para apoio imediato.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                    
                    <!-- Formulário de Solicitação Direta (7 cols) -->
                    <div class="lg:col-span-7">
                        <form action="/contacto" method="POST" class="space-y-4">
                            @csrf
                            <input type="hidden" name="assunto" value="Cotação Gráfica: {{ $service['title'] }}">
                            
                            <div class="p-3.5 rounded-2xl bg-amber-500/10 border border-amber-500/20 text-xs text-amber-900 dark:text-amber-300 flex items-center justify-between">
                                <span><strong>Pacote Selecionado:</strong> <span x-text="selectedPlan" class="font-bold text-[#f5a800]"></span></span>
                                <input type="hidden" name="plano_selecionado" :value="selectedPlan">
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">O Seu Nome *</label>
                                    <input type="text" name="name" required placeholder="Ex: Dr. António Silva" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#080c16] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f5a800]">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Empresa / Instituição</label>
                                    <input type="text" name="empresa" placeholder="Ex: Banco / Empresa LDA" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#080c16] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f5a800]">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Telefone / WhatsApp *</label>
                                    <input type="tel" name="phone" required placeholder="Ex: +244 972 888 585" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#080c16] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f5a800]">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Email Corporativo *</label>
                                    <input type="email" name="email" required placeholder="Ex: comercial@empresa.co.ao" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#080c16] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f5a800]">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Quantidade / Tiragem Estimada</label>
                                    <input type="text" name="quantidade" placeholder="Ex: 100 unidades / 500 exemplares" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#080c16] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f5a800]">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Prazo Desejado</label>
                                    <select name="urgencia" class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#080c16] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f5a800]">
                                        <option value="padrao">Prazo Normal (3 a 5 dias úteis)</option>
                                        <option value="urgente">Urgência (24h a 48h úteis)</option>
                                        <option value="programado">Entrega Programada (para evento futuro)</option>
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1.5 uppercase tracking-wider">Especificações / Detalhes do Projeto</label>
                                <textarea name="message" rows="4" placeholder="Descreva os materiais, formatos, acabamentos (capa dura, laminação, relevo, gramagem) ou anexe detalhes relevantes..." class="w-full px-4 py-3 rounded-xl border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-[#080c16] text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-[#f5a800]"></textarea>
                            </div>

                            <button type="submit" class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-[#f5a800] to-[#e08b00] hover:from-[#e08b00] hover:to-[#c67a00] text-[#080c16] font-bold text-sm transition shadow-lg shadow-amber-500/25 flex items-center justify-center gap-2 cursor-pointer">
                                <i data-lucide="send" class="w-4 h-4"></i>
                                <span>Enviar Pedido de Cotação Gráfica</span>
                            </button>

                            <p class="text-[11px] text-slate-500 dark:text-slate-400 text-center">
                                Garantia de resposta em até 2 horas úteis com proforma oficial detalhada.
                            </p>
                        </form>
                    </div>

                    <!-- Canais Directos de Atendimento (5 cols) -->
                    <div class="lg:col-span-5 space-y-6">
                        <div class="p-6 rounded-3xl bg-slate-50 dark:bg-[#080c16] border border-slate-200 dark:border-slate-800 space-y-4">
                            <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                <i data-lucide="phone" class="w-4 h-4 text-[#f5a800]"></i>
                                Atendimento Imediato RACHI Print
                            </h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                                Prefere falar diretamente com o nosso gestor de produção gráfica para esclarecer dúvidas sobre papéis, provas ou prazos urgentes?
                            </p>

                            <!-- WhatsApp Directo -->
                            <a href="https://wa.me/244972888585?text={{ urlencode($service['whatsapp_msg']) }}" target="_blank" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white dark:bg-[#0c1322] border border-slate-200 dark:border-slate-700 hover:border-green-500 transition group">
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
                            <a href="tel:+244972888585" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white dark:bg-[#0c1322] border border-slate-200 dark:border-slate-700 hover:border-amber-500 transition group">
                                <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-[#f5a800] flex items-center justify-center shrink-0">
                                    <i data-lucide="phone-call" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-[#f5a800] transition">Linha de Produção Direta</div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400">+244 972 888 585 / Luanda, Angola</div>
                                </div>
                                <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-400 group-hover:text-[#f5a800] transition"></i>
                            </a>

                            <!-- Email Directo -->
                            <a href="mailto:geral@rachi.ao?subject={{ urlencode('Cotação Gráfica: ' . $service['title']) }}" class="flex items-center gap-3 p-3.5 rounded-2xl bg-white dark:bg-[#0c1322] border border-slate-200 dark:border-slate-700 hover:border-amber-500 transition group">
                                <div class="w-10 h-10 rounded-xl bg-orange-500/15 text-orange-500 flex items-center justify-center shrink-0">
                                    <i data-lucide="mail" class="w-5 h-5"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-amber-400 transition">Email Comercial Oficial</div>
                                    <div class="text-[11px] text-slate-500 dark:text-slate-400">geral@rachi.ao</div>
                                </div>
                                <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-400 group-hover:text-amber-400 transition"></i>
                            </a>
                        </div>

                        <!-- Card de Garantia de Prova & Reimpressão -->
                        <div class="p-4 rounded-2xl bg-slate-100 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 text-xs text-slate-600 dark:text-slate-400 space-y-1.5">
                            <div class="font-bold text-slate-900 dark:text-white flex items-center gap-1.5">
                                <i data-lucide="badge-check" class="w-3.5 h-3.5 text-[#f5a800]"></i>
                                Garantia de Satisfação &amp; Prova Física
                            </div>
                            <p class="leading-relaxed">
                                Todas as tiragens corporativas têm validação de prova antes da impressão em escala. Em caso de discrepância em relação à prova aprovada, garantimos a reimpressão imediata sem qualquer encargo adicional.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 5. OUTROS SERVIÇOS DO CATÁLOGO RACHI PRINT               -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-slate-200 dark:border-slate-800">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-amber-500">Catálogo Completo</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">Outros Serviços RACHI Print</h2>
                </div>
                <a href="/print#servicos-print" class="text-xs font-bold text-amber-500 hover:underline flex items-center gap-1">
                    <span>Ver todos</span>
                    <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($otherServices as $other)
                    <a href="{{ route('print.service.show', $other['slug']) }}" class="group block overflow-hidden rounded-2xl bg-white dark:bg-[#0c1322] border border-slate-200 dark:border-slate-800 hover:border-amber-500/50 hover:shadow-xl transition-all duration-300">
                        @if(!empty($other['image']))
                            <div class="w-full h-48 sm:h-52 relative overflow-hidden bg-slate-900">
                                <img src="{{ asset($other['image']) }}" alt="{{ $other['title'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0c1322] via-transparent to-transparent"></div>
                                <span class="absolute top-3 left-3 text-[10px] font-bold text-white bg-black/60 backdrop-blur-md px-2.5 py-0.5 rounded-full border border-white/10">
                                    {{ $other['tag'] }}
                                </span>
                            </div>
                        @endif
                        <div class="p-5">
                            @if(empty($other['image']))
                                <div class="w-10 h-10 rounded-xl bg-amber-50 dark:bg-amber-950/60 text-[#f5a800] flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                    <i data-lucide="{{ $other['icon'] }}" class="w-5 h-5"></i>
                                </div>
                                <span class="text-[10px] font-bold text-amber-600 dark:text-amber-400 uppercase tracking-wider">{{ $other['tag'] }}</span>
                            @endif
                            <h3 class="text-sm font-bold text-slate-900 dark:text-white mt-1 group-hover:text-amber-400 transition line-clamp-1">{{ $other['title'] }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2">{{ $other['short_desc'] }}</p>
                            <div class="mt-4 pt-3 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs">
                                <span class="font-bold text-slate-900 dark:text-white">{{ $other['starting_price'] }}</span>
                                <span class="text-amber-500 font-semibold flex items-center gap-0.5 group-hover:translate-x-1 transition-transform">
                                    Ver Detalhes &rarr;
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-slate-100 dark:bg-[#050912] text-slate-600 dark:text-slate-400 py-12 border-t border-slate-200 dark:border-white/10 text-xs transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="font-bold text-slate-900 dark:text-white tracking-wider">RACHI PRINT</span>
                <span>•</span>
                <span>Gráfica Digital, Offset &amp; Merchandising Corporativo em Angola</span>
            </div>
            <div>
                &copy; {{ date('Y') }} RACHI. Todos os direitos reservados.
            </div>
        </div>
    </footer>

    <!-- Inicialização Lucide Icons -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                window.lucide.createIcons();
            }
        });
    </script>
</body>
</html>
