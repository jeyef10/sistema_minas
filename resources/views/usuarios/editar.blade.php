@extends('layouts.index')

<title>@yield('title') Editar Usuarios</title>
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
                        

                            {!! Form::model($user, ['method' => 'PATCH','route' => ['usuarios.update', $user->id], 'onsubmit' => 'return usuario(this)']) !!}
                            {!! Form::model($user, ['method' => 'PATCH','route' => ['usuarios.update', $user->id]]) !!}

                                @csrf
                            
                            <div class="card-body">
                                
                                <div class="row">
                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Nombre</label>
                                        {!! Form::text('name', null, array('class' => 'form-control', 'onkeypress' => 'return soloLetras(event);')) !!}
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">E-mail</label>
                                        {!! Form::text('email', null, array('class' => 'form-control')) !!}
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Nombre de Usuario</label>
                                        {!! Form::text('username', null, array('class' => 'form-control')) !!}
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Contraseña</label>
                                        {!! Form::password('password', array('class' => 'form-control')) !!}
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Confirmar Contraseña</label>
                                        {!! Form::password('confirm-password', array('class' => 'form-control')) !!}
                                    </div>

                                    <div class="col-4">
                                        <label class="font-weight-bold text-primary">Roles</label>
                                        {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control mb-3')) !!}
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
                        </div>
                    </form>
             </div> 
    </div>
    
    @if ($errors->any())
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
@endif  
          
@endsection