@extends('backend.admin-master')
@section('site-title')
    {{__('Add New Pipeline')}}
@endsection
@section('style')
    <x-summernote.css/>
    <x-media.css/>
    <style>
        .left-side-meta{
            /*margin-left: 100px;*/
        }
    </style>
@endsection
@section('content')
    <div class="col-lg-12 col-ml-12 padding-bottom-30">
        <div class="row">
            <div class="col-lg-12">
                <div class="margin-top-40"></div>
                <x-msg.success/>
                <x-msg.error/>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('Add New Pipeline')}}   </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="{{route('admin.pipeline')}}">{{__('All Pipelines')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.pipeline.new')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="tab-content margin-top-20">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">{{__('Pipeline Name')}}</label>
                                            <input type="text" class="form-control" name="pipeline_name" id="pipeline_name" placeholder="{{__('Enter Pipeline Name')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{__('Pipeline Description')}}</label>
                                    <input type="hidden" name="pipeline_description">
                                    <div class="summernote"></div>
                                </div>
                                <center><button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Add Pipeline')}}</button></center>
                            </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
    <x-media.markup/>
@endsection

@section('script')
    <x-summernote.js/>
<script>
  <x-icon-picker/> 
</script>
 <x-media.js />

 <script>
    (function ($) {
        "use strict";

        $(document).ready(function () {
            //Permalink Code
            $('.permalink_label').hide();
            $(document).on('keyup', '#name', function (e) {
                var slug = converToSlug($(this).val());
                var url = "{{url('/service-list/pipeline/')}}/" + slug;
                $('.permalink_label').show();
                var data = $('#slug_show').text(url).css('color', 'blue');
                $('.penalty_slug').val(slug);

            });
            function converToSlug(slug){
               let finalSlug = slug.replace(/[^a-zA-Z0-9]/g, ' ');
                //remove multiple space to single
                finalSlug = slug.replace(/  +/g, ' ');
                // remove all white spaces single or multiple spaces
                finalSlug = slug.replace(/\s/g, '-').toLowerCase().replace(/[^\w-]+/g, '-');
                return finalSlug;
            }
            //Slug Edit Code
            $(document).on('click', '.slug_edit_button', function (e) {
                e.preventDefault();
                $('.penalty_slug').show();
                $(this).hide();
                $('.slug_update_button').show();
            });

            //Slug Update Code
            $(document).on('click', '.slug_update_button', function (e) {
                e.preventDefault();
                $(this).hide();
                $('.slug_edit_button').show();
                var update_input = $('.penalty_slug').val();
                var slug = converToSlug(update_input);
                var url = `{{url('/service-list/pipeline/')}}/` + slug;
                $('#slug_show').text(url);
                $('.penalty_slug').val(slug)
                $('.penalty_slug').hide();
            });

        });
    })(jQuery)
</script>
@endsection  

