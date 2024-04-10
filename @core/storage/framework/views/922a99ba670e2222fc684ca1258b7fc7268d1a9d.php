<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Services')); ?>

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
                        <form action="<?php echo e(route('seller.services')); ?>" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title"><?php echo e(__('Search Service Module')); ?></h4> <i class="las la-angle-down search_by_all"></i>
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
                                <?php if(request()->get('service_id')): ?>  show
                                <?php elseif(request()->get('service_status')): ?> show
                                <?php elseif(request()->get('service_title')): ?> show
                                <?php elseif(request()->get('online_offline_status')): ?> show
                                <?php elseif(request()->get('service_price')): ?> show
                                <?php elseif(request()->get('service_date')): ?> show
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
                                                                    <label for="order_id" class="info-title"> <?php echo e(__('Service ID')); ?> </label>
                                                                    <input class="form--control" name="service_id" value="<?php echo e(request()->get('service_id')); ?>" type="text" placeholder="<?php echo e(__('Service ID')); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="service_title" class="info-title"> <?php echo e(__('Service Title')); ?> </label>
                                                                    <input class="form--control" name="service_title" value="<?php echo e(request()->get('service_title')); ?>" type="text" placeholder="<?php echo e(__('Service Title')); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="service_status" class="info-title"> <?php echo e(__('Service Status')); ?> </label>
                                                                    <select name="service_status">
                                                                        <option value=""><?php echo e(__('Select Status')); ?></option>
                                                                        <option value="pending" <?php if(request()->get('service_status') == 'pending'): ?> selected <?php endif; ?>><?php echo e(__('Pending')); ?></option>
                                                                        <option value="1" <?php if(request()->get('service_status') == 1): ?> selected <?php endif; ?>><?php echo e(__('Active')); ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="service_price" class="info-title"> <?php echo e(__('Service Price')); ?> </label>
                                                                    <input class="form--control" name="service_price" value="<?php echo e(request()->get('service_price')); ?>" type="number" placeholder="<?php echo e(__('Service Price')); ?>">
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="service_date" class="info-title"> <?php echo e(__('Created Date Range')); ?> </label>
                                                                    <input class="form--control flatpickr_input" value="<?php echo e(request()->get('service_date')); ?>" name="service_date" type="text" value="<?php echo e(request()->get('service_date')); ?>" placeholder="<?php echo e(__('Created Date Range')); ?>">
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
                            <h4 class="dashboard_table__title"> <?php echo e(__('All Services')); ?> </h4>
                        </div>
                            <?php if(moduleExists('Subscription') && $commissionGlobal->system_type == 'subscription'): ?>
                                  <?php if(!empty(auth('web')->user()->subscribedSeller)): ?>
                                            <?php if(Carbon\Carbon::parse(auth('web')->user()->subscribedSeller->expire_date) <= \Carbon\Carbon::today()): ?>
                                             <div class="col-lg-12">
                                                <div class="alert alert-warning d-flex justify-content-between"><?php echo e(__('your package has been expired, please renew it')); ?>

                                                    <a href="<?php echo e(getSlugFromReadingSetting('price_plan_page') ? url('/'.getSlugFromReadingSetting('price_plan_page')) : url('/price-plan')); ?>" target="_self" class="dashboard_table__title__btn btn-bg-1 radius-5"><?php echo e(__('view packages')); ?></a>
                                                </div>
                                            </div>
                                          <?php else: ?>
                                            <div class="btn-wrapper margin-top-50 text-right">
                                                <a href="<?php echo e(route('seller.add.services')); ?>" class="dashboard_table__title__btn btn-bg-1 radius-5"><?php echo e(__('Add Services')); ?></a>
                                            </div>
                                          <?php endif; ?>
                                    <?php else: ?>
                                   <div class="col-lg-12">
                                    <div class="alert alert-warning d-flex justify-content-between"><?php echo e(__('you must have to subscribe any of our package in order to start selling your services.')); ?>

                                        <a href="<?php echo e(getSlugFromReadingSetting('price_plan_page') ? url('/'.getSlugFromReadingSetting('price_plan_page')) : url('/price-plan')); ?>" target="_self" class="dashboard_table__title__btn btn-bg-1 radius-5"><?php echo e(__('view packages')); ?></a>
                                    </div>
                                    </div>
                                 <?php endif; ?>
                             <?php else: ?>
                            <div class="btn-wrapper margin-top-50 text-right">
                                <a href="<?php echo e(route('seller.add.services')); ?>" class="dashboard_table__title__btn btn-bg-1 radius-5"> <?php echo e(__('Add Services')); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <?php if($services->count() > 0): ?>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                            <div class="rows dash-single-inner">
                                <div class="dash-left-service">
                                    <div class="dashboard-services">
                                        <div class="dashboar-flex-services">
                                            <div class="thumb bg-image" <?php echo render_background_image_markup_by_attachment_id($data->image,'','thumb'); ?>>
                                            </div>

                                            <div class="thumb-contents">
                                                <h4 class="title"> <a href="javascript:void(0)"> <?php echo e($data->title); ?> </a> </h4>
                                                <div class="thumb-contents-review-flex">
                                                    <div class="thumb-contents-review-inner">
                                                        <span class="service-review">
                                                            <i class="las la-star"></i>
                                                            <?php echo e(round(optional($data->reviews)->avg('rating'),1)); ?>

                                                            <b>(<?php echo e(optional($data->reviews)->count()); ?>)</b>
                                                        </span>
                                                        <span class="service-review style-02"> <i class="las la-eye"></i> <?php echo e($data->view); ?> </span>
                                                        <?php if($data->is_service_online == 1): ?>
                                                            <span class="service-review style-02"> <i class="las la-map-marker"></i> <?php echo e(__('Online')); ?> </span>
                                                        <?php else: ?>
                                                            <span class="service-review style-02"> <i class="las la-map-marker"></i> <?php echo e(__('Offline')); ?> </span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="service-bottom-flex mt-1">
                                                        <a href="<?php echo e(route('seller.pending.orders')); ?>">
                                                            <div class="dashboard-service-bottom-flex color-1">
                                                                <div class="icon">
                                                                    <i class="las la-sync-alt"></i>
                                                                </div>
                                                                <div class="content">
                                                                    <span class="queue"> <?php echo e(__('In Queue')); ?> <span class="num"> <?php echo e(optional($data->pendingOrder)->count()); ?> </span> </span>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <div class="dashboard-service-bottom-flex color-2">
                                                            <div class="icon">
                                                                <i class="las la-check"></i>
                                                            </div>
                                                            <div class="content">
                                                                <span class="queue"> <?php echo e(__('Completed')); ?> <span class="num"> <?php echo e(optional($data->completeOrder)->count()); ?> </span> </span>
                                                            </div>
                                                        </div>
                                                        <div class="dashboard-service-bottom-flex color-3">
                                                            <div class="icon">
                                                                <i class="las la-times"></i>
                                                            </div>
                                                            <div class="content">
                                                                <span class="queue"> <?php echo e(__('Cancelled')); ?> <span class="num"> <?php echo e(optional($data->cancelOrder)->count()); ?> </span></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="dash-righ-service">
                                    <div class="dashboard-switch-flex-content">
                                        <div class="dashboard-switch-single">
                                            <span class="dashboard-starting"> <?php echo e(__('Starting From:')); ?> </span>
                                            <h2 class="title-price color-3"> <?php echo e(amount_with_currency_symbol($data->price)); ?> </h2>
                                        </div>
                                        <div class="dashboard-switch-single">
                                            <span class="dashboard-starting"> <?php echo e(__('On/Off Service:')); ?> </span>
                                            <?php if($data->is_service_on==1): ?>
                                                <input class="custom-switch style-02 service_on_off_btn" id="switch2_<?php echo e($data->id); ?>" type="checkbox" data-id="<?php echo e($data->id); ?>" />
                                                <label class="switch-label style-02" for="switch2_<?php echo e($data->id); ?>"></label>
                                            <?php else: ?>
                                                <input class="custom-switch service_on_off_btn" id="switch1_<?php echo e($data->id); ?>" type="checkbox" data-id="<?php echo e($data->id); ?>" />
                                                <label class="switch-label" for="switch1_<?php echo e($data->id); ?>"></label>
                                            <?php endif; ?>

                                        </div>
                                        <div class="dashboard-switch-single">
                                            <a href="<?php echo e(route('seller.edit.services',$data->id)); ?>"> <span class="dash-icon color-1" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Edit Service')); ?>"> <i class="las la-pen"></i> </span> </a>
                                            <a href="<?php echo e(route('seller.services.attributes.show.byid',$data->id)); ?>"> <span class="dash-icon color-1" data-toggle="tooltip" data-placement="top" title="<?php echo e(__('Show Attributes')); ?>"> <i class="las la-eye"></i> </span> </a>
                                            <a href="<?php echo e(route('service.list.details',$data->slug ?? 'x')); ?>" target="_blank"> <span class="dash-icon color-1" data-toggle="tooltip" data-placement="top"  title="<?php echo e(__('Service in frontend')); ?>"> <i class="las la-external-link-square-alt"></i> </span> </a>
                                             <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.services.delete',$data->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.services.delete',$data->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="blog-pagination margin-top-55">
                        <div class="custom-pagination mt-4 mt-lg-5">
                            <?php echo $services->links(); ?>

                        </div>
                    </div>
                <?php else: ?>
                    <div class="chat_wrapper__details__inner__chat__contents">
                        <h2 class="chat_wrapper__details__inner__chat__contents__para"><?php echo e(__('No Service Created Yet')); ?></h2>
                    </div>
                <?php endif; ?>

            </div>
        </div>
<?php $__env->stopSection(); ?>
 <?php $__env->startSection('scripts'); ?>
<script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
<script>
    (function($){
        "use strict";

        $(document).ready(function(){

            // date range
            $('.flatpickr_input').flatpickr({
                altFormat: "invisible",
                altInput: false,
                mode: "range",
            });

            $(document).on('change','.service_on_off_btn',function(e){
                e.preventDefault();
                if($(this).is(':checked')){
                    var service_id = $(this).data('id');
                    $.ajax({
                        method:'post',
                        url:"<?php echo e(route('seller.services.on.of')); ?>",
                        data:{service_id:service_id},
                        success:function(res){
                            if(res.status=='success'){
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "preventDuplicates": true,
                                    "onclick": null,
                                    "showDuration": "100",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "show",
                                    "hideMethod": "hide"
                                };
                                toastr.success("<?php echo e(__('Service On/Off Change Success---')); ?>");
                            }
                        }
                    });
                }else{
                    var service_id = $(this).data('id');
                    $.ajax({
                        method:'post',
                        url:"<?php echo e(route('seller.services.on.of')); ?>",
                        data:{service_id:service_id},
                        success:function(res){
                            if(res.status=='success'){
                                toastr.options = {
                                    "closeButton": true,
                                    "debug": false,
                                    "newestOnTop": false,
                                    "progressBar": true,
                                    "preventDuplicates": true,
                                    "onclick": null,
                                    "showDuration": "100",
                                    "hideDuration": "1000",
                                    "timeOut": "5000",
                                    "extendedTimeOut": "1000",
                                    "showEasing": "swing",
                                    "hideEasing": "linear",
                                    "showMethod": "show",
                                    "hideMethod": "hide"
                                };
                                toastr.success("<?php echo e(__('Service On/Off Change Success---')); ?>");
                            }
                        }
                    });
                }

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

        });

    })(jQuery);
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/pinpointplus/s8/@core/resources/views/frontend/user/seller/services/partials/services-two.blade.php ENDPATH**/ ?>