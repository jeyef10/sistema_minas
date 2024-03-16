@extends('layouts.index')

<title>@yield('title') Editar Cargo</title>


@section('content')

    <div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
                <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Editar Cargo</h3>
                    </center>
                    
                    <form method="post" action="{{ url('/cargo/'.$cargo->id )}}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH')}}
                        <div class="row">

                        <center>
                            <div class="col-3">
                                <label style="color: black;">Nombre del Cargo</label>
                                <input type="text" class="form-control" name="nombre_cargo" id="nombre_cargo" value="{{ isset($cargo->nombre_cargo)?$cargo->nombre_cargo:'' }}" style="background: white;">
                            </div>
                        </center>

                        </div>

                        <br><br>
                        
                        <center>
                        
                        <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                        <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('cargo/') }}"> Regresar </a>
                        </center>
                        
                    </form>
                </div>
            </div> 
        </div>
    </div>

@endsection