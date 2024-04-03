@extends('layouts.index')

<title>@yield('title') Registrar Regalia</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Regalia</h2>
    
                    </div>
                

                    <form method="post" action="{{ route('regalia.store') }}" enctype="multipart/form-data" onsubmit="return Regalia(this)">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                            <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Monto</label>
                                    <input type="text" class="form-control" id="monto" name="monto" style="background: white;" value="" placeholder="Ingrese el monto" autocomplete="off" onkeypress="return solonum(event);">
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Moneda/Longitud</label>
                                    <select class="select2-single form-control" name="moneda_longitud" id="moneda_longitud">
                                        <option value="0" selected="true" disabled>Seleccione una Moneda</option>
                                        <option value="$/mtrs/3">$/mtrs/3</option>
                                    </select>
                                </div>
                        

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('regalia/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>  

@endsection