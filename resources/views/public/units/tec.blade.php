<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Tec — Digitalização, Sistemas de Gestão, Websites &amp; Transformação Digital</title>
    <meta name="description" content="RACHI Tec — Digitalização, sistemas de gestão, websites, transformação digital e suporte técnico especializado em Angola.">

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        display: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        rachiNavy: '#071326',
                        rachiNavyLight: '#0d1f3d',
                        rachiBlue: '#00a3e0',
                        rachiBlueDark: '#0077c2',
                        rachiBlueGlow: 'rgba(0, 163, 224, 0.35)',
                        rachiGold: '#f5a800',
                    }
                }
            }
        }
    </script>
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
    <link rel="stylesheet" href="/css/site.css?v={{ time() }}">
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
            transform: translateY(-5px);
            border-color: #38bdf8;
            box-shadow: 0 20px 35px -10px rgba(0, 163, 224, 0.15), 0 1px 3px rgba(0, 0, 0, 0.05);
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
        <!-- 1. HERO BANNER: RACHI Tec                                -->
        <!-- ======================================================== -->
        <section class="bg-[#071326] text-white pt-16 pb-20 px-4 sm:px-6 lg:px-8 relative overflow-hidden">
            <!-- Ambient Glow Gradients -->
            <div class="absolute inset-0 bg-[radial-gradient(ellipse_70%_60%_at_50%_-10%,rgba(0,163,224,0.25),transparent_70%)] pointer-events-none"></div>
            <div class="absolute top-1/3 -right-20 w-96 h-96 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

            <div class="max-w-7xl mx-auto relative z-10">
                
                <!-- Breadcrumbs -->
                <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                    <a href="/" class="hover:text-white transition cursor-pointer">Início</a>
                    <span>/</span>
                    <span class="text-slate-500">Soluções</span>
                    <span>/</span>
                    <span class="text-[#00a3e0] font-semibold">RACHI Tec</span>
                </nav>

                <div class="max-w-4xl">
                    <!-- Pill Tag -->
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-sky-500/15 border border-sky-500/30 text-sky-300 text-xs font-bold uppercase tracking-wider mb-5">
                        <span class="w-2 h-2 rounded-full bg-[#00a3e0] animate-pulse"></span>
                        Tecnologia &amp; Transformação Digital
                    </div>

                    <!-- Main H1 -->
                    <h1 class="text-4xl sm:text-6xl font-black text-white tracking-tight leading-tight">
                        RACHI Tec
                    </h1>

                    <!-- Main Subtitle requested by user -->
                    <p class="text-lg sm:text-2xl text-slate-200 mt-4 leading-relaxed font-normal">
                        Digitalização, sistemas de gestão, websites, transformação digital e suporte técnico.
                    </p>

                    <!-- CTAs -->
                    <div class="mt-8 flex flex-col sm:flex-row items-stretch sm:items-center gap-4">
                        <a href="/contacto" class="btn-cta-blue text-sm px-6 py-3.5 shadow-lg shadow-sky-500/20">
                            <i data-lucide="message-square" class="w-4 h-4"></i>
                            <span>Falar com um Consultor de TI</span>
                        </a>
                        <a href="#servicos-tec" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/15 text-white font-semibold text-sm transition">
                            <i data-lucide="layers" class="w-4 h-4 text-sky-400"></i>
                            <span>Explorar os Nossos Serviços</span>
                        </a>
                    </div>
                </div>

                <!-- 3 Pilares Oficiais Solicitados: Segurança Garantida, Processo Rápido, Suporte Especializado -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 mt-14 pt-10 border-t border-slate-800">
                    <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-900/60 border border-slate-800/80">
                        <div class="w-10 h-10 rounded-xl bg-emerald-500/15 text-emerald-400 flex items-center justify-center shrink-0">
                            <i data-lucide="shield-check" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-white">Segurança Garantida</div>
                            <div class="text-xs text-slate-400">Proteção de dados e conformidade</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-900/60 border border-slate-800/80">
                        <div class="w-10 h-10 rounded-xl bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="zap" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-white">Processo Rápido</div>
                            <div class="text-xs text-slate-400">Implementação ágil e sem atritos</div>
                        </div>
                    </div>

                    <div class="flex items-center gap-3.5 p-4 rounded-2xl bg-slate-900/60 border border-slate-800/80">
                        <div class="w-10 h-10 rounded-xl bg-sky-500/15 text-sky-400 flex items-center justify-center shrink-0">
                            <i data-lucide="headphones" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="font-bold text-sm text-white">Suporte Especializado</div>
                            <div class="text-xs text-slate-400">Equipa técnica pronta para ajudar</div>
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
                <span class="text-[#00a3e0] font-bold text-xs uppercase tracking-widest bg-sky-50 px-3.5 py-1.5 rounded-full border border-sky-200">
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
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-emerald-50 text-emerald-800 text-xs font-bold border border-emerald-200">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-emerald-600"></i>
                        Segurança Garantida
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-amber-50 text-amber-800 text-xs font-bold border border-amber-200">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-amber-600"></i>
                        Processo Rápido
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg bg-sky-50 text-sky-800 text-xs font-bold border border-sky-200">
                        <i data-lucide="check" class="w-3.5 h-3.5 text-sky-600"></i>
                        Suporte Especializado
                    </span>
                </div>
            </div>

            <!-- Grade de Serviços (5 Serviços Oficiais) -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- SERVIÇO 1: Consultoria em transformação digital -->
                <div class="service-card flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-sky-50 text-[#00a3e0] flex items-center justify-center border border-sky-100 group-hover:scale-110 group-hover:bg-[#00a3e0] group-hover:text-white transition-all duration-300">
                                <i data-lucide="compass" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-sky-50 text-sky-700 border border-sky-200">
                                01 • Estratégia
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-[#00a3e0] transition">
                            Consultoria em transformação digital
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Apoio estratégico para modernizar a empresa com tecnologia, processos e cultura digital.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Roteiro de transformação</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Priorização de investimentos</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Acompanhamento da implementação</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-[#00a3e0] text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Solicitar Consultoria</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 2: Criação de websites -->
                <div class="service-card flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center border border-indigo-100 group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="globe" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-indigo-50 text-indigo-700 border border-indigo-200">
                                02 • Presença Online
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-indigo-600 transition">
                            Criação de websites
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Desenvolvimento de websites institucionais, páginas comerciais e lojas online responsivas.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Design moderno e responsivo</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>SEO e performance</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Gestão de conteúdos simples</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-indigo-600 text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Criar Meu Website</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 3: Digitalização de processos empresariais -->
                <div class="service-card flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="workflow" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-amber-50 text-amber-800 border border-amber-200">
                                03 • Automação
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-amber-600 transition">
                            Digitalização de processos empresariais
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Mapeamos e digitalizamos processos internos para reduzir papel, erros e tempos de operação.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Diagnóstico de processos</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Automação de fluxos</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Ganho de eficiência operacional</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-amber-600 text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Digitalizar Processos</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 4: Implementação de sistemas de gestão -->
                <div class="service-card flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-100 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="database" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 border border-emerald-200">
                                04 • ERP &amp; Gestão
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-emerald-600 transition">
                            Implementação de sistemas de gestão
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Implementação e configuração de sistemas de gestão adaptados à realidade da sua empresa.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Sistemas sob medida</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Integração com processos actuais</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Formação da equipa utilizadora</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-emerald-600 text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Implementar Sistema</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 5: Suporte técnico especializado -->
                <div class="service-card flex flex-col justify-between group md:col-span-2 lg:col-span-2">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-cyan-50 text-cyan-600 flex items-center justify-center border border-cyan-100 group-hover:scale-110 group-hover:bg-cyan-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="headphones" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-cyan-50 text-cyan-800 border border-cyan-200">
                                05 • Helpdesk &amp; Manutenção
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-cyan-600 transition">
                            Suporte técnico especializado
                        </h3>

                        <p class="text-slate-600 text-sm sm:text-base mt-3 leading-relaxed">
                            Assistência técnica contínua a sistemas, equipamentos e utilizadores para manter a operação estável.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="flex items-center gap-2.5 text-xs sm:text-sm text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Atendimento remoto e presencial</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs sm:text-sm text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Resolução rápida de incidentes</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs sm:text-sm text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Manutenção preventiva</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 py-3 px-6 rounded-xl bg-slate-900 hover:bg-cyan-600 text-white font-bold text-xs transition duration-200">
                            <span>Contratar Suporte Técnico Especializado</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

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
</body>
</html>