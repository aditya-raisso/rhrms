<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Crypt;
use Redirect;
use DataTables;
use Illuminate\Support\Facades\Auth;
class AttendenceController extends Controller
{
	public function index(Request $request)
    {
    

         if ($request->ajax()) {
            $data = Attendance::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                     
                      ->addColumn('employee_id', function($row){
                        return @$row->user->emp_id ?? '';
                      })


                      ->addColumn('employee_name', function($row){
                        if(!empty($row->user->first_name) && !empty($row->user->last_name) && !empty($row->user->middle_name)){
                         return $row->user->first_name.' '.@$row->user->middle_name.' '.@$row->user->last_name;
                        }else{
                          return @$row->user->first_name ?? ''.' '.@$row->user->last_name ?? '';

                        }
                      })

                      ->editColumn('punch_in', function($row){
                         if(!empty($row->punch_in)){
                        return date("d-m-Y H:i", strtotime($row->punch_in));
                        }else{
                             return '-';
                        }
                      })

                      ->editColumn('punch_out', function($row){
                        if(!empty($row->punch_out)){
                         return date("d-m-Y H:i", strtotime($row->punch_out));
                        }else{
                             return '-';
                        }
                      })
                  
                      ->addColumn('action', function($row){
                         $id=Crypt::encryptString($row->id);
                           $url='';

                           $btn = '<a href="'.$url.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>';
     
                            return $btn;
                    })->rawColumns(['action','employee_id'])->make(true);
        }
      

        return view('backend.attendence.list');
    }
    

	public function punchIN(Request $request){

         $check=Attendance::where('user_id',Auth::user()->id)->whereDate('punch_in',date('Y-m-d'))->get();
         if(count($check)>0){
                  return Redirect::back()->with('error','Allready punched In attendance');  
         	exit;
         }  

          $insert=Attendance::create(['user_id'=>Auth::user()->id,'punch_in'=>date('Y-m-d H:i:s')]);
           
         if($insert){
             return Redirect::back()->with('success','Punched IN successfully');
         }else{
             return Redirect::back()->with('error','Failed to punch In.');
         	
         }

	}

	public function punchOut(Request $request){
        $check=Attendance::where('user_id',Auth::user()->id)->whereDate('punch_in',date('Y-m-d'))->first();
         if(!empty($check->punch_out)){
                  return Redirect::back()->with('error','Allready punched out attendance');  
         	exit;
         }  

         $update=Attendance::where('id',$check->id)->update(['punch_out'=>date('Y-m-d H:i:s')]);
         if($update==1){
             return Redirect::back()->with('success','Punched out successfully');
         }else{
             return Redirect::back()->with('error','Failed to punch out.');
         	
         }
	}

    
    public function checkPunchInOUT(Request $request){
    	$check=Attendance::where('user_id',Auth::user()->id)->whereDate('punch_in',date('Y-m-d'))->first();
        if(!empty($check)){
        	return 'punch-out-1';
        }else{
        	return 'punch_in-1';
        }
    }

    public function Report()
    {
      return view('backend.attendence.report');
    }



}