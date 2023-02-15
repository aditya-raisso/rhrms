<x-layouts.backendlayout>

    <x-slot name='title'>Admin Setting</x-slot>
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
              <li class="breadcrumb-item active">Setting Update</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
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
            <form action="{{route('admin.settingupdate')}}" method="post">
          
              @csrf
           
            <div class="card">
                 <!-- About Me Box -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Setting Update</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <div class="row">
                 <div class="form-group col-md-6">
                   <label>Email</label>
                   <input type="email" name="email" class="form-control" placeholder="Email-id" value="{{$data->email}}">
                   @if ($errors->has('email'))
                <div class="error">{{ $errors->first('email') }}</div>
                @endif
                 </div>

                 <div class="form-group col-md-6">
                   <label>Mobile Number</label>
                   <input type="text" name="mobile_number" class="form-control" placeholder="Mobile Number" value="{{$data->mobile_number}}">
                    @if ($errors->has('mobile_number'))
                <div class="error">{{ $errors->first('mobile_number') }}</div>
                @endif
                 </div>

                 <div class="form-group col-md-6">
                   <label>Facebook Page Link</label>
                   <input type="text" name="facebook_page_link" class="form-control" placeholder="Facebook Link" value="{{$data->facebook_page_link}}">
                 <input type="hidden" name="old_email" >
                   @if ($errors->has('facebook_page_link'))
                <div class="error">{{ $errors->first('facebook_page_link') }}</div>
                @endif
                 </div>

                 <div class="form-group col-md-6">
                   <label>Twitter Page Link</label>
                   <input type="text" name="twitter_page_link" class="form-control" placeholder="Twitter Link" value="{{$data->twitter_page_link}}">
                    @if ($errors->has('twitter_page_link'))
                       <div class="error">{{ $errors->first('twitter_page_link') }}</div>
                    @endif
                 </div>
                
                 <div class="form-group col-md-6">
                   <label>Instagram Page Link</label>
                   <input type="text" name="instagram_page_link" class="form-control" placeholder="Instagram Link" value="{{$data->instagram_page_link}}">
                    @if ($errors->has('instagram_page_link'))
                       <div class="error">{{ $errors->first('instagram_page_link') }}</div>
                    @endif
                 </div>

                  <div class="form-group col-md-6">
                   <label>Linkden Page Link</label>
                   <input type="text" name="linkden_page_link" class="form-control" placeholder="Linkden Link" value="{{$data->linkden_page_link}}">
                    @if ($errors->has('linkden_page_link'))
                       <div class="error">{{ $errors->first('linkden_page_link') }}</div>
                    @endif
                 </div>

                  <div class="form-group col-md-6">
                   <label>Youtube Page Link</label>
                   <input type="text" name="youtube_link" class="form-control" placeholder="Youtube Link" value="{{$data->youtube_link}}">
                    @if ($errors->has('youtube_link'))
                       <div class="error">{{ $errors->first('youtube_link') }}</div>
                    @endif
                 </div>

                  <div class="form-group col-md-6">
                   <label>Vemeo Page Link</label>
                   <input type="text" name="vemeo_link" class="form-control" placeholder="Vemeo Link" value="{{$data->vemeo_link}}">
                    @if ($errors->has('vemeo_link'))
                       <div class="error">{{ $errors->first('vemeo_link') }}</div>
                    @endif
                 </div>

                 <div class="form-group col-md-6">
                   <label>Contact Address</label>
                   <input type="text" name="contact_address" class="form-control" placeholder="Contact Address" value="{{$data->contact_address}}">
                    @if ($errors->has('contact_address'))
                       <div class="error">{{ $errors->first('contact_address') }}</div>
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
          </form>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
     
    </div>

</x-layouts.backendlayout>
