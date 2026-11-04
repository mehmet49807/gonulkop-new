<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label',
    'description',
    'checked' => false,
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
    'name',
    'label',
    'description',
    'checked' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<label <?php echo e($attributes->merge(['class' => 'group flex cursor-pointer items-center justify-between gap-5 rounded-2xl border border-line/80 bg-[#fffaf7] p-4 transition hover:border-primary-200 hover:bg-primary-50/40'])); ?>>
    <span class="min-w-0">
        <span class="block text-sm font-bold text-ink"><?php echo e($label); ?></span>
        <span class="mt-1 block text-sm leading-6 text-muted"><?php echo e($description); ?></span>
    </span>

    <span class="relative shrink-0">
        <input type="hidden" name="<?php echo e($name); ?>" value="0">
        <input
            type="checkbox"
            name="<?php echo e($name); ?>"
            value="1"
            <?php if($checked): echo 'checked'; endif; ?>
            class="peer sr-only"
            aria-label="<?php echo e($label); ?>"
        >
        <span class="block h-7 w-12 rounded-full bg-line shadow-inner ring-1 ring-black/5 transition-colors duration-200 peer-checked:bg-primary-600 peer-focus-visible:ring-2 peer-focus-visible:ring-primary-500 peer-focus-visible:ring-offset-2"></span>
        <span class="pointer-events-none absolute top-1 left-1 size-5 rounded-full bg-white shadow-sm transition-transform duration-200 peer-checked:translate-x-5"></span>
    </span>
</label>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/settings/toggle.blade.php ENDPATH**/ ?>