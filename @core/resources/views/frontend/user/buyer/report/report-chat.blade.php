@if(get_static_option('dashboard_variant_buyer') == '02')
    @include('frontend.user.buyer.report.partials.report-chat-two')
@else
    @include('frontend.user.buyer.report.partials.report-chat-one')
@endif