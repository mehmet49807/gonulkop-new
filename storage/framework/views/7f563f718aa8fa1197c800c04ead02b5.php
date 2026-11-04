<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Ayarlar · Gönülkop','description' => 'Bildirim, gizlilik ve hesap güvenlik ayarlarınız.','showNavigation' => true,'wide' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Ayarlar · Gönülkop','description' => 'Bildirim, gizlilik ve hesap güvenlik ayarlarınız.','show-navigation' => true,'wide' => true]); ?>
    <?php
        $setting = fn (string $key, mixed $default = false): mixed => data_get($settings, $key, $default);
        $toggle = fn (string $key, bool $default = true): bool => old($key) !== null
            ? old($key) === '1'
            : (bool) $setting($key, $default);
        $settingsUpdateUrl = Route::has('settings.update') ? route('settings.update') : '#';
        $passwordUpdateUrl = Route::has('settings.password') ? route('settings.password') : '#';
        $destroyUrl = Route::has('settings.destroy') ? route('settings.destroy') : '#';
    ?>

     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between gap-4 px-4 pt-4 sm:px-5 sm:pt-5">
            <div>
                <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Hesap Merkezi</p>
                <h1 class="mt-1 text-lg font-bold tracking-tight text-ink">Ayarlar</h1>
                <p class="mt-1 text-sm text-ink-muted">Profil tercihlerinizi, bildirimlerinizi ve hesap güvenliğinizi yönetin.</p>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <main class="bg-white px-4 py-6 sm:px-6 sm:py-8">
        <?php if(session('status')): ?>
            <div class="mx-auto max-w-2xl mb-6 flex items-start gap-3 rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-900" role="status">
                <svg viewBox="0 0 24 24" class="mt-0.5 size-5 shrink-0" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 12 4 4L19 6" /></svg>
                <span><?php echo e(session('status')); ?></span>
            </div>
        <?php endif; ?>

        <?php if(isset($errors) && $errors->any()): ?>
            <div class="mx-auto max-w-2xl mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-900" role="alert">
                <p class="font-semibold">Ayarlar kaydedilemedi.</p>
                <ul class="mt-1 list-disc space-y-0.5 ps-5">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
        <!-- Bildirim Ayarları -->
        <section class="overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm mb-6">
            <div class="flex items-center gap-3 mb-6">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-primary-50 text-primary-600">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-ink">Bildirimler</h2>
                    <p class="text-sm text-ink-muted">Bildirim tercihlerinizi yönetin.</p>
                </div>
            </div>

            <form method="POST" action="<?php echo e($settingsUpdateUrl); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div class="space-y-4">
                    <?php if (isset($component)) { $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.toggle','data' => ['name' => 'email_notifications','label' => 'E-posta bildirimleri','description' => 'E-posta üzerinden bildirim almayı açın veya kapatın.','checked' => $toggle('email_notifications')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'email_notifications','label' => 'E-posta bildirimleri','description' => 'E-posta üzerinden bildirim almayı açın veya kapatın.','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toggle('email_notifications'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $attributes = $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $component = $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.toggle','data' => ['name' => 'push_notifications','description' => 'Anlık bildirimleri etkinleştirin veya devre dışı bırakın.','checked' => $toggle('push_notifications')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'push_notifications','description' => 'Anlık bildirimleri etkinleştirin veya devre dışı bırakın.','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toggle('push_notifications'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $attributes = $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $component = $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.toggle','data' => ['name' => 'new_match_notifications','description' => 'Yeni eşleşme olduğunda size bildirim gönder.','checked' => $toggle('new_match_notifications')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'new_match_notifications','description' => 'Yeni eşleşme olduğunda size bildirim gönder.','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toggle('new_match_notifications'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $attributes = $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $component = $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.toggle','data' => ['name' => 'message_notifications','description' => 'Yeni mesaj aldığınızda bildirim alın.','checked' => $toggle('message_notifications')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'message_notifications','description' => 'Yeni mesaj aldığınızda bildirim alın.','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toggle('message_notifications'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $attributes = $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $component = $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
                </div>

                <div class="mt-8 flex justify-end">
                    <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>Değişiklikleri kaydet <?php echo $__env->renderComponent(); ?>
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
            </form>
        </section>
        <!-- Gizlilik Ayarları -->
        <section class="overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm mb-6">
            <div class="flex items-center gap-3 mb-6">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-secondary-50 text-secondary-600">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4zm8 0v4.6c0 1.12-.91 2.024-2.081 2.157a43.324 43.324 0 00-2.786.56c-.526.235-.978.57-1.345.972-.399.44-.596.973-.526 1.49l.36 2.624c.042.293.254.535.536.597l2.624.36c.517.07 1.05.226 1.49.526.402.367.737.82.972 1.345.126 1.17.533 2.081.533 3.172v2.8c0 .554-.45 1-1 1H6a1 1 0 01-1-1v-2.8c0-1.091.407-2.002 1.164-2.778.132-.134.297-.297.52-.436l1.235-.782c.358-.227.765-.394 1.17-.497a43 43 0 012.786-.56c.367-.16.72-.396 1.044-.655.343-.275.614-.622.76-1.015l.36-2.624c.07-.497-.127-1.03-.525-1.47-.367-.402-.82-.737-1.345-.972a43.324 43.324 0 00-2.786-.56c-1.17-.134-2.081-.533-3.172-.533h-2.8c-.554 0-1-.45-1-1v0c0-1.091.407-2.002 1.164-2.778.132-.134.297-.297.52-.436l1.235-.782c.358-.227.765-.394 1.17-.497a43 43 0 012.786-.56c.367-.16.72-.396 1.044-.655.343-.275.614-.622.76-1.015l.36-2.624c.07-.497-.127-1.03-.525-1.47-.367-.402-.82-.737-1.345-.972a43.324 43.324 0 00-2.786-.56c-1.17-.134-2.081-.533-3.172-.533h-2.8A1 1 0 002 1.8v0c0 1.091-.407 2.002-1.164 2.778-.132.134-.297.297-.52.436L.305 4.06c-.358.227-.765.394-1.17.497a43 43 0 01-2.786.56c-.367.16-.72.396-1.044.655-.343.275-.614.622-.76 1.015l-.36 2.624c-.07.497.127 1.03.525 1.47.367.402.82.737 1.345.972a43.324 43.324 0 002.786.56c1.17.134 2.081.533 3.172.533h2.8c.554 0 1 .45 1 1v0c0-1.091-.407-2.002-1.164-2.778-.132-.134-.297-.297-.52-.436l-1.235.782c-.358.227-.765.394-1.17.497a43 43 0 01-2.786.56c-.367.16-.72.396-1.044.655-.343.275-.614.622-.76 1.015l-.36 2.624c-.07.497.127 1.03.525 1.47.367.402.82.737 1.345.972a43.324 43.324 0 002.786.56c1.17.134 2.081.533 3.172.533h2.8c.554 0 1 .45 1 1v0c0-1.091-.407-2.002-1.164-2.778-.132-.134-.297-.297-.52-.436l-1.235.782c-.358.227-.765.394-1.17.497a43 43 0 01-2.786.56c-.367.16-.72.396-1.044.655-.343.275-.614.622-.76 1.015l-.36 2.624c-.07.497.127 1.03.525 1.47.367.402.82.737 1.345.972a43.324 43.324 0 002.786.56c1.17.134 2.081.533 3.172.533h2.8c.554 0 1 .45 1 1z" /></svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-ink">Gizlilik</h2>
                    <p class="text-sm text-ink-muted">Profilinizin görünürlüğünü ve gizlilik tercihlerinizi yönetin.</p>
                </div>
            </div>

            <form method="POST" action="<?php echo e($settingsUpdateUrl); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PATCH'); ?>

                <div class="space-y-4">
                    <div class="group flex cursor-pointer items-center justify-between gap-5 rounded-xl border border-line/80 bg-[#fffaf7] p-4 transition hover:border-primary-200 hover:bg-primary-50/40">
                        <span class="min-w-0">
                            <span class="block text-sm font-bold text-ink">Profil görünürlüğü</span>
                            <span class="mt-1 block text-sm leading-6 text-muted">Kimlerin profilinizi görebileceğini seçin.</span>
                        </span>
                        <select name="profile_visibility" class="block w-full rounded-lg border border-line bg-white px-3 py-2 text-sm text-ink shadow-sm focus:ring-2 focus:ring-brand-500 focus:border-brand-500 outline-none">
                            <option value="public" <?php echo e($setting('profile_visibility') === 'public' ? 'selected' : ''); ?>>Herkes</option>
                            <option value="members" <?php echo e($setting('profile_visibility') === 'members' ? 'selected' : ''); ?>>Sadece üyeler</option>
                            <option value="private" <?php echo e($setting('profile_visibility') === 'private' ? 'selected' : ''); ?>>Özel</option>
                        </select>
                    </div>

                    <?php if (isset($component)) { $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.toggle','data' => ['name' => 'show_online','label' => 'Çevrimiçi durumu göster','description' => 'Diğer üyelerin sizi çevrimiçi olarak görebilmesi için.','checked' => $toggle('show_online')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_online','label' => 'Çevrimiçi durumu göster','description' => 'Diğer üyelerin sizi çevrimiçi olarak görebilmesi için.','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toggle('show_online'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $attributes = $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $component = $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
                    <?php if (isset($component)) { $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.toggle','data' => ['name' => 'show_location','label' => 'Konumu göster','description' => 'Diğer üyelerin şehrinizi görebilmesi için.','checked' => $toggle('show_location')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.toggle'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'show_location','label' => 'Konumu göster','description' => 'Diğer üyelerin şehrinizi görebilmesi için.','checked' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($toggle('show_location'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $attributes = $__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__attributesOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee)): ?>
<?php $component = $__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee; ?>
<?php unset($__componentOriginalb5e8d8ae92d68ac68a76e18b82b039ee); ?>
<?php endif; ?>
                </div>

                <div class="mt-8 flex justify-end">
                    <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>Değişiklikleri kaydet <?php echo $__env->renderComponent(); ?>
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
            </form>
        </section>
        <!-- Şifre Değiştirme -->
        <section class="overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm mb-6">
            <div class="flex items-center gap-3 mb-6">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-accent-50 text-accent-600">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0110 0v4"></path></svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-ink">Şifre Değiştir</h2>
                    <p class="text-sm text-ink-muted">Hesap şifrenizi güncelleyin.</p>
                </div>
            </div>

            <form method="POST" action="<?php echo e($passwordUpdateUrl); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>

                <div class="space-y-4">
                    <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'current_password','label' => 'Mevcut şifre','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'current_password','label' => 'Mevcut şifre','required' => true]); ?>
                        <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'password','label' => 'Yeni şifre','hint' => 'En az 8 karakter','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'password','label' => 'Yeni şifre','hint' => 'En az 8 karakter','required' => true]); ?>
                        <input id="password" name="password" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'password_confirmation','label' => 'Yeni şifre tekrar','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'password_confirmation','label' => 'Yeni şifre tekrar','required' => true]); ?>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password" minlength="8" required>
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

                <div class="mt-8 flex justify-end">
                    <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'submit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit']); ?>Şifreyi değiştir <?php echo $__env->renderComponent(); ?>
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
            </form>
        </section>

        <!-- Hesap Silme -->
        <section class="overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm">
            <div class="flex items-center gap-3 mb-6">
                <span class="grid size-9 shrink-0 place-items-center rounded-xl bg-red-50 text-red-600">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                </span>
                <div>
                    <h2 class="text-lg font-bold text-ink">Hesabı Sil</h2>
                    <p class="text-sm text-ink-muted">Hesabınızı kalıcı olarak silin.</p>
                </div>
            </div>

            <div class="bg-red-50/50 border border-red-100/50 rounded-lg p-4">
                <h3 class="text-sm font-bold text-red-900">Tehlikeli işlem</h3>
                <p class="mt-1 text-sm text-red-800/80">Hesabınız, mesajlarınız ve profil gönderileriniz kalıcı olarak silinir. Bu işlem geri alınamaz.</p>
            </div>

            <form method="POST" action="<?php echo e($destroyUrl); ?>" data-confirm="Hesabınız kalıcı olarak silinecek. Bu işlemi onaylıyor musunuz?" class="mt-6">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>

                <div class="space-y-4">
                    <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'current_password','label' => 'Mevcut şifre','hint' => 'Silme işlemini doğrulamak için şifrenizi girin.','required' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'current_password','label' => 'Mevcut şifre','hint' => 'Silme işlemini doğrulamak için şifrenizi girin.','required' => true]); ?>
                        <input id="current_password" name="current_password" type="password" class="form-control" autocomplete="current-password" required>
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

                <div class="mt-6 flex justify-end">
                    <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'submit','variant' => 'danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','variant' => 'danger']); ?>Hesabımı kalıcı olarak sil <?php echo $__env->renderComponent(); ?>
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
            </form>
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
<?php endif; ?><?php /**PATH /home/gonulkop/public_html/resources/views/settings/edit.blade.php ENDPATH**/ ?>