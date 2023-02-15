<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Attendance;
use Auth;

use Illuminate\Support\Facades\Crypt;
class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $employees=User::whereNotIn('role_id',[1])->get();
        $Attendance=Attendance::where('created_at',date('Y-m-d'))->get();
        return view('backend.dashboard',['employees'=>$employees,'Attendance'=>$Attendance]);
    }

    public function profile(){
      $data=User::where('id',Auth::user()->id)->first();
        return view('backend.profile',['data'=>$data]);
    }

    public function profileUpdate(Request $request){
      
        $data=array(
        'first_name'=>$request->first_name,
        'last_name'=>$request->last_name,
        'password'=>bcrypt($request->password),
        );
      $update=User::where('id',$request->id)->update($data);
      if($update==1){
       return redirect('admin/profile')->with('success','Profile has been updated successfully.');
      }else{

       return redirect('admin/profile')->with('error','Failed to update profile.');
      }

    }

    public function report(){

      $data = Role::whereNotIn('id',[1,2,9,10,11,12,13])->get();

        return view('backend.report',['data'=>$data]);

    }
    
    
   
}
