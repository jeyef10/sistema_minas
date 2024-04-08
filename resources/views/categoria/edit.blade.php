@extends('layouts.index')

<title>@yield('title') Actualizar Categoria</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Actualizar Categoria</h2>
    
                    </div>
                
                    <form method="post" action="{{ url('/categoria/'.$categoria->id) }}" enctype="multipart/form-data" onsubmit="return categoria(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Tipo Categoria</label>
                                    <select class="select2-single form-control" name="tipo_categoria" id="tipo_categoria">
                                        <option value="0" disabled>Seleccione una Marca</option>
                                        <option value="Aprovechamiento" {{ (old('tipo_categoria', $categoria->tipo_categoria ?? '') === 'Aprovechamiento') ? 'selected' : '' }}>Aprovechamiento</option>
                                        <option value="Procesamiento" {{ (old('tipo_categoria', $categoria->tipo_categoria ?? '') === 'Procesamiento') ? 'selected' : '' }}>Procesamiento</option>
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label style="color: black;">Tipo de Minerales</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo" id="metalicos" value="Metálicos" {{ $mineral->tipo == 'Metálicos' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="metalicos">Metálicos</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo" id="no_metalico" value="No metálicos" {{ $mineral->tipo == 'No metálicos' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="no_metalico">No Metálicos</label>
                                    </div>
                                </div>
                                
                                <div class="col-3">
                                    <label for="mineral" class="font-weight-bold text-primary">Nombre del Mineral</label>
                                    <select class="select2-single form-control" id="id_mineral" name="id_mineral">
                                        <option value="0">Seleccione un Mineral</option>
                                        @foreach ($minerales as $mineral)
                                            <option value="{{ $mineral->id }}" data-tipo="{{ $mineral->tipo }}" {{ $mineral->id == $categoria->id_mineral ? 'selected' : '' }}>{{ $mineral->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('categoria/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>

    <script>
    $(document).ready(function() {
        // Obtener el valor del tipo de mineral seleccionado
        var tipoSeleccionado = $('input[name="tipo"]:checked').val();
        
        // Filtrar y mostrar los minerales iniciales
        filterMinerales(tipoSeleccionado);
        
        // Manejar el evento de cambio en el radio
        $('input[name="tipo"]').change(function() {
            var tipo = $(this).val();
            filterMinerales(tipo);
        });
        
        // Función para filtrar y mostrar los minerales en el select
        function filterMinerales(tipo) {
            var select = $('#mineral');
            
            // Limpiar el select y reiniciar su valor
            select.empty().val('');
            
            // Agregar la opción "Seleccione un Sistema" solo si no se ha seleccionado un radio
            if (tipo === 'Metálicos' || tipo === 'No metálicos') {
                select.append('<option value="0" selected>Seleccione un Mineral</option>');
            }
            
            // Agregar las opciones correspondientes al tipo seleccionado
            @foreach($minerales as $mineral)
                @if ($mineral->tipo == 'Metálicos')
                    if (tipo === 'Metálicos') {
                        select.append('<option value="{{ $mineral->id }}" data-tipo="Metálicos" {{ $mineral->id == $categoria->id_mineral ? "selected" : "" }}>{{ $mineral->nombre }}</option>');
                    }
                @elseif ($mineral->tipo == 'No metálicos')
                    if (tipo === 'No metálicos') {
                        select.append('<option value="{{ $mineral->id }}" data-tipo="No metálicos" {{ $mineral->id == $categoria->id_mineral ? "selected" : "" }}>{{ $mineral->nombre }}</option>');
                    }
                @endif
            @endforeach
        }
    });
</script>

@endsection