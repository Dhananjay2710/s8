@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.services.partials.edit-service-two')
@else
    @include('frontend.user.seller.services.partials.edit-service-one')
@endif