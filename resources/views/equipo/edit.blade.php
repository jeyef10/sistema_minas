@extends('layouts.index')

<title>@yield('title') Editar Equipo</title>


@section('content')

    @if ($errors->any())
    <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
            <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Editar Equipo</h3>
                    </center>
                    
                    <form method="post" action="{{ url('/equipo/'.$equipo->id )}}" enctype="multipart/form-data" onsubmit="return Equipo(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                        <div class="row">

                            <div class="col-3">
                                <label for="marca" style="color: black;">Marca del Equipo</label>
                                <select class="form-select" id="marca" name="id_marca">
                                    <option value="0">Seleccione una Marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}"{{ $marca->id == $equipo->id_marca ? 'selected' : '' }}>{{ $marca->nombre_marca }}</option>
                                    @endforeach
                                </select>                            
                            </div>

                            <div class="col-3">
                                <label for="modelo" style="color: black;">Modelo del Equipo</label>
                                <select class="form-select" id="modelo" name="id_modelo">
                                    <option value="0">Seleccione un Modelo</option>
                                    @foreach($modelos as $modelo)
                                        <option value="{{ $modelo->id }}"{{ $modelo->id == $equipo->id_modelo ? 'selected' : '' }}>{{ $modelo->nombre_modelo }}</option>
                                    @endforeach
                                </select>                            
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Serial</label>
                                <input type="text" class="form-control" name="serial" id="serial" value="{{ isset($equipo->serial)?$equipo->serial:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>
                            
                            <div class="col-3">
                                <label style="color: black;">Serial Activo</label>
                                <input type="text" class="form-control" name="serialA" id="serialA" value="{{ isset($equipo->serialA)?$equipo->serialA:'' }}" onkeypress="return solonum(event);" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Modelo del CPU</label>
                                <input type="text" class="form-control" name="cpu" id="cpu" value="{{  isset($equipo->cpu)?$equipo->cpu:'' }}" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Velocidad del CPU (GHz)</label>
                                <input type="text" class="form-control" name="velocidad" id="velocidad" value="{{  isset($equipo->velocidad)?$equipo->velocidad:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Memoria Ram (GB)</label>
                                <input type="text" class="form-control" name="ram" id="ram" value="{{  isset($equipo->ram)?$equipo->ram:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Disco Duro</label>
                                <input type="text" class="form-control" name="disco" id="disco" value="{{  isset($equipo->disco)?$equipo->disco:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Tipo de Sistema</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="privativo" value="Privativo" {{ $equipo->sistema->tipo == 'Privativo' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="privativo">
                                        Privativo
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="tipo" id="libre" value="Libre" {{ $equipo->sistema->tipo == 'Libre' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="libre">
                                        Libre
                                    </label>
                                </div>
                            </div>

                            <div class="col-3">
                                <label for="sistema" style="color: black;">Sistema</label>
                                <select class="form-select" id="sistema" name="id_so">
                                    <option value="0">Seleccione un Sistema</option>
                                    @foreach($sistemas as $sistema)
                                        <option value="{{ $sistema->id }}" data-tipo="{{ $sistema->tipo }}" {{ $sistema->id == $equipo->id_so ? 'selected' : '' }}>{{ $sistema->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>

                        <br>
                        <center>
                        
                        <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                        <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('equipo/') }}"> Regresar </a>
                        </center>
                        
                    </form>

                </div>
            </div> 
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Obtener el valor del tipo de sistema seleccionado
        var tipoSeleccionado = $('input[name="tipo"]:checked').val();
        
        // Filtrar y mostrar los sistemas operativos iniciales
        filterSistemasOperativos(tipoSeleccionado);
        
        // Manejar el evento de cambio en el radio
        $('input[name="tipo"]').change(function() {
            var tipo = $(this).val();
            filterSistemasOperativos(tipo);
        });
        
        // Función para filtrar y mostrar los sistemas operativos en el select
        function filterSistemasOperativos(tipo) {
            var select = $('#sistema');
            
            // Limpiar el select y reiniciar su valor
            select.empty().val('');
            
            // Agregar la opción "Seleccione un Sistema" solo si se ha seleccionado un radio
            if (tipo === 'Privativo' || tipo === 'Libre') {
                select.append('<option value="0" selected>Seleccione un Sistema</option>');
            }
            
            // Agregar las opciones correspondientes al tipo seleccionado
            @foreach($sistemas as $sistema)
                @if ($sistema->tipo == 'Privativo')
                    if (tipo === 'Privativo') {
                        select.append('<option value="{{ $sistema->id }}" data-tipo="Privativo" {{ $sistema->id == $equipo->id_so ? "selected" : "" }}>{{ $sistema->nombre }}</option>');
                    }
                @elseif ($sistema->tipo == 'Libre')
                    if (tipo === 'Libre') {
                        select.append('<option value="{{ $sistema->id }}" data-tipo="Libre" {{ $sistema->id == $equipo->id_so ? "selected" : "" }}>{{ $sistema->nombre }}</option>');
                    }
                @endif
            @endforeach
        }
    });
</script>




@endsection