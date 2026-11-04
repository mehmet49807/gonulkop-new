<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'submit',
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
    'href' => null,
    'variant' => 'primary',
    'size' => 'md',
    'type' => 'submit',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $variants = [
        'primary' => 'bg-brand-600 text-white shadow-brand hover:bg-brand-700 focus-visible:ring-brand-500',
        'secondary' => 'border border-line bg-white text-ink shadow-sm hover:border-brand-200 hover:bg-brand-50 hover:text-brand-800 focus-visible:ring-brand-500',
        'ghost' => 'text-muted hover:bg-canvas hover:text-ink focus-visible:ring-brand-500',
        'danger' => 'bg-red-600 text-white shadow-sm hover:bg-red-700 focus-visible:ring-red-500',
    ];

    $sizes = [
        'sm' => 'min-h-9 px-3.5 py-2 text-xs',
        'md' => 'min-h-11 px-5 py-2.5 text-sm',
        'lg' => 'min-h-12 px-6 py-3 text-base',
    ];

    $classes = 'inline-flex items-center justify-center gap-2 rounded-control font-semibold transition disabled:pointer-events-none disabled:opacity-50 focus-visible:ring-2 focus-visible:ring-offset-2';
    $classes .= ' ' . ($variants[$variant] ?? $variants['primary']);
    $classes .= ' ' . ($sizes[$size] ?? $sizes['md']);
?>

<?php if($href): ?>
    <a href="<?php echo e($href); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button type="<?php echo e($type); ?>" <?php echo e($attributes->merge(['class' => $classes])); ?>>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/ui/button.blade.php ENDPATH**/ ?>