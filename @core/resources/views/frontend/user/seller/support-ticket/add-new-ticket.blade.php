@if(get_static_option('dashboard_variant_seller') == '02')
    @include('frontend.user.seller.support-ticket.partials.add-new-ticket-two')
@else
    @include('frontend.user.seller.support-ticket.partials.add-new-ticket-one')
@endif