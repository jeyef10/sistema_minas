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
    
                        <h2 class="font-weight-bold text-primary">Actualizar Comprobante de Pago de Licencia </h2>

                    </div>
 
                <form method="post" action="{{ route('comprobantepago.update', $comprobante_pago->id) }}" enctype="multipart/form-data" onsubmit="return Licencia(this)" >
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
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Pago</label>
                                    <select class="select2-single form-control" id="tipo_pago" name="id_tipo_pago">
                                        <option value="0">Seleccione un Tipo de Pago</option>
                                        @foreach($tipo_pagos as $tipo_pago)
                                            <option value="{{ $tipo_pago->id }}" @if (old('id_tipo_pago', $comprobante_pago->id_tipo_pago) == $tipo_pago->id) selected @endif>
                                            {{ $tipo_pago->nombre_pago }} - {{ $tipo_pago->forma_pago }}
                                        </option>
                                        @endforeach
                                    </select>
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

                                <input type="hidden" name="estatus_pago" value="Aprobado">

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
                iframe.style.width = '100%'; // Asegura que el iframe ocupe todo el div
                iframe.style.height = '200px'; // Altura fija para el iframe
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