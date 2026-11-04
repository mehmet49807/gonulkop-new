<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'conversations' => [],
    'emptyAction' => null,
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
    'conversations' => [],
    'emptyAction' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div <?php echo e($attributes->merge(['class' => 'flex h-full min-h-0 flex-col bg-white lg:border-r lg:border-line/70'])); ?>>
    <div class="shrink-0 border-b border-line/60 bg-white px-4 py-4 sm:px-5">
        <div class="flex items-center justify-between gap-3">
            <div>
                <p class="text-[0.65rem] font-bold uppercase tracking-[0.18em] text-brand-600">Konuşmalar</p>
                <h2 class="mt-1 text-lg font-extrabold tracking-tight text-ink">Sohbetler</h2>
            </div>
            <span class="grid min-w-7 place-items-center rounded-full bg-brand-50 px-2 py-1 text-[0.6875rem] font-bold text-brand-700">
                <?php echo e(count($conversations ?? [])); ?>

            </span>
        </div>
    </div>

    <div class="scrollbar-refined min-h-0 flex-1 overflow-y-auto overscroll-contain p-2.5 sm:p-3">
        <?php $__empty_1 = true; $__currentLoopData = ($conversations ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $conversation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <?php
                $participant = data_get($conversation, 'user')
                    ?: data_get($conversation, 'participant')
                    ?: data_get($conversation, 'other_user')
                    ?: $conversation;
                $participantData = $participant instanceof Illuminate\Database\Eloquent\Model ? $participant->getAttributes() : $participant;
                $participantId = data_get($participantData, 'id') ?: data_get($conversation, 'user_id');
                $name = data_get($participantData, 'name') ?: data_get($conversation, 'name') ?: 'Gönülkop üyesi';
                $displayName = data_get($participantData, 'username') ?: data_get($conversation, 'username') ?: $name;
                $image = data_get($participantData, 'avatar_url') ?: data_get($participantData, 'profile_photo_path') ?: data_get($participantData, 'avatar_path') ?: data_get($participantData, 'profile_image') ?: data_get($participantData, 'image_path');
                $lastMessage = data_get($conversation, 'last_message') ?: data_get($conversation, 'latest_message') ?: data_get($conversation, 'message');
                $preview = is_string($lastMessage) ? $lastMessage : (data_get($lastMessage, 'content') ?: data_get($conversation, 'preview') ?: 'Sohbeti açın');
                $unreadCount = (int) (data_get($conversation, 'unread_count') ?: data_get($conversation, 'unread_messages_count') ?: 0);
                $updatedAt = data_get($conversation, 'updated_at') ?: data_get($conversation, 'last_message_at') ?: data_get($conversation, 'created_at');

                if ($image && ! Illuminate\Support\Str::startsWith($image, ['http://', 'https://', '/', 'data:', 'blob:'])) {
                    $image = asset('storage/'.$image);
                }

                if ($updatedAt instanceof DateTimeInterface) {
                    $updatedAt = $updatedAt->diffForHumans();
                }

                $href = $participantId && Route::has('messages.show') ? route('messages.show', $participantId) : '#';
                $isActive = request()->route('user') && (string) request()->route('user') === (string) $participantId;
            ?>

            <a
                href="<?php echo e($href); ?>"
                class="group relative mb-1.5 flex min-h-[4.75rem] items-center gap-3 overflow-hidden rounded-2xl px-3 py-3 transition duration-200 hover:bg-canvas <?php echo e($isActive ? 'bg-brand-50 ring-1 ring-brand-100' : ''); ?>"
                <?php if($isActive): ?> aria-current="page" <?php endif; ?>
            >
                <?php if($isActive): ?>
                    <span class="absolute inset-y-3 left-0 w-1 rounded-r-full bg-brand-500" aria-hidden="true"></span>
                <?php endif; ?>

                <span class="relative shrink-0">
                    <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['src' => $image,'name' => $name,'size' => 'md']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($image),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($name),'size' => 'md']); ?>
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
                    <?php if($unreadCount > 0): ?>
                        <span class="absolute -top-0.5 -right-0.5 size-3 rounded-full border-2 border-white bg-brand-500" aria-hidden="true"></span>
                    <?php endif; ?>
                </span>

                <span class="min-w-0 flex-1">
                    <span class="flex items-center justify-between gap-3">
                        <span class="truncate text-sm font-bold text-ink group-hover:text-brand-700"><?php echo e($displayName); ?></span>
                        <?php if($updatedAt): ?>
                            <span class="shrink-0 text-[0.6875rem] font-medium text-ink-muted"><?php echo e($updatedAt); ?></span>
                        <?php endif; ?>
                    </span>
                    <span class="mt-1 flex items-center justify-between gap-3">
                        <span class="truncate text-xs leading-5 text-ink-muted"><?php echo e($preview); ?></span>
                        <?php if($unreadCount > 0): ?>
                            <span class="grid min-w-5 shrink-0 place-items-center rounded-full bg-brand-600 px-1.5 py-0.5 text-[0.625rem] font-bold text-white shadow-sm">
                                <?php echo e($unreadCount > 99 ? '99+' : $unreadCount); ?>

                            </span>
                        <?php endif; ?>
                    </span>
                </span>
            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <?php if (isset($component)) { $__componentOriginal3607a477fdef7402bc742abad5df9c51 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3607a477fdef7402bc742abad5df9c51 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.empty-state','data' => ['title' => 'Henüz sohbet yok','description' => 'Keşfet bölümünden biriyle tanışın, mesajlar burada görünecek.','icon' => 'message']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Henüz sohbet yok','description' => 'Keşfet bölümünden biriyle tanışın, mesajlar burada görünecek.','icon' => 'message']); ?>
                <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => $emptyAction ?? route('discover.index'),'variant' => 'secondary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($emptyAction ?? route('discover.index')),'variant' => 'secondary','size' => 'sm']); ?>Keşfetmeye başla <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3607a477fdef7402bc742abad5df9c51)): ?>
<?php $attributes = $__attributesOriginal3607a477fdef7402bc742abad5df9c51; ?>
<?php unset($__attributesOriginal3607a477fdef7402bc742abad5df9c51); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3607a477fdef7402bc742abad5df9c51)): ?>
<?php $component = $__componentOriginal3607a477fdef7402bc742abad5df9c51; ?>
<?php unset($__componentOriginal3607a477fdef7402bc742abad5df9c51); ?>
<?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/chat/conversation-list.blade.php ENDPATH**/ ?>