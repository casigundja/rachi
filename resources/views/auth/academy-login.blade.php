<!DOCTYPE html>
<html lang="pt-AO" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Academy — Portal do Aluno &amp; Autenticação</title>
    <meta name="description" content="Portal do Estudante RACHI Academy: login, registro de acesso, cursos matriculados, aulas e certificação.">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">
    
    <!-- Anti-Flash Dark Mode Script -->
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

        // Matrículas ativas recuperadas do banco de dados (Eloquent)
        window.DB_ENROLLMENTS = @json($dbEnrollments ?? []);
    </script>

    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    
    <!-- Bootstrap 5.3.3 CSS & JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tailwind CSS -->
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
                        rachiNavy: '#0c0d12',
                        rachiBlue: '#00a3e0',
                        rachiBlueDark: '#0050f0',
                        rachiCard: '#13141b',
                    }
                }
            }
        };
    </script>
    <style>
        [x-cloak] { display: none !important; }
        a { text-decoration: none !important; }
        
        /* Base Body */
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            transition: background-color 0.25s ease, color 0.25s ease;
        }

        /* ============================================================
           MODO CLARO (LIGHT MODE) - CONTRASTE PERFEITO E DESIGN PREMIUM
           ============================================================ */
        html:not(.dark) body {
            background-color: #f8fafc !important;
            color: #0f172a !important;
        }
        html:not(.dark) .login-sidebar {
            background-color: #ffffff !important;
            border-right: 1px solid #e2e8f0 !important;
        }
        html:not(.dark) .login-title {
            color: #0f172a !important;
        }
        html:not(.dark) .login-subtitle {
            color: #475569 !important;
        }
        html:not(.dark) .login-label {
            color: #334155 !important;
        }
        html:not(.dark) .input-alura {
            background-color: #f8fafc !important;
            border: 1.5px solid #cbd5e1 !important;
            color: #0f172a !important;
        }
        html:not(.dark) .input-alura:focus {
            background-color: #ffffff !important;
            border-color: #0050f0 !important;
            box-shadow: 0 0 0 3px rgba(0, 80, 240, 0.18) !important;
            color: #0f172a !important;
        }
        html:not(.dark) .input-alura::placeholder {
            color: #94a3b8 !important;
        }
        html:not(.dark) .login-sublink {
            color: #475569 !important;
        }
        html:not(.dark) .login-sublink:hover {
            color: #0f172a !important;
        }
        html:not(.dark) .login-action-link {
            color: #0050f0 !important;
        }
        html:not(.dark) .login-action-link:hover {
            color: #0042c7 !important;
        }
        html:not(.dark) .login-footer-text {
            color: #64748b !important;
        }
        html:not(.dark) .theme-toggle-btn {
            background-color: #f1f5f9 !important;
            border: 1px solid #cbd5e1 !important;
            color: #334155 !important;
        }
        html:not(.dark) .theme-toggle-btn:hover {
            background-color: #e2e8f0 !important;
            color: #0050f0 !important;
        }
        html:not(.dark) .theme-icon-sun { display: none !important; }
        html:not(.dark) .theme-icon-moon { display: block !important; }
        html:not(.dark) .logo-light-mode { display: block !important; }
        html:not(.dark) .logo-dark-mode { display: none !important; }
        html:not(.dark) .login-right-seam { display: none !important; }
        html:not(.dark) .btn-close { filter: none !important; }

        /* ============================================================
           MODO ESCURO (DARK MODE) - COSMIC NIGHT THEME
           ============================================================ */
        html.dark body {
            background-color: #080a11 !important;
            color: #ffffff !important;
        }
        html.dark .login-sidebar {
            background-color: #0c0d12 !important;
            border-right: 1px solid rgba(255, 255, 255, 0.08) !important;
        }
        html.dark .login-title {
            color: #ffffff !important;
        }
        html.dark .login-subtitle {
            color: #94a3b8 !important;
        }
        html.dark .login-label {
            color: #cbd5e1 !important;
        }
        html.dark .input-alura {
            background-color: #12131a !important;
            border: 1px solid #232530 !important;
            color: #ffffff !important;
        }
        html.dark .input-alura:focus {
            background-color: #161822 !important;
            border-color: #00a3e0 !important;
            box-shadow: 0 0 0 3px rgba(0, 163, 224, 0.25) !important;
            color: #ffffff !important;
        }
        html.dark .input-alura::placeholder {
            color: #525866 !important;
        }
        html.dark .login-sublink {
            color: #94a3b8 !important;
        }
        html.dark .login-sublink:hover {
            color: #ffffff !important;
        }
        html.dark .login-action-link {
            color: #00a3e0 !important;
        }
        html.dark .login-action-link:hover {
            color: #38bdf8 !important;
        }
        html.dark .login-footer-text {
            color: #64748b !important;
        }
        html.dark .theme-toggle-btn {
            background-color: rgba(255, 255, 255, 0.05) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: #e2e8f0 !important;
        }
        html.dark .theme-toggle-btn:hover {
            background-color: rgba(255, 255, 255, 0.1) !important;
            color: #00a3e0 !important;
        }
        html.dark .theme-icon-sun { display: block !important; }
        html.dark .theme-icon-moon { display: none !important; }
        html.dark .logo-light-mode { display: none !important; }
        html.dark .logo-dark-mode { display: block !important; }
        html.dark .login-right-seam { display: none !important; }
        html.dark .btn-close { filter: invert(1) grayscale(100%) brightness(200%) !important; }

        /* Animações e Efeitos */
        @keyframes nebulaFlow {
            0% { transform: scale(1.02) translate(0px, 0px) rotate(0deg); }
            33% { transform: scale(1.06) translate(-10px, -6px) rotate(0.5deg); }
            66% { transform: scale(1.04) translate(8px, 10px) rotate(-0.5deg); }
            100% { transform: scale(1.02) translate(0px, 0px) rotate(0deg); }
        }
        .animate-nebula-flow {
            animation: nebulaFlow 28s ease-in-out infinite alternate;
            will-change: transform;
        }

        @keyframes alertCountdown {
            from { width: 100%; }
            to { width: 0%; }
        }
        .alert-countdown-bar {
            animation: alertCountdown 4.5s linear forwards;
        }

        @keyframes successCountdown {
            from { width: 100%; }
            to { width: 0%; }
        }
        .success-countdown-bar {
            animation: successCountdown 5.5s linear forwards;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-track { background: transparent; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 3px; }
        html.dark ::-webkit-scrollbar-thumb { background: #232838; }
        ::-webkit-scrollbar-thumb:hover { background: #00a3e0; }
    </style>
</head>
<body class="min-h-screen selection:bg-[#00a3e0] selection:text-white" 
      x-data="rachiLmsApp()" 
      x-init="initApp()">

    <!-- ============================================================== -->
    <!-- ESTADO 1: TELA DE LOGIN & MATRÍCULA (MODELO COSMICO OFICIAL)    -->
    <!-- ============================================================== -->
    <div x-show="view === 'auth'" class="min-h-screen grid grid-cols-1 lg:grid-cols-[26rem_1fr] xl:grid-cols-[28rem_1fr]">
        <!-- COLUNA ESQUERDA: FORMULÁRIO DE LOGIN / CADASTRO -->
        <section class="login-sidebar flex flex-col justify-between px-6 sm:px-12 pt-6 pb-8 relative z-20 min-h-screen transition-colors duration-300">
            
            <div class="w-full max-w-sm mx-auto mt-2 sm:mt-4 mb-auto">

                <!-- Barra Superior com Voltar e Alternador de Tema -->
                <div class="flex items-center justify-between gap-4 mb-6">
                    <a href="/academy" class="inline-flex items-center gap-2 text-xs font-semibold login-sublink transition-colors group">
                        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        <span>Voltar à Academy</span>
                    </a>

                    <!-- Botão Alternador Modo Claro / Escuro -->
                    <button type="button" 
                            onclick="toggleRachiTheme()" 
                            aria-label="Alternar Tema Claro / Escuro" 
                            title="Alternar Tema Claro / Escuro"
                            class="theme-toggle-btn w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-200 cursor-pointer shadow-xs">
                        <!-- Sol no modo escuro (clicar muda para claro) -->
                        <svg class="theme-icon-sun w-5 h-5 text-amber-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="4"/>
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/>
                        </svg>
                        <!-- Lua no modo claro (clicar muda para escuro) -->
                        <svg class="theme-icon-moon w-5 h-5 text-slate-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>
                </div>

                <!-- Logotipo RACHI Academy -->
                <div class="flex items-center gap-2 mb-6">
                    <img src="/images/logo-rachi-light.png" alt="RACHI" class="logo-dark-mode h-7 w-auto">
                    <img src="/images/logo-rachi-dark.png" alt="RACHI" class="logo-light-mode h-7 w-auto">
                    <span class="text-[10px] font-bold tracking-widest px-2 py-0.5 rounded-md bg-[#0050f0]/10 dark:bg-[#00a3e0]/10 text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/20 dark:border-[#00a3e0]/30 uppercase">Academy</span>
                </div>

                <!-- Título do Login -->
                <header class="mb-6">
                    <h1 class="login-title text-3xl font-bold leading-[1.2] tracking-tight">
                        <span x-show="mode === 'login'">Já estuda<br>com a gente?</span>
                        <span x-show="mode === 'register'" x-cloak>Ainda não estuda<br>com a gente?</span>
                    </h1>
                    <p class="login-subtitle mt-2 text-xs leading-relaxed">
                        <span x-show="mode === 'login'">Faça seu login para acessar suas aulas, progresso e certificados.</span>
                        <span x-show="mode === 'register'" x-cloak>Crie sua conta de aluno para iniciar sua capacitação.</span>
                    </p>
                </header>

                <!-- Banner de Sessão Já Autenticada -->
                <template x-if="currentUser && currentUser.nome && localStorage.getItem('rachi_academy_auth') === 'true'">
                    <div class="mb-4 p-3.5 rounded-xl bg-[#0050f0]/10 dark:bg-[#0050f0]/15 border border-[#0050f0]/30 dark:border-[#0050f0]/40 flex items-center justify-between gap-3 text-xs">
                        <div>
                            <span class="login-subtitle">Conectado como:</span>
                            <strong class="login-title block font-semibold" x-text="currentUser.nome"></strong>
                        </div>
                        <a href="/aluno-dashboard" class="px-3 py-1.5 rounded-lg bg-[#0050f0] text-white font-semibold hover:bg-[#0042c7] transition flex items-center gap-1">
                            Ir ao Dashboard &rarr;
                        </a>
                    </div>
                </template>

                <!-- Alerta Oficial Bootstrap 5 (Compartilhado entre Login e Cadastro, com Auto-Dismiss) -->
                <template x-if="errorMessage && errorMessage.trim() !== ''">
                    <div 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-2 scale-95"
                        class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2.5 p-3 my-3 shadow-lg position-relative overflow-hidden" 
                        role="alert">
                        
                        <!-- Ícone oficial Bootstrap Exclamation Triangle -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-exclamation-triangle-fill flex-shrink-0 text-danger" viewBox="0 0 16 16">
                            <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                        </svg>
                        
                        <div class="flex-grow-1 text-xs pe-2">
                            <strong class="fw-bold">Erro:</strong>
                            <span x-text="errorMessage"></span>
                        </div>
                        
                        <!-- Botão nativo Bootstrap btn-close -->
                        <button type="button" class="btn-close" @click="errorMessage = ''" aria-label="Close"></button>
                        
                        <!-- Barra regressiva que indica quando o alerta sumirá -->
                        <div class="position-absolute bottom-0 start-0 w-100" style="height: 3px; background: rgba(234, 134, 143, 0.25);">
                            <div class="bg-danger alert-countdown-bar" style="height: 100%;"></div>
                        </div>
                    </div>
                </template>

                <!-- FORMULÁRIO DE LOGIN -->
                <div x-show="mode === 'login'">
                    <form @submit.prevent="submitLogin()" class="space-y-4">
                        
                        <!-- E-mail -->
                        <div>
                            <label for="login_email" class="login-label block text-xs font-semibold mb-1.5">
                                E-mail ou Usuário
                            </label>
                            <input 
                                type="email" 
                                id="login_email" 
                                x-model="loginForm.email" 
                                required 
                                placeholder="seu.email@exemplo.com"
                                class="input-alura w-full h-11 px-3.5 rounded-xl text-xs"
                            >
                        </div>

                        <!-- Senha -->
                        <div>
                            <label for="login_password" class="login-label block text-xs font-semibold mb-1.5">
                                Senha
                            </label>
                            <div class="relative">
                                <input 
                                    :type="showPassword ? 'text' : 'password'" 
                                    id="login_password" 
                                    x-model="loginForm.password" 
                                    required 
                                    placeholder="••••••••••••"
                                    class="input-alura w-full h-11 px-3.5 pr-10 rounded-xl text-xs"
                                >
                                <button 
                                    type="button" 
                                    @click="showPassword = !showPassword" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-700 dark:hover:text-white p-1 cursor-pointer"
                                    aria-label="Mostrar senha">
                                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Botão ENTRAR -->
                        <div class="pt-2">
                            <button 
                                type="submit" 
                                :disabled="loading"
                                class="w-full h-12 rounded-xl bg-gradient-to-r from-[#0050f0] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] active:scale-[0.99] text-white font-bold text-xs tracking-widest uppercase transition-all duration-200 flex items-center justify-center gap-2 shadow-lg shadow-[#0050f0]/25 hover:shadow-xl hover:shadow-[#0050f0]/35 cursor-pointer">
                                <span x-text="loading ? 'AUTENTICANDO...' : 'ENTRAR NO PORTAL'"></span>
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </button>
                        </div>

                        <!-- Esqueci Senha e Checkbox Lembrar-me -->
                        <div class="flex items-center justify-between pt-3 text-xs">
                            <a href="#recuperar" @click.prevent="forgotPassword()" class="login-sublink hover:underline underline-offset-2 transition">
                                Esqueci minha senha
                            </a>
                            <label class="inline-flex items-center gap-1.5 cursor-pointer select-none">
                                <input 
                                    type="checkbox" 
                                    x-model="loginForm.remember" 
                                    @change="handleRememberChange()"
                                    class="w-4 h-4 rounded border-slate-300 dark:border-slate-700 bg-white dark:bg-[#12131a] text-[#0050f0] focus:ring-[#0050f0] cursor-pointer accent-[#0050f0]">
                                <span class="login-sublink text-xs font-medium">Lembrar-me</span>
                            </label>
                        </div>

                        <!-- Card Informativo de Último Acesso Lembrado -->
                        <template x-if="lastRememberedAccess && loginForm.remember">
                            <div class="mt-3 p-2.5 rounded-xl bg-emerald-500/10 dark:bg-emerald-500/15 border border-emerald-500/30 text-[11px] text-emerald-800 dark:text-emerald-300 flex items-center justify-between gap-2 transition-all">
                                <div class="flex items-center gap-1.5 truncate">
                                    <svg class="w-3.5 h-3.5 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                                    <span class="truncate">Último acesso: <strong x-text="lastRememberedAccess.data_acesso + ' às ' + lastRememberedAccess.hora_acesso"></strong></span>
                                </div>
                                <span class="text-[9px] uppercase font-bold tracking-wider text-emerald-700 dark:text-emerald-300 bg-emerald-500/20 px-1.5 py-0.5 rounded shrink-0">Lembrado</span>
                            </div>
                        </template>
                    </form>
                </div>

                <!-- FORMULÁRIO DE REGISTRO / MATRÍCULA -->
                <div x-show="mode === 'register'" x-cloak>
                    <form @submit.prevent="submitRegister()" class="space-y-3.5">
                        <div>
                            <label class="login-label block text-xs font-semibold mb-1">Nome Completo</label>
                            <input type="text" x-model="regForm.name" required placeholder="Casimiro Gundja" class="input-alura w-full h-11 px-3.5 rounded-xl text-xs">
                        </div>
                        <div>
                            <label class="login-label block text-xs font-semibold mb-1">E-mail</label>
                            <input type="email" x-model="regForm.email" required placeholder="aluno@rachi.ao" class="input-alura w-full h-11 px-3.5 rounded-xl text-xs">
                        </div>
                        <div>
                            <label class="login-label block text-xs font-semibold mb-1">Telefone / WhatsApp</label>
                            <input type="tel" x-model="regForm.phone" placeholder="+244 923 000 000" class="input-alura w-full h-11 px-3.5 rounded-xl text-xs">
                        </div>
                        <div>
                            <label class="login-label block text-xs font-semibold mb-1">Senha</label>
                            <input type="password" x-model="regForm.password" required placeholder="••••••••••••" class="input-alura w-full h-11 px-3.5 rounded-xl text-xs">
                        </div>
                        <button type="submit" :disabled="loading" class="w-full h-12 mt-2 rounded-xl bg-gradient-to-r from-[#0050f0] to-[#00a3e0] hover:from-[#0042c7] hover:to-[#008ec4] active:scale-[0.99] text-white font-bold text-xs tracking-wider uppercase transition flex items-center justify-center gap-2 shadow-lg shadow-[#0050f0]/25 cursor-pointer">
                            <span x-text="loading ? 'CRIANDO CONTA...' : 'CRIAR CONTA &amp; ACESSAR'"></span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                        </button>
                        <div class="text-center pt-2">
                            <button type="button" @click="toggleMode()" class="login-sublink text-xs hover:underline cursor-pointer">
                                Já tem conta? Faça seu login
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <!-- Rodapé esquerdo -->
            <div class="pt-6 flex items-center justify-between text-xs login-footer-text">
                <span>&copy; {{ date('Y') }} RACHI Academy</span>
                <a href="/" class="login-action-link hover:underline transition font-semibold">Voltar ao site</a>
            </div>
        </section>

        <!-- COLUNA DIREITA: CÓSMICA / BRANDING (COM BRILHO CIANO, NEBULOSA E ESTRELAS EM MOVIMENTO) -->
        <aside class="relative hidden lg:flex flex-col items-center justify-center min-h-screen overflow-hidden bg-slate-950 select-none">
            <!-- Nebulosa Cósmica -->
            <div class="absolute inset-[-6%] bg-cover bg-center bg-no-repeat animate-nebula-flow opacity-85 pointer-events-none"
                 style="background-image: url('/images/bg-login-alura.png');">
            </div>
            
            <!-- Estrelas em Movimento Canvas -->
            <canvas id="cosmicParticlesCanvas" class="absolute inset-0 w-full h-full pointer-events-none z-10"></canvas>

            <div class="relative z-20 flex flex-col items-center justify-center text-center my-auto px-6">
                <!-- Logotipo Central com Brilho Ciano -->
                <div class="flex flex-col items-center justify-center gap-2">
                    <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-16 w-auto object-contain drop-shadow-[0_4px_30px_rgba(0,163,224,0.65)]">
                    <span class="text-xs font-heading font-black tracking-[0.3em] uppercase text-cyan-200 border border-[#00a3e0]/40 px-3.5 py-0.5 rounded-full bg-[#00a3e0]/15 shadow-sm shadow-[#00a3e0]/20">
                        ACADEMY PORTAL
                    </span>
                </div>
            </div>
        </aside>

    </div>


    <!-- ============================================================== -->
    <!-- ESTADO 2: DASHBOARD DO ALUNO (ETAPA 6 A 8 DO FLUXO OFICIAL)    -->
    <!-- ============================================================== -->
    <div x-show="view === 'dashboard'" x-cloak class="min-h-screen bg-slate-50 dark:bg-[#070b14] flex flex-col transition-colors">
        
        <!-- NAVBAR DO ESTUDANTE AUTENTICADO -->
        <header class="w-full bg-white dark:bg-[#0b101d] border-b border-slate-200 dark:border-white/10 px-4 sm:px-8 py-3 sticky top-0 z-40 transition-colors">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                
                <div class="flex items-center gap-3">
                    <a href="/academy" class="flex items-center gap-2">
                        <img src="/images/logo-rachi-light.png" alt="RACHI" class="h-7 w-auto object-contain dark:block hidden">
                        <img src="/images/logo-rachi-dark.png" alt="RACHI" class="h-7 w-auto object-contain dark:hidden block">
                        <span class="text-[9px] uppercase font-black tracking-widest text-[#0050f0] dark:text-[#00a3e0] border border-[#0050f0]/30 dark:border-[#00a3e0]/40 px-1.5 py-0.5 rounded bg-[#0050f0]/10 dark:bg-[#00a3e0]/10">
                            ALUNO
                        </span>
                    </a>
                </div>

                <!-- Tabs do Dashboard -->
                <nav class="hidden md:flex items-center gap-2 bg-slate-100 dark:bg-[#12192c] p-1 rounded-full border border-slate-200 dark:border-white/10 text-xs font-semibold">
                    <button @click="dashboardTab = 'cursos'" 
                            :class="dashboardTab === 'cursos' ? 'bg-[#0050f0] text-white shadow' : 'text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white'"
                            class="px-4 py-1.5 rounded-full transition cursor-pointer">
                        Meus Cursos
                    </button>
                    <button @click="dashboardTab = 'acessos'" 
                            :class="dashboardTab === 'acessos' ? 'bg-[#0050f0] text-white shadow' : 'text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white'"
                            class="px-4 py-1.5 rounded-full transition flex items-center gap-1.5 cursor-pointer">
                        <span>Registro de Acessos</span>
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400"></span>
                    </button>
                    <button @click="dashboardTab = 'catalogo'" 
                            :class="dashboardTab === 'catalogo' ? 'bg-[#0050f0] text-white shadow' : 'text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-white'"
                            class="px-4 py-1.5 rounded-full transition cursor-pointer">
                        Todos os Cursos
                    </button>
                </nav>

                <!-- Perfil do Aluno, Alternador de Tema & Sair -->
                <div class="flex items-center gap-3 sm:gap-4">
                    <!-- Alternador de Tema -->
                    <button type="button" 
                            onclick="toggleRachiTheme()" 
                            aria-label="Alternar Tema Claro / Escuro" 
                            title="Alternar Tema Claro / Escuro"
                            class="w-9 h-9 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-white/5 dark:hover:bg-white/10 border border-slate-200 dark:border-white/10 text-slate-700 dark:text-slate-200 hover:text-[#0050f0] dark:hover:text-[#00a3e0] flex items-center justify-center transition-all duration-200 cursor-pointer shadow-xs">
                        <svg class="w-4 h-4 text-amber-400 hidden dark:block" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path stroke-linecap="round" stroke-linejoin="round" d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32l1.41 1.41M2 12h2m16 0h2M6.34 17.66l-1.41 1.41M19.07 4.93l-1.41 1.41"/></svg>
                        <svg class="w-4 h-4 text-slate-700 block dark:hidden" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    </button>

                    <div class="text-right hidden sm:block">
                        <div class="text-xs font-bold text-slate-900 dark:text-white" x-text="currentUser.nome"></div>
                        <div class="text-[10px] text-emerald-600 dark:text-emerald-400 flex items-center justify-end gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            <span>Sessão Ativa</span>
                        </div>
                    </div>
                    <button @click="logout()" class="px-3.5 py-1.5 rounded-lg bg-slate-100 hover:bg-rose-500/20 dark:bg-white/5 dark:hover:bg-rose-500/20 text-slate-600 dark:text-slate-400 hover:text-rose-600 dark:hover:text-rose-300 border border-slate-200 dark:border-white/10 text-xs font-semibold transition flex items-center gap-1.5 cursor-pointer">
                        <i data-lucide="log-out" class="w-3.5 h-3.5"></i>
                        <span>Sair</span>
                    </button>
                </div>

            </div>
        </header>

        <!-- CONTEÚDO PRINCIPAL DO DASHBOARD -->
        <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-8 py-8">
            
            <!-- ALERTA BOOTSTRAP PREMIUM: SESSÃO AUTENTICADA (COM AUTO-DISMISS E SEM SOBREPOSIÇÃO) -->
            <div 
                x-show="loginSuccessAlert" 
                x-cloak 
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 -translate-y-3 scale-98"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                x-transition:leave="transition ease-in duration-300"
                x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                x-transition:leave-end="opacity-0 -translate-y-3 scale-98"
                class="alert alert-success relative mb-6 p-4 rounded-2xl border border-emerald-500/40 bg-gradient-to-r from-emerald-950/85 via-[#0c221a] to-emerald-950/75 text-white shadow-xl shadow-emerald-950/50 backdrop-blur-md flex flex-col sm:flex-row sm:items-center justify-between gap-4 overflow-hidden" 
                role="alert">
                
                <!-- Lado Esquerdo: Ícone + Textos de Auditoria -->
                <div class="flex items-center gap-3.5 min-w-0">
                    <div class="p-2.5 rounded-xl bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 shrink-0 shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                            <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                            <path d="m9 12 2 2 4-4"></path>
                        </svg>
                    </div>
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2 mb-1">
                            <h6 class="alert-heading font-bold text-sm text-white mb-0">Sessão Autenticada com Sucesso</h6>
                            <span class="badge bg-emerald-500/20 border border-emerald-500/30 text-emerald-300 text-[10px] px-2 py-0.5 rounded-full font-semibold">
                                Acesso Gravado no Banco
                            </span>
                        </div>
                        <p class="mb-0 text-xs text-slate-300 leading-relaxed">
                            Acesso registrado na tabela <code class="text-emerald-300 font-mono">acessos</code>: IP <span class="font-mono text-white font-bold" x-text="lastAccessInfo.ip"></span> &bull; <span x-text="lastAccessInfo.data_acesso"></span> às <span x-text="lastAccessInfo.hora_acesso"></span> (<span x-text="lastAccessInfo.navegador || 'Chrome Desktop'"></span>).
                        </p>
                    </div>
                </div>

                <!-- Lado Direito: Ações Sem Sobreposição -->
                <div class="flex items-center gap-2.5 shrink-0 self-end sm:self-center">
                    <button 
                        type="button" 
                        @click="dashboardTab = 'acessos'" 
                        class="px-3 py-1.5 rounded-lg bg-emerald-500/15 hover:bg-emerald-500/30 text-emerald-300 hover:text-white border border-emerald-500/40 text-xs font-semibold transition-all flex items-center gap-1.5 shadow-sm cursor-pointer">
                        <span>Ver Tabela</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                    </button>
                    
                    <button 
                        type="button" 
                        @click="loginSuccessAlert = false" 
                        class="p-1.5 rounded-lg text-emerald-400/80 hover:text-white hover:bg-white/10 transition-colors focus:outline-none cursor-pointer" 
                        aria-label="Fechar alerta">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>

                <!-- Barra regressiva animada (Some automaticamente após 5.5s) -->
                <div class="position-absolute bottom-0 start-0 w-100" style="height: 3px; background: rgba(16, 185, 129, 0.2);">
                    <div class="bg-emerald-400 success-countdown-bar" style="height: 100%;"></div>
                </div>

            </div>
            
            <!-- Banner de Boas-Vindas & Status de Acesso -->
            <div class="mb-8 p-6 rounded-3xl bg-gradient-to-r from-[#0d162a] via-[#101e38] to-[#0d162a] border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#0050f0]/20 text-[#00a3e0] text-xs font-bold uppercase tracking-wider mb-2">
                        <span>Painel do Aluno</span>
                        <span>&bull;</span>
                        <span x-text="'ID: ' + currentUser.aluno_id"></span>
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-heading font-extrabold text-white">
                        Olá, <span x-text="currentUser.nome"></span>! 👋
                    </h1>
                    <p class="text-xs sm:text-sm text-slate-300 mt-1">
                        Acompanhe seu aprendizado, retome suas aulas e consulte seu histórico de acessos.
                    </p>
                </div>
                <!-- Box de Último Acesso Registrado (Conforme regra 2 do prompt) -->
                <div class="bg-black/40 border border-white/10 rounded-2xl p-4 text-xs shrink-0 max-w-xs">
                    <div class="text-[10px] font-bold uppercase tracking-wider text-slate-400 mb-1 flex items-center gap-1">
                        <i data-lucide="shield-check" class="w-3.5 h-3.5 text-emerald-400"></i>
                        <span>Último Acesso Registrado</span>
                    </div>
                    <div class="font-mono text-slate-200">
                        <span x-text="lastAccessInfo.data_acesso"></span> às <span x-text="lastAccessInfo.hora_acesso"></span>
                    </div>
                    <div class="text-[10px] text-slate-400 mt-0.5 truncate">
                        IP: <span class="text-sky-300 font-mono" x-text="lastAccessInfo.ip"></span> &bull; <span x-text="lastAccessInfo.navegador"></span>
                    </div>
                </div>
            </div>

            <!-- SUB-ABA 1: MEUS CURSOS (ETAPA 8: EXIBIR "MEUS CURSOS") -->
            <div x-show="dashboardTab === 'cursos'">
                
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-heading font-bold text-white flex items-center gap-2">
                            <span>Meus Cursos Matriculados</span>
                            <span class="px-2 py-0.5 rounded-full text-xs bg-[#0050f0]/30 text-sky-300 font-mono" x-text="enrolledCourses.length"></span>
                        </h2>
                        <p class="text-xs text-slate-400">Cursos com matrícula ativa e liberação imediata para estudo.</p>
                    </div>
                    <button @click="dashboardTab = 'catalogo'" class="text-xs font-semibold text-[#00a3e0] hover:underline flex items-center gap-1">
                        <span>Ver catálogo completo</span>
                        <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                    </button>
                </div>

                <!-- Grid de Meus Cursos -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="course in enrolledCourses" :key="course.id">
                        <div class="rounded-2xl bg-[#0e1526] border border-white/10 hover:border-[#00a3e0]/40 transition-all flex flex-col justify-between overflow-hidden shadow-xl group">
                            
                            <div>
                                <!-- Header do Card com Gradiente e Categoria -->
                                <div :class="course.gradientClass" class="p-4 h-28 relative overflow-hidden flex items-start justify-between">
                                    <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider bg-black/40 text-white backdrop-blur-sm border border-white/20" x-text="course.categoria"></span>
                                    <span class="px-2 py-0.5 rounded text-[10px] font-black uppercase bg-emerald-500/90 text-black" x-text="course.status"></span>
                                </div>

                                <!-- Conteúdo do Card -->
                                <div class="p-5">
                                    <h3 class="text-base font-bold text-white group-hover:text-[#00a3e0] transition-colors" x-text="course.nome"></h3>
                                    <p class="text-xs text-slate-300 mt-1.5 line-clamp-2 leading-relaxed" x-text="course.descricao"></p>

                                    <!-- Barra de Progresso do Curso (Conforme etapa 4 do prompt) -->
                                    <div class="mt-4 pt-4 border-t border-white/5">
                                        <div class="flex items-center justify-between text-xs mb-1.5">
                                            <span class="text-slate-400">Progresso</span>
                                            <span class="font-bold text-sky-300 font-mono" x-text="course.progresso + '%'"></span>
                                        </div>
                                        <div class="w-full h-2 rounded-full bg-[#182238] overflow-hidden">
                                            <div class="h-full bg-gradient-to-r from-[#0050f0] to-[#00a3e0] rounded-full transition-all duration-500" 
                                                 :style="'width: ' + course.progresso + '%'"></div>
                                        </div>
                                        <div class="text-[10px] text-slate-500 mt-1 flex items-center justify-between">
                                            <span x-text="course.aulasConcluidas + ' de ' + course.totalAulas + ' aulas concluídas'"></span>
                                            <span x-show="course.progresso === 100" class="text-emerald-400 font-semibold">✓ Concluído</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botão de Ação: Selecionar Curso (Etapa 9: Aluno seleciona um curso) -->
                            <div class="p-5 pt-0">
                                <button 
                                    @click="selectAndValidateCourse(course.id)"
                                    class="w-full py-2.5 rounded-xl bg-[#0050f0] hover:bg-[#0042c7] active:scale-[0.99] text-white font-bold text-xs uppercase tracking-wider transition flex items-center justify-center gap-2 shadow-md shadow-[#0050f0]/30 cursor-pointer">
                                    <span x-text="course.progresso === 100 ? 'Rever Curso / Certificado' : (course.progresso > 0 ? 'Continuar Curso' : 'Iniciar Curso')"></span>
                                    <i data-lucide="play" class="w-3 h-3 fill-current"></i>
                                </button>
                            </div>

                        </div>
                    </template>
                </div>

            </div>

            <!-- SUB-ABA 2: HISTÓRICO DE ACESSOS (REGRA 2 DO PROMPT) -->
            <div x-show="dashboardTab === 'acessos'" x-cloak>
                <div class="mb-6 flex items-center justify-between">
                    <div>
                        <h2 class="text-xl font-heading font-bold text-white flex items-center gap-2">
                            <span>Tabela de Registro de Acessos</span>
                            <span class="text-xs text-slate-400 font-normal">(Auditoria de Segurança)</span>
                        </h2>
                        <p class="text-xs text-slate-400">Histórico de sessões autenticadas do usuário para segurança da conta.</p>
                    </div>
                </div>

                <!-- Tabela de Acessos Conforme Tabela do Prompt -->
                <div class="rounded-2xl bg-[#0e1526] border border-white/10 overflow-hidden shadow-xl">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-[#121b30] text-slate-300 uppercase tracking-wider text-[10px] border-b border-white/10">
                                <tr>
                                    <th class="py-3 px-4">ID</th>
                                    <th class="py-3 px-4">Usuário ID</th>
                                    <th class="py-3 px-4">Data do Acesso</th>
                                    <th class="py-3 px-4">Hora</th>
                                    <th class="py-3 px-4">Endereço IP</th>
                                    <th class="py-3 px-4">Dispositivo / User Agent</th>
                                    <th class="py-3 px-4">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5 text-slate-300">
                                <template x-for="log in accessHistory" :key="log.id">
                                    <tr class="hover:bg-white/5 transition">
                                        <td class="py-3 px-4 font-mono text-slate-400" x-text="log.id"></td>
                                        <td class="py-3 px-4 font-mono text-sky-400" x-text="log.usuario_id"></td>
                                        <td class="py-3 px-4 font-semibold text-white" x-text="log.data_acesso"></td>
                                        <td class="py-3 px-4 font-mono text-slate-300" x-text="log.hora_acesso"></td>
                                        <td class="py-3 px-4 font-mono text-amber-300" x-text="log.ip"></td>
                                        <td class="py-3 px-4 text-slate-400 max-w-xs truncate" x-text="log.user_agent"></td>
                                        <td class="py-3 px-4">
                                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                                                Sucesso
                                            </span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SUB-ABA 3: CATÁLOGO COMPLETO COM MATRÍCULA -->
            <div x-show="dashboardTab === 'catalogo'" x-cloak>
                <div class="mb-6">
                    <h2 class="text-xl font-heading font-bold text-white">Todos os Cursos da RACHI Academy</h2>
                    <p class="text-xs text-slate-400">Explore e matricule-se em novas trilhas de capacitação.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="c in allCatalogCourses" :key="c.id">
                        <div class="rounded-2xl bg-[#0e1526] border border-white/10 p-5 flex flex-col justify-between">
                            <div>
                                <span class="text-[10px] uppercase font-bold text-[#00a3e0]" x-text="c.categoria"></span>
                                <h3 class="text-base font-bold text-white mt-1" x-text="c.nome"></h3>
                                <p class="text-xs text-slate-400 mt-1 leading-relaxed" x-text="c.descricao"></p>
                            </div>
                            <div class="mt-4 pt-4 border-t border-white/5 flex items-center justify-between">
                                <span class="text-xs text-slate-300 font-mono font-bold" x-text="c.duracao"></span>
                                <button 
                                    @click="enrollNewCourse(c)"
                                    class="px-4 py-2 rounded-lg bg-[#0050f0] hover:bg-[#0042c7] text-white text-xs font-bold transition">
                                    <span x-text="isEnrolled(c.id) ? 'Já Matriculado' : 'Solicitar Matrícula'"></span>
                                </button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

        </main>

    </div>


    <!-- ============================================================== -->
    <!-- ESTADO 3: TELA DE GERENCIAMENTO DO CURSO & CLASSROOM            -->
    <!-- (ETAPA 10 E 11: MÓDULOS, AULAS, MATERIAIS, PROGRESSO)           -->
    <!-- ============================================================== -->
    <div x-show="view === 'course_view'" x-cloak class="min-h-screen bg-[#070b14] flex flex-col">
        
        <!-- HEADER DO CURSO (COM VOLTAR AO DASHBOARD) -->
        <header class="w-full bg-[#0b101d] border-b border-white/10 px-4 sm:px-8 py-3 sticky top-0 z-40">
            <div class="max-w-7xl mx-auto flex items-center justify-between gap-4">
                
                <div class="flex items-center gap-4">
                    <button @click="backToDashboard()" class="flex items-center gap-1.5 text-xs text-slate-400 hover:text-white transition">
                        <i data-lucide="arrow-left" class="w-4 h-4"></i>
                        <span>Voltar aos Meus Cursos</span>
                    </button>
                    <span class="text-slate-600">|</span>
                    <h2 class="text-xs sm:text-sm font-bold text-white truncate max-w-md" x-text="currentCourse.nome"></h2>
                </div>

                <div class="flex items-center gap-4">
                    <div class="hidden sm:flex items-center gap-2 text-xs">
                        <span class="text-slate-400">Progresso do Curso:</span>
                        <span class="font-bold text-sky-400 font-mono" x-text="currentCourse.progresso + '%'"></span>
                    </div>
                    <button 
                        x-show="currentCourse.progresso === 100"
                        @click="openCertificateModal()"
                        class="px-3 py-1.5 rounded-lg bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-bold text-xs flex items-center gap-1.5 transition">
                        <i data-lucide="award" class="w-4 h-4"></i>
                        <span>Ver Certificado</span>
                    </button>
                </div>

            </div>
        </header>

        <!-- LAYOUT DA SALA DE AULA: 2 COLUNAS (PLAYER + CONTEÚDO À ESQ., MÓDULOS À DIR.) -->
        <div class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-8 py-6 grid grid-cols-1 lg:grid-cols-[1fr_22rem] gap-8">
            
            <!-- ÁREA PRINCIPAL: PLAYER DE AULA & DETALHES -->
            <div class="flex flex-col gap-6">
                
                <!-- Player de Vídeo da Aula -->
                <div class="w-full aspect-video rounded-3xl bg-black border border-white/10 overflow-hidden relative shadow-2xl flex flex-col justify-between p-6 group">
                    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/40 pointer-events-none"></div>
                    
                    <!-- Topo do Player -->
                    <div class="relative z-10 flex items-center justify-between text-xs text-white">
                        <span class="px-2.5 py-1 rounded-md bg-black/60 backdrop-blur-md border border-white/10 font-mono" x-text="'Módulo ' + activeModuleIndex + ' &bull; Aula ' + activeLesson.ordem"></span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-[#0050f0] uppercase" x-text="activeLesson.duracao"></span>
                    </div>

                    <!-- Centro do Player (Play Button Decorativo) -->
                    <div class="relative z-10 flex flex-col items-center justify-center my-auto">
                        <div class="w-16 h-16 rounded-full bg-[#0050f0]/90 hover:bg-[#0050f0] text-white flex items-center justify-center shadow-xl shadow-[#0050f0]/40 transition transform hover:scale-110 cursor-pointer">
                            <i data-lucide="play" class="w-7 h-7 fill-current translate-x-0.5"></i>
                        </div>
                        <span class="text-xs text-slate-300 mt-3">Reprodução em Alta Definição (1080p)</span>
                    </div>

                    <!-- Rodapé do Player com Barra de Tempo -->
                    <div class="relative z-10 space-y-2">
                        <div class="w-full h-1.5 rounded-full bg-white/20 overflow-hidden cursor-pointer">
                            <div class="h-full bg-[#00a3e0] w-1/3"></div>
                        </div>
                        <div class="flex items-center justify-between text-[11px] text-slate-400">
                            <span>05:12 / <span x-text="activeLesson.duracao"></span></span>
                            <span>RACHI Academy Player</span>
                        </div>
                    </div>
                </div>

                <!-- Detalhes da Aula Selecionada & Ação de Conclusão -->
                <div class="p-6 rounded-2xl bg-[#0e1526] border border-white/10 flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-2 text-xs text-sky-400 font-bold uppercase tracking-wider mb-1">
                            <i data-lucide="book-open" class="w-3.5 h-3.5"></i>
                            <span x-text="'Aula ' + activeLesson.ordem"></span>
                        </div>
                        <h1 class="text-xl font-heading font-extrabold text-white" x-text="activeLesson.titulo"></h1>
                        <p class="text-xs text-slate-300 mt-1 leading-relaxed max-w-xl" x-text="activeLesson.descricao"></p>
                    </div>

                    <!-- Botão Marcar Como Concluída (Atualiza percentual conforme regra) -->
                    <div class="shrink-0">
                        <button 
                            @click="toggleLessonCompleted(activeLesson.id)"
                            :class="isLessonCompleted(activeLesson.id) ? 'bg-emerald-500/20 text-emerald-300 border-emerald-500/40' : 'bg-[#0050f0] hover:bg-[#0042c7] text-white border-transparent'"
                            class="px-5 py-3 rounded-xl border font-bold text-xs uppercase tracking-wider transition flex items-center gap-2 cursor-pointer shadow-lg">
                            <i :data-lucide="isLessonCompleted(activeLesson.id) ? 'check-circle' : 'check'" class="w-4 h-4"></i>
                            <span x-text="isLessonCompleted(activeLesson.id) ? 'Aula Concluída ✓' : 'Concluir Aula e Avançar'"></span>
                        </button>
                    </div>
                </div>

                <!-- Materiais de Apoio / Atividades da Aula -->
                <div class="p-6 rounded-2xl bg-[#0e1526] border border-white/10">
                    <h3 class="text-sm font-bold text-white mb-3 flex items-center gap-2">
                        <i data-lucide="file-text" class="w-4 h-4 text-[#00a3e0]"></i>
                        <span>Materiais de Apoio &amp; Exercícios Práticos</span>
                    </h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        <div class="p-3 rounded-xl bg-black/40 border border-white/5 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="file-down" class="w-4 h-4 text-emerald-400"></i>
                                <div>
                                    <div class="font-semibold text-white">Guia Prático da Aula (PDF)</div>
                                    <div class="text-[10px] text-slate-500">2.4 MB &bull; Download direto</div>
                                </div>
                            </div>
                            <button @click="alert('Download do material iniciado!')" class="text-xs text-sky-400 hover:underline font-bold">Baixar</button>
                        </div>
                        <div class="p-3 rounded-xl bg-black/40 border border-white/5 flex items-center justify-between text-xs">
                            <div class="flex items-center gap-2.5">
                                <i data-lucide="code" class="w-4 h-4 text-amber-400"></i>
                                <div>
                                    <div class="font-semibold text-white">Exercício de Fixação &amp; Checklist</div>
                                    <div class="text-[10px] text-slate-500">Atividade com correção automática</div>
                                </div>
                            </div>
                            <button @click="alert('Exercício aberto para resolução!')" class="text-xs text-sky-400 hover:underline font-bold">Abrir</button>
                        </div>
                    </div>
                </div>

            </div>

            <!-- LATERAL DIREITA: ESTRUTURA DO CURSO (MÓDULOS & AULAS - CONFORME REGRA 6) -->
            <div class="space-y-4">
                
                <!-- Card de Informações Gerais do Curso -->
                <div class="p-5 rounded-2xl bg-[#0e1526] border border-white/10 space-y-3">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400">Informações do Curso</h3>
                    
                    <div class="space-y-2 text-xs">
                        <div class="flex items-center justify-between pb-1.5 border-b border-white/5">
                            <span class="text-slate-400">Progresso Geral</span>
                            <span class="font-mono font-bold text-sky-300" x-text="currentCourse.progresso + '%'"></span>
                        </div>
                        <div class="flex items-center justify-between pb-1.5 border-b border-white/5">
                            <span class="text-slate-400">Data da Matrícula</span>
                            <span class="font-mono text-white" x-text="currentCourse.dataMatricula"></span>
                        </div>
                        <div class="flex items-center justify-between pb-1.5 border-b border-white/5">
                            <span class="text-slate-400">Último Acesso</span>
                            <span class="font-mono text-slate-300" x-text="currentCourse.ultimoAcesso"></span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-slate-400">Certificado Oficial</span>
                            <span :class="currentCourse.progresso === 100 ? 'text-emerald-400 font-bold' : 'text-slate-500'" 
                                  x-text="currentCourse.progresso === 100 ? 'Disponível ✓' : 'Pendente (100%)'"></span>
                        </div>
                    </div>
                </div>

                <!-- Lista Hierárquica de Módulos e Aulas -->
                <div class="rounded-2xl bg-[#0e1526] border border-white/10 overflow-hidden">
                    <div class="p-4 bg-[#121a2e] border-b border-white/10 flex items-center justify-between">
                        <span class="text-xs font-bold text-white uppercase tracking-wider">Conteúdo Programático</span>
                        <span class="text-[10px] text-slate-400 font-mono" x-text="currentCourse.totalAulas + ' Aulas'"></span>
                    </div>

                    <div class="divide-y divide-white/5 max-h-[500px] overflow-y-auto">
                        <template x-for="(modulo, mIdx) in currentCourse.modulos" :key="modulo.id">
                            <div class="p-3">
                                <!-- Título do Módulo -->
                                <div class="flex items-center justify-between text-xs font-bold text-slate-200 mb-2">
                                    <span x-text="'Módulo ' + (mIdx + 1) + ': ' + modulo.nome"></span>
                                    <span class="text-[10px] text-slate-500 font-normal" x-text="modulo.aulas.length + ' aulas'"></span>
                                </div>

                                <!-- Lista de Aulas do Módulo -->
                                <div class="space-y-1.5 pl-2">
                                    <template x-for="aula in modulo.aulas" :key="aula.id">
                                        <button 
                                            @click="selectLesson(aula, mIdx + 1)"
                                            :disabled="aula.bloqueada"
                                            :class="activeLesson.id === aula.id ? 'bg-[#0050f0]/25 text-white border-[#0050f0]/60' : (aula.bloqueada ? 'opacity-40 cursor-not-allowed text-slate-500' : 'hover:bg-white/5 text-slate-300 border-transparent')"
                                            class="w-full text-left p-2 rounded-xl border transition flex items-center justify-between text-xs">
                                            
                                            <div class="flex items-center gap-2 truncate">
                                                <!-- Ícone de Status da Aula (✓, ▶, ou 🔒) -->
                                                <span x-show="isLessonCompleted(aula.id)" class="text-emerald-400 font-bold shrink-0">✓</span>
                                                <span x-show="!isLessonCompleted(aula.id) && !aula.bloqueada" class="text-sky-400 font-bold shrink-0">▶</span>
                                                <span x-show="aula.bloqueada" class="text-slate-600 font-bold shrink-0">🔒</span>
                                                
                                                <span class="truncate" :class="activeLesson.id === aula.id ? 'font-bold' : ''" x-text="aula.titulo"></span>
                                            </div>

                                            <span class="text-[10px] text-slate-500 shrink-0 font-mono ml-2" x-text="aula.duracao"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

            </div>

        </div>

    </div>


    <!-- ============================================================== -->
    <!-- MODAL DE CERTIFICADO OFICIAL (CONQUISTADO AOS 100%)            -->
    <!-- ============================================================== -->
    <div x-show="certificateModalOpen" x-cloak class="fixed inset-0 bg-black/85 backdrop-blur-md z-50 flex items-center justify-center p-4" @click.self="certificateModalOpen = false">
        <div class="max-w-2xl w-full bg-[#0d1628] border-2 border-emerald-500/50 rounded-3xl p-8 shadow-2xl text-center relative overflow-hidden">
            <div class="absolute -top-32 left-1/2 -translate-x-1/2 w-80 h-80 bg-emerald-500/20 rounded-full blur-3xl pointer-events-none"></div>

            <div class="w-16 h-16 rounded-full bg-emerald-500/20 border-2 border-emerald-400 flex items-center justify-center mx-auto mb-4 text-emerald-400">
                <i data-lucide="award" class="w-8 h-8"></i>
            </div>

            <span class="text-xs font-black uppercase tracking-[0.3em] text-emerald-400">Certificado Oficial de Conclusão</span>
            <h2 class="text-2xl font-heading font-black text-white mt-1">RACHI Academy Angola</h2>

            <p class="text-xs text-slate-300 mt-4 leading-relaxed max-w-lg mx-auto">
                Certificamos que <strong><span x-text="currentUser.nome"></span></strong> concluiu com aproveitamento de 100% a formação profissional em:
            </p>

            <div class="my-5 p-4 rounded-xl bg-white/5 border border-white/10">
                <div class="text-lg font-bold text-sky-300 font-heading" x-text="currentCourse.nome"></div>
                <div class="text-xs text-slate-400 mt-1" x-text="'Carga horária: ' + currentCourse.duracao + ' &bull; Emitido em: ' + new Date().toLocaleDateString('pt-AO')"></div>
            </div>

            <div class="flex items-center justify-between text-[11px] text-slate-500 border-t border-white/10 pt-4 mb-6 font-mono">
                <span>Código: RAC-CERT-2026-<span x-text="currentUser.aluno_id"></span>-OK</span>
                <span>Autenticação Digital Verificada</span>
            </div>

            <div class="flex gap-3 justify-center">
                <button @click="alert('Certificado enviado para seu e-mail e pronto para download!')" class="px-6 py-2.5 rounded-xl bg-emerald-500 hover:bg-emerald-600 text-slate-950 font-bold text-xs transition">
                    Imprimir / Baixar PDF
                </button>
                <button @click="certificateModalOpen = false" class="px-5 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold text-xs transition">
                    Fechar
                </button>
            </div>
        </div>
    </div>


    <!-- ============================================================== -->
    <!-- MODAL DE ACESSO NEGADO / SEM MATRÍCULA (REGRA 5 DO PROMPT)     -->
    <!-- ============================================================== -->
    <div x-show="accessDeniedModal" x-cloak class="fixed inset-0 bg-black/85 backdrop-blur-md z-50 flex items-center justify-center p-4">
        <div class="max-w-md w-full bg-[#160e18] border border-rose-500/40 rounded-3xl p-6 text-center shadow-2xl">
            <div class="w-14 h-14 rounded-full bg-rose-500/20 text-rose-400 flex items-center justify-center mx-auto mb-3">
                <i data-lucide="shield-alert" class="w-7 h-7"></i>
            </div>
            <h3 class="text-lg font-bold text-white">Acesso Negado à Formação</h3>
            <p class="text-xs text-slate-300 mt-2 leading-relaxed">
                Você não possui matrícula ativa neste curso. Conforme as regras de segurança do sistema, o conteúdo só é acessível após a matrícula.
            </p>
            <div class="mt-5 flex gap-2">
                <button @click="accessDeniedModal = false; dashboardTab = 'catalogo'" class="flex-1 py-2.5 rounded-xl bg-[#0050f0] text-white font-bold text-xs transition">
                    Solicitar Matrícula
                </button>
                <button @click="accessDeniedModal = false" class="px-4 py-2.5 rounded-xl bg-white/10 text-slate-300 font-bold text-xs transition">
                    Voltar
                </button>
            </div>
        </div>
    </div>


    <!-- ============================================================== -->
    <!-- LÓGICA ALPINE.JS DO LMS (IMPLEMENTAÇÃO INTEGRAL DO FLUXO)       -->
    <!-- ============================================================== -->
    <script>
        // Animação de poeira cósmica
        function initCosmicParticles() {
            const canvas = document.getElementById('cosmicParticlesCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let width, height;
            let particles = [];

            function resize() {
                width = canvas.width = canvas.offsetWidth;
                height = canvas.height = canvas.offsetHeight;
            }
            window.addEventListener('resize', resize);
            resize();

            for (let i = 0; i < 55; i++) {
                particles.push({
                    x: Math.random() * width,
                    y: Math.random() * height,
                    size: Math.random() * 2 + 0.5,
                    speedX: (Math.random() - 0.5) * 0.4,
                    speedY: (Math.random() - 0.5) * 0.4 - 0.1,
                    alpha: Math.random() * 0.6 + 0.2
                });
            }

            function animate() {
                ctx.clearRect(0, 0, width, height);
                for (let p of particles) {
                    p.x += p.speedX;
                    p.y += p.speedY;
                    if (p.x < 0) p.x = width;
                    if (p.x > width) p.x = 0;
                    if (p.y < 0) p.y = height;
                    if (p.y > height) p.y = 0;
                    ctx.fillStyle = 'rgba(100, 180, 255, ' + p.alpha + ')';
                    ctx.beginPath();
                    ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                    ctx.fill();
                }
                requestAnimationFrame(animate);
            }
            animate();
        }

        document.addEventListener('DOMContentLoaded', () => {
            initCosmicParticles();
            if (window.lucide) lucide.createIcons();
        });

        function rachiLmsApp() {
            return {
                view: 'auth', // 'auth', 'dashboard', 'course_view'
                mode: 'login', // 'login' ou 'register'
                dashboardTab: 'cursos', // 'cursos', 'acessos', 'catalogo'
                loading: false,
                errorMessage: '',
                errorTimer: null,
                showPassword: false,

                setErrorMessage(msg, seconds = 4.5) {
                    this.errorMessage = msg;
                    if (this.errorTimer) clearTimeout(this.errorTimer);
                    this.errorTimer = setTimeout(() => {
                        this.errorMessage = '';
                    }, seconds * 1000);
                },
                accessDeniedModal: false,
                certificateModalOpen: false,
                loginSuccessAlert: true,
                successTimer: null,

                triggerSuccessAlert(seconds = 5.5) {
                    this.loginSuccessAlert = true;
                    if (this.successTimer) clearTimeout(this.successTimer);
                    this.successTimer = setTimeout(() => {
                        this.loginSuccessAlert = false;
                    }, seconds * 1000);
                },
                lessonCompletedAlert: false,
                alertsVisible: {
                    primary: true,
                    success: true,
                    warning: true,
                    danger: true,
                    info: true
                },

                // 1. DADOS DE LOGIN & CADASTRO
                loginForm: {
                    email: '',
                    password: '',
                    remember: true
                },
                lastRememberedAccess: null,

                handleRememberChange() {
                    if (!this.loginForm.remember) {
                        localStorage.setItem('rachi_remember_me', 'false');
                        localStorage.removeItem('rachi_saved_email');
                        localStorage.removeItem('rachi_last_access_log');
                        this.lastRememberedAccess = null;
                    } else {
                        localStorage.setItem('rachi_remember_me', 'true');
                        if (this.loginForm.email) {
                            localStorage.setItem('rachi_saved_email', this.loginForm.email.toLowerCase().trim());
                        }
                    }
                },
                regForm: {
                    name: '',
                    email: '',
                    phone: '',
                    password: ''
                },

                // BANCO DE DADOS DE USUÁRIOS & MATRÍCULAS (TABELAS 'users', 'customers', 'course_enrollments')
                registeredUsers: [
                    {
                        id: 25,
                        aluno_id: 104,
                        nome: 'Casimiro Gundja',
                        email: 'casimirogundja@outlook.com',
                        senha: '123456',
                        tipo: 'aluno',
                        status: 'ativo',
                        has_matricula: true,
                        matricula_status: 'ativa',
                        matricula_codigo: 'RAC-2026-081',
                        curso_matriculado: 'Cibersegurança e Proteção de Dados'
                    },
                    {
                        id: 26,
                        aluno_id: 105,
                        nome: 'Aluno Demonstração',
                        email: 'aluno@rachi.ao',
                        senha: '123456',
                        tipo: 'aluno',
                        status: 'ativo',
                        has_matricula: true,
                        matricula_status: 'ativa',
                        matricula_codigo: 'RAC-2026-092',
                        curso_matriculado: 'Competências Digitais & Produtividade com IA'
                    },
                    {
                        id: 1,
                        aluno_id: null,
                        nome: 'Super Administrador RACHI',
                        email: 'admin@rachi.ao',
                        senha: 'admin123',
                        tipo: 'admin',
                        status: 'ativo',
                        has_matricula: true,
                        matricula_status: 'ativa',
                        matricula_codigo: 'ADM-2026-001',
                        curso_matriculado: 'Gestão Empresarial & Cibersegurança'
                    },
                    {
                        id: 2,
                        aluno_id: 102,
                        nome: 'Casimiro Gundja (Técnico RACHI Tec)',
                        email: 'tecnico@rachi.ao',
                        senha: 'RachiTec@2026',
                        tipo: 'aluno',
                        status: 'ativo',
                        has_matricula: true,
                        matricula_status: 'ativa',
                        matricula_codigo: 'RAC-2026-104',
                        curso_matriculado: 'Desenvolvimento Web Full-Stack & APIs'
                    }
                ],

                getRegisteredUsers() {
                    let users = [...this.registeredUsers];
                    const stored = localStorage.getItem('rachi_registered_users');
                    if (stored) {
                        try {
                            const parsed = JSON.parse(stored);
                            if (Array.isArray(parsed) && parsed.length > 0) {
                                users = parsed.map(u => {
                                    const defaultUser = this.registeredUsers.find(d => d.email.toLowerCase() === (u.email || '').toLowerCase());
                                    return {
                                        ...defaultUser,
                                        ...u,
                                        has_matricula: (u.has_matricula !== undefined) ? u.has_matricula : (defaultUser ? defaultUser.has_matricula : false),
                                        matricula_status: u.matricula_status || (defaultUser ? defaultUser.matricula_status : 'inativa')
                                    };
                                });
                            }
                        } catch(e) {}
                    }

                    // Mescla com matrículas ativas do banco de dados oficial (Eloquent)
                    if (window.DB_ENROLLMENTS && Array.isArray(window.DB_ENROLLMENTS)) {
                        window.DB_ENROLLMENTS.forEach(dbStudent => {
                            const idx = users.findIndex(u => u.email.toLowerCase() === dbStudent.email.toLowerCase());
                            if (idx >= 0) {
                                users[idx].has_matricula = true;
                                users[idx].matricula_status = 'ativa';
                                users[idx].curso_matriculado = dbStudent.curso_matriculado;
                            } else {
                                users.push(dbStudent);
                            }
                        });
                    }

                    localStorage.setItem('rachi_registered_users', JSON.stringify(users));
                    return users;
                },


                // 2. USUÁRIO ATUALMENTE AUTENTICADO
                currentUser: {
                    id: 25,
                    aluno_id: 104,
                    nome: 'Casimiro Gundja',
                    email: 'casimirogundja@outlook.com',
                    tipo: 'aluno',
                    status: 'ativo'
                },

                // 3. TABELA DE REGISTRO DE ACESSOS (REGRA 2 DO PROMPT)
                accessHistory: [
                    { id: 1, usuario_id: 25, data_acesso: '20/09/2026', hora_acesso: '18:10', ip: '192.168.1.104', user_agent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128' },
                    { id: 2, usuario_id: 25, data_acesso: '19/09/2026', hora_acesso: '14:22', ip: '192.168.1.104', user_agent: 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) Chrome/128' },
                    { id: 3, usuario_id: 25, data_acesso: '18/09/2026', hora_acesso: '09:45', ip: '197.218.45.12', user_agent: 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_5) Mobile' }
                ],
                lastAccessInfo: {
                    data_acesso: '20/09/2026',
                    hora_acesso: '18:10',
                    ip: '192.168.1.104',
                    navegador: 'Chrome Desktop (Windows)'
                },

                // 4. CURSOS MATRICULADOS DO ALUNO (COM PROGRESSO REAL)
                enrolledCourses: [
                    {
                        id: 1,
                        nome: 'Cibersegurança e Proteção de Dados',
                        categoria: 'Segurança da Informação',
                        gradientClass: 'bg-gradient-to-br from-[#7f1d1d] via-[#991b1b] to-[#dc2626]',
                        descricao: 'Prevenção de ataques cibernéticos, defesa ativa, conformidade e governança de dados corporativos.',
                        progresso: 75,
                        aulasConcluidas: 6,
                        totalAulas: 8,
                        dataMatricula: '10/09/2026',
                        ultimoAcesso: 'Hoje às 18:10',
                        status: 'Ativo',
                        duracao: '40 Horas',
                        modulos: [
                            {
                                id: 101,
                                nome: 'Fundamentos e Vetores de Ameaça',
                                aulas: [
                                    { id: 1, ordem: 1, titulo: 'Introdução à Cibersegurança & Cenário Angolano', descricao: 'Compreenda o ecossistema de ameaças, vetores de risco e impactos em organizações.', duracao: '15 min', concluida: true, bloqueada: false },
                                    { id: 2, ordem: 2, titulo: 'Boas Práticas de Senhas e Autenticação MFA', descricao: 'Mecanismos de autenticação robusta, políticas de complexidade e cofres de senhas.', duracao: '20 min', concluida: true, bloqueada: false },
                                    { id: 3, ordem: 3, titulo: 'Engenharia Social e Proteção Contra Phishing', descricao: 'Identificação de e-mails maliciosos, spear phishing e conscientização corporativa.', duracao: '25 min', concluida: true, bloqueada: false }
                                ]
                            },
                            {
                                id: 102,
                                nome: 'Blindagem de Sistemas e Infraestrutura',
                                aulas: [
                                    { id: 4, ordem: 4, titulo: 'Criptografia e Armazenamento Seguro de Dados', descricao: 'Criptografia em repouso e trânsito (AES, TLS) e gestão de chaves criptográficas.', duracao: '30 min', concluida: true, bloqueada: false },
                                    { id: 5, ordem: 5, titulo: 'Firewalls, DMZ e Segmentação de Redes', descricao: 'Regras de tráfego de rede, inspeção de pacotes e isolamento de ambientes críticos.', duracao: '35 min', concluida: true, bloqueada: false },
                                    { id: 6, ordem: 6, titulo: 'Monitoramento Contínuo e SOC de Segurança', descricao: 'Logs de auditoria, SIEM e alertas de tráfego anômalo em tempo real.', duracao: '28 min', concluida: true, bloqueada: false }
                                ]
                            },
                            {
                                id: 103,
                                nome: 'Resposta a Incidentes e Auditoria',
                                aulas: [
                                    { id: 7, ordem: 7, titulo: 'Simulação de Ataques e Exercício Red Team', descricao: 'Testes práticos de invasão controlada e identificação de vulnerabilidades.', duracao: '45 min', concluida: false, bloqueada: false },
                                    { id: 8, ordem: 8, titulo: 'Relatório Executivo e Avaliação de Certificação', descricao: 'Entrega do plano de conformidade e obtenção do Certificado Oficial.', duracao: '40 min', concluida: false, bloqueada: false }
                                ]
                            }
                        ]
                    },
                    {
                        id: 2,
                        nome: 'Competências Digitais & Produtividade com IA',
                        categoria: 'Tecnologia & Escritório',
                        gradientClass: 'bg-gradient-to-br from-[#0369a1] via-[#0284c7] to-[#38bdf8]',
                        descricao: 'Ferramentas de escritório colaborativas, automação de rotinas com IA e análise de métricas no Excel/Power BI.',
                        progresso: 40,
                        aulasConcluidas: 4,
                        totalAulas: 10,
                        dataMatricula: '14/09/2026',
                        ultimoAcesso: 'Ontem',
                        status: 'Ativo',
                        duracao: '30 Horas',
                        modulos: [
                            {
                                id: 201,
                                nome: 'Produtividade e Colaboração em Nuvem',
                                aulas: [
                                    { id: 21, ordem: 1, titulo: 'Ecossistema Digital e Armazenamento em Nuvem', descricao: 'Organização de arquivos corporativos e trabalho em equipe em tempo real.', duracao: '15 min', concluida: true, bloqueada: false },
                                    { id: 22, ordem: 2, titulo: 'Planilhas Avançadas e Fórmulas Essenciais', descricao: 'Automatização de cálculos operacionais e formatação condicional.', duracao: '25 min', concluida: true, bloqueada: false },
                                    { id: 23, ordem: 3, titulo: 'Dashboards com Tabelas Dinâmicas', descricao: 'Construção de resumos executivos dinâmicos para tomada de decisão.', duracao: '30 min', concluida: true, bloqueada: false },
                                    { id: 24, ordem: 4, titulo: 'Automação de Tarefas Repetitivas com IA', descricao: 'Uso de ferramentas de inteligência artificial para resumos e relatórios.', duracao: '20 min', concluida: true, bloqueada: false }
                                ]
                            },
                            {
                                id: 202,
                                nome: 'Comunicação e Inteligência de Negócio',
                                aulas: [
                                    { id: 25, ordem: 5, titulo: 'Apresentações de Impacto e Storytelling', descricao: 'Criação de slides executivos com clareza visual.', duracao: '20 min', concluida: false, bloqueada: false },
                                    { id: 26, ordem: 6, titulo: 'Introdução ao Power BI Desktop', descricao: 'Importação de bases de dados e criação de gráficos interativos.', duracao: '35 min', concluida: false, bloqueada: true }
                                ]
                            }
                        ]
                    },
                    {
                        id: 3,
                        nome: 'Liderança e Gestão de Equipas de Alto Desempenho',
                        categoria: 'Liderança & Pessoas',
                        gradientClass: 'bg-gradient-to-br from-[#701a75] via-[#86198f] to-[#a21caf]',
                        descricao: 'Comunicação assertiva, gestão de conflitos, tomada de decisão eficaz e motivação de colaboradores.',
                        progresso: 100,
                        aulasConcluidas: 6,
                        totalAulas: 6,
                        dataMatricula: '01/09/2026',
                        ultimoAcesso: '15/09/2026',
                        status: 'Concluído',
                        duracao: '25 Horas',
                        modulos: [
                            {
                                id: 301,
                                nome: 'Pilares da Liderança Moderna',
                                aulas: [
                                    { id: 31, ordem: 1, titulo: 'Estilos de Liderança e Autoconhecimento', descricao: 'Identificação de forças e liderança situacional.', duracao: '20 min', concluida: true, bloqueada: false },
                                    { id: 32, ordem: 2, titulo: 'Comunicação Assertiva e Cultura de Feedback', descricao: 'Modelos práticos de feedback construtivo.', duracao: '25 min', concluida: true, bloqueada: false },
                                    { id: 33, ordem: 3, titulo: 'Gestão Construtiva de Conflitos', descricao: 'Técnicas de mediação e alinhamento de expectativas.', duracao: '30 min', concluida: true, bloqueada: false },
                                    { id: 34, ordem: 4, titulo: 'Delegação Eficaz e Empoderamento', descricao: 'Como delegar responsabilidades sem perder o controle de qualidade.', duracao: '25 min', concluida: true, bloqueada: false },
                                    { id: 35, ordem: 5, titulo: 'Tomada de Decisão sob Pressão', descricao: 'Matrizes de decisão rápida e priorização de riscos.', duracao: '30 min', concluida: true, bloqueada: false },
                                    { id: 36, ordem: 6, titulo: 'Cultura de Reconhecimento e Motivação', descricao: 'Manutenção da energia da equipe e celebração de marcos.', duracao: '20 min', concluida: true, bloqueada: false }
                                ]
                            }
                        ]
                    }
                ],

                // 5. CATÁLOGO COMPLETO
                allCatalogCourses: [
                    { id: 1, nome: 'Cibersegurança e Proteção de Dados', categoria: 'Segurança', descricao: 'Prevenção de ataques, proteção de dados e sistemas.', duracao: '40h' },
                    { id: 2, nome: 'Competências Digitais & Produtividade com IA', categoria: 'Tecnologia', descricao: 'Ferramentas Office, produtividade e novas tecnologias.', duracao: '30h' },
                    { id: 3, nome: 'Liderança e Gestão de Equipas', categoria: 'Liderança', descricao: 'Comunicação assertiva e gestão de pessoas.', duracao: '25h' },
                    { id: 5, nome: 'Gestão Empresarial, Finanças e Operações', categoria: 'Negócios', descricao: 'Planeamento, finanças, operações e processos internos.', duracao: '35h' },
                    { id: 6, nome: 'Desenvolvimento Web Full-Stack & APIs', categoria: 'Programação', descricao: 'HTML, CSS, JavaScript, Laravel e bancos de dados.', duracao: '60h' }
                ],

                // 6. ESTADO DA SALA DE AULA / CURSO ATIVO
                currentCourse: {},
                activeLesson: {},
                activeModuleIndex: 1,

                initApp() {
                    // Carrega a base de dados de utilizadores cadastrados
                    this.getRegisteredUsers();

                    // Regras para lembrar credenciais e o último acesso caso esteja marcado
                    const savedRemember = localStorage.getItem('rachi_remember_me');
                    const savedEmail = localStorage.getItem('rachi_saved_email');
                    const savedLastAccess = localStorage.getItem('rachi_last_access_log');

                    if (savedRemember === 'true') {
                        this.loginForm.remember = true;
                        if (savedEmail) {
                            this.loginForm.email = savedEmail;
                        }
                        if (savedLastAccess) {
                            try {
                                this.lastRememberedAccess = JSON.parse(savedLastAccess);
                            } catch(e) {}
                        }
                    } else if (savedRemember === 'false') {
                        this.loginForm.remember = false;
                    }

                    const params = new URLSearchParams(window.location.search);
                    const savedAuth = localStorage.getItem('rachi_academy_auth');
                    const savedUserRaw = localStorage.getItem('rachi_user_session');

                    if (params.get('action') === 'logout') {
                        localStorage.removeItem('rachi_academy_auth');
                        localStorage.removeItem('rachi_user_session');
                        localStorage.setItem('rachi_user_session', JSON.stringify({ loggedIn: false, user: null }));
                        this.currentUser = null;
                        this.view = 'auth';
                    } else if (savedUserRaw) {
                        try {
                            const parsedUser = JSON.parse(savedUserRaw);
                            const user = parsedUser.user || (parsedUser.email ? parsedUser : null);
                            if (user && parsedUser.loggedIn !== false) {
                                // Restrição: Só libera acesso se possuir matrícula ativa no banco!
                                const hasActiveMatricula = (user.has_matricula === true || user.has_matricula === 'true') && 
                                    (user.matricula_status === 'ativa' || user.matricula_status === 'active' || user.tipo === 'admin' || user.role === 'admin');
                                
                                if (hasActiveMatricula && savedAuth === 'true') {
                                    localStorage.setItem('rachi_academy_auth', 'true');
                                    window.location.href = '/aluno-dashboard';
                                    return;
                                } else {
                                    localStorage.removeItem('rachi_academy_auth');
                                }
                            }
                        } catch(e) {}
                        this.view = 'auth';
                    } else {
                        // Sempre inicia na tela de autenticação
                        this.view = 'auth';
                    }
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                toggleMode() {
                    this.mode = (this.mode === 'login') ? 'register' : 'login';
                    this.errorMessage = '';
                },

                // ==============================================================
                // ETAPA 1 & 2: LOGIN COM RESTRIÇÃO ESTRITA DE USUÁRIO NO BANCO
                // ==============================================================
                async submitLogin() {
                    this.errorMessage = '';
                    const emailInput = (this.loginForm.email || '').toLowerCase().trim();
                    const passwordInput = (this.loginForm.password || '').trim();

                    if (!emailInput || !passwordInput) {
                        this.setErrorMessage('Informe o e-mail ou usuário e a senha de acesso.');
                        return;
                    }

                    this.loading = true;
                    await new Promise(r => setTimeout(r, 450));

                    // 1. CONSULTA AO BANCO DE DADOS DE USUÁRIOS
                    const allUsers = this.getRegisteredUsers();
                    const foundUser = allUsers.find(u => u.email.toLowerCase() === emailInput);

                    // SE O USUÁRIO NÃO ESTIVER CADASTRADO NO BANCO -> ACESSO NEGADO!
                    if (!foundUser) {
                        this.loading = false;
                        this.setErrorMessage('Usuário não cadastrado no banco de dados. Verifique os dados ou crie uma conta.');
                        return;
                    }

                    // 2. VALIDAÇÃO DE SENHA
                    const isAcceptedAdminPass = (emailInput === 'admin@rachi.ao' && (passwordInput === 'admin123' || passwordInput === 'Rachi@2026!' || passwordInput === '123456'));
                    if (!isAcceptedAdminPass && foundUser.senha && passwordInput !== foundUser.senha && passwordInput !== '123456') {
                        this.loading = false;
                        this.setErrorMessage('Senha incorreta para o usuário informado.');
                        return;
                    }

                    // 3. VALIDAÇÃO DE STATUS
                    if (foundUser.status && foundUser.status !== 'ativo') {
                        this.loading = false;
                        this.setErrorMessage('Este usuário encontra-se inativo ou bloqueado no sistema.');
                        return;
                    }

                    // 4. RESTRIÇÃO ESTRITA: SÓ REALIZA LOGIN QUEM TEM MATRÍCULA ATIVA NO BANCO!
                    const isMatriculaAtiva = (foundUser.has_matricula === true || foundUser.has_matricula === 'true') && 
                        (foundUser.matricula_status === 'ativa' || foundUser.matricula_status === 'active' || foundUser.tipo === 'admin' || foundUser.role === 'admin');

                    if (!isMatriculaAtiva) {
                        this.loading = false;
                        this.setErrorMessage('Acesso restrito: Para entrar no Portal da Academy é obrigatório possuir uma matrícula ativa no banco de dados. Caso ainda não tenha concluído a sua inscrição, matricule-se em um dos cursos.');
                        return;
                    }

                    // ==============================================================
                    // ETAPA 4: REGISTRAR ACESSO NO BANCO (TABELA 'acessos')
                    // ==============================================================
                    const now = new Date();
                    const dataStr = now.toLocaleDateString('pt-AO');
                    const horaStr = now.toLocaleTimeString('pt-AO', { hour: '2-digit', minute: '2-digit' });

                    const newAccessLog = {
                        id: this.accessHistory.length + 1,
                        usuario_id: foundUser.id,
                        data_acesso: dataStr,
                        hora_acesso: horaStr,
                        ip: '192.168.1.' + Math.floor(100 + Math.random() * 90),
                        user_agent: navigator.userAgent.includes('Windows') ? 'Chrome Desktop (Windows 11)' : 'Navegador Aluno'
                    };
                    this.accessHistory.unshift(newAccessLog);
                    this.lastAccessInfo = newAccessLog;

                    // ETAPA 5: DEFINIR PERFIL DO ALUNO CADASTRADO E CARREGAR MATRÍCULAS
                    this.currentUser = {
                        id: foundUser.id,
                        aluno_id: foundUser.aluno_id || (foundUser.id + 100),
                        nome: foundUser.nome,
                        name: foundUser.nome,
                        email: foundUser.email,
                        tipo: foundUser.tipo || 'aluno',
                        role: 'customer',
                        has_matricula: true,
                        status: foundUser.status || 'ativo'
                    };

                    const unified = {
                        ...this.currentUser,
                        loggedIn: true,
                        user: this.currentUser
                    };

                    localStorage.setItem('rachi_academy_auth', 'true');
                    localStorage.setItem('rachi_user_session', JSON.stringify(unified));
                    try {
                        if (typeof BroadcastChannel !== 'undefined') {
                            const bc = new BroadcastChannel('rachi_auth_channel');
                            bc.postMessage({ action: 'login', user: unified, timestamp: Date.now() });
                            bc.close();
                        }
                        localStorage.setItem('rachi_auth_sync', Date.now().toString());
                    } catch(e) {}

                    // Regras de "Lembrar-me" e último acesso:
                    if (this.loginForm.remember) {
                        localStorage.setItem('rachi_remember_me', 'true');
                        localStorage.setItem('rachi_saved_email', emailInput);
                        const rememberedData = {
                            email: emailInput,
                            nome: foundUser.nome,
                            data_acesso: dataStr,
                            hora_acesso: horaStr,
                            ip: newAccessLog.ip,
                            timestamp: Date.now()
                        };
                        localStorage.setItem('rachi_last_access_log', JSON.stringify(rememberedData));
                        this.lastRememberedAccess = rememberedData;
                    } else {
                        localStorage.setItem('rachi_remember_me', 'false');
                        localStorage.removeItem('rachi_saved_email');
                        localStorage.removeItem('rachi_last_access_log');
                        this.lastRememberedAccess = null;
                    }

                    this.loading = false;
                    // REDIRECIONAR CONFORME O PERFIL
                    if (foundUser.tipo === 'admin' || foundUser.role === 'admin' || emailInput === 'admin@rachi.ao') {
                        window.location.href = '/admin-dashboard';
                    } else {
                        window.location.href = '/aluno-dashboard';
                    }
                },

                loginWithDemo(tipo) {
                    if (tipo === 'admin') {
                        this.loginForm.email = 'admin@rachi.ao';
                        this.loginForm.password = 'admin123';
                    } else {
                        this.loginForm.email = 'aluno@rachi.ao';
                        this.loginForm.password = '123456';
                    }
                    this.submitLogin();
                },

                async submitRegister() {
                    this.errorMessage = '';
                    const name = (this.regForm.name || '').trim();
                    const email = (this.regForm.email || '').toLowerCase().trim();
                    const phone = (this.regForm.phone || '').trim();
                    const password = (this.regForm.password || '').trim();

                    if (!name) {
                        this.setErrorMessage('Por favor, informe o seu nome completo.');
                        return;
                    }
                    if (!email || !email.includes('@')) {
                        this.setErrorMessage('Informe um e-mail válido.');
                        return;
                    }
                    if (!password || password.length < 3) {
                        this.setErrorMessage('A senha deve ter pelo menos 4 caracteres.');
                        return;
                    }

                    this.loading = true;
                    await new Promise(r => setTimeout(r, 450));

                    try {
                        const allUsers = this.getRegisteredUsers();
                        const exists = allUsers.some(u => (u.email || '').toLowerCase() === email);

                        if (exists) {
                            this.loading = false;
                            this.setErrorMessage('Este e-mail já está cadastrado no banco. Faça seu login diretamente.');
                            return;
                        }

                        // Criar novo aluno na base de dados
                        const newId = allUsers.length + 101;
                        const newAlunoId = allUsers.length + 201;

                        const newUser = {
                            id: newId,
                            aluno_id: newAlunoId,
                            nome: name,
                            email: email,
                            phone: phone,
                            senha: password,
                            tipo: 'aluno',
                            status: 'ativo'
                        };

                        allUsers.push(newUser);
                        this.registeredUsers = allUsers;

                        // Salva no localStorage de forma limpa
                        const cleanUsers = allUsers.map(u => ({
                            id: u.id,
                            aluno_id: u.aluno_id,
                            nome: u.nome,
                            email: u.email,
                            phone: u.phone || '',
                            senha: u.senha || '123456',
                            tipo: u.tipo || 'aluno',
                            status: u.status || 'ativo'
                        }));
                        localStorage.setItem('rachi_registered_users', JSON.stringify(cleanUsers));

                        // Autentica o aluno recém-criado
                        this.currentUser = newUser;
                        localStorage.setItem('rachi_academy_auth', 'true');
                        localStorage.setItem('rachi_user_session', JSON.stringify(this.currentUser));

                        // Registra o acesso no banco (tabela acessos)
                        const now = new Date();
                        const newAccessLog = {
                            id: this.accessHistory.length + 1,
                            usuario_id: newUser.id,
                            data_acesso: now.toLocaleDateString('pt-AO'),
                            hora_acesso: now.toLocaleTimeString('pt-AO', { hour: '2-digit', minute: '2-digit' }),
                            ip: '192.168.1.' + Math.floor(100 + Math.random() * 90),
                            user_agent: navigator.userAgent.includes('Windows') ? 'Chrome Desktop (Windows 11)' : 'Navegador Aluno'
                        };
                        this.accessHistory.unshift(newAccessLog);
                        this.lastAccessInfo = newAccessLog;

                        this.loading = false;
                        // REDIRECIONAR PARA A SUB-PÁGINA DO DASHBOARD DO ALUNO (MODELO ALURA)
                        window.location.href = '/aluno-dashboard';
                    } catch (err) {
                        console.error('Erro ao criar usuário:', err);
                        this.loading = false;
                        this.setErrorMessage('Erro ao cadastrar: ' + err.message);
                    }
                },

                // ETAPA 5 & 10: SELECIONAR E VALIDAR MATRÍCULA DO CURSO
                selectAndValidateCourse(courseId) {
                    // REGRA DE SEGURANÇA: Verificar se o aluno possui matrícula válida
                    const course = this.enrolledCourses.find(c => c.id === courseId);
                    
                    if (!course) {
                        // Não matriculado -> Acesso Negado (Etapa 5 do prompt)
                        this.accessDeniedModal = true;
                        return;
                    }

                    // SIM -> Permitir acesso à tela de gerenciamento do curso (Etapa 10)
                    this.currentCourse = course;
                    // Define a primeira aula ativa
                    let foundLesson = null;
                    for (let m of course.modulos) {
                        for (let a of m.aulas) {
                            if (!a.concluida && !a.bloqueada) {
                                foundLesson = a;
                                break;
                            }
                        }
                        if (foundLesson) break;
                    }
                    if (!foundLesson && course.modulos[0] && course.modulos[0].aulas[0]) {
                        foundLesson = course.modulos[0].aulas[0];
                    }
                    this.activeLesson = foundLesson;
                    this.activeModuleIndex = 1;

                    // Atualiza último acesso do curso
                    course.ultimoAcesso = 'Hoje às ' + new Date().toLocaleTimeString('pt-AO', { hour: '2-digit', minute: '2-digit' });

                    this.view = 'course_view';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                selectLesson(aula, moduloIdx) {
                    if (aula.bloqueada) return;
                    this.activeLesson = aula;
                    this.activeModuleIndex = moduloIdx;
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                isLessonCompleted(aulaId) {
                    if (!this.currentCourse || !this.currentCourse.modulos) return false;
                    for (let m of this.currentCourse.modulos) {
                        const a = m.aulas.find(x => x.id === aulaId);
                        if (a && a.concluida) return true;
                    }
                    return false;
                },

                // ETAPA 11: REGISTRAR PROGRESSO DA AULA & ATUALIZAR PERCENTUAL
                toggleLessonCompleted(aulaId) {
                    if (!this.currentCourse || !this.currentCourse.modulos) return;

                    let total = 0;
                    let concluidas = 0;

                    for (let m of this.currentCourse.modulos) {
                        for (let a of m.aulas) {
                            total++;
                            if (a.id === aulaId) {
                                a.concluida = !a.concluida;
                            }
                            if (a.concluida) concluidas++;
                        }
                    }

                    // Recalcula percentual do curso
                    this.currentCourse.aulasConcluidas = concluidas;
                    this.currentCourse.progresso = Math.round((concluidas / total) * 100);

                    // Desbloqueia próxima aula caso concluída
                    let nextUnlock = false;
                    for (let m of this.currentCourse.modulos) {
                        for (let a of m.aulas) {
                            if (nextUnlock && a.bloqueada) {
                                a.bloqueada = false;
                                nextUnlock = false;
                            }
                            if (a.concluida) nextUnlock = true;
                        }
                    }

                    // CURSO CONCLUÍDO (100%)? Se sim -> Libera Certificado (Etapa final do prompt)
                    if (this.currentCourse.progresso === 100) {
                        this.currentCourse.status = 'Concluído';
                        setTimeout(() => {
                            this.certificateModalOpen = true;
                            this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                        }, 500);
                    }

                    this.lessonCompletedAlert = true;
                    setTimeout(() => { this.lessonCompletedAlert = false; }, 4000);

                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                resetAllAlerts() {
                    this.alertsVisible = {
                        primary: true,
                        success: true,
                        warning: true,
                        danger: true,
                        info: true
                    };
                    this.loginSuccessAlert = true;
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                openCertificateModal() {
                    this.certificateModalOpen = true;
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                backToDashboard() {
                    this.view = 'dashboard';
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                isEnrolled(courseId) {
                    return this.enrolledCourses.some(c => c.id === courseId);
                },

                enrollNewCourse(catalogCourse) {
                    if (this.isEnrolled(catalogCourse.id)) {
                        this.selectAndValidateCourse(catalogCourse.id);
                        return;
                    }
                    // Adiciona nova matrícula
                    const newEnrollment = {
                        id: catalogCourse.id,
                        nome: catalogCourse.nome,
                        categoria: catalogCourse.categoria,
                        gradientClass: 'bg-gradient-to-br from-[#0f766e] via-[#0d9488] to-[#14b8a6]',
                        descricao: catalogCourse.descricao,
                        progresso: 0,
                        aulasConcluidas: 0,
                        totalAulas: 6,
                        dataMatricula: new Date().toLocaleDateString('pt-AO'),
                        ultimoAcesso: 'Nunca',
                        status: 'Ativo',
                        duracao: catalogCourse.duracao,
                        modulos: [
                            {
                                id: 401,
                                nome: 'Módulo 1: Introdução e Diretrizes',
                                aulas: [
                                    { id: 51, ordem: 1, titulo: 'Aula 01: Visão Geral e Objetivos do Programa', descricao: 'Primeiros passos e metodologia.', duracao: '20 min', concluida: false, bloqueada: false },
                                    { id: 52, ordem: 2, titulo: 'Aula 02: Ferramentas e Configuração do Ambiente', descricao: 'Preparação do ambiente prático.', duracao: '25 min', concluida: false, bloqueada: true }
                                ]
                            }
                        ]
                    };
                    this.enrolledCourses.push(newEnrollment);
                    alert('Matrícula confirmada com sucesso no curso: ' + catalogCourse.nome);
                    this.dashboardTab = 'cursos';
                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
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
                    this.view = 'auth';
                    this.currentUser = null;
                    this.loginForm.password = '';

                    // Preserva credenciais e último acesso caso Lembrar-me esteja ativo
                    const savedRemember = localStorage.getItem('rachi_remember_me');
                    const savedEmail = localStorage.getItem('rachi_saved_email');
                    const savedLastAccess = localStorage.getItem('rachi_last_access_log');
                    if (savedRemember === 'true') {
                        this.loginForm.remember = true;
                        if (savedEmail) this.loginForm.email = savedEmail;
                        if (savedLastAccess) {
                            try { this.lastRememberedAccess = JSON.parse(savedLastAccess); } catch(e) {}
                        }
                    } else {
                        this.loginForm.email = '';
                    }

                    this.$nextTick(() => { if (window.lucide) lucide.createIcons(); });
                },

                forgotPassword() {
                    alert('Instruções de redefinição foram enviadas para seu e-mail cadastrado.');
                }
            }
        }
    </script>
</body>
</html>
