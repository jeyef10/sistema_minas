@extends('layouts.index')

<title>@yield('title') Actualizar Comprobante de Pago</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
    
                        <h2 class="font-weight-bold text-primary">Actualizar Aprobación de Licencia </h2>

                    </div>
 
                <form method="post" id="comprobantepago" action="{{ route('comprobantepago.update', $comprobante_pago->id) }}" enctype="multipart/form-data" onsubmit="return ComprobantePago(this)" >
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
                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $comprobante_pago->inspeccion->planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo Solicitante: </strong>@if ($comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Solicitante: </strong>
                                            @if ($comprobante_pago->inspeccion->planificacion->id_recepcion && $comprobante_pago->inspeccion->planificacion->recepcion->solicitante)
                                                @if ($comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}
                                                @else
                                                    {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}
                                                @endif
                                            @endif
                                            </p>
                                            <p style="margin-left: 0.5%"><strong>Cédula/Rif: </strong>
                                            @if ($comprobante_pago->inspeccion->planificacion->id_recepcion && $comprobante_pago->inspeccion->planificacion->recepcion->solicitante)
                                                @if ($comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo == "Natural")
                                                    {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }}
                                                @else
                                                    {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->rif }}
                                                @endif
                                            @endif
                                            </p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos de la Solicitud</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $comprobante_pago->inspeccion->planificacion->recepcion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Tipo de Solicitud</strong>@if ($comprobante_pago->inspeccion->planificacion->id_recepcion) {{$comprobante_pago->inspeccion->planificacion->recepcion->categoria }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Latitud: </strong>@if ($comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $comprobante_pago->inspeccion->planificacion->recepcion->latitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Longitud: </strong>@if ($comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $comprobante_pago->inspeccion->planificacion->recepcion->longitud }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Direccion: </strong>@if ($comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $comprobante_pago->inspeccion->planificacion->recepcion->direccion }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($comprobante_pago->inspeccion->planificacion->id_recepcion) {{ $comprobante_pago->inspeccion->planificacion->recepcion->mineral->nombre }} @endif</p>

                                            <p style="text-align: center" class="font-weight-bold text-primary">Datos del Comisionado</p>

                                            <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($comprobante_pago->inspeccion->id_planificacion) {{ $comprobante_pago->inspeccion->planificacion->id }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Cedula </strong>@if ($comprobante_pago->inspeccion->id_planificacion) {{ $comprobante_pago->inspeccion->planificacion->comisionados->cedula }} @endif</p>
                                            <p style="margin-left: 0.5%"><strong>Nombres y Apellidos </strong>@if ($comprobante_pago->inspeccion->id_planificacion) {{ $comprobante_pago->inspeccion->planificacion->comisionados->nombres }} {{  $comprobante_pago->inspeccion->planificacion->comisionados->apellidos }}@endif</p>
                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                
                        <div class="card-body">

                            <div class="row">

                                <input type="hidden" class="form-control" id="id_inspeccion" name="id_inspeccion" style="background: white;" value="{{ isset($comprobante_pago->inspeccion->id)?$comprobante_pago->inspeccion->id:'' }}" placeholder="" autocomplete="off">                                  
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">N° de Oficio de Aprobación</label>
                                    <input type="text" class="form-control" id="nro_oficio" name="nro_oficio" value="{{ isset($comprobante_pago->nro_oficio)?$comprobante_pago->nro_oficio:'' }}" oninput="capitalizarInput('')" onkeypress="return solonum(event);"></input>                                 
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Oficio de Aprobación</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="fecha_oficio" name="fecha_oficio" class="form-control" value="{{ date('d/m/Y', strtotime($comprobante_pago->fecha_oficio) )}}" id="simpleDataInput">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Estatus Oficio de Aprobación</label>
                                    <select class="select2single form-control" name="estatus_oficio" id="estatus_oficio">
                                        <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                        <option value="Aprobado" {{ (old('estatus', $comprobante_pago->estatus_oficio ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                        {{-- <option value="Negado" {{ (old('estatus', $comprobante_pago->estatus_oficio ?? '') === 'Negado') ? 'selected' : '' }}>Negado</option> --}}
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre de Titular de Firma</label>
                                    <input type="text" class="form-control" id="nombre_firma" name="nombre_firma" value="{{ $nombre_firma }}" oninput="capitalizarInput('')" onkeypress="return soloLetras(event);"></input>                                 
                                </div>

                                </div>

                            </div>

                                <hr class="sidebar-divider">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
            
                                    <h5 class="font-weight-bold text-primary">Datos de Pago</h5>
            
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                
                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Pago</label>
                                    <select class="select2-single form-control" id="tipo_pago" name="id_tipo_pago">
                                        <option value="0">Seleccione un Tipo de Pago</option>
                                        @foreach($tipo_pagos as $tipo_pago)
                                            <option value="{{ $tipo_pago->id }}" @if (old('id_tipo_pago', $comprobante_pago->id_tipo_pago) == $tipo_pago->id) selected @endif>
                                            {{ $tipo_pago->forma_pago }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-4" id="banco_container">
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Banco</label>
                                    <select class="select2-single form-control" id="banco" name="id_banco">
                                        <option value="">Seleccione un Tipo de Banco</option>
                                        @foreach($bancos as $banco)
                                            <option value="{{ $banco->id }}" @if (old('id_banco', $comprobante_pago->id_banco) == $banco->id) selected @endif>
                                            {{ $banco->codigo_banco }} - {{ $banco->nombre_banco }}
                                        </option>
                                        @endforeach
                                    </select>

                                </div>

                                <div class="col-4" id="referencia_container">
                                    <label class="font-weight-bold text-primary">N° Referencia</label>
                                    <input type="text" class="form-control" id="n_referencia" name="n_referencia" style="background: white;" value="{{ isset($comprobante_pago->n_referencia)?$comprobante_pago->n_referencia:'' }}" placeholder="Ingrese la Referencia" autocomplete="off" onkeypress="return solonum(event);" >
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
                                    <input type="file" id="comprobante_pdf" name="comprobante_pdf[]" multiple value="{{ $comprobante_pdf }}" class="btn btn-outline-info">
                                    <div id="pdf_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Observaciones</label>
                                    <textarea class="form-control" id="observaciones_com" name="observaciones_com" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('observaciones')">{{ $observaciones_com }}</textarea>                                   
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha de Pago</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="fecha_pago" name="fecha_pago" class="form-control" value="{{ $fecha_pago }}" id="simpleDataInput">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-primary">Timbres Fiscales</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="timbre_fiscal" id="natural" value="Si" {{ ($comprobante_pago->timbre_fiscal=="Si")? "checked" : ""}} onchange="toggleObservaciones(this.value)">
                                            <label class="form-check-label" for="natural">Si</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="timbre_fiscal" id="juridico" value="No" {{ ($comprobante_pago->timbre_fiscal=="No")? "checked" : ""}} onchange="toggleObservaciones(this.value)">
                                            <label class="form-check-label" for="juridico">No</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-4" id="observaciones_div" style="display: none;">
                                    <label class="font-weight-bold text-primary">Observaciones Fiscales</label>
                                    <textarea class="form-control" id="observaciones_fiscal" name="observaciones_fiscal" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('observaciones_fiscal')">{{ $observaciones_fiscal }}</textarea>
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

    {{-- ? FUNCION PARA MANTENER LA FECHA ACTUALIZADA EN EL CALENDARIO --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var dateInput = document.getElementById('fecha_pago');
            var today = new Date().toISOString().split('T')[0]; // Formato YYYY-MM-DD
    
            dateInput.addEventListener('focus', function() {
                if (!dateInput.value) {
                    dateInput.value = today;
                }
            });
        });
    </script>

    {{-- * FUNCION PARA MOSTRAR EL PDF --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>

        $(document).ready(function () {
            const pdfs = JSON.parse(@json($comprobante_pdf)); // Decodifica el JSON de los PDFs
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
            $('#comprobante_pdf').change(function () {
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

    {{-- * FUNCION PARA MOSTRAR/OCULTAR LOS CAMPOS DE BANCO Y REFERENCIA SEGUN LO QUE SE SELECCIONE EN TIPO DE PAGO --}}
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const tipoPagoSelect = document.getElementById("tipo_pago");
        const bancoContainer = document.getElementById("banco_container");
        const referenciaContainer = document.getElementById("referencia_container");
        const bancoField = document.getElementById("banco");
        const referenciaField = document.getElementById("n_referencia");

        function toggleContainers() {
            const selectedOption = tipoPagoSelect.options[tipoPagoSelect.selectedIndex].text;

            if (selectedOption === "Efectivo") {
                bancoContainer.style.display = "none";
                referenciaContainer.style.display = "none";
                bancoField.value = "";
                referenciaField.value = "";
            } else {
                bancoContainer.style.display = "block";
                referenciaContainer.style.display = "block";
            }
        }

        // Ejecutar la función al cargar la página
        toggleContainers();

        // Añadir el evento change al select de tipo de pago
        tipoPagoSelect.addEventListener("change", toggleContainers);
    });


    </script>

    {{-- * FUNCION PARA MOSTRAR LA OSBVARCIONES FISCAL CAUNDO SELECCIONE SI AL TIMBRE FISCAL --}}

    <script>

        function toggleObservaciones(value) {
            var observacionesDiv = document.getElementById('observaciones_div');
            if (value === 'Si') {
                observacionesDiv.style.display = 'block';
            } else {
                observacionesDiv.style.display = 'none';
            }
        }
        
        // Inicializa el estado del campo de observaciones al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            var selectedValue = document.querySelector('input[name="timbre_fiscal"]:checked');
            if (selectedValue) {
                toggleObservaciones(selectedValue.value);
            }
        });
        
    </script>

    <script>
        function validarTimbreFiscal() {
            const timbreFiscal = document.querySelector('input[name="timbre_fiscal"]:checked');
        
            if (!timbreFiscal) {
                Swal.fire({
                    title: 'Timbres Fiscales',
                    text: "Debe seleccionar una opción de Timbres Fiscales.",
                    icon: 'warning',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Se puede hacer alguna acción adicional aquí si es necesario
                    }
                });
        
                return false;
            }
        
            return true;
        }
        
        // Asegúrate de llamar a esta función al enviar el formulario
        document.getElementById('comprobantepago').onsubmit = function() {
            return validarTimbreFiscal();
        };
    </script>

@if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Comprobante de Pago',
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