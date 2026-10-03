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
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <link rel="stylesheet" href="/worker-marketing.css">
    
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
                        aluraBlue: '#0050f0',
                        aluraDarkBlue: '#003eb8',
                        aluraGreen: '#10b981',
                        aluraBgLight: '#f3f5f9',
                        aluraBgDark: '#060a12',
                        aluraCardDark: '#0b1220',
                        aluraLavenderLight: '#eef2ff',
                        aluraLavenderDark: '#0e1832',
                        rachiGold: '#f5a800',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        body {
            background-color: #f3f5f9;
            color: #1e293b;
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
            transition: background-color 0.2s ease, color 0.2s ease;
        }
        html.dark body {
            background-color: #060a12;
            color: #f1f5f9;
        }
        
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
<body x-data="alunoDashboardApp()" x-init="initApp()" class="min-h-screen flex flex-col antialiased bg-[#f3f5f9] dark:bg-[#060a12] text-slate-900 dark:text-slate-100 transition-colors duration-200">

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
    <!-- TOP NAVIGATION HEADER (MODELO ALURA)                              -->
    <!-- ================================================================ -->
    <header class="sticky top-0 z-50 w-full bg-white dark:bg-[#090f1d] border-b border-slate-200/90 dark:border-white/10 shadow-xs transition-colors duration-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-[68px] gap-4 sm:gap-6">
                
                <!-- 1. Esquerda: Logo Alura / RACHI Academy -->
                <div class="flex items-center gap-4 shrink-0">
                    <!-- Mobile Hamburger -->
                    <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden p-2 rounded-xl text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/10">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>

                    <a href="/aluno-dashboard" class="flex items-center gap-2 group cursor-pointer" title="RACHI Academy">
                        <!-- Logo Light Mode -->
                        <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi.png'" alt="RACHI" class="h-7 sm:h-8 w-auto object-contain block dark:hidden transition group-hover:scale-105">
                        <!-- Logo Dark Mode -->
                        <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'" alt="RACHI" class="h-7 sm:h-8 w-auto object-contain hidden dark:block transition group-hover:scale-105">
                        <span class="font-heading font-black text-lg sm:text-xl text-slate-900 dark:text-white tracking-tight">Academy</span>
                    </a>
                </div>

                <!-- 2. Centro: Barra de Pesquisa Arredondada (Alura Style) -->
                <div class="flex-1 max-w-md sm:max-w-lg mx-2 sm:mx-6 relative" @click.away="searchOpen = false">
                    <div class="relative w-full flex items-center">
                        <input type="text" 
                               x-model="searchQuery" 
                               @focus="searchOpen = true"
                               @input="searchOpen = true"
                               placeholder="O que você quer aprender?" 
                               class="w-full bg-[#f1f4f9] dark:bg-[#0c1427] border border-transparent focus:border-blue-400 dark:focus:border-blue-500 focus:bg-white dark:focus:bg-[#080d1a] text-xs sm:text-sm text-slate-800 dark:text-white rounded-full pl-5 pr-12 py-2 sm:py-2.5 outline-none transition placeholder-slate-400 shadow-inner">
                        
                        <!-- Botão com ícone de pesquisa circular na extremidade direita -->
                        <button type="button" @click="searchOpen = true" class="absolute right-1.5 w-8 h-8 rounded-full bg-blue-100/70 dark:bg-white/10 hover:bg-blue-200/80 text-[#0050f0] dark:text-blue-400 flex items-center justify-center transition cursor-pointer">
                            <i data-lucide="search" class="w-3.5 h-3.5 sm:w-4 sm:h-4"></i>
                        </button>
                    </div>

                    <!-- Dropdown de Resultados da Pesquisa -->
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

                <!-- 3. Direita: Links Rápidos, Notificações e Perfil (Alura Style) -->
                <div class="flex items-center gap-4 sm:gap-6 shrink-0">
                    
                    <!-- Links Rápidos: Início e Explorar Catálogo (Alura Exact Style) -->
                    <nav class="hidden md:flex items-center gap-4 lg:gap-5 text-xs sm:text-sm">
                        <button @click="activeMainTab = 'dashboard'" 
                                :class="activeMainTab === 'dashboard' ? 'font-bold text-slate-900 dark:text-white' : 'font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white'"
                                class="transition cursor-pointer">
                            Início
                        </button>
                        <a href="/academy" 
                           class="font-medium text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white transition cursor-pointer">
                            Explorar Catálogo
                        </a>
                    </nav>

                    <!-- Notificações com badge vermelha (Alura Style) -->
                    <button @click="toastMessage('Nenhuma nova notificação', 'Avisos')" 
                            class="relative p-2 rounded-full hover:bg-slate-100 dark:hover:bg-white/10 text-slate-700 dark:text-slate-300 transition cursor-pointer">
                        <i data-lucide="bell" class="w-5 h-5"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-rose-500 ring-2 ring-white dark:ring-[#090f1d]"></span>
                    </button>

                    <!-- Avatar / Dropdown de Usuário (Alura Style) -->
                    <div class="relative" @click.away="profileMenuOpen = false">
                        <button @click="profileMenuOpen = !profileMenuOpen" 
                                class="flex items-center gap-2 p-1 rounded-full hover:ring-2 hover:ring-blue-500/20 transition cursor-pointer">
                            <div class="w-9 h-9 sm:w-10 sm:h-10 rounded-full bg-gradient-to-tr from-[#0050f0] via-[#00a3e0] to-[#f5a800] text-white font-extrabold text-xs flex items-center justify-center ring-2 ring-white dark:ring-slate-800 shadow-sm overflow-hidden">
                                <span x-text="getInitials(currentUser.nome)"></span>
                            </div>
                        </button>

                        <!-- Menu Dropdown -->
                        <div x-show="profileMenuOpen" 
                             x-cloak 
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-64 bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/15 rounded-2xl shadow-2xl p-3 z-50 text-slate-900 dark:text-white">
                            
                            <div class="px-3 py-2 border-b border-slate-100 dark:border-slate-800 mb-2">
                                <p class="text-xs font-bold text-slate-900 dark:text-white truncate" x-text="currentUser.nome"></p>
                                <p class="text-[11px] text-slate-500 dark:text-slate-400 truncate" x-text="currentUser.email"></p>
                                <div class="mt-1 flex items-center justify-between text-[10px]">
                                    <span class="text-[#0050f0] dark:text-[#f5a800] font-mono font-bold" x-text="'ID #' + (currentUser.aluno_id || currentUser.id)"></span>
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-50 dark:bg-emerald-500/20 text-emerald-600 dark:text-emerald-400 border border-emerald-200 font-bold">Aluno Ativo</span>
                                </div>
                            </div>

                            <div class="space-y-1 text-xs">
                                <button @click="activeMainTab = 'certificados'; profileMenuOpen = false" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition text-left cursor-pointer">
                                    <i data-lucide="award" class="w-4 h-4 text-[#f5a800]"></i>
                                    Meus Certificados
                                </button>
                                <button @click="accessLogsModal = true; profileMenuOpen = false" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition text-left cursor-pointer">
                                    <i data-lucide="shield-check" class="w-4 h-4 text-[#00a3e0]"></i>
                                    Histórico de Acessos
                                </button>
                                <a href="/academy" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition text-left">
                                    <i data-lucide="compass" class="w-4 h-4 text-[#0050f0]"></i>
                                    Catálogo de Cursos
                                </a>
                                <a href="/" class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10 transition text-left">
                                    <i data-lucide="home" class="w-4 h-4 text-slate-400"></i>
                                    Portal Principal RACHI
                                </a>
                            </div>

                            <div class="mt-2 pt-2 border-t border-slate-100 dark:border-slate-800">
                                <button @click="logout()" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-rose-600 dark:text-rose-400 hover:bg-rose-50 dark:hover:bg-rose-500/10 transition text-xs font-semibold text-left cursor-pointer">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    Sair da Minha Conta
                                </button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </header>

    <!-- ================================================================ -->
    <!-- CORPO PRINCIPAL COM SIDEBAR LATERAL (MODELO ALURA)               -->
    <!-- ================================================================ -->
    <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6 flex gap-6 lg:gap-8 items-start">

        <!-- Mobile Backdrop Overlay -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-cloak 
             x-transition:enter="transition-opacity ease-linear duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-950/60 z-40 lg:hidden backdrop-blur-xs"></div>

        <!-- ============================================================ -->
        <!-- MENU LATERAL ESQUERDO (SIDEBAR ALURA)                        -->
        <!-- ============================================================ -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
               class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-[#090f1d] lg:bg-transparent lg:dark:bg-transparent p-5 lg:p-0 border-r lg:border-r-0 border-slate-200 dark:border-white/10 lg:sticky lg:top-24 lg:z-10 lg:w-60 xl:w-64 shrink-0 transition-transform duration-300 ease-in-out overflow-y-auto lg:overflow-visible">
            
            <!-- Mobile Close Button -->
            <div class="flex items-center justify-between mb-4 lg:hidden">
                <span class="font-heading font-black text-sm text-slate-900 dark:text-white uppercase tracking-wider">Navegação</span>
                <button @click="sidebarOpen = false" class="p-1 rounded-lg text-slate-400 hover:text-slate-700">✕</button>
            </div>

            <div class="space-y-4">
                
                <!-- Lista de Menus Superiores (Alura Style) -->
                <nav class="space-y-1">
                    
                    <!-- 1. Início (Ativo: card branco com sombra sutil) -->
                    <button @click="activeMainTab = 'dashboard'; sidebarOpen = false" 
                            :class="activeMainTab === 'dashboard' ? 'bg-white dark:bg-[#0c1427] text-slate-900 dark:text-white font-bold shadow-xs border border-slate-200/80 dark:border-white/10' : 'text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-200/60 dark:hover:bg-white/5 font-medium'"
                            class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm transition cursor-pointer text-left">
                        <i data-lucide="home" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                        <span>Início</span>
                    </button>

                    <!-- 2. Modo Entrevista (Com badge NOVO azul) -->
                    <button @click="interviewModalOpen = true; sidebarOpen = false" 
                            class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-200/60 dark:hover:bg-white/5 font-medium transition cursor-pointer text-left group">
                        <div class="flex items-center gap-3">
                            <i data-lucide="sparkles" class="w-4 h-4 text-blue-500"></i>
                            <span>Modo Entrevista</span>
                        </div>
                        <span class="bg-[#0050f0] text-white text-[9px] font-extrabold px-2 py-0.5 rounded-full uppercase tracking-wider shadow-xs">
                            NOVO
                        </span>
                    </button>

                    <!-- 3. Carreira -->
                    <button @click="activeMainTab = 'formacoes'; sidebarOpen = false" 
                            :class="activeMainTab === 'formacoes' ? 'bg-white dark:bg-[#0c1427] text-slate-900 dark:text-white font-bold shadow-xs border border-slate-200/80 dark:border-white/10' : 'text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-200/60 dark:hover:bg-white/5 font-medium'"
                            class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm transition cursor-pointer text-left">
                        <i data-lucide="layers" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                        <span>Carreira</span>
                    </button>

                    <!-- 4. Cursos e Certificados -->
                    <button @click="activeMainTab = 'certificados'; sidebarOpen = false" 
                            :class="activeMainTab === 'certificados' ? 'bg-white dark:bg-[#0c1427] text-slate-900 dark:text-white font-bold shadow-xs border border-slate-200/80 dark:border-white/10' : 'text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-200/60 dark:hover:bg-white/5 font-medium'"
                            class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm transition cursor-pointer text-left">
                        <i data-lucide="award" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                        <span>Cursos e Certificados</span>
                    </button>

                    <!-- 5. Meus Livros -->
                    <button @click="booksModalOpen = true; sidebarOpen = false" 
                            class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-200/60 dark:hover:bg-white/5 font-medium transition cursor-pointer text-left">
                        <i data-lucide="book-open" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                        <span>Meus Livros</span>
                    </button>

                    <!-- 6. Minhas Trilhas -->
                    <button @click="activeMainTab = 'formacoes'; sidebarOpen = false" 
                            class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-200/60 dark:hover:bg-white/5 font-medium transition cursor-pointer text-left">
                        <i data-lucide="git-fork" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                        <span>Minhas Trilhas</span>
                    </button>

                    <!-- 7. Eventos -->
                    <button @click="eventsModalOpen = true; sidebarOpen = false" 
                            class="w-full flex items-center gap-3 px-3.5 py-2.5 rounded-xl text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-200/60 dark:hover:bg-white/5 font-medium transition cursor-pointer text-left">
                        <i data-lucide="calendar" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                        <span>Eventos</span>
                    </button>

                </nav>

                <!-- Divisor Sutil -->
                <div class="h-px bg-slate-200 dark:bg-white/10 my-2"></div>

                <!-- Seção Colapsável / Itens Secundários (Alura Style) -->
                <div class="space-y-2">

                    <!-- Lembretes (com card e botão "Ver eventos") -->
                    <div class="space-y-2">
                        <button @click="remindersOpen = !remindersOpen" 
                                class="w-full flex items-center justify-between px-3.5 py-2 rounded-xl text-xs sm:text-sm text-slate-600 dark:text-slate-300 hover:text-slate-950 dark:hover:text-white hover:bg-slate-200/60 dark:hover:bg-white/5 font-medium transition cursor-pointer text-left">
                            <div class="flex items-center gap-3">
                                <i data-lucide="bell" class="w-4 h-4 text-slate-500 dark:text-slate-400"></i>
                                <span>Lembretes</span>
                            </div>
                            <i data-lucide="chevron-up" class="w-3.5 h-3.5 text-slate-400 transition-transform duration-200" :class="remindersOpen ? '' : 'rotate-180'"></i>
                        </button>

                        <div x-show="remindersOpen" x-cloak class="px-3.5 py-2 text-xs text-slate-500 dark:text-slate-400 space-y-2.5">
                            <p class="leading-relaxed text-[11px]">
                                Explore a agenda de eventos e ative o lembrete daqueles que mais te interessam!
                            </p>
                            <button @click="eventsModalOpen = true" 
                                    class="w-full py-1.5 px-3 rounded-full bg-white dark:bg-[#0c1427] border border-slate-200 dark:border-white/15 text-slate-700 dark:text-slate-200 text-xs font-semibold hover:bg-slate-50 dark:hover:bg-white/5 transition shadow-2xs cursor-pointer text-center">
                                Ver eventos
                            </button>
                        </div>
                    </div>

                </div>

            </div>
        </aside>

        <!-- Backdrop para Mobile -->
        <div x-show="sidebarOpen" 
             @click="sidebarOpen = false" 
             x-cloak 
             class="fixed inset-0 bg-slate-900/50 backdrop-blur-xs z-40 lg:hidden"></div>

        <!-- ============================================================ -->
        <!-- ÁREA CENTRAL DE CONTEÚDO                                     -->
        <!-- ============================================================ -->
        <main class="flex-1 min-w-0 space-y-6">

            <!-- ======================================================== -->
            <!-- VIEW: DASHBOARD INICIAL (MODELO ALURA)                   -->
            <!-- ======================================================== -->
            <div x-show="activeMainTab === 'dashboard'" class="space-y-6">

                <!-- 1. INDICADOR: ● CURSO EM ANDAMENTO (ALURA STYLE) -->
                <div>
                    <div class="flex items-center gap-2 text-xs font-extrabold uppercase tracking-wider text-slate-600 dark:text-slate-400 mb-3">
                        <span class="w-2.5 h-2.5 rounded-full bg-[#10b981] animate-pulse"></span>
                        <span>CURSO EM ANDAMENTO</span>
                    </div>

                    <!-- 2. CARD HERO DO CURSO EM ANDAMENTO (MODELO ALURA) -->
                    <div class="bg-white dark:bg-[#0b1220] border border-slate-200/90 dark:border-white/10 rounded-2xl lg:rounded-3xl shadow-xs overflow-hidden flex flex-col md:flex-row items-stretch transition-colors">
                        
                        <!-- Coluna Esquerda: Título do Curso, Imagem de Capa, Botão "Continuar onde parou" e Aula Atual -->
                        <div class="flex-1 p-6 sm:p-8 flex flex-col justify-between">
                            
                            <div>
                                <div class="flex items-start gap-4">
                                    <!-- Imagem / Thumbnail sincronizada do Curso -->
                                    <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-2xl overflow-hidden shrink-0 border border-slate-200/80 dark:border-white/10 shadow-sm relative bg-slate-900">
                                        <img :src="activeCourse?.imagem || activeCourse?.thumbnail || ('/images/courses/' + activeCourse?.slug + '.jpg')" 
                                             :alt="activeCourse?.nome" 
                                             class="w-full h-full object-cover"
                                             onerror="this.src='/images/areas/rachi-academy.png'">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <span class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-blue-50 dark:bg-blue-500/10 text-[#0050f0] dark:text-blue-400 border border-blue-200 dark:border-blue-500/20"
                                              x-text="activeCourse?.categoria || 'Formação RACHI Academy'"></span>
                                        <h1 class="text-lg sm:text-xl lg:text-2xl font-heading font-black text-slate-900 dark:text-white leading-tight mt-1 line-clamp-2">
                                            <span class="block text-slate-950 dark:text-white" x-text="activeCourse?.nome || 'Cibersegurança: Defesa, Segurança da Informação e Redes'"></span>
                                        </h1>
                                        <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1 line-clamp-2" x-text="activeCourse?.descricao"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Linha de Ação: Botão Azul + Texto da Aula Atual (Alura Exact Style) -->
                            <div class="mt-6 pt-2 flex flex-wrap items-center gap-4 sm:gap-6">
                                <button @click="openClassroom(activeCourse || enrolledCourses[0])" 
                                        class="px-5 py-2.5 rounded-xl bg-[#0050f0] hover:bg-[#0042c7] active:bg-[#0038a8] text-white font-bold text-xs sm:text-sm tracking-wide flex items-center gap-2.5 shadow-sm hover:shadow transition transform hover:-translate-y-0.5 cursor-pointer">
                                    <i data-lucide="play-circle" class="w-4 h-4 fill-white text-[#0050f0]"></i>
                                    <span>Continuar onde parou</span>
                                </button>

                                <div class="text-xs sm:text-sm text-slate-600 dark:text-slate-400 font-mono sm:font-sans">
                                    <span class="font-medium">Aula atual:</span> 
                                    <span class="text-slate-800 dark:text-slate-300 font-semibold" x-text="(activeLesson?.titulo || 'Fundamentos da Defesa Ativa') + (activeLesson?.duracao ? ' - ' + activeLesson?.duracao : '')"></span>
                                </div>
                            </div>

                        </div>

                        <!-- Coluna Direita: Box Lilás / Azul Claro com Donut Circular de Progresso 91% (Alura Style) -->
                        <div class="w-full md:w-64 lg:w-72 bg-[#eef2ff] dark:bg-[#0e1935] p-6 sm:p-8 flex items-center justify-center border-t md:border-t-0 md:border-l border-slate-100 dark:border-white/5 shrink-0">
                            
                            <!-- Donut Circular Progress Gauge -->
                            <div class="relative w-28 h-28 sm:w-32 sm:h-32 flex items-center justify-center">
                                <svg class="w-full h-full transform -rotate-90" viewBox="0 0 100 100">
                                    <!-- Círculo de Fundo (Track Cinza Claro) -->
                                    <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="6.5" fill="transparent" class="text-slate-200 dark:text-slate-700/60" />
                                    <!-- Círculo de Progresso Verde Alura (#10b981) -->
                                    <circle cx="50" cy="50" r="40" 
                                            stroke="#10b981" 
                                            stroke-width="6.5" 
                                            stroke-linecap="round" 
                                            fill="transparent"
                                            :stroke-dasharray="2 * Math.PI * 40"
                                            :stroke-dashoffset="2 * Math.PI * 40 * (1 - (activeCourse?.progresso || 75) / 100)"
                                            class="transition-all duration-1000 ease-out" />
                                </svg>
                                
                                <!-- Porcentagem Central -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <span class="text-2xl sm:text-3xl font-extrabold font-heading text-slate-800 dark:text-white" 
                                          x-text="(activeCourse?.progresso || 75) + '%'"></span>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>


                <!-- 4. MEUS CURSOS: Grade com Filtros -->
                <section>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                        <div>
                            <h2 class="text-lg sm:text-xl font-heading font-extrabold text-slate-900 dark:text-white">Meus Cursos</h2>
                            <p class="text-xs text-slate-500 dark:text-slate-400">Acesse seus cursos e continue de onde parou</p>
                        </div>

                        <!-- Filtros -->
                        <div class="flex items-center gap-1 bg-white dark:bg-[#0b1220] p-1 rounded-xl border border-slate-200 dark:border-white/10 text-xs self-start shadow-2xs">
                            <button @click="courseFilter = 'all'" 
                                    :class="courseFilter === 'all' ? 'bg-[#0050f0] text-white font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 font-medium'"
                                    class="px-3 py-1.5 rounded-lg transition cursor-pointer">
                                Todos (<span x-text="enrolledCourses.length"></span>)
                            </button>
                            <button @click="courseFilter = 'active'" 
                                    :class="courseFilter === 'active' ? 'bg-[#0050f0] text-white font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 font-medium'"
                                    class="px-3 py-1.5 rounded-lg transition cursor-pointer">
                                Em Andamento
                            </button>
                            <button @click="courseFilter = 'completed'" 
                                    :class="courseFilter === 'completed' ? 'bg-[#0050f0] text-white font-bold' : 'text-slate-600 dark:text-slate-400 hover:text-slate-950 font-medium'"
                                    class="px-3 py-1.5 rounded-lg transition cursor-pointer">
                                Concluídos
                            </button>
                        </div>
                    </div>

                    <!-- Cards de Cursos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                        <template x-for="curso in filteredEnrolledCourses" :key="curso.id">
                            <div class="bg-white dark:bg-[#0b1220] border border-slate-200/90 dark:border-white/10 rounded-2xl overflow-hidden hover:shadow-lg transition-all flex flex-col justify-between group shadow-2xs">
                                
                                <!-- Topo com a Imagem Real do Curso Sincronizada -->
                                <div class="h-32 p-4 flex flex-col justify-between relative overflow-hidden group/card-top">
                                    <!-- Imagem real da capa do curso cadastrado -->
                                    <img :src="curso.imagem || curso.thumbnail || ('/images/courses/' + curso.slug + '.jpg')" 
                                         :alt="curso.nome"
                                         class="absolute inset-0 w-full h-full object-cover z-0 transition-transform duration-500 group-hover:scale-105"
                                         onerror="this.style.display='none'">
                                    
                                    <!-- Filtro de Gradiente para garantir legibilidade de alto contraste -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950/95 via-slate-950/65 to-slate-950/40 z-10"
                                         :class="curso.gradientClass ? curso.gradientClass + ' opacity-50 mix-blend-multiply' : ''"></div>

                                    <div class="relative z-20 flex items-center justify-between">
                                        <span class="text-[10px] font-extrabold uppercase tracking-wider px-2.5 py-0.5 rounded-full bg-slate-950/80 text-white border border-white/20 backdrop-blur-xs"
                                              x-text="curso.categoria"></span>
                                        <span :class="curso.progresso === 100 ? 'bg-emerald-500 text-white' : 'bg-white/95 text-slate-900'"
                                              class="text-[10px] font-bold px-2.5 py-0.5 rounded-full shadow-xs"
                                              x-text="curso.progresso === 100 ? '✓ Concluído' : curso.progresso + '%'"></span>
                                    </div>
                                    <div class="relative z-20 text-white font-semibold text-xs flex items-center justify-between drop-shadow-md">
                                        <span class="flex items-center gap-1 font-mono text-[11px]">
                                            <i data-lucide="clock" class="w-3.5 h-3.5 text-sky-400"></i>
                                            <span x-text="curso.duracao"></span>
                                        </span>
                                        <span class="text-[11px] bg-black/50 px-2 py-0.5 rounded-md backdrop-blur-xs border border-white/10" 
                                              x-text="curso.aulasConcluidas + ' / ' + curso.totalAulas + ' aulas'"></span>
                                    </div>
                                </div>

                                <div class="p-4 sm:p-5 flex-1 flex flex-col justify-between">
                                    <div>
                                        <h3 class="text-sm sm:text-base font-bold text-slate-900 dark:text-white font-heading group-hover:text-[#0050f0] transition line-clamp-1" x-text="curso.nome"></h3>
                                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 line-clamp-2 leading-relaxed" x-text="curso.descricao"></p>
                                    </div>

                                    <div class="mt-4 pt-3 border-t border-slate-100 dark:border-white/5">
                                        <div class="w-full bg-slate-100 dark:bg-white/10 rounded-full h-2 overflow-hidden mb-3">
                                            <div class="bg-[#10b981] h-full rounded-full transition-all duration-500" :style="'width: ' + curso.progresso + '%'"></div>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <button @click="openClassroom(curso)" 
                                                    class="flex-1 py-2 rounded-xl bg-[#0050f0] hover:bg-[#0042c7] text-white font-bold text-xs transition flex items-center justify-center gap-1.5 shadow-2xs cursor-pointer">
                                                <i data-lucide="play" class="w-3.5 h-3.5 fill-white"></i>
                                                <span x-text="curso.progresso === 100 ? 'Rever Curso' : 'Continuar'"></span>
                                            </button>
                                            <button @click="openCourseDetails(curso)" 
                                                    class="p-2 rounded-xl bg-slate-100 dark:bg-white/5 hover:bg-slate-200 text-slate-600 dark:text-slate-300 transition cursor-pointer" title="Ver Ementa">
                                                <i data-lucide="list" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </template>
                    </div>
                </section>


            </div>

            <!-- ======================================================== -->
            <!-- VIEW: FORMAÇÕES / CARREIRA                              -->
            <!-- ======================================================== -->
            <div x-show="activeMainTab === 'formacoes'" x-cloak class="space-y-6">
                <div class="bg-white dark:bg-[#0b1220] border border-slate-200/90 dark:border-white/10 rounded-2xl p-6 shadow-xs">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-[#0050f0] bg-blue-50 dark:bg-blue-500/10 px-2.5 py-1 rounded-full border border-blue-200 dark:border-blue-500/20">
                        Carreira &amp; Trilhas de Formação
                    </span>
                    <h1 class="text-2xl font-heading font-black text-slate-900 dark:text-white mt-2">Formações RACHI Academy</h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">Guias estruturados para você avançar do zero ao nível sênior com certificação oficial.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="formation in formations" :key="formation.id">
                        <div class="bg-white dark:bg-[#0b1220] border border-slate-200/90 dark:border-white/10 rounded-2xl p-6 shadow-xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-3">
                                    <span class="text-3xl" x-text="formation.icon"></span>
                                    <span class="text-xs font-bold px-3 py-1 rounded-full bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-300" x-text="formation.totalHours + ' Horas Totais'"></span>
                                </div>
                                <h3 class="text-base sm:text-lg font-heading font-bold text-slate-900 dark:text-white" x-text="formation.title"></h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1.5" x-text="formation.description"></p>

                                <div class="mt-4 space-y-2">
                                    <span class="text-[11px] font-bold uppercase tracking-wider text-slate-400">Cursos desta Formação:</span>
                                    <template x-for="(cName, idx) in formation.coursesList" :key="idx">
                                        <div class="flex items-center gap-2 text-xs text-slate-700 dark:text-slate-300 bg-slate-50 dark:bg-white/[0.03] p-2.5 rounded-xl border border-slate-200/60 dark:border-white/5">
                                            <span class="w-5 h-5 rounded-full bg-[#0050f0] text-white flex items-center justify-center text-[10px] font-bold shrink-0" x-text="idx + 1"></span>
                                            <span class="flex-1 truncate font-medium" x-text="cName"></span>
                                            <span class="text-[10px] text-emerald-700 font-bold bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-200" x-show="idx < formation.completedCourses">Concluído</span>
                                        </div>
                                    </template>
                                </div>
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5">
                                <div class="flex items-center justify-between text-xs text-slate-500 mb-1.5 font-medium">
                                    <span>Progresso da Trilha</span>
                                    <span class="font-bold text-slate-900 dark:text-white" x-text="formation.progress + '%'"></span>
                                </div>
                                <div class="w-full bg-slate-100 dark:bg-white/10 rounded-full h-2 overflow-hidden">
                                    <div class="bg-[#10b981] h-full rounded-full" :style="'width: ' + formation.progress + '%'"></div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- ======================================================== -->
            <!-- VIEW: CERTIFICADOS                                      -->
            <!-- ======================================================== -->
            <div x-show="activeMainTab === 'certificados'" x-cloak class="space-y-6">
                <div class="bg-white dark:bg-[#0b1220] border border-slate-200/90 dark:border-white/10 rounded-2xl p-6 shadow-xs">
                    <span class="text-[10px] font-extrabold uppercase tracking-wider text-amber-700 bg-amber-50 dark:bg-amber-500/10 px-2.5 py-1 rounded-full border border-amber-200 dark:border-amber-500/20">
                        Validação Criptográfica Oficial
                    </span>
                    <h1 class="text-2xl font-heading font-black text-slate-900 dark:text-white mt-2">Meus Certificados Oficiais</h1>
                    <p class="text-xs sm:text-sm text-slate-500 dark:text-slate-400 mt-1">Emita e imprima seus certificados de conclusão com código de autenticidade oficial.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <template x-for="curso in enrolledCourses" :key="curso.id">
                        <div class="bg-white dark:bg-[#0b1220] border border-slate-200/90 dark:border-white/10 rounded-2xl p-6 shadow-xs flex flex-col justify-between">
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-mono font-semibold text-slate-400" x-text="curso.duracao"></span>
                                    <span :class="curso.progresso === 100 ? 'bg-emerald-50 text-emerald-700 border-emerald-200 font-bold' : 'bg-slate-100 text-slate-600 border-slate-200 font-medium'"
                                          class="text-[10px] px-2.5 py-0.5 rounded-full border"
                                          x-text="curso.progresso === 100 ? 'Disponível para Emissão' : 'Em Curso (' + curso.progresso + '%)'"></span>
                                </div>
                                <h3 class="text-base font-heading font-bold text-slate-900 dark:text-white" x-text="curso.nome"></h3>
                                <p class="text-xs text-slate-500 dark:text-slate-400 mt-1" x-text="curso.descricao"></p>
                            </div>

                            <div class="mt-6 pt-4 border-t border-slate-100 dark:border-white/5 flex items-center justify-between">
                                <template x-if="curso.progresso === 100">
                                    <button @click="openCertificateModal(curso)" 
                                            class="w-full py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-extrabold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition shadow-xs cursor-pointer">
                                        <i data-lucide="award" class="w-4 h-4"></i>
                                        Visualizar e Imprimir Certificado
                                    </button>
                                </template>
                                <template x-if="curso.progresso < 100">
                                    <div class="w-full flex items-center justify-between text-xs text-slate-500">
                                        <span>Conclua o curso para desbloquear</span>
                                        <button @click="openClassroom(curso)" class="text-[#0050f0] font-bold hover:underline cursor-pointer">
                                            Continuar aula →
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </main>

    </div>

    <!-- ================================================================ -->
    <!-- MODAIS DO DASHBOARD                                              -->
    <!-- ================================================================ -->

    <!-- 1. SALA DE AULA INTERATIVA / PLAYER -->
    <div x-show="classroomModal" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/80 backdrop-blur-md flex flex-col">
        
        <header class="w-full bg-white dark:bg-[#0a0e1c] border-b border-slate-200 dark:border-white/10 px-4 sm:px-6 py-3 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <button @click="classroomModal = false" class="p-2 rounded-lg bg-slate-100 hover:bg-slate-200 text-slate-700 dark:bg-white/5 dark:hover:bg-white/10 dark:text-slate-300 transition cursor-pointer">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </button>
                <div>
                    <span class="text-[10px] uppercase font-bold text-[#0050f0] dark:text-[#00a3e0] tracking-wider" x-text="activeCourse?.nome"></span>
                    <h2 class="text-xs sm:text-sm font-bold text-slate-900 dark:text-white truncate max-w-md sm:max-w-xl" x-text="activeLesson?.titulo"></h2>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button @click="toggleLessonStatus(activeLesson)" 
                        :class="activeLesson?.concluida ? 'bg-emerald-500 text-white hover:bg-emerald-600' : 'bg-[#0050f0] text-white hover:bg-[#0042c7]'"
                        class="px-4 py-2 rounded-xl font-bold text-xs uppercase tracking-wider transition flex items-center gap-1.5 shadow-sm cursor-pointer">
                    <span x-show="activeLesson?.concluida">✓ Aula Concluída</span>
                    <span x-show="!activeLesson?.concluida">Marcar como Concluída</span>
                </button>

                <button @click="classroomModal = false" class="p-2 rounded-lg text-slate-500 hover:text-slate-800 dark:text-slate-400 dark:hover:text-white cursor-pointer font-bold">✕</button>
            </div>
        </header>

        <div class="flex-1 flex flex-col lg:flex-row overflow-hidden bg-slate-900">
            <!-- Video Stage -->
            <div class="flex-1 flex flex-col justify-between p-4 sm:p-6 bg-black relative">
                <div class="relative w-full aspect-video max-h-[70vh] mx-auto bg-slate-950 rounded-2xl overflow-hidden flex items-center justify-center border border-white/10 shadow-2xl">
                    <div class="text-center p-6 space-y-4">
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-full bg-[#0050f0]/30 border border-[#0050f0] text-white flex items-center justify-center mx-auto shadow-2xl cursor-pointer hover:scale-105 transition"
                             @click="isPlaying = !isPlaying">
                            <i data-lucide="play" class="w-8 h-8 fill-white ml-1"></i>
                        </div>
                        <div>
                            <h3 class="text-white font-bold text-sm sm:text-base font-heading" x-text="activeLesson?.titulo"></h3>
                            <p class="text-xs text-slate-400 mt-1">Instrutor: Especialista Corporativo RACHI Academy</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 flex items-center justify-between text-xs text-slate-400">
                    <span x-text="'Duração estimada: ' + (activeLesson?.duracao || '30min')"></span>
                    <button @click="toggleLessonStatus(activeLesson)" class="text-[#00a3e0] hover:underline cursor-pointer">Avançar para a próxima aula →</button>
                </div>
            </div>

            <!-- Modules Sidebar -->
            <div class="w-full lg:w-96 bg-white dark:bg-[#0c1220] border-l border-slate-200 dark:border-white/10 p-4 sm:p-5 overflow-y-auto">
                <div class="flex items-center justify-between mb-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-600 dark:text-slate-400">Ementa do Curso</h3>
                    <span class="text-xs font-bold text-[#0050f0]" x-text="(activeCourse?.progresso || 0) + '% Concluído'"></span>
                </div>

                <div class="space-y-4">
                    <template x-for="(modulo, mIdx) in activeCourse?.modulos" :key="modulo.id">
                        <div class="space-y-1.5">
                            <div class="text-[11px] font-bold text-slate-600 dark:text-slate-400 uppercase tracking-wider px-2 py-1 bg-slate-100 dark:bg-white/[0.02] rounded" x-text="modulo.nome"></div>
                            <div class="space-y-1">
                                <template x-for="aula in modulo.aulas" :key="aula.id">
                                    <button @click="selectLessonInPlayer(aula)" 
                                            :class="activeLesson?.id === aula.id ? 'bg-blue-50 border-blue-300 text-[#0050f0] font-bold dark:bg-[#0050f0]/25 dark:border-[#0050f0]/60 dark:text-white' : 'hover:bg-slate-100 text-slate-700 dark:hover:bg-white/5 dark:text-slate-300 border-transparent'"
                                            class="w-full text-left p-2.5 rounded-xl border transition flex items-center justify-between gap-2 text-xs group cursor-pointer">
                                        <div class="flex items-center gap-2 min-w-0">
                                            <input type="checkbox" 
                                                   :checked="aula.concluida" 
                                                   @click.stop="toggleLessonStatus(aula)" 
                                                   class="w-4 h-4 rounded text-[#0050f0] cursor-pointer">
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
        </div>

    </div>

    <!-- 2. MODAL: CERTIFICADO OFICIAL -->
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

            <div id="printable-certificate" class="bg-gradient-to-br from-[#faf8f2] via-[#ffffff] to-[#f7f4ec] border-4 border-double border-amber-500/50 rounded-2xl p-8 sm:p-10 text-center relative overflow-hidden shadow-lg">
                <div class="relative z-10 space-y-5">
                    <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='/images/logo-rachi.png'" alt="RACHI" class="h-9 mx-auto object-contain">
                    <div class="text-[11px] font-bold uppercase tracking-widest text-amber-800">
                        CERTIFICADO OFICIAL DE CONCLUSÃO E CAPACITAÇÃO EXECUTIVA
                    </div>
                    <p class="text-xs text-slate-600">Certificamos com distinção de mérito acadêmico que:</p>
                    <h2 class="text-2xl sm:text-3xl font-heading font-extrabold text-slate-950 tracking-wide underline decoration-amber-500/60 underline-offset-8" 
                        x-text="currentUser.nome"></h2>
                    <p class="text-xs text-slate-700 max-w-lg mx-auto leading-relaxed">
                        Concluiu com aproveitamento integral o programa em 
                        <strong class="text-[#0050f0]" x-text="certificateCourse?.nome"></strong>, com carga horária de 
                        <strong class="text-slate-900" x-text="certificateCourse?.duracao || '40 Horas'"></strong>.
                    </p>
                    <div class="pt-6 border-t border-slate-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-500">
                        <div class="text-left">
                            <div class="text-[10px] uppercase font-bold text-slate-400">CÓDIGO DE AUTENTICIDADE</div>
                            <div class="font-mono text-amber-700 font-bold text-xs" x-text="'RACHI-CERT-' + (currentUser.aluno_id || '104') + '-' + (certificateCourse?.id || '1') + '-2026'"></div>
                        </div>
                        <div class="text-right">
                            <div class="text-[10px] uppercase font-bold text-slate-400">DATA DE EMISSÃO</div>
                            <div class="text-slate-800 font-semibold" x-text="new Date().toLocaleDateString('pt-AO')"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 no-print pt-2">
                <button @click="certificateModalOpen = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 text-slate-700 dark:text-slate-200 text-xs font-semibold cursor-pointer">
                    Fechar
                </button>
                <button @click="window.print()" class="px-5 py-2.5 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-xs uppercase tracking-wider transition flex items-center gap-2 shadow-sm cursor-pointer">
                    <i data-lucide="printer" class="w-4 h-4"></i>
                    Imprimir / PDF
                </button>
            </div>
        </div>

    </div>

    <!-- 3. MODAL: MODO ENTREVISTA -->
    <div x-show="interviewModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="max-w-xl w-full bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl p-6 space-y-4 shadow-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-[#0050f0]">
                    <i data-lucide="sparkles" class="w-5 h-5"></i>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Modo Entrevista Técnica (IA)</h3>
                </div>
                <button @click="interviewModalOpen = false" class="text-slate-400 hover:text-slate-600 text-sm font-bold cursor-pointer">✕</button>
            </div>
            <p class="text-xs text-slate-600 dark:text-slate-300 leading-relaxed">
                Pratique entrevistas reais simuladas com perguntas técnicas de TI, Cibersegurança, Finanças e Gestão Corporativa com feedbacks em tempo real.
            </p>
            <div class="bg-blue-50 dark:bg-blue-500/10 p-4 rounded-xl border border-blue-200 dark:border-blue-500/20 text-xs space-y-2">
                <div class="font-bold text-blue-900 dark:text-blue-300">Próxima Simulação Disponível:</div>
                <p class="text-slate-700 dark:text-slate-300">Vaga: Analista de Cibersegurança e Defesa de Redes Jr/Pl</p>
            </div>
            <div class="flex justify-end gap-2 pt-2">
                <button @click="interviewModalOpen = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 text-xs font-semibold cursor-pointer">Fechar</button>
                <button @click="toastMessage('Simulador de Entrevista iniciado com sucesso!', 'Modo Entrevista'); interviewModalOpen = false;" class="px-4 py-2 rounded-xl bg-[#0050f0] text-white text-xs font-bold cursor-pointer">Iniciar Simulação</button>
            </div>
        </div>
    </div>

    <!-- 4. MODAL: MEUS LIVROS / MATERIAL DIDÁTICO -->
    <div x-show="booksModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="max-w-xl w-full bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl p-6 space-y-4 shadow-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-[#0050f0]">
                    <i data-lucide="book-open" class="w-5 h-5"></i>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Meus Livros &amp; Apostilas</h3>
                </div>
                <button @click="booksModalOpen = false" class="text-slate-400 hover:text-slate-600 text-sm font-bold cursor-pointer">✕</button>
            </div>
            <p class="text-xs text-slate-600 dark:text-slate-300">Acesse e faça download das apostilas oficiais, guias práticos e referências bibliográficas do seu curso:</p>
            <div class="space-y-2 text-xs">
                <div class="p-3 bg-slate-50 dark:bg-white/[0.03] rounded-xl border border-slate-200 dark:border-white/5 flex items-center justify-between">
                    <div>
                        <span class="font-bold text-slate-900 dark:text-white block">Manual de Cibersegurança &amp; Defesa Ativa</span>
                        <span class="text-[11px] text-slate-500">PDF • 140 páginas • RACHI Academy Press</span>
                    </div>
                    <button @click="toastMessage('Download do livro iniciado...', 'Download')" class="px-3 py-1.5 rounded-lg bg-blue-50 text-[#0050f0] font-bold border border-blue-200">Baixar</button>
                </div>
                <div class="p-3 bg-slate-50 dark:bg-white/[0.03] rounded-xl border border-slate-200 dark:border-white/5 flex items-center justify-between">
                    <div>
                        <span class="font-bold text-slate-900 dark:text-white block">Guia de Redes e Arquitetura Cliente-Servidor</span>
                        <span class="text-[11px] text-slate-500">PDF • 95 páginas • RACHI Academy Press</span>
                    </div>
                    <button @click="toastMessage('Download do livro iniciado...', 'Download')" class="px-3 py-1.5 rounded-lg bg-blue-50 text-[#0050f0] font-bold border border-blue-200">Baixar</button>
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button @click="booksModalOpen = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 text-xs font-semibold cursor-pointer">Fechar</button>
            </div>
        </div>
    </div>

    <!-- 5. MODAL: EVENTOS -->
    <div x-show="eventsModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 overflow-y-auto bg-slate-950/70 backdrop-blur-sm flex items-center justify-center p-4">
        <div class="max-w-xl w-full bg-white dark:bg-[#0c1220] border border-slate-200 dark:border-white/10 rounded-2xl p-6 space-y-4 shadow-2xl">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2 text-[#0050f0]">
                    <i data-lucide="calendar" class="w-5 h-5"></i>
                    <h3 class="text-base font-bold text-slate-900 dark:text-white">Agenda de Eventos e Mentorias</h3>
                </div>
                <button @click="eventsModalOpen = false" class="text-slate-400 hover:text-slate-600 text-sm font-bold cursor-pointer">✕</button>
            </div>
            <div class="space-y-3 text-xs">
                <div class="p-3.5 bg-slate-50 dark:bg-white/[0.03] rounded-xl border border-slate-200 dark:border-white/5 flex items-center justify-between">
                    <div>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase bg-emerald-50 px-2 py-0.5 rounded">Próxima Quinta • 18:00</span>
                        <h4 class="font-bold text-slate-900 dark:text-white mt-1">Live Coding: Análise Forense de Incidentes de Segurança</h4>
                    </div>
                    <button @click="toastMessage('Lembrete ativado no seu calendário!', 'Lembretes')" class="px-3 py-1.5 rounded-lg bg-[#0050f0] text-white font-bold">Lembrar-me</button>
                </div>
            </div>
            <div class="flex justify-end pt-2">
                <button @click="eventsModalOpen = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 text-xs font-semibold cursor-pointer">Fechar</button>
            </div>
        </div>
    </div>



    <!-- 7. MODAL: HISTÓRICO DE ACESSOS -->
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
                    <thead class="bg-slate-50 dark:bg-white/[0.04] text-[11px] uppercase font-bold text-slate-500 border-b border-slate-200 dark:border-white/10">
                        <tr>
                            <th class="p-3">Data</th>
                            <th class="p-3">Horário</th>
                            <th class="p-3">Endereço IP</th>
                            <th class="p-3">Dispositivo</th>
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
                <button @click="accessLogsModal = false" class="px-4 py-2 rounded-xl bg-slate-100 dark:bg-white/10 text-xs font-semibold cursor-pointer">Fechar</button>
            </div>
        </div>
    </div>

    <!-- ================================================================ -->
    <!-- JAVASCRIPT: ALPINE APP DO DASHBOARD DO ALUNO                     -->
    <!-- ================================================================ -->
    <script>
        const serverAllCourses = @json($allCourses ?? []);
        const serverEnrolledCourses = @json($enrolledCourses ?? []);
        const serverCurrentUser = @json($currentUser ?? null);

        function alunoDashboardApp() {
            return {
                activeMainTab: 'dashboard',
                courseFilter: 'all',
                searchQuery: '',
                searchOpen: false,
                profileMenuOpen: false,
                sidebarOpen: false,
                remindersOpen: true,
                interviewModalOpen: false,
                booksModalOpen: false,
                eventsModalOpen: false,
                classroomModal: false,
                certificateModalOpen: false,
                accessLogsModal: false,
                isPlaying: false,
                
                toast: { visible: false, title: '', message: '' },

                currentUser: serverCurrentUser || {
                    id: 25,
                    aluno_id: 104,
                    nome: 'Casimiro Gundja',
                    email: 'casimirogundja@outlook.com',
                    tipo: 'aluno',
                    status: 'ativo'
                },

                studentStats: {
                    streakDays: 5,
                    xp: 1850,
                    level: 4,
                    totalHours: 48
                },

                formations: [
                    {
                        id: 1,
                        icon: '🛡️',
                        title: 'Formação Cibersegurança & Defesa Ativa',
                        description: 'Trilha completa cobrindo governança de segurança, prevenção a ameaças cibernéticas e conformidade com a APD.',
                        totalHours: 115,
                        totalCourses: 3,
                        completedCourses: 2,
                        progress: 75,
                        coursesList: [
                            'Cibersegurança: Defesa, Segurança da Informação e Redes',
                            'Auditoria de Sistemas & Compliance em Segurança (APD)',
                            'Competências Digitais e Produtividade Tecnológica'
                        ]
                    },
                    {
                        id: 2,
                        icon: '📈',
                        title: 'Formação Gestão Financeira & Liderança Corporativa',
                        description: 'Domínio de DRE, valuation, fluxo de caixa estratégico e liderança de equipas.',
                        totalHours: 100,
                        totalCourses: 3,
                        completedCourses: 2,
                        progress: 66,
                        coursesList: [
                            'Gestão Empresarial, Estratégia e Operações',
                            'Liderança Executiva, Gestão de Equipas e Comunicação',
                            'Contabilidade Prática, Fiscalidade Angolana & Finanças'
                        ]
                    },
                    {
                        id: 3,
                        icon: '⚡',
                        title: 'Formação Automação de Escritório & Produtividade com IA',
                        description: 'Trabalho colaborativo em nuvem, automação com inteligência artificial e Power BI.',
                        totalHours: 66,
                        totalCourses: 2,
                        completedCourses: 1,
                        progress: 50,
                        coursesList: [
                            'Automação Digital, Inteligência Artificial e Power BI',
                            'Transformação Digital e Automação de Processos'
                        ]
                    }
                ],

                allCourses: (serverAllCourses && serverAllCourses.length > 0) ? serverAllCourses : [],
                enrolledCourses: (serverEnrolledCourses && serverEnrolledCourses.length > 0) ? serverEnrolledCourses : [],
                catalogRecommendations: (serverAllCourses && serverAllCourses.length > 0)
                    ? serverAllCourses.filter(c => !(serverEnrolledCourses || []).some(e => e.id === c.id)).slice(0, 6)
                    : [],

                accessHistory: [
                    { id: 1, data_acesso: '02/10/2026', hora_acesso: '18:10:45', ip: '102.214.34.12', navegador: 'Chrome 129.0 / Windows 11' },
                    { id: 2, data_acesso: '01/10/2026', hora_acesso: '14:22:10', ip: '102.214.34.12', navegador: 'Chrome 129.0 / Windows 11' }
                ],

                activeCourse: null,
                activeLesson: null,
                certificateCourse: null,

                async initApp() {
                    const storedUser = localStorage.getItem('rachi_user_data') || localStorage.getItem('rachi_auth_user');
                    if (storedUser) {
                        try {
                            const parsed = JSON.parse(storedUser);
                            this.currentUser = { ...this.currentUser, ...parsed };
                        } catch(e) {}
                    }

                    // Sincronização dinâmica com a API de cursos do aluno (/api/my/courses)
                    try {
                        const res = await fetch('/api/my/courses', { headers: { 'Accept': 'application/json' } });
                        if (res.ok) {
                            const data = await res.json();
                            if (data && Array.isArray(data.courses) && data.courses.length > 0) {
                                const synced = data.courses.map(apiCourse => {
                                    const full = this.allCourses.find(c => c.id === apiCourse.id || c.slug === apiCourse.slug);
                                    const total = full?.totalAulas || 10;
                                    const concl = apiCourse.completed_lessons || 0;
                                    const prog = apiCourse.enrollment_status === 'completed' ? 100 : (total > 0 ? Math.round((concl / total) * 100) : 0);
                                    return {
                                        ...(full || {}),
                                        id: apiCourse.id,
                                        slug: apiCourse.slug,
                                        nome: apiCourse.name || full?.nome,
                                        categoria: full?.categoria || 'Formação RACHI',
                                        gradientClass: full?.gradientClass || 'bg-gradient-to-br from-[#071326] via-[#0d2249] to-[#0050f0]',
                                        imagem: apiCourse.thumbnail || full?.imagem || ('/images/courses/' + apiCourse.slug + '.jpg'),
                                        thumbnail: apiCourse.thumbnail || full?.thumbnail || ('/images/courses/' + apiCourse.slug + '.jpg'),
                                        descricao: apiCourse.description || full?.descricao,
                                        duracao: (apiCourse.duration_hours || full?.duracao || 30) + (String(apiCourse.duration_hours || '').includes('Hora') ? '' : ' Horas'),
                                        totalAulas: total,
                                        aulasConcluidas: concl,
                                        progresso: prog,
                                        modulos: full?.modulos || []
                                    };
                                });
                                if (synced.length > 0) {
                                    this.enrolledCourses = synced;
                                }
                            }
                        }
                    } catch(err) {
                        // Permanece com os cursos fornecidos pelo servidor
                    }

                    if (this.enrolledCourses && this.enrolledCourses.length > 0) {
                        this.activeCourse = this.enrolledCourses[0];
                        if (this.activeCourse && this.activeCourse.modulos && this.activeCourse.modulos.length > 0) {
                            let found = null;
                            for (let m of this.activeCourse.modulos) {
                                if (m.aulas) {
                                    for (let a of m.aulas) {
                                        if (!a.concluida) { found = a; break; }
                                    }
                                }
                                if (found) break;
                            }
                            this.activeLesson = found || this.activeCourse.modulos[0]?.aulas?.[0] || null;
                        }
                    }

                    this.$nextTick(() => {
                        if (window.lucide) lucide.createIcons();
                    });
                },

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
                    const list = (this.allCourses && this.allCourses.length > 0) ? this.allCourses : this.enrolledCourses.concat(this.catalogRecommendations);
                    return list.filter(c => 
                        (c.nome && c.nome.toLowerCase().includes(q)) || 
                        (c.categoria && c.categoria.toLowerCase().includes(q))
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
                        this.toastMessage('Aula "' + aula.titulo + '" concluída!', 'Parabéns!');
                    }
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

                openCertificateModal(course) {
                    this.certificateCourse = course;
                    this.certificateModalOpen = true;
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                toastMessage(msg, title = 'Notificação') {
                    this.toast.title = title;
                    this.toast.message = msg;
                    this.toast.visible = true;
                    setTimeout(() => { this.toast.visible = false; }, 4000);
                },

                async logout() {
                    if (window.RachiSession) {
                        await window.RachiSession.logout();
                        return;
                    }
                    try {
                        await fetch('/logout', { method: 'POST', headers: { 'Accept': 'application/json' } });
                    } catch(e) {}
                    window.location.href = '/academy/login';
                }
            }
        }
    </script>

    <!-- Botão Flutuante de Modo Claro / Escuro no Canto Inferior Direito -->
    @include('components.theme-toggle-fab')
</body>
</html>
