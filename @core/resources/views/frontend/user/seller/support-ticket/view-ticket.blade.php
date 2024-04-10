@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.support-ticket.partials.view-ticket-two')
@else
    @include('frontend.user.seller.support-ticket.partials.view-ticket-one')
@endif