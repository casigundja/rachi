import re

filepath = r"c:\Users\casimiro.gundja\Documents\rachi\resources\views\public\aluno-dashboard.blade.php"

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Update Header Container to be Light in Light Mode and Dark in Dark Mode
old_header_start = """    <header class="sticky top-0 z-40 w-full bg-[#071326] dark:bg-[#050914] text-white border-b border-slate-800 dark:border-white/10 shadow-xl shadow-slate-950/30 relative">
        <!-- Linha de Destaque Âmbar Superior Corporativo RACHI -->
        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#071326] via-[#f5a800] to-[#071326]"></div>"""

new_header_start = """    <header class="sticky top-0 z-40 w-full bg-white/95 dark:bg-[#071326] text-slate-900 dark:text-white border-b border-slate-200/90 dark:border-white/10 shadow-[0_4px_25px_rgba(15,23,42,0.06)] dark:shadow-xl dark:shadow-slate-950/40 backdrop-blur-md transition-colors duration-200 relative">
        <!-- Linha de Destaque Superior Corporativo RACHI -->
        <div class="absolute top-0 inset-x-0 h-1 bg-gradient-to-r from-[#0050f0] via-[#f5a800] to-[#00a3e0] dark:from-[#071326] dark:via-[#f5a800] dark:to-[#071326]"></div>"""

content = content.replace(old_header_start, new_header_start)

# 2. Update Logo & Portal Badge in Header
old_logo = """                    <a href="/" class="flex items-center gap-3.5 group" title="Ir para a página inicial da RACHI">
                        <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" onerror="this.onerror=null; this.src='/images/logo-rachi-dark.png'" alt="RACHI Academy" class="h-9 sm:h-10 w-auto object-contain transition duration-200 group-hover:scale-105">
                        <div class="hidden sm:flex flex-col">
                            <span class="text-xs font-black uppercase tracking-widest text-white flex items-center gap-2 font-heading">
                                ACADEMY <span class="text-[10px] px-2.5 py-0.5 rounded-full bg-[#f5a800]/20 text-[#f5a800] border border-[#f5a800]/40 font-bold shadow-sm">PORTAL DO ALUNO</span>
                            </span>
                        </div>
                    </a>"""

new_logo = """                    <a href="/" class="flex items-center gap-3 group cursor-pointer" title="Ir para a página inicial da RACHI">
                        <!-- Logo Light Mode (Escuro) -->
                        <img src="/images/logo-rachi-dark.png" onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi.png'" alt="RACHI Academy" class="h-8 sm:h-9 w-auto object-contain block dark:hidden transition duration-200 group-hover:scale-105">
                        <!-- Logo Dark Mode (Branco) -->
                        <img src="https://hom.rachi.ao/assets/img/logo-rachi-light.png" onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'" alt="RACHI Academy" class="h-8 sm:h-9 w-auto object-contain hidden dark:block transition duration-200 group-hover:scale-105">
                        <div class="hidden sm:flex flex-col">
                            <span class="text-xs font-black uppercase tracking-widest text-slate-900 dark:text-white flex items-center gap-2 font-heading">
                                ACADEMY <span class="text-[10px] px-2.5 py-0.5 rounded-full bg-blue-50 text-[#0050f0] border border-blue-200 dark:bg-[#f5a800]/20 dark:text-[#f5a800] dark:border-[#f5a800]/40 font-bold shadow-xs">PORTAL DO ALUNO</span>
                            </span>
                        </div>
                    </a>"""

content = content.replace(old_logo, new_logo)

# 3. Update Desktop Navigation Links in Header
old_nav = """                    <nav class="hidden lg:flex items-center gap-1.5 text-sm font-medium">
                        <button @click="activeMainTab = 'dashboard'" 
                                :class="activeMainTab === 'dashboard' ? 'bg-white/10 text-white font-bold border border-white/15 shadow-sm' : 'text-slate-300 hover:text-white hover:bg-white/5 font-medium border border-transparent'"
                                class="px-3.5 py-2 rounded-xl transition flex items-center gap-2 cursor-pointer text-xs sm:text-sm">
                            <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#f5a800]"></i>
                            <span>Dashboard</span>
                        </button>
                        <button @click="activeMainTab = 'formacoes'" 
                                :class="activeMainTab === 'formacoes' ? 'bg-white/10 text-white font-bold border border-white/15 shadow-sm' : 'text-slate-300 hover:text-white hover:bg-white/5 font-medium border border-transparent'"
                                class="px-3.5 py-2 rounded-xl transition flex items-center gap-2 cursor-pointer text-xs sm:text-sm">
                            <i data-lucide="compass" class="w-4 h-4 text-[#00a3e0]"></i>
                            <span>Formações</span>
                        </button>
                        <button @click="activeMainTab = 'cursos'" 
                                :class="activeMainTab === 'cursos' ? 'bg-white/10 text-white font-bold border border-white/15 shadow-sm' : 'text-slate-300 hover:text-white hover:bg-white/5 font-medium border border-transparent'"
                                class="px-3.5 py-2 rounded-xl transition flex items-center gap-2 cursor-pointer text-xs sm:text-sm">
                            <i data-lucide="book-open" class="w-4 h-4 text-sky-400"></i>
                            <span>Meus Cursos</span>
                        </button>
                        <button @click="activeMainTab = 'certificados'" 
                                :class="activeMainTab === 'certificados' ? 'bg-white/10 text-white font-bold border border-white/15 shadow-sm' : 'text-slate-300 hover:text-white hover:bg-white/5 font-medium border border-transparent'"
                                class="px-3.5 py-2 rounded-xl transition flex items-center gap-2 cursor-pointer text-xs sm:text-sm">
                            <i data-lucide="award" class="w-4 h-4 text-[#f5a800]"></i>
                            <span>Certificados</span>
                        </button>
                    </nav>"""

new_nav = """                    <nav class="hidden lg:flex items-center gap-1.5 text-sm font-medium">
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
                    </nav>"""

content = content.replace(old_nav, new_nav)

# 4. Update Header Search Input and Dropdown
old_search = """                        <div class="relative w-full">
                            <i data-lucide="search" class="w-3.5 h-3.5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                            <input type="text" 
                                   x-model="searchQuery" 
                                   @focus="searchOpen = true"
                                   @input="searchOpen = true"
                                   placeholder="O que quer aprender?" 
                                   class="w-full bg-slate-900/90 dark:bg-[#080e1a] border border-slate-700/80 dark:border-white/15 focus:bg-slate-900 focus:border-[#f5a800] text-xs text-white rounded-full pl-8 pr-7 py-2 outline-none transition placeholder-slate-400 focus:ring-2 focus:ring-amber-500/20">
                            <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px] bg-slate-800 text-slate-400 px-1.5 py-0.5 rounded font-mono border border-slate-700">/</span>
                        </div>"""

new_search = """                        <div class="relative w-full">
                            <i data-lucide="search" class="w-3.5 h-3.5 text-slate-400 absolute left-3 top-1/2 -translate-y-1/2"></i>
                            <input type="text" 
                                   x-model="searchQuery" 
                                   @focus="searchOpen = true"
                                   @input="searchOpen = true"
                                   placeholder="O que quer aprender?" 
                                   class="w-full bg-slate-100 dark:bg-[#080e1a] border border-slate-200 dark:border-white/15 focus:bg-white dark:focus:bg-slate-900 focus:border-[#0050f0] dark:focus:border-[#f5a800] text-xs text-slate-900 dark:text-white rounded-full pl-8 pr-7 py-2 outline-none transition placeholder-slate-400 focus:ring-2 focus:ring-blue-500/20 dark:focus:ring-amber-500/20 shadow-xs">
                            <span class="absolute right-2.5 top-1/2 -translate-y-1/2 text-[10px] bg-slate-200 dark:bg-slate-800 text-slate-600 dark:text-slate-400 px-1.5 py-0.5 rounded font-mono border border-slate-300 dark:border-slate-700">/</span>
                        </div>"""

content = content.replace(old_search, new_search)

# Search dropdown in header
old_search_dropdown = """                        <div x-show="searchOpen && (searchQuery.trim().length > 0)" 
                             x-cloak 
                             class="absolute top-full left-0 right-0 mt-2 bg-[#071326] dark:bg-[#0c1220] border border-slate-700 dark:border-white/15 rounded-2xl shadow-2xl p-2 z-50 overflow-hidden text-white">
                            <div class="text-[10px] uppercase font-bold text-slate-400 px-3 py-1.5 tracking-wider">Resultados nos Cursos</div>
                            <template x-for="item in filteredSearchResults" :key="item.id">
                                <button @click="openCourseFromSearch(item)" 
                                        class="w-full text-left px-3 py-2 rounded-xl hover:bg-white/10 transition flex items-center justify-between text-xs group cursor-pointer text-slate-200">
                                    <span class="font-medium group-hover:text-[#f5a800]" x-text="item.nome"></span>
                                    <span class="text-[10px] text-slate-300 px-2 py-0.5 rounded bg-white/10 border border-white/10" x-text="item.categoria"></span>
                                </button>
                            </template>
                            <div x-show="filteredSearchResults.length === 0" class="text-xs text-slate-400 px-3 py-2">
                                Nenhum curso correspondente encontrado.
                            </div>
                        </div>"""

new_search_dropdown = """                        <div x-show="searchOpen && (searchQuery.trim().length > 0)" 
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
                        </div>"""

content = content.replace(old_search_dropdown, new_search_dropdown)

# Header divider
content = content.replace(
    '<div class="hidden md:block h-6 w-px bg-slate-800"></div>',
    '<div class="hidden md:block h-6 w-px bg-slate-200 dark:bg-slate-800"></div>'
)

# Theme button in header
old_theme_btn = """                    <!-- Botão de Alternância de Tema (Modo Claro / Escuro) -->
                    <button type="button" 
                            onclick="window.toggleRachiTheme()" 
                            aria-label="Alternar Modo Claro / Escuro" 
                            title="Alternar Modo Claro / Escuro"
                            class="w-9 h-9 sm:w-10 sm:h-10 rounded-xl bg-white/10 hover:bg-white/20 border border-white/15 text-slate-200 hover:text-amber-400 flex items-center justify-center transition-all duration-200 cursor-pointer shadow-sm group">
                        <!-- Lua (visível no Modo Claro) -->
                        <svg class="w-4 h-4 text-amber-300 group-hover:text-amber-200 dark:hidden transition-transform duration-300 group-hover:-rotate-12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <!-- Sol (visível no Modo Escuro) -->
                        <svg class="w-4 h-4 text-amber-400 group-hover:text-amber-300 hidden dark:block transition-transform duration-300 group-hover:rotate-45" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                    </button>"""

new_theme_btn = """                    <!-- Botão de Alternância de Tema (Modo Claro / Escuro) -->
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
                    </button>"""

content = content.replace(old_theme_btn, new_theme_btn)

# Bell button in header
old_bell = """                    <!-- Notification Bell -->
                    <button @click="toastMessage('Nenhuma notificação nova no momento', 'Avisos')" 
                            class="relative p-2 rounded-xl border border-slate-700/80 hover:bg-white/10 text-slate-300 hover:text-white transition cursor-pointer">
                        <i data-lucide="bell" class="w-4 h-4"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-[#f5a800] ring-2 ring-[#071326]"></span>
                    </button>"""

new_bell = """                    <!-- Notification Bell -->
                    <button @click="toastMessage('Nenhuma notificação nova no momento', 'Avisos')" 
                            class="relative p-2 rounded-xl bg-slate-100 hover:bg-slate-200/80 dark:bg-white/10 dark:hover:bg-white/20 border border-slate-200/90 dark:border-white/15 text-slate-700 hover:text-slate-950 dark:text-slate-300 dark:hover:text-white transition cursor-pointer shadow-xs">
                        <i data-lucide="bell" class="w-4 h-4"></i>
                        <span class="absolute top-1.5 right-1.5 w-2 h-2 rounded-full bg-[#f5a800] ring-2 ring-white dark:ring-[#071326]"></span>
                    </button>"""

content = content.replace(old_bell, new_bell)

# Profile button in header
old_profile_btn = """                        <button @click="profileMenuOpen = !profileMenuOpen" 
                                class="flex items-center gap-2.5 p-1.5 rounded-xl hover:bg-white/5 border border-transparent hover:border-slate-700 transition cursor-pointer">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-tr from-[#f5a800] via-[#00a3e0] to-[#0050f0] text-[#071326] font-black text-xs flex items-center justify-center ring-2 ring-white/20 shadow-md">
                                <span x-text="getInitials(currentUser.nome)"></span>
                            </div>
                            <div class="hidden md:flex flex-col text-left">
                                <span class="text-xs font-bold text-white leading-tight" x-text="currentUser.nome ? currentUser.nome.split(' ')[0] : 'Aluno'"></span>
                                <span class="text-[10px] text-[#f5a800] font-medium leading-tight">Aluno</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 hidden sm:block"></i>
                        </button>"""

new_profile_btn = """                        <button @click="profileMenuOpen = !profileMenuOpen" 
                                class="flex items-center gap-2.5 p-1.5 rounded-xl hover:bg-slate-100 dark:hover:bg-white/5 border border-transparent hover:border-slate-200 dark:hover:border-slate-700 transition cursor-pointer">
                            <div class="w-8 h-8 sm:w-9 sm:h-9 rounded-full bg-gradient-to-tr from-[#f5a800] via-[#00a3e0] to-[#0050f0] text-[#071326] font-black text-xs flex items-center justify-center ring-2 ring-blue-500/20 dark:ring-white/20 shadow-md">
                                <span x-text="getInitials(currentUser.nome)"></span>
                            </div>
                            <div class="hidden md:flex flex-col text-left">
                                <span class="text-xs font-bold text-slate-900 dark:text-white leading-tight" x-text="currentUser.nome ? currentUser.nome.split(' ')[0] : 'Aluno'"></span>
                                <span class="text-[10px] text-[#0050f0] dark:text-[#f5a800] font-semibold leading-tight">Aluno</span>
                            </div>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-slate-400 hidden sm:block"></i>
                        </button>"""

content = content.replace(old_profile_btn, new_profile_btn)

# Profile dropdown menu
old_profile_menu = """                        <!-- Menu Modal -->
                        <div x-show="profileMenuOpen" 
                             x-cloak 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             class="absolute right-0 mt-2 w-64 bg-[#071326] dark:bg-[#0c1220] border border-slate-700 dark:border-white/15 rounded-2xl shadow-2xl p-3 z-50 text-white">
                            
                            <!-- Header do perfil -->
                            <div class="px-3 py-2 border-b border-slate-800 mb-2">
                                <p class="text-xs font-bold text-white truncate" x-text="currentUser.nome"></p>
                                <p class="text-[11px] text-slate-400 truncate" x-text="currentUser.email"></p>
                                <div class="mt-1.5 flex items-center justify-between text-[10px]">
                                    <span class="text-[#f5a800] font-mono font-bold" x-text="'ID #' + (currentUser.aluno_id || currentUser.id)"></span>
                                    <span class="px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 font-bold">Conta Ativa</span>
                                </div>
                            </div>

                            <!-- Atalhos -->
                            <div class="space-y-1 text-xs">
                                <button @click="activeMainTab = 'certificados'; profileMenuOpen = false" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-200 hover:text-white hover:bg-white/10 transition text-left cursor-pointer">
                                    <i data-lucide="award" class="w-4 h-4 text-[#f5a800]"></i>
                                    Meus Certificados
                                </button>
                                <button @click="accessLogsModal = true; profileMenuOpen = false" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-200 hover:text-white hover:bg-white/10 transition text-left cursor-pointer">
                                    <i data-lucide="shield-check" class="w-4 h-4 text-[#00a3e0]"></i>
                                    Histórico de Acessos
                                </button>
                                <a href="/academy" 
                                   class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-200 hover:text-white hover:bg-white/10 transition text-left">
                                    <i data-lucide="globe" class="w-4 h-4 text-sky-400"></i>
                                    Portal Academy RACHI
                                </a>
                                <a href="/" 
                                   class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-slate-200 hover:text-white hover:bg-white/10 transition text-left">
                                    <i data-lucide="home" class="w-4 h-4 text-slate-400"></i>
                                    Página Inicial (Portal Geral)
                                </a>
                            </div>

                            <!-- Logout -->
                            <div class="mt-2 pt-2 border-t border-slate-800">
                                <button @click="logout()" 
                                        class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl text-rose-400 hover:bg-rose-500/10 transition text-xs font-semibold text-left cursor-pointer">
                                    <i data-lucide="log-out" class="w-4 h-4"></i>
                                    Sair da Minha Conta
                                </button>
                            </div>
                        </div>"""

new_profile_menu = """                        <!-- Menu Modal -->
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
                        </div>"""

content = content.replace(old_profile_menu, new_profile_menu)

# Mobile menu drawer
old_mobile_drawer = """        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" x-cloak class="lg:hidden bg-[#071326] dark:bg-[#050914] border-b border-slate-800 dark:border-white/10 px-4 py-3 space-y-2 text-white">
            <button @click="activeMainTab = 'dashboard'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-200 hover:bg-white/10">Dashboard</button>
            <button @click="activeMainTab = 'formacoes'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-200 hover:bg-white/10">Formações</button>
            <button @click="activeMainTab = 'cursos'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-200 hover:bg-white/10">Meus Cursos</button>
            <button @click="activeMainTab = 'certificados'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-200 hover:bg-white/10">Certificados</button>
        </div>"""

new_mobile_drawer = """        <!-- Mobile Drawer -->
        <div x-show="mobileMenuOpen" x-cloak class="lg:hidden bg-white dark:bg-[#050914] border-b border-slate-200 dark:border-white/10 px-4 py-3 space-y-2 text-slate-900 dark:text-white shadow-xl">
            <button @click="activeMainTab = 'dashboard'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10">Dashboard</button>
            <button @click="activeMainTab = 'formacoes'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10">Formações</button>
            <button @click="activeMainTab = 'cursos'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10">Meus Cursos</button>
            <button @click="activeMainTab = 'certificados'; mobileMenuOpen = false" class="w-full text-left px-3 py-2 text-xs font-semibold rounded-xl text-slate-700 dark:text-slate-200 hover:bg-slate-100 dark:hover:bg-white/10">Certificados</button>
        </div>"""

content = content.replace(old_mobile_drawer, new_mobile_drawer)

# 5. Make the Hero Section Harmonious in Light Mode!
old_hero = """            <!-- 1. HERO: Boas-vindas Executivo RACHI Academy + Estatísticas de Estudo -->
            <section class="rounded-3xl p-5 sm:p-7 lg:p-8 relative overflow-hidden bg-gradient-to-br from-[#071326] via-[#0c1f3b] to-[#071326] dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-white shadow-xl shadow-slate-900/10 border border-slate-800 dark:border-white/10">
                <!-- Luzes ambientes corporativas RACHI -->
                <div class="absolute -right-20 -top-20 w-96 h-96 bg-[#0050f0]/20 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -left-20 -bottom-20 w-80 h-80 bg-[#f5a800]/15 rounded-full blur-3xl pointer-events-none"></div>
                
                <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2.5 mb-3">
                            <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-[#f5a800]/20 text-[#f5a800] border border-[#f5a800]/40 flex items-center gap-1.5 shadow-sm">
                                <span class="w-1.5 h-1.5 rounded-full bg-[#f5a800] animate-pulse"></span>
                                RITMO DE ESTUDOS ATIVO
                            </span>
                            <span class="text-xs text-slate-300 font-medium">Nível 4 • Especialista Corporativo</span>
                        </div>
                        <h1 class="text-2xl sm:text-3xl lg:text-4xl font-heading font-black text-white tracking-tight">
                            Olá, <span class="text-transparent bg-clip-text bg-gradient-to-r from-white via-amber-200 to-[#f5a800]" x-text="currentUser.nome ? currentUser.nome.split(' ')[0] : 'Aluno'"></span>! Bom retorno aos seus estudos.
                        </h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-2 max-w-2xl leading-relaxed">
                            Continue avançando para concluir sua formação corporativa e emitir seus certificados oficiais reconhecidos pelo Grupo RACHI.
                        </p>
                    </div>

                    <!-- Botão de Ação Rápida -->
                    <div class="flex items-center gap-3 shrink-0">
                        <button @click="openClassroom(enrolledCourses[0])" 
                                class="px-6 py-3.5 rounded-xl bg-[#f5a800] hover:bg-[#d99400] text-[#071326] font-extrabold text-xs tracking-wider uppercase shadow-xl shadow-amber-500/20 hover:shadow-amber-500/30 transition-all transform hover:-translate-y-0.5 active:translate-y-0 flex items-center gap-2.5 cursor-pointer">
                            <i data-lucide="play" class="w-4 h-4 fill-[#071326]"></i>
                            <span>Continuar Aula Atual</span>
                        </button>
                    </div>
                </div>

                <!-- GRID DE MÉTRICAS RÁPIDAS (ESTILO VIDRO ESCURO CORPORATIVO) -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 sm:gap-4 mt-5 pt-5 border-t border-white/10">

                    <!-- Stat 1: Cursos Matriculados -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4.5 flex items-center gap-3.5 hover:bg-white/10 hover:border-blue-400/40 transition shadow-sm group">
                        <div class="w-12 h-12 rounded-xl bg-blue-500/20 text-[#00a3e0] border border-blue-500/30 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <i data-lucide="book-open" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black font-heading text-white" x-text="enrolledCourses.length + ' cursos'"></div>
                            <div class="text-[11px] text-slate-300 font-medium">Matriculados ativos</div>
                        </div>
                    </div>

                    <!-- Stat 2: Horas Estudadas -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4.5 flex items-center gap-3.5 hover:bg-white/10 hover:border-emerald-400/40 transition shadow-sm group">
                        <div class="w-12 h-12 rounded-xl bg-emerald-500/20 text-emerald-400 border border-emerald-500/30 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black font-heading text-white" x-text="studentStats.totalHours + 'h'"></div>
                            <div class="text-[11px] text-slate-300 font-medium">Tempo dedicado</div>
                        </div>
                    </div>

                    <!-- Stat 3: Certificados Conquistados -->
                    <div class="bg-white/5 border border-white/10 rounded-2xl p-4.5 flex items-center gap-3.5 hover:bg-white/10 hover:border-amber-400/40 transition shadow-sm group">
                        <div class="w-12 h-12 rounded-xl bg-amber-500/20 text-[#f5a800] border border-amber-500/30 flex items-center justify-center shrink-0 group-hover:scale-105 transition-transform">
                            <i data-lucide="award" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <div class="text-xl sm:text-2xl font-black font-heading text-white" x-text="getCompletedCoursesCount() + ' emitidos'"></div>
                            <div class="text-[11px] text-slate-300 font-medium">Certificados oficiais</div>
                        </div>
                    </div>

                </div>

                <!-- HABIT TRACKER: Atividade Semanal (Seg a Dom) -->
                <div class="mt-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 text-xs bg-white/5 p-3.5 sm:p-4 rounded-2xl border border-white/10">
                    <div class="flex items-center gap-2 text-slate-200">
                        <i data-lucide="calendar" class="w-4 h-4 text-[#f5a800]"></i>
                        <span class="font-medium">Frequência Semanal:</span>
                        <span class="text-[#f5a800] font-bold bg-amber-500/20 border border-amber-500/30 px-2 py-0.5 rounded-full">5 de 7 dias concluídos</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <template x-for="day in weekHabit" :key="day.name">
                            <div class="flex flex-col items-center gap-1">
                                <div :class="day.done ? 'bg-[#f5a800] text-[#071326] font-black shadow-sm' : 'bg-white/10 text-slate-400 border border-white/10'"
                                     class="w-6 h-6 rounded-md flex items-center justify-center text-[10px] transition">
                                    <span x-show="day.done">✓</span>
                                    <span x-show="!day.done" x-text="day.short"></span>
                                </div>
                                <span class="text-[9px] text-slate-400 font-semibold" x-text="day.short"></span>
                            </div>
                        </template>
                    </div>
                </div>

            </section>"""

new_hero = """            <!-- 1. HERO: Boas-vindas Executivo RACHI Academy + Estatísticas de Estudo -->
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

            </section>"""

content = content.replace(old_hero, new_hero)

# 6. Improve "Continue de Onde Parou" button in Light Mode
content = content.replace(
    'class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-gradient-to-r from-[#071326] via-[#0d1f3d] to-[#071326] hover:from-[#0b1c3d] text-white font-extrabold text-xs uppercase tracking-wider shadow-lg shadow-slate-900/15 hover:shadow-xl hover:scale-[1.02] active:scale-98 transition flex items-center justify-center gap-2.5 cursor-pointer border border-slate-700"',
    'class="w-full sm:w-auto px-6 py-3.5 rounded-xl bg-[#0050f0] hover:bg-[#0042c7] text-white dark:bg-gradient-to-r dark:from-[#071326] dark:via-[#0d1f3d] dark:to-[#071326] font-extrabold text-xs uppercase tracking-wider shadow-md shadow-blue-500/20 hover:shadow-lg hover:shadow-blue-500/30 hover:scale-[1.02] active:scale-98 transition flex items-center justify-center gap-2.5 cursor-pointer border border-blue-600 dark:border-slate-700"'
)
content = content.replace(
    '<i data-lucide="play" class="w-4 h-4 text-[#f5a800] fill-[#f5a800]"></i>',
    '<i data-lucide="play" class="w-4 h-4 fill-white text-white dark:text-[#f5a800] dark:fill-[#f5a800]"></i>'
)

# 7. Improve Course Card "Continuar Aula" Button in Light Mode
content = content.replace(
    'class="flex-1 py-2.5 rounded-xl bg-gradient-to-r from-[#071326] via-[#0d1f3d] to-[#071326] hover:from-[#0b1c3d] text-white font-extrabold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2 shadow-sm cursor-pointer border border-slate-700"',
    'class="flex-1 py-2.5 rounded-xl bg-[#0050f0] hover:bg-[#0042c7] text-white dark:bg-gradient-to-r dark:from-[#071326] dark:via-[#0d1f3d] dark:to-[#071326] font-extrabold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2 shadow-sm hover:shadow-md hover:shadow-blue-500/20 cursor-pointer border border-blue-600 dark:border-slate-700"'
)
content = content.replace(
    '<i data-lucide="play" class="w-3.5 h-3.5 text-[#f5a800] fill-[#f5a800]"></i>',
    '<i data-lucide="play" class="w-3.5 h-3.5 fill-white text-white dark:text-[#f5a800] dark:fill-[#f5a800]"></i>'
)

# 8. Improve Tab "Formações" Hero in Light Mode
old_formacoes_hero = """            <div class="rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-gradient-to-r from-[#071326] via-[#0c1f3b] to-[#071326] dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-white border border-slate-800 dark:border-white/10 shadow-xl relative overflow-hidden">
                <div class="absolute right-0 top-0 w-80 h-80 bg-[#00a3e0]/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="relative z-10">
                    <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-[#00a3e0]/20 text-[#00a3e0] border border-[#00a3e0]/30 inline-block mb-2">
                        Trilhas de Carreira Corporativas
                    </span>
                    <h1 class="text-2xl sm:text-3xl font-heading font-black text-white">Formações RACHI Academy</h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1 max-w-2xl leading-relaxed">
                        Guias estruturados passo a passo criados para você dominar uma área de especialização do zero até o nível executivo com a chancela do Grupo RACHI.
                    </p>
                </div>
            </div>"""

new_formacoes_hero = """            <div class="rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-gradient-to-r from-white via-slate-50 to-blue-50/50 dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-slate-900 dark:text-white border border-slate-200/90 dark:border-white/10 shadow-[0_4px_25px_rgba(0,80,240,0.05)] dark:shadow-xl relative overflow-hidden transition-colors">
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
            </div>"""

content = content.replace(old_formacoes_hero, new_formacoes_hero)

# 9. Improve Tab "Certificados" Hero in Light Mode
old_certificados_hero = """            <div class="rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-gradient-to-r from-[#071326] via-[#0c1f3b] to-[#071326] dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-white border border-slate-800 dark:border-white/10 shadow-xl relative overflow-hidden">
                <div class="absolute right-0 top-0 w-80 h-80 bg-[#f5a800]/10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-14 h-14 rounded-2xl bg-[#f5a800]/20 text-[#f5a800] border border-[#f5a800]/30 flex items-center justify-center text-3xl shrink-0 shadow-sm">
                        🎓
                    </div>
                    <div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider bg-[#f5a800]/20 text-[#f5a800] border border-[#f5a800]/30 inline-block mb-1">
                            Validação Criptográfica Oficial
                        </span>
                        <h1 class="text-2xl sm:text-3xl font-heading font-black text-white">Meus Certificados Oficiais</h1>
                        <p class="text-xs sm:text-sm text-slate-300 mt-0.5">
                            Certificados com validação criptográfica emitidos pela RACHI Academy &amp; Grupo RACHI.
                        </p>
                    </div>
                </div>
            </div>"""

new_certificados_hero = """            <div class="rounded-2xl sm:rounded-3xl p-5 sm:p-7 bg-gradient-to-r from-white via-slate-50 to-amber-50/50 dark:from-[#050914] dark:via-[#09152b] dark:to-[#050914] text-slate-900 dark:text-white border border-slate-200/90 dark:border-white/10 shadow-[0_4px_25px_rgba(245,168,0,0.06)] dark:shadow-xl relative overflow-hidden transition-colors">
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
            </div>"""

content = content.replace(old_certificados_hero, new_certificados_hero)

# 10. Improve Classroom Header in Light Mode
old_cr_header = """        <!-- Classroom Header -->
        <header class="w-full bg-[#0a0e1c] border-b border-white/10 px-4 sm:px-6 py-3 flex items-center justify-between shrink-0">
            <div class="flex items-center gap-3">
                <button @click="classroomModal = false" class="p-2 rounded-lg bg-white/5 hover:bg-white/10 text-slate-300 hover:text-white transition cursor-pointer">
                    <i data-lucide="arrow-left" class="w-4 h-4"></i>
                </button>
                <div>
                    <span class="text-[10px] uppercase font-bold text-[#00a3e0] tracking-wider" x-text="activeCourse.nome"></span>
                    <h2 class="text-xs sm:text-sm font-bold text-white truncate max-w-md sm:max-w-xl" x-text="activeLesson.titulo"></h2>
                </div>
            </div>

            <div class="flex items-center gap-3">
                <button @click="toggleLessonStatus(activeLesson)" 
                        :class="activeLesson.concluida ? 'bg-emerald-500 text-slate-950 hover:bg-emerald-400' : 'bg-[#0050f0] text-white hover:bg-[#0042c7]'"
                        class="px-4 py-2 rounded-xl font-bold text-xs uppercase tracking-wider transition flex items-center gap-1.5 shadow cursor-pointer">
                    <span x-show="activeLesson.concluida">✓ Aula Concluída</span>
                    <span x-show="!activeLesson.concluida">Marcar como Concluída</span>
                </button>

                <button @click="classroomModal = false" class="p-2 rounded-lg text-slate-400 hover:text-white cursor-pointer">✕</button>
            </div>
        </header>"""

new_cr_header = """        <!-- Classroom Header -->
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
        </header>"""

content = content.replace(old_cr_header, new_cr_header)

# 11. Improve Classroom Syllabus Drawer in Light Mode
old_cr_drawer = """            <!-- Right: Module and Lessons Syllabus Drawer -->
            <div class="bg-[#0b0f1e] border-t lg:border-t-0 lg:border-l border-white/10 p-4 overflow-y-auto flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Ementa do Curso</h3>
                        <span class="text-xs font-bold text-[#00a3e0]" x-text="activeCourse.progresso + '% Concluído'"></span>
                    </div>

                    <!-- Módulos e Aulas -->
                    <div class="space-y-4">
                        <template x-for="(modulo, mIdx) in activeCourse.modulos" :key="modulo.id">
                            <div class="space-y-1.5">
                                <div class="text-[11px] font-bold text-slate-400 uppercase tracking-wider px-2 py-1 bg-white/[0.02] rounded" x-text="modulo.nome"></div>
                                
                                <div class="space-y-1">
                                    <template x-for="aula in modulo.aulas" :key="aula.id">
                                        <button @click="selectLessonInPlayer(aula)" 
                                                :class="activeLesson.id === aula.id ? 'bg-[#0050f0]/25 border-[#0050f0]/60 text-white' : 'hover:bg-white/5 text-slate-300 border-transparent'"
                                                class="w-full text-left p-2.5 rounded-xl border transition flex items-center justify-between gap-2 text-xs group cursor-pointer">
                                            <div class="flex items-center gap-2 min-w-0">
                                                <input type="checkbox" 
                                                       :checked="aula.concluida" 
                                                       @click.stop="toggleLessonStatus(aula)" 
                                                       class="w-4 h-4 rounded text-[#0050f0] bg-white/10 border-white/20 focus:ring-0 cursor-pointer">
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

                <div class="mt-6 pt-4 border-t border-white/10">
                    <button @click="openCertificateModal(activeCourse)" 
                            :disabled="activeCourse.progresso < 100"
                            :class="activeCourse.progresso === 100 ? 'bg-amber-500 text-slate-950 font-bold hover:brightness-110 cursor-pointer' : 'bg-white/5 text-slate-500 cursor-not-allowed'"
                            class="w-full py-2.5 rounded-xl text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition">
                        <i data-lucide="award" class="w-4 h-4"></i>
                        <span x-text="activeCourse.progresso === 100 ? 'Emitir Certificado Oficial' : 'Certificado Bloqueado (Progresso < 100%)'"></span>
                    </button>
                </div>
            </div>"""

new_cr_drawer = """            <!-- Right: Module and Lessons Syllabus Drawer -->
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
            </div>"""

content = content.replace(old_cr_drawer, new_cr_drawer)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("Light mode enhancements applied successfully!")
