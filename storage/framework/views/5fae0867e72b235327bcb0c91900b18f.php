<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'compact' => false,
    'inverse' => false,
    'size' => 'md',
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
    'compact' => false,
    'inverse' => false,
    'size' => 'md',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $markClasses = [
        'sm' => 'size-8 rounded-xl',
        'md' => 'size-9 rounded-[0.9rem]',
        'lg' => 'size-12 rounded-2xl',
    ];
    $textSize = $compact ? 'text-base' : 'text-lg';
?>

<span <?php echo e($attributes->merge(['class' => 'inline-flex items-center gap-2.5'])); ?>>
    <span class="<?php echo e($markClasses[$size] ?? $markClasses['md']); ?> relative grid shrink-0 place-items-center overflow-hidden bg-gradient-to-br from-primary-500 via-primary-600 to-secondary-500 shadow-brand">
        <svg viewBox="0 0 32 32" class="size-[78%] text-white" fill="none" aria-hidden="true">
            <path d="M5.5 21.5c0-6 4.3-10.7 10.5-10.7 6.1 0 10.5 4.7 10.5 10.7" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" opacity=".82"/>
            <path d="M9 21.5c0-4.1 2.9-7.2 7-7.2s7 3.1 7 7.2" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" opacity=".52"/>
            <path d="M5.5 21.5h21M8.8 21.5v4.2M16 21.5v4.2M23.2 21.5v4.2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
            <path d="M16 19.2c-1.2-1.1-4.7-3.4-4.7-6.1 0-1.7 1.2-3 2.8-3 1.1 0 1.9.6 2.4 1.2.5-.6 1.3-1.2 2.4-1.2 1.6 0 2.8 1.3 2.8 3 0 2.7-3.5 5-4.7 6.1Z" fill="white"/>
            <circle cx="5.5" cy="21.5" r="1.5" fill="currentColor"/>
            <circle cx="26.5" cy="21.5" r="1.5" fill="currentColor"/>
        </svg>
    </span>

    <?php if (! ($compact)): ?>
        <span class="<?php echo e($textSize); ?> font-black tracking-[-0.035em]
            <?php if($inverse): ?>
                bg-gradient-to-r from-white via-primary-100 to-secondary-200 bg-clip-text text-transparent
            <?php else: ?>
                text-ink
            <?php endif; ?>
        ">Gönül Köprüsü</span>
    <?php endif; ?>
</span>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/brand-logo.blade.php ENDPATH**/ ?>