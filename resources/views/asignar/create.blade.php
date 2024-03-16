@extends('layouts.index')

<title>@yield('title') Asignar Équipos</title>
<script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>

@section('content')

    <div class="container-fluid" style="margin-top: 12%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
                <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">

                    <center>
                        <h3 class="mb-4" style="color: black;">Asignación</h3>
                    </center>

                    <form method="post" action="{{ url('/asignar') }}" enctype="multipart/form-data" onsubmit="">
                        @csrf
                        <div class="row">
                            <div class="col-3">
                                <label for="persona" style="color: black;">Persona</label>
                                <select class="form-select" id="persona" name="id_persona">
                                    <option value="0">Seleccione una Persona</option>
                                    @foreach($personas as $persona)
                                        <option value="{{ $persona->id }}">{{ $persona->nombre }}  {{ $persona->apellido }} - {{ $persona->cedula }}</option>
                                    @endforeach
                                </select>
                            </div>     

                                <div class="col-2">
                                    <div id="datosPersona">                       
                                    <label for="id_cargo" style="color: black;">Cargo</label>
                                    <input class="form-control" style="background: white;" type="text" id="id_cargo" name="id_cargo" disabled>
                                    </div>
                                </div>

                                <div class="col-2">
                                    <label for="telefono" style="color: black;">Telefono</label>
                                    <input class="form-control" style="background: white;" type="text" id="telefono" name="telefono" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="sede" style="color: black;">Sede</label>
                                    <input class="form-control" style="background: white;" type="text" id="sede" name="sede" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="division" style="color: black;">División</label>
                                    <input class="form-control" style="background: white;" type="text" id="division" name="division" disabled>
                                </div>

                                                    
                                <div class="col-3">
                                    <label for="equipo" style="color: black;">Equipo</label>
                                    <select class="form-select" id="equipo" name="id_equipo">
                                        <option value="0">Seleccione un Equipo</option>
                                        @foreach($equipos as $equipo)
                                            <option value="{{ $equipo->id }}">{{ $equipo->marca->nombre_marca }} {{ $equipo->modelo->nombre_modelo }}</option>
                                        @endforeach
                                    </select>
                                </div> 

                                <div class="col-2">
                                    <div id="datosEquipo">      
                                        <label for="serial" style="color: black;">Serial</label>
                                        <input class="form-control" style="background: white;" type="text" id="serial" name="serial" disabled>
                                    </div>
                                </div>
                                
                                <div class="col-2">
                                    <label for="serialA" style="color: black;">Serial Activo</label>
                                    <input class="form-control" style="background: white;" type="text" id="serialA" name="serialA" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="cpu" style="color: black;">Modelo del CPU</label>
                                    <input class="form-control" style="background: white;" type="text" id="cpu" name="cpu" disabled>
                                </div>

                                <div class="col-2">
                                    <label for="velocidad" style="color: black;">Velocidad del CPU</label>
                                    <input class="form-control" style="background: white;" type="text" id="velocidad" name="velocidad" disabled>
                                </div>

                                <div class="col-2">
                                    <label style="color: black;">Memoria Ram (GB)</label>
                                    <input type="text" class="form-control" name="ram" id="ram" style="background: white;" disabled>
                                </div>

                                <div class="col-2">
                                    <label style="color: black;">Disco Duro (GB)</label>
                                    <input type="text" class="form-control" name="disco" id="disco" style="background: white;" disabled>
                                </div>

                                <div class="col-2">
                                    <label style="color: black;">Sistema Operativo</label>
                                    <input type="text" class="form-control" name="id_so" id="id_so" style="background: white;" disabled>
                                </div>                              
                        
                    
                            <div class="col-3">
                                <label for="periferico" style="color: black;">Periféricos</label>
                                @foreach($tipo_perifericos as $tipo_periferico)
                                    <div>
                                        <input type="checkbox" class="form-check-input" id="periferico-{{ $tipo_periferico->id }}" name="tipo_periferico[]" value="{{ $tipo_periferico->id }}" onchange="togglePeriferico({{ $tipo_periferico->id }})">
                                        <label for="periferico-{{ $tipo_periferico->id }}">{{ $tipo_periferico->tipo }}</label>
                                        <select class="form-select periferico-select" id="select-periferico-{{ $tipo_periferico->id }}" name="id_periferico[]" style="display: none;">
                                            <option value="0">Seleccione un {{ $tipo_periferico->tipo }}</option>
                                            @foreach($perifericos as $periferico)
                                                @if ($periferico->id_tipo == $tipo_periferico->id)
                                                    <option value="{{ $periferico->id }}">{{ $periferico->marca->nombre_marca }} {{ $periferico->modelo->nombre_modelo }} {{ $periferico->serial }} {{ $periferico->serialA }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                @endforeach
                            </div> 

                            {{-- <div class="col-3">
                                <label for="" style="color: black;">Estatus</label>
                                <div class="form-check">
                                    <label class="form-check-label" style="color: black;" for="asignado">Asignado</label>
                                    <input class="form-check-input" style="border-color: black;" type="radio" name="estatus" id="asignado" value="Asignado" checked>
                                </div>

                                <div class="form-check">
                                    <label class="form-check-label" style="color: black;" for="desincorporado">Desincorporado</label>
                                    <input class="form-check-input" style="border-color: black;" type="radio" name="estatus" id="desincorporado" value="Desincorporado" disabled>
                                </div>
                            </div>   --}}

                            <div class="col-3" style="display:none;">
                                <label style="color: black;">Estatus</label>
                                <input type="text" class="form-control" name="estatus" id="" value="Asignado" onkeypress="return soloLetras(event);" style="background: white;">
                            </div> 

                        </div>

                        <br>
                        <center>
                        
                        <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                        <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('asignar/') }}"> Regresar </a>
                        </center>
                        
                    </form>
                    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

                    <script>
                        function togglePeriferico(id) {
                            var checkbox = document.getElementById('periferico-' + id);
                            var select = document.getElementById('select-periferico-' + id);
                            if (checkbox.checked) {
                                select.style.display = 'block';
                            } else {
                                select.style.display = 'none';
                                select.value = '0';
                            }
                        }
                    </script>

                    <script>
                        $(document).ready(function(){
                            $('#persona').on('change', function(){
                                var persona_id = $(this).val();
                                if(persona_id){
                                    var data = {!! json_encode($personas->toArray()) !!};
                                    $.each(data, function(i, v){
                                        if(v.id == persona_id){
                                            $('#id_cargo').val(v.cargo.nombre_cargo);
                                            $('#telefono').val(v.telefono);
                                            $('#sede').val(v.divisiones_sedes[0].sede.nombre_sede);
                                            $('#division').val(v.divisiones_sedes[0].division.nombre_division);
                                        }
                                    })
                                    $('#datosPersona').show();
                                }else{
                                    $('#id_cargo').val('');
                                    $('#telefono').val('');
                                    $('#sede').val('');
                                    $('#division').val('');
                                    $('#datosPersona').hide();
                                }
                            });
                        });
                    </script>

                    <script>
                        $(document).ready(function(){
                            $('#equipo').on('change', function(){
                                var equipo_id = $(this).val();
                                if(equipo_id){
                                    var data = {!! json_encode($equipos->toArray()) !!};
                                    $.each(data, function(i, v){
                                        if(v.id == equipo_id){
                                            $('#serial').val(v.serial);
                                            $('#serialA').val(v.serialA);
                                            $('#cpu').val(v.cpu);
                                            $('#velocidad').val(v.velocidad);
                                            $('#ram').val(v.ram);
                                            $('#disco').val(v.disco);
                                            $('#id_so').val(v.sistema.nombre); // Aquí es donde se ha realizado el cambio
                                        }
                                    })
                                    $('#datosEquipo').show();
                                }else{
                                    $('#serial').val('');
                                    $('#serialA').val('');
                                    $('#cpu').val('');
                                    $('#velocidad').val('');
                                    $('#ram').val('');
                                    $('#disco').val('');
                                    $('#id_so').val('');
                                    $('#datosEquipo').hide();
                                }
                            });
                        });
                    </script>

                </div>
            </div> 
        </div>
    </div>
@endsection