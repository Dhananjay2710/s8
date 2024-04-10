@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{__('Buyer Dashboard')}}
@endsection
@section('content')
    <x-frontend.seller-buyer-preloader/>
    @php $default_lang = get_default_language(); @endphp
            <!-- Dashboard area Starts -->
    @if(get_static_option('dashboard_variant_buyer') == '02')
        @include('frontend.user.buyer.dashboard.partials.dashboard-two')
    @else
        @include('frontend.user.buyer.dashboard.partials.dashboard-one')
    @endif
    <!-- Dashboard area end -->
@endsection
