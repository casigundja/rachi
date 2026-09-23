@extends('layouts.public')

@section('title', 'Depoimentos — RACHI')

@section('content')
<div class="bg-[#071326] text-white py-16 px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto">
        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
            Reconhecimento
        </span>
        <h1 class="text-4xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
            O Que Dizem <span class="text-[#eba72d]">Sobre Nós</span>
        </h1>
        <div class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full my-6"></div>
        <p class="text-slate-300 text-lg md:text-xl max-w-3xl leading-relaxed">
            Resultados e confiança construídos com empresas, líderes e profissionais que escolheram a RACHI.
        </p>
    </div>
</div>

<section class="py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 mb-4">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    </div>
                    <p class="text-sm text-slate-700 leading-relaxed italic">
                        "A parceria com a RACHI permitiu modernizar os nossos processos e equipar a nossa infraestrutura tecnológica com elevado rigor. O suporte técnico é impecável."
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-700 font-bold flex items-center justify-center text-sm">
                        CM
                    </div>
                    <div>
                        <div class="font-bold text-slate-900 text-sm">Carlos Mendes</div>
                        <div class="text-xs text-slate-500">Director de Operações &bull; Grupo Industrial</div>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 mb-4">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    </div>
                    <p class="text-sm text-slate-700 leading-relaxed italic">
                        "Os serviços gráficos da RACHI Print e as formações corporativas da Academy elevaram o padrão institucional e a produtividade da nossa equipa."
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-700 font-bold flex items-center justify-center text-sm">
                        AP
                    </div>
                    <div>
                        <div class="font-bold text-slate-900 text-sm">Ana Paula Ferreira</div>
                        <div class="text-xs text-slate-500">Gestora de RH &bull; Serviços Corporativos</div>
                    </div>
                </div>
            </div>

            <div class="p-8 rounded-3xl bg-white border border-slate-200 shadow-sm hover:shadow-xl transition-all flex flex-col justify-between">
                <div>
                    <div class="flex text-amber-400 mb-4">
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                        <i data-lucide="star" class="w-4 h-4 fill-current"></i>
                    </div>
                    <p class="text-sm text-slate-700 leading-relaxed italic">
                        "Agilidade, pontualidade e soluções que realmente funcionam no contexto empresarial angolano. A entrega de consumíveis foi irrepreensível."
                    </p>
                </div>
                <div class="mt-6 pt-4 border-t border-slate-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center text-sm">
                        MS
                    </div>
                    <div>
                        <div class="font-bold text-slate-900 text-sm">Mateus Silva</div>
                        <div class="text-xs text-slate-500">CEO &bull; Inovação &amp; Distribuição</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
