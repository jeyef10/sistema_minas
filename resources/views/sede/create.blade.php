@extends('layouts.index')

<title>@yield('title') Registrar Sede</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>


@section('content')

<div class="container-fluid" style="margin-top: 11%">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-13">
        <div class="p-3" style="background:  rgb(255, 253, 253); border-radius: 20px;">
                
                <center>
                    <h3 class="mb-4" style="color: black;">Crear de Sede</h3>
                </center>
                
                <form method="post" action="{{ url('/sede') }}" onsubmit="return Sede(this)">
                    @csrf
                    <div class="row">

                        <div class="col-3">
                            <label style="color: black;">Lugar de la Sede</label>
                            <input type="text" class="form-control" name="nombre_sede" id="nombre_sede" value="{{ isset($sede->nombre_sede)?$sede->nombre_sede:'' }}" onkeypress="return soloLetras(event);" style="background: white;">
                        </div>

                        <!-- {{-- <div class="col-3">
                            <label for="division" style="color: black;">División de la Sede</label>
                            <select class="form-select" id="division" name="id_division">
                                <option value="0">Seleccione una División</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->nombre_division }}</option>
                                @endforeach
                            </select>                            
                        </div> --}} -->

                        <div class="col-3">
                            <label for="division" style="color: black;">División de la Sede</label>
                            <div class="form-check">
                                @foreach($divisions as $division)
                                    <input class="form-check-input" type="checkbox" name="divisiones[]" value="{{ $division->id }}">
                                    <label class="form-check-label">{{ $division->nombre_division }}</label>
                                    <br>
                                @endforeach
                            </div>                                 
                        </div>
                        
                    </div>

                    <br>
                    <center>
                    
                    <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                    <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('sede/') }}"> Regresar </a>
                    </center>
                    
                </form>
            </div>
        </div> 
    </div>
</div>
                                                

@endsection