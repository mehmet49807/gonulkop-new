<?php if (isset($component)) { $__componentOriginalf103f87f9e6975b672a2453f5462c100 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf103f87f9e6975b672a2453f5462c100 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.marketing','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.marketing'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="relative isolate overflow-hidden bg-gradient-to-b from-brand-50/80 via-white to-white" aria-labelledby="hero-title">
        <div class="pointer-events-none absolute -left-32 top-20 -z-10 size-80 rounded-full bg-brand-200/35 blur-3xl" aria-hidden="true"></div>
        <div class="pointer-events-none absolute -right-24 top-0 -z-10 size-96 rounded-full bg-secondary-100/60 blur-3xl" aria-hidden="true"></div>

        <div class="mx-auto grid max-w-7xl items-center gap-14 px-4 py-16 sm:px-6 sm:py-20 lg:grid-cols-[1.05fr_0.95fr] lg:gap-10 lg:px-8 lg:py-24">
            <div class="relative z-10 text-center lg:text-left">
                <div class="inline-flex items-center gap-2 rounded-full border border-brand-200 bg-white/90 px-3.5 py-2 text-xs font-semibold text-brand-700 shadow-sm">
                    <span class="size-2 rounded-full bg-brand-500" aria-hidden="true"></span>
                    Gerçek ilgi alanlarıyla tanış
                </div>

                <h1 id="hero-title" class="mt-7 text-balance text-5xl font-black leading-[0.98] tracking-[-0.055em] text-ink sm:text-6xl lg:text-7xl">
                    Tanışmanın<br>
                    <span class="bg-gradient-to-r from-brand-600 via-brand-500 to-secondary-600 bg-clip-text text-transparent">en doğal yolu.</span>
                </h1>

                <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-ink-muted lg:mx-0">
                    Yüzeysel beğenilerden değil, ortak şehirlerden ve samimi hikâyelerden başlayan gerçek bir bağlantı. Gönül Köprüsü'nde hikâyeni paylaş, keşfet ve doğru kişiyle tanış.
                </p>

                <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row lg:justify-start">
                    <?php if(auth()->guard()->check()): ?>
                        <a href="<?php echo e(route('feed.index')); ?>" class="inline-flex min-h-14 w-full items-center justify-center gap-2 rounded-full bg-brand-600 px-7 text-base font-semibold text-white shadow-xl shadow-brand-200 transition hover:-translate-y-0.5 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 sm:w-auto">
                            Akışı keşfet
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" /></svg>
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('register')); ?>" class="inline-flex min-h-14 w-full items-center justify-center gap-2 rounded-full bg-brand-600 px-7 text-base font-semibold text-white shadow-xl shadow-brand-200 transition hover:-translate-y-0.5 hover:bg-brand-700 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 sm:w-auto">
                            Ücretsiz hesap oluştur
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6" /></svg>
                        </a>
                        <a href="<?php echo e(route('login')); ?>" class="inline-flex min-h-14 w-full items-center justify-center rounded-full border border-line bg-white px-7 text-base font-semibold text-ink transition hover:border-brand-200 hover:bg-brand-50 focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 sm:w-auto">
                            Giriş yap
                        </a>
                    <?php endif; ?>
                </div>

                <div class="mt-8 flex flex-col items-center gap-3 sm:flex-row lg:justify-start">
                    <div class="flex -space-x-2" aria-hidden="true">
                        <?php $__currentLoopData = ['Elif', 'Mert', 'Deniz', 'Selin']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="grid size-9 place-items-center rounded-full border-2 border-white bg-brand-100 text-xs font-bold text-brand-700"><?php echo e(mb_substr($member, 0, 1)); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <p class="text-sm text-ink-muted"><span class="font-semibold text-ink">Gerçek profiller</span> · Ücretsiz üyelik</p>
                </div>
            </div>

            <div class="relative mx-auto w-full max-w-lg lg:max-w-none" aria-label="Gönül Köprüsü'nde ortak ilgi alanlarıyla tanışma">
                <?php if (isset($component)) { $__componentOriginal6f94efc5314e852ef2d1634711067c1d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6f94efc5314e852ef2d1634711067c1d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.marketing.hero-3d','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('marketing.hero-3d'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6f94efc5314e852ef2d1634711067c1d)): ?>
<?php $attributes = $__attributesOriginal6f94efc5314e852ef2d1634711067c1d; ?>
<?php unset($__attributesOriginal6f94efc5314e852ef2d1634711067c1d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6f94efc5314e852ef2d1634711067c1d)): ?>
<?php $component = $__componentOriginal6f94efc5314e852ef2d1634711067c1d; ?>
<?php unset($__componentOriginal6f94efc5314e852ef2d1634711067c1d); ?>
<?php endif; ?>
            </div>
        </div>
    </section>

    <section id="ozellikler" class="scroll-mt-24 py-20 sm:py-28" aria-labelledby="features-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-brand-600">Daha iyi bir tanışma</p>
                <h2 id="features-title" class="mt-4 text-balance text-3xl font-black tracking-tight text-ink sm:text-5xl">Bir profil değil, bir hikâye gör.</h2>
                <p class="mt-5 text-lg leading-8 text-ink-muted">Gönül Köprüsü, yüzeysel kaydırmalar yerine ortak ilgi alanları üzerinden bağ kurmayı kolaylaştırır.</p>
            </div>

            <div class="mt-14 grid gap-5 md:grid-cols-3">
                <article class="group rounded-3xl border border-line bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-100/60">
                    <span class="grid size-13 place-items-center rounded-2xl bg-brand-50 text-brand-600 transition group-hover:scale-105 group-hover:bg-brand-600 group-hover:text-white">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path stroke-linecap="round" d="m20 20-4-4"/></svg>
                    </span>
                    <h3 class="mt-6 text-xl font-bold text-ink">Şehir ve yaşına göre keşfet</h3>
                    <p class="mt-3 text-sm leading-7 text-ink-muted">Günlük hayatına ve beklentilerine uygun kişileri şehir ve yaş filtreleriyle kolayca bulun.</p>
                    <a href="#nasil-calisir" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-brand-700">Nasıl çalışır? <span aria-hidden="true">→</span></a>
                </article>

                <article class="group rounded-3xl border border-line bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-secondary-200 hover:shadow-xl hover:shadow-secondary-100/60">
                    <span class="grid size-13 place-items-center rounded-2xl bg-secondary-50 text-secondary-700 transition group-hover:scale-105 group-hover:bg-secondary-600 group-hover:text-white">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19.5V6a2 2 0 0 1 2-2h13v16H6a2 2 0 0 0-2 2Zm0 0A2 2 0 0 1 6 17.5h13"/><path d="M8 8h7M8 12h5"/></svg>
                    </span>
                    <h3 class="mt-6 text-xl font-bold text-ink">Hikâyelerle tanış</h3>
                    <p class="mt-3 text-sm leading-7 text-ink-muted">Kısa gönderiler ve hikâyeler, karşındaki kişinin gününü ve tarzını daha iyi anlatmanı sağlar.</p>
                    <a href="#nasil-calisir" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-secondary-700">Deneyimi gör <span aria-hidden="true">→</span></a>
                </article>

                <article class="group rounded-3xl border border-line bg-white p-7 shadow-sm transition duration-300 hover:-translate-y-1 hover:border-accent-200 hover:shadow-xl hover:shadow-accent-100/60">
                    <span class="grid size-13 place-items-center rounded-2xl bg-accent-50 text-accent-800 transition group-hover:scale-105 group-hover:bg-accent-500 group-hover:text-white">
                        <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2Z"/></svg>
                    </span>
                    <h3 class="mt-6 text-xl font-bold text-ink">Konuşmayı sürdür</h3>
                    <p class="mt-3 text-sm leading-7 text-ink-muted">Karşılıklı ilgi olduğunda mesajlaşmaya geç; sohbetin doğal akışını bırak.</p>
                    <a href="#guvenlik" class="mt-6 inline-flex items-center gap-2 text-sm font-bold text-accent-800">Güvenli sohbet <span aria-hidden="true">→</span></a>
                </article>
            </div>
        </div>
    </section>

    <section class="overflow-hidden bg-neutral-50 py-20 sm:py-28" aria-labelledby="discovery-title">
        <div class="mx-auto grid max-w-7xl items-center gap-14 px-4 sm:px-6 lg:grid-cols-2 lg:gap-20 lg:px-8">
            <div class="relative mx-auto w-full max-w-lg lg:order-2">
                <div class="absolute -left-8 top-12 size-40 rounded-full bg-brand-200/40 blur-3xl" aria-hidden="true"></div>
                <div class="relative rounded-[2rem] border border-white bg-white p-3 shadow-2xl shadow-neutral-900/10">
                    <div class="flex items-center justify-between border-b border-line px-3 pb-4 pt-2">
                        <div><p class="text-xs font-semibold text-brand-600">Senin için</p><p class="font-bold text-ink">Yeni tanışmalar</p></div>
                        <button type="button" class="grid size-10 place-items-center rounded-full bg-brand-50 text-brand-600" aria-label="Filtreleri aç">
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" d="M4 6h16M7 12h10M10 18h4"/></svg>
                        </button>
                    </div>

                    <div class="grid gap-4 pt-5 sm:grid-cols-2">
                        <article class="overflow-hidden rounded-2xl border border-line/80">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=600&q=85" alt="Mert profil önizlemesi" class="h-48 w-full object-cover" loading="lazy">
                                <span class="absolute bottom-3 left-3 rounded-full bg-white/90 px-2.5 py-1 text-[0.65rem] font-bold text-ink backdrop-blur">İstanbul</span>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center justify-between"><h3 class="font-bold text-ink">Mert, 28</h3><span class="text-xs text-brand-600">Yeni öneri</span></div>
                                <p class="mt-2 line-clamp-2 text-xs leading-5 text-ink-muted">Canlı müzik, kısa filmler ve spontane şehir kaçamakları.</p>
                            </div>
                        </article>

                        <article class="overflow-hidden rounded-2xl border border-line/80">
                            <div class="relative">
                                <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=600&q=85" alt="Selin profil önizlemesi" class="h-48 w-full object-cover" loading="lazy">
                                <span class="absolute bottom-3 left-3 rounded-full bg-white/90 px-2.5 py-1 text-[0.65rem] font-bold text-ink backdrop-blur">İzmir</span>
                            </div>
                            <div class="p-4">
                                <div class="flex items-center justify-between"><h3 class="font-bold text-ink">Selin, 27</h3><span class="text-xs text-brand-600">Yeni öneri</span></div>
                                <p class="mt-2 line-clamp-2 text-xs leading-5 text-ink-muted">Maraton, deniz ve güzel bir kahve eşliğinde sohbet.</p>
                            </div>
                        </article>
                    </div>
                </div>

                <div class="absolute -bottom-7 -left-6 hidden items-center gap-3 rounded-2xl border border-white bg-white p-3 shadow-xl shadow-neutral-900/10 sm:flex">
                    <span class="grid size-10 place-items-center rounded-full bg-brand-100 text-brand-600">
                        <svg class="size-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"/></svg>
                    </span>
                    <div><p class="text-xs font-bold text-ink">Yeni öneriler hazır</p><p class="text-[0.65rem] text-ink-muted">Senin için 3 profil</p></div>
                </div>
            </div>

            <div class="lg:order-1">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-secondary-700">Kişiye özel keşif</p>
                <h2 id="discovery-title" class="mt-4 text-balance text-3xl font-black tracking-tight text-ink sm:text-5xl">Rastgele eşleşme değil, ortak bir başlangıç.</h2>
                <p class="mt-6 text-lg leading-8 text-ink-muted">Gönül Köprüsü, şehir ve yaş tercihlerin üzerinden kişileri sıralar. Böylece ilk mesajı günlük hayatınıza uygun birinden başlatabilirsin.</p>

                <ul class="mt-8 space-y-4" role="list">
                    <li class="flex items-start gap-3"><span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-secondary-100 text-secondary-700"><svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg></span><span class="text-sm leading-6 text-ink-muted"><strong class="text-ink">Şehir ve yaş filtreleri</strong> ile günlük hayatına uyum.</span></li>
                    <li class="flex items-start gap-3"><span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-secondary-100 text-secondary-700"><svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg></span><span class="text-sm leading-6 text-ink-muted"><strong class="text-ink">Şehir ve yaş tercihleri</strong> ile günlük hayatına uyum.</span></li>
                    <li class="flex items-start gap-3"><span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-secondary-100 text-secondary-700"><svg class="size-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 13 4 4L19 7"/></svg></span><span class="text-sm leading-6 text-ink-muted"><strong class="text-ink">Karşılıklı ilgi</strong> olduğunda sohbeti doğal şekilde başlat.</span></li>
                </ul>
            </div>
        </div>
    </section>

    <section id="nasil-calisir" class="scroll-mt-24 py-20 sm:py-28" aria-labelledby="steps-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <p class="text-xs font-bold uppercase tracking-[0.18em] text-brand-600">Üç kolay adım</p>
                <h2 id="steps-title" class="mt-4 text-balance text-3xl font-black tracking-tight text-ink sm:text-5xl">Tanışmaya başlamak bu kadar kolay.</h2>
            </div>

            <ol class="mt-14 grid gap-8 md:grid-cols-3" role="list">
                <li class="relative text-center">
                    <span class="mx-auto grid size-16 place-items-center rounded-2xl bg-brand-600 text-xl font-black text-white shadow-lg shadow-brand-200">01</span>
                    <h3 class="mt-6 text-lg font-bold text-ink">Profilini oluştur</h3>
                    <p class="mx-auto mt-3 max-w-xs text-sm leading-6 text-ink-muted">Kendini birkaç kelimeyle anlat, şehrini ve profil bilgilerini ekle.</p>
                </li>
                <li class="relative text-center before:absolute before:left-[-25%] before:top-8 before:hidden before:h-px before:w-[50%] before:bg-line before:content-[''] md:before:block">
                    <span class="mx-auto grid size-16 place-items-center rounded-2xl bg-secondary-600 text-xl font-black text-white shadow-lg shadow-secondary-200">02</span>
                    <h3 class="mt-6 text-lg font-bold text-ink">Şehir ve yaşına göre keşfet</h3>
                    <p class="mx-auto mt-3 max-w-xs text-sm leading-6 text-ink-muted">Günlük hayatına uygun kişileri filtrelerle incele.</p>
                </li>
                <li class="relative text-center before:absolute before:left-[-25%] before:top-8 before:hidden before:h-px before:w-[50%] before:bg-line before:content-[''] md:before:block">
                    <span class="mx-auto grid size-16 place-items-center rounded-2xl bg-accent-500 text-xl font-black text-white shadow-lg shadow-accent-200">03</span>
                    <h3 class="mt-6 text-lg font-bold text-ink">Sohbeti başlat</h3>
                    <p class="mx-auto mt-3 max-w-xs text-sm leading-6 text-ink-muted">Karşılıklı ilgi olduğunda mesajlaş ve bağlantını güçlendir.</p>
                </li>
            </ol>
        </div>
    </section>

    <section id="guvenlik" class="scroll-mt-24 py-20 sm:py-28" aria-labelledby="safety-title">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
            <div class="relative overflow-hidden rounded-[2rem] bg-neutral-900 px-6 py-12 text-white shadow-2xl shadow-neutral-900/15 sm:px-10 lg:px-16 lg:py-16">
                <div class="pointer-events-none absolute -right-16 -top-24 size-80 rounded-full bg-brand-500/25 blur-3xl" aria-hidden="true"></div>
                <div class="pointer-events-none absolute -bottom-32 left-1/3 size-72 rounded-full bg-secondary-500/20 blur-3xl" aria-hidden="true"></div>

                <div class="relative grid items-center gap-12 lg:grid-cols-[1fr_auto]">
                    <div class="max-w-2xl">
                        <span class="grid size-12 place-items-center rounded-2xl bg-white/10 text-brand-200 ring-1 ring-white/15">
                            <svg class="size-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path stroke-linecap="round" stroke-linejoin="round" d="m9 12 2 2 4-4"/></svg>
                        </span>
                        <h2 id="safety-title" class="mt-6 text-balance text-3xl font-black tracking-tight sm:text-5xl">Tanışma güvenli hissettirmeli.</h2>
                        <p class="mt-5 text-lg leading-8 text-white/65">Gönül Köprüsü'nde profilini sen oluşturursun, hikâyeni sen paylaşırsın ve mesajlaşmayı sen başlatırsın. İletişim her zaman senin kontrolünde.</p>

                        <div class="mt-8 grid gap-4 sm:grid-cols-3" role="list">
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4"><p class="font-bold">Senin kontrolün</p><p class="mt-1 text-sm leading-5 text-white/55">Profil ve paylaşımlar senin.</p></div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4"><p class="font-bold">Mesajlaşma</p><p class="mt-1 text-sm leading-5 text-white/55">Sohbeti sen başlatırsın.</p></div>
                            <div class="rounded-2xl border border-white/10 bg-white/5 p-4"><p class="font-bold">Saygı temeli</p><p class="mt-1 text-sm leading-5 text-white/55">Samimi ve kalıcı bağlar.</p></div>
                        </div>
                    </div>

                    <div class="hidden size-44 place-items-center rounded-full border border-white/10 bg-white/5 lg:grid">
                        <div class="grid size-28 place-items-center rounded-full bg-brand-600 shadow-2xl shadow-brand-500/20">
                            <svg class="size-12 text-white" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"/></svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 pb-20 pt-4 sm:px-6 sm:pb-28 lg:px-8" aria-labelledby="final-cta-title">
        <div class="relative mx-auto max-w-7xl overflow-hidden rounded-[2rem] bg-gradient-to-br from-brand-600 via-brand-600 to-secondary-700 px-6 py-14 text-center text-white shadow-2xl shadow-brand-200 sm:px-10 sm:py-20">
            <div class="pointer-events-none absolute -left-16 -top-24 size-72 rounded-full bg-white/10 blur-3xl" aria-hidden="true"></div>
            <div class="pointer-events-none absolute -bottom-24 -right-10 size-80 rounded-full bg-accent-300/15 blur-3xl" aria-hidden="true"></div>

            <div class="relative mx-auto max-w-2xl">
                <span class="mx-auto grid size-14 place-items-center rounded-2xl bg-white/15 ring-1 ring-white/20">
                    <svg class="size-7" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"/></svg>
                </span>
                <h2 id="final-cta-title" class="mt-7 text-balance text-3xl font-black tracking-tight sm:text-5xl">Gönlünü götürecek bir hikâye seni bekliyor.</h2>
                <p class="mx-auto mt-5 max-w-xl text-lg leading-8 text-white/75">Ücretsiz profilini oluştur, hikâyeni paylaş ve ortak bir ilgiyle başlayan yeni bir bağlantıya kapı aç.</p>

                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('feed.index')); ?>" class="mt-8 inline-flex min-h-14 w-full items-center justify-center gap-2 rounded-full bg-white px-7 text-base font-bold text-brand-700 shadow-xl transition hover:-translate-y-0.5 hover:bg-brand-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-brand-600 sm:w-auto">
                        Akışı keşfet
                        <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                    </a>
                <?php else: ?>
                    <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                        <a href="<?php echo e(route('register')); ?>" class="inline-flex min-h-14 w-full items-center justify-center gap-2 rounded-full bg-white px-7 text-base font-bold text-brand-700 shadow-xl transition hover:-translate-y-0.5 hover:bg-brand-50 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-brand-600 sm:w-auto">
                            Ücretsiz hesap oluştur
                            <svg class="size-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m9 18 6-6-6-6"/></svg>
                        </a>
                        <a href="<?php echo e(route('login')); ?>" class="inline-flex min-h-14 w-full items-center justify-center rounded-full border border-white/35 px-7 text-base font-semibold text-white transition hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-brand-600 sm:w-auto">Giriş yap</a>
                    </div>
                <?php endif; ?>

                <p class="mt-5 text-xs text-white/60">Ücretsiz üyelik · Kolay profil oluşturma · İstediğin zaman çık</p>
            </div>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf103f87f9e6975b672a2453f5462c100)): ?>
<?php $attributes = $__attributesOriginalf103f87f9e6975b672a2453f5462c100; ?>
<?php unset($__attributesOriginalf103f87f9e6975b672a2453f5462c100); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf103f87f9e6975b672a2453f5462c100)): ?>
<?php $component = $__componentOriginalf103f87f9e6975b672a2453f5462c100; ?>
<?php unset($__componentOriginalf103f87f9e6975b672a2453f5462c100); ?>
<?php endif; ?>
<?php /**PATH /home/gonulkop/public_html/resources/views/home.blade.php ENDPATH**/ ?>