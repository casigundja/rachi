@props([
    'variant' => 'primary',
    'type' => 'button'
])

@php
$baseClasses = 'inline-flex items-center justify-center font-semibold text-sm rounded-lg px-4 py-2.5 transition duration-150 focus:outline-none focus:ring-2 focus:ring-offset-2';
$variants = [
    'primary' => 'bg-amber-500 hover:bg-amber-600 text-slate-950 focus:ring-amber-400 shadow-md',
    'secondary' => 'bg-slate-800 hover:bg-slate-700 text-white focus:ring-slate-600',
    'outline' => 'border border-slate-300 text-slate-700 hover:bg-slate-100 focus:ring-slate-400',
    'danger' => 'bg-rose-600 hover:bg-rose-700 text-white focus:ring-rose-500',
    'success' => 'bg-emerald-600 hover:bg-emerald-700 text-white focus:ring-emerald-500',
];
$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>
