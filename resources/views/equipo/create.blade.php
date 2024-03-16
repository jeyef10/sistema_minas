@extends('layouts.index')

<title>@yield('title') Registrar Equipo</title>

<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

<script>
$(document).ready(function() {
  $('#guardarMarca').click(function(event) { // al hacer clic en el botón con id 'guardarMarca'
    event.preventDefault(); // prevenimos el comportamiento por defecto del botón
    if (/^([a-zA-Z0-9])\1+$/.test($('#nombre_marca').val())) { // Validamos que no pueda guardar con carecteres repetidos
        Swal.fire({
        title: 'Periférico',
        text: "El campo marca no debe contener solo caracteres repetidos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {
        this.submit();
    }
    })
    
    obj.nombre_marca.focus();
    return false;
    } 
    $.ajax({
      url: '/marca/saveModal', // la url que se va a ejecutar la acción del controlador
      type: 'POST', // el método HTTP utilizado
      data: $('#marcaForm').serialize(), // los datos que se van a enviar al servidor
      success: function(response){ // si la petición es exitosa
        $('#marca').append($('<option>', { // agrega una opción al select con id 'marca'
          value: response.marca.id, // asigna el valor de la propiedad id del objeto de respuesta al atributo 'value'
          text: response.marca.nombre_marca // asigna el valor de la propiedad nombre_marca del objeto de respuesta al contenido de la opción
        })).trigger('change'); // opcional si usas algún plugin de select
        $('#staticBackdrop').modal('hide'); // oculta el modal con id 'staticBackdrop'
        $('#marcaForm')[0].reset(); // reinicia el formulario con id 'marcaForm'
        Swal.fire(
                '¡Marca!',
                'Creado Exitosamente.',
                'success'
                )
        //alert("Creado Exitosamnete.") // muestra una alerta con un mensaje de éxito
      },
      error: function(error){ // si hay un error en la petición
        console.log('Error al guardar la marca:', error); // muestra un mensaje en la consola del navegador
        Swal.fire({ // muestra una alerta con un mensaje de error
        title: 'Marca',
        text: "Error al guardar la marca",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {
        this.submit();
    }
    })
        
      }
    });
  });
});
</script>

<script>
$(document).ready(function() {
  $('#guardarModelo').click(function(event) { // al hacer clic en el botón con id 'guardarModelo'
    event.preventDefault(); // prevenimos el comportamiento por defecto del botón
    if (/^([a-zA-Z0-9])\1+$/.test($('#nombre_modelo').val())) { // Validamos que no pueda guardar con carecteres repetidos
        Swal.fire({
        title: 'Periférico',
        text: "El campo modelo no debe contener solo caracteres repetidos.",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {
        this.submit();
    }
    })
        
    obj.nombre_modelo.focus();
    return false;
    }
    $.ajax({
      url: '/modelo/saveModal', // la url que se va a ejecutar la acción del controlador
      type: 'POST', // el método HTTP utilizado
      data: $('#modeloForm').serialize(), // los datos que se van a enviar al servidor
      success: function(response){ // si la petición es exitosa
        $('#modelo').append($('<option>', { // agrega una opción al select con id 'modelo'
          value: response.modelo.id, // asigna el valor de la propiedad id del objeto de respuesta al atributo 'value'
          text: response.modelo.nombre_modelo // asigna el valor de la propiedad nombre_modelo del objeto de respuesta al contenido de la opción
        })).trigger('change'); // opcional si usas algún plugin de select
        $('#staticBackdropModelo').modal('hide'); // oculta el modal con id 'staticBackdrop'
        $('#modeloForm')[0].reset(); // reinicia el formulario con id 'modeloForm'
        Swal.fire( // muestra una alerta con un mensaje de éxito
                '¡Modelo!',
                'Creado Exitosamente.',
                'success'
                )
        
      },
      error: function(error){ // si hay un error en la petición
        console.log('Error al guardar la modelo:', error); // muestra un mensaje en la consola del navegador
        Swal.fire({ // muestra una alerta con un mensaje de error
        title: 'Modelo',
        text: "Error al guardar el modelo",
        icon: 'warning',
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        }).then((result) => {
    if (result.isConfirmed) {
        this.submit();
    }
    })

      }
    });
  });
});

</script>

@section('content')

    @if ($errors->any())
    <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
    @endif

    <div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
            <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Crear Equipo</h3>
                    </center>
                    
                    <form method="post" action="{{ url('/equipo') }}" enctype="multipart/form-data" onsubmit="return Equipo(this)">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <label for="marca" style="color: black;">Marca del Equipo</label>
                                <select class="form-select" id="marca" name="id_marca">
                                    <option value="0">Seleccione una Marca</option>
                                    @foreach($marcas as $marca)
                                        <option value="{{ $marca->id }}">{{ $marca->nombre_marca }}</option>
                                    @endforeach
                                </select>                            
                            </div>

                            <button type="button" class="btn btn-light" style="margin-top: 2%; height: 5vh; width: 6%; color: white;" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="bi bi-plus-square"></i></button>

                            <div class="col-3">
                                <label for="modelo" style="color: black;">Modelo del Equipo</label>
                                <select class="form-select" id="modelo" name="id_modelo">
                                    <option value="0">Seleccione un Modelo</option>
                                    @foreach($modelos as $modelo)
                                        <option value="{{ $modelo->id }}">{{ $modelo->nombre_modelo }}</option>
                                    @endforeach
                                </select>                            
                            </div>

                            <button type="button" class="btn btn-light" style="margin-top: 2%; height: 5vh; width: 6%; color: white;" data-bs-toggle="modal" data-bs-target="#staticBackdropModelo"><i class="bi bi-plus-square"></i></button>

                            <div class="col-3">
                                <label style="color: black;">Serial</label>
                                <input type="text" class="form-control" name="serial" id="serial" value="{{ isset($equipo->serial)?$equipo->serial:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>
                            
                            <div class="col-3">
                                <label style="color: black;">Serial Activo</label>
                                <input type="text" class="form-control" name="serialA" id="serialA" value="{{ isset($equipo->serialA)?$equipo->serialA:'' }}" onkeypress="return sinespancios(event);" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Modelo del CPU</label>
                                <input type="text" class="form-control" name="cpu" id="cpu" value="{{ isset($equipo->cpu)?$equipo->cpu:'' }}" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Velocidad del CPU (GHz)</label>
                                <input type="text" class="form-control" name="velocidad" id="velocidad" value="{{ isset($equipo->velocidad)?$equipo->velocidad:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Memoria Ram (GB)</label>
                                <input type="text" class="form-control" name="ram" id="ram" value="{{ isset($equipo->ram)?$equipo->ram:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>

                            <div class="col-3">
                                <label style="color: black;">Disco Duro (GB)</label>
                                <input type="text" class="form-control" name="disco" id="disco" value="{{ isset($equipo->disco)?$equipo->disco:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>
                            
                            <div class="col-3">
                            <label style="color: black;">Tipo de Sistema</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="privativo" value="Privativo">
                                <label class="form-check-label" for="privativo">
                                    Privativo
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="tipo" id="libre" value="Libre">
                                <label class="form-check-label" for="libre">
                                    Libre
                                </label>
                            </div>
                            </div>

                            <div class="col-3">
                                <label for="sistema" style="color: black;">Sistema</label>
                                <select class="form-select" id="sistema" name="id_so">
                                    <option value="0" selected>Seleccione un Sistema</option>
                                    @foreach($sistemas as $sistema)
                                        @if ($sistema->tipo == 'Privativo')
                                            <option value="{{ $sistema->id }}" data-tipo="Privativo">{{ $sistema->nombre }} {{ $sistema->version }}</option>
                                        @elseif ($sistema->tipo == 'Libre')
                                            <option value="{{ $sistema->id }}" data-tipo="Libre">{{ $sistema->nombre }} {{ $sistema->version }}</option>
                                        @endif
                                    @endforeach
                                </select>

                            </div>

                            <div class="col-3" style="display:none;">
                                <label style="color: black;">Estatus</label>
                                <input type="text" class="form-control" name="estatus" id="equipo" value="Incorporado" onkeypress="return soloLetras(event);" style="background: white;">
                            </div>

                        </div>

                        <br>
                        <center>
                            <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                            <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('equipo/') }}"> Regresar </a>
                        </center>
                    </form>

                </div>
            </div> 
        </div>
    </div>

    <script>
    // Obtener referencias a los elementos del formulario
    const tipoRadios = document.querySelectorAll('input[name="tipo"]');
    const sistemaSelect = document.getElementById('sistema');
    
    // Obtener la opción "Seleccione un Sistema"
    const opcionSeleccione = sistemaSelect.querySelector('option[value="0"]');
    
    // Ocultar todas las opciones del select excepto "Seleccione un Sistema"
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




    <!-- Modal Marca  -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="marcaForm" method="POST" action="{{ route('marca.saveModal') }}">
                    @csrf   
                    <div class="modal-header">
                    <h3 class="modal-title" id="staticBackdropLabel" style="color: black;">Nuevo Registro de la Marca</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-5">
                            <label style="color: black;">Nueva Marca</label>
                            <input type="text" class="form-control" id="nombre_marca" name="nombre_marca" onkeypress="return sinespacios(event);" style="background: white;">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="guardarMarca" class="btn btn-lg btn-success"><i class="bi bi-check2-square"></i></button>
                        <button type="button" class="btn btn-lg btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Modelo  -->
    <div class="modal fade" id="staticBackdropModelo" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="modeloForm" method="POST" action="{{ route('modelo.saveModal') }}">
                @csrf  
                    <div class="modal-header">
                        <h3 class="modal-title" id="staticBackdropModeloLabel" style="color: black;">Nuevo Registro del Modelo</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="col-4">
                        <label style="color: black;">Nuevo Modelo</label>
                        <input type="text" class="form-control" id="nombre_modelo" name="nombre_modelo" onkeypress="return sinespacios(event);" style="background: white;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" id="guardarModelo" class="btn btn-lg btn-success"><i class="bi bi-check2-square"></i></button>
                        <button type="button" class="btn btn-lg btn-primary" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection