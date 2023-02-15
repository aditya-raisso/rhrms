<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\EmployeeCategory;
use App\Models\State;
use App\Models\Country;
use App\Models\SalaryType;
use App\Models\CommissionCriteria;
use App\Models\City;
use Hash;
class CommonController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function emailVerify(Request $request){
      $data=User::where('email',$request->email)->first();
      $status='false';
       if(isset($request->password)){
         if(Hash::check($request->password, $data->password)){
           echo  $status= 'true';
            exit;
         }
        
       }else{
          
          if(!empty($data)){
           if($data->account_status !=1){
               echo  $status= 0;
               exit;
           }    
            echo  $status= 'true';
            exit;
          }
       }
        
       echo $status;
    }

    public function getEmploymentType(Request $request){
         $data=EmployeeCategory::where('is_parient',$request->employmentCategory)->get()->toArray();
         echo json_encode($data);
    }

 public function getSalaryType(Request $request){
         $data=SalaryType::where('department_id',$request->department_id)->get()->toArray();
        echo json_encode($data);      
      }


    public function getStateData(Request $request){
         $country_id=Country::where('name',$request->country)->value('id');
         $data=State::where('country_id',$country_id)->get()->toArray();
         echo json_encode($data);
    }

    public function getCityData(Request $request){
         $state_id=Country::where('name',$request->state)->value('id');
         $data=City::where('state_id',$state_id)->get()->toArray();
         echo json_encode($data);
    }

    public function getRoleByUserData(Request $request){
   
         $data=User::where('role_id',$request->id)->get()->toArray();
         echo json_encode($data);
    }

    public function calculater_comission(Request $request){
        

        //Formula: comission percentnet margin; /100 * zzz
        $net_margin= User::where('id',$request->user_id)->value('net_margin');
        $total_wroking_hours=$request->hours;
        $commission=CommissionCriteria::where('from_net_margin','<=',$net_margin)
        ->where('to_net_margin','>=',$net_margin)->first();
        $percentage=  $commission->commission ?? 0;
         echo $total = ($percentage / 100) * $net_margin*$total_wroking_hours;
    }
}
