<x-backend-layout>
   
    <x-slot name='title'>Leave</x-slot>
    <div class="content-wrapper" style="min-height: 1518.06px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Leave</li>
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
                        Leave
                    </h3>
                  
              
                  <a  href="#" class="btn btn-primary float-sm-right" data-toggle="modal" data-target="#addleave"><i class="fa fa-plus"></i> Add Leave
                
                </a>
                </div>
                <div class="card-body">
                    <table class="table leaveList table-bordered table-hover" id="leaveList" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                               
                                <th>Create by</th>
                                <th>Leave type</th>
                                <th>Leave Name</th> 
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

     <!--Leave Add-->
       <div class="modal fade" id="addleave" tabindex="-1" role="dialog" aria-labelledby="addleave" aria-hidden="true">
          <form action="{{route('admin.leave.create')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Add Leave</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     
                    
                     <div class="row">
                         

                        <div class="form-group col-md-6">
                           <label>Leave type <span class="text-danger">*</span></label>
                           <input type="text" name="leave_type" id="leave_type" class="form-control" placeholder="Leave type">
                       
                     </div>

                     <div class="form-group col-md-6">
                           <label>Leave Name<span class="text-danger">*</span></label>
                           <input type="text" name="leave_name" id="leave_name" class="form-control" placeholder="Leave Name">
                       
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

   <!--Leave Edit-->
       <div class="modal fade" id="editleave" tabindex="-1" role="dialog" aria-labelledby="editleave" aria-hidden="true">
          <form action="{{route('admin.leave.edit')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="">        
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Edit Leave</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">                  
                     <div class="row">                    
                        <div class="form-group col-md-6">
                           <label>Leave type <span class="text-danger">*</span></label>
                           <input type="text" name="leave_type"  class="form-control" value="" placeholder="Leave type">                     
                     </div>
                     <div class="form-group col-md-6">
                           <label>Leave Name<span class="text-danger">*</span></label>
                           <input type="text" name="leave_name" value=""  class="form-control" placeholder="Leave Name">                       
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
