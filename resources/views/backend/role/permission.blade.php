s<x-backend-layout>
   <x-slot name='title'>Permission</x-slot>
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
                     <li class="breadcrumb-item active">Permission </li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="container">
            <form action="{{route('admin.role.insert_permission')}}" method="post" enctype="multipart/form-data">
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
                              <h3 class="card-title">{{ ucwords($role->role_name) }} Permissions</h3>
                           </div>
                           <!-- /.card-header -->
                           <input type="hidden" name="role_id" value="{{$role->id}}">   
                       
                           <div class="card-body">
                              
                          
                            <div class="card-body">
                              @if(count($Module)>0)
                                 @foreach($Module as $moduleData)
                             
                                   @php 
                                      $permission=\App\Models\Permission::where('role_id',$role->id)
                                      ->where('module_name',$moduleData->module_name)->first();

                                   @endphp
                                   <input type="hidden" name="module_name[]" value="{{$moduleData->module_name}}">
                                       <div class="row">
                                          <label class="col-md-3">{{$moduleData->module_name}}</label>
                                          <div class="col-md-9">
                                             <label for="">Add</label>
                                             <input name="add[]"  type="checkbox" @if(@$permission->add=='1')checked @endif >

                                             <label for="">Edit</label>
                                             <input name="edit[]" type="checkbox" @if(@$permission->edit=='1')checked @endif  >

                                             <label for="">View</label>
                                             <input  name="list[]" type="checkbox" @if(@$permission->list=='1')checked @endif >

                                             <label for="">Delete</label>
                                             <input name="delete[]" type="checkbox" @if(@$permission->delete=='1')checked @endif  >
                                          </div>
                                       </div>
                                  @endforeach
                               @endif
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