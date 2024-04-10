@if(get_static_option('dashboard_variant_buyer') == '02')
    @include('frontend.user.buyer.report.partials.report-list-two')
@else
    @include('frontend.user.buyer.report.partials.report-list-one')
@endif