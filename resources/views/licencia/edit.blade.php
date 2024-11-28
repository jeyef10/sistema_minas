@extends('layouts.index')

<title>@yield('title') Actualizar Licencia</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
    
                        <h2 class="font-weight-bold text-primary">Actualizar Licencia</h2>

                    </div>
 
                <form method="post" action="{{ route('licencia.update', $licencia->id) }}" enctype="multipart/form-data" onsubmit="return Licencia(this)" >
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
                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo Solicitante: </strong>@if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Solicitante: </strong>
                                            @if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion && $licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante)
                                                @if ($licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}
                                                @else
                                                    {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}
                                                @endif
                                            @endif
                                            </p>
                                            <p style="margin-left: 0.5%"><strong>Cédula/Rif: </strong>
                                            @if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion && $licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante)
                                                @if ($licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }}
                                                @else
                                                    {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->rif }}
                                                @endif
                                            @endif
                                            </p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos de la Solicitud</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo de Solicitud</strong>@if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{$licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Latitud: </strong>@if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->latitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Longitud: </strong>@if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->longitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Direccion: </strong>@if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->direccion }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }} @endif</p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos del Comisionado</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($licencia->comprobante_pago->inspeccion->id_planificacion) {{ $licencia->comprobante_pago->inspeccion->planificacion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Cedula </strong>@if ($licencia->comprobante_pago->inspeccion->id_planificacion) {{ $licencia->comprobante_pago->inspeccion->planificacion->comisionados->cedula }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Nombres y Apellidos </strong>@if ($licencia->comprobante_pago->inspeccion->id_planificacion) {{ $licencia->comprobante_pago->inspeccion->planificacion->comisionados->nombres }} {{ $licencia->comprobante_pago->inspeccion->planificacion->comisionados->apellidos }}@endif</p>
                                            
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                
                            <div class="card-body" id="inputs_aprovechamiento">

                                    <div class="row">

                                        <input type="hidden" class="form-control" id="id_comprobante_pago" name="id_comprobante_pago" style="background: white;" value="{{ isset($licencia->comprobante_pago->id)?$licencia->comprobante_pago->id:'' }}" placeholder="" autocomplete="off">                                  
                                        <input type="hidden" name="categoria" value="{{ $categoria }}">
                                        <input type="hidden" name="nombre_mineral" value="{{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }}">

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">N Resolución</label>
                                            <input type="text" class="form-control" id="resolucion_apro" name="resolucion_apro" value="{{ isset($licencia->resolucion_apro)?$licencia->resolucion_apro:'' }}" oninput="capitalizarInput('')" readonly></input>                                   
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Catastro Minero</label>
                                            <input type="text" class="form-control" id="catastro_la" name="catastro_la" value="{{ isset($licencia->catastro_la)?$licencia->catastro_la:'' }}" oninput="capitalizarInput('')" readonly></input>                                   
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Providencia Administrativa</label>
                                            <input type="text" class="form-control" id="providencia" name="providencia" value="{{ isset($licencia->providencia)?$licencia->providencia:'' }}" oninput="capitalizarInput('')"></input>                                 
                                        </div>

                                        <div class="col-3">
                                            <label  class="font-weight-bold text-primary">Cuotas de Pago</label>
                                            <select class="select2single form-control" name="metodo_licencia_apro" id="metodo_licencia">
                                                <option value="" selected="true" disabled>Seleccione una Cuota de Pago</option>
                                                <option value="Pago unico" {{ (old('metodo_licencia_apro', $licencia->metodo_licencia_apro ?? '') === 'Pago unico') ? 'selected' : '' }}>Pago único</option>
                                                <option value="Pago 2 parte" {{ (old('metodo_licencia_apro', $licencia->metodo_licencia_apro ?? '') === 'Pago 2 parte') ? 'selected' : '' }}>Pago 2 parte</option>
                                                <option value="Pago 3 parte" {{ (old('metodo_licencia_apro', $licencia->metodo_licencia_apro ?? '') === 'Pago 3 parte') ? 'selected' : '' }}>Pago 3 parte</option>
                                            </select>
                                        </div>
                                        
                                    </div>

                                </div>

                                <div class="card-body" id="inputs_procesamiento">

                                    <div class="row">

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">N Resolución</label>
                                            <input type="text" class="form-control" id="resolucion_hpc" name="resolucion_hpc" value="{{ isset($licencia->resolucion_hpc)?$licencia->resolucion_hpc:'' }}" oninput="capitalizarInput('')" readonly></input>
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Catastro Minero</label>
                                            <input type="text" class="form-control" id="catastro_lp" name="catastro_lp" value="{{ isset($licencia->catastro_lp)?$licencia->catastro_lp:'' }}" oninput="capitalizarInput('')" readonly></input>
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">N° de Ocupación de Territorio</label>
                                            <input type="text" class="form-control" id="num_territorio" name="num_territorio"  value="{{ isset($licencia->num_territorio)?$licencia->num_territorio:'' }}" oninput="capitalizarInput('')"></input>                                 
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Cuotas de Pago</label>
                                            <select class="select2single form-control" name="metodo_licencia_pro" id="metodo_licencia">
                                                <option value="" selected="true" disabled>Seleccione una Cuota de Pago</option>
                                                <option value="Pago cuotas" {{ (old('metodo_licencia_apro', $licencia->metodo_licencia_pro ?? '') === 'Pago cuotas') ? 'selected' : '' }}>Pago cuotas</option>
                                            </select>
                                        </div>

                                        @if ($licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre == "Roca caliza")
                                            <div class="col-4">
                                                <label  class="font-weight-bold text-primary">Metodo de Control</label>
                                                <select class="select2single form-control" name="metodo_control_pro" id="metodo_control_pro">
                                                    <option value="" selected="true" disabled>Seleccione un Metodo de Control</option>
                                                    <option value="control_volumen" {{ (old('metodo_control_pro', $licencia->metodo_control_pro ?? '') === 'control_volumen') ? 'selected' : '' }}>Control volumen</option>
                                                    <option value="control_declaracion" {{ (old('metodo_control_pro', $licencia->metodo_control_pro ?? '') === 'control_declaracion') ? 'selected' : '' }}>Control declaración</option>
                                                </select>
                                            </div>
                                        @endif
                                        
                                    </div>

                                </div>

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Oficio Providencia/Ocupación</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_oficio" name="fecha_oficio" value="{{ $fecha_oficio }}" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label for="persona" class="font-weight-bold text-primary">Cantidad de Plazos</label>
                                        <select class="select2-single form-control" id="plazo" name="id_plazo">
                                            @foreach($plazos as $plazo)
                                            <option value="{{ $plazo->id }}" @if (old('id_plazo', $licencia->id_plazo) == $plazo->id) selected @endif>
                                            {{ $plazo->cantidad }} - {{ $plazo->medida_tiempo }}
                                        </option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Inicial Operación</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_inicial_ope" name="fecha_inicial_ope" class="form-control" value="{{ $fecha_inicial_ope }}" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Final Operación</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_final_ope" name="fecha_final_ope" class="form-control" value="{{ $fecha_final_ope }}" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Talonario</label>
                                        <input type="text" class="form-control" id="talonario" name="talonario" value="{{ isset($licencia->talonario)?$licencia->talonario:''}}" oninput="capitalizarInput('')"></input>                                 
                                    </div>

                                </div> 
                                
                            </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('pago_regalia/') }}"><span class="icon text-white-50">
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
            const categoria = '{{$licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria}}';

            // Llamamos a la función para mostrar el div correcto
            mostrarDivCategoria(categoria);

    </script>

    {{-- ! FUNCION PARA DESHABILITAR EL SELECT DE PLAZOS SI LA LICENCIA YA TIENE UN PAGO REGISTRADO --}}
    
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const numeroPagos = {{ $numeroPagos }};
            const selectPlazo = document.getElementById('plazo');
    
            if (numeroPagos > 0) {
                selectPlazo.readonly = true;
            }
        });
    </script> --}}

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
    const numeroPagos = {{ $numeroPagos }};
    const selectPlazo = document.getElementById('plazo');

    if (numeroPagos > 0) {
        selectPlazo.addEventListener('mousedown', function(event) {
            event.preventDefault();
            alert("No puedes cambiar la cantidad de plazos una vez que se ha realizado un pago.");
        });
    }
});

    </script> --}}

   
    <script>
            document.addEventListener('DOMContentLoaded', function() {
            const numeroPagos = {{ $numeroPagos }};
            const selectPlazo = document.getElementById('plazo');

            if (numeroPagos > 0) {
                selectPlazo.addEventListener('mousedown', function(event) {
                    event.preventDefault();
                    Swal.fire({
                        icon: 'warning',
                        title: 'Plazos',
                        text: 'No puedes cambiar la cantidad de plazos una vez que se ha cancelado una regalía.',
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#3085d6'
                    });
                });
            }
        });
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

     {{-- ? FUNCIÓN PARA CALCULAR LA FECHA FINAL DEPEDIENDO EL PLAZO SELECCIONADO --}}

     {{-- <script>
        // Obtener los elementos del select y el input de fecha
        const plazoSelect = document.getElementById('plazo');
        const fechaFinalInput = document.getElementById('fecha_final_ope');

        // Función para calcular y actualizar la fecha final
        function calcularFechaFinal() {
            // Obtener el valor seleccionado del plazo (en meses)
            const meses = plazoSelect.value;

            // Obtener la fecha actual como un objeto de fecha
            const hoy = new Date();

            // Sumar los meses a la fecha actual
            hoy.setMonth(hoy.getMonth() + parseInt(meses));

            // Formatear la fecha en el formato deseado (d/m/Y)
            const fechaFinalFormateada = hoy.toLocaleDateString('es-ES'); // 'es-ES' para formato español

            // Asignar la fecha final formateada al input
            fechaFinalInput.value = fechaFinalFormateada;
        }

        // Escuchar el evento de cambio en el select del plazo
        plazoSelect.addEventListener('change', calcularFechaFinal);
    </script> --}}

@if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Licencia',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

@endsection