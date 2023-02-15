<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Leave;
use App\Models\User;
use DataTables;
use Redirect;
use Auth;

class LeaveController extends Controller
{
    public function index(Request $request){

         if ($request->ajax()) {
            $data = Leave::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()

                     ->editColumn('create_by', function ($row) {
                           return @$row->createBy->first_name.' '.@$row->createBy->last_name;

                      })

                ->addColumn('action', function($row){                    
                        $url=route('admin.leave.delete',['id'=>$row->id]);

                           $btn = '<a href="#" data-id="'.$row->id.'" class="leaveeditmodel btn btn-primary btn-sm"><i class="fa fa-edit"></i></a> <a href="'.$url.'"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>'; 
     
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

           $userdata=User::whereNotIn('role_id',[1])->get();

        return view('backend.leave.list', ['userdata'=>$userdata]);

    }

    public function store(Request $request){

        $this->validate($request, [
            'leave_type'=> 'required',
            'leave_name'=> 'required',
        ]);

        $store= array(
            'create_by'=>Auth::User()->id,
            'leave_type'=>$request->leave_type,
            'leave_name'=>$request->leave_name
        );

        $insert=Leave::create($store);
        if($insert){
             return redirect('admin/leave')->with('success', 'leave has been created ');
        }else{
             return redirect('admin/leave')->with('error', 'failed to create leave ');
        }

       

    }

    public function edit(Request $request){
          $data= Leave::where('id',$request->id)->first();
         
        return response()->json($data);         
    } 

    public function update(Request $request){
        $this->validate($request, [
            'leave_type'=> 'required',
            'leave_name'=> 'required',
        ]);

        $data=array(
            'create_by'=>Auth::User()->id,
            'leave_type'=>$request->leave_type,
            'leave_name'=>$request->leave_name,
        );
         $insert = Leave::where('id',$request->id)->update($data);
           if($insert==1){
           return redirect('admin/leave')->with('success', 'leave has been updated ');
        }else{
            return redirect('admin/leave')->with('error', 'failed to update leave ');
        }

    }

    public function delete(Request $request){
          $delete = Leave::where('id',$request->id)->delete();
           if($delete==1){
            return Redirect::back()->with('success', 'Leave has been deleted ');
        }else{
            return Redirect::back()->with('error', 'Failed to delete leave ');
        }
    } 
}
