@extends('backend.admin-master')
@section('site-title')
    {{__('Service Request Details')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        @if(!empty($order_details))
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">   
                                    <div class="checkbox-inlines">
                                        <label><strong>{{ __('Service Request ID:') }} </strong>#{{ $order_details->id }}</label>
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <button type="button" class="btn btn-info" onclick="goBack()">Go Back</button>
                                </div>
                                <!--Code for Signing of file for admin side-->
                                <!--
                                <div class="col-md-2">
                                    <div class="checkbox-inlines">
                                        <div id="timerDisplay"></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-inlines">
                                        <div>Signing Status</div>
                                        <centre><div id="fileStatusOfAdmin"></div></centre>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="checkbox-inlines">
                                        <button id="signDocumentBtnOfAdmin" type="button" class="btn btn-info" data-order_admin_file_link={{ $order_details->admin_file_link }}>
                                            {{ __('Approved by Signing') }}
                                        </button>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Service Provider Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Name:') }} </strong>{{ optional($order_details->seller)->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Email:') }} </strong>{{ optional($order_details->seller)->email }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Phone:') }} </strong>{{ optional($order_details->seller)->phone }}</label>
                                </div>
                                @if($order_details->is_order_online !=1)
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Address:') }} </strong>{{ optional($order_details->seller)->address }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }} </strong>{{ optional(optional($order_details->seller)->city)->service_city }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }} </strong>{{ optional(optional($order_details->seller)->area)->service_area }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Post Code:') }} </strong>{{ optional($order_details->seller)->post_code }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }} </strong>{{ optional(optional($order_details->seller)->country)->country }}</label>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>   
                </div>
                @if($order_details->order_from_job != 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5>{{ __('Service Details') }}</h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong>{{ __('Title:') }} </strong>{{ optional($order_details->service)->title }}</label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        {!! render_image_markup_by_attachment_id(optional($order_details->service)->image,'','thumb') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif

                @if($order_details->order_from_job == 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">

                                <div class="border-bottom mb-3">
                                    <h5>{{ __('Job Details') }}</h5>
                                </div>
                                <div class="single-checbox">
                                    <div class="checkbox-inlines">
                                        <label><strong>{{ __('Title:') }} </strong>{{ optional($order_details->job)->title }}</label>
                                    </div>
                                    <br>
                                    <div class="checkbox-inlines">
                                        {!! render_image_markup_by_attachment_id(optional($order_details->job)->image,'','thumb') !!}
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                @endif
            </div>


            <div class="row">
                <div class="col-lg-5 mt-5">
                    <div class="card">
                        <div class="card-body">

                            <div class="border-bottom mb-3">
                                <h5>{{ __('Customer Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Name:') }} </strong>{{ $order_details->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Email:') }} </strong>{{ $order_details->email }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Phone:') }} </strong>{{ $order_details->phone }}</label>
                                </div>
                                @if($order_details->is_order_online !=1)
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Address:') }} </strong>{{ $order_details->address }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }} </strong>{{ optional($order_details->service_city)->service_city }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }} </strong>{{ optional($order_details->service_area)->service_area }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Post Code:') }} </strong>{{ $order_details->post_code }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }} </strong>{{ optional($order_details->service_country)->country }}</label>
                                </div>
                               @endif
                            </div>

                            @if($order_details->is_order_online !=1)
                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Date & Schedule') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Date:') }} </strong>{{ $order_details->date }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Schedule:') }} </strong>{{ $order_details->schedule }}</label>
                                </div>
                            </div>
                            @endif

                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Amount Details') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Package Fee:') }} </strong>{{ float_amount_with_currency_symbol($order_details->package_fee) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Extra Service:') }} </strong>{{ float_amount_with_currency_symbol($order_details->extra_service) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Sub Total:') }} </strong>{{ float_amount_with_currency_symbol($order_details->sub_total) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Tax:') }} </strong>{{ float_amount_with_currency_symbol($order_details->tax) }}</label>
                                </div>
                                @if(!empty($order_details->coupon_amount))
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Coupon Amount:') }} </strong>{{ float_amount_with_currency_symbol($order_details->coupon_amount) }}</label>
                                </div>
                                @endif
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Total:') }} </strong>{{ float_amount_with_currency_symbol($order_details->total) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Admin Commission:') }} </strong>{{ float_amount_with_currency_symbol($order_details->commission_amount) }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Payment Method:') }} </strong><b class="text-success">{{ ucwords(str_replace("_", " ", $order_details->payment_gateway)) }}</b></label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Payment Status:') }} </strong>{{ ucfirst($order_details->payment_status) }}</label>
                                    <span>
                                        @if($order_details->payment_status=='pending') 
                                        <span><x-status-change :url="route('admin.order.change.status',$order_details->id)"/></span>
                                        @endif
                                    </span>
                                </div>
                                @if($order_details->payment_gateway=='manual_payment')
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Manual Payment Attachment:') }} </strong></label>
                                    <img src="{{ asset('assets/uploads/manual-payment/'.$order_details->manual_payment_image) }}" alt="">
                                </div>
                                @endif
                            </div>

                            <div class="border-bottom mb-3 mt-4">
                                <h5>{{ __('Service Request Status') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Service Request Status: ') }}</strong>
                                        @if ($order_details->status == 0) <span>{{ __('Pending') }}</span>@endif
                                        @if ($order_details->status == 1) <span>{{ __('Active') }}</span>@endif
                                        @if ($order_details->status == 2) <span>{{ __('Completed') }}</span>@endif
                                        @if ($order_details->status == 3) <span>{{ __('Delivered') }}</span>@endif
                                        @if ($order_details->status == 4) <span>{{ __('Cancelled') }}</span>@endif
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>   
                </div>
                @if($order_details->order_from_job != 'yes')
                    <div class="col-lg-7 mt-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="border-bottom mb-3 mt-4">
                                    <h5>{{ __('Include Details')}}</h5> <br>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            @if($order_details->is_order_online !=1)
                                            <th>{{ __('Unit Price') }}</th>
                                            <th>{{ __('Quantity') }}</th>
                                            <th>{{ __('Total') }}</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $package_fee =0; @endphp
                                        @foreach($order_includes as $include)
                                        <tr>
                                            <td>{{ $include->title }}</td>
                                            @if($order_details->is_order_online !=1)
                                            <td>{{ float_amount_with_currency_symbol($include->price) }}</td>
                                            <td>{{ $include->quantity }}</td>
                                            <td>{{ float_amount_with_currency_symbol($include->price * $include->quantity) }}</td>
                                            @php $package_fee += $include->price * $include->quantity @endphp
                                            @endif
                                        </tr>
                                        @endforeach
                                        <tr>
                                            @if($order_details->is_order_online !=1)
                                                <td colspan="3"><strong>{{ __('Package Fee') }}</strong></td>
                                                <td><strong>{{ float_amount_with_currency_symbol($package_fee) }}</strong></td>
                                            @else
                                                <td colspan="3"><strong>{{ __('Package Fee ') .float_amount_with_currency_symbol($order_details->package_fee)}}</strong></td>
                                            @endif

                                        </tr>
                                    </tbody>
                                </table>

                                @if($order_additionals->count() >= 1)
                                <h5>{{ __('Additional Services:')}}</h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Unit Price') }}</th>
                                            <th>{{ __('Quantity') }}</th>
                                            <th>{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $extra_service =0; @endphp
                                        @foreach($order_additionals as $additional)
                                        <tr>
                                            <td>{{ $additional->title }}</td>
                                            <td>{{ float_amount_with_currency_symbol($additional->price) }}</td>
                                            <td>{{ $additional->quantity }}</td>
                                            <td>{{ float_amount_with_currency_symbol($additional->price * $additional->quantity) }}</td>
                                            @php $extra_service += $additional->price * $additional->quantity @endphp
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="3"><strong>{{ __('Extra Service') }}</strong></td>
                                            <td><strong>{{ float_amount_with_currency_symbol($extra_service) }}</strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif


                                @if(optional($order_details->extraSevices)->count() >= 1)
                                    <div class="single-flex-middle">
                                        <div class="single-flex-middle-inner">
                                            <div class="line-charts-wrapper oreder_details_rtl margin-top-40">
                                                <div class="line-top-contents">
                                                    <h5 class="earning-title">{{ __('Extra Service Details') }}</h5>
                                                </div>
                                                <span class="info-text d-block mb-4">{{__('This is not included in the main service service request calculation')}}</span>

                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>{{ __('Title') }}</th>
                                                        <th>{{ __('Unit Price') }}</th>
                                                        <th>{{ __('Quantity') }}</th>
                                                        <th>{{ __('Amount') }}</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($order_details->extraSevices as $ex_service)
                                                        <tr>
                                                            <td>{{ $ex_service->title }}</td>
                                                            <td>{{ float_amount_with_currency_symbol($ex_service->price) }}</td>
                                                            <td>{{ $ex_service->quantity }}</td>
                                                            <td>{{ float_amount_with_currency_symbol($ex_service->price * $ex_service->quantity) }}</td>

                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if(!empty($order_details->coupon_code))
                                <h5>{{ __('Coupon Details:')}}</h5> <br>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Coupon Code') }}</th>
                                            <th>{{ __('Coupon Type') }}</th>
                                            <th>{{ __('Coupon Amount') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $order_details->coupon_code }}</td>
                                            <td>{{ $order_details->coupon_type }}</td>
                                            <td>
                                                @if(!empty($order_details->coupon_amount))
                                                {{ float_amount_with_currency_symbol($order_details->coupon_amount) }}
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                @endif

                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <br>
            <div class="row">
                <div class="col-lg-12 mt-12">
                    <div class="card">
                        <div class="card-body">
                            @if(!empty($order_declines_history->count() >= 1))
                                <div class="border-bottom mb-3 mt-4">
                                    <h5>{{ __('Service Request Images') }}</h5>
                                </div>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            {{-- <th>{{ __('History ID') }}</th> --}}
                                            {{-- <th>{{ __('Service Provider Details') }}</th> --}}
                                            {{-- <th>{{ __('Status') }} ({{ __('Decline Reason') }})</th> --}}
                                            <th>{{ __('Image Files') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($order_declines_history as $history)
                                            <tr>
                                                {{-- <td>{{ $history->id }}</td>
                                                <td>
                                                    <strong>{{ __('Name: ') }}</strong> {{ optional($history->seller)->name }}
                                                    <br>
                                                    <strong>{{ __('Email: ') }}</strong>{{ optional($history->seller)->email }}
                                                    <br>
                                                    <strong>{{ __('Phone: ') }}</strong>{{ optional($history->seller)->phone }}
                                                    <br>
                                                </td>
                                                <td>
                                                    <strong>{{ __('Decline Reason: ') }}</strong>{{ $history->decline_reason }}
                                                    </td> 
                                                <td>{!! render_image_markup_by_attachment_id($history->image,'','thumb') !!}</td> --}}
                                                <td>
                                                    @php
                                                        $imageIds = explode('|', $history->image); // Split the string by '|'
                                                    @endphp
                                                    @foreach($imageIds as $imageId)
                                                        {!! render_image_markup_by_attachment_id($imageId, '', 'thumb') !!}
                                                    @endforeach
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>   
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
 <x-datatable.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){

                $(document).on('click','.swal_status_change',function(e){
                e.preventDefault();
                    Swal.fire({
                    title: '{{__("Are you sure to change status?")}}',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).next().find('.swal_form_submit_btn').trigger('click');
                    }
                    });
                });
                
              });
        })(jQuery);

        var orderDetails = @json($order_details);
        console.log("Order Details : ", orderDetails.id);
        var admin_file_link = orderDetails.admin_file_link;
        var admin_file_status = orderDetails.admin_signing_status;
        var order_id = orderDetails.id;
       
        var fileStatusOfAdmin = document.getElementById('fileStatusOfAdmin');
        fileStatusOfAdmin.textContent = admin_file_status;
        setFileStatusColor(admin_file_status);
        var timerDisplay = document.getElementById('timerDisplay');
        timerDisplay.textContent = '';
        // for reviewModal model after click on yes
        document.getElementById('signDocumentBtnOfAdmin').addEventListener('click', function() {
            console.log('admin_file_link : ', admin_file_link);
            if (admin_file_link) {
                const width = 1000;
                const height = 800;
                const left = (screen.width / 2) - (width / 2);
                const top = (screen.height / 2) - (height / 2);
                var signWindow = window.open(admin_file_link, 'signDocumentForAdmin', `width=${width},height=${height},top=${top},left=${left},resizable=yes,scrollbars=yes`);
                // Set the timer duration (in seconds)
                let timerDuration = 180;

                // Update the timer every second
                const countdownTimer = setInterval(function () {
                    if (timerDuration > 0) {
                        timerDuration--;
                        const minutes = Math.floor(timerDuration / 60);
                        const seconds = timerDuration % 60;
                        timerDisplay.textContent = `Time left: ${minutes}:${seconds.toString().padStart(2, '0')}`;
                    } else {
                        clearInterval(countdownTimer);
                    }
                }, 1000);

                // Close the window after 3 minutes (180000 milliseconds)
                const autoCloseTimer = setTimeout(function () {
                    signWindow.close();
                }, 180000);

                // Check if the window is closed manually
                const checkWindowClosed = setInterval(function () {
                    if (signWindow.closed) {
                        clearInterval(checkWindowClosed);
                        clearInterval(countdownTimer);
                        clearTimeout(autoCloseTimer);
                        timerDisplay.textContent = "Signing window has closed.";
                        fetchUpdatedData();
                    }
                }, 500);
            } else {
                alert('No document link is available.');
            }
        });

        // fetch updated data using xhr call
        function fetchUpdatedData() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', `/providers/serviceprovider/ordersdetailsupdateapi/${order_id}`, true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        console.log("XHR Success");
                        const response = JSON.parse(xhr.responseText);
                        const updatedAdminFileSigningStatus = response.admin_signing_status;
                        console.log("Updated Status", updatedAdminFileSigningStatus);
                        const adminFileLink = response.admin_file_link;
                        updateDOM(updatedAdminFileSigningStatus, adminFileLink);
                    } else {
                        console.error('Failed to fetch updated data. Status:', xhr.status);
                    }
                }
            };
            xhr.send();
        }

        // update DOM
        function updateDOM(status, link) {
            fileStatusOfAdmin.textContent = status;
            setFileStatusColor(status);
            const signDocumentBtnOfAdmin = document.querySelector('#signDocumentBtnOfAdmin');
            signDocumentBtnOfAdmin.setAttribute('data-order_customer_file_link', link);
            signDocumentBtnOfAdmin.disabled = !link || status === 'Signed';
            timerDisplay.textContent = '';
        }

        // set file status color
        function setFileStatusColor(status) {
            if (status === 'Pending') {
                fileStatusOfAdmin.style.color = 'red';
            } else if (status === 'Signed') {
                fileStatusOfAdmin.style.color = 'green';
            } else {
                fileStatusOfAdmin.style.color = 'black'; 
            }
        }
    </script>
    <script>
        function goBack() {
          window.history.back();
        }
    </script>
@endsection

