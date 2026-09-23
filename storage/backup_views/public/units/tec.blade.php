@extends('layouts.public')

@section('title', 'RACHI Tec — Tecnologia e Inovação Digital')

@section('content')
<div class="min-h-screen bg-slate-50">
    <section class="bg-[#071326] text-white pt-14 pb-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                <a href="{{ route('home') }}" class="hover:text-white transition">Início</a>
                <span>/</span>
                <span class="text-slate-500">Soluções</span>
                <span>/</span>
                <span class="text-[#00a3e0] font-semibold">RACHI Tec</span>
            </nav>
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-blue-500/10 border border-blue-500/30 text-blue-400 text-xs font-bold uppercase tracking-wider mb-4">
                    <span class="w-2 h-2 rounded-full bg-[#00a3e0] animate-pulse"></span>
                    Divisão de Tecnologia
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Transformação Digital, <span class="text-[#00a3e0]">Sistemas Robustos</span> e Websites
                </h1>
                <p class="mt-4 text-slate-300 text-base leading-relaxed">
                    {{ $unit->description ?? 'Engenharia de software sob medida, plataformas corporativas, lojas virtuais inteligentes e infraestrutura em nuvem.' }}
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-blue-600 font-bold text-xs uppercase tracking-widest">Catálogo de Serviços</span>
            <h2 class="text-3xl font-black text-slate-900 mt-1">Soluções em Tecnologia</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($services as $service)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $service->name }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">{{ $service->description }}</p>
                </div>
                <div class="pt-4 border-t flex justify-between items-center">
                    <span class="text-sm font-black text-blue-600">{{ number_format($service->base_price, 2, ',', '.') }} AOA</span>
                    <a href="{{ route('contact') }}" class="px-4 py-2 bg-[#071326] text-white rounded-lg text-xs font-bold hover:bg-blue-600 transition">Solicitar</a>
                </div>
            </div>
            @empty
            <p class="text-center text-slate-500 col-span-3">Nenhum serviço cadastrado no momento.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
