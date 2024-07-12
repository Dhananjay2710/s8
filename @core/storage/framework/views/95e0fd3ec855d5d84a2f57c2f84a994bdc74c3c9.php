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

                <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/dashboard*')): ?> active <?php elseif(request()->is('customer/dashboard*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.dashboard')); ?>"><i class="las la-chart-bar"></i> <?php echo e(__('Dashboard')); ?></a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/profile*')): ?> active <?php elseif(request()->is('customer/profile*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.profile')); ?>"><i class="las la-user-alt"></i> <?php echo e(__('Profile')); ?></a>
                </li>

                <?php if(moduleExists('LiveChat')): ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/live-chat*')): ?> active <?php elseif(request()->is('customer/live-chat*')): ?> active <?php endif; ?> ">
                        <a href="<?php echo e(route('buyer.live.chat')); ?>"><i class="las la-sms"></i> <?php echo e(__('Chat Inbox')); ?>  </a>
                    </li>
                <?php endif; ?>

                <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/orders*')): ?> active <?php elseif(request()->is('customer/orders*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.orders')); ?>"><i class="las la-list-alt"></i> <?php echo e(__('All Service Orders')); ?> </a>
                </li>

                <?php if(moduleExists('JobPost')): ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/job-orders*')): ?> active <?php elseif(request()->is('customer/job-orders*')): ?> active <?php endif; ?>">
                        <a href="<?php echo e(route('buyer.job.orders')); ?>"> <i class="las la-bars"></i> <?php echo e(__('All Job Orders')); ?></a>
                    </li>
                <?php endif; ?>

                <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/notification/all-notifications*')): ?> active <?php elseif(request()->is('customer/notification/all-notifications*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.notification.all')); ?>"><i class="las la-bell"></i> <?php echo e(__('All Notifications')); ?></a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/all-tickets*')): ?> active <?php elseif(request()->is('customer/all-tickets*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.support.ticket')); ?>"><i class="las la-ticket-alt"></i> <?php echo e(__('Support Ticket')); ?></a>
                </li>

                <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/order/report/list*')): ?> active <?php elseif(request()->is('customer/order/report/list*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.order.report.list')); ?>"> <i class="las la-file-alt"></i> <?php echo e(__('Reports List')); ?> </a>
                </li>


                <?php if(moduleExists('Wallet')): ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/wallet-history*')): ?> active <?php elseif(request()->is('customer/wallet-history*')): ?> active <?php endif; ?> ">
                        <a href="<?php echo e(route('buyer.wallet.history')); ?>"><i class="las la-wallet"></i> <?php echo e(__('Wallet')); ?>  </a>
                    </li>
                <?php endif; ?>

                <?php if(moduleExists('JobPost')): ?>
                    <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/jobpost*')): ?> active <?php elseif(request()->is('customer/jobpost*')): ?> active <?php endif; ?> ">
                        <a href="<?php echo e(route('buyer.all.jobs')); ?>"><i class="las la-briefcase"></i> <?php echo e(__('Jobs')); ?>

                            <span class="badge_notification">
                             <?php $buyer_all_job_count = \Modules\JobPost\Entities\BuyerJob::where('buyer_id', \Illuminate\Support\Facades\Auth::guard('web')->user()->id)->count();  ?>
                                <?php echo e($buyer_all_job_count); ?>

                            </span>
                        </a>
                    </li>

                    <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/job/request/all*')): ?> active <?php elseif(request()->is('customer/job/request/all*')): ?> active <?php endif; ?> ">
                         <?php
                             $buyer_job_id = \Modules\JobPost\Entities\BuyerJob::where('buyer_id', \Illuminate\Support\Facades\Auth::guard('web')->user()->id)->pluck('id')->toArray();
                             $buyer_all_job_request = \Modules\JobPost\Entities\JobRequest::whereIn('job_post_id', $buyer_job_id)->count();
                        ?>
                        <a href="<?php echo e(route('buyer.all.jobs.request')); ?>"><i class="las la-briefcase"></i>  <?php echo e(__('Jobs Request')); ?> <span class="badge_notification"> <?php echo e($buyer_all_job_request); ?> </span> </a>
                    </li>
                <?php endif; ?>


                <li class="dashboard__bottom__list__item <?php if(request()->is('buyer/account-settings*')): ?> active <?php elseif(request()->is('customer/account-settings*')): ?> active <?php endif; ?>">
                    <a href="<?php echo e(route('buyer.account.settings')); ?>"> <i class="las la-cog"></i> <?php echo e(__('Settings')); ?> </a>
                </li>
                <li class="dashboard__bottom__list__item">
                    <a href="<?php echo e(route('buyer.logout')); ?>"> <i class="las la-sign-out-alt"></i> <?php echo e(__('Log Out' )); ?> </a>
                </li>

            </ul>
        </div>
    </div>
</div><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/buyer/partials/sidebar-two.blade.php ENDPATH**/ ?>