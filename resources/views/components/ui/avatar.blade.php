@props([
    'src' => null,
    'name' => 'Kullanıcı',
    'alt' => null,
    'size' => 'md',
    'status' => null,
])

@php
    $sizeClasses = [
        'xs' => 'size-8 text-[0.625rem]',
        'sm' => 'size-10 text-xs',
        'md' => 'size-12 text-sm',
        'lg' => 'size-16 text-base',
        'xl' => 'size-24 text-xl',
    ];

    $initials = collect(preg_split('/\s+/', trim($name)))
        ->filter()
        ->take(2)
        ->map(fn (string $part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<span {{ $attributes->merge(['class' => 'relative inline-flex shrink-0']) }}>
    @if ($src)
        <img
            src="{{ $src }}"
            alt="{{ $alt ?? $name }}"
            class="{{ $sizeClass }} rounded-full object-cover ring-2 ring-white"
            loading="lazy"
            decoding="async"
        >
    @else
        <span class="{{ $sizeClass }} grid place-items-center rounded-full bg-brand-100 font-semibold text-brand-700 ring-2 ring-white" aria-hidden="true">
            {{ $initials }}
        </span>
    @endif

    @if ($status)
        <span class="absolute right-0 bottom-0 size-3 rounded-full border-2 border-white bg-emerald-500" aria-label="Çevrimiçi"></span>
    @endif
</span>
