@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.to-do-list.partials.todolist-two')
@else
    @include('frontend.user.seller.to-do-list.partials.todolist-one')
@endif