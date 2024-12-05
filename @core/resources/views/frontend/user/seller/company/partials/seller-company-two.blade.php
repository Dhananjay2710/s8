@extends('frontend.user.buyer.buyer-master')
@section('site-title')
    {{__('Edit Service Provider Company')}}
@endsection
@section('style')
    <x-media.css/>
@endsection
@section('content')
    <x-frontend.seller-buyer-preloader/>
    @php $default_lang = get_default_language(); @endphp
    <!-- Dashboard area Starts -->
    @include('frontend.user.seller.partials.sidebar-two')
    @if(!empty($companyData))
    <div class="dashboard__right">
        <!-- buyer header -->
        @include('frontend.user.buyer.header.buyer-header')
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <div class="thumb-ad">
                    @if(!empty($companyData->profile_background))
                        {!! render_image_markup_by_attachment_id($companyData->profile_background) !!}
                    @else
                        <img src="{{ asset('assets/frontend/img/static/ads.jpg') }}" alt="ads">
                    @endif

                </div>
                <!-- buyer profile section start-->
                <div class="dashboard_accountProfile mt-4">
                    <x-error-message/>
                    <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                        <div class="dashboard_accountProfile__item">

                            <div class="dashboard_accountProfile__flex">
                                <div class="dashboard_accountProfile__author">
                                    <div class="dashboard_accountProfile__author__flex">
                                        <div class="dashboard_accountProfile__author__thumb">
                                            <a href="javascript:void(0)">
                                                @if(!is_null($companyData->image))
                                                    {!! render_image_markup_by_attachment_id($companyData->image) !!}
                                                @else
                                                    <img src="{{ asset('assets/frontend/img/no-image.jpg') }}" alt="No Image">
                                                @endif
                                            </a>
                                        </div>
                                        <div class="dashboard_accountProfile__author__contents">
                                            <h4 class="dashboard_accountProfile__author__title"><a href="javascript:void(0)">{{ $companyData->name }}</a></h4>
                                            <p class="dashboard_accountProfile__author__para mt-1">{{ $companyData->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="dashboard_accountProfile__btn">
                                    <a href="#0" class="dashboard_table__title__btn btn-bg-1 radius-5 edit_buyer_profile"
                                       data-bs-toggle="modal"
                                       data-bs-target="#editProfile"
                                    ><i class="fa-regular fa-pen-to-square"></i> {{ __('Edit Company') }}</a>
                                </div>
                            </div>
                            <div class="dashboard_accountProfile__inner profile_border_top">
                                <div class="dashboard_accountProfile__details">
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{ __('Company Name:') }}</span>
                                        <span class="dashboard_accountProfile__details__para">{{ $companyData->name }}</span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{__('Company Email:')}} </span>
                                        <span class="dashboard_accountProfile__details__para">{{ $companyData->email }}</span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{ __('Phone Number:') }}</span>
                                        <span class="dashboard_accountProfile__details__para">{{ $companyData->phone }}</span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{__('Company Address:')}}</span>
                                        <span class="dashboard_accountProfile__details__para">{{ $companyData->address }}</span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{ __('Company Area:') }}</span>
                                        @if(!empty($areas))
                                            @foreach($areas as $area)
                                                @if($area->id==$companyData->service_area)
                                                    <span class="dashboard_accountProfile__details__para"> {{ $area->service_area }} </span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{__('Company City:')}}</span>
                                        @if(!empty($cities))
                                            @foreach($cities as $city)
                                                @if($city->id==$companyData->service_city)
                                                    <span class="dashboard_accountProfile__details__para"> {{ $city->service_city }} </span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{__('Company Country:')}}</span>
                                        @if(!empty($countries))
                                            @foreach($countries as $country)
                                                @if($country->id==$companyData->country_id)
                                                    <span class="dashboard_accountProfile__details__para"> {{ $country->country }} </span>
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{__('Company Post Code:')}}</span>
                                        <span class="dashboard_accountProfile__details__para">{{ $companyData->post_code }}</span>
                                    </div>
                                    <div class="dashboard_accountProfile__details__item">
                                        <span class="dashboard_accountProfile__details__name">{{__('Company GSTIN:')}}</span>
                                        <span class="dashboard_accountProfile__details__para">{{ $companyData->gstin }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="dashboard__right">
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <!-- search section start-->
                <div class="dashboard__inner__item dashboard_border padding-20 radius-10 bg-white">
                    <div class="dashboard__wallet">
                        <form action="{{ route('seller.company') }}" method="GET">
                            <div class="dashboard__headerGlobal__flex">
                                <div class="dashboard__headerGlobal__content">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        <h4 class="dashboard_table__title">{{ __('Search Team Member') }}</h4> <i class="las la-angle-down search_by_all"></i>
                                    </button>
                                </div>
                                <div class="dashboard__headerGlobal__btn">
                                    <div class="btn-wrapper">
                                        <button href="#" class="dashboard_table__title__btn btn-bg-1 radius-5" type="submit">
                                            <i class="fa-solid fa-magnifying-glass"></i> {{ __('Search') }}</button>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <div id="collapseOne" class="accordion-collapse collapse
                                @if(request()->get('member_id'))  show
                                @elseif(request()->get('member_name ')) show
                                @elseif(request()->get('member_email ')) show
                                @elseif(request()->get('member_phone ')) show
                                @endif
                                "aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="single-settings">
                                                    <div class="single-dashboard-input">
                                                        <div class="row g-4 mt-3">
                                                            {{-- <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="member_id" class="info-title"> {{__('Member Id')}} </label>
                                                                    <input class="form--control" name="member_id" value="{{ request()->get('member_id') }}" type="text" placeholder="{{ __('Member Id') }}">
                                                                </div>
                                                            </div> --}}
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="member_name" class="info-title"> {{__('Member Name')}} </label>
                                                                    <input class="form--control" name="member_name" value="{{ request()->get('member_name') }}" type="text" placeholder="{{ __('Member Name') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="member_email" class="info-title"> {{__('Member Email')}} </label>
                                                                    <input class="form--control" name="member_email" value="{{ request()->get('member_email') }}" type="text" placeholder="{{ __('Member Email') }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-3 col-sm-6">
                                                                <div class="single-info-input">
                                                                    <label for="member_phone" class="info-title"> {{__('Member Phone')}} </label>
                                                                    <input class="form--control" name="member_phone" value="{{ request()->get('member_phone') }}" type="text" placeholder="{{ __('Member Phone') }}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!--search section end-->
                <!-- todolist table section start-->
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <h2 class="dashboard_table__title"> {{__('All Team Members')}} </h2>
                    <div class="notice-board">
                        <p class="text-danger">{{ __('Include team members who work under your supervision') }}</p>
                    </div>
                    <div class="dashboard_table__title__flex">
                        <h4 class="dashboard_table__title">  </h4>
                        <div class="btn-wrapper" data-bs-toggle="modal" data-bs-target="#openTicket">
                            <a href="javascript:void(0)"
                               class="dashboard_table__title__btn btn-bg-1 radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#addteammembermodel"><i class="fa-solid fa-plus"></i> {{__('Add Team Member' )}}</a>
                        </div>
                    </div>
                    <div class="mt-5"> <x-msg.error/> </div>
                    @if($userDataWithCompany->count() >= 1)
                        <div class="dashboard_table__main custom--table mt-4">
                            <table>
                                <thead>
                                <tr>
                                    <th>{{ __('Sr No.') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Username') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Phone') }}</th>
                                    <th>{{ __('Area') }}</th>
                                    <th>{{ __('City') }}</th>
                                    <th>{{ __('Country') }}</th>
                                    <th>{{ __('Post Code') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($userDataWithCompany))
                                    @foreach($userDataWithCompany as $index => $userData)
                                        <tr>
                                            <td>{{ $index+1 }}</td>
                                            <td>{{ $userData->name }}</td>
                                            <td>{{ $userData->username }}</td>
                                            <td>{{ $userData->email }}</td>
                                            <td>{{ $userData->phone }}</td>
                                            <td>{{ optional($userData->area)->service_area }}</td>
                                            <td>{{ optional($userData->city)->service_city }}</td>
                                            <td>{{ optional($userData->country)->country }}</td>
                                            <td>{{ $userData->post_code }}</td>
                                            <td>
                                                <div class="dashboard-switch-single">
                                                    @if($userData->user_status==1)
                                                        <span class="text-success">{{ __('Active') }}</span>
                                                    @else
                                                        <span class="text-danger">{{ __('Inactive') }}</span>
                                                    @endif
                                                    <x-seller-member-status :url="route('seller.company.member.status',$userData->id)"/>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="dashboard-switch-single">
                                                    <a href="#0" class="edit_member_modal"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editMemberModal"
                                                    data-id="{{ $userData->id }}"
                                                    data-name="{{ $userData->name }}"
                                                    data-phone="{{ $userData->phone }}"
                                                    data-email="{{ __($userData->email) }}"
                                                    data-address="{{ $userData->address }}"
                                                    data-service_area="{{ $userData->service_area }}"
                                                    data-service_city="{{ $userData->service_city }}"
                                                    data-service_country="{{ $userData->service_country }}"
                                                    data-post_code="{{ $userData->post_code }}"
                                                    >
                                                        <span style="font-size:16px;" class="dash-icon color-1"> <i class="las la-edit"></i> </span>
                                                    </a>
                                                    <x-seller-member-delete :url="route('seller.company.member.delete',$userData->id)"/>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                        <td>Data Not Found</td>
                                @endif
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="chat_wrapper__details__inner__chat__contents">
                            <h2 class="chat_wrapper__details__inner__chat__contents__para">{{ __('No Member Found') }}</h2>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Add Team member Modal -->
    <div class="modal fade modal-lg" id="addteammembermodel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Add Team Member') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="{{route('seller.company.add.member')}}" method="POST">
                            <input type="hidden" name="companyid" value="{{ $companyData->id }}">
                            @csrf
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="memberfullname" class="label_title__postition">{{ __('Full Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="memberfullname" placeholder="Full Name">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="memberusername" class="label_title__postition">{{ __('User Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="memberusername" placeholder="User Name">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="memberemail" class="label_title__postition">{{ __('Email') }} <span class="text-danger">*</span> </label>
                                        <input type="email" class="form--control radius-10" name="memberemail" placeholder="Member Email">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="memberphone" class="label_title__postition">{{ __('Phone Number') }} <span class="text-danger">*</span> </label>
                                        <input type="tel" class="form--control radius-10" name="memberphone" placeholder="Member Phone Number">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition">{{ __('New Password') }} <span class="text-danger">*</span> </label>
                                        <input type="password" class="form--control radius-10" name="newpassword" placeholder="New Password">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="confirmPassword" class="label_title__postition">{{ __('Confirm Password') }} <span class="text-danger">*</span> </label>
                                        <input type="password" class="form--control radius-10" name="confirmpassword" placeholder="Confirm Password">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="country" class="label_title__postition">{{ __('Select Country') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="country_id_add_member" id="country_id_add_member">
                                                @if(!empty($countries))
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}">{{ $country->country }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service city" class="label_title__postition">{{ __('Select City') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_city_add_member" id="service_city_add_member">
                                                @if(!empty($cities))
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->id }}">{{ $city->service_city }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service area" class="label_title__postition">{{ __('Select Area') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_area_add_member" id="service_area_add_member">
                                                @if(!empty($areas))
                                                    @foreach($areas as $area)
                                                        <option value="{{ $area->id }}">{{ $area->service_area }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Add Member') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Dashboard area end -->

    <!-- Seller Company Edit Modal Start-->
    <div class="modal fade modal-lg" id="editProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Edit Company') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="{{route('seller.company.edit')}}" method="POST">
                            <input type="hidden" name="companyid" value="{{ $companyData->id }}">
                            @csrf
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="name" class="label_title__postition">{{ __('Compnay Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="companyname" value="{{ $companyData->name }}" placeholder="Company Name">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="email" class="label_title__postition">{{ __('Company Email') }} <span class="text-danger">*</span> </label>
                                        <input type="email" class="form--control radius-10" name="companyemail" value="{{ $companyData->email }}" placeholder="Company Email">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="phone" class="label_title__postition">{{ __('Company Phone Number') }} <span class="text-danger">*</span> </label>
                                        <input type="tel" class="form--control radius-10" name="companyphone" value="{{ $companyData->phone }}" placeholder="Company Phone Number">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="country" class="label_title__postition">{{ __('Select Country') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="country_id" id="country_id">
                                                @if(!empty($countries))
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" @if($country->id==$companyData->country_id) selected @endif>{{ $country->country }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service city" class="label_title__postition">{{ __('Select City') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_city" id="service_city">
                                                @if(!empty($cities))
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->id }}" @if($city->id==$companyData->service_city) selected @endif>{{ $city->service_city }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service area" class="label_title__postition">{{ __('Select Area') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_area" id="service_area">
                                                @if(!empty($areas))
                                                    @foreach($areas as $area)
                                                        <option value="{{ $area->id }}" @if($area->id==$companyData->service_area) selected @endif>{{ $area->service_area }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition">{{ __('Company Address') }} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="companyaddress" value="{{ $companyData->address }}" placeholder="Company Address">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="newPassword" class="label_title__postition">{{ __('Post Code') }} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="companypost_code" value="{{ $companyData->post_code }}" placeholder="Company Post Code">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="gstin" class="label_title__postition">{{ __('GSTIN Number') }} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="gstin" value="{{ $companyData->gstin }}" placeholder="GSTIN Number">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="media-upload-btn-wrapper">
                                        <div class="img-wrap">
                                            {!! render_image_markup_by_attachment_id($companyData->image,'','thumb') !!}
                                        </div>
                                        <input type="hidden" id="image" name="companyimage"
                                               value="{{$companyData->image}}">
                                        <button type="button" class="btn btn-info media_upload_form_btn"
                                                data-btntitle="{{__('Select Image')}}"
                                                data-modaltitle="{{__('Upload Image')}}" data-bs-toggle="modal"
                                                data-bs-target="#media_upload_modal">
                                            {{__('Upload Company Image')}}
                                        </button>
                                    </div>
                                    <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                </div>

                                <div class="single-dashboard-input">
                                    <div class="single-info-input margin-top-30">
                                        <div class="form-group">
                                            <div class="media-upload-btn-wrapper">
                                                <div class="img-wrap">
                                                    {!! render_image_markup_by_attachment_id($companyData->profile_background) !!}
                                                </div>
                                                <input type="hidden" id="profile_background" name="company_profile_background"
                                                       value="{{$companyData->profile_background}}">
                                                <button type="button" class="btn btn-info media_upload_form_btn"
                                                        data-btntitle="{{__('Select Image')}}"
                                                        data-modaltitle="{{__('Upload Image')}}" data-bs-toggle="modal"
                                                        data-bs-target="#media_upload_modal">
                                                    {{__('Upload Background Image')}}
                                                </button>
                                            </div>
                                            <small class="form-text text-muted">{{__('allowed image format: jpg,jpeg,png')}}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Update Company Info') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Seller Company Edit Modal End-->
    <!-- Member Edit Modal -->
    <div class="modal fade modal-lg" id="editMemberModal" tabindex="-1" aria-labelledby="memberUpdateModel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="memberUpdateModel">{{ __('Edit Member') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="custom-form">
                        <form action="{{route('seller.company.member.edit')}}" method="POST">
                            <input type="hidden" name="up_member_id" id = "up_member_id">
                            @csrf
                            <div class="row g-4">
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_name" class="label_title__postition">{{ __('Name') }} <span class="text-danger">*</span></label>
                                        <input type="text" class="form--control radius-10" name="up_name" id="up_name" placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_email" class="label_title__postition">{{ __('Email') }} <span class="text-danger">*</span> </label>
                                        <input type="email" class="form--control radius-10" name="up_email" id="up_email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_phone" class="label_title__postition">{{ __('Phone Number') }} <span class="text-danger">*</span> </label>
                                        <input type="tel" class="form--control radius-10" name="up_phone" id="up_phone" placeholder="Phone Number">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="country" class="label_title__postition">{{ __('Select Country') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="country_id_update_member" id="country_id_update_member">
                                                @if(!empty($countries))
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->id }}" >{{ $country->country }}</option>
                                                    @endforeach
                                                    {{-- @if($country->id==$userData->country_id) selected @endif>{{ $country->country }} --}}
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service_city" class="label_title__postition">{{ __('Select City') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_city_update_member" id="service_city_update_member">
                                                @if(!empty($cities))
                                                    @foreach($cities as $city)
                                                        <option value="{{ $city->id }}" >{{ $city->service_city }}</option>
                                                    @endforeach
                                                    {{-- @if($city->id==$userData->service_city) selected @endif>{{ $city->service_city }} --}}
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="service_area" class="label_title__postition">{{ __('Select Area') }} <span class="text-danger">*</span> </label>
                                        <div class="single-input-select radius-10">
                                            <select name="service_area_update_member" id="service_area_update_member">
                                                @if(!empty($areas))
                                                    @foreach($areas as $area)
                                                        <option value="{{ $area->id }}" >{{ $area->service_area }}</option>
                                                    @endforeach
                                                    {{-- @if($area->id==$userData->service_area) selected @endif>{{ $area->service_area }} --}}
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_address" class="label_title__postition">{{ __('Address') }} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="up_address" id="up_address" placeholder="Address">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="single-input">
                                        <label for="up_post_code" class="label_title__postition">{{ __('Post Code') }} <span class="text-danger">*</span> </label>
                                        <input type="text" class="form--control radius-10" name="up_post_code" id="up_post_code" placeholder="Post Code">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Update Member Info') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="dashboard__right">
        <!-- buyer header -->
        @include('frontend.user.buyer.header.buyer-header')
        <div class="dashboard__body">
            <div class="dashboard__inner">
                <div class="dashboard_table__wrapper dashboard_border  padding-20 radius-10 bg-white">
                    <h2 class="dashboard_table__title"> {{__('Add Company/Channel Deatils')}} </h2>
                    <div class="notice-board">
                        <p class="text-danger">{{ __('If you are associated with a service provider or channel partner, please add your organizations details below. This information will help us better understand your business and streamline our collaboration.') }}</p>
                    </div>
                    <br>
                    <div class="dashboard_table__title__flex">
                        <h4 class="dashboard_table__title">  </h4>
                        <div class="btn-wrapper" data-bs-toggle="modal" data-bs-target="#openTicket">
                            <a href="javascript:void(0)"
                               class="dashboard_table__title__btn btn-bg-1 radius-5"
                               data-bs-toggle="modal"
                               data-bs-target="#addCompanyModal"><i class="fa-solid fa-plus"></i> {{__('Add Company' )}}</a>
                        </div>
                    </div>
                    <div class="mt-5"> <x-msg.error/> </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Add Modal -->
    <div class="modal fade" id="addCompanyModal" tabindex="-1" role="dialog" aria-labelledby="couponModal" aria-hidden="true">
        <form action="{{ route('seller.company.add') }}" method="post">
            @csrf
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header d-block ">
                        <div class="row">
                            <div class="col-md-11">
                                <h4 class="modal-title" id="couponModal">{{ __('Add Company Deatils') }}</h4>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                        <small class="text-info">{{ __('Add your company/channel deatils') }}</small>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mt-3">
                            <label for="companyname" class="label_title">{{ __('Company Name') }} <span class="text-danger">*</span> </label>
                            <input type="text" name="companyname" id="companyname" class="form-control" placeholder="{{ __('Company Name') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="companyemail" class="label_title">{{ __('Company Email') }} <span class="text-danger">*</span> </label>
                            <input type="text" name="companyemail" id="companyemail" class="form-control" placeholder="{{ __('Company Email') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="companyphone" class="label_title">{{ __('Company Phone') }} <span class="text-danger">*</span> </label>
                            <input type="text" name="companyphone" id="companyphone" class="form-control" placeholder="{{ __('Company Phone') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="companyaddress" class="label_title">{{ __('Company Address') }} <span class="text-danger">*</span> </label>
                            <input type="text" name="companyaddress" id="companyaddress" class="form-control" placeholder="{{ __('Company Address') }}">
                        </div>
                        <div class="form-group mt-3">        
                            <label for="country" class="label_title__postition">{{ __('Select Country') }} <span class="text-danger">*</span> </label>
                            <div class="single-input-select radius-10">
                                <select name="country_id_add" id="country_id_add">
                                    @if(!empty($countries))
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->country }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>    
                        </div>
                        <div class="form-group mt-3">
                            <label for="service city" class="label_title__postition">{{ __('Select City') }} <span class="text-danger">*</span> </label>
                            <div class="single-input-select radius-10">
                                <select name="service_city_add" id="service_city_add">
                                    @if(!empty($cities))
                                        @foreach($cities as $city)
                                            <option value="{{ $city->id }}">{{ $city->service_city }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group mt-3">
                            <label for="service area" class="label_title__postition">{{ __('Select Area') }} <span class="text-danger">*</span> </label>
                            <select name="service_area_add" id="service_area_add">
                                @if(!empty($areas))
                                    @foreach($areas as $area)
                                        <option value="{{ $area->id }}">{{ $area->service_area }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="companypostcode" class="label_title">{{ __('Company Post Code') }} <span class="text-danger">*</span> </label>
                            <input type="number" name="companypostcode" id="companypostcode" class="form-control" placeholder="{{ __('Company Post Code') }}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="gstin" class="label_title">{{ __('GSTIN Number') }} <span class="text-danger">*</span> </label>
                            <input type="text" name="gstin" id="gstin" class="form-control" placeholder="{{ __('GSTIN Number') }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endif
    <x-media.markup :type="'web'"/>
@endsection
@section('scripts')
    <x-media.js :type="'web'"/>
    <script src="{{asset('assets/backend/js/sweetalert2.js')}}"></script>
    <script>
        (function($){
            "use strict";
            $(document).ready(function(){

                // modal close
                $('.close').on('click', function (){
                   $('#media_upload_modal').modal('hide');
                });

                $('#country_id').select2({
                    dropdownParent: $('#editProfile')
                });
                $('#service_city').select2({
                    dropdownParent: $('#editProfile')
                });
                $('#service_area').select2({
                    dropdownParent: $('#editProfile')
                });
                $('#country_id_add').select2({
                    dropdownParent: $('#addCompanyModal')
                });
                $('#service_city_add').select2({
                    dropdownParent: $('#addCompanyModal')
                });
                $('#service_area_add').select2({
                    dropdownParent: $('#addCompanyModal')
                });
                $('#country_id_add_member').select2({
                    dropdownParent: $('#addteammembermodel')
                });
                $('#service_city_add_member').select2({
                    dropdownParent: $('#addteammembermodel')
                });
                $('#service_area_add_member').select2({
                    dropdownParent: $('#addteammembermodel')
                });

                $('#country_id_update_member').select2({
                    dropdownParent: $('#editMemberModal')
                });
                $('#service_city_update_member').select2({
                    dropdownParent: $('#editMemberModal')
                });
                $('#service_area_update_member').select2({
                    dropdownParent: $('#editMemberModal')
                });

                $(document).on('click', '.edit_buyer_profile', function(e) {
                    e.preventDefault();
                    $('#editProfile').modal('show');
                    // $('.nice-select').niceSelect('update');
                });

                // media upload modal open submit img after show old modal
               $(document).on('click', '.media_upload_modal_submit_btn', function(e) {
                    e.preventDefault();
                    $('#editProfile').modal('show');
                });

                // change country and get city for edit model
                $(document).on('change','#country_id' ,function() {
                    let country_id = $("#country_id").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.country.city') }}",
                        data: {
                            country_id: country_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select City')}}</option>";
                                var allList = "<li class='option' data-value=''>{{__('Select City')}}</li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city + "</li>";
                                });
                                $("#service_city").html(alloptions);
                                $("#service_city").parent().find(".current").html("__('Select City')");
                                $("#service_city").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");
                                $(".service_area_wrapper .list").html("");

                                $('#service_city').select2({
                                    dropdownParent: $('#editProfile')
                                });
                            }
                        }
                    })
                });

                // for add model
                $(document).on('change','#country_id_add' ,function() {
                    let country_id = $("#country_id_add").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.country.city') }}",
                        data: {
                            country_id: country_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select City')}}</option>";
                                var allList = "<li class='option' data-value=''>{{__('Select City')}}</li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city_add + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city_add + "</li>";
                                });
                                $("#service_city_add").html(alloptions);
                                $("#service_city_add").parent().find(".current").html("__('Select City')");
                                $("#service_city_add").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");
                                $(".service_area_wrapper .list").html("");

                                $('#service_city_add').select2({
                                    dropdownParent: $('#addCompanyModal')
                                });
                            }
                        }
                    })
                });

                // for add member model
                $(document).on('change','#country_id_add_member' ,function() {
                    let country_id = $("#country_id_add_member").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.country.city') }}",
                        data: {
                            country_id: country_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select City')}}</option>";
                                var allList = "<li class='option' data-value=''>{{__('Select City')}}</li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city_add + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city_add + "</li>";
                                });
                                $("#service_city_add_member").html(alloptions);
                                $("#service_city_add_member").parent().find(".current").html("__('Select City')");
                                $("#service_city_add_member").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");
                                $(".service_area_wrapper .list").html("");

                                $('#service_city_add_member').select2({
                                    dropdownParent: $('#addteammembermodel')
                                });
                            }
                        }
                    })
                });

                // for update member model
                $(document).on('change','#country_id_update_member' ,function() {
                    let country_id = $("#country_id_update_member").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.country.city') }}",
                        data: {
                            country_id: country_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select City')}}</option>";
                                var allList = "<li class='option' data-value=''>{{__('Select City')}}</li>";
                                var allCity = res.cities;
                                $.each(allCity, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_city_add + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_city_add + "</li>";
                                });
                                $("#service_city_update_member").html(alloptions);
                                $("#service_city_update_member").parent().find(".current").html("__('Select City')");
                                $("#service_city_update_member").parent().find(".list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");
                                $(".service_area_wrapper .list").html("");

                                $('#service_city_update_member').select2({
                                    dropdownParent: $('#editMemberModal')
                                });
                            }
                        }
                    })
                });

                // For edit model
                $('#service_city').select2({
                  placeholder: `{{__('search city')}}`,
                  ajax: {
                    type: 'get',
                    url: "{{route('user.country.city.ajax.search')}}",
                    dataType: 'json',
                    data: function (params) {
                        let country_id = $("#country_id").val();
                        return {
                            q: params.term, // search term
                            country_id: country_id,
                        };
                    },
                    delay: 250,
                    processResults: function (response) {
                        // console.log(response.data);
                      return {
                        results:  $.map(response, function (item) {
                              return {
                                  text: item.service_city,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });

                // For add model
                $('#service_city_add').select2({
                  placeholder: `{{__('search city')}}`,
                  ajax: {
                    type: 'get',
                    url: "{{route('user.country.city.ajax.search')}}",
                    dataType: 'json',
                    data: function (params) {
                        let country_id = $("#country_id_add").val();
                        return {
                            q: params.term, // search term
                            country_id: country_id,
                        };
                    },
                    delay: 250,
                    processResults: function (response) {
                        // console.log(response.data);
                      return {
                        results:  $.map(response, function (item) {
                              return {
                                  text: item.service_city,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });

                // For add member model
                $('#service_city_add_member').select2({
                  placeholder: `{{__('search city')}}`,
                  ajax: {
                    type: 'get',
                    url: "{{route('user.country.city.ajax.search')}}",
                    dataType: 'json',
                    data: function (params) {
                        let country_id = $("#country_id_add_member").val();
                        return {
                            q: params.term, // search term
                            country_id: country_id,
                        };
                    },
                    delay: 250,
                    processResults: function (response) {
                        // console.log(response.data);
                      return {
                        results:  $.map(response, function (item) {
                              return {
                                  text: item.service_city,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });

                // For add update model
                $('#service_city_update_member').select2({
                  placeholder: `{{__('search city')}}`,
                  ajax: {
                    type: 'get',
                    url: "{{route('user.country.city.ajax.search')}}",
                    dataType: 'json',
                    data: function (params) {
                        let country_id = $("#country_id_update_member").val();
                        return {
                            q: params.term, // search term
                            country_id: country_id,
                        };
                    },
                    delay: 250,
                    processResults: function (response) {
                        // console.log(response.data);
                      return {
                        results:  $.map(response, function (item) {
                              return {
                                  text: item.service_city,
                                  id: item.id
                              }
                          })
                      };
                    },
                    cache: true
                  }
                });

                // select city and area for edit model
                $(document).on('change','#service_city', function() {
                    var city_id = $("#service_city").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.city.area') }}",
                        data: {
                            city_id: city_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select Area')}}</option>";
                                var allList = "<li data-value='' class='option'>{{__('Select Area')}}</li>";
                                var allArea = res.areas;
                                $.each(allArea, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_area + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_area + "</li>";
                                });

                                $("#service_area").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");

                                $('#service_area').select2({
                                    dropdownParent: $('#editProfile')
                                });
                            }
                        }
                    });
                });

                // for add model
                $(document).on('change','#service_city_add', function() {
                    var city_id = $("#service_city_add").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.city.area') }}",
                        data: {
                            city_id: city_id
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select Area')}}</option>";
                                var allList = "<li data-value='' class='option'>{{__('Select Area')}}</li>";
                                var allArea = res.areas;
                                $.each(allArea, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_area + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_area + "</li>";
                                });

                                $("#service_area_add").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");

                                $('#service_area_add').select2({
                                    dropdownParent: $('#addCompanyModal')
                                });
                            }
                        }
                    });
                });

                // for add member model
                $(document).on('change','#service_city_add_member', function() {
                    var city_id_add_member = $("#service_city_add_member").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.city.area') }}",
                        data: {
                            city_id: city_id_add_member
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select Area')}}</option>";
                                var allList = "<li data-value='' class='option'>{{__('Select Area')}}</li>";
                                var allArea = res.areas;
                                $.each(allArea, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_area + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_area + "</li>";
                                });

                                $("#service_area_add_member").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");

                                $('#service_area_add_member').select2({
                                    dropdownParent: $('#addteammembermodel')
                                });
                            }
                        }
                    });
                });

                // for add member model
                $(document).on('change','#service_city_update_member', function() {
                    var city_id_add_member = $("#service_city_update_member").val();
                    $.ajax({
                        method: 'post',
                        url: "{{ route('user.city.area') }}",
                        data: {
                            city_id: city_id_add_member
                        },
                        success: function(res) {
                            if (res.status == 'success') {
                                var alloptions = "<option value=''>{{__('Select Area')}}</option>";
                                var allList = "<li data-value='' class='option'>{{__('Select Area')}}</li>";
                                var allArea = res.areas;
                                $.each(allArea, function(index, value) {
                                    alloptions += "<option value='" + value.id +
                                        "'>" + value.service_area + "</option>";
                                    allList += "<li class='option' data-value='" + value.id +
                                        "'>" + value.service_area + "</li>";
                                });

                                $("#service_area_update_member").html(alloptions);
                                $(".service_area_wrapper ul.list").html(allList);
                                $(".service_area_wrapper").find(".current").html("{{__('Select Area')}}");

                                $('#service_area_update_member').select2({
                                    dropdownParent: $('#editMemberModal')
                                });
                            }
                        }
                    });
                });

            });
        })(jQuery);

        $(document).on('click','.member_status_button',function(e){
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
                    $(this).next().find('.member_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on('click','.member_delete_button',function(e){
            e.preventDefault();
            Swal.fire({
                title: '{{__("Are you sure?")}}',
                text: '{{__("You would not be able to revert this item!")}}',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{__('Yes, delete it!')}}"
            }).then((result) => {
                if (result.isConfirmed) {
                    $(this).next().find('.member_form_submit_btn').trigger('click');
                }
            });
        });

        $(document).on('click','.edit_member_modal',function(e){
            e.preventDefault();
            let member_id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let address = $(this).data('address');
            let service_area = $(this).data('service_area');
            let service_city = $(this).data('service_city');
            let service_country = $(this).data('service_country');
            let post_code = $(this).data('post_code');
            console.log("All Data : ", member_id, name, email, phone, address);
            $('#up_member_id').val(member_id);
            $('#up_name').val(name);
            $('#up_email').val(email);
            $('#up_phone').val(phone);
            $('#up_address').val(address);
            $('#up_service_area').val(service_area);
            $('#up_service_city').val(service_city);
            $('#up_service_country').val(service_country);
            $('#up_post_code').val(post_code);
            $('.nice-select').niceSelect('update');
        });

    </script>
@endsection
