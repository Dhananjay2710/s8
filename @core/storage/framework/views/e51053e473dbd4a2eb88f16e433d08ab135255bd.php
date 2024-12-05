<?php
    $navClasses = request()->is('/') ? 'navbar navbar-area white nav-absolute navbar-expand-lg navbar-border' : 'navbar navbar-area white navbar-expand-lg navbar-border';
?>
<header class="header-style-01">
    <nav class="<?php echo e($navClasses); ?> <?php echo e($page_post->page_class ?? ''); ?>">
        <div class="container container-two nav-container">
            <div class="responsive-mobile-menu">
                <div class="logo-wrapper">
                    <a href="<?php echo e(route('homepage')); ?>" class="logo">
                        <?php echo render_image_markup_by_attachment_id(get_static_option('site_white_logo')); ?>

                    </a>
                </div>

                <div class="onlymobile-device-account-navbar">
                    <div class="onlymobile-device-account-navbar-flex">
                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                    </div>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu_navbar_one" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>

            <div class="collapse navbar-collapse" id="bizcoxx_main_menu_navbar_one">
                <ul class="navbar-nav">
                    <?php echo render_frontend_menu($primary_menu); ?>

                </ul>
            </div>

            <div class="nav-right-content">
                <div class="navbar-right-inner">
                    <div class="info-bar-item">
                        <?php if(auth('web')->check() && Auth()->guard('web')->user()->unreadNotifications()->count() > 0): ?>
                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0): ?>
                                <div class="notification-icon icon">
                                    <?php if(Auth::guard('web')->check()): ?>
                                        <span class="text-white"> <i class="las la-bell"></i> </span>
                                        <span class="notification-number">
                                        <?php echo e(Auth()->user()->unreadNotifications()->count()); ?>

                                    </span>
                                    <?php endif; ?>

                                    <div class="notification-list-item mt-2">
                                        <h5 class="notification-title"><?php echo e(__('Notifications')); ?></h5>
                                        <div class="list">
                                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications()->count() >=1): ?>
                                                <span>

                                      <!-- seller ticket Notifications-->
                                        <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if(isset($notification->data['seller_last_ticket_id'])): ?>
                                                            <a class="list-order" href="<?php echo e(route('seller.support.ticket.view',$notification->data['seller_last_ticket_id'])); ?>">
                                                            <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                            <?php echo e($notification->data['order_ticcket_message']); ?> #<?php echo e($notification->data['seller_last_ticket_id']); ?>

                                                        </a>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                               <!-- seller order Notifications-->
                                            <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications()->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                <p class="text-center text-white padding-3"><?php echo e(__('No New Notification')); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.user-menu','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.user-menu'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</header><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/partials/pages-portion/navbars/navbar-01.blade.php ENDPATH**/ ?>