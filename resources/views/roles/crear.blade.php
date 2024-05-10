@extends('layouts.index')

<title>@yield('title') Registrar Roles</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Rol</h2>

                    </div>
                
                    <form method="post" action="{{ route('roles.store') }}" enctype="multipart/form-data" onsubmit="return roles(this)">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label class="font-weight-bold text-primary">Nombre del Rol</label>
                                    <input type="text" class="form-control" id="name" name="name" style="background: white;"  value="" onkeypress="return soloLetras(event);">
                                </div>

                                <br><br><br><br>

                                <div class="form-group d-flex flex-wrap">
                                
                                    <br/>
                                    <div class="form-check mr-3">
                                        <input type="checkbox" id="select-all-permissions" onclick="selectAll()" class="form-check-input">
                                        <label class="form-check-label" for="select-all">Seleccionar todos los roles</label>
                                    </div>

                                    @foreach($permission as $value)
                                        <div class="form-check mr-3">
                                            <label class="form-check-label">{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'form-check-input')) }}
                                            {{ $value->name }}</label>
                                        </div>
                                        <br/>
                                    @endforeach                       
                                </div>

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('roles/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>

    <script>
            
        function selectAll() {
        var checkboxes = document.getElementsByTagName("input");
        for (var checkbox of checkboxes) {
            if (checkbox.type === "checkbox") {
                checkbox.checked = document.getElementById('select-all-permissions').checked;
            } 
        }
        }
        
    </script>

@endsection
