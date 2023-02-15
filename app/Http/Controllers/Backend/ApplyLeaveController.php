<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApplyLeave;
use App\Models\User;
use DataTables;
use Redirect;

use Auth;

class ApplyLeaveController extends Controller
{
    public function index(Request $request){

         if ($request->ajax()) {
            $data = ApplyLeave::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()

                     ->editColumn('user_id', function ($row) {
                           return @$row->user->first_name.' '.@$row->user->last_name;

                      })

                ->addColumn('action', function($row){                    
                        $url=route('employee.apply-leave.delete',['id'=>$row->id]);

                           $btn = '<a href="#" data-id="'.$row->id.'" class="leaveeditmodel btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> <a href="'.$url.'"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'; 
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

           $userdata=User::whereNotIn('role_id',[1])->get();
    	return view('backend.empl-applyleave.applyleave');
    }

    public function store(Request $request){

    	$this->validate($request, [
            'leave_apply_from'=> 'required',
            'leave_apply_to'=> 'required',
            'number_of_days'=> 'required',
            'leave_type_id' => 'required',
            'reason_for_leave' => 'required',
        ]);

        $store= array(
            'user_id'=>Auth::User()->id,
            'leave_apply_from' =>date("Y-m-d",strtotime($request->leave_apply_from)),
            'leave_apply_to' =>date("Y-m-d",strtotime($request->leave_apply_to)),
            'number_of_days' => $request->number_of_days,
            'leave_type_id' => $request->leave_type_id,
            'reason_for_leave' =>$request->reason_for_leave,
        );

        $insert=ApplyLeave::create($store);
        if($insert){
             return redirect('employee/apply-leave')->with('success', 'leave has been Applied ');
        }else{
             return redirect('employee/apply-leave')->with('error', 'failed to apply leave ');
        }

    	//return view('backend.empl-applyleave.applyleave');
    }

    public function edit(Request $request){

          $data= ApplyLeave::where('id',$request->id)->first();
         
        return response()->json($data);         
    }

     public function update(Request $request){
     
         $this->validate($request, [
            'leave_apply_from'=> 'required',
            'leave_apply_to'=> 'required',
            'number_of_days'=> 'required',
            'leave_type_id' => 'required',
            'reason_for_leave' => 'required',
        ]);
          
            $store=array(
            'user_id'=>Auth::User()->id,
            'leave_apply_from' =>date("Y-m-d",strtotime($request->leave_apply_from)),
            'leave_apply_to' =>date("Y-m-d",strtotime($request->leave_apply_to)),
            'number_of_days' => $request->number_of_days,
            'leave_type_id' => $request->leave_type_id,
            'reason_for_leave' =>$request->reason_for_leave,
            );

           
           $insert = ApplyLeave::where('id',$request->id)->update($store);
           if($insert==1){
           return Redirect::back()->with('success', 'leave has been updated ');
        }else{
            return Redirect::back()->with('error', 'Failed to update leave ');
        }
    } 

     public function delete(Request $request){
          $delete = ApplyLeave::where('id',$request->id)->delete();
           if($delete==1){
            return Redirect::back()->with('success', 'Leave has been deleted ');
        }else{
            return Redirect::back()->with('error', 'Failed to delete leave ');
        }
    } 

}
