@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.coupons.partials.coupons-two')
@else
    @include('frontend.user.seller.coupons.partials.coupons-one')
@endif