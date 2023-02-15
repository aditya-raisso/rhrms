<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('employee/dashboard') }}" class="brand-link" style="text-align: center;">
            <img src="{{asset('images/raisso-logo.png')}}">
            </a>
            
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <a href="{{url('employee/dashboard')}}">
                     @if(!empty(Auth::user()->avatar))
                     <img class="img-circle elevation-2" id="preview_image" src="{{url('storage/app/user/'.Auth::user()->avatar)}}"  alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                     @else
                     <img class="img-circle elevation-2" id="preview_image" src="{{asset('images/dummy-profile.png')}}" alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                     @endif
                     </a>
                  </div>
                  <div class="info">
                     <a href="{{route('employee.dashboard',['emp'=>Auth::user()->emp_id])}}" class="d-block"> {{ ucwords(Auth::user()->first_name) }} {{ ucwords(Auth::user()->middle_name) }} {{ ucwords(Auth::user()->last_name) }}</a>
                  </div>
               </div>
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                     <li class="nav-item">
                        <a href="{{route('employee.dashboard',['emp'=>Auth::user()->emp_id])}}" class="nav-link">
                           <i class="nav-icon fa fa-th"></i>
                           <p>
                              Dashboard
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('employee/dashboard')}}" class="nav-link">
                           <i class="nav-icon fa fa-user"></i>
                           <p>
                              Profile
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('employee/apply-leave')}}" class="nav-link">
                           <i class="nav-icon fa fa-calendar"></i>
                           <p>
                              Apply Leave
                           </p>
                        </a>
                     </li>

                      @if(Auth::user()->role=='10')
                       <li class="nav-item" >
                        <a href="{{url('employee')}}" class="nav-link">
                           <i class="nav-icon fa fa-user"></i>
                           <p>
                              Employee
                           </p>
                        </a>
                     </li>

                      <li class="nav-item" >
                        <a href="{{url('employee/attendance')}}" class="nav-link">
                           <i class="nav-icon fa fa-user"></i>
                           <p>
                              attendance
                           </p>
                        </a>
                     </li>

                     <li class="nav-item" >
                        <a href="{{url('employee/hour')}}" class="nav-link">
                           <i class="nav-icon fa fa-user"></i>
                           <p>
                               Import Working Hours
                           </p>
                        </a>
                     </li>

                      <li class="nav-item">
                        <a href="#" class="nav-link">
                             <i class="fa fa-cog"></i>
                           <p>
                              Setting 
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                           <li class="nav-item">
                              <a href="{{url('category')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Category</p>
                              </a>
                           </li>
                      
                           <li class="nav-item">
                              <a href="{{url('role')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Roles</p>
                              </a>
                           </li>
                        </ul>
                     </li>
                     @endif



                    
                  </ul>
               </nav>
               <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>