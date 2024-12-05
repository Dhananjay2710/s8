<span class="dash-icon color-3 member_delete_button"> <i class="las la-trash-alt text-danger theme-two-color"></i> </span>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="member_form_submit_btn d-none"></button>
</form>
<?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/components/seller-member-delete.blade.php ENDPATH**/ ?>