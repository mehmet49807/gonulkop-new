<?php if (isset($component)) { $__componentOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6107cafe1a6b2bb3ae2fbdc60a313162 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.auth','data' => ['title' => 'Kayıt Ol','description' => 'Gönül Köprüsü\'nde yeni bir hesap oluşturun.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.auth'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Kayıt Ol','description' => 'Gönül Köprüsü\'nde yeni bir hesap oluşturun.']); ?>
    <section aria-labelledby="register-title">
        <div class="mb-8">
            <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Yeni başlangıç</p>
            <h1 id="register-title" class="mt-2 text-3xl font-semibold tracking-tight text-ink">Kayıt ol</h1>
            <p class="mt-3 text-sm leading-6 text-muted">Birkaç bilgiyle profilinizi oluşturun ve keşfetmeye başlayın.</p>
        </div>

        <form method="POST" action="<?php echo e(route('register.store')); ?>" enctype="multipart/form-data" class="space-y-5">
            <?php echo csrf_field(); ?>

            <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'name','label' => 'Görünen ad','error' => isset($errors) ? $errors->first('name') : null,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'name','label' => 'Görünen ad','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($errors) ? $errors->first('name') : null),'required' => true]); ?>
                <input
                    id="name"
                    name="name"
                    type="text"
                    value="<?php echo e(old('name')); ?>"
                    class="form-control"
                    placeholder="Adınız ve soyadınız"
                    autocomplete="name"
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

            <div class="grid gap-5 sm:grid-cols-2">
                <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'gender','label' => 'Cinsiyet','error' => isset($errors) ? $errors->first('gender') : null,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'gender','label' => 'Cinsiyet','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($errors) ? $errors->first('gender') : null),'required' => true]); ?>
                    <select id="gender" name="gender" class="form-control" required>
                        <option value="" selected disabled>Seçiniz</option>
                        <option value="female" <?php if(old('gender') === 'female'): echo 'selected'; endif; ?>>Kadın</option>
                        <option value="male" <?php if(old('gender') === 'male'): echo 'selected'; endif; ?>>Erkek</option>
                    </select>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'birth_date','label' => 'Doğum tarihi','error' => isset($errors) ? $errors->first('birth_date') : null,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'birth_date','label' => 'Doğum tarihi','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($errors) ? $errors->first('birth_date') : null),'required' => true]); ?>
                    <input
                        id="birth_date"
                        name="birth_date"
                        type="date"
                        value="<?php echo e(old('birth_date')); ?>"
                        class="form-control"
                        autocomplete="bday"
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
            </div>

            <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'city','label' => 'Şehir','error' => isset($errors) ? $errors->first('city') : null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'city','label' => 'Şehir','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($errors) ? $errors->first('city') : null)]); ?>
                <input
                    id="city"
                    name="city"
                    type="text"
                    value="<?php echo e(old('city')); ?>"
                    class="form-control"
                    placeholder="Örn. İstanbul"
                    autocomplete="address-level2"
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'bio','label' => 'Biyografi','hint' => 'En fazla 1000 karakter']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'bio','label' => 'Biyografi','hint' => 'En fazla 1000 karakter']); ?>
                <textarea id="bio" name="bio" rows="3" maxlength="1000" class="form-control resize-none" placeholder="Kendinden kısaca bahset..."><?php echo e(old('bio')); ?></textarea>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'profile_photo','label' => 'Profil fotoğrafı','hint' => 'JPG, PNG veya WEBP. En fazla 2 MB.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'profile_photo','label' => 'Profil fotoğrafı','hint' => 'JPG, PNG veya WEBP. En fazla 2 MB.']); ?>
                <input id="profile_photo" name="profile_photo" type="file" accept="image/jpeg,image/png,image/webp" class="form-control file:mr-3 file:rounded-lg file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-sm file:font-semibold file:text-brand-700">
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
                    placeholder="En az 8 karakter"
                    autocomplete="new-password"
                    minlength="8"
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

            <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'password_confirmation','label' => 'Şifre tekrar','error' => isset($errors) ? $errors->first('password_confirmation') : null,'required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'password_confirmation','label' => 'Şifre tekrar','error' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(isset($errors) ? $errors->first('password_confirmation') : null),'required' => true]); ?>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    class="form-control"
                    placeholder="Şifrenizi yeniden girin"
                    autocomplete="new-password"
                    minlength="8"
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

            <p class="text-xs leading-5 text-muted">
                Kaydolarak kullanım koşullarını ve gizlilik politikasını kabul etmiş olursunuz.
            </p>

            <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'submit','size' => 'lg','class' => 'w-full']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','size' => 'lg','class' => 'w-full']); ?>Hesap oluştur <?php echo $__env->renderComponent(); ?>
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

        <p class="mt-7 text-center text-sm text-muted">
            Zaten hesabınız var mı?
            <a href="<?php echo e(route('login')); ?>" class="font-semibold text-brand-700 underline-offset-4 hover:underline">Giriş yapın</a>
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
<?php /**PATH /home/gonulkop/public_html/resources/views/auth/register.blade.php ENDPATH**/ ?>