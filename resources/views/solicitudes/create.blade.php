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

                        {{-- <label class="custom-control-label">Seleccione la licencia a solicitar</label> --}}

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
                            <h4 class="font-weight-bold text-primary" style="margin-left: 44%;">Datos Solicitante</h4>
                            <div class="row">

                                <input type="hidden" id="tipo-natural" name="tipo" value="">

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Tipo de Solicitante</label>
                                    <select class="select2-single form-control" id="persona" name="id_persona">
                                        <option value="0">Seleccione un tipo de Solicitante</option>
                                        {{-- @foreach($personas as $persona)
                                            <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label for="persona" class="font-weight-bold text-primary">Solicitante</label>
                                    <select class="select2-single form-control" id="persona" name="id_persona">
                                        <option value="0">Seleccione una Persona</option>
                                        {{-- @foreach($personas as $persona)
                                            <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                        @endforeach --}}
                                    </select>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">N° Minero</label>
                                    <input type="text" class="form-control" id="num_minero" name="num_minero" style="background: white;" value="" placeholder="N° Minero" autocomplete="off" readonly>
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
                                            <option value="0">Seleccione un tipo</option>
                                            {{-- @foreach($personas as $persona)
                                                <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                            @endforeach --}}
                                        </select>
                                    </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Nombre Mineral</label>
                                        <select class="select2-single form-control" id="nom_mineral" name="nom_mineral">
                                            <option value="0">Seleccione un mineral</option>
                                            {{-- @foreach($personas as $persona)
                                                <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                            @endforeach --}}
                                        </select>                                   
                                     </div>
            
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N° de regalias</label>
                                        <input type="number" class="form-control" id="num_minero" name="num_minero" style="background: white;" value="" placeholder="N° Minero" autocomplete="off" onkeypress="return solonum(event);" min="0">
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Tasa de Regalías</label>
                                        <select class="select2-single form-control" id="tasa_regalias" name="tasa_regalias">
                                            <option value="0">Seleccione una tasa</option>
                                            {{-- @foreach($personas as $persona)
                                                <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                            @endforeach --}}
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
                                            {{-- @foreach($personas as $persona)
                                                <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                            @endforeach --}}
                                        </select>                                   
                                     </div>

                                     <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Municipio</label>
                                        <select class="select2-single form-control" id="vigencia" name="vigencia">
                                            <option value="0">Seleccione un municipio</option>
                                            {{-- @foreach($personas as $persona)
                                                <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                            @endforeach --}}
                                        </select>                                   
                                     </div>

                                     <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Parroquia</label>
                                        <select class="select2-single form-control" id="vigencia" name="vigencia">
                                            <option value="0">Seleccione un parroquia</option>
                                            {{-- @foreach($personas as $persona)
                                                <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                            @endforeach --}}
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
                                        <label for="simpleDataInput">Fecha</label>
                                          <div class="input-group date">
                                            <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="01/06/2020" id="simpleDataInput">
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

                                <input type="hidden" id="tipo-jurídico" name="tipo" value="">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">RIF</label>
                                    <input type="text" class="form-control" id="rif" name="rif" style="background: white;" value="" placeholder="Ingrese el Rif" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre de la Empresa</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="" placeholder="Ingrese El Nombre" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="email" name="correo" style="background: white;" value="" placeholder="Ingrese El Correo" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">N° Minero</label>
                                    <input type="text" class="form-control" id="num_minero" name="num_minero" style="background: white;" value="" placeholder="N° Minero" autocomplete="off">
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