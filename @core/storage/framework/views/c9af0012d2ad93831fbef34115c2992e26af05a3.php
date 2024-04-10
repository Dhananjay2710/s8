<?php if($errors->any()): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li><?php echo e($error); ?></li>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?><?php /**PATH /var/www/pinpointplus/s8/@core/resources/views/components/error-message.blade.php ENDPATH**/ ?>