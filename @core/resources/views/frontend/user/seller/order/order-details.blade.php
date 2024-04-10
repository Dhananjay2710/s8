@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.order.partials.order-details-two')
@else
    @include('frontend.user.seller.order.partials.order-details-one')
@endif