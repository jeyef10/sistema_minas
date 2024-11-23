<!DOCTYPE html>
<html lang="en">
                                                        <!-- ? Header o Encabezado del Sistema -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device=width,initial - scale=1.0">

	  <!-- Favicon -->
	  <link href="{{ asset ('img/logo.png') }}" rel="icon">

	<title>Registrar Cuenta</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="js/validaciones.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
                                						<!-- ? Body o Cuerpo del sistama -->
	<body>
		@include('partials.messages')
		<div class="loginbox-register">
			<img src="img/yaracuy.png" alt="" class="avatar">
			<h1>Registrar Cuenta</h1>
			<br>

			<!--*Formulario de Iniciar Sensiòn-->
			<form method="post" action="/register" onsubmit="return registrousuario(this)">
                @csrf

                <p>Nombre</p>
				<input type="text" placeholder="Nombre" value="" name="name" autocomplete="off" onkeypress="return soloLetras(event);">
                <p>Email</p>
				<input type="email" placeholder="Email" value="" name="email" autocomplete="off" onkeypress="return sinespacios(event);">
                <p>Usuario</p>
				<input type="text" placeholder="Usuario" value="" name="username" autocomplete="off" >
				{{-- <p>Rol Usuario</p>
				<select name="rol" id="">
					<option value="0">Seleccionar Rol de Usuario</option>
					<option value="administrador">Administrador</option> 
					<option value="jefe_division">Jefe Coordinador de la División</option> 
					<option value="asistente">Asistente</option> 
				</select>   --}}
				<br><br><p>Contraseña</p>
				<input type="password" placeholder="Contraseña" value="" name="password" onkeypress="return sinespacios(event);">
                <p>Confirmar Contraseña</p>
				<input type="password" placeholder="Confirmar Contraseña" value="" name="password_confirmation" onkeypress="return sinespacios(event);">
				<button type="submit">Entrar</button>
			</form>
			
		</div>

	</body>

</html>