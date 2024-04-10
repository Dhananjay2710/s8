@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.profile.partials.seller-profile-two')
@else
    @include('frontend.user.seller.profile.partials.seller-profile-one')
@endif