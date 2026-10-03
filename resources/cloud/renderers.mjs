const __name = value => value;
// worker/course-show.ts
function esc(value) {
  return String(value ?? "").replace(/[&<>"']/g, (c) => ({
    "&": "&amp;",
    "<": "&lt;",
    ">": "&gt;",
    '"': "&quot;",
    "'": "&#39;"
  })[c] || c);
}
__name(esc, "esc");
function formatKz(price) {
  const num = Number(price);
  if (isNaN(num) || num <= 0) return "Sob Consulta";
  return new Intl.NumberFormat("pt-AO", { maximumFractionDigits: 0 }).format(num);
}
__name(formatKz, "formatKz");
function renderCourseShow(course, modules = [], relatedCourses = [], matriculaSuccess = null) {
  const totalLessons = modules.reduce((acc, m) => {
    const list2 = Array.isArray(m.lessons) ? m.lessons : [];
    return acc + list2.length;
  }, 0);
  const levelMap = {
    beginner: "Iniciante",
    intermediate: "Intermedi\xE1rio",
    advanced: "Avan\xE7ado"
  };
  const levelText = levelMap[course.level] || "Do B\xE1sico ao Avan\xE7ado";
  const priceFormatted = formatKz(course.price);
  const isConsultation = priceFormatted === "Sob Consulta";
  const defaultWaText = encodeURIComponent(`Ol\xE1! Gostaria de obter informa\xE7\xF5es sobre a forma\xE7\xE3o: ${course.name}`);
  const whatsappInquiry = `https://wa.me/244972888585?text=${defaultWaText}`;
  return `<!DOCTYPE html>
<html lang="pt-AO" data-theme="dark" class="scroll-smooth">
<head><link rel="stylesheet" href="/toast.css"><script src="/toast.js"><\/script><script src="/auth-session.js"><\/script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>${esc(course.name)} \u2014 RACHI Academy</title>
    <meta name="description" content="${esc(course.short_description || course.description || "")}">
    <link rel="canonical" href="https://rachi.casimirogundja.workers.dev/academy/cursos/${esc(course.slug)}">

    <!-- Open Graph -->
    <meta property="og:title" content="${esc(course.name)} \u2014 RACHI Academy">
    <meta property="og:description" content="${esc(course.short_description || course.description || "")}">
    <meta property="og:url" content="https://rachi.casimirogundja.workers.dev/academy/cursos/${esc(course.slug)}">
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

    <!-- App Compiled CSS -->
    <link rel="stylesheet" href="/build/assets/app-BmeisZIV.css">

    <!-- Tailwind Config (MUST BE BEFORE TAILWIND CDN SCRIPT) -->
    <script>
        tailwind = {
            config: {
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
        };
    <\/script>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"><\/script>
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"><\/script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"><\/script>

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
    <\/script>

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
            background-color: #070f1e !important;
            color: #ffffff !important;
        }
        .font-heading {
            font-family: 'Encode Sans', sans-serif;
        }
        .glow-rachi {
            box-shadow: 0 0 35px -8px rgba(0, 163, 224, 0.35);
        }

        /* Dark Mode High-Performance Theme Safeguards */
        html.dark .bg-white {
            background-color: #0c1527 !important;
        }
        html.dark .bg-slate-50,
        html.dark .bg-slate-50\/50,
        html.dark .bg-slate-50\/70 {
            background-color: #081020 !important;
        }
        html.dark .bg-slate-100 {
            background-color: rgba(255, 255, 255, 0.05) !important;
        }
        html.dark .border-slate-200,
        html.dark .border-slate-200\/80,
        html.dark .border-slate-200\/90,
        html.dark .border-slate-100 {
            border-color: rgba(255, 255, 255, 0.1) !important;
        }
        html.dark input,
        html.dark select,
        html.dark textarea {
            background-color: rgba(7, 15, 30, 0.95) !important;
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.15) !important;
        }
        html.dark input::placeholder,
        html.dark textarea::placeholder {
            color: #64748b !important;
        }
        html.dark input:focus,
        html.dark select:focus,
        html.dark textarea:focus {
            border-color: #00a3e0 !important;
            box-shadow: 0 0 0 2px rgba(0, 163, 224, 0.25) !important;
        }
    </style>
</head>
<body x-data="{ openMatriculaModal: false, activeModule: 1 }">

    <!-- HEADER CORPORATIVO RACHI ACADEMY -->
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

            <!-- Bot\xF5es de A\xE7\xE3o Header -->
            <div class="flex items-center gap-3">
                <a href="/academy/login" class="px-4 py-2 rounded-xl text-xs font-bold bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 hover:bg-[#0050f0]/20 text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/20 transition hidden sm:inline-flex items-center gap-1.5">
                    <i data-lucide="user" class="w-3.5 h-3.5"></i>
                    <span>Portal do Aluno</span>
                </a>
                <!-- Toggle Dark Mode -->
                <button type="button" onclick="toggleRachiTheme()" aria-label="Alternar Tema" class="w-10 h-10 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-200 hover:text-[#0050f0] dark:hover:text-[#00a3e0] flex items-center justify-center transition-colors">
                    <i data-lucide="sun" class="w-5 h-5 hidden dark:block"></i>
                    <i data-lucide="moon" class="w-5 h-5 block dark:hidden"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- BREADCRUMBS -->
    <nav class="bg-slate-100/60 dark:bg-[#0c1527]/50 border-b border-slate-200/80 dark:border-white/5 py-3">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <ol class="flex items-center flex-wrap gap-2 text-xs font-medium text-slate-500 dark:text-slate-400">
                <li><a href="/" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">In\xEDcio</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li><a href="/academy" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">RACHI Academy</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li><a href="/academy#cursos" class="hover:text-[#0050f0] dark:hover:text-[#00a3e0] transition-colors">Forma\xE7\xF5es</a></li>
                <li><i data-lucide="chevron-right" class="w-3 h-3 text-slate-400"></i></li>
                <li class="text-slate-900 dark:text-white font-semibold truncate max-w-[280px] sm:max-w-md">${esc(course.name)}</li>
            </ol>
        </div>
    </nav>

    <!-- ALERTA DE SUCESSO DE MATR\xCDCULA -->
    ${matriculaSuccess ? `<span hidden data-rachi-flash="success">Recebemos a sua solicita\xE7\xE3o de matr\xEDcula com sucesso e retornaremos em breve.</span>
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
                            Pr\xE9-Matr\xEDcula Confirmada com Sucesso!
                        </span>
                        <h2 class="text-xl sm:text-2xl font-bold font-heading text-white tracking-tight">
                            Parab\xE9ns, ${esc(matriculaSuccess.name)}!
                        </h2>
                        <p class="text-sm text-slate-300 mt-1 max-w-2xl leading-relaxed">
                            A sua reserva de vaga para a forma\xE7\xE3o <strong class="text-[#00a3e0]">${esc(matriculaSuccess.course)}</strong> foi registada com o c\xF3digo oficial <span class="px-2 py-0.5 rounded bg-white/10 font-mono text-white font-bold">${esc(matriculaSuccess.code)}</span>.
                        </p>
                    </div>
                </div>
                <div class="shrink-0 flex flex-col sm:flex-row items-stretch sm:items-center gap-3 w-full md:w-auto">
                    <a href="${esc(matriculaSuccess.whatsappUrl)}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm shadow-lg transition-all">
                        <i data-lucide="message-circle" class="w-5 h-5"></i>
                        <span>Confirmar no WhatsApp</span>
                    </a>
                </div>
            </div>
        </div>
    </section>` : ""}

    <!-- HERO DO CURSO -->
    <section class="relative pt-10 pb-16 overflow-hidden">
        <!-- Efeito ambiente de fundo -->
        <div class="absolute top-0 right-1/4 w-96 h-96 bg-[#00a3e0]/10 dark:bg-[#00a3e0]/15 rounded-full blur-3xl pointer-events-none -z-10"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-[#0050f0]/10 dark:bg-[#0050f0]/15 rounded-full blur-3xl pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                
                <!-- Coluna Esquerda: Informa\xE7\xF5es Principais -->
                <div class="lg:col-span-8 space-y-6">
                    <!-- Badges superiores -->
                    <div class="flex flex-wrap items-center gap-2.5">
                        <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full text-xs font-bold bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/20 dark:border-[#00a3e0]/30 backdrop-blur-md">
                            \u2605 Forma\xE7\xE3o Oficial RACHI Academy
                        </span>
                        ${course.category_name ? `
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-200/80 dark:bg-white/10 text-slate-700 dark:text-slate-300">
                            ${esc(course.category_name)}
                        </span>` : ""}
                        <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 border border-emerald-500/20">
                            <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                            Inscri\xE7\xF5es Abertas
                        </span>
                    </div>

                    <!-- T\xEDtulo H1 -->
                    <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold font-heading text-slate-900 dark:text-white tracking-tight leading-tight">
                        ${esc(course.name)}
                    </h1>

                    <!-- Descri\xE7\xE3o Curta -->
                    <p class="text-base sm:text-lg text-slate-600 dark:text-slate-300 leading-relaxed max-w-3xl">
                        ${esc(course.short_description || course.description || "")}
                    </p>

                    <!-- P\xEDlulas de M\xE9tricas e Especifica\xE7\xF5es -->
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 pt-2">
                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="clock" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Carga Hor\xE1ria</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">${course.duration_hours || 40} horas</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="book-open" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Conte\xFAdo</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">${modules.length} m\xF3dulos (${totalLessons} aulas)</span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="bar-chart-2" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>N\xEDvel</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white capitalize">
                                ${esc(levelText)}
                            </span>
                        </div>

                        <div class="p-3.5 rounded-2xl bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 shadow-xs">
                            <div class="flex items-center gap-2 text-slate-500 dark:text-slate-400 text-xs mb-1">
                                <i data-lucide="award" class="w-4 h-4 text-[#00a3e0]"></i>
                                <span>Certifica\xE7\xE3o</span>
                            </div>
                            <span class="text-base font-bold text-slate-900 dark:text-white">Oficial RACHI</span>
                        </div>
                    </div>

                    <!-- Vis\xE3o Geral e Objectivos da Forma\xE7\xE3o -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-xs">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 rounded-xl bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center">
                                <i data-lucide="target" class="w-5 h-5"></i>
                            </div>
                            <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white">
                                Vis\xE3o Geral e Objectivos da Forma\xE7\xE3o
                            </h2>
                        </div>
                        <p class="text-sm sm:text-base text-slate-600 dark:text-slate-300 leading-relaxed mb-6">
                            ${esc(course.description || course.short_description || "")}
                        </p>

                        <!-- Destaques pr\xE1ticos -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-4 border-t border-slate-100 dark:border-white/5">
                            <div class="flex items-start gap-3">
                                <div class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">01</div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Foco no Mercado Angolano</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Metodologia e casos pr\xE1ticos adaptados \xE0 realidade de Angola.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-3">
                                <div class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center shrink-0 mt-0.5 font-bold text-xs">02</div>
                                <div>
                                    <h4 class="text-sm font-bold text-slate-900 dark:text-white">Aprendizagem Baseada em Projetos</h4>
                                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">Constru\xE7\xE3o de portf\xF3lio tang\xEDvel pronto para aplica\xE7\xE3o real.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Garantias & Selos -->
                    <div class="flex flex-wrap items-center gap-6 pt-4 border-t border-slate-200 dark:border-white/10 text-xs text-slate-600 dark:text-slate-400">
                        <span class="flex items-center gap-2">
                            <i data-lucide="shield-check" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Certificado com QR Code Autentic\xE1vel</span>
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="users" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Turmas Reduzidas & Mentoria Pr\xE1tica</span>
                        </span>
                        <span class="flex items-center gap-2">
                            <i data-lucide="laptop" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Laborat\xF3rios & Exerc\xEDcios Aplicados</span>
                        </span>
                    </div>
                </div>

                <!-- Coluna Direita: Card Flutuante de Matr\xEDcula -->
                <div class="lg:col-span-4 sticky top-28">
                    <div class="bg-white dark:bg-[#0c1527] border-2 border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-7 shadow-xl dark:shadow-2xl relative overflow-hidden transition-all duration-300">
                        <!-- Top Line Gradient -->
                        <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0]"></div>

                        <!-- Imagem do Curso -->
                        <div class="h-44 w-full rounded-2xl overflow-hidden mb-5 relative border border-slate-200/80 dark:border-white/10 shadow-sm">
                            <img src="/images/courses/${esc(course.slug)}.jpg" onerror="this.src='/images/areas/rachi-academy.png'" alt="${esc(course.name)}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0c1527]/80 via-transparent to-transparent"></div>
                            <span class="absolute bottom-3 left-3 px-3 py-1 rounded-full text-xs font-bold bg-[#071326]/90 text-[#00a3e0] border border-[#00a3e0]/40 backdrop-blur-md">
                                \u2605 Forma\xE7\xE3o Oficial RACHI
                            </span>
                        </div>

                        <!-- Pre\xE7o / Investimento -->
                        <div class="mb-6">
                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider block mb-1">
                                Investimento na Forma\xE7\xE3o
                            </span>
                            <div class="flex items-baseline gap-2">
                                ${isConsultation ? `
                                <span class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-900 dark:text-white">
                                    Sob Consulta
                                </span>` : `
                                <span class="text-3xl sm:text-4xl font-black font-heading text-slate-900 dark:text-white tracking-tight">
                                    ${priceFormatted}
                                </span>
                                <span class="text-base font-bold text-[#0050f0] dark:text-[#00a3e0]">Kz</span>`}
                            </div>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                                Possibilidade de pagamento parcelado ou fatura empresarial proforma.
                            </p>
                        </div>

                        <!-- A\xE7\xF5es Imediatas -->
                        <div class="space-y-3 mb-6">
                            <button @click="openMatriculaModal = true" class="w-full py-4 px-6 rounded-2xl bg-gradient-to-r from-[#0050f0] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] text-white font-extrabold text-base shadow-lg shadow-[#0050f0]/30 hover:shadow-xl hover:shadow-[#0050f0]/40 hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer">
                                <i data-lucide="check-circle" class="w-5 h-5"></i>
                                <span>Fazer Matr\xEDcula Agora</span>
                            </button>

                            <a href="${whatsappInquiry}" target="_blank" rel="noopener noreferrer" class="w-full py-3 px-4 rounded-2xl bg-slate-100 dark:bg-white/5 hover:bg-slate-200 dark:hover:bg-white/10 text-slate-800 dark:text-slate-200 font-bold text-sm border border-slate-200 dark:border-white/10 transition-colors flex items-center justify-center gap-2">
                                <i data-lucide="message-square" class="w-4 h-4 text-emerald-500"></i>
                                <span>Tirar D\xFAvidas no WhatsApp</span>
                            </a>
                        </div>

                        <!-- O que est\xE1 inclu\xEDdo -->
                        <div class="border-t border-slate-100 dark:border-white/10 pt-5">
                            <h3 class="text-xs font-bold text-slate-900 dark:text-white uppercase tracking-wider mb-3.5">
                                O que est\xE1 inclu\xEDdo:
                            </h3>
                            <ul class="space-y-2.5 text-xs text-slate-600 dark:text-slate-300">
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Acesso a todas as aulas te\xF3ricas e pr\xE1ticas</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Certificado com valida\xE7\xE3o digital e QR Code</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Material did\xE1tico e apostilas em formato digital</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Mentoria direta com instrutores especializados</span>
                                </li>
                                <li class="flex items-center gap-2.5">
                                    <span class="w-5 h-5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center font-bold text-[11px] shrink-0">\u2713</span>
                                    <span>Acesso ao Portal do Aluno RACHI</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- DETALHES DA FORMA\xC7\xC3O & EMENTA DOS M\xD3DULOS -->
    <section class="py-12 bg-slate-50 dark:bg-[#081020] border-y border-slate-200 dark:border-white/5">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">

                <!-- Coluna Principal (8 colunas) -->
                <div class="lg:col-span-8 space-y-12">
                    
                    <!-- Conte\xFAdo Program\xE1tico / M\xF3dulos (Accordion) -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-xs">
                        <div class="flex items-center justify-between gap-4 mb-6">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] flex items-center justify-center">
                                    <i data-lucide="layers" class="w-5 h-5"></i>
                                </div>
                                <div>
                                    <h2 class="text-xl sm:text-2xl font-bold font-heading text-slate-900 dark:text-white">
                                        Conte\xFAdo Program\xE1tico Completo
                                    </h2>
                                    <p class="text-xs text-slate-500 dark:text-slate-400">
                                        ${modules.length} m\xF3dulos estruturados para o seu dom\xEDnio
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Lista de M\xF3dulos Accordion -->
                        <div class="space-y-3">
                            ${modules.length ? modules.map((module, index) => {
    const lessons = Array.isArray(module.lessons) ? module.lessons : [];
    return `
                            <div class="border border-slate-200 dark:border-white/10 rounded-2xl overflow-hidden transition-all duration-200">
                                <button type="button" @click="activeModule = activeModule === ${index + 1} ? null : ${index + 1}" class="w-full px-5 py-4 flex items-center justify-between text-left bg-slate-50/70 dark:bg-white/[0.03] hover:bg-slate-100 dark:hover:bg-white/[0.06] transition-colors">
                                    <div class="flex items-center gap-3">
                                        <span class="w-7 h-7 rounded-lg bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 border border-[#0050f0]/20 dark:border-[#00a3e0]/30 text-[#0050f0] dark:text-[#00a3e0] text-xs font-bold flex items-center justify-center">
                                            ${index + 1}
                                        </span>
                                        <div>
                                            <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white">
                                                ${esc(module.title)}
                                            </h3>
                                            ${module.description ? `
                                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">
                                                ${esc(module.description)}
                                            </p>` : ""}
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-3 text-xs text-slate-400 shrink-0">
                                        <span class="hidden sm:inline">${lessons.length} aulas</span>
                                        <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': activeModule === ${index + 1} }"></i>
                                    </div>
                                </button>

                                <div x-show="activeModule === ${index + 1}" class="px-5 py-4 border-t border-slate-200 dark:border-white/5 bg-white dark:bg-[#0c1527] space-y-2.5">
                                    ${lessons.length ? lessons.map((lesson) => `
                                    <div class="flex items-center justify-between text-xs py-1.5 border-b border-slate-100 dark:border-white/[0.04] last:border-0">
                                        <div class="flex items-center gap-2.5 text-slate-700 dark:text-slate-300">
                                            <i data-lucide="play-circle" class="w-3.5 h-3.5 text-[#00a3e0]"></i>
                                            <span class="font-medium">${esc(lesson.title)}</span>
                                        </div>
                                        ${lesson.duration_minutes ? `
                                        <span class="text-slate-400 text-[11px] shrink-0">${lesson.duration_minutes} min</span>` : ""}
                                    </div>
                                    `).join("") : `
                                    <p class="text-xs text-slate-500">Aulas pr\xE1ticas em desenvolvimento para este m\xF3dulo.</p>`}
                                </div>
                            </div>
                            `;
  }).join("") : `
                            <div class="p-6 rounded-2xl bg-slate-50 dark:bg-white/5 text-center text-sm text-slate-500">
                                Os m\xF3dulos deste curso est\xE3o a ser preparados para a pr\xF3xima turma.
                            </div>`}
                        </div>
                    </div>

                </div>

                <!-- Coluna Lateral Direita (4 colunas) -->
                <div class="lg:col-span-4 space-y-6">
                    
                    <!-- Outras Forma\xE7\xF5es Recomendadas -->
                    <div class="bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 shadow-xs">
                        <h3 class="text-base font-bold font-heading text-slate-900 dark:text-white mb-4 flex items-center gap-2">
                            <i data-lucide="compass" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Outras Forma\xE7\xF5es RACHI</span>
                        </h3>

                        <div class="space-y-3">
                            ${relatedCourses.map((rel) => `
                            <a href="/academy/cursos/${esc(rel.slug)}" class="block p-3.5 rounded-2xl border border-slate-100 dark:border-white/5 hover:border-[#00a3e0]/40 dark:hover:border-[#00a3e0]/40 bg-slate-50/50 dark:bg-white/[0.02] hover:bg-slate-100/70 dark:hover:bg-white/[0.05] transition-all group">
                                <h4 class="text-xs font-bold text-slate-900 dark:text-white group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition-colors leading-snug line-clamp-2">
                                    ${esc(rel.name)}
                                </h4>
                                <div class="flex items-center justify-between mt-2 text-[11px] text-slate-500 dark:text-slate-400">
                                    <span>${rel.duration_hours || 40}h de forma\xE7\xE3o</span>
                                    <span class="font-bold text-[#00a3e0] flex items-center gap-0.5">
                                        Ver <i data-lucide="chevron-right" class="w-3 h-3"></i>
                                    </span>
                                </div>
                            </a>
                            `).join("")}
                        </div>

                        <div class="mt-4 pt-4 border-t border-slate-100 dark:border-white/5 text-center">
                            <a href="/academy#cursos" class="text-xs font-bold text-[#0050f0] dark:text-[#00a3e0] hover:underline flex items-center justify-center gap-1">
                                <span>Ver Cat\xE1logo Completo</span>
                                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    <!-- MODAL INTERATIVO DE MATR\xCDCULA -->
    <div x-show="openMatriculaModal" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 sm:p-6 overflow-y-auto" role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div x-show="openMatriculaModal" @click="openMatriculaModal = false" class="fixed inset-0 bg-slate-950/80 backdrop-blur-md"></div>

        <!-- Modal Container -->
        <div x-show="openMatriculaModal" class="relative w-full max-w-lg bg-white dark:bg-[#0c1527] border border-slate-200 dark:border-white/10 rounded-3xl p-6 sm:p-8 shadow-2xl overflow-hidden z-10">
            <!-- Top Line Gradient -->
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#0050f0]"></div>

            <!-- Bot\xE3o Fechar -->
            <button type="button" @click="openMatriculaModal = false" aria-label="Fechar" class="absolute top-4 right-4 w-9 h-9 rounded-xl bg-slate-100 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-500 hover:text-slate-900 dark:hover:text-white flex items-center justify-center transition-colors">
                <i data-lucide="x" class="w-4 h-4"></i>
            </button>

            <!-- Cabe\xE7alho Modal -->
            <div class="mb-5 pr-8">
                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] mb-2">
                    RACHI Academy Matr\xEDcula
                </span>
                <h3 class="text-xl font-bold font-heading text-slate-900 dark:text-white leading-tight">
                    ${esc(course.name)}
                </h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">
                    Preencha os dados abaixo para reservar a sua vaga oficial.
                </p>
            </div>

            <!-- Formul\xE1rio de Matr\xEDcula -->
            <form action="/academy/cursos/${esc(course.slug)}/matricula" method="POST" class="space-y-3.5">
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
                    <input type="tel" name="phone" required placeholder="+244 972 888 585" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white text-xs focus:outline-hidden focus:border-[#00a3e0]">
                </div>

                <div class="pt-2">
                    <button type="submit" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-[#0050f0] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] text-white font-extrabold text-sm shadow-md shadow-[#0050f0]/30 transition-all flex items-center justify-center gap-2 cursor-pointer">
                        <i data-lucide="check" class="w-4 h-4"></i>
                        <span>Confirmar e Fazer Matr\xEDcula</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

        <!-- ============================================================ -->
    <!-- FOOTER INSTITUCIONAL RACHI ACADEMY                          -->
    <!-- ============================================================ -->
    <footer class="bg-slate-100 dark:bg-[#071326] text-slate-700 dark:text-slate-300 pt-16 pb-8 border-t border-slate-200 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div>
                    <!-- Footer Logo Oficial RACHI Academy -->
                    <a href="/academy" class="inline-flex items-center gap-2.5 mb-4 group text-decoration-none">
                        <picture class="flex items-center">
                            <source srcset="/images/areas/rachi-academy.webp" type="image/webp">
                            <img src="/images/areas/rachi-academy.png" 
                                 onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/areas/rachi-academy.png'" 
                                 alt="RACHI Academy" 
                                 class="h-8 w-auto object-contain filter drop-shadow-[0_0_4px_rgba(99,102,241,0.35)] group-hover:scale-105 transition-all">
                        </picture>
                        <span class="font-display font-bold text-base text-slate-900 dark:text-white">RACHI <span class="text-[#0050f0] dark:text-[#00a3e0]">Academy</span></span>
                    </a>
                    <p class="text-xs text-slate-600 dark:text-slate-400 leading-relaxed">
                        Formação executiva, tecnologia, inteligência artificial e programas corporativos para profissionais e empresas em Angola.
                    </p>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#0050f0] dark:text-[#00a3e0] mb-3">Soluções RACHI</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/capital" class="hover:text-emerald-400 transition">01 RACHI Human Capital</a></li>
                        <li><a href="/academy" class="hover:text-indigo-400 transition text-[#0050f0] dark:text-[#00a3e0] font-bold">02 RACHI Academy</a></li>
                        <li><a href="/tec" class="hover:text-sky-400 transition">03 RACHI Tec</a></li>
                        <li><a href="/print" class="hover:text-amber-400 transition">04 RACHI Print</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#0050f0] dark:text-[#00a3e0] mb-3">Navegação</h4>
                    <ul class="space-y-2 text-xs text-slate-600 dark:text-slate-400">
                        <li><a href="/" class="hover:text-slate-900 dark:hover:text-white transition">Portal RACHI</a></li>
                        <li><a href="/academy#cursos" class="hover:text-slate-900 dark:hover:text-white transition">Catálogo de Cursos</a></li>
                        <li><a href="/aluno-dashboard" class="hover:text-slate-900 dark:hover:text-white transition">Área do Aluno</a></li>
                        <li><a href="/contacto" class="hover:text-slate-900 dark:hover:text-white transition">Contacto &amp; Matrículas</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-[#0050f0] dark:text-[#00a3e0] mb-3">Contacto</h4>
                    <p class="text-xs text-slate-600 dark:text-slate-400">Luanda — Angola</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-1">Horário: Seg-Sex 08h às 17h</p>
                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2">Formações presenciais e à distância com certificação oficial.</p>
                </div>
            </div>
            <div class="border-t border-slate-200 dark:border-slate-800/80 pt-6 flex flex-col sm:flex-row justify-between items-center text-xs text-slate-500 dark:text-slate-400 gap-4">
                <div>&copy; 2026 <strong class="text-slate-900 dark:text-white">RACHI Academy</strong>. Todos os direitos reservados.</div>
                <div class="flex gap-4">
                    <span class="text-[#0050f0] dark:text-[#00a3e0] font-bold">PT</span>
                    <span class="text-slate-600">|</span>
                    <span>EN</span>
                </div>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (window.lucide) {
                lucide.createIcons();
            }
        });
    <\/script>
</body>
</html>`;
}
__name(renderCourseShow, "renderCourseShow");


// worker/views.ts
function shell(title, content) {
  return `<!doctype html><html lang="pt"><head><link rel="stylesheet" href="/toast.css"><script src="/toast.js"><\/script><script src="/auth-session.js"><\/script><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>${title} \xB7 RACHI</title><link rel="stylesheet" href="/worker.css"><script src="/worker-ui.js" defer><\/script></head><body><header><a class="brand" href="/">RACHI<span>Solu\xE7\xF5es inteligentes</span></a><nav><a href="/loja">Loja</a><a href="/academy/cursos">Academy</a><a href="/portal">Minha conta</a></nav></header><main>${content}</main><footer>RACHI \xB7 Tecnologia, forma\xE7\xE3o e servi\xE7os empresariais</footer></body></html>`;
}
__name(shell, "shell");
function loginPage(register = false) {
  const isRegister = register;
  return `<!doctype html>
<html lang="pt-AO" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Painel Administrativo \xB7 RACHI</title>
  <meta name="description" content="Autentica\xE7\xE3o segura e gest\xE3o integrada das unidades TEC, PRINT, ACADEMY e HUMAN CAPITAL \u2014 RACHI.">
  <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">
  
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  
  <link rel="stylesheet" href="/toast.css">
  <script src="/toast.js"><\/script>
  <script src="/auth-session.js"><\/script>

  <!-- Script Anti-Flash de Tema -->
  <script>
    (function() {
      var t = localStorage.getItem('rachi_theme');
      if (t === 'light') {
        document.documentElement.classList.remove('dark');
        document.documentElement.setAttribute('data-theme', 'light');
      } else {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-theme', 'dark');
      }
    })();

    window.toggleRachiTheme = function() {
      var isDark = document.documentElement.classList.toggle('dark');
      var t = isDark ? 'dark' : 'light';
      document.documentElement.setAttribute('data-theme', t);
      localStorage.setItem('rachi_theme', t);
      var label = document.getElementById('theme-toggle-label');
      if (label) label.textContent = isDark ? 'Modo Claro' : 'Modo Escuro';
      window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
      return isDark;
    };
  <\/script>

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    
    :root {
      --font-sans: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
      --font-heading: 'Outfit', 'Plus Jakarta Sans', sans-serif;
      
      --brand-blue: #0050f0;
      --brand-blue-hover: #0041c4;
      --brand-cyan: #00a3e0;
      --brand-gold: #f5a800;
      
      /* Modo Escuro (Padr\xE3o) */
      --bg-page: #060b17;
      --bg-sidebar: #091122;
      --bg-card: rgba(14, 24, 46, 0.95);
      --bg-input: rgba(6, 12, 24, 0.9);
      
      --border-subtle: rgba(255, 255, 255, 0.08);
      --border-card: rgba(255, 255, 255, 0.09);
      --border-hover: rgba(0, 163, 224, 0.4);
      --border-input: rgba(255, 255, 255, 0.14);
      
      --text-main: #f8fafc;
      --text-muted: #94a3b8;
      --text-dim: #64748b;
      
      --input-focus-border: #00a3e0;
      --input-focus-ring: rgba(0, 163, 224, 0.25);
      
      --badge-admin-bg: rgba(0, 80, 240, 0.15);
      --badge-admin-border: rgba(0, 163, 224, 0.35);
      --badge-admin-text: #38bdf8;
      
      --badge-showcase-bg: rgba(245, 168, 0, 0.12);
      --badge-showcase-border: rgba(245, 168, 0, 0.3);
      --badge-showcase-text: #fbbf24;
      
      --shadow-sidebar: 15px 0 45px rgba(0, 0, 0, 0.35);
      --shadow-card: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
      
      --toggle-bg: rgba(255, 255, 255, 0.06);
      --toggle-border: rgba(255, 255, 255, 0.12);
      --toggle-text: #cbd5e1;
    }

    html:not(.dark) {
      /* Modo Claro */
      --bg-page: #f4f6fa;
      --bg-sidebar: #ffffff;
      --bg-card: #ffffff;
      --bg-input: #ffffff;
      
      --border-subtle: #e2e8f0;
      --border-card: #e5e9f2;
      --border-hover: rgba(0, 80, 240, 0.35);
      --border-input: #cbd5e1;
      
      --text-main: #0f172a;
      --text-muted: #475569;
      --text-dim: #64748b;
      
      --input-focus-border: #0050f0;
      --input-focus-ring: rgba(0, 80, 240, 0.18);
      
      --badge-admin-bg: rgba(0, 80, 240, 0.08);
      --badge-admin-border: rgba(0, 80, 240, 0.22);
      --badge-admin-text: #0050f0;
      
      --badge-showcase-bg: rgba(245, 168, 0, 0.1);
      --badge-showcase-border: rgba(245, 168, 0, 0.25);
      --badge-showcase-text: #b45309;
      
      --shadow-sidebar: 10px 0 35px rgba(15, 23, 42, 0.04);
      --shadow-card: 0 4px 20px -2px rgba(15, 23, 42, 0.06), 0 2px 6px -1px rgba(15, 23, 42, 0.03);
      
      --toggle-bg: #f1f5f9;
      --toggle-border: #cbd5e1;
      --toggle-text: #334155;
    }

    body {
      font-family: var(--font-sans);
      background-color: var(--bg-page);
      color: var(--text-main);
      min-height: 100vh;
      line-height: 1.5;
      display: flex;
      flex-direction: column;
      transition: background-color 0.25s ease, color 0.25s ease;
      background-image: 
        radial-gradient(at 0% 0%, rgba(0, 80, 240, 0.12) 0px, transparent 50%),
        radial-gradient(at 100% 100%, rgba(0, 163, 224, 0.09) 0px, transparent 50%);
      background-attachment: fixed;
    }

    /* Container Principal */
    .admin-login-layout {
      display: grid;
      grid-template-columns: minmax(380px, 470px) 1fr;
      min-height: 100vh;
      width: 100%;
    }

    /* COLUNA ESQUERDA: AUTENTICA\xC7\xC3O ADMINISTRATIVA */
    .auth-col {
      background-color: var(--bg-sidebar);
      border-right: 1px solid var(--border-subtle);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 2.75rem 2.75rem 2.25rem;
      position: relative;
      z-index: 10;
      box-shadow: var(--shadow-sidebar);
      transition: background-color 0.25s ease, border-color 0.25s ease;
    }

    .auth-header-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 2rem;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--text-muted);
      text-decoration: none;
      padding: 0.4rem 0.65rem;
      border-radius: 8px;
      transition: all 0.2s ease;
    }
    .back-link:hover {
      color: var(--brand-cyan);
      background: rgba(0, 163, 224, 0.08);
    }
    .back-link svg {
      transition: transform 0.2s ease;
    }
    .back-link:hover svg {
      transform: translateX(-3px);
    }

    .theme-toggle-btn {
      background: var(--toggle-bg);
      border: 1px solid var(--toggle-border);
      color: var(--toggle-text);
      padding: 0.45rem 0.85rem;
      border-radius: 10px;
      display: inline-flex;
      align-items: center;
      gap: 0.5rem;
      font-size: 0.75rem;
      font-weight: 700;
      cursor: pointer;
      transition: all 0.2s ease;
      user-select: none;
    }
    .theme-toggle-btn:hover {
      border-color: var(--brand-cyan);
      color: var(--text-main);
      background: rgba(0, 163, 224, 0.1);
    }

    html:not(.dark) .icon-sun { display: none; }
    html.dark .icon-moon { display: none; }

    /* Logo & Marca */
    .brand-wrap {
      margin-bottom: 2rem;
    }
    .brand-logo-img {
      height: 38px;
      width: auto;
      max-width: 190px;
      display: block;
      object-fit: contain;
    }
    /* Regra do Logotipo Conforme o Tema:
       - No Modo Escuro (fundo escuro): exibe o logotipo claro/branco (.logo-for-dark)
       - No Modo Claro (fundo claro): exibe o logotipo escuro (.logo-for-light) */
    html.dark .logo-for-light { display: none !important; }
    html.dark .logo-for-dark { display: block !important; }
    html:not(.dark) .logo-for-light { display: block !important; }
    html:not(.dark) .logo-for-dark { display: none !important; }

    .auth-title {
      font-family: var(--font-heading);
      font-size: 1.85rem;
      font-weight: 800;
      color: var(--text-main);
      letter-spacing: -0.02em;
      line-height: 1.2;
      margin-top: 0.85rem;
      margin-bottom: 0.4rem;
    }
    .auth-desc {
      font-size: 0.875rem;
      color: var(--text-muted);
      line-height: 1.5;
      margin-bottom: 2rem;
    }

    /* Formul\xE1rio */
    .form-group {
      margin-bottom: 1.25rem;
    }
    .form-label {
      display: block;
      font-size: 0.8125rem;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 0.45rem;
    }
    .input-wrap {
      position: relative;
      display: flex;
      align-items: center;
    }
    .input-icon {
      position: absolute;
      left: 1rem;
      width: 18px;
      height: 18px;
      color: var(--text-dim);
      pointer-events: none;
      transition: color 0.2s;
    }
    .form-control {
      width: 100%;
      padding: 0.825rem 1rem 0.825rem 2.75rem;
      font-family: var(--font-sans);
      font-size: 0.9rem;
      color: var(--text-main);
      background-color: var(--bg-input);
      border: 1.5px solid var(--border-input);
      border-radius: 11px;
      transition: border-color 0.2s, box-shadow 0.2s, background-color 0.2s;
    }
    .form-control:focus {
      outline: none;
      border-color: var(--input-focus-border);
      box-shadow: 0 0 0 3px var(--input-focus-ring);
    }
    .form-control::placeholder {
      color: var(--text-dim);
      font-size: 0.85rem;
    }
    .toggle-pass-btn {
      position: absolute;
      right: 0.75rem;
      background: none;
      border: none;
      color: var(--text-dim);
      cursor: pointer;
      padding: 0.4rem;
      border-radius: 6px;
      display: flex;
      align-items: center;
      transition: color 0.2s;
    }
    .toggle-pass-btn:hover {
      color: var(--text-main);
    }

    /* Op\xE7\xF5es Extras */
    .form-extras {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin-bottom: 1.5rem;
      font-size: 0.8125rem;
    }
    .remember-wrap {
      display: flex;
      align-items: center;
      gap: 0.5rem;
      cursor: pointer;
      color: var(--text-muted);
      user-select: none;
    }
    .remember-wrap input[type="checkbox"] {
      width: 16px;
      height: 16px;
      border-radius: 4px;
      accent-color: var(--brand-blue);
      cursor: pointer;
    }
    .forgot-link {
      color: var(--brand-cyan);
      text-decoration: none;
      font-weight: 600;
    }
    .forgot-link:hover {
      text-decoration: underline;
    }

    /* Bot\xE3o Prim\xE1rio */
    .btn-submit {
      width: 100%;
      padding: 0.95rem 1.25rem;
      font-family: var(--font-sans);
      font-size: 0.925rem;
      font-weight: 700;
      color: #ffffff;
      background: linear-gradient(135deg, var(--brand-blue) 0%, #0077e6 100%);
      border: none;
      border-radius: 11px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.6rem;
      transition: all 0.2s ease;
      box-shadow: 0 4px 16px rgba(0, 80, 240, 0.35);
    }
    .btn-submit:hover:not(:disabled) {
      background: linear-gradient(135deg, var(--brand-blue-hover) 0%, #0066cc 100%);
      transform: translateY(-1px);
      box-shadow: 0 6px 20px rgba(0, 80, 240, 0.45);
    }
    .btn-submit:disabled {
      opacity: 0.65;
      cursor: not-allowed;
      transform: none;
    }

    .spinner {
      width: 18px;
      height: 18px;
      border: 2px solid rgba(255, 255, 255, 0.3);
      border-radius: 50%;
      border-top-color: #ffffff;
      animation: spin 0.7s linear infinite;
      display: none;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    /* Mensagem de Feedback */
    .feedback-msg {
      margin-top: 1.25rem;
      padding: 0.85rem 1.1rem;
      border-radius: 10px;
      font-size: 0.825rem;
      display: none;
      line-height: 1.4;
    }
    .feedback-msg.error {
      background: rgba(239, 68, 68, 0.12);
      border: 1px solid rgba(239, 68, 68, 0.35);
      color: #ef4444;
    }
    html.dark .feedback-msg.error {
      color: #f87171;
    }
    .feedback-msg.success {
      background: rgba(16, 185, 129, 0.12);
      border: 1px solid rgba(16, 185, 129, 0.35);
      color: #10b981;
    }
    html.dark .feedback-msg.success {
      color: #34d399;
    }

    .auth-footer {
      margin-top: 2.5rem;
      font-size: 0.72rem;
      color: var(--text-dim);
      display: flex;
      align-items: center;
      gap: 0.4rem;
    }

    /* COLUNA DIREITA: APRESENTA\xC7\xC3O DO PROJETO RACHI */
    .showcase-col {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 4rem 5rem;
      position: relative;
      overflow-y: auto;
    }

    .showcase-header {
      max-width: 720px;
      margin-bottom: 2.5rem;
    }
    .showcase-tag {
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      padding: 0.35rem 0.85rem;
      border-radius: 9999px;
      font-size: 0.7rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      background: var(--badge-showcase-bg);
      color: var(--badge-showcase-text);
      border: 1px solid var(--badge-showcase-border);
      margin-bottom: 1.25rem;
    }
    .showcase-heading {
      font-family: var(--font-heading);
      font-size: clamp(2rem, 2.7vw, 2.75rem);
      font-weight: 800;
      line-height: 1.2;
      color: var(--text-main);
      letter-spacing: -0.02em;
      margin-bottom: 1.15rem;
    }
    .showcase-heading span {
      background: linear-gradient(135deg, var(--brand-blue) 0%, var(--brand-cyan) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    html.dark .showcase-heading span {
      background: linear-gradient(135deg, var(--brand-cyan) 0%, #60a5fa 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .showcase-lead {
      font-size: 1rem;
      color: var(--text-muted);
      line-height: 1.65;
    }

    /* Grid das 4 Unidades RACHI */
    .units-section-title {
      font-size: 0.75rem;
      font-weight: 800;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--text-dim);
      margin-bottom: 1.25rem;
      display: flex;
      align-items: center;
      gap: 0.6rem;
    }
    .units-section-title::after {
      content: '';
      flex: 1;
      height: 1px;
      background: var(--border-subtle);
    }

    .units-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 1.35rem;
      max-width: 900px;
    }

    .unit-card {
      background: var(--bg-card);
      border: 1px solid var(--border-card);
      border-radius: 16px;
      padding: 1.5rem;
      box-shadow: var(--shadow-card);
      transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .unit-card:hover {
      transform: translateY(-3px);
      border-color: var(--border-hover);
      box-shadow: 0 14px 30px -5px rgba(0, 0, 0, 0.15);
    }
    html.dark .unit-card:hover {
      box-shadow: 0 14px 30px -5px rgba(0, 0, 0, 0.4), 0 0 20px -5px rgba(0, 163, 224, 0.15);
    }

    .unit-card-header {
      display: flex;
      align-items: center;
      gap: 0.85rem;
      margin-bottom: 0.85rem;
    }
    .unit-icon-box {
      width: 44px;
      height: 44px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.25rem;
      flex-shrink: 0;
    }
    .unit-icon-box.tec { background: rgba(0, 163, 224, 0.12); color: #00a3e0; border: 1px solid rgba(0, 163, 224, 0.25); }
    .unit-icon-box.print { background: rgba(245, 168, 0, 0.12); color: #f5a800; border: 1px solid rgba(245, 168, 0, 0.25); }
    .unit-icon-box.academy { background: rgba(16, 185, 129, 0.12); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.25); }
    .unit-icon-box.capital { background: rgba(147, 51, 234, 0.12); color: #a855f7; border: 1px solid rgba(147, 51, 234, 0.25); }

    .unit-name-wrap h3 {
      font-family: var(--font-heading);
      font-size: 1.05rem;
      font-weight: 700;
      color: var(--text-main);
      line-height: 1.2;
    }
    .unit-tag {
      font-size: 0.7rem;
      font-weight: 600;
      color: var(--text-dim);
    }
    .unit-card p {
      font-size: 0.835rem;
      color: var(--text-muted);
      line-height: 1.5;
    }

    /* RESPONSIVIDADE */
    @media (max-width: 1024px) {
      .admin-login-layout {
        grid-template-columns: 1fr;
      }
      .auth-col {
        border-right: none;
        border-bottom: 1px solid var(--border-subtle);
        padding: 2.5rem 1.75rem;
      }
      .showcase-col {
        padding: 3rem 1.75rem;
      }
      .units-grid {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>

  <div class="admin-login-layout">
    
    <!-- ========================================== -->
    <!-- COLUNA ESQUERDA: AUTENTICA\xC7\xC3O ADMINISTRATIVA -->
    <!-- ========================================== -->
    <aside class="auth-col">
      <div>
        <!-- Barra Superior: Voltar ao Site & Alternador de Tema -->
        <div class="auth-header-bar">
          <a href="/" class="back-link" title="Voltar \xE0 p\xE1gina inicial">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            <span>Voltar ao site</span>
          </a>

          <button type="button" class="theme-toggle-btn" onclick="toggleRachiTheme()" aria-label="Alternar Tema Claro/Escuro" title="Alternar tema">
            <svg class="icon-sun" width="16" height="16" fill="none" stroke="#f5a800" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
            <svg class="icon-moon" width="16" height="16" fill="none" stroke="#0050f0" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
            <span id="theme-toggle-label">Modo Claro</span>
          </button>
        </div>

        <!-- Marca -->
        <div class="brand-wrap">
          <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-dark.png'" alt="RACHI" class="brand-logo-img logo-for-light">
          <img src="/images/logo-rachi-light.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'" alt="RACHI" class="brand-logo-img logo-for-dark">
        </div>

        <h1 class="auth-title">Painel Administrativo</h1>
        <p class="auth-desc">Introduza as suas credenciais para aceder ao sistema corporativo.</p>

        <!-- FORMUL\xC1RIO DE LOGIN -->
        <form id="admin-login-form" method="POST" action="/login" onsubmit="handleAdminLogin(event)">
          <div class="form-group">
            <label for="login-email" class="form-label">E-mail</label>
            <div class="input-wrap">
              <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
              <input type="email" id="login-email" name="email" class="form-control" required autocomplete="username" placeholder="admin@rachi.ao" autofocus>
            </div>
          </div>

          <div class="form-group">
            <label for="login-password" class="form-label">Palavra-passe</label>
            <div class="input-wrap">
              <svg class="input-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
              <input type="password" id="login-password" name="password" class="form-control" required autocomplete="current-password" placeholder="Palavra-passe">
              <button type="button" class="toggle-pass-btn" onclick="togglePassVisibility('login-password', this)" aria-label="Mostrar ou ocultar palavra-passe">
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
              </button>
            </div>
          </div>

          <div class="form-extras">
            <label class="remember-wrap">
              <input type="checkbox" name="remember" checked>
              <span>Manter conectado</span>
            </label>
            <a href="#" class="forgot-link" onclick="handleForgotPassword(event)">Recuperar acesso</a>
          </div>

          <button type="submit" id="btn-login-submit" class="btn-submit">
            <span class="spinner" id="login-spinner"></span>
            <span class="btn-text">Entrar</span>
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
          </button>

          <div id="login-feedback" class="feedback-msg" role="alert"></div>
        </form>
      </div>

      <!-- Rodap\xE9 da Barra Esquerda -->
      <footer class="auth-footer">
        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
        <span>Sess\xE3o Encriptada TLS 1.3 &bull; Cloudflare Hyperdrive</span>
      </footer>
    </aside>

    <!-- ======================================================== -->
    <!-- COLUNA DIREITA: INFORMA\xC7\xD5ES DO PROJETO RACHI             -->
    <!-- ======================================================== -->
    <main class="showcase-col">
      <div>
        <!-- Cabe\xE7alho do Showcase -->
        <header class="showcase-header">
          <h2 class="showcase-heading">
            Tecnologia, Ind\xFAstria Gr\xE1fica, Forma\xE7\xE3o e <span>Capital Humano</span>
          </h2>
          <p class="showcase-lead">
            A <strong>RACHI \u2014 Solu\xE7\xF5es Inteligentes Lda.</strong> \xE9 uma estrutura empresarial angolana focada em inova\xE7\xE3o, efici\xEAncia operacional e capacita\xE7\xE3o de alto n\xEDvel, integrando quatro unidades de excel\xEAncia para transformar organiza\xE7\xF5es.
          </p>
        </header>

        <!-- As 4 Unidades de Neg\xF3cio -->
        <div class="units-section-title">
          <span>Unidades de Neg\xF3cio do Projeto RACHI</span>
        </div>

        <div class="units-grid">
          <!-- UNIDADE 1: TEC -->
          <article class="unit-card">
            <div>
              <div class="unit-card-header">
                <div class="unit-icon-box tec">\u{1F4BB}</div>
                <div class="unit-name-wrap">
                  <h3>RACHI TEC</h3>
                  <span class="unit-tag">Tecnologia & Infraestrutura</span>
                </div>
              </div>
              <p>Solu\xE7\xF5es completas de TI: desenvolvimento de software, infraestruturas cloud de alta disponibilidade, ciberseguran\xE7a, redes estruturadas e suporte corporativo gerido.</p>
            </div>
          </article>

          <!-- UNIDADE 2: PRINT -->
          <article class="unit-card">
            <div>
              <div class="unit-card-header">
                <div class="unit-icon-box print">\u{1F5A8}\uFE0F</div>
                <div class="unit-name-wrap">
                  <h3>RACHI PRINT</h3>
                  <span class="unit-tag">Ind\xFAstria Gr\xE1fica & Merchandising</span>
                </div>
              </div>
              <p>Comunica\xE7\xE3o visual e produ\xE7\xE3o gr\xE1fica profissional: impress\xE3o digital e offset de alta precis\xE3o, grandes formatos, sinal\xE9tica, brindes personalizados e branding corporativo.</p>
            </div>
          </article>

          <!-- UNIDADE 3: ACADEMY -->
          <article class="unit-card">
            <div>
              <div class="unit-card-header">
                <div class="unit-icon-box academy">\u{1F393}</div>
                <div class="unit-name-wrap">
                  <h3>RACHI ACADEMY</h3>
                  <span class="unit-tag">Forma\xE7\xE3o Profissional & LMS</span>
                </div>
              </div>
              <p>Centro de excel\xEAncia em capacita\xE7\xE3o executiva e tecnol\xF3gica: cursos avan\xE7ados, plataforma LMS interativa, emiss\xE3o de certificados e programas in-company sob medida.</p>
            </div>
          </article>

          <!-- UNIDADE 4: HUMAN CAPITAL -->
          <article class="unit-card">
            <div>
              <div class="unit-card-header">
                <div class="unit-icon-box capital">\u{1F465}</div>
                <div class="unit-name-wrap">
                  <h3>RACHI HUMAN CAPITAL</h3>
                  <span class="unit-tag">Gest\xE3o Estrat\xE9gica de Talentos</span>
                </div>
              </div>
              <p>Recrutamento executivo especializado, outsourcing de especialistas em tecnologia, avalia\xE7\xE3o de compet\xEAncias e consultoria de recursos humanos para empresas.</p>
            </div>
          </article>
        </div>
      </div>
    </main>

  </div>

  <!-- Scripts de Interatividade e Autentica\xE7\xE3o -->
  <script>
    (function updateThemeButtonLabel() {
      var isDark = document.documentElement.classList.contains('dark');
      var label = document.getElementById('theme-toggle-label');
      if (label) label.textContent = isDark ? 'Modo Claro' : 'Modo Escuro';
    })();

    function togglePassVisibility(inputId, btn) {
      var input = document.getElementById(inputId);
      if (!input) return;
      var isPass = input.type === 'password';
      input.type = isPass ? 'text' : 'password';
      btn.setAttribute('aria-label', isPass ? 'Ocultar palavra-passe' : 'Mostrar palavra-passe');
      btn.innerHTML = isPass 
        ? '<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l18 18"/></svg>'
        : '<svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>';
    }

    function handleForgotPassword(e) {
      e.preventDefault();
      if (window.RachiToast) {
        RachiToast.info('Para redefini\xE7\xE3o de palavra-passe corporativa, contacte a equipa de TI: it@rachi.co.ao');
      } else {
        alert('Para redefini\xE7\xE3o de palavra-passe corporativa, contacte a equipa de TI: it@rachi.co.ao');
      }
    }

    async function handleAdminLogin(e) {
      e.preventDefault();
      var btn = document.getElementById('btn-login-submit');
      var btnText = btn.querySelector('.btn-text');
      var spinner = document.getElementById('login-spinner');
      var feedback = document.getElementById('login-feedback');
      
      var email = document.getElementById('login-email').value.trim();
      var password = document.getElementById('login-password').value;

      if (!email || !password) {
        if (window.RachiToast) RachiToast.error('Por favor, informe o e-mail e a palavra-passe.');
        return;
      }

      btn.disabled = true;
      btnText.textContent = 'A autenticar...';
      spinner.style.display = 'inline-block';
      feedback.style.display = 'none';
      feedback.textContent = '';

      try {
        var response = await fetch('/login', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
          },
          body: JSON.stringify({ email: email, password: password }),
          credentials: 'same-origin'
        });

        var data = await response.json().catch(function() {
          return { success: false, message: 'Resposta inv\xE1lida do servidor.' };
        });

        if (!response.ok || !data.success) {
          var msg = data.message || 'Credenciais incorretas ou utilizador inativo.';
          if (window.RachiToast) RachiToast.error(msg);
          feedback.className = 'feedback-msg error';
          feedback.textContent = msg;
          feedback.style.display = 'block';
          return;
        }

        if (window.RachiToast) RachiToast.success('Autentica\xE7\xE3o bem-sucedida! A redirecionar...');
        
        if (window.RachiSession) {
          try { await window.RachiSession.session(); } catch(err) {}
        }

        var role = data.user ? data.user.role_slug : null;
        var isAdmin = ['admin', 'super_admin'].indexOf(role) !== -1;
        var urlParams = new URLSearchParams(window.location.search);
        var redirectParam = urlParams.get('redirect');

        setTimeout(function() {
          if (redirectParam) {
            window.location.href = redirectParam;
          } else if (isAdmin) {
            window.location.href = '/admin-dashboard';
          } else if (data.redirect) {
            window.location.href = data.redirect;
          } else {
            window.location.href = '/portal';
          }
        }, 350);

      } catch (err) {
        var msg = err.message || 'Falha na liga\xE7\xE3o com o servidor.';
        if (window.RachiToast) RachiToast.error(msg);
        feedback.className = 'feedback-msg error';
        feedback.textContent = msg;
        feedback.style.display = 'block';
      } finally {
        btn.disabled = false;
        btnText.textContent = 'Entrar';
        spinner.style.display = 'none';
      }
    }
  <\/script>
</body>
</html>`;
}
__name(loginPage, "loginPage");
function portalPage() {
  return shell("Portal", `<div class="portal"><aside><p class="eyebrow">\xC1REA RESERVADA</p><h2 id="user-name">Minha conta</h2><nav id="portal-nav"><button data-tab="requests">Solicita\xE7\xF5es</button><button data-tab="orders">Pedidos</button><button data-tab="quotes">Or\xE7amentos</button><button data-tab="courses">Meus cursos</button><button data-tab="password">Palavra-passe</button></nav><form data-api="/logout" data-redirect="/"><button class="secondary">Sair</button></form></aside><section><p class="eyebrow">RACHI / PORTAL</p><h1 id="section-title">Solicita\xE7\xF5es</h1><div id="portal-content" aria-live="polite">Carregando\u2026</div></section></div>`);
}
__name(portalPage, "portalPage");
function catalogPage(kind, slug = "") {
  return shell(kind === "courses" ? "Academy" : "Loja", `<p class="eyebrow">${kind === "courses" ? "RACHI ACADEMY" : "RACHI STORE"}</p><h1>${kind === "courses" ? "Aprenda. Cres\xE7a. Transforme." : "Tecnologia para o seu dia a dia"}</h1><div id="catalog" data-kind="${kind}" data-slug="${slug.replace(/[^a-zA-Z0-9_-]/g, "")}">Carregando\u2026</div>`);
}
__name(catalogPage, "catalogPage");
function cartPage() {
  return shell("Carrinho", `<p class="eyebrow">RACHI STORE</p><h1>Seu carrinho</h1><div id="cart">Carregando\u2026</div>`);
}
__name(cartPage, "cartPage");


export { loginPage, portalPage, catalogPage, cartPage, renderCourseShow };
