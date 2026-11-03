<!DOCTYPE html>
<html lang="pt">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="/toast.css">
    <script src="/toast.js"></script>
    <script src="/auth-session.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="admin-session-authenticated" content="{{ auth()->check() && auth()->user()->isAdmin() ? 'true' : 'false' }}">
    <title>RACHI — Soluções Inteligentes em Tecnologia, Gráfica, Formação & Gestão</title>
    <meta name="description" content="Ecossistema empresarial em Angola: RACHI Tec (tecnologia, websites e suporte de TI), RACHI Print (gráfica e brindes), RACHI Academy (formações executivas) e RACHI Human Capital (RH, contabilidade e legalização).">
    <link rel="canonical" href="https://rachi.ao/">
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="shortcut icon" href="/favicon.ico">
    <link rel="manifest" href="/site.webmanifest">

    <x-public-footer unit="global" />
    </div>

    <!-- ============================================================== -->
    <!-- ALERTA TOAST FLUTUANTE DINÂMICO (SUCESSO, LOGOUT, ERRO, AVISO)  -->
    <!-- ============================================================== -->
    <div x-show="loginToast.show"
         x-cloak
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 -translate-y-4 sm:translate-y-0 sm:translate-x-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:translate-x-0 scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 sm:translate-x-0 scale-100"
         x-transition:leave-end="opacity-0 -translate-y-4 sm:translate-y-0 sm:translate-x-4 scale-95"
         class="fixed top-20 right-4 sm:right-6 z-[2100] max-w-md w-full bg-slate-900/95 rounded-2xl p-4 shadow-2xl backdrop-blur-xl text-white border transition-colors duration-300"
         style="z-index: 2100 !important;"
         :class="{
             'border-emerald-500/50 shadow-emerald-500/10': loginToast.type === 'success',
             'border-[#0050f0]/60 shadow-blue-500/10': loginToast.type === 'logout',
             'border-rose-500/60 shadow-rose-500/15': loginToast.type === 'error',
             'border-amber-500/50 shadow-amber-500/10': loginToast.type === 'warning',
             'border-sky-500/50 shadow-sky-500/10': loginToast.type === 'info'
         }">
        <div class="flex items-start gap-3.5">
            <!-- Ícone Condicional por Tipo de Alerta -->
            <div class="w-9 h-9 rounded-xl flex items-center justify-center flex-shrink-0 border"
                 :class="{
                     'bg-emerald-500/20 text-emerald-400 border-emerald-500/30': loginToast.type === 'success',
                     'bg-blue-500/20 text-[#00a3e0] border-blue-500/30': loginToast.type === 'logout',
                     'bg-rose-500/20 text-rose-400 border-rose-500/30': loginToast.type === 'error',
                     'bg-amber-500/20 text-amber-400 border-amber-500/30': loginToast.type === 'warning',
                     'bg-sky-500/20 text-sky-400 border-sky-500/30': loginToast.type === 'info'
                 }">
                <!-- Sucesso (Checkmark) -->
                <template x-if="loginToast.type === 'success'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                </template>
                <!-- Logout / Desconectar -->
                <template x-if="loginToast.type === 'logout'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </template>
                <!-- Erro (Cross / Alert) -->
                <template x-if="loginToast.type === 'error'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </template>
                <!-- Aviso (Triangle) -->
                <template x-if="loginToast.type === 'warning'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </template>
                <!-- Info (Info circle) -->
                <template x-if="loginToast.type === 'info'">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
            </div>

            <!-- Conteúdo do Alerta -->
            <div class="flex-1 min-w-0">
                <div class="font-bold text-sm text-white flex items-center gap-2">
                    <span x-text="loginToast.title"></span>
                    <span class="text-[10px] font-extrabold uppercase px-2 py-0.5 rounded border"
                          :class="{
                              'bg-emerald-500/20 text-emerald-400 border-emerald-500/30': loginToast.type === 'success',
                              'bg-blue-500/20 text-blue-300 border-blue-500/30': loginToast.type === 'logout',
                              'bg-rose-500/20 text-rose-300 border-rose-500/30': loginToast.type === 'error',
                              'bg-amber-500/20 text-amber-300 border-amber-500/30': loginToast.type === 'warning',
                              'bg-sky-500/20 text-sky-300 border-sky-500/30': loginToast.type === 'info'
                          }"
                          x-text="loginToast.badge"></span>
                </div>
                <p class="text-xs text-slate-300 mt-0.5 leading-relaxed break-words" x-text="loginToast.message"></p>
            </div>

            <!-- Botão Fechar -->
            <button @click="closeLoginToast()"
                    class="text-slate-400 hover:text-white p-1 rounded-lg hover:bg-white/10 transition leading-none">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <!-- Barra de Progresso com Contagem Decrescente Automática -->
        <div class="w-full bg-white/10 h-1 rounded-full mt-3 overflow-hidden">
            <div :key="loginToast.progressKey"
                 class="toast-progress-bar h-full w-full"
                 :class="{
                     'bg-gradient-to-r from-emerald-500 to-teal-400': loginToast.type === 'success',
                     'bg-gradient-to-r from-[#0050f0] to-[#00a3e0]': loginToast.type === 'logout',
                     'bg-gradient-to-r from-rose-500 to-red-600': loginToast.type === 'error',
                     'bg-gradient-to-r from-amber-500 to-yellow-400': loginToast.type === 'warning',
                     'bg-gradient-to-r from-sky-500 to-blue-600': loginToast.type === 'info'
                 }">
            </div>
        </div>
    </div>

    <!-- ============================================================== -->
    <!-- MODAL: ENTRAR E CRIAR CONTA UNIFICADO (LIGHT & DARK MODE)      -->
    <!-- ============================================================== -->
    <div x-show="loginModal"
        class="fixed inset-0 bg-slate-950/75 dark:bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4 sm:p-6 overflow-y-auto transition-all duration-300 no-scrollbar scrollbar-none"
        style="z-index: 2000 !important;"
        x-cloak
        x-init="$watch('loginModal', val => document.body.style.overflow = val ? 'hidden' : '')"
        @click.self="loginModal = false">
        <div :class="authTab === 'register' ? 'max-w-xl max-h-[88vh] overflow-y-auto my-auto no-scrollbar scrollbar-none' : 'max-w-md my-auto overflow-hidden'"
             class="bg-white dark:bg-gradient-to-b dark:from-slate-900 dark:to-[#071326] border border-slate-200 dark:border-slate-700/80 rounded-3xl w-full p-5 sm:p-6 shadow-2xl text-slate-800 dark:text-white relative transition-all duration-300">
            <!-- Glow background effect -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/10 dark:bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-600/10 dark:bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Header: Logo & Botão Fechar -->
            <div class="flex justify-between items-center mb-4 relative z-10">
                <div class="flex items-center">
                    <!-- Dark Logo para Modo Claro -->
                    <img src="/images/logo-rachi-dark.png" 
                         onerror="this.onerror=null; this.src='/images/logo-rachi.png'"
                         alt="RACHI" class="h-8 object-contain dark:hidden">
                    <!-- Light Logo para Modo Escuro -->
                    <img src="/images/logo-rachi-light.png" 
                         onerror="this.onerror=null; this.src='/images/logo-rachi-light.png'"
                         alt="RACHI" class="h-8 object-contain hidden dark:block">
                </div>
                <button @click="loginModal = false" 
                        class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:bg-slate-800/80 dark:hover:bg-slate-700 dark:text-slate-400 dark:hover:text-white flex items-center justify-center transition text-xl font-bold cursor-pointer"
                        title="Fechar">
                    &times;
                </button>
            </div>

            <!-- Título e Descrição Dinâmicos -->
            <div class="relative z-10 mb-4">
                <template x-if="authTab === 'login'">
                    <div>
                        <h3 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white flex items-center gap-2">
                            <span>Iniciar sessão</span>
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 dark:text-slate-400 mt-1 leading-relaxed">
                            Todos os utilizadores acedem pelo mesmo login. Use o e-mail e a palavra-passe da sua conta RACHI.
                        </p>
                    </div>
                </template>
                <template x-if="authTab === 'register'">
                    <div>
                        <h3 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white flex items-center gap-2 mb-1">
                            <span>Criar conta</span>
                        </h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 dark:text-slate-400 leading-relaxed">
                            Registe-se como particular ou empresa. Enviaremos a palavra-passe temporária e o código de activação para o seu e-mail.
                        </p>
                    </div>
                </template>
            </div>

            <!-- Alerta de Erro Unificado (Com desaparecimento automático e transição suave) -->
            <div x-show="authError" x-cloak
                x-transition:enter="transition ease-out duration-300 transform"
                x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-300 transform"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                class="mb-3 p-3 rounded-xl bg-rose-50 border border-rose-200 text-rose-700 dark:bg-rose-500/15 dark:border-rose-500/40 dark:text-rose-300 text-xs flex items-center justify-between gap-2.5 relative z-10 shadow-sm">
                <div class="flex items-center gap-2.5 flex-1 min-w-0">
                    <svg class="w-4 h-4 flex-shrink-0 text-rose-500 dark:text-rose-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <span x-text="authError" class="leading-relaxed"></span>
                </div>
                <button type="button" @click="authError = ''" class="text-rose-400 hover:text-rose-600 dark:hover:text-rose-200 p-0.5 rounded cursor-pointer leading-none flex-shrink-0" title="Fechar">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <!-- ABA 1: FORMULÁRIO DE LOGIN -->
            <form x-show="authTab === 'login'" @submit.prevent="submitUnifiedLogin()" class="space-y-4 relative z-10">
                <!-- Campo E-mail -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1.5">
                        E-mail
                    </label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 dark:text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                            </svg>
                        </span>
                        <input type="email" x-model="authForm.email"
                               @input="authErrors.email = ''"
                               placeholder="ex: seu.email@empresa.com"
                               :class="authErrors.email ? 'border-rose-500 focus:border-rose-500' : 'border-slate-200 dark:border-slate-700 focus:border-[#0050f0]'"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border rounded-xl pl-10 pr-4 py-2.5 text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                    <p x-show="authErrors.email" x-text="authErrors.email" class="text-[11px] text-rose-500 font-semibold mt-1" x-cloak></p>
                </div>

                <!-- Campo Palavra-passe -->
                <div>
                    <div class="flex justify-between items-center mb-1.5">
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300">
                            Palavra-passe
                        </label>
                    </div>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400 dark:text-slate-500">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input :type="authForm.showPassword ? 'text' : 'password'" x-model="authForm.password"
                               @input="authErrors.password = ''"
                               placeholder="••••••••"
                               :class="authErrors.password ? 'border-rose-500 focus:border-rose-500' : 'border-slate-200 dark:border-slate-700 focus:border-[#0050f0]'"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border rounded-xl pl-10 pr-10 py-2.5 text-sm text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        <button type="button" @click="authForm.showPassword = !authForm.showPassword" 
                                class="absolute inset-y-0 right-0 flex items-center pr-3.5 text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 cursor-pointer">
                            <span x-text="authForm.showPassword ? '🙈' : '👁️'" class="text-xs"></span>
                        </button>
                    </div>
                    <p x-show="authErrors.password" x-text="authErrors.password" class="text-[11px] text-rose-500 font-semibold mt-1" x-cloak></p>
                </div>

                <!-- Botão de Ação: Login -->
                <button type="submit"
                        :disabled="authLoading"
                        class="w-full mt-2 py-3.5 px-4 rounded-xl bg-gradient-to-r from-[#0050f0] via-[#0284c7] to-[#00a3e0] hover:from-[#0040d0] hover:to-[#0274b5] text-white font-bold text-sm uppercase tracking-wider shadow-lg shadow-blue-500/25 transition-all flex items-center justify-center gap-2 transform active:scale-[0.99] cursor-pointer">
                    <template x-if="!authLoading">
                        <div class="flex items-center gap-2">
                            <span>Aceder à Plataforma</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="authLoading">
                        <div class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Validando credenciais...</span>
                        </div>
                    </template>
                </button>

                <!-- Footer Link -->
                <p class="text-center text-xs text-slate-500 dark:text-slate-400 pt-1">
                    Ainda não tem conta?
                    <button type="button" @click="authTab = 'register'; authError = ''"
                            class="font-bold text-[#0050f0] dark:text-amber-400 hover:underline cursor-pointer ml-1">
                        Criar conta gratuita
                    </button>
                </p>
            </form>

            <!-- ABA 2: FORMULÁRIO DE CRIAR CONTA -->
            <form x-show="authTab === 'register'" @submit.prevent="submitRegister()" class="space-y-3 relative z-10">
                <!-- Tipo de cliente -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        Tipo de cliente
                    </label>
                    <div class="grid grid-cols-2 gap-2 p-1 bg-slate-100 dark:bg-slate-800/90 rounded-xl border border-slate-200/80 dark:border-slate-700/60">
                        <button type="button" @click="registerForm.tipo_cliente = 'particular'"
                                :class="registerForm.tipo_cliente === 'particular' ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-white font-bold shadow-sm' : 'text-slate-600 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white'"
                                class="py-1.5 text-xs rounded-lg transition text-center cursor-pointer flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            <span>Particular</span>
                        </button>
                        <button type="button" @click="registerForm.tipo_cliente = 'empresa'"
                                :class="registerForm.tipo_cliente === 'empresa' ? 'bg-white dark:bg-slate-700 text-slate-900 dark:text-white font-bold shadow-sm' : 'text-slate-600 dark:text-slate-400 font-medium hover:text-slate-900 dark:hover:text-white'"
                                class="py-1.5 text-xs rounded-lg transition text-center cursor-pointer flex items-center justify-center gap-1.5">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                            <span>Empresa</span>
                        </button>
                    </div>
                </div>

                <!-- Nome Completo / Nome da Empresa & NIF (opcional) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            <span x-show="registerForm.tipo_cliente === 'empresa'">Nome da empresa</span>
                            <span x-show="registerForm.tipo_cliente !== 'empresa'">Nome completo</span>
                        </label>
                        <input type="text" x-model="registerForm.nome" required
                               :placeholder="registerForm.tipo_cliente === 'empresa' ? 'Empresa, Lda.' : 'O seu nome'"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            NIF (opcional)
                        </label>
                        <input type="text" x-model="registerForm.nif"
                               placeholder="Número de identificação fiscal"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                </div>

                <!-- E-mail -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                        E-mail
                    </label>
                    <input type="email" x-model="registerForm.email" required
                           placeholder="nome@gmail.com"
                           class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                </div>

                <!-- Telefone (opcional) & WhatsApp (opcional) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            Telefone (opcional)
                        </label>
                        <input type="tel" x-model="registerForm.telefone"
                               placeholder="+244 ..."
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            WhatsApp (opcional)
                        </label>
                        <input type="tel" x-model="registerForm.whatsapp"
                               placeholder="+244 ..."
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                    </div>
                </div>


                <!-- Morada (opcional) -->
                <div class="pt-2 border-t border-slate-200/70 dark:border-slate-700/60 space-y-2">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-800 dark:text-slate-200">
                            Endereço (opcional)
                        </label>
                        <p class="text-[11px] text-slate-500 dark:text-slate-400 dark:text-slate-400">
                            Se preencher a morada, indique pelo menos a província e o município.
                        </p>
                    </div>

                    <!-- Província e Município -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Província
                            </label>
                            <select x-model="registerForm.provincia"
                                    class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white transition outline-none cursor-pointer">
                                <option value="">Seleccione a província</option>
                                <option value="Luanda">Luanda</option>
                                <option value="Bengo">Bengo</option>
                                <option value="Benguela">Benguela</option>
                                <option value="Bié">Bié</option>
                                <option value="Cabinda">Cabinda</option>
                                <option value="Cuando Cubango">Cuando Cubango</option>
                                <option value="Cuanza Norte">Cuanza Norte</option>
                                <option value="Cuanza Sul">Cuanza Sul</option>
                                <option value="Cunene">Cunene</option>
                                <option value="Huambo">Huambo</option>
                                <option value="Huíla">Huíla</option>
                                <option value="Lunda Norte">Lunda Norte</option>
                                <option value="Lunda Sul">Lunda Sul</option>
                                <option value="Malanje">Malanje</option>
                                <option value="Moxico">Moxico</option>
                                <option value="Namibe">Namibe</option>
                                <option value="Uíge">Uíge</option>
                                <option value="Zaire">Zaire</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Município
                            </label>
                            <input type="text" x-model="registerForm.municipio"
                                   placeholder="Seleccione o município"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                    </div>

                    <!-- Distrito / Bairro e Rua -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Distrito / Bairro
                            </label>
                            <input type="text" x-model="registerForm.bairro"
                                   placeholder="Talatona"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Rua
                            </label>
                            <input type="text" x-model="registerForm.rua"
                                   placeholder="Rua / avenida"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                    </div>

                    <!-- N.º e Referência -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-2">
                        <div>
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                N.º
                            </label>
                            <input type="text" x-model="registerForm.numero"
                                   placeholder="Porta"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-1.5 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-[11px] font-semibold text-slate-600 dark:text-slate-400 mb-0.5">
                                Referência
                            </label>
                            <input type="text" x-model="registerForm.referencia"
                                   placeholder="Referência"
                                   class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 focus:ring-1 focus:ring-[#0050f0] dark:focus:ring-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 transition outline-none">
                        </div>
                    </div>
                </div>

                <!-- Palavra-passe & Confirmação -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 pt-1 border-t border-slate-200/60 dark:border-slate-700/60">
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            Palavra-passe
                        </label>
                        <input type="password" x-model="registerForm.password" required minlength="6"
                               placeholder="Mínimo 6 caracteres"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold uppercase tracking-wider text-slate-700 dark:text-slate-300 mb-1">
                            Confirmar Palavra-passe
                        </label>
                        <input type="password" x-model="registerForm.password_confirmation" required minlength="6"
                               placeholder="Repita a palavra-passe"
                               class="w-full bg-slate-50 dark:bg-slate-800/90 border border-slate-200 dark:border-slate-700 focus:border-[#0050f0] dark:focus:border-amber-400 rounded-xl px-3 py-2 text-xs text-slate-900 dark:text-white placeholder-slate-400 outline-none">
                    </div>
                </div>

                <!-- Termos e Privacidade (Lei 22/11 de Angola) -->
                <label class="flex items-start gap-2 text-[11px] text-slate-600 dark:text-slate-400 cursor-pointer pt-1">
                    <input type="checkbox" x-model="registerForm.terms_accepted" required class="mt-0.5 accent-[#0050f0]">
                    <span>Concordo com os <a href="/termos" target="_blank" class="text-blue-600 dark:text-amber-400 underline font-semibold">Termos de Uso</a> e a <a href="/privacidade" target="_blank" class="text-blue-600 dark:text-amber-400 underline font-semibold">Política de Privacidade</a> (Lei n.º 22/11 de Angola).</span>
                </label>

                <!-- Botão de Ação: Criar Conta -->
                <button type="submit"
                        :disabled="authLoading"
                        class="w-full mt-3 py-3.5 px-4 rounded-xl bg-gradient-to-r from-emerald-600 via-teal-600 to-cyan-600 hover:from-emerald-700 hover:to-cyan-700 text-white font-bold text-sm uppercase tracking-wider shadow-lg shadow-emerald-500/25 transition-all flex items-center justify-center gap-2 transform active:scale-[0.99] cursor-pointer">
                    <template x-if="!authLoading">
                        <div class="flex items-center gap-2">
                            <span>Criar conta</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                            </svg>
                        </div>
                    </template>
                    <template x-if="authLoading">
                        <div class="flex items-center gap-2">
                            <svg class="animate-spin h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            <span>Criando conta e gerando acessos...</span>
                        </div>
                    </template>
                </button>

                <!-- Footer Link -->
                <p class="text-center text-xs text-slate-500 dark:text-slate-400 dark:text-slate-400 pt-1">
                    Já tem uma conta registada?
                    <button type="button" @click="authTab = 'login'; authError = ''"
                            class="font-bold text-[#0050f0] dark:text-amber-400 hover:underline cursor-pointer ml-1">
                        Fazer login
                    </button>
                </p>
            </form>
        </div>
    </div>

    <!-- MODAL INFORMATIVO: MATRÍCULA NECESSÁRIA NA ACADEMY (RESPONDE A DARK MODE E MODO CLARO) -->
    <div x-show="matriculaModalOpen" 
         class="fixed inset-0 bg-slate-950/75 dark:bg-slate-950/85 backdrop-blur-md flex items-center justify-center p-4 sm:p-6 overflow-y-auto transition-all duration-300" style="z-index: 2000 !important;" 
         x-cloak 
         @click.self="matriculaModalOpen = false">
        <div class="bg-white dark:bg-gradient-to-b dark:from-slate-900 dark:to-[#071326] border border-slate-200 dark:border-slate-700/80 rounded-3xl max-w-md w-full p-6 sm:p-7 shadow-2xl text-slate-800 dark:text-white relative overflow-hidden transition-all duration-300">
            <!-- Glow background effect -->
            <div class="absolute -top-24 -right-24 w-48 h-48 bg-amber-500/10 dark:bg-amber-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-600/10 dark:bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

            <!-- Botão Fechar -->
            <div class="flex justify-end mb-1 relative z-10">
                <button @click="matriculaModalOpen = false" 
                        class="w-8 h-8 rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 dark:text-slate-400 hover:text-slate-800 dark:bg-slate-800/80 dark:hover:bg-slate-700 dark:text-slate-400 dark:hover:text-white flex items-center justify-center transition text-xl font-bold cursor-pointer"
                        title="Fechar">
                    &times;
                </button>
            </div>

            <!-- Ícone -->
            <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 border border-amber-200 dark:bg-amber-500/20 dark:text-amber-400 dark:border-amber-500/30 flex items-center justify-center mx-auto mb-4 relative z-10 shadow-sm">
                <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>

            <h3 class="text-xl font-bold text-center text-slate-900 dark:text-white mb-2 relative z-10">
                Matrícula Necessária
            </h3>
            
            <p class="text-xs text-slate-600 dark:text-slate-300 text-center leading-relaxed mb-6 relative z-10">
                O seu perfil de cliente está ativo para solicitar produtos e serviços, porém <strong class="text-amber-600 dark:text-amber-400 font-bold">ainda não possui matrícula ativa</strong> em nenhum curso da <strong>RACHI Academy</strong>.
                <br><br>
                Faça a sua matrícula para liberar acesso à Sala de Aula, aulas em vídeo, materiais e emissão de certificados.
            </p>

            <div class="space-y-2.5 relative z-10">
                <button @click="window.location.href = '/academy'" 
                        class="w-full py-3.5 px-4 rounded-xl bg-gradient-to-r from-amber-500 via-amber-600 to-amber-700 hover:from-amber-600 hover:to-amber-800 text-slate-950 font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 shadow-lg shadow-amber-500/20 transition cursor-pointer transform active:scale-[0.99]">
                    <span>Conhecer Cursos & Fazer Matrícula</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </button>
                <button @click="matriculaModalOpen = false" 
                        class="w-full py-2.5 px-4 rounded-xl bg-slate-100 hover:bg-slate-200 border border-slate-200 text-slate-700 dark:bg-slate-800/80 dark:hover:bg-slate-700 dark:border-slate-700 dark:text-slate-300 font-semibold text-xs transition cursor-pointer">
                    Voltar ao Painel do Cliente
                </button>
            </div>
        </div>
    </div>

    <!-- CART SLIDE-OVER -->
    <div x-show="cartDrawer" class="fixed inset-0 overflow-hidden" style="z-index: 2000 !important;" x-cloak>
        <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" @click="cartDrawer = false"></div>
        <div class="absolute inset-y-0 right-0 max-w-md w-full bg-white shadow-2xl flex flex-col">
            <div class="p-6 border-b flex justify-between items-center bg-[#071326] text-white">
                <h3 class="font-bold text-lg">Meu Carrinho</h3>
                <button @click="cartDrawer = false" class="text-slate-400 hover:text-white text-2xl">&times;</button>
            </div>
            <div class="p-6 flex-1 overflow-y-auto space-y-4">
                <template x-if="cart.length === 0">
                    <div class="text-center py-12 text-slate-400">
                        <i data-lucide="shopping-cart" class="w-12 h-12 mx-auto mb-2 opacity-50"></i>
                        <p>O seu carrinho está vazio.</p>
                    </div>
                </template>
                <template x-for="(item, index) in cart" :key="index">
                    <div class="flex items-center justify-between border-b pb-3">
                        <div class="flex items-center gap-3">
                            <img :src="item.image" class="w-12 h-12 object-contain rounded bg-slate-50 p-1 border">
                            <div>
                                <h5 class="text-sm font-bold text-slate-800" x-text="item.name"></h5>
                                <span class="text-xs text-slate-500 dark:text-slate-400"
                                    x-text="item.price.toLocaleString('pt-AO') + ' AOA'"></span>
                            </div>
                        </div>
                        <button @click="removeFromCart(index)"
                            class="text-rose-500 hover:text-rose-700 text-xs font-semibold">Remover</button>
                    </div>
                </template>
            </div>
            <div class="p-6 bg-slate-50 dark:bg-slate-900 border-t border-slate-200 dark:border-slate-800 space-y-3" x-show="cart.length > 0">
                <div class="flex justify-between font-bold text-base">
                    <span class="text-slate-700 dark:text-slate-300">Total:</span>
                    <span class="text-amber-600 dark:text-amber-400 font-black" x-text="cartTotal.toLocaleString('pt-AO') + ' AOA'"></span>
                </div>

                <!-- Formulário de Identificação do Cliente para Factura Proforma (quando não autenticado) -->
                <template x-if="!currentUser && cartCheckoutStep === 'identity'">
                    <div class="space-y-3 pt-2 border-t border-slate-200 dark:border-slate-700 text-xs">
                        <div class="p-2.5 rounded-xl bg-blue-50 dark:bg-blue-950/40 border border-blue-200 dark:border-blue-800 text-blue-800 dark:text-blue-300 text-[11px] leading-relaxed">
                            <strong>Factura Proforma Multicaixa:</strong> Introduza os dados de facturação para emitirmos o documento formal com coordenadas de pagamento.
                        </div>
                        <div>
                            <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Nome / Empresa *</label>
                            <input type="text" x-model="checkoutForm.name" required placeholder="O seu nome ou empresa" class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">E-mail *</label>
                                <input type="email" x-model="checkoutForm.email" required placeholder="para envio da proforma" class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Telefone *</label>
                                <input type="text" x-model="checkoutForm.phone" required placeholder="+244 ..." class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">NIF (Opcional)</label>
                                <input type="text" x-model="checkoutForm.document" placeholder="N.º fiscal" class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                            </div>
                            <div>
                                <label class="block font-semibold text-slate-700 dark:text-slate-300 mb-1">Município / Bairro</label>
                                <input type="text" x-model="checkoutForm.address" placeholder="Talatona, Luanda" class="w-full px-3 py-2 border rounded-lg text-xs bg-white dark:bg-slate-800 text-slate-900 dark:text-white outline-none">
                            </div>
                        </div>
                        <div class="pt-2 flex gap-2">
                            <button type="button" @click="submitProformaOrder()" class="flex-1 py-3 bg-gradient-to-r from-emerald-600 to-teal-600 hover:from-emerald-700 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition">
                                Emitir Factura Proforma
                            </button>
                            <button type="button" @click="cartCheckoutStep = 'cart'" class="px-3 py-3 border rounded-xl text-xs font-semibold text-slate-600 dark:text-slate-300">
                                Voltar
                            </button>
                        </div>
                        <p class="text-center text-[10px] text-slate-500 pt-1">
                            Já tem conta? <button type="button" @click="cartDrawer = false; loginModal = true; authTab = 'login'" class="text-blue-600 font-bold underline">Iniciar sessão</button>
                        </p>
                    </div>
                </template>

                <template x-if="currentUser || cartCheckoutStep === 'cart'">
                    <div class="space-y-2">
                        <button @click="processCartCheckout()"
                            class="w-full py-3.5 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold rounded-xl shadow-lg transition text-xs uppercase tracking-wider flex items-center justify-center gap-2">
                            <span>Gerar Factura Proforma (Multicaixa)</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </button>
                        <p class="text-[11px] text-center text-slate-500 dark:text-slate-400">
                            Facturação formal com coordenadas bancárias Multicaixa Express / IBAN.
                        </p>
                    </div>
                </template>
            </div>
        </div>
    </div>



    <!-- Script Implementation -->
    <script>
        function rachiApp() {
            return {
                currentUser: null,
                isLoggedIn: false,
                currentView: 'public',
                currentTab: 'home',
                identityModalOpen: false,
                matriculaModalOpen: false,
                mobileMenuOpen: false,
                solutionsOpen: false,
                loginModal: false,
                cartDrawer: false,
                productModalOpen: false,
                selectedStoreProduct: null,
                cartCheckoutStep: 'cart',
                checkoutForm: {
                    name: '',
                    email: '',
                    phone: '',
                    document: '',
                    address: ''
                },
                authTab: 'login',
                authForm: {
                    email: '',
                    password: '',
                    showPassword: false
                },
                authErrors: {
                    email: '',
                    password: ''
                },
                registerForm: {
                    tipo_cliente: 'particular',
                    nome: '',
                    nif: '',
                    email: '',
                    telefone: '',
                    whatsapp: '',
                    password: '',
                    password_confirmation: '',
                    provincia: '',
                    municipio: '',
                    terms_accepted: true
                },
                authError: '',
                authErrorTimer: null,
                authLoading: false,
                loginToast: {
                    show: false,
                    title: '',
                    message: '',
                    type: 'success',
                    badge: 'Ativo',
                    timer: null,
                    progressKey: 0
                },
                showLoginToast(title, message, type = 'success', duration = 6000) {
                    return RachiToast.show(message, { title, type, duration });
                },
                closeLoginToast() {
                    if (this.loginToast.timer) {
                        clearTimeout(this.loginToast.timer);
                        this.loginToast.timer = null;
                    }
                    this.loginToast.show = false;
                },
                toggleTheme() {
                    if (typeof window.toggleRachiTheme === 'function') {
                        this.customerDarkMode = window.toggleRachiTheme();
                    } else {
                        const isDark = document.documentElement.classList.toggle('dark');
                        this.customerDarkMode = isDark;
                        localStorage.setItem('rachi_theme', isDark ? 'dark' : 'light');
                    }
                },
                init() {
                    this.restoreUserSession();
                    this.customerDarkMode = document.documentElement.classList.contains('dark') || localStorage.getItem('rachi_theme') === 'dark';
                    window.addEventListener('rachi-theme-changed', (e) => {
                        this.customerDarkMode = e.detail && typeof e.detail.dark !== 'undefined' ? e.detail.dark : document.documentElement.classList.contains('dark');
                    });
                    this.$watch('authError', (val) => {
                        if (val) {
                            if (this.authErrorTimer) clearTimeout(this.authErrorTimer);
                            this.authErrorTimer = setTimeout(() => {
                                this.authError = '';
                                this.authErrorTimer = null;
                            }, 4500);
                        }
                    });

                    const urlParams = new URLSearchParams(window.location.search);
                    if (urlParams.get('login') === '1') {
                        this.loginModal = true;
                    }
                    if (window.location.hash) {
                        const targetId = window.location.hash.replace('#', '').toLowerCase();
                        if (['missao', 'visao', 'valores', 'identidade', 'missao-visao-valores'].includes(targetId)) {
                            this.identityModalOpen = true;
                        } else if (targetId) {
                            setTimeout(() => {
                                this.scrollToSection(targetId);
                            }, 300);
                        }
                    }
                    window.addEventListener('hashchange', () => {
                        const hash = window.location.hash.replace('#', '').toLowerCase();
                        if (['missao', 'visao', 'valores', 'identidade', 'missao-visao-valores'].includes(hash)) {
                            this.identityModalOpen = true;
                        }
                    });
                    window.openIdentityModal = () => { this.openIdentityModal(); };
                    window.closeIdentityModal = () => { this.closeIdentityModal(); };
                    this.$nextTick(() => lucide.createIcons());
                },

                async restoreUserSession() {
                    try {
                        this.currentUser = await window.RachiSession.session();
                        this.isLoggedIn = !!this.currentUser;
                        if (this.currentUser) this.loginModal = false;
                    } catch(e) {}
                },

                goToHome() {
                    this.solutionsOpen = false;
                    this.currentTab = 'home';
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;
                    try {
                        if (window.location.hash) {
                            history.pushState(null, '', window.location.pathname + window.location.search);
                        }
                    } catch (e) {}
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                },

                openIdentityModal() {
                    this.identityModalOpen = true;
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;
                    if (this.solutionsOpen) this.solutionsOpen = false;
                },
                closeIdentityModal() {
                    this.identityModalOpen = false;
                },
                openStore() { window.location.href = '/loja'; },
                openUnitPage(unit) {
                    if (unit === 'academy') { window.location.href = '/academy'; return; }
                    if (unit === 'capital') { window.location.href = '/capital'; return; }
                    if (unit === 'tec') { window.location.href = '/tec'; return; }
                    if (unit === 'print') { window.location.href = '/print'; return; }
                    window.location.href = '/' + unit;
                },
                openContacto() { window.location.href = '/contacto'; },

                openProductModal(p) {
                    this.selectedStoreProduct = p;
                    this.productModalOpen = true;
                    this.$nextTick(() => lucide.createIcons());
                },

                addToCartFromStore(p) {
                    this.cart.push({
                        id: Date.now(),
                        name: p.title || p.name,
                        category: p.category,
                        price: p.priceNum || parseFloat(String(p.price).replace(/[^0-9]/g, '')) || 10000,
                        image: p.image
                    });
                    this.cartDrawer = true;
                    this.$nextTick(() => lucide.createIcons());
                },

                featuredIndex: 0,
                featuredProducts: [
                    {
                        id: 1,
                        slug: "hp-elitebook-x360-1040-g8",
                        name: "HP Elitebook x360 1040 G8 (2-in-1)",
                        title: "HP Elitebook x360 1040 G8 (2-in-1)",
                        category: "Laptops & Computadores",
                        price: "1.489.000,29 AOA",
                        priceNum: 1489000.29,
                        oldPrice: "1.650.000,00 AOA",
                        discountPercent: "-10% OFF",
                        badge: "Mais Vendido",
                        image: "/images/hp-elitebook-studio.png"
                    },
                    {
                        id: 2,
                        slug: "smartwatch-lige-executivo",
                        name: "Smartwatch Lige Executivo Pro",
                        title: "Smartwatch Lige Executivo Pro",
                        category: "Smartwatches & Wearables",
                        price: "10.000,00 AOA",
                        priceNum: 10000.00,
                        oldPrice: "15.000,00 AOA",
                        discountPercent: "-33% OFF",
                        badge: "Destaque",
                        image: "/images/smartwatch-studio.png"
                    },
                    {
                        id: 3,
                        slug: "cabo-console-rs232-db9-rj45",
                        name: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        title: "Cabo Console RS232/DB9 para RJ45 1.5M",
                        category: "Cabos & Redes",
                        price: "16.989,89 AOA",
                        priceNum: 16989.89,
                        oldPrice: "18.000,00 AOA",
                        discountPercent: "-6% OFF",
                        badge: "Essencial TI",
                        image: "/images/cabo-console-studio.png"
                    },
                    {
                        id: 4,
                        slug: "tv-box-android-mxq-pro-4k",
                        name: "TV Box Android MXQ Pro 4K Ultra HD",
                        title: "TV Box Android MXQ Pro 4K Ultra HD",
                        category: "TV Box & Streaming",
                        price: "18.000,00 AOA",
                        priceNum: 18000.00,
                        oldPrice: "25.000,00 AOA",
                        discountPercent: "-28% OFF",
                        badge: "Promoção",
                        image: "/images/tvbox-studio.png"
                    }
                ],

                get visibleFeaturedProducts() {
                    const total = this.featuredProducts.length;
                    const maxStart = total - 3;
                    const start = Math.min(this.featuredIndex, Math.max(0, maxStart));
                    return this.featuredProducts.slice(start, start + 3);
                },

                nextFeaturedProduct() {
                    const maxIndex = this.featuredProducts.length - 3;
                    if (this.featuredIndex >= maxIndex) {
                        this.featuredIndex = 0;
                    } else {
                        this.featuredIndex++;
                    }
                    this.$nextTick(() => lucide.createIcons());
                },

                prevFeaturedProduct() {
                    const maxIndex = this.featuredProducts.length - 3;
                    if (this.featuredIndex <= 0) {
                        this.featuredIndex = Math.max(0, maxIndex);
                    } else {
                        this.featuredIndex--;
                    }
                    this.$nextTick(() => lucide.createIcons());
                },

                addToCartFromFeatured(p) {
                    this.cart.push({
                        id: Date.now(),
                        name: p.name,
                        category: p.category,
                        price: p.priceNum,
                        image: p.image
                    });
                    this.cartDrawer = true;
                    this.cartCheckoutStep = 'cart';
                    this.$nextTick(() => lucide.createIcons());
                },

                scrollToSection(id) {
                    if (id === 'academy') { window.location.href = '/academy'; return; }
                    if (id === 'capital' || id === 'tec' || id === 'print') { this.openUnitPage(id); return; }
                    if (id === 'contacto') { window.location.href = '/contacto'; return; }
                    this.currentTab = 'home';
                    this.solutionsOpen = false;
                    if (this.mobileMenuOpen) this.mobileMenuOpen = false;

                    if (id === 'home' || id === 'inicio' || !id) {
                        this.goToHome();
                        return;
                    }
                    try { window.history.pushState(null, '', '#' + id); } catch (e) {}
                    this.$nextTick(() => {
                        setTimeout(() => {
                            const el = document.getElementById(id);
                            if (el) {
                                const headerOffset = 75;
                                const elementPosition = el.getBoundingClientRect().top;
                                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                                window.scrollTo({ top: offsetPosition, behavior: 'smooth' });
                            }
                        }, 50);
                    });
                },

                cart: [],
                get cartTotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price || 0), 0);
                },

                removeFromCart(idx) {
                    this.cart.splice(idx, 1);
                },

                processCartCheckout() {
                    if (!this.currentUser) {
                        this.cartCheckoutStep = 'identity';
                        return;
                    }
                    this.submitProformaOrder();
                },

                submitProformaOrder() {
                    const clientName = this.currentUser ? this.currentUser.name : (this.checkoutForm.name || 'Cliente');
                    const clientEmail = this.currentUser ? this.currentUser.email : (this.checkoutForm.email || 'contacto@cliente.ao');

                    if (!this.currentUser && (!this.checkoutForm.name || !this.checkoutForm.email || !this.checkoutForm.phone)) {
                        RachiToast.warning('Por favor, preencha o Nome, E-mail e Telefone para emissão da Factura Proforma.');
                        return;
                    }

                    const proformaNumber = 'PRF-2026-' + Math.floor(10000 + Math.random() * 90000);
                    RachiToast.success('Factura Proforma ' + proformaNumber + ' gerada com sucesso para ' + clientName + '! Coordenadas de pagamento Multicaixa Express enviadas para ' + clientEmail + '.');
                    this.cart = [];
                    this.cartDrawer = false;
                    this.cartCheckoutStep = 'cart';

                    if (this.currentUser) {
                        setTimeout(() => {
                            window.location.href = '/portal#orders';
                        }, 1200);
                    }
                },

                async submitUnifiedLogin() {
                    this.authErrors.email = '';
                    this.authErrors.password = '';
                    this.authError = '';

                    const email = this.authForm.email.trim();
                    const password = this.authForm.password;

                    if (!email) {
                        this.authErrors.email = 'Por favor, introduza o seu endereço de e-mail.';
                        return;
                    }
                    if (!password) {
                        this.authErrors.password = 'Por favor, introduza a palavra-passe.';
                        return;
                    }

                    this.authLoading = true;
                    try {
                        this.currentUser = await RachiSession.login(email, password);
                        this.isLoggedIn = !!this.currentUser;
                        this.loginModal = false;
                        RachiToast.success('Sessão iniciada com sucesso. Bem-vindo(a), ' + (this.currentUser.name || 'Cliente') + '!');
                    } catch(e) {
                        this.authError = e.message || 'As credenciais fornecidas não conferem com os nossos registos.';
                    } finally {
                        this.authLoading = false;
                    }
                },

                async submitRegister() {
                    this.authError = '';
                    const f = this.registerForm;

                    if (!f.nome.trim()) {
                        this.authError = 'Por favor, introduza o seu nome completo ou nome da empresa.';
                        return;
                    }
                    if (!f.email.trim()) {
                        this.authError = 'Por favor, introduza um endereço de e-mail válido.';
                        return;
                    }
                    if (!f.password || f.password.length < 6) {
                        this.authError = 'A palavra-passe deve conter pelo menos 6 caracteres.';
                        return;
                    }
                    if (f.password !== f.password_confirmation) {
                        this.authError = 'A confirmação da palavra-passe não confere.';
                        return;
                    }
                    if (!f.terms_accepted) {
                        this.authError = 'Deverá aceitar os Termos de Uso e a Política de Privacidade (Lei 22/11).';
                        return;
                    }

                    this.authLoading = true;
                    try {
                        const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
                        const payload = {
                            name: f.nome.trim(),
                            email: f.email.trim().toLowerCase(),
                            password: f.password,
                            password_confirmation: f.password_confirmation,
                            type: f.tipo_cliente === 'empresa' ? 'company' : 'individual',
                            document: f.nif ? f.nif.trim() : null,
                            phone: f.telefone ? f.telefone.trim() : null
                        };

                        const response = await fetch('/registro', {
                            method: 'POST',
                            credentials: 'same-origin',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': token
                            },
                            body: JSON.stringify(payload)
                        });

                        const data = await response.json().catch(() => ({}));

                        if (response.ok && data.success) {
                            RachiToast.success('Conta criada com sucesso! A aceder ao seu portal...');
                            this.currentUser = data.user;
                            this.isLoggedIn = true;
                            this.loginModal = false;
                            setTimeout(() => {
                                window.location.href = data.redirect || '/portal';
                            }, 800);
                        } else {
                            let msg = data.message || 'Não foi possível concluir o registo. Verifique os dados.';
                            if (data.errors) {
                                msg = Object.values(data.errors).flat().join(' ');
                            }
                            this.authError = msg;
                        }
                    } catch(err) {
                        this.authError = 'Erro de ligação ao servidor. Tente novamente.';
                    } finally {
                        this.authLoading = false;
                    }
                },

                isAdminUser() {
                    if (!this.currentUser) return false;
                    const roleSlug = String(this.currentUser.role_slug || '').toLowerCase().trim();
                    const tipo = String(this.currentUser.tipo || '').toLowerCase().trim();
                    return ['admin', 'super_admin', 'super-admin'].includes(roleSlug) || tipo === 'admin';
                },

                isStudentUser() {
                    if (!this.currentUser) return false;
                    const roleSlug = String(this.currentUser.role_slug || '').toLowerCase().trim();
                    return roleSlug === 'student' || roleSlug === 'aluno' || this.currentUser.tipo === 'aluno';
                },

                isCustomerUser() {
                    if (!this.currentUser) return false;
                    return !this.isAdminUser();
                },

                canAccessStudentPortal() {
                    return this.isAdminUser() || !!(this.currentUser && (this.currentUser.has_matricula || this.currentUser.has_active_enrollment));
                },

                openAdminDashboard() {
                    this.userMenuDropdown = false;
                    if (!this.isAdminUser()) {
                        RachiToast.warning('Acesso Restrito: Apenas administradores podem aceder ao Painel Administrativo.');
                        return;
                    }
                    window.location.assign('/admin-dashboard');
                },

                openAcademyAluno() {
                    this.userMenuDropdown = false;
                    if (this.canAccessStudentPortal()) {
                        window.location.href = '/aluno-dashboard';
                    } else {
                        this.matriculaModalOpen = true;
                    }
                },

                async logout() {
                    await window.RachiSession.logout();
                }
            };
        }
    </script>
    @include('components.theme-toggle-fab')
</body>
</html>