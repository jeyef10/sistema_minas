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
    <link href= "{{asset('vendor/select2/dist/css/select2.min.css')}}" rel="stylesheet" type="text/css">
    <link href= "{{asset('css/ruang-admin.min.css')}}" rel="stylesheet">
    <link href= "{{asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href= "{{asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">
    <link href= "{{asset('vendor/bootstrap-touchspin/css/jquery.bootstrap-touchspin.css')}}" rel="stylesheet">
    <link href= "{{asset('vendor/clock-picker/clockpicker.css')}}" rel="stylesheet">


    <script src="{{ asset ('js/validaciones.js') }}"></script>
    <script src="{{ asset ('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    
  </head>

  <body id="page-top">
    <div id="wrapper">
                                                                                <!-- Sidebar Inicio Menu lateral -->
                                                                                
            <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
              <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/home">
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

                    @can('ver-solicitante')
                      <a class="collapse-item" href="{{ url('solicitante') }}">Solicitante</a>
                    @endcan

                    @can('ver-recaudo')
                    <a class="collapse-item" href="{{ url('recaudo') }}">Recaudo</a>
                    @endcan

                    @can('ver-comisionado')
                    <a class="collapse-item" href="{{ url('comisionado') }}">Comisionado</a>
                    @endcan

                    @can('ver-mineral')
                    <a class="collapse-item" href="{{ url('mineral') }}">Mineral</a>
                    @endcan

                    @can('ver-plazo')
                    <a class="collapse-item" href="{{ url('plazo') }}">Plazos de Vigencia</a>
                    @endcan

                    <a class="collapse-item" href="{{ url('tipopago') }}">Tipo de Pago</a>
                    
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
                    
                    @can('ver-recepcion')
                    <a class="collapse-item" href="{{ route('recepcion.create') }}">Recepción de Recaudos</a>
                    @endcan

                    @can('ver-planificacion')
                    <a class="collapse-item" href="{{ url('planificacion') }}">Planificación</a>
                    @endcan

                    @can('ver-inspeccion')
                    <a class="collapse-item" href="{{ url('inspeccion') }}">Inspección</a>
                    @endcan

                    <a class="collapse-item" href="{{ url('comprobantepago') }}">Pago de Licencia</a>
                    
                    @can('ver-licencia')
                    <a class="collapse-item" href="{{ url('licencia') }}">Licencia</a>
                    @endcan

                    @can('ver-pago_regalia')
                    <a class="collapse-item" href="{{ url('pago_regalia') }}">Control de Licencias</a>
                    @endcan

                    @can('ver-control_regalia')
                    <a class="collapse-item" href="{{ url('control_regalia') }}">Control de Pago</a>
                    @endcan
                  </div>
                </div>
              </li>
              
              <hr class="sidebar-divider">
              <div class="sidebar-heading">
                
              </div>

             <li class="nav-item">
               <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReportes"
                aria-expanded="true" aria-controls="collapseReportes">
               <i class="fas fa-fw fa-columns"></i>
                   <span>Reportes</span>
                    </a>
                      <div id="collapseReportes" class="collapse" aria-labelledby="headingReportes" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                           <a class="nav-link collapsed" href="{{ url('reporte') }}" >Reporte General</a>
                           <a class="nav-link collapsed" href="{{ url('reporte/mensual') }}" >Reporte Mensual</a>
                          
                        </div>
                    
                    </div>
             
             </li>

              <li class="nav-item">
                <a class="nav-link" href="{{ url('estadistica') }}">
                  <i class="fas fa-fw fa-table"></i>
                  <span>Estadísticas</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('bitacora') }}">
                  <i class="fas fa-fw fa-chart-area"></i>
                  <span>Bitacora</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{ url('manual') }}">
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

                    <li class="nav-item dropdown no-arrow mx-1">
                      <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                          aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-bell fa-fw"></i>
                          <!-- El contador de notificaciones se actualizará dinámicamente -->
                          <span id="notificationCounter" class="badge badge-danger badge-counter"></span>
                      </a>
                      <!-- La lista de notificaciones se actualizará dinámicamente -->
                      <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                          aria-labelledby="alertsDropdown">
                          <h6 class="dropdown-header">
                              Centro de notificaciones
                          </h6>
                          <div id="notificationList">
                              <!-- Las notificaciones individuales se agregarán aquí con AJAX -->
                          </div>
                      </div>
                  </li>
  
                    <li class="nav-item dropdown no-arrow">
                      <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        <span class="ml-2 d-none d-lg-inline text-white small"></span>
                        {{auth()->user()->username }}</a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{ route('Perfil') }}">
                          <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                          Gestion de Perfil
                        </a>

                        @can('ver-rol')
                        <a class="dropdown-item" href="{{ url('roles') }}">
                          <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                          Roles
                        </a>                
                        @endcan

                        @can('ver-usuario')
                        <a class="dropdown-item" href="/usuarios">
                          <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                          Usuario
                        </a>
                        @endcan

                        <div class="dropdown-divider"></div>
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

    <script src="{{ asset('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('js/ruang-admin.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('js/demo/chart-area-demo.js') }}"></script>
    <script src="{{ asset('js/demo/chart-pie-demo.js')}}"></script>
    <script src="{{ asset('js/demo/chart-bar-demo.js')}}"></script>
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
    <script src="{{ asset ('js/main.js') }}"></script> 
    <script src="{{ asset ('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset ('vendor/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset ('vendor/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js') }}"></script>
    <script src="{{ asset ('vendor/clock-picker/clockpicker.js') }}"></script>
    <script src="{{asset('path/to/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js')}}"></script>

    @yield('datatable')

    @yield('sweetalert')

                                                     {{-- Codigo para la notificación --}} 

    <script>
      function fetchNotifications() {
            $.ajax({
                url: '/notifications/fetch',
                method: 'GET',
                success: function(data) {
                  console.log(data);
                    $('#notificationCounter').text(data.unreadCount); // Actualiza el contador
                    var notificationsHtml = ''; // Inicializa el HTML para las notificaciones

                    // Construye el HTML para cada notificación
                    $.each(data.notifications, function(i, notification) {
                        notificationsHtml += `
                            <a class="dropdown-item d-flex align-items-center" href="/inspeccion/create/${notification.data.id_planificacion}/${notification.id}" data-notification-id="">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fa fa-user-secret text-white" aria-hidden="true"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">${new Date(notification.created_at).toLocaleDateString('es-ES', { year: 'numeric', month: 'short', day: 'numeric' })}</div>
                                    <span class="font-weight-bold">Se ha creado una nueva planificación de inspección</span>
                                </div>
                            </a>`;
                    });

                    // Actualiza la lista desplegable con el nuevo HTML
                    $('#notificationList').html(notificationsHtml);

                    // // Agrega un evento de clic a los enlaces de notificación
                    // $('.dropdown-item').on('click', function(e) {
                    //   /* e.preventDefault(); */ // Evita la redirección predeterminada del enlace
                    //     const id = $(this).data('notification-id');
                    //     // Redirige a la URL del formulario con el ID de la planificación
                    //     window.location.href = `/inspeccion/create/${id}`; // Cambia la ruta según tu definición
                    // });
                },
                error: function(error) {
                    console.error('Error fetching notifications:', error);
                }
            });
        }

        // Llama a fetchNotifications cuando la página esté lista
        $(document).ready(function() {
            fetchNotifications();
        });
    </script>

  </body>

</html>