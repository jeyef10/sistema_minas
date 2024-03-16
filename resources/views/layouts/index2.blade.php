<!DOCTYPE html>
<html lang="en">
                                                        <!-- ? Header o Encabezado del Sistema -->
<head>
    <meta charset="utf-8">
    <title>INCES</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
                                                        <!-- ? Llamados de los Estilos del Sistema -->

    @yield('css-datatable')

    <!-- Favicon -->
    <link href="{{ asset ('img/inces.jpg') }}" rel="icon">
    
    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset ('css/bootstrap.min.css') }}" rel="stylesheet">
    
    <!-- Template Stylesheet -->
    <link href="{{ asset ('css/style.css') }}" rel="stylesheet">

    <script src="{{ asset ('js/validaciones.js') }}"></script> 

    @yield('stylesheet')
    
</head>
                                <!--                               ? Body o Cuerpo del sistama
                                    ? Spinner de carga (circulo de carga que aparece en el medio de la pantalla) -->
                                    
<body>
@auth
    <div class="container-fluid position-relative d-flex p-0" style="background: rgb(190, 38, 38);">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        
        <!-- Spinner End -->

                                                            <!-- ? Menu Lateral del Sistema -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3"> 
            <a href="/home" class="text-md-center" style="margin-left: 20%;"><img src="{{ asset ('img/LOGO SISTEMA .png') }}" width="130px" height="110px"></a>
            <nav class="navbar bg-navbar-dark">
                <div class="navbar-nav">

                    <a href="/home" class="nav-item nav-link"><i class="bi bi-house-door me-2"></i>Inicio</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Registros</a>
                        <div class="dropdown-menu bg-transparent border-0">

                        
                                <a href="{{ url('division') }}" class="dropdown-item">División</a>
                           
                            
                                                    <a href="{{ url('sede') }}" class="dropdown-item">Sede</a>
                                                       
                            
                        
                                <a href="{{ url('cargo') }}" class="dropdown-item">Cargo</a>
                           
                            
                        
                                <a href="{{ url('persona') }}" class="dropdown-item">Persona</a>
                           
                            
                        
                            <a href="{{ url('marca') }}" class="dropdown-item">Marca</a>
                           
                            
                        
                                <a href= "{{ url('modelo') }}"  class="dropdown-item">Modelo</a>
                           
                            
                        
                                <a href="{{ url('tipoperif') }}" class="dropdown-item">Tipos de Periféricos</a>
                           

                        
                                <a href="{{ url('periferico') }}" class="dropdown-item">Periféricos</a>
                           
                            
                        
                                <a href="{{ url('sistema') }}" class="dropdown-item">Sistemas Operativos</a>
                           

                        
                                <a href="{{ url('equipo') }}" class="dropdown-item">Incorporar Equipos</a>
                           
                                                        
                        </div>
                    </div>
                    <a href="{{ url('asignar') }}" class="nav-item nav-link"><i class="bi bi-arrow-right-circle"></i>   Asignar</a>
                    <a href="{{ url('reincorporar') }}" class="nav-item nav-link"><i class="bi bi-arrow-repeat"></i> Reincorporar</a>
                    <a href="{{ url('desincorporar') }}" class="nav-item nav-link"><i class="bi bi-arrow-left-circle"></i>  Desincorporar</a>
                    <a href= "{{ url('inventario') }}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Inventario</a>
                    <a href="{{ url('estadistica') }}" class="nav-item nav-link"><i class="bi bi-bar-chart-line"></i>  Estadística</a>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa fa-laptop me-2"></i>Reportes</a>
                        <div class="dropdown-menu bg-transparent border-0">

                    
                        <a href="{{ url('reportes') }}" class="dropdown-item"></i>Reporte General</a>
                       

                    
                        <a href="{{ url('reportes/indexperif') }}" class="dropdown-item"></i>Reporte Perifericos</a>
                       
                        </div>
                    </div>

                    
                    <a href="{{ url('bitacora') }}" class="nav-item nav-link"><i class="bi bi-arrows-angle-contract"></i>  Bitácora</a>
                    
                    <a href="./manual/manual_usuario.pdf" target="_blank" class="nav-item nav-link"><i class="bi bi-journal-text me-2"></i>Manual</a>
                    
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
 

        <!-- Content Start -->
        <div class="content">

                                     <!-- ? Informacion de perfil o usuario, ubicado en la esquina superior derecha -->

            <!-- Navbar Start -->
            <nav class="navbar navbar-expand sticky-top px-5 py-0" style="background:rgb(190, 38, 38); height: 65px; ">
                
                <a href="#" class="sidebar-toggler flex-shrink-0" style="color: white; background: black;">
                    <i class="fa fa-bars"></i>
                </a>
                
                
                <div class="d-none d-md-flex ms-4" style="margin-top: 10px;">
                    <h6 class="text-lg-center" style="color: rgb(255, 255, 255);"> <MARQUEE> BIENVENID@ {{ Auth::user()->name }} al SISTEMA DE INVENTARIO PARA LA DIVISIÓN INFORMÁTICA DE LA SEDE REGIONAL INCES ESTADO YARACUY(S.I.D.I)</MARQUEE> </h6> 
                </div>
                
                <div class="navbar-nav align-items-center ms-auto">
                </div>

                <div class="nav-item dropdown" style="left: 1.75%;">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" ><i class="fa fa-user me-2"></i> {{auth()->user()->username }}</a>
                    <div class="dropdown-menu  border-0" style="background:rgb(190, 38, 38); ">
                    
                            <a href= "/roles" class="dropdown-item" style="color: white;">Roles</a>
                       
                                               <a href="/usuarios" class="dropdown-item" style="color: white;">Usuarios</a>
                       
                         <a href="{{ route('Perfil') }}" class="dropdown-item" style="color: white;">Mi Perfil</a>
                        <a href="/logout" class="dropdown-item" style="color: white;">Cerrar Sesión</a>
                    </div>
                </div>
            </nav>
            
            <!-- Navbar End -->


                                                <!-- ? Tabla o formulario con sus respectivos campos -->

            <!-- Recent Sales Start -->
           
            <!-- Recent Sales End -->

                                                            <!-- ? Pie de pagina del sistema (footer) -->

            <!-- Footer Start -->
            <!-- <div class="container-fluid pt-1 px-2">
                <div class="rounded-top p-4" style="background: rgb(240, 236, 236);">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start" style="margin-left: 25% ; margin-top: 1% ;">
                            <h6 class="text-lg-center" style="color: rgb(171, 14, 14);">SISTEMA DE INVENTARIO EQUIPOS INFORMATICOS PARA LA DIVISION INFORMTICA DE LA SEDE REGIONAL INCES</h6> 
                        </div>
                    </div>
                </div>
            </div> -->
            <!-- Footer End -->
            @yield('content')
        </div>
        <!-- Content End -->

                                 <!-- ? Boton de ir hacia arriba en caso de que haya mucho contenido, ubicado en la inferior derecha -->
        
        <!-- Back to Top -->
        <!-- <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div> -->

                                                <!-- ? Libreria de JavaScript -->

    
    <script src="{{ asset ('js/jquery-3.5.1.js') }}"></script>
    <script src="{{ asset ('js/bootstrap.bundle.min.js') }}"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset ('js/main.js') }}"></script> 

    @yield('js-datatable')

    @yield('sweetalert')

    @yield('scripts')
    
@endauth

@guest
<p>Para ver el contenido <a href="/login">Inicia Sesión</a></p>
@endguest

</body>

</html>