<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FlashMsg;
use App\Pipeline;
use Illuminate\Support\Facades\DB;
use Str;

class PipelineController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pipeline-list|pipeline-create|pipeline-status|pipeline-edit|pipeline-delete',['only' => ['index']]);
        $this->middleware('permission:pipeline-create',['only' => ['add_new_pipeline']]);
        $this->middleware('permission:pipeline-edit',['only' => ['edit_pipeline']]);
        $this->middleware('permission:pipeline-status',['only' => ['change_status']]);
        $this->middleware('permission:pipeline-delete',['only' => ['delete_pipeline','bulk_action']]);
    }
    
    public function index(){
        $pipelines = Pipeline::all();
        return view('backend.pages.pipeline.index',compact('pipelines'));
    }

    public function add_new_pipeline(Request $request)
    {

        if($request->isMethod('post')){
            $request->validate(
                [
                    'pipeline_name'=> 'required|unique:pipelines|max:300',
                ],
                [
                    'pipeline_name.unique' => __('Pipeline Already Exists.'),
                ]
            );
            $pipeline = Pipeline::create([
               'pipeline_name' => $request->pipeline_name,
               'status' => 1,
               'pipeline_description' => $request->pipeline_description,
           ]);

           return redirect()->back()->with(FlashMsg::item_new('New Pipeline Added'));
        }
        return view('backend.pages.pipeline.add_pipeline');
    }

    public function edit_pipeline(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $request->validate(
                [
                'pipeline_name' => 'required|max:191|unique:pipelines,pipeline_name,'.$id,
            ],
            [
                'pipeline_name.unique' => __('Pipeline Already Exists.'),
            ]
            );
            
            Pipeline::where('id',$id)->update([
                'pipeline_name' => $request->pipeline_name,
                'pipeline_description' => $request->pipeline_description,
            ]);

            return redirect()->back()->with(FlashMsg::item_new('Pipeline Update Success'));
        }
        $pipeline = Pipeline::find($id);
        return view('backend.pages.pipeline.edit_pipeline',compact('pipeline'));
    }

    public function change_status($id){
       $pipeline = Pipeline::select('status')->where('id',$id)->first();
       if($pipeline->status==1){
           $status = 0;
       }else{
        $status = 1;
       }
       Pipeline::where('id',$id)->update(['status'=>$status]);
       return redirect()->back()->with(FlashMsg::item_new(' Status Change Success'));
    }

    public function delete_pipeline($id){
        Pipeline::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new('Pipeline Deleted Success'));
    }

    public function bulk_action(Request $request){
        Pipeline::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
