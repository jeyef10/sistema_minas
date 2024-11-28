@extends('layouts.index')

<title>@yield('title') Actualizar Pago de Regalia</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
    
                        <h2 class="font-weight-bold text-primary">Actualizar Pago de Regalía</h2>

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

                                                        {{-- *  INPUTS CORRESPONDIENTE A PAGOS EN APROVECHAMINETO --}}
                
                            <div class="card-body" id="inputs_aprovechamiento">

                                <div class="row">

                                    <input type="hidden" class="form-control" id="id_licencia" name="id_licencia" style="background: white;" value="{{ isset($pago_regalia->licencia->id)?$pago_regalia->licencia->id:'' }}" placeholder="" autocomplete="off">                                  
                                    <input type="hidden" name="categoria_licencia" value="{{ $categoria }}">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Cuotas de Pago</label>
                                        <select class="select2single form-control" name="metodo_apro" id="metodo_apro" onchange="calcularMonto()">
                                            <option value="" selected="true" disabled>Seleccione una Cuota de Pago</option>
                                            @if ($pago_regalia->licencia) 
                                                <option value="{{ $pago_regalia->licencia->metodo_licencia_apro }}" selected> 
                                                    {{ $pago_regalia->licencia->metodo_licencia_apro }}
                                                </option> 
                                            @endif
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Pago a Realizar</label>
                                        <select class="select2single form-control" name="pago_realizar" id="pago_realizar">
                                            <option value="{{ $pago_regalia->pago_realizar }}" selected> 
                                                {{ $pago_regalia->pago_realizar}}
                                            </option> 
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="persona" class="font-weight-bold text-primary">Tasa de Regalias</label>
                                        <select class="select2-single form-control" id="id_mineral" name="id_mineral" onchange="calcularMonto()">
                                            <option value="">Seleccione una tasa</option>
                                               @if ($numeroPagos == 1)
                                                    @if ($pago_regalia->tasa_convenio == '')
                                                        <option value="{{ $mineral->id }}" selected>
                                                            {{ $mineral->nombre }} - {{ $mineral->tasa }} {{ $mineral->moneda_longitud }}
                                                        </option>
                                                        <option value="convenio">Convenio</option>
                                                    @else
                                                        <option value="{{ $mineral->id }}">
                                                            {{ $mineral->nombre }} - {{ $mineral->tasa }} {{ $mineral->moneda_longitud }}
                                                        </option>
                                                        <option value="convenio" selected>Convenio</option> 
                                                    @endif
                                               @elseif ($numeroPagos > 1)
                                                    @if ($pago_regalia->tasa_convenio == '')
                                                        <option value="{{ $mineral->id }}" selected>
                                                            {{ $mineral->nombre }} - {{ $mineral->tasa }} {{ $mineral->moneda_longitud }}
                                                        </option>
                                                    @else
                                                        <option value="convenio" selected>Convenio</option> 
                                                    @endif
                                               @endif
                                        </select>
                                        <input type="hidden" name="mineral_oculto" value="{{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->id }}">
                                    </div>

                                    <div class="col-4" style="display: none;" id="convenio_container">
                                        <label  class="font-weight-bold text-primary">Tasa Convenio ($)</label>
                                        <input type="text" class="form-control" id="tasa_convenio" name="tasa_convenio" value="{{ isset($pago_regalia->tasa_convenio)?$pago_regalia->tasa_convenio:'' }}" oninput="calcularMonto()" ></input>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Cantidad Metro Cúbico</label>
                                        <input type="text" class="form-control" id="monto_apro" name="monto_apro" value="{{ isset($pago_regalia->monto_apro)?$pago_regalia->monto_apro:'' }}" readonly oninput="calcularMonto()" ></input>
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Total a Cancelar</label>
                                        <input type="text" class="form-control" id="resultado_apro" name="resultado_apro" value="{{ isset($pago_regalia->resultado_apro)?$pago_regalia->resultado_apro:'' }}" readonly></input>
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
                                                @if ($pago_regalia->licencia) 
                                                    <option value="{{ $pago_regalia->licencia->metodo_licencia_pro }}" selected> 
                                                        {{ $pago_regalia->licencia->metodo_licencia_pro }}
                                                    </option> 
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Pago a Realizar</label>
                                            <select class="select2single form-control" name="pago_realizar" id="pago_realizar">
                                                <option value="{{ $pago_regalia->pago_realizar }}" selected> 
                                                    {{ $pago_regalia->pago_realizar}}
                                                </option> 
                                            </select>
                                        </div>
    
                                        <div class="col-4">
                                            <label for="persona" class="font-weight-bold text-primary">Tasa de Regalias</label>
                                            <select class="select2-single form-control" id="id_mineral_pro" name="id_mineral_pro" onchange="calcularMontoPro()">
                                                <option value="">Seleccione una tasa</option>
                                                @if ($pago_regalia->mineral)
                                                    <option value="{{ $mineral->id }}" {{ $mineral->id == $pago_regalia->id_mineral ? 'selected' : '' }}>
                                                        {{ $mineral->nombre }} - {{ $mineral->tasa }} {{ $mineral->moneda_longitud }}
                                                    </option>
                                                @endif
                                            </select>
                                        </div>

                                        @if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre == "Roca caliza")
                                        
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Metodo de Control</label>
                                            <select class="select2single form-control" name="metodo_control_pro" id="metodo_control_pro">
                                                {{-- <option value="" selected="true" disabled>Seleccione un Metodo de Control</option> --}}
                                                @if ($pago_regalia->licencia->metodo_control_pro == "control_volumen")
                                                    <option value="control_volumen" selected="true">Control volumen</option>
                                                @elseif ($pago_regalia->licencia->metodo_control_pro == "control_declaracion")
                                                    <option value="control_declaracion" selected="true">Control declaración</option>
                                                @endif
                                            </select>
                                        </div>

                                            @if ($pago_regalia->licencia->metodo_control_pro == "control_volumen")
                                                <div class="col-4">
                                                    <label  class="font-weight-bold text-primary">Cantidad Metro Cúbico</label>
                                                    <input type="text" class="form-control" id="monto_pro" name="monto_pro" value="{{ isset($pago_regalia->monto_pro)?$pago_regalia->monto_pro:'' }}" oninput="calcularMontoPro()"></input>
                                                </div>
                                            @elseif ($pago_regalia->licencia->metodo_control_pro == "control_declaracion")
                                                <div class="col-4">
                                                    <label  class="font-weight-bold text-primary">Monto Declaración</label>
                                                    <input type="text" class="form-control" id="monto_decl" name="monto_decl" value="{{ isset($pago_regalia->monto_decl)?$pago_regalia->monto_decl:'' }}" oninput="calcularMontoPro()"></input>
                                                </div>
                                            @endif
                                        @else
                                            <div class="col-4">
                                                <label  class="font-weight-bold text-primary">Cantidad Metro Cúbico</label>
                                                <input type="text" class="form-control" id="monto_pro" name="monto_pro" value="{{ isset($pago_regalia->monto_pro)?$pago_regalia->monto_pro:'' }}" oninput="calcularMontoPro()"></input>
                                            </div>
                                        @endif
    
                                        <div class="col-4">
                                            <label class="font-weight-bold text-primary">Total a Cancelar</label>
                                            <input type="text" class="form-control" id="resultado_pro" name="resultado_pro" value="{{ isset($pago_regalia->resultado_pro)?$pago_regalia->resultado_pro:'' }}" readonly></input>
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
                                        <input type="file" id="comprobante_pdf" name="comprobante[]" multiple value="{{ $comprobante }}" class="btn btn-outline-info">
                                        <div id="pdf_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha de Pago</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_pago" name="fecha_pago" value="{{ $fecha_pago }}" class="form-control" id="simpleDataInput">
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
                                                <input type="text" id="fecha_aprovechamiento" name="fecha_venci" value="{{ $fecha_venci }}" class="form-control"  id="simpleDataInput">
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
                                                <input type="text" id="fecha_procesamiento" name="fecha_venci" value="{{ $fecha_venci }}" class="form-control"  id="simpleDataInput">
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

        {{-- ! FUNCION PARA MOSTRAR EL PDF --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
 
         $(document).ready(function () {
             const pdfs = JSON.parse(@json($comprobante)); // Decodifica el JSON de los PDFs
             const pdfContainer = document.getElementById('pdf_container');
 
             // Función para crear un elemento PDF con botón de eliminación
             function createPdfElement(src) {
                 const div = document.createElement('div');
                 div.style.position = 'relative';
                 div.style.display = 'inline-block';
                 div.style.margin = '5px';
                 div.style.width = 'calc(50% - 10px)'; // Ajusta el ancho para dos columnas
                 div.style.boxSizing = 'border-box'; // Asegura que el margen no afecte el ancho total
 
                 const iframe = document.createElement('iframe');
                 iframe.src = src;
                 iframe.style.width = '200%'; // Asegura que el iframe ocupe todo el div
                 iframe.style.height = '400px'; // Altura fija para el iframe
                 iframe.style.display = 'block';
 
                 const btn = document.createElement('button');
                 btn.innerText = 'X';
                 btn.style.position = 'absolute';
                 btn.style.top = '0';
                 btn.style.right = '0';
                 btn.style.backgroundColor = 'black';
                 btn.style.color = 'white';
                 btn.style.border = 'none';
                 btn.style.borderRadius = '50%';
                 btn.style.cursor = 'pointer';
                 btn.style.transform = 'translate(-15%, 15%)';
                 btn.style.width = '20px';  // Ancho del botón
                 btn.style.height = '20px'; // Alto del botón
                 btn.style.fontSize = '12px';
 
                 btn.addEventListener('click', () => {
                     pdfContainer.removeChild(div);
                 });
 
                 div.appendChild(iframe);
                 div.appendChild(btn);
                 return div;
             }
 
             // Muestra los PDFs registrados
             pdfs.forEach(pdf => {
                 const pdfElement = createPdfElement(`{{ asset('pdf/') }}/${pdf}`);
                 pdfContainer.appendChild(pdfElement);
             });
 
             // Agrega nuevos PDFs seleccionados por el usuario
             $('#comprobante').change(function () {
                 for (const file of this.files) {
                     const reader = new FileReader();
                     reader.onload = (e) => {
                         const pdfElement = createPdfElement(e.target.result);
                         pdfContainer.appendChild(pdfElement);
                     };
                     reader.readAsDataURL(file);
                 }
             });
         });
 
    </script>

    {{-- ? FUNCION PARA CALCULAR LOS METROS CÚBICOS DE LA TASA REGALIA APROVECHAMIENTO --}}

    <script>

        function calcularMonto() {
            const mineralSelect = document.getElementById('id_mineral');
            const selectedOption = mineralSelect.options[mineralSelect.selectedIndex];
            const tasa = selectedOption.value === 'convenio' ? 0 : parseFloat(selectedOption.text.split('-')[1].trim()) || 0;
            const tasaConvenio = parseFloat(document.getElementById('tasa_convenio').value) || 0;
            const metrosCubicos = parseFloat(document.getElementById('monto_apro').value) || 0;
            const metodoPago = document.getElementById('metodo_apro').value;
            const tasaConvenioInput = document.getElementById('tasa_convenio');
            
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
                tasaConvenioInput.value = '';
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
            const mineral = '{{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }}'; // Obtener el nombre del mineral desde Laravel
            const montoDeclInput = document.getElementById('monto_decl');
            const resultadoProInput = document.getElementById('resultado_pro');
            const mineralProSelect = document.getElementById('id_mineral_pro');
            const montoProInput = document.getElementById('monto_pro');
            const tasa_pro = '{{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->mineral->tasa }}';
            const metodo_control_pro ='{{ $pago_regalia->licencia->metodo_control_pro }}';
            
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
            const categoria = '{{$pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria}}';
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


