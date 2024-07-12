<a tabindex="0" class="btn btn-danger btn-xs btn-sm mr-1 swal_status_change_decline text-white"><?php echo e(__('Decline')); ?></a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
    <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
    <br>
    <button type="submit" class="swal_form_submit_btn_decline_order d-none"></button>
</form><?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/components/decline-order.blade.php ENDPATH**/ ?>