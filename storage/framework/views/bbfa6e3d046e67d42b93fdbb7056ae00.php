<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title',
    'description',
    'icon' => 'sparkles',
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
    'title',
    'description',
    'icon' => 'sparkles',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'flex flex-col items-center px-6 py-14 text-center'])); ?>>
    <span class="mb-5 grid size-16 place-items-center rounded-3xl bg-brand-50 text-brand-600">
        <?php switch($icon):
            case ('message'): ?>
                <svg viewBox="0 0 24 24" class="size-7" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12h.008v.008H8.625V12Zm0 3.75h.008v.008H8.625v-.008Zm0-7.5h.008v.008H8.625v-.008Zm6.75 7.5h.008v.008h-.008V15.75Zm0-3.75h.008v.008h-.008V12Zm0-3.75h.008v.008h-.008V8.25Z" />
                </svg>
                <?php break; ?>

            <?php default: ?>
                <svg viewBox="0 0 24 24" class="size-7" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z" />
                </svg>
                <?php break; ?>
        <?php endswitch; ?>
    </span>

    <h2 class="text-lg font-semibold tracking-tight text-ink"><?php echo e($title); ?></h2>
    <p class="mt-2 max-w-sm text-sm leading-6 text-muted"><?php echo e($description); ?></p>

    <?php if(! $slot->isEmpty()): ?>
        <div class="mt-6">
            <?php echo e($slot); ?>

        </div>
    <?php endif; ?>
</div>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/ui/empty-state.blade.php ENDPATH**/ ?>