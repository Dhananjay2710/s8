

<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Service Book Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-6 mt-5">
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
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title mb-4"><?php echo e(__("Service Book Settings")); ?></h4>
                        <form action="<?php echo e(route('admin.service.book.settings.update')); ?>" method="POST" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="form-group">
                                <label for="service_main_attribute_title"><?php echo e(__('Service Main Attribute Title')); ?></label>
                                <input type="text" name="service_main_attribute_title"  class="form-control" value="<?php echo e(get_static_option('service_main_attribute_title')); ?>" id="service_main_attribute_title">
                            </div>
                            <div class="form-group">
                                <label for="service_additional_attribute_title"><?php echo e(__('Service Additional Attribute Title')); ?></label>
                                <input type="text" name="service_additional_attribute_title"  class="form-control" value="<?php echo e(get_static_option('service_additional_attribute_title')); ?>" id="service_additional_attribute_title">
                            </div>
                            <div class="form-group">
                                <label for="service_benifits_title"><?php echo e(__('Service Benifits Title')); ?></label>
                                <input type="text" name="service_benifits_title"  class="form-control" value="<?php echo e(get_static_option('service_benifits_title')); ?>" id="service_benifits_title">
                            </div>
                            <div class="form-group">
                                <label for="service_booking_title"><?php echo e(__('Service Booking Title')); ?></label>
                                <input type="text" name="service_booking_title"  class="form-control" value="<?php echo e(get_static_option('service_booking_title')); ?>" id="service_booking_title">
                            </div>
                            <div class="form-group">
                                <label for="service_appoinment_package_title"><?php echo e(__('Service Appoinment Package Title')); ?></label>
                                <input type="text" name="service_appoinment_package_title"  class="form-control" value="<?php echo e(get_static_option('service_appoinment_package_title')); ?>" id="service_appoinment_package_title">
                            </div>
                            <div class="form-group">
                                <label for="service_package_fee_title"><?php echo e(__('Service Package Fee Title')); ?></label>
                                <input type="text" name="service_package_fee_title"  class="form-control" value="<?php echo e(get_static_option('service_package_fee_title')); ?>" id="service_package_fee_title">
                            </div>
                            <div class="form-group">
                                <label for="service_extra_title"><?php echo e(__('Service Extra Title')); ?></label>
                                <input type="text" name="service_extra_title"  class="form-control" value="<?php echo e(get_static_option('service_extra_title')); ?>" id="service_extra_title">
                            </div>
                            <div class="form-group">
                                <label for="service_subtotal_title"><?php echo e(__('Service Subtotal Title')); ?></label>
                                <input type="text" name="service_subtotal_title"  class="form-control" value="<?php echo e(get_static_option('service_subtotal_title')); ?>" id="service_subtotal_title">
                            </div>
                            <div class="form-group">
                                <label for="service_total_amount_title"><?php echo e(__('Service Total Amount Title')); ?></label>
                                <input type="text" name="service_total_amount_title"  class="form-control" value="<?php echo e(get_static_option('service_total_amount_title')); ?>" id="service_total_amount_title">
                            </div>
                            <div class="form-group">
                                <label for="service_available_date_title"><?php echo e(__('Service Available Date Title')); ?></label>
                                <input type="text" name="service_available_date_title"  class="form-control" value="<?php echo e(get_static_option('service_available_date_title')); ?>" id="service_available_date_title">
                            </div>
                            <div class="form-group">
                                <label for="service_available_schudule_title"><?php echo e(__('Service Available Schedule Title')); ?></label>
                                <input type="text" name="service_available_schudule_title"  class="form-control" value="<?php echo e(get_static_option('service_available_schudule_title')); ?>" id="service_available_schudule_title">
                            </div>
                            <div class="form-group">
                                <label for="service_booking_information_title"><?php echo e(__('Service Booking Information Title')); ?></label>
                                <input type="text" name="service_booking_information_title"  class="form-control" value="<?php echo e(get_static_option('service_booking_information_title')); ?>" id="service_booking_information_title">
                            </div>
                            <div class="form-group">
                                <label for="terms_and_conditions_link"><?php echo e(__('Trems and Conditions Link')); ?></label> </br>
                                <small class="text-danger"><?php echo e(__('This link will be set in service request confirmation terms and conditions.')); ?></small>
                                <input type="text" name="terms_and_conditions_link"  class="form-control" value="<?php echo e(get_static_option('terms_and_conditions_link')); ?>" id="terms_and_conditions_link">
                            </div>
                            <div class="form-group">
                                <label for="service_order_confirm_title"><?php echo e(__('Service Service Request Confirm Title')); ?></label>
                                <input type="text" name="service_order_confirm_title"  class="form-control" value="<?php echo e(get_static_option('service_order_confirm_title')); ?>" id="service_order_confirm_title">
                            </div>

                            <button type="submit" id="update" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Changes')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('script'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){
                <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.icon-picker','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('icon-picker'); ?>
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
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.btn.update','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('btn.update'); ?>
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
            });
        }(jQuery));
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/backend/pages/services/service-book-settings.blade.php ENDPATH**/ ?>