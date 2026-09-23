<!DOCTYPE html>
<html lang="pt" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Print — Impressão Institucional, Brindes &amp; Produção Gráfica Corporativa</title>
    <meta name="description" content="RACHI Print — Impressão de documentos institucionais, materiais promocionais, produção gráfica corporativa e gráfica para eventos com acabamentos de alta qualidade em Angola.">

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
                        brandDark: '#080c16',
                        brandSurface: '#0f1626',
                        brandSurfaceLight: '#162035',
                        brandGold: '#f5a800',
                        brandGoldHover: '#d97706',
                        brandGoldGlow: 'rgba(245, 168, 0, 0.35)',
                        brandBlue: '#00a3e0',
                        brandNavy: '#071326',
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
        section[id], div[id] { scroll-margin-top: 90px; }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #080c16;
            color: #f1f5f9;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, .font-display {
            font-family: 'Outfit', sans-serif;
        }

        /* Ambient Glow Backgrounds inspired by SmashingLogo */
        .ambient-bg {
            background: 
                radial-gradient(75% 95% at 82% -5%, rgba(245, 168, 0, 0.16), transparent 58%),
                radial-gradient(60% 80% at 12% 45%, rgba(0, 163, 224, 0.12), transparent 62%),
                radial-gradient(45% 60% at 70% 95%, rgba(245, 168, 0, 0.08), transparent 65%),
                #080c16;
        }

        /* Sleek Top Navigation Bar */
        .nav-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            background: rgba(8, 12, 22, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.3s ease;
        }
        .nav-header.scrolled {
            background: rgba(8, 12, 22, 0.95);
            border-bottom-color: rgba(245, 168, 0, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        }

        /* Buttons like SmashingLogo */
        .btn-upload-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, #f5a800 0%, #e08b00 100%);
            color: #071326;
            border: none;
            padding: 15px 32px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 20px rgba(245, 168, 0, 0.4);
            text-decoration: none;
        }
        .btn-upload-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(245, 168, 0, 0.55);
            color: #050d1a;
        }

        .btn-watch-examples {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: rgba(255, 255, 255, 0.04);
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.12);
            padding: 15px 28px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            text-decoration: none;
        }
        .btn-watch-examples:hover {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(245, 168, 0, 0.4);
            color: #f5a800;
            transform: translateY(-2px);
        }

        /* SmashingLogo-style Feature Card */
        .feature-card {
            background: rgba(255, 255, 255, 0.02);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.07);
            padding: 30px 24px;
            text-align: left;
            transition: all 0.3s ease;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.35);
            position: relative;
            overflow: hidden;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            border-color: rgba(245, 168, 0, 0.35);
            background: rgba(255, 255, 255, 0.04);
            box-shadow: 0 16px 36px rgba(0, 0, 0, 0.5), 0 0 20px rgba(245, 168, 0, 0.1);
        }

        /* Visual Stack Cards (Hero 3D mockup effect) */
        .hero-stack-card {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
</head>
<body x-data="rachiPrintStudio()" class="ambient-bg antialiased">

    <!-- ============================================================ -->
    <!-- NAVIGATION (SmashingLogo Model + RACHI Ecosystem)            -->
    <!-- ============================================================ -->
    <header class="nav-header" id="navbar">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            
            <!-- Brand Logo Oficial RACHI Print -->
            <a href="/" class="flex items-center gap-3 group text-decoration-none" title="Ir para a página inicial (Portal RACHI)">
                <div class="h-12 px-2 py-1 rounded-xl bg-white/[0.06] border border-white/10 group-hover:border-amber-400/40 flex items-center justify-center transition-all duration-200 group-hover:scale-105 shadow-sm">
                    <picture class="flex items-center">
                        <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                        <img src="/images/areas/rachi-print.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-print.png'" 
                             alt="RACHI Print" 
                             class="h-10 w-auto object-contain filter drop-shadow-[0_0_6px_rgba(255,255,255,0.35)]">
                    </picture>
                </div>
                <div class="flex flex-col">
                    <span class="font-display font-black text-lg tracking-wider text-white flex items-center gap-1.5">
                        RACHI <span class="text-[#f5a800] text-xs font-bold px-2 py-0.5 rounded-full bg-amber-500/10 border border-amber-500/20">PRINT</span>
                    </span>
                    <span class="text-[10px] text-slate-400 tracking-widest uppercase font-medium">Gráfica &amp; Produção</span>
                </div>
            </a>

            <!-- Central Nav Links -->
            <nav class="hidden lg:flex items-center gap-1 bg-white/[0.04] border border-white/[0.08] p-1.5 rounded-full backdrop-blur-md">
                <a href="/" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-full transition">Home</a>
                
                <!-- Solutions Dropdown -->
                <div class="relative" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white flex items-center gap-1.5 rounded-full transition">
                        <span>Soluções</span>
                        <i data-lucide="chevron-down" class="w-3.5 h-3.5 transition-transform" :class="open ? 'rotate-180 text-amber-400' : ''"></i>
                    </button>
                    <div x-show="open" x-cloak class="absolute top-full mt-2 w-64 p-2 bg-[#0d1527]/95 border border-white/10 rounded-2xl shadow-2xl backdrop-blur-xl space-y-1">
                        <a href="/capital" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-white/5 transition">
                            <span class="w-7 h-7 rounded-lg bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs font-bold">01</span>
                            <div>
                                <div class="text-xs font-bold text-white">RACHI Human Capital</div>
                                <div class="text-[10px] text-slate-400">Recrutamento &amp; RH</div>
                            </div>
                        </a>
                        <a href="/academy" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-white/5 transition">
                            <span class="w-7 h-7 rounded-lg bg-indigo-500/20 text-indigo-400 flex items-center justify-center text-xs font-bold">02</span>
                            <div>
                                <div class="text-xs font-bold text-white">RACHI Academy</div>
                                <div class="text-[10px] text-slate-400">Educação &amp; Treinamento</div>
                            </div>
                        </a>
                        <a href="/tec" class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-white/5 transition">
                            <span class="w-7 h-7 rounded-lg bg-sky-500/20 text-sky-400 flex items-center justify-center text-xs font-bold">03</span>
                            <div>
                                <div class="text-xs font-bold text-white">RACHI Tec</div>
                                <div class="text-[10px] text-slate-400">Sistemas &amp; TI</div>
                            </div>
                        </a>
                        <a href="/print" class="flex items-center gap-3 p-2.5 rounded-xl bg-amber-500/15 border border-amber-500/30 transition">
                            <span class="w-7 h-7 rounded-lg bg-amber-500/20 text-amber-400 flex items-center justify-center text-xs font-bold">04</span>
                            <div>
                                <div class="text-xs font-bold text-amber-300">RACHI Print</div>
                                <div class="text-[10px] text-amber-400/80">Gráfica &amp; Produção</div>
                            </div>
                        </a>
                    </div>
                </div>

                <a href="#produtos-graficos" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-full transition">Produtos</a>
                <a href="#como-funciona" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-full transition">Diferenciais</a>
                <a href="/loja" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-full transition">Loja</a>
                <a href="/contacto" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-full transition">Pedir Orçamento</a>
                <a href="/contacto" class="px-4 py-2 text-sm font-medium text-slate-300 hover:text-white rounded-full transition">Contacto</a>
            </nav>

            <!-- Action Buttons -->
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

                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 rounded-xl bg-white/5 border border-white/10 text-white">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown -->
        <div x-show="mobileMenuOpen" @click.away="mobileMenuOpen = false" x-cloak class="lg:hidden bg-[#080c16]/98 border-b border-white/10 px-6 py-4 space-y-3">
            <a href="/" class="block py-2 text-sm font-medium text-slate-300">Home</a>
            <div class="pt-2 border-t border-white/10 space-y-1">
                <span class="text-xs uppercase font-bold text-amber-400 tracking-wider">Soluções</span>
                <a href="/capital" class="block pl-3 text-xs text-slate-400 py-1">01 RACHI Human Capital</a>
                <a href="/academy" class="block pl-3 text-xs text-slate-400 py-1">02 RACHI Academy</a>
                <a href="/tec" class="block pl-3 text-xs text-slate-400 py-1">03 RACHI Tec</a>
                <a href="/print" class="block pl-3 text-xs text-amber-400 font-bold py-1">04 RACHI Print</a>
            </div>
            <div class="pt-2 border-t border-white/10 space-y-2">
                <a href="#produtos-graficos" @click="mobileMenuOpen = false" class="block text-sm text-slate-300 py-1">Produtos Gráficos</a>
                <a href="#como-funciona" @click="mobileMenuOpen = false" class="block text-sm text-slate-300 py-1">Diferenciais</a>
                <a href="/contacto" class="block text-sm text-amber-400 font-bold py-1">Pedir Orçamento</a>
                <a href="/contacto" class="block text-sm text-slate-300 py-1">Contacto</a>
            </div>
        </div>
    </header>

    <!-- ============================================================ -->
    <!-- HERO SECTION (SmashingLogo Model)                            -->
    <!-- ============================================================ -->
    <main class="pt-32 pb-20">
        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center pt-8 sm:pt-14">
            <div class="space-y-8 max-w-4xl mx-auto">
                
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/30 text-amber-300 text-xs font-semibold">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    <span>Gráfica de Alto Padrão • Luanda &amp; Províncias</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-6xl lg:text-7xl font-black text-white leading-tight tracking-tight">
                    Dê vida aos seus materiais com <br class="hidden sm:inline">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#f5a800] via-[#ffd580] to-[#f5a800]">acabamento institucional</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-slate-300 text-base sm:text-xl leading-relaxed max-w-3xl mx-auto font-normal">
                    Produção gráfica corporativa, brindes promocionais e documentos institucionais de alta definição que destacam a sua empresa, impressionam clientes e garantem total conformidade de marca.
                </p>

                <!-- CTA Buttons (Exact SmashingLogo style) -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-2">
                    <a href="/contacto" class="btn-upload-primary">
                        <i data-lucide="printer" class="w-5 h-5"></i>
                        <span>Solicitar Cotação</span>
                    </a>

                    <a href="#produtos-graficos" class="btn-watch-examples">
                        <i data-lucide="layers" class="w-5 h-5 text-amber-400"></i>
                        <span>Ver 4 Linhas de Produção</span>
                    </a>
                </div>

                <!-- Trust Indicators -->
                <div class="pt-8 border-t border-white/10 max-w-2xl mx-auto flex flex-wrap items-center justify-center gap-8 sm:gap-12 text-xs sm:text-sm text-slate-300">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-emerald-500/10 text-emerald-400 flex items-center justify-center shrink-0">
                            <i data-lucide="check-circle" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Offset &amp; Digital</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-amber-500/10 text-amber-400 flex items-center justify-center shrink-0">
                            <i data-lucide="shield-check" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">100% Controlo de Qualidade</span>
                    </div>
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-sky-500/10 text-sky-400 flex items-center justify-center shrink-0">
                            <i data-lucide="truck" class="w-4 h-4"></i>
                        </div>
                        <span class="font-medium">Entrega Nacional</span>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================================ -->
        <!-- FEATURE HIGHLIGHTS (SmashingLogo Model)                       -->
        <!-- ============================================================ -->
        <section id="como-funciona" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-28">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-400 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/20">
                    Excelência em Cada Detalhe
                </span>
                <h2 class="text-3xl sm:text-4xl font-black text-white mt-4">
                    Por que as empresas líderes confiam na RACHI Print
                </h2>
                <p class="text-slate-400 text-sm sm:text-base mt-3">
                    Combinamos capacidade industrial com acabamentos manuais nobres para posicionar a sua marca com máxima autoridade.
                </p>
            </div>

            <!-- 4 Grid Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                
                <!-- Card 1 -->
                <div class="feature-card group">
                    <div class="w-12 h-12 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-amber-400 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <i data-lucide="award" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Faça sua empresa parecer maior</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Transforme apresentações e relatórios em publicações executivas que transmitem solidez, prestígio institucional e credibilidade.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="feature-card group">
                    <div class="w-12 h-12 rounded-2xl bg-blue-500/15 border border-blue-500/30 text-blue-400 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Destaque-se da concorrência</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Acabamentos com verniz UV localizado, laminação soft-touch, relevo seco e hot-stamping que colocam sua marca num patamar superior.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="feature-card group">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <i data-lucide="calendar" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Perfeito para eventos &amp; campanhas</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Produção ágil de credenciais, sinalética, backdrops e brindes temáticos prontos no prazo exato da sua activação ou feira.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="feature-card group">
                    <div class="w-12 h-12 rounded-2xl bg-purple-500/15 border border-purple-500/30 text-purple-400 flex items-center justify-center mb-5 group-hover:scale-110 transition">
                        <i data-lucide="sliders" class="w-6 h-6"></i>
                    </div>
                    <h3 class="text-lg font-bold text-white mb-2">Feito sob medida para seu orçamento</h3>
                    <p class="text-xs text-slate-400 leading-relaxed">
                        Flexibilidade de tiragens: desde pequenas tiragens digitais sob demanda até grandes tiragens offset para ampla distribuição.
                    </p>
                </div>

            </div>
        </section>

        <!-- ============================================================ -->
        <!-- SHOWCASE SECTION: "Veja no que seus materiais gráficos      -->
        <!-- podem se transformar" (As 4 Informações Oficiais Solicitadas)-->
        <!-- ============================================================ -->
        <section id="produtos-graficos" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-32">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-xs font-bold uppercase tracking-widest text-amber-400 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/20">
                    Catálogo de Soluções
                </span>
                <h2 class="text-3xl sm:text-5xl font-black text-white mt-4">
                    Veja no que seus materiais gráficos podem se transformar
                </h2>
                <p class="text-slate-400 text-sm sm:text-base mt-3">
                    As quatro linhas oficiais de produção da RACHI Print, prontas para atender as exigências mais elevadas de empresas e instituições.
                </p>
            </div>

            <!-- 4 Detailed Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- PRODUTO 1: Impressão de documentos institucionais -->
                <div class="bg-[#0f1626]/90 border border-white/10 hover:border-blue-400/60 rounded-3xl p-8 sm:p-9 transition duration-300 flex flex-col justify-between group shadow-xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-blue-500/20 transition"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-blue-500/15 border border-blue-500/30 text-blue-400 flex items-center justify-center">
                                <i data-lucide="file-text" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-blue-500/10 text-blue-300 border border-blue-500/20">
                                Documentos Oficiais
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-bold text-white group-hover:text-blue-300 transition">
                            Impressão de documentos institucionais
                        </h3>

                        <p class="text-slate-300 text-sm sm:text-base mt-3.5 leading-relaxed font-normal">
                            Impressão de relatórios, brochuras, manuais, propostas e documentos oficiais com qualidade institucional.
                        </p>

                        <!-- Bullets Oficiais -->
                        <div class="mt-6 pt-6 border-t border-white/10 space-y-3">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Impressão a cores e P&amp;B</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Acabamentos variados</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Tiragens flexíveis</span>
                            </div>
                        </div>

                        <!-- Aplicações Práticas -->
                        <div class="mt-6 p-4 rounded-2xl bg-white/[0.03] border border-white/5 text-xs text-slate-400 space-y-1">
                            <span class="font-bold text-slate-300 block uppercase text-[10px] tracking-wider">Aplicações comuns:</span>
                            <span>Relatórios de Gestão &amp; Contas, Manuais de Procedimentos, Propostas de Concurso Público, Livros Institucionais e Certificados Oficiais.</span>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-white/10">
                        <a href="/contacto" class="w-full py-3.5 px-5 rounded-xl bg-white/5 hover:bg-blue-600 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                            <span>Solicitar Cotação de Documentos</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- PRODUTO 2: Materiais promocionais -->
                <div class="bg-[#0f1626]/90 border border-white/10 hover:border-amber-400/60 rounded-3xl p-8 sm:p-9 transition duration-300 flex flex-col justify-between group shadow-xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-amber-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-amber-500/20 transition"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-amber-500/15 border border-amber-500/30 text-amber-400 flex items-center justify-center">
                                <i data-lucide="gift" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-amber-500/10 text-amber-300 border border-amber-500/20">
                                Brindes &amp; Ativação
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-bold text-white group-hover:text-amber-300 transition">
                            Materiais promocionais
                        </h3>

                        <p class="text-slate-300 text-sm sm:text-base mt-3.5 leading-relaxed font-normal">
                            Criação e produção de brindes e materiais promocionais para campanhas, activações e fidelização.
                        </p>

                        <!-- Bullets Oficiais -->
                        <div class="mt-6 pt-6 border-t border-white/10 space-y-3">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Brindes personalizados</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Campanhas e activações</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Opções para diferentes orçamentos</span>
                            </div>
                        </div>

                        <!-- Aplicações Práticas -->
                        <div class="mt-6 p-4 rounded-2xl bg-white/[0.03] border border-white/5 text-xs text-slate-400 space-y-1">
                            <span class="font-bold text-slate-300 block uppercase text-[10px] tracking-wider">Aplicações comuns:</span>
                            <span>Agendas Executivas, Cadernos Corporativos, T-Shirts &amp; Polos bordados, Garrafas Térmicas, Canecas, Pen Drives, Mochilas e Kits Onboarding.</span>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-white/10">
                        <a href="/contacto" class="w-full py-3.5 px-5 rounded-xl bg-white/5 hover:bg-amber-500 hover:text-[#071326] text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                            <span>Solicitar Cotação de Brindes</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- PRODUTO 3: Produção gráfica corporativa -->
                <div class="bg-[#0f1626]/90 border border-white/10 hover:border-emerald-400/60 rounded-3xl p-8 sm:p-9 transition duration-300 flex flex-col justify-between group shadow-xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-emerald-500/20 transition"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-emerald-500/15 border border-emerald-500/30 text-emerald-400 flex items-center justify-center">
                                <i data-lucide="briefcase" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-emerald-500/10 text-emerald-300 border border-emerald-500/20">
                                Papelaria &amp; Identidade
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-bold text-white group-hover:text-emerald-300 transition">
                            Produção gráfica corporativa
                        </h3>

                        <p class="text-slate-300 text-sm sm:text-base mt-3.5 leading-relaxed font-normal">
                            Produção de materiais gráficos alinhados à identidade visual da sua empresa ou instituição.
                        </p>

                        <!-- Bullets Oficiais -->
                        <div class="mt-6 pt-6 border-t border-white/10 space-y-3">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Identidade visual consistente</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Acabamento profissional</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Prazos e qualidade controlados</span>
                            </div>
                        </div>

                        <!-- Aplicações Práticas -->
                        <div class="mt-6 p-4 rounded-2xl bg-white/[0.03] border border-white/5 text-xs text-slate-400 space-y-1">
                            <span class="font-bold text-slate-300 block uppercase text-[10px] tracking-wider">Aplicações comuns:</span>
                            <span>Cartões de Visita (soft touch, cantos redondos), Pastas com bolsa e orelha, Papel Timbrado, Envelopes Timbrados e Carimbos automáticos.</span>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-white/10">
                        <a href="/contacto" class="w-full py-3.5 px-5 rounded-xl bg-white/5 hover:bg-emerald-600 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                            <span>Solicitar Cotação Corporativa</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

                <!-- PRODUTO 4: Produção gráfica para eventos -->
                <div class="bg-[#0f1626]/90 border border-white/10 hover:border-purple-400/60 rounded-3xl p-8 sm:p-9 transition duration-300 flex flex-col justify-between group shadow-xl relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl pointer-events-none group-hover:bg-purple-500/20 transition"></div>
                    
                    <div>
                        <div class="flex items-center justify-between mb-5">
                            <div class="w-14 h-14 rounded-2xl bg-purple-500/15 border border-purple-500/30 text-purple-400 flex items-center justify-center">
                                <i data-lucide="calendar-range" class="w-7 h-7"></i>
                            </div>
                            <span class="text-[11px] font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full bg-purple-500/10 text-purple-300 border border-purple-500/20">
                                Grandes Formatos &amp; Feiras
                            </span>
                        </div>

                        <h3 class="text-2xl sm:text-3xl font-bold text-white group-hover:text-purple-300 transition">
                            Produção gráfica para eventos
                        </h3>

                        <p class="text-slate-300 text-sm sm:text-base mt-3.5 leading-relaxed font-normal">
                            Produção de banners, convites, credenciais, sinalética e materiais para eventos corporativos.
                        </p>

                        <!-- Bullets Oficiais -->
                        <div class="mt-6 pt-6 border-t border-white/10 space-y-3">
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Materiais para todos os formatos</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Entrega alinhada ao evento</span>
                            </div>
                            <div class="flex items-center gap-3 text-xs sm:text-sm font-semibold text-slate-200">
                                <span class="w-5 h-5 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs shrink-0 font-bold">✓</span>
                                <span>Impacto visual e legibilidade</span>
                            </div>
                        </div>

                        <!-- Aplicações Práticas -->
                        <div class="mt-6 p-4 rounded-2xl bg-white/[0.03] border border-white/5 text-xs text-slate-400 space-y-1">
                            <span class="font-bold text-slate-300 block uppercase text-[10px] tracking-wider">Aplicações comuns:</span>
                            <span>Roll-up Banners (85x200cm, 120x200cm), Backdrops de Palco, Credenciais em PVC com fita personalizada, Totens e Sinalética Direcional.</span>
                        </div>
                    </div>

                    <div class="pt-6 mt-6 border-t border-white/10">
                        <a href="/contacto" class="w-full py-3.5 px-5 rounded-xl bg-white/5 hover:bg-purple-600 text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2">
                            <span>Solicitar Cotação para Eventos</span>
                            <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>

            </div>
        </section>

        <!-- ============================================================ -->
        <!-- TRUST & TECHNICAL SPECS BAR                                  -->
        <!-- ============================================================ -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-28">
            <div class="p-8 sm:p-10 rounded-3xl bg-gradient-to-r from-white/[0.02] via-white/[0.04] to-white/[0.02] border border-white/10">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                    <div>
                        <div class="text-3xl sm:text-4xl font-black text-[#f5a800]">+1.2M</div>
                        <div class="text-xs text-slate-400 font-medium mt-1">Páginas &amp; Peças Entregues</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-black text-emerald-400">100%</div>
                        <div class="text-xs text-slate-400 font-medium mt-1">Fidelidade Cromática &amp; ISO</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-black text-sky-400">48h</div>
                        <div class="text-xs text-slate-400 font-medium mt-1">Opção Express em Luanda</div>
                    </div>
                    <div>
                        <div class="text-3xl sm:text-4xl font-black text-purple-400">18</div>
                        <div class="text-xs text-slate-400 font-medium mt-1">Províncias Atendidas</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- ============================================================ -->
        <!-- CALL TO ACTION BANNER (Sleek Dark Studio CTA)                -->
        <!-- ============================================================ -->
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-28 mb-12">
            <div class="relative rounded-3xl p-10 sm:p-14 bg-gradient-to-br from-[#0e172a] to-[#0a101d] border border-amber-500/30 overflow-hidden shadow-2xl text-center">
                <div class="absolute -top-20 -right-20 w-80 h-80 bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-sky-500/10 rounded-full blur-3xl pointer-events-none"></div>

                <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                    <span class="text-xs font-bold uppercase tracking-widest text-amber-400 px-3 py-1 rounded-full bg-amber-400/10 border border-amber-400/20">
                        Atendimento Corporativo
                    </span>
                    <h2 class="text-3xl sm:text-4xl font-black text-white">
                        Pronto para elevar a produção gráfica da sua instituição?
                    </h2>
                    <p class="text-slate-300 text-sm sm:text-base">
                        Fale diretamente com os nossos consultores gráficos e receba um orçamento personalizado com as melhores especificações para o seu projeto.
                    </p>
                    <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="/contacto" class="btn-upload-primary">
                            <i data-lucide="mail" class="w-5 h-5"></i>
                            <span>Falar Connosco / Pedir Proposta</span>
                        </a>
                        <a href="https://wa.me/244923000000?text=Ol%C3%A1!%20Gostaria%20de%20solicitar%20uma%20cota%C3%A7%C3%A3o%20para%20a%20RACHI%20Print." target="_blank" class="btn-watch-examples">
                            <i data-lucide="message-circle" class="w-5 h-5 text-emerald-400"></i>
                            <span>WhatsApp Direto</span>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- ============================================================ -->
    <!-- FOOTER (Exact Minimalist SmashingLogo Style)                 -->
    <!-- ============================================================ -->
    <footer class="border-t border-white/10 bg-[#060911] py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-6">
                
                <!-- Brand & Copyright -->
                <a href="/" class="flex items-center gap-3 group text-decoration-none" title="Ir para a página inicial (Portal RACHI)">
                    <picture class="flex items-center">
                        <source srcset="/images/areas/rachi-print.webp" type="image/webp">
                        <img src="/images/areas/rachi-print.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-print.png'" 
                             alt="RACHI Print" 
                             class="h-8 w-auto object-contain filter drop-shadow-[0_0_4px_rgba(255,255,255,0.35)] group-hover:scale-105 transition-all">
                    </picture>
                    <div class="text-xs text-slate-400">
                        &copy; 2026 <strong class="text-white">RACHI Print</strong>. Todos os direitos reservados.
                    </div>
                </a>

                <!-- Footer Nav Links -->
                <div class="flex flex-wrap items-center justify-center gap-6 text-xs text-slate-400">
                    <a href="/" class="hover:text-white transition">Portal RACHI</a>
                    <a href="/capital" class="hover:text-emerald-400 transition">Human Capital</a>
                    <a href="/academy" class="hover:text-indigo-400 transition">Academy</a>
                    <a href="/tec" class="hover:text-sky-400 transition">Tec</a>
                    <a href="/contacto" class="hover:text-[#f5a800] transition">Contacto</a>
                </div>

            </div>
        </div>
    </footer>

    <!-- Alpine.js Application Logic -->
    <script>
        function rachiPrintStudio() {
            return {
                mobileMenuOpen: false,

                init() {
                    window.addEventListener('scroll', () => {
                        const nav = document.getElementById('navbar');
                        if (window.scrollY > 30) {
                            nav.classList.add('scrolled');
                        } else {
                            nav.classList.remove('scrolled');
                        }
                    });
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    </script>
</body>
</html>