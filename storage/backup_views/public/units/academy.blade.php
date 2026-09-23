@extends('layouts.public')

@section('title', 'RACHI Academy — Formação e Desenvolvimento Executivo')

@section('content')
<div class="min-h-screen bg-slate-50">
    <section class="bg-[#071326] text-white pt-14 pb-16 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
                <a href="{{ route('home') }}" class="hover:text-white transition">Início</a>
                <span>/</span>
                <span class="text-slate-500">Soluções</span>
                <span>/</span>
                <span class="text-emerald-400 font-semibold">RACHI Academy</span>
            </nav>
            <div class="max-w-3xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-bold uppercase tracking-wider mb-4">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Formação Profissional
                </div>
                <h1 class="text-3xl sm:text-5xl font-extrabold text-white tracking-tight leading-tight">
                    Capacitação Prática, <span class="text-emerald-400">Certificação Oficial</span> e Liderança
                </h1>
                <p class="mt-4 text-slate-300 text-base leading-relaxed">
                    {{ $unit->description ?? 'Cursos práticos e certificados para capacitação profissional contínua de executivos e equipas.' }}
                </p>
            </div>
        </div>
    </section>

    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-3xl mx-auto mb-12">
            <span class="text-emerald-600 font-bold text-xs uppercase tracking-widest">Catálogo Académico</span>
            <h2 class="text-3xl font-black text-slate-900 mt-1">Cursos com Inscrições Abertas</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($courses as $course)
            <div class="bg-white rounded-2xl border border-slate-200 p-6 shadow-sm flex flex-col justify-between">
                <div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">{{ $course->title }}</h3>
                    <p class="text-slate-600 text-xs leading-relaxed mb-4">{{ $course->description }}</p>
                </div>
                <div class="pt-4 border-t flex justify-between items-center">
                    <span class="text-sm font-black text-emerald-600">{{ number_format($course->price, 2, ',', '.') }} AOA</span>
                    <a href="{{ route('academy.enroll') }}?curso={{ urlencode($course->title) }}&preco={{ urlencode(number_format($course->price, 2, ',', '.') . ' AOA') }}&modo=register" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-xs font-bold hover:bg-emerald-700 transition flex items-center gap-1">
                        <span>Matricular</span>
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>
            @empty
            <p class="text-center text-slate-500 col-span-3">Nenhum curso cadastrado no momento.</p>
            @endforelse
        </div>
    </section>
</div>
@endsection
