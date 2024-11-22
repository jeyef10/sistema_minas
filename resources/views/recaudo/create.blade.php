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
                                    <label for="recaudo" class="font-weight-bold text-primary">Nombre</label>
                                    <input type="text" class="form-control" id="recaudo" name="nombre" style="background: white;" value="" placeholder="Ingrese un Recaudo" autocomplete="off" onkeypress="return soloLetras(event);" oninput="capitalizarInput('recaudo')">
                                </div>

                                <div class="col-4">
                                    <label for="select2Multiple" class="font-weight-bold text-primary">Categoría</label>
                                    <select class="select2-multiple form-control" name="categoria_recaudos[]" multiple="multiple" id="select2Multiple">
                                        <option value="" disabled>Seleccione una o ambas Categoria</option>
                                        <option value="Aprovechamiento">Aprovechamiento</option>
                                        <option value="Procesamiento">Procesamiento</option>
                                    </select>
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