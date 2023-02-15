<x-backend-layout>
   <x-slot name='title'>Employee Document</x-slot>
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
                     <li class="breadcrumb-item active">Employee </li>
                  </ol>
               </div>
            </div>
         </div>
         <!-- /.container-fluid -->
      </section>
      <!-- Main content -->
      <section class="content">
         <div class="container">
            <form action="{{route('admin.employee.document.create')}}" method="post" enctype="multipart/form-data">
               @csrf
               <input type="hidden" name="user_id" value="{{ @$_GET['id'] }}">
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
                              <h3 class="card-title">Document Add </h3>
                              <a class="btn btn-primary float-sm-right" href="{{route('admin.employee.view',['emp'=>$emp_id])}}"><i class="fa fa-angle-left" aria-hidden="true"></i> Back to profile
                
                               </a>
                           </div>
                           <!-- /.card-header -->
                           <div class="card-body">
                              @php
                                        $path='storage/app/user/'.$emp_id.'/';

                                    @endphp
                              <div class="row">
                                 <label class="col-md-3">Copy Passport</label>
                                 <div class="col-md-9" >
                                    @if(@$data->passport !='')
                                         
                                          <a href="{{url($path.$data->passport)}}">
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                          </a>
                                          <a href="{{route('admin.employee.document.delete',
                                          ['id'=>$data->id,'field'=>'passport'])}}" class="remove-doc" data-id="passport"><i class="fa fa-trash"></i> Remove</a>
                                      
                                    @else
                                       <input class="form-control" type="file" name="passport" accept=".pdf,.doc">
                                    @endif
                                    
                                    @if ($errors->has('passport'))
                                    <div class="error">{{ $errors->first('passport') }}</div>
                                    @endif
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <label class="col-md-3">Relieving letter from the last employer</label>
                                 <div class="col-md-9">
                                    @if(@$data->relieving_letter !='')
                                          <a href="{{url($path.$data->relieving_letter)}}">
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                          </a>
                                          <a href="{{route('admin.employee.document.delete',['id'=>$data->id,'field'=>'relieving_letter'])}}"  class="remove-doc" data-id="relieving_letter"><i class="fa fa-trash"></i> Remove</a>
                                    @else
                                      <input class="form-control" type="file" name="relieving_letter" accept=".pdf,.doc">
                                    @endif
                                    
                                    @if ($errors->has('relieving_letter'))
                                    <div class="error">{{ $errors->first('relieving_letter') }}</div>
                                    @endif
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <label class="col-md-3">Last drawn Pay slips of three months</label>
                                 <div class="col-md-9">
                                     @if(@$data->salary_slip !='')
                                          <a href="{{url($path.$data->salary_slip)}}">
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                          </a>
                                          <a href="{{route('admin.employee.document.delete',['id'=>$data->id,'field'=>'salary_slip'])}}"  class="remove-doc" data-id="salary_slip"><i class="fa fa-trash"></i> Remove</a>
                                    @else
                                    <input class="form-control" type="file" name="salary_slip" accept=".pdf,.doc">
                                    @endif
                                    @if ($errors->has('salary_slip'))
                                    <div class="error">{{ $errors->first('salary_slip') }}</div>
                                    @endif
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <label class="col-md-3">Aadhar card copy</label>
                                 <div class="col-md-9">
                                     @if(@$data->aadhar_card !='')
                                          <a href="{{url($path.$data->aadhar_card)}}">
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                          </a>
                                          <a href="{{route('admin.employee.document.delete',['id'=>$data->id,'field'=>'aadhar_card'])}}"  class="remove-doc" data-id="aadhar_card"><i class="fa fa-trash"></i> Remove</a>
                                    @else
                                    <input class="form-control" type="file" name="aadhar_card" accept=".pdf,.doc">
                                    @endif

                                    @if ($errors->has('aadhar_card'))
                                    <div class="error">{{ $errors->first('aadhar_card') }}</div>
                                    @endif
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <label class="col-md-3">PAN Card</label>
                                 <div class="col-md-9">
                                    @if(@$data->pencard_card !='')
                                          <a href="{{url($path.$data->pencard_card)}}">
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                          </a>
                                          <a href="{{route('admin.employee.document.delete',['id'=>$data->id,'field'=>'pencard_card'])}}"  class="remove-doc" data-id="pencard_card"><i class="fa fa-trash"></i> Remove</a>
                                    @else
                                    <input class="form-control" type="file" name="pencard_card" accept=".pdf,.doc">
                                    @endif

                                    @if ($errors->has('pencard_card'))
                                    <div class="error">{{ $errors->first('pencard_card') }}</div>
                                    @endif
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <label class="col-md-3">Recent Form - 16 from last employer</label>
                                 <div class="col-md-9">
                                    @if(@$data->form_16 !='')
                                          <a href="{{url($path.$data->form_16)}}">
                                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                          </a>
                                          <a href="{{route('admin.employee.document.delete',['id'=>$data->id,'field'=>'form_16'])}}"  class="remove-doc" data-id="pencard_card"><i class="fa fa-trash"></i> Remove</a>
                                    @else
                                    <input class="form-control" type="file" name="form_16" accept=".pdf,.doc">
                                    @endif
                                    @if ($errors->has('form_16'))
                                    <div class="error">{{ $errors->first('form_16') }}</div>
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