<?php if(Auth::guard('web')->check()): ?>



<div class="login-account">
    <div class="info-bar-item d-lg-none">
        <?php if(auth('web')->check() && Auth()->guard('web')->user()->unreadNotifications()->count() > 0): ?>
            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0): ?>
                <div class="notification-icon icon">
                    <?php if(Auth::guard('web')->check()): ?>
                        <i class="las la-bell"></i>
                        <span class="notification-number">
                    <?php echo e(Auth()->user()->unreadNotifications()->where('data->order_message' , 'You have a new order')->count()); ?>

                </span>
                    <?php endif; ?>

                    <div class="notification-list-item mt-2">
                        <h5 class="notification-title"><?php echo e(__('Notifications')); ?></h5>
                        <div class="list">
                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications()->where('data->order_message' , 'You have a new order')->count() >=1): ?>
                                <span>
                            <?php $__currentLoopData = Auth::user()->unreadNotifications->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(isset($notification->data['order_id'])): ?>
                                            <a class="list-order" href="<?php echo e(route('seller.order.details',$notification->data['order_id'])); ?>">
                                        <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                        <?php echo e($notification->data['order_message']); ?> #<?php echo e($notification->data['order_id']); ?>

                                    </a>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </span>
                                <a class="p-2 text-center d-block" href="<?php echo e(route('seller.notification.all')); ?>"><?php echo e(__('View All Notification')); ?></a>
                            <?php else: ?>
                                <p class="text-center padding-3"><?php echo e(__('No New Notification')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="info-bar-item-two">
        <div class="author-thumb">
            <?php if(!empty(Auth::guard('web')->user()->image)): ?>
                <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image); ?>

            <?php else: ?>
                <img src="<?php echo e(asset('assets/frontend/img/static/user_profile.png')); ?>" alt="No Image">
            <?php endif; ?>

        </div>
        <a class="accounts loggedin" href="javascript:void(0)">
            <span class="title"> <?php echo e(Auth::guard('web')->user()->name); ?> </span>
        </a>
        <ul class="account-list-item mt-2">
            <li class="list">
                <?php if(Auth::guard('web')->user()->user_type==0): ?>
                <a href="<?php echo e(route('seller.dashboard')); ?>"> <?php echo e(__('Dashboard')); ?> </a>
                <?php else: ?>
                <a href="<?php echo e(route('buyer.dashboard')); ?>"> <?php echo e(__('Dashboard')); ?> </a>
                <?php endif; ?>
            </li>
            <li class="list"> <a href="<?php echo e(route('seller.logout')); ?>"> <?php echo e(__('Logout')); ?> </a> </li>
        </ul>
    </div>
</div>

<?php else: ?>
    <div class="login-account">
        <a class="accounts" href="javascript:void(0)"> <span class="account"><?php echo e(__('Account')); ?></span> <i class="las la-user"></i> </a>
        <ul class="account-list-item mt-2">
            <li class="list"> <a href="<?php echo e(route('user.register')); ?>"> <?php echo e(__('Sign Up')); ?> </a> </li>
            <li class="list"> <a href="<?php echo e(route('user.login')); ?>"><?php echo e(__('Sign In')); ?> </a> </li>
        </ul>
    </div>
<?php endif; ?>


<?php /**PATH /var/www/pinpointplus/s8/@core/resources/views/components/frontend/user-menu.blade.php ENDPATH**/ ?>