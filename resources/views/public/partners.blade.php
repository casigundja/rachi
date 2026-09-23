@extends('layouts.public')

@section('title', 'Parceiros — RACHI')

@section('content')
<div class="bg-[#071326] text-white py-16 px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto">
        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
            Alianças Estratégicas
        </span>
        <h1 class="text-4xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
            Nossos <span class="text-[#eba72d]">Parceiros</span>
        </h1>
        <div class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full my-6"></div>
        <p class="text-slate-300 text-lg md:text-xl max-w-3xl leading-relaxed">
            Marcas e instituições que caminham connosco para transformar o ecossistema empresarial em Angola.
        </p>
    </div>
</div>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- INOV QUIMUA -->
            <a href="https://ticket.ao/author/inov-quimua-consultoria/" target="_blank" rel="noopener noreferrer" 
               class="p-8 rounded-3xl border border-slate-200 bg-slate-50 hover:bg-white hover:border-blue-500 hover:shadow-2xl transition-all duration-300 group flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-xs font-extrabold text-blue-600 uppercase tracking-wider bg-blue-100/60 px-3 py-1 rounded-full">
                            Parceiro 01
                        </span>
                        <span class="text-xs font-bold text-slate-400 group-hover:text-blue-600 transition">
                            Visitar website &rarr;
                        </span>
                    </div>
                    <div class="h-20 flex items-center mb-6">
                        <img src="/images/inov-quimua-clean.png" 
                             alt="INOV QUIMUA" 
                             class="max-h-full max-w-[180px] object-contain rounded-lg dark:hidden">
                        <img src="/images/inov-quimua-dark.png" 
                             alt="INOV QUIMUA" 
                             class="max-h-full max-w-[180px] object-contain rounded-lg hidden dark:block">
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 group-hover:text-blue-600 transition">INOV QUIMUA</h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        Inov Quimua Consultoria é uma empresa de consultoria em Angola liderada por Pedro Ivanov, conhecida por organizar eventos empresariais e fóruns de liderança voltados para o desenvolvimento local, como o Cacuaco Business &amp; Leadership Summit.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-200/80 text-xs font-bold text-blue-600 flex items-center gap-1">
                    <span>Consultoria empresarial &bull; Liderança &bull; Cimeiras</span>
                </div>
            </a>

            <!-- HELTON PLUS -->
            <a href="https://heltonplus.ao/" target="_blank" rel="noopener noreferrer" 
               class="p-8 rounded-3xl border border-slate-200 bg-slate-50 hover:bg-white hover:border-amber-500 hover:shadow-2xl transition-all duration-300 group flex flex-col justify-between">
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <span class="text-xs font-extrabold text-amber-600 uppercase tracking-wider bg-amber-100/60 px-3 py-1 rounded-full">
                            Parceiro 02
                        </span>
                        <span class="text-xs font-bold text-slate-400 group-hover:text-amber-600 transition">
                            Visitar website &rarr;
                        </span>
                    </div>
                    <div class="h-20 flex items-center mb-6">
                        <img src="/images/helton-plus-clean.png" 
                             alt="HELTON PLUS" 
                             class="max-h-full max-w-[180px] object-contain rounded-lg dark:hidden">
                        <img src="/images/helton-plus-dark.png" 
                             alt="HELTON PLUS" 
                             class="max-h-full max-w-[180px] object-contain rounded-lg hidden dark:block">
                    </div>
                    <h3 class="text-2xl font-bold text-slate-900 group-hover:text-amber-500 transition">HELTON PLUS</h3>
                    <p class="text-sm text-slate-600 mt-3 leading-relaxed">
                        Líder em soluções de higienização e controle de pragas. Compromisso rigoroso com a saúde e conformidade ambiental de Ambientes Corporativos, Institucionais e Familiares.
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-200/80 text-xs font-bold text-amber-600 flex items-center gap-1">
                    <span>Soluções ambientais &bull; Saúde corporativa &bull; Certificações</span>
                </div>
            </a>
        </div>
    </div>
</section>
@endsection
