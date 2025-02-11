<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Coupons')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/flatpickr.min.css')); ?>">
    <style>
        .close{ border: none;  }
        .dashboard-switch-single{
            font-size: 20px;
        }
        .swal_delete_button{
            color: #da0000 !important;
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
                        <form action="<?php echo e(route('seller.service.coupon')); ?>" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Search Coupons')); ?></h4> <i class="las la-angle-down search_by_all"></i>
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
                                 <?php if(request()->get('coupon_code')): ?>  show
                                 <?php elseif(request()->get('status')): ?> show
                                 <?php elseif(request()->get('discount_type')): ?> show
                                 <?php elseif(request()->get('coupon_date')): ?> show
                                 <?php endif; ?>
                                "aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-settings">
                                                    <div class="single-dashboard-input">
                                                        <div class="row g-4 mt-3">
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="coupon_code" class="info-title"> <?php echo e(__('Coupon Code')); ?> </label>
                                                                    <input class="form--control" name="coupon_code" value="<?php echo e(request()->get('coupon_code')); ?>" type="text" placeholder="<?php echo e(__('Coupon Code')); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="status" class="info-title"> <?php echo e(__('Discount Type')); ?> </label>
                                                                    <select name="discount_type">
                                                                        <option value=""><?php echo e(__('Select Type')); ?></option>
                                                                        <option value="percentage" <?php if(request()->get('discount_type') == 'percentage'): ?> selected <?php endif; ?>><?php echo e(__('Percentage')); ?></option>
                                                                        <option value="amount" <?php if(request()->get('discount_type') == 'amount'): ?> selected <?php endif; ?>><?php echo e(__('Amount')); ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="status" class="info-title"> <?php echo e(__('Status')); ?> </label>
                                                                    <select name="status">
                                                                        <option value=""><?php echo e(__('Select Order Status')); ?></option>
                                                                        <option value="1" <?php if(request()->get('status') == 1): ?> selected <?php endif; ?>><?php echo e(__('Active')); ?></option>
                                                                        <option value="pending" <?php if(request()->get('status') == 'pending'): ?> selected <?php endif; ?>><?php echo e(__('Inactive')); ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="coupon_date" class="info-title"> <?php echo e(__('Created Date Range')); ?> </label>
                                                                    <input class="form--control flatpickr_input"  name="coupon_date" type="text" value="<?php echo e(request()->get('coupon_date')); ?>" placeholder="<?php echo e(__('Created Date Range')); ?>">
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
                <!-- todolist table section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <h2 class="dashboard_table__title"> <?php echo e(__('All Coupons')); ?> </h2>
                    <div class="notice-board">
                        <p class="text-danger"><?php echo e(__('Coupon will applicable only for your services and coupon amount will be reduce from your earnings.')); ?></p>
                    </div>
                    <div class="dashboard_table__title__flex">
                        <h4 class="dashboard_table__title">  </h4>
                        <div class="btn-wrapper" data-bs-toggle="modal" data-bs-target="#openTicket">
                            <a href="javascript:void(0)"
                               class="dashboard_table__title__btn btn-bg-1 radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#addCouponModal"><i class="fa-solid fa-plus"></i> <?php echo e(__('Add Coupon' )); ?></a>
                        </div>
                    </div>
                    <div class="mt-5"> <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
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
<?php endif; ?> </div>
                    <?php if($coupons->count() >= 1): ?>
                        <div class="dashboard_table__main custom--table mt-4">
                            <table>
                                <thead>
                                <tr>
                                    <th><?php echo e(__('No')); ?></th>
                                    <th><?php echo e(__('Code')); ?></th>
                                    <th><?php echo e(__('Discount')); ?></th>
                                    <th><?php echo e(__('Discount Type')); ?></th>
                                    <th><?php echo e(__('Expire Date')); ?></th>
                                    <th><?php echo e(__('Status')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($data->code); ?></td>
                                        <td><?php echo e($data->discount); ?></td>
                                        <td><?php echo e(__($data->discount_type)); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($data->expire_date)->format('d/m/Y')); ?></td>
                                        <td>
                                            <?php if($data->status==1): ?>
                                                <span class="text-success"><?php echo e(__('Active')); ?></span>
                                            <?php else: ?>
                                                <span class="text-danger"><?php echo e(__('Inactive')); ?></span>
                                            <?php endif; ?>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-coupon-status','data' => ['url' => route('seller.service.coupon.status',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-coupon-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.service.coupon.status',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="dashboard-switch-single">
                                                <a href="#0" class="edit_coupon_modal"
                                                   data-bs-toggle="modal"
                                                   data-bs-target="#editCouponModal"
                                                   data-id="<?php echo e($data->id); ?>"
                                                   data-code="<?php echo e($data->code); ?>"
                                                   data-discount="<?php echo e($data->discount); ?>"
                                                   data-discount_type="<?php echo e(__($data->discount_type)); ?>"
                                                   data-expire_date="<?php echo e($data->expire_date); ?>"
                                                >
                                                    <span style="font-size:16px;" class="dash-icon color-1"> <i class="las la-edit"></i> </span>
                                                </a>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.service.coupon.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.service.coupon.delete',$data->id))]); ?>
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
                        <div class="blog-pagination margin-top-55">
                            <div class="custom-pagination mt-lg-5">
                                <?php echo $coupons->links(); ?>

                            </div>
                        </div>
                    <?php else: ?>
                        <div class="chat_wrapper__details__inner__chat__contents">
                            <h2 class="chat_wrapper__details__inner__chat__contents__para"><?php echo e(__('No Coupon Found')); ?></h2>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addCouponModal" tabindex="-1" role="dialog" aria-labelledby="couponModal" aria-hidden="true">
        <form action="<?php echo e(route('seller.service.coupon.add')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header d-block ">
                        <h4 class="modal-title" id="couponModal"><?php echo e(__('Add New Coupon')); ?></h4>
                        <small class="text-info"><?php echo e(__('Be careful while create a coupon. if the service price less than the admin charge after apply coupon than admin charge will cut from your main balance.')); ?></small>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="code" class="label_title"><?php echo e(__('Coupon Code')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="code" id="code" class="form-control" placeholder="<?php echo e(__('Coupon Code')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="discount" class="label_title"><?php echo e(__('Coupon Discount')); ?> <span class="text-danger">*</span> </label>
                            <input type="number" name="discount" id="discount" class="form-control" placeholder="<?php echo e(__('Discount')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="discount_type" class="label_title"><?php echo e(__('Coupon Type')); ?> <span class="text-danger">*</span> </label>
                            <select name="discount_type" id="discount_type" class="form-control mb-3">
                                <option value=""><?php echo e(__('Select Type')); ?></option>
                                <option value="percentage"><?php echo e(__('Percentage')); ?></option>
                                <option value="amount"><?php echo e(__('Amount')); ?></option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="expire_date" class="label_title"><?php echo e(__('Expire Date')); ?> <span class="text-danger">*</span> </label>
                            <input type="date" name="expire_date" id="expire_date" class="form-control" placeholder="<?php echo e(__('Expire Date')); ?>">
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
    <!-- Edit Modal -->
    <div class="modal fade" id="editCouponModal" tabindex="-1" role="dialog" aria-labelledby="editCouponModal" aria-hidden="true">
        <form action="<?php echo e(route('seller.service.coupon.update')); ?>" method="post">
            <input type="hidden" id="up_id" name="up_id" >
            <?php echo csrf_field(); ?>
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="editCouponModal"><?php echo e(__('Edit Coupon')); ?></h4>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group mt-3">
                            <label for="up_code" class="label_title"><?php echo e(__('Coupon Code')); ?> <span class="text-danger">*</span> </label>
                            <input type="text" name="up_code" id="up_code" class="form-control" placeholder="<?php echo e(__('Coupon Code')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="up_discount" class="label_title"><?php echo e(__('Coupon Discount')); ?> <span class="text-danger">*</span> </label>
                            <input type="number" name="up_discount" id="up_discount" class="form-control" placeholder="<?php echo e(__('Discount')); ?>">
                        </div>
                        <div class="form-group mt-3">
                            <label for="up_discount_type" class="label_title"><?php echo e(__('Coupon Type')); ?> <span class="text-danger">*</span> </label>
                            <select name="up_discount_type" id="up_discount_type" class="form-control nice-select mb-3">
                                <option value=""><?php echo e(__('Select Type')); ?></option>
                                <option value="percentage"><?php echo e(__('Percentage')); ?></option>
                                <option value="amount"><?php echo e(__('Amount')); ?></option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="up_expire_date" class="label_title"><?php echo e(__('Expire Date')); ?> <span class="text-danger">*</span> </label>
                            <input type="date" name="up_expire_date" id="up_expire_date" class="form-control" placeholder="<?php echo e(__('Expire Date')); ?>">
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
    <script src="<?php echo e(asset('assets/backend/js/dropzone.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/common/js/flatpickr.js')); ?>"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // search select2
                $('#discount_type').select2({
                    dropdownParent: $('#addCouponModal')
                });

                $('#up_discount_type').select2({
                    dropdownParent: $('#editCouponModal')
                });

                // date range
                $('.flatpickr_input').flatpickr({
                    altFormat: "invisible",
                    altInput: false,
                    mode: "range",
                });

                $(document).on('click','.edit_coupon_modal',function(e){
                    e.preventDefault();
                    let coupon_id = $(this).data('id');
                    let code = $(this).data('code');
                    let discount = $(this).data('discount');
                    let discount_type = $(this).data('discount_type');
                    let expire_date = $(this).data('expire_date');

                    $('#up_id').val(coupon_id);
                    $('#up_code').val(code);
                    $('#up_discount').val(discount);
                    $('#up_discount_type').val(discount_type);
                    $('#up_expire_date').val(expire_date);
                    $('.nice-select').niceSelect('update');
                });

                $(document).on('click','.swal_status_button',function(e){
                    e.preventDefault();
                    Swal.fire({
                        title: '<?php echo e(__("Are you sure to change status?")); ?>',
                        text: '<?php echo e(__("You will change it anytime!")); ?>',
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

                $("#expire_date").flatpickr({
                    dateFormat: "Y-m-d",
                });
                $("#up_expire_date").flatpickr({
                    dateFormat: "Y-m-d",
                });

            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/coupons/partials/coupons-two.blade.php ENDPATH**/ ?>