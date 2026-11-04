<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => 'Gönül Köprüsü — Tanışmanın en doğal yolu',
    'description' => 'Şehirlerden ve samimi hikâyelerden başlayan güvenli ve gerçek tanışmalar keşfet.',
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
    'title' => 'Gönül Köprüsü — Tanışmanın en doğal yolu',
    'description' => 'Şehirlerden ve samimi hikâyelerden başlayan güvenli ve gerçek tanışmalar keşfet.',
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
    <meta name="theme-color" content="#fffaf8">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e($title); ?></title>
    <meta name="description" content="<?php echo e($description); ?>">

    <?php echo app('Illuminate\Foundation\Vite')->fonts(); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    <?php echo $__env->yieldPushContent('head'); ?>
</head>
<body class="min-h-[dvh] bg-white text-ink antialiased">
    <div class="flex min-h-[dvh] flex-col overflow-x-hidden">
        <header class="sticky top-0 z-50 border-b border-white/70 bg-white/85 backdrop-blur-xl">
            <nav class="mx-auto flex min-h-18 max-w-7xl items-center justify-between gap-4 px-4 sm:px-6 lg:px-8" aria-label="Ana menü">
                <a href="<?php echo e(route('home')); ?>" class="shrink-0" aria-label="Gönül Köprüsü ana sayfa">
                    <?php if (isset($component)) { $__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.brand-logo','data' => ['size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('brand-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md']); ?>
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

                <div class="hidden items-center gap-8 md:flex">
                    <a href="#nasil-calisir" class="text-sm font-medium text-ink-muted transition hover:text-ink">Nasıl çalışır?</a>
                    <a href="#ozellikler" class="text-sm font-medium text-ink-muted transition hover:text-ink">Özellikler</a>
                    <a href="#guvenlik" class="text-sm font-medium text-ink-muted transition hover:text-ink">Güvenlik</a>
                </div>

                <div class="flex shrink-0 items-center gap-2">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('feed.index')); ?>" class="inline-flex min-h-11 items-center justify-center rounded-full bg-brand-600 px-5 text-sm font-semibold text-white shadow-lg shadow-brand-200 transition hover:-translate-y-0.5 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                            Akışı keşfet
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('login')); ?>" class="hidden min-h-11 items-center justify-center rounded-full px-4 text-sm font-semibold text-ink transition hover:bg-brand-50 sm:inline-flex">Giriş yap</a>
                        <a href="<?php echo e(route('register')); ?>" class="inline-flex min-h-11 items-center justify-center rounded-full bg-brand-600 px-5 text-sm font-semibold text-white shadow-lg shadow-brand-200 transition hover:-translate-y-0.5 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2">
                            Ücretsiz başla
                        </a>
                    <?php endif; ?>
                </div>
            </nav>
        </header>

        <main class="flex-1">
            <?php echo e($slot); ?>

        </main>

        <footer class="border-t border-line/70 bg-neutral-50/70">
            <div class="mx-auto flex max-w-7xl flex-col gap-8 px-4 py-10 sm:px-6 md:flex-row md:items-end md:justify-between lg:px-8">
                <div>
                    <?php if (isset($component)) { $__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.brand-logo','data' => ['size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('brand-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'md']); ?>
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
                    <p class="mt-3 max-w-sm text-sm leading-6 text-ink-muted">Samimi, güvenli ve karşılıklı saygıya dayalı tanışmalar için yeni bir alan.</p>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-8">
                    <div class="flex flex-wrap gap-x-5 gap-y-2 text-sm text-ink-muted">
                        <a href="#ozellikler" class="transition hover:text-ink">Özellikler</a>
                        <a href="#guvenlik" class="transition hover:text-ink">Güvenlik</a>
                        <a href="<?php echo e(route('home')); ?>#nasil-calisir" class="transition hover:text-ink">Nasıl çalışır?</a>
                    </div>
                    <p class="text-xs text-ink-subtle">© <?php echo e(now()->year); ?> Gönül Köprüsü</p>
                </div>
            </div>
        </footer>
    </div>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/layouts/marketing.blade.php ENDPATH**/ ?>