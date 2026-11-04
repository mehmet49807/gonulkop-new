<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'items' => null,
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
    'items' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $items ??= [
        [
            'label' => 'Akış',
            'route' => 'feed.index',
            'icon' => 'home',
        ],
        [
            'label' => 'Keşfet',
            'route' => Route::has('discover.index') ? 'discover.index' : 'discover',
            'icon' => 'discover',
        ],
        [
            'label' => 'Mesajlar',
            'route' => 'messages.index',
            'icon' => 'chat',
        ],
        [
            'label' => 'Profil',
            'route' => Route::has('profile.index') ? 'profile.index' : 'profile.edit',
            'icon' => 'profile',
        ],
        [
            'label' => 'Ayarlar',
            'route' => Route::has('settings.edit') ? 'settings.edit' : '#',
            'icon' => 'settings',
        ],
    ];
    $columnClass = count($items) === 3 ? 'grid-cols-3' : 'grid-cols-5';
?>

<nav
    aria-label="Ana gezinme"
    <?php echo e($attributes->merge(['class' => 'safe-bottom fixed inset-x-0 bottom-0 z-50 border-t border-line/80 bg-white/95 px-2 pt-1.5 shadow-[0_-8px_30px_oklch(0.22_0.02_280/0.08)] backdrop-blur-xl lg:hidden'])); ?>

>
    <div class="mx-auto grid max-w-xl <?php echo e($columnClass); ?>">
        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $isActive = request()->routeIs($item['route']);
                $href = Route::has($item['route']) ? route($item['route']) : '#';
            ?>

            <a
                href="<?php echo e($href); ?>"
                <?php if(! Route::has($item['route'])): ?> aria-disabled="true" <?php endif; ?>
                <?php if($isActive): ?> aria-current="page" <?php endif; ?>
                class="group flex min-h-14 flex-col items-center justify-center gap-0.5 rounded-2xl text-[0.6875rem] font-medium transition <?php echo e($isActive ? 'text-brand-700' : 'text-muted hover:text-ink'); ?>"
            >
                <span class="grid size-8 place-items-center rounded-xl transition <?php echo e($isActive ? 'bg-brand-50' : 'group-hover:bg-canvas'); ?>">
                    <?php switch($item['icon']):
                        case ('home'): ?>
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] <?php echo e($isActive ? 'fill-brand-100' : 'fill-none'); ?>" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955a1.126 1.126 0 0 1 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75" />
                            </svg>
                            <?php break; ?>

                        <?php case ('discover'): ?>
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] <?php echo e($isActive ? 'fill-brand-100' : 'fill-none'); ?>" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <circle cx="12" cy="12" r="8.25" />
                                <path stroke-linecap="round" d="m15.25 8.75-2.1 4.4-4.4 2.1 2.1-4.4 4.4-2.1Z" />
                            </svg>
                            <?php break; ?>

                        <?php case ('chat'): ?>
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] <?php echo e($isActive ? 'fill-brand-100' : 'fill-none'); ?>" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12c0 4.556-4.03 8.25-9 8.25a9.764 9.764 0 0 1-2.555-.337A5.972 5.972 0 0 1 5.41 20.97a5.969 5.969 0 0 1-.474-.065 4.48 4.48 0 0 0 .978-2.025c.09-.457-.133-.901-.467-1.226C3.93 16.178 3 14.189 3 12c0-4.556 4.03-8.25 9-8.25s9 3.694 9 8.25Z" />
                            </svg>
                            <?php break; ?>

                        <?php case ('profile'): ?>
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] <?php echo e($isActive ? 'fill-brand-100' : 'fill-none'); ?>" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                            <?php break; ?>

                        <?php case ('settings'): ?>
                            <svg viewBox="0 0 24 24" class="size-[1.375rem] <?php echo e($isActive ? 'fill-brand-100' : 'fill-none'); ?>" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 0 0-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 0 0-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 0 0-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 0 0-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 0 0 1.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065" />
                            </svg>
                            <?php break; ?>
                    <?php endswitch; ?>
                </span>
                <span><?php echo e($item['label']); ?></span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</nav>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/navigation/mobile-nav.blade.php ENDPATH**/ ?>