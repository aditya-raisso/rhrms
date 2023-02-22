<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Auth;
use DB;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
    'id','avatar','emp_id','first_name','last_name','middle_name','gender','email','email_verified_at','password','mobile_number','report_to','department','designation','start_date','end_date','reason_for_resignation','working_type','shift_timing','marital_status','country','state','city','salary_type','pincode','current_address','employment_category_id','employment_type','permanent_address','role_id','type','account_status','deleted_at','bill_rate','vendor_cost_id','wt_payrate','net_margin','placement','create_by','assign_delivery_manager','assign_recruiter_lead','assign_recruiter','assign_account_manager','assign_bdm',
    'assign_vp','blood_group','dob','married_date','emergency_contact','commission_type_account_manager','alies_name','stipned','gross_pay','delivery_director','stipend_perdiem','shift_end_time',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function getFirstNamettribute($value)
    {
        return ucwords($value);
    }

    public function getLastNamettribute($value)
    {
         return ucwords($value);
    }
      public function role()
      {
          return $this->belongsTo('App\Models\Role','role_id','id');
      }

     public function create_by()
      {
          return $this->belongsTo('App\Models\User','create_by','id');
      }

       public function report()
      {
          return $this->belongsTo('App\Models\User','report_to','id');
      }

       public function employementtype()
      {
          return $this->belongsTo('App\Models\EmployeeCategory','employment_type','id');
      }

      //   public function salarytype()
      // {
      //     return $this->belongsTo('App\Models\SalaryType','salary_type','id');
      // }

    public function attendence(){
          return $this->belongsTo(Attendance::class,'user_id','id')->whereDate('punch_in',date('Y-m-d'));

    }

     public function reportTo(){
          return $this->belongsTo(User::class,'report_to','id')->select('first_name','last_name');
    }

     public function assignDeliveryManager(){
          return $this->belongsTo(User::class,'assign_delivery_manager','id')->select('first_name','last_name','avatar');
    }
    
     public function assignRecruiterLead(){
          return $this->belongsTo(User::class,'assign_recruiter_lead','id')->select('first_name','last_name','avatar');
    }
    
     public function assignRecruiter(){
          return $this->belongsTo(User::class,'assign_recruiter','id')->select('first_name','last_name','avatar');
    }
    
     public function assignAccountManager(){
          return $this->belongsTo(User::class,'assign_account_manager','id')->select('first_name','last_name','avatar');
    }

      public function assignBdm(){
          return $this->belongsTo(User::class,'assign_bdm','id')->select('first_name','last_name','avatar');
    }
    
     public function assignVp(){
          return $this->belongsTo(User::class,'assign_vp','id')->select('first_name','last_name','avatar');
    }

      public function consultent()
      {
          return $this->hasMany(User::class,'assign_recruiter','id')->whereMonth('start_date',date('m'))->where('account_status',1);
      }

    
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department_name(){
       return $this->belongsTo(Department::class,'department','id');
    }
    
    //Lead commission
    public function working_hours(){
         return $this->hasMany(WorkingHour::class,'user_id','id')->select(DB::raw('sum(working_hours) as working_hours'))->whereMonth('start_date',date('m'))->groupBy('user_id');

    }
   
    

}
