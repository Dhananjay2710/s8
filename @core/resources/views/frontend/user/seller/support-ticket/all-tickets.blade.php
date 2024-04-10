@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.support-ticket.partials.tickets-two')
@else
    @include('frontend.user.seller.support-ticket.partials.tickets-one')
@endif