@extends('layouts.index')

<title>@yield('title') Registrar Inspección</title>
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
    
                        <h2 class="font-weight-bold text-primary">Registrar Inspección</h2>

                    </div>
 
                <form method="post" action="{{ route('inspeccion.store') }}" enctype="multipart/form-data" onsubmit="return Inspeccion(this)">
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
                                                    <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($planificacion->id_recepcion) {{ $planificacion->recepcion->id }} @endif</p>
                                                    <p style="margin-left: 0.5%"><strong>Tipo Solicitante: </strong>@if ($planificacion->id_recepcion) {{ $planificacion->recepcion->solicitante->tipo }} @endif</p>
                                                    <p style="margin-left: 0.5%"><strong>Solicitante: </strong>
                                                    @if ($planificacion->id_recepcion && $planificacion->recepcion->solicitante)
                                                        @if ($planificacion->recepcion->solicitante->tipo == "Natural")
                                                            {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}
                                                        @else
                                                            {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}
                                                        @endif
                                                    @endif
                                                    </p>
                                                    <p style="margin-left: 0.5%"><strong>Cédula/Rif: </strong>
                                                    @if ($planificacion->id_recepcion && $planificacion->recepcion->solicitante)
                                                        @if ($planificacion->recepcion->solicitante->tipo == "Natural")
                                                            {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }}
                                                        @else
                                                            {{ $planificacion->recepcion->solicitante->solicitanteEspecifico->rif }}
                                                        @endif
                                                    @endif
                                                    </p>
    
                                                    <p style="text-align: center" class="font-weight-bold text-primary">Datos de la Solicitud</p>
    
                                                    <p style="margin-left: 0.5%"><strong>Nº: </strong>@if ($planificacion->id_recepcion) {{ $planificacion->recepcion->id }} @endif</p>
                                                    <p style="margin-left: 0.5%"><strong>Tipo de Solicitud</strong>@if ($planificacion->id_recepcion) {{$planificacion->recepcion->categoria }} @endif</p>
                                                    <p style="margin-left: 0.5%"><strong>Latitud: </strong>@if ($planificacion->id_recepcion) {{ $planificacion->recepcion->latitud }} @endif</p>
                                                    <p style="margin-left: 0.5%"><strong>Longitud: </strong>@if ($planificacion->id_recepcion) {{ $planificacion->recepcion->longitud }} @endif</p>
                                                    <p style="margin-left: 0.5%"><strong>Dirección: </strong>@if ($planificacion->id_recepcion) {{ $planificacion->recepcion->direccion }} @endif</p>
                                                    <p style="margin-left: 0.5%"><strong>Mineral: </strong>@if ($planificacion->id_recepcion) {{ $planificacion->recepcion->mineral->nombre }} @endif</p>
    
                                                </div>
                                                
                                            </div>
                                
    
                                        </div>
                                    </div>
                                </div>

                            </div>
                                              
                            <div class="card-body">

                                <div class="row">

                                    <input type="hidden" class="form-control" id="id_planificacion" name="id_planificacion" style="background: white;" value="{{ isset($planificacion->id)?$planificacion->id:'' }}" placeholder="" autocomplete="off">                                  
                                   
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Municipio</label>
                                        <select class="select2-single form-control" id="municipio" name="municipio" disabled>
                                            <option value="0">Seleccione un municipio</option>
                                            @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id }}" @selected($planificacion->id_municipio == $municipio->id)>{{ $municipio->nom_municipio }}</option>
                                        @endforeach
                                        </select>                                   
                                    </div>

                                    <div class="col-4">
                                        <label for="comisionado" class="font-weight-bold text-primary">Comisionado asignado</label>
                                        <select class="select2-single form-control" id="comisionado" name="comisionado" disabled>
                                            <option value="0">Seleccione un comisionado</option>
                                            @foreach($comisionados as $comisionado)
                                            <option value="{{ $comisionado->id }}" @selected($planificacion->id_comisionado == $comisionado->id)> {{ $comisionado->cedula }} 
                                                {{ $comisionado->nombres }} {{ $comisionado->apellidos }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label for="comisionado" class="font-weight-bold text-primary">Fecha Inicial y Fecha Final</label>
                                        <select class="select2-single form-control"disabled>
                                            <option value="0">Seleccione una Fecha</option>
                                            @foreach($planificacion as $planificaciones)
                                            <option value="{{ $comisionado->id }}" @selected($planificacion->id == $planificacion->id)> {{ $planificacion->fecha_inicial }} - {{ $planificacion->fecha_final }} </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>

                            </div>  
                            
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Funcionario Acompañante</label>
                                        <textarea class="form-control" id="funcionario_acomp" name="funcionario_acomp" cols="10" rows="10" style="max-height: 6rem;"  oninput="capitalizarInput('funcionario_acomp')">{{ old('funcionario_acomp') }}</textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Observaciones</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('observaciones')">{{ old('observaciones') }}</textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Conclusiones</label>
                                        <textarea class="form-control" id="conclusiones" name="conclusiones" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('conclusiones')">{{ old('conclusiones') }}</textarea>                                   
                                    </div>

                                </div>

                            </div>
                         
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Latitud</label>
                                        <input type="text" class="form-control" id="latitud" name="latitud" style="background: white;" value="{{ old('latitud') }}" placeholder="Ingrese la Latitud" autocomplete="off" onkeypress="return solonum(event);">                                  
                                    </div>
    
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Longitud</label>
                                        <input type="text" class="form-control" id="longitud" name="longitud" style="background: white;" value="{{ old('longitud') }}" placeholder="Ingrese la Longitud" autocomplete="off" onkeypress="return solonum(event);">                                  
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lugar</label>
                                        <textarea class="form-control" id="lugar_direccion" name="lugar_direccion" cols="10" rows="10" style="max-height: 6rem;" oninput="capitalizarInput('lugar_direccion')">{{ old('lugar_direccion') }}</textarea>                                   
                                    </div>

                                    <div class="col-8">
                                        <div id="mapa" style="height: 350px; width:100%; display:block;"></div>
                                    </div> 

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">UTM Norte</label>
                                        <input type="text" class="form-control" id="utm_norte" name="utm_norte" style="background: white;" value="{{ old('utm_norte') }}" placeholder="Ingrese la UTM Norte" autocomplete="off" onkeypress="return solonum(event);">                                  
                                    
                                        <label  class="font-weight-bold text-primary">UTM Este</label>
                                        <input type="text" class="form-control" id="utm_este" name="utm_este" style="background: white;" value="{{ old('utm_este') }}" placeholder="Ingrese la UTM Este" autocomplete="off" onkeypress="return solonum(event);">                           
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
                                        <input type="file" id="res_fotos" name="res_fotos[]" multiple class="btn btn-outline-info">
                                            <div id="foto_container"></div>
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" id="fecha_inspeccion" name="fecha_inspeccion" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Estatus Inspección</label>
                                        <select class="select2single form-control" name="estatus" id="estatus">
                                            <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                            <option value="Aprobado">Aprobado</option>
                                            <option value="Negado">Negado</option>
                                        </select>
                                    </div>

                                    @if(auth()->user()->hasRole('Administrador'))
                                    <div class="card-body" id="estatus_aprob">
                                        <label class="font-weight-bold text-primary">Estatus Aprobación</label>
                                        <div class="row">
                                            <div class="custom-control custom-radio col-1 mr-2"> 
                                                <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_pen" value="Pendiente" checked>
                                                <label class="custom-control-label" for="estatus_resp_pen">Pendiente</label>
                                            </div>
                                            <div class="custom-control custom-radio col-1 mr-2">
                                                <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_apro" value="Aprobado">
                                                <label class="custom-control-label" for="estatus_resp_apro">Aprobado</label>
                                            </div>
                                            <div class="custom-control custom-radio col-1 mr-2">
                                                <input class="custom-control-input" type="radio" name="estatus_resp" id="estatus_resp_neg" value="Negado">
                                                <label class="custom-control-label" for="estatus_resp_neg">Negado</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                    <input type="hidden" name="estatus_resp" value="Pendiente">
                                    <input type="hidden" name="notification_id" value="{{$notification_id}}" />
                                </div> 
                                
                            </div>

                            <div class="card-body" id="inputs_aprovechamiento">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Longitud</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="longitud_terreno" name="longitud_terreno" style="background: white; width: 78%; margin-right: 2%;" value="{{ old('longitud_terreno') }}" placeholder="Ingrese la Longitud" autocomplete="off" onkeypress="return solonum(event);">
                                                <select class="select2-single form-control" style="width: 20%" disabled>
                                                    <option value="mts" selected>mts</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Ancho Máximo</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="ancho" name="ancho" style="background: white; width: 78%; margin-right: 2%;" value="{{ old('ancho') }}" placeholder="Ingrese el Ancho" autocomplete="off" onkeypress="return solonum(event);">
                                                <select class="select2-single form-control" style="width: 20%" disabled>
                                                    <option value="mts" selected>mts</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Profundidad Máxima</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="profundidad" name="profundidad" style="background: white; width: 78%; margin-right: 2%;" value="{{ old('profundidad') }}" placeholder="Ingrese la Profundidad" autocomplete="off" onkeypress="return solonum(event);">
                                                <select class="select2-single form-control" style="width: 20%" disabled>
                                                    <option value="mts" selected>mts</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Volumen a Extraer</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="volumen" name="volumen" style="background: white; width: 78%; margin-right: 2%;" value="{{ old('volumen') }}" placeholder="Ingrese la Volumen" autocomplete="off" onkeypress="return solonum(event);">
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
                                        <input type="text" class="form-control" id="lind_norte" name="lindero_norte" style="background: white;" value="{{ old('lindero_norte') }}" placeholder="Ingrese El Lindero Norte" oninput="capitalizarInput('nombre')" autocomplete="off" >
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lindero Sur</label>
                                        <input type="text" class="form-control" id="lind_sur" name="lindero_sur" style="background: white;" value="{{ old('lindero_sur') }}" placeholder="Ingrese El Lindero Sur" oninput="capitalizarInput('nombre')" autocomplete="off" >
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lindero Este</label>
                                        <input type="text" class="form-control" id="lind_este" name="lindero_este" style="background: white;" value="{{ old('lindero_este') }}" placeholder="Ingrese El Lindero Este" oninput="capitalizarInput('nombre')" autocomplete="off" >
                                    </div>
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lindero Oeste</label>
                                        <input type="text" class="form-control" id="lind_oeste" name="lindero_oeste" style="background: white;" value="{{ old('lindero_oeste') }}" placeholder="Ingrese El Lindero Oeste" oninput="capitalizarInput('nombre')" autocomplete="off" >
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Superficie</label>
                                            <div style="display: flex">
                                                <input type="text" class="form-control" id="superficie" name="superficie" {{ old('superficie') }} style="background: white; width: 78%; margin-right: 2%;" value="" placeholder="Ingrese la Superficie" autocomplete="off" onkeypress="return solonum(event);">
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
                            <a  class="btn btn-info btn-lg" href="{{ url('inspeccion/') }}"><span class="icon text-white-50">
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

    {{-- * FUNCION PARA MOSTRAR LA FOTO --}}

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#res_fotos').change(function () {
                const fotoContainer = document.getElementById('foto_container');
    
                for (const file of this.files) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.style.maxWidth = '40%';
                        img.style.maxHeight = '40%';
                        fotoContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });
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

        // Inicializa el mapa en el contenedor con ID "map"
        const map = L.map('mapa').setView([10.2825,-68.7222], 9.6); // Latitud y longitud iniciales de Yaracuy
      
        // Agrega el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);
      
        // Declara una variable para el marcador
        let marcador;
      
        // Agrega un marcador cuando se hace clic en el mapa
        map.on('click', (e) => {
          const latitud = e.latlng.lat;
          const longitud = e.latlng.lng;
      
          // Utiliza la API Nominatim para obtener la dirección
        fetch(`https://nominatim.openstreetmap.org/reverse?lat=${latitud}&lon=${longitud}&format=json&addressdetails=1&language=es`)
            .then(response => response.json())
            .then(data => {
                let estado = data.address.state;
                if (estado.includes('State')) {
                    estado = estado.replace(' State', '');
                }
              const lugar_direccion = data.address.road + ", " + data.address.postcode + ", " + data.address.county + ", "  + estado + ", " + data.address.country;
      
              // Elimina cualquier marcador existente
              if (marcador) {
                map.removeLayer(marcador);
              }
      
              // Crea un marcador en la posición del clic
              marcador = L.marker([latitud, longitud], { title: lugar_direccion }).addTo(map);

              // Convierte las coordenadas a UTM
                const utmCoords = proj4('EPSG:4326', 'EPSG:32619', [longitud, latitud]); // EPSG:32619 es para la zona UTM 19N
      
              // Actualiza los campos de texto con las coordenadas y la dirección
              document.getElementById('latitud').value = latitud;
              document.getElementById('longitud').value = longitud;
              document.getElementById('lugar_direccion').value = lugar_direccion;
              document.getElementById('utm_norte').value = utmCoords[1];
              document.getElementById('utm_este').value = utmCoords[0];
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
            const categoria = '{{$planificacion->recepcion->categoria}}';

            // Llamamos a la función para mostrar el div correcto
            mostrarDivCategoria(categoria);

    </script>

    {{-- * FUNCION  PARA MOSTRAR EL ESTATUS APROBACION SEGUN EL ESTATUS DE INSPECCION --}}

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const estatusInspeccion = document.getElementById('estatus');
        const estatusAprobacion = document.getElementById('estatus_aprob');

        function toggleEstatusAprobacion() {
            if (estatusInspeccion.value === 'Negado') {
                estatusAprobacion.style.display = 'none';
            } else if (estatusInspeccion.value === 'Aprobado') {
                estatusAprobacion.style.display = 'block';
            } else {
                estatusAprobacion.style.display = 'block';
            }
        }

        estatusInspeccion.addEventListener('change', toggleEstatusAprobacion);

        // Ejecutar al cargar la página para establecer el estado inicial
        toggleEstatusAprobacion();
    });

    </script>


    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Inspección',
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