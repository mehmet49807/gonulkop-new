<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Profil · Gönülkop','description' => 'Profilinizi ve paylaşımlarınızı keşfedin.','showNavigation' => true,'wide' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profil · Gönülkop','description' => 'Profilinizi ve paylaşımlarınızı keşfedin.','show-navigation' => true,'wide' => true]); ?>
    <?php
        $profileId = data_get($profile, 'id');
        $viewerId = auth()->id();
        $isOwner = (bool) (data_get($profile, 'is_owner') ?? ($profileId && $viewerId && (string) $profileId === (string) $viewerId));
        $profileData = $profile instanceof Illuminate\Database\Eloquent\Model ? $profile->getAttributes() : $profile;
        $profileName = data_get($profileData, 'name') ?: 'Gönülkop üyesi';
        $username = data_get($profileData, 'username');
        $profileImage = data_get($profileData, 'avatar_url') ?: data_get($profileData, 'profile_photo_path') ?: data_get($profileData, 'avatar_path') ?: data_get($profileData, 'profile_image') ?: data_get($profileData, 'image_path');
        $profileCity = data_get($profileData, 'city');
        $profileBio = data_get($profileData, 'bio') ?: data_get($profileData, 'about');
        $birthDate = data_get($profileData, 'birth_date') ?: data_get($profileData, 'date_of_birth');
        $age = data_get($profileData, 'age');

        if (! $age && $birthDate) {
            try {
                $age = Illuminate\Support\Carbon::parse($birthDate)->age;
            } catch (Throwable) {
                $age = null;
            }
        }

        if ($profileImage && ! Illuminate\Support\Str::startsWith($profileImage, ['http://', 'https://', '/', 'data:', 'blob:'])) {
            $profileImage = asset('storage/'.$profileImage);
        }

        $postCount = data_get($profile, 'post_count') ?? count(data_get($profile, 'posts') ?? []);
        $followersCount = data_get($profile, 'followers_count') ?? 0;
        $followingCount = data_get($profile, 'following_count') ?? 0;
    ?>

     <?php $__env->slot('header', null, []); ?> 
        <div class="flex items-center justify-between gap-4 px-4 pt-4 sm:px-5 sm:pt-5">
            <div>
                <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase"><?php echo e($isOwner ? 'Hesabım' : 'Profil'); ?></p>
                <h1 class="mt-1 text-lg font-semibold tracking-tight text-ink"><?php echo e($isOwner ? 'Profili Düzenle' : $profileName); ?></h1>
            </div>
            <?php if($isOwner): ?>
                <a href="<?php echo e(route('settings.edit')); ?>" class="tap-target grid size-9 place-items-center rounded-lg text-ink transition hover:bg-brand-50 hover:text-brand-600" aria-label="Ayarlar">
                    <svg viewBox="0 0 24 24" class="size-5" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-2.83 2.83-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.56V21h-4v-.09a1.7 1.7 0 0 0-1.88.34l-.06.06-2.83-2.83.06-.06A1.7 1.7 0 0 0 4.57 15 1.7 1.7 0 0 0 3 14H3v-4h.09a1.7 1.7 0 0 0 .34-1.88L4.2 7l2.83-2.83.06.06A1.7 1.7 0 0 0 9 4.57 1.7 1.7 0 0 0 10 3h4v.09a1.7 1.7 0 0 0 1.06 1.51 1.7 1.7 0 0 0 1.88-.34L17 4.2 19.83 7l-.06.06a1.7 1.7 0 0 0-.34 1.88A1.7 1.7 0 0 0 21 10h.09v4H21a1.7 1.7 0 0 0-1.6 1Z"></path></svg>
                </a>
            <?php endif; ?>
        </div>
     <?php $__env->endSlot(); ?>

    <main class="bg-white px-4 py-6 sm:px-6 sm:py-8 lg:px-8">
        <section class="mt-6 overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:gap-6">
                <div class="relative">
                    <?php if (isset($component)) { $__componentOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald04dd79f9e235eb8e58dee4526a2f3c2 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.avatar','data' => ['src' => $profileImage,'name' => $profileName,'size' => 'xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.avatar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['src' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($profileImage),'name' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($profileName),'size' => 'xl']); ?>
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
                    <?php if($isOwner): ?>
                        <button type="button" class="absolute -right-1 -bottom-1 size-8 rounded-full bg-brand-600 text-white shadow-sm flex items-center justify-center transition hover:bg-brand-700" aria-label="Profil fotoğrafını değiştir">
                            <svg viewBox="0 0 24 24" class="size-4" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M12 5v14M5 12h14"></path></svg>
                        </button>
                    <?php endif; ?>
                </div>

                <div class="min-w-0 flex-1">
                    <div class="flex items-center gap-2">
                        <h2 id="profile-summary-title" class="text-lg font-bold text-ink"><?php echo e($profileName); ?></h2>
                        <?php if($username): ?>
                            <span class="text-xs text-ink-muted">{{ $username }}</span>
                        <?php endif; ?>
                        <?php if($isOwner): ?>
                            <span class="rounded-full bg-brand-100 px-2.5 py-0.5 text-[0.65rem] font-bold text-brand-800">Siz</span>
                        <?php endif; ?>
                    </div>
                    <?php if($profileBio): ?>
                        <p class="mt-2 text-sm text-ink-muted line-clamp-2"><?php echo e($profileBio); ?></p>
                    <?php endif; ?>
                    <div class="mt-4 flex items-center gap-1 text-xs text-ink-muted">
                        <?php if($age): ?>
                            <span><?php echo e($age); ?> yaş</span>
                        <?php endif; ?>
                        <?php if($profileCity): ?>
                            <span aria-hidden="true">·</span>
                            <span><?php echo e($profileCity); ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($isOwner): ?>
                    <div class="flex flex-col items-end gap-2 sm:flex-row sm:items-center sm:justify-end">
                        <button class="w-full sm:w-auto inline-flex min-h-10 items-center justify-center rounded-full bg-white border border-line px-4 text-sm font-semibold text-ink shadow-sm transition hover:bg-neutral-50">
                            Düzenle
                        </button>
                        <a href="<?php echo e(route('settings.edit')); ?>" class="inline-flex min-h-10 items-center justify-center rounded-full bg-brand-600 px-4 text-sm font-semibold text-white shadow-brand hover:bg-brand-700 transition">
                            Ayarlar
                        </a>
                    </div>
                <?php else: ?>
                    <button class="w-full inline-flex min-h-10 items-center justify-center rounded-full bg-brand-600 px-4 text-sm font-semibold text-white shadow-brand hover:bg-brand-700 transition">
                        Takip Et
                    </button>
                <?php endif; ?>
            </div>

            <div class="mt-6 flex gap-x-12 sm:gap-x-16">
                <div class="flex-1 text-center">
                    <p class="text-xs font-bold text-ink-muted uppercase tracking-[0.12em]">Gönderiler</p>
                    <p class="text-lg font-bold text-ink"><?php echo e($postCount); ?></p>
                </div>
                <div class="flex-1 text-center">
                    <p class="text-xs font-bold text-ink-muted uppercase tracking-[0.12em]">Takipçiler</p>
                    <p class="text-lg font-bold text-ink"><?php echo e($followersCount); ?></p>
                </div>
                <div class="flex-1 text-center">
                    <p class="text-xs font-bold text-ink-muted uppercase tracking-[0.12em]">Takip Edilen</p>
                    <p class="text-lg font-bold text-ink"><?php echo e($followingCount); ?></p>
                </div>
            </div>
        </section>
        <?php if($isOwner || (auth()->check() && auth()->user()->isAdmin())): ?>
        <section class="mt-6 overflow-hidden rounded-lg border border-line bg-white p-5 shadow-sm">
            <h2 class="text-sm font-semibold text-ink-muted uppercase tracking-[0.12em] mb-5">Özel Bilgiler</h2>
            <div class="space-y-4">
                <div class="flex items-center gap-4 px-4 py-3 bg-neutral-50 rounded-lg border border-line/60">
                    <span class="text-sm font-medium text-ink-muted">E-posta</span>
                    <p class="ml-auto text-sm font-medium text-ink"><?php echo e(data_get($profileData, 'email') ?: '-'); ?></p>
                </div>
                <div class="flex items-center gap-4 px-4 py-3 bg-neutral-50 rounded-lg border border-line/60">
                    <span class="text-sm font-medium text-ink-muted">Tam Ad</span>
                    <p class="ml-auto text-sm font-medium text-ink"><?php echo e(data_get($profileData, 'full_name') ?: '-'); ?></p>
                </div>
                <div class="flex items-center gap-4 px-4 py-3 bg-neutral-50 rounded-lg border border-line/60">
                    <span class="text-sm font-medium text-ink-muted">Telefon</span>
                    <p class="ml-auto text-sm font-medium text-ink"><?php echo e(data_get($profileData, 'phone') ?: '-'); ?></p>
                </div>
            </div>
        </section>
<?php endif; ?>

<?php
            $profilePosts = is_object($posts) && method_exists($posts, 'items')
                ? $posts->items()
                : ($posts instanceof Illuminate\Support\Collection ? $posts->all() : ($posts ?? []));
        ?>

        <section class="mt-8" aria-labelledby="profile-posts-title">
            <div class="mb-4 flex items-center justify-between gap-3 px-1">
                <h2 id="profile-posts-title" class="text-base font-bold text-ink">Gönderiler</h2>
                <span class="text-xs font-medium text-ink-muted"><?php echo e(count($profilePosts)); ?></span>
            </div>

            <div class="profile-grid">
                <?php $__empty_1 = true; $__currentLoopData = $profilePosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="profile-grid-item group relative overflow-hidden cursor-pointer">
                        <img src="<?php echo e(data_get($post, 'image_path') ? asset('storage/'.data_get($post, 'image_path')) : ''); ?>" alt="Gönderi" class="size-full object-cover group-hover:scale-105 transition-transform duration-200">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex items-center justify-center">
                            <svg viewBox="0 0 24 24" class="size-6 text-white" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="col-span-3 flex flex-col items-center justify-center py-12 text-center">
                        <?php if (isset($component)) { $__componentOriginal3607a477fdef7402bc742abad5df9c51 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3607a477fdef7402bc742abad5df9c51 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.empty-state','data' => ['title' => 'Henüz gönderi yok','description' => 'Bu profilin yayımlanmış gönderileri burada görünecek.','icon' => 'message']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Henüz gönderi yok','description' => 'Bu profilin yayımlanmış gönderileri burada görünecek.','icon' => 'message']); ?>
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
<?php endif; ?><?php /**PATH /home/gonulkop/public_html/resources/views/profile/edit.blade.php ENDPATH**/ ?>