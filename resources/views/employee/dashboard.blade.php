@extends('layouts.portal')

@section('title', 'Painel do Funcionário')
@section('portal-type', 'Área de Atendimento / Técnico')

@section('sidebar-menu')
    <a href="{{ route('employee.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-amber-500/10 text-amber-400 font-medium">
        <i data-lucide="inbox" class="w-5 h-5"></i>
        <span>Fila de Chamados</span>
    </a>
    <a href="{{ route('employee.requests') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="check-square" class="w-5 h-5"></i>
        <span>Minhas Atribuições</span>
    </a>
    <a href="{{ route('employee.orders') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="package" class="w-5 h-5"></i>
        <span>Expedição / Pedidos</span>
    </a>
    <a href="{{ route('employee.stock') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="boxes" class="w-5 h-5"></i>
        <span>Controle de Estoque</span>
    </a>
@endsection

@section('breadcrumbs')
    <span>Portal</span> / <span>Operações</span> / <span>Fila de Trabalho</span>
@endsection

@section('page-title', 'Fila de Atendimento e Solicitações')

@section('content')
    <!-- Dashboard Cards (Section 46) -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-8">
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-blue-500">
            <span class="text-xs font-semibold text-slate-500 uppercase">Novas</span>
            <div class="text-2xl font-black text-slate-900 mt-1">{{ $newCount ?? 5 }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-yellow-500">
            <span class="text-xs font-semibold text-slate-500 uppercase">Em Análise</span>
            <div class="text-2xl font-black text-slate-900 mt-1">{{ $analysisCount ?? 3 }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-indigo-500">
            <span class="text-xs font-semibold text-slate-500 uppercase">Em Execução</span>
            <div class="text-2xl font-black text-slate-900 mt-1">{{ $inProgressCount ?? 4 }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-orange-500">
            <span class="text-xs font-semibold text-slate-500 uppercase">Aguard. Cliente</span>
            <div class="text-2xl font-black text-slate-900 mt-1">{{ $waitingCount ?? 2 }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-emerald-500">
            <span class="text-xs font-semibold text-slate-500 uppercase">Concluídas</span>
            <div class="text-2xl font-black text-slate-900 mt-1">{{ $completedCount ?? 18 }}</div>
        </div>
        <div class="bg-white p-4 rounded-xl shadow-sm border-l-4 border-rose-500">
            <span class="text-xs font-semibold text-slate-500 uppercase">Pedidos Pend.</span>
            <div class="text-2xl font-black text-slate-900 mt-1">{{ $pendingOrdersCount ?? 6 }}</div>
        </div>
    </div>

    <!-- Filters Section -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 mb-6">
        <form class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4" method="GET">
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Unidade</label>
                <select name="unit" class="w-full text-sm border-slate-300 rounded-md">
                    <option value="">Todas as Unidades</option>
                    <option value="1">RACHI Tec</option>
                    <option value="2">RACHI Print</option>
                    <option value="3">RACHI Academy</option>
                    <option value="4">RACHI Human Capital</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Status</label>
                <select name="status" class="w-full text-sm border-slate-300 rounded-md">
                    <option value="">Todos</option>
                    <option value="new">Novas</option>
                    <option value="in_analysis">Em Análise</option>
                    <option value="in_progress">Em Execução</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1">Prioridade</label>
                <select name="priority" class="w-full text-sm border-slate-300 rounded-md">
                    <option value="">Todas</option>
                    <option value="urgent">Urgente</option>
                    <option value="high">Alta</option>
                    <option value="normal">Normal</option>
                    <option value="low">Baixa</option>
                </select>
            </div>
            <div class="flex items-end">
                <button type="submit" class="w-full py-2 bg-slate-800 hover:bg-slate-900 text-white rounded-md text-sm font-medium">Filtrar</button>
            </div>
        </form>
    </div>

    <!-- Requests Table -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="font-bold text-slate-900">Solicitações Ativas</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                    <tr>
                        <th class="p-4">Protocolo</th>
                        <th class="p-4">Cliente</th>
                        <th class="p-4">Unidade</th>
                        <th class="p-4">Assunto</th>
                        <th class="p-4">Prioridade</th>
                        <th class="p-4">Responsável</th>
                        <th class="p-4">Status</th>
                        <th class="p-4 text-right">Ação</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($requests ?? [] as $r)
                        <tr class="hover:bg-slate-50">
                            <td class="p-4 font-mono font-medium">{{ $r->protocol }}</td>
                            <td class="p-4">{{ $r->customer->display_name ?? 'N/D' }}</td>
                            <td class="p-4"><span class="px-2 py-0.5 rounded bg-slate-100 text-xs font-semibold">{{ $r->businessUnit->name ?? '' }}</span></td>
                            <td class="p-4 font-medium">{{ $r->title }}</td>
                            <td class="p-4"><span class="text-xs px-2 py-0.5 rounded font-semibold {{ $r->priority_badge_color }}">{{ strtoupper($r->priority) }}</span></td>
                            <td class="p-4 text-slate-600">{{ $r->assignedEmployee->user->name ?? '— Livre —' }}</td>
                            <td class="p-4">{{ $r->status_label }}</td>
                            <td class="p-4 text-right">
                                <a href="{{ route('employee.requests.show', $r->id) }}" class="text-blue-600 hover:underline font-semibold">Atender</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="p-6 text-center text-slate-400">Nenhuma solicitação na fila.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
