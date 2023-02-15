<x-backend-layout>
   <x-slot name='title'>Dashboard</x-slot>
   <style type="text/css">
      ul.profilebar{
      list-style: none;
      }
      ul.profilebar li{
      float: left;
      padding: 8px 18px;
      }
      ul.prf-details{
      list-style: none;
      }
      ul.prf-details li {
      float: left;
      padding: 3px 21px;
      font-weight: 600;
      }
      ul.prf-details li span{
      font-size: 14px;
      font-weight: 400;
      }
      .button-success{
      background-color: #20d45e;
      }
      a.disabled {
      pointer-events: none;
      cursor: default;
      }
   </style>
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <!-- /.col -->
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{url('admin')}}">Home</a></li>
                     <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
               </div>
               <!-- /.col -->
            </div>
            <!-- /.row -->
         </div>
         <!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->
      <!-- Admin Main content -->
      @if(Auth::user()->role_id==1)
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
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
            </div>
            <!-- Small boxes (Stat box) -->
            <div class="row">
               <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-success">
                     <div class="inner">
                        <h3>{{count($Attendance)}}</h3>
                        <p>Today Present Employees</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-users"></i>
                     </div>
                     <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-danger">
                     <div class="inner">
                        <h3>{{ count($employees)-count($Attendance)  }}</h3>
                        <p>Today Absent Employees</p>
                     </div>
                     <div class="icon">
                        <i class="fa fa-users"></i>
                     </div>
                     <a href="{{url('employee/attendance')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
               <div class="col-lg-4 col-6">
                  <!-- small box -->
                  <div class="small-box bg-warning">
                     <div class="inner">
                        <h3>{{ count($employees) }}</h3>
                        <p>Total Employees</p>
                     </div>
                     <div class="icon">
                        <i class="icon fa fa-users"></i>
                     </div>
                     <a href="{{url('employee/attendance')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                  </div>
               </div>
               <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <!-- /.row (main row) -->
         <!--    <div class="row">
               <section class="col-lg-7 connectedSortable ui-sortable">
                  <div class="card direct-chat direct-chat-primary">
                     <div class="card-header ui-sortable-handle " style="cursor: move;">
                        <h3 class="card-title">Commission Calculater</h3>
                        
                     </div>
                     <div class="card-body">
                          <p id="total_comission"></p>
                     </div>
                     <div class="card-footer">
                        <form action="#" method="post">
                             <div class="form-group">
                              <label>Select Employee</label>
                                <select class="form-control" id="user_id" name="user">
                                 @if(count($employees)>0)
                                 @foreach($employees as $empdata)
                                   <option value="{{$empdata->id}}">{{$empdata->first_name}}{{$empdata->last_name}}</option>
                                   @endforeach
                                   @endif
                                </select>
                              </div>
                              <div class="form-group">
                                 <label>Working Hours</label>
                              <input type="text" id="hours" name="hours" placeholder="Enter net working hours" class="form-control">
                              </div>

                              <button class="btn btn-primary" type="button" id="Calculater">Submit</button>

                              
                          
                        </form>
                     </div>
                  </div>
               </section>
               <section class="col-lg-5 connectedSortable ui-sortable"></section>
            </div> -->
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
      @endif
      @if(Auth::user()->role_id !=1)
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-lg-12">
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
            </div>
            <div class="row">
               <div class="col-md-3">
                  <div class="card card-primary card-outline">
                     <div class="card-body box-profile">
                        <div class="text-center">
            
                           @if(!empty(Auth::user()->avatar))
                           <img class="profile-user-img img-fluid img-circle" id="preview_image" src="{{url('storage/app/user/'.Auth::user()->avatar)}}" height="90" alt="User profile picture">
                           @else
                           <img class="profile-user-img img-fluid img-circle" id="preview_image" src="{{asset('images/dummy-profile.png')}}" height="90" alt="User profile picture">
                           @endif
                        </div>
                        <h3 class="profile-username text-center">{{ ucwords(Auth::user()->first_name) }} {{ ucwords(Auth::user()->middle_name) }} {{ ucwords(Auth::user()->last_name) }}</h3>
                        <p class="text-muted text-center">{{ Auth::user()->designation }}</p>
                     </div>
                  </div>
               </div>
               <div class="col-md-9">
                  @php
                  $attendence= \App\Models\Attendance::where('user_id',Auth::user()->id)->whereDate('punch_in',date('Y-m-d'))->first();
                  $punch_in= $attendence->punch_in ?? 0;
                  $punch_out=$attendence->punch_out ?? 0; 
                  $user_id=Crypt::encryptString(Auth::user()->id);
                  @endphp
                  <div class="card">
                     <div class="col-sm-12">
                        <ul class="profilebar">
                           <li><i class="fa fa-map-marker" aria-hidden="true"></i> {{ Auth::user()->city ?? '-' }}</li>
                           <li><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ Auth::user()->email ?? '-' }}</li>
                           <li><i class="fa fa-phone"></i> {{ Auth::user()->mobile_number ?? '-' }}</li>
                           <li><a @if(!empty($punch_in)) class="btn btn-block btn-default disabled" href="#" @else class="btn btn-success"   @endif href="{{route('employee.attendance.punch-in')}}"> <i class="fa fa-sign-in" aria-hidden="true" ></i> Punch In</a></li>
                           <li><a  @if(empty($punch_out) && !empty($punch_in)) href="{{route('employee.attendance.punch-out')}}" class="btn btn-success" @else class="btn btn-block btn-default disabled"  href="#"  @endif  ><i class="fa fa-sign-out" aria-hidden="true"></i> Punch Out</a></li>
                        </ul>
                     </div>
                     <hr>
                     <div class="col-sm-12">
                        <ul class="prf-details">
                           <li>EMPLOYEE NUMBER <br><span>{{Auth::user()->emp_id}}</span></li>
                           <li>JOB TITLE  <br><span>{{ Auth::user()->designation }}</span></li>
                           <li>DEPARTMENT  <br><span>{{ Auth::user()->department }}</span></li>
                           <li>REPORT TO  <br><span>{{ Auth::user()->reportTo->first_name ?? '' }} {{ Auth::user()->reportTo->last_name ?? '' }}</span></li>
                        </ul>
                     </div>
                     <div class="card-header p-2">
                        <ul class="nav nav-pills">
                           <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">ABOUT</a></li>
                           <li class="nav-item"><a class="nav-link" href="{{route('employee.edit',['emp'=>$user_id])}}">PROFILE</a></li>
                           <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">JOB</a></li>
                           <li class="nav-item"><a class="nav-link" href="{{url('employee/document/add')}}">DOCUMENTS</a></li>
                           <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">JOB</a></li>
                           <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">ASSETS</a></li>
                        </ul>
                     </div>
                     <div class="card-body">
                     </div>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <div class="card card">
                     <div class="card-header">
                        <h3 class="card-title">Professional Summery</h3>
                     </div>
                     <div class="card-body">
                        {{ Auth::user()->professional_summery }}
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card card">
                     <div class="card-header">
                        <h3 class="card-title">Skills</h3>
                     </div>
                     <div class="card-body">
                        {{ Auth::user()->skills }}
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card card">
                     <div class="card-header">
                        <h3 class="card-title">Contact Details</h3>
                     </div>
                     <div class="card-body">
                     </div>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="card card">
                     <div class="card-header">
                        <h3 class="card-title">Experience</h3>
                     </div>
                     <div class="card-body">
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      @endif
      <!-- //Admin Main content -->
   </div>
</x-backend-layout>