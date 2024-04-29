<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Inicio</title>
    <link href= "{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link href= "{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ asset('vendor/select2/dist/css/select2.min.css') }}" rel="stylesheet" type="text/css">

    <link href= "{{asset('css/ruang-admin.min.css')}}" rel="stylesheet">
    <link href= "{{asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href= "{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/clock-picker/clockpicker.css') }}" rel="stylesheet">


    <script src="{{ asset ('js/validaciones.js') }}"></script>
    <script src="{{ asset ('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    
  </head>

  <body id="page-top">
    <div id="wrapper">
                                                                                <!-- Sidebar Inicio Menu lateral -->
                                                                                
            <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
                {{-- <div class="sidebar-brand-icon">
                  <img src="img/logo/logo2.png">
                </div> --}}
                <div class="sidebar-brand-text mx-3"></div>
              </a>
              <hr class="sidebar-divider my-0">
              <li class="nav-item active">
                <a class="nav-link" href="/home">
                  <i class="fas fa-fw fa-tachometer-alt"></i>
                  <span>INICIO</span></a>
              </li>
              <hr class="sidebar-divider">
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseBootstrap"
                  aria-expanded="true" aria-controls="collapseBootstrap">
                  <i class="far fa-fw fa-window-maximize"></i>
                  <span>Registros</span>
                </a>
                <div id="collapseBootstrap" class="collapse" aria-labelledby="headingBootstrap" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{ url('solicitante') }}">Solicitante</a>
                    <a class="collapse-item" href="{{ url('mineral') }}">Mineral</a>
                    <a class="collapse-item" href="{{ url('regalia') }}">Tasa de Regalias</a>
                    <a class="collapse-item" href="{{ url('plazo') }}">Plazos de Vigencia</a>
                    {{-- <a class="collapse-item" href="{{ url('categoria') }}">Categoria</a> --}}
                  </div>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseForm" aria-expanded="true"
                  aria-controls="collapseForm">
                  <i class="fab fa-fw fa-wpforms"></i>
                  <span>Movimientos</span>
                </a>
                <div id="collapseForm" class="collapse" aria-labelledby="headingForm" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    {{-- <h6 class="collapse-header">Forms</h6>
                    <a class="collapse-item" href="form_basics.html">Form Basics</a>--}}
                    <a class="collapse-item" href="{{ url('solicitudes') }}">Solicitudes</a>
                    <a class="collapse-item" href="{{ url('licencia') }}">Liciencias</a>
                    <a class="collapse-item" href="{{ url('Pago') }}">Pago / Talonario</a>
                  </div>
                </div>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
                  aria-controls="collapseTable">
                  <i class="fas fa-fw fa-table"></i>
                  <span>Tables</span>
                </a>
                <div id="collapseTable" class="collapse" aria-labelledby="headingTable" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Tables</h6>
                    <a class="collapse-item" href="simple-tables.html">Simple Tables</a>
                    <a class="collapse-item" href="datatables.html">DataTables</a>
                  </div>
                </div>
              </li> --}}
              
              <hr class="sidebar-divider">
              <div class="sidebar-heading">
                
              </div>
              <li class="nav-item">
                <a class="nav-link collapsed" >
                  <i class="fas fa-fw fa-columns"></i>
                  <span>Estadísticas</span>
                </a>
                <div id="collapsePage" class="collapse" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                  <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Example Pages</h6>
                    <a class="collapse-item" href="login.html">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                  </div>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('bitacora') }}">
                  <i class="fas fa-fw fa-chart-area"></i>
                  <span>Bitacora</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">
                  <i class="fas fa-fw fa-table"></i>
                  <span>Reportes</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="">
                  <i class="fas fa-fw fa-table"></i>
                  <span>Manuales</span>
                </a>
              </li>
            </ul>

                                                                        <!-- Sidebar Final del Menu Lateral-->
                                                                        
        <div id="content-wrapper" class="d-flex flex-column">
          <div id="content">

                                                                                <!-- TopBar Inicio de la Barra Superior Azul-->

                <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
                  <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                  </button>
                  <MARQUEE style="color: white;"> BIENVENID@ {{ Auth::user()->name }} al SISTEMA DE GESTIÓN DE SOLICITUDES Y LICENCIAS PARA LA DIRECCIÓN DE MINAS (SIGESOLI)</MARQUEE>
                  <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"> 
                    </div>
                    <li class="nav-item dropdown no-arrow">
                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        {{-- <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px"> --}}
                        <span class="ml-2 d-none d-lg-inline text-white small"></span>
                        {{auth()->user()->username }}</a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('Perfil') }}">
                          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                          Gestion de Perfil
                        </a>

                        @can('ver-usuario')
                        <a class="dropdown-item" href="/usuarios">
                          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                          Usuario
                        </a>
                        @endcan

                        @can('ver-rol')
                        <a class="dropdown-item" href="{{ url('roles') }}">
                          <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                          Roles
                        </a>                
                        <div class="dropdown-divider"></div>
                        @endcan

                        <a class="dropdown-item" href="/logout">
                          <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                          Cerrar Sesión
                        </a>
                      </div>
                    </li>
                  </ul>
                </nav>
                
                                                                          <!-- Topbar Final de la Barra Superior Azul-->
      
            @yield('contenido')

          </div>
        </div>
    </div>

    <!-- Scroll to top -->
    {{-- <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a> --}}

    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/ruang-admin.min.j') }}s"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
    <script src="{{ asset ('js/main.js') }}"></script> 
    <script src="{{ asset ('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset ('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset ('vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset ('vendor/clock-picker/clockpicker.js') }}"></script>

    @yield('datatable')

    @yield('sweetalert')

  </body>

</html>