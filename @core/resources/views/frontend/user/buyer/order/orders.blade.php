@if(get_static_option('dashboard_variant_buyer') == '02')
    @include('frontend.user.buyer.order.partials.service-orders-two')
@else
    @include('frontend.user.buyer.order.partials.service-orders-one')
@endif