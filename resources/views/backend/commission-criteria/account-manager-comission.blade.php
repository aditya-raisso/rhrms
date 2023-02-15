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
    <x-slot name='title'>Account Manager commision criteria</x-slot>
    <div class="content-wrapper" style="min-height: 1518.06px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Account Manager Commission Criteria</li>
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
                        Account Manager Commission Criteria
                    </h3>
                     <a class="btn btn-primary float-sm-right"  data-toggle="modal" data-target="#addCommission"><i class="fa fa-plus"></i> Add  Commission Criteria
                
                </a>
                </div>
                <div class="card-body">
                     <table class="table  table-bordered table-hover table-responsive" id="accountManagerComissionCriteria" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th>From Net Margin %</th>
                            <th>To Net Margin %</th>
                            <th>Monthly from net margin</th>
                            <th>Monthly to net margin</th>
                            <th>Monthly Commission %</th>
                    
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

     <div class="modal fade" id="addCommission" tabindex="-1" role="dialog" aria-labelledby="addCommission" aria-hidden="true">
     <form action="{{route('admin.account-commission-criteria.create')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Add Commission Criteria</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                 
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label>From Net Margin %<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="from_net_margin_per" placeholder="Enter from net margin">
                        @if ($errors->has('from_net_margin_per'))
                        <div class="error">{{ $errors->first('from_net_margin_per') }}</div>
                        @endif
                     </div>
                     <div class="form-group col-md-6">
                        <label>To Net Margin %<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="to_net_margin_per" placeholder="Enter  to net margin">
                        @if ($errors->has('to_net_margin_per'))
                        <div class="error">{{ $errors->first('to_net_margin_per') }}</div>
                        @endif
                     </div>
                      <div class="form-group col-md-6">
                        <label>Monthly from net margin <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="monthly_from_net_margin" placeholder="Enter from net margin">
                        @if ($errors->has('monthly_from_net_margin'))
                        <div class="error">{{ $errors->first('monthly_from_net_margin') }}</div>
                        @endif
                     </div>
                     <div class="form-group col-md-6">
                        <label>Monthly to net margin<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="monthly_to_net_margin" placeholder="Enter  to net margin">
                        @if ($errors->has('monthly_to_net_margin'))
                        <div class="error">{{ $errors->first('monthly_to_net_margin') }}</div>
                        @endif
                     </div>

                      <div class="form-group col-md-6">
                        <label>Monthly Commission %<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="monthly_commission" placeholder="Enter  to net margin">
                        @if ($errors->has('monthly_commission'))
                        <div class="error">{{ $errors->first('monthly_commission') }}</div>
                        @endif
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

    <div class="modal fade" id="editAccountCommissionModel" tabindex="-1" role="dialog" aria-labelledby="editLeadCommissionModel" aria-hidden="true">
     <form action="{{route('admin.account-commission-criteria.update')}}" method="post" enctype="multipart/form-data">
               @csrf
         <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Edit Commission Slab</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                  </button>
               </div>
               <div class="modal-body">
                 <input  id="id" name="id" type="hidden">
                  <div class="row">
                     <div class="form-group col-md-6">
                        <label>From Net Margin %<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="from_net_margin_per" placeholder="Enter from net margin" id="from_net_margin_per">
                        @if ($errors->has('from_net_margin_per'))
                        <div class="error">{{ $errors->first('from_net_margin_per') }}</div>
                        @endif
                     </div>
                     <div class="form-group col-md-6">
                        <label>To Net Margin %<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="to_net_margin_per" placeholder="Enter  to net margin"  id="to_net_margin_per">
                        @if ($errors->has('to_net_margin_per'))
                        <div class="error">{{ $errors->first('to_net_margin_per') }}</div>
                        @endif
                     </div>
                      <div class="form-group col-md-6">
                        <label>Monthly from net margin <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="monthly_from_net_margin" placeholder="Enter from net margin" id="monthly_from_net_margin">
                        @if ($errors->has('monthly_from_net_margin'))
                        <div class="error">{{ $errors->first('monthly_from_net_margin') }}</div>
                        @endif
                     </div>
                     <div class="form-group col-md-6">
                        <label>Monthly to net margin<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="monthly_to_net_margin" placeholder="Enter  to net margin" id="monthly_to_net_margin">
                        @if ($errors->has('monthly_to_net_margin'))
                        <div class="error">{{ $errors->first('monthly_to_net_margin') }}</div>
                        @endif
                     </div>

                      <div class="form-group col-md-6">
                        <label>Monthly Commission<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="monthly_commission" placeholder="Enter  to net margin" id="monthly_commission">
                        @if ($errors->has('monthly_commission'))
                        <div class="error">{{ $errors->first('monthly_commission') }}</div>
                        @endif
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
