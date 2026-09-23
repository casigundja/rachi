@extends('layouts.public')

@section('title', 'O Que Fazemos — RACHI')

@section('content')
<div class="bg-[#071326] text-white py-16 px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto">
        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
            Capacidades da Empresa
        </span>
        <h1 class="text-4xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
            O Que <span class="text-[#eba72d]">Fazemos</span>
        </h1>
        <div class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full my-6"></div>
        <p class="text-slate-300 text-lg md:text-xl max-w-3xl leading-relaxed">
            Soluções inteligentes para transformar e impulsionar o seu negócio.
        </p>
    </div>
</div>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center mb-16">
            <div class="lg:col-span-6">
                <div class="bg-white p-6 rounded-2xl border-l-4 border-amber-500 shadow-sm mb-6">
                    <p class="text-lg font-bold text-slate-900">
                        "Mais do que serviços, entregamos soluções que geram resultados."
                    </p>
                </div>
                <p class="text-slate-600 leading-relaxed mb-4">
                    A RACHI desenvolve serviços pensados para criar, estruturar, modernizar e fortalecer empresas. A nossa lógica de actuação é simples: reduzir dificuldades, acelerar decisões e oferecer uma experiência empresarial integrada.
                </p>
                <p class="text-slate-600 leading-relaxed">
                    Acompanhamos o cliente desde a legalização do negócio até à organização administrativa, capacitação das equipas, digitalização dos processos e comunicação visual da marca.
                </p>
            </div>
            <div class="lg:col-span-6">
                <img src="https://hom.rachi.ao/assets/img/what-we-do-team.png" 
                     onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/what-we-do-team.webp'"
                     alt="Equipa RACHI" 
                     class="w-full h-auto rounded-3xl shadow-xl border border-slate-200 dark:border-slate-800 dark:hidden">
                <img src="/images/what-we-do-team-dark.jpg" 
                     onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/what-we-do-team.png'"
                     alt="Equipa RACHI" 
                     class="w-full h-auto rounded-3xl shadow-xl border border-slate-200 dark:border-slate-800 hidden dark:block">
            </div>
        </div>

        <!-- Ecosystem diagram -->
                    <!-- ECOSYSTEM INFOGRAPHIC DIAGRAM (100% VETORIAL, NÍTIDO EM RETINA/4K) -->
                    <div class="mt-16 bg-white p-6 sm:p-10 md:p-12 rounded-3xl border border-slate-200/80 shadow-2xl relative overflow-hidden">
                        <!-- Subtle background illumination -->
                        <div class="absolute -top-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-blue-500/5 rounded-full blur-3xl pointer-events-none"></div>
                        <div class="absolute -bottom-20 left-1/2 -translate-x-1/2 w-96 h-96 bg-amber-500/5 rounded-full blur-3xl pointer-events-none"></div>

                        <div class="text-center mb-10 relative z-10">
                            <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-50 px-3.5 py-1 rounded-full border border-blue-100">
                                Visão Integrada
                            </span>
                            <h3 class="text-2xl md:text-3xl font-[850] text-[#071326] mt-2 uppercase tracking-tight">
                                O nosso ecossistema de soluções
                            </h3>
                            <p class="text-xs sm:text-sm text-slate-500 max-w-xl mx-auto mt-2">
                                Uma estrutura conectada e sinérgica pensada para atender todas as fases de crescimento do seu negócio.
                            </p>
                        </div>

                        <!-- DIAGRAM CONTENT (DESKTOP TREE & RESPONSIVE GRID) -->
                        <div class="relative max-w-5xl mx-auto z-10">
                            
                            <!-- DESKTOP CONNECTOR SVG OVERLAY (Hidden on mobile) -->
                            <div class="hidden lg:block absolute inset-0 pointer-events-none z-0">
                                <svg class="w-full h-full" viewBox="0 0 1000 460" fill="none" preserveAspectRatio="none">
                                    <defs>
                                        <linearGradient id="lineGradLeft1" x1="360" y1="75" x2="460" y2="200" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#2563eb" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradLeft2" x1="360" y1="230" x2="450" y2="230" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#f59e0b" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#f59e0b" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradLeft3" x1="360" y1="385" x2="460" y2="260" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#10b981" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradRight1" x1="640" y1="75" x2="540" y2="200" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#06b6d4" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#00a3e0" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradRight2" x1="640" y1="230" x2="550" y2="230" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#9333ea" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#9333ea" stop-opacity="0.3"/>
                                        </linearGradient>
                                        <linearGradient id="lineGradRight3" x1="640" y1="385" x2="540" y2="260" gradientUnits="userSpaceOnUse">
                                            <stop stop-color="#f97316" stop-opacity="0.7"/>
                                            <stop offset="1" stop-color="#eba72d" stop-opacity="0.3"/>
                                        </linearGradient>
                                    </defs>

                                    <!-- Left Lines -->
                                    <!-- Top Left to Center -->
                                    <path d="M 360 75 C 430 75, 430 195, 465 205" stroke="url(#lineGradLeft1)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="430" cy="135" r="4.5" fill="#2563eb" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Middle Left to Center -->
                                    <path d="M 360 230 L 450 230" stroke="url(#lineGradLeft2)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="405" cy="230" r="4.5" fill="#f59e0b" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Bottom Left to Center -->
                                    <path d="M 360 385 C 430 385, 430 265, 465 255" stroke="url(#lineGradLeft3)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="430" cy="325" r="4.5" fill="#10b981" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Right Lines -->
                                    <!-- Top Right to Center -->
                                    <path d="M 640 75 C 570 75, 570 195, 535 205" stroke="url(#lineGradRight1)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="570" cy="135" r="4.5" fill="#06b6d4" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Middle Right to Center -->
                                    <path d="M 640 230 L 550 230" stroke="url(#lineGradRight2)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="595" cy="230" r="4.5" fill="#9333ea" stroke="#ffffff" stroke-width="2"/>

                                    <!-- Bottom Right to Center -->
                                    <path d="M 640 385 C 570 385, 570 265, 535 255" stroke="url(#lineGradRight3)" stroke-width="2.5" stroke-linecap="round"/>
                                    <circle cx="570" cy="325" r="4.5" fill="#f97316" stroke="#ffffff" stroke-width="2"/>
                                </svg>
                            </div>

                            <!-- 3-Column Content Grid -->
                            <div class="grid grid-cols-1 lg:grid-cols-11 gap-6 lg:gap-8 items-center relative z-10">
                                
                                <!-- LEFT COLUMN (3 Pillars) -->
                                <div class="lg:col-span-4 space-y-4">
                                    <!-- 01: Formalização Empresarial -->
                                    <div class="group bg-white hover:bg-blue-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-blue-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div class="w-12 h-12 rounded-xl bg-blue-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-blue-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="file-check-2" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-blue-600 uppercase tracking-wide">
                                                Formalização Empresarial
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Legalização, constituição e regularização do negócio.
                                            </p>
                                        </div>
                                        <span class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-blue-600 border-2 border-white shadow"></span>
                                    </div>

                                    <!-- 02: Recursos Humanos -->
                                    <div class="group bg-white hover:bg-amber-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-amber-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div class="w-12 h-12 rounded-xl bg-amber-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-amber-500/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="users" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-amber-500 uppercase tracking-wide">
                                                Recursos Humanos
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Gestão de pessoas, recrutamento e desenvolvimento.
                                            </p>
                                        </div>
                                        <span class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-amber-500 border-2 border-white shadow"></span>
                                    </div>

                                    <!-- 03: Formação Profissional -->
                                    <div class="group bg-white hover:bg-emerald-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-emerald-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <div class="w-12 h-12 rounded-xl bg-emerald-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-emerald-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-emerald-600 uppercase tracking-wide">
                                                Formação Profissional
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Capacitação prática para equipas mais produtivas.
                                            </p>
                                        </div>
                                        <span class="hidden lg:block absolute -right-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-emerald-600 border-2 border-white shadow"></span>
                                    </div>
                                </div>

                                <!-- CENTER HUB: RACHI CENTRAL NODE -->
                                <div class="lg:col-span-3 flex flex-col items-center justify-center py-4 lg:py-0">
                                    <div class="relative group">
                                        <!-- Animated Ambient Glow -->
                                        <div class="absolute -inset-2 rounded-full bg-gradient-to-r from-blue-500 via-amber-400 to-cyan-400 opacity-30 group-hover:opacity-60 blur-md transition duration-500"></div>
                                        
                                        <!-- Central Node Badge -->
                                        <div class="relative w-36 h-36 sm:w-44 sm:h-44 rounded-full bg-[#071326] border-4 border-white shadow-2xl flex flex-col items-center justify-center text-center p-3 transition-transform duration-300 group-hover:scale-105">
                                            
                                            <!-- Brand Graphic Emblem -->
                                            <div class="w-10 h-10 sm:w-12 sm:h-12 mb-1 flex items-center justify-center">
                                                <svg viewBox="0 0 60 60" fill="none" class="w-9 h-9 sm:w-11 sm:h-11 drop-shadow">
                                                    <path d="M14 10H32C39.732 10 46 16.268 46 24C46 31.732 39.732 38 32 38H24V50H14V10Z" fill="url(#rachiHubGrad)"/>
                                                    <path d="M30 36L44 50H32L22 38H30Z" fill="#eba72d"/>
                                                    <circle cx="28" cy="24" r="6" fill="#071326"/>
                                                    <defs>
                                                        <linearGradient id="rachiHubGrad" x1="14" y1="10" x2="46" y2="38" gradientUnits="userSpaceOnUse">
                                                            <stop stop-color="#00a3e0"/>
                                                            <stop offset="1" stop-color="#eba72d"/>
                                                        </linearGradient>
                                                    </defs>
                                                </svg>
                                            </div>

                                            <span class="text-white font-[900] text-sm sm:text-base tracking-wider uppercase leading-tight">
                                                RACHI
                                            </span>
                                            <span class="text-[8px] sm:text-[9px] font-bold text-amber-400 tracking-[0.15em] uppercase mt-0.5 leading-none">
                                                SOLUÇÕES INTELIGENTES
                                            </span>

                                            <!-- Connector Points around Circle -->
                                            <span class="absolute -top-1.5 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-[#00a3e0] border-2 border-white shadow"></span>
                                            <span class="absolute -bottom-1.5 left-1/2 -translate-x-1/2 w-3 h-3 rounded-full bg-emerald-500 border-2 border-white shadow"></span>
                                            <span class="absolute -left-1.5 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-amber-500 border-2 border-white shadow"></span>
                                            <span class="absolute -right-1.5 top-1/2 -translate-y-1/2 w-3 h-3 rounded-full bg-cyan-400 border-2 border-white shadow"></span>
                                        </div>
                                    </div>
                                </div>

                                <!-- RIGHT COLUMN (3 Pillars) -->
                                <div class="lg:col-span-4 space-y-4">
                                    <!-- 04: Tecnologia e Digitalização -->
                                    <div class="group bg-white hover:bg-cyan-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-cyan-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-cyan-500 border-2 border-white shadow"></span>
                                        <div class="w-12 h-12 rounded-xl bg-cyan-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-cyan-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="monitor" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-cyan-600 uppercase tracking-wide">
                                                Tecnologia e Digitalização
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Soluções tecnológicas para automatizar e escalar.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 05: Comunicação Institucional -->
                                    <div class="group bg-white hover:bg-purple-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-purple-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-purple-600 border-2 border-white shadow"></span>
                                        <div class="w-12 h-12 rounded-xl bg-purple-600 text-white flex items-center justify-center shrink-0 shadow-md shadow-purple-600/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="megaphone" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-purple-600 uppercase tracking-wide">
                                                Comunicação Institucional
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Identidade visual, marketing e presença no mercado.
                                            </p>
                                        </div>
                                    </div>

                                    <!-- 06: Produção Gráfica -->
                                    <div class="group bg-white hover:bg-orange-50/50 p-4 sm:p-5 rounded-2xl border border-slate-200 hover:border-orange-500 shadow-sm hover:shadow-lg transition-all duration-300 flex items-center gap-4 relative">
                                        <span class="hidden lg:block absolute -left-2 top-1/2 -translate-y-1/2 w-3.5 h-3.5 rounded-full bg-orange-500 border-2 border-white shadow"></span>
                                        <div class="w-12 h-12 rounded-xl bg-orange-500 text-white flex items-center justify-center shrink-0 shadow-md shadow-orange-500/25 group-hover:scale-110 transition-transform">
                                            <i data-lucide="printer" class="w-6 h-6"></i>
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="text-xs sm:text-sm font-extrabold text-orange-500 uppercase tracking-wide">
                                                Produção Gráfica
                                            </h4>
                                            <p class="text-xs text-slate-600 mt-1 leading-snug">
                                                Materiais gráficos de qualidade que fortalecem a marca.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Bottom Badges / Trust Points -->
                        <div class="mt-10 pt-6 border-t border-slate-100 flex flex-wrap items-center justify-center gap-6 sm:gap-10 text-xs font-semibold text-slate-500">
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span>
                                <span>Soluções 100% Integradas</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span>
                                <span>Parceiro Estratégico B2B</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span>
                                <span>Rigor, Inovação e Conformidade</span>
                            </div>
                        </div>
                    </div>

    
    </div>
</section>
@endsection
