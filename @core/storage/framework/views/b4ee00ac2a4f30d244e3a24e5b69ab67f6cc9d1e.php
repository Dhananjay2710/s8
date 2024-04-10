<!-- back to top area start -->
<div class="back-to-top">
    <span class="back-top"><i class="las la-angle-up"></i></span>
</div>
<!-- back to top area end -->

 <!-- footer two -->
<script src="<?php echo e(asset('assets/frontend/theme-two/js/jquery-3.6.0.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/theme-two/js/jquery-migrate.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/theme-two/js/bootstrap.bundle.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/js/chart.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/theme-two/js/wow.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/theme-two/js/slick.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/theme-two/js/jquery.nicescroll.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/theme-two/js/select2.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/theme-two/js/flatpickr.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/frontend/theme-two/js/main.js')); ?>"></script>
<script src="<?php echo e(asset('assets/backend/js/sweetalert2.js')); ?>"></script>

<script>
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

<script src="<?php echo e(asset('assets/common/js/toastr.min.js')); ?>"></script>
<?php echo Toastr::message(); ?>


<?php echo $__env->yieldContent('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/i18n/<?php echo e(current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))); ?>.js"></script>
<script>
    /*-----------------
     Select2
    ------------------*/
    $('select').select2({
         language: "<?php echo e(current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))); ?>"
    });
    document.addEventListener('livewire:load', function () {
        // Your JS here.
        $('select').select2({
            language: "<?php echo e(current(explode('_',\App\Helpers\LanguageHelper::user_lang_slug()))); ?>"
        });
    })
</script>
<?php echo \Livewire\Livewire::scripts(); ?>

 <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/user/seller/partials/footer-two.blade.php ENDPATH**/ ?>