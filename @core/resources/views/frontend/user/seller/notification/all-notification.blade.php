@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.notification.partials.notification-two')
@else
    @include('frontend.user.seller.notification.partials.notification-one')
@endif