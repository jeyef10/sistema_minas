@extends('layouts.index')

<title>@yield('title') Editar Recepción</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 25%;">Actualizar Recepción de Recaudos</h2>

                    </div>

                                                {{-- * FORMULARIO EDITAR DE RECEPCION DE RECAUDOS --}}

                <form method="post" action="{{ route('recepcion.update', $recepcion->id) }}" enctype="multipart/form-data" onsubmit="return Recepcion(this)" >
                    @csrf
                    @method('PUT')

                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Solicitante</label>
                                    <select class="select2-single form-control" id="tipo_solicitante" name="solicitante" disabled>
                                        <option value="0">Seleccione un tipo de Solicitante</option>
                                        @if ($tipoSolicitante->tipo == 'Natural')
                                            <option value="Natural" {{ (old('tipo', $tipoSolicitante->tipo ?? '') === 'Natural') ? 'selected' : '' }}>Natural</option>
                                        @else
                                            <option value="Jurídico" {{ (old('tipo', $tipoSolicitante->tipo ?? '') === 'Jurídico') ? 'selected' : '' }}>Jurídico</option>
                                        @endif
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Solicitante</label>
                                    <div style="display: flex;">
                                        <select class="select2-single form-control" id="solicitante" name="solicitante_especifico_id" @readonly(true)>
                                            <option value="0">Seleccione un Solicitante</option>
                                            @if ($tipoSolicitante->tipo == 'Jurídico')
                                                <option value="{{$datosSolicitante->solicitante_id}}" selected>{{$datosSolicitante->rif}} {{ $datosSolicitante->nombre }} {{ $datosSolicitante->correo }}</option>
                                            @else 
                                                <option value="{{$datosSolicitante->solicitante_id}}" selected>{{$datosSolicitante->cedula}} {{ $datosSolicitante->nombre }} {{ $datosSolicitante->apellido }}</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Municipio</label>
                                    <select class="select2-single form-control" id="municipio" name="id_municipio">
                                        @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id }}" @selected($recepcion->id_municipio == $municipio->id)>{{ $municipio->nom_municipio }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                        </div>
                              
                        <div class="card-body">
        
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Latitud</label>
                                    <input type="text" class="form-control" id="latitud" name="latitud" value="{{ $latitud }}" style="background: white;" value="" placeholder="Ingrese la Latitud" autocomplete="off" onkeypress="return solonum(event);">                                  
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Longitud</label>
                                    <input type="text" class="form-control" id="longitud" name="longitud" value="{{ $longitud }}" style="background: white;" value="" placeholder="Ingrese la Longitud" autocomplete="off" onkeypress="return solonum(event);">                                  
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Dirección / Lugar</label>
                                    <textarea name="direccion" class="form-control" id="direccion" cols="10" rows="10" style="max-height: 6rem;">{{ $direccion }}</textarea>                                   
                                </div>

                                <div class="col-4">
                                    <div id="mapa" style="height: 350px; width:200%;"></div>
                                </div> 

                            </div>
                        </div>
                                
                        <div class="card-body">
        
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Categoria</label>
                                    <select class="select2-single form-control" name="categoria" id="categoria">
                                        <option value="0" selected="true" disabled>Seleccione una Categoria</option>
                                        <option value="Aprovechamiento" {{ (old('categoria', $cat_mineral->categoria ?? '') === 'Aprovechamiento') ? 'selected' : '' }}>Aprovechamiento</option>
                                        <option value="Procesamiento" {{ (old('categoria', $cat_mineral->categoria ?? '') === 'Procesamiento') ? 'selected' : '' }}>Procesamiento</option>
                                    </select>
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre Mineral</label>
                                    <select class="select2-single form-control" id="nom_mineral" name="nom_mineral">
                                        @foreach($minerales as $mineral)
                                            <option value="{{ $mineral->id }}" @if (old('id_mineral', $recepcion->id_mineral) == $mineral->id) selected @endif>
                                            {{ $mineral->nombre }}
                                        </option>
                                        @endforeach
                                    </select>                                  
                                </div>

                            </div>
                        </div>
                    
                        <div class="card-body">

                            <div class="row">
                                
                                <div class="col-4">
                                    <label for="recaudo" class="font-weight-bold text-primary">Recaudos</label>
                                    <div class="form-check">
                                        <input type="checkbox" id="select-all-recaudos" onclick="selectAll()" class="form-check-input" style="margin-rigth:">
                                        <label class="form-check-label ml-1" for="select-all">Seleccionar todos los recaudos</label>
                                    </div>
                                   
                                    <div id='recaudo_categoria'>
                                        @foreach ($recaudos as $recaudo)
                                        <div class="form-check"> 
                                            <input type="checkbox" name="recaudos[]" value="{{ $recaudo->id }}"
                                                   @if ($recaudosSeleccionados->contains($recaudo->id)) checked @endif
                                                   class="form-check-input"> 
                                            <label class="form-check-label ml-1" for="{{ $recaudo->id }}">{{ $recaudo->nombre }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="{{ $fecha }}" id="simpleDataInput" name= "simpleDataInput">
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
                        <a  class="btn btn-info btn-lg" href="{{ url('planificacion/') }}"><span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="text">Regresar</span></a>
                    </center>
                </form>
            </div>
        </div>    
    </div>

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('path/to/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

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

    {{-- ? FUNCION PARA FILTRAR MINERALES POR SU CATEGORIA --}}

    <script> 

        $(document).ready(function() {
        actualizarMinerales(); // Filtrar al cargar la página

        $('#categoria').change(actualizarMinerales); // Filtrar al cambiar la categoría
        });

        function actualizarMinerales() {
            const categoriaSeleccionada = $('#categoria').val();
            const mineralActual = $('#nom_mineral').val();

            if (categoriaSeleccionada) {
                $.ajax({
                    url: '/recepcion/create/fetch-minerales', 
                    method: 'GET',
                    data: { categoria: categoriaSeleccionada },
                    success: function(data) {
                        const selectMinerales = $('#nom_mineral');
                        selectMinerales.empty();

                        selectMinerales.append('<option value="0">Seleccione un mineral</option>');

                        data.forEach(function(mineral) {
                            const option = $('<option>', {
                                value: mineral.id,
                                text: mineral.nombre,
                                selected: (mineral.id == mineralActual) 
                            });
                            selectMinerales.append(option);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching minerales:', error);
                    }
                });
            }
        }
    </script> 

     {{-- ? FUNCION PARA FILTRAR RECAUDOS POR SU CATEGORIA --}}

    <script>
        
    $(document).ready(function() {
        actualizarRecaudos(); 

        $('#categoria').change(actualizarRecaudos); 
    });

    function actualizarRecaudos() {
        const categoriaSeleccionada = $('#categoria').val();
        const recaudosSeleccionados = $('input[name="recaudos[]"]:checked').map(function() {
            return this.value;
        }).get(); 

        if (categoriaSeleccionada) {
            $.ajax({
                url: '/recepcion/create/fetch-recaudos',
                method: 'GET',
                data: { categoria: categoriaSeleccionada },
                success: function(data) {
                    const recaudosContainer = $('#recaudo_categoria');
                    recaudosContainer.children().each(function() { // Iterar sobre los recaudos existentes
                        const recaudoId = $(this).find('input[type="checkbox"]').val();
                        const recaudoData = data.find(r => r.id == recaudoId); // Buscar datos del recaudo

                        if (!recaudoData || !JSON.parse(recaudoData.categoria_recaudos).includes(categoriaSeleccionada)) {
                            $(this).remove(); // Eliminar si no pertenece a la categoría
                        }
                    });

                    data.forEach(function(recaudo) {
                        const categoriasRecaudo = JSON.parse(recaudo.categoria_recaudos);
                        const esCategoriaUnica = categoriasRecaudo.length === 1 && categoriasRecaudo.includes(categoriaSeleccionada);
                        const noEstaSeleccionado = !recaudosSeleccionados.includes(recaudo.id.toString());
                        const noExiste = !recaudosContainer.children().find('input[value="' + recaudo.id + '"]').length;

                        // Agregar solo si es de categoría única, no está seleccionado y no existe
                        if (esCategoriaUnica && noExiste) {
                            const recaudoDiv = $('<div>', { class: 'form-check' });
                            const label = $('<label>', { class: 'form-check-label ml-1' });
                            const checkbox = $('<input>', {
                                type: 'checkbox',
                                name: 'recaudos[]',
                                value: recaudo.id,
                                class: 'form-check-input'
                            });
                            label.append(checkbox).append(recaudo.nombre);
                            recaudoDiv.append(label);
                            recaudosContainer.append(recaudoDiv);
                        }
                    });
                },
                error: function(error) {
                    console.error('Error fetching recaudos:', error);
                }
            });
        }
    }

    </script>

    {{-- * FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

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
        marcador = L.marker([lat, lng]).addTo(map)
            .bindPopup('Nuevo marcador').openPopup();

        // Actualizar los inputs
        document.getElementById('latitud').value = lat;
        document.getElementById('longitud').value = lng;
        // document.getElementById('direccion').value = "";

        // Obtener la dirección utilizando Nominatim 
        fetch(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`)
            .then(response => response.json())
            .then(data => {
                let estado = data.address.state;
                if (estado.includes('State')) {
                    estado = estado.replace(' State', '');
                }
                const direccion_nueva = data.address.road + ", " + data.address.postcode + ", " + data.address.county + ", " + estado + ", " + data.address.country;
                document.getElementById('direccion').textContent = direccion_nueva;
            });
    });
    }
    // Llamada a la función para cargar el mapa al inicio
    cargarMapaYMarcador();

    </script>

     {{-- ! FUNCION PARA SELLECIONAR TODOS LOS RECAUDOS --}}

     <script>  

        function selectAll() {
        var checkboxes = document.getElementsByTagName("input");
        for (var checkbox of checkboxes) {
            if (checkbox.type === "checkbox") {
                checkbox.checked = document.getElementById('select-all-recaudos').checked;
                } 
            }
        }
        
    </script>

    {{--! FUNCIÓN PARA MOSTRAR LA ALERTA QUE DEBES SELECCIONAR 13 RECAUDOS --}}

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Recaudo',
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