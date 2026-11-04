<?php
    $label = isset($label) ? $label : '';
    $name = isset($name) ? $name : '';
    $description = isset($description) ? $description : null;
    $checked = isset($checked) ? $checked : false;
?>

<label <?php echo e($attributes->merge(['class' => 'group flex cursor-pointer items-center justify-between gap-5 rounded-2xl border border-line/80 bg-[#fffaf7] p-4 transition hover:border-primary-200 hover:bg-primary-50/40'])); ?>>
    <span class="min-w-0">
        <span class="block text-sm font-bold text-ink"><?php echo e($label); ?></span>
        <?php if($description): ?>
            <span class="mt-1 block text-sm leading-6 text-muted"><?php echo e($description); ?></span>
        <?php endif; ?>
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
        <span class="block h-7 w-12 rounded-full bg-line shadow-inner ring-1 ring-black/5 transition-colors duration-200 peer-checked:bg-brand-600 peer-focus-visible:ring-2 peer-focus-visible:ring-brand-500 peer-focus-visible:ring-offset-2"></span>
        <span class="pointer-events-none absolute top-1 left-1 size-5 rounded-full bg-white shadow-sm transition-transform duration-200 peer-checked:translate-x-5"></span>
    </span>
</label><?php /**PATH /home/gonulkop/public_html/resources/views/components/ui/toggle.blade.php ENDPATH**/ ?>