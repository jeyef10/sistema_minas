<!DOCTYPE html>
<html lang="en">
                                                        <!-- ? Header o Encabezado del Sistema -->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device=width,initial - scale=1.0">

	  <!-- Favicon -->
	  <link href="{{ asset ('img/logo.png') }}" rel="icon">

	<title>Validar Cédula</title>

	<link href="css/bootstrap.min.css" rel="stylesheet">

	<link rel="stylesheet" type="text/css" href="css/estilo.css">

	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="js/validaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
                                						<!-- ? Body o Cuerpo del sistama -->
	<body>
		@include('partials.messages')
		
		<div class="loginbox-importar">

			<img src="img/yaracuy.png" alt="" class="avatar">
			<h1>Validar Cédula</h1>
			<br>

			<!--*Importar Nómina-->
			<form action="{{ url('/validar') }}" method="get" enctype="multipart/form-data" onsubmit="return validar(this)">
				@csrf

				<p>Introduzca la cédula:</p>
				<input type="text" name="cedula" id="cedula" autocomplete="off" onkeypress="return solonum(event);" >
                <input type="submit" value="Validar">
			</form>
			
		</div>

	</body>

</html>

<script type="text/javascript">

    function validar(){
        var cedula = obj.cedula.value;
            if (!cedula) {
                alert("Debe de ingresar la cédula");
                obj.cedula.focus();
                return false;
            }
    }
    
</script>