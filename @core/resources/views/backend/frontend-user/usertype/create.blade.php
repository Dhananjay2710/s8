@extends('backend.admin-master')
@section('site-title')
    {{__('Add New User Type')}}
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <h4 class="header-title">{{__('New User Type')}}</h4>
                            <div class="btn-wrapper">
                                <a href="{{route('admin.all.frontend.usertype')}}" class="btn btn-info">{{__('All User Types')}}</a>
                            </div>
                        </div>
                        <x-msg.error/>
                        <x-msg.success/>
                        <form action="{{route('admin.frontend.new.usertype')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">{{__('Name')}}</label>
                                <input type="text" class="form-control"  id="name" name="name" placeholder="{{__('Enter name')}}">
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 pr-4 pl-4">{{__('Add')}}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function (){
           "use strict";

           $(document).on('click','.checked_all',function (){
              var allCheckbox =  $('.checkbox-wrapper input[type="checkbox"]');
              $.each(allCheckbox,function (index,value){
                  if ($(this).is(':checked')){
                      $(this).prop('checked',false);
                  }else{
                      $(this).prop('checked',true);
                  }
              });
           });

        });
    </script>
@endsection
