@extends('layouts.portal')

@section('title', 'Detalhe da Solicitação ' . $request->protocol)
@section('portal-type', 'Área do Cliente')

@section('sidebar-menu')
    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
        <span>Visão Geral</span>
    </a>
    <a href="{{ route('customer.requests.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        <span>Nova Solicitação</span>
    </a>
    <a href="{{ route('customer.requests') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-amber-500/10 text-amber-400 font-medium">
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
    <a href="{{ route('customer.dashboard') }}" class="hover:underline">Dashboard</a> / 
    <a href="{{ route('customer.requests') }}" class="hover:underline">Solicitações</a> / 
    <span>{{ $request->protocol }}</span>
@endsection

@section('page-title')
    Solicitação: <span class="font-mono text-amber-600">{{ $request->protocol }}</span>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left 2 Cols: Details, Messages, Quotes -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Request Summary Card -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                    {{ $request->businessUnit->name ?? 'Geral' }}
                </span>
                <span class="text-xs px-2.5 py-1 rounded-full font-semibold {{ $request->priority_badge_color }}">
                    Prioridade: {{ strtoupper($request->priority) }}
                </span>
            </div>
            <h2 class="text-xl font-bold text-slate-900 mt-4">{{ $request->title }}</h2>
            <p class="text-slate-600 mt-3 whitespace-pre-line leading-relaxed">{{ $request->description }}</p>
        </div>

        <!-- Quotes section if any -->
        @if($request->quotes && $request->quotes->count() > 0)
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i data-lucide="receipt" class="w-5 h-5 text-amber-500"></i>
                Orçamento(s) Associado(s)
            </h3>
            @foreach($request->quotes as $quote)
                <div class="border border-slate-200 rounded-lg p-4 mb-3 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div>
                        <div class="font-mono font-bold text-slate-900">{{ $quote->number }}</div>
                        <div class="text-sm text-slate-500">Válido até: {{ $quote->valid_until ? $quote->valid_until->format('d/m/Y') : 'Sob consulta' }}</div>
                        <div class="text-base font-bold text-emerald-600 mt-1">{{ $quote->formatted_total }}</div>
                    </div>
                    <div class="flex gap-2">
                        @if($quote->status === 'sent')
                            <form action="{{ route('customer.quotes.approve', $quote->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg">
                                    Aprovar Orçamento
                                </button>
                            </form>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $quote->status === 'approved' ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-700' }}">
                                {{ ucfirst($quote->status) }}
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        @endif

        <!-- Discussion / Messages Thread (Section 28) -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i data-lucide="message-square" class="w-5 h-5 text-blue-500"></i>
                Mensagens e Atendimento
            </h3>
            <div class="space-y-4 max-h-96 overflow-y-auto mb-6 pr-2">
                @forelse($request->messages ?? [] as $msg)
                    <div class="flex gap-3 {{ $msg->user_id === auth()->id() ? 'justify-end' : '' }}">
                        <div class="max-w-lg rounded-xl p-4 {{ $msg->user_id === auth()->id() ? 'bg-amber-50 border border-amber-200' : 'bg-slate-100 border border-slate-200' }}">
                            <div class="flex justify-between items-center text-xs text-slate-500 mb-1 gap-4">
                                <span class="font-semibold">{{ $msg->user->name ?? 'Suporte' }}</span>
                                <span>{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <p class="text-sm text-slate-800">{{ $msg->message }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 italic">Nenhuma mensagem ainda.</p>
                @endforelse
            </div>

            <!-- Send message form -->
            <form action="{{ route('customer.requests.message', $request->id) }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="message" required placeholder="Digite sua resposta ou dúvida..." class="flex-1 px-4 py-2 border rounded-lg focus:ring-blue-500 focus:border-blue-500 text-sm">
                <button type="submit" class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-white font-semibold rounded-lg text-sm flex items-center gap-1">
                    <i data-lucide="send" class="w-4 h-4"></i>
                    Enviar
                </button>
            </form>
        </div>
    </div>

    <!-- Right Col: Status and History (Section 16) -->
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Estado Atual</h3>
            <div class="flex items-center gap-3">
                <span class="w-3 h-3 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-lg font-bold text-slate-900">{{ $request->status_label }}</span>
            </div>
            @if($request->assignedEmployee)
                <div class="mt-4 pt-4 border-t border-slate-100 text-sm">
                    <span class="text-slate-500">Técnico Responsável:</span>
                    <div class="font-semibold text-slate-800 mt-1">{{ $request->assignedEmployee->user->name ?? 'Atribuído' }}</div>
                    <div class="text-xs text-slate-400">{{ $request->assignedEmployee->position }}</div>
                </div>
            @endif
        </div>

        <!-- History Timeline -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-semibold text-slate-500 uppercase tracking-wider mb-4">Histórico do Atendimento</h3>
            <ol class="relative border-l border-slate-200 ml-2 space-y-6">
                @foreach($request->statusHistories as $history)
                    <li class="ml-4">
                        <div class="absolute -left-1.5 mt-1.5 w-3 h-3 bg-amber-500 rounded-full border border-white"></div>
                        <time class="mb-1 text-xs font-normal text-slate-400">{{ $history->created_at->format('d/m/Y H:i') }}</time>
                        <h4 class="text-sm font-semibold text-slate-900">{{ $history->new_status }}</h4>
                        @if($history->comment)
                            <p class="text-xs text-slate-600 mt-0.5">{{ $history->comment }}</p>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endsection
