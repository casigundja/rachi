<!DOCTYPE html>
<html lang="pt-AO" data-theme="dark" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Planos RACHI Academy: matricule-se nos melhores cursos de tecnologia, IA e negócios em Angola</title>
    <meta name="description"
        content="Planos RACHI Academy com acesso a cursos práticos de tecnologia, IA, programação, dados, cibersegurança e liderança. Certificação reconhecida, mentorias e projetos reais.">
    <link rel="canonical" href="https://rachi.ao/academy">

    <!-- Open Graph / Redes Sociais -->
    <meta property="og:title" content="Planos RACHI Academy: matricule-se nos melhores cursos de tecnologia e IA">
    <meta property="og:description"
        content="Aprenda com prática, projetos reais e certificação profissional na maior academia tecnológica e executiva de Angola.">
    <meta property="og:url" content="https://rachi.ao/academy">
    <meta property="og:site_name" content="RACHI Academy">
    <meta property="og:locale" content="pt_AO">
    <meta property="og:image" content="/images/areas/rachi-academy.png">
    <meta property="og:type" content="website">

    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">
    <link rel="shortcut icon" href="/images/logo-rachi-light.png">

    <!-- Google Fonts: Encode Sans, Inter, Montserrat & Roboto Flex -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@300;400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Montserrat:wght@400;500;600;700;800;900&family=Roboto+Flex:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5.3 CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        a {
            text-decoration: none !important;
        }

        .alert {
            border-radius: 0.75rem !important;
        }

        .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }
    </style>

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
                        sans: ['"Inter"', '"Roboto Flex"', 'sans-serif'],
                        heading: ['"Encode Sans"', '"Montserrat"', 'sans-serif'],
                    },
                    colors: {
                        rachi: {
                            navy: '#071326',
                            navyLight: '#0d1f3d',
                            blue: '#00a3e0',
                            blueDark: '#052fd3',
                            blueHover: '#0042c7',
                            gold: '#f5a800',
                            goldDark: '#eba72d',
                            surface: '#0b1629',
                            surfaceDark: '#070f1e',
                            border: '#162744',
                            borderLight: '#1f355c',
                        }
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
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        html.dark body {
            background-color: #070f1e;
            color: #ffffff;
        }

        .font-heading {
            font-family: 'Encode Sans', sans-serif;
        }

        /* Glow effects inspirados no design da Alura */
        .glow-cyan {
            box-shadow: 0 0 40px -10px rgba(0, 163, 224, 0.4);
        }

        .glow-blue {
            box-shadow: 0 0 50px -10px rgba(5, 47, 211, 0.5);
        }

        .card-plan {
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .card-plan:hover {
            transform: translateY(-6px);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none !important;
        }
        .no-scrollbar {
            -ms-overflow-style: none !important;
            scrollbar-width: none !important;
        }

        /* ============================================================== */
        /* HEADER DUAL-THEME STYLES (COR E COMPORTAMENTO DO PORTAL)       */
        /* ============================================================== */
        .site-header {
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            z-index: 1030 !important;
            width: 100% !important;
            background: rgba(7, 19, 38, 0.94) !important;
            backdrop-filter: blur(20px) saturate(180%) !important;
            -webkit-backdrop-filter: blur(20px) saturate(180%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.08) !important;
            transition: all 0.3s ease !important;
        }

        .brand-logo-img {
            height: 38px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            transition: transform 0.25s ease, filter 0.25s ease;
        }

        @media (min-width: 992px) {
            .brand-logo-img {
                height: 40px;
                max-width: 200px;
            }
        }

        /* CAPSULA CENTRAL COESA */
        .site-header .main-nav-capsule {
            display: flex;
            align-items: center;
            gap: 0.15rem;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 9999px;
            padding: 0.25rem 0.35rem;
            box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.2), 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .site-header .main-nav-capsule .nav-link {
            position: relative;
            font-size: 0.82rem;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.75) !important;
            padding: 0.4rem 0.8rem !important;
            border-radius: 9999px;
            white-space: nowrap;
            text-decoration: none;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
            letter-spacing: 0.01em;
        }

        .site-header .main-nav-capsule .nav-link:hover {
            color: #ffffff !important;
            background: rgba(255, 255, 255, 0.08);
        }

        .site-header .main-nav-capsule .nav-link.active {
            color: #ffffff !important;
            background: linear-gradient(135deg, rgba(0, 163, 224, 0.28), rgba(0, 163, 224, 0.14));
            border: 1px solid rgba(0, 163, 224, 0.45);
            box-shadow: 0 0 14px rgba(0, 163, 224, 0.25);
            font-weight: 600;
            padding: 0.4rem 0.95rem !important;
        }

        /* BOTAO DE PERFIL REFINADO & PROXIMO */
        .profile-action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: 1px solid rgba(0, 163, 224, 0.4);
            background: rgba(255, 255, 255, 0.04);
            color: #ffffff;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            text-decoration: none;
        }

        .profile-action-btn:hover {
            border-color: #00a3e0;
            background: rgba(0, 163, 224, 0.12);
            transform: translateY(-1px);
            box-shadow: 0 4px 18px rgba(0, 163, 224, 0.35);
        }

        .mobile-menu-btn {
            background: rgba(255, 255, 255, 0.06) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #ffffff !important;
        }

        /* PROFILE ICON BUTTON (Ícone de Perfil) */
        .profile-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: 1px solid rgba(0, 163, 224, 0.45);
            background: linear-gradient(135deg, rgba(0, 163, 224, 0.18) 0%, rgba(5, 25, 55, 0.5) 100%);
            color: #00a3e0;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            box-shadow: 0 2px 10px rgba(0, 163, 224, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.15);
        }

        .profile-icon-btn:hover {
            border-color: #00a3e0;
            background: linear-gradient(135deg, #00a3e0 0%, #0077c2 100%);
            color: #ffffff;
            transform: translateY(-1px) scale(1.05);
            box-shadow: 0 4px 18px rgba(0, 163, 224, 0.45);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 dark:bg-[#070f1e] dark:text-white selection:bg-[#00a3e0] selection:text-white transition-colors duration-300" x-data="rachiAcademyPlans()">

    <!-- ============================================================== -->
    <!-- 1. NAVBAR SUPERIOR OFICIAL (EXATA DO MODELO DO PRINT DA ALURA) -->
    <!-- ============================================================== -->
    <header
        class="w-full bg-white dark:bg-[#071326] border-b border-slate-200/90 dark:border-white/10 px-4 sm:px-6 lg:px-8 py-3.5 sticky top-0 z-50 backdrop-blur-2xl transition-all duration-300 shadow-[0_4px_25px_rgba(15,23,42,0.09),0_1px_4px_rgba(15,23,42,0.06)] dark:shadow-[0_4px_30px_rgba(0,0,0,0.45)]">
        <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">

            <!-- Logo Oficial -->
            <div class="flex items-center gap-3 shrink-0">
                <a href="/"
                    class="flex items-center gap-2.5 group cursor-pointer transition-transform duration-200 hover:scale-[1.02]"
                    title="Ir para a página inicial (Portal RACHI)">
                    <!-- Logo Dark Mode (Branco) -->
                    <img src="/images/logo-rachi-light.png"
                        onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'"
                        alt="RACHI Academy"
                        class="h-8 lg:h-9 w-auto object-contain filter drop-shadow-sm group-hover:drop-shadow-[0_0_14px_rgba(0,163,224,0.4)] transition-all hidden dark:block">
                    <!-- Logo Light Mode (Escuro) -->
                    <img src="/images/logo-rachi-dark.png"
                        onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi.png'"
                        alt="RACHI Academy"
                        class="h-8 lg:h-9 w-auto object-contain filter drop-shadow-sm group-hover:drop-shadow-[0_0_14px_rgba(0,80,240,0.3)] transition-all block dark:hidden">
                    <span
                        class="text-[10px] uppercase font-heading font-black tracking-[0.2em] text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/30 dark:border-[#00a3e0]/40 px-2 py-0.5 rounded-full bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 shadow-xs">
                        ACADEMY
                    </span>
                </a>
            </div>

            @php
                $catalogCourses = (isset($courses) && $courses->count() > 0)
                    ? $courses
                    : \App\Models\Course::where('status', 'published')->with('category')->get();
            @endphp

            <!-- Menu Central Cápsula Escura Premium -->
            <nav
                class="hidden lg:flex items-center justify-center bg-slate-900 dark:bg-white/[0.08] border border-slate-800/90 dark:border-white/15 rounded-full p-1 shadow-md shadow-slate-950/20 gap-0.5 text-[13px] tracking-tight transition-all">
                <a href="#home" class="px-4 py-1.5 rounded-full bg-white text-slate-900 font-bold transition-all shadow-sm">Home</a>

                <!-- Dropdown Cursos com Catálogo Animado -->
                <div class="relative" @mouseenter="openCursos = true"
                    @mouseleave="openCursos = false">
                    <a href="/academy/cursos" class="flex items-center gap-1.5 px-3.5 py-1.5 rounded-full text-slate-300 hover:text-white hover:bg-white/10 transition-all font-semibold cursor-pointer"
                        :class="openCursos ? 'text-white bg-white/15 shadow-xs' : ''">
                        <span>Cursos</span>
                        <svg class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200"
                            :class="openCursos ? 'rotate-180 text-[#00a3e0]' : ''" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>

                    <!-- Painel Dropdown Flutuante (Catálogo Animado com Rolagem Contínua) -->
                    <div x-show="openCursos" x-cloak 
                        x-data="rachiCatalogScroller()"
                        x-transition:enter="transition ease-out duration-250"
                        x-transition:enter-start="opacity-0 translate-y-2 scale-98"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-2 scale-98"
                        @mouseenter="pause()"
                        @mouseleave="resume()"
                        class="absolute top-full left-1/2 -translate-x-1/2 mt-3 w-[840px] max-w-[96vw] bg-white/95 dark:bg-[#0b162a]/95 backdrop-blur-2xl text-slate-900 dark:text-white rounded-3xl shadow-[0_25px_60px_-15px_rgba(0,0,0,0.3)] dark:shadow-[0_25px_60px_-15px_rgba(0,0,0,0.85)] border border-slate-200/90 dark:border-white/15 p-4 sm:p-5 z-[100] text-left before:content-[''] before:absolute before:-top-3 before:left-0 before:right-0 before:h-3">

                        <!-- Cabeçalho do Catálogo com Filtros e Controles -->
                        <div class="flex flex-wrap items-center justify-between gap-2.5 pb-3 mb-3 border-b border-slate-100 dark:border-white/10">
                            <div class="flex items-center gap-2">
                                <span class="text-xs font-black uppercase tracking-wider bg-gradient-to-r from-[#0050f0] to-[#00a3e0] bg-clip-text text-transparent">
                                    Catálogo de Formações
                                </span>
                                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                    {{ $catalogCourses->count() }} Ativas
                                </span>
                            </div>

                            <!-- Filtros rápidos por Categoria -->
                            <div class="flex items-center gap-1.5 text-[11px] font-medium">
                                <button type="button" @click="setCategory('all')"
                                    :class="activeCategory === 'all' ? 'bg-[#0050f0] text-white shadow-sm' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200/80 dark:hover:bg-white/10'"
                                    class="px-2.5 py-1 rounded-full transition-all cursor-pointer">
                                    Todas ({{ $catalogCourses->count() }})
                                </button>
                                <button type="button" @click="setCategory('ti')"
                                    :class="activeCategory === 'ti' ? 'bg-[#0050f0] text-white shadow-sm' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200/80 dark:hover:bg-white/10'"
                                    class="px-2.5 py-1 rounded-full transition-all cursor-pointer">
                                    Tecnologia &amp; IA
                                </button>
                                <button type="button" @click="setCategory('gestao')"
                                    :class="activeCategory === 'gestao' ? 'bg-[#0050f0] text-white shadow-sm' : 'bg-slate-100 dark:bg-white/5 text-slate-600 dark:text-slate-300 hover:bg-slate-200/80 dark:hover:bg-white/10'"
                                    class="px-2.5 py-1 rounded-full transition-all cursor-pointer">
                                    Gestão &amp; Negócios
                                </button>
                            </div>

                            <!-- Controles de Rolagem e Link Geral -->
                            <div class="flex items-center gap-2">
                                <!-- Status de Rolagem -->
                                <div class="hidden sm:inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-medium bg-slate-100 dark:bg-white/5 text-slate-500 dark:text-slate-400">
                                    <span class="w-1.5 h-1.5 rounded-full" :class="isPaused ? 'bg-amber-400' : 'bg-emerald-400 animate-ping'"></span>
                                    <span x-text="isPaused ? 'Pausado' : 'Rolando'"></span>
                                </div>

                                <!-- Setas de navegação manual -->
                                <div class="flex items-center gap-1">
                                    <button type="button" @click="scrollLeftBy(300)" 
                                        class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-white/10 dark:hover:bg-white/20 text-slate-700 dark:text-white flex items-center justify-center transition cursor-pointer"
                                        title="Rolar para a esquerda">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
                                    </button>
                                    <button type="button" @click="scrollRightBy(300)" 
                                        class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 dark:bg-white/10 dark:hover:bg-white/20 text-slate-700 dark:text-white flex items-center justify-center transition cursor-pointer"
                                        title="Rolar para a direita">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                                    </button>
                                </div>

                                <a href="/academy/cursos" @click="openCursos = false"
                                    class="text-xs font-bold text-[#0050f0] dark:text-[#00a3e0] hover:text-[#0042c7] dark:hover:text-cyan-300 flex items-center gap-1 transition ml-1">
                                    <span>Ver todas</span>
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>
                            </div>
                        </div>

                        <!-- Trilha com Rolagem Animada Automática (Passa Rolando) -->
                        <div class="relative overflow-hidden rounded-2xl">
                            <div x-ref="scrollerTrack"
                                class="flex gap-3 overflow-x-auto scroll-smooth py-1 no-scrollbar select-none cursor-grab active:cursor-grabbing"
                                style="scrollbar-width: none; -ms-overflow-style: none;">

                                <!-- Lote 1 e Lote 2 para efeito de rolagem contínua sem quebras -->
                                @for($copy = 0; $copy < 2; $copy++)
                                    <div class="grid grid-rows-2 grid-flow-col auto-cols-[270px] sm:auto-cols-[305px] gap-3 shrink-0">
                                        @foreach($catalogCourses as $course)
                                            @php
                                                $catName = $course->category->name ?? 'Formação';
                                                $isTech = Str::contains($catName, ['Tecnologia', 'TI', 'Ciber', 'Digital', 'Automação']);
                                            @endphp
                                            <a href="{{ route('academy.course.show', $course->slug) }}"
                                                @click="openCursos = false"
                                                :class="{
                                                    'opacity-35 scale-98': !matchesCategory('{{ addslashes($catName) }}'),
                                                    'opacity-100 ring-2 ring-[#0050f0] dark:ring-[#00a3e0]': activeCategory !== 'all' && matchesCategory('{{ addslashes($catName) }}')
                                                }"
                                                class="h-[106px] p-3 rounded-xl bg-slate-50/90 hover:bg-white dark:bg-white/[0.04] dark:hover:bg-white/[0.09] border border-slate-200/80 hover:border-[#0050f0] dark:border-white/10 dark:hover:border-[#00a3e0] transition-all duration-200 hover:shadow-md hover:shadow-[#0050f0]/15 dark:hover:shadow-[#00a3e0]/20 hover:-translate-y-0.5 flex flex-col justify-between group/card text-left shrink-0">
                                                
                                                <div>
                                                    <div class="flex items-center justify-between gap-1.5 mb-1">
                                                        <span class="text-[9px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full {{ $isTech ? 'bg-[#0050f0]/10 text-[#0050f0] dark:bg-[#00a3e0]/20 dark:text-[#00a3e0]' : 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 dark:bg-emerald-400/20' }}">
                                                            {{ $catName }}
                                                        </span>
                                                        <span class="text-[10px] font-mono text-slate-400 dark:text-slate-400 flex items-center gap-1 font-semibold">
                                                            <svg class="w-2.5 h-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                                            {{ $course->duration_hours ?? 40 }}h
                                                        </span>
                                                    </div>

                                                    <h4 class="font-bold text-xs text-slate-900 dark:text-white group-hover/card:text-[#0050f0] dark:group-hover/card:text-[#00a3e0] transition-colors line-clamp-1">
                                                        {{ $course->name }}
                                                    </h4>

                                                    <p class="text-[11px] text-slate-500 dark:text-slate-400 mt-0.5 line-clamp-1 leading-tight">
                                                        {{ $course->short_description ?? Str::limit($course->description, 55) }}
                                                    </p>
                                                </div>

                                                <div class="flex items-center justify-between pt-1 border-t border-slate-200/50 dark:border-white/5 text-[10px] font-semibold text-slate-400 dark:text-slate-500 group-hover/card:text-[#0050f0] dark:group-hover/card:text-[#00a3e0] transition-colors">
                                                    <span class="group-hover/card:text-[#0050f0] dark:group-hover/card:text-[#00a3e0]">Ver Programa</span>
                                                    <svg class="w-3 h-3 group-hover/card:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
                                                    </svg>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                @endfor
                            </div>

                            <!-- Gradientes de fade nas extremidades para suavizar a rolagem contínua -->
                            <div class="absolute left-0 top-0 bottom-0 w-6 bg-gradient-to-r from-white dark:from-[#0b162a] to-transparent pointer-events-none"></div>
                            <div class="absolute right-0 top-0 bottom-0 w-6 bg-gradient-to-l from-white dark:from-[#0b162a] to-transparent pointer-events-none"></div>
                        </div>

                        <!-- Rodapé do Menu com Dica e Atalhos -->
                        <div class="flex items-center justify-between mt-3 pt-2.5 border-t border-slate-100 dark:border-white/10 text-[11px] text-slate-500 dark:text-slate-400">
                            <div class="flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#0050f0] dark:bg-[#00a3e0]"></span>
                                <span>Passe o cursor sobre qualquer curso para pausar e abrir directamente.</span>
                            </div>
                            <a href="#cursos" @click="openCursos = false" class="text-[11px] font-bold text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition">
                                Ver na página ↓
                            </a>
                        </div>
                    </div>
                </div>

                <a href="#cursos" class="px-3.5 py-1.5 rounded-full text-slate-300 hover:text-white hover:bg-white/10 font-semibold transition-all">Eventos</a>
                <a href="#cursos" class="px-3.5 py-1.5 rounded-full text-slate-300 hover:text-white hover:bg-white/10 font-semibold transition-all">Conteúdos</a>
                <a href="/loja" class="px-3.5 py-1.5 rounded-full text-slate-300 hover:text-white hover:bg-white/10 font-semibold transition-all">Loja</a>
            </nav>

            <!-- Botões da Direita (Tema, Busca, CTA, Menu Mobile) -->
            <div class="flex items-center gap-2.5 sm:gap-3.5 shrink-0">
                <!-- Botão de Alternância de Tema -->
                <button type="button"
                    onclick="window.toggleRachiTheme()"
                    class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200/80 dark:bg-white/[0.05] dark:hover:bg-white/[0.12] border border-slate-200/80 hover:border-[#0050f0]/40 dark:border-white/[0.12] dark:hover:border-[#00a3e0]/40 flex items-center justify-center transition-all duration-200 cursor-pointer shadow-sm hover:shadow-md hover:shadow-[#0050f0]/15 dark:hover:shadow-[#00a3e0]/15 hover:-translate-y-0.5 group"
                    aria-label="Alternar Modo Escuro / Claro"
                    title="Alternar Modo Escuro / Claro">
                    <!-- Lua (visível no Modo Claro) -->
                    <svg class="w-4 h-4 text-slate-700 group-hover:text-slate-950 dark:hidden transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                    </svg>
                    <!-- Sol (visível no Modo Escuro) -->
                    <svg class="w-4 h-4 text-amber-400 group-hover:text-amber-300 hidden dark:block transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <circle cx="12" cy="12" r="4"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                    </svg>
                </button>

                <!-- Botão Busca Circular -->
                <a href="#cursos"
                    class="w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200/80 dark:bg-white/[0.05] dark:hover:bg-white/[0.12] text-slate-700 hover:text-slate-950 dark:text-slate-300 dark:hover:text-white flex items-center justify-center transition-all duration-200 border border-slate-200/80 hover:border-[#0050f0]/40 dark:border-white/[0.12] dark:hover:border-[#00a3e0]/40 shadow-sm hover:shadow-md hover:shadow-[#0050f0]/15 dark:hover:shadow-[#00a3e0]/15 hover:-translate-y-0.5 group"
                    title="Buscar Cursos">
                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </a>

                <!-- Botão CTA "Ver Cursos ↗" -->
                <a href="#cursos"
                    class="h-10 px-5 sm:px-6 rounded-full bg-gradient-to-r from-[#0050f0] via-[#006bf8] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec2] text-white font-bold text-xs uppercase tracking-wider transition-all duration-200 shadow-md shadow-[#0050f0]/25 hover:shadow-lg hover:shadow-[#0050f0]/45 hover:-translate-y-0.5 active:translate-y-0 inline-flex items-center justify-center gap-2 whitespace-nowrap border border-white/20 cursor-pointer group">
                    <span>Ver Cursos</span>
                    <svg class="w-3.5 h-3.5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M7 17L17 7M17 7H7M17 7v10" />
                    </svg>
                </a>

                <!-- Botão Menu Mobile (Apenas em telas menores que lg!) -->
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="lg:hidden w-10 h-10 rounded-full bg-slate-100 hover:bg-slate-200/80 dark:bg-white/[0.05] dark:hover:bg-white/[0.12] text-slate-700 dark:text-white flex items-center justify-center transition border border-slate-200/80 dark:border-white/[0.12] cursor-pointer"
                    aria-label="Abrir Menu">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
            </div>

        </div>

        <!-- Menu Mobile Dropdown -->
        <div x-show="mobileMenuOpen" x-cloak
            class="xl:hidden mt-3 p-4 bg-white dark:bg-[#0a1428] rounded-2xl border border-slate-200 dark:border-white/10 space-y-2 text-sm shadow-xl">
            <a href="#home" @click="mobileMenuOpen = false" class="block py-1.5 text-slate-900 dark:text-white font-bold">Home</a>
            <a href="#cursos" @click="mobileMenuOpen = false"
                class="block py-1.5 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white">Cursos &amp; Carreiras</a>
            <template x-if="!isLoggedIn">
                <a href="/academy/login" class="block py-1.5 text-[#0050f0] dark:text-[#00a3e0] font-bold">Entrar na Conta</a>
            </template>
            <template x-if="isLoggedIn">
                <div class="pt-2 border-t border-slate-100 dark:border-white/10 space-y-1">
                    <a href="/aluno-dashboard"
                        class="block py-1.5 text-[#0050f0] dark:text-[#00a3e0] font-bold flex items-center justify-between">
                        <span>Meu Dashboard</span>
                        <span class="text-xs bg-[#0050f0]/30 px-2 py-0.5 rounded text-white"
                            x-text="currentUser ? currentUser.nome.split(' ')[0] : 'Aluno'"></span>
                    </a>
                    <button @click="logout()" class="block w-full text-left py-1 text-rose-500 dark:text-rose-400 text-xs">Sair da
                        Conta</button>
                </div>
            </template>
        </div>
    </header>

    <!-- ============================================================== -->
    <!-- 2. HERO CAMPAIGN BANNER: CIBERSEGURANÇA (100% FULL BLEED)       -->
    <!-- ============================================================== -->
    <section id="home"
        class="relative w-full overflow-hidden bg-white dark:bg-[#060e1d] min-h-[500px] lg:min-h-[560px] flex items-stretch transition-colors duration-300">

        <!-- FUNDO AZUL: IMAGEM OFICIAL DAS ONDAS 3D (100% WIDTH COM FUSÃO SUAVE NO DARK MODE) -->
        <div class="absolute inset-0 w-full h-full">
            <img src="/images/set-bg-hero2.png" alt="Fundo Ondas 3D Cibersegurança"
                class="w-full h-full object-cover object-right opacity-95 dark:opacity-85" />
            <!-- Gradiente horizontal suave: garante leitura impecável no texto e fusão perfeita no Dark Mode -->
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/90 to-white/40 lg:to-transparent dark:from-[#060e1d] dark:via-[#060e1d]/85 dark:to-transparent/30 pointer-events-none"></div>
            <!-- Luzes ambientes e orbes de brilho neon no Dark Mode -->
            <div class="hidden dark:block absolute top-1/4 left-10 w-96 h-96 bg-[#00a3e0]/15 rounded-full blur-[130px] pointer-events-none"></div>
            <div class="hidden dark:block absolute bottom-10 left-1/3 w-80 h-80 bg-[#0050f0]/20 rounded-full blur-[140px] pointer-events-none"></div>
        </div>

        <!-- CURVA ORGÂNICA SVG: ATIVA NO MODO CLARO (Oculta no Dark Mode para fusão contínua sem cortes artificiais) -->
        <div class="hidden lg:block dark:hidden absolute inset-0 w-full h-full pointer-events-none z-10">
            <svg class="w-full h-full" preserveAspectRatio="none" viewBox="0 0 1440 640">
                <path d="M 0,0 
                         L 860,0 
                         C 850,150 915,280 910,380 
                         C 905,480 870,580 840,640 
                         L 0,640 
                         Z" class="fill-white transition-colors duration-300" />
            </svg>
        </div>

        <!-- CONTEÚDO PRINCIPAL EM GRID / FLEX -->
        <div
            class="relative z-20 w-full max-w-[1700px] mx-auto flex flex-col lg:flex-row items-center justify-between min-h-[500px] lg:min-h-[560px]">

            <!-- COLUNA DA ESQUERDA (CIBERSEGURANÇA DUAL-MODE) -->
            <div
                class="w-full lg:w-[55%] px-6 sm:px-12 lg:pl-16 xl:pl-28 lg:pr-8 py-8 lg:py-12 text-slate-900 dark:text-white flex flex-col justify-center transition-colors duration-300">

                <!-- Pill: Semana da Cibersegurança -->
                <div class="mb-3.5">
                    <span
                        class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full border border-[#0050f0]/30 dark:border-[#00a3e0]/40 text-[#0050f0] dark:text-[#00a3e0] bg-white dark:bg-[#00a3e0]/10 text-xs font-bold tracking-tight shadow-sm dark:shadow-[0_0_20px_rgba(0,163,224,0.25)] backdrop-blur-md">
                        <span class="w-2 h-2 rounded-full bg-[#0050f0] dark:bg-[#00a3e0] animate-pulse"></span>
                        <span>Semana da Cibersegurança</span>
                    </span>
                </div>

                <!-- Título Oficial Cibersegurança -->
                <h1
                    class="text-3xl sm:text-4xl lg:text-[44px] xl:text-[46px] font-sans font-bold text-slate-900 dark:text-white tracking-tight leading-[1.18] mb-3">
                    Seu próximo upgrade pode vir<br class="hidden sm:inline" /> com a Cibersegurança.
                </h1>

                <!-- Subtítulo Oficial -->
                <p class="text-sm sm:text-base text-slate-700 dark:text-slate-300 font-normal leading-relaxed mb-4 max-w-xl">
                    Matricule-se na RACHI Academy com até 40% OFF e domine a segurança de dados e defesa cibernética com instrutores seniores.
                </p>

                <!-- Bullet Points com Marcador Circular Azul com chevron (>) -->
                <div class="space-y-2 mb-4">

                    <div class="flex items-center gap-2.5 text-xs sm:text-sm text-slate-800 dark:text-slate-200 font-medium">
                        <svg class="w-4 h-4 text-[#0050f0] dark:text-[#00a3e0] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 8l4 4-4 4" />
                        </svg>
                        <span>Planos a partir de <s class="text-slate-400 dark:text-slate-500">75.000 Kz</s> por 45.000 Kz</span>
                    </div>

                    <div class="flex items-center gap-2.5 text-xs sm:text-sm text-slate-800 dark:text-slate-200 font-medium">
                        <svg class="w-4 h-4 text-[#0050f0] dark:text-[#00a3e0] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 8l4 4-4 4" />
                        </svg>
                        <span>7 dias para cancelar com reembolso total garantido</span>
                    </div>

                    <div class="flex items-center gap-2.5 text-xs sm:text-sm text-slate-800 dark:text-slate-200 font-medium">
                        <svg class="w-4 h-4 text-[#0050f0] dark:text-[#00a3e0] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10 8l4 4-4 4" />
                        </svg>
                        <span>Evolua em tecnologia com profundidade, direção e prática</span>
                    </div>

                </div>

                <!-- Nota de Rodapé Regulamento -->
                <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-5 leading-tight">
                    *Elegível para planos adquiridos na RACHI Academy.<br />
                    <a href="#faq" class="underline hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition">Consulte o Regulamento.</a>
                </p>

                <!-- Botão CTA Oficial com Gradiente RACHI -->
                <div>
                    <a href="#cursos"
                        class="inline-flex items-center justify-center gap-2.5 px-7 py-3 rounded-xl bg-gradient-to-r from-[#0050f0] via-[#0066ff] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] text-white font-extrabold text-sm tracking-wide transition-all duration-300 shadow-lg shadow-[#0050f0]/35 hover:shadow-xl hover:shadow-[#00a3e0]/50 hover:scale-105 active:scale-95 border border-white/20 cursor-pointer group">
                        <svg class="w-4 h-4 text-cyan-200 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                        <span>Aproveitar oferta especial</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                        </svg>
                    </a>
                </div>

            </div>

            <!-- COLUNA DA DIREITA (ESCUDO 3D DE CIBERSEGURANÇA + MEDALHA + FAIXA SUSPENSA) -->
            <div class="w-full lg:w-[45%] relative min-h-[360px] lg:min-h-[560px] flex items-center justify-center">

                <!-- FAIXA / RIBBON SUSPENSA NO TOPO -->
                <div class="absolute top-0 right-14 sm:right-24 xl:right-32 z-30">
                    <div
                        class="bg-white/95 dark:bg-[#071326]/95 backdrop-blur-xl text-slate-900 dark:text-white border-x border-b border-slate-200 dark:border-white/15 px-5 pt-3 pb-4 shadow-xl text-center rounded-b-xl flex flex-col items-center w-28 transition-colors">
                        <span class="text-xs font-semibold text-slate-800 dark:text-slate-200 tracking-tight">RACHI</span>
                        <span class="text-3xl font-black text-[#0050f0] dark:text-[#00a3e0] leading-none mt-1 tracking-tight">22</span>
                        <span class="text-[11px] font-black text-slate-800 dark:text-slate-200 tracking-widest leading-none mt-1">ANOS</span>
                        <span class="text-[9px] font-medium text-slate-500 dark:text-slate-400 leading-none mt-1">no ensino tech</span>
                    </div>
                </div>

                <!-- MEDALHA 3D CIRCULAR AZUL: "ATÉ 40% OFF" SOBRE A DIVISÓRIA -->
                <div class="absolute left-[-24px] sm:left-[-45px] lg:left-[-70px] top-1/2 -translate-y-1/2 z-40">
                    <div
                        class="w-32 h-32 sm:w-40 sm:h-40 lg:w-44 lg:h-44 rounded-full bg-gradient-to-b from-[#005bf8] via-[#003db3] to-[#001d68] p-3 shadow-[0_15px_35px_rgba(0,30,100,0.6)] dark:shadow-[0_0_40px_rgba(0,163,224,0.45)] flex items-center justify-center border-4 border-[#0047d4] dark:border-[#00a3e0] ring-2 ring-[#002277] dark:ring-[#00a3e0]/30 transform hover:scale-105 transition-transform duration-300">
                        <div
                            class="w-full h-full rounded-full border border-sky-400/40 flex flex-col items-center justify-center text-white select-none">
                            <span class="text-xs sm:text-sm font-bold tracking-widest uppercase text-sky-100">ATÉ</span>
                            <span
                                class="text-4xl sm:text-5xl font-black leading-none tracking-tight text-white my-0.5 drop-shadow-md">40%</span>
                            <span class="text-xs sm:text-sm font-black tracking-widest uppercase text-sky-100">OFF</span>
                        </div>
                    </div>
                </div>

                <!-- ESCUDO 3D DE DEFESA & SEGURANÇA DIGITAL -->
                <div class="relative z-20 flex flex-col items-center justify-center pt-8 lg:pt-0">
                    <div class="relative group">
                        <img src="/images/cybersecurity-shield-transparent.png"
                            alt="Cibersegurança e Defesa Digital RACHI Academy"
                            class="h-[280px] sm:h-[360px] lg:h-[420px] xl:h-[440px] w-auto object-contain filter drop-shadow-[0_20px_40px_rgba(0,100,240,0.35)] dark:drop-shadow-[0_0_50px_rgba(0,163,224,0.35)] transform group-hover:scale-105 transition-transform duration-500" />
                    </div>
                </div>

            </div>

        </div>

    </section>

    <!-- ============================================================== -->
    <!-- 5. HISTÓRIAS REAIS & DEPOIMENTOS DE ALUNOS                     -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- 5. HISTÓRIAS REAIS & DEPOIMENTOS DE ALUNOS (ANIMADO & OTIMIZADO) -->
    <!-- ============================================================== -->
    <section class="py-10 sm:py-14 bg-slate-100/70 dark:bg-[#070f1e] transition-colors duration-300 relative overflow-hidden" 
             id="depoimentos" 
             x-data="{ 
                 activeSlide: 1, 
                 progress: 0,
                 isHovered: false,
                 timer: null,
                 startTimer() { 
                     if (this.timer) clearInterval(this.timer);
                     this.timer = setInterval(() => { 
                         if (!this.isHovered) {
                             this.progress += 2;
                             if (this.progress >= 100) {
                                 this.progress = 0;
                                 this.activeSlide = this.activeSlide === 1 ? 2 : 1;
                             }
                         }
                     }, 140); 
                 }, 
                 goTo(slide) {
                     this.activeSlide = slide;
                     this.progress = 0;
                 },
                 next() {
                     this.activeSlide = this.activeSlide === 1 ? 2 : 1;
                     this.progress = 0;
                 },
                 prev() {
                     this.activeSlide = this.activeSlide === 1 ? 2 : 1;
                     this.progress = 0;
                 }
             }" 
             x-init="startTimer()" 
             @mouseenter="isHovered = true" 
             @mouseleave="isHovered = false">
        
        <!-- Luz ambiente sutil de fundo -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[650px] h-[300px] bg-[#00a3e0]/10 rounded-full blur-[130px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

            <!-- Cabeçalho Otimizado -->
            <div class="text-center max-w-2xl mx-auto mb-7 sm:mb-9">
                <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight">
                    Histórias reais de quem escolheu a tecnologia para evoluir na carreira
                </h2>
                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 mt-2 max-w-lg mx-auto">
                    Conheça a trajetória de profissionais que transformaram seus resultados e aceleraram o crescimento profissional com a RACHI Academy.
                </p>
            </div>

            <!-- SLIDE 1: 3 Histórias -->
            <div x-show="activeSlide === 1" 
                 x-transition:enter="transition ease-out duration-500" 
                 x-transition:enter-start="opacity-0 translate-y-3 scale-[0.99]" 
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                 x-transition:leave="transition ease-in duration-300 absolute inset-x-0" 
                 x-transition:leave-start="opacity-100 scale-100" 
                 x-transition:leave-end="opacity-0 scale-[0.99]" 
                 class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5 items-stretch">

                <!-- Depoimento 1: Mateus Cassoma -->
                <div class="relative p-5 sm:p-6 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/40 dark:hover:border-[#00a3e0]/50 shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:hover:shadow-[0_15px_30px_rgba(0,163,224,0.15)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group overflow-hidden h-full">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Marca d'água decorativa de citação -->
                    <svg class="absolute top-4 right-4 w-7 h-7 text-slate-200/60 dark:text-white/5 pointer-events-none group-hover:text-blue-500/20 dark:group-hover:text-cyan-400/20 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>

                    <div>
                        <!-- Topo com Estrelas -->
                        <div class="flex items-center gap-1 text-amber-400 mb-2.5 sm:mb-3">
                            <span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-700 dark:text-slate-300 leading-relaxed italic mb-4 sm:mb-5">
                            "Estava buscando uma transição de carreira para a área de dados. Através da trilha prática e das mentorias da RACHI Academy, consegui em 6 meses uma vaga como Engenheiro de Dados em Luanda."
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-3.5 border-t border-slate-100 dark:border-white/5">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-[#0050f0] to-[#00a3e0] text-white flex items-center justify-center font-bold text-xs shadow-xs ring-2 ring-blue-500/20 shrink-0">
                            MC
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">Mateus Cassoma</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Engenheiro de Dados &bull; Luanda</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 2: Renata Miranda -->
                <div class="relative p-5 sm:p-6 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/40 dark:hover:border-[#00a3e0]/50 shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:hover:shadow-[0_15px_30px_rgba(0,163,224,0.15)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group overflow-hidden h-full">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Marca d'água decorativa de citação -->
                    <svg class="absolute top-4 right-4 w-7 h-7 text-slate-200/60 dark:text-white/5 pointer-events-none group-hover:text-purple-500/20 dark:group-hover:text-purple-400/20 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>

                    <div>
                        <!-- Topo com Estrelas -->
                        <div class="flex items-center gap-1 text-amber-400 mb-2.5 sm:mb-3">
                            <span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-700 dark:text-slate-300 leading-relaxed italic mb-4 sm:mb-5">
                            "A metodologia com projetos reais me deu total segurança para entrevistas internacionais. O Modo Entrevista e o Inglês Técnico foram divisores de água para a minha contratação remota."
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-3.5 border-t border-slate-100 dark:border-white/5">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-purple-600 to-indigo-500 text-white flex items-center justify-center font-bold text-xs shadow-xs ring-2 ring-purple-500/20 shrink-0">
                            RM
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">Renata Miranda</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Dev Full Stack Remota &bull; Luanda</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 3: Eduardo Manuel -->
                <div class="relative p-5 sm:p-6 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/40 dark:hover:border-[#00a3e0]/50 shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:hover:shadow-[0_15px_30px_rgba(0,163,224,0.15)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group overflow-hidden h-full">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Marca d'água decorativa de citação -->
                    <svg class="absolute top-4 right-4 w-7 h-7 text-slate-200/60 dark:text-white/5 pointer-events-none group-hover:text-emerald-500/20 dark:group-hover:text-emerald-400/20 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>

                    <div>
                        <!-- Topo com Estrelas -->
                        <div class="flex items-center gap-1 text-amber-400 mb-2.5 sm:mb-3">
                            <span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-700 dark:text-slate-300 leading-relaxed italic mb-4 sm:mb-5">
                            "Como Tech Lead, precisava capacitar desenvolvedores juniores com agilidade e rigor. O conteúdo corporativo da RACHI reduziu nosso tempo de onboarding pela metade com métricas reais."
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-3.5 border-t border-slate-100 dark:border-white/5">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-emerald-600 to-teal-500 text-white flex items-center justify-center font-bold text-xs shadow-xs ring-2 ring-emerald-500/20 shrink-0">
                            EM
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">Eduardo Manuel</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Líder Técnico &bull; Setor Bancário</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- SLIDE 2: Mais 3 Histórias -->
            <div x-show="activeSlide === 2" x-cloak 
                 x-transition:enter="transition ease-out duration-500" 
                 x-transition:enter-start="opacity-0 translate-y-3 scale-[0.99]" 
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100" 
                 x-transition:leave="transition ease-in duration-300 absolute inset-x-0" 
                 x-transition:leave-start="opacity-100 scale-100" 
                 x-transition:leave-end="opacity-0 scale-[0.99]" 
                 class="grid grid-cols-1 md:grid-cols-3 gap-4 sm:gap-5 items-stretch">

                <!-- Depoimento 4: Teresa Muondo -->
                <div class="relative p-5 sm:p-6 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/40 dark:hover:border-[#00a3e0]/50 shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:hover:shadow-[0_15px_30px_rgba(0,163,224,0.15)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group overflow-hidden h-full">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Marca d'água decorativa de citação -->
                    <svg class="absolute top-4 right-4 w-7 h-7 text-slate-200/60 dark:text-white/5 pointer-events-none group-hover:text-red-500/20 dark:group-hover:text-red-400/20 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>

                    <div>
                        <!-- Topo com Estrelas -->
                        <div class="flex items-center gap-1 text-amber-400 mb-2.5 sm:mb-3">
                            <span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-700 dark:text-slate-300 leading-relaxed italic mb-4 sm:mb-5">
                            "A formação prática em defesa cibernética e resposta a incidentes foi determinante para a minha contratação na equipa de segurança da informação de uma das maiores telecom de Angola."
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-3.5 border-t border-slate-100 dark:border-white/5">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-rose-600 to-red-500 text-white flex items-center justify-center font-bold text-xs shadow-xs ring-2 ring-red-500/20 shrink-0">
                            TM
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">Teresa Muondo</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Analista SOC &bull; Talatona</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 5: Paulo Damião -->
                <div class="relative p-5 sm:p-6 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/40 dark:hover:border-[#00a3e0]/50 shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:hover:shadow-[0_15px_30px_rgba(0,163,224,0.15)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group overflow-hidden h-full">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Marca d'água decorativa de citação -->
                    <svg class="absolute top-4 right-4 w-7 h-7 text-slate-200/60 dark:text-white/5 pointer-events-none group-hover:text-amber-500/20 dark:group-hover:text-amber-400/20 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>

                    <div>
                        <!-- Topo com Estrelas -->
                        <div class="flex items-center gap-1 text-amber-400 mb-2.5 sm:mb-3">
                            <span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-700 dark:text-slate-300 leading-relaxed italic mb-4 sm:mb-5">
                            "Automatizar relatórios financeiros com Power BI e IA revolucionou a minha consultoria. Em menos de 3 meses dobrei meus clientes atendidos com dashboards executivos em tempo real."
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-3.5 border-t border-slate-100 dark:border-white/5">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-amber-500 to-orange-500 text-white flex items-center justify-center font-bold text-xs shadow-xs ring-2 ring-amber-500/20 shrink-0">
                            PD
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">Paulo Damião</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Consultor de BI &bull; Luanda</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 6: Carla Fernandes -->
                <div class="relative p-5 sm:p-6 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/40 dark:hover:border-[#00a3e0]/50 shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:hover:shadow-[0_15px_30px_rgba(0,163,224,0.15)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group overflow-hidden h-full">
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Marca d'água decorativa de citação -->
                    <svg class="absolute top-4 right-4 w-7 h-7 text-slate-200/60 dark:text-white/5 pointer-events-none group-hover:text-sky-500/20 dark:group-hover:text-blue-400/20 transition-colors duration-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                    </svg>

                    <div>
                        <!-- Topo com Estrelas -->
                        <div class="flex items-center gap-1 text-amber-400 mb-2.5 sm:mb-3">
                            <span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span><span class="text-xs sm:text-sm">★</span>
                        </div>
                        <p class="text-xs sm:text-[13px] text-slate-700 dark:text-slate-300 leading-relaxed italic mb-4 sm:mb-5">
                            "Os módulos de liderança estratégica e gestão ágil de projectos trouxeram um salto imediato na produtividade e no alinhamento das nossas equipas multidisciplinares de operações."
                        </p>
                    </div>

                    <div class="flex items-center gap-3 pt-3.5 border-t border-slate-100 dark:border-white/5">
                        <div class="w-9 h-9 rounded-full bg-gradient-to-tr from-sky-600 to-blue-600 text-white flex items-center justify-center font-bold text-xs shadow-xs ring-2 ring-sky-500/20 shrink-0">
                            CF
                        </div>
                        <div class="min-w-0 flex-1">
                            <h4 class="text-xs font-bold text-slate-900 dark:text-white truncate">Carla Fernandes</h4>
                            <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate">Directora de Operações &bull; Luanda</p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- CONTROLES DO SLIDER (AUTO-PLAY + BARRA DE PROGRESSO + NAVEGAÇÃO COMPACTA) -->
            <div class="flex flex-col items-center justify-center gap-2.5 mt-6 sm:mt-8">
                <!-- Barra de progresso do auto-play suave -->
                <div class="w-28 h-1 bg-slate-200 dark:bg-white/10 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-[#0050f0] to-[#00a3e0] transition-all duration-150 ease-linear rounded-full" 
                         :style="`width: ${progress}%`"></div>
                </div>

                <div class="flex items-center gap-2.5">
                    <!-- Botão Slide Anterior -->
                    <button type="button" 
                            @click="prev()"
                            class="w-8 h-8 rounded-full bg-white dark:bg-[#0c1527] hover:bg-slate-50 dark:hover:bg-white/10 text-slate-700 dark:text-white flex items-center justify-center shadow-xs border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/40 transition-all cursor-pointer group"
                            title="Ver depoimento anterior">
                        <i data-lucide="chevron-left" class="w-3.5 h-3.5 group-hover:-translate-x-0.5 transition-transform"></i>
                    </button>

                    <!-- Pílulas Indicadoras com Animação -->
                    <div class="flex items-center gap-1.5">
                        <button type="button" 
                                @click="goTo(1)"
                                :class="activeSlide === 1 ? 'w-7 bg-[#0050f0] dark:bg-[#00a3e0]' : 'w-2 bg-slate-300 dark:bg-white/20 hover:bg-slate-400'"
                                class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"
                                aria-label="Grupo de histórias 1"></button>
                        <button type="button" 
                                @click="goTo(2)"
                                :class="activeSlide === 2 ? 'w-7 bg-[#0050f0] dark:bg-[#00a3e0]' : 'w-2 bg-slate-300 dark:bg-white/20 hover:bg-slate-400'"
                                class="h-1.5 rounded-full transition-all duration-300 cursor-pointer"
                                aria-label="Grupo de histórias 2"></button>
                    </div>

                    <!-- Botão Próximo Slide -->
                    <button type="button" 
                            @click="next()"
                            class="w-8 h-8 rounded-full bg-white dark:bg-[#0c1527] hover:bg-slate-50 dark:hover:bg-white/10 text-slate-700 dark:text-white flex items-center justify-center shadow-xs border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/40 transition-all cursor-pointer group"
                            title="Ver próximo depoimento">
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5 group-hover:translate-x-0.5 transition-transform"></i>
                    </button>
                </div>
            </div>

        </div>
    </section>

        <!-- ============================================================== -->
    <!-- 6. SHOWCASE DE CURSOS & CARREIRAS (ESTRUTURADO EM 6 PILARES)   -->
    <!-- ============================================================== -->
    <section class="py-12 sm:py-16 bg-slate-50/90 dark:bg-[#070f1e] border-t border-slate-200/80 dark:border-white/10 relative overflow-hidden transition-colors duration-300" id="cursos" x-data="{ currentCarreirasPage: 1 }">
        
        <!-- Luz ambiente radial suave -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[350px] bg-[#00a3e0]/10 rounded-full blur-[140px] pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <!-- Título e Subtítulo -->
            <div class="text-center max-w-3xl mx-auto mb-8 sm:mb-10">
                <span class="text-xs font-bold uppercase tracking-widest text-[#0050f0] dark:text-[#00a3e0]">Programas Oficiais de Capacitação</span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-heading font-extrabold text-slate-900 dark:text-white tracking-tight leading-tight mt-2">
                    O caminho mais seguro para a sua próxima profissão
                </h2>
                <p class="mt-4 text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed font-normal">
                    Formações práticas com foco no mercado de trabalho e nas exigências das organizações em Angola: estude com cronograma pronto, construa projetos reais e obtenha certificação reconhecida.
                </p>
            </div>

                                                            <!-- PÁGINA 1: OS 6 PILARES OFICIAIS SOLICITADOS -->
            <div x-show="currentCarreirasPage === 1" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-3"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                <!-- Card: Cibersegurança -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/ciberseguranca.jpg" alt="Cibersegurança" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Cibersegurança
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Aprenda a prevenir ameaças cibernéticas, proteger infraestruturas críticas de dados e reforçar a segurança digital com práticas de mercado.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/ciberseguranca" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Competências Digitais -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/competencias-digitais.jpg" alt="Competências Digitais" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Competências Digitais
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Capacitação no uso de ferramentas em nuvem, inteligência artificial e produtividade digital para se destacar no ambiente de trabalho moderno.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/competencias-digitais" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Formação Corporativa -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/formacao-corporativa.jpg" alt="Formação Corporativa" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Formação Corporativa
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Soluções sob medida para capacitar equipas e lideranças empresariais, alinhando competências técnicas aos objectivos estratégicos da organização.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/formacao-corporativa" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Formação Profissional -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/formacao-profissional.jpg" alt="Formação Profissional" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Formação Profissional
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Acelere a sua inserção no mercado de trabalho com programas práticos, projetos reais e certificação de alto valor para a sua carreira.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/formacao-profissional" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Gestão Empresarial -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/gestao-empresarial.jpg" alt="Gestão Empresarial" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Gestão Empresarial
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Domine estratégias corporativas, planeamento financeiro e optimização de operações para gerir e expandir negócios com solidez.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/gestao-empresarial" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Liderança Executiva -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/lideranca.jpg" alt="Liderança Executiva" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Liderança Executiva
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Desenvolva competências avançadas de liderança, comunicação estratégica e gestão de equipas de alto desempenho e resultados.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/lideranca" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PÁGINA 2: APROFUNDAMENTO & ESPECIALIZAÇÕES PRÁTICAS -->
            <div x-show="currentCarreirasPage === 2" x-cloak
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-3"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5 sm:gap-6">
                <!-- Card: Auditoria de Sistemas -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/auditoria-sistemas.jpg" alt="Auditoria de Sistemas" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Auditoria de Sistemas
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Especialização em auditoria técnica, governança de TI e conformidade legal com a Lei de Proteção de Dados (APD Angola).
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/auditoria-sistemas" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Automação Digital & IA -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/automacao-digital-ia.jpg" alt="Automação Digital & IA" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Automação Digital & IA
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Automatize rotinas de trabalho, crie dashboards executivos no Power BI e aplique ferramentas de Inteligência Artificial para aumentar a eficiência.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/automacao-digital-ia" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Gestão de Projectos -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/gestao-projectos.jpg" alt="Gestão de Projectos" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Gestão de Projectos
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Aprenda a gerir projetos com excelência utilizando Scrum, Kanban e metodologias ágeis reconhecidas internacionalmente.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/gestao-projectos" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Atendimento ao Cliente -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/atendimento-cliente.jpg" alt="Atendimento ao Cliente" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Atendimento ao Cliente
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Domine técnicas de Customer Experience (CX), resolução de conflitos e comunicação empática para encantar e fidelizar clientes.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/atendimento-cliente" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Vendas Consultivas B2B -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/vendas-b2b.jpg" alt="Vendas Consultivas B2B" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Vendas Consultivas B2B
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Estratégias avançadas de prospecção corporativa, negociação de alto impacto e fecho de vendas consultivas para empresas.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/vendas-b2b" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Card: Contabilidade & Fiscalidade -->
                <div class="relative bg-white dark:bg-[#071326] border border-slate-200/90 dark:border-white/10 hover:border-[#0050f0]/60 dark:hover:border-[#00a3e0]/70 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#0050f0]/10 dark:shadow-xl dark:hover:shadow-[0_16px_36px_-8px_rgba(0,163,224,0.3)] hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between group">
                    <!-- Linha decorativa de topo sutil -->
                    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0] opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-20"></div>

                    <!-- Imagem Fotográfica com Fusão Adaptativa (Modo Claro & Escuro) -->
                    <div class="relative h-40 sm:h-44 w-full overflow-hidden shrink-0">
                        <img src="/images/courses/contabilidade-fiscalidade.jpg" alt="Contabilidade & Fiscalidade" class="w-full h-full object-cover object-center group-hover:scale-106 transition-transform duration-500">
                        
                        <!-- Gradiente de Fusão: Branco no Modo Claro, Azul Escuro no Dark Mode -->
                        <div class="absolute inset-0 bg-gradient-to-t from-white via-white/75 via-35% to-transparent dark:from-[#071326] dark:via-[#071326]/75 pointer-events-none"></div>
                    </div>

                    <!-- Corpo do Card Limpo & Compacto Dual-Mode -->
                    <div class="p-4 sm:p-5 pt-2.5 flex flex-col flex-grow justify-between text-center relative z-10">
                        <div>
                            <!-- Título Principal em Destaque -->
                            <h3 class="text-lg sm:text-xl font-black font-heading text-slate-900 dark:text-white tracking-wide uppercase mb-2 group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors">
                                Contabilidade & Fiscalidade
                            </h3>

                            <!-- Descrição Curta e Direta -->
                            <p class="text-xs sm:text-[13px] text-slate-600 dark:text-slate-300 leading-relaxed font-normal max-w-sm mx-auto min-h-[42px]">
                                Domine a prática contabilística em Angola, regras do PGC, apuramento de impostos e cumprimento de obrigações com a AGT.
                            </p>
                        </div>

                        <!-- Botão de Ação Estilo Print 2 Dual-Mode -->
                        <div class="pt-3 mt-2.5 border-t border-slate-100 dark:border-white/10 flex flex-col items-center">
                            <a href="/academy/cursos/contabilidade-fiscalidade" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-full border-2 border-slate-800 dark:border-white/80 hover:border-[#0050f0] dark:hover:border-[#00a3e0] bg-transparent hover:bg-gradient-to-r hover:from-[#0050f0] hover:to-[#00a3e0] text-slate-800 dark:text-white hover:text-white dark:hover:text-white font-bold text-xs uppercase tracking-wider transition-all duration-300 shadow-xs group-hover:shadow-[0_0_20px_rgba(0,80,240,0.3)] dark:group-hover:shadow-[0_0_20px_rgba(0,163,224,0.4)] group-hover:scale-[1.02] cursor-pointer">
                                <span>VER CURSOS</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CONTROLES DE PAGINAÇÃO (<- 1 2 ->) -->
            <div class="flex items-center justify-center gap-2 mt-8 sm:mt-10">
                <!-- Seta Anterior -->
                <button @click="if (currentCarreirasPage > 1) currentCarreirasPage--" 
                        :disabled="currentCarreirasPage === 1"
                        :class="currentCarreirasPage === 1 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-200 dark:hover:bg-white/20 hover:text-slate-900 dark:hover:text-white'"
                        class="w-9 h-9 rounded-full bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 flex items-center justify-center transition focus:outline-none border border-slate-200 dark:border-transparent cursor-pointer"
                        title="Página Anterior">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </button>

                <!-- Páginas 1 e 2 -->
                <button @click="currentCarreirasPage = 1" 
                        :class="currentCarreirasPage === 1 ? 'bg-[#0050f0] text-white dark:bg-white dark:text-slate-950 font-black shadow-md scale-105' : 'bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200 dark:hover:bg-white/20'"
                        class="w-9 h-9 rounded-full text-xs font-semibold flex items-center justify-center transition focus:outline-none cursor-pointer">
                    1
                </button>
                <button @click="currentCarreirasPage = 2" 
                        :class="currentCarreirasPage === 2 ? 'bg-[#0050f0] text-white dark:bg-white dark:text-slate-950 font-black shadow-md scale-105' : 'bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:bg-slate-200 dark:hover:bg-white/20'"
                        class="w-9 h-9 rounded-full text-xs font-semibold flex items-center justify-center transition focus:outline-none cursor-pointer">
                    2
                </button>

                <!-- Seta Próximo -->
                <button @click="if (currentCarreirasPage < 2) currentCarreirasPage++" 
                        :disabled="currentCarreirasPage === 2"
                        :class="currentCarreirasPage === 2 ? 'opacity-40 cursor-not-allowed' : 'hover:bg-slate-200 dark:hover:bg-white/20 hover:text-slate-900 dark:hover:text-white'"
                        class="w-9 h-9 rounded-full bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-300 flex items-center justify-center transition focus:outline-none border border-slate-200 dark:border-transparent cursor-pointer"
                        title="Próxima Página">
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- 7. PERGUNTAS FREQUENTES (FAQ)                                   -->
    <!-- ============================================================== -->
    <section class="py-12 sm:py-14 bg-white dark:bg-[#070f1e] border-t border-slate-200/80 dark:border-white/5 transition-colors duration-300 relative" id="faq" x-data="{ activeFaq: 1 }">
        <div class="max-w-2xl mx-auto px-4 sm:px-6">

            <!-- Cabeçalho Compacto & Otimizado -->
            <div class="text-center mb-6 sm:mb-7">
                <span class="text-[11px] font-bold uppercase tracking-widest text-[#0050f0] dark:text-[#00a3e0] bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 px-3 py-1 rounded-full border border-[#0050f0]/20 dark:border-[#00a3e0]/20 inline-block mb-2">
                    Tire Suas Dúvidas
                </span>
                <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-900 dark:text-white tracking-tight">
                    Perguntas Frequentes
                </h2>
                <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 max-w-md mx-auto">
                    Tudo sobre matrículas, pagamentos em Angola, certificação e metodologia.
                </p>
            </div>

            <!-- Accordion Compacto com Animação Suave -->
            <div class="space-y-2.5">

                <!-- FAQ 1 -->
                <div class="rounded-xl border transition-all duration-200 overflow-hidden cursor-pointer select-none"
                     :class="activeFaq === 1 
                        ? 'border-[#0050f0] dark:border-[#00a3e0] bg-white dark:bg-[#0c182e] shadow-sm ring-1 ring-[#0050f0]/15 dark:ring-[#00a3e0]/20' 
                        : 'border-slate-200/80 dark:border-white/10 bg-slate-50/70 dark:bg-[#0a1324]/70 hover:border-slate-300 dark:hover:border-white/20 hover:bg-slate-50 dark:hover:bg-[#0c182e]/60'"
                     @click="activeFaq = (activeFaq === 1 ? null : 1)">
                    <div class="py-3.5 px-4 sm:px-5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span class="text-[11px] font-mono font-bold transition-colors shrink-0"
                                  :class="activeFaq === 1 ? 'text-[#0050f0] dark:text-[#00a3e0]' : 'text-slate-400 dark:text-slate-500'">
                                01
                            </span>
                            <span class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white leading-snug">
                                Para quem é a RACHI Academy?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 transition-transform duration-300 ease-out"
                             :class="activeFaq === 1 
                                ? 'rotate-180 bg-[#0050f0]/10 dark:bg-[#00a3e0]/15 text-[#0050f0] dark:text-[#00a3e0]' 
                                : 'bg-slate-200/60 dark:bg-white/5 text-slate-400 dark:text-slate-500'">
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                        </div>
                    </div>
                    <div class="grid transition-all duration-300 ease-in-out"
                         :class="activeFaq === 1 ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                        <div class="overflow-hidden">
                            <div class="px-4 sm:px-5 pb-4 pt-1 text-xs text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-white/5">
                                Para iniciantes e profissionais que desejam ingressar ou evoluir com segurança em Tecnologia e Inteligência Artificial, além de líderes e organizações que precisam dominar ferramentas práticas e valorizadas no mercado de Angola e global.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="rounded-xl border transition-all duration-200 overflow-hidden cursor-pointer select-none"
                     :class="activeFaq === 2 
                        ? 'border-[#0050f0] dark:border-[#00a3e0] bg-white dark:bg-[#0c182e] shadow-sm ring-1 ring-[#0050f0]/15 dark:ring-[#00a3e0]/20' 
                        : 'border-slate-200/80 dark:border-white/10 bg-slate-50/70 dark:bg-[#0a1324]/70 hover:border-slate-300 dark:hover:border-white/20 hover:bg-slate-50 dark:hover:bg-[#0c182e]/60'"
                     @click="activeFaq = (activeFaq === 2 ? null : 2)">
                    <div class="py-3.5 px-4 sm:px-5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span class="text-[11px] font-mono font-bold transition-colors shrink-0"
                                  :class="activeFaq === 2 ? 'text-[#0050f0] dark:text-[#00a3e0]' : 'text-slate-400 dark:text-slate-500'">
                                02
                            </span>
                            <span class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white leading-snug">
                                Quais são as formas de pagamento em Angola?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 transition-transform duration-300 ease-out"
                             :class="activeFaq === 2 
                                ? 'rotate-180 bg-[#0050f0]/10 dark:bg-[#00a3e0]/15 text-[#0050f0] dark:text-[#00a3e0]' 
                                : 'bg-slate-200/60 dark:bg-white/5 text-slate-400 dark:text-slate-500'">
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                        </div>
                    </div>
                    <div class="grid transition-all duration-300 ease-in-out"
                         :class="activeFaq === 2 ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                        <div class="overflow-hidden">
                            <div class="px-4 sm:px-5 pb-4 pt-1 text-xs text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-white/5">
                                Pagamento direto em Kwanzas (AOA) por <strong>Multicaixa Express</strong>, transferência bancária por <strong>IBAN</strong> com fatura proforma e recibo oficial para pessoas físicas ou empresas, e cartões internacionais (Visa/Mastercard) em até 12x.
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="rounded-xl border transition-all duration-200 overflow-hidden cursor-pointer select-none"
                     :class="activeFaq === 3 
                        ? 'border-[#0050f0] dark:border-[#00a3e0] bg-white dark:bg-[#0c182e] shadow-sm ring-1 ring-[#0050f0]/15 dark:ring-[#00a3e0]/20' 
                        : 'border-slate-200/80 dark:border-white/10 bg-slate-50/70 dark:bg-[#0a1324]/70 hover:border-slate-300 dark:hover:border-white/20 hover:bg-slate-50 dark:hover:bg-[#0c182e]/60'"
                     @click="activeFaq = (activeFaq === 3 ? null : 3)">
                    <div class="py-3.5 px-4 sm:px-5 flex items-center justify-between gap-3">
                        <div class="flex items-center gap-2.5 min-w-0">
                            <span class="text-[11px] font-mono font-bold transition-colors shrink-0"
                                  :class="activeFaq === 3 ? 'text-[#0050f0] dark:text-[#00a3e0]' : 'text-slate-400 dark:text-slate-500'">
                                03
                            </span>
                            <span class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white leading-snug">
                                A RACHI Academy tem planos para empresas e equipas?
                            </span>
                        </div>
                        <div class="w-7 h-7 rounded-full flex items-center justify-center shrink-0 transition-transform duration-300 ease-out"
                             :class="activeFaq === 3 
                                ? 'rotate-180 bg-[#0050f0]/10 dark:bg-[#00a3e0]/15 text-[#0050f0] dark:text-[#00a3e0]' 
                                : 'bg-slate-200/60 dark:bg-white/5 text-slate-400 dark:text-slate-500'">
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i>
                        </div>
                    </div>
                    <div class="grid transition-all duration-300 ease-in-out"
                         :class="activeFaq === 3 ? 'grid-rows-[1fr] opacity-100' : 'grid-rows-[0fr] opacity-0'">
                        <div class="overflow-hidden">
                            <div class="px-4 sm:px-5 pb-4 pt-1 text-xs text-slate-600 dark:text-slate-300 leading-relaxed border-t border-slate-100 dark:border-white/5">
                                Sim! Com a solução corporativa da RACHI, oferecemos programas customizados para empresas com gestão de progresso para o RH e contratação corporativa por fatura proforma / IBAN.
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>

    <!-- ============================================================== -->
    <!-- 9. RODAPÉ INSTITUCIONAL RACHI ACADEMY                         -->
    <!-- ============================================================== -->
    <footer class="bg-slate-900 dark:bg-[#050a14] py-10 sm:py-12 border-t border-slate-800 dark:border-white/10 text-xs text-slate-400 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center justify-between gap-5 pb-6 border-b border-white/5">
                <a href="/" class="flex items-center gap-3 group transition hover:opacity-90" title="Ir para a página inicial (Portal RACHI)">
                    <img src="/images/logo-rachi-light.png"
                        onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'"
                        alt="RACHI Academy" class="h-7 w-auto object-contain">
                    <span
                        class="text-[10px] font-heading font-black tracking-widest text-[#00a3e0] uppercase px-2 py-0.5 rounded bg-[#00a3e0]/10 border border-[#00a3e0]/30">
                        ACADEMY
                    </span>
                </a>
                <div class="flex flex-wrap items-center gap-6 text-slate-400">
                    <a href="/" class="hover:text-white transition">Início</a>
                    <a href="/capital" class="hover:text-white transition">RACHI Human Capital</a>
                    <a href="/tec" class="hover:text-white transition">RACHI Tec</a>
                    <a href="/print" class="hover:text-white transition">RACHI Print</a>
                    <a href="#cursos" class="hover:text-white transition">Cursos</a>
                    <a href="/academy/login" class="hover:text-white transition">Área do Aluno</a>
                    <a href="/contacto" class="hover:text-white transition">Contacto</a>
                </div>
            </div>

            <div
                class="pt-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left text-[11px] text-slate-500">
                <p>&copy; 2026 RACHI — Soluções Inteligentes. Todos os direitos reservados. Luanda, Angola.</p>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:underline">Termos de Uso</a>
                    <span>&bull;</span>
                    <a href="#" class="hover:underline">Privacidade</a>
                    <span>&bull;</span>
                    <span>Pagamentos em Kwanzas (Multicaixa Express)</span>
                </div>
            </div>
        </div>
    </footer>

    <!-- Lógica Alpine.js & Lucide -->
    <script>
        function rachiAcademyPlans() {
            return {
                billingCycle: 'biennial', // 'annual' ou 'biennial'
                activeFaq: 1,
                mobileMenuOpen: false,
                openCursos: false,
                activeMegaTab: 'carreiras',
                isLoggedIn: false,
                currentUser: null,
                userMenuOpen: false,

                checkAuth() {
                    const storedUser = localStorage.getItem('rachi_user_session');
                    const isAuth = localStorage.getItem('rachi_academy_auth');
                    let userObj = null;

                    if (storedUser) {
                        try {
                            const parsed = JSON.parse(storedUser);
                            if (parsed.loggedIn !== false) {
                                userObj = parsed.user || (parsed.email ? parsed : null);
                            }
                        } catch(e) {}
                    }

                    if (userObj && (userObj.nome || userObj.name || userObj.email)) {
                        // Se tiver matrícula ativa, sincroniza autorização da academy
                        if (userObj.has_matricula || isAuth === 'true') {
                            localStorage.setItem('rachi_academy_auth', 'true');
                        }
                        this.isLoggedIn = true;
                        this.currentUser = {
                            ...userObj,
                            nome: userObj.nome || userObj.name,
                            name: userObj.nome || userObj.name
                        };
                        return;
                    }

                    if (isAuth === 'true') {
                        this.isLoggedIn = true;
                        this.currentUser = { nome: 'Aluno RACHI', email: 'aluno@rachi.ao', has_matricula: true };
                        return;
                    }

                    this.isLoggedIn = false;
                    this.currentUser = null;
                },

                getUserInitials(name) {
                    if (!name) return 'AL';
                    const parts = name.trim().split(' ');
                    if (parts.length === 1) return parts[0].substring(0, 2).toUpperCase();
                    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
                },

                logout() {
                    localStorage.removeItem('rachi_academy_auth');
                    localStorage.removeItem('rachi_user_session');
                    localStorage.setItem('rachi_user_session', JSON.stringify({ loggedIn: false, user: null }));
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            const bc = new BroadcastChannel('rachi_auth_channel');
                            bc.postMessage({ action: 'logout', timestamp: Date.now() });
                            bc.close();
                        }
                        localStorage.setItem('rachi_auth_sync', Date.now().toString());
                    } catch(e) {}

                    this.isLoggedIn = false;
                    this.currentUser = null;
                    this.userMenuOpen = false;
                    window.location.reload();
                },

                init() {
                    this.checkAuth();
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            this.authChannel = new BroadcastChannel('rachi_auth_channel');
                            this.authChannel.onmessage = (event) => {
                                if (!event.data) return;
                                if (event.data.action === 'logout') {
                                    this.isLoggedIn = false;
                                    this.currentUser = null;
                                } else if (event.data.action === 'login') {
                                    this.checkAuth();
                                }
                            };
                        }
                    } catch(e) {}

                    window.addEventListener('storage', (event) => {
                        if (event.key === 'rachi_user_session' || event.key === 'rachi_auth_sync' || event.key === 'rachi_academy_auth') {
                            this.checkAuth();
                        }
                    });

                    if (window.lucide) {
                        this.$nextTick(() => lucide.createIcons());
                    }
                }
            }
        }

        function rachiCatalogScroller() {
            return {
                isPaused: false,
                activeCategory: 'all',
                scrollInterval: null,
                init() {
                    this.$nextTick(() => {
                        this.startScrolling();
                    });
                },
                startScrolling() {
                    this.stopScrolling();
                    const track = this.$refs.scrollerTrack;
                    if (!track) return;
                    this.scrollInterval = setInterval(() => {
                        if (!this.isPaused && track) {
                            const half = track.scrollWidth / 2;
                            if (half > 0 && track.scrollLeft >= (half - 4)) {
                                track.scrollLeft -= half;
                            } else {
                                track.scrollLeft += 1;
                            }
                        }
                    }, 28);
                },
                stopScrolling() {
                    if (this.scrollInterval) {
                        clearInterval(this.scrollInterval);
                        this.scrollInterval = null;
                    }
                },
                pause() {
                    this.isPaused = true;
                },
                resume() {
                    this.isPaused = false;
                },
                scrollLeftBy(amount) {
                    const track = this.$refs.scrollerTrack;
                    if (track) {
                        track.scrollBy({ left: -amount, behavior: 'smooth' });
                    }
                },
                scrollRightBy(amount) {
                    const track = this.$refs.scrollerTrack;
                    if (track) {
                        track.scrollBy({ left: amount, behavior: 'smooth' });
                    }
                },
                setCategory(cat) {
                    this.activeCategory = cat;
                },
                matchesCategory(catName) {
                    if (this.activeCategory === 'all') return true;
                    if (!catName) return false;
                    const clean = catName.toLowerCase();
                    if (this.activeCategory === 'ti') {
                        return clean.includes('tecnologia') || clean.includes('ti') || clean.includes('ciber') || clean.includes('digital') || clean.includes('automação') || clean.includes('sistemas');
                    }
                    if (this.activeCategory === 'gestao') {
                        return clean.includes('gestão') || clean.includes('liderança') || clean.includes('vendas') || clean.includes('corporativa') || clean.includes('contabilidade') || clean.includes('negócios') || clean.includes('profissional');
                    }
                    return true;
                }
            };
        }

        document.addEventListener('DOMContentLoaded', function () {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    </script>



</body>

</html>