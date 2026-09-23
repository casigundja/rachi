@extends('layouts.public')

@section('title', 'Ética e Compliance — RACHI')

@section('content')
<div class="bg-[#071326] text-white py-16 px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto">
        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
            Governação Corporativa
        </span>
        <h1 class="text-4xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
            Ética e <span class="text-[#eba72d]">Compliance</span>
        </h1>
        <div class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full my-6"></div>
        <p class="text-slate-300 text-lg md:text-xl max-w-3xl leading-relaxed">
            Ética que orienta. Integridade que fortalece. Crescer com confiança exige princípios, responsabilidade e conformidade legal.
        </p>
    </div>
</div>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="max-w-3xl mb-12">
            <h2 class="text-3xl font-extrabold text-slate-900">Os 4 Pilares da Nossa Actuação</h2>
            <p class="text-slate-600 mt-2">
                A nossa actuação é orientada pelo rigor no cumprimento das leis, protecção da informação e relações comerciais justas.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50">
                <span class="text-amber-500 font-bold text-xs">Pilar 01</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1 mb-2">Ética e Integridade</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Relações comerciais honestas, combate a fraudes e cumprimento integral dos acordos assumidos.
                </p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50">
                <span class="text-blue-500 font-bold text-xs">Pilar 02</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1 mb-2">Transparência</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Comunicação clara, prestação de contas responsável e transparência nos orçamentos e contratos.
                </p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50">
                <span class="text-emerald-500 font-bold text-xs">Pilar 03</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1 mb-2">Responsabilidade</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Sigilo profissional, segurança de dados confidenciais e responsabilidade civil e social.
                </p>
            </div>
            <div class="p-6 rounded-2xl border border-slate-200 bg-slate-50">
                <span class="text-cyan-500 font-bold text-xs">Pilar 04</span>
                <h3 class="text-lg font-bold text-slate-900 mt-1 mb-2">Conformidade Legal</h3>
                <p class="text-xs text-slate-600 leading-relaxed">
                    Aderência estrita à legislação angolana, direitos dos trabalhadores e normas de auditoria.
                </p>
            </div>
        </div>

        <div class="mt-16 p-8 rounded-3xl bg-[#071326] text-white flex flex-col md:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="text-xl font-bold">Precisa do nosso dossiê de Compliance ou Certidões?</h3>
                <p class="text-sm text-slate-300 mt-1">
                    Disponibilizamos aos parceiros institucionais e clientes corporativos toda a documentação comprobatória.
                </p>
            </div>
            <a href="{{ route('contact') }}" class="px-6 py-3 rounded-xl bg-amber-500 hover:bg-amber-400 text-slate-950 font-bold text-sm transition whitespace-nowrap">
                Contactar Departamento Jurídico &rarr;
            </a>
        </div>
    </div>
</section>
@endsection
