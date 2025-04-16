@extends('backend.admin-master')
@section('site-title')
    {{__('All Pipelines')}}
@endsection

@section('style')
<x-datatable.css/>
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
                        <div class="header-wrap d-flex justify-content-between">
                            <div class="left-content">
                                <h4 class="header-title">{{__('All Pipelines')}}  </h4>
                                @can('pipeline-delete')
                                  <x-bulk-action/>
                                @endcan
                            </div>
                            @can('pipeline-create')
                            <div class="right-content">
                                <a href="{{ route('admin.pipeline.new')}}" class="btn btn-primary">{{__('Add New Pipeline')}}</a>
                            </div>
                             @endcan
                        </div>
                        <div class="table-wrap table-responsive">
                            <table class="table table-default">
                                <thead>
                                <th class="no-sort">
                                    <div class="mark-all-checkbox">
                                        <input type="checkbox" class="all-checkbox">
                                    </div>
                                </th>
                                <th>{{__('ID')}}</th>
                                <th>{{__('Name')}}</th>
                                <th>{{__('Description')}}</th>
                                <th>{{__('Status')}}</th>
                                <th>{{__('Create Date')}}</th>
                                <th>{{__('Action')}}</th>
                                </thead>
                                <tbody>
                                    @foreach($pipelines as $pipeline)
                                        <tr>
                                            <td>
                                                <x-bulk-delete-checkbox :id="$pipeline->id"/>
                                            </td>
                                            <td>{{$pipeline->id}}</td>
                                            <td>{{$pipeline->pipeline_name}}</td>
                                            <td>{!! $pipeline->pipeline_description !!}</td>
                                            <td>
                                                @can('pipeline-status')
                                                    @if($pipeline->status==1)
                                                    <span class="btn btn-success btn-sm">{{__('Active')}}</span>
                                                    @else 
                                                    <span class="btn btn-danger">{{__('Inactive')}}</span> 
                                                    @endif
                                                    <span><x-status-change :url="route('admin.pipeline.status',$pipeline->id)"/></span>
                                                @endcan
                                            </td>
                                            <td>{{date('d-m-Y', strtotime($pipeline->created_at))}}</td>
                                            <td>
                                                @can('pipeline-delete')
                                                  <x-delete-popover :url="route('admin.pipeline.delete',$pipeline->id)"/>
                                                @endcan
                                                @can('pipeline-edit')
                                                  <x-edit-icon :url="route('admin.pipeline.edit',$pipeline->id)"/>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
 <x-datatable.js/>
    <script type="text/javascript">
        (function(){
            "use strict";
            $(document).ready(function(){
                <x-bulk-action-js :url="route('admin.pipeline.bulk.action')"/>

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
