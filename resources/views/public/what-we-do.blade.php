<!DOCTYPE html>
<html lang="pt">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Que Fazemos — RACHI</title>
    <meta name="description" content="RACHI — soluções inteligentes em tecnologia, educação e serviços empresariais.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="preload" as="style" href="/build/assets/app-B40JgtYj.css" /><link rel="modulepreload" href="/build/assets/app-Dn06r9IG.js" /><link rel="stylesheet" href="/build/assets/app-B40JgtYj.css" />    <script defer src="/libs/alpine.js"></script>
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
        .site-header.header-scrolled-light .header-dropdown {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(11, 26, 46, 0.1) !important;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12), 0 5px 15px rgba(0, 0, 0, 0.06) !important;
        }
        .site-header.header-scrolled-light .header-dropdown a {
            color: #334155 !important;
        }
        .site-header.header-scrolled-light .header-dropdown a:hover {
            background: #f1f5f9 !important;
            color: #0077c2 !important;
        }
        .site-header.header-scrolled-light .header-dropdown .dropdown-title {
            color: #0f172a !important;
        }
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
<body x-data="{ currentTab: 'what-we-do', mobileMenuOpen: false, goToHome() { location.href = '/'; }, scrollToSection(section) { location.href = '/' + section; }, openUnitPage(unit) { location.href = '/' + unit; }, openStore() { location.href = '/loja'; }, openContacto() { location.href = '/contacto'; } }" class="min-h-screen flex flex-col justify-between">
    <!-- EXACT NAV BAR -->
    <!-- HEADER DUAL-THEME: ESCURO NO TOPO, CLARO AO ROLAR (ESTILO KLASSE.AO) -->
        <header id="main-site-header" class="site-header header-top-dark px-4 sm:px-6 lg:px-8 py-5 lg:py-6 transition-all duration-300">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                <!-- Coluna 1 (Esquerda): Logótipo RACHI -->
                <div class="flex-1 flex items-center justify-start min-w-0">
                    <a href="#home" @click.prevent="goToHome()" class="flex items-center group cursor-pointer transition-transform duration-200 hover:scale-[1.02]">
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
                    <a href="#home" @click.prevent="goToHome()" class="nav-link cursor-pointer" :class="currentTab === 'home' ? 'active' : ''">
                        <span>Home</span>
                    </a>
                    
                    <!-- Sobre Nós Dropdown -->
                    <div class="relative" x-data="{ open: false , solutionsOpen: false}" @mouseleave="open = false">
                        <button @mouseover="open = true" @click="open = !open" class="nav-link flex items-center gap-1.5 focus:outline-none" :class="open ? 'nav-link-open' : ''">
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
                             class="header-dropdown absolute top-full left-0 mt-3 w-56 bg-[#071326]/95 backdrop-blur-2xl border border-white/15 rounded-2xl shadow-2xl p-2 z-50 text-sm space-y-1">
                            <a href="#sobre" @click.prevent="scrollToSection('sobre'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-blue-500/15 text-blue-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="info" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Quem somos</span>
                            </a>
                            <a href="#o-que-fazemos" @click.prevent="scrollToSection('o-que-fazemos'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-cyan-500/15 text-cyan-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="layers" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">O que fazemos</span>
                            </a>
                            <a href="#parceiros" @click.prevent="scrollToSection('parceiros'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-amber-500/15 text-amber-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="handshake" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Parceiros</span>
                            </a>
                            <a href="#depoimentos" @click.prevent="scrollToSection('depoimentos'); open = false" class="flex items-center gap-2.5 px-3.5 py-2.5 rounded-xl text-slate-300 hover:text-white hover:bg-blue-600/20 transition">
                                <span class="w-7 h-7 rounded-lg bg-pink-500/15 text-pink-400 flex items-center justify-center shrink-0">
                                    <i data-lucide="message-square" class="w-4 h-4"></i>
                                </span>
                                <span class="font-medium text-xs dropdown-title">Depoimentos</span>
                            </a>
                        </div>
                    </div>

                    <!-- Soluções (Mega Menu Ecossistema RACHI) -->
                    <button type="button"
                        @click="solutionsOpen = !solutionsOpen"
                        class="nav-link relative flex items-center gap-1.5 focus:outline-none cursor-pointer transition-all duration-200"
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

                    <a href="#etica" @click.prevent="scrollToSection('etica')" class="nav-link" :class="currentTab === 'etica' ? 'active' : ''">
                        <span>Ética e Compliance</span>
                    </a>
                    <a href="#loja" @click.prevent="openStore()" class="nav-link" :class="currentTab === 'loja' ? 'active' : ''">
                        <span>Loja</span>
                    </a>
                    <a href="/contacto" @click.prevent="openContacto()" class="nav-link" :class="currentTab === 'contacto' ? 'active' : ''">
                        <span>Contacto</span>
                    </a>
                </nav>
            </div>

            <!-- Coluna 3 (Direita): Autenticação e Ações Rápidas -->
            <div class="flex-1 flex items-center justify-end min-w-0 gap-2.5 sm:gap-3">
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
                <a href="#home" @click.prevent="goToHome()" class="block font-medium py-1.5 hover:text-[#00a3e0]">Home</a>
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
                    <a href="#etica" @click.prevent="scrollToSection('etica')" class="block font-medium py-1 hover:text-[#00a3e0]">Ética e Compliance</a>
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
            Capacidades da Empresa
        </span>
        <h1 class="text-4xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
            O Que <span class="text-[#eba72d]">Fazemos</span>
        </h1>
        <div class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full my-6"></div>
        <p class="text-slate-300 text-lg md:text-xl max-w-3xl leading-relaxed">
            Soluções inteligentes para transformar e impulsionar o seu negócio.
        </p>
    </div>
</div>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-16">
            <div class="lg:col-span-6">
                <div class="bg-white p-6 rounded-2xl border-l-4 border-amber-500 shadow-sm mb-6">
                    <p class="text-lg font-bold text-slate-900">
                        "Mais do que serviços, entregamos soluções que geram resultados."
                    </p>
                </div>
                <p class="text-slate-600 leading-relaxed mb-4">
                    A RACHI desenvolve serviços pensados para criar, estruturar, modernizar e fortalecer empresas. A nossa lógica de actuação é simples: reduzir dificuldades, acelerar decisões e oferecer uma experiência empresarial integrada.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Acompanhamos o cliente desde a legalização do negócio até à organização administrativa, capacitação das equipas, digitalização dos processos e comunicação visual da marca.
                </p>
            </div>
            <div class="lg:col-span-6">
                <img src="https://hom.rachi.ao/assets/img/what-we-do-team.png" 
                     onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/what-we-do-team.webp'"
                     alt="Equipa RACHI" 
                     class="w-full h-auto rounded-3xl shadow-xl border border-slate-200 dark:border-slate-800 dark:hidden">
                <img src="/images/what-we-do-team-dark.jpg" 
                     onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/what-we-do-team.png'"
                     alt="Equipa RACHI" 
                     class="w-full h-auto rounded-3xl shadow-xl border border-slate-200 dark:border-slate-800 hidden dark:block">
            </div>
        </div>

        <!-- Ecosystem diagram -->
                    <!-- ECOSYSTEM INFOGRAPHIC DIAGRAM (100% VETORIAL, NÍTIDO EM RETINA/4K) -->
                    <div class="mt-16 bg-white p-6 sm:p-10 md:p-12 rounded-3xl border border-slate-200/80 shadow-2xl relative overflow-hidden">
                        <!-- Subtle background illumination -->
                        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="absolute -bottom-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

                        <div class="text-center mb-10 relative z-10">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-50 px-3.5 py-1 rounded-full border border-blue-100">
                                Visão Integrada
                            </span>
                            <h3 class="text-2xl md:text-3xl font-[850] text-[#071326] mt-2 uppercase tracking-tight">
                                O nosso ecossistema de soluções
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 max-w-xl mx-auto mt-2">
                                Uma estrutura conectada e sinérgica pensada para atender todas as fases de crescimento do seu negócio.
                            </p>
                        </div>

                        <!-- DIAGRAM CONTENT (DESKTOP TREE & RESPONSIVE GRID) -->
                        <div class="relative max-w-5xl mx-auto z-10">
                            
                            <!-- DESKTOP CONNECTOR SVG OVERLAY (Hidden on mobile) -->
                            <div class="hidden lg:block absolute inset-0 pointer-events-none z-0">
                                <svg class="w-full h-full" viewBox="0 0 1000 460" fill="none" preserveAspectRatio="none">
                                    <defs>
                                        <linearGradient id="lineGradLeft1" x1="360" y1="75" x2="460" y2="200" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#2563eb" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradLeft2" x1="360" y1="230" x2="450" y2="230" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#f59e0b" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#f59e0b" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradLeft3" x1="360" y1="385" x2="460" y2="260" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#10b981" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradRight1" x1="640" y1="75" x2="540" y2="200" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06b6d4" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradRight2" x1="640" y1="230" x2="550" y2="230" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#9333ea" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#9333ea" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradRight3" x1="640" y1="385" x2="540" y2="260" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#f97316" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#eba72d" stop-opacity="0.3"/>
                                        </linearGradient>
                                    </defs>

                                    <!-- Left Lines -->
                                    <!-- Top Left to Center -->
                                    <path d="M 360 75 C 430 75, 430 195, 465 205" stroke="url(#lineGradLeft1)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="430" cy="135" r="4.5" fill="#2563eb" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Middle Left to Center -->
                                    <path d="M 360 230 L 450 230" stroke="url(#lineGradLeft2)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="405" cy="230" r="4.5" fill="#f59e0b" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Bottom Left to Center -->
                                    <path d="M 360 385 C 430 385, 430 265, 465 255" stroke="url(#lineGradLeft3)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="430" cy="325" r="4.5" fill="#10b981" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Right Lines -->
                                    <!-- Top Right to Center -->
                                    <path d="M 640 75 C 570 75, 570 195, 535 205" stroke="url(#lineGradRight1)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="570" cy="135" r="4.5" fill="#06b6d4" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Middle Right to Center -->
                                    <path d="M 640 230 L 550 230" stroke="url(#lineGradRight2)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="595" cy="230" r="4.5" fill="#9333ea" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Bottom Right to Center -->
                                    <path d="M 640 385 C 570 385, 570 265, 535 255" stroke="url(#lineGradRight3)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="570" cy="325" r="4.5" fill="#f97316" stroke="#ffffff" stroke-width="2"/>
                                </svg>
                            </div>

                            <!-- 3-Column Content Grid -->
                            <div class="grid grid-cols-1 lg:grid-cols-11 gap-6 lg:gap-8 items-center relative z-10">
                                
                                <!-- LEFT COLUMN (3 Pillars) -->
                                <div class="lg:col-span-4 space-y-4">
                                    <!-- 01: Formalização Empresarial -->
                                    <div class="group bg-white hover:bg-blue-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-blue-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="file-check-2" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-blue-600 uppercase tracking-wide">
                                                Formalização Empresarial
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Legalização, constituição e regularização do negócio.
                                            </p>
                                        </div>
                                        <span class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-blue-600 border-2 border-white shadow"></span>
                                    </div>

                                    <!-- 02: Recursos Humanos -->
                                    <div class="group bg-white hover:bg-amber-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-amber-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-amber-500/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="users" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-amber-500 uppercase tracking-wide">
                                                Recursos Humanos
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Gestão de pessoas, recrutamento e desenvolvimento.
                                            </p>
                                        </div>
                                        <span class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-amber-500 border-2 border-white shadow"></span>
                                    </div>

                                    <!-- 03: Formação Profissional -->
                                    <div class="group bg-white hover:bg-emerald-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-emerald-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-emerald-600 uppercase tracking-wide">
                                                Formação Profissional
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Capacitação prática para equipas mais produtivas.
                                            </p>
                                        </div>
                                        <span class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-emerald-600 border-2 border-white shadow"></span>
                                    </div>
                                </div>

                                <!-- CENTER HUB: RACHI CENTRAL NODE -->
                                <div class="lg:col-span-3 flex flex-col items-center justify-center py-4 lg:py-0">
                                    <div class="relative group">
                                        <!-- Animated Ambient Glow -->
                                        <div class="absolute -inset-2 rounded-full bg-gradient-to-r from-blue-500 via-amber-400 to-cyan-400 opacity-30 group-hover:opacity-60 blur-md transition duration-500"></div>
                                        
                                        <!-- Central Node Badge -->
                                        <div class="relative w-36 h-36 sm:w-44 sm:h-44 rounded-full bg-[#071326] border-4 border-white shadow-2xl flex flex-col items-center justify-center text-center p-3 transition-transform duration-300 group-hover:scale-105">
                                            
                                            <!-- Brand Graphic Emblem -->
                                            <div class="w-10 h-10 sm:w-12 sm:h-12 mb-1 flex items-center justify-center">
                                                <svg viewBox="0 0 60 60" fill="none" class="w-9 h-9 sm:w-11 sm:h-11 drop-shadow">
                                                    <path d="M14 10H32C39.732 10 46 16.268 46 24C46 31.732 39.732 38 32 38H24V50H14V10Z" fill="url(#rachiHubGrad)"/>
                                                    <path d="M30 36L44 50H32L22 38H30Z" fill="#eba72d"/>
                                                    <circle cx="28" cy="24" r="6" fill="#071326"/>
                                                    <defs>
                                                        <linearGradient id="rachiHubGrad" x1="14" y1="10" x2="46" y2="38" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#00a3e0"/>
                                                            <stop offset="1" stop-color="#eba72d"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </div>

                                            <span class="text-white font-[900] text-sm sm:text-base tracking-wider uppercase leading-tight">
                                                RACHI
                                            </span>
                                            <span class="text-[8px] sm:text-[9px] font-bold text-amber-400 tracking-[0.15em] uppercase mt-0.5 leading-none">
                                                SOLUÇÕES INTELIGENTES
                                            </span>

                                            <!-- Connector Points around Circle -->
                                            <span class="absolute -top-1.5 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-[#00a3e0] border-2 border-white shadow"></span>
                                            <span class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-emerald-500 border-2 border-white shadow"></span>
                                            <span class="absolute -left-1.5 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-amber-500 border-2 border-white shadow"></span>
                                            <span class="absolute -right-1.5 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-cyan-400 border-2 border-white shadow"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT COLUMN (3 Pillars) -->
                                <div class="lg:col-span-4 space-y-4">
                                    <!-- 04: Tecnologia e Digitalização -->
                                    <div class="group bg-white hover:bg-cyan-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-cyan-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-cyan-500 border-2 border-white shadow"></span>
                                        <div class="w-12 h-12 rounded-xl bg-cyan-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-cyan-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="monitor" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-cyan-600 uppercase tracking-wide">
                                                Tecnologia e Digitalização
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Soluções tecnológicas para automatizar e escalar.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 05: Comunicação Institucional -->
                                    <div class="group bg-white hover:bg-purple-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-purple-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-purple-600 border-2 border-white shadow"></span>
                                        <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-purple-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="megaphone" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-purple-600 uppercase tracking-wide">
                                                Comunicação Institucional
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Identidade visual, marketing e presença no mercado.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 06: Produção Gráfica -->
                                    <div class="group bg-white hover:bg-orange-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-orange-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-orange-500 border-2 border-white shadow"></span>
                                        <div class="w-12 h-12 rounded-xl bg-orange-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-orange-500/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="printer" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-orange-500 uppercase tracking-wide">
                                                Produção Gráfica
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Materiais gráficos de qualidade que fortalecem a marca.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Bottom Badges / Trust Points -->
                        <div class="mt-10 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-xs font-semibold text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                                <span>Soluções 100% Integradas</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                <span>Parceiro Estratégico B2B</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span>Rigor, Inovação e Conformidade</span>
                            </div>
                        </div>
                    </div>

    
    </div>
</section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-[#071326] text-white border-t border-slate-800 py-12 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
            <div>
                <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" 
                     onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'"
                     alt="RACHI" 
                     class="h-10 mb-4">
                <p class="text-sm text-slate-400">
                    Soluções inteligentes em tecnologia, comunicação visual, formação profissional e recursos humanos.
                </p>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Unidades</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="/solucoes/tec" class="hover:text-white">RACHI Tec — Loja de TI</a></li>
                    <li><a href="/solucoes/print" class="hover:text-white">RACHI Print — Artes &amp; Logótipos</a></li>
                    <li><a href="/solucoes/academy" class="hover:text-white">RACHI Academy — Cursos</a></li>
                    <li><a href="/solucoes/capital" class="hover:text-white">RACHI Capital — Sites &amp; Suporte TI</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Links Úteis</h4>
                <ul class="space-y-2 text-sm text-slate-300">
                    <li><a href="/loja" class="hover:text-white">Loja Online</a></li>
                    <li><a href="#etica" class="hover:text-white">Ética e Compliance</a></li>
                    <li><a href="/contacto" class="hover:text-white">Contactos</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-sm tracking-wider uppercase text-amber-400 mb-3">Contacto</h4>
                <p class="text-sm text-slate-400">Luanda, Angola</p>
                <p class="text-sm text-slate-400 mt-1">geral@rachi.ao</p>
                <p class="text-sm text-slate-400 mt-1">+244 923 000 000</p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto mt-8 pt-6 border-t border-slate-800/80 text-xs text-slate-500 text-center">
            &copy; 2026 RACHI — Soluções Inteligentes. Todos os direitos reservados.
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
    <script src="/worker-public.js"></script></body>
</html>
