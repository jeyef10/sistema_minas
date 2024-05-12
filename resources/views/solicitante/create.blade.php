@extends('layouts.index')

<title>@yield('title') Registrar Solicitante</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    @if ($errors->any())
        <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Solicitante</h2>

                    </div>

                    <div class="card-body">

                        <div class="row">

                            <div class="custom-control custom-radio col-1">
                                <input type="radio" id="natural" name="tipo" value="Natural" class="custom-control-input">
                                <label class="custom-control-label" for="natural">Natural</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="juridico" name="tipo" value="Jurídico" class="custom-control-input">
                                <label class="custom-control-label" for="juridico">Jurídico</label>
                            </div>

                        </div>

                    </div>
                    
                    <form method="post" action="{{ route('solicitante.store') }}" enctype="multipart/form-data" onsubmit="return Solicitante(this)" id="Natural" style="display: none;">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <input type="hidden" name="previous_url" value="{{ $previous_url }}">

                                <input type="hidden" id="tipo-natural" name="tipo" value="">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Cédula</label>
                                    <input type="text" class="form-control" id="cedula" name="cedula" style="background: white;" value="" placeholder="Ingrese La Cédula" autocomplete="off" onkeypress="return solonum(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="" placeholder="Ingrese El Nombre" oninput="convertirTexto()" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Apellido</label>
                                    <input type="text" class="form-control" id="apellido" name="apellido" style="background: white;" value="" placeholder="Ingrese El Apellido" autocomplete="off">
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

                    <form method="post" action="{{ route('solicitante.store') }}" enctype="multipart/form-data" onsubmit="return Solicitante_juridico(this)" id="Jurídico" style="display: none;">
                        @csrf
                        <div class="card-body">
                            
                            <div class="row">

                                <input type="hidden" name="previous_url" value="{{ $previous_url }}"> {{-- Agregamos este input tipo hidden para capturar la url anterior para asi pasarsela al controlador --}}

                                <input type="hidden" id="tipo-jurídico" name="tipo" value="">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">RIF</label>
                                    <input type="text" class="form-control" id="rif" name="rif" style="background: white;" value="" placeholder="Ingrese el Rif" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre de la Empresa</label>
                                    <input type="text" class="form-control" id="nombre_empresa" name="nombre" style="background: white;" value="" placeholder="Ingrese El Nombre" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email_empresa" name="correo" style="background: white;" value="" placeholder="Ingrese El Correo" autocomplete="off">
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

    
  
@endsection