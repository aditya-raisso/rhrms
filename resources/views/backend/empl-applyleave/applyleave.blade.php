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
                            <li class="breadcrumb-item active">Apply Leave</li>
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
                    <table class="table applyleaveList table-bordered table-hover" id="applyleaveList" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>User Name</th>
                                <th>Leave applied From</th>
                                <th>Leave applied To</th>
                                <th>Number of Days</th>
                                <th>Leave type Id</th>
                                <th>Reason</th> 
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
          <form action="{{route('employee.apply-leave.create')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Apply Leave</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     
                    
                     <div class="row">

                      <!-- <div class="form-group col-md-6">
                           <label>User Name<span class="text-danger">*</span></label>
                           <input type="text" name="user_id" id="user_id" class="form-control" placeholder="User Name">
                       
                     </div> -->

                     <div class="form-group col-md-6">
                           <label>Leave applied From <span class="text-danger">*</span></label>
                           <input type="date" name="leave_apply_from" class="form-control" placeholder="Leave applied From ">
                       
                     </div>

                     <div class="form-group col-md-6">
                           <label>Leave applied To <span class="text-danger">*</span></label>
                           <input type="date" name="leave_apply_to" class="form-control" placeholder="Leave applied To">
                       
                     </div>
                         

                        <div class="form-group col-md-6">
                           <label>Number of Days <span class="text-danger">*</span></label>
                           <input type="text" name="number_of_days"  class="form-control" placeholder="Number of Days">
                       
                     </div>

                     <div class="form-group col-md-6">
                           <label>Leave type Id<span class="text-danger">*</span></label>
                            <select name="leave_type_id" class="form-control">
                           <option value="">Select Leave Type</option>
                           <option value="12">CL</option>
                        </select>                      
                     </div>

                     <div class="form-group col-md-12">
                           <label>Reason<span class="text-danger">*</span></label>
                           <textarea name="reason_for_leave" class="form-control" placeholder="Reason">
                           </textarea>                       
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
       <div class="modal fade" id="applyeditleave" tabindex="-1" role="dialog" aria-labelledby="applyeditleave" aria-hidden="true">
          <form action="{{route('employee.apply-leave.update')}}" method="post" enctype="multipart/form-data">
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
  <input type="text" name="id" id="lv_id" >
                      <div class="form-group col-md-6">
                           <label>Leave applied From <span class="text-danger">*</span></label>
                           <input type="date" name="leave_apply_from" id="leave_apply_from" class="form-control" placeholder="Leave applied From ">
                         
                     </div>

                     <div class="form-group col-md-6">
                           <label>Leave applied To <span class="text-danger">*</span></label>
                           <input type="date" name="leave_apply_to" id="leave_apply_to" class="form-control" placeholder="Leave applied To">
                       
                     </div>
                         

                        <div class="form-group col-md-6">
                           <label>Number of Days <span class="text-danger">*</span></label>
                           <input type="text" name="number_of_days" id="number_of_days" class="form-control" placeholder="Number of Days">
                       
                     </div>

                     <div class="form-group col-md-6">
                           <label>Leave type Id<span class="text-danger">*</span></label>
                            <select name="leave_type_id" id="leave_type_id" class="form-control">
                           <option value="">Select Leave Type</option>
                           <option value="12">CL</option>
                        </select>                      
                     </div>

                     <div class="form-group col-md-12">
                           <label>Reason<span class="text-danger">*</span></label>
                           <textarea name="reason_for_leave" id="reason_for_leave" class="form-control" placeholder="Reason">
                           </textarea>                       
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
