<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Keşfet','description' => 'Yeni kişileri keşfedin ve bağlantı kurun.','wide' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Keşfet','description' => 'Yeni kişileri keşfedin ve bağlantı kurun.','wide' => true]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="border-t border-line/60 bg-canvas/70 px-4 py-4 sm:px-5">
            <div class="flex items-end justify-between gap-4">
                <div>
                    <p class="text-xs font-semibold tracking-[0.16em] text-brand-600 uppercase">Yeni eşleşmeler</p>
                    <h1 class="mt-1 text-xl font-semibold tracking-tight text-ink">Keşfet</h1>
                </div>
                <span class="hidden text-xs text-muted sm:inline">Kartları kaydırarak inceleyin</span>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <?php
        $selectedCity = data_get($filters, 'city', request('city', ''));
        $selectedAge = data_get($filters, 'age', request('age', 'all'));
        $ageOptions = [
            'all' => 'Tüm yaşlar',
            '18-24' => '18-24',
            '25-34' => '25-34',
            '35-44' => '35-44',
            '45+' => '45+',
        ];
    ?>

    <section class="bg-canvas/45 px-3 py-4 sm:px-5 sm:py-5" aria-labelledby="discovery-filters-title">
        <h2 id="discovery-filters-title" class="sr-only">Keşfet filtreleri</h2>
        <form method="GET" action="<?php echo e(route('discover.index')); ?>" class="surface-card grid gap-3 p-3 sm:grid-cols-[minmax(0,1fr)_minmax(0,1fr)_auto] sm:items-end">
            <?php if (isset($component)) { $__componentOriginal0a97b30fa188f1c6e8d656b590013771 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal0a97b30fa188f1c6e8d656b590013771 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'city','label' => 'Şehir']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'city','label' => 'Şehir']); ?>
                <select id="city" name="city" class="form-control">
                    <option value="">Tüm şehirler</option>
                    <?php $__currentLoopData = ($cities ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $cityValue = is_string($city) || is_numeric($city) ? (string) $city : (data_get($city, 'value') ?: data_get($city, 'name'));
                            $cityName = data_get($city, 'name') ?: $cityValue;
                        ?>
                        <option value="<?php echo e($cityValue); ?>" <?php if((string) $selectedCity === (string) $cityValue): echo 'selected'; endif; ?>><?php echo e($cityName); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.form-field','data' => ['name' => 'age','label' => 'Yaş aralığı']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.form-field'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['name' => 'age','label' => 'Yaş aralığı']); ?>
                <select id="age" name="age" class="form-control">
                    <?php $__currentLoopData = $ageOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>" <?php if((string) $selectedAge === (string) $value): echo 'selected'; endif; ?>><?php echo e($label); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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

            <div class="flex gap-2">
                <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['type' => 'submit','class' => 'flex-1 sm:flex-none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => 'submit','class' => 'flex-1 sm:flex-none']); ?>Filtrele <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                <?php if(filled($selectedCity) || $selectedAge !== 'all'): ?>
                    <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => route('discover.index'),'variant' => 'ghost','class' => 'flex-1 sm:flex-none']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('discover.index')),'variant' => 'ghost','class' => 'flex-1 sm:flex-none']); ?>Temizle <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $attributes = $__attributesOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__attributesOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala8bb031a483a05f647cb99ed3a469847)): ?>
<?php $component = $__componentOriginala8bb031a483a05f647cb99ed3a469847; ?>
<?php unset($__componentOriginala8bb031a483a05f647cb99ed3a469847); ?>
<?php endif; ?>
                <?php endif; ?>
            </div>
        </form>
    </section>

    <section class="bg-canvas/45 px-3 pb-6 sm:px-5" aria-labelledby="discovery-results-title">
        <div class="mb-3 flex items-center justify-between gap-3 px-1">
            <h2 id="discovery-results-title" class="text-sm font-semibold text-ink">Senin için</h2>
            <span class="text-xs text-muted"><?php echo e(count($users ?? [])); ?> kişi</span>
        </div>

        <?php if(count($users ?? []) > 0): ?>
            <div class="no-scrollbar -mx-3 flex snap-x snap-mandatory gap-4 overflow-x-auto px-3 pb-2 sm:-mx-5 sm:px-5 lg:mx-0 lg:grid lg:grid-cols-2 lg:overflow-visible lg:px-0">
                <?php $__currentLoopData = ($users ?? []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="w-[86vw] max-w-[22rem] shrink-0 snap-center sm:w-[24rem] lg:w-auto lg:max-w-none">
                        <?php if (isset($component)) { $__componentOriginal955aa7e971361bf2b468773716a054c7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal955aa7e971361bf2b468773716a054c7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.discovery.user-card','data' => ['user' => $user]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('discovery.user-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['user' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($user)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal955aa7e971361bf2b468773716a054c7)): ?>
<?php $attributes = $__attributesOriginal955aa7e971361bf2b468773716a054c7; ?>
<?php unset($__attributesOriginal955aa7e971361bf2b468773716a054c7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal955aa7e971361bf2b468773716a054c7)): ?>
<?php $component = $__componentOriginal955aa7e971361bf2b468773716a054c7; ?>
<?php unset($__componentOriginal955aa7e971361bf2b468773716a054c7); ?>
<?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="surface-card overflow-hidden">
                <?php if (isset($component)) { $__componentOriginal3607a477fdef7402bc742abad5df9c51 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3607a477fdef7402bc742abad5df9c51 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.empty-state','data' => ['title' => 'Şu anda eşleşme bulunamadı','description' => 'Filtreleri değiştirerek daha fazla kişiyi görebilirsin.','icon' => 'message']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.empty-state'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Şu anda eşleşme bulunamadı','description' => 'Filtreleri değiştirerek daha fazla kişiyi görebilirsin.','icon' => 'message']); ?>
                    <?php if (isset($component)) { $__componentOriginala8bb031a483a05f647cb99ed3a469847 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala8bb031a483a05f647cb99ed3a469847 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.ui.button','data' => ['href' => route('discover.index'),'variant' => 'secondary','size' => 'sm']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('ui.button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('discover.index')),'variant' => 'secondary','size' => 'sm']); ?>Filtreleri temizle <?php echo $__env->renderComponent(); ?>
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
<?php /**PATH /home/gonulkop/public_html/resources/views/discovery/index.blade.php ENDPATH**/ ?>