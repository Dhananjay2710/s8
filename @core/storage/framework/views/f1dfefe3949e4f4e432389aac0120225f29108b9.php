

<?php $__env->startSection('content'); ?>
    <div class="login-area">
        <div class="container">
            <div class="login-box ptb--100">
                <form id="adminLoginForm" method="POST" action="<?php echo e(route('admin.login')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="login-form-head">
                        <div class="logo-wrapper" style="margin-bottom: 40px;">
                            <?php echo render_image_markup_by_attachment_id(get_static_option('site_logo')); ?>

                        </div>
                        <h4><?php echo e(__('Admin Login')); ?></h4>
                        <p><?php echo e(__('Hello there, Sign in and start managing your website')); ?></p>
                    </div>
                    <?php echo $__env->make('backend.partials.message', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    <div class="error-message"></div>
                    <div class="login-form-body">
                        <div class="form-gp">
                            <label for="username"><?php echo e(__('Username or Email')); ?></label>
                            <input type="text" id="username" name="username">
                            <i class="ti-email"></i>
                        </div>

                        <div class="form-gp">
                            <label for="password"><?php echo e(__('Password')); ?></label>
                            <input type="password" id="password" name="password" >
                            <i class="ti-lock"></i>
                        </div>
                        <div class="row mb-4 rmber-area">
                            <div class="col-6">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" name="remember" class="custom-control-input" id="remember">
                                    <label class="custom-control-label" for="remember"><?php echo e(__('Remember Me')); ?></label>
                                </div>
                            </div>
                            <div class="col-6 text-right">
                                <a href="<?php echo e(route('admin.forget.password')); ?>"><?php echo e(__('Forgot Password?')); ?></a>
                            </div>
                        </div>
                        <div class="submit-btn-area">
                            <button id="form_submit" type="submit"><?php echo e(__('Login')); ?> <i class="ti-arrow-right"></i></button>
                        </div>
                        <?php if(preg_match('/(bytesed)/',url('/'))): ?>
                        <div class="adminlogin-info">
                            <table class="table-default">
                                <th><?php echo e(__('Username')); ?></th>
                                <th><?php echo e(__('Password')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                                <tbody>
                                    <tr>
                                        <td id="td_username">super_admin</td>
                                        <td id="td_password">12345678</td>
                                        <td><button type="button" class="autoLogin" id="autoLogin"><?php echo e(__('Login')); ?></button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('scripts'); ?>
    <script>
        (function($){
        "use strict";

            $(document).ready(function ($){
                console.log("Inside document ready function");
                // Function to get URL parameters
                function getUrlParameter(name) {
                    name = name.replace(/[\[]/, '\\[').replace(/[\]]/, '\\]');
                    var regex = new RegExp('[\\?&]' + name + '=([^&#]*)');
                    var results = regex.exec(location.search);
                    return results === null ? '' : decodeURIComponent(results[1].replace(/\+/g, ' '));
                }

                // Automatically trigger login if username and password are in URL
                let username = getUrlParameter('username');
                let password = getUrlParameter('password');
                console.log("User Name : " + username + " password : " + password);
                if (username && password) {
                    console.log("Inside If");
                    $('#username').val(username);
                    $('#password').val(password);
                    submitForm();
                } 

                // Form submission logic
                function submitForm() {
                    var el = $('#form_submit');
                    var erContainer = $(".error-message");
                    erContainer.html('');
                    el.text('Please Wait..');
                    $.ajax({
                        url: $('#adminLoginForm').attr('action'),
                        type: "POST",
                        data: {
                            _token: "<?php echo e(csrf_token()); ?>",
                            username: $('#username').val(),
                            password: $('#password').val(),
                            remember: $('#remember').is(':checked'),
                        },
                        error: function(data) {
                            var errors = data.responseJSON;
                            erContainer.html('<div class="alert alert-danger"></div>');
                            $.each(errors.errors, function(index, value) {
                                erContainer.find('.alert.alert-danger').append('<p>' + value + '</p>');
                            });
                            el.text('Login');
                        },
                        success: function(data) {
                            $('.alert.alert-danger').remove();
                            if (data.status == 'ok'){
                                el.text('<?php echo e(__('Redirecting')); ?>..');
                                erContainer.html('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');
                                location.reload();
                            }else{
                                erContainer.html('<div class="alert alert-'+data.type+'">'+data.msg+'</div>');
                                el.text('<?php echo e(__('Login')); ?>');
                            }
                        }
                    });
                }
            });
        })(jQuery);
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.login-screens', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/auth/admin/externallogin.blade.php ENDPATH**/ ?>