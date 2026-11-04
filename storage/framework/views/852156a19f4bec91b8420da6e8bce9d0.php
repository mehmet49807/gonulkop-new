<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Premium · Gönülkop','description' => 'Gönülkop Premium üyelik paketleri ve avantajları.','wide' => true,'contentClass' => 'bg-[radial-gradient(circle_at_top_left,oklch(0.93_0.06_35/0.55),transparent_35rem)]']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Premium · Gönülkop','description' => 'Gönülkop Premium üyelik paketleri ve avantajları.','wide' => true,'content-class' => 'bg-[radial-gradient(circle_at_top_left,oklch(0.93_0.06_35/0.55),transparent_35rem)]']); ?>
    <?php
        $isPremium = (bool) $member->is_premium;
        $trialExpired = $member->hasExpiredTrial();
        $packageThemes = [
            'silver' => ['icon' => 'silver', 'button' => 'border-line bg-white text-ink hover:border-primary-200 hover:bg-primary-50'],
            'gold' => ['icon' => 'gold', 'button' => 'bg-primary-600 text-white shadow-brand hover:bg-primary-700'],
            'platinum' => ['icon' => 'platinum', 'button' => 'bg-neutral-900 text-white shadow-lg hover:bg-neutral-800'],
            'pro' => ['icon' => 'pro', 'button' => 'bg-gradient-to-r from-primary-600 to-accent-600 text-white shadow-brand hover:opacity-95'],
        ];
    ?>

    <?php if(session('success')): ?>
        <div class="mx-auto mt-5 max-w-5xl rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-900" role="status">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mx-auto mt-5 max-w-5xl rounded-2xl border border-red-200 bg-red-50 px-4 py-3 text-sm font-semibold text-red-900" role="alert">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <section class="relative overflow-hidden px-4 pb-10 pt-10 text-center sm:px-6 sm:pb-14 sm:pt-14">
        <div class="pointer-events-none absolute left-1/2 top-2 size-72 -translate-x-1/2 rounded-full bg-primary-100/50 blur-3xl" aria-hidden="true"></div>

        <div class="relative mx-auto max-w-3xl">
            <span class="inline-flex items-center gap-2 rounded-full border border-accent-200 bg-accent-50 px-3.5 py-1.5 text-xs font-black tracking-[0.14em] text-accent-800 uppercase">
                <svg viewBox="0 0 24 24" class="size-4" fill="currentColor" aria-hidden="true"><path d="m12 3 2.1 4.3 4.7.7-3.4 3.3.8 4.7-4.2-2.2L7.8 16l.8-4.7-3.4-3.3 4.7-.7L12 3Z"/></svg>
                Gönülkop Premium
            </span>

            <h1 class="mt-6 text-balance text-4xl font-black tracking-[-0.05em] text-ink sm:text-6xl">
                Bağlantını <span class="bg-gradient-to-r from-primary-600 to-accent-600 bg-clip-text text-transparent">daha özel</span> kıl.
            </h1>
            <p class="mx-auto mt-5 max-w-2xl text-base leading-7 text-muted sm:text-lg sm:leading-8">
                Daha fazla mesaj, gelişmiş keşif araçları ve profilini öne çıkarma özellikleriyle tanışma deneyimini derinleştir.
            </p>

            <div class="mx-auto mt-7 flex w-fit items-center gap-2 rounded-full border border-line bg-white/80 px-4 py-2 text-sm font-semibold text-ink shadow-sm backdrop-blur">
                <span class="size-2 rounded-full <?php echo e($isPremium ? 'bg-emerald-500' : ($trialExpired ? 'bg-amber-500' : 'bg-primary-500')); ?>"></span>
                <?php if($isPremium): ?>
                    Premium üyeliğiniz etkin
                <?php elseif($trialExpired): ?>
                    Deneme süreniz doldu
                <?php else: ?>
                    Deneme süreniz aktif
                <?php endif; ?>
            </div>
        </div>
    </section>


    <section class="px-4 sm:px-6" aria-labelledby="package-heading">
        <div class="mx-auto max-w-6xl">
            <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
                <div>
                    <p class="text-xs font-black tracking-[0.16em] text-primary-600 uppercase">Size uygun paketi seçin</p>
                    <h2 id="package-heading" class="mt-2 text-2xl font-black tracking-[-0.03em] text-ink sm:text-3xl">Üyelik paketleri</h2>
                </div>
                <p class="max-w-md text-sm leading-6 text-muted">Tüm paketlerde sınırsız mesajlaşma ve gelişmiş filtreleme bulunur.</p>
            </div>

            <div class="mt-7 grid gap-5 md:grid-cols-2 xl:grid-cols-4">
                <?php $__currentLoopData = $packages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $package): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $slug = strtolower($package['name']);
                        $theme = $packageThemes[$slug] ?? $packageThemes['gold'];
                        $isPopular = (bool) ($package['popular'] ?? false);
                    ?>

                    <article class="relative flex h-full flex-col overflow-hidden rounded-[1.75rem] border bg-white p-5 shadow-[0_12px_40px_oklch(0.22_0.018_24/0.07)] transition duration-200 hover:-translate-y-1 hover:shadow-xl sm:p-6 <?php echo e($isPopular ? 'border-primary-300 ring-2 ring-primary-100' : 'border-line/80'); ?>">
                        <?php if($package['badge']): ?>
                            <span class="absolute right-4 top-4 rounded-full bg-accent-100 px-2.5 py-1 text-[0.65rem] font-black tracking-wide text-accent-800 uppercase"><?php echo e($package['badge']); ?></span>
                        <?php endif; ?>

                        <div class="flex items-center gap-3">
                            <span class="grid size-12 shrink-0 place-items-center rounded-2xl <?php echo e($slug === 'platinum' ? 'bg-neutral-900 text-white' : ($slug === 'gold' ? 'bg-accent-100 text-accent-700' : ($slug === 'pro' ? 'bg-gradient-to-br from-primary-500 to-accent-500 text-white' : 'bg-neutral-100 text-neutral-600'))); ?>">
                                <?php if($slug === 'platinum'): ?>
                                    <svg viewBox="0 0 24 24" class="size-6" fill="currentColor" aria-hidden="true"><path d="m12 2 2.4 6.1L21 10l-5.3 4.1L17 21l-5-3.5L7 21l1.3-6.9L3 10l6.6-1.9L12 2Z"/></svg>
                                <?php elseif($slug === 'gold'): ?>
                                    <svg viewBox="0 0 24 24" class="size-6" fill="currentColor" aria-hidden="true"><path d="M3 9h18l-2 11H5L3 9Zm4 0 2-5h6l2 5H7Zm-1 5h2v3H6v-3Zm10 0h2v3h-2v-3Z"/></svg>
                                <?php elseif($slug === 'pro'): ?>
                                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m13 2-9 12h7l-1 8 9-12h-7l1-8Z"/></svg>
                                <?php else: ?>
                                    <svg viewBox="0 0 24 24" class="size-6" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 3 5 6v5c0 4.6 2.9 8.8 7 10 4.1-1.2 7-5.4 7-10V6l-7-3Z"/><path d="m9 12 2 2 4-4"/></svg>
                                <?php endif; ?>
                            </span>
                            <div>
                                <h3 class="text-xl font-black tracking-[-0.02em] text-ink"><?php echo e($package['name_tr']); ?></h3>
                                <p class="text-xs font-bold tracking-wide text-muted uppercase"><?php echo e($package['name']); ?></p>
                            </div>
                        </div>

                        <div class="mt-6 flex items-end gap-1.5">
                            <span class="text-4xl font-black tracking-[-0.04em] text-ink"><?php echo e(number_format($package['price'], 0, ',', '.')); ?></span>
                            <span class="pb-1 text-sm font-bold text-muted"><?php echo e($package['currency']); ?></span>
                        </div>
                        <p class="mt-1 text-sm font-semibold text-muted"><?php echo e($package['duration']); ?> boyunca</p>

                        <ul class="mt-6 flex-1 space-y-3" role="list">
                            <?php $__currentLoopData = $package['features']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="flex items-start gap-2.5 text-sm leading-5 text-ink">
                                    <span class="mt-0.5 grid size-5 shrink-0 place-items-center rounded-full bg-primary-50 text-primary-600">
                                        <svg viewBox="0 0 20 20" class="size-3.5" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="m5 10 3 3 7-7"/></svg>
                                    </span>
                                    <span><?php echo e($feature); ?></span>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>

                        <form method="POST" action="<?php echo e(route('premium.purchase', $slug)); ?>" class="mt-7">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="inline-flex min-h-12 w-full items-center justify-center rounded-xl border px-5 text-sm font-black transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-primary-500 focus-visible:ring-offset-2 <?php echo e($theme['button']); ?>">
                                <?php echo e($isPremium ? 'Bu paketi seç' : 'Paketi aktifleştir'); ?>

                            </button>
                        </form>
                        <p class="mt-2 text-center text-[0.65rem] leading-4 text-muted">Demo aktivasyon · Ödeme altyapısı yakında</p>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>


    <section class="px-4 py-14 sm:px-6 sm:py-20" aria-labelledby="benefits-heading">
        <div class="mx-auto max-w-6xl">
            <div class="text-center">
                <p class="text-xs font-black tracking-[0.16em] text-primary-600 uppercase">Premium farkı</p>
                <h2 id="benefits-heading" class="mt-2 text-3xl font-black tracking-[-0.04em] text-ink">Tanışmayı kolaylaştıran özellikler</h2>
            </div>

            <div class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <?php $__currentLoopData = [
                    ['Mesajlaşma', 'Sınırsız sohbet ve daha fazla kişiyle bağlantı kur.', 'M12 6c3.4 0 6 2.3 6 5.3 0 3-2.6 5.2-6 5.2s-6-2.2-6-5.2C6 8.3 8.6 6 12 6Zm0 0V3m-6 8.3L3 9m15 2.3L21 9'],
                    ['Profil', 'Ziyaretçilerini gör, profilini öne çıkar ve gizli modda kal.', 'M16 7a4 4 0 1 1-8 0 4 4 0 0 1 8 0ZM4 21a8 8 0 0 1 16 0'],
                    ['Keşif', 'Şehir, yaş ve tercihlerle aramalarını hassaslaştır.', 'M11 4a7 7 0 1 1 0 14 7 7 0 0 1 0-14Zm5 12 4 4'],
                    ['Gizlilik', 'Kim beğendiğini gör ve paylaşım tercihlerini yönet.', 'M12 3 5 6v5c0 4.6 2.9 8.8 7 10 4.1-1.2 7-5.4 7-10V6l-7-3Z'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$title, $description, $path]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="rounded-2xl border border-line/80 bg-white p-5 shadow-sm transition hover:-translate-y-0.5 hover:border-primary-200 hover:shadow-lg">
                        <span class="grid size-11 place-items-center rounded-2xl bg-primary-50 text-primary-600">
                            <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="<?php echo e($path); ?>"/></svg>
                        </span>
                        <h3 class="mt-4 text-base font-black text-ink"><?php echo e($title); ?></h3>
                        <p class="mt-2 text-sm leading-6 text-muted"><?php echo e($description); ?></p>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <section class="px-4 pb-16 sm:px-6 sm:pb-24" aria-labelledby="faq-heading">
        <div class="mx-auto max-w-3xl">
            <div class="text-center">
                <p class="text-xs font-black tracking-[0.16em] text-primary-600 uppercase">SSS</p>
                <h2 id="faq-heading" class="mt-2 text-3xl font-black tracking-[-0.04em] text-ink">Merak edilenler</h2>
            </div>

            <div class="mt-8 divide-y divide-line/70 overflow-hidden rounded-2xl border border-line/80 bg-white shadow-sm">
                <?php $__currentLoopData = [
                    ['Premium üyelik nasıl çalışır?', 'Seçtiğiniz paket demo olarak hesabınıza tanımlanır ve premium erişiminiz etkinleşir. Ödeme sağlayıcı entegrasyonu tamamlandığında aynı akış gerçek ödeme adımına bağlanacaktır.'],
                    ['Hangi özellikler premium üyelere açık?', 'Premium; sınırsız mesajlaşma, gelişmiş filtreleme, profil ziyaretçilerini görme ve profil öne çıkarma gibi paket özelliklerini içerir.'],
                    ['Mevcut hesabımı kullanabilir miyim?', 'Evet. Premium aynı Gönülkop hesabına tanımlanır; yeni bir profil veya şifre oluşturmanız gerekmez.'],
                ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$question, $answer]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <details class="group px-5 py-5 sm:px-6">
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-sm font-black text-ink">
                            <?php echo e($question); ?>

                            <span class="grid size-7 shrink-0 place-items-center rounded-full bg-canvas text-muted transition group-open:rotate-45 group-open:bg-primary-50 group-open:text-primary-600">+</span>
                        </summary>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-muted"><?php echo e($answer); ?></p>
                    </details>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>
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
<?php /**PATH /home/gonulkop/public_html/resources/views/premium.blade.php ENDPATH**/ ?>