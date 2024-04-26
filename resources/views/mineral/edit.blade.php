@extends('layouts.index')

<title>@yield('title') Actualizar Mineral</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Actualizar Mineral</h2>
    
                    </div>
                

                    <form method="post" action="{{ url('/mineral/'.$mineral->id) }}" enctype="multipart/form-data" onsubmit="return mineral(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Tipo</label>
                                    <select class="select2-single form-control" name="tipo" id="tipo">
                                        <option value="0" disabled>Seleccione una Marca</option>
                                            <option value="No metálicos" {{ (old('tipo', $mineral->tipo ?? '') === 'No metálicos') ? 'selected' : '' }}>No metálicos</option>
                                            {{-- <option value="Metálicos" {{ (old('tipo', $mineral->tipo ?? '') === 'Metálicos') ? 'selected' : '' }}>Metálicos</option> --}}
                                    </select>
                                </div>
                            
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre</label>
                                    <input type="text" class="form-control" id="username" name="nombre" style="background: white;" value="{{ isset($mineral->nombre)?$mineral->nombre:'' }}" placeholder="Ingrese El Nombre" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Categoria</label>
                                    <select class="select2-single form-control" name="categoria" id="categoria">
                                        <option value="0" selected="true" disabled>Seleccione una Mineral</option>
                                        <option value="Aprovechamiento" {{ (old('categoria', $mineral->categoria ?? '') === 'Aprovechamiento') ? 'selected' : '' }}>Aprovechamiento</option>
                                        <option value="Procesamiento" {{ (old('categoria', $mineral->categoria ?? '') === 'Procesamiento') ? 'selected' : '' }}>Procesamiento</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('mineral/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>  

@endsection