@extends('layouts.index')

<title>@yield('title') Registrar Tipo de Periférico</title>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>


@section('content')

    <div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
                <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Crear Tipo de Periférico</h3>
                    </center>
                    
                    <form method="post" action="{{ url('/tipoperif') }}" enctype="multipart/form-data" onsubmit="return TipoPeriferico(this)">
                        @csrf
                        
                        <center>
                            <div class="col-3">
                                <label style="color: black;">Tipo de Periérico</label>
                                <input type="text" class="form-control" name="tipo" id="tipo" placeholder="Ingrese el Tipo de Periérico" maxLength="15" value="{{ isset($tipo_periferico->tipo)?$tipo_periferico->tipo:'' }}" onkeypress="return soloLetras(event);" style="background: white;">
                            </div>
                        </center>
                        

                        <br><br>
                        <center>
                        
                        <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                        <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('tipoperif/') }}"> Regresar </a>
                        </center>
                        
                    </form>
                </div>
            </div> 
        </div>
    </div>

@endsection