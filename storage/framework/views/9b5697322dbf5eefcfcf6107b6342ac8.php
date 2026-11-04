<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Gönülkop',
    'description' => 'Gönülleri birleştiren köprü.',
    'wide' => false,
    'contentClass' => null,
    'showNavigation' => true,
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
    'title' => 'Gönülkop',
    'description' => 'Gönülleri birleştiren köprü.',
    'wide' => false,
    'contentClass' => null,
    'showNavigation' => true,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#ffffff">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title); ?></title>

    <?php if($description): ?>
        <meta name="description" content="<?php echo e($description); ?>">
    <?php endif; ?>

    <?php echo app('Illuminate\Foundation\Vite')->fonts(); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="bg-[var(--color-canvas)] text-[var(--color-ink)] antialiased selection:bg-brand-200 selection:text-brand-900">
    <div class="relative flex min-h-[dvh] flex-col">
        <header class="sticky top-0 z-40 border-b border-line/50 bg-white/80 shadow-[0_1px_0_rgba(255,255,255,.7)] backdrop-blur-2xl">
            <div class="mx-auto flex min-h-16 max-w-6xl items-center justify-between gap-4 px-3 sm:px-6">
                <a href="<?php echo e(route('feed.index')); ?>" class="flex min-w-0 items-center gap-2" aria-label="Gönülkop ana sayfa">
                    <?php if (isset($component)) { $__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.brand-logo','data' => ['size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('brand-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'sm']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3)): ?>
<?php $attributes = $__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3; ?>
<?php unset($__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3)): ?>
<?php $component = $__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3; ?>
<?php unset($__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3); ?>
<?php endif; ?>
                </a>

                <nav class="hidden items-center gap-1 lg:flex" aria-label="Sayfa navigasyonu">
                    <a href="<?php echo e(route('feed.index')); ?>" class="rounded-full px-4 py-2 text-sm font-semibold transition <?php echo e(request()->routeIs('feed.index') ? 'bg-primary-50 text-primary-700' : 'text-muted hover:bg-canvas hover:text-ink'); ?>">Akış</a>
                    <a href="<?php echo e(route('discover.index')); ?>" class="rounded-full px-4 py-2 text-sm font-semibold transition <?php echo e(request()->routeIs('discover.index') ? 'bg-primary-50 text-primary-700' : 'text-muted hover:bg-canvas hover:text-ink'); ?>">Keşfet</a>
                    <a href="<?php echo e(route('matches.index')); ?>" class="rounded-full px-4 py-2 text-sm font-semibold transition <?php echo e(request()->routeIs('matches.index') ? 'bg-primary-50 text-primary-700' : 'text-muted hover:bg-canvas hover:text-ink'); ?>">Eşleşmeler</a>
                    <a href="<?php echo e(route('messages.index')); ?>" class="rounded-full px-4 py-2 text-sm font-semibold transition <?php echo e(request()->routeIs('messages.index', 'messages.show') ? 'bg-primary-50 text-primary-700' : 'text-muted hover:bg-canvas hover:text-ink'); ?>">Mesajlar</a>
                </nav>

                <div class="flex shrink-0 items-center gap-2">
                    <a href="<?php echo e(route('messages.index')); ?>" class="tap-target grid size-10 place-items-center rounded-xl border border-line bg-white text-muted shadow-sm transition hover:border-primary-200 hover:bg-primary-50 hover:text-primary-700 lg:hidden" aria-label="Mesajlar">
                        <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" /></svg>
                    </a>

                    <div x-data="{ open: false }" class="relative">
                        <button
                            @click="open = !open"
                            @click.away="open = false"
                            class="tap-target grid size-10 place-items-center rounded-xl border border-line bg-white shadow-sm transition hover:border-primary-200 hover:bg-primary-50"
                            aria-label="Hesap menüsü"
                            aria-haspopup="true"
                            :aria-expanded="open"
                        >
                            <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['src' => data_get(auth()->user(), 'avatar_url') ?: data_get(auth()->user(), 'profile_photo_path'),'name' => data_get(auth()->user(), 'name') ?: 'Gönülkop üyesi','size' => 'xs','class' => 'ring-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(data_get(auth()->user(), 'avatar_url') ?: data_get(auth()->user(), 'profile_photo_path')),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(data_get(auth()->user(), 'name') ?: 'Gönülkop üyesi'),'size' => 'xs','class' => 'ring-0']); ?>
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
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                            class="absolute right-0 z-50 mt-2 w-64 rounded-2xl border border-line/80 bg-white p-1 shadow-xl shadow-neutral-900/10"
                        >
                            <div class="p-2">
                                <div class="border-b border-line/60 px-3 py-3">
                                    <p class="truncate text-sm font-bold text-ink"><?php echo e(data_get(auth()->user(), 'name') ?: 'Gönülkop üyesi'); ?></p>
                                    <p class="mt-0.5 truncate text-xs text-muted">{{ data_get(auth()->user(), 'username') ?: 'uye' }}</p>
                                </div>

                                <a href="<?php echo e(route('discover.index')); ?>" class="mt-1 flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-ink transition hover:bg-primary-50 hover:text-primary-700" aria-label="Keşfet">
                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                                    <span>Keşfet</span>
                                </a>
                                <a href="<?php echo e(route('profile.index')); ?>" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-ink transition hover:bg-primary-50 hover:text-primary-700" aria-label="Profili görüntüle">
                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                    <span>Profilim</span>
                                </a>
                                <a href="<?php echo e(route('settings.edit')); ?>" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-ink transition hover:bg-primary-50 hover:text-primary-700" aria-label="Ayarlar">
                                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                                    <span>Ayarlar</span>
                                </a>
                                <?php if(auth()->user()?->gender?->value === 'male'): ?>
                                    <a href="<?php echo e(route('premium.index')); ?>" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium text-ink transition hover:bg-primary-50 hover:text-primary-700" aria-label="Premium">
                                        <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m12 3 2.1 4.3 4.7.7-3.4 3.3.8 4.7-4.2-2.2L7.8 16l.8-4.7-3.4-3.3 4.7-.7L12 3Z"/></svg>
                                        <span>Premium</span>
                                    </a>
                                <?php endif; ?>
                                <div class="my-1 border-t border-line/60"></div>
                                <form method="POST" action="<?php echo e(route('logout')); ?>">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold text-red-600 transition hover:bg-red-50" aria-label="Çıkış yap">
                                        <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 16l4-4m0 0l-4-4m4 4H7" /></svg>
                                        <span>Çıkış Yap</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </header>

        <?php if(isset($header)): ?>
            <div class="relative z-10">
                <?php echo e($header); ?>

            </div>
        <?php endif; ?>

        <main class="w-full flex-1 <?php echo e($contentClass ?? ($wide ? 'mx-auto max-w-5xl' : 'mx-auto max-w-3xl')); ?>">
            <?php echo e($slot); ?>

        </main>
    </div>

    <?php if($showNavigation): ?>
        <nav class="safe-bottom fixed inset-x-0 bottom-0 z-40 border-t border-line/40 bg-white/70 backdrop-blur-2xl px-4 pt-2 pb-6 sm:px-6" aria-label="Ana gezinme">
            <div class="mx-auto max-w-5xl flex items-center justify-around gap-2">
                <a href="<?php echo e(route('feed.index')); ?>" class="flex flex-1 flex-col items-center justify-center gap-1.5 rounded-2xl px-2 py-2 text-[0.65rem] font-semibold transition-all <?php echo e(request()->routeIs('feed.index') ? 'bg-primary-50 text-primary-700 shadow-sm' : 'text-ink-muted hover:bg-white hover:text-ink'); ?>" aria-label="Akış">
                    <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M3 12h18M3 6h18M3 18h18" /></svg>
                    <span class="<?php echo e(request()->routeIs('feed.index') ? 'font-bold' : 'font-medium'); ?>">Akış</span>
                </a>

                <a href="<?php echo e(route('discover.index')); ?>" class="flex flex-1 flex-col items-center justify-center gap-1.5 rounded-2xl px-2 py-2 text-[0.65rem] font-semibold transition-all <?php echo e(request()->routeIs('discover.index', 'matches.index') ? 'bg-primary-50 text-primary-700 shadow-sm' : 'text-ink-muted hover:bg-white hover:text-ink'); ?>" aria-label="Keşfet">
                    <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-4-4"/></svg>
                    <span class="<?php echo e(request()->routeIs('discover.index', 'matches.index') ? 'font-bold' : 'font-medium'); ?>">Keşfet</span>
                </a>

                <a href="<?php echo e(route('messages.index')); ?>" class="flex flex-col items-center justify-center gap-1.5 px-3 py-2 rounded-3xl text-[0.6rem] font-medium transition-all <?php echo e(request()->routeIs('messages.index') ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-ink-muted hover:text-ink hover:bg-neutral-50'); ?>" aria-label="Mesajlar">
                    <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" /></svg>
                    <span class="<?php echo e(request()->routeIs('messages.index') ? 'font-semibold' : 'font-normal'); ?>">Mesaj</span>
                </a>

                <a href="<?php echo e(route('profile.index')); ?>" class="flex flex-col items-center justify-center gap-1.5 px-3 py-2 rounded-3xl text-[0.6rem] font-medium transition-all <?php echo e(request()->routeIs('profile.index') || request()->routeIs('profile.edit') || request()->routeIs('profiles.show') ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-ink-muted hover:text-ink hover:bg-neutral-50'); ?>" aria-label="Profil">
                    <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="9" cy="7" r="4" /><path d="M23 21v-2a4 4 0 0 0-3-3.87" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /></svg>
                    <span class="<?php echo e(request()->routeIs('profile.index') || request()->routeIs('profile.edit') || request()->routeIs('profiles.show') ? 'font-semibold' : 'font-normal'); ?>">Profil</span>
                </a>

                <a href="<?php echo e(route('settings.edit')); ?>" class="flex flex-col items-center justify-center gap-1.5 px-3 py-2 rounded-3xl text-[0.6rem] font-medium transition-all <?php echo e(request()->routeIs('settings.edit') ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-ink-muted hover:text-ink hover:bg-neutral-50'); ?>" aria-label="Ayarlar">
                    <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" /></svg>
                    <span class="<?php echo e(request()->routeIs('settings.edit') ? 'font-semibold' : 'font-normal'); ?>">Ayar</span>
                </a>
                    <?php if(auth()->check() && auth()->user()?->gender?->value === 'male'): ?>
                        <a href="<?php echo e(route('premium.index')); ?>" class="flex flex-col items-center justify-center gap-1.5 px-3 py-2 rounded-3xl text-[0.6rem] font-medium transition-all <?php echo e(request()->routeIs('premium.index') ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-ink-muted hover:text-ink hover:bg-neutral-50'); ?>" aria-label="Premium">
                            <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><circle cx="12" cy="12" r="10" /><path d="M12 2a10 10 0 0 0-10 10A10 10 0 0 0 12 2zM12 12c-4.41 0-8 3.59-8 8s3.59 8 8 8 8-3.59 8-8-3.59-8-8-8Z" /></svg>
                            <span class="<?php echo e(request()->routeIs('premium.index') ? 'font-semibold' : 'font-normal'); ?>">Premium</span>
                        </a>
                    <?php endif; ?>
            </div>
        </nav>
    <?php endif; ?>

    <?php echo $__env->yieldPushContent('modals'); ?>
    <?php echo $__env->yieldPushContent('scripts'); ?>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html><?php /**PATH /home/gonulkop/public_html/resources/views/components/layouts/app.blade.php ENDPATH**/ ?>