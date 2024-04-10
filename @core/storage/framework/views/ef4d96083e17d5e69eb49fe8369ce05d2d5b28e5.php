<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Show Service Attributes')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
   <style>
       .theme-two-color{
           font-size: 20px;
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
                <div class="dashboard__headerContents">
                    <div class="dashboard__headerContents__flex">
                        <div class="dashboard__headerContents__left">
                            <h4 class="dashboard_table__title"> <?php echo e(__('Show Service Attributes')); ?> </h4>
                        </div>
                    </div>
                </div>

                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="show_service_all_attr">
                        <div class="row">
                            <div class="col-lg-4">
                                <h5><?php echo e(__('Service Title:')); ?> <strong><?php echo e($service->title); ?></strong></h5>
                                <div class="dashboard_recentOrder__item__service__thumb mt-3" style="height: 150px; width: 200px">
                                    <?php if(!empty(render_image_markup_by_attachment_id($service->image, ''))): ?>
                                        <?php echo render_image_markup_by_attachment_id($service->image, ''); ?>

                                    <?php else: ?>
                                        <img src="<?php echo e(asset('assets/uploads/no-image.png')); ?>" class="no_image_style_two" alt="No Image">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-service-single-item border-1 margin-top-40 mt-4">

                        <h5 class="mb-3"><?php echo e(__('Include Service Attributes')); ?></h5>
                        <div class="rows dash-single-inner">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th><?php echo e(__('No')); ?></th>
                                    <th><?php echo e(__('Title')); ?></th>
                                    <th><?php echo e(__('Price')); ?></th>
                                    <th><?php echo e(__('Quantity')); ?></th>
                                    <th><?php echo e(__('Action')); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $__currentLoopData = $include_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$inc_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($key+1); ?></td>
                                        <td><?php echo e($inc_service->include_service_title); ?></td>
                                        <td><?php echo e(float_amount_with_currency_symbol($inc_service->include_service_price)); ?></td>
                                        <td><?php echo e($inc_service->include_service_quantity); ?></td>
                                        <td>
                                            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.services.includeservice.delete',$inc_service->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.services.includeservice.delete',$inc_service->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>

                        <?php if($additional_service->count() >= 1): ?>
                            <h5 class="mt-3 mb-3"><?php echo e(__('Additional Service Attributes')); ?></h5>
                            <div class="rows dash-single-inner">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('No')); ?></th>
                                        <th><?php echo e(__('Title')); ?></th>
                                        <th><?php echo e(__('Price')); ?></th>
                                        <th><?php echo e(__('Quantity')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $additional_service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$addi_service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e($addi_service->additional_service_title); ?></td>
                                            <td><?php echo e(float_amount_with_currency_symbol($addi_service->additional_service_price)); ?></td>
                                            <td><?php echo e($addi_service->additional_service_quantity); ?></td>
                                            <td>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.services.additionalservice.delete',$addi_service->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.services.additionalservice.delete',$addi_service->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                        <?php if($service_benifit->count() >= 1): ?>
                            <h5 class="mt-3 mb-3"><?php echo e(__('Service Benefit')); ?></h5>
                            <div class="rows dash-single-inner">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('No')); ?></th>
                                        <th><?php echo e(__('Benefit')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $service_benifit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$ser_benifit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e($ser_benifit->benifits); ?></td>
                                            <td>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.services.benifit.delete',$ser_benifit->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.services.benifit.delete',$ser_benifit->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                        <?php if($service_faqs->count() >= 1): ?>
                            <h5 class="mt-3 mb-3"><?php echo e(__('Service Faqs')); ?></h5>
                            <div class="rows dash-single-inner">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th><?php echo e(__('No')); ?></th>
                                        <th><?php echo e(__('Faq Title')); ?></th>
                                        <th><?php echo e(__('Faq Description')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $__currentLoopData = $service_faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$service_faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($key+1); ?></td>
                                            <td><?php echo e($service_faq->title); ?></td>
                                            <td><?php echo e($service_faq->description); ?></td>
                                            <td>
                                                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seller-delete-popup','data' => ['url' => route('seller.services.faq.delete',$service_faq->id)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('seller-delete-popup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['url' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('seller.services.faq.delete',$service_faq->id))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>
        </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.edit_todo_modal',function(e){
                    e.preventDefault();
                    let todo_id = $(this).data('id');
                    let title = $(this).data('title');
                    let description = $(this).data('description');

                    $('#up_id').val(todo_id);
                    $('#up_title').val(title);
                    $('#up_description').val(description);
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
                        confirmButtonText: 'Yes, delete it!'
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
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/pinpointplus/s8/@core/resources/views/frontend/user/seller/services/partials/show-service-attributes-by-id-two.blade.php ENDPATH**/ ?>