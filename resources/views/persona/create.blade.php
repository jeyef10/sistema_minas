@extends('layouts.index')

<title>@yield('title') Registrar Persona</title>

<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

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
                        <h3 class="mb-4" style="color: black;">Crear Persona</h3>
                    </center>

                    <form method="post" action="{{ url('/persona') }}" enctype="multipart/form-data" id="formulario_persona" onsubmit="return persona(this)">
                    
                        @csrf
                        <div class="row">

                            <div class="col-3">
                                <label style="color: black;">Nombre de la Persona</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="{{  isset($persona->nombre)?$persona->nombre:'' }}" onkeypress="return soloLetras(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label style="color: black;">Apellido de la Persona</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" value="{{ isset($persona->apellido)?$persona->apellido:'' }}" onkeypress="return soloLetras(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label style="color: black;">Cédula de la Persona</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" value="{{ isset($persona->cedula)?$persona->cedula:'' }}" onkeypress="return solonum(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label style="color: black;">Id.Usuario de la Persona</label>
                                <input type="text" class="form-control" name="id_usuario" id="id_usuario" value="{{ isset($persona->id_usuario)?$persona->id_usuario:'' }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label for="cargo" style="color: black;">Cargo de la Persona</label>
                                <select class="form-select" id="cargo" required name="id_cargo">
                                    <option value="">Seleccione un cargo</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id }}">{{ $cargo->nombre_cargo }}</option>
                                    @endforeach
                                </select>                            
                            </div>
                            <div class="col-3">
                                <label style="color: black;">Teléfono de la Persona</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" value="{{ isset($persona->telefono)?$persona->telefono:'' }}" onkeypress="return solonum(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                    <label for="sede" style="color: black;">Sede</label>
                                    <select class="form-select" id="id_sede" name="id_sede" required onchange="fetchDivisiones(this)">
                                        <option value="">Seleccione una sede</option>
                                        @foreach ($sedes as $sede)
                                            <option value="{{ $sede->id }}" data-url="{{ route('divisiones.by.sede', $sede->id) }}">{{ $sede->nombre_sede }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-3">
                                    <label for="division" style="color: black;">División de la Persona</label>
                                    <select class="form-select" id="id_division" required name="id_division">
                                        <option value="">Seleccione una división</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" id="id_division_sede" name="id_division_sede" value="">
  
                        <br>
                        <center>
                            <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                            <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('persona/') }}"> Regresar </a>
                        </center>
                    </form>
                    <script>
                        function fetchDivisiones(selectElement) {
                        var sedeId = selectElement.value;
                        var url = selectElement.options[selectElement.selectedIndex].getAttribute('data-url');
                        var divisionSedeId = selectElement.options[selectElement.selectedIndex].getAttribute('data-division-sede-id');

                        if (sedeId === '0') {
                            // Si no se ha seleccionado ninguna sede, se vacía el select de divisiones
                            var divisionSelect = document.getElementById('id_division');
                            divisionSelect.innerHTML = '<option value="0">Seleccione una división</option>';
                            document.getElementById('id_division_sede').value = ""; // Actualizamos el valor del campo oculto a vacío
                            return;
                        }

                        var divisionSelect = document.getElementById('id_division');
                        divisionSelect.innerHTML = '<option value="0">Cargando divisiones...</option>';

                        // Actualizamos el valor del campo oculto con el id de la relación division_sede seleccionada
                        document.getElementById('id_division_sede').value = divisionSedeId;

                        // Realizar una petición AJAX utilizando XMLHttpRequest
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', url, true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4) {
                            if (xhr.status === 200) {
                                var divisiones = JSON.parse(xhr.responseText);

                                // Limpiar el select de divisiones
                                divisionSelect.innerHTML = '';

                                // Agregar las opciones al select de divisiones
                                for (var divisionId in divisiones) {
                                var divisionNombre = divisiones[divisionId];
                                var option = new Option(divisionNombre, divisionId);
                                divisionSelect.add(option);
                                }
                            } else {
                                divisionSelect.innerHTML = '<option value="0">Error al cargar las divisiones</option>';
                            }
                            }
                        };
                        xhr.send();
                        }

                        function setDivisionId() {
                        var divisionSelect = document.getElementById('id_division');
                        var selectedOption = divisionSelect.options[divisionSelect.selectedIndex];
                        var divisionSedeId = selectedOption.getAttribute('data-division-sede-id');
                        document.getElementById('id_division_sede').value = divisionSedeId;
                        }

                        // Escuchar el evento de enviar el formulario
                        document.getElementById('formulario_persona').addEventListener('submit', function(event) {
                        // Antes de enviar el formulario, establecer el ID de la división seleccionada
                        setDivisionId();
                        });

                    </script>


                </div>
            </div> 
        </div>
    </div>

@endsection