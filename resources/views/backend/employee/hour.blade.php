<x-backend-layout>
   <style type="text/css">
      table thead tr th{
      width: 100%;
      }
      table.dataTable th,
      table.dataTable td {
      white-space: nowrap;
      }
   </style>
   <x-slot name='title'>Employees</x-slot>
   <div class="content-wrapper" style="min-height: 1518.06px;">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                     <li class="breadcrumb-item active">Employees</li>
                  </ol>
               </div>
            </div>
         </div>
      </section>
    
           
        
<section class="content">
  
           
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title">
                        Working Hours
                    </h3>
            
                     <a type="button" class="btn btn-primary float-sm-right " href="{{asset('working-hours-sample.xlsx')}}">
                     Sample File <i class="fa fa-download"></i>
                    </a>

                    <button type="button" class="btn btn-primary float-sm-right" data-toggle="modal" data-target="#import-hours" style="margin-right:10px;" >
                    Bulk Import Hours
                    </button>
                </div>
                <div class="card-body">
                    <table class="table working_hours_list table-bordered table-hover" id="working_hours_list" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                               <th>EMP ID</th>
                                <th>User Name</th>
                                <th>Working Hours</th>
                                <th>Net Margin</th>
                               
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

<div class="modal fade" id="import-hours">
       <form action="{{route('admin.employee.import-hours')}}" method="post" enctype="multipart/form-data">
                     @csrf
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">Import Working Hours</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
       <div class="row">
           <div class="col-sm-12 form-group">
                 
                <input type="file" name="working_hour_file" class="form-control">
                       
           </div>
       </div>

    </div>
    <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
    </div>
    </div>
</form>
</div>
</x-backend-layout>