<x-backend-layout>
   <x-slot name='title'>Employee</x-slot>
   <div class="content-wrapper" style="min-height: 1604.44px;">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Employee Profile</li>
                  </ol>
               </div>
            </div>
         </div>
      </section>
      <style type="text/css">
         .card-header:first-child {
         border-radius: calc(0.25rem - 1px) calc(0.25rem - 1px) 0 0;
         background: white;
         }
      </style>
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-sm-12">
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
               </div>
               <div class="col-md-2">
                  <div class="card empprofileimage" style="background: white; height: 278px;">
                     @if(empty($data->avatar))
                     <img class="emp_side_profileiamge img-circle" src="{{asset('images/dummy-profile.png')}}"  >
                     @else
                     <img class="emp_side_profileiamge img-circle" onerror="this.src = '{{asset('images/dummy-profile.png')}}';"  src="{{url('storage/app/user/'.$data->avatar)}}" alt="Employee profile picture" >
                     @endif
                  </div>
               </div>
               <div class="col-md-10">
                  <div class="card">
                     <div class="card-header emp_profile_card_header">
                        @php
                        $attendence= \App\Models\Attendance::where('user_id',Auth::user()->id)->whereDate('punch_in',date('Y-m-d'))->first();
                        $punch_in= $attendence->punch_in ?? 0;
                        $punch_out=$attendence->punch_out ?? 0; 
                        $user_id=Crypt::encryptString(Auth::user()->id);
                        @endphp
                        <h3 class="card-title col-sm-12 "><strong>{{ ucwords($data->first_name) }} {{ ucwords($data->last_name) }}</strong></h3>
                        <ul class="profilebar" style="margin: 0;
                           padding: 0;
                           font-size: 13px;">
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ $data->city ?? '-' }}</li>
                           <li><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ $data->email ?? '-' }}</li>
                           <li><i class="fa fa-phone"></i> {{ $data->mobile_number ?? '99999 00000' }}</li>
                        </ul>
                     </div>
                     <div class="card-body clearfix">
                        <ul class="users-list clearfix">
                           <li>
                              <strong>EMPLOYEE NUMBER</strong>
                              <span class="users-list-date">{{ $data->emp_id }}</span>
                           </li>
                           <li>
                              <strong>JOB TITLE</strong>
                              <span class="users-list-date">{{ $data->role->role_name ?? '-' }}</span>
                           </li>
                           <li>
                              <strong>DEPARTMENT</strong>
                              <span class="users-list-date">{{ $data->department_name->department ?? '-' }}</span>
                           </li>
                           <li>
                              <strong>DATE OF JOINING</strong>
                              <span class="users-list-date">{{ date("d/m/Y",strtotime($data->start_date)) ?? '-' }}</span>
                           </li>
                        </ul>
                     </div>
                     <div class="card-footer emp_profile_card_header">
                        <ul class="nav nav-pills">
                           <li class="nav-item"><a class="nav-link " >ABOUT</a></li>
                           <li class="nav-item"><a class="nav-link" href="{{route('admin.employee.document',['id'=>$data->emp_id])}}" >DOCUMENT</a></li>
                           <li class="nav-item"><a class="nav-link" href="{{route('admin.employee.edit',['emp'=>$data->emp_id])}}" >EDIT PROFILE</a></li>
                           <li class="nav-item"><a class="nav-link" href="{{route('employee.apply-leave',['emp'=>$data->emp_id])}}" >APPLY LEAVE</a></li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <!--Profissional-->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">
                           Professional summary
                        </h3>
                     </div>
                     <div class="card-body">
                        <p>Hii there !</p>
                        <p>you have not added Professional summary.</p>
                     </div>
                  </div>
                  <!--Contact Details-->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">
                           Contact Details
                        </h3>
                     </div>
                     <div class="card-body clearfix">
                        @if($data->mobile_number=='')
                        <p><i class="fa fa-phone"></i> {{$data->mobile_number}}</p>
                        @endif
                        <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{$data->email}}</p>
                        <strong><i class="fa fa-map-marker mr-1"></i> Current Address</strong>
                        <p class="text-muted">
                           {{$data->current_address}}
                        </p>
                        <hr>
                        <strong><i class="fa fa-map-marker mr-1"></i> Permanent Address</strong>
                        <p class="text-muted">
                           {{$data->permanent_address}}
                        </p>
                        <hr>
                     </div>
                  </div>
                  <!--Education-->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">
                           Education <a href="" data-toggle="modal" data-target="#addEducation"><i class="fa fa-plus"></i></a>
                        </h3>
                     </div>
                     <div class="card-body clearfix">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">
                           @if(count($education)>0)
                           @foreach($education as $eduData)
                           <li>
                              <span class="text">Studied at {{$eduData->board_of_education}} {{$eduData->qualification}} , {{date("Y",strtotime($eduData->start_date)) }} to {{date("Y",strtotime($eduData->end_date)) }} </span>
                              <div class="tools">
                                 <a href="#" data-id="{{$eduData->id}}" class="editEmpEducation" data-toggle="tooltip" data-placement="top" title="Edit!">  <i class="fas fa-edit"></i></a>
                              </div>
                           </li>
                           @endforeach
                           @endif
                        </ul>
                     </div>
                  </div>
                  <!--Emergency Contact-->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">
                           Emergency Contacts <a href="" data-toggle="modal" data-target="#addEmergency"><i class="fa fa-plus"></i></a>
                        </h3>
                     </div>
                     <div class="card-body clearfix">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">
                           @if(count($emergencyContact)>0)
                           @foreach($emergencyContact as $emergencyData)
                           <li>
                              <span class="text">{{$emergencyData->name}},({{$emergencyData->relation_type}}),{{$emergencyData->contact_number}}</span> 
                              <div class="tools">
                                 <a href="#" data-id="{{$emergencyData->id}}" class="editEmergencyContact" data-toggle="tooltip" data-placement="top" title="Edit!">  <i class="fas fa-edit"></i></a> 
                                 <a href="{{route('employee.emergency-contact.delete',['id'=>$emergencyData->id])}}">
                                 <i class="fa fa-trash"></i></a>
                              </div>
                           </li>
                           @endforeach
                           @endif
                        </ul>
                     </div>
                  </div>
               </div>
               <!--//lef-side--> 
               <!--Right-side-->  
                <div class="col-md-6">
               @if($data->role_id==11)
              
                  <!--Attendece-->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">
                           Net Margin
                        </h3>
                     </div>
                     <div class="card-body">
                       
                       <span class="badge badge-primary">{{ $data->net_margin }}</span>
                     </div>
                  </div>
                  @endif
                  <!--Attendece-->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">
                           Attendance
                        </h3>
                     </div>
                     <div class="card-body">
                        @if(Auth::user()->id !=$data->id)
                        @if(!empty($Attendance))
                        <button class="btn btn-default">
                        <img src="{{asset('images/login.svg')}}" > {{ date("H:i A",strtotime($Attendance->punch_in)) }}
                        </button>
                        <button class="btn btn-success">
                        @if(empty($Attendance->punch_out))  
                        <img src="{{asset('images/logOut.svg')}}" > Punch Out
                        @else
                        <img src="{{asset('images/logOut.svg')}}"> {{ date("H:i A",strtotime($Attendance->punch_out)) }}
                        @endif
                        </button>
                        @else
                        <button class="btn btn-warning">On leave
                        </button>
                        @endif
                        @else
                        <a @if(!empty($punch_in)) class="btn btn-default disabled" href="#" @else class="btn btn-success"   @endif href="{{route('employee.attendance.punch-in')}}"> <i class="fa fa-sign-in" aria-hidden="true" ></i>  Punch In</a></li>
                        <a  @if(empty($punch_out) && !empty($punch_in)) href="{{route('employee.attendance.punch-out')}}" class="btn btn-success" @else class="btn  btn-default disabled"  href="#"  @endif  ><i class="fa fa-sign-out" aria-hidden="true"></i> Punch Out</a>
                        @endif
                     </div>
                  </div>
                  <!--Assing Teams-->
                  @if(! empty($data->assign_vp) && ! empty($data->assign_delivery_manager) && ! empty($data->assign_recruiter_lead) && ! empty($data->assign_recruiter) && ! empty($data->assign_account_manager) && ! empty($data->assign_bdm))
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Asigned Teams</h3>
                        <div class="card-tools">
                        </div>
                     </div>
                     <div class="card-body p-0">
                        <ul class="users-list clearfix">
                           @if(!empty($data->assign_vp))
                           <li>
                              <img onerror="this.src = '{{asset('images/dummy-profile.png')}}';"  src="{{url('storage/app/user/'.$data->assignVp->avatar)}}" alt="User Image" class="team_member_image">
                              <a class="users-list-name" href="#">Mr. {{$data->assignVp->first_name}}
                              {{$data->assignVp->last_name}}</a>
                              <span class="users-list-date">VP</span>
                           </li>
                           @endif
                           @if(!empty($data->assign_delivery_manager))
                           <li>
                              <img onerror="this.src = '{{asset('images/dummy-profile.png')}}';"  src="{{url('storage/app/user/'.$data->assignDeliveryManager->avatar)}}" alt="User Image" class="team_member_image">
                              <a class="users-list-name" href="#">Mr. {{$data->assignDeliveryManager->first_name}}
                              {{$data->assignDeliveryManager->last_name}}</a>
                              <span class="users-list-date">Delivery Manager</span>
                           </li>
                           @endif

                           @if(!empty($data->assign_recruiter_lead))
                           <li>
                              <img onerror="this.src = '{{asset('images/dummy-profile.png')}}';"  src="{{url('storage/app/user/'.$data->assignRecruiterLead->avatar)}}" alt="User Image" class="team_member_image">
                              <a class="users-list-name" href="#">Mr. {{$data->assignRecruiterLead->first_name}}
                              {{$data->assignRecruiterLead->last_name}}</a>
                              <span class="users-list-date">Recruiter Lead</span>
                           </li>
                           @endif

                           @if(!empty($data->assign_recruiter))
                           <li>
                              <img onerror="this.src = '{{asset('images/dummy-profile.png')}}';"  src="{{url('storage/app/user/'.$data->assignRecruiter->avatar)}}" alt="User Image" class="team_member_image">
                              <a class="users-list-name" href="#">Mr. {{$data->assignRecruiter->first_name}}
                              {{$data->assignVp->last_name}}</a>
                              <span class="users-list-date">Recruiter</span>
                           </li>
                           @endif
                           @if(!empty($data->assign_account_manager))
                           <li>
                              <img onerror="this.src = '{{asset('images/dummy-profile.png')}}';"  src="{{url('storage/app/user/'.$data->assignAccountManager->avatar)}}" alt="User Image" class="team_member_image">
                              <a class="users-list-name" href="#">Mr. {{$data->assignAccountManager->first_name}}
                              {{$data->assignAccountManager->last_name}}</a>
                              <span class="users-list-date">Account Manager</span>
                           </li>
                           @endif
                           @if(!empty($data->assign_bdm))
                           <li>
                              <img onerror="this.src = '{{asset('images/dummy-profile.png')}}';"  src="{{url('storage/app/user/'.$data->assignBdm->avatar)}}" alt="User Image" class="team_member_image">
                              <a class="users-list-name" href="#">Mr. {{$data->assignBdm->first_name}}
                              {{$data->assignBdm->last_name}}</a>
                              <span class="users-list-date">BDM</span>
                           </li>
                           @endif
                        </ul>
                     </div>
                  </div>
                  @else
                  @if(count($teams)>0)
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Asigned Teams</h3>
                     </div>
                     <div class="card-body p-0">
                        <ul class="users-list clearfix">
                           @foreach($teams as $teamsData)
                           <li>
                              <img onerror="this.src = '{{asset('images/dummy-profile.png')}}';" src="{{url('storage/app/user/'.$teamsData->avatar)}}" alt="User Image" class="team_member_image">
                              <a class="users-list-name" href="#">Mr. {{ $teamsData->first_name }}
                              {{ $teamsData->last_name }}</a>
                              <span class="users-list-date">{{$teamsData->role->role_name ?? '' }}</span>
                           </li>
                           @endforeach
                        </ul>
                     </div>
                  </div>
                  @endif
                  @endif
                  <!--Commission-->
                  @if($data->role_id==3 || $data->role_id==4 || $data->role_id==5 || $data->role_id==6 || $data->role_id==7 || $data->role_id==8)
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">
                           Commission
                        </h3>
                     </div>
                     <div class="card-body">
                        <?php echo $commission; ?>
                     </div>
                  </div>
                  @endif
                  <!--Work Experience-->
                  <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">
                           Work Experience <a href="" data-toggle="modal" data-target="#addEmployement"><i class="fa fa-plus"></i></a>
                        </h3>
                     </div>
                     <div class="card-body clearfix">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">
                           @if(count($workExperience)>0)
                           @foreach($workExperience as $workdata)  
                           <li>
                              <span class="text">@if($workdata->currently_work_here==1)Former @endif {{$workdata->job_title}} at {{$workdata->company_name}} From {{$workdata->location}}</span>
                              <div class="tools">
                                 <a href="#" data-id="{{$workdata->id}}" class="editEmpEmployement" data-toggle="tooltip" data-placement="top" title="Edit!"><i class="fas fa-edit"></i>
                                 </a>
                              </div>
                           </li>
                           @endforeach
                           @endif
                        </ul>
                     </div>
                  </div>
                  <!--TOdo-->
                  <div class="card">
                     <div class="card-header ui-sortable-handle" style="cursor: move;">
                        <h3 class="card-title">
                           <i class="ion ion-clipboard mr-1"></i>
                           To Do List
                        </h3>
                     </div>
                     <div class="card-body">
                        <ul class="todo-list ui-sortable" data-widget="todo-list">
                           @if(count($todo)>0)
                           @foreach($todo as $todo_data)
                           <li>
                              <span class="handle ui-sortable-handle">
                              <i class="fas fa-ellipsis-v"></i>
                              <i class="fas fa-ellipsis-v"></i>
                              </span>
                              <span class="text">{{ $todo_data->comment}}</span>
                              <small class="badge badge-danger">
                              <i class="far fa-clock"></i> {{date("d-m H:i",strtotime($todo_data->created_at))}}</small>
                           </li>
                           @endforeach
                           @endif
                        </ul>
                     </div>
                  </div>
               </div>
               <!--lef-side-->  
            </div>
         </div>
      </section>
   </div>
   <!--Education Add-->
   <div class="modal fade" id="addEducation" tabindex="-1" role="dialog" aria-labelledby="addEducation" aria-hidden="true">
      <form action="{{route('admin.employee.education.create')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Add your school or university </h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="user_id" class="form-control" placeholder="Enter User Id" value="{{ $data->id }}">
                  <div class="row">
                     <div class="form-group col-md-12">
                        <label>Qualification Name<span class="text-danger">*</span></label>
                        <input type="text" name="qualification" class="form-control" placeholder="Qualification Name" value="">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Start date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date" value="" class="form-control" placeholder="Start date">
                     </div>
                     <div class="form-group col-md-6">
                        <label>End date <span class="text-danger">*</span></label>
                        <input type="date" name="end_date" value="" class="form-control" placeholder="End date">
                     </div>
                     <div class="form-group col-md-12">
                        <label>Board of education <span class="text-danger">*</span></label>
                        <input type="text" name="board_of_education" class="form-control" placeholder="Enter board of education name" value="">
                     </div>
                     <div class="form-group col-md-8">
                        <label>Upload Documents <span class="text-danger">*</span></label>
                        <input type="file" name="upload_documents"  class="form-control" placeholder="Upload Documents">
                        <input type="hidden" name="old_document" class="form-control" placeholder="Upload Documents">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <!--Education edit-->
   <div class="modal fade" id="educationEditEmp" tabindex="-1" role="dialog" aria-labelledby="educationEditEmp" aria-hidden="true">
      <form action="{{route('admin.employee.education.update')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Edit your school or university</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" id="edu_id" name="id"  class="form-control" placeholder="Enter User Id" >
                  <div class="row">
                     <div class="form-group col-md-12">
                        <label>Qualification Name<span class="text-danger">*</span></label>
                        <input type="text" id="qualification" name="qualification" class="form-control" placeholder="Qualification Name" >
                     </div>
                     <div class="form-group col-md-6">
                        <label>Start date <span class="text-danger">*</span></label>
                        <input type="text" id="start_date"  name="start_date" value="" class="form-control" placeholder="Start date" onfocus="changeDateInput(this)">
                     </div>
                     <div class="form-group col-md-6">
                        <label>End date <span class="text-danger">*</span></label>
                        <input  type="text" id="end_date" name="end_date" value="" class="form-control" placeholder="End date" onfocus="changeDateInput(this)">
                     </div>
                     <div class="form-group col-md-12">
                        <label>Board of education <span class="text-danger">*</span></label>
                        <input type="text" id="board_of_education" name="board_of_education" class="form-control" placeholder="Enter board of education name" value="">
                     </div>
                     <div class="form-group col-md-8">
                        <label>Upload Documents <span class="text-danger">*</span></label>
                        <input type="file" name="upload_documents" value="" class="form-control" placeholder="Upload Documents">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   </div>
   <!--Employement Add-->
   <div class="modal fade" id="addEmployement" tabindex="-1" role="dialog" aria-labelledby="addEmployement" aria-hidden="true">
      <form action="{{route('admin.employee.employment.create')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Work Experience</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="user_id" class="form-control" placeholder="Enter User Id" value="{{ $data->id }}">
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label>Job title<span class="text-danger">*</span></label>
                        <input type="text" name="job_title" value="" class="form-control" placeholder="Enter job title">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="">
                     </div>
                     <div class="form-group col-md-12">
                        <label>Location <span class="text-danger">*</span></label>
                        <input type="text" name="location" class="form-control" placeholder="Enter location" value="">
                     </div>
                     <div class="form-group col-md-12">
                        <label>Currently Work Here</label>
                        <label class="switch">
                        <input type="checkbox" class="currently_work_here" name="currently_work_here"  id="currently_work_here">
                        <span class="slider round"></span>
                        </label>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Start date <span class="text-danger">*</span></label>
                        <input type="date" name="start_date"  class="form-control" placeholder="Start date">
                     </div>
                     <div class="form-group col-md-6 employement_end_date" >
                        <label>End date </label>
                        <input type="date" name="end_date" id="end_date" class="form-control" placeholder="End date">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <!--Employement Edit-->
   <div class="modal fade" id="editEmployement" tabindex="-1" role="dialog" aria-labelledby="addEmployement" aria-hidden="true">
      <form action="{{route('admin.employee.employment.update')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Work Experience edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="user_id" class="form-control" placeholder="Enter User Id" value="{{ $data->id }}">
                  <input type="hidden" name="id" id="id" class="form-control" >
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label>Job title<span class="text-danger">*</span></label>
                        <input type="text" name="job_title" id="job_title" class="form-control" placeholder="Enter job title">
                     </div>
                     <div class="form-group col-md-6">
                        <label>Company Name <span class="text-danger">*</span></label>
                        <input type="text" name="company_name" id="company_name" class="form-control" placeholder="Company Name" >
                     </div>
                     <div class="form-group col-md-12">
                        <label>Location <span class="text-danger">*</span></label>
                        <input type="text" name="location" id="location" class="form-control" placeholder="Enter location" value="">
                     </div>
                     <div class="form-group col-md-12">
                        <label>Currently Work Here</label>
                        <label class="switch">
                        <input type="checkbox" class="currently_work_here" name="currently_work_here"  id="currently_work_here">
                        <span class="slider round"></span>
                        </label>
                     </div>
                     <div class="form-group col-md-6">
                        <label>Start date <span class="text-danger">*</span></label>
                        <input type="text" name="start_date" id="work_start_date"  class="form-control" placeholder="Start date" onfocus="changeDateInput(this)">
                     </div>
                     <div class="form-group col-md-6 employement_end_date">
                        <label>End date </label>
                        <input type="text" name="end_date" id="work_end_date" class="form-control" placeholder="End date" onfocus="changeDateInput(this)">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   @include('backend.employee.emergency-contact')
</x-backend-layout>