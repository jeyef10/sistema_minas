@extends('layouts.index')

<title>@yield('title') Actualizar Planificacion</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Actualizar Planificación</h2>

                    </div>
               
                                                {{-- * FORMULARIO EDITAR DE LA PLANIFICACIÓN --}}

                <form method="post" action="{{ route('planificacion.update', $planificacion->id) }}" enctype="multipart/form-data" onsubmit="return Plafinicacion(this)" >
                    @csrf
                    @method('PUT')
                                
                    <div class="card-body">

                        <div class="accordion" id="accordionExample" style="display: flex; justify-content: center;">
                            <div class="card" style="width: 90%; border-radius: 2.5%;">
                                
                                    <button class="btn btn-block text-center" type="button" data-toggle="collapse" data-target="#collapseOne" style="margin-top: 0.3%;">
                                        <label  class="font-weight-bold text-primary">Detalles Recepción</label>
                                    </button>
                    
                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
                                    
                                         <div class="form-group">
                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos del Solicitante</p>
                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($planificacion->recepcion) {{ $planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo Solicitante: </strong>@if ($planificacion->recepcion && $planificacion->recepcion->solicitante) {{ $planificacion->recepcion->solicitante->tipo }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Solicitante: </strong>
                                            @if ($planificacion->recepcion && $planificacion->recepcion->solicitante)
                                                @if ($planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}
                                                @else
                                                    {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}
                                                @endif
                                            @endif
                                            </p>
                                            <p style="margin-left: 0.5%"><strong>Cédula/Rif: </strong>
                                            @if ($planificacion->recepcion && $planificacion->recepcion->solicitante)
                                                @if ($planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }}
                                                @else
                                                    {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->rif }}
                                                @endif
                                            @endif
                                            </p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos de la Solicitud</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($planificacion->recepcion) {{ $planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo de Solicitud</strong>@if ($planificacion->recepcion) {{ $planificacion->recepcion->categoria }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Municipio: </strong>@if ($planificacion->recepcion && $planificacion->recepcion->municipio) {{ $planificacion->recepcion->municipio->nom_municipio }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Latitud: </strong>@if ($planificacion->recepcion) {{ $planificacion->recepcion->latitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Longitud: </strong>@if ($planificacion->recepcion) {{ $planificacion->recepcion->longitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Dirección: </strong>@if ($planificacion->recepcion) {{ $planificacion->recepcion->direccion }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($planificacion->recepcion && $planificacion->recepcion->mineral) {{ $planificacion->recepcion->mineral->nombre }} @endif</p>

                                        </div> 
                                        
                                    </div>
                        

                                </div>
                            </div>
                    </div>

                        <hr class="sidebar-divider">

                        <div class="card-body">

                            <div class="row">

                                <input type="hidden" class="form-control" id="id_recepcion" name="id_recepcion" style="background: white;" value="{{ isset($planificacion->id_recepcion)?$planificacion->id_recepcion:'' }}" placeholder="" autocomplete="off">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Municipio</label>
                                    <select class="select2-single form-control" id="municipio" name="id_municipio">
                                        <option value="0">Seleccione un municipio</option>
                                        @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id }}" @selected($planificacion->id_municipio == $municipio->id)>{{ $municipio->nom_municipio }}</option>
                                        @endforeach
                                    </select>                                   
                                </div>

                                    <div class="col-4">
                                    <label for="comisionado" class="font-weight-bold text-primary">Comisionado asignado</label>
                                    <select class="select2-single form-control" id="comisionado" name="comisionado">
                                        <option value="0">Seleccione un comisionado</option>
                                        @foreach($comisionados as $comisionado)
                                            <option value="{{ $comisionado->id }}" @selected($planificacion->id_comisionado == $comisionado->id)> {{ $comisionado->cedula }} {{ $comisionado->nombres }} {{ $comisionado->apellidos }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Inicial</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{ $fecha_inicial }}" id="simpleDataInput" name="fecha_inicial">
                                        </div>
                                    </div>
                                </div>

                            </div>    
                        </div>

                        <hr class="sidebar-divider">

                        <div class="card-body">

                            <div class="row">
                                
                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Final</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{ $fecha_final }}" id="simpleDataInput" name="fecha_final">
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Estatus de la Planificación</label>
                                    <select class="select2single form-control" name="estatus" id="estatus">
                                        <option value="0" selected="true" disabled>Seleccione un Estatus</option>
                                        <option value="Asignado" {{ (old('estatus', $planificacion->estatus ?? '') === 'Asignado') ? 'selected' : '' }}>Asignado</option>
                                        <option value="Pendiente" {{ (old('estatus', $planificacion->estatus ?? '') === 'Pendiente') ? 'selected' : '' }}>Pendiente</option>
                                    </select>
                                </div> --}}

                            </div>
                        </div>
                         
                    <br>

                    <center>
                        <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                        <span class="text">Guardar</span>
                        </button>
                        <a  class="btn btn-info btn-lg" href="{{ url('inspeccion/') }}"><span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="text">Regresar</span></a>
                    </center>

                </form>
            </div>
        </div>    
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('path/to/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js')}}"></script>
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
            language: 'es'        
          });
    
          $('#simple-date2 .input-group.date').datepicker({
            startView: 1,
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
            language: 'es'
          });
    
          $('#simple-date3 .input-group.date').datepicker({
            startView: 2,
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
            language: 'es'
          });
    
          $('#simple-date4 .input-daterange').datepicker({        
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
            language: 'es'
          });    
    
        });
    </script>

    {{-- * FUNCION PARA MOSTRAR COMISIONADOS SEGUN SU MUNICIPIO --}}

    <script>
        
         $('#municipio').change(function() {
        var municipioId = $(this).val(); // Get selected municipio ID
 
        if (municipioId) {
             $.ajax({
             url: '/planificacion/create/fetchComisionados/'  + municipioId, // Replace with your actual API URL
             method: 'GET',
             success: function(data) {
                console.log(data);
                 // Assuming data is an array of solicitante objects
                var options = '<option value="">Seleccione un Comisionado</option>';
                
                data.forEach(function(comisionado) {
                options += '<option value="' + comisionado.id + '">' +
                    (comisionado.cedula || '') + ' - ' +
                    (comisionado.nombres || '') + ' ' +
                    (comisionado.apellidos || '') + '</option>';
                });
 
                $('#comisionado').html(options); // Update the 'Solicitante' select with new options
 
             },
             error: function(error) {
                console.error('Error fetching comisionados:', error);
                 // Handle AJAX error (e.g., network error, server error)
             }
             });
         } else {
            $('#comisionado').html('<option value="">Seleccione un Comisionado</option>'); // Clear 'Comisionado' select
        }

        });

    </script>

@endsection

