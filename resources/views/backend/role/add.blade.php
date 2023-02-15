<x-backend-layout>
   <x-slot name='title'>Add Role</x-slot>
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
                     <li class="breadcrumb-item active">Add Role </li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="container">
            <form action="{{route('admin.role.create')}}" method="post" enctype="multipart/form-data">
               @csrf
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

                     <div class="card">
                        <!-- About Me Box -->
                        <div class="card card-primary card-outline">
                           <div class="card-header">
                              <h3 class="card-title">Add  Role </h3>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                                          <label class="col-md-3">Role Name</label>
                                          <div class="col-md-9">
                                              <input class="form-control" type="text" name="role_name" placeholder="Enter role name">
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
                     <!-- /.card -->
                  </div>
                  <!-- /.col -->
               </div>
               <!-- /.row -->
            </form>
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
   </div>
   </div>
</x-backend-layout>