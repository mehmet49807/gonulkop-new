@props([
    'stories' => [],
    'privacyMode' => false,
])

<div {{ $attributes->merge(['class' => 'border-y border-line/60 bg-white/65']) }}>
    <div class="mx-auto max-w-2xl px-3 sm:px-5">
        <div class="flex items-center justify-between gap-4 pt-5 sm:pt-6">
            <div>
                <p class="text-xs font-bold tracking-[0.16em] text-brand-600 uppercase">Hikâyeler</p>
                <p class="mt-1 text-sm font-semibold text-ink">Çevrenden bugün</p>
            </div>
            <span class="rounded-full bg-brand-50 px-3 py-1.5 text-xs font-bold text-brand-700">
                {{ count($stories) }} hikâye
            </span>
        </div>

        <div class="no-scrollbar -mx-1 flex snap-x gap-4 overflow-x-auto px-1 pb-5 pt-4 sm:gap-5 sm:pb-6" role="list" aria-label="Hikâyeler">
            @forelse ($stories as $story)
                @php
                    $storyData = $story instanceof Illuminate\Database\Eloquent\Model ? $story->getAttributes() : $story;
                    $storyUser = data_get($story, 'user') ?: $storyData;
                    $storyUserData = $storyUser instanceof Illuminate\Database\Eloquent\Model ? $storyUser->getAttributes() : $storyUser;
                    $storyName = $privacyMode
                        ? (data_get($storyUserData, 'username') ?: 'Kullanıcı')
                        : (data_get($storyData, 'name') ?: (data_get($storyUserData, 'name') ?: data_get($storyUserData, 'username') ?: 'Kullanıcı'));
                    $storyImage = data_get($storyData, 'image_path') ?: data_get($storyData, 'image') ?: (data_get($storyUserData, 'avatar_url') ?: data_get($storyUserData, 'profile_photo_path') ?: data_get($storyUserData, 'avatar_path') ?: data_get($storyUserData, 'profile_image') ?: data_get($storyUserData, 'image_path') ?: null);
                    $storyHref = data_get($story, 'href');

                    if ($storyImage && ! Illuminate\Support\Str::startsWith($storyImage, ['http://', 'https://', '/', 'data:', 'blob:'])) {
                        $storyImage = asset('storage/'.$storyImage);
                    }
                @endphp

                <a
                    href="{{ $storyHref ?: '#' }}"
                    class="group flex w-[4.5rem] shrink-0 snap-start flex-col items-center gap-2.5 focus-visible:outline-none"
                    role="listitem"
                    @if (! $storyHref) aria-disabled="true" @endif
                >
                    <span class="grid size-[4.25rem] place-items-center rounded-full bg-gradient-to-br from-brand-400 via-brand-500 to-accent-400 p-[3px] shadow-brand transition duration-200 group-hover:-translate-y-0.5 group-hover:shadow-lg group-focus-visible:ring-2 group-focus-visible:ring-brand-500 group-focus-visible:ring-offset-2">
                        <span class="grid size-full place-items-center rounded-full bg-white p-[3px]">
                            <x-ui.avatar
                                :src="$storyImage"
                                :name="$storyName"
                                size="lg"
                                class="ring-0"
                            />
                        </span>
                    </span>
                    <span class="w-full truncate text-center text-xs font-bold text-ink">{{ $storyName }}</span>
                </a>
            @empty
                <div class="flex w-full items-center gap-3 py-3 text-sm text-ink-muted">
                    <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-brand-50 text-brand-600">
                        <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5c-1.5-1.5-4.087-1.5-5.586 0L4.5 6.414A3.92 3.92 0 0 0 3 9.172V19.5A1.5 1.5 0 0 0 4.5 21h15a1.5 1.5 0 0 0 1.5-1.5V9.172a3.92 3.92 0 0 0-1.5-2.758l-1.914-1.914C16.087 3 13.5 3 12 4.5Z" />
                        </svg>
                    </span>
                    <span class="font-medium">Yeni hikâyeler burada görünecek.</span>
                </div>
            @endforelse
        </div>
    </div>
</div>
