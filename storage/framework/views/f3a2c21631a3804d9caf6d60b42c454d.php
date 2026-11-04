<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'conversations' => [],
    'activeUser' => null,
    'messages' => [],
    'trialExpired' => false,
    'premiumRequired' => false,
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
    'activeUser' => null,
    'messages' => [],
    'trialExpired' => false,
    'premiumRequired' => false,
    'emptyAction' => null,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $hasActiveUser = filled($activeUser) && data_get($activeUser, 'id');
    $emptyAction = $emptyAction ?? route('discover.index');
?>

<div
    <?php echo e($attributes->merge(['class' => 'grid h-[calc(100dvh-12.5rem)] min-h-[32rem] overflow-hidden rounded-[1.75rem] border border-line/70 bg-white shadow-[0_18px_55px_rgba(78,35,28,0.08)] lg:grid-cols-[21rem_minmax(0,1fr)]'])); ?>

>
    <div class="<?php echo e($hasActiveUser ? 'hidden lg:block' : 'block'); ?> min-h-0 min-w-0">
        <?php if (isset($component)) { $__componentOriginaleba3512b75a5549b9960eb9e86133b0a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleba3512b75a5549b9960eb9e86133b0a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.chat.conversation-list','data' => ['conversations' => $conversations,'emptyAction' => $emptyAction]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('chat.conversation-list'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['conversations' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($conversations),'empty-action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($emptyAction)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleba3512b75a5549b9960eb9e86133b0a)): ?>
<?php $attributes = $__attributesOriginaleba3512b75a5549b9960eb9e86133b0a; ?>
<?php unset($__attributesOriginaleba3512b75a5549b9960eb9e86133b0a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleba3512b75a5549b9960eb9e86133b0a)): ?>
<?php $component = $__componentOriginaleba3512b75a5549b9960eb9e86133b0a; ?>
<?php unset($__componentOriginaleba3512b75a5549b9960eb9e86133b0a); ?>
<?php endif; ?>
    </div>

    <div class="<?php echo e($hasActiveUser ? 'block' : 'hidden lg:flex'); ?> min-h-0 min-w-0">
        <?php if($hasActiveUser): ?>
            <?php if (isset($component)) { $__componentOriginal1acfd946eac1f203d690bcae8f2c5a24 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1acfd946eac1f203d690bcae8f2c5a24 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.chat.message-thread','data' => ['activeUser' => $activeUser,'messages' => $messages,'trialExpired' => $trialExpired,'premiumRequired' => $premiumRequired]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('chat.message-thread'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['active-user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeUser),'messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($messages),'trial-expired' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($trialExpired),'premium-required' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($premiumRequired)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1acfd946eac1f203d690bcae8f2c5a24)): ?>
<?php $attributes = $__attributesOriginal1acfd946eac1f203d690bcae8f2c5a24; ?>
<?php unset($__attributesOriginal1acfd946eac1f203d690bcae8f2c5a24); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1acfd946eac1f203d690bcae8f2c5a24)): ?>
<?php $component = $__componentOriginal1acfd946eac1f203d690bcae8f2c5a24; ?>
<?php unset($__componentOriginal1acfd946eac1f203d690bcae8f2c5a24); ?>
<?php endif; ?>
        <?php else: ?>
            <div class="relative flex min-h-0 flex-1 items-center justify-center overflow-hidden bg-canvas/60 p-6">
                <div class="pointer-events-none absolute -top-20 -right-16 size-64 rounded-full bg-brand-100/50 blur-3xl" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-24 -left-20 size-72 rounded-full bg-secondary-100/70 blur-3xl" aria-hidden="true"></div>

                <?php if (isset($component)) { $__componentOriginal3607a477fdef7402bc742abad5df9c51 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3607a477fdef7402bc742abad5df9c51 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.empty-state','data' => ['title' => 'Bir sohbet seçin','description' => 'Sohbetler listesinden bir kişiye dokunarak konuşmaya başlayın.','icon' => 'message','class' => 'relative']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Bir sohbet seçin','description' => 'Sohbetler listesinden bir kişiye dokunarak konuşmaya başlayın.','icon' => 'message','class' => 'relative']); ?>
                    <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => $emptyAction,'variant' => 'primary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($emptyAction),'variant' => 'primary','size' => 'sm']); ?>
                        Yeni kişi bul
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                     <?php echo $__env->renderComponent(); ?>
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
            </div>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/chat/inbox.blade.php ENDPATH**/ ?>