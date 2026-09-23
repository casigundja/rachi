@extends('layouts.portal')

@section('title', 'Atendimento: ' . $request->protocol)
@section('portal-type', 'Área de Atendimento / Técnico')

@section('sidebar-menu')
    <a href="{{ route('employee.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="inbox" class="w-5 h-5"></i>
        <span>Fila de Chamados</span>
    </a>
    <a href="{{ route('employee.requests') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-amber-500/10 text-amber-400 font-medium">
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
    <a href="{{ route('employee.dashboard') }}" class="hover:underline">Atendimento</a> / 
    <span>{{ $request->protocol }}</span>
@endsection

@section('page-title')
    Gerenciar Solicitação <span class="font-mono text-amber-600">#{{ $request->protocol }}</span>
@endsection

@section('page-actions')
    <div class="flex items-center gap-2">
        @if(!$request->assigned_to)
            <form action="{{ route('employee.requests.assign', $request->id) }}" method="POST">
                @csrf
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg flex items-center gap-1.5 shadow">
                    <i data-lucide="user-check" class="w-4 h-4"></i>
                    Assumir Chamado
                </button>
            </form>
        @endif
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6" x-data="{ showQuoteModal: false, showStatusModal: false }">
    <!-- Left Column: Details & Communication -->
    <div class="lg:col-span-2 space-y-6">
        <!-- Request Details -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between pb-3 border-b border-slate-100">
                <span class="text-xs font-bold uppercase tracking-wider text-slate-500">Unidade: {{ $request->businessUnit->name }}</span>
                <span class="text-xs px-2.5 py-1 rounded-full font-semibold {{ $request->priority_badge_color }}">Prioridade: {{ strtoupper($request->priority) }}</span>
            </div>

            <div class="mt-4">
                <h3 class="text-lg font-bold text-slate-900">{{ $request->title }}</h3>
                <div class="mt-2 text-sm text-slate-600 leading-relaxed bg-slate-50 p-4 rounded-lg border border-slate-100">
                    {{ $request->description }}
                </div>
            </div>

            <!-- Client Info Card inside -->
            <div class="mt-4 pt-4 border-t border-slate-100 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-slate-400 block text-xs">CLIENTE</span>
                    <span class="font-semibold text-slate-800">{{ $request->customer->display_name ?? 'Cliente Anónimo' }}</span>
                </div>
                <div>
                    <span class="text-slate-400 block text-xs">CONTACTO</span>
                    <span class="font-semibold text-slate-800">{{ $request->customer->phone ?? 'Não informado' }}</span>
                </div>
            </div>
        </div>

        <!-- Action Bar for Employee (Section 47) -->
        <div class="bg-white p-4 rounded-xl shadow-sm border border-slate-200 flex flex-wrap gap-3">
            <button @click="showStatusModal = true" class="px-4 py-2 bg-slate-800 hover:bg-slate-900 text-white text-sm font-medium rounded-lg flex items-center gap-1.5">
                <i data-lucide="refresh-cw" class="w-4 h-4"></i>
                Alterar Status
            </button>
            <button @click="showQuoteModal = true" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 text-sm font-bold rounded-lg flex items-center gap-1.5">
                <i data-lucide="receipt" class="w-4 h-4"></i>
                Criar Orçamento
            </button>
            <form action="{{ route('employee.requests.status', $request->id) }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="status" value="completed">
                <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg flex items-center gap-1.5" onclick="return confirm('Confirmar conclusão da solicitação?')">
                    <i data-lucide="check" class="w-4 h-4"></i>
                    Concluir
                </button>
            </form>
            <form action="{{ route('employee.requests.status', $request->id) }}" method="POST" class="inline">
                @csrf
                <input type="hidden" name="status" value="cancelled">
                <button type="submit" class="px-4 py-2 bg-rose-50 text-rose-600 hover:bg-rose-100 text-sm font-medium rounded-lg flex items-center gap-1.5" onclick="return confirm('Deseja realmente cancelar esta solicitação?')">
                    <i data-lucide="x-circle" class="w-4 h-4"></i>
                    Cancelar
                </button>
            </form>
        </div>

        <!-- Messages / Direct Chat -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-base font-bold text-slate-900 mb-4 flex items-center gap-2">
                <i data-lucide="message-square" class="w-5 h-5 text-blue-500"></i>
                Comunicação com o Cliente
            </h3>
            <div class="space-y-4 max-h-80 overflow-y-auto mb-4 pr-2">
                @forelse($request->messages ?? [] as $msg)
                    <div class="flex gap-3 {{ $msg->user_id === auth()->id() ? 'justify-end' : '' }}">
                        <div class="max-w-lg rounded-xl p-3.5 {{ $msg->user_id === auth()->id() ? 'bg-amber-50 border border-amber-200' : 'bg-slate-100 border border-slate-200' }}">
                            <div class="flex justify-between items-center text-xs text-slate-500 mb-1 gap-4">
                                <span class="font-semibold">{{ $msg->user->name ?? 'Utilizador' }}</span>
                                <span>{{ $msg->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <p class="text-sm text-slate-800">{{ $msg->message }}</p>
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-400 italic">Sem mensagens registadas.</p>
                @endforelse
            </div>

            <form action="{{ route('employee.requests.message', $request->id) }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="message" required placeholder="Enviar mensagem ou solicitar informações ao cliente..." class="flex-1 px-4 py-2 border rounded-lg focus:ring-blue-500 text-sm">
                <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm">
                    Enviar
                </button>
            </form>
        </div>
    </div>

    <!-- Right Column: Status, Assignment & History -->
    <div class="space-y-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-xs font-bold uppercase text-slate-400 mb-3">Informações Técnicas</h3>
            <div class="space-y-3 text-sm">
                <div class="flex justify-between">
                    <span class="text-slate-500">Estado:</span>
                    <span class="font-semibold text-slate-800">{{ $request->status_label }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Atribuído a:</span>
                    <span class="font-semibold text-slate-800">{{ $request->assignedEmployee->user->name ?? 'Não atribuído' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-slate-500">Aberto em:</span>
                    <span class="text-slate-800">{{ $request->created_at->format('d/m/Y H:i') }}</span>
                </div>
            </div>
        </div>

        <!-- History Timeline -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-xs font-bold uppercase text-slate-400 mb-4">Linha do Tempo</h3>
            <ol class="relative border-l border-slate-200 ml-2 space-y-4">
                @foreach($request->statusHistories as $h)
                    <li class="ml-4 text-xs">
                        <div class="absolute -left-1.5 mt-1 w-3 h-3 bg-blue-600 rounded-full border border-white"></div>
                        <span class="text-slate-400">{{ $h->created_at->format('d/m/Y H:i') }}</span>
                        <div class="font-bold text-slate-800">{{ $h->new_status }}</div>
                        @if($h->comment)
                            <div class="text-slate-600 mt-0.5">{{ $h->comment }}</div>
                        @endif
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    <!-- Modal para Mudança de Status -->
    <div x-show="showStatusModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50" x-cloak>
        <div class="bg-white rounded-xl max-w-md w-full p-6 shadow-2xl">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Alterar Estado da Solicitação</h3>
            <form action="{{ route('employee.requests.status', $request->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">Novo Estado</label>
                    <select name="status" class="w-full border rounded-lg p-2.5 text-sm">
                        <option value="in_analysis">Em Análise</option>
                        <option value="waiting_customer">Aguardando Cliente</option>
                        <option value="in_progress">Em Execução</option>
                        <option value="in_review">Em Revisão</option>
                        <option value="completed">Concluída</option>
                        <option value="cancelled">Cancelada</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-xs font-semibold text-slate-700 uppercase mb-2">Comentário / Justificativa</label>
                    <textarea name="comment" rows="3" class="w-full border rounded-lg p-2.5 text-sm" placeholder="Explique o motivo da alteração..."></textarea>
                </div>
                <div class="flex justify-end gap-3">
                    <button type="button" @click="showStatusModal = false" class="px-4 py-2 border rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-bold">Salvar Estado</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal para Criar Orçamento -->
    <div x-show="showQuoteModal" class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50" x-cloak>
        <div class="bg-white rounded-xl max-w-lg w-full p-6 shadow-2xl">
            <h3 class="text-lg font-bold text-slate-900 mb-4">Criar Orçamento para {{ $request->protocol }}</h3>
            <form action="{{ route('employee.quotes.store') }}" method="POST">
                @csrf
                <input type="hidden" name="service_request_id" value="{{ $request->id }}">
                <input type="hidden" name="customer_id" value="{{ $request->customer_id }}">
                <input type="hidden" name="business_unit_id" value="{{ $request->business_unit_id }}">
                
                <div class="space-y-4 mb-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Descrição do Item Principal</label>
                        <input type="text" name="items[0][description]" value="{{ $request->title }}" required class="w-full border rounded-lg p-2.5 text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Quantidade</label>
                            <input type="number" name="items[0][quantity]" value="1" min="1" required class="w-full border rounded-lg p-2.5 text-sm">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Preço Unitário (AOA)</label>
                            <input type="number" step="0.01" name="items[0][unit_price]" required class="w-full border rounded-lg p-2.5 text-sm" placeholder="Ex: 50000">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-700 uppercase mb-1">Validade do Orçamento</label>
                        <input type="date" name="valid_until" value="{{ now()->addDays(15)->format('Y-m-d') }}" class="w-full border rounded-lg p-2.5 text-sm">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t">
                    <button type="button" @click="showQuoteModal = false" class="px-4 py-2 border rounded-lg text-sm font-medium text-slate-600 hover:bg-slate-50">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-amber-500 hover:bg-amber-600 text-slate-950 rounded-lg text-sm font-bold">Emitir Orçamento</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
