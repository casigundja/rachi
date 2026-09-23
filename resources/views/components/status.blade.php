@props(['status'])

@php
$colorClasses = match($status) {
    'new' => 'bg-blue-100 text-blue-800 border-blue-200',
    'in_analysis' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
    'waiting_customer' => 'bg-orange-100 text-orange-800 border-orange-200',
    'quoted' => 'bg-purple-100 text-purple-800 border-purple-200',
    'approved' => 'bg-teal-100 text-teal-800 border-teal-200',
    'in_progress' => 'bg-indigo-100 text-indigo-800 border-indigo-200',
    'in_review' => 'bg-cyan-100 text-cyan-800 border-cyan-200',
    'completed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
    'cancelled' => 'bg-rose-100 text-rose-800 border-rose-200',
    default => 'bg-slate-100 text-slate-800 border-slate-200'
};

$label = match($status) {
    'new' => 'Nova',
    'in_analysis' => 'Em Análise',
    'waiting_customer' => 'Aguardando Cliente',
    'quoted' => 'Orçado',
    'approved' => 'Aprovado',
    'in_progress' => 'Em Execução',
    'in_review' => 'Em Revisão',
    'completed' => 'Concluída',
    'cancelled' => 'Cancelada',
    default => ucfirst($status)
};
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border ' . $colorClasses]) }}>
    {{ $label }}
</span>
