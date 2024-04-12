<!DOCTYPE html>
<html lang="en">
                                                        <!-- ? Header o Encabezado del Sistema -->
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device=width,initial - scale=1.0">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	  <!-- Favicon -->
	{{-- <link href="img/inces.jpg" rel="icon"> --}}

	<title>Login</title>

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

	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/estilo.css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="js/validaciones.js"></script>
	
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
                                						<!-- ? Body o Cuerpo del sistama -->
	<body>
		@include('partials.messages')
    <!-- Formulario de Registar -->
    
    <div class="container" id="container">
        <div class="form-container sign-up">
		<form method="POST" action="{{ route('password.email') }}" enctype="multipart/form-data" onsubmit="return Email(this)">
        @csrf
            <h2 style="color: black; text-align: center;">Ingrese su correo electrónico</h2>
                <input type="email" id="email_login" name="email" placeholder="Ingrese su correo" autocomplete="off">
                <input type="submit" value="ENVIAR CÓDIGO" id="log-in-button">
        </form>
        </div>

        <!-- Formulario de Iniciar Sensión -->
        <div class="form-container sign-in">
		<form action="/login" method="POST"  enctype="multipart/form-data" onsubmit="return login(this)">
		@csrf
            <h1 style="color: black;">Iniciar Sesión</h1>
                <input type="text" id="username" name="username" placeholder="Usuario"  autocomplete="off">
                <input type="password" id="contraseña" name="password" placeholder="Contraseña"  autocomplete="off" >
                <input type="submit" value="ENTRAR" id="log-in-button">
                
        </form>
        </div>

        <!-- Ventana de información -->
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Vaya! Parece que tienes problemas de acceso</h1>
                    <p>Ingrese su correo electrónico para recuperar contraseña</p>
                    <button class="hidden" id="login">Inicar Cuenta</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Hola Amigo(a)!</h1>
                    <p>Regístrese con sus datos personales para utilizar todas las funciones del sitio</p>
                    <a href="#" id="register" class="hidden"> Restablecer Contraseña </a>
                    {{-- <button class="hidden" id="register">Crear una cuenta</button> --}}
                </div>
            </div>
        </div>
    </div>

	<script type="text/javascript" src="js/login.js"></script>


    </body>

</html>