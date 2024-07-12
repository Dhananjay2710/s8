<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Customer Dashboard')); ?>

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
    <!-- buyer sidebar -->
    <?php echo $__env->make('frontend.user.buyer.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <!-- buyer header -->
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__body">
        <div class="dashboard__inner">
            <div class="row g-4">
                <div class="col-xxl-6 col-lg-12">
                    <div class="dashboard_promo__row row_col_2">
                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <a href="<?php echo e(route('buyer.orders')); ?>">
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
                                    <a href="<?php echo e(route('buyer.orders')); ?>">
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
                                    <a href="<?php echo e(route('buyer.orders')); ?>">
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
                                    <a href="<?php echo e(route('buyer.orders')); ?>">
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
                    </div>
                </div>
                <!-- Notifications Section start -->
                <div class="col-xxl-6 col-lg-12">
                    <div class="dashboard__notification bg-white padding-20 radius-10">
                        <div class="dashboard__notification__flex">
                            <h4 class="dashboard__notification__title"><?php echo e(__('Notifications')); ?></h4>
                            <a href="<?php echo e(route('buyer.clear.notifications')); ?>" class="dashboard__notification__clearBtn"><?php echo e(__('Clear all')); ?></a>
                        </div>
                        <div class="dashboard__notification__inner profile_border_top">
                            <!--Buyer All Notifications start-->
                            
                            <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==1): ?>
                                <?php if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications->count() >=1): ?>
                                    <?php $__currentLoopData = Auth::guard('web')->user()->unreadNotifications->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="dashboard__notification__item">
                                        <div class="dashboard__notification__item__author">
                                            <div class="dashboard__header__notification__wrap__list__icon">
                                                <i class="las la-bell"></i>
                                            </div>
                                            <?php if(isset($notification->data['last_ticket_id'])): ?>
                                            <div class="dashboard__notification__item__author__contents">
                                                <p class="dashboard__notification__item__author__details">
                                                    <?php $ticket_id_find = \App\SupportTicket::find($notification->data['last_ticket_id']) ?>
                                                        <a href="<?php if(!empty($ticket_id_find)): ?> <?php echo e(route('buyer.support.ticket.view',$notification->data['last_ticket_id'])); ?> <?php endif; ?> ">
                                                        <?php echo e($notification->data['order_ticcket_message']); ?> #<?php echo e($notification->data['last_ticket_id']); ?>

                                                        </a>
                                                </p>
                                                <span class="dashboard__notification__item__time"><?php echo e(date('Y/m/d h:i A', strtotime($notification->created_at))); ?></span>
                                            </div>
                                            <?php endif; ?>
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
                <div class="col-xxl-5">
                    <div class="dashboard_recentOrder dashboard_border  bg-white padding-20 radius-10">
                        <h4 class="dashboard_recentOrder__title"><?php echo e(__('Recent Service Request')); ?></h4>
                        <div class="dashboard_recentOrder__inner">
                            <?php if($last_6_order_dash_two->count() >= 1): ?>
                            <?php $__currentLoopData = $last_6_order_dash_two; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="dashboard_recentOrder__item recentOrder_parent radius-10 mt-3">
                                <div class="dashboard_recentOrder__item__flex">
                                    <div class="dashboard_recentOrder__item__service">
                                        <?php if(!empty($order->service->image)): ?>
                                            <a href="<?php echo e(route('buyer.order.details', $order->id)); ?>" >
                                             <div class="dashboard_recentOrder__item__service__thumb" style="height: 120px; width: 120px">
                                            <?php if(!empty(render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'))): ?>
                                                <?php echo render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'); ?>

                                            <?php else: ?>
                                                <img src="<?php echo e(asset('assets/frontend/img/no-image-one.jpg')); ?>" class="no_image_style_two" alt="No Image">
                                            <?php endif; ?>
                                              </div>
                                           </a>
                                        <?php endif; ?>

                                        <div class="dashboard_recentOrder__item__service__contents">
                                            <a href="<?php echo e(route('buyer.order.details', $order->id)); ?>" class="dashboard_recentOrder__item__service__id"><span><?php echo e(__('Service Request ID:')); ?></span> <?php echo e($order->id); ?></a>
                                            <h4 class="dashboard_recentOrder__item__service__title mt-1">
                                                <?php if(!empty($order->job_post_id)): ?>

                                                    <a href="<?php echo e(route('job.post.details', optional($order->job)->slug)); ?>"> <?php echo e(optional($order->job)->title); ?></a></h4>
                                                 <?php else: ?>
                                                <a href="<?php echo e(route('service.list.details', optional($order->service)->slug)); ?>"> <?php echo e(optional($order->service)->title); ?></a></h4>
                                                <?php endif; ?>
                                            <p class="dashboard_recentOrder__item__service__buyer mt-2">
                                                <?php echo e(__('Service Request Date:')); ?> <strong><?php echo e(Carbon\Carbon::parse($order->created_at)->format('d/m/y')); ?><?php echo e(__(',')); ?></strong>
                                                <?php echo e(__('Service Provider:')); ?>   <a href="<?php echo e(route('about.seller.profile',optional($order->seller)->username)); ?>"> <?php echo e(optional($order->seller)->name); ?> </a>
                                            </p>
                                        </div>
                                    </div>

                                    <div class="dashboard_recentOrder__item__icon">
                                        <div class="dashboard_table__main__actions">
                                            <a href="<?php echo e(route('buyer.order.details', $order->id)); ?>" class="icon"><i class="fa-regular fa-eye"></i></a>
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
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <p class="text-center padding-3" style="color:#111;"><?php echo e(__('No New Order')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-7">
                    <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                        <h4 class="dashboard_table__title"><?php echo e(__('Recent Ticket')); ?></h4>
                        <?php if($last_10_tickets->count() >= 1): ?>
                        <div class="dashboard_table__main custom--table mt-4">
                            <table>
                                <thead>
                                <tr>
                                    <th> <?php echo e(__('Ticket Name/ID')); ?></th>
                                    <th> <?php echo e(__('Service Request ID')); ?></th>
                                    <th> <?php echo e(__('Priority')); ?></th>
                                    <th> <?php echo e(__('Status')); ?></th>
                                    <th> <?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $last_10_tickets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ticket): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <div class="dashboard_table__main__ticket">
                                            <a href="<?php echo e(route('buyer.support.ticket.view', $ticket->id)); ?>">
                                            <h5 class="dashboard_table__main__ticket__title"><?php echo e($ticket->title); ?></h5>
                                            <span class="dashboard_table__main__ticket__id mt-2"><?php echo e(__('Ticket ID:')); ?> <?php echo e($ticket->id); ?></span>
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dashboard_table__main__orderId"><?php echo e($ticket->order_id); ?></div>
                                    </td>
                                    <td>
                                        <div class="dashboard_table__main__priority">
                                            <?php if($ticket->priority == 'high'): ?>  <a href="javascript:void(0)" class="priorityBtn high"><?php echo e(__('High')); ?> </a><?php endif; ?>
                                            <?php if($ticket->priority == 'low'): ?>  <a href="javascript:void(0)" class="priorityBtn low"><?php echo e(__('Low')); ?> </a><?php endif; ?>
                                            <?php if($ticket->priority == 'medium'): ?>  <a href="javascript:void(0)" class="priorityBtn medium"><?php echo e(__('Medium')); ?> </a><?php endif; ?>
                                            <?php if($ticket->priority == 'urgent'): ?>  <a href="javascript:void(0)" class="priorityBtn urgent"><?php echo e(__('Urgent')); ?> </a><?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dashboard_table__main__status dropdown__status">
                                                <?php if($ticket->status === 'open'): ?>
                                                    <a href="javascript:void(0)"  class="dashboard_table__main__status__select dropdown__status__main Open">
                                                        <?php echo e(__(ucfirst($ticket->status))); ?></a>
                                                <?php else: ?>
                                                    <a href="javascript:void(0)" class="dashboard_table__main__status__select dropdown__status__main Close">
                                                        <?php echo e(__(ucfirst($ticket->status))); ?></a>
                                                <?php endif; ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="dashboard_table__main__actions">
                                            <a href="<?php echo e(route('buyer.support.ticket.view', $ticket->id)); ?>" class="icon"><i class="fa-regular fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <?php else: ?>
                            <p class="text-center padding-3" style="color:#111;"><?php echo e(__('No New Ticket')); ?></p>
                        <?php endif; ?>
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

            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/buyer/dashboard/partials/dashboard-two.blade.php ENDPATH**/ ?>