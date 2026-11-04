<x-layouts.app
    title="Akış · Gönülkop"
    description="Takip ettiğin kişilerin hikâyelerini ve gönderilerini keşfet."
>
    <main class="mx-auto max-w-[440px] px-3 sm:px-4" aria-labelledby="feed-title">
        <x-feed.story-strip :stories="($stories ?? [])" />

        <section class="pb-12 pt-6 sm:pt-8" aria-labelledby="feed-title">
            <div class="mb-4 flex items-end justify-between gap-4 px-1 sm:mb-5 sm:px-2">
                <div>
                    <h2 id="feed-title" class="text-xl font-bold tracking-tight text-ink">Gönderiler</h2>
                </div>
                <span class="inline-flex items-center gap-2 pb-0.5 text-xs font-semibold text-ink-muted sm:text-sm">
                    <span class="size-1.5 rounded-full bg-brand-500" aria-hidden="true"></span>
                    En yeni
                </span>
            </div>

            @php
                $postItems = is_object($posts) && method_exists($posts, 'items')
                    ? $posts->items()
                    : ($posts instanceof Illuminate\Support\Collection ? $posts->all() : ($posts ?? []));
                $nextFeedUrl = null;

                if (is_object($posts) && method_exists($posts, 'nextPageUrl')) {
                    $nextFeedUrl = $posts->nextPageUrl();
                }

                $feedEndpoint = Route::has('feed.api') ? route('feed.api') : url('/api/feed');
            @endphp

            <div
                data-feed-infinite
                data-feed-url="{{ $feedEndpoint }}"
                data-next-url="{{ $nextFeedUrl }}"
                class="space-y-4 sm:space-y-6"
            >
                <div data-feed-posts class="space-y-4 sm:space-y-6">
                    @forelse ($postItems as $post)
                        <x-feed.post-card :post="$post" />
                    @empty
                        <div class="rounded-[1.5rem] border border-line bg-white shadow-sm" data-feed-empty>
                            <x-ui.empty-state
                                title="Akış henüz sakin"
                                description="Yeni hikâyeler ve gönderiler yayımlandığında burada görünecek."
                                icon="message"
                            >
                                <x-ui.button :href="route('discover.index')" variant="secondary" size="sm">Kişileri keşfet</x-ui.button>
                            </x-ui.empty-state>
                        </div>
                    @endforelse
                </div>

                <div data-feed-sentinel class="grid min-h-24 place-items-center py-4" aria-hidden="true"></div>

                <div data-feed-status class="min-h-6 text-center text-xs font-medium text-ink-muted" role="status" aria-live="polite"></div>

                <div data-feed-error class="hidden text-center" role="alert">
                    <x-ui.button type="button" variant="secondary" size="sm" data-feed-retry>Tekrar dene</x-ui.button>
                </div>
            </div>
        </section>
    </main>
</x-layouts.app>
