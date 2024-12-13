@extends('layouts.index')

<title>@yield('title') Actualizar Entidad Bancaria</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Actualizar Entidad Bancaria</h2>
    
                    </div>
                
                    <form method="post" action="{{ url('/banco/'.$banco->id) }}" enctype="multipart/form-data" onsubmit="return Banco(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-3">
                                    <label  class="font-weight-bold text-primary">Código del Banco</label>
                                    <input class="form-control" type="text" name="codigo_banco" id="codigo_banco" placeholder="Ingrese el Código del banco" maxlength="4" value="{{ isset($banco->codigo_banco)?$banco->codigo_banco:'' }}" onkeypress="return solonum(event);">
                                </div>
                                
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre del Banco</label>
                                    <input class="form-control" type="text" name="nombre_banco" id="nombre_banco" placeholder="Ingrese el Nombre del Banco" value="{{ isset($banco->nombre_banco)?$banco->nombre_banco:'' }}" onkeypress="return soloLetras(event);" oninput="capitalizarInput('nombre_banco')">
                                </div>
                                    
                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('banco/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div> 

    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
  
    {{-- ! FUNCIÓN PARA LOS SELECT MULTIPLE --}}

    <script>

        $(document).ready(function () {

        $('.select2-single').select2();

        // Select2 Single  with Placeholder
        $('.select2-single-placeholder').select2({
            placeholder: "Select a Province",
            allowClear: true
        });      

        // Select2 Multiple
        $('.select2-multiple').select2();
        });

    </script>

    {{-- ? FUNCIÓN PARA CONVERTIR UNA LETRA EN MAYÚSCULAS Y LOS DEMAS EN MINÚSCULAS --}}
    
    {{-- <script>

        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }
    
        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }

    </script> --}}

    <script>
        function capitalizarPrimeraLetraDeCadaPalabra(texto) {
            return texto.replace(/\b\w/g, function (char) {
                return char.toUpperCase();
            }).replace(/\B\w/g, function (char) {
                return char.toLowerCase();
            });
        }
        
        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetraDeCadaPalabra(inputElement.value);
        }
    </script>
        
    
        @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Entidad Bancaria',
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