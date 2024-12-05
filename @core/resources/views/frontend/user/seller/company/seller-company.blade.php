@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.company.partials.seller-company-two')
@else
    @include('frontend.user.seller.company.partials.seller-company-one')
@endif