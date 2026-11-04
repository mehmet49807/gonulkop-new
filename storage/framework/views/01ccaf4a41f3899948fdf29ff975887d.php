<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Akış · Gönülkop','description' => 'Takip ettiğin kişilerin hikâyelerini ve gönderilerini keşfet.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Akış · Gönülkop','description' => 'Takip ettiğin kişilerin hikâyelerini ve gönderilerini keşfet.']); ?>
    <main class="mx-auto max-w-[440px] px-3 sm:px-4" aria-labelledby="feed-title">
        <?php if (isset($component)) { $__componentOriginal2edabb25a7027b380be696833e5ddafa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2edabb25a7027b380be696833e5ddafa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.feed.story-strip','data' => ['stories' => ($stories ?? [])]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feed.story-strip'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['stories' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(($stories ?? []))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2edabb25a7027b380be696833e5ddafa)): ?>
<?php $attributes = $__attributesOriginal2edabb25a7027b380be696833e5ddafa; ?>
<?php unset($__attributesOriginal2edabb25a7027b380be696833e5ddafa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2edabb25a7027b380be696833e5ddafa)): ?>
<?php $component = $__componentOriginal2edabb25a7027b380be696833e5ddafa; ?>
<?php unset($__componentOriginal2edabb25a7027b380be696833e5ddafa); ?>
<?php endif; ?>

        <section class="pb-12 pt-6 sm:pt-8" aria-labelledby="feed-title">
            <div class="mb-4 flex items-end justify-between gap-4 px-1 sm:mb-5 sm:px-2">
                <div>
                    <h2 id="feed-title" class="text-xl font-bold tracking-tight text-ink">Gönderiler</h2>
                </div>
                <span class="inline-flex items-center gap-2 pb-0.5 text-xs font-semibold text-ink-muted sm:text-sm">
                    <span class="size-1.5 rounded-full bg-brand-500" aria-hidden="true"></span>
                    En yeni
                </span>
            </div>

            <?php
                $postItems = is_object($posts) && method_exists($posts, 'items')
                    ? $posts->items()
                    : ($posts instanceof Illuminate\Support\Collection ? $posts->all() : ($posts ?? []));
                $nextFeedUrl = null;

                if (is_object($posts) && method_exists($posts, 'nextPageUrl')) {
                    $nextFeedUrl = $posts->nextPageUrl();
                }

                $feedEndpoint = Route::has('feed.api') ? route('feed.api') : url('/api/feed');
            ?>

            <div
                data-feed-infinite
                data-feed-url="<?php echo e($feedEndpoint); ?>"
                data-next-url="<?php echo e($nextFeedUrl); ?>"
                class="space-y-4 sm:space-y-6"
            >
                <div data-feed-posts class="space-y-4 sm:space-y-6">
                    <?php $__empty_1 = true; $__currentLoopData = $postItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php if (isset($component)) { $__componentOriginal9b8c4c0a5d5528ace8a5978e88aed225 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9b8c4c0a5d5528ace8a5978e88aed225 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.feed.post-card','data' => ['post' => $post]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('feed.post-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['post' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($post)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9b8c4c0a5d5528ace8a5978e88aed225)): ?>
<?php $attributes = $__attributesOriginal9b8c4c0a5d5528ace8a5978e88aed225; ?>
<?php unset($__attributesOriginal9b8c4c0a5d5528ace8a5978e88aed225); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9b8c4c0a5d5528ace8a5978e88aed225)): ?>
<?php $component = $__componentOriginal9b8c4c0a5d5528ace8a5978e88aed225; ?>
<?php unset($__componentOriginal9b8c4c0a5d5528ace8a5978e88aed225); ?>
<?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="rounded-[1.5rem] border border-line bg-white shadow-sm" data-feed-empty>
                            <?php if (isset($component)) { $__componentOriginal3607a477fdef7402bc742abad5df9c51 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3607a477fdef7402bc742abad5df9c51 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.empty-state','data' => ['title' => 'Akış henüz sakin','description' => 'Yeni hikâyeler ve gönderiler yayımlandığında burada görünecek.','icon' => 'message']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Akış henüz sakin','description' => 'Yeni hikâyeler ve gönderiler yayımlandığında burada görünecek.','icon' => 'message']); ?>
                                <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => route('discover.index'),'variant' => 'secondary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('discover.index')),'variant' => 'secondary','size' => 'sm']); ?>Kişileri keşfet <?php echo $__env->renderComponent(); ?>
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

                <div data-feed-sentinel class="grid min-h-24 place-items-center py-4" aria-hidden="true"></div>

                <div data-feed-status class="min-h-6 text-center text-xs font-medium text-ink-muted" role="status" aria-live="polite"></div>

                <div data-feed-error class="hidden text-center" role="alert">
                    <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'button','variant' => 'secondary','size' => 'sm','dataFeedRetry' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'button','variant' => 'secondary','size' => 'sm','data-feed-retry' => true]); ?>Tekrar dene <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                </div>
            </div>
        </section>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH /home/gonulkop/public_html/resources/views/feed/index.blade.php ENDPATH**/ ?>