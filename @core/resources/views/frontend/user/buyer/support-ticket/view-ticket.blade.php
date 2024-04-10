@if(get_static_option('dashboard_variant_buyer') == '02')
    @include('frontend.user.buyer.support-ticket.partials.view-ticket-two')
@else
    @include('frontend.user.buyer.support-ticket.partials.view-ticket-one')
@endif