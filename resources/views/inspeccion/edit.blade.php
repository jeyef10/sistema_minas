@extends('layouts.index')

<title>@yield('title') Actualizar Inspección</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
    
                        <h2 class="font-weight-bold text-primary" >Actualizar Inspección</h2>

                    </div>
 
                <form method="post" action="{{ route('inspeccion.update', $inspeccion->id) }}" enctype="multipart/form-data" onsubmit="return Inspeccion(this)" >
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
                                                <p style="margin-left: 0.5%"><strong>Dirección: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->direccion }} @endif</p>
                                                <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($inspeccion->planificacion->id_recepcion) {{ $inspeccion->planificacion->recepcion->mineral->nombre }} @endif</p>

                                            </div>
                                            
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                                                            
                            <div class="card-body">

                                <div class="row">

                                    <input type="hidden" class="form-control" id="id_planificacion" name="id_planificacion" style="background: white;" value="{{ isset($inspeccion->planificacion->id)?$inspeccion->planificacion->id:'' }}" placeholder="" autocomplete="off">                                  
                                                                                                           
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Municipio</label>
                                        <select class="select2-single form-control" id="municipio" name="municipio" disabled>
                                            <option value="0">Seleccione un municipio</option>
                                            @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id }}"@selected($inspeccion->planificacion->id_municipio == $municipio->id)>{{ $municipio->nom_municipio }}</option>
                                            @endforeach  
                                        </select>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Comisionado Asignado</label>
                                        <select class="select2-single form-control" id="comisionado" name="comisionado" disabled>
                                            <option value="0">Seleccione un comisionado</option>
                                            @foreach($comisionados as $comisionado)
                                            <option value="{{ $comisionado->id }}"@selected($inspeccion->planificacion->id_comisionado == $comisionado->id)>{{ $comisionado->cedula }}
                                                {{ $comisionado->nombres }} {{ $comisionado->apellidos }}
                                            </option>
                                            @endforeach  
                                        </select>                                   
                                    </div>
                                                
                                </div>

                            </div>
                           
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Funcionario Acompañante</label>
                                        <textarea class="form-control" id="funcionario" name="funcionario_acomp" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('funcionario')">{{ $funcionario_acomp }}</textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Observaciones</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('observaciones')">{{ $observaciones }}</textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Conclusiones</label>
                                        <textarea class="form-control" id="conclusiones" name="conclusiones" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('conclusiones')">{{ $conclusiones }}</textarea>                                   
                                    </div>

                                </div>

                            </div>
                           
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Latitud</label>
                                        <input type="text" class="form-control" id="latitud" name="latitud" style="background: white;" value="{{ isset($inspeccion->latitud)?$inspeccion->latitud:'' }}" placeholder="Ingrese la Latitud" autocomplete="off" onkeypress="return solonum(event);">                                  
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Longitud</label>
                                        <input type="text" class="form-control" id="longitud" name="longitud" style="background: white;" value="{{ isset($inspeccion->longitud)?$inspeccion->longitud:'' }}" placeholder="Ingrese la Longitud" autocomplete="off" onkeypress="return solonum(event);">                                  
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lugar</label>
                                        <textarea class="form-control" id="lugar_direccion" name="lugar_direccion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('lugar_direccion')">{{ $lugar_direccion }}</textarea>                                   
                                    </div>

                                    <div class="col-8">
                                        <div id="mapa" style="height: 350px; width:100%; display:block;"></div>
                                    </div>  

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">UTM Norte</label>
                                        <input type="text" class="form-control" id="utm_norte" name="utm_norte" style="background: white;" value="{{ isset($inspeccion->utm_norte)?$inspeccion->utm_norte:'' }}" placeholder="Ingrese la UTM Norte" autocomplete="off" onkeypress="return solonum(event);">                                  
                                    
                                        <label  class="font-weight-bold text-primary">UTM Este</label>
                                        <input type="text" class="form-control" id="utm_este" name="utm_este" style="background: white;" value="{{ isset($inspeccion->utm_este)?$inspeccion->utm_este:'' }}" placeholder="Ingrese la UTM Este" autocomplete="off" onkeypress="return solonum(event);">                           
                                    </div>
                                
                                </div>
                                
                            </div>
                           
                            <div class="card-body">

                                <div class="row">

                                    <div class="grid grid-cols-1 mt-5 mx-7">
                                        <img id="miniaturas">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Reseña Fotográfica</label>
                                        <input type="file" id="res_fotos" name="res_fotos[]" multiple value="{{ $res_fotos }}" class="btn btn-outline-info">
                                            <div id="foto_container" style="margin-top: 3%; display: flex; flex-wrap: wrap;"></div>
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_inspeccion" name="fecha_inspeccion" class="form-control" value="{{ $fecha_inspeccion }}" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    @if(auth()->user()->hasRole('Comisionado'))
                                        @if ($inspeccion->estatus_resp == "" || $inspeccion->estatus_resp == "Pendiente")
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Estatus Inspección</label>
                                            <select class="select2single form-control" name="estatus" id="estatus">
                                                <option value="0" selected="true" disabled>Seleccione un Estatus</option>
                                                <option value="Aprobado" {{ (old('estatus', $inspeccion->estatus ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                                <option value="Negado" {{ (old('estatus', $inspeccion->estatus ?? '') === 'Negado') ? 'selected' : '' }}>Negado</option>
                                            </select>
                                        </div>
                                        @endif
                                    @elseif(auth()->user()->hasRole('Administrador'))
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Estatus Inspección</label>
                                            <select class="select2single form-control" name="estatus" id="estatus">
                                                <option value="0" selected="true" disabled>Seleccione un Estatus</option>
                                                <option value="Aprobado" {{ (old('estatus', $inspeccion->estatus ?? '') === 'Aprobado') ? 'selected' : '' }}>Aprobado</option>
                                                <option value="Negado" {{ (old('estatus', $inspeccion->estatus ?? '') === 'Negado') ? 'selected' : '' }}>Negado</option>
                                            </select>
                                        </div>
                                    @endif
                                    
                                    @if(auth()->user()->hasRole('Administrador'))
                                        <div class="card-body" id="estatus_respuesta" style="display: none;">
                                            <label class="font-weight-bold text-primary">Estatus Aprobación</label>
                                            <div class="row">
                                                <div class="custom-control custom-radio col-1 mr-2"> 
                                                    <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_pen" value="Pendiente" {{ ($inspeccion->estatus_resp=="Pendiente")? "checked" : ""}}>
                                                    <label class="custom-control-label" for="estatus_resp_pen">Pendiente</label>
                                                </div>
                                                <div class="custom-control custom-radio col-1 mr-2">
                                                    <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_apro" value="Aprobado" {{ ($inspeccion->estatus_resp=="Aprobado")? "checked" : ""}}>
                                                    <label class="custom-control-label" for="estatus_resp_apro">Aprobado</label>
                                                </div>
                                                <div class="custom-control custom-radio col-1 mr-2">
                                                    <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_neg" value="Negado" {{ ($inspeccion->estatus_resp=="Negado")? "checked" : ""}}>
                                                    <label class="custom-control-label" for="estatus_resp_neg">Negado</label>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        {{-- <input type="hidden" name="estatus_resp" id="estatus_resp" value="Pendiente"> --}}
                                    @endif

                                </div>
                                
                            </div>
                        
                            <div class="card-body" id="inputs_aprovechamiento">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Longitud</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="longitud_terreno" name="longitud_terreno" style="background: white; width: 78%; margin-right: 2%;" value="{{ isset($inspeccion->longitud_terreno)?$inspeccion->longitud_terreno:'' }}" placeholder="Ingrese la Longitud" autocomplete="off" onkeypress="return solonum(event);">
                                                <select class="select2-single form-control" style="width: 20%" disabled>
                                                    <option value="mts" selected>mts</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Ancho Máximo</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="ancho" name="ancho" style="background: white; width: 78%; margin-right: 2%;" value="{{ isset($inspeccion->ancho)?$inspeccion->ancho:'' }}" placeholder="Ingrese el Ancho" autocomplete="off" onkeypress="return solonum(event);">
                                                <select class="select2-single form-control" style="width: 20%" disabled>
                                                    <option value="mts" selected>mts</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Profundidad Máxima</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="profundidad" name="profundidad" style="background: white; width: 78%; margin-right: 2%;" value="{{ isset($inspeccion->profundidad)?$inspeccion->profundidad:'' }}" placeholder="Ingrese la Profundidad" autocomplete="off" onkeypress="return solonum(event);">
                                                <select class="select2-single form-control" style="width: 20%" disabled>
                                                    <option value="mts" selected>mts</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Volumen a Extraer</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="volumen" name="volumen" style="background: white; width: 78%; margin-right: 2%;" value="{{ isset($inspeccion->volumen)?$inspeccion->volumen:'' }}" placeholder="Ingrese la Volumen" autocomplete="off" onkeypress="return solonum(event);">
                                                <select class="select2-single form-control" style="width: 20%" disabled>
                                                    <option value="m3" selected>m³</option>
                                                </select>
                                            </div>
                                    </div>

                                </div>

                            </div>

                            <div class="card-body" id="inputs_procesamiento">

                                <div class="row">
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lindero Norte</label>
                                        <input type="text" class="form-control" id="lind_norte" name="lindero_norte" style="background: white;" value="{{ isset($inspeccion->lindero_norte)?$inspeccion->lindero_norte:'' }}" placeholder="Ingrese El Lindero Norte" oninput="capitalizarInput('nombre')" autocomplete="off" >
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lindero Sur</label>
                                        <input type="text" class="form-control" id="lind_sur" name="lindero_sur" style="background: white;" value="{{ isset($inspeccion->lindero_sur)?$inspeccion->lindero_sur:'' }}" placeholder="Ingrese El Lindero Sur" oninput="capitalizarInput('nombre')" autocomplete="off" >
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lindero Este</label>
                                        <input type="text" class="form-control" id="lind_este" name="lindero_este" style="background: white;" value="{{ isset($inspeccion->lindero_este)?$inspeccion->lindero_este:'' }}" placeholder="Ingrese El Lindero Este" oninput="capitalizarInput('nombre')" autocomplete="off" >
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lindero Oeste</label>
                                        <input type="text" class="form-control" id="lind_oeste" name="lindero_oeste" style="background: white;" value="{{ isset($inspeccion->lindero_oeste)?$inspeccion->lindero_oeste:'' }}" placeholder="Ingrese El Lindero Oeste" oninput="capitalizarInput('nombre')" autocomplete="off" >
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Superficie</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="superficie" name="superficie" style="background: white; width: 78%; margin-right: 2%;" value="{{ isset($inspeccion->superficie)?$inspeccion->superficie:'' }}" placeholder="Ingrese la Superficie" autocomplete="off" onkeypress="return solonum(event);">
                                                <select class="select2-single form-control" style="width: 20%" disabled>
                                                    <option value="ha" selected>ha</option>
                                                </select>
                                            </div>
                                    </div>

                                </div>

                            </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('comprobantepago/') }}"><span class="icon text-white-50">
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
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js')}}"></script>

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

    {{-- * FUNCION PARA MOSTRAR COMISIONADOS SEGUN SU MUNICIPIO --}}

    <script>
        $('#municipio').change(function() {
        var municipioId = $(this).val(); // Get selected municipio ID

        if (municipioId) {
            $.ajax({
            url: '/inspeccion/create/fetchComisionados/'  + municipioId, // Replace with your actual API URL
            method: 'GET',
            success: function(data) {

               
                // Assuming data is an array of comisionado objects
                var options = '<option value="">Seleccione un Comisionado</option>';
                // var parroquiaInput = $('#parroquia'); // Get the parroquia select element

                data.forEach(function(comisionado) {
                options += '<option value="' + comisionado.id + '">' +
                    (comisionado.cedula || '') + ' - ' +
                    (comisionado.nombres || '') + ' ' +
                    (comisionado.apellidos || '') + '</option>';
                });

                $('#comisionado').html(options); // Update the 'Comisionado' select with new options
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

    {{-- * FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.6.2/proj4.js"></script>

        <script>
            proj4.defs([
                [
                    'EPSG:32619',
                    '+proj=utm +zone=19 +datum=WGS84 +units=m +no_defs'
                ]
            ]);
        </script>

    <script>

        let marcadorActual = null; // Variable global para almacenar el marcador actual
    
        function cargarMapaYMarcador() {
            // Obtener los valores de los inputs
            const latitud = parseFloat(document.getElementById('latitud').value);
            const longitud = parseFloat(document.getElementById('longitud').value);
    
            // Validar los datos
            if (isNaN(latitud) || isNaN(longitud)) {
                alert('Por favor, ingresa valores numéricos válidos para la latitud y longitud.');
                return;
            }
    
            // Crear el mapa
            const map = L.map('mapa').setView([latitud, longitud], 15); // Latitud y longitud iniciales
    
            // Agregar la capa base de OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
    
            // Declara una variable para el marcador
            let marcador;
    
            // Crear el marcador
           const marcadorActual = L.marker([latitud, longitud]).addTo(map);
    
                // Agregar evento click al mapa
                map.on('click', function(e) {
            // Eliminar el marcador anterior si existe
            if (marcadorActual) {
                 map.removeLayer(marcadorActual);
             }
    
            // Elimina cualquier marcador existente
            if (marcador) {
                    map.removeLayer(marcador);
                  }
          
            // Obtener las coordenadas del clic
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;
    
            // Crear un nuevo marcador y almacenarlo
            marcador = L.marker([lat, lng]).addTo(map);
                // .bindPopup('Nueva Inspección').openPopup();

            
            
            // Obtener la dirección utilizando Nominatim 
            fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                let estado = data.address.state;
                if (estado.includes('State')) {
                    estado = estado.replace(' State', '');
                }
                const lugar_direccion = data.address.road + ", " + data.address.postcode + ", " + data.address.county + ", "  + estado + ", " + data.address.country;
                    document.getElementById('lugar_direccion').textContent = lugar_direccion;
                });
            
            // Convierte las coordenadas a UTM
            const utmCoords = proj4('EPSG:4326', 'EPSG:32619', [lng, lat]); // EPSG:32619 es para la zona UTM 19N    
    
            // Actualizar los inputs
            document.getElementById('latitud').value = lat;
            document.getElementById('longitud').value = lng;
            document.getElementById('utm_norte').value = utmCoords[1];
            document.getElementById('utm_este').value = utmCoords[0];
        });
        }
        // Llamada a la función para cargar el mapa al inicio
        cargarMapaYMarcador();
    
        </script>

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    
    <script>
        $(document).ready(function () {
            const fotos = JSON.parse(@json($res_fotos)); // Decodifica el JSON de las fotos
            const fotoContainer = document.getElementById('foto_container');
    
            // Función para crear una imagen con botón de eliminación
            function createImageElement(src) {
                const div = document.createElement('div');
                div.style.position = 'relative';
                div.style.display = 'inline-block';
                div.style.margin = '5px';
                div.style.width = 'calc(50% - 10px)'; // Ajusta el ancho para dos columnas
                div.style.boxSizing = 'border-box'; // Asegura que el margen no afecte el ancho total
    
                const img = document.createElement('img');
                img.src = src;
                img.style.width = '100%'; // Asegura que la imagen ocupe todo el div
                img.style.height = 'auto'; // Mantiene la proporción de la imagen
                img.style.display = 'block';
    
                const btn = document.createElement('button');
                btn.innerText = 'X';
                // btn.classList.add('btn btn-danger btn-sm');
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
                    fotoContainer.removeChild(div);
                });
    
                div.appendChild(img);
                div.appendChild(btn);
                return div;
            }
    
            // Muestra las fotos registradas
            fotos.forEach(foto => {
                const imgElement = createImageElement(`{{ asset('imagen/') }}/${foto}`);
                fotoContainer.appendChild(imgElement);
            });
    
            // Agrega nuevas fotos seleccionadas por el usuario
            $('#res_fotos').change(function () {
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const imgElement = createImageElement(e.target.result);
                        fotoContainer.appendChild(imgElement);
                    };
                    reader.readAsDataURL(file);
                }
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

    {{-- * FUNCION PARA MOSTRAR/OCULTAR EL ESTATUS DE RESPUESTA Y ENVIAR EL VALUE OCULTO --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const estatusSelect = document.getElementById('estatus');
            const estatusRespuestaDiv = document.getElementById('estatus_respuesta');
    
            function toggleEstatusRespuesta() {
                const selectedValue = estatusSelect.value;
                if (selectedValue === 'Aprobado') {
                    estatusRespuestaDiv.style.display = 'block';
                } else {
                    estatusRespuestaDiv.style.display = 'none';
                }
            }
    
            // Ejecutar al cargar la página
            toggleEstatusRespuesta();
    
            // Ejecutar al cambiar la selección
            estatusSelect.addEventListener('change', toggleEstatusRespuesta);
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