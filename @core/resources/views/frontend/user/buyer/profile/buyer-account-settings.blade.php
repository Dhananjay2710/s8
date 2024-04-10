@if(get_static_option('dashboard_variant_buyer') == '02')
    @include('frontend.user.buyer.profile.partials.account-settings-two')
@else
    @include('frontend.user.buyer.profile.partials.account-settings-one')
@endif