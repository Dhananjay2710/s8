@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.day-and-schedule.partials.days-two')
@else
    @include('frontend.user.seller.day-and-schedule.partials.days-one')
@endif