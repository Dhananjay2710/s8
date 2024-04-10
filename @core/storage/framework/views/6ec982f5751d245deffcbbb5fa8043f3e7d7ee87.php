<?php if(get_static_option('dashboard_variant_seller') == '02'): ?>
    <?php echo $__env->make('frontend.user.seller.day-and-schedule.partials.days-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('frontend.user.seller.day-and-schedule.partials.days-one', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/day-and-schedule/days.blade.php ENDPATH**/ ?>