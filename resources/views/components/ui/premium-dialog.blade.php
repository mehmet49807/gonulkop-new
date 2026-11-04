@props([
    'id' => 'premium-dialog',
    'title' => 'Premium’a Geç',
    'description' => 'Deneme süren doldu. Mesajlaşmaya devam etmek ve tüm eşleşme özelliklerini kullanmak için Premium üyeliğe geç.',
])

<dialog id="{{ $id }}" {{ $attributes->merge(['class' => 'm-auto w-[calc(100%_-_2rem)] max-w-md rounded-card bg-white p-0 text-ink shadow-float backdrop:bg-ink/45 backdrop:backdrop-blur-sm']) }}>
    <div class="p-6 sm:p-7">
        <div class="flex items-start justify-between gap-4">
            <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-brand-50 text-brand-600">
                <svg viewBox="0 0 24 24" class="size-6" fill="currentColor" aria-hidden="true">
                    <path d="M12 2.25l2.196 4.448 4.912.714-3.554 3.463.839 4.886L12 13.805l-4.393 2.306.839-4.886-3.554-3.463 4.912-.714L12 2.25z" />
                </svg>
            </span>

            <button type="button" class="tap-target -mt-2 -mr-2 rounded-full text-muted transition hover:bg-canvas hover:text-ink" data-dialog-close aria-label="Pencereyi kapat">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <h2 class="mt-5 text-xl font-semibold tracking-tight text-ink">{{ $title }}</h2>
        <p class="mt-2 text-sm leading-6 text-muted">{{ $description }}</p>

        <div class="mt-6 grid gap-3">
            <x-ui.button type="button" class="w-full">Premium’a Geç</x-ui.button>
            <x-ui.button type="button" variant="ghost" class="w-full" data-dialog-close>Şimdi Değil</x-ui.button>
        </div>
    </div>
</dialog>
