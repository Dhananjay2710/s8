<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Seller Profile Verify')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('style'); ?>
    <style>
        .single-dashboard-input .attachment-preview {
            width: 500px;
            height: 500px;
        }
        .notice-board {
            display: block;
            background-color: #fff;
            box-shadow: 0 0 20px #f2f2f2;
            border-left: 5px solid #dc3545;
            padding: 10px;
            border-radius: 10px;
            margin-top: 30px;
        }
    </style>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.css','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.css'); ?>
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

            <div class="dashboard__inner mt-3">
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <div class="row">
                        <div class="col-lg-12 margin-top-40">
                            <div class="edit-profile">
                                <div class="profile-info-dashboard mt-3">
                                    <h4 class="dashboards-title"> <?php echo e(__('Profile Verify')); ?> </h4>
                                    <?php if(!is_null($seller_verify_info) && $seller_verify_info->status === 1): ?>
                                            <div class="alert alert-success mt-3 mx-2" style="width: 170px">  <i class="las la-check-circle mx-2" style="font-size: 25px"></i><?php echo e(__('Profile Verified')); ?>

                                            </div>
                                    <?php else: ?>

                                        <div class="notice-board mt-3">
                                            <p class="text-danger"><?php echo e(__('Submit your original documents so that the admin can verify you. Once verified a badge will show in your profile that increase your order possibility')); ?></p>
                                        </div>

                                        <div class="dashboard-profile-flex">
                                            <div class="dashboard-address-details">

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

                                                <form action="<?php echo e(route('seller.profile.verify')); ?>" method="post">
                                                    <?php echo csrf_field(); ?>
                                                    <div class="single-dashboard-input">
                                                         <div class="row">
                                                             <div class="col-xxl-6 col-lg-6">
                                                                 <div class="single-info-input margin-top-30">
                                                                     <div class="form-group">
                                                                         <div class="media-upload-btn-wrapper">
                                                                             <div class="img-wrap">
                                                                                 <?php echo render_image_markup_by_attachment_id(optional($seller_verify_info)->national_id ?? '','','large'); ?>

                                                                             </div>
                                                                             <input type="hidden" id="national_id" name="national_id"
                                                                                    value="<?php echo e(optional($seller_verify_info)->national_id ?? ''); ?>">
                                                                             <button type="button" class="btn btn-success media_upload_form_btn"
                                                                                     data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                                     data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-bs-toggle="modal"
                                                                                     data-bs-target="#media_upload_modal">
                                                                                 <?php echo e(__('Upload Your National ID')); ?>

                                                                             </button>
                                                                         </div>
                                                                         <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                                                         <br>
                                                                         <small class="text-danger"><?php echo e(__('recommended size 740x504')); ?></small>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                             <div class="col-xxl-6 col-lg-6">
                                                                 <div class="single-info-input margin-top-30">
                                                                     <div class="form-group">
                                                                         <div class="media-upload-btn-wrapper">
                                                                             <div class="img-wrap">
                                                                                 <?php echo render_image_markup_by_attachment_id(optional($seller_verify_info)->address ?? '','','large'); ?>

                                                                             </div>
                                                                             <input type="hidden" id="address" name="address"
                                                                                    value="<?php echo e(optional($seller_verify_info)->address ?? ''); ?>">
                                                                             <button type="button" class="btn btn-success media_upload_form_btn"
                                                                                     data-btntitle="<?php echo e(__('Select Image')); ?>"
                                                                                     data-modaltitle="<?php echo e(__('Upload Image')); ?>" data-bs-toggle="modal"
                                                                                     data-bs-target="#media_upload_modal">
                                                                                 <?php echo e(__('Upload Your Address Document')); ?>

                                                                             </button>
                                                                         </div>
                                                                         <small class="form-text text-muted"><?php echo e(__('allowed image format: jpg,jpeg,png')); ?></small>
                                                                         <br>
                                                                         <small class="text-danger"><?php echo e(__('recommended size 740x504')); ?></small>
                                                                     </div>
                                                                 </div>
                                                             </div>
                                                         </div>
                                                    </div>


                                                    <div class="dashboard__headerGlobal__btn">
                                                        <div class="btn-wrapper">
                                                            <button href="#" class="dashboard_table__title__btn btn-bg-1 radius-5" type="submit"> <?php echo e(__('Send Verify Request')); ?></button>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.markup','data' => ['type' => 'web']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.markup'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <!-- Dashboard area end -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.media.js','data' => ['type' => 'web']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('media.js'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('web')]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/profile-verify/partials/seller-profile-verify-two.blade.php ENDPATH**/ ?>