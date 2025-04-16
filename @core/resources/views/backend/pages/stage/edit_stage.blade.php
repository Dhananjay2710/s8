@extends('backend.admin-master')

@section('site-title')
    {{__('Edit Stage')}}
@endsection
@section('style')
    <x-summernote.css/>
    <x-media.css/>
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
                                <h4 class="header-title">{{__('Edit Stage')}}   </h4>
                            </div>
                            <div class="right-content">
                                <a class="btn btn-info btn-sm" href="{{route('admin.stage')}}">{{__('All Stages')}}</a>
                            </div>
                        </div>
                        <form action="{{route('admin.stage.edit',$stage->id)}}" method="post" enctype="multipart/form-data" id="edit_pipeline_form">
                            @csrf

                            <div class="tab-content margin-top-20">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="icon" class="d-block">{{__('Pipeline')}}</label>
                                            <select name="pipeline_id" id="pipeline_id" class="form-control">
                                                @foreach($pipelines as $pipeline)
                                                <option value="{{ $pipeline->id }}" {{ $stage->pipeline_id == $pipeline->id ? 'selected' : '' }}>
                                                    {{ $pipeline->pipeline_name }}
                                                </option>                                                
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">{{__('Stage Name')}}</label>
                                            <input type="text" class="form-control" name="stage_name" id="stage_name" value="{{$stage->stage_name}}" placeholder="{{__('Stage Name')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">{{__('Stage Action Key')}}</label>
                                            <input type="text" class="form-control" name="stage_action_key" id="stage_action_key" value="{{$stage->stage_action_key}}" placeholder="{{__('Stage Name')}}">
                                        </div>
                                    </div>
                                </div>
                               
                                <center><button type="submit" class="btn btn-primary mt-3 submit_btn">{{__('Update')}}</button></center>
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
                var sl =  $('.penalty_slug').val();
                var url = `{{url('/service-list/stage/')}}/` + sl;
                var data = $('#slug_show').text(url).css('color', 'blue');

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
                    var url = `{{url('/service-list/stage/')}}/` + slug;
                    $('#slug_show').text(url);
                    $('.penalty_slug').val(slug)
                    $('.penalty_slug').hide();
                });


             // for summernote
            $('.summernote').summernote({
                height: 400,   //set editable area's height
                codemirror: { // codemirror options
                    theme: 'monokai'
                },
                callbacks: {
                    onChange: function (contents, $editable) {
                        $(this).prev('input').val(contents);
                    }
                }
            });
            if ($('.summernote').length > 0) {
                $('.summernote').each(function (index, value) {
                    $(this).summernote('code', $(this).data('content'));
                });
            }


        });
    })(jQuery)
</script>
@endsection