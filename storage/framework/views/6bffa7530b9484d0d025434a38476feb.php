<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'name',
    'label',
    'hint' => null,
    'error' => null,
    'required' => false,
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
    'hint' => null,
    'error' => null,
    'required' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'space-y-2'])); ?>>
    <label for="<?php echo e($name); ?>" class="flex items-center justify-between gap-3 text-sm font-semibold text-ink">
        <span>
            <?php echo e($label); ?>

            <?php if($required): ?>
                <span class="text-brand-600" aria-hidden="true">*</span>
            <?php endif; ?>
        </span>

        <?php if($hint): ?>
            <span class="text-xs font-normal text-muted"><?php echo e($hint); ?></span>
        <?php endif; ?>
    </label>

    <?php echo e($slot); ?>


    <?php if($error): ?>
        <p id="<?php echo e($name); ?>-error" class="text-sm font-medium text-red-600" role="alert">
            <?php echo e($error); ?>

        </p>
    <?php endif; ?>
</div>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/ui/form-field.blade.php ENDPATH**/ ?>