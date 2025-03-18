<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\FlashMsg;
use App\Penalty;
use Illuminate\Support\Facades\DB;
use Str;

class PenaltyController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:penalty-list|penalty-create|penalty-status|penalty-edit|penalty-delete',['only' => ['index']]);
        $this->middleware('permission:penalty-create',['only' => ['add_new_penalty']]);
        $this->middleware('permission:penalty-edit',['only' => ['edit_penalty']]);
        $this->middleware('permission:penalty-status',['only' => ['change_status']]);
        $this->middleware('permission:penalty-delete',['only' => ['delete_penalty','bulk_action']]);
    }
    
    public function index(){
        $penalties = Penalty::all();
        return view('backend.pages.penalty.index',compact('penalties'));
    }

    public function add_new_penalty(Request $request)
    {

        if($request->isMethod('post')){
            $request->validate(
                [
                    'penalty_reason'=> 'required|unique:penalties|max:300',
                ],
                [
                    'penalty_reason.unique' => __('Penalty Already Exists.'),
                ]
            );
            $penalty = Penalty::create([
               'penalty_reason' => $request->penalty_reason,
               'status' => 1,
               'description' => $request->penalty_description,
               'penalty_percentage' => $request->penalty_percentage,
           ]);

           return redirect()->back()->with(FlashMsg::item_new('New Penalty Added'));
        }
        return view('backend.pages.penalty.add_penalty');
    }

    public function edit_penalty(Request $request, $id=null)
    {
        if($request->isMethod('post')){
            $request->validate(
                [
                'penalty_reason' => 'required|max:191|unique:penalties,penalty_reason,'.$id,
            ],
            [
                'penalty_reason.unique' => __('Penalty Already Exists.'),
            ]
            );
            
            Penalty::where('id',$id)->update([
                'penalty_reason' => $request->penalty_reason,
                'description' => $request->penalty_description,
                'penalty_percentage' => $request->penalty_percentage,
            ]);

            return redirect()->back()->with(FlashMsg::item_new('Penalty Update Success'));
        }
        $penalty = Penalty::find($id);
        return view('backend.pages.penalty.edit_penalty',compact('penalty'));
    }

    public function change_status($id){
       $penalty = Penalty::select('status')->where('id',$id)->first();
       if($penalty->status==1){
           $status = 0;
       }else{
        $status = 1;
       }
       Penalty::where('id',$id)->update(['status'=>$status]);
       return redirect()->back()->with(FlashMsg::item_new(' Status Change Success'));
    }

    public function delete_penalty($id){
        Penalty::find($id)->delete();
        return redirect()->back()->with(FlashMsg::item_new(' Penalty Deleted Success'));
    }

    public function bulk_action(Request $request){
        Penalty::whereIn('id',$request->ids)->delete();
        return response()->json(['status' => 'ok']);
    }
}
