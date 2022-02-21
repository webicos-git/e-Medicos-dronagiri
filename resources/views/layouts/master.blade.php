<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="author" content="Digit93Team">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <link rel="icon" type="image/png" href="{{ asset('img/dd-logo2.png') }}">
      <title>e-Medicos - @yield('title') </title>
      <!-- Custom styles for this template-->
      <link href="{{ asset('css/app.css') }}" rel="stylesheet">
      @yield('header')
   </head>
   <body id="page-top">
      <div id="app">
         <!-- Page Wrapper -->
         <div id="wrapper">
            <!-- Sidebar -->
            <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark top-0 accordion" id="accordionSidebar">
               <!-- Sidebar - Brand -->
               <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
                  {{-- <div class="sidebar-brand-icon rotate-n-15">
                     <i class="fas fa-user-md"></i>
                  </div>
                  <div class="sidebar-brand-text mx-3">e-Medicos <sup>1.0</sup></div> --}}

                  <img src="{{ asset('img/dd-logo-white.png') }}" alt="Doctor Logo" width="100%" height="80">

               </a>
               <!-- Divider -->
               <hr class="sidebar-divider my-0">
               <!-- Nav Item - Dashboard -->
               <li class="nav-item active">
                  <a class="nav-link" href="{{ route('home') }}">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>{{ __('sentence.Dashboard') }}</span></a>
               </li>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  {{ __('sentence.Patients') }}
               </div>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePatient" aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-fw fa-users"></i>
                  <span>{{ __('sentence.Patients') }}</span>
                  </a>
                  <div id="collapsePatient" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('patient.create') }}">{{ __('sentence.New Patient') }}</a>
                        <a class="collapse-item" href="{{ route('patient.all') }}">{{ __('sentence.All Patients') }}</a>
                     </div>
                  </div>
               </li>
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInvestigation" aria-expanded="true" aria-controls="collapseInvestigation">
                  <i class="fas fa-fw fa-syringe"></i>
                  <span>{{ __('sentence.Investigations / Follow Up') }}</span>
                  </a>
                  <div id="collapseInvestigation" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('investigation.create') }}">{{ __('sentence.Add Investigation') }}</a>
                        <a class="collapse-item" href="{{ route('investigation.all') }}">{{ __('sentence.All Investigations') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  {{ __('sentence.Report') }}
               </div>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReport" aria-expanded="true" aria-controls="collapseReport">
                  <i class="fas fa-fw fa-calendar-plus"></i>
                  <span>{{ __('sentence.Report') }}</span>
                  </a>
                  <div id="collapseReport" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('report.all') }}">{{ __('sentence.Report Generation') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  {{ __('sentence.Appointment') }}
               </div>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseAppointment" aria-expanded="true" aria-controls="collapseAppointment">
                  <i class="fas fa-fw fa-calendar-plus"></i>
                  <span>{{ __('sentence.Appointment') }}</span>
                  </a>
                  <div id="collapseAppointment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('appointment.create') }}">{{ __('sentence.New Appointment') }}</a>
                        <a class="collapse-item" href="{{ route('appointment.all') }}">{{ __('sentence.All Appointments') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  {{ __('sentence.Doctors') }}
               </div>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                  <i class="fas fa-fw fa-users"></i>
                  <span>{{ __('sentence.Doctors') }}</span>
                  </a>
                  <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('doctor.create') }}">{{ __('sentence.Add Doctor') }}</a>
                        <a class="collapse-item" href="{{ route('doctor.all') }}">{{ __('sentence.All Doctors') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                  <i class="fas fa-fw fa-syringe"></i>
                  <span>{{ __('sentence.Xrays') }}</span>
                  </a>
                  <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('xray.create') }}">{{ __('sentence.Add Xray') }}</a>
                        <a class="collapse-item" href="{{ route('xray.all') }}">{{ __('sentence.All Xrays') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSonography" aria-expanded="true" aria-controls="collapseSonography">
                  <i class="fas fa-fw fa-heartbeat"></i>
                  <span>{{ __('sentence.Sonography') }}</span>
                  </a>
                  <div id="collapseSonography" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('sonography.create') }}">{{ __('sentence.Add Sonography') }}</a>
                        <a class="collapse-item" href="{{ route('sonography.all') }}">{{ __('sentence.All Sonography') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTests" aria-expanded="true" aria-controls="collapseTests">
                  <i class="fas fa-fw fa-syringe"></i>
                  <span>{{ __('sentence.Blood Tests') }}</span>
                  </a>
                  <div id="collapseTests" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('blood_test.create') }}">{{ __('sentence.Add Blood Test') }}</a>
                        <a class="collapse-item" href="{{ route('blood_test.all') }}">{{ __('sentence.All Blood Tests') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  {{ __('sentence.Billing') }}
               </div>
               <!-- Nav Item - Utilities Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                  <i class="fas fa-fw fa-rupee-sign"></i>
                  <span>{{ __('sentence.Billing') }}</span>
                  </a>
                  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        {{-- <a class="collapse-item" href="{{ route('billing.create') }}">{{ __('sentence.Create Invoice') }}</a> --}}
                        <a class="collapse-item" href="{{ route('billing.all') }}">{{ __('sentence.Billing List') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Divider -->
               <hr class="sidebar-divider">
               <!-- Heading -->
               <div class="sidebar-heading">
                  {{ __('sentence.Settings') }}
               </div>
               <!-- Nav Item - Pages Collapse Menu -->
               <li class="nav-item">
                  <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseSettings" aria-expanded="true" aria-controls="collapseSettings">
                  <i class="fas fa-fw fa-cogs"></i>
                  <span>{{ __('sentence.Settings') }}</span>
                  </a>
                  <div id="collapseSettings" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                     <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="{{ route('doctorino_settings.edit') }}">{{ __('sentence.e-Medicos Settings') }}</a>
                        <a class="collapse-item" href="{{ route('prescription_settings.edit') }}">{{ __('sentence.Prescription Settings') }}</a>
                     </div>
                  </div>
               </li>
               <!-- Divider -->
               <hr class="sidebar-divider d-none d-md-block">
               <!-- Sidebar Toggler (Sidebar) -->
               <div class="text-center d-none d-md-inline">
                  <button class="rounded-circle border-0" id="sidebarToggle"></button>
               </div>
            </ul>
            <!-- End of Sidebar -->
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
               <!-- Topbar -->
                  <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                     <!-- Sidebar Toggle (Topbar) -->
                     <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                     <i class="fa fa-bars"></i>
                     </button>
                     <!-- Topbar Navbar -->
                     <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                           <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                           <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                           <img class="img-profile rounded-circle" src="{{ asset('img/dd-logo2.png') }}">
                           </a>
                           <!-- Dropdown - User Information -->
                           <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                              <a class="dropdown-item" href="{{ route('doctorino_settings.edit') }}">
                              <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                              {{ __('sentence.Settings') }}
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                              <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                              {{ __('sentence.Logout') }}
                              </a>
                           </div>
                        </li>
                     </ul>
                  </nav>
                  <!-- End of Topbar -->
                  
               <!-- Main Content -->
               <div id="content">
                  <!-- Begin Page Content -->
                  <div class="container-fluid">
                     @yield('content')
                     <!-- Page Heading -->
                     
                  </div>
                  <!-- /.container-fluid -->
               </div>
               <!-- End of Main Content -->
               
               <!-- Footer -->
               <div class="container mb-4">
                  <div class="copyright text-center">
                     <span>
                        Copyright &copy; 2022 Dronagiri Diagnostic, Developed by Webicos 
                        {{-- <i class="fa fa-heart" style="color: red;"></i> --}}
                     </span>
                  </div>
               </div>
               <!-- End of Footer -->
            </div>
            <!-- End of Content Wrapper -->
         </div>
         <!-- End of Page Wrapper -->
      </div>
      <!-- Scroll to Top Button-->
      <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
      </a>
      <!-- Logout Modal-->
      <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
         <div class="modal-dialog" role="document">
            <div class="modal-content">
               <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{ __('sentence.Ready to Leave') }}</h5>
                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
               </div>
               <div class="modal-body">{{ __('sentence.Ready to Leave Msg') }}</div>
               <div class="modal-footer">
                  <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('sentence.Cancel') }}</button>
                  <a class="btn btn-primary" href="{{ route('logout') }}" 
                     onclick="event.preventDefault();
                     document.getElementById('logout-form').submit();">{{ __('sentence.Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                     @csrf
                  </form>
               </div>
            </div>
         </div>
      </div>
      <!-- Bootstrap core JavaScript-->
      <script src="{{ asset('js/app.js') }}"></script>
      @yield('footer')
   </body>
</html>