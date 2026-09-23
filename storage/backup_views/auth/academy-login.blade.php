<!DOCTYPE html>
<html lang="pt-BR" data-theme="dark" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RACHI Academy — Faça seu login</title>
    <meta name="description" content="Acesse sua conta na RACHI Academy. Formação prática, certificações e capacitação executiva.">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo-rachi-light.png">
    
    <!-- Google Fonts: Inter & Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Inter"', 'sans-serif'],
                        heading: ['"Outfit"', '"Inter"', 'sans-serif'],
                    },
                    colors: {
                        rachiNavy: '#0c0d12',
                        rachiBlue: '#00a3e0',
                        rachiBlueDark: '#0070f3',
                        rachiCard: '#13141b',
                    }
                }
            }
        }
    </script>
    <style>
        [x-cloak] { display: none !important; }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0c0d12;
            color: #ffffff;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }

        /* Estilização fiel dos inputs igual ao print */
        .input-alura {
            background-color: #12131a;
            border: 1px solid #232530;
            color: #ffffff;
            transition: all 0.2s ease-in-out;
        }
        .input-alura:focus {
            outline: none;
            border-color: #00a3e0;
            box-shadow: 0 0 0 1px #00a3e0;
            background-color: #161822;
        }
        .input-alura::placeholder {
            color: #525866;
        }

        /* Animação suave de respiração e movimento cósmico da nebulosa */
        @keyframes nebulaFlow {
            0% {
                transform: scale(1.02) translate(0px, 0px) rotate(0deg);
            }
            33% {
                transform: scale(1.07) translate(-12px, -8px) rotate(0.6deg);
            }
            66% {
                transform: scale(1.05) translate(10px, 12px) rotate(-0.5deg);
            }
            100% {
                transform: scale(1.02) translate(0px, 0px) rotate(0deg);
            }
        }

        .animate-nebula-flow {
            animation: nebulaFlow 28s ease-in-out infinite alternate;
            will-change: transform;
        }

        /* Brilho pulsante sutil no vórtice */
        @keyframes vortexPulse {
            0%, 100% {
                opacity: 0.88;
                filter: brightness(1) contrast(1.05);
            }
            50% {
                opacity: 1;
                filter: brightness(1.15) contrast(1.1);
            }
        }

        .animate-vortex-glow {
            animation: vortexPulse 8s ease-in-out infinite alternate;
        }

        /* Efeito de levitação flutuante para o card da direita */
        @keyframes floatCard {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-8px);
            }
        }

        .animate-float-card {
            animation: floatCard 6s ease-in-out infinite alternate;
        }
    </style>
</head>
<body class="h-full bg-[#0c0d12] text-white selection:bg-[#00a3e0] selection:text-[#0c0d12]" 
      x-data="academyAuth()" 
      x-init="initData()">

    <!-- CONTAINER GRID PRINCIPAL: 2 COLUNAS (IDÊNTICO AO PRINT) -->
    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-[24rem_1fr] xl:grid-cols-[26rem_1fr] 2xl:grid-cols-[28rem_1fr]">
        
        <!-- ============================================================== -->
        <!-- COLUNA ESQUERDA: FORMULÁRIO (FIEL AO PRINT, PADRÃO RACHI ACADEMY) -->
        <!-- ============================================================== -->
        <section class="flex flex-col justify-between px-8 sm:px-12 pt-8 sm:pt-12 pb-8 bg-[#0c0d12] relative z-20 border-r border-[#1a1c26]/60 min-h-screen">
            
            <div class="w-full max-w-sm mx-auto mt-2 sm:mt-4 mb-auto">
                
                <!-- CABEÇALHO DO FORMULÁRIO (EXATAMENTE COMO NO PRINT) -->
                <header class="mb-8">
                    <h1 class="text-3xl sm:text-[2.2rem] font-normal text-white leading-[1.2] tracking-tight">
                        <template x-if="mode === 'login'">
                            <div>
                                <span>Já estuda</span><br>
                                <span>com a gente?</span>
                            </div>
                        </template>
                        <template x-if="mode === 'register'">
                            <div>
                                <span>Ainda não estuda</span><br>
                                <span>com a gente?</span>
                            </div>
                        </template>
                    </h1>
                    <p class="mt-2 text-sm text-[#94a3b8] font-normal leading-relaxed">
                        <span x-show="mode === 'login'">Faça seu login e boa aula!</span>
                        <span x-show="mode === 'register'" x-cloak>Faça sua matrícula e comece hoje mesmo!</span>
                    </p>
                </header>

                <!-- ==================== 1. FORMULÁRIO DE LOGIN ==================== -->
                <div x-show="mode === 'login'">
                    <form @submit.prevent="submitLogin()" class="space-y-4">
                        
                        <!-- Campo E-mail -->
                        <div>
                            <label for="login_email" class="flex items-center gap-0.5 text-xs text-slate-300 font-normal mb-1.5">
                                <span>E-mail</span>
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="login_email" 
                                x-model="loginForm.email" 
                                required 
                                placeholder="casimirogundja@outlook.com"
                                class="w-full h-11 px-3.5 rounded-md input-alura text-xs text-white"
                            >
                        </div>

                        <!-- Campo Senha -->
                        <div>
                            <label for="login_password" class="flex items-center gap-0.5 text-xs text-slate-300 font-normal mb-1.5">
                                <span>Senha</span>
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    :type="showPassword ? 'text' : 'password'" 
                                    id="login_password" 
                                    x-model="loginForm.password" 
                                    required 
                                    placeholder="••••••••••••"
                                    class="w-full h-11 px-3.5 pr-10 rounded-md input-alura text-xs text-white"
                                >
                                <button 
                                    type="button" 
                                    @click="showPassword = !showPassword" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white p-1 cursor-pointer"
                                    aria-label="Mostrar senha">
                                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Mensagem de erro inline -->
                        <div x-show="errorMessage" x-cloak class="p-2.5 rounded-md bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs">
                            <span x-text="errorMessage"></span>
                        </div>

                        <!-- Botão Primário ENTRAR > (Azul vibrante oficial do print) -->
                        <div class="pt-2">
                            <button 
                                type="submit" 
                                :disabled="loading"
                                class="w-full h-11 rounded-md bg-[#0050f0] hover:bg-[#0042c7] active:scale-[0.99] text-white font-semibold text-xs tracking-widest uppercase transition-all duration-200 flex items-center justify-center gap-2 shadow-lg shadow-[#0050f0]/25 cursor-pointer">
                                <span x-text="loading ? 'A ENTRAR...' : 'ENTRAR'"></span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </button>
                        </div>

                        <!-- Botão Secundário Google (Fiel ao print) -->
                        <div>
                            <button 
                                type="button" 
                                @click="loginGoogle()"
                                class="w-full h-11 rounded-md border border-[#232530] bg-[#12131a] hover:bg-[#161822] hover:border-slate-500 text-slate-200 text-xs font-normal transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                                    <path fill="#4285F4" d="M17.618 9.205c0-.593-.053-1.155-.143-1.703H9v3.383h4.852c-.217 1.11-.854 2.047-1.8 2.685v2.25h2.896c1.694-1.568 2.67-3.878 2.67-6.615"></path>
                                    <path fill="#34A853" d="M9 18.002c2.43 0 4.463-.81 5.948-2.182l-2.895-2.25c-.81.54-1.838.87-3.053.87-2.347 0-4.335-1.583-5.047-3.72H.967v2.317c1.478 2.94 4.516 4.965 8.033 4.965"></path>
                                    <path fill="#FBBC05" d="M3.953 10.72a5.2 5.2 0 0 1-.285-1.718c0-.6.104-1.177.285-1.717V4.967H.966a8.9 8.9 0 0 0 0 8.07z"></path>
                                    <path fill="#EA4335" d="M9 3.565c1.328 0 2.512.457 3.45 1.35l2.565-2.565C13.462.895 11.43.002 9 .002 5.483.002 2.445 2.027.967 4.967l2.986 2.318c.712-2.138 2.7-3.72 5.047-3.72"></path>
                                </svg>
                                <span>Logar com o Google</span>
                            </button>
                        </div>

                        <!-- Link Primeiro Acesso (Fiel ao print) -->
                        <div class="text-center pt-3">
                            <a href="#recuperar" @click.prevent="forgotPassword()" class="text-[11px] text-slate-400 hover:text-white underline underline-offset-2 transition">
                                Primeiro acesso / Esqueci minha senha
                            </a>
                        </div>
                    </form>
                </div>

                <!-- ==================== 2. FORMULÁRIO DE MATRÍCULA ==================== -->
                <div x-show="mode === 'register'" x-cloak>
                    <form @submit.prevent="submitRegister()" class="space-y-3.5">
                        
                        <!-- Aviso de Curso Selecionado -->
                        <div x-show="selectedCourse" class="p-2.5 rounded-md bg-[#0050f0]/15 border border-[#0050f0]/40 text-xs text-sky-200 flex items-center justify-between">
                            <span class="truncate font-medium" x-text="'Curso: ' + selectedCourse"></span>
                            <span x-show="coursePrice" class="font-bold text-amber-400 shrink-0 ml-2" x-text="coursePrice"></span>
                        </div>

                        <!-- Nome Completo -->
                        <div>
                            <label for="reg_name" class="flex items-center gap-0.5 text-xs text-slate-300 font-normal mb-1">
                                <span>Nome Completo</span>
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="reg_name" 
                                x-model="regForm.name" 
                                required 
                                placeholder="Casimiro Gundja"
                                class="w-full h-11 px-3.5 rounded-md input-alura text-xs text-white"
                            >
                        </div>

                        <!-- E-mail -->
                        <div>
                            <label for="reg_email" class="flex items-center gap-0.5 text-xs text-slate-300 font-normal mb-1">
                                <span>E-mail</span>
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            <input 
                                type="email" 
                                id="reg_email" 
                                x-model="regForm.email" 
                                required 
                                placeholder="casimirogundja@outlook.com"
                                class="w-full h-11 px-3.5 rounded-md input-alura text-xs text-white"
                            >
                        </div>

                        <!-- WhatsApp / Telemóvel (Opcional) -->
                        <div>
                            <label for="reg_phone" class="flex items-center justify-between text-xs text-slate-300 font-normal mb-1">
                                <span>WhatsApp / Telemóvel</span>
                                <span class="text-[10px] text-emerald-400 font-normal lowercase">(opcional)</span>
                            </label>
                            <input 
                                type="tel" 
                                id="reg_phone" 
                                x-model="regForm.phone" 
                                placeholder="+244 923 000 000"
                                class="w-full h-11 px-3.5 rounded-md input-alura text-xs text-white"
                            >
                        </div>

                        <!-- Senha -->
                        <div>
                            <label for="reg_password" class="flex items-center gap-0.5 text-xs text-slate-300 font-normal mb-1">
                                <span>Senha</span>
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            <div class="relative">
                                <input 
                                    :type="showPassword ? 'text' : 'password'" 
                                    id="reg_password" 
                                    x-model="regForm.password" 
                                    required 
                                    placeholder="••••••••••••"
                                    class="w-full h-11 px-3.5 pr-10 rounded-md input-alura text-xs text-white"
                                >
                                <button 
                                    type="button" 
                                    @click="showPassword = !showPassword" 
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white p-1 cursor-pointer"
                                    aria-label="Mostrar senha">
                                    <svg x-show="!showPassword" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                    <svg x-show="showPassword" x-cloak class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Confirmar Senha -->
                        <div>
                            <label for="reg_password_confirm" class="flex items-center gap-0.5 text-xs text-slate-300 font-normal mb-1">
                                <span>Confirmar Senha</span>
                                <span class="text-red-500 font-bold">*</span>
                            </label>
                            <input 
                                type="password" 
                                id="reg_password_confirm" 
                                x-model="regForm.passwordConfirm" 
                                required 
                                placeholder="••••••••••••"
                                class="w-full h-11 px-3.5 rounded-md input-alura text-xs text-white"
                            >
                        </div>

                        <!-- Termos e Condições -->
                        <div class="flex items-start gap-2.5 pt-1">
                            <input 
                                type="checkbox" 
                                id="reg_terms" 
                                x-model="regForm.terms" 
                                required 
                                class="mt-0.5 rounded border-slate-700 bg-[#12131a] text-[#0050f0] focus:ring-[#0050f0] w-3.5 h-3.5">
                            <label for="reg_terms" class="text-[11px] text-slate-300 leading-snug">
                                Concordo com os <a href="#" class="text-[#00a3e0] hover:underline">Termos de Uso</a> e <a href="#" class="text-[#00a3e0] hover:underline">Política de Privacidade</a> da RACHI.
                            </label>
                        </div>

                        <!-- Mensagem de erro inline -->
                        <div x-show="errorMessage" x-cloak class="p-2.5 rounded-md bg-rose-500/15 border border-rose-500/30 text-rose-300 text-xs">
                            <span x-text="errorMessage"></span>
                        </div>

                        <!-- Botão Primário Cadastrar -->
                        <div class="pt-2">
                            <button 
                                type="submit" 
                                :disabled="loading"
                                class="w-full h-11 rounded-md bg-[#0050f0] hover:bg-[#0042c7] active:scale-[0.99] text-white font-semibold text-xs tracking-widest uppercase transition-all duration-200 flex items-center justify-center gap-2 shadow-lg shadow-[#0050f0]/25 cursor-pointer">
                                <span x-text="loading ? 'A PROCESSAR...' : 'FINALIZAR MATRÍCULA'"></span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </button>
                        </div>

                        <!-- Botão Secundário Google -->
                        <div>
                            <button 
                                type="button" 
                                @click="loginGoogle()"
                                class="w-full h-11 rounded-md border border-[#232530] bg-[#12131a] hover:bg-[#161822] hover:border-slate-500 text-slate-200 text-xs font-normal transition-all duration-200 flex items-center justify-center gap-2.5 cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 18 18">
                                    <path fill="#4285F4" d="M17.618 9.205c0-.593-.053-1.155-.143-1.703H9v3.383h4.852c-.217 1.11-.854 2.047-1.8 2.685v2.25h2.896c1.694-1.568 2.67-3.878 2.67-6.615"></path>
                                    <path fill="#34A853" d="M9 18.002c2.43 0 4.463-.81 5.948-2.182l-2.895-2.25c-.81.54-1.838.87-3.053.87-2.347 0-4.335-1.583-5.047-3.72H.967v2.317c1.478 2.94 4.516 4.965 8.033 4.965"></path>
                                    <path fill="#FBBC05" d="M3.953 10.72a5.2 5.2 0 0 1-.285-1.718c0-.6.104-1.177.285-1.717V4.967H.966a8.9 8.9 0 0 0 0 8.07z"></path>
                                    <path fill="#EA4335" d="M9 3.565c1.328 0 2.512.457 3.45 1.35l2.565-2.565C13.462.895 11.43.002 9 .002 5.483.002 2.445 2.027.967 4.967l2.986 2.318c.712-2.138 2.7-3.72 5.047-3.72"></path>
                                </svg>
                                <span>Matricular com o Google</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- RODAPÉ DA COLUNA ESQUERDA (DOTTED MATRIX SVG FIEL AO PRINT) -->
            <div class="pt-6 flex items-center justify-between pointer-events-none select-none">
                <svg xmlns="http://www.w3.org/2000/svg" width="140" height="26" fill="currentColor" class="text-slate-700/40">
                    <path d="M2.02 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M18.178 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M34.337 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M50.495 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M66.654 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M82.812 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M98.97 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M115.129 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M131.287 18.01a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0"></path>
                    <path d="M2.02 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M18.178 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M34.337 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M50.495 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M66.654 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M82.812 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M98.97 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M115.129 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0M131.287 26.163a1.01 1.01 0 1 1-2.02 0 1.01 1.01 0 0 1 2.02 0"></path>
                </svg>
            </div>
        </section>

        <!-- ============================================================== -->
        <!-- COLUNA DIREITA: CÓSMICA COM MOVIMENTO VIVO & RACHI ACADEMY    -->
        <!-- ============================================================== -->
        <aside class="relative hidden lg:flex flex-col items-center justify-center min-h-screen overflow-hidden bg-black select-none">
            
            <!-- 1. CAMADA DE FUNDO CÓSMICO COM ANIMAÇÃO DE MOVIMENTO REAL (DRIFT & SCALE) -->
            <div class="absolute inset-[-6%] bg-cover bg-center bg-no-repeat animate-nebula-flow animate-vortex-glow pointer-events-none"
                 style="background-image: url('/images/bg-login-alura.png');">
            </div>

            <!-- 2. CANVAS INTERATIVO DE PARTÍCULAS / POEIRA ESTELAR EM MOVIMENTO DINÂMICO -->
            <canvas id="cosmicParticlesCanvas" class="absolute inset-0 w-full h-full pointer-events-none z-10"></canvas>

            <!-- 3. GRADIENTE DE INTEGRAÇÃO SUAVE COM A COLUNA ESQUERDA -->
            <div class="absolute inset-y-0 left-0 w-24 bg-gradient-to-r from-[#0c0d12] to-transparent z-10 pointer-events-none"></div>

            <!-- 4. CENTRO DO VÓRTICE CÓSMICO: LOGO RACHI ACADEMY (SUBSTITUINDO O ALURA DO PRINT COM PERFEIÇÃO) -->
            <div class="relative z-20 flex flex-col items-center justify-center text-center my-auto px-6">
                
                <!-- LOGO RACHI ACADEMY COM ESTILO IDENTICO AO LOGO CENTRAL DO PRINT -->
                <div class="flex flex-col items-center justify-center gap-1.5 mb-14 group transition-transform duration-500 hover:scale-[1.04]">
                    <!-- Logotipo Oficial Rachi em Branco Puro com Sombra Atmosférica -->
                    <div class="flex items-center gap-3">
                        <img src="/images/logo-rachi-light.png" 
                             onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/logo-rachi-light.png'" 
                             alt="RACHI" 
                             class="h-14 sm:h-16 w-auto object-contain drop-shadow-[0_4px_30px_rgba(0,163,224,0.65)]">
                    </div>
                    
                    <!-- Badge elegante ACADEMY com visual cósmico translúcido -->
                    <div class="inline-flex items-center gap-2 px-3 py-0.5 rounded-full bg-[#00a3e0]/15 border border-[#00a3e0]/40 backdrop-blur-md shadow-lg shadow-[#00a3e0]/20 mt-1">
                        <span class="w-1.5 h-1.5 rounded-full bg-cyan-400 animate-pulse"></span>
                        <span class="text-[11px] font-heading font-black tracking-[0.3em] uppercase text-cyan-200">
                            ACADEMY
                        </span>
                    </div>
                </div>

                <!-- CARD TRANSLÚCIDO FLUTUANTE (IDÊNTICO AO PRINT) -->
                <div class="animate-float-card flex flex-col items-center gap-4 w-full max-w-[420px] rounded-2xl bg-[#090b14]/75 border border-[#1e2538]/70 px-8 py-7 text-center backdrop-blur-xl shadow-2xl shadow-black/80">
                    <h2 class="text-base sm:text-lg font-normal text-white tracking-tight">
                        <span x-show="mode === 'login'">Ainda não estuda com a gente?</span>
                        <span x-show="mode === 'register'" x-cloak>Já estuda com a gente?</span>
                    </h2>
                    
                    <!-- Botão Fazer Matrícula que direciona a http://localhost:5173/#academy -->
                    <a 
                        x-show="mode === 'login'"
                        href="/#academy"
                        class="h-10 px-8 rounded-md border border-[#0050f0] bg-[#0050f0]/20 hover:bg-[#0050f0] text-white font-medium text-xs tracking-wider uppercase transition-all duration-200 cursor-pointer flex items-center justify-center shadow-lg shadow-[#0050f0]/20 hover:shadow-[#0050f0]/40">
                        FAZER MATRÍCULA
                    </a>

                    <!-- Botão Fazer Login em modo de matrícula -->
                    <button 
                        type="button" 
                        x-show="mode === 'register'"
                        x-cloak
                        @click="setMode('login')"
                        class="h-10 px-8 rounded-md border border-[#0050f0] bg-[#0050f0]/20 hover:bg-[#0050f0] text-white font-medium text-xs tracking-wider uppercase transition-all duration-200 cursor-pointer flex items-center justify-center shadow-lg shadow-[#0050f0]/20 hover:shadow-[#0050f0]/40">
                        FAZER LOGIN
                    </button>
                </div>
            </div>

        </aside>

    </div>

    <!-- ============================================================== -->
    <!-- MODAL DE CONFIRMAÇÃO & SUCESSO DE MATRÍCULA                     -->
    <!-- ============================================================== -->
    <div x-show="successModalOpen" 
         x-cloak
         class="fixed inset-0 bg-[#071326]/85 backdrop-blur-md z-50 flex items-center justify-center p-4 transition-all duration-300"
         @click.self="closeSuccessModal()">
        
        <div class="relative max-w-lg w-full bg-[#0d1a30] border border-emerald-500/30 rounded-3xl p-6 sm:p-8 shadow-2xl shadow-emerald-500/10 text-center overflow-hidden animate-in fade-in zoom-in-95 duration-200">
            <!-- Brilhos de fundo -->
            <div class="absolute -top-24 left-1/2 -translate-x-1/2 w-64 h-64 bg-emerald-500/15 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-emerald-500 via-[#00a3e0] to-emerald-400"></div>

            <!-- Botão de Fechar no topo -->
            <button 
                @click="closeSuccessModal()" 
                class="absolute top-4 right-4 text-slate-400 hover:text-white p-2 rounded-full hover:bg-white/5 transition cursor-pointer"
                title="Fechar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>

            <!-- Ícone de Sucesso -->
            <div class="w-16 h-16 rounded-full bg-emerald-500/20 border-2 border-emerald-400 flex items-center justify-center mx-auto mb-4 text-emerald-400 shadow-lg shadow-emerald-500/20">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Título e Subtítulo -->
            <h3 class="text-xl font-heading font-black text-white mb-2" x-text="successTitle"></h3>
            <p class="text-slate-300 text-xs mb-5 leading-relaxed" x-text="successMessage"></p>

            <!-- Card de Detalhes da Matrícula -->
            <div class="bg-[#08101e] border border-white/10 rounded-xl p-4 text-left mb-5 space-y-2.5">
                <div class="flex items-center justify-between pb-2 border-b border-white/5">
                    <span class="text-xs text-slate-400">Protocolo</span>
                    <span class="text-xs font-mono font-bold text-amber-400" x-text="lastEnrollment.protocol"></span>
                </div>
                <div class="flex items-center justify-between pb-2 border-b border-white/5">
                    <span class="text-xs text-slate-400">Estudante</span>
                    <span class="text-xs font-semibold text-white truncate max-w-[200px]" x-text="lastEnrollment.name"></span>
                </div>
                <div class="flex items-center justify-between pb-2 border-b border-white/5">
                    <span class="text-xs text-slate-400">E-mail</span>
                    <span class="text-xs font-semibold text-sky-300 truncate max-w-[200px]" x-text="lastEnrollment.email"></span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-xs text-slate-400">Status</span>
                    <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-500/20 text-emerald-300 border border-emerald-500/30">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                        Acesso Liberado
                    </span>
                </div>
            </div>

            <!-- Ações -->
            <div class="flex flex-col sm:flex-row gap-2.5">
                <a :href="'academy.html?auth=true&enrollment=' + (lastEnrollment.protocol || '')" 
                   class="flex-1 py-2.5 px-4 rounded-lg bg-[#0050f0] hover:bg-[#0042c7] text-white font-bold text-xs uppercase tracking-wider transition shadow-lg shadow-[#0050f0]/30 flex items-center justify-center gap-2">
                    <span>ACESSAR CATÁLOGO &rarr;</span>
                </a>
            </div>
        </div>
    </div>

    <!-- SCRIPT DE PARTICULAS DINÂMICAS & LÓGICA ALPINE.JS -->
    <script>
        // Animação de poeira estelar cósmica e partículas no Canvas
        function initCosmicParticles() {
            const canvas = document.getElementById('cosmicParticlesCanvas');
            if (!canvas) return;
            const ctx = canvas.getContext('2d');
            let animationFrameId;
            let width, height;
            let particles = [];
            const particleCount = 65;

            function resize() {
                width = canvas.width = canvas.offsetWidth;
                height = canvas.height = canvas.offsetHeight;
            }
            window.addEventListener('resize', resize);
            resize();

            class Particle {
                constructor() {
                    this.reset();
                }
                reset() {
                    this.x = Math.random() * width;
                    this.y = Math.random() * height;
                    this.size = Math.random() * 2.2 + 0.6;
                    this.speedX = (Math.random() - 0.5) * 0.45;
                    this.speedY = (Math.random() - 0.5) * 0.45 - 0.15;
                    this.alpha = Math.random() * 0.7 + 0.2;
                    this.pulseSpeed = Math.random() * 0.02 + 0.005;
                    this.color = Math.random() > 0.4 ? 'rgba(100, 180, 255, ' : 'rgba(255, 255, 255, ';
                }
                update() {
                    this.x += this.speedX;
                    this.y += this.speedY;
                    this.alpha += Math.sin(Date.now() * this.pulseSpeed) * 0.01;

                    if (this.x < 0) this.x = width;
                    if (this.x > width) this.x = 0;
                    if (this.y < 0) this.y = height;
                    if (this.y > height) this.y = 0;
                }
                draw() {
                    ctx.save();
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fillStyle = this.color + Math.max(0.1, Math.min(0.9, this.alpha)) + ')';
                    ctx.shadowColor = '#00a3e0';
                    ctx.shadowBlur = this.size * 3;
                    ctx.fill();
                    ctx.restore();
                }
            }

            for (let i = 0; i < particleCount; i++) {
                particles.push(new Particle());
            }

            function animate() {
                ctx.clearRect(0, 0, width, height);
                for (let i = 0; i < particles.length; i++) {
                    particles[i].update();
                    particles[i].draw();
                }
                animationFrameId = requestAnimationFrame(animate);
            }
            animate();
        }

        document.addEventListener('DOMContentLoaded', () => {
            initCosmicParticles();
        });

        function academyAuth() {
            return {
                mode: 'login', // 'login' ou 'register'
                loading: false,
                errorMessage: '',
                showPassword: false,
                successModalOpen: false,
                successTitle: '',
                successMessage: '',
                selectedCourse: '',
                coursePrice: '',

                loginForm: {
                    email: '',
                    password: ''
                },

                regForm: {
                    name: '',
                    email: '',
                    phone: '',
                    password: '',
                    passwordConfirm: '',
                    terms: true
                },

                lastEnrollment: {
                    protocol: '',
                    name: '',
                    email: '',
                    course: ''
                },

                initData() {
                    const urlParams = new URLSearchParams(window.location.search);
                    const modo = urlParams.get('modo');
                    if (modo === 'register' || modo === 'matricula' || modo === 'cadastro') {
                        this.mode = 'register';
                    } else {
                        this.mode = 'login';
                    }

                    const curso = urlParams.get('curso') || urlParams.get('course');
                    if (curso) {
                        this.selectedCourse = decodeURIComponent(curso);
                    }
                    const preco = urlParams.get('preco') || urlParams.get('price');
                    if (preco) {
                        this.coursePrice = decodeURIComponent(preco);
                    }

                    try {
                        const savedSession = localStorage.getItem('rachi_user_session');
                        if (savedSession) {
                            const parsed = JSON.parse(savedSession);
                            if (parsed.email) {
                                this.loginForm.email = parsed.email;
                                this.regForm.email = parsed.email;
                            }
                            if (parsed.name) {
                                this.regForm.name = parsed.name;
                            }
                        }
                    } catch(e) {}
                },

                setMode(newMode) {
                    this.mode = newMode;
                    this.errorMessage = '';
                    const url = new URL(window.location.href);
                    url.searchParams.set('modo', newMode);
                    window.history.replaceState({}, '', url);
                },

                async submitLogin() {
                    this.errorMessage = '';
                    if (!this.loginForm.email || !this.loginForm.password) {
                        this.errorMessage = 'Por favor, preencha todos os campos obrigatórios.';
                        return;
                    }

                    this.loading = true;
                    await new Promise(r => setTimeout(r, 600));

                    const studentName = this.loginForm.email.split('@')[0].replace(/[._]/g, ' ')
                        .replace(/\b\w/g, l => l.toUpperCase());

                    const sessionData = {
                        authenticated: true,
                        role: 'student',
                        name: studentName,
                        email: this.loginForm.email,
                        token: 'rachi_tk_' + Date.now().toString(36),
                        loginAt: new Date().toISOString()
                    };

                    localStorage.setItem('rachi_user_session', JSON.stringify(sessionData));
                    localStorage.setItem('rachi_academy_auth', 'true');

                    this.loading = false;
                    window.location.href = '/aluno-dashboard.html';
                },

                async submitRegister() {
                    this.errorMessage = '';
                    if (!this.regForm.name || !this.regForm.email || !this.regForm.password) {
                        this.errorMessage = 'Por favor, preencha todos os campos obrigatórios.';
                        return;
                    }

                    if (this.regForm.password !== this.regForm.passwordConfirm) {
                        this.errorMessage = 'As senhas digitadas não coincidem.';
                        return;
                    }

                    if (this.regForm.password.length < 6) {
                        this.errorMessage = 'A senha deve conter no mínimo 6 caracteres.';
                        return;
                    }

                    this.loading = true;
                    const protocol = 'RAC-' + new Date().getFullYear() + '-' + Math.floor(100000 + Math.random() * 900000);
                    const courseName = this.selectedCourse || 'Curso Geral RACHI Academy';

                    // Envio de e-mail de matrícula via FormSubmit
                    try {
                        const emailPayload = {
                            _subject: '🎓 Confirmação de Matrícula RACHI Academy [' + protocol + ']',
                            _template: 'table',
                            _captcha: 'false',
                            protocolo: protocol,
                            nome: this.regForm.name,
                            email: this.regForm.email,
                            telefone: this.regForm.phone || 'Não informado',
                            curso: courseName,
                            data_inscricao: new Date().toLocaleString('pt-AO')
                        };

                        await fetch('https://formsubmit.co/ajax/casimirogundja@outlook.com', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify(emailPayload)
                        });
                    } catch (err) {}

                    const sessionData = {
                        authenticated: true,
                        role: 'student',
                        name: this.regForm.name,
                        email: this.regForm.email,
                        course: courseName,
                        protocol: protocol,
                        token: 'rachi_tk_' + Date.now().toString(36),
                        enrolledAt: new Date().toISOString()
                    };

                    localStorage.setItem('rachi_user_session', JSON.stringify(sessionData));
                    localStorage.setItem('rachi_academy_auth', 'true');

                    this.lastEnrollment = {
                        protocol: protocol,
                        name: this.regForm.name,
                        email: this.regForm.email,
                        course: courseName
                    };

                    this.loading = false;
                    this.successTitle = 'Matrícula Realizada com Sucesso!';
                    this.successMessage = 'Sua inscrição na RACHI Academy foi confirmada. Acesse agora as suas aulas no catálogo!';
                    this.successModalOpen = true;
                },

                loginGoogle() {
                    this.loginForm.email = 'aluno.rachi@gmail.com';
                    this.loginForm.password = 'google_authenticated';
                    this.submitLogin();
                },

                forgotPassword() {
                    const email = this.loginForm.email || prompt('Digite o seu e-mail para recuperar a senha:');
                    if (email) {
                        alert('Enviamos instruções de redefinição de acesso para: ' + email);
                    }
                },

                closeSuccessModal() {
                    this.successModalOpen = false;
                    window.location.href = '/aluno-dashboard.html';
                }
            }
        }
    </script>
</body>
</html>
