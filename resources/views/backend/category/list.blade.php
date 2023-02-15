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
    <x-slot name='title'>Employees Category</x-slot>
    <div class="content-wrapper" style="min-height: 1518.06px;">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Category</li>
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
                        Category
                    </h3>
                  <a class="btn btn-primary float-sm-right" href="{{url('admin/category/add')}}"><i class="fa fa-plus"></i> Add  Category
                
                </a>
                </div>
                <div class="card-body">
                     <table class="table category table-bordered table-hover" id="category" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>ID</th>
                               <th>Category Name</th>
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

    
</x-backend-layout>
