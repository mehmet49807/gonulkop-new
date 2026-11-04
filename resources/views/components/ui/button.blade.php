@props([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'submit',
])

@php
    $variants = [
        'primary' => 'bg-brand-600 text-white shadow-brand hover:bg-brand-700 focus-visible:ring-brand-500',
        'secondary' => 'border border-line bg-white text-ink shadow-sm hover:border-brand-200 hover:bg-brand-50 hover:text-brand-800 focus-visible:ring-brand-500',
        'ghost' => 'text-muted hover:bg-canvas hover:text-ink focus-visible:ring-brand-500',
        'danger' => 'bg-red-600 text-white shadow-sm hover:bg-red-700 focus-visible:ring-red-500',
    ];

    $sizes = [
        'sm' => 'min-h-9 px-3.5 py-2 text-xs',
        'md' => 'min-h-11 px-5 py-2.5 text-sm',
        'lg' => 'min-h-12 px-6 py-3 text-base',
    ];

    $classes = 'inline-flex items-center justify-center gap-2 rounded-control font-semibold transition disabled:pointer-events-none disabled:opacity-50 focus-visible:ring-2 focus-visible:ring-offset-2';
    $classes .= ' ' . ($variants[$variant] ?? $variants['primary']);
    $classes .= ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
