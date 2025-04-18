<?php if(get_static_option('dashboard_variant_buyer') == '02'): ?>
    <?php echo $__env->make('frontend.user.seller.partials.header-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!--Dashboard Markup -->
    <div class="body-overlay"></div>
    <div class="dashboard__area <?php if((Auth::guard('web')->user()->user_type ?? 0) == 0): ?> seller_look <?php endif; ?>">
        <div class="container-fluid p-0">
            <div class="dashboard__contents__wrapper">
                <!-- <div class="dashboard__icon">
                    <div class="dashboard__icon__bars sidebar-icon">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div> -->
                 <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>
    <?php echo $__env->make('frontend.user.seller.partials.footer-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('frontend.user.seller.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('content'); ?>
    <?php echo $__env->make('frontend.user.seller.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

 <?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/buyer/buyer-master.blade.php ENDPATH**/ ?>