@extends('backend.admin-master')
@section('site-title')
    {{__('Service Provider Extra Service Template')}}
@endsection
@section('style')
    <x-media.css/>
    <x-summernote.css/>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrapp d-flex justify-content-between">
                            <h4 class="header-title">{{__('Service Provider Extra Service Template')}}</h4>
                            <a class="btn btn-info" href="{{route('admin.email.template.all')}}">{{__('All Email Templates')}}</a>
                        </div>
                        <form action="{{route('admin.seller.extra.service')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-30">
                                <div class="form-group">
                                    <label for="seller_extra_service_subject">{{__('Email Subject')}}</label>
                                    <input type="text" name="seller_extra_service_subject"  class="form-control" value="{{ get_static_option('seller_extra_service_subject') ?? __('Extra Service Added') }}">
                                </div>
                                <div class="form-group">
                                    <label for="seller_extra_service_message">{{ __('Email Message For Service Provider') }}</label>
                                    <textarea class="form-control summernote" name="seller_extra_service_message">{!! get_static_option('seller_extra_service_message') ?? '' !!} </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="seller_to_buyer_extra_service_message">{{ __('Email Message For Customer') }}</label>
                                    <textarea class="form-control summernote" name="seller_to_buyer_extra_service_message">{!! get_static_option('seller_to_buyer_extra_service_message') ?? '' !!} </textarea>
                                </div>
                                <small class="form-text text-muted text-danger"><code>@order_id</code> {{__('will be replaced by dynamically with service request id.')}}</small>
                                <small class="form-text text-muted text-danger"><code>@seller_name</code> {{__('will be replaced by dynamically with service provider name.')}}</small>
                                <small class="form-text text-muted text-danger"><code>@buyer_name</code> {{__('will be replaced by dynamically with customer name.')}}</small>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Update')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <x-media.js />
    <x-summernote.js/>
    <script>
        $(document).ready(function () {
            //to do:
        });
    </script>
@endsection
