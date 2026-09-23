@extends('layouts.portal')

@section('title', 'Painel do Cliente')
@section('portal-type', 'Área do Cliente')

@section('sidebar-menu')
    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-amber-500/10 text-amber-400 font-medium">
        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
        <span>Visão Geral</span>
    </a>
    <a href="{{ route('customer.requests.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        <span>Nova Solicitação</span>
    </a>
    <a href="{{ route('customer.requests') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="file-text" class="w-5 h-5"></i>
        <span>Minhas Solicitações</span>
    </a>
    <a href="{{ route('customer.quotes') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="receipt" class="w-5 h-5"></i>
        <span>Orçamentos</span>
    </a>
    <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="shopping-bag" class="w-5 h-5"></i>
        <span>Meus Pedidos</span>
    </a>
    <a href="{{ route('customer.courses') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
        <span>Meus Cursos</span>
    </a>
@endsection

@section('breadcrumbs')
    <span>Portal</span> / <span>Cliente</span> / <span>Dashboard</span>
@endsection

@section('page-title', 'Bem-vindo, ' . (auth()->user()->name ?? 'Cliente'))

@section('page-actions')
    <a href="{{ route('customer.requests.create') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold rounded-lg text-sm transition">
        <i data-lucide="plus" class="w-4 h-4"></i>
        Solicitar Serviço
    </a>
@endsection

@section('content')
    <!-- KPI Cards (Section 44) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider">Solicitações Abertas</span>
                <i data-lucide="clock" class="w-5 h-5 text-amber-500"></i>
            </div>
            <div class="text-3xl font-extrabold text-slate-900">{{ $openRequestsCount ?? 2 }}</div>
            <div class="text-xs text-slate-500 mt-2">Em andamento / análise</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider">Orçamentos Pendentes</span>
                <i data-lucide="receipt" class="w-5 h-5 text-blue-500"></i>
            </div>
            <div class="text-3xl font-extrabold text-slate-900">{{ $pendingQuotesCount ?? 1 }}</div>
            <div class="text-xs text-slate-500 mt-2">Aguardando sua aprovação</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider">Pedidos na Loja</span>
                <i data-lucide="shopping-cart" class="w-5 h-5 text-emerald-500"></i>
            </div>
            <div class="text-3xl font-extrabold text-slate-900">{{ $ordersCount ?? 3 }}</div>
            <div class="text-xs text-slate-500 mt-2">Compras realizadas</div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between text-slate-500 mb-2">
                <span class="text-xs font-semibold uppercase tracking-wider">Cursos Activos</span>
                <i data-lucide="book-open" class="w-5 h-5 text-purple-500"></i>
            </div>
            <div class="text-3xl font-extrabold text-slate-900">{{ $activeCoursesCount ?? 1 }}</div>
            <div class="text-xs text-slate-500 mt-2">RACHI Academy</div>
        </div>
    </div>

    <!-- Recent Requests Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden mb-8">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <h2 class="text-lg font-bold text-slate-900">Últimas Solicitações de Serviços</h2>
            <a href="{{ route('customer.requests') }}" class="text-sm font-semibold text-blue-600 hover:underline">Ver todas &rarr;</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-50 border-b border-slate-200 text-slate-600 uppercase text-xs">
                        <th class="p-4 font-semibold">Protocolo</th>
                        <th class="p-4 font-semibold">Unidade</th>
                        <th class="p-4 font-semibold">Título / Serviço</th>
                        <th class="p-4 font-semibold">Prioridade</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold">Data</th>
                        <th class="p-4 font-semibold text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($recentRequests ?? [] as $req)
                        <tr class="hover:bg-slate-50/80 transition">
                            <td class="p-4 font-mono font-medium text-slate-900">{{ $req->protocol }}</td>
                            <td class="p-4">
                                <span class="px-2.5 py-1 text-xs font-semibold rounded-full 
                                    {{ $req->businessUnit->slug === 'tec' ? 'bg-blue-100 text-blue-800' : '' }}
                                    {{ $req->businessUnit->slug === 'print' ? 'bg-pink-100 text-pink-800' : '' }}
                                    {{ $req->businessUnit->slug === 'academy' ? 'bg-emerald-100 text-emerald-800' : '' }}
                                    {{ $req->businessUnit->slug === 'capital' ? 'bg-amber-100 text-amber-800' : '' }}">
                                    {{ $req->businessUnit->name }}
                                </span>
                            </td>
                            <td class="p-4 font-medium text-slate-800">{{ $req->title }}</td>
                            <td class="p-4">
                                <span class="text-xs font-medium px-2 py-0.5 rounded {{ $req->priority_badge_color }}">
                                    {{ strtoupper($req->priority) }}
                                </span>
                            </td>
                            <td class="p-4">
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-700 bg-slate-100 px-2.5 py-1 rounded-full">
                                    <span class="w-2 h-2 rounded-full bg-blue-500"></span>
                                    {{ $req->status_label }}
                                </span>
                            </td>
                            <td class="p-4 text-slate-500">{{ $req->created_at->format('d/m/Y') }}</td>
                            <td class="p-4 text-right">
                                <a href="{{ route('customer.requests.show', $req->id) }}" class="text-blue-600 hover:text-blue-800 font-medium">Acompanhar</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-6 text-center text-slate-400">Nenhuma solicitação em andamento no momento.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
