<x-backend-layout>
   
    <x-slot name='title'>Holiday</x-slot>
    <div class="content-wrapper" style="min-height: 1518.06px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Holiday</li>
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
                        Holiday
                    </h3>
                  
              
                  <a  href="#" class="btn btn-primary float-sm-right" data-toggle="modal" data-target="#addholiday"><i class="fa fa-plus"></i> Add  Holiday
                
                </a>
                </div>
                <div class="card-body">
                    <table class="table holiday table-bordered table-hover" id="holiday" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                               
                                <th>Holiday Name</th>
                                <th>Date</th>
                                <th>Year</th> 
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

     <!--Holiday Add-->
       <div class="modal fade" id="addholiday" tabindex="-1" role="dialog" aria-labelledby="addholiday" aria-hidden="true">
          <form action="{{route('admin.holiday.create')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Add Holiday</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     
                    
                     <div class="row">
                          
                           <div class="form-group col-md-6">
                           <label>Holiday Name <span class="text-danger">*</span></label>
                           <input type="text" name="holiday_name" class="form-control" placeholder="Holiday Name" value="">
                        </div>

                        <div class="form-group col-md-6">
                           <label>Date <span class="text-danger">*</span></label>
                           <input type="date" name="date"  class="form-control" placeholder="Date">
                       
                     </div>
                  
                        <div class="form-group col-md-6 employement_end_date" >
                           <label>Year</label>
                           <input type="text" name="year" class="form-control" placeholder="Year">
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

<!--Holiday Edit-->
   <div class="modal fade" id="editholiday" tabindex="-1" role="dialog" aria-labelledby="editholiday" aria-hidden="true">
          <form action="{{route('admin.holiday.update')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="">
           
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">Edit Holiday</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     
                    
                     <div class="row">
                          
                           <div class="form-group col-md-6">
                           <label>Holiday Name <span class="text-danger">*</span></label>
                           <input type="text" name="holiday_name" id="holiday_name" class="form-control" placeholder="Holiday Name" value="">
                           <input type="hidden" name="id" id="id" >
                        </div>

                        <div class="form-group col-md-6">
                           <label>Date <span class="text-danger">*</span></label>
                           <input type="text" name="date" id="date" class="form-control" placeholder="Date">
                    
                     </div>
                  
                        <div class="form-group col-md-6 employement_end_date" >
                           <label>Year</label>
                           <input type="text" name="year" id="year" class="form-control" placeholder="Year">
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
