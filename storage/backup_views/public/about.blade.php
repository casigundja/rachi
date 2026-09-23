@extends('layouts.public')

@section('title', 'Quem Somos — RACHI')

@section('content')
<!-- BREADCRUMB & HERO -->
<div class="bg-[#071326] text-white py-16 px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto">
        <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
            Sobre a RACHI
        </span>
        <h1 class="text-4xl md:text-5xl font-[850] text-white mt-4 uppercase tracking-tight">
            Quem <span class="text-[#eba72d]">Somos</span>
        </h1>
        <div class="w-20 h-1.5 bg-gradient-to-r from-[#00a3e0] to-[#eba72d] rounded-full my-6"></div>
        <p class="text-slate-300 text-lg md:text-xl max-w-3xl leading-relaxed">
            Soluções inteligentes para negócios mais fortes e sustentáveis.
        </p>
    </div>
</div>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-6 lg:px-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            <div class="lg:col-span-6">
                <h2 class="text-3xl md:text-4xl font-[850] text-[#071326] uppercase">
                    Parceira estratégica para empresas em crescimento
                </h2>
                <div class="space-y-4 text-slate-600 mt-6 leading-relaxed">
                    <p>
                        A <strong>RACHI</strong> actua como parceira estratégica para empresas que precisam de soluções práticas, integradas e confiáveis em Angola.
                    </p>
                    <p>
                        Combinamos competências em quatro áreas fundamentais — tecnologia, comunicação visual e produção gráfica, formação profissional e recursos humanos — para responder com agilidade e consistência aos desafios de cada cliente.
                    </p>
                </div>
                <div class="mt-8 flex gap-4">
                    <a href="{{ route('contact') }}" class="px-6 py-3 rounded-lg bg-[#071326] hover:bg-slate-800 text-white font-bold text-sm transition">
                        Fale connosco &rarr;
                    </a>
                    <a href="{{ route('what-we-do') }}" class="px-6 py-3 rounded-lg border border-slate-300 hover:border-slate-800 text-slate-700 font-bold text-sm transition">
                        O que fazemos
                    </a>
                </div>
            </div>

            <div class="lg:col-span-6">
                <div class="rounded-3xl overflow-hidden shadow-2xl border border-slate-200">
                    <img src="https://hom.rachi.ao/assets/img/about-team.png" 
                         onerror="this.onerror=null; this.src='https://hom.rachi.ao/assets/img/about-team.webp'"
                         alt="Equipa RACHI — pessoas, processos e tecnologia" 
                         class="w-full h-auto">
                </div>
            </div>
        </div>

        <!-- 3 Pillars Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-20">
            <div class="p-8 rounded-2xl border border-slate-200 bg-slate-50">
                <span class="text-2xl font-black text-blue-600 block mb-3">01</span>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Negócio integrado</h3>
                <p class="text-sm text-slate-600">
                    Unimos tecnologia, produção gráfica, capacitação e recursos humanos para simplificar a operação da sua empresa.
                </p>
            </div>
            <div class="p-8 rounded-2xl border border-slate-200 bg-slate-50">
                <span class="text-2xl font-black text-amber-500 block mb-3">02</span>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Parceria B2B</h3>
                <p class="text-sm text-slate-600">
                    Trabalhamos lado a lado com equipas e lideranças, criando soluções ajustadas a cada desafio do negócio.
                </p>
            </div>
            <div class="p-8 rounded-2xl border border-slate-200 bg-slate-50">
                <span class="text-2xl font-black text-emerald-600 block mb-3">03</span>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Crescimento sustentável</h3>
                <p class="text-sm text-slate-600">
                    Focamos em eficiência, qualidade e inovação para apoiar o desenvolvimento contínuo da sua organização.
                </p>
            </div>
        </div>
    </div>
</section>
@endsection
