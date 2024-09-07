@extends('layouts.index')

<title>@yield('title') Actualizar Pago</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Actualizar Pago</h2>
    
                    </div>
                

                    <form method="post" action="{{ url('/tipopago/'.$tipo_pago->id) }}" enctype="multipart/form-data" onsubmit="return TipoPago(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                        <div class="card-body">
                            
                            <div class="row">
                            
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre del Pago</label>
                                    <input type="text" class="form-control" id="nombre_pago" name="nombre_pago" style="background: white;" value="{{ isset($tipo_pago->nombre_pago)?$tipo_pago->nombre_pago:'' }}" placeholder="Ingrese El Nombre" autocomplete="off" oninput="capitalizarInput('nombre')">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Método de Pago</label>
                                    <select class="select2single form-control" name="forma_pago" id="forma_pago">
                                        <option value="0" selected="true" disabled>Seleccione un Método de pago</option>
                                        <option value="Efectivo" {{ (old('forma_pago', $tipo_pago->forma_pago ?? '') === 'Efectivo') ? 'selected' : '' }}>Efectivo</option>
                                        <option value="Pago Movil" {{ (old('forma_pago', $tipo_pago->forma_pago ?? '') === 'Pago Movil') ? 'selected' : '' }}>Pago Movil</option>
                                        <option value="Transferencia Bancaria" {{ (old('forma_pago', $tipo_pago->forma_pago ?? '') === 'Transferencia Bancaria') ? 'selected' : '' }}>Transferencia Bancaria</option>
                                    </select>
                                </div>

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('tipopago/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div> 

    {{-- ? FUNCIÓN PARA CONVERTIR UNA LETRA EN MAYÚSCULAS Y LOS DEMAS EN MINÚSCULAS --}}
    
    <script>
        function capitalizarPrimeraLetra(texto) {
            return texto.charAt(0).toUpperCase() + texto.slice(1).toLowerCase();
        }
    
        function capitalizarInput(idInput) {
            const inputElement = document.getElementById(idInput);
            inputElement.value = capitalizarPrimeraLetra(inputElement.value);
        }
    </script>
    
    @if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        Swal.fire({
                    title: 'Mineral',
                    text: " Este Mineral Ya Existe.",
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