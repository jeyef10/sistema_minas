@extends('layouts.index')

<title>@yield('title') Registrar Pago Regalias</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>


@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Registrar Pago Regalias</h2>

                    </div>
 
                <form method="post" action="{{ route('pago_regalia.store') }}" enctype="multipart/form-data" onsubmit="return Licencia(this)">
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
                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($licencia->inspeccion->planificacion->id_recepcion) {{ $licencia->inspeccion->planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo Solicitante: </strong>@if ($licencia->inspeccion->planificacion->id_recepcion) {{ $licencia->inspeccion->planificacion->recepcion->solicitante->tipo }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Solicitante: </strong>
                                            @if ($licencia->inspeccion->planificacion->id_recepcion && $licencia->inspeccion->planificacion->recepcion->solicitante)
                                                @if ($licencia->inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $licencia->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $licencia->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}
                                                @else
                                                    {{ $licencia->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}
                                                @endif
                                            @endif
                                            </p>
                                            <p style="margin-left: 0.5%"><strong>Cédula/Rif: </strong>
                                            @if ($licencia->inspeccion->planificacion->id_recepcion && $licencia->inspeccion->planificacion->recepcion->solicitante)
                                                @if ($licencia->inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $licencia->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }}
                                                @else
                                                    {{ $licencia->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->rif }}
                                                @endif
                                            @endif
                                            </p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos de la Solicitud</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($licencia->inspeccion->planificacion->id_recepcion) {{ $licencia->inspeccion->planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo de Solicitud</strong>@if ($licencia->inspeccion->planificacion->id_recepcion) {{$licencia->inspeccion->planificacion->recepcion->categoria }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Latitud: </strong>@if ($licencia->inspeccion->planificacion->id_recepcion) {{ $licencia->inspeccion->planificacion->recepcion->latitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Longitud: </strong>@if ($licencia->inspeccion->planificacion->id_recepcion) {{ $licencia->inspeccion->planificacion->recepcion->longitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Direccion: </strong>@if ($licencia->inspeccion->planificacion->id_recepcion) {{ $licencia->inspeccion->planificacion->recepcion->direccion }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($licencia->inspeccion->planificacion->id_recepcion) {{ $licencia->inspeccion->planificacion->recepcion->mineral->nombre }} @endif</p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos del Comisionado</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($licencia->inspeccion->id_planificacion) {{ $licencia->inspeccion->planificacion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Cedula </strong>@if ($licencia->inspeccion->id_planificacion) {{ $licencia->inspeccion->planificacion->comisionados->cedula }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Nombres y Apellidos </strong>@if ($licencia->inspeccion->id_planificacion) {{ $licencia->inspeccion->planificacion->comisionados->nombres }} {{ $licencia->inspeccion->planificacion->comisionados->apellidos }}@endif</p>
                                            
                                        </div>
                                        
                                    </div>


                                </div>
                            </div>
                        </div>

                    </div>

                            <div class="card-body" id="inputs_aprovechamiento">

                                <div class="row">

                                    <input type="hidden" class="form-control" id="id_licencia" name="id_licencia" style="background: white;" value="{{ isset($licencia->id)?$licencia->id:'' }}" placeholder="" autocomplete="off">                                  

                                    <div class="col-4">
                                        <label for="persona" class="font-weight-bold text-primary">Tasa de Regalias</label>
                                        <select class="select2-single form-control" id="id_regalia" name="id_regalia" onchange="calcularMonto()">
                                            <option value="0">Seleccione una tasa</option>
                                            @foreach($regalias as $regalia)
                                            <option value="{{ $regalia->id }}">{{ $regalia->monto }} - {{ $regalia->moneda_longitud }}</option>
                                        @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Monto Metro Cúbico</label>
                                        <input type="text" class="form-control" id="monto_apro" name="monto_apro" oninput="calcularMonto()" ></input>
                                    </div>

                                    <div class="col-3">
                                        <label  class="font-weight-bold text-primary">Metodo de Pago</label>
                                        <select class="select2single form-control" name="metodo_apro" id="metodo_apro" onchange="calcularMonto()">
                                            <option value="" selected="true" disabled>Seleccione un Metodo de Pago</option>
                                            <option value="Pago unico">Pago unico</option>
                                            <option value="Pago 1 parte">Pago 1 parte</option>
                                            <option value="Pago 2 parte">Pago 2 parte</option>
                                            <option value="Pago 3 parte">Pago 3 parte</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Total a Cancelar</label>
                                        <input type="text" class="form-control" id="resultado_apro" name="resultado_apro" readonly></input>
                                    </div>

                                </div>

                            </div>

                            <div class="card-body" id="inputs_procesamiento">

                                <div class="row">

                                    <div class="col-3">
                                        <label  class="font-weight-bold text-primary">Metodo de Pago</label>
                                        <select class="select2single form-control" name="metodo_pro" id="metodo_pro">
                                            <option value="" selected="true" disabled>Seleccione un Metodo de Pago</option>
                                            <option value="Pago unico">Pago unico</option>
                                            <option value="Hectárea 3%">Hectárea 3%</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Monto</label>
                                        <input type="text" class="form-control" id="monto_pro" name="monto_pro" oninput="capitalizarInput('')" ></input>
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Total a Cancelar</label>
                                        <input type="text" class="form-control" id="resultado_pro" name="resultado_pro" readonly></input>
                                    </div>


                                </div>

                            </div>

                            <hr class="sidebar-divider">

                            <div class="card-body">

                                <div class="row">

                                    <div class="grid grid-cols-1 mt-5 mx-7">
                                        <img id="miniaturas">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Comprobante</label>
                                        <input type="file" id="comprobante" name="comprobante[]" multiple class="btn btn-outline-info">
                                            <div id="pdf_container"></div>
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Pago</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_pago" name="fecha_pago" value="<?php echo date('d/m/Y'); ?>" class="form-control"  id="simpleDataInput">
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
                                                <input type="text" id="fecha_venci" name="fecha_venci" value="<?php echo date('d/m/Y'); ?>" class="form-control"  id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-3">
                                        <label  class="font-weight-bold text-primary">Estatus</label>
                                        <select class="select2single form-control" name="estatus_regalia" id="estatus_regalia">
                                            <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                            <option value="Aprobado">Aprobado</option>
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
                            <a  class="btn btn-info btn-lg" href="{{ url('pago_regalia') }}"><span class="icon text-white-50">
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
            const categoria = '{{$licencia->inspeccion->planificacion->recepcion->categoria}}';

            // Llamamos a la función para mostrar el div correcto
            mostrarDivCategoria(categoria);

    </script>

    {{-- * FUNCION PARA MOSTRAR El PDF --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#comprobante').change(function () {
                const pdfcontainer = document.getElementById('pdf_container');
                pdfcontainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos archivos

                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const embed = document.createElement('embed');
                        embed.src = e.target.result;
                        embed.type = 'application/pdf';
                        embed.style.width = '100%';
                        embed.style.height = '500px';
                        pdfcontainer.appendChild(embed);
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>

    {{-- * FUNCION PARA CALCULAR LOS METROS CÚBICOS DE LA TASA REGALIA APROVECHAMIENTO --}}

    <script>
        function calcularMonto() {
            const tasa = 1;
            const metrosCubicos = parseFloat(document.getElementById('monto_apro').value);
            const metodoPago = document.getElementById('metodo_apro').value;
            let total = metrosCubicos * tasa;
            let resultado_apro;

            switch(metodoPago) {
                case 'Pago unico':
                    resultado_apro = total;
                    break;
                case 'Pago 1 parte':
                    resultado_apro = total / 2;
                    break;
                case 'Pago 2 parte':
                    resultado_apro = total / 3;
                    break;
                case 'Pago 3 parte':
                    resultado_apro = total / 4;
                    break;
                default:
                    resultado_apro = 0;
            }

            document.getElementById('resultado_apro').value = `$${resultado_apro.toFixed(2)}`;
        }

    </script>

    {{-- * FUNCION PARA CALCULAR LA FECHA DE VENCIMIENTO DE PAGO DE REGALIA AUTOMATICAMENTE EN 45 DIAS  --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let fechaActual = new Date();
            let dia = fechaActual.getDate().toString().padStart(2, '0');
            let mes = (fechaActual.getMonth() + 1).toString().padStart(2, '0');
            let año = fechaActual.getFullYear();

            let fechaPagoStr = `${dia}/${mes}/${año}`;
            document.getElementById('fecha_pago').value = fechaPagoStr;
            console.log('Fecha de pago actualizada:', fechaPagoStr);

            let fechaVencimiento = new Date(fechaActual);
            fechaVencimiento.setDate(fechaActual.getDate() + 45);

            let diaVenci = fechaVencimiento.getDate().toString().padStart(2, '0');
            let mesVenci = (fechaVencimiento.getMonth() + 1).toString().padStart(2, '0');
            let añoVenci = fechaVencimiento.getFullYear();

            let fechaVenciStr = `${diaVenci}/${mesVenci}/${añoVenci}`;
            document.getElementById('fecha_venci').value = fechaVenciStr;
            console.log('Fecha de vencimiento calculada:', fechaVenciStr);
        });

        document.getElementById('fecha_pago').addEventListener('change', function() {
            console.log('Fecha de pago ingresada:', this.value);
            let fechaPago = new Date(this.value.split('/').reverse().join('-'));
            console.log('Fecha de pago convertida:', fechaPago);

            if (isNaN(fechaPago)) {
                console.error('Fecha de pago no válida');
                return;
            }

            let fechaVencimiento = new Date(fechaPago);
            fechaVencimiento.setDate(fechaPago.getDate() + 45);

            let dia = fechaVencimiento.getDate().toString().padStart(2, '0');
            let mes = (fechaVencimiento.getMonth() + 1).toString().padStart(2, '0');
            let año = fechaVencimiento.getFullYear();

            document.getElementById('fecha_venci').value = `${dia}/${mes}/${año}`;
            console.log('Fecha de vencimiento calculada:', document.getElementById('fecha_venci').value);
        });
    </script>

@endsection