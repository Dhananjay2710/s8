@if(get_static_option('dashboard_variant_buyer') == '02')
    @include('frontend.user.buyer.order.partials.order-details-two')
@else
    @include('frontend.user.buyer.order.partials.order-details-one')
@endif