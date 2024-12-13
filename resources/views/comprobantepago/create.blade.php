@extends('layouts.index')

<title>@yield('title') Registrar Comprobante</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>


@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
    
                        <h2 class="font-weight-bold text-primary">Registrar Aprobación de Licencia</h2>

                    </div>
 
                <form method="post" id="comprobantepago" action="{{ route('comprobantepago.store') }}" enctype="multipart/form-data" onsubmit="return ComprobantePago(this)">
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

                        <div class="card-body">

                            <div class="row">

                                <input type="hidden" class="form-control" id="id_inspeccion" name="id_inspeccion" style="background: white;" value="{{ isset($inspeccion->id)?$inspeccion->id:'' }}" placeholder="" autocomplete="off">                                  

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">N° de Oficio de Aprobación</label>
                                    <input type="text" class="form-control" id="nro_oficio" name="nro_oficio" oninput="capitalizarInput('')" onkeypress="return solonum(event);"></input>                                 
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Oficio de Aprobación</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="fecha_oficio" name="fecha_oficio" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Estatus Oficio de Aprobación</label>
                                    <select class="select2single form-control" name="estatus_oficio" id="estatus_oficio">
                                        <option value="" disabled>Seleccione un Estatus</option>
                                        <option value="Aprobado" selected="true">Aprobado</option>
                                        {{-- <option value="Negado">Negado</option> --}}
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre de Titular de Firma</label>
                                    <input type="text" class="form-control" id="nombre_firma" name="nombre_firma" oninput="capitalizarInput('')" onkeypress="return soloLetras(event);"></input>                                 
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
                                        <option value="{{ $tipo_pago->id }}">{{ $tipo_pago->forma_pago }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="col-4" id="banco_container">
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Banco</label>
                                    <select class="select2-single form-control" id="banco" name="id_banco">
                                        <option value="">Seleccione un Tipo de Banco</option>
                                        @foreach($bancos as $banco)
                                        <option value="{{ $banco->id }}"> {{ $banco->codigo_banco }} - {{ $banco->nombre_banco }} </option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="col-4" id="referencia_container">
                                    <label class="font-weight-bold text-primary">N° Referencia</label>
                                    <input type="text" class="form-control" id="n_referencia" name="n_referencia" style="background: white;" value="" placeholder="Ingrese la Referencia" autocomplete="off" onkeypress="return solonum(event);">
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
                                    <input type="file" id="comprobante_pdf" name="comprobante_pdf[]" multiple class="btn btn-outline-info">
                                        <div id="pdf_container"></div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Observaciones</label>
                                    <textarea class="form-control" id="observaciones_com" name="observaciones_com" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('observaciones')"> {{ old('observaciones') }} </textarea>                                   
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha de Pago</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="fecha_pago" name="fecha_pago" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-primary">Timbres Fiscales</label>
                                    <div class="form-group">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="timbre_fiscal" id="natural" value="Si" onchange="toggleObservaciones(this.value)">
                                            <label class="form-check-label" for="natural">Si</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="timbre_fiscal" id="juridico" value="No" onchange="toggleObservaciones(this.value)">
                                            <label class="form-check-label" for="juridico">No</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4" id="observaciones_div" style="display: none;">
                                    <label class="font-weight-bold text-primary">Observaciones Fiscales</label>
                                    <textarea class="form-control" id="observaciones_fiscal" name="observaciones_fiscal" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('observaciones_fiscal')"></textarea>
                                </div>
                                
                            </div>

                        </div>


                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('comprobantepago') }}"><span class="icon text-white-50">
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

    {{-- * FUNCION PARA MOSTRAR El PDF --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#comprobante_pdf').change(function () {
                const pdfcontainer = document.getElementById('pdf_container');
                pdfcontainer.innerHTML = ''; // Limpiar el contenedor antes de agregar nuevos archivos

                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const embed = document.createElement('embed');
                        embed.src = e.target.result;
                        embed.type = 'application/pdf';
                        embed.style.width = '100%';
                        embed.style.height = '400px';
                        pdfcontainer.appendChild(embed);
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

        tipoPagoSelect.addEventListener("change", function() {
            const selectedOption = tipoPagoSelect.options[tipoPagoSelect.selectedIndex].text;

            if (selectedOption === "Efectivo") {
                bancoContainer.style.display = "none";
                referenciaContainer.style.display = "none";
            } else {
                bancoContainer.style.display = "block";
                referenciaContainer.style.display = "block";
            }
        });
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
                    title: 'Pago de Licencia',
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
                title: 'Pago de Licencia',
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

