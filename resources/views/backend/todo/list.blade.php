<x-backend-layout>
   
    <x-slot name='title'>Todo</x-slot>
    <div class="content-wrapper" style="min-height: 1518.06px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">To do</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>


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




        <section class="content">
         
           
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        To do
                    </h3>
                  
              
                  <a  href="#" class="btn btn-primary float-sm-right" data-toggle="modal" data-target="#addtodo"><i class="fa fa-plus"></i> To do
                
                </a>
                </div>
                <div class="card-body">
                    <table class="table todoList table-bordered table-hover" id="todoList" >
                        <thead>
                            <tr>
                               
                                <th>Create By</th>
                                <th>Name</th>
                                <th>Comment</th> 
                                 <th>Action</th>     
                            </tr>
                        </thead>
                         <tbody>

                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                </div>
            </div>
        </section>
    </div>

     <!--To DO Add-->
       <div class="modal fade" id="addtodo" tabindex="-1" role="dialog" aria-labelledby="addtodo" aria-hidden="true">
          <form action="{{route('admin.todo.create')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Add To do</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     
                    
                     <div class="row">
                          
                         

                        <div class="form-group col-md-12">
                           <label>User Name<span class="text-danger">*</span></label>
                         <select id="" name="user_id" class="form-control">
							  <option  Selected >Select Name</option>
							  @foreach($userdata as $userdat)
							  <option value="{{ $userdat->id }}">{{$userdat->first_name}}{{$userdat->last_name}}</option>
							  @endforeach
							</select>
                        </div>

                        <div class="form-group col-md-12">
                           <label>Comment<span class="text-danger">*</span></label>
                           <textarea name="comment" class="form-control" placeholder="Comment"></textarea>
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

   
<!--To DO Edit -->
    <div class="modal fade" id="edittodo" tabindex="-1" role="dialog" aria-labelledby="edittodo" aria-hidden="true">
          <form action="{{route('admin.todo.update')}}" method="POST" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Edit To do</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">     
                     <div class="row">
                          
                            <input type="hidden" name="id" id="id" >                     

                        <div class="form-group col-md-12">
                           <label>User Name<span class="text-danger">*</span></label>
                         <select id="user_id" name="user_id" class="form-control">
							  <option Selected>Select Name</option>
							  @foreach($userdata as $userdat)
							  <option value="{{ $userdat->id }}">{{$userdat->first_name}}{{$userdat->last_name }}</option>
							  @endforeach
							</select>
                        </div>
                        <div class="form-group col-md-12">
                           <label>Comment<span class="text-danger">*</span></label>
                             <textarea name="comment" id="comment" class="form-control" placeholder="Comment"></textarea>                         
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



    
</x-backend-layout>
