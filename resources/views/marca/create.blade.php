@extends('layouts.index')

<title>@yield('title') Registrar Marca</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('content')

    <div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
                <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Crear Marca</h3>
                    </center>
                    
                    <form method="post" action="{{ url('/marca') }}" enctype="multipart/form-data" onsubmit="return Marca(this)">
                        @csrf
                        
                        <center>
                            <div class="col-3">
                                <label style="color: black;">Nombre de la Marca</label>
                                <input type="text" class="form-control" placeholder="Ingrese Una Marca" name="nombre_marca" id="nombre_marca" maxLength="15" value="{{ isset($marca->nombre_marca)?$marca->nombre_marca:'' }}" onkeypress="" style="background: white;">
                            </div>
                        </center>
                        
                        <br><br>
                        <center>
                        
                        <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                        <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('marca/') }}"> Regresar </a>
                        </center>
                        
                    </form>
                </div>
            </div> 
        </div>
    </div>

@endsection