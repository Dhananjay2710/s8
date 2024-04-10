@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.payout.partials.payout-request-details-two')
@else
    @include('frontend.user.seller.payout.partials.payout-request-details-one')
@endif