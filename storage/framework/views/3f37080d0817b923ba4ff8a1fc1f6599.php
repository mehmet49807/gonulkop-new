<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'src' => null,
    'name' => 'Kullanıcı',
    'alt' => null,
    'size' => 'md',
    'status' => null,
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
    'src' => null,
    'name' => 'Kullanıcı',
    'alt' => null,
    'size' => 'md',
    'status' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $sizeClasses = [
        'xs' => 'size-8 text-[0.625rem]',
        'sm' => 'size-10 text-xs',
        'md' => 'size-12 text-sm',
        'lg' => 'size-16 text-base',
        'xl' => 'size-24 text-xl',
    ];

    $initials = collect(preg_split('/\s+/', trim($name)))
        ->filter()
        ->take(2)
        ->map(fn (string $part) => mb_strtoupper(mb_substr($part, 0, 1)))
        ->implode('');
    $sizeClass = $sizeClasses[$size] ?? $sizeClasses['md'];
?>

<span <?php echo e($attributes->merge(['class' => 'relative inline-flex shrink-0'])); ?>>
    <?php if($src): ?>
        <img
            src="<?php echo e($src); ?>"
            alt="<?php echo e($alt ?? $name); ?>"
            class="<?php echo e($sizeClass); ?> rounded-full object-cover ring-2 ring-white"
            loading="lazy"
            decoding="async"
        >
    <?php else: ?>
        <span class="<?php echo e($sizeClass); ?> grid place-items-center rounded-full bg-brand-100 font-semibold text-brand-700 ring-2 ring-white" aria-hidden="true">
            <?php echo e($initials); ?>

        </span>
    <?php endif; ?>

    <?php if($status): ?>
        <span class="absolute right-0 bottom-0 size-3 rounded-full border-2 border-white bg-emerald-500" aria-label="Çevrimiçi"></span>
    <?php endif; ?>
</span>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/ui/avatar.blade.php ENDPATH**/ ?>