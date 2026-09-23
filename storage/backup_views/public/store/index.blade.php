@extends('layouts.public')

@section('title', 'Produtos para a sua empresa — Loja RACHI')

@section('content')
<!-- STORE HERO BANNER -->
<section class="bg-[#071326] text-white pt-12 pb-16 px-6 lg:px-12 border-b border-slate-800">
    <div class="max-w-7xl mx-auto">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6 font-medium">
            <a href="{{ route('home') }}" class="hover:text-white transition">Início</a>
            <span class="text-slate-600">/</span>
            <span class="text-amber-400 font-bold">Loja</span>
        </nav>

        <div class="max-w-3xl">
            <span class="text-xs font-bold uppercase tracking-widest text-[#00a3e0] bg-blue-950/80 px-3 py-1 rounded-full border border-blue-800/60">
                Loja Corporativa RACHI
            </span>
            <h1 class="text-3xl md:text-5xl font-[850] text-white mt-3 uppercase tracking-tight">
                Produtos para a sua <span class="text-[#eba72d]">empresa</span>
            </h1>
            <p class="text-slate-300 text-base md:text-lg mt-3 leading-relaxed">
                Encontre consumíveis, equipamentos, software e serviços num único lugar com entrega garantida em Luanda.
            </p>
        </div>

        <!-- Search Bar -->
        <form action="{{ route('store.index') }}" method="GET" class="mt-8 max-w-2xl">
            <div class="relative flex items-center bg-white rounded-2xl p-1.5 shadow-2xl border border-slate-200">
                <span class="pl-3 text-slate-400">
                    <i data-lucide="search" class="w-5 h-5"></i>
                </span>
                <input type="search" 
                       name="q" 
                       value="{{ request('q') }}"
                       placeholder="Pesquisar por nome ou referência..." 
                       class="w-full px-3 py-2.5 text-sm text-slate-800 placeholder-slate-400 bg-transparent focus:outline-none">
                <button type="submit" class="px-6 py-2.5 bg-[#071326] hover:bg-amber-500 hover:text-slate-950 text-white font-bold rounded-xl text-xs uppercase tracking-wider transition whitespace-nowrap">
                    Pesquisar
                </button>
            </div>
        </form>

        <!-- Store Benefits -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 pt-8 border-t border-slate-800/80">
            <div class="flex items-center gap-3 text-xs text-slate-300">
                <div class="w-8 h-8 rounded-lg bg-blue-500/10 text-cyan-400 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="truck" class="w-4 h-4"></i>
                </div>
                <span>Entrega em Luanda com prazo a combinar</span>
            </div>
            <div class="flex items-center gap-3 text-xs text-slate-300">
                <div class="w-8 h-8 rounded-lg bg-amber-500/10 text-amber-400 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="store" class="w-4 h-4"></i>
                </div>
                <span>Levantamento nas instalações RACHI sem custos</span>
            </div>
            <div class="flex items-center gap-3 text-xs text-slate-300">
                <div class="w-8 h-8 rounded-lg bg-emerald-500/10 text-emerald-400 flex items-center justify-center flex-shrink-0">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                </div>
                <span>Facturação e garantia empresarial formal</span>
            </div>
        </div>
    </div>
</section>

<!-- STORE CATALOG -->
<section class="py-12 px-6 lg:px-12 max-w-7xl mx-auto">
    <!-- Category Tabs -->
    <div class="bg-white p-6 rounded-2xl border border-slate-200 shadow-sm mb-8">
        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
            <div class="flex items-center gap-2 overflow-x-auto pb-2 lg:pb-0 scrollbar-none">
                <a href="{{ route('store.index') }}" class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap {{ !request('categoria') ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Todas as Categorias
                </a>
                <a href="{{ route('store.index', ['categoria' => 'personalizado-grafica']) }}" class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap {{ request('categoria') == 'personalizado-grafica' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Personalizado_Gráfica
                </a>
                <a href="{{ route('store.index', ['categoria' => 'consumiveis']) }}" class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap {{ request('categoria') == 'consumiveis' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Consumíveis
                </a>
                <a href="{{ route('store.index', ['categoria' => 'material-escritorio']) }}" class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap {{ request('categoria') == 'material-escritorio' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Material de Escritório
                </a>
                <a href="{{ route('store.index', ['categoria' => 'informatica-tecnologia']) }}" class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap {{ request('categoria') == 'informatica-tecnologia' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Informática e Tecnologia
                </a>
                <a href="{{ route('store.index', ['categoria' => 'impressao-papelaria']) }}" class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap {{ request('categoria') == 'impressao-papelaria' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Impressão e Papelaria
                </a>
                <a href="{{ route('store.index', ['categoria' => 'material-promocional']) }}" class="px-4 py-2 rounded-xl text-xs transition whitespace-nowrap {{ request('categoria') == 'material-promocional' ? 'bg-[#071326] text-white font-bold' : 'bg-slate-100 text-slate-700 hover:bg-slate-200' }}">
                    Material Promocional
                </a>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @php
            $realProducts = [
                [
                    'title' => 'Auricular com fio',
                    'category' => 'Consumíveis',
                    'price' => '3.000,00 AOA',
                    'oldPrice' => '5.000,00 AOA',
                    'badge' => 'Promoção',
                    'image' => 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-09-at-23-27-07-2-2e9986bc.jpg?v=1786645310',
                    'slug' => 'auricular-com-fio'
                ],
                [
                    'title' => 'Auriculares sem Fio',
                    'category' => 'Informática e Tecnologia',
                    'price' => '5,00 AOA',
                    'oldPrice' => '',
                    'badge' => '',
                    'image' => 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-09-at-23-27-07-1-5d801c62.jpg?v=1786644616',
                    'slug' => 'auriculares-sem-fio'
                ],
                [
                    'title' => 'Cabo Console RS232/DB9/COM/Serial Para RJ45 1.5M Preto',
                    'category' => 'Informática e Tecnologia',
                    'price' => '16.989,89 AOA',
                    'oldPrice' => '18.000,00 AOA',
                    'badge' => 'Promoção',
                    'image' => 'https://hom.rachi.ao/uploads/produtos/cabo-console_rj45-db44e13a.png?v=1786492137',
                    'slug' => 'cabo-console-rs232-db9-com-serial-para-rj45-1-5m-preto'
                ],
                [
                    'title' => 'Capa Temática Naruto para iPhone 11 / 12 Pro',
                    'category' => 'Material Promocional',
                    'price' => '7.000,00 AOA',
                    'oldPrice' => '',
                    'badge' => '',
                    'image' => 'https://hom.rachi.ao/uploads/produtos/capa-iphone-22a16aff.png?v=1786548506',
                    'slug' => 'capa-tematica-naruto-para-iphone-11-12-pro'
                ],
                [
                    'title' => 'HP Elitebook x360 1040 G8 (2-in-1)',
                    'category' => 'Informática e Tecnologia',
                    'price' => '1.489.000,29 AOA',
                    'oldPrice' => '',
                    'badge' => '',
                    'image' => 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-05-at-11-02-30-3bbd6053.jpg?v=1786486137',
                    'slug' => 'hp-elitebook-x360-1040-g8-2-in-1'
                ],
                [
                    'title' => 'Smartwatch Lige',
                    'category' => 'Informática e Tecnologia',
                    'price' => '10.000,00 AOA',
                    'oldPrice' => '',
                    'badge' => '',
                    'image' => 'https://hom.rachi.ao/uploads/produtos/smart-whatch-8ee88fb4.png?v=1786493480',
                    'slug' => 'smartwatch-lige'
                ],
                [
                    'title' => 'TV Box Android',
                    'category' => 'Informática e Tecnologia',
                    'price' => '18.000,00 AOA',
                    'oldPrice' => '25.000,00 AOA',
                    'badge' => 'Promoção',
                    'image' => 'https://hom.rachi.ao/uploads/produtos/whatsapp-image-2026-08-11-at-09-06-36-f406b8ca.jpg?v=1786463364',
                    'slug' => 'tv-box-android'
                ]
            ];
        @endphp

        @foreach($realProducts as $p)
            <article class="bg-white rounded-2xl border border-slate-200 overflow-hidden shadow-sm hover:shadow-xl hover:border-amber-400 transition-all duration-300 flex flex-col justify-between group">
                <div class="h-56 bg-slate-50 p-6 flex items-center justify-center relative overflow-hidden">
                    <img src="{{ $p['image'] }}" alt="{{ $p['title'] }}" class="max-h-full max-w-full object-contain group-hover:scale-105 transition-transform duration-300">
                    @if($p['badge'])
                        <span class="absolute top-3 left-3 px-2.5 py-1 bg-amber-500 text-slate-950 font-black text-[10px] rounded-md uppercase tracking-wider shadow-sm">
                            {{ $p['badge'] }}
                        </span>
                    @endif
                </div>

                <div class="p-5 flex-1 flex flex-col justify-between">
                    <div>
                        <p class="text-[11px] font-bold uppercase tracking-wider text-slate-400">{{ $p['category'] }}</p>
                        <h3 class="font-bold text-slate-900 text-sm mt-1 line-clamp-2 leading-snug group-hover:text-blue-600 transition">
                            {{ $p['title'] }}
                        </h3>
                    </div>

                    <div class="mt-4 pt-3 border-t border-slate-100">
                        <div class="flex items-baseline gap-2 mb-2">
                            <strong class="text-base font-black text-slate-900">{{ $p['price'] }}</strong>
                            @if($p['oldPrice'])
                                <span class="text-xs text-slate-400 line-through">{{ $p['oldPrice'] }}</span>
                            @endif
                        </div>

                        <p class="text-[11px] text-emerald-600 font-semibold flex items-center gap-1.5 mb-4">
                            <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                            Disponível
                        </p>

                        <a href="{{ route('cart.index') }}" class="w-full py-2.5 rounded-xl bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-slate-950 font-bold text-xs uppercase tracking-wider shadow-sm shadow-amber-500/20 transition flex items-center justify-center gap-2">
                            <i data-lucide="shopping-cart" class="w-3.5 h-3.5"></i>
                            <span>Adicionar ao carrinho</span>
                        </a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
