<x-backend-layout>

    <x-slot name='title'>Admin Profile</x-slot>
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
              <li class="breadcrumb-item active">Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

   
            <div class="card  card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{asset('images/admin-icon.png')}}"
                       alt="Admin profile picture">
                </div>

                <h3 class="profile-username text-center">{{ $data->first_name }} {{ $data->last_name }}</h3>
                <p class="text-muted text-center">{{$data->email  }}</p>
              </div>
            
            </div>
         </div>
          <!-- /.col -->
          <div class="col-md-8">
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
            <form action="{{route('admin.profile.update')}}" method="post">
              <input type="hidden" name="id" value="{{ $data->id }}">
              @csrf
           
            <div class="card">
                 <!-- About Me Box -->
            <div class="card ">
              <div class="card-header">
                <h3 class="card-title">Profile Update</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class="row">
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
                   <label>Email</label>
                   <input type="text" readonly name="email" class="form-control" placeholder="Enter email" value="{{$data->email}}">
                   <input type="hidden" name="old_email" value="{{$data->email}}">
                   @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
                @endif
                 </div>

                 <div class="form-group col-md-6">
                   <label>Password</label>
                   <input type="text" name="password" class="form-control" placeholder="Enter password" value="">
                    @if ($errors->has('password'))
                       <div class="error">{{ $errors->first('password') }}</div>
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

</x-backend-layout>
