@extends('layouts.index')

<title>@yield('title') Registrar Solicitudes</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Solicitudes</h2>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="custom-control custom-radio col-2">
                                <input type="radio" id="natural" name="tipo" value="Natural" class="custom-control-input">
                                <label class="custom-control-label" for="natural">Aprovechamiento</label>
                            </div>

                            <div class="custom-control custom-radio col-1">
                                <input type="radio" id="juridico" name="tipo" value="Jurídico" class="custom-control-input">
                                <label class="custom-control-label" for="juridico">Procesamiento</label>
                            </div>

                        </div>

                    </div>
                    
                    <form method="post" action="{{ route('solicitudes.store') }}" enctype="multipart/form-data" onsubmit="return solicitante(this)" id="Natural" style="display: none;">
                        @csrf
                            
                        <div class="card-body">
                            <h3 class="font-weight-bold text-primary" style="margin-left: 44%;">Datos Solicitante</h3>
                            <div class="row">

                                <input type="hidden" name="previous_url" value="{{ url()->previous() }}">

                                <input type="hidden" id="tipo-natural" name="tipo" value="">

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Solicitante</label>
                                    <select class="select2-single form-control" id="tipo_solicitante" name="solicitante">
                                        <option value="0">Seleccione un tipo de Solicitante</option>
                                        <option value="Natural">Natural</option>
                                        <option value="Jurídico">Jurídico</option>
                                    </select>
                                </div>

                                <div class="col-5">
                                    <label for="persona" class="font-weight-bold text-primary">Solicitante</label>
                                    <div style="display: flex;">
                                        <select class="select2-single form-control" id="solicitante" name="solicitante_especifico_id" >
                                            <option value="0">Seleccione una Persona</option>
                                        </select>

                                        <a class="btn btn-primary" href="{{ route('solicitante.create') }}" style="align-content: center; margin-left: 5%"> 
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="col-3">
                                    <label  class="font-weight-bold text-primary">N° Minero</label>
                                    <input type="text" class="form-control" id="num_minero" name="num_minero" style="background: white;" value="" placeholder="N° Minero" autocomplete="off" readonly>
                                </div>
                  
                            </div>
                        </div>

                            <div class="card-body">
                                <h3 class="font-weight-bold text-primary" style="margin-left: 44%;">Datos Solicitud</h3>
                                <div class="row">
    
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N°</label>
                                        <input type="text" class="form-control" id="num_soli" name="num_soli" style="background: white;" value="" placeholder="Ingrese La Número" autocomplete="off" onkeypress="return solonum(event);">
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Tipo Mineral</label>
                                        <select class="select2-single form-control" id="tipo_mineral" name="tipo_mineral">
                                            <option value="0" selected="true">Seleccione un tipo</option>
                                            {{-- @foreach($minerales as $mineral)
                                                <option value="{{ $mineral->id }}">{{ $mineral->tipo }}</option>
                                            @endforeach  --}}
                                            <option value="No metálicos">No metálicos</option>
                                        </select>
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Nombre Mineral</label>
                                        <select class="select2-single form-control" id="nom_mineral" name="nom_mineral">
                                            <option value="0">Seleccione un mineral</option>
                                                @foreach($minerales as $mineral)
                                                    @If ($mineral->tipo === 'No metálicos') 
                                                        <option value="{{ $mineral->id }}">{{ $mineral->nombre }}</option>
                                                    @endif
                                                @endforeach
                                        </select>                                   
                                     </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N° de regalias</label>
                                        <input type="number" class="form-control" id="num_minero" name="num_minero" style="background: white;" value="" placeholder="N° Regalías" autocomplete="off" onkeypress="return solonum(event);" min="0">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Tasa de Regalías</label>
                                        <select class="select2-single form-control" id="tasa_regalias" name="tasa_regalias">
                                            <option value="0">Seleccione una tasa</option>
                                            @foreach($regalias as $regalia)
                                                <option value="{{ $regalia->id }}">{{ $regalia->monto }}  {{ $regalia->moneda_longitud}}</option>
                                            @endforeach 
                                        </select>                                   
                                     </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Volumen (mtrs3)</label>
                                        <input type="text" class="form-control" id="volumen" name="volumen" style="background: white;" value="" placeholder="Ingrese El Volumen" autocomplete="off" onkeypress="return solonum(event);">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Plazo de Vigencia</label>
                                        <select class="select2-single form-control" id="vigencia" name="vigencia">
                                            <option value="0">Seleccione un plazo</option>
                                            @foreach($plazos as $plazo)
                                                <option value="{{ $plazo->id }}">{{ $plazo->cantidad }}  {{ $plazo->medida_tiempo}}</option>
                                            @endforeach 
                                        </select>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Municipio</label>
                                        <select class="select2-single form-control" id="municipio" name="municipio">
                                            <option value="0">Seleccione un municipio</option>
                                            @foreach($municipios as $municipio)
                                                <option value="{{ $municipio->id }}">{{ $municipio->nom_municipio }}</option>
                                            @endforeach
                                        </select>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Parroquia</label>
                                        <select class="select2-single form-control" id="parroquia" name="parroquia">
                                            <option value="0">Seleccione un parroquia</option>
                                        </select>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Dirección</label>
                                        <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Observaciones</label>
                                        <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                  <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control" value="01/06/2020" id="simpleDataInput">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Estatus</label>
                                        <select class="select2-single form-control" id="estatus" name="estatus">
                                            <option value="0">Seleccione un estatus</option>
                                            <option value="1">En proceso</option>
                                            <option value="2">Aprobado</option>
                                            <option value="3">Rechazado</option>
                                            
                                        </select>                                   
                                    </div>

                                </div>
                            </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('solicitante/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>

                    <form method="post" action="{{ route('solicitante.store') }}" enctype="multipart/form-data" onsubmit="return solicitante(this)" id="Jurídico" style="display: none;">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="card-body">
                                    <h3 class="font-weight-bold text-primary" style="margin-left: 44%;">Datos Solicitante</h3>
                                    <div class="row">
        
                                        <input type="hidden" id="tipo-juridico" name="tipo" value="">
        
                                        <div class="col-4">
                                            <label for="persona" class="font-weight-bold text-primary">Tipo de Solicitante</label>
                                            <select class="select2-single form-control" id="tipo_solicitante_p" name="solicitante">
                                                <option value="0">Seleccione un tipo de Solicitante</option>
                                                <option value="Natural">Natural</option>
                                                <option value="Jurídico">Jurídico</option>
                                            </select>
                                        </div>
        
                                        <div class="col-5">
                                            <label for="persona" class="font-weight-bold text-primary">Solicitante</label>
                                            <div style="display: flex;">
                                                <select class="select2-single form-control" id="solicitante_p" name="solicitante_especifico_id" >
                                                    <option value="0">Seleccione una Persona</option>
                                                </select>
        
                                                <a class="btn btn-primary" href="{{ route('solicitante.create') }}" style="align-content: center; margin-left: 5%"> 
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
        
                                        <div class="col-3">
                                            <label  class="font-weight-bold text-primary">N° Minero</label>
                                            <input type="text" class="form-control" id="num_minero_p" name="num_minero" style="background: white;" value="" placeholder="N° Minero" autocomplete="off" readonly>
                                        </div>
                          
                                    </div>
                                </div> 
                                
                                <div class="card-body">
                                    <h3 class="font-weight-bold text-primary" style="margin-left: 44%;">Datos Solicitud</h3>

                                    <div class="row">
                
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Tipo Mineral</label>
                                            <select class="select2-single form-control" id="tipo_mineral" name="tipo_mineral">
                                                <option value="0" selected="true">Seleccione un tipo</option>
                                                {{-- @foreach($minerales as $mineral)
                                                    <option value="{{ $mineral->id }}">{{ $mineral->tipo }}</option>
                                                @endforeach  --}}
                                                <option value="No metálicos">No metálicos</option>
                                            </select>
                                        </div>
                
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Nombre Mineral</label>
                                            <select class="select2-single form-control" id="nom_mineral" name="nom_mineral">
                                                <option value="0">Seleccione un mineral</option>
                                                    @foreach($minerales as $mineral)
                                                        @If ($mineral->tipo === 'No metálicos') 
                                                            <option value="{{ $mineral->id }}">{{ $mineral->nombre }}</option>
                                                        @endif
                                                    @endforeach
                                            </select>                                   
                                         </div>
    
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Volumen (mtrs3)</label>
                                            <input type="text" class="form-control" id="volumen" name="volumen" style="background: white;" value="" placeholder="Ingrese El Volumen" autocomplete="off" onkeypress="return solonum(event);">
                                        </div>
    
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Plazo de Vigencia</label>
                                            <select class="select2-single form-control" id="vigencia" name="vigencia">
                                                <option value="0">Seleccione un plazo</option>
                                                @foreach($plazos as $plazo)
                                                    <option value="{{ $plazo->id }}">{{ $plazo->cantidad }}  {{ $plazo->medida_tiempo}}</option>
                                                @endforeach 
                                            </select>                                   
                                        </div>
    
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Municipio</label>
                                            <select class="select2-single form-control" id="municipio_p" name="municipio">
                                                <option value="0">Seleccione un municipio</option>
                                                @foreach($municipios as $municipio)
                                                    <option value="{{ $municipio->id }}">{{ $municipio->nom_municipio }}</option>
                                                @endforeach
                                            </select>                                   
                                        </div>
    
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Parroquia</label>
                                            <select class="select2-single form-control" id="parroquia_p" name="parroquia">
                                                <option value="0">Seleccione un parroquia</option>
                                            </select>                                   
                                        </div>
    
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Dirección</label>
                                            <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                        </div>
    
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Observaciones</label>
                                            <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                        </div>
    
                                        <div class="col-4">                                     
                                            <div class="form-group" id="simple-date1">
                                                <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                                <div class="input-group date">
                                                    <div class="input-group-prepend">
                                                      <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" value="01/06/2020" id="simpleDataInput">
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="col-4">
                                            <label  class="font-weight-bold text-primary">Estatus</label>
                                            <select class="select2-single form-control" id="estatus" name="estatus">
                                                <option value="0">Seleccione un estatus</option>
                                                <option value="1">En proceso</option>
                                                <option value="2">Aprobado</option>
                                                <option value="3">Rechazado</option>
                                                
                                            </select>                                   
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
                                <a  class="btn btn-info btn-lg" href="{{ url('solicitante/') }}"><span class="icon text-white-50">
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



    {{--! ESTILOS DE LA FECHA PARA QUE SE DESPLIEGUE  --}}

    <script>
        $(document).ready(function () {
       
          // Bootstrap Date Picker
          $('#simple-date1 .input-group.date').datepicker({
            format: 'dd/mm/yyyy',
            todayBtn: 'linked',
            todayHighlight: true,
            autoclose: true,        
          });
    
          $('#simple-date2 .input-group.date').datepicker({
            startView: 1,
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
          });
    
          $('#simple-date3 .input-group.date').datepicker({
            startView: 2,
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
          });
    
          $('#simple-date4 .input-daterange').datepicker({        
            format: 'dd/mm/yyyy',        
            autoclose: true,     
            todayHighlight: true,   
            todayBtn: 'linked',
          });    
    
        });
    </script>

    {{-- ! FUNCION PARA MOSTRAR Y OCULTAR FORMULARIOS --}}

    <script>
        function showHideForms() {
            // Selecciona los botones de radio con el nombre "tipo"
            const radios = document.querySelectorAll('input[type="radio"][name="tipo"]'); 
    
            // Selecciona los formularios con los ID "Natural" y "Jurídico"
            const forms = document.querySelectorAll('#Natural, #Jurídico'); 
    
            // Inicialmente oculta ambos formularios
            forms[0].style.display = 'none';
            forms[1].style.display = 'none';
    
            // Añade un evento de cambio a los botones de radio
            radios.forEach(radio => {
                radio.addEventListener('change', (event) => {

                    // Obtiene el ID del formulario a mostrar
                    const selectedFormId = event.target.value; 
    
                    // Recorre todos los formularios
                    for (const form of forms) {

                        // Si el ID del formulario coincide con el ID seleccionado, muestra el formulario
                        if (form.id === selectedFormId) {
                            form.style.display = 'block';

                            // Establece el valor del campo de tipo en el formulario seleccionado
                            document.querySelector(`#tipo-${selectedFormId.toLowerCase()}`).value = selectedFormId;
                        } else {
                            
                            // Si no coincide, oculta el formulario
                            form.style.display = 'none';
                        }
                    }
                });
            });
        }
    
        // Añade el evento de carga a la ventana para ejecutar la función showHideForms cuando se carga la página
        window.addEventListener('DOMContentLoaded', showHideForms);
    </script>

    {{-- ! FUNCION PARA MOSTRAR SOLICITANTES SEGUN SU TIPO APROVECHAMIENTO --}}

    <script>
       $('#tipo_solicitante').change(function() {
        var tipoSolicitante = $(this).val(); // Get selected tipoSolicitante

        if (tipoSolicitante) {
            $.ajax({
            url: '/solicitudes/create/fetch-solicitantes/' + tipoSolicitante, // Replace with your actual API URL
            method: 'GET',
            success: function(data) {
                // Assuming data is an array of solicitante objects
                var options = '<option value="">Seleccione una Persona</option>';
                var numMineroInput = $('#num_minero'); // Get the num_minero input element
                
                // numMineroInput = ' ';

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

                // Update num_minero input when option is selected
                $('#solicitante').change(function() {
                var selectedSolicitante = $(this).val();
                if (selectedSolicitante) {
                    var selectedSolicitanteData = data.find(function(solicitante) {
                    return solicitante.id == selectedSolicitante;
                    });

                    if (selectedSolicitanteData) {
                    numMineroInput.val(selectedSolicitanteData.num_minero);
                    } else {
                    // This could happen if no matching solicitante is found
                    console.warn('No matching solicitante found for ID:', selectedSolicitante);
                    }
                } else {
                    // This block executes if no solicitante is selected
                    numMineroInput.val('');  // Clear num_minero input
                }
                });
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


    {{-- * FUNCION PARA MOSTRAR PARROQUIAS EN APROVECHAMIENTO  --}}

    <script>
        $(document).ready(function() {
        $('#municipio').change(function() {
            var municipioId = $(this).val(); // Get the selected municipio ID

            if (municipioId) { // If a municipio is selected
                $.ajax({
                    url: '/solicitudes/create/' + municipioId, // Replace with your actual route URL
                    method: 'GET',
                    success: function(data) {
                        console.log(data)
                        var options = '<option value="">Seleccione una parroquia</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + key + '">' + value + '</option>';
                        });

                        $('#parroquia').html(options); // Update the 'Parroquia' select with new options
                    }
                });
            } else {
                $('#parroquia').html('<option value="">Seleccione una parroquia</option>'); // Clear 'Parroquia' select
            }
        });
    });
    </script>

    {{-- ? FUNCION PARA MOSTRAR SOLICITANTES SEGUN SU TIPO PROCESAMIENTO --}}

    <script>
        $('#tipo_solicitante_p').change(function() {
         var tipoSolicitante = $(this).val(); // Get selected tipoSolicitante
 
         if (tipoSolicitante) {
             $.ajax({
             url: '/solicitudes/create/fetch-solicitantes/' + tipoSolicitante, // Replace with your actual API URL
             method: 'GET',
             success: function(data) {
                 // Assuming data is an array of solicitante objects
                 var options = '<option value="">Seleccione una Persona</option>';
                 var numMineroInput = $('#num_minero_p'); // Get the num_minero input element
                 
                 // numMineroInput = ' ';
 
                 data.forEach(function(solicitante) {
                 if (solicitante.solicitante_especifico || solicitante) {
                     options += '<option value="' + solicitante.id + '">' +
                     (solicitante.solicitante_especifico.cedula || '') + ' ' +
                     (solicitante.solicitante_especifico.rif || '') + ' - ' +
                     (solicitante.solicitante_especifico.nombre || '') + ' ' +
                     (solicitante.solicitante_especifico.apellido || '') + '</option>';
                 }
                 });
 
                $('#solicitante_p').html(options); // Update the 'Solicitante' select with new options
 
                 // Update num_minero input when option is selected
                $('#solicitante_p').change(function() {
                 var selectedSolicitante = $(this).val();
                 if (selectedSolicitante) {
                     var selectedSolicitanteData = data.find(function(solicitante) {
                     return solicitante.id == selectedSolicitante;
                     });
 
                     if (selectedSolicitanteData) {
                     numMineroInput.val(selectedSolicitanteData.num_minero);
                     } else {
                     // This could happen if no matching solicitante is found
                     console.warn('No matching solicitante found for ID:', selectedSolicitante);
                     }
                 } else {
                     // This block executes if no solicitante is selected
                     numMineroInput.val('');  // Clear num_minero input
                 }
                 });
                 // Trigger nested change event listener on programmatically updated solicitante
                 $('#solicitante_p').trigger('change');
             },
             error: function(error) {
                 console.error('Error fetching solicitantes:', error);
                 // Handle AJAX error (e.g., network error, server error)
             }
             });
         } else {
             $('#solicitante_p').html('<option value="">Seleccione una Persona</option>'); // Clear 'Solicitante' select
            }
        });
    </script>

    {{-- * FUNCION PARA MOSTRAR PARROQUIAS EN PROCESAMIENTO  --}}

    <script>
        $(document).ready(function() {
        $('#municipio_p').change(function() {
            var municipioId = $(this).val(); // Get the selected municipio ID

            if (municipioId) { // If a municipio is selected
                $.ajax({
                    url: '/solicitudes/create/' + municipioId, // Replace with your actual route URL
                    method: 'GET',
                    success: function(data) {
                        console.log(data)
                        var options = '<option value="">Seleccione una parroquia</option>';
                        $.each(data, function(key, value) {
                            options += '<option value="' + key + '">' + value + '</option>';
                        });

                        $('#parroquia_p').html(options); // Update the 'Parroquia' select with new options
                    }
                });
            } else {
                $('#parroquia_p').html('<option value="">Seleccione una parroquia</option>'); // Clear 'Parroquia' select
            }
        });
    });
    </script>

@endsection