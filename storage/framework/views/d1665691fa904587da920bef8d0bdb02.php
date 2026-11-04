<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'activeUser' => null,
    'messages' => [],
    'trialExpired' => false,
    'premiumRequired' => false,
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
    'activeUser' => null,
    'messages' => [],
    'trialExpired' => false,
    'premiumRequired' => false,
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $activeUserData = $activeUser instanceof Illuminate\Database\Eloquent\Model ? $activeUser->getAttributes() : $activeUser;
    $activeUserId = data_get($activeUserData, 'id');
    $activeUserName = data_get($activeUserData, 'name') ?: 'Gönülkop üyesi';
    $activeUserImage = data_get($activeUserData, 'avatar_url') ?: data_get($activeUserData, 'profile_photo_path') ?: data_get($activeUserData, 'avatar_path') ?: data_get($activeUserData, 'profile_image') ?: data_get($activeUserData, 'image_path');
    $viewer = auth()->user();
    $viewerGender = $viewer?->gender;
    $viewerGender = $viewerGender instanceof BackedEnum ? $viewerGender->value : $viewerGender;
    $sendBlocked = (bool) $premiumRequired || ((bool) $trialExpired && $viewerGender === 'male');
    $storeUrl = $activeUserId && Route::has('messages.store') ? route('messages.store', $activeUserId) : '#';
    $pollUrl = $activeUserId && Route::has('messages.show') ? route('messages.show', $activeUserId) : null;
?>

<section
    data-chat
    data-chat-poll-url="<?php echo e($pollUrl); ?>"
    data-chat-user-id="<?php echo e($activeUserId); ?>"
    data-current-user-id="<?php echo e(auth()->id()); ?>"
    class="flex min-h-0 flex-1 flex-col bg-canvas/45"
    aria-label="<?php echo e($activeUserName); ?> ile sohbet"
>
    <header class="relative z-10 flex min-h-[4.75rem] shrink-0 items-center gap-3 border-b border-line/60 bg-white/95 px-3 backdrop-blur-xl sm:px-5">
        <?php if(Route::has('messages.index')): ?>
            <a href="<?php echo e(route('messages.index')); ?>" class="tap-target -ml-2 grid size-10 shrink-0 place-items-center rounded-full text-ink-muted transition hover:bg-canvas hover:text-brand-700 lg:hidden" aria-label="Sohbetlere dön">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>
            </a>
        <?php endif; ?>

        <a href="<?php echo e($activeUserId && Route::has('profiles.show') ? route('profiles.show', $activeUserId) : '#'); ?>" class="group flex min-w-0 items-center gap-3 rounded-2xl py-1 pr-2 transition hover:bg-canvas/70">
            <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['src' => $activeUserImage,'name' => $activeUserName,'size' => 'md','status' => 'online']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeUserImage),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($activeUserName),'size' => 'md','status' => 'online']); ?>
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
            <span class="min-w-0">
                <span class="block truncate text-sm font-extrabold tracking-tight text-ink transition group-hover:text-brand-700"><?php echo e($activeUserName); ?></span>
                <span class="mt-0.5 flex items-center gap-1.5 text-[0.6875rem] font-semibold text-emerald-600">
                    <span class="size-1.5 rounded-full bg-emerald-500" aria-hidden="true"></span>
                    Çevrimiçi
                </span>
            </span>
        </a>

        <span class="ml-auto hidden items-center gap-1.5 rounded-full bg-brand-50 px-3 py-1.5 text-[0.6875rem] font-bold text-brand-700 sm:inline-flex">
            <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 20h.01" />
            </svg>
            Güvenli sohbet
        </span>
    </header>

    <?php if($sendBlocked): ?>
        <div class="flex items-start gap-3 border-b border-amber-200/80 bg-[#fffaf0] px-4 py-3 text-amber-950 sm:px-6" role="status">
            <span class="mt-0.5 grid size-9 shrink-0 place-items-center rounded-xl bg-amber-100 text-amber-700">
                <svg viewBox="0 0 24 24" class="size-5" fill="currentColor" aria-hidden="true">
                    <path d="M12 2.25l2.196 4.448 4.912.714-3.554 3.463.839 4.886L12 13.805l-4.393 2.306.839-4.886-3.554-3.463 4.912-.714L12 2.25z" />
                </svg>
            </span>
            <div class="min-w-0 flex-1 text-sm leading-5">
                <p class="font-extrabold">Deneme süren doldu</p>
                <p class="mt-0.5 text-amber-900/75">Yeni mesaj göndermek için Premium üyeliğe geçmelisin.</p>
            </div>
            <button type="button" class="tap-target -my-2 -mr-2 grid size-10 shrink-0 place-items-center rounded-full text-amber-700 transition hover:bg-amber-100" data-premium-open aria-label="Premium seçeneklerini aç">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </button>
        </div>
    <?php endif; ?>

    <div
        data-chat-messages
        class="scrollbar-refined min-h-0 flex-1 overflow-y-auto overscroll-contain bg-canvas/45 px-3 py-5 sm:px-6 sm:py-6"
        role="log"
        aria-live="polite"
        aria-relevant="additions"
        tabindex="0"
    >
        <div class="mx-auto flex max-w-2xl flex-col gap-3.5">
            <?php $__empty_1 = true; $__currentLoopData = ($messages ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $sender = data_get($message, 'sender');
                    $senderId = data_get($message, 'sender_id') ?: data_get($sender, 'id');
                    $isMine = auth()->check() && (string) $senderId === (string) auth()->id();
                    $content = data_get($message, 'content');
                    $createdAt = data_get($message, 'created_at');
                    $attachment = data_get($message, 'attachment_url') ?: data_get($message, 'attachment_path');

                    if ($createdAt instanceof DateTimeInterface) {
                        $createdAt = $createdAt->format('H:i');
                    }

                    if ($attachment && ! Illuminate\Support\Str::startsWith($attachment, ['http://', 'https://', '/', 'data:', 'blob:'])) {
                        $attachment = asset('storage/'.$attachment);
                    }
                ?>

                <article data-message-id="<?php echo e(data_get($message, 'id')); ?>" class="flex <?php echo e($isMine ? 'justify-end' : 'justify-start'); ?>">
                    <div class="max-w-[85%] sm:max-w-[72%]">
                        <div class="rounded-2xl px-4 py-3 text-sm leading-6 shadow-sm <?php echo e($isMine ? 'rounded-br-md bg-brand-600 text-white' : 'rounded-bl-md border border-line/70 bg-white text-ink'); ?>">
                            <?php if($attachment): ?>
                                <a href="<?php echo e($attachment); ?>" target="_blank" rel="noopener" class="mb-2 block overflow-hidden rounded-xl border <?php echo e($isMine ? 'border-white/20' : 'border-line'); ?>">
                                    <img src="<?php echo e($attachment); ?>" alt="Ek dosya" class="max-h-72 w-full object-cover" loading="lazy">
                                </a>
                            <?php endif; ?>
                            <?php if($content): ?>
                                <p class="whitespace-pre-wrap break-words"><?php echo e($content); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if($createdAt): ?>
                            <p class="mt-1 px-1 text-[0.6875rem] text-ink-muted <?php echo e($isMine ? 'text-right' : 'text-left'); ?>"><?php echo e($createdAt); ?></p>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="flex flex-col items-center justify-center py-12 text-center">
                    <span class="grid size-14 place-items-center rounded-2xl bg-brand-100/70 text-brand-600">
                        <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                    </span>
                    <p class="mt-4 text-sm font-extrabold text-ink">Sohbeti başlatın</p>
                    <p class="mt-1 max-w-xs text-xs leading-5 text-ink-muted">İlk mesajınızı yazarak tanışmayı başlatın.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <form
        data-chat-form
        data-premium-required="<?php echo e($sendBlocked ? 'true' : 'false'); ?>"
        method="POST"
        action="<?php echo e($storeUrl); ?>"
        enctype="multipart/form-data"
        class="shrink-0 border-t border-line/70 bg-white/95 px-3 pt-3 pb-[calc(env(safe-area-inset-bottom)+5rem)] backdrop-blur-xl sm:px-5"
    >
        <?php echo csrf_field(); ?>
        <div class="mx-auto flex max-w-2xl items-end gap-2 rounded-[1.35rem] border border-line/80 bg-canvas/70 p-2 shadow-sm">
            <label class="tap-target grid size-10 shrink-0 cursor-pointer place-items-center rounded-full text-ink-muted transition hover:bg-white hover:text-brand-700" aria-label="Dosya ekle">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m18.375 12.739-7.693 7.693a4.5 4.5 0 0 1-6.364-6.364l10.94-10.94A3 3 0 1 1 19.5 7.372L8.552 18.32m.009-.01-.01.01m5.699-9.941-7.81 7.81a1.5 1.5 0 0 0 2.112 2.13" />
                </svg>
                <input data-chat-file type="file" name="attachment" accept="image/*,application/pdf" class="sr-only">
            </label>

            <div class="min-w-0 flex-1">
                <div data-file-preview class="mb-2 hidden items-center gap-3 rounded-xl border border-line bg-white p-2" aria-live="polite">
                    <img data-file-preview-image class="size-12 rounded-lg object-cover" alt="Ek dosya önizlemesi" hidden>
                    <span data-file-preview-name class="min-w-0 flex-1 truncate text-xs font-semibold text-ink"></span>
                    <button type="button" data-file-preview-remove class="tap-target grid size-8 place-items-center rounded-full text-ink-muted transition hover:bg-canvas hover:text-ink" aria-label="Eki kaldır">
                        <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <label for="chat-content" class="sr-only">Mesajınız</label>
                <textarea
                    id="chat-content"
                    name="content"
                    rows="1"
                    maxlength="5000"
                    class="form-control max-h-36 min-h-11 resize-none border-transparent bg-transparent py-2.5 shadow-none focus:border-brand-200 focus:ring-4 focus:ring-brand-500/10"
                    placeholder="Bir mesaj yazın..."
                    required
                ></textarea>
            </div>

            <button type="submit" class="tap-target grid size-11 shrink-0 place-items-center rounded-full bg-brand-600 text-white shadow-[0_8px_20px_rgba(255,86,112,0.28)] transition hover:bg-brand-700 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-brand-500 focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50" aria-label="Mesajı gönder">
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                </svg>
            </button>
        </div>
    </form>
</section>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/chat/message-thread.blade.php ENDPATH**/ ?>