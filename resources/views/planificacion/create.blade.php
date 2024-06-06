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
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Planificación</h2>

                    </div>
 
                <form method="post" action="{{ route('planificacion.store') }}" enctype="multipart/form-data" onsubmit="return Planificacion(this)">
                        @csrf
                    
                        <div class="card-body">

                            <div class="row">

                                {{-- <div class="accordion" id="miAcordeon">

                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="encabezadoUno">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#colapsoUno" aria-expanded="true" aria-controls="colapsoUno">
                                            Recepcion
                                        </button>
                                        </h2>
                                        <div id="colapsoUno" class="accordion-collapse collapse show" aria-labelledby="encabezadoUno" data-bs-parent="#miAcordeon">
                                        <div class="accordion-body">
                                        @foreach ($recepciones as $recepcion)
                                            <input type="hidden" class="form-control" id="id_recepcion" name="id_recepcion" style="background: white;" value="{{ isset($recepcion->id)?$recepcion->id:'' }}" placeholder="" autocomplete="off">                                  
                                        @endforeach 
                                        </div>
                                        </div>
                                    </div>
                                </div> --}}

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
                                            <input type="text" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
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
                                            <input type="text" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Estatus</label>
                                    <select class="select2-single form-control" id="estatus" name="estatus">
                                        <option value="0">Seleccione un estatus</option>
                                        <option value="1">Asignado</option>
                                        <option value="2">Ejecutado</option>
                                        
                                    </select>                                   
                                </div> 

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

