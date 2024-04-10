@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.order.partials.pending-orders-two')
@else
    @include('frontend.user.seller.order.partials.pending-orders-one')
@endif