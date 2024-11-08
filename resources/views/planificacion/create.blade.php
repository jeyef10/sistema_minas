@extends('layouts.index')

<title>@yield('title') Registrar Planificacion</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Registrar Planificación</h2>

                    </div>
 
                <form method="post" action="{{ route('planificacion.store') }}" enctype="multipart/form-data" onsubmit="return Planificacion(this)">
                        @csrf
                    
                        <div class="card-body">

                            <input type="hidden" class="form-control" id="id_recepcion" name="id_recepcion" style="background: white;" value="{{ isset($recepcion->id)?$recepcion->id:'' }}" placeholder="" autocomplete="off">

                            <div class="accordion" id="accordionExample" style="display: flex; justify-content: center;">
                                <div class="card" style="width: 90%; border-radius: 2.5%;">
                                    
                                        <button class="btn btn-block text-center" type="button" data-toggle="collapse" data-target="#collapseOne" style="margin-top: 0.3%;">
                                            <label  class="font-weight-bold text-primary">Detalles Recepción</label>
                                        </button>
                        
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                        
                                            <div class="form-group">
                                                <p style="text-align: center" class="font-weight-bold text-primary">Datos del Solicitante</p>
                                                <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($recepcion) {{ $recepcion->id }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Tipo Solicitante: </strong>@if ($recepcion && $recepcion->solicitante) {{ $recepcion->solicitante->tipo }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Solicitante: </strong>
                                                @if ($recepcion && $recepcion->solicitante)
                                                    @if ($recepcion->solicitante->tipo == "Natural")
                                                        {{ $recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $recepcion->solicitante->solicitanteEspecifico->apellido }}
                                                    @else
                                                        {{ $recepcion->solicitante->solicitanteEspecifico->nombre }}
                                                    @endif
                                                @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Cédula/Rif: </strong>
                                                @if ($recepcion && $recepcion->solicitante)
                                                    @if ($recepcion->solicitante->tipo == "Natural")
                                                        {{ $recepcion->solicitante->solicitanteEspecifico->cedula }}
                                                    @else
                                                        {{ $recepcion->solicitante->solicitanteEspecifico->rif }}
                                                    @endif
                                                @endif
                                                </p>

                                                <p style="text-align: center" class="font-weight-bold text-primary">Datos de la Solicitud</p>

                                                <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($recepcion) {{ $recepcion->id }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Tipo de Solicitud</strong>@if ($recepcion) {{ $recepcion->categoria }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Municipio: </strong>@if ($recepcion && $recepcion->municipio) {{ $recepcion->municipio->nom_municipio }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Latitud: </strong>@if ($recepcion) {{ $recepcion->latitud }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Longitud: </strong>@if ($recepcion) {{ $recepcion->longitud }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Direccion: </strong>@if ($recepcion) {{ $recepcion->direccion }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($recepcion && $recepcion->mineral) {{ $recepcion->mineral->nombre }} @endif</p>

                                            </div>
                                            
                                        </div>
                            

                                    </div>
                                </div>
                        </div>
    
                        <hr class="sidebar-divider">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Municipio</label>
                                    <select class="select2-single form-control" id="municipio" name="id_municipio">
                                        <option value="0">Seleccione un municipio</option>
                                        @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id }}">{{ $municipio->nom_municipio }}</option>
                                        @endforeach
                                    </select>                                   
                                </div>

                                    <div class="col-4">
                                    <label for="comisionado" class="font-weight-bold text-primary">Comisionado asignado</label>
                                    <select class="select2-single form-control" id="comisionado" name="comisionado">
                                        <option value="0">Seleccione un comisionado</option>
                                    </select>
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Inicial</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput" name="fecha_inicial">
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
                                            <input type="text" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput" name="fecha_final">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label  class="font-weight-bold text-primary">Estatus de la Planificación</label>
                                    <select class="select2single form-control" name="estatus" id="estatus">
                                        <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                        <option value="Asignado">Asignado</option>
                                        <option value="Pendiente">Pendiente</option>
                                    </select>
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

    {{--! FUNCIÓN PARA MOSTRAR LA ALERTA DE LA FECHA --}}

    @if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        Swal.fire({
                title: 'Planificación',
                text: "La fecha registrada no es válida. Por favor, asegúrese de ingresar la fecha actual y que esté dentro del lapso permitido.",
                icon: 'warning',
                showconfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '¡OK!',
                
                }).then((result) => {
            if (result.isConfirmed) {

                this.submit();
            }
            })
    </script>
    @endif

@endsection

