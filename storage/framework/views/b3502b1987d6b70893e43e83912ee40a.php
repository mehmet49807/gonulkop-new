<?php if (isset($component)) { $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.auth','data' => ['title' => 'Giriş Yap','description' => 'Gönül Köprüsü hesabınıza giriş yapın.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.auth'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Giriş Yap','description' => 'Gönül Köprüsü hesabınıza giriş yapın.']); ?>
    <section aria-labelledby="login-title" class="animate-fade-up">
        <!-- Brand Header -->
        <div class="mb-10 text-center">
            <?php if (isset($component)) { $__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.brand-logo','data' => ['size' => 'lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('brand-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['size' => 'lg']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3)): ?>
<?php $attributes = $__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3; ?>
<?php unset($__attributesOriginal8741a05e11b0c77d19ec61b6b35b26b3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3)): ?>
<?php $component = $__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3; ?>
<?php unset($__componentOriginal8741a05e11b0c77d19ec61b6b35b26b3); ?>
<?php endif; ?>
        </div>

        <div class="mb-8">
            <p class="text-xs font-semibold tracking-[0.16em] text-primary-600 uppercase">Tekrar hoş geldin</p>
            <h1 id="login-title" class="mt-2 text-3xl font-semibold tracking-tight text-ink">Giriş yap</h1>
            <p class="mt-3 text-sm leading-6 text-ink-muted">Tanışmalarına kaldığın yerden devam et.</p>
        </div>

        <form method="POST" action="<?php echo e(route('login.store')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'email','label' => 'E-posta','error' => isset($errors) ? $errors->first('email') : null,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'email','label' => 'E-posta','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($errors) ? $errors->first('email') : null),'required' => true]); ?>
                <input
                    id="email"
                    name="email"
                    type="email"
                    value="<?php echo e(old('email')); ?>"
                    class="form-control"
                    placeholder="ornek@eposta.com"
                    autocomplete="email"
                    inputmode="email"
                    required
                    autofocus
                >
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a97b30fa188f1c6e8d656b590013771)): ?>
<?php $attributes = $__attributesOriginal0a97b30fa188f1c6e8d656b590013771; ?>
<?php unset($__attributesOriginal0a97b30fa188f1c6e8d656b590013771); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a97b30fa188f1c6e8d656b590013771)): ?>
<?php $component = $__componentOriginal0a97b30fa188f1c6e8d656b590013771; ?>
<?php unset($__componentOriginal0a97b30fa188f1c6e8d656b590013771); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'password','label' => 'Şifre','error' => isset($errors) ? $errors->first('password') : null,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'password','label' => 'Şifre','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($errors) ? $errors->first('password') : null),'required' => true]); ?>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-control"
                    placeholder="Şifren"
                    autocomplete="current-password"
                    required
                >
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal0a97b30fa188f1c6e8d656b590013771)): ?>
<?php $attributes = $__attributesOriginal0a97b30fa188f1c6e8d656b590013771; ?>
<?php unset($__attributesOriginal0a97b30fa188f1c6e8d656b590013771); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal0a97b30fa188f1c6e8d656b590013771)): ?>
<?php $component = $__componentOriginal0a97b30fa188f1c6e8d656b590013771; ?>
<?php unset($__componentOriginal0a97b30fa188f1c6e8d656b590013771); ?>
<?php endif; ?>

            <div class="flex items-center justify-between">
                <label class="flex min-h-11 cursor-pointer items-center gap-3 text-sm text-ink-muted">
                    <input
                        name="remember"
                        type="checkbox"
                        value="1"
                        <?php if(old('remember')): echo 'checked'; endif; ?>
                        class="size-5 rounded border-line text-primary-600 focus:ring-primary-500"
                    >
                    <span>Beni hatırla</span>
                </label>

                <a href="#" class="text-sm font-medium text-primary-600 hover:underline underline-offset-2">
                    Şifremi unuttum
                </a>
            </div>

            <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'submit','size' => 'lg','class' => 'w-full btn-primary btn-block']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','size' => 'lg','class' => 'w-full btn-primary btn-block']); ?>
                Giriş yap
                <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
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
        </form>

        <!-- Divider -->
        <div class="divider my-8">
            <span class="divider-text"><span>veya</span></span>
        </div>

        <!-- Social Login Buttons -->
        <div class="grid gap-3 sm:grid-cols-2">
            <button type="button" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-xl border border-line bg-white text-ink font-medium transition-all hover:bg-brand-50 hover:text-white hover:border-transparent hover:shadow-brand active:scale-95" data-social-login="google">
                <svg class="size-5" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/></svg>
                <span>Google ile devam et</span>
            </button>
            <button type="button" class="w-full flex items-center justify-center gap-2.5 px-4 py-3 rounded-xl border border-line bg-white text-ink font-medium transition-all hover:bg-brand-50 hover:text-white hover:border-transparent hover:shadow-brand active:scale-95" data-social-login="apple">
                <svg class="size-5" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M19.5 12c0-2.121-1.279-3.879-3-4.797V6.5c0-1.355-.92-2.445-2.121-2.672C13.121 2.67 12 3.76 12 5.105c0 1.345-1.121 2.435-2.121 2.672V7.203C9.279 8.121 8 9.879 8 12c0 3.309 2.691 6 6 6s6-2.691 6-6zM12 20c-2.21 0-4-1.79-4-4s1.79-4 4-4 4 1.79 4 4-1.79 4-4 4zM7.25 7a1.25 1.25 0 1 1 0 2.5 1.25 1.25 0 0 1 0-2.5z"/></svg>
                <span>Apple ile devam et</span>
            </button>
        </div>

        <p class="mt-7 text-center text-sm text-ink-muted">
            Henüz hesabın yok mu?
            <a href="<?php echo e(route('register')); ?>" class="font-semibold text-primary-700 underline-offset-4 hover:underline">Kayıt ol</a>
        </p>

    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162)): ?>
<?php $attributes = $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162; ?>
<?php unset($__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162)): ?>
<?php $component = $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162; ?>
<?php unset($__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162); ?>
<?php endif; ?>
<?php /**PATH /home/gonulkop/public_html/resources/views/auth/login.blade.php ENDPATH**/ ?>