@extends('layouts.index')

<title>@yield('title') Editar Modelo</title>


@section('content')

    <div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
            <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Editar Modelo</h3>
                    </center>
                    
                    <form method="post" action="{{ url('/modelo/'.$modelo->id )}}" enctype="multipart/form-data" onsubmit="return Modelo(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                        
                        <center>
                            <div class="col-3">
                                <label style="color: black;">Nombre del Modelo:</label>
                                <input type="text" class="form-control" placeholder="Ingrese Un Modelo" name="nombre_modelo" id="nombre_modelo" value="{{ isset($modelo->nombre_modelo)?$modelo->nombre_modelo:'' }}" onkeypress="" style="background: white;">
                            </div>
                        </center>

                        <br><br>
                        <center>
                        
                        <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                        <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('modelo/') }}"> Regresar </a>
                        </center>
                        
                    </form>
                </div>
            </div> 
        </div>
    </div>

@endsection