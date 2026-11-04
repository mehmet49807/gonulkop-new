@props([
    'name',
    'label',
    'hint' => null,
    'error' => null,
    'required' => false,
])

<div {{ $attributes->merge(['class' => 'space-y-2']) }}>
    <label for="{{ $name }}" class="flex items-center justify-between gap-3 text-sm font-semibold text-ink">
        <span>
            {{ $label }}
            @if ($required)
                <span class="text-brand-600" aria-hidden="true">*</span>
            @endif
        </span>

        @if ($hint)
            <span class="text-xs font-normal text-muted">{{ $hint }}</span>
        @endif
    </label>

    {{ $slot }}

    @if ($error)
        <p id="{{ $name }}-error" class="text-sm font-medium text-red-600" role="alert">
            {{ $error }}
        </p>
    @endif
</div>
