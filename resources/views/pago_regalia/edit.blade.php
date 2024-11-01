@extends('layouts.index')

<title>@yield('title') Actualizar Pago de Regalia</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Actualizar Pago de Regalia</h2>

                    </div>
 
                <form method="post" action="{{ route('pago_regalia.update', $pago_regalia->id) }}" enctype="multipart/form-data" onsubmit="return PagoRegalia(this)" >
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
                                                <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->id }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Tipo Solicitante: </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Solicitante: </strong>
                                                @if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion && $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante)
                                                    @if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                        {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}
                                                    @else
                                                        {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}
                                                    @endif
                                                @endif
                                                </p>
                                                <p style="margin-left: 0.5%"><strong>Cédula/Rif: </strong>
                                                @if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion && $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante)
                                                    @if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                        {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }}
                                                    @else
                                                        {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->rif }}
                                                    @endif
                                                @endif
                                                </p>
    
                                                <p style="text-align: center" class="font-weight-bold text-primary">Datos de la Solicitud</p>
    
                                                <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->id }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Tipo de Solicitud</strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{$pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Latitud: </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->latitud }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Longitud: </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->longitud }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Direccion: </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->direccion }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }} @endif</p>
    
                                                <p style="text-align: center" class="font-weight-bold text-primary">Datos del Comisionado</p>
    
                                                <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->id_planificacion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->id }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Cedula </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->id_planificacion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->comisionados->cedula }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Nombres y Apellidos </strong>@if ($pago_regalia->licencia->comprobante_pago->inspeccion->id_planificacion) {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->comisionados->nombres }} {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->comisionados->apellidos }}@endif</p>
                                                
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                
                            <div class="card-body" id="inputs_aprovechamiento">

                                    <div class="row">

                                        <input type="hidden" class="form-control" id="id_licencia" name="id_licencia" style="background: white;" value="{{ isset($pago_regalia->licencia->id)?$pago_regalia->licencia->id:'' }}" placeholder="" autocomplete="off">                                  

                                        <div class="col-4">
                                            <label for="persona" class="font-weight-bold text-primary">Tasa de Regalias</label>
                                            <select class="select2-single form-control" id="id_regalia" name="id_regalia">
                                                @foreach($regalias as $regalia)
                                                <option value="{{ $regalia->id }}" @if (old('id_regalia', $pago_regalia->id_regalia) == $regalia->id) selected @endif>
                                                {{ $regalia->monto }} - {{ $regalia->moneda_longitud }}
                                            </option>
                                            @endforeach
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Método de Pago</label>
                                            <select class="select2single form-control" name="metodo_apro" id="metodo_apro">
                                                <option value="0" selected="true" disabled>Seleccione un Método de pago</option>
                                                <option value="Pago unico" {{ (old('metodo_apro', $pago_regalia->metodo_apro ?? '') === 'Pago unico') ? 'selected' : '' }}>Pago unico</option>
                                                <option value="Pago 1 parte" {{ (old('metodo_apro', $pago_regalia->metodo_apro ?? '') === 'Pago 1 parte') ? 'selected' : '' }}>Pago 1 parte</option>
                                                <option value="Pago 2 parte" {{ (old('metodo_apro', $pago_regalia->metodo_apro ?? '') === 'Pago 2 parte') ? 'selected' : '' }}>Pago 2 parte</option>
                                                <option value="Pago 3 parte" {{ (old('metodo_apro', $pago_regalia->metodo_apro ?? '') === 'Pago 3 parte') ? 'selected' : '' }}>Pago 3 parte</option>
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Monto</label>
                                            <input type="text" class="form-control" id="monto_apro" name="monto_apro" value="{{ isset($pago_regalia->monto_apro)?$pago_regalia->monto_apro:'' }}" oninput="capitalizarInput('')"></input>                                 
                                        </div>

                                    </div>

                                </div>

                                <div class="card-body" id="inputs_procesamiento">

                                    <div class="row">

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Método de Pago</label>
                                            <select class="select2single form-control" name="metodo_pro" id="metodo_pro">
                                                <option value="0" selected="true" disabled>Seleccione un Método de pago</option>
                                                <option value="Pago unico" {{ (old('metodo_pro', $pago_regalia->metodo_pro ?? '') === 'Pago unico') ? 'selected' : '' }}>Pago unico</option>
                                                <option value="Hectarea 3%" {{ (old('metodo_pro', $pago_regalia->metodo_pro ?? '') === 'Hectarea 3%') ? 'selected' : '' }}>Hectárea 3%</option>
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Monto</label>
                                            <input type="text" class="form-control" id="monto_pro" name="monto_pro" value="{{ isset($pago_regalia->monto_pro)?$pago_regalia->monto_pro:'' }}" oninput="capitalizarInput('')"></input>                                 
                                        </div>
                                        
                                    </div>

                                </div>

                            <hr class="sidebar-divider">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha de Pago</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_pago" name="fecha_pago" value="{{ $fecha_pago }}" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha de Vencimiento</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_venci" name="fecha_venci" value="{{ $fecha_venci }}" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Estatus</label>
                                        <select class="select2single form-control" name="estatus_regalia" id="estatus_regalia">
                                            <option value="0" selected="true" disabled>Seleccione un Método de pago</option>
                                            <option value="Aprobado" {{ (old('estatus_regalia', $pago_regalia->estatus_regalia ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                            <option value="Pendiente" {{ (old('estatus_regalia', $pago_regalia->estatus_regalia ?? '') === 'Pendiente') ? 'selected' : '' }}>Pendiente</option>
                                        </select>
                                    </div>

                                </div> 
                                
                            </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('control_regalia/') }}"><span class="icon text-white-50">
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
    <script src="{{asset('path/to/bootstrap-datepicker.es.min.js')}}"></script>

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
            const categoria = '{{$pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria}}';

            // Llamamos a la función para mostrar el div correcto
            mostrarDivCategoria(categoria);

    </script>

    {{-- ? FUNCION PARA MANTENER LA FECHA ACTUALIZADA EN EL CALENDARIO --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dateInput = document.getElementById('fecha_inspeccion');
            var today = new Date().toISOString().split('T')[0]; // Formato YYYY-MM-DD
    
            dateInput.addEventListener('focus', function() {
                if (!dateInput.value) {
                    dateInput.value = today;
                }
            });
        });
    </script>

    {{--! FUNCIÓN PARA MOSTRAR LA ALERTA DE LA FECHA --}}

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
    @endif

    
@endsection