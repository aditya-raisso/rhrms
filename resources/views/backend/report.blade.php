<x-backend-layout>
   <x-slot name='title'>Report</x-slot>
   <div class="content-wrapper" style="min-height: 1518.06px;">
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                     <li class="breadcrumb-item active">Report</li>
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
                  Report
               </h3>
            </div>
            <div class="card-body">
               <div class="row">
                  <div class="col-md-3">
                     <div class="form-label-group in-border">
                        <select class="form-control select2" name="role" id="role_id">
                           <option value="" selected>Select Designation</option>
                           @foreach($data as $dat)
                           <option value="{{$dat->id}}">{{$dat->role_name}} </option>
                           @endforeach 
                        </select>
                        <label for="tt8">Designation</label>
                     </div>
                  </div>
                  <div class="col-md-3">
                     <div class="form-label-group in-border">
                        <select class="form-control select2" name="employee" id="employee_id">
                           <option>Select Employee</option>
                        </select>
                        <label for="tt8">Employee</label>
                     </div>
                  </div>
                 <!--  <div class="col-md-3">
                     <div class="form-label-group in-border">
                        <select class="form-control select2" name="month" id="month">
                           <option value=''>--Select Month--</option>
                           <option selected value='1'>Janaury</option>
                           <option value='2'>February</option>
                           <option value='3'>March</option>
                           <option value='4'>April</option>
                           <option value='5'>May</option>
                           <option value='6'>June</option>
                           <option value='7'>July</option>
                           <option value='8'>August</option>
                           <option value='9'>September</option>
                           <option value='10'>October</option>
                           <option value='11'>November</option>
                           <option value='12'>December</option>
                        </select>
                        <label for="tt8">Month</label>
                     </div>
                  </div> -->

                   <div class="col-md-3">
                     <div class="form-label-group in-border">
                        <input type="date" name="from_date" id="from_date" class="form-control" >
                        <label for="tt8">Working Hours From</label>
                     </div>
                  </div>

                  <div class="col-md-3">
                     <div class="form-label-group in-border">
                        <input type="date" name="to_date" id="to_date" class="form-control" >
                        <label for="tt8">Working Hours To</label>
                     </div>
                  </div>

                  <div class="col-md-3" style="display: none" id="indirect_direct_comission">
                     <div class="form-label-group in-border">
                        <select class="form-control select2" name="commission_type" id="commission_type">
                           <option value="">Commission Type</option>
                           <option value="0">Direct Commission</option>
                           <option value="1">Indirect Commission</option>
                        </select>
                        <label for="tt8">Commission Type</label>
                     </div>
                  </div>

                  <div class="col-md-3">
                     <button class="btn btn-primary" id="generatereport">Generate</button>
                  </div>
               </div>
               <hr>
               <div class="row">
                   <!--Rquirtor -->
                  <div class="col-md-12">
                     <table class="table table-bordered" id="recruiter" style="display: none">
                        <thead>
                           <tr>
                             
                              <th style="width: 10px">Total Consultant</th>
                               <th style="width: 10px">Working Hours</th>
                              <th style="width: 10px">NetMargin</th>
                              <th style="width: 10px">Commission</th>
                             
                           </tr>
                        </thead>
                        <tbody id="recruiterdata"></tbody>
                     </table>
                  </div>

                    <!--BDM Direct-->
                  <div class="col-md-12">
                     <table class="table table-bordered" id="bdm" style="display: none">
                        <thead>
                           <tr>
                             
                              <th style="width: 10px">Total Consultant</th>
                              <th style="width: 10px">Working Hours</th>
                              <th style="width: 10px">Net Margin</th>
                             
                              <th style="width: 10px">Commission</th>
                             
                           </tr>
                        </thead>
                        <tbody id="bdm_data"></tbody>
                     </table>
                  </div>

                   <!--BDM Indirect-->
                  <div class="col-md-12">
                     <table class="table table-bordered" id="bdm-indirect" style="display: none">
                        <thead>
                           <tr>
                              
                              <th style="width: 10px">Consultants</th>
                              <th style="width: 10px">Net Margin</th>
                              <th style="width: 10px">Commission</th> 
                           </tr>
                        </thead>
                        <tbody id="bdm_indireact_data"></tbody>
                     </table>
                  </div>

                  <!--Rquirtor Lead-->
                  <div class="col-md-12">
                     <table class="table table-bordered" id="recruiterLead" style="display: none">
                        <thead>
                           <tr>
                             
                              <th style="width: 10px">Total Consultant</th>
                              <th style="width: 10px">Total Recruiter</th>
                               <th style="width: 10px">Slab</th>
                              <th style="width: 10px">Gross NetMargin</th>
                              <th style="width: 10px">Commission</th>
                             
                           </tr>
                        </thead>
                        <tbody id="report_table_requirtor_lead"></tbody>
                     </table>
                  </div>
                  <!--Vp Report data-->
                  <div class="col-md-12" style="display: none" id="vp">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                             
                              <th style="width: 10px">Total Placement</th>                         
                              <th style="width: 10px">Gross NetMargin</th>
                              <th style="width: 10px">Commission</th>
                             
                           </tr>
                        </thead>
                        <tbody id="vp_report_data"></tbody>
                     </table>
                  </div>

                   <!--Account Manager-->
                  <div class="col-md-12" style="display: none" id="accountManager">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                              <th style="width: 10px">Total Consultant</th>
                              <th style="width: 10px">Working Hours</th>
                              <th style="width: 10px">Gross NetMargin</th>
                              <th style="width: 10px">Commission</th>
                           </tr>
                        </thead>
                        <tbody id="am_report_table"></tbody>
                     </table>
                  </div>

                    <!--Delivery Manager-->
                  <div class="col-md-12" style="display: none" id="deliveryManager">
                     <table class="table table-bordered">
                        <thead>
                           <tr>
                             
                              <th style="width: 10px">Total Consultant</th>
                              <th style="width: 10px">Working Hours</th>
                              <th style="width: 10px">Gross NetMargin</th>
                              <th style="width: 10px">Commission</th>
                             
                           </tr>
                        </thead>
                        <tbody id="dm_report_table"></tbody>
                     </table>
                  </div>


               </div>
            </div>
         </div>
      </section>
   </div>
</x-backend-layout>