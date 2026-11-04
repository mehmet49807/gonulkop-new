<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
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
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
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
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
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
?>

<article <?php echo e($attributes->merge(['class' => 'rounded-[1rem] border border-line bg-white shadow-sm'])); ?>>
    <header class="flex items-center justify-between gap-3 px-4 pt-4 sm:px-5 sm:pt-5">
        <div class="flex min-w-0 items-center gap-3">
            <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['src' => $authorImage,'name' => $authorName,'size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($authorImage),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($authorName),'size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $attributes = $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2)): ?>
<?php $component = $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2; ?>
<?php unset($__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2); ?>
<?php endif; ?>
            <div class="min-w-0">
                <h2 class="truncate text-sm font-semibold text-ink"><?php echo e($authorName); ?></h2>
                <p class="mt-0.5 flex items-center gap-1 truncate text-xs text-ink-muted"><?php echo e($publishedAt); ?></p>
            </div>
        </div>
        </div>

        <?php if($canDelete && $deleteUrl): ?>
            <button type="button" class="tap-target grid size-8 place-items-center rounded-lg text-muted transition hover:bg-neutral-100 hover:text-ink" data-delete-post="<?php echo e($deleteUrl); ?>" aria-label="Gönderiyi sil">
                <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M20 12H4" /></svg>
            </button>
        <?php endif; ?>
    </header>

    <?php if($image): ?>
        <a href="<?php echo e($href ?? '#'); ?>" class="block relative overflow-hidden">
            <img src="<?php echo e($image); ?>" alt="<?php echo e($authorName); ?> gönderisi" class="feed-post-image" loading="lazy" decoding="async">
        </a>
    <?php endif; ?>

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

        <p class="mt-2 text-sm font-semibold text-ink"><?php echo e(number_format($likeCount)); ?> beğeni</p>

        <?php if($title): ?>
            <h3 class="mt-3 text-base font-bold text-ink"><?php echo e($title); ?></h3>
        <?php endif; ?>

        <?php if($content): ?>
            <p class="mt-2 line-clamp-3 text-sm leading-6 text-ink-muted"><?php echo e($content); ?></p>
        <?php endif; ?>

        <?php if($commentCount > 0): ?>
            <button type="button" class="mt-3 inline-flex min-h-9 items-center rounded-full bg-neutral-50 px-3 text-[0.75rem] font-bold text-ink-muted transition hover:bg-brand-50 hover:text-brand-600">
                <?php echo e(number_format($commentCount)); ?> yorumun tümünü gör
            </button>
        <?php endif; ?>
    </div>
</article>
                    </svg>
                </button>
            </form>
        <?php else: ?>
            <button type="button" class="tap-target grid size-10 shrink-0 place-items-center rounded-full bg-canvas text-ink-muted transition hover:bg-brand-50 hover:text-brand-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Gönderi seçenekleri">
                <svg viewBox="0 0 24 24" class="size-5" fill="currentColor" aria-hidden="true">
                    <path d="M12 6.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5ZM12 18.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                </svg>
            </button>
        <?php endif; ?>
    </header>

    <div class="relative mx-3 mt-4 aspect-[4/5] overflow-hidden rounded-[1.5rem] bg-gradient-to-br from-brand-100 via-rose-50 to-accent-100 sm:mx-4 sm:mt-5 sm:aspect-[16/10]">
        <?php if($image): ?>
            <img
                src="<?php echo e($image); ?>"
                alt="<?php echo e($title ?: $authorName . ' gönderisi'); ?>"
                class="size-full object-cover transition duration-500 hover:scale-[1.015]"
                loading="lazy"
                decoding="async"
            >
        <?php else: ?>
            <div class="absolute inset-0 grid place-items-center" aria-hidden="true">
                <div class="grid size-20 place-items-center rounded-[1.75rem] bg-white/65 text-brand-400 shadow-sm backdrop-blur-sm">
                    <svg viewBox="0 0 24 24" class="size-9" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                    </svg>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="px-5 pb-5 pt-4 sm:px-6 sm:pb-6 sm:pt-5">
        <div class="flex items-center gap-1.5">
            <button type="button" class="tap-target grid size-10 place-items-center rounded-2xl text-ink transition hover:bg-brand-50 hover:text-brand-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Beğen">
                <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                </svg>
            </button>
            <button type="button" data-super-like data-user-id="<?php echo e($author instanceof Illuminate\Database\Eloquent\Model ? $author->getKey() : (data_get($authorData, 'id') ?: null)); ?>" class="tap-target relative grid size-10 place-items-center rounded-2xl text-brand-500 transition hover:bg-brand-50 hover:text-brand-600 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400" aria-label="Süper Beğen">
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

        <p class="mt-2 text-sm font-extrabold text-ink"><?php echo e(number_format($likeCount)); ?> beğeni</p>

        <?php if($title): ?>
            <h3 class="mt-4 text-lg leading-7 font-extrabold tracking-[-0.015em] text-ink">
                <?php if($href): ?>
                    <a href="<?php echo e($href); ?>" class="transition hover:text-brand-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400"><?php echo e($title); ?></a>
                <?php else: ?>
                    <?php echo e($title); ?>

                <?php endif; ?>
            </h3>
        <?php endif; ?>

        <?php if($content): ?>
            <p class="mt-2 line-clamp-3 text-sm leading-6 text-ink-muted"><?php echo e($content); ?></p>
        <?php endif; ?>

        <?php if($commentCount > 0): ?>
            <button type="button" class="mt-4 inline-flex min-h-9 items-center rounded-full bg-canvas px-3.5 text-xs font-bold text-ink-muted transition hover:bg-brand-50 hover:text-brand-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-400">
                <?php echo e(number_format($commentCount)); ?> yorumun tümünü gör
            </button>
        <?php endif; ?>
    </div>
</article>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/feed/post-card.blade.php ENDPATH**/ ?>