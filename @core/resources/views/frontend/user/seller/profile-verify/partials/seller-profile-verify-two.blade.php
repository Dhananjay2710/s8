@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{__('Service Provider Profile Verify')}}
@endsection
@section('style')
    <style>
        .single-dashboard-input .attachment-preview {
            width: 500px;
            height: 500px;
        }
        .notice-board {
            display: block;
            background-color: #fff;
            box-shadow: 0 0 20px #f2f2f2;
            border-left: 5px solid #dc3545;
            padding: 10px;
            border-radius: 10px;
            margin-top: 30px;
        }
    </style>
    <x-media.css/>
@endsection
@section('content')
    <x-frontend.seller-buyer-preloader/>
    @include('frontend.user.seller.partials.sidebar-two')
    <div class="dashboard__right">
        @include('frontend.user.buyer.header.buyer-header')
        <div class="dashboard__body">

            <div class="dashboard__inner mt-3">
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <div class="row">
                        <div class="col-lg-12 margin-top-40">
                            <div class="edit-profile">
                                <div class="profile-info-dashboard mt-3">
                                    <h4 class="dashboards-title"> {{__('Profile Verify')}} </h4>
                                    @if(!is_null($seller_verify_info) && !is_null($seller_verification_data) && $seller_verify_info->status === 1)
                                            <div class="alert alert-success mt-3 mx-2" style="width: 170px">  <i class="las la-check-circle mx-2" style="font-size: 25px"></i>{{__('Profile Verified')}}
                                            </div>
                                    @else

                                        <div class="notice-board mt-3">
                                            <p class="text-danger">{{ __('Submit your original documents so that the admin can verify you. Once verified a badge will show in your profile that increase your service request possibility') }}</p>
                                        </div>

                                        <div class="dashboard-profile-flex">
                                            <div class="dashboard-address-details">

                                                <div class="mt-5"> <x-msg.error/> </div>

                                                <form action="{{route('seller.profile.verify')}}" method="post">
                                                    @csrf
                                                    <div class="single-dashboard-input">
                                                        <div class="row">
                                                            <div class="col-xxl-6 col-lg-6">
                                                                <div class="single-info-input margin-top-30">
                                                                    <div class="form-group">
                                                                        <div class="media-upload-btn-wrapper">
                                                                            <div class="img-wrap">
                                                                                {!! render_image_markup_by_attachment_id(optional($seller_verify_info)->national_id ?? '','','large') !!}
                                                                            </div>
                                                                            <input type="hidden" id="national_id" name="national_id"
                                                                                    value="{{optional($seller_verify_info)->national_id ?? ''}}">
                                                                            <button type="button" class="btn btn-primary media_upload_form_btn"
                                                                                     data-btntitle="{{__('Select Image')}}"
                                                                                     data-modaltitle="{{__('Upload Image')}}" data-bs-toggle="modal"
                                                                                     data-bs-target="#media_upload_modal">
                                                                                 {{__('Upload Your National ID')}}
                                                                            </button>
                                                                        </div>
                                                                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                                                        <br>
                                                                        <small class="text-danger">{{ __('recommended size 740x504') }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-6 col-lg-6">
                                                                <div class="single-info-input margin-top-30">
                                                                    <div class="form-group">
                                                                        <div class="media-upload-btn-wrapper">
                                                                            <div class="img-wrap">
                                                                                 {!! render_image_markup_by_attachment_id(optional($seller_verify_info)->address ?? '','','large') !!}
                                                                            </div>
                                                                            <input type="hidden" id="address" name="address"
                                                                                    value="{{optional($seller_verify_info)->address ?? ''}}">
                                                                            <button type="button" class="btn btn-primary media_upload_form_btn"
                                                                                     data-btntitle="{{__('Select Image')}}"
                                                                                     data-modaltitle="{{__('Upload Image')}}" data-bs-toggle="modal"
                                                                                     data-bs-target="#media_upload_modal">
                                                                                 {{__('Upload Your Address Document')}}
                                                                            </button>
                                                                        </div>
                                                                        <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                                                        <br>
                                                                        <small class="text-danger">{{ __('recommended size 740x504') }}</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-6 col-lg-6">
                                                                <div class="row">
                                                                    <div class="col-xxl-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Aadhaar Number') }}</label>
                                                                            <input class="form-control numeric-value" type="text" id="aadhaar_number" name="aadhaar_number" placeholder="{{__('Enter Aadhaar Number')}}" 
                                                                                value="{{ $seller_verification_data['aadhaar_number'] ?? '' }}"
                                                                                {{ $seller_verification_data['is_aadhaar_verified'] == 1 ? 'readonly' : '' }}
                                                                            >
                                                                        </div>
                                                                        <br>
                                                                        <div class="form-group">
                                                                            <button id="verify_aadhaar_button" type="button" 
                                                                                class="btn {{ $seller_verification_data['is_aadhaar_verified'] == 1 ? 'btn-success' : 'btn-primary' }}" 
                                                                                {{ $seller_verification_data['is_aadhaar_verified'] == 1 ? 'disabled' : '' }}
                                                                            >{{__('Verify Aadhaar Number')}}</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('PAN Number') }}</label>
                                                                            <input class="form-control" type="text" id="pan_number" name="pan_number" placeholder="{{__('Enter PAN Number')}}" 
                                                                                value="{{ $seller_verification_data['pan_number'] ?? "" }}"
                                                                                {{ $seller_verification_data['is_pan_verified'] == 1 ? 'readonly' : '' }}
                                                                            >
                                                                        </div>
                                                                        <br>
                                                                        <div class="form-group"> 
                                                                            <button id="verify_pan_button" type="button" 
                                                                                class="btn {{ $seller_verification_data['is_pan_verified'] == 1 ? 'btn-success' : 'btn-primary' }}"
                                                                                {{ $seller_verification_data['is_pan_verified'] == 1 ? 'disabled' : '' }}
                                                                            >{{ __('Verify PAN Number') }}
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xxl-6 col-lg-6">
                                                                <div class="row">
                                                                    <div class="col-xxl-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Account Number') }}</label>
                                                                            <input class="form-control" type="text" id="account_number" name="account_number" placeholder="{{__('Enter Account Number')}}" 
                                                                                value="{{ $seller_verification_data['account_number'] ?? "" }}"
                                                                                {{ $seller_verification_data['is_account_verified'] == 1 ? 'readonly' : '' }}
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('IFSC Code') }}</label>
                                                                            <input class="form-control" type="text" id="ifsc_number" name="ifsc_number" placeholder="{{__('Enter IFSC Number')}}" 
                                                                                value="{{$seller_verification_data['ifsc_number'] ?? "" }}"
                                                                                {{ $seller_verification_data['is_account_verified'] == 1 ? 'readonly' : '' }}
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Mobile Number') }}</label>
                                                                            <input class="form-control" type="text" id="mobile_number" name="mobile_number" placeholder="{{__('Enter Mobile Number')}}" 
                                                                                value="{{$seller_verification_data['mobile_number'] ?? "" }}"
                                                                                {{ $seller_verification_data['is_account_verified'] == 1 ? 'readonly' : '' }}
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-6 col-lg-6">
                                                                        <div class="form-group">
                                                                            <label>{{ __('Name As Per Bank Account') }}</label>
                                                                            <input class="form-control" type="text" id="name_as_per_bank_account_number" name="name_as_per_bank_account_number" placeholder="{{__('Enter Name')}}" 
                                                                                value="{{$seller_verification_data['name_as_per_bank_account_number'] ?? "" }}"
                                                                                {{ $seller_verification_data['is_account_verified'] == 1 ? 'readonly' : '' }}
                                                                            >
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-3 col-lg-3">
                                                                    </div>
                                                                    <div class="col-xxl-6 col-lg-6">
                                                                        <br>
                                                                       <div class="form-group">
                                                                            <button id="verify_account_number_button" type="button" 
                                                                                class="btn {{ $seller_verification_data['is_account_verified'] == 1 ? 'btn-success' : 'btn-primary' }}"
                                                                                {{ $seller_verification_data['is_account_verified'] == 1 ? 'disabled' : '' }}
                                                                            >{{ __('Verify Account Number') }}
                                                                            </button> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-xxl-3 col-lg-3">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                         </div>
                                                    </div>
                                                    <br>
                                                    <div class="dashboard__headerGlobal__btn">
                                                            <div class="btn-wrapper">
                                                            <center><button href="#" class="dashboard_table__title__btn btn-bg-1 radius-5" type="submit"> {{ __('Send Verify Request') }}</button></center>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="otpModal" tabindex="-1" role="dialog" aria-labelledby="otpModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpModalLabel">Enter Aadhaar OTP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="otpForm">
                        <input type="hidden" id="userId" name="user_id" value="">
                        <div class="form-group">
                            <label for="otp">Enter OTP</label>
                            <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter otp" required >
                        </div>
                        <br>
                        <button type="submit" id="otpSubmitButton" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <x-media.markup :type="'web'"/>
    <!-- Dashboard area end -->
@endsection
@section('scripts')
    <script>
    $(document).ready(function() {
        $('#verify_pan_button').on('click', function() {
            var panNumber = $('#pan_number').val();
            var button = $(this);
            var originalText = button.text();
            console.log("PanNumber : ", panNumber);
            button.prop('disabled', true).text('Verifying...');
            $.ajax({
                url: '{{ route('seller.profile.verify.pan') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    pan_number: panNumber
                },
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        window.location.reload();
                    } else {
                        window.location.reload();
                        console.log('Verification failed: ' + response.message);
                        button.prop('disabled', false).text(originalText);
                    }
                },
                error: function(xhr, status, error) {
                    window.location.reload();
                    console.error('Error:', error);
                    button.prop('disabled', false).text(originalText);
                }
            });
        });

        $('#verify_aadhaar_button').on('click', function() {
            var aadhaarNumber = $('#aadhaar_number').val();
            var button = $(this);
            var originalText = button.text();
            console.log("Aadhaar Number : ", aadhaarNumber);
            button.prop('disabled', true).text('Sending OTP.....');
            $.ajax({
                url: '{{ route('seller.profile.verify.aadhaar') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    aadhaar_number: aadhaarNumber
                },
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        $('#otpModal').modal('show');
                    } else {
                        window.location.reload();
                        button.prop('disabled', false).text(originalText);
                        console.log('Send OTP Failed');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    window.location.reload();
                    button.prop('disabled', false).text(originalText);
                    alert('Error: ' + error);
                }
            });
        });

        $('#otpForm').on('submit', function(event) {
            event.preventDefault();
            let formData = $(this).serialize();
            let submitButton = $('#otpSubmitButton');
            let originalText = submitButton.text();
            submitButton.prop('disabled', true).text('Verifying...');
            $.ajax({
                url: '{{ route('seller.profile.verify.otp') }}',
                type: 'POST',
                data: formData,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#otpModal').modal('hide');
                        window.location.reload();
                    } else {
                        $('#otpModal').modal('hide');
                        window.location.reload();
                        console.log('OTP Verification Failed');
                        submitButton.prop('disabled', false).text(originalText);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    $('#otpModal').modal('hide');
                    window.location.reload();
                    submitButton.prop('disabled', false).text(originalText);
                    alert('Error: ' + error);
                }
            });
        });

        $('#verify_account_number_button').on('click', function() {
            var accountNumber = $('#account_number').val();
            var ifscNumber = $('#ifsc_number').val();
            var mobileNumber = $('#mobile_number').val();
            var nameAsPerBankAccountNumber = $('#name_as_per_bank_account_number').val();
            var button = $(this);
            var originalText = button.text();
            console.log("Account Number : ", accountNumber);
            console.log("IFSC Number : ", ifscNumber);
            console.log("Mobile Number : ", mobileNumber);
            console.log("Name as per Bank Account Number : ", nameAsPerBankAccountNumber);
            button.prop('disabled', true).text('Verifying.....');
            $.ajax({
                url: '{{ route('seller.profile.verify.bankaccount') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    beneficiaryAccount: accountNumber,
                    beneficiaryIFSC: ifscNumber,
                    beneficiaryMobile: mobileNumber,
                    beneficiaryName: nameAsPerBankAccountNumber,
                    nameFuzzy: true
                },
                success: function(response) {
                    console.log(response);
                    if (response.status === 'success') {
                        window.location.reload();
                    } else {
                        window.location.reload();
                        button.prop('disabled', false).text(originalText);
                        console.log('Account Verification Failed');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    window.location.reload();
                    button.prop('disabled', false).text(originalText);
                    alert('Error: ' + error);
                }
            });
        });
    });
    </script>
    <x-media.js :type="'web'"/>
@endsection