@extends('layouts.index')

<title>@yield('title') Registrar Pago</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>


@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Pago</h2>
    
                    </div>
                
                    <form method="post" action="{{ route('tipopago.store') }}" enctype="multipart/form-data" onsubmit="return TipoPago(this)">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre del Pago</label>
                                    <select class="select2single form-control" name="nombre_pago" id="nombre_pago">
                                        <option value="" disabled>Seleccione un Pago</option>
                                        <option value="Pago Licencia" selected="true">Pago Licencia</option>
                                    </select>
                                </div>

                                <div class="col-3">
                                    <label  class="font-weight-bold text-primary">Metodo de Pago</label>
                                    <select class="select2single form-control" name="forma_pago" id="forma_pago">
                                        <option value="" selected="true" disabled>Seleccione un Metodo de Pago</option>
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Pago Móvil">Pago Móvil</option>
                                        <option value="Transferecia Bancaria">Transferecia Bancaria</option>
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
    
    <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('vendor/select2/dist/js/select2.min.js')}}"></script>
  

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
                            title: 'Recaudo',
                            text: " Esta Recaudo Ya Existe.",
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