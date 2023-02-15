<x-layouts.backendlayout>

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
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Employee </li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
        
          <!-- /.col -->
          <div class="col-md-12">
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
                
                @if(Auth::user()->role->role_name=='admin')
                 <form action="{{route('admin.employee.profile-update')}}" method="post">
                @else
                 <form action="{{route('employee.profile-update')}}" method="post">
                @endif
           
             
              @csrf
                    <input type="hidden" name="id" value="{{ $data->id }}">
            <div class="card">
                 <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Employee profile update</h3>
                @if(Auth::user()->role->role_name=='admin')
                <a class="btn btn-primary float-sm-right" href="{{url('admin/employee')}}"><i class="fa fa-eye"></i> Employees
                
                </a>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class="row">
                @if(Auth::user()->role->role_name=='admin')
                <div class="form-group col-md-6">
                   <label>Report To <span>*</span></label>
                   <select class="form-control" name="report_to">
                     <option value="" >Select Report to</option>
                     @if(count($employees)>0)
                     @foreach($employees as $u_data)
                        <option value="{{ $u_data->id }}" @if($u_data->id==$data->report_to) selected @endif>{{$u_data->first_name}} {{$u_data->last_name}}</option>
                     @endforeach
                    @endif
                   </select>
                   
                   @if ($errors->has('designation'))
                     <div class="error">{{ $errors->first('designation') }}</div>
                  @endif
                 </div>

                  <div class="form-group col-md-6">
                   <label>Designation <span>*</span></label>
                   <select class="form-control" name="designation">
                     <option value="" ></option>
                     <option value="Web Designer" @if($data->designation=='Web Designer') selected  @endif>Web Designer</option>
                     <option value="HTML Developer" @if($data->designation=='Web Designer') selected  @endif>HTML Developer</option>
                     <option value="Quality Assurance" @if($data->designation=='Quality Assurance') selected  @endif>Quality Assurance</option>
                     <option value="Web Developer" @if($data->designation=='Web Developer') selected  @endif>Web Developer</option>
                     <option value="Andriod Developer" @if($data->designation=='Andriod Developer') selected @endif>Andriod Developer</option>
                   </select>
                   
                   @if ($errors->has('designation'))
                     <div class="error">{{ $errors->first('designation') }}</div>
                  @endif
                 </div>
                  
                 <div class="form-group col-md-6">
                   <label>Department <span>*</span></label>
                    <select class="form-control" name="department">
                     <option value="Development" @if($data->designation=='Development') selected  @endif>Development</option>
                     <option value="Designing" @if($data->designation=='Designing') selected  @endif>Designing</option>
                     <option value="Quality Assurance" @if($data->designation=='Quality Assurance') selected  @endif>Quality Assurance</option>
                     <option value="Account" @if($data->designation=='Account') selected  @endif>Account</option>
                   </select>
                   
                   @if ($errors->has('department'))
                     <div class="error">{{ $errors->first('department') }}</div>
                  @endif
                 </div>
                 @endif
                    
                 <div class="form-group col-md-12">
                   <label>Professional Summery</label>
                    <textarea class="form-control" name="professional_summery" placeholder="Professional Summery">{{ $data->professional_summery }}</textarea>
                   @if ($errors->has('professional_summery'))
                <div class="error">{{ $errors->first('professional_summery') }}</div>
                @endif
                 </div>

                  <div class="form-group col-md-12">
                   <label>Skills</label>
                    <textarea class="form-control" name="skills" placeholder="Skills">{{ $data->skills }}</textarea>
                   @if ($errors->has('skills'))
                <div class="error">{{ $errors->first('skills') }}</div>
                @endif
                 </div>

                  <div class="form-group col-md-6">
                   <label>Email <span>*</span></label>
                   <input type="text" disabled name="email" class="form-control" placeholder="Enter email" value="{{$data->email}}">
                   
                   @if ($errors->has('email'))
                     <div class="error">{{ $errors->first('email') }}</div>
                  @endif
                 </div>
                
               
                 

                 <div class="form-group col-md-6">
                   <label>First Name</label>
                   <input type="text" name="first_name" class="form-control" placeholder="Enter first name" value="{{$data->first_name}}">
                   @if ($errors->has('first_name'))
                <div class="error">{{ $errors->first('first_name') }}</div>
                @endif
                 </div>



                 <div class="form-group col-md-6">
                   <label>Last Name</label>
                   <input type="text" name="last_name" class="form-control" placeholder="Enter last name" value="{{$data->last_name}}">
                    @if ($errors->has('last_name'))
                <div class="error">{{ $errors->first('last_name') }}</div>
                @endif
                 </div>
                 
                  <div class="form-group col-md-6">
                   <label>Mobile Number <span>*</span></label>
                   <input type="text" name="mobile_number" class="form-control" placeholder="Enter mobile number" value="{{$data->mobile_number}}">
                   
                   @if ($errors->has('mobile_number'))
                <div class="error">{{ $errors->first('mobile_number') }}</div>
                @endif
                 </div>

                
                 
               </div>
              </div>
              <!-- /.card-body -->
               <div class="card-footer">
                 <button type="submit" class="btn btn-primary float-sm-right">Submit</button>
              </div>

            </div>
              <!-- /.card-header -->
             
            </div>
          </form>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
     
    </div>

</x-layouts.backendlayout>
