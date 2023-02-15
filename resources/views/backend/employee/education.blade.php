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
                     <li class="breadcrumb-item active">Employee Education document</li>
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
                        <h3 class="card-title">Employe Education </h3>
                        <!-- Button trigger modal -->
                           <a class="btn btn-primary float-sm-right" href="{{route('admin.employee.view',['emp'=>Crypt::encryptString(@$_GET['id'])])}}"> Back to profile </a>

                        <button type="button" class="btn btn-primary float-sm-right" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus"></i>Add  Education</button>
                      
                     </div>
                     <div class="card-body">
                        <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                           <div class="row">
                              <div class="col-sm-12 col-md-6"></div>
                              <div class="col-sm-12 col-md-6"></div>
                           </div>
                         
                             <div class="card-body">
                    <table class="table education table-bordered table-hover" id="education">
                        <thead>
                            <tr>
                               
                                <th>Qualification</th>
                                <th>Board Of Education</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                
                                <th>Documents</th>
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
          <form action="{{route('admin.employee.education.create')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Employee Education Add</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                       <input type="hidden" name="user_id" class="form-control" placeholder="Enter User Id" value="{{ @$_GET['id']}}">
                    
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

   <!--edit-->
   <div class="modal fade" id="educationEditEmp" tabindex="-1" role="dialog" aria-labelledby="educationEditEmp" aria-hidden="true">
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
   </div>
</div>

</x-backend-layout>