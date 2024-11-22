@extends('layouts.index')

<title>@yield('title') Actualizar Mineral</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Actualizar Mineral</h2>
    
                    </div>
                

                    <form method="post" action="{{ url('/mineral/'.$mineral->id) }}" enctype="multipart/form-data" onsubmit="return mineral(this)">
                        @csrf
                        {{ method_field('PATCH')}}
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Tipo</label>
                                    <select class="select2-single form-control" name="tipo" id="tipo">
                                        <option value="0" disabled>Seleccione una Mineral</option>
                                            <option value="No metálicos" {{ (old('tipo', $mineral->tipo ?? '') === 'No metálicos') ? 'selected' : '' }}>No metálicos</option>
                                            {{-- <option value="Metálicos" {{ (old('tipo', $mineral->tipo ?? '') === 'Metálicos') ? 'selected' : '' }}>Metálicos</option> --}}
                                    </select>
                                </div>
                            
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="{{ isset($mineral->nombre)?$mineral->nombre:'' }}" placeholder="Ingrese El Nombre" autocomplete="off" oninput="capitalizarInput('nombre')" onkeypress="return soloLetras(event);">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Categoria</label>
                                    <select class="select2-single form-control" name="categoria" id="categoria">
                                        <option value="0" selected="true" disabled>Seleccione una Categoría</option>
                                        <option value="Aprovechamiento" {{ (old('categoria', $mineral->categoria ?? '') === 'Aprovechamiento') ? 'selected' : '' }}>Aprovechamiento</option>
                                        <option value="Procesamiento" {{ (old('categoria', $mineral->categoria ?? '') === 'Procesamiento') ? 'selected' : '' }}>Procesamiento</option>
                                    </select>
                                </div>
                                
                                <!-- <div class="card-body">
                                    <div class="row" id="tasa_options">
                                        <div class="custom-control custom-radio col-3 mr-2">
                                            <input class="custom-control-input" type="radio" name="tasa" value="Tasa Mineral" id="tasa_mineral" {{ ($mineral->tasa =="Tasa Mineral")? "checked" : ""}}>
                                            <label class="custom-control-label font-weight-bold text-primary" for="tasa_mineral">Tasa Mineral</label>
                                        </div>
                                        <div class="custom-control custom-radio col-3 mr-2" id="tasa_convenio_container" style="display: none;">
                                            <input class="custom-control-input" type="radio" name="tasa" value="Tasa Convenio" id="tasa_convenio" {{ ($mineral->tasa =="Tasa Convenio")? "checked" : ""}}>
                                            <label class="custom-control-label font-weight-bold text-primary" for="tasa_convenio">Tasa Convenio</label>
                                        </div>
                                    </div>
                                </div>     -->

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Tasa</label>
                                    <input type="text" class="form-control" id="tasa" name="tasa" style="background: white;" value="{{ isset($mineral->tasa)?$mineral->tasa:'' }}" placeholder="Ingrese El monto" autocomplete="off">
                                </div>
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Moneda/Longitud</label>
                                    <select class="select2-single form-control" name="moneda_longitud" id="">
                                        <option value="0" disabled>Seleccione una Marca</option>
                                            <option value="$/mtrs3" {{ (old('tipo', $mineral->moneda_longitud ?? '') === '$/mtrs3') ? 'selected' : '' }}>$/mtrs3</option>
                                           
                                    </select>
                                </div>
                            

                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('mineral/') }}"><span class="icon text-white-50">
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


    <!-- <script>
            document.addEventListener("DOMContentLoaded", function() {
                const categoriaSelect = document.getElementById('categoria');
                const tasaMineral = document.getElementById('tasa_mineral').parentNode;
                const tasaConvenio = document.getElementById('tasa_convenio_container');

                function toggleTasaOptions() {
                    const selectedValue = categoriaSelect.value;
                    if (selectedValue === 'Aprovechamiento') {
                        tasaMineral.style.display = 'block';
                        tasaConvenio.style.display = 'block';
                    } else if (selectedValue === 'Procesamiento') {
                        tasaMineral.style.display = 'block';
                        tasaConvenio.style.display = 'none';
                    } else {
                        tasaMineral.style.display = 'none';
                        tasaConvenio.style.display = 'none';
                    }
                }

                // Inicialmente ocultar los radios hasta que se seleccione una categoría
                toggleTasaOptions();

                // Ejecutar al cambiar la selección
                categoriaSelect.addEventListener('change', toggleTasaOptions);
            });

    </script> -->
    
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