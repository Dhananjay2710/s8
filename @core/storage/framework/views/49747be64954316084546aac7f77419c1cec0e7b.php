<style>
    :root {
        --main-color-one: <?php echo e(get_static_option('site_main_color_one','#1DBF73')); ?>;
        --main-color-two: <?php echo e(get_static_option('site_main_color_two','#47C8ED')); ?>;
        --main-color-three: <?php echo e(get_static_option('site_main_color_three','#FF6B2C')); ?>;
        --heading-color: <?php echo e(get_static_option('heading_color','#333333')); ?>;
        --light-color: <?php echo e(get_static_option('light_color','#666666')); ?>;
        --extra-light-color: <?php echo e(get_static_option('extra_light_color','#999999')); ?>;

        --heading-font: <?php echo e(get_static_option('heading_font_family')); ?>,sans-serif;
        --body-font: <?php echo e(get_static_option('body_font_family')); ?>,sans-serif;

            <?php if(get_static_option('dashboard_variant_seller') == '02'): ?>
              <?php if(!empty(Auth::guard('web')->user()->user_typ) == 0): ?>
              <?php if(request()->is('seller/*')): ?>
                --main-color-one: #2163b3;
                --main-color-one-rgb: 33, 99, 179;
              <?php endif; ?>
              <?php if(request()->is('serviceprovider/*')): ?>
                --main-color-one: #2163b3;
                --main-color-one-rgb: 33, 99, 179;
              <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>
        }
    </style>



<?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/frontend/partials/root-style.blade.php ENDPATH**/ ?>