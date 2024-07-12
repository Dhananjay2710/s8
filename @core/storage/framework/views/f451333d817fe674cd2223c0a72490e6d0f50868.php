<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Payout Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/backend/css/bootstrap-tagsinput.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/flatpickr.min.css')); ?>">
    <style>
        .close{ border: none;  }
        .dashboard-switch-single{
            font-size: 20px;
        }
        .swal_delete_button{
            color: #da0000 !important;
        }
        .dashboard_promo__row{
            flex-wrap: unset !important;
        }
        #seller_note{
            height: 140px;
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
                <!-- search section start-->
                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="dashboard__wallet">
                        <form action="<?php echo e(route('seller.payout')); ?>" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Search Payout History Module')); ?></h4> <i class="las la-angle-down search_by_all"></i>
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
                                 <?php if(request()->get('payout_history_id')): ?>  show <?php elseif(request()->get('status')): ?> show <?php elseif(request()->get('payout_request_date')): ?> show <?php endif; ?>
                                " aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-settings">
                                                    <div class="single-dashboard-input">
                                                        <div class="row g-4 mt-3">
                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="payout_history_id" class="info-title"> <?php echo e(__('Payout History ID')); ?> </label>
                                                                    <input class="form--control" name="payout_history_id" value="<?php echo e(request()->get('payout_history_id')); ?>" type="text" placeholder="<?php echo e(__('Payout History ID')); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="status" class="info-title"> <?php echo e(__('Status')); ?> </label>
                                                                    <select name="status">
                                                                        <option value=""><?php echo e(__('Select Order Status')); ?></option>
                                                                        <option value="1" <?php if(request()->get('status') == 1): ?> selected <?php endif; ?>><?php echo e(__('Completed')); ?></option>
                                                                        <option value="pending" <?php if(request()->get('status') == 'pending'): ?> selected <?php endif; ?>><?php echo e(__('Pending')); ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="payout_request_date" class="info-title"> <?php echo e(__('Created Date Range')); ?> </label>
                                                                    <input class="form--control flatpickr_input"  name="payout_request_date" type="text" value="<?php echo e(request()->get('payout_request_date')); ?>" placeholder="<?php echo e(__('Created Date Range')); ?>">
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
                <div class="col-xxl-12 col-lg-12">
                    <div class="dashboard_promo__row row_col_2">
                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Pending Service Request')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"><?php echo e($pending_order); ?></h4>
                                    </div>
                                    <div class="dashboard_promo__icon">
                                        <i class="las la-tasks"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Service Request Completed')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"><?php echo e($complete_order); ?></h4>
                                    </div>
                                    <div class="dashboard_promo__icon">
                                        <i class="las la-handshake"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard_promo__col dashboard_promo__child">
                            <div class="dashboard_promo bg-white">
                                <div class="dashboard_promo__flex">
                                    <div class="dashboard_promo__contents">
                                        <span class="dashboard_promo__subtitle"><?php echo e(__('Total Withdraw')); ?></span>
                                        <h4 class="dashboard_promo__title mt-2"><?php echo e(float_amount_with_currency_symbol($total_earnings)); ?> </h4>
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
                                    <a href="<?php echo e(route('buyer.orders')); ?>">
                                        <div class="dashboard_promo__contents">
                                            <span class="dashboard_promo__subtitle"><?php echo e(__('Remaining Balance')); ?></span>
                                            <h4 class="dashboard_promo__title mt-2"><?php echo e(float_amount_with_currency_symbol($remaning_balance-$total_earnings)); ?></h4>
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

                <!-- payout section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white mt-5">
                    <div class="dashboard_table__title__flex">
                        <div class="dashboard__headerContents__left">
                            <h4 class="dashboard_table__title"> <?php echo e(__('Payout History')); ?> </h4>
                            <p class="text-danger"><?php echo e(__('You can create a request for withdraw your earnings.')); ?></p>
                        </div>
                        <div class="btn-wrapper" data-bs-toggle="modal" data-bs-target="#openTicket">
                            <a href="javascript:void(0)"
                               class="dashboard_table__title__btn btn-bg-1 radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#payoutRequestModal"><i class="fa-solid fa-plus"></i> <?php echo e(__('Request A Payment' )); ?></a>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="dashboard-settings">
                            <div class="mt-3"> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
<?php endif; ?></div>
                        </div>
                    </div>
                    <?php if($all_payout_request->count() >= 1): ?>
                        <div class="dashboard_table__main custom--table mt-4">
                            <table>
                                <thead>
                                <tr>
                                    <th> <?php echo e(__('ID')); ?></th>
                                    <th> <?php echo e(__('Payment Gateway')); ?> </th>
                                    <th> <?php echo e(__('Request Date')); ?> </th>
                                    <th> <?php echo e(__('Request Amount')); ?> </th>
                                    <th> <?php echo e(__('Request Status')); ?> </th>
                                    <th> <?php echo e(__('Downloads')); ?> </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $all_payout_request; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay_request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($pay_request->id); ?> </td>
                                        <td><?php echo e(__($pay_request->payment_gateway)); ?></td>
                                        <td><?php echo e($pay_request->created_at->diffForHumans()); ?> </td>
                                        <td> <?php echo e(float_amount_with_currency_symbol($pay_request->amount)); ?> </td>
                                        <td>
                                        <div class="dashboard_table__main__priority">
                                            <?php if($pay_request->status == 0): ?>  <span class="priorityBtn pending"><?php echo e(__('Pending')); ?></span><?php endif; ?>
                                            <?php if($pay_request->status == 1): ?>  <span class="priorityBtn completed"><?php echo e(__('Completed')); ?></span><?php endif; ?>
                                        </div>
                                        </td>
                                        <td>
                                            <div class="dashboard_table__main__actions">
                                                <a href="<?php echo e(route('seller.payout.request.details', $pay_request->id)); ?>" class="icon">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('seller.payout.invoice.details',$pay_request->id)); ?>">
                                                    <i class="las la-file-pdf"></i> <?php echo e(__('Download PDF')); ?>

                                                </a>
                                            </div>


                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="blog-pagination margin-top-55">
                            <div class="custom-pagination mt-4 mt-lg-5">
                                <?php echo $all_payout_request->links(); ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="chat_wrapper__details__inner__chat__contents">
                            <h2 class="chat_wrapper__details__inner__chat__contents__para"><?php echo e(__('No Payout History Found')); ?></h2>
                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>

    <!--Status Modal -->
    <div class="modal fade" id="payoutRequestModal" tabindex="-1" role="dialog" aria-labelledby="editModal"
         aria-hidden="true">
        <form action="<?php echo e(route('seller.create.payout.request')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editModal"><?php echo e(__('Payout Request')); ?></h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="amount" class="label_title"><?php echo e(__('Amount')); ?> <span class="text-danger">*</span> </label>
                            <input type="number" class="form-control" name="amount" id="amount" placeholder="<?php echo e(__('amount')); ?>">
                        </div>
                        <div class="form-group mt-2">
                            <label for="payment_gateway" class="label_title"><?php echo e(__('Payment Gateway')); ?></label>
                            <select name="payment_gateway" id="payment_gateway" class="form-control nice-select">
                                <option value=""><?php echo e(__('Select Payment gateway')); ?></option>
                                <?php
                                    $all_gateways = ['paypal','manual_payment','mollie','paytm','stripe','razorpay','flutterwave','paystack','marcadopago','instamojo','cashfree','payfast','midtrans'];
                                ?>
                                <?php $__currentLoopData = $all_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(!empty(get_static_option($gateway.'_gateway'))): ?>
                                        <option value="<?php echo e($gateway); ?>" <?php if(get_static_option('site_default_payment_gateway') == $gateway): ?> selected <?php endif; ?>><?php echo e(ucwords(str_replace('_',' ',$gateway))); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="payout-request-note d-block pt-4 label_title" for="amount"><?php echo e(__('Note (your payment account details)')); ?></label>
                            <?php $amount_settings = App\AmountSettings::first(); ?>
                            <small class="text-danger margin-bottom-10 d-block"><?php echo e(sprintf(__('You can make a request only if your remaining balance in a range set by the site admin. Like admin set minimum request amount %1$s and maximum request amount %2$s. than you can request a payment between %1$s to %2$s.'),$amount_settings->min_amount,$amount_settings->max_amount)); ?></small>
                            <textarea class="form-control mt-3" name="seller_note" id="seller_note" cols="30" rows="7" placeholder="<?php echo e(__('note')); ?>"></textarea>
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
    <script src="<?php echo e(asset('assets/common/js/flatpickr.js')); ?>"></script>
    <script>
        (function($) {
            "use strict";
            $(document).ready(function() {

                // search select2
                $('#payment_gateway').select2({
                    dropdownParent: $('#payoutRequestModal')
                });

                // date range
                $('.flatpickr_input').flatpickr({
                    altFormat: "invisible",
                    altInput: false,
                    mode: "range",
                });

                $(document).on('click', '.edit_status_modal', function(e) {
                    e.preventDefault();
                    let order_id = $(this).data('id');
                    let status = $(this).data('status');

                    $('#order_id').val(order_id);
                    $('#status').val(status);
                    $('.nice-select').niceSelect('update');
                });

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/payout/partials/payout-request-two.blade.php ENDPATH**/ ?>