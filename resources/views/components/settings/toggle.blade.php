@props([
    'name',
    'label',
    'description',
    'checked' => false,
])

<label {{ $attributes->merge(['class' => 'group flex cursor-pointer items-center justify-between gap-5 rounded-2xl border border-line/80 bg-[#fffaf7] p-4 transition hover:border-primary-200 hover:bg-primary-50/40']) }}>
    <span class="min-w-0">
        <span class="block text-sm font-bold text-ink">{{ $label }}</span>
        <span class="mt-1 block text-sm leading-6 text-muted">{{ $description }}</span>
    </span>

    <span class="relative shrink-0">
        <input type="hidden" name="{{ $name }}" value="0">
        <input
            type="checkbox"
            name="{{ $name }}"
            value="1"
            @checked($checked)
            class="peer sr-only"
            aria-label="{{ $label }}"
        >
        <span class="block h-7 w-12 rounded-full bg-line shadow-inner ring-1 ring-black/5 transition-colors duration-200 peer-checked:bg-primary-600 peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500 peer-focus-visible:ring-offset-2"></span>
        <span class="pointer-events-none absolute top-1 left-1 size-5 rounded-full bg-white shadow-sm transition-transform duration-200 peer-checked:translate-x-5"></span>
    </span>
</label>
