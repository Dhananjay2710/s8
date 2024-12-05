<?php $__env->startSection('site-title'); ?>
    <?php echo e(__('Add New User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <!-- basic form start -->
            <div class="col-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title"><?php echo e(__('New User')); ?></h4>
                        <?php echo $__env->make('backend/partials/message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo $__env->make('backend/partials/error', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <form action="<?php echo e(route('admin.all.frontend.store-new-user')); ?>" method="post" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label for="name"><?php echo e(__('Name')); ?></label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="<?php echo e(__('Enter name')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="username"><?php echo e(__('Username')); ?></label>
                                <input type="text" class="form-control"  id="username" name="username" placeholder="<?php echo e(__('Username')); ?>">
                                <small class="text text-danger"><?php echo e(__('Remember this username, user will login using this username')); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Email')); ?></label>
                                <input type="text" class="form-control"  id="email" name="email" placeholder="<?php echo e(__('Email')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="phone"><?php echo e(__('Phone')); ?></label>
                                <input type="text" class="form-control"  id="phone" name="phone" placeholder="<?php echo e(__('Phone')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="country"><?php echo e(__('Country')); ?></label>
                                <?php echo get_country_field('country','country','form-control'); ?>

                            </div>
                            <div class="form-group">
                                <label for="state"><?php echo e(__('State')); ?></label>
                                <input type="text" class="form-control"  id="state" name="state" placeholder="<?php echo e(__('State')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="city"><?php echo e(__('City')); ?></label>
                                <input type="text" class="form-control"  id="city" name="city" placeholder="<?php echo e(__('City')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="zipcode"><?php echo e(__('Zipcode')); ?></label>
                                <input type="text" class="form-control"  id="zipcode" name="zipcode" placeholder="<?php echo e(__('Zipcode')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="address"><?php echo e(__('Address')); ?></label>
                                <input type="text" class="form-control"  id="address" name="address" placeholder="<?php echo e(__('Address')); ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Designation')); ?></label>
                                <input type="text" class="form-control"  id="designation" name="designation" placeholder="<?php echo e(__('Designation')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="email"><?php echo e(__('Description')); ?></label>
                                <textarea class="form-control" cols="5" name="description" id="description"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="userType"><?php echo e('User Type'); ?></label>
                                <select name="userType" class="form-control">
                                    <option value=""><?php echo e(__('Select User Type')); ?></option>
                                    <?php $__currentLoopData = $userTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $userType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($userType); ?>"><?php echo e($userType); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="password"><?php echo e(__('Password')); ?></label>
                                <input type="password" class="form-control"  id="password" name="password" placeholder="<?php echo e(__('Password')); ?>">
                            </div>
                            <div class="form-group">
                                <label for="password_confirmation"><?php echo e(__('Password Confirm')); ?></label>
                                <input type="password" class="form-control"  id="password_confirmation" name="password_confirmation" placeholder="<?php echo e(__('Password Confirmation')); ?>">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4"><?php echo e(__('Add New User')); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('backend.admin-master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/backend/frontend-user/add-new-user.blade.php ENDPATH**/ ?>