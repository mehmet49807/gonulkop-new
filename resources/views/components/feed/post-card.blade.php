@props([
    'post' => null,
    'authorName' => null,
    'authorImage' => null,
    'image' => null,
    'title' => null,
    'content' => null,
    'publishedAt' => null,
    'likeCount' => 0,
    'commentCount' => 0,
    'href' => null,
    'canDelete' => false,
    'deleteUrl' => null,
    'privacyMode' => false,
])

@php
    $author = data_get($post, 'user');
    $authorData = $author instanceof Illuminate\Database\Eloquent\Model ? $author->getAttributes() : $author;
    $authorUsername = data_get($authorData, 'username') ?: null;
    $authorCity = data_get($authorData, 'show_location') === false ? null : (data_get($authorData, 'city') ?: null);
    $authorName = $privacyMode
        ? ($authorUsername ?: 'Kullanıcı')
        : ($authorName ?: ($authorUsername ?: data_get($authorData, 'name') ?: data_get($post, 'author_name') ?: 'Kullanıcı'));
    $authorImage = $authorImage ?: (data_get($authorData, 'avatar_url') ?: data_get($authorData, 'profile_photo_path') ?: data_get($authorData, 'avatar_path') ?: data_get($authorData, 'profile_image') ?: data_get($authorData, 'image_path') ?: null);
    $image = $image ?: (data_get($post, 'image_url') ?: data_get($post, 'image_path') ?: data_get($post, 'image') ?: null);
    $title = $title ?? data_get($post, 'title');
    $content = $content ?? data_get($post, 'content');
    $publishedAt = $publishedAt ?? data_get($post, 'published_at');
    $likeCount = $likeCount ?: (int) (data_get($post, 'likes_count') ?? 0);
    $commentCount = $commentCount ?: (int) (data_get($post, 'comments_count') ?? 0);

    if ($publishedAt instanceof DateTimeInterface) {
        $publishedAt = $publishedAt->diffForHumans();
    }

    if ($authorImage && ! Illuminate\Support\Str::startsWith($authorImage, ['http://', 'https://', '/', 'data:', 'blob:'])) {
        $authorImage = asset('storage/'.$authorImage);
    }

    if ($image && ! Illuminate\Support\Str::startsWith($image, ['http://', 'https://', '/', 'data:', 'blob:'])) {
        $image = asset('storage/'.$image);
    }

    $postId = data_get($post, 'id');
    $href = $href ?: ($postId && Route::has('posts.show') ? route('posts.show', $postId) : null);
@endphp

<article {{ $attributes->merge(['class' => 'rounded-[1rem] border border-line bg-white shadow-sm']) }}>
    <header class="flex items-center justify-between gap-3 px-4 pt-4 sm:px-5 sm:pt-5">
        <div class="flex min-w-0 items-center gap-3">
            <x-ui.avatar :src="$authorImage" :name="$authorName" size="sm" />
            <div class="min-w-0">
                <h2 class="truncate text-sm font-semibold text-ink">{{ $authorName }}</h2>
                <p class="mt-0.5 flex items-center gap-1 truncate text-xs text-ink-muted">{{ $publishedAt }}</p>
            </div>
        </div>
        </div>

        @if ($canDelete && $deleteUrl)
            <button type="button" class="tap-target grid size-8 place-items-center rounded-lg text-muted transition hover:bg-neutral-100 hover:text-ink" data-delete-post="{{ $deleteUrl }}" aria-label="Gönderiyi sil">
                <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" /></svg>
            </button>
        @endif
    </header>

    @if ($image)
        <a href="{{ $href ?? '#' }}" class="block relative overflow-hidden">
            <img src="{{ $image }}" alt="{{ $authorName }} gönderisi" class="feed-post-image" loading="lazy" decoding="async">
        </a>
    @endif

    <div class="px-3 py-3 sm:px-4 sm:py-4">
        <div class="flex items-center gap-2 mb-2">
            <button type="button" class="tap-target grid size-9 place-items-center rounded-lg text-ink transition hover:bg-neutral-50" aria-label="Beğen">
                <svg viewBox="0 0 24 24" class="size-5 fill-none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" /></svg>
            </button>
            <button type="button" class="tap-target grid size-9 place-items-center rounded-lg text-ink transition hover:bg-neutral-50" aria-label="Yorum yap">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432 .447 .74 1.04 .586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 12 20.25Z" /></svg>
            </button>
            <button type="button" class="tap-target grid size-9 place-items-center rounded-lg text-ink transition hover:bg-neutral-50" aria-label="Paylaş">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" /></svg>
            </button>
            <button type="button" class="tap-target ml-auto grid size-9 place-items-center rounded-lg text-ink transition hover:bg-neutral-50" aria-label="Kaydet">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" /></svg>
            </button>
        </div>

        <p class="mt-2 text-sm font-semibold text-ink">{{ number_format($likeCount) }} beğeni</p>

        @if ($title)
            <h3 class="mt-3 text-base font-bold text-ink">{{ $title }}</h3>
        @endif

        @if ($content)
            <p class="mt-2 line-clamp-3 text-sm leading-6 text-ink-muted">{{ $content }}</p>
        @endif

        @if ($commentCount > 0)
            <button type="button" class="mt-3 inline-flex min-h-9 items-center rounded-full bg-neutral-50 px-3 text-[0.75rem] font-bold text-ink-muted transition hover:bg-brand-50 hover:text-brand-600">
                {{ number_format($commentCount) }} yorumun tümünü gör
            </button>
        @endif
    </div>
</article>
                    </svg>
                </button>
            </form>
        @else
            <button type="button" class="tap-target grid size-10 shrink-0 place-items-center rounded-full bg-canvas text-ink-muted transition hover:bg-brand-50 hover:text-brand-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Gönderi seçenekleri">
                <svg viewBox="0 0 24 24" class="size-5" fill="currentColor" aria-hidden="true">
                    <path d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                </svg>
            </button>
        @endif
    </header>

    <div class="relative mx-3 mt-4 aspect-[4/5] overflow-hidden rounded-[1.5rem] bg-gradient-to-br from-brand-100 via-rose-50 to-accent-100 sm:mx-4 sm:mt-5 sm:aspect-[16/10]">
        @if ($image)
            <img
                src="{{ $image }}"
                alt="{{ $title ?: $authorName . ' gönderisi' }}"
                class="size-full object-cover transition duration-500 hover:scale-[1.015]"
                loading="lazy"
                decoding="async"
            >
        @else
            <div class="absolute inset-0 grid place-items-center" aria-hidden="true">
                <div class="grid size-20 place-items-center rounded-[1.75rem] bg-white/65 text-brand-400 shadow-sm backdrop-blur-sm">
                    <svg viewBox="0 0 24 24" class="size-9" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </div>
            </div>
        @endif
    </div>

    <div class="px-5 pb-5 pt-4 sm:px-6 sm:pb-6 sm:pt-5">
        <div class="flex items-center gap-1.5">
            <button type="button" class="tap-target grid size-10 place-items-center rounded-2xl text-ink transition hover:bg-brand-50 hover:text-brand-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Beğen">
                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
            <button type="button" data-super-like data-user-id="{{ $author instanceof Illuminate\Database\Eloquent\Model ? $author->getKey() : (data_get($authorData, 'id') ?: null) }}" class="tap-target relative grid size-10 place-items-center rounded-2xl text-brand-500 transition hover:bg-brand-50 hover:text-brand-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Süper Beğen">
                <svg viewBox="0 0 24 24" class="size-6 fill-current" fill="currentColor" aria-hidden="true">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                </svg>
                <span class="absolute -right-1 -top-1 grid min-w-5 place-items-center rounded-full bg-brand-600 px-1 py-0.5 text-[0.55rem] font-bold leading-none text-white shadow-sm" data-super-like-remaining>30</span>
            </button>
            <button type="button" class="tap-target grid size-10 place-items-center rounded-2xl text-ink transition hover:bg-brand-50 hover:text-brand-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Yorum yap">
                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 20.25c4.97 0 9-3.694 9-8.25s-4.03-8.25-9-8.25S3 7.444 3 12c0 2.104.859 4.023 2.273 5.48.432.447.74 1.04.586 1.641a4.483 4.483 0 0 1-.923 1.785A5.969 5.969 0 0 0 12 20.25Z" />
                </svg>
            </button>
            <button type="button" class="tap-target grid size-10 place-items-center rounded-2xl text-ink transition hover:bg-brand-50 hover:text-brand-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Paylaş">
                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>

            <button type="button" class="tap-target ml-auto grid size-10 place-items-center rounded-2xl text-ink transition hover:bg-brand-50 hover:text-brand-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Kaydet">
                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                </svg>
            </button>
        </div>

        <p class="mt-2 text-sm font-extrabold text-ink">{{ number_format($likeCount) }} beğeni</p>

        @if ($title)
            <h3 class="mt-4 text-lg leading-7 font-extrabold tracking-[-0.015em] text-ink">
                @if ($href)
                    <a href="{{ $href }}" class="transition hover:text-brand-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400">{{ $title }}</a>
                @else
                    {{ $title }}
                @endif
            </h3>
        @endif

        @if ($content)
            <p class="mt-2 line-clamp-3 text-sm leading-6 text-ink-muted">{{ $content }}</p>
        @endif

        @if ($commentCount > 0)
            <button type="button" class="mt-4 inline-flex min-h-9 items-center rounded-full bg-canvas px-3.5 text-xs font-bold text-ink-muted transition hover:bg-brand-50 hover:text-brand-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400">
                {{ number_format($commentCount) }} yorumun tümünü gör
            </button>
        @endif
    </div>
</article>
