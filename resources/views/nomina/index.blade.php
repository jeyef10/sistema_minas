@extends('layouts.index')

<title>@yield('title') Usuarios</title>

@section('css-datatable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@endsection

@section('content')
                                										<!-- ? Body o Cuerpo del sistama -->
	

	<div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
                <div class="p-3" style="background:  rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Importar Nomina de Empleados</h3>
                    </center>
                    
                    <form action="{{ url('nomina/importar') }}" method="POST" enctype="multipart/form-data" onsubmit="return validararchivo(this)">
                        @csrf

						@if (Session::has('message'))
							<p>{{ Session::get('message') }}</p>
						@endif
						
                        <div class="row">
                            <center>
                            <div class="col-3">
                                <label style="color: black;">Seleccione un Archivo:</label>
								<br><br>
                                <input type="file" name="documento" id="inputFile" class="form-control" style="background: white; width:360px;">
                            </div>
                            </center>
                        </div>

                        <br><br>
                        
                        <center>
                        
                        <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Importar</button>
                        <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('usuarios/') }}"> Regresar </a>
                        </center>
                        
                    </form>
                </div>
            </div> 
        </div>
    </div>

@endsection

<script type="text/javascript">

    function validararchivo(){
        var input = document.getElementById('inputFile');
        if (input.files.length === 0) {
            alert("No Se Ha Seleccionado Ningún Archivo."); // No se ha seleccionado ningún archivo
            return false;
        } else {
            // Se ha seleccionado un archivo
        }
    }
</script>