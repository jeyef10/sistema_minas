@extends('layouts.index')

<title>@yield('title') Perfil</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Perfil</h2>
                    </div>

                    <form method="POST" action="{{route('changePassword')}}">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" style="background: white;" value="" placeholder="Ingrese el Nombre" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>

                                <div class="col-4">
                                    <label class="font-weight-bold text-primary">Usuario</label>
                                    <input type="text" class="form-control" name="username" value="{{ Auth::user()->username }}" onkeypress="" style="background: white;">
                                </div>
                    
                                <div class="col-4">
                                    <label class="font-weight-bold text-primary">Contraseña Actual</label>
                                    <input type="password" class="form-control" name="password_actual"  onkeypress="" style="background: white;">
                                </div>
                    
                                <div class="col-4">
                                    <label class="font-weight-bold text-primary">Nueva Contraseña</label>
                                    <input type="password" class="form-control" name="password" onkeypress="" style="background: white;">
                                </div>
                    
                                <div class="col-4">
                                    <label class="font-weight-bold text-primary">Confirme Nueva Contraseña</label>
                                    <input type="password" class="form-control" name="confirm_password" onkeypress="" style="background: white;">
                                </div>

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                    <span class="text">Guardar</span>
                                </button>

                                <a class="btn btn-info btn-lg" href="/home">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    <span class="text">Regresar</span>
                                </a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>  
      
@endsection