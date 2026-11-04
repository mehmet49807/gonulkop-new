<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Mesajlar · Gönülkop','description' => 'Gönülkop mesajlarınızı ve sohbetlerinizi yönetin.','showNavigation' => true,'wide' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Mesajlar · Gönülkop','description' => 'Gönülkop mesajlarınızı ve sohbetlerinizi yönetin.','show-navigation' => true,'wide' => true]); ?>
    <?php
        $conversations = $conversations ?? [];
        $activeUser = $activeUser ?? null;
        $messages = $messages ?? [];
        $trialExpired = $trialExpired ?? false;
        $premiumRequired = $premiumRequired ?? false;
    ?>

     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between gap-4 px-4 pt-4 sm:px-5 sm:pt-5">
            <div class="min-w-0">
                <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Bağlantılar</p>
                <h1 class="mt-1 text-lg font-bold tracking-tight text-ink">Mesajlar</h1>
                <p class="mt-1 text-sm text-ink-muted">Sevdiğin kişilerle sıcak ve samimi sohbetler kur.</p>
            </div>
            <?php if($premiumRequired): ?>
                <button type="button" class="tap-target grid size-9 place-items-center rounded-lg border border-amber-200 bg-amber-50 text-amber-700 transition hover:bg-amber-100" data-premium-open aria-label="Premium seçeneklerini aç">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </button>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>

    <main class="bg-white px-4 py-6 sm:px-6 sm:py-8">
        <div class="grid min-h-[calc(100dvh-14rem)] lg:grid-cols-[20rem_minmax(0,1fr)] gap-0">
            <!-- Conversation List (desktop only) -->
            <div class="hidden lg:flex min-h-0 flex-col border-r border-line/60 bg-white">
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

                <div class="min-h-0 flex-1 overflow-y-auto overscroll-contain p-2.5 sm:p-3">
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
                            class="group relative mb-1.5 flex min-h-[4.75rem] items-center gap-3 overflow-hidden rounded-xl px-3 py-3 transition duration-200 hover:bg-neutral-50 <?php echo e($isActive ? 'bg-brand-50 ring-1 ring-brand-100' : ''); ?>"
                            <?php if($isActive): ?> aria-current="page" <?php endif; ?>
                        >
                            <?php if($isActive): ?>
                                <span class="absolute inset-y-3 left-0 w-1 rounded-r-xl bg-brand-500" aria-hidden="true"></span>
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
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <?php if (isset($component)) { $__componentOriginal3607a477fdef7402bc742abad5df9c51 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3607a477fdef7402bc742abad5df9c51 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.empty-state','data' => ['title' => 'Henüz sohbet yok','description' => 'Keşfet bölümünden biriyle tanışın, mesajlar burada görünecek.','icon' => 'message','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Henüz sohbet yok','description' => 'Keşfet bölümünden biriyle tanışın, mesajlar burada görünecek.','icon' => 'message','class' => 'w-full']); ?>
                                <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => route('discover.index'),'variant' => 'secondary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('discover.index')),'variant' => 'secondary','size' => 'sm']); ?>Keşfetmeye başla <?php echo $__env->renderComponent(); ?>
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
            <!-- Active Conversation -->
            <div class="min-h-0 min-w-0 flex flex-col">
                <?php if($activeUser): ?>
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
                    <div class="relative flex min-h-0 flex-1 items-center justify-center overflow-hidden bg-neutral-50/40 p-8">
                        <div class="pointer-events-none absolute -top-20 -right-16 size-64 rounded-full bg-brand-100/40 blur-3xl" aria-hidden="true"></div>
                        <div class="pointer-events-none absolute -bottom-24 -left-20 size-72 rounded-full bg-secondary-100/60 blur-3xl" aria-hidden="true"></div>

                        <div class="relative z-10 flex flex-col items-center justify-center text-center">
                            <svg viewBox="0 0 24 24" class="size-16 text-neutral-300 mb-4" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                            </svg>
                            <h3 class="text-lg font-bold text-ink mb-1">Bir sohbet seçin</h3>
                            <p class="text-sm text-ink-muted">Sohbetler listesinden bir kişiye dokunarak konuşmaya başlayın.</p>
                            <a href="<?php echo e(route('matches.index')); ?>" class="mt-6 inline-flex items-center gap-2 text-sm font-medium text-brand-600 hover:text-brand-700 transition" aria-label="Yeni eşleşme">
                                <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M12 5l7 7-7 7" /></svg>
                                Yeni kişi bul
                            </a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <?php $__env->startPush('modals'); ?>
        <?php if (isset($component)) { $__componentOriginalbe636dfc5c1cb5369ecfdc7df00c8853 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalbe636dfc5c1cb5369ecfdc7df00c8853 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.premium-dialog','data' => ['id' => 'premium-dialog']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.premium-dialog'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'premium-dialog']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalbe636dfc5c1cb5369ecfdc7df00c8853)): ?>
<?php $attributes = $__attributesOriginalbe636dfc5c1cb5369ecfdc7df00c8853; ?>
<?php unset($__attributesOriginalbe636dfc5c1cb5369ecfdc7df00c8853); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalbe636dfc5c1cb5369ecfdc7df00c8853)): ?>
<?php $component = $__componentOriginalbe636dfc5c1cb5369ecfdc7df00c8853; ?>
<?php unset($__componentOriginalbe636dfc5c1cb5369ecfdc7df00c8853); ?>
<?php endif; ?>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?><?php /**PATH /home/gonulkop/public_html/resources/views/messages/index.blade.php ENDPATH**/ ?>