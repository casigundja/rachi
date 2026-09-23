@extends('layouts.portal')

@section('title', 'Nova Solicitação de Serviço')
@section('portal-type', 'Área do Cliente')

@section('sidebar-menu')
    <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition">
        <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
        <span>Visão Geral</span>
    </a>
    <a href="{{ route('customer.requests.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-amber-500/10 text-amber-400 font-medium">
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
    <a href="{{ route('customer.dashboard') }}" class="hover:underline">Dashboard</a> / <span>Nova Solicitação</span>
@endsection

@section('page-title', 'Abrir Solicitação de Serviço')

@section('content')
<div class="max-w-3xl bg-white rounded-xl shadow-sm border border-slate-200 p-6 md:p-8">
    <form action="{{ route('customer.requests.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Unidade de Negócio -->
            <div>
                <label for="business_unit_id" class="block text-sm font-semibold text-slate-700 mb-1">Unidade de Negócio *</label>
                <select name="business_unit_id" id="business_unit_id" required class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500 text-sm">
                    <option value="">Selecione uma unidade...</option>
                    @foreach($units ?? [] as $unit)
                        <option value="{{ $unit->id }}" {{ old('business_unit_id') == $unit->id ? 'selected' : '' }}>
                            {{ $unit->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Serviço específico -->
            <div>
                <label for="service_id" class="block text-sm font-semibold text-slate-700 mb-1">Serviço (Opcional)</label>
                <select name="service_id" id="service_id" class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500 text-sm">
                    <option value="">Selecione ou deixe em aberto...</option>
                    @foreach($services ?? [] as $serv)
                        <option value="{{ $serv->id }}" {{ old('service_id') == $serv->id ? 'selected' : '' }}>
                            [{{ $serv->businessUnit->name }}] {{ $serv->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Título -->
        <div>
            <label for="title" class="block text-sm font-semibold text-slate-700 mb-1">Título da Solicitação *</label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Ex: Criação de Logotipo e Cartões de Visita" required class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500 text-sm">
        </div>

        <!-- Descrição -->
        <div>
            <label for="description" class="block text-sm font-semibold text-slate-700 mb-1">Descrição / Detalhes da Necessidade *</label>
            <textarea name="description" id="description" rows="4" required placeholder="Explique os detalhes do serviço, requisitos, quantidades, preferências..." class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500 text-sm">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Prioridade -->
            <div>
                <label for="priority" class="block text-sm font-semibold text-slate-700 mb-1">Prioridade</label>
                <select name="priority" id="priority" class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500 text-sm">
                    <option value="low">Baixa</option>
                    <option value="normal" selected>Normal</option>
                    <option value="high">Alta</option>
                    <option value="urgent">Urgente</option>
                </select>
            </div>

            <!-- Prazo Desejado -->
            <div>
                <label for="requested_date" class="block text-sm font-semibold text-slate-700 mb-1">Prazo Desejado</label>
                <input type="date" name="requested_date" id="requested_date" value="{{ old('requested_date') }}" class="w-full px-4 py-2 border rounded-lg focus:ring-amber-500 focus:border-amber-500 text-sm">
            </div>
        </div>

        <!-- Upload de Arquivo / Briefing / Arte -->
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Anexo / Ficheiro (Opcional)</label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-lg hover:border-amber-500 transition">
                <div class="space-y-1 text-center">
                    <i data-lucide="upload-cloud" class="mx-auto h-12 w-12 text-slate-400"></i>
                    <div class="flex text-sm text-slate-600">
                        <label for="attachment" class="relative cursor-pointer bg-white rounded-md font-medium text-amber-600 hover:text-amber-500 focus-within:outline-none">
                            <span>Carregar ficheiro</span>
                            <input id="attachment" name="attachment" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">ou arraste e solte</p>
                    </div>
                    <p class="text-xs text-slate-500">PDF, PNG, JPG, DOCX, ZIP até 25MB</p>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
            <a href="{{ route('customer.dashboard') }}" class="px-5 py-2.5 rounded-lg border border-slate-300 text-slate-700 font-medium hover:bg-slate-50 transition">Cancelar</a>
            <button type="submit" class="px-6 py-2.5 rounded-lg bg-amber-500 hover:bg-amber-600 text-slate-950 font-bold transition flex items-center gap-2">
                <i data-lucide="send" class="w-4 h-4"></i>
                Enviar Solicitação
            </button>
        </div>
    </form>
</div>
@endsection
