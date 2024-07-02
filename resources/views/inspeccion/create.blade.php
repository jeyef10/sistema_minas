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

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Registrar Inspección</h2>

                    </div>
 
                <form method="post" action="{{ route('inspeccion.store') }}" enctype="multipart/form-data" onsubmit="return Inspeccion(this)">
                    @csrf
                    
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
                                        <label  class="font-weight-bold text-primary">Funcionario Acompañante</label>
                                        <textarea class="form-control" id="funcionario_acomp" name="funcionario_acomp" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                </div>

                            </div>

                            <hr class="sidebar-divider">

                            <div class="card-body">

                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Lugar</label>
                                        <textarea class="form-control" id="lugar_direccion" name="lugar_direccion" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Observaciones</label>
                                        <textarea class="form-control" id="observaciones" name="observaciones" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Conclusiones</label>
                                        <textarea class="form-control" id="conclusiones" name="conclusiones" cols="10" rows="10" style="max-height: 6rem;"></textarea>                                   
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
                                        <div id="mapa" style="height: 280px; width:370px;"></div>
                                    </div>    

                                </div>
                                
                            </div>

                            <hr class="sidebar-divider">

                            <div class="card-body">

                                <div class="row">

                                    <div class="grid grid-cols-1 mt-5 mx-7">
                                        <img id="imagenSeleccionada" style="max-heigth: 300px;">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Reseña Fotográfica</label>
                                        <input type="file" name="res_fotos" id="res_fotos" class="btn btn-outline-info">
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

                                    <input type="hidden" name="estatus" value="Aprobado">

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

        $(document).ready(function (e) {
            $('#res_fotos').change(function(){
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#imagenSeleccionada').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
        });

    </script>

<<<<<<< HEAD
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
=======
    {{-- * FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

    <script>

        // Importa Leaflet
        // import L from 'leaflet';

        // Inicializa el mapa en el contenedor con ID "map"
        const map = L.map('mapa').setView([10.2825,-68.7222], 9.2); // Latitud y longitud iniciales de Yaracuy

        // Agrega el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        // Agrega un marcador cuando se hace clic en el mapa
        map.on('click', (e) => {
            const latitud = e.latlng.lat;
            const longitud = e.latlng.lng;

            // Actualiza los campos de texto con las coordenadas
            document.getElementById('latitud').value = latitud;
            document.getElementById('longitud').value = longitud;
        });

        // var map = L.map('mapa').setView([10.2825,-68.7222], 10); // Coordenadas iniciales

        // // Agrega el mapa base de OpenStreetMap
        // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        //     attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);

        // // Agrega un marcador interactivo
        // var marker = L.marker([10.2825,-68.7222], { draggable: true }).addTo(map);
        // marker.on('dragend', function (e) {
        //     var latLng = e.target.getLatLng();
        //     document.getElementById('latitud').value = latLng.lat;
        //     document.getElementById('longitud').value = latLng.lng;
        // });

        // let map = L.map('mapa').setView([10.2825,-68.7222], 10)

        // L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        // attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        // }).addTo(map);

    </script>

    {{--! FUNCIÓN PARA MOSTRAR LA ALERTA DE LA FECHA --}}

    @if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        Swal.fire({
                title: 'Recaudo',
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
>>>>>>> 94e313f02cefcfcc3f75efd285f160ca88604759

@endsection