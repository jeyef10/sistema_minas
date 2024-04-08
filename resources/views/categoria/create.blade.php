@extends('layouts.index')

<title>@yield('title') Registrar Categoria</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Categoria</h2>
    
                    </div>
                
                    <form method="post" action="{{ route('categoria.store') }}" enctype="multipart/form-data" onsubmit="return Categoria(this)">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Tipo Categoria</label>
                                    <select class="select2-single form-control" name="tipo_categoria" id="tipo_categoria">
                                        <option value="0" selected="true" disabled>Seleccione una Categoria</option>
                                        <option value="Aprovechamiento">Aprovechamiento</option>
                                        <option value="Procesamiento">Procesamiento</option>
                                    </select>
                                </div>

                                <div class="col-2">
                                    <label class="font-weight-bold text-primary">Tipo Minerales</label>
                                        <div class="custom-control custom-radio col-1.5">
                                            <input class="custom-control-input" type="radio" name="tipo" id="metalico" value="Metálicos">
                                            <label class="custom-control-label" for="metalico">Metálicos</label>
                                        </div>
                                        
                                        <div class="custom-control custom-radio col-1.5">
                                            <input class="custom-control-input" type="radio" name="tipo" id="no_metalico" value="No metálicos">
                                            <label class="custom-control-label" for="no_metalico">No Metálicos</label>
                                        </div>
                                </div>

                                <div class="col-4">
                                    <label for="mineral" class="font-weight-bold text-primary">Nombre Mineral</label>
                                    <select class="select2-single form-control" name="id_mineral" id="mineral">
                                    <option value="0" disabled>Seleccione una Categoria</option>
                                        @foreach ($minerales as $mineral)
                                            @if ($mineral->tipo == 'Metálicos')
                                            <option value="{{ $mineral->id }}" data-tipo="Metálicos">{{ $mineral->nombre }}</option>
                                            @elseif ($mineral->tipo == 'No metálicos')
                                            <option value="{{ $mineral->id }}" data-tipo="No metálicos">{{ $mineral->nombre }}</option>
                                            @endif
                                        @endforeach
                                    </select>                                
                                </div>
                                
                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('categoria/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>  


    <script>
    // Obtener referencias a los elementos del formulario
    const tipoRadios = document.querySelectorAll('input[name="tipo"]');
    const sistemaSelect = document.getElementById('mineral');
    
    // Obtener la opción "Seleccione un Mineral"
    const opcionSeleccione = sistemaSelect.querySelector('option[value="0"]');
    
    // Ocultar todas las opciones del select excepto "Seleccione un Mineral"
    Array.from(sistemaSelect.options).forEach(option => {
        if (option !== opcionSeleccione) {
            option.style.display = 'none';
        }
    });

    // Escuchar el evento "change" en los radios de tipo
    tipoRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Obtener el valor del radio seleccionado
            const tipoSeleccionado = this.value;

            // Mostrar u ocultar las opciones del select según el tipo seleccionado
            Array.from(sistemaSelect.options).forEach(option => {
                const tipoOpcion = option.getAttribute('data-tipo');
                if (option === opcionSeleccione || tipoOpcion === tipoSeleccionado) {
                    option.style.display = 'block';
                } else {
                    option.style.display = 'none';
                }
            });

            // Reiniciar el valor del select si la opción seleccionada se oculta
            if (sistemaSelect.selectedIndex !== -1 && sistemaSelect.options[sistemaSelect.selectedIndex].style.display === 'none') {
                sistemaSelect.selectedIndex = -1;
            }
        });
    });
</script>

@endsection