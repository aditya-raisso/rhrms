<aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('admin') }}"  class="brand-link" style="text-align: center;background-color: white">
            <img src="{{asset('images/raisso-logo.png')}}" onerror="this.src = '{{asset('images/dummy-profile.png')}}';" >
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
               <!-- Sidebar user panel (optional) -->
               <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                  <div class="image">
                     <a href="{{url('admin')}}">
                     @if(!empty(Auth::user()->avatar))
                     <img class="img-circle elevation-2"  src="{{url('storage/app/user/'.Auth::user()->avatar)}}"  alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                     @else
                     <img class="img-circle elevation-2"  src="{{asset('images/dummy-profile.png')}}" alt="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}">
                     @endif
                     </a>
                  </div>
                  <div class="info">
                     <a href="{{url('admin')}}" class="d-block"> {{ ucwords(Auth::user()->first_name) }} {{ ucwords(Auth::user()->middle_name) }} {{ ucwords(Auth::user()->last_name) }}</a>
                  </div>
               </div>
               <!-- Sidebar Menu -->
               <nav class="mt-2">
                  <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                     data-accordion="false">
                     <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                     <li class="nav-item">
                        <a href="{{ url('admin') }}" class="nav-link">
                           <i class="nav-icon fa fa-th"></i>
                           <p>
                              Dashboard
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                        <a href="{{url('admin/profile')}}" class="nav-link">
                           <i class="nav-icon fa fa-user"></i>
                           <p>
                              Profile
                           </p>
                        </a>
                     </li>
                      <li class="nav-item">
                      <a href="{{url('admin/holiday')}}" class="nav-link">
                           <i class="nav-icon fas fa-calendar-alt"></i>
                           <p>
                              Holidays
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                       <a href="{{url('admin/todo')}}" class="nav-link"> 
                           <i class="nav-icon fa fa-tasks"></i>
                           <p>
                              To Do
                           </p>
                        </a>
                     </li>
                     <li class="nav-item">
                       <a href="{{url('admin/leave')}}" class="nav-link"> 
                           <i class="nav-icon fa fa-hourglass"></i>
                           <p>
                              Leave balance
                           </p>
                        </a>
                     </li>

                     <li class="nav-item">
                        <a href="#" class="nav-link">
                           <i class="nav-icon fas fa-users"></i>
                           <p>
                              Employee
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                           <li class="nav-item">
                              <a href="{{url('admin/employee')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Employee List</p>
                              </a>
                           </li>
                             <li class="nav-item">
                              <a href="{{url('admin/employee/hour')}}" class="nav-link">
                                 <i class="nav-icon fa fa-file-excel-o"></i>
                                 <p>
                                    Import Working Hours
                                 </p>
                              </a>
                           </li>
                      
                           <li class="nav-item">
                              <a href="{{url('admin/employee/attendance')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Attendance</p>
                              </a>
                           </li>
                        </ul>
                     </li>

                       <li class="nav-item">
                        <a href="#" class="nav-link">
                           <i class="nav-icon fas fa-calculator"></i>
                           <p>
                              Commission Criteria
                              <i class="fas fa-angle-left right"></i>
                           </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                           <li class="nav-item">
                              <a href="{{route('admin.commission-criteria.list',['type'=>5])}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Recruiter</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{route('admin.lead-commission-criteria')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Recruiter Lead</p>
                              </a>
                           </li>
                            <li class="nav-item">
                               <a href="{{route('admin.account-commission-criteria')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Account Manager</p>
                              </a>
                           </li>
                           <li class="nav-item">
                               <a href="{{route('admin.bdm-commission-criteria')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>BDM</p>
                              </a>
                           </li>
                           <!-- <li class="nav-item">
                             <a href="{{route('admin.commission-criteria.list',['type'=>3])}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Delivery Manager</p>
                              </a>
                           </li>
                           <li class="nav-item">
                               <a href="{{route('admin.commission-criteria.list',['type'=>6])}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Account Manger</p>
                              </a>
                           </li>
                           <li class="nav-item">
                              <a href="{{route('admin.commission-criteria.list',['type'=>7])}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>BDM</p>
                              </a>
                           </li>
                           <li class="nav-item">
                               <a href="{{route('admin.commission-criteria.list',['type'=>8])}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>VP</p>
                              </a>
                           </li> -->
                          
                           
                        </ul>
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
                              <a href="{{url('admin/category')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Category</p>
                              </a>
                           </li>
                      
                           <li class="nav-item">
                              <a href="{{url('admin/role')}}" class="nav-link">
                                 <i class="far fa-circle nav-icon"></i>
                                 <p>Roles</p>
                              </a>
                           </li>
                        </ul>
                     </li>

                     <li class="nav-item">
                       <a href="{{url('admin/report')}}" class="nav-link"> 
                           <i class="nav-icon fa fa-tasks"></i>
                           <p>
                              Report
                           </p>
                        </a>
                     </li>    
                  </ul>
               </nav>
               <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
         </aside>