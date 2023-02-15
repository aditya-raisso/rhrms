<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmploymentDetails;
use DataTables;
use Redirect;
class EmploymentDetailController extends Controller
{
    public function index(Request $request){
        $data= EmploymentDetails::where('id',$request->id)->first();
        return response()->json($data);         
    }

    public function store(Request $request){
        $this->validate($request, [
        'job_title'=> 'required|string',
        'company_name'=> 'required|string',
        'location'=> 'required|string',
        'start_date'=> 'required|string',
       
        ]);
          $store=array(      
            'user_id'=> $request->user_id,
             'job_title'=> $request->job_title,
            'start_date'=>date("Y-m-d",strtotime($request->start_date)),
            'company_name'=>$request->company_name,
            'location'=>$request->location,
            );
         

         if($request->currently_work_here==''){
            $store['currently_work_here']=0;
            $store['end_date']=date("Y-m-d",strtotime($request->end_date));
           
         }else{
           $store['currently_work_here']=1;
         }
          $insert= EmploymentDetails::create($store);

           if($insert){
             return Redirect::back()->with('success', 'Employment details has been created ');
        }else{
             return Redirect::back()->with('error', 'Failed to create Employment details');
        }

     
    }


      public function update(Request $request){
        $this->validate($request, [
        'id'=> 'required|integer',
        'job_title'=> 'required|string',
        'company_name'=> 'required|string',
        'location'=> 'required|string',
        'start_date'=> 'required|string',
        ]);
          $store=array(    
           'job_title'=> $request->job_title,  
            'user_id'=> $request->user_id,
            'start_date'=>date("Y-m-d",strtotime($request->start_date)),
            'company_name'=>$request->company_name,
            'location'=>$request->location,
            );
         

         if($request->currently_work_here==''){
            $store['currently_work_here']=0;
            $store['end_date']=date("Y-m-d",strtotime($request->end_date));
           
         }else{
           $store['currently_work_here']=1;
         }
          $insert= EmploymentDetails::where('id',$request->id)->update($store);

           if($insert==1){
             return Redirect::back()->with('success', 'Employment details has been updated ');
        }else{
             return Redirect::back()->with('error', 'Failed to update employment details');
        }

     
    }
}
