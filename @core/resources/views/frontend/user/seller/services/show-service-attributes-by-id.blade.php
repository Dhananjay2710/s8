@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.services.partials.show-service-attributes-by-id-two')
@else
    @include('frontend.user.seller.services.partials.show-service-attributes-by-id-one')
@endif