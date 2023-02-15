<!--Emergency Add-->
<div class="modal fade" id="addEmergency" tabindex="-1" role="dialog" aria-labelledby="addEmergency" aria-hidden="true">
      <form action="{{route('employee.emergency-contact.create')}}" method="post" enctype="multipart/form-data">
         @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Add Emergency</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  <input type="hidden" name="user_id" class="form-control" placeholder="Enter User Id" value="{{ @$data->id }}">
                  <div class="row">
                    
                     <div class="form-group col-md-6">
                        <label>Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Name" value="">
                     </div>
                    
                    <div class="form-group col-md-6">
                        <label>Relation Type<span class="text-danger">*</span></label>
                        <select name="relation_type" class="form-control">
                           <option value="">Select Relation Type</option>
                           <option value="Wife">Wife</option>
                           <option value="Father">Father</option>
                           <option value="Mother">Mother</option>
                           <option value="Sister">Sister</option>
                           <option value="Brother">Brother</option>
                           <option value="Husband">Husband</option>
                        </select>
                     </div>

                      <div class="form-group col-md-6">
                        <label>Contact Number<span class="text-danger">*</span></label>
                        <input type="text" name="contact_number" value="" class="form-control" placeholder="Enter contact number">
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
   <!--Emergency Edit-->
   <div class="modal fade" id="editEmergencyContact" tabindex="-1" role="dialog" aria-labelledby="editEmergencyContact" aria-hidden="true">
      <form action="{{route('employee.emergency-contact.update')}}" method="post" enctype="multipart/form-data">
         @csrf
          <input type="hidden" name="id" id="id" class="form-control">
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Work Experience edit</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                  
                 
                  <div class="row">
                    <div class="form-group col-md-6">
                        <label>Name<span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Name" value="">
                     </div>
                    
                    <div class="form-group col-md-6">
                        <label>Relation Type<span class="text-danger">*</span></label>
                        <select name="relation_type" id="relation_type" class="form-control">
                           <option value="">Select Relation Type</option>
                           <option value="Wife">Wife</option>
                           <option value="Father">Father</option>
                           <option value="Mother">Mother</option>
                           <option value="Sister">Sister</option>
                           <option value="Brother">Brother</option>
                           <option value="Husband">Husband</option>
                        </select>
                     </div>

                      <div class="form-group col-md-6">
                        <label>Contact Number<span class="text-danger">*</span></label>
                        <input type="text" id="contact_number" name="contact_number" value="" class="form-control" placeholder="Enter contact number">
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