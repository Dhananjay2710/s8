<?php if(get_static_option('dashboard_variant_seller') == '02'): ?>
    <?php echo $__env->make('frontend.user.seller.day-and-schedule.partials.schedules-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php else: ?>
    <?php echo $__env->make('frontend.user.seller.day-and-schedule.partials.schedules-one', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?><?php /**PATH /var/www/pinpointplus/s8/@core/resources/views/frontend/user/seller/day-and-schedule/schedules.blade.php ENDPATH**/ ?>