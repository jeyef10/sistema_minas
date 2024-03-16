@extends('layouts.index')

<title>@yield('title') Editar Persona</title>


@section('content')

    {{-- @if ($errors->any())
    <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
    @endif --}}

    <div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
            <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Editar Persona</h3>
                    </center>
                    
                    <form method="post" action="{{ url('/persona/'.$persona->id )}}" enctype="multipart/form-data" onsubmit="return Persona(this)">

                        @csrf
                        {{ method_field('PATCH')}}
                        <div class="row">
                            <div class="col-3">
                                <label style="color: black;">Nombre de la Persona</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ $persona->nombre }}" onkeypress="return soloLetras(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label style="color: black;">Apellido de la Persona</label>
                                <input type="text" class="form-control" name="apellido" id="apellido" value="{{ $persona->apellido }}" onkeypress="return soloLetras(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label style="color: black;">Cédula de la Persona</label>
                                <input type="text" class="form-control" name="cedula" id="cedula" value="{{ $persona->cedula }}" onkeypress="return solonum(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label style="color: black;">Id.Usuario de la Persona</label>
                                <input type="text" class="form-control" name="id_usuario" id="id_usuario" value="{{ $persona->id_usuario }}" onkeypress="return sinespacios(event);" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label for="cargo" style="color: black;">Cargo de la Persona</label>
                                <select class="form-select" id="cargo" name="id_cargo">
                                    <option value="0">Seleccione un cargo</option>
                                    @foreach($cargos as $cargo)
                                        <option value="{{ $cargo->id }}" {{ $cargo->id == $persona->id_cargo ? 'selected' : '' }}>{{ $cargo->nombre_cargo }}</option>
                                    @endforeach
                                </select>
                                
                            </div>
                            <div class="col-3">
                                <label style="color: black;">Teléfono de la Persona</label>
                                <input type="text" class="form-control" name="telefono" id="telefono" value="{{ $persona->telefono }}" style="background: white;">
                            </div>
                            <div class="col-3">
                                <label for="sede" style="color: black;">Sede</label>
                                <select class="form-select" id="id_sede" name="id_sede" onchange="fetchDivisiones(this)">
                                <option value="0">Seleccione una sede</option>
                                    @foreach ($sedes as $sede)
                                        <option value="{{ $sede->id }}" data-url="{{ route('divisiones.by.sede', $sede->id) }}" {{ $sede->id === $id_sede ? 'selected' : '' }}>{{ $sede->nombre_sede }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                            <label for="division" style="color: black;">División de la Persona</label>
                            <select class="form-select" id="id_division" name="id_division">
                            @foreach ($divisiones as $id => $nombre_division)
                                <option value="{{ $id }}" {{ $id == $id_division_sede ? 'selected' : '' }}>{{ $nombre_division }}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        <input type="hidden" id="id_division_sede" name="id_division_sede" value="{{ $id_division_sede }}">

                        <br>
                        <center>
                            <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                            <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('persona/') }}"> Regresar </a>
                        </center>
                    </form>

                    <script>
<<<<<<< HEAD
    function fetchDivisiones(selectElement) {
        var url = selectElement.options[selectElement.selectedIndex].dataset.url;

        fetch(url)
            .then(function(response) {
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }
                return response.json();
            })
            .then(function(data) {
                var divisionSelect = document.getElementById('id_division');
                divisionSelect.innerHTML = '';
                for (var divisionSedeId in data) {
                    var divisionNombre = data[divisionSedeId];
                    var option = new Option(divisionNombre, divisionSedeId);
                    divisionSelect.add(option);
                }
                
                // Seleccionar la opción que corresponde a la división actual de la persona
                var idDivisionSedeActual = document.getElementById('id_division_sede').value;
divisionSelect.value = idDivisionSedeActual;

                setDivisionSedeId();
            })
            .catch(function(error) {
                console.log(error);
                divisionSelect.innerHTML = '<option value="0">Error al cargar las divisiones</option>';
            });
    }
    
    function setDivisionSedeId() {
        var divisionSelect = document.getElementById('id_division');
        var selectedOption = divisionSelect.options[divisionSelect.selectedIndex];
        var nuevoIdDivisionSede = selectedOption.value;
        document.getElementById('id_division_sede').value = nuevoIdDivisionSede;
    }

    document.addEventListener('DOMContentLoaded', function(event) {
        var selectElement = document.getElementById('id_sede');
        fetchDivisiones(selectElement);
    });

    // Escuchar el evento de cambio de sede
    document.getElementById('id_sede').addEventListener('change', function(event) {
        fetchDivisiones(this);
    });

    // Escuchar el evento de cambio de división
    document.getElementById('id_division').addEventListener('change', setDivisionSedeId);
    console.log('ID division_sede actual:', idDivisionSedeActual);
console.log('Opciones de select de divisiones:', divisionSelect.options);

</script>
=======
                        function fetchDivisiones(selectElement) {
                            var url = selectElement.options[selectElement.selectedIndex].dataset.url;
>>>>>>> e94c959b7e948d08d355251c75cba422ae15928d

                            fetch(url)
                                .then(function(response) {
                                    if (!response.ok) {
                                        throw new Error('Error en la solicitud');
                                    }
                                    return response.json();
                                })
                                .then(function(data) {
                                    var divisionSelect = document.getElementById('id_division');
                                    divisionSelect.innerHTML = '';
                                    for (var divisionSedeId in data) {
                                        var divisionNombre = data[divisionSedeId];
                                        var option = new Option(divisionNombre, divisionSedeId);
                                        divisionSelect.add(option);
                                    }
                                    
                                    // Seleccionar la opción que corresponde a la división actual de la persona
                                    var idDivisionSedeActual = document.getElementById('id_division_sede').value;
                    divisionSelect.value = idDivisionSedeActual;

                                    setDivisionSedeId();
                                })
                                .catch(function(error) {
                                    console.log(error);
                                    divisionSelect.innerHTML = '<option value="0">Error al cargar las divisiones</option>';
                                });
                        }
                        
                        function setDivisionSedeId() {
                            var divisionSelect = document.getElementById('id_division');
                            var selectedOption = divisionSelect.options[divisionSelect.selectedIndex];
                            var nuevoIdDivisionSede = selectedOption.value;
                            document.getElementById('id_division_sede').value = nuevoIdDivisionSede;
                        }

                        document.addEventListener('DOMContentLoaded', function(event) {
                            var selectElement = document.getElementById('id_sede');
                            fetchDivisiones(selectElement);
                        });

                        // Escuchar el evento de cambio de sede
                        document.getElementById('id_sede').addEventListener('change', function(event) {
                            fetchDivisiones(this);
                        });

                        // Escuchar el evento de cambio de división
                        document.getElementById('id_division').addEventListener('change', setDivisionSedeId);
                        console.log('ID division_sede actual:', idDivisionSedeActual);
                    console.log('Opciones de select de divisiones:', divisionSelect.options);

<<<<<<< HEAD

=======
                    </script>
>>>>>>> e94c959b7e948d08d355251c75cba422ae15928d
                </div>
            </div> 
        </div>
    </div>

    @if ($errors->any())
    <script>
        var errorMessageEdit = @json($errors->first());
        Swal.fire({
                            title: 'Persona',
                            text: " No se puede registar la cédula debido que ya pertence a otra persona.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '¡Si, Eliminar!',
                            cancelButtonText: 'Cancelar',
                            }).then((result) => {
                        if (result.isConfirmed) {

                            this.submit();
                        }
                        })
    </script>
    @endif 
    
@endsection