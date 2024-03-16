@extends('layouts.index')

<title>@yield('title') Editar División</title>


@section('content')

    <div class="container-fluid" style="margin-top: 11%">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-13">
            <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                    
                    <center>
                        <h3 class="mb-4" style="color: black;">Editar División</h3>
                    </center>
                    
                    <form method="post" action="{{ url('/division/'.$division->id )}}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH')}}
                        
                        <center>
                            <div class="col-3">
                                <label style="color: black;">Nombre de la División</label>
                                <input type="text" class="form-control" name="nombre_division" id="nombre_division" value="{{ isset($division->nombre_division)?$division->nombre_division:'' }}"onkeypress="return soloLetras(event);" style="background: white;">
                            </div>

                        </center>
                        
                        <br><br>
                        <center>
                        
                        <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                        <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('division/') }}"> Regresar </a>
                        </center>
                        
                    </form>
                </div>
            </div> 
        </div>
    </div>

@endsection