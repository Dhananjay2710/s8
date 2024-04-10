<span class="dash-icon color-3 swal_delete_button"> <i class="las la-trash-alt text-danger theme-two-color"></i> </span>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
<input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
<br>
<button type="submit" class="swal_form_submit_btn d-none"></button>
 </form>
<?php /**PATH /var/www/pinpointplus/s8/@core/resources/views/components/seller-delete-popup.blade.php ENDPATH**/ ?>