@extends('layouts.index')

<title>@yield('title') Editar Solicitud</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Actualizar Solicitud</h2>

                    </div>
{{-- 
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

                    </div> --}}
                    
                                                {{-- * FORMULARIO DE SOLICITUDES RECAUDOS --}}

                <form method="post" action="{{ route('solicitudes.update', $solicitudes->id) }}" enctype="multipart/form-data" onsubmit="return solicitudes(this)" >
                    @csrf
                    @method('PUT')

                        <div class="card-body">
                            
                            <div class="row">

                                <div class="card-body">
                                    <h3 class="font-weight-bold text-primary" style="margin-left: 44%;">Datos Solicitante</h3>
                                    <div class="row">
        
                                        <input type="hidden" id="tipo-natural" name="tipo" value="">
        
                                        <div class="col-4">
                                            <label for="persona" class="font-weight-bold text-primary">Tipo de Solicitante</label>
                                            <select class="select2-single form-control" id="tipo_solicitante" name="solicitante">
                                                <option value="0">Seleccione un tipo de Solicitante</option>
                                                {{-- @foreach($personas as $persona)
                                                    <option value="{{ $persona->id }}" @if($persona->id == $asignacion->id_persona) selected @endif>{{ $persona->nombre }}  
                                                    {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                                @endforeach --}}
                                            </select>
                                        </div>
        
                                        <div class="col-5">
                                            <label for="persona" class="font-weight-bold text-primary">Solicitante</label>
                                            <div style="display: flex;">
                                                <select class="select2-single form-control" id="solicitante" name="solicitante_especifico_id" >
                                                    <option value="0">Seleccione una Persona</option>
                                                    {{-- @foreach($personas as $persona)
                                                    <option value="{{ $persona->id }}" @if($persona->id == $asignacion->id_persona) selected @endif>{{ $persona->nombre }}  
                                                    {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                                @endforeach --}}
                                                </select>
        
                                                {{-- <a class="btn btn-primary" href="{{ route('solicitante.create') }}" style="align-content: center; margin-left: 5%"> 
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                                                    </svg>
                                                </a> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                
                        <div class="card-body">
                                <h3 class="font-weight-bold text-primary" style="margin-left: 44%;">Datos Recaudos</h3>
                            <div class="row">
                                
                                <div class="col-4">
                                    <div class="form-check">
                                        <input type="checkbox" id="select-all-recaudos" onclick="selectAll()" class="form-check-input">
                                        <label class="form-check-label" for="select-all">Seleccionar todos los recaudos</label>
                                    </div>
                                    <br>
                                        {{-- @foreach($recaudos as $value)
                                            <div class="form-check">
                                                <label class="form-check-label">{{ Form::checkbox('recaudos[]', $value->id, false, array('class' => 'form-check-input')) }}
                                                {{ $value->nombre }}</label>
                                            </div>
                                        @endforeach  --}}
                                    </div>

                                    <div class="col-4">                                     
                                        <div class="form-group" id="simple-date1">
                                            <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                            <div class="input-group date">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                                </div>
                                                <input type="text" class="form-control" value="01/06/2020" id="simpleDataInput" name= "simpleDataInput">
                                            </div>
                                        </div>
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
                                <a  class="btn btn-info btn-lg" href="{{ url('inspeccion/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                </form>


                                                    {{-- * FORMULARIO PROCESAMIENTO DE SOLICITUDES RECAUDOS --}}

            {{-- <form method="post" action="{{ route('solicitudes.store') }}" enctype="multipart/form-data" onsubmit="return solicitante(this)" id="Jurídico" style="display: none;"> --}}
                    {{-- @csrf
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
                                            </select> --}}

                                                {{-- <a class="btn btn-primary" href="{{ route('solicitante.create') }}" style="align-content: center; margin-left: 5%"> 
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
                                                </svg>
                                            </a> 
                                        </div>
                                    </div>
                                    
                    
                                </div>
                            </div> 
                            
                        <div class="card-body">
                                <h3 class="font-weight-bold text-primary" style="margin-left: 44%;">Datos Recaudos</h3>
                            <div class="row">

                                <div class="col-4">
                                    {{-- @foreach($recaudos as $value)
                                        <div class="form-check">
                                            <label class="form-check-label">{{ Form::checkbox('recaudos[]', $value->id, false, array('class' => 'form-check-input')) }}
                                            {{ $value->nombre }}</label>
                                        </div>
                                    @endforeach  
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" class="form-control" value="01/06/2020" id="simpleDataInput" name = "simpleDataInput">
                                        </div>
                                    </div>
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
                            <a  class="btn btn-info btn-lg" href="{{ url('inspeccion/') }}"><span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Regresar</span></a>
                        </center>

                </form>--}}
            </div>
        </div>    
    </div>

@endsection 