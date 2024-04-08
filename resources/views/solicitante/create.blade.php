@extends('layouts.index')

<title>@yield('title') Registrar Solicitante</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

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
                                <input type="radio" id="customRadio3" name="customRadio" value="n" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio3">Natural</label>
                            </div>

                            <div class="custom-control custom-radio">
                                <input type="radio" id="customRadio4" name="customRadio" value="j" class="custom-control-input">
                                <label class="custom-control-label" for="customRadio4">Jurídico</label>
                            </div>

                        </div>

                    </div>
                    
                    <form method="post" action="{{ route('solicitante.store') }}" enctype="multipart/form-data" onsubmit="return solicitante(this)" id="form-n">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Cédula</label>
                                    <input type="text" class="form-control" id="name" name="cedula" style="background: white;" value="" placeholder="Ingrese La Cédula" autocomplete="off" onkeypress="return solonum(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre</label>
                                    <input type="text" class="form-control" id="username" name="nombre" style="background: white;" value="" placeholder="Ingrese El Nombre" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Apellido</label>
                                    <input type="text" class="form-control" id="password" name="apellido" style="background: white;" value="" placeholder="Ingrese El Apellido" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">N° Minero</label>
                                    <input type="text" class="form-control" id="confirm_password" name="num_minero" style="background: white;" value="" placeholder="N° Minero" autocomplete="off">
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

                    <form method="post" action="{{ route('solicitante.store') }}" enctype="multipart/form-data" onsubmit="return solicitante(this)" id="form-j">
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">RIF</label>
                                    <input type="text" class="form-control" id="email" name="rif" style="background: white;" value="" placeholder="Ingrese el Rif" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre de la Empresa</label>
                                    <input type="text" class="form-control" id="username" name="nombre" style="background: white;" value="" placeholder="Ingrese El Nombre" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Correo Electrónico</label>
                                    <input type="email" class="form-control" id="username" name="email" style="background: white;" value="" placeholder="Ingrese El Correo" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">N° Minero</label>
                                    <input type="text" class="form-control" id="confirm_password" name="num_minero" style="background: white;" value="" placeholder="N° Minero" autocomplete="off">
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
    window.addEventListener('DOMContentLoaded', showHideForms);
  </script>
  
@endsection