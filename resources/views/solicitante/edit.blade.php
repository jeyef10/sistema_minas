@extends('layouts.index')

<title>@yield('title') Actualizar Solicitante</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Actualizar Solicitante</h2>

                    </div>

                    <div class="card-body" style="display: none;">

                        <div class="row">

                            <div class="custom-control custom-radio col-1">
                                <input type="radio" id="natural" name="tipo" value="Natural" class="custom-control-input" {{ $solicitante->tipo == 'Natural' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="natural">Natural</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="juridico" name="tipo" value="Jurídico" class="custom-control-input" {{ $solicitante->tipo == 'Jurídico' ? 'checked' : '' }}>
                                <label class="custom-control-label" for="juridico">Jurídico</label>
                            </div>

                        </div>

                    </div>

                    @if ($solicitante->tipo == 'Natural')

                        <form method="post" action="{{ route('solicitante.update', $solicitante->id) }}" enctype="multipart/form-data" onsubmit="return solicitante(this)" id="Natural" style="display: none;">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                
                                <div class="row">

                                    <input type="hidden" id="tipo-natural" name="tipo" value="{{ $solicitante->tipo }}">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Cédula</label>
                                        <input type="text" class="form-control" id="cedula" name="cedula" style="background: white;" value="{{ $solicitante->solicitanteEspecifico->cedula }}" placeholder="Ingrese La Cédula" autocomplete="off" onkeypress="return solonum(event);">
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Nombre</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="{{ $solicitante->solicitanteEspecifico->nombre }}" placeholder="Ingrese El Nombre" autocomplete="off">
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Apellido</label>
                                        <input type="text" class="form-control" id="apellido" name="apellido" style="background: white;" value="{{ $solicitante->solicitanteEspecifico->apellido }}" placeholder="Ingrese El Apellido" autocomplete="off">
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N° Minero</label>
                                        <input type="text" class="form-control" id="num_minero" name="num_minero" style="background: white;" value="{{ $solicitante->num_minero }}" placeholder="N° Minero" autocomplete="off">
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

                        @elseif ($solicitante->tipo == 'Jurídico')

                        <form method="post" action="{{ route('solicitante.update', $solicitante->id) }}" enctype="multipart/form-data" onsubmit="return solicitante(this)" id="Jurídico" style="display: none;">
                            @csrf
                            @method('PUT')

                            <div class="card-body">
                                
                                <div class="row">

                                    <input type="hidden" id="tipo-jurídico" name="tipo" value="{{ $solicitante->tipo }}">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">RIF</label>
                                        <input type="text" class="form-control" id="rif" name="rif" style="background: white;" value="{{ $solicitante->solicitanteEspecifico->rif }}" placeholder="Ingrese el Rif" autocomplete="off">
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Nombre de la Empresa</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="{{ $solicitante->solicitanteEspecifico->nombre }}" placeholder="Ingrese El Nombre" autocomplete="off">
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Correo Electrónico</label>
                                        <input type="email" class="form-control" id="email" name="correo" style="background: white;" value="{{ $solicitante->solicitanteEspecifico->correo }}" placeholder="Ingrese El Correo" autocomplete="off">
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N° Minero</label>
                                        <input type="text" class="form-control" id="num_minero" name="num_minero" style="background: white;" value="{{ $solicitante->num_minero }}" placeholder="N° Minero" autocomplete="off">
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

                    @endif

                </div>
            </div>    
    </div>

    <script>
        function showHideForms() {
            // Selecciona los botones de radio con el nombre "tipo"
            const radios = document.querySelectorAll('input[type="radio"][name="tipo"]'); 
    
            // Selecciona los formularios con los ID "Natural" y "Jurídico"
            const forms = document.querySelectorAll('#Natural, #Jurídico'); 
    
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
    
            // Muestra el formulario correcto cuando se carga la página
            const selectedFormId = document.querySelector('input[type="radio"][name="tipo"]:checked').value;
            for (const form of forms) {
                if (form.id === selectedFormId) {
                    form.style.display = 'block';
                } else {
                    form.style.display = 'none';
                }
            }
        }
    
        // Añade el evento de carga a la ventana para ejecutar la función showHideForms cuando se carga la página
        window.addEventListener('DOMContentLoaded', showHideForms);
    </script>
  
@endsection