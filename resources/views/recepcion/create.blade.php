@extends('layouts.index')

<title>@yield('title') Registrar Recepción</title>
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
                        <h2 class="font-weight-bold text-primary" style="margin-left: 34%;">Recepción de Recaudos</h2>
                    </div>

                    
                                                {{-- * FORMULARIO DE RECEPCIÓN RECAUDOS --}}

            <form method="post" action="{{ route('recepcion.store') }}" enctype="multipart/form-data" onsubmit="return Recepcion(this)">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Solicitante</label>
                                    <select class="select2-single form-control" id="tipo_solicitante" name="solicitante">
                                        <option value="">Seleccione tipo de Solicitante</option>
                                        <option value="Natural">Natural</option>
                                        <option value="Jurídico">Jurídico</option>
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Solicitante</label>
                                    <div style="display: flex;">
                                        <select class="select2-single form-control" id="solicitante" name="solicitante_especifico_id" >
                                            <option value="">Seleccione una Persona</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Municipio</label>
                                    <select class="select2-single form-control" id="municipio" name="id_municipio">
                                        <option value="">Seleccione un municipio</option>
                                        @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->id }}">{{ $municipio->nom_municipio }}</option>
                                        @endforeach
                                    </select>                                   
                                </div>

                            </div>
                        </div>

                        <hr class="sidebar-divider">

                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Latitud</label>
                                    <input type="text" class="form-control" id="latitud" name="latitud" style="background: white;" value="" placeholder="Ingrese la Latitud" autocomplete="off" onkeypress="return solonum(event);">                                  
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Longitud</label>
                                    <input type="text" class="form-control" id="longitud" name="longitud" style="background: white;" value="" placeholder="Ingrese la Longitud" autocomplete="off" onkeypress="return solonum(event);">                                  
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Dirección / Lugar</label>
                                    <textarea name="direccion" class="form-control" id="direccion" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                </div>

                                <div class="col-4">
                                    <div id="mapa" style="height: 350px; width:200%;"></div>
                                </div>   

                            </div>
                        </div>

                        <hr class="sidebar-divider">

                        <div class="card-body">

                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Categoria</label>
                                    <select class="select2-single form-control" name="categoria" id="categoria">
                                        <option value="" selected="true" disabled>Seleccione una Categoria</option>
                                        <option value="Aprovechamiento">Aprovechamiento</option>
                                        <option value="Procesamiento">Procesamiento</option>
                                    </select>
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre Mineral</label>
                                    <select class="select2-single form-control" id="nom_mineral" name="nom_mineral">
                                        <option value="0">Seleccione un mineral</option>
                                            {{-- * ES CARGADO POR EL JS/AJAX --}}
                                    </select>                                  
                                 </div>

                            </div>
                            
                        </div>

                        <hr class="sidebar-divider">
                                
                        <div class="card-body">
                                
                            <div class="row">

                                <div class="col-4">
                                    <label for="recaudo" class="font-weight-bold text-primary">Recaudos</label>
                                    <div>
                                        <input type="checkbox" id="select-all-recaudos" onclick="selectAll()" class="form-check-input ml-1">
                                        <label class="form-check-label ml-4" for="select-all">Seleccionar todos los recaudos</label>
                                            <div id='recaudo_categoria'>
                                                {{-- * RECAUDOS CARGADOS SEGÚN CATEGORÍA --}}
                                            </div>
                                    </div>
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput" name= "simpleDataInput">
                                        </div>
                                    </div>
                                </div>
                                
                                </div>
                            </div>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                               {{--  <a  class="btn btn-info btn-lg" href="{{ url('recepcion/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a> --}}
                            </center>
                    </form>
                </div>
            </div>      
        </div> 

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{asset('path/to/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{asset('https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/locales/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

    {{-- ! FUNCION PARA MOSTRAR SOLICITANTES SEGUN SU TIPO --}}

    <script>
        $('#tipo_solicitante').change(function() {
         var tipoSolicitante = $(this).val(); // Get selected tipoSolicitante
 
         if (tipoSolicitante) {
             $.ajax({
             url: '/recepcion/create/fetch-solicitantes/' + tipoSolicitante, // Replace with your actual API URL
             method: 'GET',
             success: function(data) {
                 // Assuming data is an array of solicitante objects
                 var options = '<option value="">Seleccione una Persona</option>';
 
                 data.forEach(function(solicitante) {
                 if (solicitante.solicitante_especifico || solicitante) {
                     options += '<option value="' + solicitante.id + '">' +
                     (solicitante.solicitante_especifico.cedula || '') + ' ' +
                     (solicitante.solicitante_especifico.rif || '') + ' - ' +
                     (solicitante.solicitante_especifico.nombre || '') + ' ' +
                     (solicitante.solicitante_especifico.apellido || '') + '</option>';
                 }
                 });
 
                 $('#solicitante').html(options); // Update the 'Solicitante' select with new options
 
                //  // Update num_minero input when option is selected
                //  $('#solicitante').change(function() {
                //  var selectedSolicitante = $(this).val();
                //  if (selectedSolicitante) {
                //      var selectedSolicitanteData = data.find(function(solicitante) {
                //      return solicitante.id == selectedSolicitante;
                //      });
 
                //      if (selectedSolicitanteData) {
                //      numMineroInput.val(selectedSolicitanteData.num_minero);
                //      } else {
                //      // This could happen if no matching solicitante is found
                //      console.warn('No matching solicitante found for ID:', selectedSolicitante);
                //      }
                //  } else {
                //      // This block executes if no solicitante is selected
                //       um_minero input
                //  }
                //  });
                 // Trigger nested change event listener on programmatically updated solicitante
                 $('#solicitante').trigger('change');
             },
             error: function(error) {
                 console.error('Error fetching solicitantes:', error);
                 // Handle AJAX error (e.g., network error, server error)
             }
             });
         } else {
             $('#solicitante').html('<option value="">Seleccione una Persona</option>'); // Clear 'Solicitante' select
         }
         });
     </script>


    {{-- ? FUNCION PARA FILTRAR MINERALES POR SU CATEGORIA --}}

    <script>
        $('#categoria').change(function() {
        const categoriaSeleccionada = $(this).val();

        if (categoriaSeleccionada) {
            $.ajax({
                url: '/recepcion/create/fetch-minerales', // Ruta sin ID de categoría
                method: 'GET',
                data: { categoria: categoriaSeleccionada }, // Enviar categoría como parámetro
                success: function(data) { 
                    const selectMinerales = $('#nom_mineral');
                    selectMinerales.empty(); 

                    selectMinerales.append('<option value="0">Seleccione un mineral</option>');

                    data.forEach(function(mineral) {
                        const option = $('<option>', {
                            value: mineral.id, 
                            text: mineral.nombre 
                        });
                        selectMinerales.append(option);
                    });

                    selectMinerales.trigger('change');
                },
                error: function(error) {
                    console.error('Error fetching minerales:', error);
                }
            });
        } else {
            $('#nom_mineral').empty().append('<option value="0">Seleccione un mineral</option>');
        }
    });

    </script>

     {{-- ? FUNCION PARA FILTRAR RECAUDOS POR SU CATEGORIA --}}

    <script>
        $('#categoria').change(function() {
        const categoriaSeleccionada = $(this).val(); 

        if (categoriaSeleccionada) {
            $.ajax({
                url: '/recepcion/create/fetch-recaudos', 
                method: 'GET',
                data: { categoria: categoriaSeleccionada }, 
                success: function(data) { 
                    const recaudosContainer = $('#recaudo_categoria'); // Seleccionar el div por ID
                    recaudosContainer.empty(); // Limpiar recaudos existentes

                    data.forEach(function(recaudo) {
                        const categoriasRecaudo = JSON.parse(recaudo.categoria_recaudos); // Parsear JSON de categorías
                        // console.log(categoriasRecaudo);
                        if (categoriasRecaudo.includes(categoriaSeleccionada)) { // Verificar si la categoría coincide
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
        } else {
            // Si no se selecciona categoría, mostrar todos los recaudos (opcional)
            // ... (puedes agregar lógica aquí si es necesario)
        }
    });

    </script>

    {{-- * FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

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
              const direccion = data.address.road + ", " + data.address.postcode + ", " + data.address.county + ", " + data.address.country;
      
              // Elimina cualquier marcador existente
              if (marcador) {
                map.removeLayer(marcador);
              }
      
              // Crea un marcador en la posición del clic
              marcador = L.marker([latitud, longitud], { title: direccion }).addTo(map);
      
              // Actualiza los campos de texto con las coordenadas y la dirección
              document.getElementById('latitud').value = latitud;
              document.getElementById('longitud').value = longitud;
              document.getElementById('direccion').value = direccion;
            });
        });
      
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

    {{--! FUNCIÓN PARA MOSTRAR LA ALERTA QUE DEBES SELECCIONAR 13 RECAUDOS --}}

@if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        Swal.fire({
                title: 'Recaudo',
                text: "Se requieren 13 Recaudos para registrar la recepción. Por favor, seleccione 13 Recaudos..",
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