import re

filepath = r"c:\Users\casimiro.gundja\Documents\rachi\resources\views\public\home.blade.php"

with open(filepath, 'r', encoding='utf-8') as f:
    content = f.read()

# 1. Update the user button to be dual-mode (clean white in light mode, dark in dark mode)
old_user_btn = """                    <template x-if="currentUser">
                        <div class="relative" x-data="{ userMenuDropdown: false }" @click.away="userMenuDropdown = false">
                            <button @click="userMenuDropdown = !userMenuDropdown"
                                class="flex items-center gap-2.5 py-1.5 pl-2 pr-3.5 rounded-full bg-slate-900/85 hover:bg-slate-800/90 border border-slate-700/80 hover:border-amber-400/80 text-white transition-all shadow-md group">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 font-black text-xs flex items-center justify-center shadow-sm"
                                     x-text="currentUser.avatar || 'U'"></div>
                                <div class="text-left hidden sm:block">
                                    <div class="text-xs font-bold leading-tight max-w-[150px] truncate text-slate-100 group-hover:text-amber-300 transition" x-text="currentUser.nome"></div>
                                    <div class="text-[10px] text-amber-400 leading-none" x-text="currentUser.roleLabel || 'Autenticado'"></div>
                                </div>
                                <svg class="w-3.5 h-3.5 text-slate-400 group-hover:text-white transition-transform duration-200" :class="userMenuDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>"""

new_user_btn = """                    <template x-if="currentUser">
                        <div class="relative" x-data="{ userMenuDropdown: false }" @click.away="userMenuDropdown = false">
                            <button @click="userMenuDropdown = !userMenuDropdown"
                                class="flex items-center gap-2.5 py-1.5 pl-2 pr-3.5 rounded-full bg-white hover:bg-slate-50 dark:bg-slate-900/85 dark:hover:bg-slate-800/90 border border-slate-200/90 dark:border-slate-700/80 hover:border-[#0050f0]/40 dark:hover:border-amber-400/80 text-slate-800 dark:text-white transition-all shadow-sm hover:shadow-md cursor-pointer group">
                                <div class="w-7 h-7 rounded-full bg-gradient-to-tr from-amber-500 to-yellow-300 text-slate-950 font-black text-xs flex items-center justify-center shadow-xs"
                                     x-text="currentUser.avatar || 'U'"></div>
                                <div class="text-left hidden sm:block">
                                    <div class="text-xs font-bold leading-tight max-w-[150px] truncate text-slate-800 dark:text-slate-100 group-hover:text-[#0050f0] dark:group-hover:text-amber-300 transition" x-text="currentUser.nome"></div>
                                    <div class="text-[10px] text-amber-600 dark:text-amber-400 font-semibold leading-none" x-text="currentUser.roleLabel || 'Autenticado'"></div>
                                </div>
                                <svg class="w-3.5 h-3.5 text-slate-500 dark:text-slate-400 group-hover:text-slate-900 dark:group-hover:text-white transition-transform duration-200" :class="userMenuDropdown ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>"""

content = content.replace(old_user_btn, new_user_btn)

# 2. Update the dropdown menu container & items to be light in Light Mode and dark in Dark Mode
old_dropdown = """                            <!-- Menu Dropdown com Permissões -->
                            <div x-show="userMenuDropdown" x-cloak
                                 class="absolute right-0 mt-2 w-64 rounded-2xl bg-slate-900/95 backdrop-blur-xl border border-slate-700 shadow-2xl py-2 z-50 text-xs text-white">
                                <div class="px-4 py-2 border-b border-slate-800">
                                    <div class="font-bold text-slate-100 truncate" x-text="currentUser.nome"></div>
                                    <div class="text-[10px] text-slate-400 truncate" x-text="currentUser.email"></div>
                                    <div class="mt-1 flex items-center gap-1.5">
                                        <span class="text-[10px] px-2 py-0.5 rounded-full font-bold"
                                              :class="currentUser.has_matricula ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-blue-500/20 text-blue-300 border border-blue-500/30'"
                                              x-text="currentUser.has_matricula ? 'Aluno Matriculado' : 'Cliente Autorizado'"></span>
                                    </div>
                                </div>

                                <div class="p-1 space-y-0.5">
                                    <!-- Permissão 1: Área do Cliente -->
                                    <button @click="currentView = 'customer'; customerTab = 'dashboard'; userMenuDropdown = false"
                                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-800 text-left text-slate-200 transition">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        <span>Painel do Cliente</span>
                                    </button>

                                    <!-- Permissão 2: Solicitar Produtos & Serviços -->
                                    <button @click="currentView = 'customer'; customerTab = 'new_request'; userMenuDropdown = false"
                                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-800 text-left text-slate-200 transition">
                                        <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Solicitar Produtos / Serviços</span>
                                    </button>

                                    <!-- Permissão 2.5: Loja Online Integrada (Sessão Sincronizada) -->
                                    <a href="/loja"
                                       class="w-full flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-800 text-left text-slate-200 transition">
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                            <span>Loja Corporativa RACHI</span>
                                        </div>
                                        <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-500/20 text-blue-400 font-bold">Conectado</span>
                                    </a>

                                    <!-- Permissão 3: Academy (Perfil de Aluno) com validação de matrícula -->
                                    <button @click="openAcademyAluno(); userMenuDropdown = false"
                                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-800 text-left text-slate-200 transition">
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                            <span>Perfil Aluno (Academy)</span>
                                        </div>
                                        <template x-if="currentUser && currentUser.has_matricula">
                                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-500/20 text-emerald-400 font-bold">Ativa</span>
                                        </template>
                                        <template x-if="!currentUser || !currentUser.has_matricula">
                                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-amber-500/20 text-amber-400 font-bold">Bloqueado</span>
                                        </template>
                                    </button>

                                    <!-- Se for Admin: Atalho para Admin Dashboard -->
                                    <template x-if="currentUser && (currentUser.role === 'admin' || currentUser.tipo === 'admin')">
                                        <a href="/admin-dashboard"
                                           class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-800 text-left text-amber-300 font-semibold transition">
                                            <svg class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            <span>Painel Administrativo</span>
                                        </a>
                                    </template>

                                    <!-- Logout -->
                                    <div class="pt-1 mt-1 border-t border-slate-800">
                                        <button @click="logout(); userMenuDropdown = false"
                                                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-500/10 text-left text-rose-400 transition font-medium">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            <span>Terminar Sessão (Sair)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>"""

new_dropdown = """                            <!-- Menu Dropdown com Permissões -->
                            <div x-show="userMenuDropdown" x-cloak
                                 class="absolute right-0 mt-2 w-64 rounded-2xl bg-white/95 dark:bg-slate-900/95 backdrop-blur-xl border border-slate-200/90 dark:border-slate-700 shadow-2xl py-2 z-50 text-xs text-slate-800 dark:text-white transition-colors">
                                <div class="px-4 py-2 border-b border-slate-100 dark:border-slate-800">
                                    <div class="font-bold text-slate-900 dark:text-slate-100 truncate" x-text="currentUser.nome"></div>
                                    <div class="text-[10px] text-slate-500 dark:text-slate-400 truncate" x-text="currentUser.email"></div>
                                    <div class="mt-1 flex items-center gap-1.5">
                                        <span class="text-[10px] px-2 py-0.5 rounded-full font-bold"
                                              :class="currentUser.has_matricula ? 'bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-500/20 dark:text-emerald-300 dark:border-emerald-500/30' : 'bg-blue-50 text-blue-700 border border-blue-200 dark:bg-blue-500/20 dark:text-blue-300 dark:border-blue-500/30'"
                                              x-text="currentUser.has_matricula ? 'Aluno Matriculado' : 'Cliente Autorizado'"></span>
                                    </div>
                                </div>

                                <div class="p-1 space-y-0.5">
                                    <!-- Permissão 1: Área do Cliente -->
                                    <button @click="currentView = 'customer'; customerTab = 'dashboard'; userMenuDropdown = false"
                                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white transition cursor-pointer">
                                        <svg class="w-4 h-4 text-[#0050f0] dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                                        <span>Painel do Cliente</span>
                                    </button>

                                    <!-- Permissão 2: Solicitar Produtos & Serviços -->
                                    <button @click="currentView = 'customer'; customerTab = 'new_request'; userMenuDropdown = false"
                                            class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white transition cursor-pointer">
                                        <svg class="w-4 h-4 text-[#0050f0] dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        <span>Solicitar Produtos / Serviços</span>
                                    </button>

                                    <!-- Permissão 2.5: Loja Online Integrada (Sessão Sincronizada) -->
                                    <a href="/loja"
                                       class="w-full flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white transition">
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-sky-500 dark:text-sky-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                                            <span>Loja Corporativa RACHI</span>
                                        </div>
                                        <span class="text-[9px] px-1.5 py-0.5 rounded bg-blue-50 text-blue-600 border border-blue-200 dark:bg-blue-500/20 dark:text-blue-400 font-bold">Conectado</span>
                                    </a>

                                    <!-- Permissão 3: Academy (Perfil de Aluno) com validação de matrícula -->
                                    <button @click="openAcademyAluno(); userMenuDropdown = false"
                                            class="w-full flex items-center justify-between px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-slate-700 dark:text-slate-200 hover:text-slate-950 dark:hover:text-white transition cursor-pointer">
                                        <div class="flex items-center gap-2.5">
                                            <svg class="w-4 h-4 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                            <span>Perfil Aluno (Academy)</span>
                                        </div>
                                        <template x-if="currentUser && currentUser.has_matricula">
                                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-emerald-50 text-emerald-700 border border-emerald-200 dark:bg-emerald-500/20 dark:text-emerald-400 font-bold">Ativa</span>
                                        </template>
                                        <template x-if="!currentUser || !currentUser.has_matricula">
                                            <span class="text-[9px] px-1.5 py-0.5 rounded bg-amber-50 text-amber-800 border border-amber-200 dark:bg-amber-500/20 dark:text-amber-400 font-bold">Bloqueado</span>
                                        </template>
                                    </button>

                                    <!-- Se for Admin: Atalho para Admin Dashboard -->
                                    <template x-if="currentUser && (currentUser.role === 'admin' || currentUser.tipo === 'admin')">
                                        <a href="/admin-dashboard"
                                           class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-slate-100 dark:hover:bg-slate-800 text-left text-amber-700 dark:text-amber-300 hover:text-amber-900 font-semibold transition">
                                            <svg class="w-4 h-4 text-amber-500 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                            <span>Painel Administrativo</span>
                                        </a>
                                    </template>

                                    <!-- Logout -->
                                    <div class="pt-1 mt-1 border-t border-slate-100 dark:border-slate-800">
                                        <button @click="logout(); userMenuDropdown = false"
                                                class="w-full flex items-center gap-2.5 px-3 py-2 rounded-xl hover:bg-rose-50 dark:hover:bg-rose-500/10 text-left text-rose-600 dark:text-rose-400 transition font-medium cursor-pointer">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                            <span>Terminar Sessão (Sair)</span>
                                        </button>
                                    </div>
                                </div>
                            </div>"""

content = content.replace(old_dropdown, new_dropdown)

# 3. Update Mobile Menu Button and Drawer
content = content.replace(
    'class="mobile-menu-btn lg:hidden p-2 rounded-xl text-white hover:text-[#00a3e0] focus:outline-none transition"',
    'class="mobile-menu-btn lg:hidden p-2 rounded-xl text-slate-800 dark:text-white hover:text-[#0050f0] dark:hover:text-[#00a3e0] focus:outline-none transition"'
)

content = content.replace(
    'class="header-dropdown lg:hidden bg-[#071326]/95 backdrop-blur-2xl border-t border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">',
    'class="header-dropdown lg:hidden bg-white/95 dark:bg-[#071326]/95 text-slate-800 dark:text-white backdrop-blur-2xl border-t border-slate-200 dark:border-white/10 px-6 py-4 space-y-3 shadow-2xl mt-2 rounded-2xl">'
)

with open(filepath, 'w', encoding='utf-8') as f:
    f.write(content)

print("home.blade.php light mode dropdown updated successfully!")
