<?php
namespace App\Http\Controllers\backend;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CommissionCriteria;
use App\Models\LeadComissionCriteria;
use App\Models\VpCommissionCriteria;
use App\Models\Role;
use App\Models\User;
use App\Models\WorkingHour;
use DataTables;
use App\Interfaces\UserRole;
use DB;
class ComissionController extends Controller
{
    
   /*
    Recruiter calculate commission
    
    a. total_net_margin
    b. check net margin in comission criteria and get percent of comission
    c  consultant total working hours of current month

     Formula calculate comission :  (b/100)* a * c;
   */

      public function recruiterCalculateComission($user_id, $month){
       
        $total=0;
        
       // $data['net_margin']= User::where('assign_recruiter',$user_id)->whereMonth('start_date',$month)->where('role_id',11)->sum('net_margin') ?? 0;

        $consultents= User::where('assign_recruiter',$user_id)
        ->where('role_id',UserRole::Consultant)->where('account_status',1)->get();

         $total_wroking_hours=[];
         $total_commission=[];
         $total_net_margin=[];
        foreach($consultents as $placementData){
         
           if(!empty($month['from_date']) && !empty($month['to_date'])){
           
            $working_hours=DB::table('working_hours')
            ->select(DB::raw('sum(working_hours) as working_hours'))
            ->where('user_id','=',$placementData->id)
            ->whereDate('start_date','>',$month['from_date'])
            ->whereDate('end_date','<',$month['to_date'])
            //->groupBy('user_id')
            ->get();
           $working_hours=@$working_hours[0]->working_hours ?? 0;
           }else{
           
            $working_hours=DB::table('working_hours')
            ->select(DB::raw('sum(working_hours) as working_hours'))
            ->where('user_id','=',$placementData->id)
             ->groupBy('user_id')
            ->get();
           
            $working_hours=@$working_hours[0]->working_hours ?? 0;
           }
            
            $net_margin=$placementData->net_margin ?? 0;
            $total_net_margin[]=$net_margin;
            $total_wroking_hours[]=$working_hours;
           
          $percentage_commission=DB::select("SELECT * FROM `commission_criterias` WHERE `to_net_margin` > ".$net_margin." and `from_net_margin` <=".$net_margin."");

          $comissionPercent=$percentage_commission[0]->commission ?? 0;
          $total_commission[]= ($comissionPercent / 100) *  $net_margin* $working_hours;

         }

        $data['consultents']=count($consultents);
        $data['total_wroking_hours']= array_sum($total_wroking_hours);

        $data['net_margin']= round(array_sum($total_net_margin));
      
        // $rateArr=$this->currencyconvert($currency='USD');
        // if(!empty($rateArr)){
        //   $current_rate=$rateArr->conversion_rates->INR ?? 0;
        //   $data['total_commission']= 'Rs '.round($current_rate*array_sum($total_commission));
        // }else{
        //   $data['total_commission']= '$ '.round(array_sum($total_commission));
        // }
       
        $data['total_commission']= '$ '.round(array_sum($total_commission));
      //  $data['total_commission']= $current_rate*round(array_sum($total_commission));
        $data['role']=UserRole::Recruiter;
        return $data;
    }

   
    
    /*
    a . Number of placement start current month under the team requirtor
    b . Total Requirtor
    c  a/b
    d Average net margin= Total net margin of hires/ no. of hires)  

    */
    public function recruiterLeadComission($user_id, $month=null){
        
        $recruiter= User::where('assign_recruiter_lead',$user_id)->where('role_id',UserRole::Recruiter)
        ->where('account_status',1)->get();

        $numofStartPlacement=[];
        $net_margin=[];
        foreach($recruiter as $recruiterRow){
          //Get Num of consultent under recruiter
         if(!empty($month['from_date']) && !empty($month['to_date'])){
          $numofStartPlacement[]=  User::where('assign_recruiter',$recruiterRow->id)->whereBetween('start_date',[@$month['from_date'], @$month['to_date']])->where('account_status',1)->count(); 
          //Get Num of consultent get total net margin
          $net_margin[]=User::where('assign_recruiter',$recruiterRow->id)->whereBetween('start_date',[@$month['from_date'], @$month['to_date']])->where('account_status',1)->sum('net_margin');
         }else{
          $numofStartPlacement[]=  User::where('assign_recruiter',$recruiterRow->id)->where('account_status',1)->count(); 
          //Get Num of consultent get total net margin
          $net_margin[]=User::where('assign_recruiter',$recruiterRow->id)->where('account_status',1)->sum('net_margin');
         }
        
        }
         $data['consultents']=array_sum($numofStartPlacement)/12;
         $data['recruiter']=count($recruiter) ?? 0;
         $data['net_margin']= array_sum($net_margin) ?? 0;
         //Total slab formula
         $data['slab_total']=0;
         if($data['consultents'] !=0 && !empty($data['recruiter'])){
            $data['slab_total']=$data['consultents']/$data['recruiter'];
         }
       

         //Avg Rate manger
          $data['avg_gross_net_margin']=0;
         if($data['net_margin'] !=0 && $data['consultents'] !=0){
           $data['avg_gross_net_margin']= round($data['net_margin']/ $data['consultents']);
         }
        $commission=DB::select("SELECT * FROM `lead_comission_criterias` WHERE to_slab > ".$data['slab_total']." and from_slab <= ".$data['slab_total']." AND to_net_margin > ".$data['avg_gross_net_margin']." and from_net_margin <=".$data['avg_gross_net_margin']." ");

      $data['role']=UserRole::RecruiterLead;
      $data['total_commission']=@$commission[0]->comission_amount*$data['consultents'];

        return  $data;
    }
    

    public function accountManagerDirectCommission($user_id, $month=null){
        //All consultent sum net margin

        $consultant= User::where('assign_account_manager',$user_id)
        ->where('role_id',UserRole::Consultant)
        ->where('commission_type_account_manager',1)
        ->where('account_status',1)->get();
        $data['total_net_margin']=$consultant->sum('net_margin') ?? 0;
        $data['total_placement']=$consultant->count() ?? 0; //consultent

         $data['avg_net_margin']= round($data['total_net_margin']/$data['total_placement']);
         
         $total_wroking_hours=[];
         $gross_avg_net_margin=[];
         foreach($consultant as $placementData){
           if(!empty($month['from_date']) && !empty($month['to_date'])){
            $working_hours=DB::table('working_hours')
            ->select(DB::raw('sum(working_hours) as working_hours'))
            ->where('user_id','=',$placementData->id)
            ->whereDate('start_date','>',$month['from_date'])
            ->whereDate('end_date','<',$month['to_date'])
            //->groupBy('user_id')
            ->get();
           $working_hours=@$working_hours[0]->working_hours ?? 0;
           }else{
            $working_hours=DB::table('working_hours')
            ->select(DB::raw('sum(working_hours) as working_hours'))
            ->where('user_id','=',$placementData->id)
           
            ->get();
           $working_hours=@$working_hours[0]->working_hours ?? 0;
           }
          
         
           $total_wroking_hours[]=$working_hours;
           $gross_avg_net_margin[]=$placementData->net_margin*$working_hours;
         }

        
          $data['total_wroking_hours']=array_sum($total_wroking_hours);
          $data['avg_gross_net_margin']=array_sum($gross_avg_net_margin);

          $commission=DB::select("SELECT * FROM `account_manager_comission_criteria` WHERE to_net_margin_per > ".$data['avg_net_margin']." and from_net_margin_per <= ".$data['avg_net_margin']." AND monthly_to_net_margin > ".$data['avg_gross_net_margin']." and monthly_from_net_margin <=".$data['avg_gross_net_margin']." ");

          $data['commission_percent']=@$commission[0]->monthly_commission ?? 0;

          $data['total_commission']=round($data['avg_gross_net_margin']*$data['commission_percent']/100);
           $data['role']=UserRole::AccountManager;
             $data['type']=0;//direct commission
          return $data;
    }

    public function accountManagerIndirectCommission($user_id, $month=null){
        $data['total_net_margin']= User::where('assign_account_manager',$user_id)
        ->where('role_id',UserRole::Consultant)
        ->where('commission_type_account_manager',1)
        ->where('account_status',1)
        ->sum('net_margin');


        $data['total_placement']= User::where('assign_account_manager',$user_id)
        ->where('account_status',1)
        ->where('role_id',UserRole::Consultant)
        ->where('commission_type_account_manager',1)
        ->get();
        $data['avg_net_margin']= $data['total_net_margin']/count($data['total_placement']);
        $total_wroking_hours=[];
        $gross_avg_net_margin=[];
        foreach($data['total_placement'] as $placementData){
        $working_hours= @$placementData->working_hours[0]->working_hours ?? 0;
        $total_wroking_hours[]=$working_hours;
        $gross_avg_net_margin[]=$placementData->net_margin*$working_hours;

        }
        $data['role']=UserRole::AccountManager;
        $data['total_wroking_hours']=array_sum($total_wroking_hours);
        $data['avg_gross_net_margin']=array_sum($gross_avg_net_margin);
        $data['type']=1;
        return $data;
    }

    
     public function bdmDirectCommission($user_id, $month=null){
        $consultant= User::where('assign_bdm',$user_id)->where('role_id',UserRole::Consultant)->where('account_status',1)->get();

          $data['consultants']=$consultant->count();
          $data['net_margin']=$consultant->sum('net_margin');
          $data['avg_net_margin']= round($data['net_margin']/$data['consultants']);
          $total_wroking_hours=[];
          $gross_avg_net_margin=[];
          foreach($consultant as $placementData){
            if(!empty($month['from_date']) && !empty($month['to_date'])){
          $working_hoursdata=WorkingHour::where('user_id',$placementData->id)
          ->select(DB::raw('sum(working_hours) as working_hours'))
          ->whereBetween('start_date',[@$month['from_date'], @$month['to_date']])
          ->groupBy('user_id')->get(); 
          $working_hours=$working_hoursdata[0]['working_hours'] ?? 0;
          }else{
            $working_hoursdata=WorkingHour::where('user_id',$placementData->id)
            ->select(DB::raw('sum(working_hours) as working_hours'))
           
            ->groupBy('user_id')->get(); 
            $working_hours=$working_hoursdata[0]['working_hours'] ?? 0;
          }


          $total_wroking_hours[]=$working_hours;
          $gross_avg_net_margin[]=$placementData->net_margin*$working_hours;
          }

          $data['total_wroking_hours']= round(array_sum($total_wroking_hours));
          $data['avg_gross_net_margin']= round(array_sum($gross_avg_net_margin));
          $data['role']=7;

          $commission=DB::select("SELECT * FROM `bdm_commission_criterias` WHERE to_net_margin_per > ".$data['avg_net_margin']." and from_net_margin_per <= ".$data['avg_net_margin']." AND monthly_to_net_margin > ".$data['avg_gross_net_margin']." and monthly_from_net_margin <=".$data['avg_gross_net_margin']." and type=0 ");

          $data['commission_percent']=@$commission[0]->monthly_commission ?? 0;
           $data['total_commission']=$data['avg_gross_net_margin']*$data['commission_percent']/100;
           $data['type']=0;//commission type
          return $data;
     }

     public function bdmIndirectCommission($user_id,$month=null){
       $consultant= User::where('assign_bdm',$user_id)->where('role_id',UserRole::Consultant)
       ->whereBetween('start_date',[@$month['from_date'], @$month['to_date']])
       ->where('account_status',1)->get();

        $bdm= User::where('id',$user_id)->where('role_id',UserRole::BDM)->where('account_status',1)->first();
        $data['consultants']=$consultant->count();

      $data['net_margin']=$consultant->sum('net_margin');
      $net_margin_percentage=  $data['net_margin']/count($consultant);//percent
      $data['avg_net_margin']= $net_margin_percentage/100;

           $total_wroking_hours=[];
          $all_consultent_monthly_percent=[];
           $gross_avg_net_margin=[];
          foreach($consultant as $placementData){
             $net_margin=$placementData->net_margin;

             $no_of_month=$this->getNoOfMonthStartDate($placementData->start_date);

             if(!empty($month['from_date']) && !empty($month['to_date'])){
              $working_hoursdata=WorkingHour::where('user_id',$placementData->id)
              ->select(DB::raw('sum(working_hours) as working_hours'))
              ->groupBy('user_id')->get(); 
              $working_hours=@$working_hoursdata[0]['working_hours'] ?? 0;
            }else{
              $working_hours= @$placementData->working_hours[0]->working_hours ?? 0;
            }

            $total_wroking_hours[]=$working_hours;
            $gross_avg_net_margin=$net_margin*$working_hours;

             $percent=DB::select("SELECT * FROM `bdm_commission_criterias` WHERE to_net_margin_per < ".$gross_avg_net_margin."  AND monthly_to_net_margin > ".$no_of_month." and monthly_from_net_margin <=".$no_of_month." and type=1");

             $all_consultent_monthly_percent[]=$percent[0]->monthly_commission ?? 0;

          }
         
          $data['total_wroking_hours']= round(array_sum($total_wroking_hours));
          $data['avg_gross_net_margin']=   $data['avg_net_margin'];//gross margin
          $data['total_commission']=$all_consultent_monthly_percent;
          $data['role']=7;
          $data['type']=1;//commission type

          return $data;
     }


    public function getCommissionReport(Request $request){
      $employee_id=$request->employee_id;
       $month=$request->month;
        $role_id=$request->role_id;
         $month=[];
        $commission_type=$request->commission_type;
       $month['from_date']=$request->from_date;
         $month['to_date']=$request->to_date;

      if($role_id==UserRole::AccountManager){
        if($commission_type==1){
             $cal=$this->accountManagerIndirectCommission($employee_id,$month); 
           
           }else{
             $cal=$this->accountManagerDirectCommission($employee_id,$month);
           }
      }elseif($role_id==UserRole::DeliveryManager){
        if($commission_type==1){
             $cal=$this->deliveryManagerIndirectCommission($employee_id,$month); 
           
           }else{
             $cal=$this->deliveryManagerDirectCommission($employee_id,$month);
           }
       }elseif($role_id==UserRole::RecruiterLead){

          $cal=$this->recruiterLeadComission($employee_id,$month);
       }elseif($role_id==UserRole::Recruiter){

            $cal=$this->recruiterCalculateComission($employee_id,$month);
        }elseif($role_id==UserRole::BDM){
           if($commission_type==1){
             $cal=$this->bdmIndirectCommission($employee_id,$month); 
            
           }else{
            $cal=$this->bdmDirectCommission($employee_id,$month); 
           }
       }elseif($role_id==UserRole::VP){
           $cal=$this->vpCalculateComission($employee_id,$month);
       }else{
         $cal=0;
       }
 
      return response()->json($cal);
    }
    //Vice president commission
    public function vpCalculateComission($user_id,$month=null){
        $employee_id=$user_id;
        $month=$month;
      
         $consultant= User::where('assign_vp',$user_id)->where('role_id',UserRole::Consultant)
         ->where('account_status',1)->get();
          $data['consultants']=$consultant->count();
          $data['net_margin']=$consultant->sum('net_margin');
          $data['avg_net_margin']= round($data['net_margin']/$data['consultants']);
          $total_wroking_hours=[];
          $gross_avg_net_margin=[];
          foreach($consultant as $placementData){
            if(!empty($month['from_date']) && !empty($month['to_date'])){
              $working_hoursdata=WorkingHour::where('user_id',$placementData->id)
              ->select(DB::raw('sum(working_hours) as working_hours'))
              ->whereBetween('start_date',[@$month['from_date'], @$month['to_date']])
              ->groupBy('user_id')->get(); 
              $working_hours=$working_hoursdata[0]['working_hours'] ?? 0;
            }else{
              $working_hoursdata=WorkingHour::where('user_id',$placementData->id)
              ->select(DB::raw('sum(working_hours) as working_hours'))
              
              ->groupBy('user_id')->get(); 
              $working_hours=$working_hoursdata[0]['working_hours'] ?? 0;
            }
            $total_wroking_hours[]=$working_hours;
            $gross_avg_net_margin[]=$placementData->net_margin*$working_hours;
          }

          $data['total_wroking_hours']= round(array_sum($total_wroking_hours));
          $data['avg_gross_net_margin']= round(array_sum($gross_avg_net_margin));

         $net_gross_percent=DB::select("SELECT * FROM `vp_commission_criterias` WHERE to_net_margin > ".$data['avg_gross_net_margin']." and from_net_margin <= ".$data['avg_gross_net_margin']."  ");
          $net_gross_percent= @$net_gross_percent[0]->percent ?? 0;

           $data['total_commission']=$data['avg_gross_net_margin']/100*$net_gross_percent;

        
          $data['role']=8;
        return $data;
    }

    function getNoOfMonthStartDate($joining_date){
        $date1 = $joining_date;
        $date2 = date('Y-m-d');
        $ts1 = strtotime($date1);
        $ts2 = strtotime($date2);
        $year1 = date('Y', $ts1);
        $year2 = date('Y', $ts2);
        $month1 = date('m', $ts1);
        $month2 = date('m', $ts2);
        return $diff = (($year2 - $year1) * 12) + ($month2 - $month1);

    }

   /* Delivery Manager Commission*/
   public function deliveryManagerDirectCommission($user_id, $month=null){
        //All consultent sum net margin
       
         //All placement consultant
         $consultant= User::where('assign_delivery_manager',$user_id)->where('role_id',11)->get();

          $data['total_net_margin']=$consultant->sum('net_margin') ?? 0;

         $data['total_placement']=$consultant->count() ?? 0; //consultent

         
         $data['avg_net_margin']= round($data['total_net_margin']/$data['total_placement']);
         
         $total_wroking_hours=[];
         $gross_avg_net_margin=[];
         foreach($consultant as $placementData){
           if($month !=null || $month !=''){
            $working_hoursdata=WorkingHour::where('user_id',$placementData->id)->select(DB::raw('sum(working_hours) as working_hours'))->whereBetween('start_date',[@$month['from_date'], @$month['to_date']])->groupBy('user_id')->get(); 
            $working_hours=$working_hoursdata[0]['working_hours'] ?? 0;
           }else{
            $working_hours= @$placementData->working_hours[0]->working_hours ?? 0;
           }
          
         
           $total_wroking_hours[]=$working_hours;
           $gross_avg_net_margin[]=$placementData->net_margin*$working_hours;
         }

        
          $data['total_wroking_hours']=array_sum($total_wroking_hours);
          $data['avg_gross_net_margin']=array_sum($gross_avg_net_margin);

          $commission=DB::select("SELECT * FROM `account_manager_comission_criteria` WHERE to_net_margin_per > ".$data['avg_net_margin']." and from_net_margin_per <= ".$data['avg_net_margin']." AND monthly_to_net_margin > ".$data['avg_gross_net_margin']." and monthly_from_net_margin <=".$data['avg_gross_net_margin']." ");

          $data['commission_percent']=@$commission[0]->monthly_commission ?? 0;

          $data['total_commission']=round($data['avg_gross_net_margin']*$data['commission_percent']/100);
           $data['role']=UserRole::DeliveryManager;
             $data['type']=0;//direct commission
          return $data;
    }

     public function deliveryManagerIndirectCommission($user_id, $month=null){
         $data['total_net_margin']= User::where('assign_delivery_manager',$user_id)->sum('net_margin');
         $data['total_placement']= User::where('assign_delivery_manager',$user_id)->get();
         $data['avg_net_margin']= $data['total_net_margin']/count($data['total_placement']);
         $total_wroking_hours=[];
         $gross_avg_net_margin=[];
         foreach($data['total_placement'] as $placementData){
           $working_hours= @$placementData->working_hours[0]->working_hours ?? 0;
           $total_wroking_hours[]=$working_hours;
           $gross_avg_net_margin[]=$placementData->net_margin*$working_hours;

         }
          $data['role']=UserRole::DeliveryManager;
          $data['total_wroking_hours']=array_sum($total_wroking_hours);
          $data['avg_gross_net_margin']=array_sum($gross_avg_net_margin);
           $data['type']=1;


        return $data;
    }

    public function currencyconvert($currency){
      //https://app.exchangerate-api.com/
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://v6.exchangerate-api.com/v6/9200d155eec1f406a5de1997/latest/'.$currency,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        return json_decode($response);
    }

}
