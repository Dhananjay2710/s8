@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.report.partials.report-list-two')
@else
    @include('frontend.user.seller.report.partials.report-list-one')
@endif