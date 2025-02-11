<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Provider Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .dashboard__notification__item:not(:last-child) {
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 16px;
            margin-bottom: 16px;
        }
    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.frontend.seller-buyer-preloader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('frontend.seller-buyer-preloader'); ?>
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
    <?php $default_lang = get_default_language(); ?>
    <!-- Dashboard area Starts -->
    <?php echo $__env->make('frontend.user.seller.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <!-- buyer header -->
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="row g-4">
                <?php if(moduleExists('Subscription') && $commissionGlobal->system_type == 'subscription' ): ?>
                    <?php if(empty(auth('web')->user()->subscribedSeller)): ?>
                        <div class="col-lg-12 mt-1">
                                <div class="alert alert-warning d-flex justify-content-between">
                                    <strong style="font-size: 16px"><?php echo e(__('you must have to subscribe any of our package in service request to start selling your services.')); ?></strong>
                                    <a href="<?php echo e(getSlugFromReadingSetting('price_plan_page') ? url('/'.getSlugFromReadingSetting('price_plan_page')) : url('/price-plan')); ?>" target="_self" class="btn btn-secondary"><?php echo e(__('view packages')); ?></a>
                                </div>
                        </div>
                    <?php else: ?>
                        
                        <?php if(!empty(Auth::guard('web')->user()->subscribedSeller)): ?>
                            <?php if(Carbon\Carbon::parse(auth('web')->user()->subscribedSeller->expire_date) <= \Carbon\Carbon::today()): ?>
                                <div class="alert alert-warning d-flex justify-content-between">
                                    <strong><?php echo e(__('your package has been expired, please renew it')); ?></strong>
                                    <a href="<?php echo e(getSlugFromReadingSetting('price_plan_page') ? url('/'.getSlugFromReadingSetting('price_plan_page')) : url('/price-plan')); ?>" target="_self" class="btn btn-secondary"><?php echo e(__('view packages')); ?></a>
                                </div>
                              <?php else: ?>
                                <div class="col-lg-12 mt-1">
                                    <div class="alert alert-info d-flex justify-content-between">
                                        <p><?php echo e(__('Your Subscribed Package:')); ?> <strong class="text-success">
                                                <?php echo e(auth('web')->user()?->subscribedSeller?->subscription?->title); ?></strong> <?php echo e(__('Expire Date:')); ?>

                                            <strong class="text-danger"><?php echo e(auth('web')->user()?->subscribedSeller->expire_date->format('d M Y')); ?></strong>
                                        </p>
                                    </div>
                                </div>
                             <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endif; ?>
                <div class="col-xxl-6 col-lg-12">
                    <div class="dashboard_promo__row row_col_2">
                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <a href="<?php echo e(route('seller.orders')); ?>">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Service Request In Progress')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"><?php echo e($active_order); ?></h4>
                                    </div>
                                    </a>
                                    <div class="dashboard_promo__icon">
                                        <i class="fa-solid fa-hourglass-end"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <a href="<?php echo e(route('seller.orders')); ?>">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Pending Service Request')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"><?php echo e($pending_order); ?></h4>
                                    </div>
                                    </a>
                                    <div class="dashboard_promo__icon">
                                        <i class="fa-solid fa-list-ul"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <a href="<?php echo e(route('seller.orders')); ?>">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Service Request Completed')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"><?php echo e($complete_order); ?></h4>
                                    </div>
                                    </a>
                                    <div class="dashboard_promo__icon">
                                        <i class="fa-regular fa-square-check"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <a href="<?php echo e(route('seller.orders')); ?>">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Total Service Request')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"><?php echo e($total_order); ?></h4>
                                    </div>
                                    </a>
                                    <div class="dashboard_promo__icon">
                                        <i class="fa-solid fa-clipboard-list"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <a href="<?php echo e(route('seller.payout')); ?>">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Total Withdraw')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"><?php echo e(float_amount_with_currency_symbol($total_earnings)); ?></h4>
                                    </div>
                                    </a>
                                    <div class="dashboard_promo__icon">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <a href="<?php echo e(route('seller.payout')); ?>">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Remaining Balance')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"> <?php echo e(float_amount_with_currency_symbol($remaning_balance - $total_earnings)); ?>

                                        </h4>
                                    </div>
                                    </a>
                                    <div class="dashboard_promo__icon">
                                        <i class="fa-solid fa-indian-rupee-sign"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Notifications Section start -->
                <div class="col-xxl-6 col-lg-12">
                    <div class="dashboard__notification bg-white padding-20 radius-10">
                        <div class="dashboard__notification__flex">
                            <h4 class="dashboard__notification__title"><?php echo e(__('Notifications')); ?></h4>
                            <a href="<?php echo e(route('seller.clear.notifications')); ?>" class="dashboard__notification__clearBtn"><?php echo e(__('Clear all')); ?></a>
                        </div>
                        <div class="dashboard__notification__inner profile_border_top">
                            <!--Buyer All Notifications start-->
                            
                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0): ?>
                                <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications->count() >=1): ?>
                                    <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="dashboard__notification__item">
                                        <div class="dashboard__notification__item__author">
                                            <div class="dashboard__header__notification__wrap__list__icon">
                                                <i class="las la-bell"></i>
                                            </div>
                                            <div class="dashboard__notification__item__author__contents">
                                                <p class="dashboard__notification__item__author__details">
                                                    <!--seller ticket notification -->
                                                    <?php if(isset($notification->data['seller_last_ticket_id'])): ?>
                                                    <a href="<?php echo e(route('seller.support.ticket.view',$notification->data['seller_last_ticket_id'])); ?>">
                                                    <?php echo e($notification->data['order_ticcket_message']); ?> #<?php echo e($notification->data['seller_last_ticket_id']); ?>

                                                    </a>
                                                    <?php endif; ?>
                                                    <!--seller order notification -->
                                                    <?php if(isset($notification->data['order_id'])): ?>
                                                        <a class="list-order" href="<?php echo e(route('seller.order.details',$notification->data['order_id'])); ?>">
                                                            <?php echo e($notification->data['order_message']); ?> #<?php echo e($notification->data['order_id']); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                </p>
                                                <span class="dashboard__notification__item__time"><?php echo e(date('Y/m/d h:i A', strtotime($notification->created_at))); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <p class="text-center padding-3" style="color:#111;"><?php echo e(__('No New Notification')); ?></p>
                            <?php endif; ?>
                         <?php endif; ?>
                        <!--Buyer All Notifications end-->
                        </div>
                    </div>
                </div>
                <!-- Notifications Section end -->
            </div>
                <div class="row g-4 mt-1">
                    <div class="col-xxl-12">
                        <div class="dashboard_recentOrder dashboard_border  bg-white padding-10 radius-10">
                            <h4 class="dashboard_recentOrder__title"><?php echo e(__('Recent Service Request')); ?></h4>
                            <div class="dashboard_recentOrder__inner">
                                <?php if($last_five_order->count() >= 1): ?>
                                    <div class="row g-4 mt-1">
                                        <?php $__currentLoopData = $last_five_order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-xxl-6 col-md-6 col-sm-6 col-xs-12">
                                          <div class="dashboard_recentOrder__item recentOrder_parent radius-10">
                                            <div class="dashboard_recentOrder__item__flex">
                                                <div class="dashboard_recentOrder__item__service">
                                                    <div class="dashboard_recentOrder__item__service__thumb">
                                                        <a href="<?php echo e(route('seller.order.details', $order->id)); ?>">
                                                            <?php if(!empty(render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'))): ?>
                                                                <?php echo render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'); ?>

                                                            <?php else: ?>
                                                                <img src="<?php echo e(asset('assets/frontend/img/no-image-one.jpg')); ?>" class="no_image_style_two" alt="No Image">
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>
                                                    <div class="dashboard_recentOrder__item__service__contents">
                                                        <a href="<?php echo e(route('seller.order.details', $order->id)); ?>" class="dashboard_recentOrder__item__service__id"><span><?php echo e(__('Service Request ID:')); ?></span> <?php echo e($order->id); ?></a>
                                                        <h4 class="dashboard_recentOrder__item__service__title mt-1">
                                                            <?php if(!empty($order->job_post_id)): ?>
                                                                <a href="<?php echo e(route('job.post.details', optional($order->job)->slug)); ?>"> <?php echo e(optional($order->job)->title); ?></a></h4>
                                                             <?php else: ?>
                                                            <a href="<?php echo e(route('service.list.details', optional($order->service)->slug)); ?>"> <?php echo e(optional($order->service)->title); ?></a></h4>
                                                            <?php endif; ?>
                                                        <p class="dashboard_recentOrder__item__service__buyer mt-2">
                                                            <?php echo e(__('Service Request Date:')); ?> <strong><?php echo e(Carbon\Carbon::parse($order->created_at)->format('d/m/y')); ?><?php echo e(__(',')); ?></strong>
                                                            <?php echo e(__('Customer:')); ?>   <a href="<?php echo e(route('about.buyer.profile',optional($order->buyer)->username)); ?>"> <?php echo e(optional($order->buyer)->name); ?> </a>
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="dashboard_recentOrder__item__icon">
                                                    <div class="dashboard_table__main__actions">
                                                        <a href="<?php echo e(route('seller.order.details', $order->id)); ?>" class="icon"><i class="fa-regular fa-eye"></i></a>
                                                    </div>
                                                    <span class="dashboard_recentOrder__item__icon__single toggle_recentOrder"><i class="fa-solid fa-angle-down"></i></span>
                                                </div>
                                            </div>
                                            <div class="dashboard_recentOrder__item__details recentOrder_children">
                                                <div class="dashboard_recentOrder__item__details__item">
                                                    <p class="dashboard_recentOrder__item__details__item__left"><?php echo e(__('Booking Date & Time:')); ?></p>
                                                    <?php if($order->date === 'No Date Created'): ?>
                                                        <p><?php echo e(__('No Date Created')); ?></p>
                                                        <?php else: ?>
                                                            <p class="dashboard_recentOrder__item__details__item__right"><?php echo e(Carbon\Carbon::parse($order->date)->format('d/m/y')); ?> <span><?php echo e($order->schedule); ?></span></p>
                                                      <?php endif; ?>
                                                </div>

                                                <div class="dashboard_recentOrder__item__details__item">
                                                    <p class="dashboard_recentOrder__item__details__item__left"><?php echo e(__('Service Request type:')); ?></p>
                                                    <p class="dashboard_recentOrder__item__details__item__right">
                                                        <?php $online = __('Online'); $offline = __('Offline')  ?>
                                                        <?php if($order->is_order_online == 1): ?> <?php echo e($online); ?> <?php else: ?> <?php echo e($offline); ?> <?php endif; ?>
                                                    </p>
                                                </div>
                                                <div class="dashboard_recentOrder__item__details__item">
                                                    <p class="dashboard_recentOrder__item__details__item__left"><?php echo e(__('Service Request amount:')); ?></p>
                                                    <p class="dashboard_recentOrder__item__details__item__right"><?php echo e(amount_with_currency_symbol($order->total)); ?></p>
                                                </div>
                                                <div class="dashboard_recentOrder__item__details__item">
                                                    <p class="dashboard_recentOrder__item__details__item__left"><?php echo e(__('Service Request status:')); ?></p>
                                                    <?php if($order->status == 0): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn pending"><?php echo e(__('Pending')); ?></a> </div> <?php endif; ?>
                                                    <?php if($order->status == 1): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn active"><?php echo e(__('Active')); ?></a> </div> <?php endif; ?>
                                                    <?php if($order->status == 2): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn completed"><?php echo e(__('Completed')); ?></a> </div> <?php endif; ?>
                                                    <?php if($order->status == 3): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn delivered"><?php echo e(__('Delivered')); ?></a> </div> <?php endif; ?>
                                                    <?php if($order->status == 4): ?><div class="dashboard_table__main__priority"><a href="javascript:void(0)" class="priorityBtn cancel"><?php echo e(__('Cancel')); ?></a> </div> <?php endif; ?>
                                                </div>
                                            </div>
                                          </div>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php else: ?>
                                    <p class="text-center padding-3" style="color:#111;"><?php echo e(__('No New Order')); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <div class="dashboard_table__wrapper dashboard_border  padding-10 radius-10 bg-white">
                            <h4 class="dashboard_table__title"><?php echo e(__('This Month Summery ')); ?></h4>
                            <div class="dashboard_promo__row row_col_2 mt-2">
                                <div class="dashboard_promo__col dashboard_promo__child">
                                    <div class="dashboard_promo bg-white">
                                        <div class="dashboard_promo__flex">
                                            <div class="dashboard_promo__contents">
                                                <span class="dashboard_promo__subtitle"><?php echo e(__('Service Request')); ?></span>
                                                <h4 class="dashboard_promo__title mt-2"><?php echo e($this_month_order_count); ?></h4>
                                            </div>
                                            <div class="dashboard_promo__icon">
                                                <i class="fa-solid fa-tasks"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard_promo__col dashboard_promo__child">
                                    <div class="dashboard_promo bg-white">
                                        <div class="dashboard_promo__flex">
                                            <div class="dashboard_promo__contents">
                                                <span class="dashboard_promo__subtitle"><?php echo e(__('Earning')); ?></span>
                                                <h4 class="dashboard_promo__title mt-2"><?php echo e(float_amount_with_currency_symbol($this_month_earnings)); ?></h4>
                                            </div>
                                            <div class="dashboard_promo__icon">
                                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard_promo__col dashboard_promo__child">
                                    <div class="dashboard_promo bg-white">
                                        <div class="dashboard_promo__flex">
                                            <div class="dashboard_promo__contents">
                                                <span class="dashboard_promo__subtitle"><?php echo e(__('Balance')); ?></span>
                                                <h4 class="dashboard_promo__title mt-2"><?php echo e(float_amount_with_currency_symbol($this_month_balance_without_tax_and_admin_commission)); ?></h4>
                                            </div>
                                            <div class="dashboard_promo__icon">
                                                <i class="fa-solid fa-indian-rupee-sign"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="dashboard_promo__col dashboard_promo__child">
                                    <div class="dashboard_promo bg-white">
                                        <div class="dashboard_promo__flex">
                                            <div class="dashboard_promo__contents">
                                                <span class="dashboard_promo__subtitle"><?php echo e(__('Total Customer')); ?></span>
                                                <h4 class="dashboard_promo__title mt-2"><?php echo e($buyer_count); ?></h4>
                                            </div>
                                            <div class="dashboard_promo__icon">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-6">
                        <div class="dashboard_table__wrapper dashboard_border  padding-10 radius-10 bg-white">
                            <h4 class="dashboard_table__title"><?php echo e(__('To Do List')); ?></h4>
                            <div class="text-end">
                                <a href="<?php echo e(route('seller.todolist')); ?>" class="dashboard__notification__clearBtn text-end"><?php echo e(__('See All')); ?></a>
                            </div>

                            <?php if($to_do_list->count() >= 1): ?>
                                <div class="dashboard_table__main custom--table mt-2">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th> <?php echo e(__('ID')); ?></th>
                                            <th> <?php echo e(__('Description')); ?></th>
                                            <th> <?php echo e(__('Action')); ?></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $__currentLoopData = $to_do_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $todo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="dashboard_table__main__ticket">
                                                        <a href="<?php echo e(route('seller.support.ticket.view', $todo->id)); ?>">
                                                            <span class="dashboard_table__main__ticket__id mt-2"> <?php echo e($todo->id); ?></span>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td><div class="dashboard_table__main__ticket"><?php echo e($todo->description); ?></div></td>
                                                <td>
                                                    <div class="dashboard_table__main__actions">
                                                        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-coupon-status','data' => ['url' => route('seller.todolist.status',$todo->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-coupon-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.todolist.status',$todo->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-center padding-3" style="color:#111;"><?php echo e(__('No New To Do List')); ?></p>
                            <?php endif; ?>

                        </div>
                    </div>
                    <div class="col-xl-6">
                        <!-- chat js -->
                        <div class="dashboard-middle-flex">
                            <div class="single-flex-middle margin-top-40">
                                <div class="line-charts-wrapper">
                                    <div class="line-top-contents">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Total Service Request Overview')); ?></h4>
                                    </div>
                                    <div class="line-charts">
                                        <canvas id="line-chart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <!-- chat js -->
                        <div class="single-flex-middle margin-top-40">
                            <div class="line-charts-wrapper">
                                <div class="line-top-contents">
                                    <h4 class="dashboard_table__title"><?php echo e(__('Weekly Work Summary')); ?> </h4>
                                </div>
                                <div class="group-bar-charts">
                                    <canvas id="bar-chart-grouped"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 </div><!-- Dashboard area end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        (function($){
            "use strict";

            $(document).ready(function(){

                $(document).on('click','.swal_delete_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure?")); ?>',
                        text: '<?php echo e(__("You would not be able to revert this item!")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, delete it!')); ?>"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });

                $(document).on('click','.swal_status_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to close status?")); ?>',
                        text: '<?php echo e(__("You will not able to open it!")); ?>',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "<?php echo e(__('Yes, change it!')); ?>"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $(this).next().find('.swal_form_submit_btn').trigger('click');
                        }
                    });
                });


                /* Line Charts */
                new Chart(document.getElementById("line-chart"), {
                    type: 'line',
                    data: {
                        labels: [<?php $__currentLoopData = $month_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                        datasets: [{
                            data: [<?php $__currentLoopData = $monthly_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                            label: "<?php echo e(__('Order')); ?>",
                            borderColor: "#1DBF73",
                            borderWidth: 3,
                            fill: false,
                            pointBorderWidth: 2,
                            pointBackgroundColor: '#fff',
                            pointRadius: 5,
                            pointHoverRadius: 5,
                            pointHoverBackgroundColor: "#1DBF73",
                        }]
                    },

                });


                /* Group Bar Charts */
                new Chart(document.getElementById("bar-chart-grouped"), {
                    type: 'bar',
                    data: {
                        labels: [<?php $__currentLoopData = $days_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                        datasets: [
                            {
                                label: "<?php echo e(__('Pending')); ?>",
                                backgroundColor: "#2F98DC",
                                data: [<?php $__currentLoopData = $pending_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                                barThickness: 10,
                                hoverBackgroundColor: '#fff',
                                hoverBorderColor: '#2F98DC',
                                borderColor: '#fff',
                                borderWidth: 2,
                            },
                            {
                                label: "<?php echo e(__('Active')); ?>",
                                backgroundColor: "#FFB307",
                                data: [<?php $__currentLoopData = $active_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                                barThickness: 10,
                                hoverBackgroundColor: '#fff',
                                hoverBorderColor: '#FFB307',
                                borderColor: '#fff',
                                borderWidth: 2,
                            },
                            {
                                label: "<?php echo e(__('Complete')); ?>",
                                backgroundColor: "#6560FF",
                                data: [<?php $__currentLoopData = $complete_order_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> "<?php echo e($list); ?>", <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>],
                                barThickness: 10,
                                hoverBackgroundColor: '#fff',
                                hoverBorderColor: '#6560FF',
                                borderColor: '#fff',
                                borderWidth: 2,
                            }
                        ],
                    },
                });


            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/dashboard/partials/dashboard-two.blade.php ENDPATH**/ ?>