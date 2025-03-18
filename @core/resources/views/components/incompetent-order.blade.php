<a tabindex="0" class="btn btn-danger btn-xs btn-sm mr-1 swal_status_change_incompetent text-white">{{ __('Incompetent') }}</a>
<form method='post' action='{{$url}}' class="d-none">
    <input type='hidden' name='_token' value='{{csrf_token()}}'>
    <br>
    <input type="hidden" name="penalty_reason_id" id="penalty_reason_id">
    <input type="hidden" name="penalty_reason_text" id="penalty_reason_text">
    <button type="submit" class="swal_form_submit_btn_incompetent_order d-none"></button>
</form>