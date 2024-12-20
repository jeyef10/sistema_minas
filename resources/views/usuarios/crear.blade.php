@extends('layouts.index')

<title>@yield('title') Registrar Usuarios</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
        <div class="col-lg-12">
            <div class="card mb-4">

                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Usuario</h2>

                </div>
                

                <form method="post" action="{{ route('usuarios.store') }}" enctype="multipart/form-data" onsubmit="return usuario(this)">
                    @csrf
                        
                    <div class="card-body">
                        
                        <div class="row">

                            <div class="col-4">
                                <label  class="font-weight-bold text-primary">Roles</label>
                                {!! Form::select('roles[]', $roles,[], array('class' => 'form-control mb-3', 'id' => 'roles', 'onchange' => 'mostrarCampoCedula()')) !!}
                            </div>

                            <div class="col-4" id="cedulaField" style="display: none;">
                                <label  class="font-weight-bold text-primary">Cédula Comisionado</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" style="background: white;" value="" placeholder="Ingrese La Cédula del Comisionado" autocomplete="off" onkeypress="return solonum(event);" onblur="verificarCedula()">
                                <small id="mensajeCedula"> </small>
                            </div>

                            <div class="col-4">
                                <label  class="font-weight-bold text-primary">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" style="background: white;" value="" placeholder="Ingrese el Nombre" autocomplete="off" onkeypress="return soloLetras(event);">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-primary">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" style="background: white;" value="" placeholder="Ingrese el E-mail" autocomplete="off">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-primary">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="username" name="username" style="background: white;" value="" placeholder="Ingrese El Usuario" autocomplete="off">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-primary">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" style="background: white;" value="" placeholder="Ingrese la Contrseña" autocomplete="off">
                            </div>
    
                            <div class="col-4">
                                <label  class="font-weight-bold text-primary">Confirmar Contraseña</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" style="background: white;" value="" placeholder="Confirme La Contraseña" autocomplete="off">
                            </div>
    
                        </div>

                    </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="{{ url('usuarios/') }}"><span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Regresar</span></a>
                        </center>
                </form>
            </div>
        </div>    
</div>

<script>
    function mostrarCampoCedula() {
        var rol = document.getElementById("roles").value;
        var cedulaField = document.getElementById("cedulaField");
        
        if (rol === "Comisionado") {
            cedulaField.style.display = "block";
        } else {
            cedulaField.style.display = "none";
        }
    }

    function verificarCedula() {
        var cedula = document.getElementById("cedula").value;
        var mensajeCedula = document.getElementById("mensajeCedula");
        var nombreCampo = document.getElementById("name");

        fetch(`/verificar-cedula?cedula=${cedula}`)
            .then(response => response.json())
            .then(data => {
                if (data.existe) {
                    document.getElementById("cedula").style.borderColor = "green";
                    mensajeCedula.textContent = "Comisionado Encontrado Exitosamente";
                    mensajeCedula.style.color = "green";
                    // Insertar el nombre y apellido en el campo de nombre 
                    nombreCampo.value = `${data.nombres} ${data.apellidos}`;
                } else {
                    document.getElementById("cedula").style.borderColor = "red";
                    mensajeCedula.textContent = "Comisionado No Encontrado";
                    mensajeCedula.style.color = "red";

                    // Limpiar el campo de nombre 
                    nombreCampo.value = "";
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>

{{-- @if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        Swal.fire({
                title: 'Usuario',
                text: " Este Email Ya Existe.",
                icon: 'warning',
                showconfirmButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: '¡OK!',
                
                }).then((result) => {
            if (result.isConfirmed) {

                this.submit();
            }
            })
    </script>
@endif --}}

@if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Usuario',
                    text: error,
                    icon: 'warning',
                    showConfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                });
            });
        </script>
    @endif

@endsection