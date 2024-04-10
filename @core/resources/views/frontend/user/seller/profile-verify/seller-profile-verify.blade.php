@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.profile-verify.partials.seller-profile-verify-two')
@else
    @include('frontend.user.seller.profile-verify.partials.seller-profile-verify-one')
@endif