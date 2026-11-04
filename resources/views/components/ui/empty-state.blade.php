@props([
    'title',
    'description',
    'icon' => 'sparkles',
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center px-6 py-14 text-center']) }}>
    <span class="mb-5 grid size-16 place-items-center rounded-3xl bg-brand-50 text-brand-600">
        @switch($icon)
            @case('message')
                <svg viewBox="0 0 24 24" class="size-7" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12h.008v.008H8.625V12Zm0 3.75h.008v.008H8.625v-.008Zm0-7.5h.008v.008H8.625v-.008Zm6.75 7.5h.008v.008h-.008V15.75Zm0-3.75h.008v.008h-.008V12Zm0-3.75h.008v.008h-.008V8.25Z" />
                </svg>
                @break

            @default
                <svg viewBox="0 0 24 24" class="size-7" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
                </svg>
                @break
        @endswitch
    </span>

    <h2 class="text-lg font-semibold tracking-tight text-ink">{{ $title }}</h2>
    <p class="mt-2 max-w-sm text-sm leading-6 text-muted">{{ $description }}</p>

    @if (! $slot->isEmpty())
        <div class="mt-6">
            {{ $slot }}
        </div>
    @endif
</div>
