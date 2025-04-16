<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FlashMsg;
use App\Stage;
use App\Pipeline;
use Illuminate\Support\Facades\DB;
use Str;

class StageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:stage-list|stage-create|stage-status|stage-edit|stage-delete',['only' => ['index']]);
        $this->middleware('permission:stage-create',['only' => ['add_new_pipeline']]);
        $this->middleware('permission:stage-edit',['only' => ['edit_pipeline']]);
        $this->middleware('permission:stage-status',['only' => ['change_status']]);
        $this->middleware('permission:stage-delete',['only' => ['delete_pipeline','bulk_action']]);
    }
    
    public function index(){
        $stages = Stage::all();
        $pipelines = Pipeline::all();
        return view('backend.pages.stage.index',compact('stages','pipelines'));
    }

    public function add_new_stage(Request $request)
    {
        $pipelines = Pipeline::all();
        if($request->isMethod('post')){
            $request->validate(
                [
                    'stage_name'=> 'required|unique:stages|max:300',
                ],
                [
                    'stage_name.unique' => __('Stage Already Exists.'),
                ]
            );
            $stage = Stage::create([
                'pipeline_id' => $request->pipeline_id,
                'stage_name' => $request->stage_name,
                'stage_action_key'  => $request->stage_action_key,
                'status' => 1,
           ]);

           return redirect()->back()->with(FlashMsg::item_new('New Stage Added'));
        }
        return view('backend.pages.stage.add_stage',compact('pipelines'));
    }

    public function edit_stage(Request $request, $id=null)
    {
        $pipelines = Pipeline::all();
        if($request->isMethod('post')){
            $request->validate(
                [
                'stage_name' => 'required|max:191|unique:stages,stage_name,'.$id,
            ],
            [
                'stage_name.unique' => __('Stage Already Exists.'),
            ]
            );
            
            Stage::where('id',$id)->update([
                'pipeline_id' => $request->pipeline_id,
                'stage_name' => $request->stage_name,
                'stage_action_key' => $request->stage_action_key,
            ]);

            return redirect()->back()->with(FlashMsg::item_new('Stage Update Success'));
        }
        $stage = Stage::find($id);
        return view('backend.pages.stage.edit_stage',compact('stage','pipelines'));
    }

    public function change_status($id){
       $stage = Stage::select('status')->where('id',$id)->first();
       if($stage->status==1){
           $status = 0;
       }else{
        $status = 1;
       }
       Stage::where('id',$id)->update(['status'=>$status]);
       return redirect()->back()->with(FlashMsg::item_new(' Status Change Success'));
    }

    public function delete_stage($id){
        Stage::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new('Stage Deleted Success'));
    }

    public function bulk_action(Request $request){
        Stage::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
