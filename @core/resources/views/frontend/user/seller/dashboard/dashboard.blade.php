@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Seller Dashboard')}}
@endsection
@section('content')
    <x-frontend.seller-buyer-preloader/>
    @php $default_lang = get_default_language(); @endphp
            <!-- Dashboard area Starts -->
    @if(get_static_option('dashboard_variant_seller') == '02')
        @include('frontend.user.seller.dashboard.partials.dashboard-two')
    @else
        @include('frontend.user.seller.dashboard.partials.dashboard-one')
    @endif
    <!-- Dashboard area end -->
@endsection
