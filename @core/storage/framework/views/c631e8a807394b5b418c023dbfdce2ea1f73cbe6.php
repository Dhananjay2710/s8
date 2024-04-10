<!DOCTYPE html>
<html lang="<?php echo e(get_user_lang()); ?>" dir="<?php echo e(get_user_lang_direction()); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('site-title',''); ?></title>
    <?php echo render_favicon_by_id(get_static_option('site_favicon')); ?>

    <?php echo load_google_fonts(); ?>

    <!-- header two -->
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/animate.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/flaticon.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/slick.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/line-awesome.min.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/select2.min.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/flatpickr.min.css')); ?>">
    <link rel="stylesheet" href=" <?php echo e(asset('assets/frontend/theme-two/css/buyer_dashboard.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/toastr.min.css')); ?>">
    <?php if( get_user_lang_direction() === 'rtl'): ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/common/css/rtl.css')); ?>">
    <?php endif; ?>
    <link rel="canonical" href="<?php echo e(request()->url()); ?>" />
    <script src="<?php echo e(asset('assets/common/js/jquery-3.6.0.min.js')); ?>"></script>
    <?php echo $__env->make('frontend.partials.root-style', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('style'); ?>
</head>
<body>
<?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/partials/header-two.blade.php ENDPATH**/ ?>