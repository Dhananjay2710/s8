@extends('frontend.user.seller.seller-master')
@section('site-title')
    {{__('Service Provider Dashboard')}}
@endsection
@section('content')
    <x-frontend.seller-buyer-preloader/>
    <!-- Dashboard area Starts -->
    <div class="body-overlay"></div>
    <div class="dashboard-area dashboard-padding">
        <div class="container-fluid">
            <div class="dashboard-contents-wrapper">
                <div class="dashboard-icon">
                    <div class="sidebar-icon">
                        <i class="las la-bars"></i>
                    </div>
                </div>
                @include('frontend.user.seller.partials.sidebar')
                <div class="dashboard-right">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="dashboard-flex-title">
                                <div class="dashboard-settings margin-top-40">
                                    <h2 class="dashboards-title">{{ __('Dashboard') }}</h2>
                                </div>
                                @if(Auth()->user()->unreadNotifications()->count() > 0)
                                    <div class="info-bar-item">
                                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->user_type==0)
                                            <div class="notification-icon icon">
                                                @if(Auth::guard('web')->check())
                                                    <span class="bell-icon"> {{__("Notifications")}} <i class="las la-bell"></i> </span>
                                                    <span class="notification-number">
                                                          @php $order_count =Auth()->user()->unreadNotifications()->count(); @endphp
                                                        {{ $order_count }}
                                                        </span>
                                                @endif
                                                <div class="notification-list-item mt-2">
                                                    <h5 class="notification-title">{{ __('Notifications') }}</h5>
                                                    <div class="list">
                                                        @if(Auth::guard('web')->check() && Auth::guard('web')->user()->unreadNotifications->count() >0)
                                                            <span>
                                                                @foreach(Auth::guard('web')->user()->unreadNotifications->take(10) as $notification)
                                                                    @if(isset($notification->data['seller_last_ticket_id']))
                                                                        <a class="list-order" href="{{ route('seller.support.ticket.view',$notification->data['seller_last_ticket_id']) }}">
                                                                          <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                                          {{ $notification->data['order_ticcket_message']  }} #{{ $notification->data['seller_last_ticket_id'] }}
                                                                       </a>
                                                                    @endif
                                                                @endforeach

                                                                @foreach(Auth::user()->unreadNotifications->take(5) as $notification)
                                                                    @if(isset($notification->data['order_id']))
                                                                        <a class="list-order" href="{{ route('seller.order.details',$notification->data['order_id']) }}">
                                                                                <span class="order-icon"> <i class="las la-check-circle"></i> </span>
                                                                                {{ $notification->data['order_message'] }} #{{ $notification->data['order_id'] }}
                                                                            </a>
                                                                    @endif
                                                                @endforeach
                                                            </span>
                                                        @else
                                                            <p class="text-center padding-3" style="color:#111;">{{ __('No New Notification') }}</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @if(moduleExists('Subscription') && $commissionGlobal->system_type == 'subscription' )
                            @if(empty(auth('web')->user()->subscribedSeller))
                                <div class="col-lg-12 mt-1">
                                    <div class="alert alert-warning d-flex justify-content-between">
                                        <strong style="font-size: 16px">{{__('you must have to subscribe any of our package in service request to start selling your services.')}}</strong>
                                        <a href="{{getSlugFromReadingSetting('price_plan_page') ? url('/'.getSlugFromReadingSetting('price_plan_page')) : url('/price-plan')}}" target="_self" class="btn btn-secondary">{{__('view packages')}}</a>
                                    </div>
                                </div>
                            @else
                                {{-- first check this seller subscribed then expire or subscribed expire info message show --}}
                                @if(!empty(Auth::guard('web')->user()->subscribedSeller))
                                    @if(Carbon\Carbon::parse(auth('web')->user()->subscribedSeller->expire_date)->gt(Carbon\Carbon::today()))
                                        <div class="col-lg-12 mt-1">
                                        <div class="alert alert-warning d-flex justify-content-between">
                                            <strong>{{__('your package has been expired, please renew it')}}</strong>
                                            <a href="{{getSlugFromReadingSetting('price_plan_page') ? url('/'.getSlugFromReadingSetting('price_plan_page')) : url('/price-plan')}}" target="_self" class="btn btn-secondary">{{__('view packages')}}</a>
                                        </div>
                                        </div>
                                    @else
                                        <div class="col-lg-12 mt-1">
                                            <div class="alert alert-info d-flex justify-content-between">
                                                <p>{{__('Your Subscribed Package:')}} <strong class="text-success">
                                                        {{auth('web')->user()?->subscribedSeller?->subscription?->title}}</strong> {{__('Expire Date:')}}
                                                    <strong class="text-danger">{{auth('web')->user()?->subscribedSeller->expire_date->format('d M Y')}}</strong>
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                @endif

                            @endif
                        @endif

                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{asset('assets/frontend/img/static/orders-shapes.png')}}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-tasks"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles"> {{ $pending_order }} </h2>
                                        <span class="order-para">{{ __('Pending Service Request') }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{asset('assets/frontend/img/static/orders-shapes2.png')}}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-handshake"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles"> {{ $complete_order }} </h2>
                                        <span class="order-para"> {{ __('Service Request Completed ') }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{asset('assets/frontend/img/static/orders-shapes3.png')}}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-dollar-sign"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles"> {{ float_amount_with_currency_symbol($total_earnings) }} </h2>
                                        <span class="order-para">{{ __('Total Withdraw') }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 margin-top-30 orders-child">
                            <div class="single-orders">
                                <div class="orders-shapes">
                                    <img src="{{asset('assets/frontend/img/static/orders-shapes4.png')}}" alt="">
                                </div>
                                <div class="orders-flex-content">
                                    <div class="icon">
                                        <i class="las la-file-invoice-dollar"></i>
                                    </div>
                                    <div class="contents">
                                        <h2 class="order-titles">{{ float_amount_with_currency_symbol($remaning_balance - $total_earnings) }} </h2>
                                        <span class="order-para"> {{ __('Remaining Balance') }} </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-middle-flex">
                        <div class="single-flex-middle margin-top-40">
                            <div class="line-charts-wrapper">
                                <div class="line-top-contents">
                                    <h5 class="earning-title">{{ __('Total Service Request Overview') }}</h5>
                                </div>
                                <div class="line-charts">
                                    <canvas id="line-chart"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="single-flex-middle">
                            <div class="single-flex-middle-inner">
                                <div class="line-charts-wrapper margin-top-40">
                                    <div class="line-top-contents">
                                        <h5 class="earning-title">{{ __('To Do List') }}</h5>
                                        <div class="line-chart-select style-02">
                                            <a href="{{ route('seller.todolist') }}"><span class="text-success btn">{{ __('See All') }}</span></a>
                                        </div>
                                    </div>
                                    @foreach($to_do_list as $todo)
                                        <div class="single-checbox">
                                            <div class="checkbox-inlines">
                                                <x-seller-coupon-status :url="route('seller.todolist.status',$todo->id)"/>
                                                <label class="checkbox-label">{{ $todo->description }} </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="line-charts-wrapper margin-top-40">
                                    <div class="line-top-contents">
                                        <h5 class="earning-title">{{ __('This Month Summery') }} </h5>
                                    </div>
                                    <div class="chart-summery-inner">
                                        <div class="single-chart-summery">
                                            <div class="icon">
                                                <i class="las la-tasks"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title">{{ $this_month_order_count }} </h4>
                                                <span class="title-para">{{ __('Service Request') }} </span>
                                            </div>
                                        </div>
                                        <div class="single-chart-summery">
                                            <div class="icon">
                                                <i class="las la-dollar-sign"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title"> {{ float_amount_with_currency_symbol($this_month_earnings) }} </h4>
                                                <span class="title-para">{{ __('Earning') }} </span>
                                            </div>
                                        </div>
                                        <div class="single-chart-summery">
                                            <div class="icon">
                                                <i class="las la-file-invoice-dollar"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title"> {{ float_amount_with_currency_symbol($this_month_balance_without_tax_and_admin_commission) }} </h4>
                                                <span class="title-para"> {{ __('Balance') }} </span>
                                            </div>
                                        </div>
                                        <div class="single-chart-summery">
                                            <div class="icon">
                                                <i class="las la-male"></i>
                                            </div>
                                            <div class="contents">
                                                <h4 class="title"> {{ $buyer_count }} </h4>
                                                <span class="title-para">{{ __('Total Customer') }} </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="dashboard-middle-flex style-02">
                        @if($last_five_order->count() >= 1)
                            <div class="single-flex-middle margin-top-40">
                                <div class="line-charts-wrapper">
                                    <div class="table-responsive table-responsive--md">
                                        <table class="custom--table">
                                            <thead>
                                            <tr>
                                                <th> {{ __('Client Name') }} </th>
                                                <th>{{ __('Status') }}</th>
                                                <th> {{ __('Email') }} </th>
                                                <th>{{ __('Price') }} </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($last_five_order as $order)
                                                <tr>
                                                    <td data-label="{{__('Client Name')}}">{{ $order->name }} </td>
                                                    @if ($order->status == 0) <td data-label="{{__('Status')}}" class="pending"><span>{{ __('Pending') }}</span></td>@endif
                                                    @if ($order->status == 1) <td data-label="{{__('Status')}}" class="order-active"><span>{{ __('Active') }}</span></td>@endif
                                                    @if ($order->status == 2) <td data-label="{{__('Status')}}" class="completed"><span>{{ __('Completed') }}</span></td>@endif
                                                    @if ($order->status == 3) <td data-label="{{__('Status')}}" class="order-deliver"><span>{{ __('Delivered') }}</span></td>@endif
                                                    @if ($order->status == 4) <td data-label="{{__('Status')}}" class="canceled"><span>{{ __('Cancelled') }}</span></td>@endif
                                                    <td data-label="{{__('Email')}}">{{ $order->email }}</td>
                                                    <td data-label="{{__('Price')}}"> {{ float_amount_with_currency_symbol($order->total) }} </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="single-flex-middle margin-top-40">
                            <div class="line-charts-wrapper">
                                <div class="line-top-contents">
                                    <h5 class="earning-title">{{ __('Weekly Work Summary') }} </h5>
                                </div>
                                <div class="group-bar-charts">
                                    <canvas id="bar-chart-grouped"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->
@endsection
@section('scripts')
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script>
        "use strict";
        $(document).ready(function () {

            $(document).on('click','.swal_status_button',function(e){
                e.preventDefault();
                Swal.fire({
                    title: '{{__("Are you sure to change status?")}}',
                    text: '{{__("You will change it anytime!")}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: "{{__('Yes, change it!')}}"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                });
            });

            /* Line Charts */
            new Chart(document.getElementById("line-chart"), {
                type: 'line',
                data: {
                    labels: [@foreach($month_list as $list) "{{ $list }}", @endforeach],
                    datasets: [{
                        data: [@foreach($monthly_order_list as $list) "{{ $list }}", @endforeach],
                        label: "{{__('Order')}}",
                        borderColor: "#1DBF73",
                        borderWidth: 3,
                        fill: false,
                        pointBorderWidth: 2,
                        pointBackgroundColor: '#fff',
                        pointRadius: 5,
                        pointHoverRadius: 5,
                        pointHoverBackgroundColor: "#1DBF73",
                    }]
                },

            });


            /* Group Bar Charts */
            new Chart(document.getElementById("bar-chart-grouped"), {
                type: 'bar',
                data: {
                    labels: [@foreach($days_list as $list) "{{ $list }}", @endforeach],
                    datasets: [
                        {
                            label: "{{__('Pending')}}",
                            backgroundColor: "#2F98DC",
                            data: [@foreach($pending_order_list as $list) "{{ $list }}", @endforeach],
                            barThickness: 10,
                            hoverBackgroundColor: '#fff',
                            hoverBorderColor: '#2F98DC',
                            borderColor: '#fff',
                            borderWidth: 2,
                        },
                        {
                            label: "{{__('Active')}}",
                            backgroundColor: "#FFB307",
                            data: [@foreach($active_order_list as $list) "{{ $list }}", @endforeach],
                            barThickness: 10,
                            hoverBackgroundColor: '#fff',
                            hoverBorderColor: '#FFB307',
                            borderColor: '#fff',
                            borderWidth: 2,
                        },
                        {
                            label: "{{__('Complete')}}",
                            backgroundColor: "#6560FF",
                            data: [@foreach($complete_order_list as $list) "{{ $list }}", @endforeach],
                            barThickness: 10,
                            hoverBackgroundColor: '#fff',
                            hoverBorderColor: '#6560FF',
                            borderColor: '#fff',
                            borderWidth: 2,
                        }
                    ],
                },
            });

        });
    </script>
@endsection
