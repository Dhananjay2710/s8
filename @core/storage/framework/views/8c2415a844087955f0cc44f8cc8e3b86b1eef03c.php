<a href="javascript:void(0)" class="icon delete swal_delete_button"><i class="fa-regular fa-trash-can"></i></a>
<form method='post' action='<?php echo e($url); ?>' class="d-none">
 <input type='hidden' name='_token' value='<?php echo e(csrf_token()); ?>'>
 <br>
 <button type="submit" class="swal_form_submit_btn d-none"></button>
</form>

<?php /**PATH C:\xampp\htdocs\s8\@core\resources\views/components/ticket-delete-popup.blade.php ENDPATH**/ ?>