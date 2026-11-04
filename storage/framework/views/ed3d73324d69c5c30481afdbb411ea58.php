<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="theme-color" content="#111936">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title>Yönetim Girişi · Gönül Köprüsü</title>
    <?php echo app('Illuminate\Foundation\Vite')->fonts(); ?>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="admin-theme min-h-[dvh] bg-neutral-950 text-white antialiased">
    <main class="grid min-h-[dvh] lg:grid-cols-[minmax(0,1fr)_42rem]">
        <section class="relative hidden overflow-hidden bg-brand-950 p-12 lg:flex lg:flex-col lg:justify-between xl:p-16" aria-label="Yönetim paneli tanıtımı">
            <div class="absolute -left-32 -top-32 size-[34rem] rounded-full bg-brand-500/25 blur-3xl"></div>
            <div class="absolute -bottom-48 right-0 size-[32rem] rounded-full bg-cyan-400/12 blur-3xl"></div>
            <div class="absolute inset-0 opacity-[0.07]" style="background-image:linear-gradient(rgba(255,255,255,.5) 1px,transparent 1px),linear-gradient(90deg,rgba(255,255,255,.5) 1px,transparent 1px);background-size:44px 44px"></div>

            <a href="<?php echo e(route('home')); ?>" class="relative flex w-fit items-center gap-3">
                <span class="grid size-12 place-items-center rounded-2xl bg-gradient-to-br from-brand-400 to-brand-700 shadow-xl shadow-brand-950/40">
                    <svg viewBox="0 0 24 24" class="size-6 fill-current" aria-hidden="true"><path d="M4 20c0-3.31 2.69-6 6-6s6 2.69 6 6M10 20c0-3.31 2.69-6 6-6s6 2.69 6 6M4 14V20M10 14V20M16 14V20" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M12 17.2a2.2 2.2 0 0 1 2.2-2.2l-2.2 2.2-2.2-2.2a2.2 2.2 0 0 1 2.2-2.2Z"/></svg>
                </span>
                <span><span class="block text-lg font-black tracking-tight">Gönül Köprüsü</span><span class="mt-0.5 block text-[0.6rem] font-bold uppercase tracking-[0.2em] text-neutral-500">Yönetim Merkezi</span></span>
            </a>

            <div class="relative max-w-2xl">
                <span class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/6 px-3.5 py-2 text-[0.65rem] font-bold uppercase tracking-[0.16em] text-brand-200"><span class="size-1.5 rounded-full bg-emerald-400 shadow-[0_0_10px_oklch(.8_.16_160)]"></span>Sistem aktif</span>
                <h1 class="mt-7 text-5xl font-black leading-[1.03] tracking-[-0.04em] xl:text-6xl">Platformun nabzını<br><span class="bg-gradient-to-r from-brand-300 via-cyan-300 to-white bg-clip-text text-transparent">tek yerden yönetin.</span></h1>
                <p class="mt-6 max-w-xl text-base leading-7 text-neutral-400">Kullanıcıları, gönderileri ve mesajları güvenli, sade ve gerçek zamanlı yönetim deneyimiyle kontrol edin.</p>

                <div class="mt-10 grid max-w-xl grid-cols-3 gap-3">
                    <div class="rounded-2xl border border-white/8 bg-white/5 p-4 backdrop-blur-sm"><p class="text-xl font-black">7/24</p><p class="mt-1 text-xs text-neutral-500">Erişilebilir</p></div>
                    <div class="rounded-2xl border border-white/8 bg-white/5 p-4 backdrop-blur-sm"><p class="text-xl font-black">Canlı</p><p class="mt-1 text-xs text-neutral-500">Veri</p></div>
                    <div class="rounded-2xl border border-white/8 bg-white/5 p-4 backdrop-blur-sm"><p class="text-xl font-black">Tek</p><p class="mt-1 text-xs text-neutral-500">Panel</p></div>
                </div>
            </div>

            <p class="relative text-xs text-neutral-600">© <?php echo e(now()->year); ?> Gönül Köprüsü · Güvenli yönetim çözümü</p>
        </section>

        <section class="relative flex min-h-[dvh] items-center justify-center overflow-hidden bg-[radial-gradient(circle_at_85%_12%,oklch(0.38_0.15_258/.95),transparent_34%),radial-gradient(circle_at_10%_90%,oklch(0.31_0.11_250/.8),transparent_38%),linear-gradient(145deg,oklch(0.135_0.05_266),oklch(0.205_0.065_266))] px-5 py-10 text-ink sm:px-10 lg:px-14">
            <div class="absolute -right-20 bottom-4 size-64 rounded-full bg-cyan-400/12 blur-3xl"></div>
            <div class="absolute left-8 top-8 size-36 rounded-full border border-white/5"></div>
            <div class="absolute left-[5.5rem] top-[5.5rem] size-20 rounded-full border border-white/5"></div>

            <div class="relative w-full max-w-[25rem]">
                <a href="<?php echo e(route('home')); ?>" class="mb-8 flex items-center justify-center gap-2.5 text-sm font-black text-white lg:hidden"><span class="grid size-10 place-items-center rounded-xl bg-gradient-to-br from-brand-400 to-brand-700 text-white shadow-lg shadow-brand-950/40">G</span>Gönül Köprüsü</a>

                <div class="relative overflow-hidden rounded-[2rem] border border-white/70 bg-white p-6 shadow-[0_30px_90px_oklch(0.08_0.04_266/.55)] sm:p-9">
                    <div class="absolute right-0 top-0 h-28 w-28 rounded-bl-full bg-gradient-to-bl from-brand-100/80 to-transparent"></div>
                    <div class="relative">
                        <span class="inline-flex items-center gap-2 rounded-full bg-brand-50 px-3 py-1.5 text-[0.65rem] font-black uppercase tracking-[0.14em] text-brand-700">
                            <svg viewBox="0 0 24 24" class="size-3.5" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10Z"/><path d="m9 12 2 2 4-4"/></svg>
                            Güvenli erişim
                        </span>
                        <h2 class="mt-5 text-3xl font-black tracking-[-0.03em] text-neutral-950">Yönetici girişi</h2>
                        <p class="mt-2 text-sm leading-6 text-neutral-500">Yönetim merkezine erişmek için hesap bilgilerinizi girin.</p>

                        <?php if(session('status')): ?>
                            <div class="mt-5 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-800" role="status"><span class="grid size-5 place-items-center rounded-full bg-emerald-500 text-xs text-white">✓</span><?php echo e(session('status')); ?></div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(route('admin.login.store')); ?>" class="mt-7 space-y-5">
                            <?php echo csrf_field(); ?>
                            <label class="block">
                                <span class="mb-2 block text-xs font-bold text-neutral-700">E-posta adresi</span>
                                <span class="relative block">
                                    <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
                                    <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" autocomplete="email" inputmode="email" required autofocus class="h-12 w-full rounded-xl border border-neutral-200 bg-neutral-50 pl-11 pr-4 text-sm font-medium outline-none transition placeholder:text-neutral-400 focus:border-brand-500 focus:bg-white focus:ring-3 focus:ring-brand-100" placeholder="admin@gonulkop.com">
                                </span>
                            </label>
                            <label class="block">
                                <span class="mb-2 block text-xs font-bold text-neutral-700">Şifre</span>
                                <span class="relative block">
                                    <svg viewBox="0 0 24 24" class="pointer-events-none absolute left-3.5 top-1/2 size-4 -translate-y-1/2 text-neutral-400" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="4" y="10" width="16" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/></svg>
                                    <input id="password" type="password" name="password" autocomplete="current-password" required class="h-12 w-full rounded-xl border border-neutral-200 bg-neutral-50 pl-11 pr-4 text-sm font-medium outline-none transition placeholder:text-neutral-400 focus:border-brand-500 focus:bg-white focus:ring-3 focus:ring-brand-100" placeholder="••••••••">
                                </span>
                            </label>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="flex items-center gap-2 text-sm font-semibold text-red-600" role="alert"><span class="grid size-5 place-items-center rounded-full bg-red-100">!</span><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><p class="text-sm font-semibold text-red-600" role="alert"><?php echo e($message); ?></p><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <button type="submit" class="group flex h-12 w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-brand-500 to-brand-700 text-sm font-black text-white shadow-lg shadow-brand-700/25 transition hover:-translate-y-0.5 hover:shadow-xl hover:shadow-brand-700/30 focus:outline-none focus:ring-3 focus:ring-brand-200 active:translate-y-0">Yönetim paneline gir<svg viewBox="0 0 24 24" class="size-4 transition-transform group-hover:translate-x-0.5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3"/></svg></button>
                        </form>

                        <div class="mt-7 border-t border-neutral-100 pt-6 text-center">
                            <p class="text-xs text-neutral-400">Normal kullanıcı girişi</p>
                            <a href="<?php echo e(route('login')); ?>" class="mt-2 inline-flex items-center gap-1.5 text-sm font-bold text-brand-700 transition hover:text-brand-800">Kullanıcı girişine dön<span aria-hidden="true">→</span></a>
                        </div>
                    </div>
                </div>

                <p class="mt-6 text-center text-xs text-neutral-500">Yetkisiz erişim denemeleri kayıt altına alınır.</p>
            </div>
        </section>
    </main>
</body>
</html>
<?php /**PATH /home/gonulkop/public_html/resources/views/auth/admin-login.blade.php ENDPATH**/ ?>