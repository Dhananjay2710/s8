<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Dashboard Variant Settings')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('style'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.datatable.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('datatable.css'); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
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
            </div>

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Buyer & Seller Dashboard Variant')); ?> </h4>
                            </div>
                        </div>
                        <form action="<?php echo e(route('admin.dashboard.variant')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <input type="hidden" class="form-control"  id="dashboard_variant_buyer" value="<?php echo e(get_static_option('dashboard_variant_buyer')); ?>" name="dashboard_variant_buyer">
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6">
                                    <div class="img-select">
                                        <div class="img-wrap">
                                            <img src="<?php echo e(asset('assets/backend/dashboard-variant/buyer/01.jpg')); ?>" data-dashboard_id="01" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6">
                                    <div class="img-select">
                                        <div class="img-wrap">
                                            <img src="<?php echo e(asset('assets/backend/dashboard-variant/buyer/02.jpg')); ?>" data-dashboard_id="02" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update Variant')); ?></button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Seller Dashboard Weekly Work Summary Start Day Add')); ?> </h4>
                            </div>
                        </div>

                        <form action="<?php echo e(route('admin.dashboard.variant')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="start_week_from"><?php echo e(__('Select Start Day')); ?></label>
                                <?php  $days_array = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'); ?>
                                <select name="start_week_from" class="form-control">
                                    <?php $__currentLoopData = $days_array; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $day_name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <option value="<?php echo e($key); ?>" <?php if(get_static_option('start_week_from') == $key): ?> selected <?php endif; ?>><?php echo e($day_name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <button id="update" type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Update')); ?></button>
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

            $(document).ready(function () {
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

                let imgSelect = $('.img-select');
                let id = $('#dashboard_variant_buyer').val();
                imgSelect.removeClass('selected');
                $('img[data-dashboard_id="'+id+'"]').parent().parent().addClass('selected');

                // buyer dashboard
                $(document).on('click','.img-select img',function (e) {
                    e.preventDefault();
                    imgSelect.removeClass('selected');
                    $(this).parent().parent().addClass('selected').siblings();
                    $('#dashboard_variant_buyer').val($(this).data('dashboard_id'));
                });

            });

        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp\htdocs\v105\@core\resources\views/backend/theme-variant/dashboard-variant.blade.php ENDPATH**/ ?>