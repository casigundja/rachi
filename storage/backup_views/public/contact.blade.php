@extends('layouts.public')

@section('title', 'Contacto — Fale Connosco — RACHI Soluções Inteligentes')

@section('content')
<div class="min-h-screen bg-slate-50">
    <!-- Hero Banner -->
    <section class="bg-[#071326] text-white pt-14 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/30 via-transparent to-amber-900/20 pointer-events-none"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <!-- Breadcrumbs -->
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                <a href="{{ route('home') }}" class="hover:text-white transition cursor-pointer">Início</a>
                <span>/</span>
                <span class="text-amber-400 font-semibold">Contacto</span>
            </nav>

            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/30 text-blue-400 text-xs font-bold uppercase tracking-wider mb-4">
                    <span class="w-2 h-2 rounded-full bg-[#00a3e0] animate-pulse"></span>
                    Atendimento &amp; Suporte Corporativo
                </div>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-white tracking-tight leading-tight uppercase">
                    Fale com a <span class="text-amber-400">RACHI</span>
                </h1>
                <p class="mt-4 text-slate-300 text-base sm:text-lg leading-relaxed">
                    Conte-nos o seu desafio. A nossa equipa de consultores responde prontamente com a solução ideal para a sua empresa ou projecto em Angola.
                </p>
            </div>
        </div>
    </section>

    <!-- SECTION: CONTACTO DETAILS & FORM (EXACT MATCH TO USER SCREENSHOT) -->
    <section id="contacto" class="py-16 md:py-24 bg-slate-50" aria-labelledby="contact-title">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                <!-- Left Column: Information Cards -->
                <div class="lg:col-span-5 space-y-6">
                    <div>
                        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0]">Contacto Directo</span>
                        <h2 id="contact-title" class="text-3xl md:text-4xl font-[850] text-[#071326] mt-2 uppercase tracking-tight">
                            Fale connosco
                        </h2>
                        <p class="text-slate-600 mt-2 text-sm leading-relaxed">
                            Conte-nos o seu desafio. A equipa RACHI responde com a solução certa para a sua empresa ou projecto em Angola.
                        </p>
                    </div>

                    <div class="space-y-4">
                        <div class="flex items-center gap-4 p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="mail" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">E-mail</div>
                                <a href="mailto:geral@rachi.ao" class="text-base font-bold text-slate-900 hover:text-blue-600 transition">geral@rachi.ao</a>
                                <div class="text-[11px] text-slate-500 mt-0.5">Resposta em menos de 24 horas úteis</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="phone" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">Telefone</div>
                                <a href="tel:+244923000000" class="text-base font-bold text-slate-900 hover:text-amber-600 transition">+244 923 000 000</a>
                                <div class="text-[11px] text-slate-500 mt-0.5">Atendimento telefónico e WhatsApp</div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 p-5 rounded-2xl bg-white border border-slate-200 shadow-sm hover:shadow-md transition">
                            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="map-pin" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <div class="text-xs text-slate-400 font-bold uppercase tracking-wider">Localização</div>
                                <div class="text-base font-bold text-slate-900">Luanda, Angola</div>
                                <div class="text-[11px] text-slate-500 mt-0.5">Sede administrativa e operativa</div>
                            </div>
                        </div>
                    </div>

                    <!-- Operating hours & Commitment -->
                    <div class="p-6 rounded-2xl bg-[#071326] text-white">
                        <h3 class="text-sm font-bold text-amber-400 uppercase tracking-wider mb-2 flex items-center gap-2">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                            Horário de Funcionamento
                        </h3>
                        <p class="text-xs text-slate-300 leading-relaxed">
                            Segunda a Sexta-feira: <strong>08:00 – 17:00</strong><br>
                            Sábados e Feriados: <em>Plantão sob agendamento</em>
                        </p>
                    </div>
                </div>

                <!-- Right Column: Contact Form (Exact match to screenshot) -->
                <div class="lg:col-span-7 bg-white p-8 sm:p-10 rounded-3xl border border-slate-200 shadow-xl">
                    <h3 class="text-2xl font-bold text-slate-900 mb-6">Envie a sua mensagem</h3>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-semibold">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Nome Completo</label>
                                <input type="text" name="name" required placeholder="Seu nome" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">E-mail Profissional</label>
                                <input type="email" name="email" required placeholder="seu.email@empresa.ao" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Telefone / WhatsApp</label>
                                <input type="text" name="phone" placeholder="+244 9..." class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Unidade de Interesse</label>
                                <select name="subject" class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition bg-white">
                                    <option value="Geral">Todas / Consultoria Geral</option>
                                    <option value="Tecnologia">RACHI Tec (Tecnologia &amp; Software)</option>
                                    <option value="Gráfica">RACHI Print (Gráfica &amp; Brindes)</option>
                                    <option value="Academy">RACHI Academy (Formação &amp; Cursos)</option>
                                    <option value="RH">RACHI Capital (RH &amp; Recrutamento)</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase text-slate-700 mb-1.5">Como podemos ajudar?</label>
                            <textarea name="message" rows="5" required placeholder="Descreva sucintamente a sua necessidade ou solicitação de proposta..." class="w-full px-4 py-3 rounded-xl border border-slate-300 text-sm focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100 transition resize-y"></textarea>
                        </div>

                        <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-sm uppercase tracking-wider shadow-lg shadow-amber-500/25 transition">
                            Enviar Mensagem Agora &rarr;
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
