<x-backend-layout>
   <style>
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
   <x-slot name='title'>Employment Details</x-slot>
   <div class="content-wrapper" style="min-height: 1604.44px;">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Employment Details</li>
                  </ol>
               </div>
            </div>
         </div>
      </section>
      <section class="content">
         <div class="container-fluid">
            <div class="row">
               <div class="col-12">
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
                     <div class="card-header">
                        <h3 class="card-title">Employment Details</h3>
                        <!-- Button trigger modal -->
                           <a class="btn btn-primary float-sm-right" href="{{route('admin.employee.view',['emp'=>Crypt::encryptString(@$_GET['id'])])}}"> Back to profile </a>

                        <button type="button" class="btn btn-primary float-sm-right" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i>Add  Employment</button>
                      
                     </div>
                     <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                           <div class="row">
                              <div class="col-sm-12 col-md-6"></div>
                              <div class="col-sm-12 col-md-6"></div>
                           </div>
                         
                             <div class="card-body">
                    <table class="table employmentDetails table-bordered table-hover" id="employmentDetails">
                        <thead>
                            <tr>
                               
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Company Name</th>  
                                <th>Current Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                           
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <!--Employee Eductaion Add Modal -->
      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <form action="{{route('admin.employee.employment.employment_detail.create')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Employment Details</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                       <input type="hidden" name="user_id" class="form-control" placeholder="Enter User Id" value="{{ @$_GET['id']}}">
                    
                     <div class="row">

                      <div class="form-group col-md-8">
                           <label>Currently Work Here<span class="text-danger">*</span></label>
                       
                     
                        <label class="switch">
                          <input type="checkbox" name="currently_work_here" id="currently_work_here" value="0">
                          <span class="slider round"></span>
                        </label>
                     </div> 
         

                        <div class="form-group col-md-6">
                           <label>Start date <span class="text-danger">*</span></label>
                           <input type="date" name="start_date" value="" class="form-control" placeholder="Start date">
                       
                     </div>
                  
                        <div class="form-group col-md-6" id="end_date">
                           <label>End date <span class="text-danger">*</span></label>
                           <input type="date" name="end_date" id="end_date" value="" class="form-control" placeholder="End date">
                        </div>
                        <div class="form-group col-md-12">
                           <label>Company Name <span class="text-danger">*</span></label>
                           <input type="text" name="company_name" class="form-control" placeholder="Company Name" value="">
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

   <!--edit-->
  <!--  <div class="modal fade" id="educationEditEmp" tabindex="-1" role="dialog" aria-labelledby="educationEditEmp" aria-hidden="true">
          <form action="{{route('admin.employee.education.update')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Employee Education Edit</h5>
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
   </div> -->
</div>

</x-backend-layout>