@if(get_static_option('dashboard_variant_buyer') == '02')
    @include('frontend.user.buyer.notification.partials.notification-two')
@else
    @include('frontend.user.buyer.notification.partials.notification-one')
@endif