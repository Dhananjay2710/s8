<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Request Details')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .line-top-contents{
            margin-top: 20px;
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
                <!-- Report section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <?php if(!empty($order_details)): ?>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="single-flex-middle">
                                    <div class="single-flex-middle-inner">
                                        <div class="line-charts-wrapper margin-top-40">

                                            <div class="line-top-contents mb-2">
                                                <h4 class="earning-title"><?php echo e(__('Service Provider Details')); ?></h4>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Name:')); ?> </strong><?php echo e(optional($order_details->seller)->name); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Email:')); ?> </strong><?php echo e(optional($order_details->seller)->email); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Phone:')); ?> </strong><?php echo e(optional($order_details->seller)->phone); ?>

                                                    </label>
                                                </div>
                                                <?php if($order_details->is_order_online !=1): ?>
                                                    <div class="checkbox-inlines">
                                                        <label><strong><?php echo e(__('Address:')); ?> </strong><?php echo e(optional($order_details->seller)->address); ?>

                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong><?php echo e(__('City:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->city)->service_city); ?>

                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong><?php echo e(__('Area:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->area)->service_area); ?>

                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong><?php echo e(__('Post Code:')); ?> </strong><?php echo e(optional($order_details->seller)->post_code); ?>

                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong><?php echo e(__('Country:')); ?> </strong><?php echo e(optional(optional($order_details->seller)->country)->country); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <?php if($order_details->is_order_online !=1): ?>
                                                <div class="line-top-contents mb-2">
                                                    <h4 class="earning-title"><?php echo e(__('Date & Schedule')); ?></h4>
                                                </div>
                                                <div class="single-checbox">
                                                    <div class="checkbox-inlines">
                                                        <label><strong><?php echo e(__('Date:')); ?>

                                                                <?php if($order_details->date === 'No Date Created'): ?>
                                                                    <span><?php echo e(__('No Date Created')); ?></span>
                                                                <?php else: ?>
                                                            </strong><?php echo e(Carbon\Carbon::parse($order_details->date)->format('d/m/y')); ?>

                                                            <?php endif; ?>

                                                        </label>
                                                    </div>
                                                    <div class="checkbox-inlines">
                                                        <label><strong><?php echo e(__('Schedule:')); ?> </strong><?php echo e($order_details->schedule); ?>

                                                        </label>
                                                    </div>
                                                </div>
                                            <?php endif; ?>

                                            <div class="line-top-contents mb-2">
                                                <h4 class="earning-title"><?php echo e(__('Amount Details')); ?></h4>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Package Fee:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->package_fee)); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Extra Service:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->extra_service)); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Sub Total:')); ?></strong><?php echo e(float_amount_with_currency_symbol($order_details->sub_total)); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Tax:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->tax)); ?>

                                                    </label>
                                                </div>
                                                <?php if(!empty($order_details->coupon_amount)): ?>
                                                    <div class="checkbox-inlines">
                                                        <label><strong><?php echo e(__('Coupon Amount:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->coupon_amount)); ?>

                                                        </label>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Total:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->total)); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Admin Charge:')); ?> </strong><?php echo e(float_amount_with_currency_symbol($order_details->commission_amount)); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Payment Method:')); ?> </strong><?php echo e(__(ucwords(str_replace("_", " ", $order_details->payment_gateway)))); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Payment Status:')); ?> </strong><?php echo e(__(ucfirst($order_details->payment_status))); ?>

                                                    </label>
                                                </div>
                                            </div>

                                            <div class="line-top-contents mb-2">
                                                <h4 class="earning-title"><?php echo e(__('Service Request Details')); ?></h4>
                                            </div>
                                            <div class="single-checbox">
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Service Request ID:')); ?> </strong><?php echo e($order_details->id); ?>

                                                    </label>
                                                </div>
                                                <div class="checkbox-inlines">
                                                    <label><strong><?php echo e(__('Service Request Status: ')); ?></strong>
                                                        <?php if($order_details->status == 0): ?>
                                                            <span><?php echo e(__('Pending')); ?></span>
                                                        <?php endif; ?>
                                                        <?php if($order_details->status == 1): ?>
                                                            <span><?php echo e(__('Active')); ?></span>
                                                        <?php endif; ?>
                                                        <?php if($order_details->status == 2): ?>
                                                            <span><?php echo e(__('Completed')); ?></span>
                                                        <?php endif; ?>
                                                        <?php if($order_details->status == 3): ?>
                                                            <span><?php echo e(__('Delivered')); ?></span>
                                                        <?php endif; ?>
                                                        <?php if($order_details->status == 4): ?>
                                                            <span><?php echo e(__('Cancelled')); ?></span>
                                                        <?php endif; ?>
                                                    </label>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">

                                <?php if($order_details->order_from_job != 'yes'): ?>
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h4 class="earning-title"><?php echo e(__('Include Details')); ?></h4>
                                                </div>
                                                <table class="table table-bordered mt-3">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Title')); ?></th>
                                                        <?php if($order_details->is_order_online !=1): ?>
                                                            <th><?php echo e(__('Unit Price')); ?></th>
                                                            <th><?php echo e(__('Quantity')); ?></th>
                                                            <th><?php echo e(__('Total')); ?></th>
                                                        <?php endif; ?>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $package_fee =0; ?>
                                                    <?php $__currentLoopData = $order_includes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $include): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($include->title); ?></td>
                                                            <?php if($order_details->is_order_online !=1): ?>
                                                                <td><?php echo e(float_amount_with_currency_symbol($include->price)); ?></td>
                                                                <td><?php echo e($include->quantity); ?></td>
                                                                <td><?php echo e(float_amount_with_currency_symbol($include->price * $include->quantity)); ?></td>
                                                                <?php $package_fee += $include->price * $include->quantity ?>
                                                            <?php endif; ?>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <?php if($order_details->is_order_online !=1): ?>
                                                            <td colspan="3"><strong><?php echo e(__('Package Fee')); ?></strong>
                                                            </td>
                                                            <td>
                                                                <strong><?php echo e(float_amount_with_currency_symbol($package_fee)); ?></strong>
                                                            </td>
                                                        <?php else: ?>
                                                            <td colspan="3">
                                                                <strong><?php echo e(__('Package Fee ') .float_amount_with_currency_symbol($order_details->package_fee)); ?></strong>
                                                            </td>
                                                        <?php endif; ?>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <?php if($order_additionals->count() >= 1): ?>
                                    <div class="single-flex-middle mt-4">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h4 class="earning-title"><?php echo e(__('Additional Details')); ?></h4>
                                                </div>
                                                <table class="table table-bordered mt-3">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo e(__('Title')); ?></th>
                                                        <th><?php echo e(__('Unit Price')); ?></th>
                                                        <th><?php echo e(__('Quantity')); ?></th>
                                                        <th><?php echo e(__('Total')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $extra_service =0; ?>
                                                    <?php $__currentLoopData = $order_additionals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $additional): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($additional->title); ?></td>
                                                            <td><?php echo e(float_amount_with_currency_symbol($additional->price)); ?></td>
                                                            <td><?php echo e($additional->quantity); ?></td>
                                                            <td><?php echo e(float_amount_with_currency_symbol($additional->price * $additional->quantity)); ?></td>
                                                            <?php $extra_service += $additional->price * $additional->quantity ?>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    <tr>
                                                        <td colspan="3"><strong><?php echo e(__('Extra Service')); ?></strong></td>
                                                        <td>
                                                            <strong><?php echo e(float_amount_with_currency_symbol($extra_service)); ?></strong>
                                                        </td>
                                                    </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                    <?php if(optional($order_details->extraSevices)->count() >= 1): ?>
                                        <div class="single-flex-middle mt-4">
                                            <div class="single-flex-middle-inner">
                                                <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                    <div class="line-top-contents">
                                                        <h4 class="earning-title"><?php echo e(__('Extra Service Details')); ?></h4>
                                                    </div>
                                                    <span class="info-text d-block mb-4"><?php echo e(__('This is not included in the main service request calculation')); ?></span>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th><?php echo e(__('Title')); ?></th>
                                                            <th><?php echo e(__('Unit Price')); ?></th>
                                                            <th><?php echo e(__('Quantity')); ?></th>
                                                            <th><?php echo e(__('Amount')); ?></th>
                                                            <th><?php echo e(__('Action')); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $order_details->extraSevices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ex_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($ex_service->title); ?></td>
                                                                <td><?php echo e(float_amount_with_currency_symbol($ex_service->price)); ?></td>
                                                                <td><?php echo e($ex_service->quantity); ?></td>
                                                                <td><?php echo e(float_amount_with_currency_symbol($ex_service->price * $ex_service->quantity)); ?></td>
                                                                <td>
                                                                    <?php if($ex_service->payment_status !== 'complete' && $order_details->payment_status === 'complete'): ?>
                                                                        <a href="#" data-url="<?php echo e(route('seller.order.extra.service.delete')); ?>" data-id="<?php echo e($ex_service->id); ?>" class="btn btn-danger extra_service_delete_btn"><?php echo e(__('Delete')); ?></a>
                                                                    <?php endif; ?>
                                                                </td>
                                                            </tr>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                                    <?php if(!empty($order_details->coupon_code)): ?>
                                        <div class="single-flex-middle mt-4">
                                            <div class="single-flex-middle-inner">
                                                <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                    <div class="line-top-contents">
                                                        <h4 class="earning-title"><?php echo e(__('Coupon Details')); ?></h4>
                                                    </div>
                                                    <table class="table table-bordered">
                                                        <thead>
                                                        <tr>
                                                            <th><?php echo e(__('Coupon Code')); ?></th>
                                                            <th><?php echo e(__('Coupon Type')); ?></th>
                                                            <th><?php echo e(__('Coupon Amount')); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td><?php echo e($order_details->coupon_code); ?></td>
                                                            <td><?php echo e(__($order_details->coupon_type)); ?></td>
                                                            <td>
                                                                <?php if($order_details->coupon_amount >0): ?>
                                                                    <?php echo e(float_amount_with_currency_symbol($order_details->coupon_amount)); ?>

                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>

                            </div>

                            <div class="col-sm-12">
                                <?php if(!empty($order_declines_history->count() >= 1)): ?>
                                    <div class="single-flex-middle mt-4">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h4 class="earning-title"><?php echo e(__('Service Request Decline History')); ?></h4>
                                                </div>
                                                <table class="table table-bordered mt-3">
                                                    <thead>
                                                    <tr>
                                                        <th><?php echo e(__('History ID')); ?></th>
                                                        <th><?php echo e(__('Service Provider Details')); ?></th>
                                                        <th><?php echo e(__('Status')); ?> (<?php echo e(__('Decline Reason')); ?>)</th>
                                                        <th><?php echo e(__('Image File')); ?></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $__currentLoopData = $order_declines_history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($history->id); ?></td>
                                                            <td>
                                                                <strong><?php echo e(__('Name: ')); ?></strong> <?php echo e(optional($history->seller)->name); ?>

                                                                <br>
                                                                <strong><?php echo e(__('Email: ')); ?></strong><?php echo e(optional($history->seller)->email); ?>

                                                                <br>
                                                                <strong><?php echo e(__('Phone: ')); ?></strong><?php echo e(optional($history->seller)->phone); ?>

                                                                <br>
                                                            </td>
                                                            <td>
                                                                <strong><?php echo e(__('Decline Reason: ')); ?></strong><?php echo e($history->decline_reason); ?>

                                                            </td>
                                                            <td><?php echo render_image_markup_by_attachment_id($history->image,'','thumb'); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>


<div class="modal fade" id="acceptExtraServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
    <form action="<?php echo e(route('buyer.order.extra.service.accept')); ?>" method="post" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo e(__('Accept Extra Service Request')); ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="comments-flex-item">
                        <input type="hidden" name="id" class="form-control form-control-sm">
                        <input type="hidden" name="order_id" class="form-control form-control-sm">
                    </div>
                    <?php echo \App\Helpers\PaymentGatewayRenderHelper::renderPaymentGatewayForForm(false); ?>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo e(__('Close')); ?></button>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('Pay Now')); ?></button>
                </div>
            </div>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
<script>
    (function($){

        "use strict";

        $(document).ready(function (){
            /* Delete */
            //seller.order.extra.service.delete
            $(document).on('click','.extra_service_delete_btn',function (e){
                e.preventDefault();
                var id = $(this).data('id');
                var url = $(this).data('url')
                Swal.fire({
                    title: '<?php echo e(__("Are you sure?")); ?>',
                    text: '<?php echo e(__("You would not be able to revert this item!")); ?>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "<?php echo e(__('Yes, Delete it!')); ?>"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            "type" :"POST",
                            'url' : url,
                            data: {
                                _token : "<?php echo e(csrf_token()); ?>",
                                id: id
                            },
                            success: function (data){
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'warning',
                                    title: "<?php echo e(__('delete success')); ?>",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                location.reload();
                            }
                        })
                    }
                });

            });

        });


    })(jQuery);
    //extra_service_edit_btn
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/order/partials/order-details-two.blade.php ENDPATH**/ ?>