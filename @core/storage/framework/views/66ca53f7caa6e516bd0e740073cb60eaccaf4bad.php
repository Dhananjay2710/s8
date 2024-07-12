<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Customer Account Settings')); ?>

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
    <?php echo $__env->make('frontend.user.buyer.partials.sidebar-two', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="dashboard__right">
        <?php echo $__env->make('frontend.user.buyer.header.buyer-header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <!-- Buyer Account settings section start-->
                <div class="dashboard_accountSettings">
                    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.error-message','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('error-message'); ?>
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
                    <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                        <div class="dashboard_accountSettings__item">
                            <div class="dashboard_accountSettings__flex">
                                <div class="dashboard_accountSettings__left">
                                    <h4 class="dashboard_accountSettings__title"><?php echo e(__('Change Password')); ?></h4>
                                    <p class="dashboard_accountSettings__para mt-2"><?php echo e(__('Last changed')); ?>

                                        <?php echo e(Auth::guard('web')->user()->updated_at->diffForHumans()); ?>

                                    </p>
                                </div>
                                <div class="dashboard_accountSettings__btn">
                                    <div class="btn-wrapper" data-bs-toggle="modal" data-bs-target="#changePassword">
                                        <a href="javascript:void(0)" class="dashboard_table__title__btn btn-bg-1 radius-5"><?php echo e(__('Change Password')); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dashboard_accountSettings__item">
                            <div class="dashboard_accountSettings__flex">
                                <div class="dashboard_accountSettings__left">
                                    <h4 class="dashboard_accountSettings__title"> <?php echo e(__('Deactivate/Delete account')); ?> </h4>
                                    <p class="dashboard_accountSettings__para mt-2">
                                        <?php if(!empty($user)): ?>
                                            <?php if($user->status === 0): ?>
                                                <?php echo e(__('Currently your account is deactivated. You can activate from here. ')); ?>

                                            <?php elseif($user->status === 1): ?>
                                                <?php echo e(__('Your account has been deleted')); ?>

                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo e(__('You can deactivate your account temporarily or Delete permanently')); ?>

                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div class="dashboard_accountSettings__btn btn_flex">

                                    <?php if(empty($user)): ?>
                                        <a href="javascript:void(0)" class="dashboard_table__title__btn btn-bg-deactivate radius-5"
                                           data-bs-toggle="modal"
                                           data-bs-target="#deactivateAccount"
                                        ><?php echo e(__('Deactivate')); ?></a>
                                    <?php endif; ?>

                                    <a href="javascript:void(0)" class="dashboard_table__title__btn btn-outline-delete hover_danger radius-5"
                                       data-bs-toggle="modal" data-bs-target="#deleteAccount"><?php echo e(__('Delete')); ?></a>


                                    <?php if(!empty($user)): ?>
                                        <?php if($user->status === 0): ?>
                                            <a href="<?php echo e(route('buyer.account.deactive.cancel',$user->user_id)); ?>" class="dashboard_table__title__btn btn-bg-deactivate radius-5"><?php echo e(__('Activate Your Account')); ?></a>
                                        <?php elseif($user->status === 1): ?>
                                            <a href="javascript:void(0)" class="dashboard_table__title__btn btn-bg-deactivate radius-5"><?php echo e(__('Already Delete Account')); ?></a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- buyer Account settings section End-->
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Change Password')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('seller.account.settings')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="CurrentPassword" class="label_title__postition"><?php echo e(__('Current password')); ?> <span class="text-danger">*</span> </label>
                                        <input class="form--control radius-10" type="password" name="current_password" id="current_password" placeholder="<?php echo e(__('Type Current Password')); ?>">
                                        <span class="toggle_password"><i class="fa fa-eye-slash"></i></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition"><?php echo e(__('Type New password')); ?> <span class="text-danger">*</span> </label>
                                        <input class="form--control radius-10" type="password" name="new_password" id="new_password" placeholder="<?php echo e(__('Type New Password')); ?>">
                                        <span class="toggle_password"><i class="fa fa-eye-slash"></i></span>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="reTypePassword" class="label_title__postition"><?php echo e(__('Retype new password')); ?> <span class="text-danger">*</span> </label>
                                        <input class="form--control radius-10" type="password" name="confirm_password" id="confirm_password" placeholder="<?php echo e(__('Retype Password')); ?>">
                                        <span class="toggle_password"><i class="fa fa-eye-slash"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal"><?php echo e(__('Change Password')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Deactivate Account Modal -->
    <div class="modal fade" id="deactivateAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Deactivate Account')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('buyer.account.deactive')); ?>" method="post">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="CurrentPassword" class="label_title__postition"><?php echo e(__('Deactivation reason')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select class="select2_activation" name="reason" id="reason2">
                                                <option value="For Vacation"><?php echo e(__('For Vacation')); ?></option>
                                                <option value="Personal Reasons"><?php echo e(__('Personal Reasons')); ?></option>
                                                <option value="Others"><?php echo e(__('Others')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition"><?php echo e(__('Describe')); ?> <span class="text-danger">*</span> </label>
                                        <textarea class="form--control radius-10"  name="description" id="description" cols="30" rows="4"
                                                  placeholder="<?php echo e(__('e.g. explain why you are deactivating')); ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Deactivate Now')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Account Modal -->
    <div class="modal fade" id="deleteAccount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?php echo e(__('Delete account')); ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="<?php echo e(route('buyer.account.delete')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="row g-4">
                                <div class="col-12">
                                    <div class="dashboard_accountDelete">
                                        <p class="dashboard_accountDelete__reason"><?php echo e(__('Account deletion is permanent')); ?></p>
                                        <p class="dashboard_accountDelete__reason"><?php echo e(__('We remove all your data')); ?></p>
                                        <p class="dashboard_accountDelete__reason"><?php echo e(__('You can’t log in to this account anymore')); ?></p>
                                        <p class="dashboard_accountDelete__reason"><?php echo e(__('Any services that are currently on progress will be suspended')); ?></p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="CurrentPassword" class="label_title__postition"><?php echo e(__('Delete reason')); ?> <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select class="select2_activation" name="reason" id="reason">
                                                <option value="For Vacation"><?php echo e(__('For Vacation')); ?></option>
                                                <option value="Personal Reasons"><?php echo e(__('Personal Reasons')); ?></option>
                                                <option value="Others"><?php echo e(__('Others')); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition"><?php echo e(__('Describe')); ?> <span class="text-danger">*</span> </label>
                                        <textarea class="form--control radius-10"  name="description" id="description" cols="30" rows="4"
                                                  placeholder="<?php echo e(__('e.g. explain why you are deactivating')); ?>"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
                                <button type="submit" class="btn btn-danger" data-bs-dismiss="modal"><?php echo e(__('Delete Now')); ?></button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // modal close
                $('.close').on('click', function (){
                    $('#media_upload_modal').modal('hide');
                });

                $('#reason').select2({
                    dropdownParent: $('#deleteAccount')
                });
                $('#reason2').select2({
                    dropdownParent: $('#deactivateAccount')
                });

            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.user.buyer.buyer-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/buyer/profile/partials/account-settings-two.blade.php ENDPATH**/ ?>