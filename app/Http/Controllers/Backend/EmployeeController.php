<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Backend\ComissionController;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Todo;
use App\Models\Role;
use App\Models\EmployeeCategory;
use App\Models\CommissionCriteria;
use App\Models\Education;
use App\Models\EmploymentDetails;
use App\Models\SalaryType;
use App\Models\Department;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use App\Models\VendorCost;
use App\Models\Attendance;
use App\Models\EmergencyContact;
use App\Models\WorkingHour;
use App\Imports\WorkingHourImport;
use App\Interfaces\UserRole;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Redirect;
use Illuminate\Support\Facades\Crypt;
use Auth;
use DataTables;
use DB;
use Mail;
class EmployeeController extends ComissionController
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
    public function index(Request $request)
    {
         if ($request->ajax()) {
            $data = User::whereNotIn('role_id',[1])->orderBy('id','DESC')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('start_date', function ($row){
                        return date('d-m-Y',strtotime($row->start_date));
                    })

                     ->editColumn('status', function ($row){
                        if($row->account_status==1){
                            return '<span class="badge badge-success">Active</span>';
                        }else{
                            return '<span class="badge badge-danger">Inactive</span>';
                        }
                        
                    })
                    ->editColumn('assign_delivery_manager', function ($row){
                    if($row->assign_delivery_manager !=''){
                    return  @$row->assignDeliveryManager->first_name.' '.@$row->assignDeliveryManager->last_name;
                    }

                    })

                    ->editColumn('assign_recruiter_lead', function ($row){
                    if($row->assign_recruiter_lead !=''){
                    return  @$row->assignRecruiterLead->first_name.' '.@$row->assignRecruiterLead->last_name;
                    }

                    })

                    ->editColumn('assign_recruiter', function ($row){
                    if($row->assign_recruiter !=''){
                    return  @$row->assignRecruiter->first_name.' '.@$row->assignRecruiter->last_name;
                    }

                    })


                    ->editColumn('assign_account_manager', function ($row){
                    if($row->assign_account_manager !=''){
                    return  @$row->assignAccountManager->first_name.' '.@$row->assignAccountManager->last_name;
                    }

                    })

                    ->editColumn('assign_bdm', function ($row){
                    if($row->assign_bdm !=''){
                    return  @$row->assignBdm->first_name.' '.@$row->assignBdm->last_name;
                    }

                    })
                    ->editColumn('assign_vp', function ($row){
                    if($row->assign_vp !=''){
                    return  @$row->assignVp->first_name.' '.@$row->assignVp->last_name;
                    }

                    })

                    ->editColumn('create_by', function ($row){
                        return  @$row->create_by->first_name.' '.@$row->create_by->last_name;
                    })
                    ->editColumn('employment_type', function ($row){
                       return  $row->employementtype->category_name ?? '';
                    })
                     ->editColumn('role_id', function ($row){
                       return  $row->role->role_name ?? '';
                    })

                    ->addColumn('action', function($row){
                        $view=route('admin.employee.view',['emp'=>$row->emp_id]);
                         $edit=route('admin.employee.edit',['emp'=>$row->emp_id]);
                        
                        $delete=route('admin.employee.delete',['emp'=>$row->emp_id]);
                           $btn = '<a href="'.$edit.'" class="edit btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <a href="'.$view.'" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i></a>
                             <a href="'.$delete.'" class="edit btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>';
     
                            return $btn;
                    })
                    ->rawColumns(['action','status'])
                    ->make(true);
        }
      

        return view('backend.employee.list');
    }
    
    public function add()
    {   
        $report = User::where('role_id',2)->get();
        $employeeCategory=EmployeeCategory::orderBy('category_name','ASC')->where('is_parient',0)->get();
        
        $role = Role::whereNotIn('id',[1,9])->get();
        $report_type = Role::whereNotIn('id',[1])->get();

        $department=Department::orderBy('department','ASC')->get();
        $salaryType=SalaryType::orderBy('salary_type','ASC')->get();
        $country=Country::orderBy('name','ASC')->get();
        $VendorCost=VendorCost::get();
        $allUsers=User::get();

        return view('backend.employee.add',['role'=>$role,'report'=>$report,
            'employeeCategory'=>$employeeCategory,'department'=>$department,'salaryType'=>$salaryType,'country'=>$country,'VendorCost'=>$VendorCost,'allUsers'=>$allUsers,'report_type'=>$report_type]);
    }

   

    public function profile()
    {
        return view('backend.employee.profile');
    }

    public function store(Request $request){
      

        $this->validate($request, [
            'alies_name'=> 'nullable|string|max:70',
            'first_name'=> 'required|string|max:48',
            'last_name'=> 'required|string|max:48',
            'middle_name'=> 'nullable|string|max:48',
            'email'=> 'required|unique:users,email|max:100',
            'gender'=> 'required|in:male,female',
            'marital_status'=> 'required|in:0,1',
            'married_date'=>'nullable|date|max:20',
            'mobile_number'=> 'nullable|string|max:15',
            'date_of_joining'=> 'required|date|max:15',
            'dob'=> 'nullable|date|max:15',
            'blood_group'=>'string|nullable|max:20',
            //'emergency_contact'=>'string|nullable|max:20',
            'designation'=> 'required|integer|exists:roles,id',
            'country'=> 'nullable|string',
            'current_address'=> 'nullable|string',
            'permanent_address'=> 'nullable|string',
            'employmentCategory'=> 'required|integer|exists:employee_categories,id',
            'employmentType'=> 'required|string|exists:employee_categories,id',
            'division'=> 'nullable|string|exists:departments,id',
            'payroll_frequency'=> 'required|string|exists:salary_types,salary_type',
            'shift_timing'=> 'nullable|max:100',
            'working_type'=> 'required|string',
             
            // 'wt_payrate'=> 'required_if:employmentCategory,==,1',
            // 'bill_rate'=> 'required_if:employmentCategory,==,1',
            // 'vendor_cost_id'=>'required_if:employmentCategory,==,1',
    
        ],[
                 'employmentType.exists' => 'Employment type does not exist.',
                 'role.exists' => 'Role does not exist.',
                 'report_to.exists' => 'Report to does not exist.',
                 'salary_type.exists' => 'Salary type to does not exist.'
        ]);
          
 
           $store=array(
             
            'alies_name'=>$request->alies_name,
            'role_id'=>$request->designation,
            'employment_category_id'=>$request->employmentCategory,
            'employment_type'=>$request->employmentType,
            'placement'=>$request->placement ?? 9,
            'report_to'=> $request->report_to,
            'salary_type'=> $request->payroll_frequency,
            'department'=> $request->division,
            'first_name'=>$request->first_name,
            'last_name'=> $request->last_name,
            'middle_name'=> $request->middle_name,
            'mobile_number'=> $request->mobile_number,
            'start_date'=>date("Y-m-d",strtotime($request->date_of_joining)),
            'role_id'=>$request->designation,
            'email'=> $request->email,
            'gender'=> $request->gender,
            'marital_status'=>$request->marital_status,
            'working_type'=> $request->working_type,
            'shift_timing'=> $request->shift_timing,
            'country'=> $request->country,
            'state'=> $request->state,
            'city'=> $request->city,
            'current_address'=>$request->current_address,
            'permanent_address'=>$request->permanent_address,
            'bill_rate'=>$request->bill_rate,
            'wt_payrate'=>$request->wt_payrate,
            'vendor_cost_id'=>$request->vendor_cost_id,
            'create_by'=>Auth::user()->id,
            'assign_recruiter'=>$request->assign_recruiter,
            'assign_recruiter_lead'=>$request->assign_recruiter_lead,
            'assign_delivery_manager'=>$request->assign_delivery_manager,
            'assign_bdm'=>$request->assign_bdm,
            'assign_vp'=>$request->assign_vp,
            'delivery_director'=>$request->delivery_director,
            'assign_account_manager'=>$request->assign_account_manager,
            'blood_group'=>$request->blood_group,
            'dob'=>$request->dob,
            'married_date'=>date("Y-m-d",strtotime($request->married_date)),
            //'emergency_contact'=>$request->emergency_contact,
            'create_by'=>Auth::user()->id,
            'account_status'=>1,
            'commission_type_account_manager'=>$request->commission_type_account_manager,
            'gross_pay'=>$request->gross_pay,
            'stipend_perdiem'=>$request->stipend_perdiem,
            );

          
           
          

            $vms_cost=VendorCost::where('id',$request->vendor_cost_id)->value('vms_cost');
            $over_loading_cost=Department::where('id',$request->division)->value('overloading_cost');

           //Calcualte Net Margin
       // if( !empty($request->bill_rate) && !empty($request->wt_payrate) && !empty($over_loading_cost)){
        $type =$request->employmentType;
             $store['net_margin'] = $this->net_margin_calculate($vms_cost, $request->bill_rate,
              $request->wt_payrate,$over_loading_cost, $request->stipend_perdiem, $request->gross_pay,$type);
      //  }
      
        

        $avatar_file = $request->file('profile_image');
        if ($avatar_file) {
              $avatar_old=Auth::user()->avatar;
            //Delete old image
                if(!empty($avatar_old)){
                    
                    $imageArr=explode("storage/user/",$avatar_old);
                    Storage::disk('user')->delete($imageArr);
                 }
            //update new image   
            $store['avatar'] = rand(1000, 9990) . date('ymd') . '.' . $avatar_file->getClientOriginalExtension();
            $avatar_file->storeAs('user',$store['avatar']);
            
        }

           $store['emp_id']= $this->generateEmployeeId();
           $store['password']= bcrypt($store['emp_id']);

        $insert=User::insert($store);
        if($insert){
           // $this->sendMail($store);
            return redirect('admin/employee')->with('success', 'Employee has been created ');
        }else{
            return redirect('admin/employee')->with('error', 'Failed to create employee ');
        }
    }

 public function edit(Request $request)
    {
          $report = User::where('role_id',2)->get();
        if(! isset($request->emp)){
            return Redirect::back()->with('error', 'Invalid employee please try again latter.');
            exit;
        }

        $data = User::where('emp_id',$request->emp)->first();
        if(empty($data)){
           return Redirect::back()->with('error', 'Invalid employee please try again latter.');
         exit;
        }

        $employeeCategory=EmployeeCategory::orderBy('category_name','ASC')->where('is_parient',0)->get();
        $department=Department::orderBy('department','ASC')->get();
        $salaryType=SalaryType::orderBy('salary_type','ASC')->get();
        $role = Role::whereNotIn('id',[1,9])->get();
        $country=Country::orderBy('name','ASC')->get();
        $VendorCost=VendorCost::get();
        $allUsers=User::get();
           $placement_type = Role::whereNotIn('id',[1])->get();
        return view('backend.employee.edit',['role'=>$role,'report'=>$report,'data'=>$data,
            'employeeCategory'=>$employeeCategory,'department'=>$department,'salaryType'=>$salaryType,'country'=>$country,'VendorCost'=>$VendorCost,'allUsers'=>$allUsers,'placement_type'=>$placement_type]);

    }
   public function update(Request $request){
   

          $this->validate($request, [
            'alies_name'=> 'nullable|string|max:70',
            'first_name'=> 'required|string|max:45',
            'last_name'=> 'required|string|max:45',
            'middle_name'=> 'nullable|string|max:45',
            'gender'=> 'required|in:male,female',
            'marital_status'=> 'nullable',
            'married_date'=>'string|nullable|max:20',
            'mobile_number'=> 'nullable|string|max:15',
            'date_of_joining'=> 'required|string|max:15',
            'dob'=> 'nullable|string|max:15',
            'blood_group'=>'string|nullable|max:20',
            'emergency_contact'=>'string|nullable|max:20',
            'role'=> 'required|integer|exists:roles,id',
            'country'=> 'nullable',
            'current_address'=> 'nullable|string',
            'permanent_address'=> 'nullable|string',
            'employmentCategory'=> 'required|integer|exists:employee_categories,id',
            'employmentType'=> 'required|string|exists:employee_categories,id',
            'division'=> 'nullable|string|exists:departments,id',
            'salary_type'=> 'required|string|exists:salary_types,salary_type',
            'shift_timing'=> 'nullable|max:100',
            'working_type'=> 'required|string',
        ],[
                 'employmentType.exists' => 'Employment type does not exist.',
                 'role.exists' => 'Role does not exist.',
                 'report_to.exists' => 'Report to does not exist.',
                 'salary_type.exists' => 'Salary type to does not exist.'
        ]);

           $store=array(
            'role_id'=>$request->role,
            'alies_name'=>$request->alies_name,
           'email'=>$request->email,
            'employment_category_id'=>$request->employmentCategory,
            'employment_type'=>$request->employmentType,
            //'report_to'=> $request->report_to,
            'salary_type'=> $request->salary_type,
            'department'=> $request->division,
            'first_name'=>$request->first_name,
            'last_name'=> $request->last_name,
            'middle_name'=> $request->middle_name,
            'mobile_number'=> $request->mobile_number,
            'gender'=> $request->gender,
            'marital_status'=>$request->marital_status,
            'working_type'=> $request->working_type,
            'shift_timing'=> $request->shift_timing,
            'country'=> $request->country,
            'state'=> $request->state,
            'city'=> $request->city,
            'current_address'=>$request->current_address,
             'permanent_address'=>$request->permanent_address,
             'start_date'=> date("Y-m-d",strtotime($request->date_of_joining)),
             'vendor_cost_id'=>$request->vendor_cost_id,
             'assign_recruiter'=>$request->assign_recruiter,
             'assign_recruiter_lead'=>$request->assign_recruiter_lead,
             'assign_delivery_manager'=>$request->assign_delivery_manager,
             'assign_bdm'=>$request->assign_bdm,
             'assign_vp'=>$request->assign_vp,
             'assign_account_manager'=>$request->assign_account_manager,
            'blood_group'=>$request->blood_group,
            'dob'=>$request->dob,
            'married_date'=>date("Y-m-d",strtotime($request->married_date)),
            'emergency_contact'=>$request->emergency_contact, 
            'commission_type_account_manager'=>$request->commission_type_account_manager,
            'stipend_perdiem'=>$request->stipend_perdiem,
            'gross_pay'=>$request->gross_pay,
            'bill_rate'=>$request->bill_rate,
             'wt_payrate'=>$request->wt_payrate,
            );
           

         if(isset($request->account_status)){
           $store['account_status']=$request->account_status;
         }

         $vms_cost=VendorCost::where('id',$request->vendor_cost_id)->value('vms_cost') ?? 0;
         //$store['vms_cost']=$vms_cost;
        
         $over_loading_cost=Department::where('id',$request->division)->value('overloading_cost');
        // $store['over_loading_cost']=$over_loading_cost;
          //Calcualte Net Margin
          $type =$request->employmentType;

            $store['net_margin'] = $this->net_margin_calculate($vms_cost, $request->bill_rate,
             $request->wt_payrate,$over_loading_cost, $request->stipend_perdiem, $request->gross_pay,$type);
      
    

         $avatar_file = $request->file('profile_image');
        if ($avatar_file) {
              $avatar_old=$request->old_avatar;
               if(!empty($avatar_old)){
                    $imageArr=explode("storage/user/",$avatar_old);
                    Storage::disk('user')->delete($imageArr);
                 }
            //update new image   
           $store['avatar'] = rand(1000, 9990).date('ymd'). '.' .$avatar_file->getClientOriginalExtension();
            $avatar_file->storeAs('user',$store['avatar']);
        }
       
        $update=User::where('id',$request->id)->update($store);
        if( $update==1){
         return Redirect::back()->with('success', 'Employee profile has been updated.');
        }else{
         return Redirect::back()->with('error', 'Failed to update  employee profile.');
        }
    }

    public function getNetMargin(Request  $request){
       
      $vms_cost=VendorCost::where('id',$request->vendor_cost_id)->value('vms_cost') ?? 0;
      $over_loading_cost=Department::where('id',$request->division)->value('overloading_cost');
      
       $net_margin = $this->net_margin_calculate($vms_cost, $request->bill_rate,
             $request->wt_payrate,$over_loading_cost, $request->stipend_perdiem, $request->gross_pay,$request->employmentType);
      
      echo $net_margin;
    }

    public function generateEmployeeId() {
        $num = User::get()->count();
        ++$num; // add 1;
        $len = strlen($num);
        for($i=$len; $i< 4; ++$i) {
           $num = '0'.$num;
        }
     
        return 'RSO'.rand(0, 999999).$num.date('y');
    }
    
    public function deleteProfileImage(Request $request){
        $avatar=User::where('emp_id',$request->emp_id)->value('avatar');
        if(!empty($avatar)){
            $imageArr=explode("storage/user/",$avatar);
            Storage::disk('user')->delete($imageArr); 
            $delete=User::where('emp_id',$request->emp_id)->update(['avatar'=>'']);
            return Redirect::back()->with('error', 'Delete image has been successfully.');
            exit;
        }

         return Redirect::back()->with('error', 'Failed to remove image.');
    }

      public function delete(Request $request){
       User::where('emp_id',$request->emp)->delete();
        
         return Redirect::back()->with('success', 'Employee has been deleted.');
    }

    function net_margin_calculate($vms_cost, $actualBillRate, $w2_payrate, $over_loading_cost, $stipend, $grosspay,$type){
       // $totalBillRate=$bill_rate;
      /*
          $after_disount=$bill_rate*$vms_cost;
          $before_discount=$bill_rate;
      */

          if($vms_cost !=0){
             $vms_cost=$actualBillRate*$vms_cost/100; //after discount
          }
      
          $w2_payrate= $w2_payrate ?? 0;
          $over_loading_cost= $over_loading_cost ?? 0;
          $stipend= $stipend ?? 0;
          $grosspay=$grosspay ?? 0;
       //if discount vms cost
       // if(!empty($vms_cost)){
       //     $totalBillRate= abs($bill_rate-$vms_cost);
       // }
      
         $overLoadingCost=$w2_payrate*$over_loading_cost/100; //3
         
        // $groospay=65;
        if($type=='6'){ //1099
            $net_margin= abs($actualBillRate-($vms_cost+$grosspay));
        }else{
            if($stipend !='' || $stipend !=0){
                $net_margin=abs($actualBillRate-($w2_payrate+$overLoadingCost+$stipend+$vms_cost));
              
            }else{
                $AftertotalOverLoadingCost=$w2_payrate+$overLoadingCost;
                $net_margin=abs($AftertotalOverLoadingCost-$actualBillRate);
            }
        }
        
       return $net_margin;
    }

 
   public function working_hour(Request $request)
    {

         if ($request->ajax()) {
             $data = WorkingHour::groupBy('user_id')->select('user_id', DB::raw('sum(working_hours) as working_hours'))->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                        ->editColumn('user_id', function ($row){
                       return  $row->user->first_name.' '.$row->user->last_name ?? '';
                    })
                        
                          ->addColumn('emp_id', function($row){     
                        return @$row->user->emp_id ?? '-';
                    })
                   ->addColumn('net_margin', function($row){     
                        return @$row->user->net_margin ?? '-';
                    })
                   // ->addColumn('commission', function($row){     
                   //      return $this->requestorCalculateComission($row->user_id, $row->working_hours);
                   //  })
                    ->rawColumns([''])
                    ->make(true);
        }
      
        return view('backend.employee.hour');
    }

    public function importHours() 
    {
        
        Excel::import(new WorkingHourImport,request()->file('working_hour_file'));

        return back();


    }



    function weekOfMonth($date) {
        //Get the first day of the month.
        $firstOfMonth = strtotime(date("Y-m-01", $date));

        //Apply above formula.
       $week= $this->weekOfYear($date) - $this->weekOfYear($firstOfMonth) + 1;
        return $week;
    }

    function weekOfYear($date) {
        $weekOfYear = intval(date("W", $date));
        if (date('n', $date) == "1" && $weekOfYear > 51) {
            // It's the last week of the previos year.
            return 0;
        }
        else if (date('n', $date) == "12" && $weekOfYear == 1) {
            // It's the first week of the next year.
            return 53;
        }
        else {
            // It's a "normal" week.
            return $weekOfYear;
        }
    }


//Show comission 
 public function allconsultentUser($internalEmpId){
     $commission=[];
     $teams = User::where('assign_recruiter',@$internalEmpId)->get();
     if(count($teams)>0){
        foreach($teams as $data){
              $hoursArr=$data['working_hours'];
               $hours= $hoursArr[0]['working_hours'] ?? 0;
             if($hours !=0){
                 $commission[]=$this->requestorCalculateComission($data->id, $hours);
             }
        }
     }

    return  $commission=array_sum($commission) ?? 0;
 }
   

public function view(Request $request)
    {
        $data = User::where('emp_id',@$request->emp)->first();
        if(empty($data)){
             return Redirect::back()->with('error','Failed to view profile');
            exit;
        }
        $education = Education::where('user_id',@$data->id)->get();
        $emergencyContact = EmergencyContact::where('user_id',@$data->id)->get();
        $workExperience = EmploymentDetails::where('user_id',$data->id)->get();
        $Attendance = Attendance::where('user_id',@$data->id)
        ->whereDate('created_at',date('Y-m-d'))->first();

        
          $commission=0;

            $todo=Todo::where('user_id',$data->id)->orderBy('id','DESC')->get();
            $teams=[];
            if($data->role_id==UserRole::DeliveryManager){
             $teams = User::where('assign_delivery_manager',@$data->id)->get();
            }elseif($data->role_id==UserRole::RecruiterLead){
                $commission_data=$this->recruiterLeadComission($data->id, date('m'));

                $commission='Total Commission: <span class="badge badge-success">'.round($commission_data['total_commission']).'</span>';

                $teams = User::where('assign_recruiter_lead',@$data->id)->get();
                
            }elseif($data->role_id==UserRole::Recruiter){
                $teams = User::where('assign_recruiter',@$data->id)->get();
                $commission_data=$this->recruiterCalculateComission($data->id,date('m'));
                 $commission='Total Commission: <span class="badge badge-success">'.round($commission_data['total_commission']).'</span>';
            }elseif($data->role_id==UserRole::AccountManager){
                $teams = User::where('assign_account_manager',@$data->id)->get();
                $direct_commission=$this->accountManagerDirectCommission($data->id, $month='');
                $indirect_commission=0;
            $commission='Direct commission: <span class="badge badge-success">'.round($direct_commission['total_commission']).'</span> 
            Indirect commission<span class="badge badge-success">'.$indirect_commission.'</span>';

            }elseif($data->role_id==UserRole::BDM){
                 $direct_commission=$this->bdmDirectCommission($data->id, $month='');
                $indirect_commission=0;
                $teams = User::where('assign_bdm',@$data->id)->get();
            }elseif($data->role_id==UserRole::VP){
                $teams = User::where('assign_vp',@$data->id)->get();
            }
     

        return view('backend.employee.view',['data'=>$data,'education'=>$education,'workExperience'=>$workExperience,'Attendance'=>$Attendance,'todo'=>$todo,'teams'=>$teams,'commission'=>$commission,'emergencyContact'=>$emergencyContact]);
    }

   
    
    public function addEmergency(Request $request){

        $this->validate($request, [
            'name'=> 'required',
            'relation_type'=> 'required',
            'contact_number'=> 'required',
        ]);

        $store=array(
            'user_id'=> $request->user_id,
            'name'=>$request->name,
            'relation_type'=>$request->relation_type,
            'contact_number'=>$request->contact_number,
        );

        $insert=EmergencyContact::create($store);

        if($insert){
           return Redirect::back()->with('success', 'Emergency Contact has been updated ');
        }else{
            return Redirect::back()->with('error', 'Failed to update emergency contact ');
        }

    }
   
    public function updateEmergency(Request $request){
        $this->validate($request, [
            'name'=> 'required',
            'relation_type'=> 'required',
            'contact_number'=> 'required',
        ]);

        $store=array(
            'name'=>$request->name,
            'relation_type'=>$request->relation_type,
            'contact_number'=>$request->contact_number,
        );
       

        $insert=EmergencyContact::where('id',$request->id)->update($store);

        if($insert==1){
           return Redirect::back()->with('success', 'Emergency Contact has been updated');
        }else{
            return Redirect::back()->with('error', 'Failed to update emergency contact');
        }
        
    }
    

       public function editEmergencyContact(Request $request){
         $data=EmergencyContact::where('id',$request->id)->first();
         return response()->json($data);       
      }
    public function deleteEmergency(Request $request){
        $delete = EmergencyContact::where('id',$request->id)->delete();
           if($delete==1){
            return Redirect::back()->with('success', 'Emergency Contact has been deleted ');
        }else{
            return Redirect::back()->with('error', 'Failed to deleteemergency contact ');
        }
        
    }

public function currency(){
        $curl = curl_init();
        curl_setopt_array($curl, [
        CURLOPT_URL => "https://currency-converter5.p.rapidapi.com/currency/convert?format=json&from=USD&to=INR&amount=1",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
        "X-RapidAPI-Host: currency-converter5.p.rapidapi.com",
        "X-RapidAPI-Key: 523f05d4ddmsh0a5b5e51364b46ap12975ejsn95a528313698"
        ],
        ]);

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            echo $response;
        }
    }

    
 public function sendMail($data){
    $email=$data['email'];
    $data['message']='';
    $mail=   Mail::send('mail.welcome',['data'=>$data], function($message) use($email){
        $message->to($email);
        $message->subject('Welcome to RAISSO HRMS');
    });

    return $mail;
}



}
