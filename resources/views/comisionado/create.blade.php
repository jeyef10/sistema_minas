@extends('layouts.index')

<title>@yield('title') Registrar Comisionado</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Comisionado</h2>
    
                    </div>

                    <form method="post" action="{{ route('comisionado.store') }}" enctype="multipart/form-data" onsubmit="return Comisionado(this)">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Cédula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" style="background: white;" value="" placeholder="Ingrese La Cédula" autocomplete="off" onkeypress="return solonum(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombres</label>
                                    <input type="text" class="form-control" id="nombre" name="nombres" style="background: white;" value="" placeholder="Ingrese El Nombre" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Apellidos</label>
                                    <input type="text" class="form-control" id="apellido" name="apellidos" style="background: white;" value="" placeholder="Ingrese El Apellido" autocomplete="off" onkeypress="return soloLetras(event);">
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
{{-- 
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Parroquia</label>
                                    <select class="select2-single form-control" id="parroquia" name="parroquia">
                                        <option value="0">Seleccione un parroquia</option>
                                    </select>                                   
                                </div> --}}
                                
                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('comisionado/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>

    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}
    
    {{-- * FUNCION PARA MOSTRAR PARROQUIAS EN Comisionado  --}}

    {{-- <script>
        $(document).ready(function() {
        $('#municipio').change(function() {
            var municipioId = $(this).val(); // Get the selected municipio ID

            if (municipioId) { // If a municipio is selected
                $.ajax({
                    url: '/comisionados/create/' + municipioId, // Replace with your actual route URL
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

@endsection