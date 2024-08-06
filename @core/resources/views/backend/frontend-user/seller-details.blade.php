@extends('backend.admin-master')
@section('site-title')
    {{__('Service Provider Details')}}
@endsection

@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        @if(!empty($seller_details) && !empty($seller_verification_data))
            
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="checkbox-inlines">
                                <label><strong>{{ __('Service Provider ID:') }} </strong>#{{ $seller_details->id }}</label>
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
                                    <label><strong>{{ __('Name:') }} </strong>{{ $seller_details->name }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Email:') }} </strong>{{ $seller_details->email }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Phone:') }} </strong>{{ $seller_details->phone }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Address:') }} </strong>{{ $seller_details->address }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('City:') }} </strong>{{ optional($seller_details->city)->service_city }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Area:') }} </strong>{{ optional($seller_details->area)->service_area }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Post Code:') }} </strong>{{ $seller_details->post_code }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('Country:') }} </strong>{{ optional($seller_details->country)->country }}</label>
                                </div>
                                <div class="checkbox-inlines">
                                    <label><strong>{{ __('User Verify:') }} </strong>
                                        @if(optional($seller_details->sellerVerify)->status==1)
                                            <span class="text-warning">{{ __('Verified') }}</span>
                                        @else
                                            <span class="text-info">{{ __('Not Verified') }}</span>
                                        @endif
                                        <x-status-change :url="route('admin.frontend.seller.profile.verify',$seller_details->id)"/>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>   
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom mt-5 mb-3">
                                <h5>{{ __('Service Provider Aadhaar Deatils') }}</h5>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><strong>{{ __('Index') }} </strong></th>
                                        <th><strong>{{ __('Deatils As Per Aadhaar') }} </strong></th>
                                        <th><strong>{{ __('Deatils As per Seller') }} </strong></th>
                                        <th><strong>{{ __('Status') }} </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Number</strong></td>
                                        <td>{{ $seller_verification_data['aadhaar_number'] == "" ? "NA" : $seller_verification_data['aadhaar_number']}}</td>
                                        <td>{{ $seller_verification_data['aadhaar_number'] == "" ? "NA" : $seller_verification_data['aadhaar_number']}}</td>
                                        <td>
                                            @if($seller_verification_data['is_aadhaar_verified']!="")
                                                @if($seller_verification_data['is_aadhaar_verified']==1)
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;">{{ __('Verified') }}</strong></span>
                                                    
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Verified') }}</strong></span>
                                                    
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td>{{ $seller_verification_data['name_as_per_aadhaar'] == "" ? "NA" : $seller_verification_data['name_as_per_aadhaar']}}</td>
                                        <td>{{ $seller_verification_data['provided_name'] == "" ? "NA" : $seller_verification_data['provided_name']}}</td>
                                        <td>
                                            @if($seller_verification_data['aadhaar_name_match_status']!="")
                                                @if($seller_verification_data['aadhaar_name_match_status']==1)
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;">{{ __('Matched') }}</strong></span>
                                                    
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Matched') }}</strong></span>
                                                    
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Address</strong></td>
                                        <td>{{ $seller_verification_data['address_as_per_aadhaar'] == "" ? "NA" : $seller_verification_data['address_as_per_aadhaar']}}</td>
                                        <td>{{ $seller_verification_data['provided_address'] == "" ? "NA" : $seller_verification_data['provided_address']}}</td>
                                        <td>
                                            @if($seller_verification_data['aadhaar_address_match_status']!="")
                                                @if($seller_verification_data['aadhaar_address_match_status']==1)
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;">{{ __('Matched') }}</strong></span>
                                                    
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Matched') }}</strong></span>
                                                    
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="border-bottom mt-5 mb-3">
                                <h5>{{ __('Service Provider PAN Deatils') }}</h5>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><strong>{{ __('Item') }} </strong></th>
                                        <th><strong>{{ __('Deatils As Per PAN') }} </strong></th>
                                        <th><strong>{{ __('Deatils As per Seller') }} </strong></th>
                                        <th><strong>{{ __('Status') }} </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Number</strong></td>
                                        <td>{{ $seller_verification_data['pan_number'] == "" ? "NA" : $seller_verification_data['pan_number']}}</td>
                                        <td>{{ $seller_verification_data['pan_number'] == "" ? "NA" : $seller_verification_data['pan_number']}}</td>
                                        <td>
                                            @if($seller_verification_data['is_pan_verified']!="")
                                                @if($seller_verification_data['is_pan_verified']==1)
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;">{{ __('Verified') }}</strong></span>
                                                    
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Verified') }}</strong></span>
                                                    
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td>{{ $seller_verification_data['name_as_per_pan'] == "" ? "NA" : $seller_verification_data['name_as_per_pan']}}</td>
                                        <td>{{ $seller_verification_data['provided_name'] == "" ? "NA" : $seller_verification_data['provided_name']}}</td>
                                        <td>
                                            @if($seller_verification_data['pan_name_match_status']!="")
                                                @if($seller_verification_data['pan_name_match_status']==1)
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;">{{ __('Matched') }}</strong></span>
                                                    
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Matched') }}</strong></span>
                                                    
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>   
                </div>
                <div class="col-lg-7 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="border-bottom mb-3">
                                <h5>{{ __('Service Provider National ID') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    {!! render_image_markup_by_attachment_id(optional($seller_details->sellerVerify)->national_id,'','large') !!}
                                </div>
                            </div>   
                            <br>
                            <div class="border-bottom mt-5 mb-3">
                                <h5>{{ __('Service Provider Address') }}</h5>
                            </div>
                            <div class="single-checbox">
                                <div class="checkbox-inlines">
                                    {!! render_image_markup_by_attachment_id(optional($seller_details->sellerVerify)->address,'','large') !!}
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="border-bottom mb-3">
                                <h5>{{ __('Service Provider Account Details') }}</h5>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th><strong>{{ __('Item') }} </strong></th>
                                        <th><strong>{{ __('Deatils As Per Bank Account') }} </strong></th>
                                        <th><strong>{{ __('Status') }} </strong></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><strong>Account Number</strong></td>
                                        <td>{{ $seller_verification_data['account_number'] == "" ? "NA" : $seller_verification_data['account_number']}}</td>
                                        <td>
                                            @if($seller_verification_data['is_account_verified']!="")
                                                @if($seller_verification_data['is_account_verified']==1)
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;">{{ __('Verified') }}</strong></span>
                                                    
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Verified') }}</strong></span>
                                                    
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>IFSC Number</strong></td>
                                        <td>{{ $seller_verification_data['ifsc_number'] == "" ? "NA" : $seller_verification_data['ifsc_number']}}</td>
                                        <td>
                                            @if($seller_verification_data['is_account_verified']!="")
                                                @if($seller_verification_data['is_account_verified']==1)
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;" >{{ __('Matched') }}</strong></span>
                                                    
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Matched') }}</strong></span>
                                                    
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Mobile Number</strong></td>
                                        <td>{{ $seller_verification_data['mobile_number'] == "" ? "NA" : $seller_verification_data['mobile_number']}}</td>
                                        <td>
                                            @if($seller_verification_data['is_account_verified']!="")
                                                @if($seller_verification_data['is_account_verified']==1)
                                                    <span class="text-success"><strong style="background: green; padding: 6px; color: white;">{{ __('Matched') }}</strong></span>
                                                    
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Matched') }}</strong></span>
                                                    
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><strong>Name</strong></td>
                                        <td>{{ $seller_verification_data['name_as_per_bank_account_number'] == "" ? "NA" : $seller_verification_data['name_as_per_bank_account_number']}}</td>
                                        <td>
                                            @if($seller_verification_data['is_account_verified']!="")
                                                @if($seller_verification_data['is_account_verified']==1)
                                                    <span class="text-info"><strong style="background: green; padding: 6px; color: white;">{{ __('Matched') }}</strong></span>
                                                @else
                                                    <span class="text-danger"><strong style="background: red; padding: 6px; color: white;">{{ __('Not Matched') }}</strong></span>
                                                @endif
                                            @else
                                                <span class="text-info"><strong>{{ __('NA') }}</strong></span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('script')
<script>
    (function($){
    "use strict";
    $(document).ready(function() {
        
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
    
</script>

@endsection

