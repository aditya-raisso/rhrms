<x-backend-layout>
   <x-slot name='title'>Category</x-slot>
  
   <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
         <div class="container-fluid">
            <div class="row mb-2">
               <div class="col-sm-6">
               </div>
               <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="#">Home</a></li>
                     <li class="breadcrumb-item active">Category </li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="container">
            <form action="{{ route('admin.category.create') }}" method="post" enctype="multipart/form-data">
                     @csrf
            <div class="row">
                
              
               <!-- /.col -->
               <div class="col-md-12">
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
                        <!-- About Me Box -->
                        <div class="card card">
                           <div class="card-header">
                              <h3 class="card-title">Add Category </h3>
                              <a class="btn btn-primary float-sm-right" href="{{url('admin/category')}}"><i class="fa fa-eye"></i> Categories
                              </a>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              <div class="row">
                                  <div class="col-md-12 form-group">
                                     <label>Category Name</label>
                                     <input type="text" name="category_name" class="form-control" placeholder="Category Name">
                                     @if ($errors->has('category_name'))
                                    <div class="error">{{ $errors->first('category_name') }}</div>
                                    @endif
                                  </div>

                                  <div class="col-md-12 form-group">
                                     <label>Is Parent</label>
                                     <select name="is_parient" class="form-control">
                                        <option value="">Select Is Parent Category</option>
                                        @if(count($data)>0)
                                           @foreach($data as $cate)
                                                   <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                           @endforeach
                                        @endif
                                     </select>
                                        @if ($errors->has('is_parient'))
                                    <div class="error">{{ $errors->first('is_parient') }}</div>
                                    @endif
                                  </div>
                              </div>
                           </div>
                           <!-- /.card-body -->
                           <div class="card-footer">
                              <button type="submit" class="btn btn-primary float-sm-right">Submit</button>
                           </div>
                        </div>
                        <!-- /.card-header -->
                     </div>
                  
                  <!-- /.card -->
               </div>
               <!-- /.col -->
            </div>
            
            <!-- /.row -->
         </form>
         </div>

         <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
   </div>
   </div>
</x-backend-layout>