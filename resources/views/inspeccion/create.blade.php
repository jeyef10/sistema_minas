@extends('layouts.index')

<title>@yield('title') Registrar Inspección</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Registrar Inspección</h2>

                    </div>

                    {{-- <div class="card-body">

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

                    </div>  --}}
 
        <form method="post" action="{{ route('inspeccion.store') }}" enctype="multipart/form-data" onsubmit="return Inspeccion(this)" id="Natural" style="">
                        @csrf
                    
                            <div class="card-body">
{{--                                     <h3 class="font-weight-bold text-primary mb1" style="margin-left: 44%;">Inspección</h3> --}}
                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Municipio</label>
                                        <select class="select2-single form-control" id="municipio" name="municipio">
                                            <option value="0">Seleccione un municipio</option>
                                            @foreach($municipios as $municipio)
                                                <option value="{{ $municipio->id }}">{{ $municipio->nom_municipio }}</option>
                                            @endforeach
                                        </select>                                   
                                    </div>

                                    {{-- <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Parroquia</label>
                                        <select class="select2-single form-control" id="parroquia" name="parroquia">
                                            <option value="0">Seleccione un parroquia</option>
                                        </select>                                   
                                    </div>  --}}

                                    <div class="col-4">
                                        <label for="comisionado" class="font-weight-bold text-primary">Comisionado asignado</label>
                                        <select class="select2-single form-control" id="comisionado" name="comisionado">
                                            <option value="0">Seleccione un comisionado</option>
                                        </select>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Funcionario Acompañante</label>
                                        <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lugar</label>
                                        <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Observaciones</label>
                                        <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Conclusiones</label>
                                        <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Latitud</label>
                                        <input type="text" class="form-control" id="latitud" name="latitud" style="background: white;" value="" placeholder="Ingrese la Latitud" autocomplete="off">                                  
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Longitud</label>
                                        <input type="text" class="form-control" id="longitud" name="longitud" style="background: white;" value="" placeholder="Ingrese la Longitud" autocomplete="off">                                  
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Reseña Fotográfica</label>
                                        <textarea name="direccion" class="form-control" id="" cols="10" rows="10" style="max-height: 6rem;"></textarea>
                                        <input type="file" name="resenia" id="resenia" class="btn btn-outline-info">
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

   {{--  <script>
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
    </script> --}}

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

    {{-- * FUNCION PARA MOSTRAR PARROQUIAS EN APROVECHAMIENTO  --}}

    {{-- <script>
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
    </script> --}}

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