<x-backend-layout>
   <x-slot name='title'>Add Employee</x-slot>
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Add Employee </li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <form action="{{ route('admin.employee.create') }}" method="post" enctype="multipart/form-data">
         @csrf
         <!-- Main content -->
         <section class="content">
            <div class="container">
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
                        <div class="card card">
                           <div class="card-header">
                              <h3 class="card-title">General Information</h3>
                             <a class="btn btn-primary float-sm-right" href="{{route('admin.employee')}}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to  Employees

                              </a>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                              
                             
                                 <div class="form-group col-md-4">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="{{ old('first_name') }}">
                                    @if ($errors->has('first_name'))
                                    <div class="error">{{ $errors->first('first_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Middle Name </label>
                                    <input type="text" name="middle_name" value="{{ old('middle_name') }}" class="form-control" placeholder="Enter middle name">
                                    @if ($errors->has('middle_name'))
                                    <div class="error">{{ $errors->first('middle_name') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Enter last name">
                                    @if ($errors->has('last_name'))
                                    <div class="error">{{ $errors->first('last_name') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Alies name</label>
                                    <input type="text" name="alies_name" class="form-control" placeholder="Enter alies name" value="{{ old('alies_name') }}">
                                    @if ($errors->has('alies_name'))
                                    <div class="error">{{ $errors->first('alies_name') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" name="email" class="form-control" placeholder="Enter email" value="{{ old('email') }}">
                                    @if ($errors->has('email'))
                                    <div class="error">{{ $errors->first('email') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Gender <span class="text-danger">*</span></label>
                                    <br>
                                    <label class="radio-inline"><input type="radio" name="gender" value="male" @if(old('gender') == 'male')checked @endif> Male</label>
                                    <label class="radio-inline"><input type="radio" name="gender" value="female" @if(old('gender') == 'female')checked @endif> Female</label>
                                    @if ($errors->has('gender'))
                                    <div class="error">{{ $errors->first('gender') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Marital status </label>
                                    <br>
                                    <label class="radio-inline"><input type="radio" name="marital_status" class="merried_status" value="1" @if(old('marital_status') == '1')checked @endif> Married</label>
                                    
                                    <label class="radio-inline"><input type="radio" name="marital_status" value="0" @if(old('marital_status') == '0')checked @endif class="merried_status" checked> Unmarried</label>
                                    @if ($errors->has('marital_status'))
                                    <div class="error">{{ $errors->first('marital_status') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4" id="date_of_marriage" style="display: none;">
                                    <label>Date of marriage </label>
                                    
                                     <input type="text" name="married_date" placeholder="Enter date of marriage" value="{{ old('married_date') }}" class="form-control"  onfocus="this.type='date'" >
                                   
                                    @if ($errors->has('married_date'))
                                    <div class="error">{{ $errors->first('married_date') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Mobile Number </label>
                                    <input type="text" name="mobile_number" value="{{ old('mobile_number') }}" class="form-control" placeholder="Enter mobile number" >
                                    @if ($errors->has('mobile_number'))
                                    <div class="error">{{ $errors->first('mobile_number') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Date of Joining <span class="text-danger">*</span></label>
                                    <input type="text" name="date_of_joining" 
                                    @if(old('date_of_joining') !='') value="{{ old('date_of_joining') }}" @else value="{{ date('d-m-Y') }}" @endif class="form-control" placeholder="Enter date of joining"  onfocus="this.type='date'">
                                    @if ($errors->has('date_of_joining'))
                                    <div class="error">{{ $errors->first('date_of_joining') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Date of Birth </label>
                                    <input type="text" name="dob" placeholder="Enter date of birth" value="{{ old('dob') }}" class="form-control"   onfocus="this.type='date'">
                                    @if ($errors->has('dob'))
                                    <div class="error">{{ $errors->first('dob') }}</div>
                                    @endif
                                 </div>
                                  <div class="form-group col-md-4">
                                    <label>Blood Group </label>
                                    <input type="text" name="blood_group" placeholder="Enter blood group" value="{{ old('blood_group') }}" class="form-control"  >
                                    @if ($errors->has('blood_group'))
                                    <div class="error">{{ $errors->first('blood_group') }}</div>
                                    @endif
                                 </div>

                                 <!-- <div class="form-group col-md-4">
                                    <label>Emergency contact No </label>
                                    <input type="text" name="emergency_contact" value="{{ old('emergency_contact') }}" class="form-control"  placeholder="Emergency contact">
                                    @if ($errors->has('emergency_contact'))
                                    <div class="error">{{ $errors->first('emergency_contact') }}</div>
                                    @endif
                                 </div> -->

                                 <div class="form-group col-md-4">
                                    <label>Designation <span class="text-danger">*</span></label>
                                    <select class="form-control select2"  id="designation" name="designation">
                                       <option value="" selected>Select Designation</option>
                                       @if(count($role)>0)
                                       @foreach($role as $roledata)
                                       <option value="{{$roledata->id}}" @if(old('designation') == $roledata->id)selected @endif> {{$roledata->role_name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    @if ($errors->has('designation'))
                                    <div class="error">{{ $errors->first('designation') }}</div>
                                    @endif
                                 </div>
                              </div>
                           </div>
                           <!-- /.card-body -->
                           <div class="card-footer">
                           </div>
                        </div>
                        <!-- /.card-header -->
                     </div>
                     <!-- /.card -->
                     <!--Location Address-->
                     <div class="col-sm-12">
                        <div class="card">
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
                                       <option value="{{$countryData->name}}" @if(old('country') == $countryData->name)selected @endif>{{ $countryData->name }}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    @if ($errors->has('country'))
                                    <div class="error">{{ $errors->first('country') }}</div>
                                    @endif
                                 </div>
                                <!--  <div class="form-group col-md-4">
                                    <label>State</label>
                                    <select class="form-control select2" name="state" id="state">
                                       <option value="">Select State</option>
                                       @if(old('state') !='')  
                                       <option value="{{old('state')}}" selected>{{old('employmentType')}}</option>
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
                                       @if(old('city') !='')  
                                       <option value="{{old('city')}}" selected>{{old('city')}}</option>
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
                                    <textarea class="form-control" rows="2" cols="20" name="current_address" placeholder="Enter Current Address">
                                        {{ old('current_address') }}
                                     </textarea>
                                    @if ($errors->has('current_address'))
                                    <div class="error">{{ $errors->first('current_address') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label>Permanent Address</label>
                                    <textarea class="form-control" rows="2" cols="20" name="permanent_address" placeholder="Enter Permanent Address">
                                    {{ old('permanent_address') }}
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
                     <!--/.Location Address-->
                     <div class="col-sm-12">
                        <div class="card card">
                           <div class="card-header">
                              <h3 class="card-title">Employement Section</h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                                 <div class="form-group col-md-6">
                                    <label>Employment Category <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="employmentCategory" id="employmentCategory">
                                       <option value="" selected>Select Employment</option>
                                       @if(count($employeeCategory)>0)
                                       @foreach($employeeCategory as $empCateData)
                                       <option value="{{$empCateData->id}}" @if(old('employmentCategory') == $empCateData->id)selected @endif>{{$empCateData->category_name}}</option>
                                       @endforeach
                                       @endif
                                    </select>
                                    @if ($errors->has('employmentCategory'))
                                    <div class="error">{{ $errors->first('employmentCategory') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-6">
                                    <label>Employment Type <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="employmentType" id="employmentType">
                                       @if(old('employmentType') !='')  
                                       <option value="{{old('employmentType')}}" selected>{{old('employmentType')}}</option>
                                       @else
                                       <option value="" >Select Employment Type</option>
                                       @endif
                                    </select>
                                    @if ($errors->has('employmentType'))
                                    <div class="error">{{ $errors->first('employmentType') }}</div>
                                    @endif
                                 </div>
                                   <div class="form-group col-md-6">
                                    <label>Division </label>
                                    <select class="form-control select2" id="division" name="division">
                                       <option value="" >Select Division</option>
                                       @if(count($department)>0)
                                       @foreach($department as $departmentData)
                                       <option value="{{$departmentData->id}}" 
                                       @if(old('division')== $departmentData->id) selected @endif>
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
                                    <select class="form-control " name="payroll_frequency" id="payroll_frequency">
                                     
                                       
                                    </select>
                                    @if ($errors->has('payroll_frequency'))
                                    <div class="error">{{ $errors->first('payroll_frequency') }}</div>
                                    @endif
                                 </div>
                               
                                 <div class="form-group col-md-12">
                                    <label>Working Mode <span class="text-danger">*</span></label>
                                    <select class="form-control select2" name="working_type">
                                       <option value="" >Select Working Mode</option>
                                       <option value="REMOTE" @if(old('working_type') == 'REMOTE')selected @endif>REMOTE</option>
                                       <option value="ONSITE" @if(old('working_type') == 'ONSITE')selected @endif>ONSITE</option>
                                       <option value="HYBRID" @if(old('working_type') == 'HYBRID')selected @endif>HYBRID</option>
                                    </select>
                                    @if ($errors->has('working_type'))
                                    <div class="error">{{ $errors->first('working_type') }}</div>
                                    @endif
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-label-group outline">
                                       <input type="time" name="shift_timing" value="{{old('shift_timing')}}" class="form-control shadow-none ">
                                       <span><label for="email">Shift Start Time</label></span>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-label-group outline">
                                       <input type="time" name="shift_end_time" value="{{old('shift_end_timing')}}" class="form-control shadow-none ">
                                       <span><label for="email">Shift End Timing</label></span>
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
                                    <label>Recruiter </label>
                                    <select class="form-control select2" name="assign_recruiter" >
                                       <option value="" >Select assign recruiter</option>
                                       @foreach ($allUsers as $recruiter)
                                       @if($recruiter->role_id == 5)
                                          <option value="{{$recruiter->id}}" @if(old('assign_recruiter')==$recruiter->id) selected @endif>{{$recruiter->first_name}} {{$recruiter->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_recruiter'))
                                    <div class="error">{{ $errors->first('assign_recruiter') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4" id="assign_recruiter_lead">
                                    <label>Recruiter Lead </label>
                                    <select class="form-control select2" name="assign_recruiter_lead" >
                                       <option value="" >Select Report to</option>
                                       @foreach ($allUsers as $rl)
                                       @if($rl->role_id == 4)
                                       <option value="{{$rl->id}}" @if(old('assign_recruiter_lead')==$rl->id) selected @endif>{{$rl->first_name}} {{$rl->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_recruiter_lead'))
                                    <div class="error">{{ $errors->first('assign_recruiter_lead') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4" id="assign_delivery_manager">
                                    <label>Delivery Manager </label>
                                    <select class="form-control select2" name="assign_delivery_manager" >
                                       <option value="" >Select Delivery Manager</option>
                                       @foreach ($allUsers as $dm)
                                       @if($dm->role_id == 3)
                                       <option value="{{$dm->id}}" @if(old('assign_delivery_manager')==$dm->id) selected @endif>{{$dm->first_name}} {{$dm->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_delivery_manager'))
                                    <div class="error">{{ $errors->first('assign_delivery_manager') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4" id="delivery_director">
                                    <label>Delivery Director </label>
                                    <select class="form-control select2" name="delivery_director" >
                                       <option value="" >Select Delivery Director</option>
                                       @foreach ($allUsers as $dd)
                                       @if($dd->role_id == 14)
                                             <option value="{{$dd->id}}" @if(old('delivery_director')==$dd->id) selected @endif>
                                                {{$dd->first_name}} {{$dd->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('delivery_director'))
                                    <div class="error">{{ $errors->first('delivery_director') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4" id="assign_bdm">
                                    <label>BDM </label>
                                    <select class="form-control select2" name="assign_bdm" >
                                       <option value="" >Select Assign BDM</option>
                                       @foreach ($allUsers as $bdm)
                                       @if($bdm->role_id == 7)
                                       <option value="{{$bdm->id}}" @if(old('assign_bdm')==$bdm->id) selected @endif>{{$bdm->first_name}} {{$bdm->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_bdm'))
                                    <div class="error">{{ $errors->first('assign_bdm') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4" id="assign_vp">
                                    <label>Vice president </label>
                                    <select class="form-control select2" name="assign_vp" >
                                       <option value="" >Select VP</option>
                                       @foreach ($allUsers as $vp)
                                       @if($vp->role_id == 8)
                                       <option value="{{$vp->id}}" @if(old('assign_vp')==$vp->id) selected @endif>
                                          {{$vp->first_name}} {{$vp->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_vp'))
                                    <div class="error">{{ $errors->first('assign_vp') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4" id="a_m">
                                    <label> Account Manager </label>
                                    <select class="form-control select2" name="assign_account_manager" id="assign_account_manager">
                                       <option value="" >Select Account Manager</option>
                                       @foreach ($allUsers as $am)
                                       @if($am->role_id == 6)
                                          <option value="{{$am->id}}" @if(old('assign_account_manager')==$am->id) selected @endif>{{$am->first_name}} {{$am->last_name}}</option>
                                       @endif 
                                       @endforeach
                                    </select>
                                    @if ($errors->has('assign_account_manager'))
                                    <div class="error">{{ $errors->first('assign_account_manager') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-12" id="accout_manager_commission_type" style="display: none;" >
                                     <label> Account Manager Commission Type </label>
                                     <br>
                                    <input type="radio" name="commission_type_account_manager" id="direct_commission" value="1" checked>
                                    <label>Direct Commission </label>
                                    <input type="radio" name="commission_type_account_manager" id="indirect_commission" value="0" >
                                    <label>Indirect Commission </label>   
                                 </div>
                              </div>
                              <!--/.row-->
                           </div>
                           <!--/.card-body-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <!--/.col-sm-12-->
                     <div class="col-sm-12" id="rate_section">
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
                                       <option value="{{$vcost->id}}" @if(old('vendor_cost_id')==$vcost->id) selected @endif>{{$vcost->vms}} ({{$vcost->vms_cost}})%</option>
                                       @endforeach
                                       @endif
                                    </select>
                                     @if ($errors->has('vendor_cost_id'))
                                    <div class="error">{{ $errors->first('vendor_cost_id') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Bill Rate</label>
                                    <input type="text" id="bill_rate" name="bill_rate" class="form-control calculate" value="{{ old('bill_rate') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    @if ($errors->has('bill_rate'))
                                    <div class="error">{{ $errors->first('bill_rate') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>Gross Pay Rate</label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="gross_pay" name="gross_pay" class="form-control calculate" value="{{ old('gross_pay') }}">
                                    @if ($errors->has('gross_pay'))
                                    <div class="error">{{ $errors->first('gross_pay') }}</div>
                                    @endif
                                 </div>
                                 <div class="form-group col-md-4">
                                    <label>W2 Pay Rate</label>
                                    <input type="text" id="w2_pay_rate" name="wt_payrate" class="calculate form-control" value="{{ old('wt_payrate') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    @if ($errors->has('wt_payrate'))
                                    <div class="error">{{ $errors->first('wt_payrate') }}</div>
                                    @endif
                                 </div>

                                 <div class="form-group col-md-4">
                                    <label>Stipend/Per Diem</label>
                                    <input type="text" id="stipend_perdiem" name="stipend_perdiem" class="form-control" value="{{ old('stipend_perdiem') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                                    @if ($errors->has('stipend_perdiem'))
                                    <div class="error">{{ $errors->first('stipend_perdiem') }}</div>
                                    @endif
                                 </div>

                                
                              <div class="form-group col-md-4">
                                 <label>Net Margin</label>
                                 <input type="text" name="net_margin" id="net_margin" readonly class="form-control" value="">
                              </div>

                                
                              </div>
                              <!--/.row-->
                           </div>
                           <!--/.card-body-->
                        </div>
                        <!--/.card-body-->
                     </div>
                     <!--/.col-sm-12-->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-3">
                     <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                           <div class="text-center">
                              <img class="profile-user-img img-fluid img-circle" id="preview_image" src="{{asset('images/dummy-profile.png')}}" alt="User profile picture">
                           </div>
                           <p class="text-muted text-center">Profile Image</p>
                           <div class="error profile_image_error"></div>
                           <div class="btn_upload">
                              <input type="file" name="profile_image" id="profile_image" accept="image/png, image/jpeg, image/gif" height="90" >
                              <a href="#" class="btn btn-primary btn-block profile-img-upload-btn"><i class="fa fa-camera" aria-hidden="true"></i> <b>Upload Image</b></a>
                           </div>
                           <a href="#" class="btn btn-danger btn-block profile-img-remove-btn" style="display: none;"><i class="fa fa-trash" aria-hidden="true"></i> <b>Remove Image</b></a>
                        </div>
                        <div class="card-footer">
                           <a href="{{url('admin/employee/add')}}"  class="btn btn-danger">Cancel</a>
                           <button type="submit" class="btn btn-primary float-sm-right">Save Changes</button>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
         </section>
      </form>
      <!-- /.content -->
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