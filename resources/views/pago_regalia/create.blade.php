@extends('layouts.index')

<title>@yield('title') Registrar Pago Regalias</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>


@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
    
                        <h2 class="font-weight-bold text-primary">Registrar Pago Regalias</h2>

                    </div>
 
                <form method="post" action="{{ route('pago_regalia.store') }}" enctype="multipart/form-data" onsubmit="return PagoRegalia (this)">
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

                  

                                            {{-- * INPUTS CORRESPONDIENTE A PAGOS EN APROVECHAMIENTO --}}

                            <div class="card-body" id="inputs_aprovechamiento">

                                <div class="row">

                                    <input type="hidden" class="form-control" id="id_licencia" name="id_licencia" style="background: white;" value="{{ isset($licencia->id)?$licencia->id:'' }}" placeholder="" autocomplete="off">                                  
                                    <input type="hidden" name="categoria_licencia" value="{{ $categoria }}">
                                    
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Cuotas de Pago</label>
                                        <select class="select2single form-control" name="metodo_apro" id="metodo_apro" onchange="calcularMonto()">
                                            <option value="" selected="true" disabled>Seleccione una Cuota de Pago</option>
                                            @if ($licencia) 
                                            <option value="{{ $licencia->metodo_licencia_apro }}" selected> 
                                                {{ $licencia->metodo_licencia_apro }}
                                            </option> 
                                        @endif
                                        </select>
                                    </div>
                                    
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Pago a Realizar</label>
                                        <select class="select2single form-control" name="pago_realizar_apro" id="pago_realizar_apro" onchange="ocultarFecha()">
                                            @if ($numeroPagos == 0)

                                                @if ($licencia->metodo_licencia_apro == "Pago unico")
                                                    <option value="Pago unico">Pago único</option>
                                                @else
                                                    <option value="1era parte">1era parte</option> 
                                                @endif
                                                
                                            @elseif ($numeroPagos == 1)
                                                <option value="2da parte">2da parte</option>
                                            @elseif ($numeroPagos == 2)
                                                <option value="3era parte">3era parte</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="persona" class="font-weight-bold text-primary">Tasa de Regalias</label>
                                        <select class="select2-single form-control" id="id_mineral" name="id_mineral" onchange="calcularMonto()">
                                            <option value="">Seleccione una tasa</option>
                                            @if ($numeroPagos == 0)
                                                @if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) 
                                                    <option value="{{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->id }}"> 
                                                        {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }} - 
                                                        {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->tasa }} 
                                                        {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->moneda_longitud }} 
                                                    </option>
                                                @endif
                                                <option value="convenio">Convenio</option>
                                            @elseif ($numeroPagos > 0)
                                                @if ($primerPago && is_null($tasaConvenio))
                                                    <option value="{{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->id }}"> 
                                                        {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }} - 
                                                        {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->tasa }} 
                                                        {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->moneda_longitud }} 
                                                    </option>
                                                @else
                                                    <option value="convenio">Convenio</option>
                                                @endif
                                            @endif
                                        </select>
                                        <input type="hidden" name="mineral_oculto" value="{{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->id }}">
                                    </div>

                                    <div class="col-4" style="display: none;" id="convenio_container">
                                        <label  class="font-weight-bold text-primary">Tasa Convenio ($)</label>
                                        <input type="text" class="form-control" id="tasa_convenio" name="tasa_convenio" value="{{isset($tasaConvenio)?$tasaConvenio:'' }}" oninput="calcularMonto()" onkeypress="return solonum(event);"></input>
                                    </div>
                                    
                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Cantidad Metro Cúbico</label>
                                        <input type="text" class="form-control" id="monto_apro" name="monto_apro" value="{{isset($licencia->id)?$licencia->comprobante_pago->inspeccion->volumen:'' }}" readonly oninput="calcularMonto()" onkeypress="return solonum(event);">
                                    </div>
                                    
                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Total a Cancelar</label>
                                        <input type="text" class="form-control" id="resultado_apro" name="resultado_apro" readonly>
                                    </div>
                                    
                                </div>

                            </div>


                                                 {{-- ? INPUTS CORRESPONDIENTE A PAGOS EN PROCESAMIENTO --}}

                            <div class="card-body" id="inputs_procesamiento">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Cuotas de Pago</label>
                                        <select class="select2single form-control" name="metodo_pro" id="metodo_pro">
                                            <option value="" selected="true" disabled>Seleccione una Cuota de Pago</option>
                                            @if ($licencia) 
                                            <option value="{{ $licencia->metodo_licencia_pro }}" selected> 
                                                {{ $licencia->metodo_licencia_pro }}
                                            </option> 
                                        @endif
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Pago a Realizar</label>
                                        <select class="select2single form-control" name="pago_realizar_pro" id="pago_realizar_pro"  onchange="ocultarFecha()">
                                            {{-- <option value=""  disabled>Seleccione el Pago a Realizar</option> --}}
                                            @for ($i = 1; $i <= $nroCuotas; $i++) 
                                                @if ($i == $numeroPagos + 1) 
                                                    <option value="Cuota {{ $i }}">Cuota {{ $i }}</option> 
                                                @endif
                                            @endfor
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="persona" class="font-weight-bold text-primary">Tasa de Regalias</label>
                                        <select class="select2-single form-control" id="id_mineral_pro" name="id_mineral_pro" onchange="calcularMontoPro()">
                                            <option value="">Seleccione una tasa</option>
                                        @if ($licencia->comprobante_pago->inspeccion->planificacion->id_recepcion) 
                                            <option value="{{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->id }}"> 
                                                {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }} - 
                                                {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->tasa }} 
                                                {{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->moneda_longitud }} 
                                            </option> 
                                        @endif
                                        </select>
                                    </div>


                                    @if ($licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre == "Roca caliza")
                                        
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Metodo de Control</label>
                                        <select class="select2single form-control" name="metodo_control_pro" id="metodo_control_pro">
                                       
                                            @if ($licencia->metodo_control_pro == "control_volumen")
                                                 <option value="control_volumen" selected="true">Control volumen</option>
                                            @elseif ($licencia->metodo_control_pro == "control_declaracion")
                                                <option value="control_declaracion" selected="true">Control declaración</option>
                                            @endif
                                        </select>
                                    </div>

                                        @if ($licencia->metodo_control_pro == "control_volumen")
                                            <div class="col-4">
                                                <label  class="font-weight-bold text-primary">Cantidad Metro Cúbico</label>
                                                <input type="text" class="form-control" id="monto_pro" name="monto_pro" oninput="calcularMontoPro()" onkeypress="return solonum(event);"></input>
                                            </div>
                                        @elseif ($licencia->metodo_control_pro == "control_declaracion")
                                            <div class="col-4">
                                                <label  class="font-weight-bold text-primary">Monto Declaración</label>
                                                <input type="text" class="form-control" id="monto_decl" name="monto_decl" oninput="calcularMontoPro()" onkeypress="return solonum(event);"></input>
                                            </div>
                                        @endif
                                    @else
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Cantidad Metro Cúbico</label>
                                            <input type="text" class="form-control" id="monto_pro" name="monto_pro" oninput="calcularMontoPro()" onkeypress="return solonum(event);"></input>
                                        </div>
                                    @endif

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Total a Cancelar</label>
                                        <input type="text" class="form-control" id="resultado_pro" name="resultado_pro" readonly></input>
                                    </div>

                                </div>

                            </div>

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

                                    <div class="col-4" id="input_aprovechamiento" style="display: none">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha de Vencimiento</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_aprovechamiento" name="fecha_venci_apro" value="<?php echo date('d/m/Y'); ?>" class="form-control"  id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4" id="input_procesamiento" style="display: none">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha de Vencimiento</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_procesamiento" name="fecha_venci_pro" value="<?php echo date('d/m/Y'); ?>" class="form-control"  id="simpleDataInput">
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
            const categoria = '{{$licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria}}';

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
            const mineralSelect = document.getElementById('id_mineral');
            const selectedOption = mineralSelect.options[mineralSelect.selectedIndex];
            const tasa = selectedOption.value === 'convenio' ? 0 : parseFloat(selectedOption.text.split('-')[1].trim()) || 0;
            const tasaConvenio = parseFloat(document.getElementById('tasa_convenio').value) || 0;
            const metrosCubicos = parseFloat(document.getElementById('monto_apro').value) || 0;
            const metodoPago = document.getElementById('metodo_apro').value;
            
            let total = metrosCubicos * tasa;
            let totalConvenio = metrosCubicos * tasaConvenio;
            let resultado_apro;
    
            switch(metodoPago) {
                case 'Pago unico':
                    resultado_apro = tasa != 0 ? total : totalConvenio;
                    break;
                case 'Pago 2 parte':
                    resultado_apro = tasa != 0 ? total / 2 : totalConvenio / 2;
                    break;
                case 'Pago 3 parte':
                    resultado_apro = tasa != 0 ? total / 3 : totalConvenio / 3;
                    break;
                default:
                    resultado_apro = 0;
            }
    
            document.getElementById('resultado_apro').value = `$${resultado_apro.toFixed(2)}`;
            
            // Mostrar u ocultar el contenedor de convenio basado en la selección
            const convenioContainer = document.getElementById('convenio_container');
            if (selectedOption.value === 'convenio') {
                convenioContainer.style.display = 'block';
            } else {
                convenioContainer.style.display = 'none';
            }
        }
    
        // Inicializar la visualización correcta basado en el valor inicial del select
        document.addEventListener("DOMContentLoaded", function() {
            calcularMonto();
        });

    </script>
        

    {{-- ! FUNCIÓN PARA CALCULAR EL 3% SEGUN EL VOLUMEN/DECLARACION EN PROCESAMIENTO --}}

    

    <script>
        function calcularMontoPro() {
            const mineral = '{{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }}'; // Obtener el nombre del mineral desde Laravel
            const montoDeclInput = document.getElementById('monto_decl');
            const resultadoProInput = document.getElementById('resultado_pro');
            const mineralProSelect = document.getElementById('id_mineral_pro');
            const montoProInput = document.getElementById('monto_pro');
            const tasa_pro = '{{ $licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->tasa }}';
            const metodo_control_pro ='{{ $licencia->metodo_control_pro }}';
            
            let totalACancelar = 0;
    
            if (mineral === 'Roca caliza') {
                if (metodo_control_pro == 'control_volumen') {
                    const tasa = parseFloat(tasa_pro) || 0;
                    const monto = parseFloat(montoProInput.value) || 0;

                    console.log(tasa, monto);
                    totalACancelar = (monto * tasa) * 0.03;
                    resultadoProInput.value = `$${totalACancelar.toFixed(2)}`;
                } else  {
                    const montoDecl = parseFloat(montoDeclInput.value) || 0;
                    totalACancelar = montoDecl * 0.03;
                    resultadoProInput.value = `$${totalACancelar.toFixed(2)}`;
                } 
                       
            } else {
                const tasa = parseFloat(tasa_pro) || 0;
                const monto = parseFloat(montoProInput.value) || 0;

                console.log(tasa, monto);
                totalACancelar = (monto * tasa) * 0.03;
                resultadoProInput.value = `$${totalACancelar.toFixed(2)}`;
            }
            
            console.log(totalACancelar);
            resultadoProInput.value = `$${totalACancelar.toFixed(2)}`;
        }
    
        // Asignar el evento oninput al campo monto_decl para que se ejecute la función al cambiar su valor
        document.getElementById('monto_decl').addEventListener('input', calcularMontoPro);
        document.getElementById('monto_pro').addEventListener('input', calcularMontoPro);
        document.getElementById('id_mineral_pro').addEventListener('change', calcularMontoPro);
    </script>
    

    {{-- * FUNCION PARA CALCULAR LA FECHA DE VENCIMIENTO DE PAGO DE REGALIA, PARA APROVECHAMIENTO LOS PROXIMOS 45 DIAS, Y PROCESAMIENTO LOS PRIMEROS 5 DIAS DE CADA MES --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const categoria = '{{$licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria}}';
            mostrarCampos(categoria);

            if (categoria === 'Aprovechamiento') {
                let fechaActual = new Date();
                let dia = fechaActual.getDate().toString().padStart(2, '0');
                let mes = (fechaActual.getMonth() + 1).toString().padStart(2, '0');
                let año = fechaActual.getFullYear();

                let fechaPagoStr = `${dia}/${mes}/${año}`;
                document.getElementById('fecha_aprovechamiento').value = fechaPagoStr;

                let fechaVencimiento = new Date(fechaActual);
                fechaVencimiento.setDate(fechaActual.getDate() + 45);

                let diaVenci = fechaVencimiento.getDate().toString().padStart(2, '0');
                let mesVenci = (fechaVencimiento.getMonth() + 1).toString().padStart(2, '0');
                let añoVenci = fechaVencimiento.getFullYear();

                let fechaVenciStr = `${diaVenci}/${mesVenci}/${añoVenci}`;
                document.getElementById('fecha_aprovechamiento').value = fechaVenciStr;
    
            } else if (categoria === 'Procesamiento') {
                let fechaActual = new Date();
                let mesSiguiente = fechaActual.getMonth() + 1;
                let año = fechaActual.getFullYear();

                if (mesSiguiente > 11) {
                    mesSiguiente = 0;
                    año += 1;
                }

                let diaProcesamiento = '05';
                let mesProcesamiento = (mesSiguiente + 1).toString().padStart(2, '0');
                let fechaProcesamientoStr = `${diaProcesamiento}/${mesProcesamiento}/${año}`;
                document.getElementById('fecha_procesamiento').value = fechaProcesamientoStr;
            
            }
        });

            function mostrarCampos(condicion) {
                var select = document.getElementById('pago_realizar_apro');
                var aprovechamiento = document.getElementById('input_aprovechamiento');
                var procesamiento = document.getElementById('input_procesamiento');

                if (condicion === 'Aprovechamiento') {
                    aprovechamiento.style.display = 'block';
                    procesamiento.style.display = 'none';  
                } else if (condicion === 'Procesamiento') {
                    aprovechamiento.style.display = 'none';
                    procesamiento.style.display = 'block';
                }
            }


            function ocultarFecha() {
                var select = document.getElementById('pago_realizar_apro');
                var selectPro = document.getElementById('pago_realizar_pro');
                var inputFecha = document.getElementById('input_aprovechamiento');
                var inputFechaPro = document.getElementById('input_procesamiento');
                var pagos = '{{ $numeroPagos }}';
                var cuotas = '{{ $nroCuotas }}';
                var metodo_apro = document.getElementById('metodo_apro').value;
                var metodo_pro = document.getElementById('metodo_pro').value;

                console.log(pagos, cuotas);
                
                if (select.value === 'Pago unico' || 
                    (metodo_apro === 'Pago 2 parte' && select.value === '2da parte' && pagos == 1) || 
                    (metodo_apro === 'Pago 3 parte' && select.value === '3era parte' && pagos == 2)) {
                    
                    inputFecha.style.display = 'none';
                } 
                else if (metodo_pro == 'Pago cuotas') {
                    
                    if (selectPro.value.includes("Cuota") && (pagos == cuotas - 1)) {
                        inputFechaPro.style.display = 'none';
                    } else {
                        inputFechaPro.style.display = 'block'; 
                    }
                      
                } else {
                    inputFecha.style.display = 'block';
                }

            }

            // Llama a ocultarFecha() después de mostrarCampos() cuando la página se carga
        document.addEventListener('DOMContentLoaded', function() {
            const categoria = '{{$licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria}}';
            mostrarCampos(categoria);
            ocultarFecha(); // Asegúrate de llamar a ocultarFecha() aquí también
        });

    </script>


    {{-- ? FUNCION PARA MOSTRAR EL ALERTA  --}}

    @if ($errors->any())
            <script>
                var errors = @json($errors->all());
                errors.forEach(function(error) {
                    Swal.fire({
                        title: 'Pago de regalia',
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


    





