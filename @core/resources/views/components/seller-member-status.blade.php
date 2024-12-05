<span class="dash-icon color-1 dash-edit-icon member_status_button"> <i class="las la-edit"></i> </span>
<form method='post' action='{{$url}}' class="d-none">
    <input type='hidden' name='_token' value='{{csrf_token()}}'>
    <br>
    <button type="submit" class="member_form_submit_btn d-none"></button>
</form>