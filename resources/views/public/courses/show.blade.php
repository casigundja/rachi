<!DOCTYPE html>
<html lang="pt-AO" data-theme="dark" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $course->name }} — RACHI Academy</title>
    <meta name="description" content="{{ Str::limit($course->short_description ?? $course->description, 160) }}">
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $course->name }} — RACHI Academy">
    <meta property="og:description" content="{{ Str::limit($course->short_description ?? $course->description, 160) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:site_name" content="RACHI Academy">
    <meta property="og:locale" content="pt_AO">
    <meta property="og:image" content="/images/areas/rachi-academy.png">
    <meta property="og:type" content="article">

    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">
    <link rel="shortcut icon" href="/images/logo-rachi-light.png">

    <!-- Fonts: Inter & Encode Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Encode+Sans:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Bootstrap toast styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

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
                        sans: ['"Inter"', 'sans-serif'],
                        heading: ['"Encode Sans"', '"Inter"', 'sans-serif'],
                    },
                    colors: {
                        rachi: {
                            navy: '#071326',
                            navyLight: '#0d1f3d',
                            blue: '#00a3e0',
                            blueDark: '#0050f0',
                            blueHover: '#0042c7',
                            surface: '#0c1527',
                            surfaceDark: '#070f1e',
                            border: '#162744',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Anti-Flash Dark Mode Script -->
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
    </script>

    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
            color: #0f172a;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        html.dark body {
            background-color: #070f1e;
            color: #ffffff;
        }
        .font-heading {
            font-family: 'Encode Sans', sans-serif;
        }
        .glow-rachi {
            box-shadow: 0 0 35px -8px rgba(0, 163, 224, 0.35);
        }
    </style>
</head>
<body x-data="{ openMatriculaModal: false, activeModule: 1 }">

    <!-- ============================================================ -->
    <!-- HEADER CORPORATIVO RACHI ACADEMY                             -->
    <!-- ============================================================ -->
    <header class="sticky top-0 z-50 bg-white/95 dark:bg-[#070f1e]/95 backdrop-blur-xl border-b border-slate-200/90 dark:border-white/10 shadow-[0_4px_25px_rgba(15,23,42,0.08),0_1px_4px_rgba(15,23,42,0.05)] dark:shadow-[0_4px_30px_rgba(0,0,0,0.45)] transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between gap-4">
            <!-- Logo & Voltar -->
            <div class="flex items-center gap-4 sm:gap-6">
                <a href="/academy" class="flex items-center gap-2 text-slate-500 dark:text-slate-400 hover:text-[#0050f0] dark:hover:text-[#00a3e0] text-sm font-semibold transition-colors group">
                    <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="hidden sm:inline">Voltar para Academy</span>
                </a>
                <span class="h-5 w-px bg-slate-200 dark:bg-white/10 hidden sm:block"></span>
                <a href="/" class="flex items-center gap-2.5">
                    <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-8 w-auto dark:block hidden">
                    <img src="/images/logo-rachi-dark.png" alt="RACHI" class="h-8 w-auto dark:hidden block">
                    <span class="text-xs font-bold tracking-widest px-2 py-0.5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/20 dark:border-[#00a3e0]/30 uppercase">Academy</span>
                </a>
            </div>

            <!-- Botões de Ação Header -->
            <div class="flex items-center gap-3">
                <!-- Toggle Dark Mode -->
                <button type="button" onclick="toggleRachiTheme()" aria-label="Alternar Tema" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-200 hover:text-[#0050f0] dark:hover:text-[#00a3e0] flex items-center justify-center transition-colors">
                    <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                    <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- ============================================================ -->
    <!-- BREADCRUMBS                                                  -->
    <!-- ============================================================ -->
    <nav class="bg-slate-100/60 dark:bg-[#0c1527]/50 border-b border-slate-200/80 dark:border-white/5 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center flex-wrap gap-2 text-xs font-medium text-slate-500 dark:text-slate-400">
                <li><a href="/" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">Início</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li><a href="/academy" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">RACHI Academy</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li><a href="/academy#cursos" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">Formações</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li class="text-slate-900 dark:text-white font-semibold truncate max-w-[280px] sm:max-w-md">{{ $course->name }}</li>
            </ol>
        </div>
    </nav>

    <!-- ============================================================ -->
    <!-- ALERTA DE SUCESSO DE MATRÍCULA (QUANDO SUBMETIDO)           -->
    <!-- ============================================================ -->
    @if(session('matricula_sucesso'))
    @php $mat = session('matricula_sucesso'); @endphp
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100; padding-top: 5.5rem !important;">
        <div id="enrollment-success-toast" class="toast text-bg-success border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true" data-bs-delay="7000">
            <div class="d-flex align-items-center">
                <div class="toast-body d-flex align-items-center gap-2 fw-semibold">
                    <i data-lucide="circle-check" class="w-5 h-5 flex-shrink-0"></i>
                    <span>Recebemos a sua solicitação de matrícula com sucesso e retornaremos em breve.</span>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button>
            </div>
        </div>
    </div>
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <div class="p-6 sm:p-8 rounded-3xl bg-gradient-to-br from-[#0c1527] to-[#070f1e] border-2 border-[#00a3e0] text-white shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0]"></div>
            <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-[#00a3e0]/20 border border-[#00a3e0]/40 text-[#00a3e0] flex items-center justify-center shrink-0">
                        <i data-lucide="check-circle-2" class="w-8 h-8"></i>
                    </div>
                    <div>
                        <span class="inline-flex items-center gap-1.5 px-3 py-0.5 rounded-full text-xs font-bold bg-[#00a3e0]/20 text-[#00a3e0] border border-[#00a3e0]/30 mb-2">
                            Pré-Matrícula Confirmada com Sucesso!
                        </span>
                        <h2 class="text-xl sm:text-2xl font-bold font-heading text-white tracking-tight">
                            Parabéns, {{ $mat['name'] }}!
                        </h2>
                        <p class="text-sm text-slate-300 mt-1 max-w-2xl leading-relaxed">
                            A sua reserva de vaga para a formação <strong class="text-[#00a3e0]">{{ $mat['course'] }}</strong> foi registada com o código oficial <span class="px-2 py-0.5 rounded bg-white/10 font-mono text-white font-bold">{{ $mat['code'] }}</span>.
                        </p>
                    </div>
                </div>
                <div class="shrink-0 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
                    <a href="{{ $mat['whatsappUrl'] }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-lg transition-all">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        <span>Confirmar no WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!-- ============================================================ -->
    <!-- HERO DO CURSO                                                -->
    <!-- ============================================================ -->
    <section class="relative pt-10 pb-16 overflow-hidden">
        <!-- Efeito ambiente de fundo -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#00a3e0]/10 dark:bg-[#00a3e0]/15 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-[#0050f0]/10 dark:bg-[#0050f0]/15 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Coluna Esquerda: Informações Principais -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- Badges superiores -->
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/20 dark:border-[#00a3e0]/30 backdrop-blur-md">
                            ★ Formação Oficial RACHI Academy
                        </span>
                        @if($course->category)
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-200/80 dark:bg-white/10 text-slate-700 dark:text-slate-300">
                            {{ $course->category->name }}
                        </span>
                        @endif
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Inscrições Abertas
                        </span>
                    </div>

                    <!-- Título H1 -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-slate-900 dark:text-white tracking-tight leading-tight">
                        {{ $course->name }}
                    </h1>

                    <!-- Descrição Curta -->
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        {{ $course->short_description ?? $course->description }}
                    </p>

                    <!-- Pílulas de Métricas e Especificações -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="clock" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Carga Horária</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">{{ $course->duration_hours }} horas</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Conteúdo</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">{{ $course->modules->count() }} módulos ({{ $totalLessons }} aulas)</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="bar-chart-2" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Nível</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white capitalize">
                                @if($course->level === 'beginner') Iniciante
                                @elseif($course->level === 'intermediate') Intermediário
                                @elseif($course->level === 'advanced') Avançado
                                @else Do Básico ao Avançado
                                @endif
                            </span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="award" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Certificação</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">Oficial RACHI</span>
                        </div>
                    </div>

                    <!-- Visão Geral e Objectivos da Formação (No Box de Cima) -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-xs">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center">
                                <i data-lucide="target" class="w-5 h-5"></i>
                            </div>
                            <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white">
                                Visão Geral e Objectivos da Formação
                            </h2>
                        </div>
                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            {{ $course->description ?? $course->short_description }}
                        </p>

                        <!-- Destaques práticos -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100 dark:border-white/5">
                            <div class="flex items-start gap-3">
                                <div class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">01</div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Foco no Mercado Angolano</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Metodologia e casos práticos adaptados à realidade de Angola.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">02</div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Aprendizagem Baseada em Projetos</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Construção de portfólio tangível pronto para aplicação real.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Garantias & Selos -->
                    <div class="flex flex-wrap items-center gap-6 pt-4 border-t border-slate-200 dark:border-white/10 text-xs text-slate-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Certificado com QR Code Autenticável</span>
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="users" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Turmas Reduzidas & Mentoria Prática</span>
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="laptop" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Laboratórios & Exercícios Aplicados</span>
                        </span>
                    </div>
                </div>

                <!-- Coluna Direita: Card Flutuante de Matrícula -->
                <div class="lg:col-span-4 sticky top-28">
                    <div class="bg-white dark:bg-[#0c1527] border-2 border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-xl dark:shadow-2xl relative overflow-hidden transition-all duration-300">
                        <!-- Top Line Gradient -->
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0]"></div>

                        <!-- Imagem do Curso -->
                        <div class="h-44 w-full rounded-2xl overflow-hidden mb-5 relative border border-slate-200/80 dark:border-white/10 shadow-sm">
                            <img src="/images/courses/{{ $course->slug }}.jpg" alt="{{ $course->name }}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0c1527]/80 via-transparent to-transparent"></div>
                            <span class="absolute bottom-3 left-3 px-3 py-1 rounded-full text-xs font-bold bg-[#071326]/90 text-[#00a3e0] border border-[#00a3e0]/40 backdrop-blur-md">
                                ★ Formação Oficial RACHI
                            </span>
                        </div>

                        <!-- Preço / Investimento -->
                        <div class="mb-6">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">
                                Investimento na Formação
                            </span>
                            <div class="flex items-baseline gap-2">
                                @if($course->price > 0)
                                <span class="text-3xl sm:text-4xl font-black font-heading text-slate-900 dark:text-white tracking-tight">
                                    {{ number_format($course->price, 0, ',', '.') }}
                                </span>
                                <span class="text-base font-bold text-[#0050f0] dark:text-[#00a3e0]">Kz</span>
                                @else
                                <span class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900 dark:text-white">
                                    Sob Consulta
                                </span>
                                @endif
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                Possibilidade de pagamento parcelado ou fatura empresarial proforma.
                            </p>
                        </div>

                        <!-- Ações Imediatas -->
                        <div class="space-y-3 mb-6">
                            <button @click="openMatriculaModal = true" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-[#0050f0] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] text-white font-extrabold text-base shadow-lg shadow-[#0050f0]/30 hover:shadow-xl hover:shadow-[#0050f0]/40 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                                <span>Fazer Matrícula Agora</span>
                            </button>

                            <a href="https://wa.me/244923000000?text={{ urlencode('Olá! Gostaria de obter informações sobre a formação: ' . $course->name) }}" target="_blank" rel="noopener noreferrer" class="w-full py-3 px-4 rounded-2xl bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-slate-800 dark:text-slate-200 font-bold text-sm border border-slate-200 dark:border-white/10 transition-colors flex items-center justify-center gap-2">
                                <i data-lucide="message-square" class="w-4 h-4 text-emerald-500"></i>
                                <span>Tirar Dúvidas no WhatsApp</span>
                            </a>
                        </div>

                        <!-- O que está incluído -->
                        <div class="border-t border-slate-100 dark:border-white/10 pt-5">
                            <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-3.5">
                                O que está incluído:
                            </h3>
                            <ul class="space-y-2.5 text-xs text-slate-600 dark:text-slate-300">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">✓</span>
                                    <span>Acesso a todas as aulas teóricas e práticas</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">✓</span>
                                    <span>Certificado com validação digital e QR Code</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">✓</span>
                                    <span>Material didático e apostilas em formato digital</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">✓</span>
                                    <span>Mentoria direta com instrutores especializados</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">✓</span>
                                    <span>Acesso ao Portal do Aluno RACHI</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- DETALHES DA FORMAÇÃO & EMENTA DOS MÓDULOS                   -->
    <!-- ============================================================ -->
    <section class="py-12 bg-slate-50 dark:bg-[#081020] border-y border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                <!-- Coluna Principal (8 colunas) -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- 1. Conteúdo Programático / Módulos (Accordion) -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-xs">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center">
                                    <i data-lucide="layers" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white">
                                        Conteúdo Programático Completo
                                    </h2>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">
                                        {{ $course->modules->count() }} módulos estruturados para o seu domínio
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Lista de Módulos Accordion -->
                        <div class="space-y-3">
                            @forelse($course->modules as $index => $module)
                            <div class="border border-slate-200 dark:border-white/10 rounded-2xl overflow-hidden transition-all duration-200">
                                <button type="button" @click="activeModule = activeModule === {{ $index + 1 }} ? null : {{ $index + 1 }}" class="w-full px-5 py-4 flex items-center justify-between text-left bg-slate-50/70 dark:bg-white/[0.03] hover:bg-slate-100 dark:hover:bg-white/[0.06] transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] text-xs font-bold flex items-center justify-center">
                                            {{ $index + 1 }}
                                        </span>
                                        <div>
                                            <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white">
                                                {{ $module->title }}
                                            </h3>
                                            @if($module->description)
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                                {{ $module->description }}
                                            </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-slate-400 shrink-0">
                                        <span class="hidden sm:inline">{{ $module->lessons->count() }} aulas</span>
                                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': activeModule === {{ $index + 1 }} }"></i>
                                    </div>
                                </button>

                                <div x-show="activeModule === {{ $index + 1 }}" x-collapse class="px-5 py-4 border-t border-slate-200 dark:border-white/5 bg-white dark:bg-[#0c1527] space-y-2.5">
                                    @forelse($module->lessons as $lesson)
                                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-slate-100 dark:border-white/[0.04] last:border-0">
                                        <div class="flex items-center gap-2.5 text-slate-700 dark:text-slate-300">
                                            <i data-lucide="play-circle" class="w-3.5 h-3.5 text-[#00a3e0]"></i>
                                            <span class="font-medium">{{ $lesson->title }}</span>
                                        </div>
                                        @if($lesson->duration_minutes > 0)
                                        <span class="text-slate-400 text-[11px] shrink-0">{{ $lesson->duration_minutes }} min</span>
                                        @endif
                                    </div>
                                    @empty
                                    <p class="text-xs text-slate-500">Aulas práticas em desenvolvimento para este módulo.</p>
                                    @endforelse
                                </div>
                            </div>
                            @empty
                            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-white/5 text-center text-sm text-slate-500">
                                Os módulos deste curso estão a ser preparados para a próxima turma.
                            </div>
                            @endforelse
                        </div>
                    </div>

                </div>

                <!-- Coluna Lateral Direita (4 colunas) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Outras Formações Recomendadas -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-xs">
                        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <i data-lucide="compass" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Outras Formações RACHI</span>
                        </h3>

                        <div class="space-y-3">
                            @foreach($relatedCourses as $relCourse)
                            <a href="{{ route('academy.course.show', $relCourse->slug) }}" class="block p-3.5 rounded-2xl border border-slate-100 dark:border-white/5 hover:border-[#00a3e0]/40 dark:hover:border-[#00a3e0]/40 bg-slate-50/50 dark:bg-white/[0.02] hover:bg-slate-100/70 dark:hover:bg-white/[0.05] transition-all group">
                                <h4 class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors leading-snug line-clamp-2">
                                    {{ $relCourse->name }}
                                </h4>
                                <div class="flex items-center justify-between mt-2 text-[11px] text-slate-500 dark:text-slate-400">
                                    <span>{{ $relCourse->duration_hours }}h de formação</span>
                                    <span class="font-bold text-[#00a3e0] flex items-center gap-0.5">
                                        Ver <i data-lucide="chevron-right" class="w-3 h-3"></i>
                                    </span>
                                </div>
                            </a>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-white/5 text-center">
                            <a href="/academy#cursos" class="text-xs font-bold text-[#0050f0] dark:text-[#00a3e0] hover:underline flex items-center justify-center gap-1">
                                <span>Ver Catálogo Completo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- ============================================================ -->
    <!-- MODAL INTERATIVO DE MATRÍCULA (ALPINE.JS)                   -->
    <!-- ============================================================ -->
    <div x-show="openMatriculaModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div x-show="openMatriculaModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="openMatriculaModal = false" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"></div>

        <!-- Modal Container -->
        <div x-show="openMatriculaModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="relative w-full max-w-lg bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl overflow-hidden z-10">
            <!-- Top Line Gradient -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0]"></div>

            <!-- Botão Fechar -->
            <button type="button" @click="openMatriculaModal = false" aria-label="Fechar" class="absolute top-4 right-4 w-9 h-9 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white flex items-center justify-center transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>

            <!-- Cabeçalho Modal -->
            <div class="mb-5 pr-8">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] mb-2">
                    RACHI Academy Matrícula
                </span>
                <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-white leading-tight">
                    {{ $course->name }}
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Preencha os dados abaixo para reservar a sua vaga oficial.
                </p>
            </div>

            <!-- Formulário de Matrícula -->
            <form action="{{ route('academy.course.enroll', $course->slug) }}" method="POST" class="space-y-3.5">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        Nome Completo <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" required placeholder="Seu nome completo" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-hidden focus:border-[#00a3e0]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        E-mail <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" required placeholder="seu.email@exemplo.com" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-hidden focus:border-[#00a3e0]">
                </div>

                <div>
                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 mb-1">
                        Telefone / WhatsApp (Angola) <span class="text-red-500">*</span>
                    </label>
                    <input type="tel" name="phone" required placeholder="+244 923 000 000" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-hidden focus:border-[#00a3e0]">
                </div>


                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-[#0050f0] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] text-white font-extrabold text-sm shadow-md shadow-[#0050f0]/30 transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Confirmar e Fazer Matrícula</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- FOOTER INSTITUCIONAL RACHI                                  -->
    <!-- ============================================================ -->
    <footer class="bg-white dark:bg-[#070f1e] border-t border-slate-200 dark:border-white/10 py-10 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500 dark:text-slate-400">
            <div class="flex items-center gap-2">
                <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-6 w-auto dark:block hidden">
                <img src="/images/logo-rachi-dark.png" alt="RACHI" class="h-6 w-auto dark:hidden block">
                <span>© {{ date('Y') }} RACHI Academy. Todos os direitos reservados.</span>
            </div>
            <div class="flex items-center gap-4">
                <a href="/academy" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0]">Academy</a>
                <a href="/contacto" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0]">Contacto</a>
                <a href="/academy/login" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0]">Portal do Aluno</a>
            </div>
        </div>
    </footer>

    @if(session('matricula_sucesso'))
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toastElement = document.getElementById('enrollment-success-toast');
            if (toastElement && window.bootstrap?.Toast) {
                window.bootstrap.Toast.getOrCreateInstance(toastElement).show();
            }
        });
    </script>
    @endif

    <!-- Lucide init -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lucide.createIcons();
        });
    </script>
</body>
</html>
