<div class="dashboard__left dashboard-left-content">
    <div class="dashboard__left__main">
        <div class="dashboard__left__close close-bars"> <i class="fa-solid fa-times"></i> </div>
        <div class="dashboard__top">
            <div class="dashboard__top__logo">
                <a href="<?php echo e(route('homepage')); ?>" class="logo" target="_blank">
                    <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                </a>
            </div>
        </div>
        <div class="dashboard__bottom mt-5">
            <ul class="dashboard__bottom__list dashboard-list">

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/dashboard*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.dashboard')); ?>"><i class="las la-chart-bar"></i> <?php echo e(__('Dashboard')); ?></a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/profile*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.profile')); ?>"><i class="las la-user-alt"></i> <?php echo e(__('Profile')); ?></a>
                </li>

                <?php if(moduleExists('LiveChat')): ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('seller/live-chat*')): ?> active <?php endif; ?> ">
                        <a href="<?php echo e(route('seller.live.chat')); ?>"><i class="las la-sms"></i> <?php echo e(__('Chat Inbox')); ?>  </a>
                    </li>
                <?php endif; ?>

                <?php if(moduleExists('Subscription') && $commissionGlobal->system_type === 'subscription' && Route::has('seller.subscription.all')): ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('seller/subscription*')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('seller.subscription.all')); ?>"> <i class="las la-th"></i> <?php echo e(__('Subscriptions')); ?> </a>
                    </li>
                <?php endif; ?>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/services*') || request()->is('seller/add-services*') || request()->is('seller/service-attributes*') || request()->is('seller/edit-services*') || request()->is('seller/edit-service-attributes*') || request()->is('seller/add-service-attributes-by-id*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.services')); ?>"> <i class="las la-cogs"></i><?php echo e(__('Services')); ?> </a>
                </li>
                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/coupons*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.service.coupon')); ?>"> <i class="las la-gifts"></i> <?php echo e(__('Service Coupons')); ?> </a>
                </li>
                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/days*') || request()->is('seller/add-day*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.days')); ?>"> <i class="las la-calendar-week"></i><?php echo e(__('Create Day')); ?> </a>
                </li>
                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/schedules*') || request()->is('seller/add-schedule*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.schedules')); ?>"> <i class="las la-clock"></i><?php echo e(__('Create Schedule')); ?> </a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/pending-orders')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.pending.orders')); ?>"> <i class="las la-tasks"></i> <?php echo e(__('Order Pending')); ?> </a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/orders*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.orders')); ?>"><i class="las la-list-alt"></i> <?php echo e(__('All Service Orders')); ?> </a>
                </li>

                <?php if(moduleExists('JobPost')): ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('seller/job-orders*')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('seller.job.orders')); ?>"> <i class="las la-bars"></i> <?php echo e(__('All Job Orders')); ?></a>
                    </li>
                <?php endif; ?>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/notification/all-notifications*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.notification.all')); ?>"><i class="las la-bell"></i> <?php echo e(__('All Notifications')); ?></a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/payout-request*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.payout')); ?>"> <i class="las la-dollar-sign"></i><?php echo e(__('Payout History')); ?> </a>
                </li>
                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/service-reviews*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.service.review')); ?>"> <i class="lar la-star"></i><?php echo e(__('Review')); ?></a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/all-tickets*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.support.ticket')); ?>"><i class="las la-ticket-alt"></i> <?php echo e(__('Support Ticket')); ?></a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/order/report/list*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.order.report.list')); ?>"> <i class="las la-file-alt"></i> <?php echo e(__('Reports List')); ?> </a>
                </li>


                <?php if(moduleExists('Wallet')): ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('seller/wallet-history*')): ?> active <?php endif; ?> ">
                        <a href="<?php echo e(route('seller.wallet.history')); ?>"><i class="las la-wallet"></i> <?php echo e(__('Wallet')); ?>  </a>
                    </li>
                <?php endif; ?>

                <?php if(moduleExists('JobPost')): ?>
                    <?php
                        $jobs = \Modules\JobPost\Entities\BuyerJob::whereDoesntHave('sellerViewJobs', function ($list){
                           $list->where('seller_id', Auth::guard('web')->user()->id);
                        })->latest()->count();
                    ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('seller/job/notification/new/jobs*')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('seller.new.jobs')); ?>"> <i class="las la-briefcase"></i> <?php echo e(__('New Jobs')); ?>

                            <span class="badge badge-danger" style="color: #2163b3; border: solid 2px"><?php echo e($jobs); ?></span></a>
                    </li>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('seller/job/request/*')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('seller.all.jobs.request')); ?>"> <i class="las la-briefcase"></i> <?php echo e(__('All Jobs Request')); ?> </a>
                    </li>
                <?php endif; ?>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/to-do-list*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.todolist')); ?>"> <i class="las la-list"></i><?php echo e(__('Todo List')); ?></a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/seller-profile-verify*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.profile.verify')); ?>"> <i class="las la-user"></i> <?php echo e(__('Profile Verify')); ?> </a>
                </li>
                <li class="dashboard__bottom__list__item <?php if(request()->is('seller/account-settings*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('seller.account.settings')); ?>"> <i class="las la-cog"></i> <?php echo e(__('Settings')); ?> </a>
                </li>

                <li class="dashboard__bottom__list__item">
                    <a href="<?php echo e(route('seller.logout')); ?>"> <i class="las la-sign-out-alt"></i> <?php echo e(__('Log Out' )); ?> </a>
                </li>

            </ul>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/partials/sidebar-two.blade.php ENDPATH**/ ?>