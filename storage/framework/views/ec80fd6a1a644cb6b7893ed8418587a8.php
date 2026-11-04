<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'stories' => [],
    'privacyMode' => false,
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
    'stories' => [],
    'privacyMode' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'border-y border-line/60 bg-white/65'])); ?>>
    <div class="mx-auto max-w-2xl px-3 sm:px-5">
        <div class="flex items-center justify-between gap-4 pt-5 sm:pt-6">
            <div>
                <p class="text-xs font-bold tracking-[0.16em] text-brand-600 uppercase">Hikâyeler</p>
                <p class="mt-1 text-sm font-semibold text-ink">Çevrenden bugün</p>
            </div>
            <span class="rounded-full bg-brand-50 px-3 py-1.5 text-xs font-bold text-brand-700">
                <?php echo e(count($stories)); ?> hikâye
            </span>
        </div>

        <div class="no-scrollbar -mx-1 flex snap-x gap-4 overflow-x-auto px-1 pb-5 pt-4 sm:gap-5 sm:pb-6" role="list" aria-label="Hikâyeler">
            <?php $__empty_1 = true; $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $storyData = $story instanceof Illuminate\Database\Eloquent\Model ? $story->getAttributes() : $story;
                    $storyUser = data_get($story, 'user') ?: $storyData;
                    $storyUserData = $storyUser instanceof Illuminate\Database\Eloquent\Model ? $storyUser->getAttributes() : $storyUser;
                    $storyName = $privacyMode
                        ? (data_get($storyUserData, 'username') ?: 'Kullanıcı')
                        : (data_get($storyData, 'name') ?: (data_get($storyUserData, 'name') ?: data_get($storyUserData, 'username') ?: 'Kullanıcı'));
                    $storyImage = data_get($storyData, 'image_path') ?: data_get($storyData, 'image') ?: (data_get($storyUserData, 'avatar_url') ?: data_get($storyUserData, 'profile_photo_path') ?: data_get($storyUserData, 'avatar_path') ?: data_get($storyUserData, 'profile_image') ?: data_get($storyUserData, 'image_path') ?: null);
                    $storyHref = data_get($story, 'href');

                    if ($storyImage && ! Illuminate\Support\Str::startsWith($storyImage, ['http://', 'https://', '/', 'data:', 'blob:'])) {
                        $storyImage = asset('storage/'.$storyImage);
                    }
                ?>

                <a
                    href="<?php echo e($storyHref ?: '#'); ?>"
                    class="group flex w-[4.5rem] shrink-0 snap-start flex-col items-center gap-2.5 focus-visible:outline-none"
                    role="listitem"
                    <?php if(! $storyHref): ?> aria-disabled="true" <?php endif; ?>
                >
                    <span class="grid size-[4.25rem] place-items-center rounded-full bg-gradient-to-br from-brand-400 via-brand-500 to-accent-400 p-[3px] shadow-brand transition duration-200 group-hover:-translate-y-0.5 group-hover:shadow-lg group-focus-visible:ring-2 group-focus-visible:ring-brand-500 group-focus-visible:ring-offset-2">
                        <span class="grid size-full place-items-center rounded-full bg-white p-[3px]">
                            <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['src' => $storyImage,'name' => $storyName,'size' => 'lg','class' => 'ring-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($storyImage),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($storyName),'size' => 'lg','class' => 'ring-0']); ?>
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
                        </span>
                    </span>
                    <span class="w-full truncate text-center text-xs font-bold text-ink"><?php echo e($storyName); ?></span>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="flex w-full items-center gap-3 py-3 text-sm text-ink-muted">
                    <span class="grid size-12 shrink-0 place-items-center rounded-2xl bg-brand-50 text-brand-600">
                        <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5c-1.5-1.5-4.087-1.5-5.586 0L4.5 6.414A3.92 3.92 0 0 0 3 9.172V19.5A1.5 1.5 0 0 0 4.5 21h15a1.5 1.5 0 0 0 1.5-1.5V9.172a3.92 3.92 0 0 0-1.5-2.758l-1.914-1.914C16.087 3 13.5 3 12 4.5Z" />
                        </svg>
                    </span>
                    <span class="font-medium">Yeni hikâyeler burada görünecek.</span>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/feed/story-strip.blade.php ENDPATH**/ ?>