@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.services.partials.services-two')
@else
    @include('frontend.user.seller.services.partials.services-one')
@endif