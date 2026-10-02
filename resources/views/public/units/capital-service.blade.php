<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $service['title'] }} — RACHI Human Capital</title>
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

        /* DUAL THEME HEADER */
        .site-header {
            position: fixed !important;
            top: 0 !important; left: 0 !important; right: 0 !important;
            z-index: 1030 !important;
            width: 100% !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        }
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
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link {
            font-size: 0.88rem; font-weight: 500;
            color: rgba(255, 255, 255, 0.8) !important;
            padding: 0.45rem 0.9rem !important; border-radius: 9999px;
            text-decoration: none; transition: all 0.2s ease;
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link:hover {
            color: #ffffff !important; background: rgba(255, 255, 255, 0.08);
        }
        .site-header.header-top-dark .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: rgba(16, 185, 129, 0.2);
            border: 1px solid rgba(16, 185, 129, 0.4);
            font-weight: 700;
        }

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

        /* Card Service & Cards */
        .service-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 1.5rem;
            padding: 2rem;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .service-card:hover {
            transform: translateY(-4px);
            border-color: #34d399;
            box-shadow: 0 20px 35px -10px rgba(16, 185, 129, 0.18), 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        html.dark .service-card {
            background: #071326;
            border-color: rgba(255, 255, 255, 0.08);
            color: #f8fafc;
        }
        html.dark .service-card:hover {
            border-color: #10b981;
            box-shadow: 0 20px 40px -10px rgba(16, 185, 129, 0.25), 0 0 20px rgba(0, 0, 0, 0.5);
        }

        /* ======================================================== */
        /* DARK MODE LUXURY DESIGN SYSTEM - RACHI HUMAN CAPITAL     */
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
        html.dark main .bg-emerald-50 {
            background-color: rgba(16, 185, 129, 0.15) !important;
            border-color: rgba(16, 185, 129, 0.3) !important;
            color: #34d399 !important;
        }
        html.dark main .bg-blue-50 {
            background-color: rgba(59, 130, 246, 0.15) !important;
            border-color: rgba(59, 130, 246, 0.3) !important;
            color: #60a5fa !important;
        }
        html.dark main .bg-purple-50 {
            background-color: rgba(168, 85, 247, 0.15) !important;
            border-color: rgba(168, 85, 247, 0.3) !important;
            color: #c084fc !important;
        }
        html.dark main .bg-amber-50 {
            background-color: rgba(245, 158, 11, 0.15) !important;
            border-color: rgba(245, 158, 11, 0.3) !important;
            color: #fbbf24 !important;
        }

        /* Pricing Plan Cards */
        html.dark .ring-2.ring-\[\#10b981\],
        html.dark .border-\[\#10b981\] {
            background: linear-gradient(180deg, #072e21 0%, #071326 100%) !important;
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.6), 0 0 25px rgba(16, 185, 129, 0.25) !important;
            border-color: #10b981 !important;
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
            background-color: #0c2621 !important;
            border-color: #10b981 !important;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.25) !important;
            outline: none !important;
        }

        /* Notice / Info Boxes */
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
<body x-data="servicePageApp()">

    <!-- ============================================================ -->
    <!-- DUAL THEME HEADER                                            -->
    <!-- ============================================================ -->
    <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-5 lg:py-6 transition-all duration-300">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            
            <!-- Brand Logo Oficial RACHI Human Capital -->
            <a href="/capital" class="flex items-center gap-3 group text-decoration-none" title="Voltar à página de Human Capital">
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
                
                <a href="/capital" class="nav-link active">
                    <span>Human Capital</span>
                </a>

                <a href="/capital#servicos-capital" class="nav-link">
                    <span>Todos os Serviços</span>
                </a>

                <a href="/contacto" class="nav-link">
                    <span>Contacto</span>
                </a>
            </nav>

            <!-- Header Actions -->
            <div class="flex items-center gap-2.5 sm:gap-3">
                <!-- Theme Toggle Button -->
                <button type="button"
                    onclick="window.toggleRachiTheme()"
                    class="theme-toggle-btn"
                    aria-label="Alternar Modo Escuro / Claro"
                    title="Alternar Modo Escuro / Claro">
                    <!-- Lua -->
                    <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-slate-300 hover:text-white dark:hidden transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <!-- Sol -->
                    <svg class="w-4 h-4 sm:w-[18px] sm:h-[18px] text-amber-400 hover:text-amber-300 hidden dark:block transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                    </svg>
                </button>

                <a href="#solicitar" class="btn-cta-emerald group">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    <span>Pedir Proposta</span>
                </a>
            </div>

        </div>
    </header>

    <main class="pt-24 sm:pt-28">

        <!-- ======================================================== -->
        <!-- BREADCRUMBS                                              -->
        <!-- ======================================================== -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <nav class="flex items-center gap-2 text-xs text-slate-500 dark:text-slate-400" aria-label="Breadcrumb">
                <a href="/" class="hover:text-emerald-500 transition">Portal RACHI</a>
                <span class="text-slate-400">/</span>
                <a href="/capital" class="hover:text-emerald-500 transition">Human Capital</a>
                <span class="text-slate-400">/</span>
                <a href="/capital#servicos-capital" class="hover:text-emerald-500 transition">Serviços</a>
                <span class="text-slate-400">/</span>
                <span class="text-slate-900 dark:text-white font-semibold truncate">{{ $service['title'] }}</span>
            </nav>
        </div>

        <!-- ======================================================== -->
        <!-- 1. HERO DO SERVIÇO                                       -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="relative rounded-3xl p-8 sm:p-12 lg:p-16 bg-gradient-to-br from-[#071326] via-[#0d2238] to-[#071326] border border-emerald-500/25 overflow-hidden shadow-2xl text-white">
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-96 h-96 bg-blue-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                    <div class="lg:col-span-7 space-y-6">
                        <div class="flex flex-wrap items-center gap-3">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#10b981] px-3.5 py-1.5 rounded-full bg-emerald-500/15 border border-emerald-500/30">
                                {{ $service['tag'] }}
                            </span>
                            <span class="text-xs font-bold uppercase tracking-widest text-slate-300 px-3 py-1 rounded-full bg-white/10 border border-white/15">
                                RACHI Human Capital
                            </span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                            {{ $service['title'] }}
                        </h1>

                        <p class="text-slate-300 text-base sm:text-lg leading-relaxed max-w-2xl">
                            {{ $service['full_desc'] }}
                        </p>

                        <!-- Destaques Rápidos: SLA, Garantia, Preço Base -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 pt-4 border-t border-white/10">
                            <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10">
                                <div class="text-[11px] uppercase tracking-wider text-emerald-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="clock" class="w-3.5 h-3.5"></i>
                                    <span>Prazo Médio</span>
                                </div>
                                <div class="font-bold text-sm text-white">{{ $service['prazo'] }}</div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10">
                                <div class="text-[11px] uppercase tracking-wider text-emerald-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="shield-check" class="w-3.5 h-3.5"></i>
                                    <span>Garantia RACHI</span>
                                </div>
                                <div class="font-bold text-sm text-white">{{ $service['garantia'] }}</div>
                            </div>

                            <div class="p-4 rounded-2xl bg-white/[0.04] border border-white/10">
                                <div class="text-[11px] uppercase tracking-wider text-emerald-400 font-bold flex items-center gap-1.5 mb-1">
                                    <i data-lucide="tag" class="w-3.5 h-3.5"></i>
                                    <span>A Partir de</span>
                                </div>
                                <div class="font-bold text-sm text-white">
                                    <strong class="text-xl text-[#10b981]">{{ $service['starting_price'] }}</strong> 
                                    <span class="text-xs text-slate-300 font-normal">{{ $service['price_period'] }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação Imediata -->
                        <div class="pt-4 flex flex-col sm:flex-row items-center gap-4">
                            <a href="#solicitar" class="btn-cta-emerald w-full sm:w-auto px-7 py-4 text-sm font-bold shadow-lg shadow-emerald-500/25">
                                <i data-lucide="send" class="w-4 h-4"></i>
                                <span>Solicitar Proposta Online</span>
                            </a>
                            <a href="https://wa.me/244972888585?text={{ urlencode($service['whatsapp_msg']) }}" target="_blank" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-4 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-sm transition shadow-lg shadow-green-500/20">
                                <i data-lucide="message-circle" class="w-4 h-4"></i>
                                <span>Falar no WhatsApp Directo</span>
                            </a>
                            <a href="/capital#servicos-capital" class="text-xs text-slate-400 hover:text-white transition flex items-center gap-1 py-2">
                                <span>&larr; Ver outros serviços</span>
                            </a>
                        </div>
                    </div>

                    <!-- Imagem Oficial em Destaque do Serviço -->
                    @if(!empty($service['image']))
                        <div class="lg:col-span-5">
                            <div class="relative rounded-2xl overflow-hidden shadow-2xl border border-white/15 bg-white/5 group">
                                <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }}" class="w-full h-72 sm:h-96 object-cover group-hover:scale-105 transition-transform duration-700">
                                <div class="absolute inset-0 bg-gradient-to-t from-[#071326]/85 via-transparent to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4 flex items-center justify-between text-xs text-slate-300">
                                    <span class="px-3 py-1.5 rounded-full bg-black/60 backdrop-blur-md border border-white/10 font-bold text-white flex items-center gap-1.5">
                                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-[#10b981]"></i>
                                        Serviço Oficial RACHI
                                    </span>
                                    <span class="text-[11px] text-emerald-400 font-semibold tracking-wider uppercase">Garantia Ativa</span>
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
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                
                <!-- O Que Inclui (7 cols) -->
                <div class="lg:col-span-7 bg-white dark:bg-[#071326] p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-[#10b981] dark:bg-emerald-950/60 dark:text-emerald-400 flex items-center justify-center border border-emerald-200 dark:border-emerald-800">
                            <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-emerald-600 dark:text-emerald-400">Escopo Detalhado</span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">O que está incluído no serviço</h2>
                        </div>
                    </div>

                    <div class="space-y-3.5 pt-2">
                        @foreach($service['includes'] as $inc)
                            <div class="flex items-start gap-3 p-3.5 rounded-2xl bg-slate-50 dark:bg-[#0a1a33]/60 border border-slate-100 dark:border-slate-800/80">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold mt-0.5">✓</span>
                                <span class="text-xs sm:text-sm text-slate-700 dark:text-slate-300 leading-relaxed font-medium">{{ $inc }}</span>
                            </div>
                        @endforeach
                    </div>

                    <div class="p-4 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 text-xs text-emerald-800 dark:text-emerald-300 flex items-start gap-2.5">
                        <i data-lucide="shield" class="w-4 h-4 text-emerald-600 shrink-0 mt-0.5"></i>
                        <div>
                            <strong>Segurança &amp; Conformidade Garantidas:</strong> Todas as tramitações são executadas em estrita harmonia com as leis angolanas (LGT, AGT, INSS e MINDCOM) por especialistas credenciados.
                        </div>
                    </div>
                </div>

                <!-- Como Funciona - Processo em 4 Etapas (5 cols) -->
                <div class="lg:col-span-5 bg-white dark:bg-[#071326] p-6 sm:p-8 rounded-3xl border border-slate-200 dark:border-slate-800 shadow-sm space-y-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 dark:bg-blue-950/60 dark:text-blue-400 flex items-center justify-center border border-blue-200 dark:border-blue-800">
                            <i data-lucide="layers" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <span class="text-[11px] font-bold uppercase tracking-wider text-blue-600 dark:text-blue-400">Fluxo Transparente</span>
                            <h2 class="text-xl sm:text-2xl font-black text-slate-900 dark:text-white">Como Funciona</h2>
                        </div>
                    </div>

                    <div class="space-y-4 pt-2 relative">
                        @foreach($service['steps'] as $st)
                            <div class="flex items-start gap-3.5">
                                <div class="w-8 h-8 rounded-xl bg-slate-900 dark:bg-emerald-500/15 text-[#10b981] font-black text-xs flex items-center justify-center shrink-0 border border-emerald-500/25">
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
                        <a href="#solicitar" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-[#10b981] text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                            <span>Iniciar Solicitação</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 3. TABELA DE PREÇOS & PACOTES EM KWANZAS                -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-xs font-bold uppercase tracking-widest text-[#10b981] px-3.5 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800">
                    Tabela de Preços e Pacotes
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-slate-900 dark:text-white mt-3 tracking-tight">
                    Valores transparentes e planos à medida
                </h2>
                <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-2">
                    Cotações em Kwanzas (AOA) com emissão de factura proforma oficial imediata.
                </p>
            </div>

            <!-- Grade dos 3 Planos -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($service['plans'] as $plan)
                    <div class="relative rounded-3xl p-6 sm:p-8 transition-all duration-300 flex flex-col justify-between border {{ $plan['popular'] ? 'bg-white dark:bg-[#071326] border-[#10b981] shadow-xl shadow-emerald-500/10 ring-2 ring-[#10b981]' : 'bg-white dark:bg-[#071326] border-slate-200 dark:border-slate-800 shadow-sm' }}">
                        
                        @if($plan['popular'])
                            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2 px-3.5 py-0.5 rounded-full bg-[#10b981] text-white text-[10px] font-extrabold uppercase tracking-wider shadow-sm">
                                Mais Escolhido
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
                                        <span class="w-4 h-4 rounded-full bg-emerald-100 dark:bg-emerald-950 text-emerald-700 dark:text-emerald-400 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                        <span>{{ $feat }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="pt-4 border-t border-slate-100 dark:border-slate-800">
                            <a href="#solicitar" 
                               @click="selectPlan('{{ $plan['name'] }}')"
                               class="w-full py-3 px-4 rounded-xl font-bold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer {{ $plan['popular'] ? 'bg-[#10b981] hover:bg-[#059669] text-white shadow-md shadow-emerald-500/25' : 'bg-slate-900 hover:bg-[#10b981] text-white dark:bg-slate-800 dark:hover:bg-[#10b981]' }}">
                                <span>Solicitar este Plano</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Nota de Transparência -->
            <div class="mt-8 p-4 rounded-2xl bg-slate-100 dark:bg-slate-800/40 border border-slate-200 dark:border-slate-700/60 flex items-start gap-3 text-xs text-slate-600 dark:text-slate-400 max-w-3xl mx-auto">
                <i data-lucide="info" class="w-4 h-4 text-emerald-500 shrink-0 mt-0.5"></i>
                <div>
                    <strong>Transparência Contratual:</strong> Não existem taxas ocultas. Para demandas que envolvam volumes elevados de pessoal ou sociedades comerciais com objetos múltiplos, elaboramos proposta técnica customizada e cronograma detalhado de execução.
                </div>
            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 4. MEIOS DE SOLICITAR O SERVIÇO                         -->
        <!-- ======================================================== -->
        <section id="solicitar" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 pb-24">
            <div class="bg-white dark:bg-[#071326] rounded-3xl border border-slate-200 dark:border-slate-800 shadow-xl p-6 sm:p-10 lg:p-12">
                
                <div class="max-w-3xl mb-8">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#10b981] px-3.5 py-1.5 rounded-full bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800">
                        Como Solicitar
                    </span>
                    <h2 class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 dark:text-white mt-3">
                        Solicite {{ $service['title'] }} agora
                    </h2>
                    <p class="text-slate-600 dark:text-slate-400 text-sm sm:text-base mt-2">
                        Escolha o canal que preferir: envie o formulário online para receber uma proposta oficial em menos de 2 horas ou fale agora diretamente pelo WhatsApp.
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
                    
                    <!-- Formulário Online (7 cols) -->
                    <div class="lg:col-span-7 bg-slate-50 dark:bg-[#0a1a33]/60 p-6 sm:p-8 rounded-2xl border border-slate-200 dark:border-slate-800">
                        <div x-show="!formSubmitted">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                                <i data-lucide="edit-3" class="w-4 h-4 text-emerald-500"></i>
                                <span>Formulário de Cotação Rápida</span>
                            </h3>

                            <form @submit.prevent="submitForm()" class="space-y-4">
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nome Completo *</label>
                                        <input type="text" x-model="formData.nome" required placeholder="Ex: Manuel Silva" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Empresa / Organização</label>
                                        <input type="text" x-model="formData.empresa" placeholder="Ex: Silva & Filhos Lda" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Contacto Telefónico / WhatsApp *</label>
                                        <input type="tel" x-model="formData.telefone" required placeholder="Ex: +244 972 888 585" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                    </div>
                                    <div>
                                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">E-mail Corporativo</label>
                                        <input type="email" x-model="formData.email" placeholder="manuel@empresa.ao" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Plano Pretendido</label>
                                    <select x-model="formData.plano" class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:outline-none">
                                        @foreach($service['plans'] as $plan)
                                            <option value="{{ $plan['name'] }}">{{ $plan['name'] }} ({{ $plan['price'] }})</option>
                                        @endforeach
                                        <option value="Plano Sob Medida">Plano Sob Medida / Outro</option>
                                    </select>
                                </div>

                                <div>
                                    <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Detalhes Adicionais da Solicitação</label>
                                    <textarea x-model="formData.detalhes" rows="3" placeholder="Indique quantidade de colaboradores, prazo pretendido ou especificidades do seu negócio..." class="w-full px-3.5 py-2.5 rounded-xl border border-slate-200 dark:border-slate-700 bg-white dark:bg-[#071326] text-xs sm:text-sm text-slate-900 dark:text-white focus:ring-2 focus:ring-emerald-500 focus:outline-none"></textarea>
                                </div>

                                <div class="pt-2">
                                    <button type="submit" class="w-full py-3.5 px-6 rounded-xl bg-[#10b981] hover:bg-[#059669] text-white font-bold text-xs uppercase tracking-wider transition duration-200 shadow-md shadow-emerald-500/25 flex items-center justify-center gap-2 cursor-pointer">
                                        <i data-lucide="send" class="w-4 h-4"></i>
                                        <span>Submeter Pedido de Cotação</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Feedback de Sucesso -->
                        <div x-show="formSubmitted" class="py-8 text-center space-y-4">
                            <div class="w-16 h-16 rounded-full bg-emerald-500/15 text-[#10b981] flex items-center justify-center mx-auto border border-emerald-500/30">
                                <i data-lucide="check-circle" class="w-8 h-8"></i>
                            </div>
                            <h3 class="text-xl font-black text-slate-900 dark:text-white">Pedido Submetido com Sucesso!</h3>
                            <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 max-w-md mx-auto leading-relaxed">
                                Muito obrigado, <strong x-text="formData.nome"></strong>. Registamos a sua solicitação para <strong>{{ $service['title'] }}</strong>. A nossa equipa entrará em contacto em menos de 2 horas úteis.
                            </p>
                            <div class="pt-3 flex flex-col sm:flex-row items-center justify-center gap-3">
                                <button type="button" 
                                        @click="sendWhatsAppDirect()"
                                        class="w-full sm:w-auto px-5 py-2.5 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-xs flex items-center justify-center gap-2 shadow-md cursor-pointer">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                    <span>Continuar pelo WhatsApp</span>
                                </button>
                                <button type="button" 
                                        @click="formSubmitted = false"
                                        class="w-full sm:w-auto px-4 py-2.5 rounded-xl bg-slate-200 dark:bg-slate-700 text-slate-800 dark:text-slate-200 font-bold text-xs cursor-pointer">
                                    Novo Pedido
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Canais Directos de Atendimento (5 cols) -->
                    <div class="lg:col-span-5 space-y-5 flex flex-col justify-between">
                        <div>
                            <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-4">Canais Diretos</h3>

                            <!-- WhatsApp Oficial -->
                            <div class="p-6 rounded-2xl bg-[#25D366]/10 border border-[#25D366]/30 space-y-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-[#25D366] text-white flex items-center justify-center shrink-0 shadow-sm">
                                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                                    </div>
                                    <div>
                                        <div class="font-bold text-sm text-slate-900 dark:text-white">WhatsApp Corporativo</div>
                                        <div class="text-[11px] text-slate-500 dark:text-slate-400">Atendimento prioritário em minutos</div>
                                    </div>
                                </div>
                                <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                                    Converse em tempo real com um dos nossos consultores para tirar dúvidas jurídicas, contratuais ou tributárias.
                                </p>
                                <button type="button" 
                                        @click="sendWhatsAppDirect()"
                                        class="w-full py-3 px-4 rounded-xl bg-[#25D366] hover:bg-[#20bd5a] text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                                    <span>Solicitar via WhatsApp Oficial</span>
                                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </button>
                            </div>

                            <!-- Linhas e Contactos -->
                            <div class="mt-4 p-5 rounded-2xl bg-slate-50 dark:bg-[#0a1a33]/60 border border-slate-200 dark:border-slate-800 space-y-3">
                                <div class="flex items-center gap-3 text-xs">
                                    <div class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-slate-800 flex items-center justify-center shrink-0 text-slate-700 dark:text-slate-300">
                                        <i data-lucide="phone" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-slate-400 uppercase font-semibold">Linha Telefónica</div>
                                        <a href="tel:+244972888585" class="font-bold text-slate-900 dark:text-white hover:text-[#10b981] transition">(+244) 972 888 585</a>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 text-xs">
                                    <div class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-slate-800 flex items-center justify-center shrink-0 text-slate-700 dark:text-slate-300">
                                        <i data-lucide="mail" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-slate-400 uppercase font-semibold">E-mail Institucional</div>
                                        <a href="mailto:capital@rachi.ao" class="font-bold text-slate-900 dark:text-white hover:text-[#10b981] transition">capital@rachi.ao</a>
                                    </div>
                                </div>

                                <div class="flex items-center gap-3 text-xs">
                                    <div class="w-8 h-8 rounded-lg bg-slate-200 dark:bg-slate-800 flex items-center justify-center shrink-0 text-slate-700 dark:text-slate-300">
                                        <i data-lucide="map-pin" class="w-4 h-4"></i>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-slate-400 uppercase font-semibold">Localização &amp; Horário</div>
                                        <div class="font-bold text-slate-900 dark:text-white">Luanda — Angola (Seg-Sex: 08h às 17h)</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="p-3.5 rounded-xl bg-emerald-500/10 border border-emerald-500/20 text-center">
                            <span class="text-[11px] font-bold text-emerald-700 dark:text-emerald-400">
                                ✓ Confidencialidade e Contrato Blindado
                            </span>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <!-- ======================================================== -->
        <!-- 5. OUTROS SERVIÇOS DA RACHI HUMAN CAPITAL                -->
        <!-- ======================================================== -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 border-t border-slate-200 dark:border-slate-800">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
                <div>
                    <span class="text-xs font-bold uppercase tracking-widest text-[#10b981]">Conheça Também</span>
                    <h2 class="text-2xl sm:text-3xl font-black text-slate-900 dark:text-white mt-1">
                        Outros serviços da RACHI Human Capital
                    </h2>
                </div>
                <a href="/capital#servicos-capital" class="text-xs font-bold text-emerald-600 dark:text-emerald-400 hover:underline flex items-center gap-1">
                    <span>Ver todos no portal</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($otherServices as $other)
                    <a href="/capital/servicos/{{ $other['slug'] }}" class="service-card group cursor-pointer block text-decoration-none">
                        <div>
                            <div class="flex items-center justify-between mb-4">
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-slate-700 dark:text-slate-300">
                                    {{ $other['num'] }}
                                </span>
                                <span class="text-xs font-extrabold text-emerald-600 dark:text-emerald-400">
                                    {{ $other['starting_price'] }}
                                </span>
                            </div>

                            <h3 class="text-base sm:text-lg font-bold text-slate-900 dark:text-white group-hover:text-[#10b981] transition">
                                {{ $other['title'] }}
                            </h3>

                            <p class="text-slate-600 dark:text-slate-400 text-xs mt-2 leading-relaxed">
                                {{ $other['short_desc'] }}
                            </p>
                        </div>

                        <div class="pt-4 mt-4 border-t border-slate-100 dark:border-slate-800 flex items-center justify-between text-xs text-emerald-600 dark:text-emerald-400 font-bold">
                            <span>Ver informações completas</span>
                            <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
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
                    <!-- Footer Logo Oficial RACHI Human Capital -->
                    <a href="/capital" class="inline-flex items-center gap-2.5 mb-4 group text-decoration-none">
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
                        <li><a href="/capital#servicos-capital" class="hover:text-slate-900 dark:hover:text-white transition">Serviços Capital</a></li>
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
        function servicePageApp() {
            return {
                formSubmitted: false,
                formData: {
                    nome: '',
                    empresa: '',
                    telefone: '',
                    email: '',
                    plano: '{{ $service['plans'][1]['name'] ?? $service['plans'][0]['name'] }}',
                    detalhes: ''
                },
                selectPlan(planName) {
                    this.formData.plano = planName;
                },
                submitForm() {
                    if (!this.formData.nome || !this.formData.telefone) {
                        if (window.RachiToast) {
                            window.RachiToast.warning('Por favor, preencha o seu nome e contacto telefónico.');
                        } else {
                            alert('Por favor, preencha o seu nome e contacto telefónico.');
                        }
                        return;
                    }
                    this.formSubmitted = true;
                    if (window.RachiToast) {
                        window.RachiToast.success('Pedido registado com sucesso! A nossa equipa entrará em contacto em menos de 2 horas.');
                    }
                },
                sendWhatsAppDirect() {
                    let msg = '{{ $service['whatsapp_msg'] }}';
                    if (this.formData.nome) {
                        msg += ` Meu nome é ${this.formData.nome}`;
                    }
                    if (this.formData.empresa) {
                        msg += ` da empresa ${this.formData.empresa}.`;
                    }
                    if (this.formData.plano) {
                        msg += ` Tenho interesse específico no plano: ${this.formData.plano}.`;
                    }
                    const url = `https://wa.me/244972888585?text=${encodeURIComponent(msg)}`;
                    window.open(url, '_blank');
                }
            };
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
<script src="/worker-public.js"></script></body>
</html>
