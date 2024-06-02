@extends('layouts.index')

<title>@yield('title') Editar Recepción</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 25%;">Actualizar Recepción de Recaudos</h2>

                    </div>

                                                {{-- * FORMULARIO EDITAR DE RECEPCION DE RECAUDOS --}}

                <form method="post" action="{{ route('recepcion.update', $recepcion->id) }}" enctype="multipart/form-data" onsubmit="return Recepcion(this)" >
                    @csrf
                    @method('PUT')

                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Solicitante</label>
                                    <select class="select2-single form-control" id="tipo_solicitante" name="solicitante">
                                        <option value="0">Seleccione un tipo de Solicitante</option>
                                        @if ($tipoSolicitante->tipo == 'Natural')
                                            <option value="Natural" {{ (old('tipo', $tipoSolicitante->tipo ?? '') === 'Natural') ? 'selected' : '' }}>Natural</option>
                                        @else
                                            <option value="Jurídico" {{ (old('tipo', $tipoSolicitante->tipo ?? '') === 'Jurídico') ? 'selected' : '' }}>Jurídico</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Solicitante</label>
                                    <div style="display: flex;">
                                        <select class="select2-single form-control" id="solicitante" name="solicitante_especifico_id" >
                                            <option value="0">Seleccione una Persona</option>
                                            @if ($tipoSolicitante->tipo == 'Jurídico')
                                                <option value="{{$datosSolicitante->solicitante_id}}" selected>{{$datosSolicitante->rif}} {{ $datosSolicitante->nombre }} {{ $datosSolicitante->correo }}</option>
                                            @else 
                                                <option value="{{$datosSolicitante->solicitante_id}}" selected>{{$datosSolicitante->cedula}} {{ $datosSolicitante->nombre }} {{ $datosSolicitante->apellido }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Municipio</label>
                                    <select class="select2-single form-control" id="municipio" name="municipio">
                                        @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id }}" @selected($recepcion->id_municipio == $municipio->id)>{{ $municipio->nom_municipio }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>

                        <hr class="sidebar-divider">
                                
                        <div class="card-body">
        
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Categoria</label>
                                    <select class="select2-single form-control" name="categoria" id="categoria">
                                        <option value="" selected="true" disabled>Seleccione una Categoria</option>
                                        <option value="Aprovechamiento" {{ (old('categoria', $recepcion->categoria ?? '') === 'Aprovechamiento') ? 'selected' : '' }}>Aprovechamiento</option>
                                        <option value="Procesamiento" {{ (old('categoria', $recepcion->categoria ?? '') === 'Procesamiento') ? 'selected' : '' }}>Procesamiento</option>
                                    </select>
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre Mineral</label>
                                    <select class="select2-single form-control" id="nom_mineral" name="nom_mineral">
                                        @foreach($minerales as $mineral)
                                            <option value="{{ $mineral->id }}" @selected($recepcion->id_mineral == $mineral->id)>{{ $mineral->nom_mineral }}</option>
                                        @endforeach
                                    </select>                                  
                                </div>


                                
                                    
                            </div>
                        
                        <hr class="sidebar-divider">
                                
                        <div class="card-body">
        
                            <div class="row">
                                
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="select-all-recaudos" onclick="selectAll()" class="form-check-input">
                                        <label class="form-check-label" for="select-all">Seleccionar todos los recaudos</label>
                                    </div>
                                    <br>
                                    @foreach ($recaudos as $recaudo)
                                        <div class="form-group">
                                            <input type="checkbox" name="recaudos[]" value="{{ $recaudo->id }}" {{ $recaudo->selected ? 'checked' : '' }} @checked(true)>
                                            <label for="{{ $recaudo->id }}">{{ $recaudo->nombre }}</label>
                                        </div>
                                    @endforeach
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{ $fecha }}" id="simpleDataInput" name= "simpleDataInput">
                                        </div>
                                    </div>
                                </div>
                                    
                            </div>
                        </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('planificacion/') }}"><span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Regresar</span></a>
                        </center>
                </form>
            </div>
        </div>    
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

    {{--! ESTILOS DE LA FECHA PARA QUE SE DESPLIEGUE  --}}

    <script>
        $(document).ready(function () {
       
          // Bootstrap Date Picker
          $('#simple-date1 .input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,        
          });
    
          $('#simple-date2 .input-group.date').datepicker({
            startView: 1,
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
          });
    
          $('#simple-date3 .input-group.date').datepicker({
            startView: 2,
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
          });
    
          $('#simple-date4 .input-daterange').datepicker({        
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
          });    
    
        });
    </script>

     {{-- ! FUNCION PARA SELLECIONAR TODOS LOS RECAUDOS --}}

     <script>  

        function selectAll() {
        var checkboxes = document.getElementsByTagName("input");
        for (var checkbox of checkboxes) {
            if (checkbox.type === "checkbox") {
                checkbox.checked = document.getElementById('select-all-recaudos').checked;
                } 
            }
        }
        
    </script>

@endsection 