<x-backend-layout>
   <x-slot name='title'>Employee</x-slot>
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                     <li class="breadcrumb-item active"><a href="#">Employees</a> </li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <form action="{{ route('admin.employee.update') }}" id="employee_form" method="post" enctype="multipart/form-data">
         @csrf
         <input type="hidden" name="id" value="{{$data->id}}">
         <!-- Main content -->
         <section class="content">
            <div class="container-fluid">
               <div class="row">
                  <!-- /.col -->
                  <div class="col-md-9">
                     @if (session('success'))
                     <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                     </div>
                     @endif
                     @if (session('error'))
                     <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true"><i class="fa fa-close"></i></span>
                        </button>
                     </div>
                     @endif
                     <div class="col-sm-12">
                        <!-- About Me Box -->
                        <div class="card">
                           <div class="card-header">
                              <h3 class="card-title">General Information</h3>
                              <a class="btn btn-primary float-sm-right" href="{{route('admin.employee')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to  Employees

                              </a>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                              

                                 <div class="form-group col-md-4">
                                    <label>Employee Id <span class="text-danger">*</span></label>
                                    <input type="text" name="emp_id" class="form-control" placeholder="Enter first name" value="{{ $data->emp_id }}" readonly>
                                    @if ($errors->has('emp_id'))
                                    <div class="error">{{ $errors->first('emp_id') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="{{ $data->first_name }}">
                                    @if ($errors->has('first_name'))
                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Middle Name </label>
                                    <input type="text" name="middle_name" value="{{ $data->middle_name }}" class="form-control" placeholder="Enter middle name">
                                    @if ($errors->has('middle_name'))
                                    <div class="error">{{ $errors->first('middle_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" value="{{$data->last_name}}" class="form-control" placeholder="Enter last name">
                                    @if ($errors->has('last_name'))
                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Alies name </label>
                                    <input type="text" name="alies_name" class="form-control" placeholder="Enter alies name" value="{{ $data->alies_name }}">
                                    @if ($errors->has('alies_name'))
                                    <div class="error">{{ $errors->first('alies_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ $data->email }}" >
                                    @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Gender <span class="text-danger">*</span></label>
                                    <br>
                                    <label class="radio-inline"><input type="radio" name="gender" value="male" @if($data->gender == 'male')checked @endif> Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female" @if($data->gender == 'female')checked @endif> Female</label>
                                    @if ($errors->has('gender'))
                                    <div class="error">{{ $errors->first('gender') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Marital status </label>
                                    <br>
                                    <label class="radio-inline"><input type="radio" name="marital_status" value="1" class="merried_status" @if($data->marital_status == '1')checked @endif> Married</label>
                                    <label class="radio-inline"><input type="radio" name="marital_status" value="0" class="merried_status" @if($data->marital_status == '0')checked @endif> Unmarried</label>
                                    @if ($errors->has('marital_status'))
                                    <div class="error">{{ $errors->first('marital_status') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4" id="date_of_marriage" @if($data->marital_status==0) style="display: none;"@endif>
                                 <label>Date of marriage </label>
                                 <input type="text" name="married_date" value="{{ $data->married_date }}" class="form-control"  >
                                 @if ($errors->has('married_date'))
                                 <div class="error">{{ $errors->first('married_date') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Mobile Number </label>
                                 <input type="text" name="mobile_number" value="{{$data->mobile_number}}" class="form-control" placeholder="Enter mobile number" >
                                 @if ($errors->has('mobile_number'))
                                 <div class="error">{{ $errors->first('mobile_number') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Date Of Joining <span class="text-danger">*</span></label>
                                 <input type="text" name="date_of_joining"  value="{{ date('d-m-Y', strtotime($data->start_date)) }}" class="form-control" placeholder="Enter Joining date"  onfocus="this.type='date'">
                                 @if ($errors->has('date_of_joining'))
                                 <div class="error">{{ $errors->first('date_of_joining') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Date of Birth </label>
                                 <input type="text" name="dob" value="{{ $data->dob }}" class="form-control"  onfocus="this.type='date'">
                                 @if ($errors->has('dob'))
                                 <div class="error">{{ $errors->first('dob') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Blood Group </label>
                                 <input type="text" name="blood_group" value="{{ $data->blood_group }}" class="form-control"  >
                                 @if ($errors->has('blood_group'))
                                 <div class="error">{{ $errors->first('blood_group') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Emergency contact No </label>
                                 <input type="text" name="emergency_contact" value="{{ $data->emergency_contact }}" class="form-control"  placeholder="Emergency contact">
                                 @if ($errors->has('emergency_contact'))
                                 <div class="error">{{ $errors->first('emergency_contact') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Designation <span class="text-danger">*</span></label>
                                 <select class="form-control" name="role" id="designation">
                                    <option value="" selected>Select Designation</option>
                                    @if(count($role)>0)
                                    @foreach($role as $roledata)
                                    <option value="{{$roledata->id}}" @if($data->role_id == $roledata->id)selected @endif> {{$roledata->role_name}}</option>
                                    @endforeach
                                    @endif
                                 </select>
                                 @if ($errors->has('role'))
                                 <div class="error">{{ $errors->first('role') }}</div>
                                 @endif
                              </div>
                              @if(Auth::user()->role_id !=2)
                              <div class="form-group col-md-4">
                                 <label>Account Status </label>
                                 <select class="form-control select2" name="account_status" >
                                    <option value="">Select Account Status</option>
                                    <option value="1" @if($data->account_status==1) selected @endif>Active</option>
                                    <option value="0" @if($data->account_status==0) selected @endif>Inactive</option>
                                 </select>
                                 @if ($errors->has('status'))
                                 <div class="error">{{ $errors->first('status') }}</div>
                                 @endif
                              </div>
                              @endif
                           </div>
                        </div>
                        <!-- /.card-body -->
                     </div>
                     <!-- /.card-header -->
                  </div>
                  <!-- /.card -->
                  <!--Location/Address-->
                  <div class="col-sm-12">
                     <div class="card card">
                        <div class="card-header">
                           <h3 class="card-title">Location/Address</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="row">
                              <div class="form-group col-md-12">
                                 <label>Countries</label>
                                 <select class="form-control select2" name="country" id="country">
                                    <option value="" selected>Select Country</option>
                                    @if(count($country)>0)
                                    @foreach($country as $countryData)
                                    <option value="{{$countryData->name}}" @if($data->country == $countryData->name)selected @endif>{{ $countryData->name }}</option>
                                    @endforeach
                                    @endif
                                 </select>
                                 @if ($errors->has('country'))
                                 <div class="error">{{ $errors->first('country') }}</div>
                                 @endif
                              </div>
                              <!-- <div class="form-group col-md-4">
                                 <label>State</label>
                                 <select class="form-control select2" name="state" id="state">
                                    <option value="">Select State</option>
                                    @if($data->state !='')  
                                    <option value="{{$data->state}}" selected>{{$data->state}}</option>
                                    @else
                                    <option value="" selected>Select State</option>
                                    @endif
                                 </select>
                                 @if ($errors->has('state'))
                                 <div class="error">{{ $errors->first('state') }}</div>
                                 @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                 <label>City </label>
                                 <select class="form-control select2" name="city" id="city">
                                    <option value="">Select City</option>
                                    @if($data->city !='')  
                                    <option value="{{$data->city}}" selected>{{$data->city}}</option>
                                    @else
                                    <option value="" selected>Select City</option>
                                    @endif
                                 </select>
                                 @if ($errors->has('city'))
                                 <div class="error">{{ $errors->first('city') }}</div>
                                 @endif
                                 </div> -->
                              <div class="form-group col-md-6">
                                 <label>Current Address</label>
                                 <textarea class="form-control" name="current_address" placeholder="Current Address" va>
                                 {{ $data->current_address }}
                                 </textarea>
                                 @if ($errors->has('current_address'))
                                 <div class="error">{{ $errors->first('current_address') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-6">
                                 <label>Permanent Address</label>
                                 <textarea class="form-control" name="permanent_address" placeholder="Permanent Address">
                                 {{ $data->permanent_address }}

                                 </textarea>
                                 @if ($errors->has('permanent_address'))
                                 <div class="error">{{ $errors->first('permanent_address') }}</div>
                                 @endif
                              </div>
                           </div>
                           <!--/.row-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <!--/.card-body-->
                  </div>
                  <div class="col-sm-12">
                     <div class="card card">
                        <div class="card-header">
                           <h3 class="card-title">Employment Section</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="row">
                              <div class="form-group col-md-6">
                                 <label>Employment Category <span class="text-danger">*</span></label>
                                 <select class="form-control" name="employmentCategory" id="employmentCategory">
                                    <option value="" selected>Select Employment</option>
                                    @if(count($employeeCategory)>0)
                                    @foreach($employeeCategory as $empCateData)
                                    <option value="{{$empCateData->id}}"  @if($data->employment_category_id == $empCateData->id)selected @endif>{{$empCateData->category_name}}</option>
                                    @endforeach
                                    @endif
                                 </select>
                                 @if ($errors->has('employmentCategory'))
                                 <div class="error">{{ $errors->first('employmentCategory') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-6">
                                 <label>Employment Type <span class="text-danger">*</span></label>
                                 <select class="form-control "  name="employmentType"  id="employmentType">
                                    @if(!empty($data->employment_type))
                                    <option value="{{@$data->employementtype->id}}">{{@$data->employementtype->category_name}}</option>
                                    @else
                                    <option value="">Select employement type</option>
                                    @endif
                                 </select>
                                 @if ($errors->has('employmentType'))
                                 <div class="error">{{ $errors->first('employmentType') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-6">
                                 <label>Division </label>
                                 <select class="form-control" name="division" id="division">
                                    <option value="" >Select Division</option>
                                    @if(count($department)>0)
                                    @foreach($department as $departmentData)
                                    <option value="{{$departmentData->id}}" 
                                    @if($data->department == $departmentData->id) selected @endif>
                                    {{$departmentData->department}}</option>
                                    @endforeach
                                    @endif
                                 </select>
                                 @if ($errors->has('division'))
                                 <div class="error">{{ $errors->first('division') }}</div>
                                 @endif
                              </div>

                              <div class="form-group col-md-6">
                                 <label>Payroll frequency <span class="text-danger">*</span></label>
                                 <select class="form-control" name="salary_type"  id="payroll_frequency">
                                    <option value="" >Select payroll frequency</option>
                                    @if(!empty($data->salary_type))
                                    <option value="{{$data->salary_type}}"  selected>{{$data->salary_type}}</option>
                                    @endif
                                 </select>
                                 @if ($errors->has('salary_type'))
                                 <div class="error">{{ $errors->first('salary_type') }}</div>
                                 @endif
                              </div>
                              
                              <div class="form-group col-md-12">
                                 <label>Working Type <span class="text-danger">*</span></label>
                                 <select class="form-control" name="working_type">
                                    <option value="" >Select Working Type</option>
                                    <option value="REMOTE" @if($data->working_type == 'REMOTE')selected @endif>REMOTE</option>
                                    <option value="ONSITE" @if($data->working_type == 'ONSITE')selected @endif>ONSITE</option>
                                    <option value="HYBRID" @if($data->working_type == 'HYBRID')selected @endif>HYBRID</option>
                                 </select>
                                 @if ($errors->has('working_type'))
                                 <div class="error">{{ $errors->first('working_type') }}</div>
                                 @endif
                              </div>
                              <div class="col-md-6">
                                    <div class="form-label-group outline">
                                       <input type="time" name="shift_timing" value="{{old('shift_timing',$data->shift_timing)}}" class="form-control shadow-none ">
                                       <span><label for="email">Shift Start Time</label></span>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-label-group outline">
                                       <input type="time" name="shift_end_time" value="{{old('shift_end_time',$data->shift_end_time)}}" class="form-control shadow-none ">
                                       <span><label for="email">Shift End Time</label></span>
                                       </div>
                                    </div>

                           </div>
                           <!--/.row-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <!--/.card-body-->
                  </div>
                  <div class="col-sm-12">
                     <div class="card card">
                        <div class="card-header">
                           <h3 class="card-title">Assign Placement</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="row">
                              <div class="form-group col-md-4" id="assign_recruiter">
                                 <label>Assign Recruiter </label>
                                 <select class="form-control select2" name="assign_recruiter" >
                                    <option value="" >Select Report to</option>
                                    @foreach ($allUsers as $allUser)
                                    @if($allUser->role_id == 5)
                                    <option value="{{$allUser->id}}" @if($data->assign_recruiter == $allUser->id)selected @endif >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                    @endif 
                                    @endforeach
                                 </select>
                                 @if ($errors->has('report_to'))
                                 <div class="error">{{ $errors->first('report_to') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4" id="assign_recruiter_lead">
                                 <label>Assign Recruiter Lead </label>
                                 <select class="form-control select2" name="assign_recruiter_lead" >
                                    <option value="" >Select Report to</option>
                                    @foreach ($allUsers as $allUser)
                                    @if($allUser->role_id == 4)
                                    <option value="{{$allUser->id}}" @if($data->assign_recruiter_lead == $allUser->id)selected @endif >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                    @endif 
                                    @endforeach
                                 </select>
                                 @if ($errors->has('report_to'))
                                 <div class="error">{{ $errors->first('report_to') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4" id="assign_delivery_manager">
                                 <label>Assign Delivery Manager </label>
                                 <select class="form-control select2" name="assign_delivery_manager" >
                                    <option value="" >Select Report to</option>
                                    @foreach ($allUsers as $allUser)
                                    @if($allUser->role_id == 3)
                                    <option value="{{$allUser->id}}" @if($data->assign_delivery_manager == $allUser->id)selected @endif >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                    @endif 
                                    @endforeach
                                 </select>
                                 @if ($errors->has('report_to'))
                                 <div class="error">{{ $errors->first('report_to') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4" id="assign_bdm">
                                 <label>Assign BDM </label>
                                 <select class="form-control select2" name="assign_bdm" >
                                    <option value="" >Select Report to</option>
                                    @foreach ($allUsers as $allUser)
                                    @if($allUser->role_id == 7)
                                    <option value="{{$allUser->id}}" @if($data->assign_bdm == $allUser->id)selected @endif >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                    @endif 
                                    @endforeach
                                 </select>
                                 @if ($errors->has('report_to'))
                                 <div class="error">{{ $errors->first('report_to') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4" id="assign_vp">
                                 <label>Assign VP </label>
                                 <select class="form-control select2" name="assign_vp" >
                                    <option value="" >Select Report to</option>
                                    @foreach ($allUsers as $allUser)
                                    @if($allUser->role_id == 8)
                                    <option value="{{$allUser->id}}" @if($data->assign_vp == $allUser->id)selected @endif >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                    @endif 
                                    @endforeach
                                 </select>
                                 @if ($errors->has('report_to'))
                                 <div class="error">{{ $errors->first('report_to') }}</div>
                                 @endif
                              </div>
                              <div class="form-group col-md-4" id="a_m">
                                 <label>Assign Account Manager </label>
                                 <select class="form-control select2" name="assign_account_manager" id="assign_account_manager">
                                    <option value="" >Select Report to</option>
                                    @foreach ($allUsers as $allUser)
                                    @if($allUser->role_id == 6)
                                    <option value="{{$allUser->id}}" @if($data->assign_account_manager == $allUser->id)selected @endif >{{$allUser->first_name}} {{$allUser->last_name}}</option>
                                    @endif 
                                    @endforeach
                                 </select>
                                 @if ($errors->has('report_to'))
                                 <div class="error">{{ $errors->first('report_to') }}</div>
                                 @endif
                              </div>

                              <div class="form-group col-md-12" id="accout_manager_commission_type"  @if(empty($data->assign_account_manager)) style="display: none;" @endif>
                                     <label> Account Manager Commission Type </label>
                                     <br>
                                    <input type="radio" name="commission_type_account_manager" id="direct_commission" value="1" @if($data->commission_type_account_manager==1) checked @endif>
                                    <label>Direct Commission </label>
                                    <input type="radio" name="commission_type_account_manager" id="indirect_commission" value="0" @if($data->commission_type_account_manager==0) checked @endif>
                                    <label>Indirect Commission </label>   
                                 </div>

                           </div>
                           <!--/.row-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <!--/.card-body-->
                  </div>
                  <div class="col-sm-12" id="rate_section" @if($data->role_id !='11')style="display:none" @endif>
                     <div class="card card">
                        <div class="card-header">
                           <h3 class="card-title">Rate</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                           <div class="row">
                              <div class="form-group col-md-4">
                                 <label>VMS  </label>
                                 <select class="form-control select2 calculate"  name="vendor_cost_id" id="vms_cost">
                                    <option value="" selected>Select VMS </option>
                                    @if(count($VendorCost)>0)
                                    @foreach($VendorCost as $vcost)
                                    <option value="{{$vcost->id}}"  @if($data->vendor_cost_id==$vcost->id) selected @endif>{{$vcost->vms}} </option>
                                    @endforeach
                                    @endif
                                 </select>
                              </div>
                              <div class="form-group col-md-4">
                                 <label>Bill Rate</label>
                                 <input type="text" id="bill_rate" name="bill_rate" class="form-control calculate" value="{{ $data->bill_rate }}">
                                 @if ($errors->has('bill_rate'))
                                 <div class="error">{{ $errors->first('bill_rate') }}</div>
                                 @endif
                              </div>
                                  <div class="form-group col-md-4">
                                    <label>Gross Pay Rate</label>
                                    <input type="text" id="gross_pay" name="gross_pay" class="form-control calculate" value="{{ $data->gross_pay }}">
                                    @if ($errors->has('gross_pay'))
                                    <div class="error">{{ $errors->first('gross_pay') }}</div>
                                    @endif
                                 </div>
                              <div class="form-group col-md-4">
                                 <label>W2 Hourly Pay Rate</label>
                                 <input type="text" id="w2_pay_rate" name="wt_payrate" class="form-control calculate" value="{{ $data->wt_payrate }}">
                                 @if ($errors->has('wt_payrate'))
                                 <div class="error">{{ $errors->first('wt_payrate') }}</div>
                                 @endif
                              </div>

                              <div class="form-group col-md-4">
                                     <label>Stipend/Per Diem</label>
                                    <input type="text" id="stipend_perdiem" name="stipend_perdiem" class="form-control calculate" value="{{ $data->stipend_perdiem }}">
                                    @if ($errors->has('stipend_perdiem'))
                                    <div class="error">{{ $errors->first('stipend_perdiem') }}</div>
                                    @endif
                                 </div>

                              <div class="form-group col-md-4">
                                 <label>Net Margin</label>
                                 <input type="text" name="net_margin" id="net_margin" readonly class="form-control" value="{{ $data->net_margin }}">
                              </div>
                           </div>
                           <!--/.row-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <!--/.card-body-->
                  </div>
               </div>
               <!-- /.col -->
               <!--Right Sidebar-->
               <div class="col-md-3">
                  <input type="hidden" name="old_avatar" value="{{$data->avatar}}">
                  <div class="card card-primary card-outline">
                     <div class="card-body box-profile">
                        <div class="text-center">
                           @if(!empty($data->avatar))
                           <img  onerror="this.src = '{{asset('images/dummy-profile.png')}}';" class="profile-user-img img-fluid img-circle" id="preview_image" src="{{url('storage/app/user/'.$data->avatar)}}" height="90" alt="User profile picture">
                           @else
                           <img onerror="this.src = '{{asset('images/dummy-profile.png')}}';" class="profile-user-img img-fluid img-circle" id="preview_image" src="{{asset('images/dummy-profile.png')}}" height="90" alt="User profile picture">
                           @endif
                        </div>
                        <p class="text-muted text-center">Profile Image</p>
                        <div class="error profile_image_error"></div>
                        @if(!empty($data->avatar))    
                        <a href="{{route('admin.employee.remove-image',['emp_id'=>$data->emp_id])}}" class="btn btn-danger btn-block profile-img-remove-btn" ><i class="fa fa-trash" aria-hidden="true"></i> <b>Remove Image</b></a>
                        @else
                        <div class="btn_upload">
                           <input type="file" name="profile_image" id="profile_image" accept="image/png, image/jpeg, image/gif" height="70" width="70">
                           <a href="#" class="btn btn-primary btn-block profile-img-upload-btn"><i class="fa fa-camera" aria-hidden="true"></i> <b>Upload Image</b></a>
                        </div>
                        <a href="#" class="btn btn-danger btn-block profile-img-remove-btn" style="display:none"><i class="fa fa-trash" aria-hidden="true" ></i> <b>Remove Image</b></a>
                        @endif
                     </div>
                     <div class="card-footer">
                        <button type="submit" class="btn btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-primary float-sm-right">Save Changes</button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
   </section>
   <!-- /.content -->
   </form>
   </div>
   </div>
</x-backend-layout>
<script type="text/javascript">

 $("#division").change(function() {
           var department_id = $("#division").val();
           
           $.post(
           '{{ url('/salary-type') }}',
           {
           _token: '{{ csrf_token() }}',
           department_id : department_id,
           },
           function(data) {
           var listitems='<option value="" selected>Payroll frequency </option>';
           var data =  JSON.parse(data)
           console.log(data);
               var select = $("#payroll_frequency");
               $.each(data, function(key, value) {
                    
                     listitems += '<option value=' + value['salary_type'] + '>' + value['salary_type'] + '</option>';
               });
         
               select.html(listitems);
         
           }
           );
         });


</script>