@extends('layouts.index')

<title>@yield('title') Registrar Recaudo</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Recaudo</h2>
    
                    </div>
                

                    <form method="post" action="{{ route('recaudo.store') }}" enctype="multipart/form-data" onsubmit="return Recaudo(this)">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                            <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre</label>
                                    <input type="text" class="form-control" id="recaudo" name="nombre" style="background: white;" value="" placeholder="Ingrese un Recaudo" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('recaudo/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>  

@endsection