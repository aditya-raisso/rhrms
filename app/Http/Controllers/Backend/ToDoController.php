<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\User;
use DataTables;
use Redirect;
use Auth;

class ToDoController extends Controller
{

    
    public function index(Request $request){

        if ($request->ajax()) {
            $data = Todo::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()

                        ->editColumn('create_by', function ($row) {
                           return @$row->createBy->first_name.' '.$row->createBy->last_name;

                      })

                        ->editColumn('user_id', function ($row) {
                           return @$row->userBy->first_name.' '.$row->userBy->last_name;

                      })

                    ->addColumn('action', function($row){
                        $url=route('admin.todo.delete',['id'=>$row->id]);

                           $btn = '<a href="#" data-id="'.$row->id.'" class="todoeditmodel btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="'.$url.'"  class=" btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

      $userdata=User::whereNotIn('role_id',[1])->get();

      return view('backend.todo.list',['userdata'=>$userdata]);
    }

    public function store(Request $request){

         $this->validate($request, [
            'user_id'=> 'required',
            'comment'=> 'required',
        ]);

        $store=array(
            'create_by'=>Auth::User()->id,
            'user_id'=>$request->user_id,
            'comment'=>$request->comment,                                                  
        );

        $insert=Todo::create($store);

        if($insert){
             return redirect('admin/todo')->with('success', 'To Do has been created ');
        }else{
             return redirect('admin/todo')->with('error', 'failed to create To Do ');
        }

}
     public function edit(Request $request){

        $store = Todo::where('id',$request->id)->first();

        return response()->json($store);
    }

    public function update(Request $request){
        $this->validate($request, [        
            'user_id'=> 'required',
            'comment'=> 'required',
        ]);

        $data=array(
            'create_by'=>Auth::User()->id,
            'user_id'=>$request->user_id,
            'comment'=>$request->comment,
        );
         $update = Todo::where('id',$request->id)->update($data);

           if($update==1){
           return redirect('admin/todo')->with('success', 'To do has been updated ');
        }else{
            return redirect('admin/todo')->with('error', 'Failed to update To do');
        }

    }

    public function delete(Request $request){
         $delete = Todo::where('id',$request->id)->delete();

           if($delete==1){
           return redirect('admin/todo')->with('success', 'To do has been deleted ');
        }else{
            return redirect('admin/todo')->with('error', 'Failed to delete');
        }
    }

   
}
