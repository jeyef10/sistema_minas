@extends('layouts.index')

<title>@yield('title') Registrar Plazos</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Plazos</h2>
    
                    </div>
                

                    <form method="post" action="{{ route('plazo.store') }}" enctype="multipart/form-data" onsubmit="return Plazo(this)">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                            <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Cantidad</label>
                                    <input type="text" class="form-control" id="cantidad" name="cantidad" style="background: white;" value="" placeholder="Ingrese la cantidad" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Medida de tiempo</label>
                                    <input type="text" class="form-control" id="medida_tiempo" name="medida_tiempo" style="background: white;" value="" placeholder="Ingrese la medida del tiempo" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                                <!-- <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Moneda de Longitud</label>
                                    <select class="select2-single form-control" name="moneda_longitud" id="moneda_longutid">
                                        <option value="0" selected="true" disabled>Seleccione una Moneda</option>
                                        <option value="$ 1.5mtrs/3">$ 1.5mtrs/3</option>
                                    </select>
                                </div> -->
                        

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('plazo/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>  

@endsection