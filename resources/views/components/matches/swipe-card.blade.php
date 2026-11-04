@props([
    'card',
    'index' => 0,
    'total' => 0,
])

@php
    $card = $card instanceof Illuminate\Database\Eloquent\Model ? $card->getAttributes() : $card;
    $name = data_get($card, 'name') ?: 'Gönülkop üyesi';
    $username = data_get($card, 'username');
    $city = data_get($card, 'city');
    $bio = data_get($card, 'bio') ?: data_get($card, 'about');
    $gender = data_get($card, 'gender');
    $gender = $gender instanceof BackedEnum ? $gender->value : $gender;
    $age = data_get($card, 'age');
    $birthDate = data_get($card, 'birth_date') ?: data_get($card, 'date_of_birth');

    if (! $age && $birthDate) {
        try {
            $age = Illuminate\Support\Carbon::parse($birthDate)->age;
        } catch (Throwable) {
            $age = null;
        }
    }

    $image = data_get($card, 'avatar_url') ?: data_get($card, 'profile_photo_path') ?: data_get($card, 'avatar_path') ?: data_get($card, 'profile_image') ?: data_get($card, 'image_path');

    if ($image && ! Illuminate\Support\Str::startsWith($image, ['http://', 'https://', '/', 'data:', 'blob:'])) {
        $image = asset('storage/' . $image);
    }

    $profileUrl = data_get($card, 'id') && Route::has('profiles.show') ? route('profiles.show', data_get($card, 'id')) : '#';
    $messageUrl = data_get($card, 'id') && Route::has('messages.show') ? route('messages.show', data_get($card, 'id')) : '#';
@endphp

<article class="surface-card flex h-full min-h-[32rem] flex-col overflow-hidden relative">
    <!-- Fotoğraf -->
    <div class="relative aspect-[4/5] overflow-hidden bg-gradient-to-br from-brand-100 via-rose-50 to-amber-100 sm:aspect-[5/6]">
        @if ($image)
            <img src="{{ $image }}" alt="{{ $name }}" class="size-full object-cover" loading="lazy" decoding="async">
        @else
            <div class="absolute inset-0 grid place-items-center text-brand-500/25" aria-hidden="true">
                <svg viewBox="0 0 24 24" class="size-24" fill="none" stroke="currentColor" stroke-width="1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>
        @endif

        <!-- Etiket: Yaş + Şehir -->
        <div class="absolute inset-x-0 bottom-0 bg-gradient-to-t from-ink/75 via-ink/25 to-transparent px-5 pt-16 pb-5 text-white">
            <div class="flex items-end justify-between gap-3">
                <div class="min-w-0">
                    <h2 class="truncate text-xl font-semibold tracking-tight">{{ $name }}</h2>
                    <p class="mt-1 text-sm text-white/80">
                        @if ($age) {{ $age }} yaş @endif
                        @if ($age && $city) <span aria-hidden="true">·</span> @endif
                        @if ($city) {{ $city }} @endif
                    </p>
                </div>
                @if ($gender)
                    <span class="shrink-0 rounded-full bg-white/18 px-3 py-1 text-xs font-semibold backdrop-blur-sm">
                        {{ $gender === 'female' ? 'Kadın' : 'Erkek' }}
                    </span>
                @endif
            </div>
        </div>

        <!-- Beğen / Süper Beğen / Geç simgeleri overlay -->
        <div class="absolute inset-0 flex items-center justify-center px-6 py-4 gap-8 opacity-0 group-hover:opacity-100 transition-opacity">
            <button type="button" class="text-[3rem] text-neutral-400/90 select-none bg-white/10 backdrop-blur rounded-full p-1 tap-target" aria-label="Geç">
                ✕
            </button>
            <button type="button" data-super-like data-user-id="{{ $card['id'] ?? null }}" class="text-[3rem] text-yellow-400/90 select-none bg-white/10 backdrop-blur rounded-full p-1 tap-target hover:text-yellow-500 transition" aria-label="Süper Beğen">
                ⭐
            </button>
            <button type="button" class="text-[3rem] text-brand-600/90 select-none bg-white/10 backdrop-blur rounded-full p-1 tap-target hover:text-brand-600 transition" aria-label="Beğen">
                ❤️
            </button>
        </div>
    </div>

    <!-- Biyografi -->
    <div class="flex flex-1 flex-col p-5">
        <p class="line-clamp-4 text-sm leading-6 text-muted">
            {{ $bio ?: 'Tanışmak için kısa bir tanıtım ekleyin.' }}
        </p>

        <div class="mt-auto grid grid-cols-2 gap-3 pt-6">
            <x-ui.button
                :href="$messageUrl"
                variant="secondary"
                class="w-full"
            >
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                </svg>
                Mesajla
            </x-ui.button>

            <x-ui.button :href="$profileUrl" class="w-full">
                Profili gör
            </x-ui.button>
        </div>
    </div>
</article>