<!DOCTYPE html>
<html lang="pt-AO" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu Dashboard | RACHI Academy — Portal do Aluno</title>
    <meta name="description" content="Dashboard do Aluno RACHI Academy: continue seus estudos, acompanhe formações, ganhe XP e emita seus certificados.">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-dark.png">
    
        <!-- Script de Inicialização Imediata do Tema (Anti-Flash Dark Mode) -->
    <script>
        (function() {
            var theme = localStorage.getItem('rachi_theme');
            if (theme === 'dark' || (!theme && window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
                document.documentElement.setAttribute('data-theme', 'dark');
                document.documentElement.setAttribute('data-bs-theme', 'dark');
            } else {
                document.documentElement.classList.remove('dark');
                document.documentElement.setAttribute('data-theme', 'light');
                document.documentElement.setAttribute('data-bs-theme', 'light');
            }
        })();

        window.toggleRachiTheme = function() {
            var isDark = document.documentElement.classList.toggle('dark');
            var theme = isDark ? 'dark' : 'light';
            document.documentElement.setAttribute('data-theme', theme);
            document.documentElement.setAttribute('data-bs-theme', theme);
            localStorage.setItem('rachi_theme', theme);
            window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
            return isDark;
        };

        window.addEventListener('storage', function(e) {
            if (e.key === 'rachi_theme') {
                var isDark = e.newValue === 'dark';
                if (isDark) {
                    document.documentElement.classList.add('dark');
                    document.documentElement.setAttribute('data-theme', 'dark');
                    document.documentElement.setAttribute('data-bs-theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    document.documentElement.setAttribute('data-theme', 'light');
                    document.documentElement.setAttribute('data-bs-theme', 'light');
                }
                window.dispatchEvent(new CustomEvent('rachi-theme-changed', { detail: { dark: isDark } }));
            }
        });
    </script>

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        heading: ['"Outfit"', '"Inter"', 'sans-serif'],
                    },
                    colors: {
                        rachiNavy: '#071326',
                        rachiDark: '#0b1c3d',
                        rachiCardNavy: '#0f274a',
                        rachiGold: '#f5a800',
                        rachiGoldHover: '#d99400',
                        rachiCyan: '#00a3e0',
                        rachiBlue: '#0050f0',
                        aluraBg: '#f8fafc',
                        aluraCard: '#ffffff',
                        aluraBorder: '#e2e8f0',
                        aluraBlue: '#0050f0',
                        aluraCyan: '#00a3e0',
                        aluraAccent: '#0284c7',
                        aluraGold: '#f5a800',
                        aluraGreen: '#10b981',
                        aluraPurple: '#8b5cf6',
                    },
                    boxShadow: {
                        'rachi-card': '0 4px 25px -3px rgba(7, 19, 38, 0.06), 0 2px 8px -2px rgba(7, 19, 38, 0.03)',
                        'rachi-glow': '0 0 30px -5px rgba(245, 168, 0, 0.25)',
                        'alura-card': '0 4px 20px -2px rgba(15, 23, 42, 0.05), 0 2px 6px -1px rgba(15, 23, 42, 0.02)',
                        'alura-glow': '0 0 25px -5px rgba(0, 80, 240, 0.25)',
                        'alura-cyan-glow': '0 0 20px -5px rgba(0, 163, 224, 0.2)',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body {
            background-color: #f8fafc;
            color: #071326;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        html.dark body {
            background-color: #060a12;
            color: #f1f5f9;
        }
        
        /* Custom scrollbar para tema RACHI */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        html.dark ::-webkit-scrollbar-track {
            background: #090e1a;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        html.dark ::-webkit-scrollbar-thumb {
            background: #1e293b;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
        html.dark ::-webkit-scrollbar-thumb:hover {
            background: #334155;
        }

        /* Glassmorphic utilities RACHI */
        .glass-panel {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.04), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
            transition: background-color 0.2s ease, border-color 0.2s ease, box-shadow 0.2s ease;
        }
        html.dark .glass-panel {
            background: #0c1220;
            border-color: rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 25px -3px rgba(0, 0, 0, 0.5), 0 2px 8px -2px rgba(0, 0, 0, 0.3);
        }
        .glass-header {
            background: #071326;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 4px 20px -2px rgba(7, 19, 38, 0.35);
        }

        /* Print styles for Certificate */
        @media print {
            body * {
                visibility: hidden;
            }
            #printable-certificate, #printable-certificate * {
                visibility: visible;
            }
            #printable-certificate {
                position: fixed;
                left: 0;
                top: 0;
                width: 100vw;
                height: 100vh;
                background: white !important;
                color: black !important;
                z-index: 999999;
                margin: 0;
                padding: 2cm;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body x-data="alunoDashboardApp()" x-init="initApp()" class="min-h-screen flex flex-col antialiased bg-slate-50 dark:bg-[#060a12] text-slate-900 dark:text-slate-100 selection:bg-[#f5a800]/20 selection:text-[#071326] transition-colors duration-200">

    <!-- TOAST NOTIFICATION -->
    <div x-show="toast.visible" 
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:translate-x-4"
         x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         x-cloak
         class="fixed bottom-5 right-5 z-50 max-w-md w-full bg-white dark:bg-[#0c1220] border border-emerald-500/40 dark:border-emerald-500/50 rounded-2xl p-4 shadow-2xl flex items-start gap-3">
        <div class="w-9 h-9 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 border border-emerald-200">
            <i data-lucide="check-circle" class="w-5 h-5"></i>
        </div>
        <div class="flex-1">
            <h4 class="text-sm font-bold text-slate-900 dark:text-white" x-text="toast.title"></h4>
            <p class="text-xs text-slate-600 dark:text-slate-300 mt-0.5" x-text="toast.message"></p>
        </div>
        <button @click="toast.visible = false" class="text-slate-400 hover:text-slate-600 text-xs font-bold">✕</button>
    </div>



    <!-- ================================================================ -->
    <!-- TOP NAVIGATION HEADER (TEMA EXECUTIVO RACHI - AMPLO COMPRIMENTO) -->
    <!-- ================================================================ -->
    <!-- TOP NAVIGATION HEADER (TEMA EXECUTIVO RACHI - ESPAÇAMENTO COESO) -->
    <!-- ================================================================ -->
    <header class="sticky top-0 z-40 w-full bg-white/95 dark:bg-[#071326] text-slate-900 dark:text-white border-b border-slate-200/90 dark:border-white/10 shadow-[0_4px_25px_rgba(15,23,42,0.06)] dark:shadow-xl dark:shadow-slate-950/40 backdrop-blur-md transition-colors duration-200 relative">
        <!-- Linha de Destaque Superior Corporativo RACHI -->
        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#f5a800] to-[#00a3e0] dark:from-[#071326] dark:via-[#f5a800] dark:to-[#071326]"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-[70px] py-1.5 gap-3 sm:gap-4">
                
                <!-- Bloco Esquerdo: Logo & Nav Links Integrados -->
                <div class="flex items-center gap-6 lg:gap-8 shrink-0">
                    <a href="/" class="flex items-center gap-3 group cursor-pointer" title="Ir para a página inicial da RACHI">
                        <!-- Logo Light Mode (Escuro) -->
                        <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi.png'" alt="RACHI Academy" class="h-8 sm:h-9 w-auto object-contain block dark:hidden transition duration-200 group-hover:scale-105">
                        <!-- Logo Dark Mode (Branco) -->
                        <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'" alt="RACHI Academy" class="h-8 sm:h-9 w-auto object-contain hidden dark:block transition duration-200 group-hover:scale-105">
                        <div class="hidden sm:flex flex-col">
                            <span class="text-xs font-black uppercase tracking-widest text-slate-900 dark:text-white flex items-center gap-2 font-heading">
                                ACADEMY <span class="text-[10px] px-2.5 py-0.5 rounded-full bg-blue-50 text-[#0050f0] border border-blue-200 dark:bg-[#f5a800]/20 dark:text-[#f5a800] dark:border-[#f5a800]/40 font-bold shadow-xs">PORTAL DO ALUNO</span>
                            </span>
                        </div>
                    </a>

                    <!-- Desktop Nav Links (Próximos ao Logo) -->
                    <nav class="hidden lg:flex items-center gap-1.5 text-sm font-medium">
                        <button @click="activeMainTab = 'dashboard'" 
                                :class="activeMainTab === 'dashboard' ? 'bg-slate-900 text-white dark:bg-white/10 dark:text-white font-bold shadow-sm' : 'text-slate-600 hover:text-slate-950 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-white/5 font-medium border border-transparent'"
                                class="px-3.5 py-2 rounded-xl transition flex items-center gap-2 cursor-pointer text-xs sm:text-sm">
                            <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#f5a800]"></i>
                            <span>Dashboard</span>
                        </button>
                        <button @click="activeMainTab = 'formacoes'" 
                                :class="activeMainTab === 'formacoes' ? 'bg-slate-900 text-white dark:bg-white/10 dark:text-white font-bold shadow-sm' : 'text-slate-600 hover:text-slate-950 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-white/5 font-medium border border-transparent'"
                                class="px-3.5 py-2 rounded-xl transition flex items-center gap-2 cursor-pointer text-xs sm:text-sm">
                            <i data-lucide="compass" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Formações</span>
                        </button>
                        <button @click="activeMainTab = 'cursos'" 
                                :class="activeMainTab === 'cursos' ? 'bg-slate-900 text-white dark:bg-white/10 dark:text-white font-bold shadow-sm' : 'text-slate-600 hover:text-slate-950 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-white/5 font-medium border border-transparent'"
                                class="px-3.5 py-2 rounded-xl transition flex items-center gap-2 cursor-pointer text-xs sm:text-sm">
                            <i data-lucide="book-open" class="w-4 h-4 text-sky-500 dark:text-sky-400"></i>
                            <span>Meus Cursos</span>
                        </button>
                        <button @click="activeMainTab = 'certificados'" 
                                :class="activeMainTab === 'certificados' ? 'bg-slate-900 text-white dark:bg-white/10 dark:text-white font-bold shadow-sm' : 'text-slate-600 hover:text-slate-950 hover:bg-slate-100 dark:text-slate-300 dark:hover:text-white dark:hover:bg-white/5 font-medium border border-transparent'"
                                class="px-3.5 py-2 rounded-xl transition flex items-center gap-2 cursor-pointer text-xs sm:text-sm">
                            <i data-lucide="award" class="w-4 h-4 text-[#f5a800]"></i>
                            <span>Certificados</span>
                        </button>
                    </nav>
                </div>

                <!-- Bloco Direito: Busca, Notificações e Perfil (Coesos e Próximos) -->
                <div class="flex items-center gap-3 sm:gap-4 shrink-0">
                    <!-- Search Bar Compacta -->
                    <div class="hidden md:flex items-center w-56 lg:w-64 xl:w-72 relative" @click.away="searchOpen = false">
                        <div class="relative w-full">
                            <i data-lucide="search" class="w-3.5 h-3.5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                            <input type="text" 
                                   x-model="searchQuery" 
                                   @focus="searchOpen = true"
                                   @input="searchOpen = true"
                                   placeholder="O que quer aprender?" 
                                   class="w-full bg-slate-100 dark:bg-[#080e1a] border border-slate-200 dark:border-white/15 focus:bg-white dark:focus:bg-slate-900 focus:border-[#0050f0] dark:focus:border-[#f5a800] text-xs text-slate-900 dark:text-white rounded-full pl-8 pr-7 py-2 outline-none transition placeholder-slate-400 focus:ring-2 focus:ring-blue-500/20 dark:focus:ring-amber-500/20 shadow-xs">
                            <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px] bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 px-1.5 py-0.5 rounded font-mono border border-slate-300 dark:border-slate-700">/</span>
                        </div>

                        <!-- Search Suggestions Dropdown -->
                        <div x-show="searchOpen && (searchQuery.trim().length > 0)" 
                             x-cloak 
                             class="absolute top-full left-0 right-0 mt-2 bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/15 rounded-2xl shadow-2xl p-2 z-50 overflow-hidden text-slate-900 dark:text-white">
                            <div class="text-[10px] uppercase font-bold text-slate-400 px-3 py-1.5 tracking-wider">Resultados nos Cursos</div>
                            <template x-for="item in filteredSearchResults" :key="item.id">
                                <button @click="openCourseFromSearch(item)" 
                                        class="w-full text-left px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-white/10 transition flex items-center justify-between text-xs group cursor-pointer text-slate-700 dark:text-slate-200">
                                    <span class="font-medium group-hover:text-[#0050f0] dark:group-hover:text-[#f5a800]" x-text="item.nome"></span>
                                    <span class="text-[10px] text-slate-600 dark:text-slate-300 px-2 py-0.5 rounded bg-slate-100 dark:bg-white/10 border border-slate-200 dark:border-white/10" x-text="item.categoria"></span>
                                </button>
                            </template>
                            <div x-show="filteredSearchResults.length === 0" class="text-xs text-slate-400 px-3 py-2">
                                Nenhum curso correspondente encontrado.
                            </div>
                        </div>
                    </div>

                    <!-- Divisor Sutil -->
                    <div class="hidden md:block h-6 w-px bg-slate-200 dark:bg-slate-800"></div>

                    <!-- Botão de Alternância de Tema (Modo Claro / Escuro) -->
                    <button type="button" 
                            onclick="window.toggleRachiTheme()" 
                            aria-label="Alternar Modo Claro / Escuro" 
                            title="Alternar Modo Claro / Escuro"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-slate-100 hover:bg-slate-200/80 dark:bg-white/10 dark:hover:bg-white/20 border border-slate-200/90 dark:border-white/15 text-slate-700 hover:text-slate-950 dark:text-slate-200 dark:hover:text-amber-400 flex items-center justify-center transition-all duration-200 cursor-pointer shadow-xs group">
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

                    <!-- Notification Bell -->
                    <button @click="toastMessage('Nenhuma notificação nova no momento', 'Avisos')" 
                            class="relative p-2 rounded-xl bg-slate-100 hover:bg-slate-200/80 dark:bg-white/10 dark:hover:bg-white/20 border border-slate-200/90 dark:border-white/15 text-slate-700 hover:text-slate-950 dark:text-slate-300 dark:hover:text-white transition cursor-pointer shadow-xs">
                        <i data-lucide="bell" class="w-4 h-4"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-[#f5a800] ring-2 ring-white dark:ring-[#071326]"></span>
                    </button>

                    <!-- User Profile Dropdown -->
                    <div class="relative" @click.away="profileMenuOpen = false">
                        <button @click="profileMenuOpen = !profileMenuOpen" 
                                class="flex items-center gap-2.5 p-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 border border-transparent hover:border-slate-200 dark:hover:border-slate-700 transition cursor-pointer">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-tr from-[#f5a800] via-[#00a3e0] to-[#0050f0] text-[#071326] font-black text-xs flex items-center justify-center ring-2 ring-blue-500/20 dark:ring-white/20 shadow-md">
                                <span x-text="getInitials(currentUser.nome)"></span>
                            </div>
                            <div class="hidden md:flex flex-col text-left">
                                <span class="text-xs font-bold text-slate-900 dark:text-white leading-tight" x-text="currentUser.nome ? currentUser.nome.split(' ')[0] : 'Aluno'"></span>
                                <span class="text-[10px] text-[#0050f0] dark:text-[#f5a800] font-semibold leading-tight">Aluno</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 hidden sm:block"></i>
                        </button>

                        <!-- Menu Modal -->
                        <div x-show="profileMenuOpen" 
                             x-cloak 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-64 bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/15 rounded-2xl shadow-2xl p-3 z-50 text-slate-900 dark:text-white">
                            
                            <!-- Header do perfil -->
                            <div class="px-3 py-2 border-b border-slate-100 dark:border-slate-800 mb-2">
                                <p class="text-xs font-bold text-slate-900 dark:text-white truncate" x-text="currentUser.nome"></p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate" x-text="currentUser.email"></p>
                                <div class="mt-1.5 flex items-center justify-between text-[10px]">
                                    <span class="text-[#0050f0] dark:text-[#f5a800] font-mono font-bold" x-text="'ID #' + (currentUser.aluno_id || currentUser.id)"></span>
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30 font-bold">Conta Ativa</span>
                                </div>
                            </div>

                            <!-- Atalhos -->
                            <div class="space-y-1 text-xs">
                                <button @click="activeMainTab = 'certificados'; profileMenuOpen = false" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/10 transition text-left cursor-pointer">
                                    <i data-lucide="award" class="w-4 h-4 text-[#f5a800]"></i>
                                    Meus Certificados
                                </button>
                                <button @click="accessLogsModal = true; profileMenuOpen = false" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/10 transition text-left cursor-pointer">
                                    <i data-lucide="shield-check" class="w-4 h-4 text-[#00a3e0]"></i>
                                    Histórico de Acessos
                                </button>
                                <a href="/academy" 
                                   class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/10 transition text-left">
                                    <i data-lucide="globe" class="w-4 h-4 text-[#0050f0] dark:text-sky-400"></i>
                                    Portal Academy RACHI
                                </a>
                                <a href="/" 
                                   class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white hover:bg-slate-100 dark:hover:bg-white/10 transition text-left">
                                    <i data-lucide="home" class="w-4 h-4 text-slate-400"></i>
                                    Página Inicial (Portal Geral)
                                </a>
                            </div>

                            <!-- Logout -->
                            <div class="mt-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                                <button @click="logout()" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition text-xs font-semibold text-left cursor-pointer">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    Sair da Minha Conta
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden p-2 text-slate-300 hover:text-white cursor-pointer">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                </div>

            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" x-cloak class="lg:hidden bg-white dark:bg-[#050914] border-b border-slate-200 dark:border-white/10 px-4 py-3 space-y-2 text-slate-900 dark:text-white shadow-xl">
            <button @click="activeMainTab = 'dashboard'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10">Dashboard</button>
            <button @click="activeMainTab = 'formacoes'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10">Formações</button>
            <button @click="activeMainTab = 'cursos'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10">Meus Cursos</button>
            <button @click="activeMainTab = 'certificados'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10">Certificados</button>
        </div>
    </header>

    <!-- ================================================================ -->
    <!-- MAIN CONTENT CONTAINER                                           -->
    <!-- ================================================================ -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-7 space-y-6 sm:space-y-7">

        <!-- ============================================================ -->
        <!-- VIEW: DASHBOARD (TEMA CLARO ELEGANTE)                        -->
        <!-- ============================================================ -->
        <div x-show="activeMainTab === 'dashboard'" class="space-y-6 sm:space-y-7">
            
            <!-- 1. HERO: Boas-vindas Executivo RACHI Academy + Estatísticas de Estudo -->
            <section class="rounded-3xl p-5 sm:p-7 lg:p-8 relative overflow-hidden bg-gradient-to-br from-white via-slate-50/90 to-blue-50/40 dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-slate-900 dark:text-white shadow-[0_8px_30px_rgba(0,80,240,0.06)] dark:shadow-xl dark:shadow-slate-900/40 border border-slate-200/90 dark:border-white/10 transition-colors">
                <!-- Luzes ambientes corporativas RACHI -->
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-blue-500/10 dark:bg-[#0050f0]/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-amber-500/10 dark:bg-[#f5a800]/15 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5 mb-3">
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-amber-50 dark:bg-[#f5a800]/20 text-amber-800 dark:text-[#f5a800] border border-amber-200 dark:border-[#f5a800]/40 flex items-center gap-1.5 shadow-xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 dark:bg-[#f5a800] animate-pulse"></span>
                                RITMO DE ESTUDOS ATIVO
                            </span>
                            <span class="text-xs text-slate-600 dark:text-slate-300 font-medium">Nível 4 • Especialista Corporativo</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-black text-slate-950 dark:text-white tracking-tight">
                            Olá, <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0050f0] via-[#00a3e0] to-[#f5a800] dark:from-white dark:via-amber-200 dark:to-[#f5a800]" x-text="currentUser.nome ? currentUser.nome.split(' ')[0] : 'Aluno'"></span>! Bom retorno aos seus estudos.
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-2 max-w-2xl leading-relaxed">
                            Continue avançando para concluir sua formação corporativa e emitir seus certificados oficiais reconhecidos pelo Grupo RACHI.
                        </p>
                    </div>

                    <!-- Botão de Ação Rápida -->
                    <div class="flex items-center gap-3 shrink-0">
                        <button @click="openClassroom(enrolledCourses[0])" 
                                class="px-6 py-3.5 rounded-xl bg-[#0050f0] hover:bg-[#0042c7] text-white dark:bg-[#f5a800] dark:hover:bg-[#d99400] dark:text-[#071326] font-extrabold text-xs tracking-wider uppercase shadow-xl shadow-blue-500/20 dark:shadow-amber-500/20 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2.5 cursor-pointer">
                            <i data-lucide="play" class="w-4 h-4 fill-white dark:fill-[#071326]"></i>
                            <span>Continuar Aula Atual</span>
                        </button>
                    </div>
                </div>

                <!-- GRID DE MÉTRICAS RÁPIDAS (MODO CLARO REFINADO / ESCURO CORPORATIVO) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 sm:gap-4 mt-5 pt-5 border-t border-slate-200/80 dark:border-white/10">

                    <!-- Stat 1: Cursos Matriculados -->
                    <div class="bg-white/90 dark:bg-white/5 border border-slate-200/90 dark:border-white/10 rounded-2xl p-4.5 flex items-center gap-3.5 hover:bg-white dark:hover:bg-white/10 hover:border-[#0050f0]/40 transition shadow-xs group">
                        <div class="w-12 h-12 rounded-xl bg-blue-50 dark:bg-blue-500/20 text-[#0050f0] dark:text-[#00a3e0] border border-blue-200 dark:border-blue-500/30 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <i data-lucide="book-open" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black font-heading text-slate-950 dark:text-white" x-text="enrolledCourses.length + ' cursos'"></div>
                            <div class="text-[11px] text-slate-500 dark:text-slate-300 font-medium">Matriculados ativos</div>
                        </div>
                    </div>

                    <!-- Stat 2: Horas Estudadas -->
                    <div class="bg-white/90 dark:bg-white/5 border border-slate-200/90 dark:border-white/10 rounded-2xl p-4.5 flex items-center gap-3.5 hover:bg-white dark:hover:bg-white/10 hover:border-emerald-400/40 transition shadow-xs group">
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-500/30 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black font-heading text-slate-950 dark:text-white" x-text="studentStats.totalHours + 'h'"></div>
                            <div class="text-[11px] text-slate-500 dark:text-slate-300 font-medium">Tempo dedicado</div>
                        </div>
                    </div>

                    <!-- Stat 3: Certificados Conquistados -->
                    <div class="bg-white/90 dark:bg-white/5 border border-slate-200/90 dark:border-white/10 rounded-2xl p-4.5 flex items-center gap-3.5 hover:bg-white dark:hover:bg-white/10 hover:border-amber-400/40 transition shadow-xs group">
                        <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-500/20 text-[#f5a800] border border-amber-200 dark:border-amber-500/30 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <i data-lucide="award" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black font-heading text-slate-950 dark:text-white" x-text="getCompletedCoursesCount() + ' emitidos'"></div>
                            <div class="text-[11px] text-slate-500 dark:text-slate-300 font-medium">Certificados oficiais</div>
                        </div>
                    </div>

                </div>

                <!-- HABIT TRACKER: Atividade Semanal (Seg a Dom) -->
                <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs bg-white/80 dark:bg-white/5 p-3.5 sm:p-4 rounded-2xl border border-slate-200/80 dark:border-white/10 shadow-xs">
                    <div class="flex items-center gap-2 text-slate-700 dark:text-slate-200">
                        <i data-lucide="calendar" class="w-4 h-4 text-[#f5a800]"></i>
                        <span class="font-medium">Frequência Semanal:</span>
                        <span class="text-amber-800 dark:text-[#f5a800] font-bold bg-amber-50 dark:bg-amber-500/20 border border-amber-200 dark:border-amber-500/30 px-2 py-0.5 rounded-full">5 de 7 dias concluídos</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <template x-for="day in weekHabit" :key="day.name">
                            <div class="flex flex-col items-center gap-1">
                                <div :class="day.done ? 'bg-[#f5a800] text-slate-950 font-black shadow-xs' : 'bg-slate-100 dark:bg-white/10 text-slate-400 dark:text-slate-400 border border-slate-200 dark:border-white/10'"
                                     class="w-6 h-6 rounded-md flex items-center justify-center text-[10px] transition">
                                    <span x-show="day.done">✓</span>
                                    <span x-show="!day.done" x-text="day.short"></span>
                                </div>
                                <span class="text-[9px] text-slate-500 dark:text-slate-400 font-semibold" x-text="day.short"></span>
                            </div>
                        </template>
                    </div>
                </div>

            </section>

            <!-- 2. CARD "CONTINUE DE ONDE VOCÊ PAROU" -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <div class="w-2.5 h-2.5 rounded-full bg-[#f5a800] animate-ping"></div>
                        <h2 class="text-lg sm:text-xl font-heading font-black text-slate-900 dark:text-white">Continue de onde você parou</h2>
                    </div>
                    <span class="text-xs text-slate-500 dark:text-slate-400 font-medium">Último acesso: Hoje às 18:10</span>
                </div>

                <!-- Card Heroico de Retomada de Estudo -->
                <div class="bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10 rounded-2xl sm:rounded-3xl p-5 sm:p-6 shadow-sm dark:shadow-xl hover:border-[#f5a800]/50 transition duration-300 relative overflow-hidden group">
                    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl group-hover:bg-amber-500/10 transition"></div>
                    <!-- Linha decorativa superior corporativa -->
                    <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#071326] via-[#f5a800] to-[#071326]"></div>

                    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                        
                        <div class="flex items-start gap-4 sm:gap-5 flex-1">
                            <!-- Ícone / Thumbnail Corporativo RACHI -->
                            <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl bg-gradient-to-br from-[#071326] to-[#0f274a] text-[#f5a800] border border-[#f5a800]/30 flex items-center justify-center text-2xl sm:text-3xl shrink-0 shadow-lg shadow-slate-900/10">
                                🛡️
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2 mb-1.5">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-[#0050f0] dark:text-[#00a3e0] border border-blue-200 dark:border-blue-500/20">
                                        FORMAÇÃO CIBERSEGURANÇA RACHI
                                    </span>
                                    <span class="text-xs text-slate-500 dark:text-slate-400 font-medium">Módulo 3 • Resposta a Incidentes</span>
                                </div>

                                <h3 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900 dark:text-white truncate" x-text="enrolledCourses[0]?.nome"></h3>
                                
                                <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1 flex items-center gap-2">
                                    <span class="text-[#f5a800] font-black">Aula 7:</span> 
                                    Simulação de Ataques e Exercício Red Team (45 min)
                                </p>

                                <!-- Barra de Progresso do Curso -->
                                <div class="mt-4 max-w-md">
                                    <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 mb-1.5 font-medium">
                                        <span>Progresso geral do curso</span>
                                        <span class="font-bold text-slate-900 dark:text-white" x-text="(enrolledCourses[0]?.progresso || 75) + '% concluído'"></span>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-white/10 rounded-full h-2.5 overflow-hidden p-0.5 border border-slate-200/80 dark:border-white/10">
                                        <div class="bg-gradient-to-r from-[#071326] via-[#0050f0] to-[#f5a800] h-full rounded-full transition-all duration-700" 
                                             :style="'width: ' + (enrolledCourses[0]?.progresso || 75) + '%'"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Botões de Ação do Card Hero -->
                        <div class="flex sm:flex-col items-center gap-3 shrink-0">
                            <button @click="openClassroom(enrolledCourses[0])" 
                                    class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-[#0050f0] hover:bg-[#0042c7] text-white dark:bg-gradient-to-r dark:from-[#071326] dark:via-[#0d1f3d] dark:to-[#071326] font-extrabold text-xs uppercase tracking-wider shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 hover:scale-[1.02] active:scale-98 transition flex items-center justify-center gap-2.5 cursor-pointer border border-blue-600 dark:border-slate-700">
                                <i data-lucide="play" class="w-4 h-4 fill-white text-white dark:text-[#f5a800] dark:fill-[#f5a800]"></i>
                                <span>Retomar Aula</span>
                            </button>
                            <button @click="openCourseDetails(enrolledCourses[0])" 
                                    class="w-full sm:w-auto px-4 py-2.5 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-slate-200 dark:hover:bg-white/15 text-slate-700 dark:text-slate-200 hover:text-slate-900 dark:hover:text-white text-xs font-bold border border-slate-200 dark:border-white/10 transition flex items-center justify-center gap-1.5 cursor-pointer">
                                <i data-lucide="list" class="w-3.5 h-3.5 text-slate-500"></i>
                                <span>Ver Ementa</span>
                            </button>
                        </div>

                    </div>
                </div>
            </section>

            <!-- 3. LEARNING TRACKS: "MINHAS FORMAÇÕES" -->
            <section>
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900 dark:text-white">Minhas Formações</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Trilhas de desenvolvimento contínuo compostas por múltiplos cursos práticos</p>
                    </div>
                    <button @click="activeMainTab = 'formacoes'" class="text-xs text-[#0050f0] hover:underline font-bold flex items-center gap-1 cursor-pointer">
                        Ver todas as formações <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    
                    <template x-for="formation in formations" :key="formation.id">
                        <div class="glass-panel rounded-2xl p-4.5 sm:p-5 hover:border-blue-400 dark:hover:border-blue-500 hover:shadow-md transition duration-300 flex flex-col justify-between group bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-2xl" x-text="formation.icon"></span>
                                    <span class="text-[10px] uppercase font-bold tracking-wider px-2.5 py-1 rounded-full bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-300 border border-slate-200 dark:border-white/10"
                                          x-text="formation.totalHours + ' horas'"></span>
                                </div>
                                <h3 class="text-sm font-bold text-slate-900 dark:text-white font-heading group-hover:text-[#0050f0] dark:group-hover:text-[#00a3e0] transition line-clamp-1" x-text="formation.title"></h3>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1.5 line-clamp-2 leading-relaxed" x-text="formation.description"></p>
                                
                                <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/10 space-y-1.5 text-xs">
                                    <div class="flex items-center justify-between text-slate-500 dark:text-slate-400 text-[11px] font-medium">
                                        <span x-text="formation.completedCourses + ' de ' + formation.totalCourses + ' cursos concluídos'"></span>
                                        <span class="font-bold text-slate-900 dark:text-white" x-text="formation.progress + '%'"></span>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-white/10 rounded-full h-2 overflow-hidden border border-slate-200/60 dark:border-white/10">
                                        <div :class="formation.gradient" class="h-full rounded-full transition-all duration-500" :style="'width: ' + formation.progress + '%'"></div>
                                    </div>
                                </div>
                            </div>

                            <button @click="openFormationModal(formation)" 
                                    class="mt-4 w-full py-2.5 rounded-xl bg-slate-50 dark:bg-white/5 hover:bg-blue-50 dark:hover:bg-white/10 text-slate-700 dark:text-slate-300 hover:text-[#0050f0] dark:hover:text-[#00a3e0] hover:border-blue-300 dark:hover:border-blue-500/30 border border-slate-200 dark:border-white/10 text-xs font-semibold transition flex items-center justify-center gap-1.5 cursor-pointer">
                                Acessar Formação <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                            </button>
                        </div>
                    </template>

                </div>
            </section>

            <!-- 4. MEUS CURSOS: Grade com Filtros por Status -->
            <section>
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4">
                    <div>
                        <h2 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900 dark:text-white">Meus Cursos Matriculados</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Acesse seus cursos em andamento e obtenha suas certificações</p>
                    </div>

                    <!-- Filtros -->
                    <div class="flex items-center gap-1 bg-slate-100 dark:bg-[#0c1220] p-1 rounded-xl border border-slate-200 dark:border-white/10 text-xs self-start">
                        <button @click="courseFilter = 'all'" 
                                :class="courseFilter === 'all' ? 'bg-[#071326] dark:bg-[#0050f0] text-[#f5a800] dark:text-white font-extrabold shadow-sm border border-slate-700 dark:border-blue-400/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white font-medium'"
                                class="px-3.5 py-1.5 rounded-lg transition cursor-pointer">
                            Todos (<span x-text="enrolledCourses.length"></span>)
                        </button>
                        <button @click="courseFilter = 'active'" 
                                :class="courseFilter === 'active' ? 'bg-[#071326] dark:bg-[#0050f0] text-[#f5a800] dark:text-white font-extrabold shadow-sm border border-slate-700 dark:border-blue-400/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white font-medium'"
                                class="px-3.5 py-1.5 rounded-lg transition cursor-pointer">
                            Em Andamento
                        </button>
                        <button @click="courseFilter = 'completed'" 
                                :class="courseFilter === 'completed' ? 'bg-[#071326] dark:bg-[#0050f0] text-[#f5a800] dark:text-white font-extrabold shadow-sm border border-slate-700 dark:border-blue-400/30' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 dark:hover:text-white font-medium'"
                                class="px-3.5 py-1.5 rounded-lg transition cursor-pointer">
                            Concluídos
                        </button>
                    </div>
                </div>

                <!-- Grade de Cursos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                    
                    <template x-for="curso in filteredEnrolledCourses" :key="curso.id">
                        <div class="glass-panel rounded-2xl overflow-hidden hover:border-[#f5a800]/50 hover:shadow-xl transition duration-300 flex flex-col justify-between group shadow-sm dark:shadow-xl bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10">
                            
                            <!-- Banner do Curso com Gradiente Corporativo RACHI -->
                            <div :class="curso.gradientClass" class="h-28 p-4 flex flex-col justify-between relative">
                                <div class="flex items-center justify-between">
                                    <span class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-[#071326]/80 text-[#f5a800] border border-white/10 shadow-xs backdrop-blur-xs"
                                          x-text="curso.categoria"></span>
                                    <span :class="curso.progresso === 100 ? 'bg-emerald-500 text-white' : 'bg-white/95 text-slate-900'"
                                          class="text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs"
                                          x-text="curso.progresso === 100 ? '✓ Concluído' : 'Em Andamento'"></span>
                                </div>
                                <div class="text-white font-bold text-xs flex items-center justify-between drop-shadow-sm">
                                    <span x-text="curso.duracao"></span>
                                    <span class="text-[11px]" x-text="curso.aulasConcluidas + ' / ' + curso.totalAulas + ' aulas'"></span>
                                </div>
                            </div>

                            <!-- Corpo do Card -->
                            <div class="p-4.5 sm:p-5 flex-1 flex flex-col justify-between bg-white dark:bg-[#0c1220]">
                                <div>
                                    <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading group-hover:text-[#071326] dark:group-hover:text-[#f5a800] transition" x-text="curso.nome"></h3>
                                    <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 line-clamp-2 leading-relaxed" x-text="curso.descricao"></p>
                                </div>

                                <!-- Barra de progresso -->
                                <div class="mt-4 pt-3 border-t border-slate-100">
                                    <div class="flex items-center justify-between text-xs text-slate-500 dark:text-slate-400 mb-1.5 font-medium">
                                        <span>Progresso</span>
                                        <span class="font-bold text-slate-900 dark:text-white" x-text="curso.progresso + '%'"></span>
                                    </div>
                                    <div class="w-full bg-slate-100 dark:bg-white/10 rounded-full h-2 overflow-hidden border border-slate-200/60 dark:border-white/10">
                                        <div class="bg-gradient-to-r from-[#071326] via-[#0050f0] to-[#f5a800] h-full rounded-full transition-all duration-500" 
                                             :style="'width: ' + curso.progresso + '%'"></div>
                                    </div>

                                    <!-- Botões de Ação do Card -->
                                    <div class="mt-4 flex items-center gap-2">
                                        <template x-if="curso.progresso === 100">
                                            <button @click="openCertificateModal(curso)" 
                                                    class="flex-1 py-2.5 rounded-xl bg-[#f5a800] hover:bg-[#d99400] text-[#071326] font-extrabold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2 shadow-md shadow-amber-500/15 cursor-pointer">
                                                <i data-lucide="award" class="w-4 h-4"></i>
                                                Emitir Certificado
                                            </button>
                                        </template>

                                        <template x-if="curso.progresso < 100">
                                            <button @click="openClassroom(curso)" 
                                                    class="flex-1 py-2.5 rounded-xl bg-[#0050f0] hover:bg-[#0042c7] text-white dark:bg-gradient-to-r dark:from-[#071326] dark:via-[#0d1f3d] dark:to-[#071326] font-extrabold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md hover:shadow-blue-500/20 cursor-pointer border border-blue-600 dark:border-slate-700">
                                                <i data-lucide="play" class="w-3.5 h-3.5 fill-white text-white dark:text-[#f5a800] dark:fill-[#f5a800]"></i>
                                                Continuar Aula
                                            </button>
                                        </template>

                                        <button @click="openCourseDetails(curso)" 
                                                title="Ver ementa do curso"
                                                class="p-2.5 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-slate-200 dark:hover:bg-white/15 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white border border-slate-200 dark:border-white/10 transition cursor-pointer">
                                            <i data-lucide="info" class="w-4 h-4"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </template>

                </div>
            </section>

            <!-- 5. RECOMENDAÇÕES PERSONALIZADAS -->
            <section class="glass-panel rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10 shadow-sm dark:shadow-xl">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-lg sm:text-xl font-heading font-black text-slate-900 dark:text-white">Recomendados para o seu plano de carreira</h2>
                        <p class="text-xs text-slate-500 dark:text-slate-400">Expandir suas competências com as certificações mais requisitadas pelo mercado de Angola</p>
                    </div>
                    <a href="/academy" class="text-xs text-[#0050f0] hover:text-[#f5a800] hover:underline font-bold flex items-center gap-1 transition">
                        Ver catálogo completo <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <template x-for="catCourse in catalogRecommendations" :key="catCourse.id">
                        <div class="bg-slate-50/80 dark:bg-white/[0.03] border border-slate-200/80 dark:border-white/10 rounded-xl sm:rounded-2xl p-4 flex flex-col justify-between hover:bg-white dark:hover:bg-white/[0.07] hover:border-[#f5a800]/40 hover:shadow-md transition">
                            <div>
                                <span class="text-[10px] font-bold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 text-[#0050f0] border border-blue-200" x-text="catCourse.categoria"></span>
                                <h4 class="text-sm font-bold text-slate-900 dark:text-white mt-2 font-heading" x-text="catCourse.nome"></h4>
                                <p class="text-xs text-slate-600 dark:text-slate-400 mt-1 leading-relaxed" x-text="catCourse.descricao"></p>
                            </div>
                            <div class="mt-4 pt-3 border-t border-slate-200/80 dark:border-white/10 flex items-center justify-between">
                                <span class="text-xs text-slate-500 dark:text-slate-400 font-mono font-semibold" x-text="catCourse.duracao"></span>
                                <a :href="'/academy?curso=' + encodeURIComponent(catCourse.nome)" 
                                   class="text-xs text-[#0050f0] dark:text-[#00a3e0] hover:text-[#f5a800] dark:hover:text-[#f5a800] font-bold flex items-center gap-1 transition">
                                    Matricular-se <i data-lucide="plus" class="w-3 h-3"></i>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            </section>

        </div>

        <!-- ============================================================ -->
        <!-- VIEW: FORMAÇÕES (TEMA EXECUTIVO RACHI)                       -->
        <!-- ============================================================ -->
        <div x-show="activeMainTab === 'formacoes'" x-cloak class="space-y-6">
            <div class="rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-gradient-to-r from-white via-slate-50 to-blue-50/50 dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-slate-900 dark:text-white border border-slate-200/90 dark:border-white/10 shadow-[0_4px_25px_rgba(0,80,240,0.05)] dark:shadow-xl relative overflow-hidden transition-colors">
                <div class="absolute right-0 top-0 w-80 h-80 bg-blue-500/10 dark:bg-[#00a3e0]/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10">
                    <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-blue-50 text-[#0050f0] border border-blue-200 dark:bg-[#00a3e0]/20 dark:text-[#00a3e0] dark:border-[#00a3e0]/30 inline-block mb-2">
                        Trilhas de Carreira Corporativas
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-heading font-black text-slate-950 dark:text-white">Formações RACHI Academy</h1>
                    <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-1 max-w-2xl leading-relaxed">
                        Guias estruturados passo a passo criados para você dominar uma área de especialização do zero até o nível executivo com a chancela do Grupo RACHI.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <template x-for="formation in formations" :key="formation.id">
                    <div class="glass-panel rounded-2xl sm:rounded-3xl p-5 sm:p-6 hover:border-[#f5a800]/50 hover:shadow-xl transition flex flex-col justify-between bg-white dark:bg-[#0c1220] border border-slate-200/90 dark:border-white/10 shadow-sm dark:shadow-xl">
                        <div>
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-3xl" x-text="formation.icon"></span>
                                <span class="text-xs px-3 py-1 rounded-full bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-300 font-bold border border-slate-200 dark:border-white/10" x-text="formation.totalHours + ' Horas Totais'"></span>
                            </div>
                            <h3 class="text-lg font-heading font-bold text-slate-900 dark:text-white" x-text="formation.title"></h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-2 leading-relaxed" x-text="formation.description"></p>
                            
                            <!-- Lista de Cursos da Formação -->
                            <div class="mt-5 space-y-2">
                                <span class="text-[11px] font-bold uppercase tracking-wider text-slate-500 dark:text-slate-400">Cursos desta Formação:</span>
                                <template x-for="(cName, idx) in formation.coursesList" :key="idx">
                                    <div class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 bg-slate-50 dark:bg-white/[0.04] p-2.5 rounded-xl border border-slate-200/80 dark:border-white/10">
                                        <span class="w-5 h-5 rounded-full bg-[#071326] dark:bg-white/10 text-[#f5a800] flex items-center justify-center text-[10px] font-bold shrink-0" x-text="idx + 1"></span>
                                        <span class="flex-1 truncate font-medium" x-text="cName"></span>
                                        <span class="text-[10px] text-emerald-700 font-bold bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200" x-show="idx < formation.completedCourses">Concluído</span>
                                    </div>
                                </template>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100">
                            <div class="flex items-center justify-between text-xs text-slate-500 mb-2 font-medium">
                                <span>Progresso da Trilha</span>
                                <span class="font-bold text-[#071326]" x-text="formation.progress + '%'"></span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden border border-slate-200/60">
                                <div :class="formation.gradient" class="h-full rounded-full" :style="'width: ' + formation.progress + '%'"></div>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <!-- ============================================================ -->
        <!-- VIEW: CERTIFICADOS (TEMA EXECUTIVO RACHI)                    -->
        <!-- ============================================================ -->
        <div x-show="activeMainTab === 'certificados'" x-cloak class="space-y-6">
            <div class="rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-gradient-to-r from-white via-slate-50 to-amber-50/50 dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-slate-900 dark:text-white border border-slate-200/90 dark:border-white/10 shadow-[0_4px_25px_rgba(245,168,0,0.06)] dark:shadow-xl relative overflow-hidden transition-colors">
                <div class="absolute right-0 top-0 w-80 h-80 bg-amber-500/10 dark:bg-[#f5a800]/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-amber-50 dark:bg-[#f5a800]/20 text-amber-600 dark:text-[#f5a800] border border-amber-200 dark:border-[#f5a800]/30 flex items-center justify-center text-3xl shrink-0 shadow-xs">
                        🎓
                    </div>
                    <div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-amber-50 text-amber-800 border border-amber-200 dark:bg-[#f5a800]/20 dark:text-[#f5a800] dark:border-[#f5a800]/30 inline-block mb-1">
                            Validação Criptográfica Oficial
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-heading font-black text-slate-950 dark:text-white">Meus Certificados Oficiais</h1>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 mt-0.5">
                            Certificados com validação criptográfica emitidos pela RACHI Academy &amp; Grupo RACHI.
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <template x-for="curso in enrolledCourses" :key="curso.id">
                    <div class="glass-panel rounded-2xl p-5 sm:p-6 flex flex-col justify-between bg-white dark:bg-[#0c1220] hover:border-[#f5a800]/40 transition shadow-sm dark:shadow-xl border border-slate-200/90 dark:border-white/10">
                        <div>
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs font-mono font-semibold text-slate-500 dark:text-slate-400" x-text="curso.duracao"></span>
                                <span :class="curso.progresso === 100 ? 'bg-amber-50 dark:bg-amber-500/10 text-amber-900 dark:text-amber-300 border-amber-300 dark:border-amber-500/30 font-extrabold' : 'bg-slate-100 dark:bg-white/10 text-slate-600 dark:text-slate-400 border-slate-200 dark:border-white/10 font-medium'"
                                      class="text-[10px] px-2.5 py-0.5 rounded-full border"
                                      x-text="curso.progresso === 100 ? 'Disponível para Emissão' : 'Em Curso (' + curso.progresso + '%)'"></span>
                            </div>
                            <h3 class="text-base font-heading font-bold text-slate-900 dark:text-white" x-text="curso.nome"></h3>
                            <p class="text-xs text-slate-600 dark:text-slate-400 mt-1.5 leading-relaxed" x-text="curso.descricao"></p>
                        </div>

                        <div class="mt-6 pt-4 border-t border-slate-100 flex items-center justify-between">
                            <template x-if="curso.progresso === 100">
                                <button @click="openCertificateModal(curso)" 
                                        class="w-full py-2.5 rounded-xl bg-[#f5a800] hover:bg-[#d99400] text-[#071326] font-extrabold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition shadow-md shadow-amber-500/15 cursor-pointer">
                                    <i data-lucide="award" class="w-4 h-4"></i>
                                    Visualizar e Imprimir Certificado
                                </button>
                            </template>
                            <template x-if="curso.progresso < 100">
                                <div class="w-full flex items-center justify-between text-xs text-slate-500">
                                    <span>Conclua todas as aulas para desbloquear</span>
                                    <button @click="openClassroom(curso)" class="text-slate-900 dark:text-white hover:text-[#f5a800] dark:hover:text-[#f5a800] font-extrabold cursor-pointer transition">
                                        Continuar curso →
                                    </button>
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        </div>



    </main>

    <!-- ================================================================ -->
    <!-- MODAL: SALA DE AULA INTERATIVA / PLAYER                         -->
    <!-- ================================================================ -->
    <div x-show="classroomModal" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-md flex flex-col">
        
        <!-- Classroom Header -->
        <header class="w-full bg-white dark:bg-[#0a0e1c] border-b border-slate-200 dark:border-white/10 px-4 sm:px-6 py-3 flex items-center justify-between shrink-0 transition-colors">
            <div class="flex items-center gap-3">
                <button @click="classroomModal = false" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 hover:text-slate-950 dark:bg-white/5 dark:hover:bg-white/10 dark:text-slate-300 dark:hover:text-white transition cursor-pointer">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </button>
                <div>
                    <span class="text-[10px] uppercase font-bold text-[#0050f0] dark:text-[#00a3e0] tracking-wider" x-text="activeCourse.nome"></span>
                    <h2 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate max-w-md sm:max-w-xl" x-text="activeLesson.titulo"></h2>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button @click="toggleLessonStatus(activeLesson)" 
                        :class="activeLesson.concluida ? 'bg-emerald-500 text-white dark:text-slate-950 hover:bg-emerald-600 dark:hover:bg-emerald-400' : 'bg-[#0050f0] text-white hover:bg-[#0042c7]'"
                        class="px-4 py-2 rounded-xl font-bold text-xs uppercase tracking-wider transition flex items-center gap-1.5 shadow-md shadow-blue-500/20 cursor-pointer">
                    <span x-show="activeLesson.concluida">✓ Aula Concluída</span>
                    <span x-show="!activeLesson.concluida">Marcar como Concluída</span>
                </button>

                <button @click="classroomModal = false" class="p-2 rounded-lg text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white cursor-pointer font-bold">✕</button>
            </div>
        </header>

        <!-- Classroom Main Body: Video Player + Modules Sidebar -->
        <div class="flex-1 grid grid-cols-1 lg:grid-cols-[1fr_22rem] xl:grid-cols-[1fr_26rem] overflow-hidden">
            
            <!-- Left: Video Player Simulation & Content -->
            <div class="p-4 sm:p-6 overflow-y-auto space-y-6">
                
                <!-- Video Screen Simulator -->
                <div class="relative w-full aspect-video bg-[#050811] rounded-2xl overflow-hidden border border-white/10 shadow-2xl flex flex-col justify-between p-4 group">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-black/40 pointer-events-none"></div>

                    <!-- Top bar in player -->
                    <div class="relative z-10 flex items-center justify-between text-xs text-white">
                        <span class="bg-black/60 px-2.5 py-1 rounded backdrop-blur text-[11px] font-mono" x-text="activeLesson.duracao || '25 min'"></span>
                        <span class="bg-[#0050f0]/80 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider">RACHI Player HD</span>
                    </div>

                    <!-- Center Play/Pause button -->
                    <div class="relative z-10 self-center">
                        <button @click="isPlaying = !isPlaying" 
                                class="w-16 h-16 rounded-full bg-[#0050f0] text-white flex items-center justify-center text-2xl shadow-alura-glow hover:scale-110 active:scale-95 transition cursor-pointer">
                            <span x-show="!isPlaying">▶</span>
                            <span x-show="isPlaying">❚❚</span>
                        </button>
                    </div>

                    <!-- Bottom Player Controls -->
                    <div class="relative z-10 space-y-2">
                        <!-- Progress Timeline -->
                        <div class="w-full bg-white/20 h-1.5 rounded-full overflow-hidden cursor-pointer">
                            <div class="bg-[#00a3e0] h-full rounded-full transition-all duration-300" :style="'width: ' + (isPlaying ? '65%' : '35%')"></div>
                        </div>

                        <div class="flex items-center justify-between text-xs text-slate-300">
                            <div class="flex items-center gap-3">
                                <button @click="isPlaying = !isPlaying" class="hover:text-white font-bold cursor-pointer">
                                    <span x-show="!isPlaying">Play</span>
                                    <span x-show="isPlaying">Pause</span>
                                </button>
                                <span class="text-[11px] font-mono text-slate-400">14:20 / 25:00</span>
                            </div>

                            <div class="flex items-center gap-2">
                                <select x-model="playbackSpeed" class="bg-black/60 text-[11px] text-white rounded px-2 py-0.5 border border-white/20 outline-none cursor-pointer">
                                    <option value="1">1.0x</option>
                                    <option value="1.25">1.25x</option>
                                    <option value="1.5">1.5x</option>
                                    <option value="2">2.0x</option>
                                </select>
                                <button @click="toastMessage('Modo tela cheia ativado', 'Vídeo HD')" class="hover:text-white p-1 cursor-pointer">
                                    <i data-lucide="maximize" class="w-3.5 h-3.5"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Lesson Info Tabs -->
                <div class="bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl p-5 space-y-4 shadow-sm text-slate-900 dark:text-slate-100">
                    <div class="flex items-center gap-4 border-b border-slate-100 dark:border-white/10 pb-3 text-xs font-bold">
                        <button @click="lessonTab = 'sobre'" :class="lessonTab === 'sobre' ? 'text-[#0050f0] dark:text-[#00a3e0] border-b-2 border-[#0050f0] dark:border-[#00a3e0]' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'" class="pb-2 cursor-pointer">Sobre esta Aula</button>
                        <button @click="lessonTab = 'materiais'" :class="lessonTab === 'materiais' ? 'text-[#0050f0] dark:text-[#00a3e0] border-b-2 border-[#0050f0] dark:border-[#00a3e0]' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'" class="pb-2 cursor-pointer">Materiais Complementares (PDF)</button>
                        <button @click="lessonTab = 'exercicios'" :class="lessonTab === 'exercicios' ? 'text-[#0050f0] dark:text-[#00a3e0] border-b-2 border-[#0050f0] dark:border-[#00a3e0]' : 'text-slate-500 dark:text-slate-400 hover:text-slate-900 dark:hover:text-white'" class="pb-2 cursor-pointer">Exercícios Práticos</button>
                    </div>

                    <div x-show="lessonTab === 'sobre'" class="space-y-3">
                        <h3 class="text-base font-bold text-slate-900 dark:text-white font-heading" x-text="activeLesson.titulo"></h3>
                        <p class="text-xs sm:text-sm text-slate-600 dark:text-slate-300 leading-relaxed" x-text="activeLesson.descricao"></p>
                        <div class="p-3 bg-blue-50/60 dark:bg-blue-500/10 border border-blue-100 dark:border-blue-500/20 rounded-xl text-xs text-blue-900 dark:text-blue-200 flex items-center gap-2">
                            <i data-lucide="shield" class="w-4 h-4 text-[#0050f0]"></i>
                            Certificação Oficial emitida automaticamente após conclusão de 100% das aulas deste curso.
                        </div>
                    </div>

                    <div x-show="lessonTab === 'materiais'" x-cloak class="space-y-3 text-xs">
                        <div class="flex items-center justify-between p-3 bg-slate-50 dark:bg-white/[0.04] border border-slate-200 dark:border-white/10 rounded-xl">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="file-text" class="w-4 h-4 text-rose-500"></i>
                                <div>
                                    <div class="font-bold text-slate-900 dark:text-white">Apostila Completa da Formação (PDF)</div>
                                    <div class="text-[10px] text-slate-500 dark:text-slate-400">4.2 MB • Guia de estudo oficial</div>
                                </div>
                            </div>
                            <button @click="toastMessage('Download iniciado: Apostila_Oficial.pdf', 'Download Concluído')" class="px-3 py-1.5 rounded-lg bg-[#0050f0] text-white font-semibold hover:bg-[#0042c7] transition cursor-pointer">Baixar</button>
                        </div>
                    </div>

                    <div x-show="lessonTab === 'exercicios'" x-cloak class="space-y-3 text-xs">
                        <div class="p-4 bg-slate-50 dark:bg-white/[0.04] border border-slate-200 dark:border-white/10 rounded-xl space-y-2">
                            <div class="font-bold text-slate-900 dark:text-white">Exercício de Fixação #1</div>
                            <p class="text-slate-600 dark:text-slate-300 text-xs">Implemente as diretrizes de proteção e análise de riscos apresentadas no estudo de caso prático.</p>
                            <button @click="toastMessage('Exercício submetido ao orientador!', 'Sucesso')" class="px-3 py-1.5 rounded-lg bg-emerald-600 text-white font-semibold hover:bg-emerald-500 transition cursor-pointer">Enviar Resposta</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right: Module and Lessons Syllabus Drawer -->
            <div class="bg-white dark:bg-[#0b0f1e] border-t lg:border-t-0 lg:border-l border-slate-200 dark:border-white/10 p-4 overflow-y-auto flex flex-col justify-between transition-colors">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Ementa do Curso</h3>
                        <span class="text-xs font-bold text-[#0050f0] dark:text-[#00a3e0]" x-text="activeCourse.progresso + '% Concluído'"></span>
                    </div>

                    <!-- Módulos e Aulas -->
                    <div class="space-y-4">
                        <template x-for="(modulo, mIdx) in activeCourse.modulos" :key="modulo.id">
                            <div class="space-y-1.5">
                                <div class="text-[11px] font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider px-2 py-1 bg-slate-100 dark:bg-white/[0.02] rounded" x-text="modulo.nome"></div>
                                
                                <div class="space-y-1">
                                    <template x-for="aula in modulo.aulas" :key="aula.id">
                                        <button @click="selectLessonInPlayer(aula)" 
                                                :class="activeLesson.id === aula.id ? 'bg-blue-50 border-blue-300 text-[#0050f0] font-bold dark:bg-[#0050f0]/25 dark:border-[#0050f0]/60 dark:text-white' : 'hover:bg-slate-100 text-slate-700 dark:hover:bg-white/5 dark:text-slate-300 border-transparent'"
                                                class="w-full text-left p-2.5 rounded-xl border transition flex items-center justify-between gap-2 text-xs group cursor-pointer">
                                            <div class="flex items-center gap-2 min-w-0">
                                                <input type="checkbox" 
                                                       :checked="aula.concluida" 
                                                       @click.stop="toggleLessonStatus(aula)" 
                                                       class="w-4 h-4 rounded text-[#0050f0] bg-slate-100 dark:bg-white/10 border-slate-300 dark:border-white/20 focus:ring-0 cursor-pointer">
                                                <span class="truncate" :class="aula.concluida ? 'text-slate-400 line-through' : 'font-medium'" x-text="aula.titulo"></span>
                                            </div>
                                            <span class="text-[10px] text-slate-400 font-mono shrink-0" x-text="aula.duracao"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <div class="mt-6 pt-4 border-t border-slate-200 dark:border-white/10">
                    <button @click="openCertificateModal(activeCourse)" 
                            :disabled="activeCourse.progresso < 100"
                            :class="activeCourse.progresso === 100 ? 'bg-[#f5a800] text-slate-950 font-bold hover:brightness-110 cursor-pointer shadow-md' : 'bg-slate-100 dark:bg-white/5 text-slate-400 dark:text-slate-500 cursor-not-allowed'"
                            class="w-full py-2.5 rounded-xl text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition">
                        <i data-lucide="award" class="w-4 h-4"></i>
                        <span x-text="activeCourse.progresso === 100 ? 'Emitir Certificado Oficial' : 'Certificado Bloqueado (Progresso < 100%)'"></span>
                    </button>
                </div>
            </div>

        </div>

    </div>

    <!-- ================================================================ -->
    <!-- MODAL: CERTIFICADO OFICIAL RACHI ACADEMY (IMPRESSÃO / PDF)        -->
    <!-- ================================================================ -->
    <div x-show="certificateModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        
        <div class="relative max-w-3xl w-full bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl sm:rounded-3xl p-5 sm:p-7 shadow-2xl space-y-6">
            
            <div class="flex items-center justify-between no-print">
                <div class="flex items-center gap-2 text-amber-700 dark:text-amber-400 font-bold">
                    <i data-lucide="award" class="w-5 h-5"></i>
                    <span class="text-xs uppercase tracking-wider">Certificado Oficial RACHI Academy</span>
                </div>
                <button @click="certificateModalOpen = false" class="text-slate-400 hover:text-slate-700 text-sm font-bold cursor-pointer">✕</button>
            </div>

            <!-- Certificado Renderizado para Visualização / Impressão -->
            <div id="printable-certificate" class="bg-gradient-to-br from-[#faf8f2] via-[#ffffff] to-[#f7f4ec] border-4 border-double border-amber-500/50 rounded-2xl p-8 sm:p-10 text-center relative overflow-hidden shadow-lg">
                <div class="absolute inset-0 bg-[radial-gradient(#f5a800_1px,transparent_1px)] [background-size:16px_16px] opacity-10 pointer-events-none"></div>
                
                <div class="relative z-10 space-y-5">
                    <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="h-9 mx-auto object-contain">
                    
                    <div class="text-[11px] font-bold uppercase tracking-widest text-amber-800">
                        CERTIFICADO OFICIAL DE CONCLUSÃO E CAPACITAÇÃO EXECUTIVA
                    </div>

                    <p class="text-xs text-slate-600">Certificamos com distinção de mérito e aproveitamento acadêmico que:</p>

                    <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-950 tracking-wide underline decoration-amber-500/60 underline-offset-8" 
                        x-text="currentUser.nome"></h2>

                    <p class="text-xs text-slate-700 max-w-lg mx-auto leading-relaxed">
                        Concluiu com aproveitamento integral o programa de formação em 
                        <strong class="text-[#0050f0]" x-text="certificateCourse.nome"></strong>, com carga horária total de 
                        <strong class="text-slate-900" x-text="certificateCourse.duracao || '40 Horas'"></strong>, cumprindo todos os módulos práticos e avaliações exigidas.
                    </p>

                    <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                        <div class="text-left">
                            <div class="text-[10px] uppercase font-bold text-slate-400">CÓDIGO DE AUTENTICIDADE</div>
                            <div class="font-mono text-amber-700 font-bold text-xs" x-text="'RACHI-CERT-' + (currentUser.aluno_id || '104') + '-' + (certificateCourse.id || '1') + '-2026'"></div>
                        </div>

                        <div class="text-right">
                            <div class="text-[10px] uppercase font-bold text-slate-400">DATA DE EMISSÃO</div>
                            <div class="text-slate-800 font-semibold" x-text="new Date().toLocaleDateString('pt-AO')"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões de Ação do Certificado -->
            <div class="flex items-center justify-end gap-3 no-print pt-2">
                <button @click="certificateModalOpen = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 hover:bg-slate-200 dark:hover:bg-white/15 text-slate-700 dark:text-slate-200 text-xs font-semibold cursor-pointer">
                    Fechar
                </button>
                <button @click="window.print()" class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-400 hover:to-amber-500 text-slate-950 font-bold text-xs uppercase tracking-wider transition flex items-center gap-2 shadow-md cursor-pointer">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    Imprimir / Salvar em PDF
                </button>
            </div>

        </div>

    </div>

    <!-- ================================================================ -->
    <!-- MODAL: HISTÓRICO DE ACESSOS (AUDITORIA E SEGURANÇA)               -->
    <!-- ================================================================ -->
    <div x-show="accessLogsModal" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/60 backdrop-blur-sm flex items-center justify-center p-4">
        
        <div class="max-w-2xl w-full bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl sm:rounded-3xl p-5 sm:p-7 space-y-4 shadow-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-[#0050f0]">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Histórico de Acessos &amp; Sessões</h3>
                </div>
                <button @click="accessLogsModal = false" class="text-slate-400 hover:text-slate-600 text-sm font-bold cursor-pointer">✕</button>
            </div>

            <p class="text-xs text-slate-600 dark:text-slate-300">Registros de segurança de autenticação do seu usuário na RACHI Academy:</p>

            <div class="overflow-x-auto rounded-xl border border-slate-200 dark:border-white/10">
                <table class="w-full text-left text-xs text-slate-700 dark:text-slate-300">
                    <thead class="bg-slate-50 dark:bg-white/[0.04] text-[11px] uppercase font-bold text-slate-500 dark:text-slate-400 border-b border-slate-200 dark:border-white/10">
                        <tr>
                            <th class="p-3">Data</th>
                            <th class="p-3">Horário</th>
                            <th class="p-3">Endereço IP</th>
                            <th class="p-3">Dispositivo / Navegador</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-white/10">
                        <template x-for="log in accessHistory" :key="log.id">
                            <tr class="hover:bg-slate-50 dark:hover:bg-white/[0.04] transition">
                                <td class="p-3 text-slate-900 dark:text-white font-semibold" x-text="log.data_acesso"></td>
                                <td class="p-3 font-mono text-[#0050f0] font-bold" x-text="log.hora_acesso"></td>
                                <td class="p-3 font-mono text-slate-500" x-text="log.ip"></td>
                                <td class="p-3 text-slate-600 dark:text-slate-400 truncate max-w-xs" x-text="log.user_agent || log.navegador"></td>
                            </tr>
                        </template>
                    </tbody>
                </table>
            </div>

            <div class="flex justify-end pt-2">
                <button @click="accessLogsModal = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-200 text-xs font-semibold hover:bg-slate-200 dark:hover:bg-white/15 cursor-pointer">Fechar</button>
            </div>
        </div>
    </div>

    <!-- ================================================================ -->
    <!-- FOOTER (TEMA BRANCO)                                             -->
    <!-- ================================================================ -->
    <footer class="w-full border-t border-slate-200 dark:border-white/10 bg-white dark:bg-[#060a12] py-6 sm:py-7 text-xs text-slate-500 dark:text-slate-400 mt-10 transition-colors">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="h-5 w-auto dark:brightness-125">
                <span>&copy; 2026 RACHI Academy • Todos os direitos reservados.</span>
            </div>
            <div class="flex items-center gap-4 text-slate-600 dark:text-slate-400">
                <a href="/academy" class="hover:text-[#0050f0] dark:hover:text-[#f5a800] transition">Cursos</a>
                <a href="/contacto" class="hover:text-[#0050f0] dark:hover:text-[#f5a800] transition">Suporte Acadêmico</a>
                <button @click="accessLogsModal = true" class="hover:text-[#0050f0] dark:hover:text-[#f5a800] transition cursor-pointer">Privacidade &amp; Segurança</button>
            </div>
        </div>
    </footer>

    <!-- ================================================================ -->
    <!-- JAVASCRIPT: ALPINE APP DO DASHBOARD DO ALUNO                     -->
    <!-- ================================================================ -->
    <script>
        function alunoDashboardApp() {
            return {
                activeMainTab: 'dashboard',
                courseFilter: 'all',
                searchQuery: '',
                searchOpen: false,
                profileMenuOpen: false,
                mobileMenuOpen: false,
                notificationsOpen: false,
                classroomModal: false,
                certificateModalOpen: false,
                accessLogsModal: false,
                isPlaying: false,
                playbackSpeed: '1',
                lessonTab: 'sobre',
                
                toast: { visible: false, title: '', message: '' },
                xpToast: { visible: false, points: 50 },

                // Perfil do Aluno
                currentUser: {
                    id: 25,
                    aluno_id: 104,
                    nome: 'Casimiro Gundja',
                    email: 'casimirogundja@outlook.com',
                    tipo: 'aluno',
                    status: 'ativo'
                },

                // Estatísticas do Aluno (Gamificação)
                studentStats: {
                    streakDays: 5,
                    xp: 1850,
                    level: 4,
                    totalHours: 48
                },

                // Rastreador de frequência semanal
                weekHabit: [
                    { name: 'Segunda', short: 'S', done: true },
                    { name: 'Terça', short: 'T', done: true },
                    { name: 'Quarta', short: 'Q', done: true },
                    { name: 'Quinta', short: 'Q', done: true },
                    { name: 'Sexta', short: 'S', done: true },
                    { name: 'Sábado', short: 'S', done: false },
                    { name: 'Domingo', short: 'D', done: false }
                ],

                // Trilhas / Formações
                formations: [
                    {
                        id: 1,
                        icon: '🛡️',
                        title: 'Formação Cibersegurança & Defesa Ativa',
                        description: 'Trilha completa cobrindo governança de segurança, prevenção a ameaças cibernéticas, SOC e conformidade.',
                        totalHours: 90,
                        totalCourses: 4,
                        completedCourses: 3,
                        progress: 75,
                        gradient: 'bg-gradient-to-r from-[#071326] via-[#0d2249] to-[#0050f0]',
                        coursesList: [
                            'Fundamentos de Redes e Protocolos Seguros',
                            'Cibersegurança e Proteção de Dados',
                            'Gestão de Vulnerabilidades e Pentest',
                            'Resoluções e Compliance Governamental'
                        ]
                    },
                    {
                        id: 2,
                        icon: '📈',
                        title: 'Formação Gestão Financeira & Liderança Corporativa',
                        description: 'Domínio de DRE, valuation, fluxo de caixa estratégico e liderança de equipas de alto rendimento.',
                        totalHours: 65,
                        totalCourses: 3,
                        completedCourses: 2,
                        progress: 66,
                        gradient: 'bg-gradient-to-r from-[#071326] via-[#b45309] to-[#f5a800]',
                        coursesList: [
                            'Gestão Empresarial, Finanças e Operações',
                            'Liderança e Gestão de Equipas de Alto Desempenho',
                            'Modelagem Financeira Avançada no Excel'
                        ]
                    },
                    {
                        id: 3,
                        icon: '⚡',
                        title: 'Formação Automação de Escritório & Produtividade com IA',
                        description: 'Trabalho colaborativo em nuvem, automação com inteligência artificial generativa e análise de dados no Power BI.',
                        totalHours: 50,
                        totalCourses: 5,
                        completedCourses: 2,
                        progress: 40,
                        gradient: 'bg-gradient-to-r from-[#071326] via-[#0284c7] to-[#00a3e0]',
                        coursesList: [
                            'Competências Digitais & Produtividade com IA',
                            'Power BI para Tomadores de Decisão',
                            'Automação de Rotinas com Python e IA',
                            'Gestão Eletrônica de Documentos',
                            'Design de Dashboards Corporativos'
                        ]
                    }
                ],

                // Cursos Matriculados do Aluno
                enrolledCourses: [
                    {
                        id: 1,
                        nome: 'Cibersegurança e Proteção de Dados',
                        categoria: 'Segurança da Informação',
                        gradientClass: 'bg-gradient-to-br from-[#071326] via-[#0d2249] to-[#0050f0]',
                        descricao: 'Prevenção de ataques cibernéticos, defesa ativa, conformidade e governança de dados corporativos.',
                        progresso: 75,
                        aulasConcluidas: 6,
                        totalAulas: 8,
                        duracao: '40 Horas',
                        modulos: [
                            {
                                id: 101,
                                nome: 'Fundamentos e Vetores de Ameaça',
                                aulas: [
                                    { id: 1, titulo: 'Introdução à Cibersegurança & Cenário Angolano', duracao: '15 min', concluida: true },
                                    { id: 2, titulo: 'Boas Práticas de Senhas e Autenticação MFA', duracao: '20 min', concluida: true },
                                    { id: 3, titulo: 'Engenharia Social e Proteção Contra Phishing', duracao: '25 min', concluida: true }
                                ]
                            },
                            {
                                id: 102,
                                nome: 'Blindagem de Sistemas e Infraestrutura',
                                aulas: [
                                    { id: 4, titulo: 'Criptografia e Armazenamento Seguro de Dados', duracao: '30 min', concluida: true },
                                    { id: 5, titulo: 'Firewalls, DMZ e Segmentação de Redes', duracao: '35 min', concluida: true },
                                    { id: 6, titulo: 'Monitoramento Contínuo e SOC de Segurança', duracao: '28 min', concluida: true }
                                ]
                            },
                            {
                                id: 103,
                                nome: 'Resposta a Incidentes e Auditoria',
                                aulas: [
                                    { id: 7, titulo: 'Simulação de Ataques e Exercício Red Team', duracao: '45 min', concluida: false },
                                    { id: 8, titulo: 'Relatório Executivo e Avaliação de Certificação', duracao: '40 min', concluida: false }
                                ]
                            }
                        ]
                    },
                    {
                        id: 2,
                        nome: 'Competências Digitais & Produtividade com IA',
                        categoria: 'Tecnologia & Escritório',
                        gradientClass: 'bg-gradient-to-br from-[#071326] via-[#0284c7] to-[#00a3e0]',
                        descricao: 'Ferramentas de escritório colaborativas, automação de rotinas com IA e análise de métricas no Excel/Power BI.',
                        progresso: 40,
                        aulasConcluidas: 4,
                        totalAulas: 10,
                        duracao: '30 Horas',
                        modulos: [
                            {
                                id: 201,
                                nome: 'Produtividade e Colaboração em Nuvem',
                                aulas: [
                                    { id: 21, titulo: 'Ecossistema Digital e Armazenamento em Nuvem', duracao: '15 min', concluida: true },
                                    { id: 22, titulo: 'Planilhas Avançadas e Fórmulas Essenciais', duracao: '25 min', concluida: true },
                                    { id: 23, titulo: 'Dashboards com Tabelas Dinâmicas', duracao: '30 min', concluida: true },
                                    { id: 24, titulo: 'Automação de Tarefas Repetitivas com IA', duracao: '20 min', concluida: true }
                                ]
                            },
                            {
                                id: 202,
                                nome: 'Comunicação e Inteligência de Negócio',
                                aulas: [
                                    { id: 25, titulo: 'Apresentações de Impacto e Storytelling', duracao: '20 min', concluida: false },
                                    { id: 26, titulo: 'Introdução ao Power BI Desktop', duracao: '35 min', concluida: false }
                                ]
                            }
                        ]
                    },
                    {
                        id: 3,
                        nome: 'Liderança e Gestão de Equipas de Alto Desempenho',
                        categoria: 'Liderança & Pessoas',
                        gradientClass: 'bg-gradient-to-br from-[#071326] via-[#b45309] to-[#f5a800]',
                        descricao: 'Comunicação assertiva, gestão de conflitos, tomada de decisão eficaz e motivação de colaboradores.',
                        progresso: 100,
                        aulasConcluidas: 6,
                        totalAulas: 6,
                        duracao: '25 Horas',
                        modulos: [
                            {
                                id: 301,
                                nome: 'Pilares da Liderança Moderna',
                                aulas: [
                                    { id: 31, titulo: 'Estilos de Liderança e Autoconhecimento', duracao: '20 min', concluida: true },
                                    { id: 32, titulo: 'Comunicação Assertiva e Cultura de Feedback', duracao: '25 min', concluida: true },
                                    { id: 33, titulo: 'Gestão Construtiva de Conflitos', duracao: '30 min', concluida: true },
                                    { id: 34, titulo: 'Delegação Eficaz e Empoderamento', duracao: '25 min', concluida: true },
                                    { id: 35, titulo: 'Tomada de Decisão sob Pressão', duracao: '30 min', concluida: true },
                                    { id: 36, titulo: 'Cultura de Reconhecimento e Motivação', duracao: '20 min', concluida: true }
                                ]
                            }
                        ]
                    }
                ],

                // Catálogo de Recomendações
                catalogRecommendations: [
                    { id: 4, nome: 'Gestão Empresarial, Finanças e Operações', categoria: 'Gestão & Negócios', duracao: '35h', descricao: 'Planeamento estratégico, análise de rentabilidade, fluxo de caixa e conformidade fiscal.' },
                    { id: 5, nome: 'Redes Corporativas e Infraestrutura de TI', categoria: 'Infraestrutura', duracao: '45h', descricao: 'Cabeamento estruturado, roteamento Mikrotik/Cisco e balanceamento de carga.' },
                    { id: 6, nome: 'Marketing Digital e Aquisição B2B', categoria: 'Vendas & Negócios', duracao: '25h', descricao: 'Estratégias de atração de clientes corporativos e automação de funis.' }
                ],

                // Histórico de Acessos
                accessHistory: [
                    { id: 1, data_acesso: '20/09/2026', hora_acesso: '18:10', ip: '192.168.1.104', user_agent: 'Chrome Desktop (Windows 11)' },
                    { id: 2, data_acesso: '19/09/2026', hora_acesso: '14:22', ip: '192.168.1.104', user_agent: 'Chrome Desktop (Windows 11)' },
                    { id: 3, data_acesso: '18/09/2026', hora_acesso: '09:45', ip: '197.218.45.12', user_agent: 'Mobile Safari (iOS 18)' }
                ],

                // Sala de Aula e Certificado Ativo
                activeCourse: {},
                activeLesson: {},
                certificateCourse: {},

                // Inicialização com Verificação de Autenticação
                initApp() {
                    // 1. Validar se existe sessão autenticada de usuário existente
                    const isAuth = localStorage.getItem('rachi_academy_auth');
                    const storedUser = localStorage.getItem('rachi_user_session');
                    let authenticated = false;

                    if (storedUser) {
                        try {
                            const parsed = JSON.parse(storedUser);
                            if (parsed && parsed.loggedIn !== false) {
                                const u = parsed.user || (parsed.email ? parsed : null);
                                if (u) {
                                    // Se tem matrícula ativa, ou isAuth é true, ou admin, ou aluno registrado
                                    const uEmail = (u.email || '').toLowerCase();
                                    if (u.has_matricula || isAuth === 'true' || u.role === 'admin' || u.tipo === 'admin' || u.tipo === 'aluno' || uEmail === 'casimirogundja@outlook.com' || uEmail === 'aluno@rachi.ao') {
                                        this.currentUser = {
                                            id: u.id || 25,
                                            aluno_id: u.aluno_id || (u.id ? u.id + 100 : 104),
                                            nome: u.nome || u.name || 'Casimiro Gundja',
                                            email: u.email || 'casimirogundja@outlook.com',
                                            tipo: 'aluno',
                                            status: 'ativo',
                                            has_matricula: true
                                        };
                                        localStorage.setItem('rachi_academy_auth', 'true');
                                        authenticated = true;

                                        // Sincronizar de volta na sessão global do portal
                                        try {
                                            parsed.has_matricula = true;
                                            if (parsed.user) parsed.user.has_matricula = true;
                                            localStorage.setItem('rachi_user_session', JSON.stringify(parsed));
                                        } catch(err) {}
                                    }
                                }
                            }
                        } catch(e) {
                            console.error('Erro ao ler sessão:', e);
                        }
                    }

                    if (!authenticated && isAuth === 'true') {
                        authenticated = true;
                    }

                    if (!authenticated) {
                        // Se não houver sessão ativa, inicializa sessão de demonstração do aluno padrão
                        this.currentUser = {
                            id: 25,
                            aluno_id: 104,
                            nome: 'Casimiro Gundja',
                            email: 'casimirogundja@outlook.com',
                            tipo: 'aluno',
                            status: 'ativo',
                            has_matricula: true
                        };
                        try {
                            localStorage.setItem('rachi_academy_auth', 'true');
                            localStorage.setItem('rachi_user_session', JSON.stringify({
                                loggedIn: true,
                                user: this.currentUser,
                                has_matricula: true
                            }));
                        } catch(e) {}
                        authenticated = true;
                    }

                    // Sincronização em tempo real via BroadcastChannel e storage
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            this.authChannel = new BroadcastChannel('rachi_auth_channel');
                            this.authChannel.onmessage = (event) => {
                                if (!event.data) return;
                                if (event.data.action === 'logout') {
                                    window.location.href = '/academy/login?action=logout';
                                }
                            };
                        }
                    } catch(e) {}

                    window.addEventListener('storage', (event) => {
                        if (event.key === 'rachi_user_session' || event.key === 'rachi_auth_sync') {
                            const raw = localStorage.getItem('rachi_user_session');
                            if (!raw || raw.includes('"loggedIn":false')) {
                                window.location.href = '/academy/login?action=logout';
                            }
                        }
                    });

                    // Carregar cursos salvos no localStorage se houverem
                    const savedCourses = localStorage.getItem('rachi_enrolled_courses_' + this.currentUser.id);
                    if (savedCourses) {
                        try {
                            const parsedC = JSON.parse(savedCourses);
                            if (Array.isArray(parsedC) && parsedC.length > 0) {
                                this.enrolledCourses = parsedC;
                            }
                        } catch(e) {}
                    }

                    // Configura curso ativo inicial para a sala de aula
                    this.activeCourse = this.enrolledCourses[0];
                    if (this.activeCourse && this.activeCourse.modulos) {
                        this.activeLesson = this.activeCourse.modulos[2]?.aulas[0] || this.activeCourse.modulos[0]?.aulas[0];
                    }

                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },

                // Getters
                get filteredEnrolledCourses() {
                    if (this.courseFilter === 'active') {
                        return this.enrolledCourses.filter(c => c.progresso < 100);
                    }
                    if (this.courseFilter === 'completed') {
                        return this.enrolledCourses.filter(c => c.progresso === 100);
                    }
                    return this.enrolledCourses;
                },

                get filteredSearchResults() {
                    if (!this.searchQuery.trim()) return [];
                    const q = this.searchQuery.toLowerCase();
                    return this.enrolledCourses.concat(this.catalogRecommendations).filter(c => 
                        c.nome.toLowerCase().includes(q) || c.categoria.toLowerCase().includes(q)
                    );
                },

                getCompletedCoursesCount() {
                    return this.enrolledCourses.filter(c => c.progresso === 100).length;
                },

                getInitials(name) {
                    if (!name) return 'RA';
                    const parts = name.trim().split(' ');
                    if (parts.length === 1) return parts[0].substring(0, 2).toUpperCase();
                    return (parts[0][0] + parts[parts.length - 1][0]).toUpperCase();
                },

                // Ações da Sala de Aula
                openClassroom(course) {
                    this.activeCourse = course;
                    let found = null;
                    for (let m of course.modulos) {
                        for (let a of m.aulas) {
                            if (!a.concluida) {
                                found = a;
                                break;
                            }
                        }
                        if (found) break;
                    }
                    this.activeLesson = found || course.modulos[0].aulas[0];
                    this.classroomModal = true;
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                selectLessonInPlayer(aula) {
                    this.activeLesson = aula;
                    this.isPlaying = false;
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                toggleLessonStatus(aula) {
                    aula.concluida = !aula.concluida;
                    
                    let totalAulas = 0;
                    let concluidas = 0;
                    for (let m of this.activeCourse.modulos) {
                        for (let a of m.aulas) {
                            totalAulas++;
                            if (a.concluida) concluidas++;
                        }
                    }
                    this.activeCourse.totalAulas = totalAulas;
                    this.activeCourse.aulasConcluidas = concluidas;
                    this.activeCourse.progresso = Math.round((concluidas / totalAulas) * 100);

                    if (aula.concluida) {
                        this.studentStats.xp += 50;
                        this.triggerXpReward(50);
                        this.toastMessage('Aula "' + aula.titulo + '" concluída!', 'Parabéns!');
                    }

                    localStorage.setItem('rachi_enrolled_courses_' + this.currentUser.id, JSON.stringify(this.enrolledCourses));
                },

                openCourseDetails(course) {
                    this.openClassroom(course);
                },

                openCourseFromSearch(course) {
                    this.searchOpen = false;
                    this.searchQuery = '';
                    const enrolled = this.enrolledCourses.find(c => c.id === course.id);
                    if (enrolled) {
                        this.openClassroom(enrolled);
                    } else {
                        window.location.href = '/academy?curso=' + encodeURIComponent(course.nome);
                    }
                },

                openFormationModal(formation) {
                    this.toastMessage('Você está inscrito na trilha: ' + formation.title, 'Formação Corporativa');
                    this.activeMainTab = 'formacoes';
                },

                openCertificateModal(course) {
                    this.certificateCourse = course;
                    this.certificateModalOpen = true;
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                triggerXpReward(pts = 50) {
                    this.xpToast.points = pts;
                    this.xpToast.visible = true;
                    setTimeout(() => { this.xpToast.visible = false; }, 3000);
                },

                toastMessage(msg, title = 'Notificação') {
                    this.toast.title = title;
                    this.toast.message = msg;
                    this.toast.visible = true;
                    setTimeout(() => { this.toast.visible = false; }, 4000);
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
                    window.location.href = '/academy/login?action=logout';
                }
            }
        }
    </script>
</body>
</html>
<?php /**PATH C:\Users\casimiro.gundja\Documents\rachi\resources\views/public/aluno-dashboard.blade.php ENDPATH**/ ?>