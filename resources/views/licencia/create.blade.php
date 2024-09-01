@extends('layouts.index')

<title>@yield('title') Registrar Licencia</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>


@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Registrar Licencia</h2>

                    </div>
 
                <form method="post" action="{{ route('licencia.store') }}" enctype="multipart/form-data" onsubmit="return Licencia(this)">
                    @csrf

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
                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo Solicitante: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->solicitante->tipo }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Solicitante: </strong>
                                            @if ($inspeccion->planificacion->id_recepcion && $inspeccion->planificacion->recepcion->solicitante)
                                                @if ($inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}
                                                @else
                                                    {{ $inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}
                                                @endif
                                            @endif
                                            </p>
                                            <p style="margin-left: 0.5%"><strong>Cédula/Rif: </strong>
                                            @if ($inspeccion->planificacion->id_recepcion && $inspeccion->planificacion->recepcion->solicitante)
                                                @if ($inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }}
                                                @else
                                                    {{ $inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->rif }}
                                                @endif
                                            @endif
                                            </p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos de la Solicitud</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo de Solicitud</strong>@if ($inspeccion->planificacion->id_recepcion) {{$inspeccion->planificacion->recepcion->categoria }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Latitud: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->latitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Longitud: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->longitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Direccion: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->direccion }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->mineral->nombre }} @endif</p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos del Comisionado</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($inspeccion->id_planificacion) {{ $inspeccion->planificacion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Cedula </strong>@if ($inspeccion->id_planificacion) {{ $inspeccion->planificacion->comisionados->cedula }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Nombres y Apellidos </strong>@if ($inspeccion->id_planificacion) {{ $inspeccion->planificacion->comisionados->nombres }} {{ $inspeccion->planificacion->comisionados->apellidos }}@endif</p>
                                            
                                        </div>
                                        
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                            <div class="card-body" id="inputs_aprovechamiento">

                                <div class="row">

                                    <input type="hidden" class="form-control" id="id_inspeccion" name="id_inspeccion" style="background: white;" value="{{ isset($inspeccion->id)?$inspeccion->id:'' }}" placeholder="" autocomplete="off">                                  

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N Resolución</label>
                                        <input type="text" class="form-control" id="resolucion_apro" name="resolucion_apro" value="{{ $codigo_apro }}" oninput="capitalizarInput('')"></input>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Catastro Minero</label>
                                        <input type="text" class="form-control" id="catastro_la" name="catastro_la"  oninput="capitalizarInput('')"></input>                                   
                                    </div>

                                </div>

                            </div>

                            <div class="card-body" id="inputs_procesamiento">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N Resolución</label>
                                        <input type="text" class="form-control" id="resolucion_hpc" name="resolucion_hpc" value="{{ $codigo_hpc }}" oninput="capitalizarInput('')"></input>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Catastro Minero</label>
                                        <input type="text" class="form-control" id="catastro_lp" name="catastro_lp" oninput="capitalizarInput('')"></input>
                                    </div>
                                    
                                </div>

                            </div>

                            <hr class="sidebar-divider">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N Oficio</label>
                                        <input type="text" class="form-control" id="num_oficio" name="num_oficio" oninput="capitalizarInput('')"></input>                                 
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Oficio</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_oficio" name="fecha_oficio" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="persona" class="font-weight-bold text-primary">Cantidad de Plazos</label>
                                        <select class="select2-single form-control" id="plazo" name="id_plazo">
                                            <option value="0">Seleccione una Cantidad</option>
                                            @foreach($plazos as $plazo)
                                            <option value="{{ $plazo->id }}">{{ $plazo->cantidad }} - {{ $plazo->medida_tiempo }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Talonario</label>
                                        <input type="text" class="form-control" id="talonario" name="talonario" oninput="capitalizarInput('')"></input>                                 
                                    </div>

                                </div> 
                                
                            </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('licencia') }}"><span class="icon text-white-50">
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
    <script src="{{ asset('path/to/bootstrap-datepicker.es.min.js')}}"></script>
    
    {{-- <script src="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.6.2/proj4.js')}}"></script> --}}
    
    {{-- ? FUNCIÓN PARA CONVERTIR UNA LETRA EN MAYÚSCULAS Y LOS DEMAS EN MINÚSCULAS --}}

    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }

        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>

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
      

    {{-- * FUNCIÓN PARA MOSTRAR LOS DIVS CON LOS CAMPOS CORRESPONDIENTES A SU CATEGORIA --}}

    <script>

        function mostrarDivCategoria(categoria) {
            // Obtenemos los divs por su ID
            const divAprovechamiento = document.getElementById('inputs_aprovechamiento');
            const divProcesamiento = document.getElementById('inputs_procesamiento');

            // Ocultamos ambos divs por defecto
            divAprovechamiento.style.display = 'none';
            divProcesamiento.style.display = 'none';

            // Mostramos el div correspondiente a la categoría
            if (categoria === 'Aprovechamiento') {
                divAprovechamiento.style.display = 'block';
            } else if (categoria === 'Procesamiento') {
                divProcesamiento.style.display = 'block';
            }
            }

            // Suponiendo que tienes una variable JavaScript con el valor de la categoría
            const categoria = '{{$inspeccion->planificacion->recepcion->categoria}}';

            // Llamamos a la función para mostrar el div correcto
            mostrarDivCategoria(categoria);

    </script>

    <!-- {{--! FUNCIÓN PARA MOSTRAR LA ALERTA DE LA FECHA --}}

    @if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        Swal.fire({
                title: 'Inspección',
                text: "La fecha registrada no es válida. Por favor, asegúrese de ingresar la fecha actual.",
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
    @endif -->

@endsection