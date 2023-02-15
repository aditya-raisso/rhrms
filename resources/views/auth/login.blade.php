<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>HRMS | Login</title>
      <link href="{{ asset('css/all.min.css') }}" rel="stylesheet"/>
      <!-- Google Fonts -->
      <link href="{{ asset('css/font.css') }}" rel="stylesheet"/>
      <!-- MDB -->
      <link href="{{ asset('css/mdb.min.css') }}" rel="stylesheet" />
      <link href="{{ asset('css/custome.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('floating-label/floating-labels.css')}}">
      <link rel="stylesheet" href="{{ asset('floating-label/intlTelInput.min.css')}}">
<style type="text/css">
   .btn-primary {
    
    background-color: #0999ca !important;
}
.is-invalid{
   color: red;
}
</style>
    
   </head>
   <body>
      <section class="vh-100">
         <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
               <div class="col-md-9 col-lg-6 col-xl-5">
                  <img src="{{ asset('images/login-bg.png')}}"
                     class="img-fluid" alt="Sample image">

                     <img src="https://www.raisso.com/wp-content/uploads/2022/09/Logo-for-Website-and-Signature-1.png" title="Logo-for-Website-and-Signature-1" alt="Logo-for-Website-and-Signature-1" style="height: 26px;">
               </div>
               <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                  <form method="POST" action="{{ route('login') }}" id="form" >
                     @csrf
                     <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                        <p class="lead fw-normal mb-0 me-3">Sign in with</p>
                        
                      
                     </div>
                     <small id="email-heading">Please enter your username or work email address</small>
                    
                     <div class="divider d-flex align-items-center my-4"></div>
                     <!-- Email input -->
                          <div class="md-4" >
                          <div class="form-label-group outline">
                               <input type="text"  name="email" value="" class="form-control shadow-none @if ($errors->has('email')) is-invalid @endif">
                               <span><label for="email">Email or Username</label></span>
                          </div>
                                    @if ($errors->has('email'))
                                      <span class="text-danger">{{ $errors->first('email') }}</span>
                                    @endif

                     </div>

                     <div class="md-4" >
                          <div class="form-label-group outline">
                               <input type="password"  name="password" value="" class="form-control shadow-none @if ($errors->has('password')) is-invalid @endif">
                               <span><label for="email">Password</label></span>
                          </div>
                        @if ($errors->has('password'))
                          <span class="text-danger">{{ $errors->first('password') }}</span>
                        @endif
                     </div>

                     
                     <div class="d-flex justify-content-between align-items-center">
                        <!-- Checkbox -->
                        <div class="form-check mb-0">
                           <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" name="remember"  {{ old('remember') ? 'checked' : '' }}/>
                           <label class="form-check-label" for="form2Example3">
                           Remember me
                           </label>
                        </div>
                        <!--  @if (Route::has('password.request'))
                           <a class="text-body" href="{{ route('password.request') }}">
                               {{ __('Forgot Your Password?') }}
                           </a>
                           @endif -->
                     </div>
                     <div class="text-center text-lg-start mt-4 pt-2">
                      

                             <button type="submit" class="btn btn-primary btn-lg"
                           style="padding-left: 2.5rem; padding-right: 2.5rem;" id="submit">Login</button>
                        <!--  <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="{{route('register')}}"
                           class="link-danger">Register</a></p> -->
                     </div>
                  </form>
               </div>
            </div>
         </div>
        
      </section>

      <script src="{{ asset('floating-label/intlTelInput.min.js')}}"></script>




      <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
         <script type="text/javascript">
            $('#next').on("click",function(){
                 
                  var email = $('#email').val();
                  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                  if(email == ''){
                     $('#errorEmail').show();
                    $('#errorEmail').html('<strong>This email field is required.</strong>');
                      
                  } else if (regex.test(email) == false) {
                    $('#errorEmail').html('<strong>Please enter a valid E-mail address.</strong>');
                  }else{
                     $.post(
                     '{{ url('/email-verify') }}', {
                     _token: '{{ csrf_token() }}',
                     email: email,
                     },
                     function(data) {
                       
                        
                        if (data == 'true') {
                              $('#errorEmail').hide();
                           $('#email-heading').hide(); 
                           $('#email_field').hide();
                           $('#next').hide();
                           $('#submit').show();
                           $('#password_field').fadeIn("slow");
                           $("#password").val('');
                        } else if (data == '0') {
                           $('#errorEmail').show();
                           $('#errorEmail').html('Your account is not active.Please contact to support.');
                        } else {
                           $('#errorEmail').show();
                           $('#errorEmail').html('<strong>Email does not exist.</strong>');
                        }
                     }
                  );
                
                 }
            });

            $("#submit").on("click", function(e) {
              
               var password = $("#password").val();
             
               var email = $("#email").val();
               $('#errorPassword').show();
               if (password == '') {

                     $('#errorPassword').html('<strong>This password field is required.</strong>');
               } else if (password.length < 6) {
                     $('#errorPassword').html('<strong>Password should be minimum of 6 characters.</strong>');
               } else {
                  $.post(
                      '{{ url('/email-verify ') }}', {
                          _token: '{{ csrf_token() }}',
                          email: email,
                          password: password,
                      },
                      function(data) {
                          if (data == 'false') {
                              $('#errorPassword').show();
                              $('#errorPassword').html('<strong>Incorrect Password.</strong>');
                          } else {
                              $('#form').submit();
                              $('#errorPassword').html('');
                              
                          }

                      }
                  );
        }
    });

    
         </script>
   </body>
</html>