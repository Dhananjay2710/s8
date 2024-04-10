<div class="dashboard__header single_border_bottom">
    <div class="row g-4 justify-content-between">
        <div class="col-sm-6">
            <div class="dashboard__header__left">
                <h4 class="dashboard__header__title"><?php echo e(\Illuminate\Support\Facades\Auth::guard('web')->user()->name); ?> </h4>
                <p class="dashboard__header__para mt-2"><?php echo e(__('Manage your accounts activity from here')); ?></p>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="dashboard__header__right">
                <div class="dashboard__header__right__flex">
                    <div class="dashboard__header__right__item">

                        <div class="dashboard__header__notification">
                            <a href="javascript:void(0)" class="dashboard__header__notification__icon"> <i class="fa-solid fa-bell"></i> </a>
                            <span class="dashboard__header__notification__number"><?php echo e(Auth::user()->unreadNotifications->count()); ?></span>
                            <div class="dashboard__header__notification__wrap">
                                <h6 class="dashboard__header__notification__wrap__title"><?php echo e(__('Notifications')); ?></h6>
                                <ul class="dashboard__header__notification__wrap__list">
                                    <!--Buyer All Notifications start-->
                                    
                                    <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==1): ?>
                                        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications->count() >=1): ?>
                                            <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="dashboard__header__notification__wrap__list__item">
                                                    <div class="dashboard__header__notification__wrap__list__flex">
                                                        <a class="dashboard__header__notification__wrap__list__contents__title"
                                                           href="<?php echo e(route('buyer.support.ticket.view',$notification->data['last_ticket_id'])); ?>">
                                                        <div class="dashboard__header__notification__wrap__list__icon">
                                                            <i class="las la-bell"></i>
                                                        </div>
                                                        <div class="dashboard__header__notification__wrap__list__contents">
                                                                <?php echo e($notification->data['order_ticcket_message']); ?> #<?php echo e($notification->data['last_ticket_id']); ?>

                                                            <span class="dashboard__header__notification__wrap__list__contents__sub"> <?php echo e(date('Y/m/d h:i A', strtotime($notification->created_at))); ?></span>
                                                        </div>
                                                        </a>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <p class="text-center padding-3 mt-2" style="color:#111;"><?php echo e(__('No New Notification')); ?></p>
                                        <?php endif; ?>
                                        <div class="text-center mt-3">
                                            <a href="<?php echo e(route('buyer.notification.all')); ?>" class="dashboard__notification__clearBtn"><?php echo e(__('View all')); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <!--Buyer All Notifications end-->

                                    <!--Seller All Notifications start-->
                                    
                                    <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0): ?>
                                        <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications->count() >=1): ?>
                                            <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <!--seller order support ticket notification -->
                                                <?php if(isset($notification->data['seller_last_ticket_id'])): ?>
                                                    <li class="dashboard__header__notification__wrap__list__item">
                                                        <div class="dashboard__header__notification__wrap__list__flex">
                                                            <a class="dashboard__header__notification__wrap__list__contents__title"
                                                               href="<?php echo e(route('seller.support.ticket.view',$notification->data['seller_last_ticket_id'])); ?>">
                                                            <div class="dashboard__header__notification__wrap__list__icon">
                                                                <i class="las la-bell"></i>
                                                            </div>
                                                            <div class="dashboard__header__notification__wrap__list__contents">
                                                                    <?php echo e($notification->data['order_ticcket_message']); ?> #<?php echo e($notification->data['seller_last_ticket_id']); ?>

                                                                <span class="dashboard__header__notification__wrap__list__contents__sub"> <?php echo e(date('Y/m/d h:i A', strtotime($notification->created_at))); ?></span>
                                                            </div>
                                                            </a>
                                                         </div>
                                                    </li>
                                                <?php endif; ?>

                                            <!--seller order notification -->
                                                <?php if(isset($notification->data['order_id'])): ?>
                                                    <li class="dashboard__header__notification__wrap__list__item">
                                                        <div class="dashboard__header__notification__wrap__list__flex">
                                                            <a class="dashboard__header__notification__wrap__list__contents__title"
                                                               href="<?php echo e(route('seller.order.details',$notification->data['order_id'])); ?>">
                                                            <div class="dashboard__header__notification__wrap__list__icon"> <i class="las la-bell"></i> </div>
                                                            <div class="dashboard__header__notification__wrap__list__contents">
                                                                    <?php echo e($notification->data['order_message']); ?> #<?php echo e($notification->data['order_id']); ?>

                                                                <span class="dashboard__header__notification__wrap__list__contents__sub"> <?php echo e(date('Y/m/d h:i A', strtotime($notification->created_at))); ?></span>
                                                            </div>
                                                            </a>
                                                        </div>
                                                    </li>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            <p class="text-center padding-3 mt-2" style="color:#111;"><?php echo e(__('No New Notification')); ?></p>
                                        <?php endif; ?>
                                        <div class="text-center mt-3">
                                            <a href="<?php echo e(route('seller.notification.all')); ?>" class="dashboard__notification__clearBtn"><?php echo e(__('View all')); ?></a>
                                        </div>
                                    <?php endif; ?>
                                    <!--Seller All Notifications end-->
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="dashboard__header__right__item">
                        <div class="dashboard__header__author">
                            <a href="javascript:void(0)" class="dashboard__header__author__flex flex-btn">
                                <div class="dashboard__header__author__thumb">
                                    <?php if(!is_null(Auth::guard('web')->user()->image)): ?>
                                        <?php echo render_image_markup_by_attachment_id(Auth::guard('web')->user()->image); ?>

                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/frontend/img/no-image.jpg')); ?>" alt="authorImg">
                                    <?php endif; ?>
                                </div>
                            </a>
                            <div class="dashboard__header__author__wrapper">
                                <div class="dashboard__header__author__wrapper__list">
                                    <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==1): ?>
                                        <a href="<?php echo e(route('buyer.profile')); ?>" class="dashboard__header__author__wrapper__list__item"><?php echo e(__('Profile')); ?></a>
                                        <a href="<?php echo e(route('buyer.account.settings')); ?>" class="dashboard__header__author__wrapper__list__item"><?php echo e(__('Settings')); ?></a>
                                    <?php endif; ?>
                                    <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0): ?>
                                        <a href="<?php echo e(route('seller.profile')); ?>" class="dashboard__header__author__wrapper__list__item"><?php echo e(__('Profile')); ?></a>
                                        <a href="<?php echo e(route('seller.account.settings')); ?>" class="dashboard__header__author__wrapper__list__item"><?php echo e(__('Settings')); ?></a>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('seller.logout')); ?>" class="dashboard__header__author__wrapper__list__item"><?php echo e(__('Logout')); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/buyer/header/buyer-header.blade.php ENDPATH**/ ?>