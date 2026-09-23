<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Human Capital — Serviços Empresariais, Recursos Humanos &amp; Contabilidade</title>
    <meta name="description" content="RACHI Human Capital — Serviços empresariais, recursos humanos, contabilidade e regularização documental em Angola.">

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
                        rachiEmerald: '#10b981',
                        rachiEmeraldDark: '#059669',
                        rachiGold: '#f5a800',
                        rachiBlue: '#00a3e0',
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
            transform: translateY(-5px);
            border-color: #34d399;
            box-shadow: 0 20px 35px -10px rgba(16, 185, 129, 0.15), 0 1px 3px rgba(0, 0, 0, 0.05);
        }
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
                <div class="relative" x-data="{ openSol: false }" @mouseleave="openSol = false">
                    <button @mouseover="openSol = true" @click="openSol = !openSol" class="nav-link flex items-center gap-1.5 focus:outline-none active">
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

            <!-- Grade de 6 Serviços Oficiais -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- SERVIÇO 1: Cedência temporária de trabalhadores -->
                <div class="service-card group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-[#10b981] flex items-center justify-center border border-emerald-100 group-hover:scale-110 group-hover:bg-[#10b981] group-hover:text-white transition-all duration-300">
                                <i data-lucide="users" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-emerald-50 text-emerald-700 border border-emerald-200">
                                01 • Gestão de Talentos
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-[#10b981] transition">
                            Cedência temporária de trabalhadores
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Disponibilização temporária de trabalhadores qualificados para a sua empresa.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Profissionais qualificados</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Processo ágil e flexível</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Conformidade legal garantida</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-[#10b981] text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Solicitar Cedência</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 2: Constituição e legalização de empresas -->
                <div class="service-card group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center border border-blue-100 group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="building-2" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-blue-50 text-blue-700 border border-blue-200">
                                02 • Legalização
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition">
                            Constituição e legalização de empresas
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Apoio completo na constituição e legalização da sua empresa.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Acompanhamento completo</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Documentação incluída</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Prazos reduzidos</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-blue-600 text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Legalizar Empresa</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 3: Consultoria em recursos humanos -->
                <div class="service-card group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-purple-50 text-purple-600 flex items-center justify-center border border-purple-100 group-hover:scale-110 group-hover:bg-purple-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="briefcase" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-purple-50 text-purple-700 border border-purple-200">
                                03 • Estratégia RH
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-purple-600 transition">
                            Consultoria em recursos humanos
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Consultoria especializada em gestão de pessoas e organizações.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Diagnóstico personalizado</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Estratégias eficazes</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Melhoria contínua</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-purple-600 text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Consultoria em RH</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 4: Organização de contabilidade -->
                <div class="service-card group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center border border-amber-100 group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="calculator" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-amber-50 text-amber-800 border border-amber-200">
                                04 • Finanças &amp; Contas
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-amber-600 transition">
                            Organização de contabilidade
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Organização documental e apoio completo à gestão contabilística.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Contabilidade organizada</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Relatórios precisos</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Apoio contínuo</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-amber-600 text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Organizar Contabilidade</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 5: Registo no INSS -->
                <div class="service-card group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center border border-sky-100 group-hover:scale-110 group-hover:bg-sky-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="shield-check" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-sky-50 text-sky-800 border border-sky-200">
                                05 • Segurança Social
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-sky-600 transition">
                            Registo no INSS
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Apoio no registo de empresas e trabalhadores no INSS.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Registo simplificado</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Conformidade assegurada</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Acompanhamento dedicado</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-sky-600 text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Registar no INSS</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- SERVIÇO 6: Regularização documental empresarial -->
                <div class="service-card group">
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center border border-teal-100 group-hover:scale-110 group-hover:bg-teal-600 group-hover:text-white transition-all duration-300">
                                <i data-lucide="file-check-2" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3 py-1 rounded-full bg-teal-50 text-teal-800 border border-teal-200">
                                06 • Compliance &amp; Arquivo
                            </span>
                        </div>

                        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 group-hover:text-teal-600 transition">
                            Regularização documental empresarial
                        </h3>

                        <p class="text-slate-600 text-sm mt-3 leading-relaxed">
                            Apoio na organização e regularização documental da sua empresa.
                        </p>

                        <!-- 3 Bullets Oficiais -->
                        <div class="mt-6 pt-5 border-t border-slate-100 space-y-2.5">
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Documentação completa</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Regularização rápida</span>
                            </div>
                            <div class="flex items-center gap-2.5 text-xs text-slate-700 font-semibold">
                                <span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 flex items-center justify-center text-[10px] shrink-0 font-bold">✓</span>
                                <span>Evite complicações legais</span>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-slate-100">
                        <a href="/contacto" class="w-full py-3 px-4 rounded-xl bg-slate-900 hover:bg-teal-600 text-white font-bold text-xs transition duration-200 flex items-center justify-center gap-2">
                            <span>Regularizar Documentos</span>
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
                        <a href="https://wa.me/244923000000?text=Ol%C3%A1!%20Gostaria%20de%20solicitar%20uma%20proposta%20de%20servi%C3%A7os%20com%20a%20RACHI%20Human%20Capital." target="_blank" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/15 border border-white/20 text-white font-semibold text-sm transition">
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
                    <!-- Footer Logo Oficial RACHI Human Capital -->
                    <a href="/" class="inline-flex items-center gap-2.5 mb-4 group text-decoration-none">
                        <picture class="flex items-center">
                            <source srcset="/images/areas/rachi-human-capital.webp" type="image/webp">
                            <img src="/images/areas/rachi-human-capital.png" 
                                 onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-human-capital.png'" 
                                 alt="RACHI Human Capital" 
                                 class="h-8 w-auto object-contain filter drop-shadow-[0_0_4px_rgba(255,255,255,0.35)] group-hover:scale-105 transition-all">
                        </picture>
                        <span class="font-display font-bold text-base text-white">RACHI <span class="text-[#10b981]">Human Capital</span></span>
                    </a>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Serviços empresariais, recursos humanos, contabilidade e regularização documental com rigor institucional.
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#10b981] mb-3">Soluções RACHI</h4>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li><a href="/capital" class="hover:text-emerald-400 transition text-emerald-400 font-bold">01 RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-indigo-400 transition">02 RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-sky-400 transition">03 RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-400 transition">04 RACHI Print</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#10b981] mb-3">Navegação</h4>
                    <ul class="space-y-2 text-xs text-slate-300">
                        <li><a href="/" class="hover:text-white transition">Portal RACHI</a></li>
                        <li><a href="#servicos-capital" class="hover:text-white transition">Os nossos serviços</a></li>
                        <li><a href="/#sobre" class="hover:text-white transition">Sobre a RACHI</a></li>
                        <li><a href="/contacto" class="hover:text-white transition">Contacto</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#10b981] mb-3">Contacto</h4>
                    <p class="text-xs text-slate-400">Luanda — Angola</p>
                    <p class="text-xs text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
                    <p class="text-xs text-slate-400 mt-2">Consultoria presencial e suporte corporativo contínuo.</p>
                </div>
            </div>
            <div class="border-t border-slate-800/80 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 gap-4">
                <div>&copy; 2026 <strong class="text-white">RACHI Human Capital</strong>. Todos os direitos reservados.</div>
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
</body>
</html>