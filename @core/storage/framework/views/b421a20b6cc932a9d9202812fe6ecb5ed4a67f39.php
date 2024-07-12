<a tabindex="0" class="btn btn-success btn-xs btn-sm mr-1 swal_status_change_order_accept text-white"><?php echo e(__('Accept')); ?></a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn_accept_order d-none"></button>
</form><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/components/accept-order.blade.php ENDPATH**/ ?>