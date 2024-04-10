
<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('User Register Settings')); ?>

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
                                <h4 class="header-title"><?php echo e(__('Seller Register Settings')); ?> </h4>
                                <p class="mb-3 text-info"><?php echo e(__('You can set the seller register on/off  and Service Area field required from here.')); ?></p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">

                            <form action="<?php echo e(route('admin.seller.register.settings.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="commission_charge"><?php echo e(__('Seller Register On/Off')); ?></label>
                                    <select name="seller_register_on_off" id="seller_register_on_off" class="form-control">
                                        <option value="on" <?php echo e(get_static_option('seller_register_on_off')=== 'on'? 'selected': ''); ?>><?php echo e(__('On')); ?></option>
                                        <option value="off" <?php echo e(get_static_option('seller_register_on_off')=== 'off' ? 'selected': ''); ?> ><?php echo e(__('Off')); ?></option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="site_google_captcha_enable"><strong><?php echo e(__('Service Area')); ?></strong></label>
                                    <label class="switch yes">
                                        <input type="checkbox" name="seller_service_area_required"  <?php if(!empty(get_static_option('seller_service_area_required'))): ?> checked <?php endif; ?>>
                                        <span class="slider-enable-disable"></span>
                                    </label>
                                </div>

                                <div class="form-group mt-4">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Buyer Register Settings')); ?> </h4>
                                <p class="mb-3 text-info"><?php echo e(__('You can set the buyer register on/off from here.')); ?></p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <form action="<?php echo e(route('admin.buyer.register.settings.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="commission_charge"><?php echo e(__('Buyer Register On/Off')); ?></label>
                                    <select name="buyer_register_on_off" id="buyer_register_on_off" class="form-control">
                                        <option value="on" <?php echo e(get_static_option('buyer_register_on_off')=== 'on'? 'selected' :''); ?> ><?php echo e(__('On')); ?></option>
                                        <option value="off" <?php echo e(get_static_option('buyer_register_on_off')=== 'off'? 'selected' :''); ?>><?php echo e(__('Off')); ?></option>
                                    </select>
                                </div>


                                <div class="form-group mt-4">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title"><?php echo e(__('Register Notice')); ?> </h4>
                                <p class="mb-3 text-info"><?php echo e(__('This notice will show in register page only if the seller and buyer registration off.')); ?></p>
                            </div>
                        </div>
                        <div class="table-wrap table-responsive">
                            <form action="<?php echo e(route('admin.seller.buyer.register.off.notice.update')); ?>" method="post">
                                <?php echo csrf_field(); ?>
                                <div class="form-group">
                                    <label for="commission_charge"><?php echo e(__('Register Notice')); ?></label>
                                    <textarea class="form-control" name="register_notice" id="register_notice" cols="30" rows="5"><?php echo e(get_static_option('register_notice') ?? ''); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/backend/pages/register-settings/user-register-settings.blade.php ENDPATH**/ ?>