<div class="hero-3d" data-hero-3d aria-hidden="true">
    <div class="hero-3d__ambient hero-3d__ambient--one"></div>
    <div class="hero-3d__ambient hero-3d__ambient--two"></div>

    <div class="hero-3d__tilt">
        <div class="hero-3d__stage">
            <div class="hero-3d__core">
                <div class="hero-3d__core-glass"></div>
                <div class="hero-3d__core-glow"></div>
                <svg viewBox="0 0 24 24" class="hero-3d__heart">
                    <path d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"/>
                </svg>
            </div>

            <div class="hero-3d__orbit hero-3d__orbit--outer">
                <span class="hero-3d__bead hero-3d__bead--one"></span>
                <span class="hero-3d__bead hero-3d__bead--two"></span>
                <span class="hero-3d__bead hero-3d__bead--three"></span>
            </div>

            <div class="hero-3d__orbit hero-3d__orbit--inner">
                <span class="hero-3d__bead hero-3d__bead--four"></span>
                <span class="hero-3d__bead hero-3d__bead--five"></span>
            </div>

            <div class="hero-3d__card hero-3d__card--one">
                <div class="hero-3d__card-inner">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=240&q=85" alt="" loading="eager">
                    <span><strong>Elif</strong><small>İstanbul</small></span>
                    <i></i>
                </div>
            </div>

            <div class="hero-3d__card hero-3d__card--two">
                <div class="hero-3d__card-inner">
                    <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=240&q=85" alt="" loading="eager">
                    <span><strong>Mert</strong><small>İstanbul</small></span>
                    <i></i>
                </div>
            </div>

            <div class="hero-3d__card hero-3d__card--three">
                <div class="hero-3d__card-inner">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=240&q=85" alt="" loading="eager">
                    <span><strong>Selin</strong><small>İzmir</small></span>
                    <i></i>
                </div>
            </div>

            <div class="hero-3d__match">
                <span class="hero-3d__match-icon">
                    <svg viewBox="0 0 24 24"><path d="M12 21.35 10.55 20C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09A6.02 6.02 0 0 1 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35Z"/></svg>
                </span>
                <span><strong>Yeni bağlantı</strong><small>Seni bekliyor</small></span>
            </div>

            <?php $__currentLoopData = range(1, 12); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $particle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="hero-3d__particle hero-3d__particle--<?php echo e($particle); ?>"></span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php /**PATH /home/gonulkop/public_html/resources/views/components/marketing/hero-3d.blade.php ENDPATH**/ ?>