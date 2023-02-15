<x-backend-layout>
   
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
                        Employees
                    </h3>
                  
              
                <a class="btn btn-primary float-sm-right" href="{{url('admin/employee/add')}}"><i class="fa fa-plus"></i> Add  Employee
                
                </a>
                </div>
                <div class="card-body">
                    <table class="table employee table-bordered table-hover" id="employee" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Action</th>
                                <th>Code</th>
                                <th>Designation</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Alies Name</th>
                                
                                <th>Employment Type</th>
                                <th>Net Margin</th>
                                <th>Status</th>
                                <th>Contact Number</th>
                                <th>Email Address</th>
                                
                             
                                <th>Date Of Joining</th>
                                
                               
                                <th>Create By</th>
                                 <th>Assign Recruiter</th>
                                <th>Assign Recruiter Lead</th>
                                <th>Assign Delivery Manager</th>
                                <th>Assign BDM</th>
                                <th>Assign VP</th>
                                <th>Assign Account Manager</th>
                                
                               
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

    
</x-backend-layout>
