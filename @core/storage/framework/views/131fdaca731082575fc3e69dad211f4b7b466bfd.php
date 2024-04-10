<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Pending Orders')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .btn-wrapper .cmn-btn.btn-bg-3 {
            background: var(--main-color-three);
            color: #fff;
        }
        .btn-wrapper .cmn-btn {
            color: var(--paragraph-color);
            font-size: 15px;
            font-weight: 500;
            font-family: var(--body-font);
            display: inline-block;
            border-radius: 5px;
            text-transform: capitalize;
            text-align: center;
            cursor: pointer;
            line-height: 24px;
            padding: 10px 17px;
            -webkit-transition: all .3s ease-in;
            transition: all .3s ease-in;
        }
        .dashboard_jobPost__views__para{
            font-size: 14px;
        }
        .close{
            border: none;
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
    <?php echo $__env->make('frontend.user.seller.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.error','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.error'); ?>
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
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.msg.success','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('msg.success'); ?>
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
                <!-- search section start-->
                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="dashboard__wallet">
                        <form action="<?php echo e(route('seller.pending.orders')); ?>" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Search Order Pending Module')); ?></h4> <i class="las la-angle-down search_by_all"></i>
                                    </button>
                                </div>
                                <div class="dashboard__headerGlobal__btn">
                                    <div class="btn-wrapper">
                                        <button href="#" class="dashboard_table__title__btn btn-bg-1 radius-5" type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i> <?php echo e(__('Search')); ?></button>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div id="collapseOne" class="accordion-collapse collapse
                                <?php if(request()->get('order_id')): ?>  show
                                <?php elseif(request()->get('order_date')): ?> show
                                <?php endif; ?>
                             " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-settings">
                                                    <div class="single-dashboard-input">
                                                        <div class="row g-4 mt-3">
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="order_id" class="info-title"> <?php echo e(__('Order ID')); ?> </label>
                                                                    <input class="form--control" name="order_id" value="<?php echo e(request()->get('order_id')); ?>" type="text" placeholder="<?php echo e(__('Order ID')); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="order_date" class="info-title"> <?php echo e(__('Created Date Range')); ?> </label>
                                                                    <input class="form--control flatpickr_input" value="<?php echo e(request()->get('order_date')); ?>" name="order_date" type="text" value="<?php echo e(request()->get('order_date')); ?>" placeholder="<?php echo e(__('Created Date Range')); ?>">
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--search section end-->
                <div class="dashboard__headerContents">
                    <div class="dashboard__headerContents__flex">
                        <div class="dashboard__headerContents__left">
                            <h4 class="dashboard__headerContents__title"> <?php echo e(__('Order Request')); ?>(<?php echo e($pending_orders->total()); ?>) </h4>
                        </div>
                    </div>
                </div>
                <?php if($pending_orders->count() > 0): ?>
                    <div class="row g-4">
                        <?php $__currentLoopData = $pending_orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xxl-6 col-lg-12 col-md-12">
                                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                                    <div class="dashboard_jobPost">
                                        <div class="dashboard_jobPost__flex">
                                            <div class="dashboard_jobPost__author">
                                                <div class="dashboard_jobPost__author__thumb mt-4">
                                                    <a href="<?php echo e(route('seller.order.details', $order->id)); ?>">
                                                    <?php if(!empty(render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'))): ?>
                                                       <?php echo render_image_markup_by_attachment_id(optional($order->service)->image, '', 'thumb'); ?>

                                                    <?php else: ?>
                                                        <img src="<?php echo e(asset('assets/frontend/img/no-image-one.jpg')); ?>" class="no_image_style_two" alt="No Image">
                                                    <?php endif; ?>
                                                    </a>
                                                </div>
                                                <div class="dashboard_jobPost__author__contents">
                                                    <a target="_blank" href="<?php echo e(route('seller.order.details', $order->id)); ?>">
                                                    <h4 class="dashboard_jobPost__author__title">
                                                     <?php echo e(optional($order->service)->title); ?>

                                                    </h4>
                                                    <strong class="label_title mt-2"> <?php echo e(__('Order').' #'.$order->id); ?> </strong>
                                                    </a>

                                                    <div class="dashboard_jobPost__views mt-3">
                                                        <div class="dashboard_jobPost__views__item">
                                                            <?php if($order->status==0): ?>
                                                            <div class="btn-wrapper pending">
                                                                <a href="javascript:void(0)" class="dashboard_table__title__btn btn-bg-1 radius-5"><?php echo e(__('New Request')); ?></a>
                                                            </div>
                                                            <?php endif; ?>
                                                            <?php if($order->status==1): ?>
                                                                <div class="btn-wrapper completed">
                                                                    <a href="javascript:void(0)" class="dashboard_table__title__btn btn-bg-1 radius-5"><?php echo e(__('Active Orders')); ?></a>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="dashboard_jobPost__views__item">
                                                            <strong class="replaceText text-success">  <?php echo e(float_amount_with_currency_symbol($order->total)); ?> </strong>
                                                        </div>

                                                        <div class="dashboard_jobPost__views__item">
                                                            <span class="dashboard_jobPost__views__para"><?php echo e(__('Date & Schedule:')); ?>

                                                                <strong class="replaceText text-success">
                                                                <?php if($order->date === 'No Date Created' && $order->schedule === 'No Schedule Created'): ?>
                                                                        <span><?php echo e(__('No Date & Schedule Created')); ?></span>
                                                                <?php else: ?>
                                                                    <?php if($order->date === 'No Date Created'): ?>
                                                                        <span><?php echo e(__('No Date Created')); ?></span>
                                                                    <?php else: ?>
                                                                        <?php echo e(Carbon\Carbon::parse($order->date)->format('d/m/y')); ?>

                                                                    <?php endif; ?>

                                                                    <?php if($order->schedule === 'No Schedule Created'): ?>
                                                                        <span><?php echo e(__('No Schedule Created')); ?></span>
                                                                    <?php else: ?>
                                                                        <span class="orders"><?php echo e(__($order->schedule)); ?></span>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </strong>
                                                            </span>
                                                         </div>
                                                    </div>

                                                    <div class="dashboard_jobPost__views mt-3">

                                                     <?php if($order->payment_gateway === 'cash_on_delivery' && $order->payment_status === 'pending'): ?>
                                                         <div class="dashboard_jobPost__views__item">
                                                                <div class="btn-wrapper">
                                                                    <a href="javascript:void(0)"
                                                                       class="cmn-btn btn-bg-3 edit_payment_status_modal"
                                                                       data-bs-toggle="modal"
                                                                       data-bs-target="#editPaymentStatusModal"
                                                                       data-id="<?php echo e($order->id); ?>"><?php echo e(__('Payment Status')); ?>

                                                                    </a>
                                                                </div>
                                                           </div>
                                                        <?php endif; ?>

                                                        <div class="dashboard_jobPost__views__item">
                                                            <div class="dashboard_table__main__actions">
                                                                <a href="<?php echo e(route('seller.order.details', $order->id)); ?>" title="<?php echo e(__('View Details')); ?>" class="icon"><i class="fa-regular fa-eye"></i></a>
                                                            </div>
                                                            <div class="dashboard_table__main__actions">
                                                                <a href="<?php echo e(route('seller.order.invoice.details',$order->id)); ?>" target="_blank" title="<?php echo e(__('Print Pdf')); ?>" class="icon"><i class="las la-print"></i></a>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <div class="blog-pagination margin-top-55">
                            <div class="custom-pagination mt-4 mt-lg-5">
                                <?php echo $pending_orders->links(); ?>

                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="chat_wrapper__details__inner__chat__contents">
                        <h2 class="chat_wrapper__details__inner__chat__contents__para"><?php echo e(__('No Pending Order Found')); ?></h2>
                    </div>
                <?php endif; ?>
            </div>
        </div>



        <div class="modal fade" id="editPaymentStatusModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
             aria-hidden="true">
            <form action="<?php echo e(route('seller.order.payment.status')); ?>" method="post">
                <input type="hidden"  name="order_id">
                <?php echo csrf_field(); ?>
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="editModal"><?php echo e(__('Change Payment Status')); ?></h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="up_day_id" class="label_title"><?php echo e(__('Select Status')); ?></label>
                                <select name="status" id="status" class="form-control nice-select">
                                    <option value=""><?php echo e(__('Select Status')); ?></option>
                                    <option value="complete"><?php echo e(__('Completed')); ?></option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
                            <button type="submit" class="btn btn-primary"><?php echo e(__('Save changes')); ?></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

  <?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                // date range
                $('.flatpickr_input').flatpickr({
                    altFormat: "invisible",
                    altInput: false,
                    mode: "range",
                });

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    $('#order_id').val(order_id);
                    $('.nice-select').niceSelect('update');
                });
                $(document).on('click', '.edit_payment_status_modal', function(e) {
                    e.preventDefault();
                    let modalContainer = $('#editPaymentStatusModal');
                    let order_id = $(this).data('id');
                    modalContainer.find('input[name="order_id"]').val(order_id);
                    $('.nice-select').niceSelect('update');
                });
                $(document).on('click', '.swal_delete_button', function(e) {
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__('Are you sure?')); ?>',
                        text: '<?php echo e(__('You would not be able to revert this item!')); ?>',
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

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/pinpointplus/s8/@core/resources/views/frontend/user/seller/order/partials/pending-orders-two.blade.php ENDPATH**/ ?>