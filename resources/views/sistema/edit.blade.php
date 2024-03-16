@extends('layouts.index')

<title>@yield('title') Editar Sistemas Operativos</title>


@section('content')

            <div class="container-fluid" style="margin-top: 11%">
                <div class="row g-4">
                    <div class="col-sm-12 col-xl-13">
                    <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
                            <center>
                                <h3 class="mb-4" style="color: black;">Editar un Sistemas Operativos en los Equipos</h3>
                            </center>
                            
                            <form method="post" action="{{ url('/sistema/'.$sistema->id )}}" enctype="multipart/form-data" onsubmit="return usuario(this)">

                                 @csrf
                                 {{ method_field('PATCH')}}

                                <div class="row">

                                    <div class="form-check col-2">
                                        <label class="form-check-label" style="color: black; margin-top: 2.5px ;" for="softpriv">Software Privativo</label>
                                        <input class="form-check-input" style="border-color: black; margin-left: 60px; margin-top: 10px;" type="radio" name="tipo" id="softpriv" value="Privativo" {{ ($sistema->tipo=="Privativo")? "checked" : ""}}>
                                    </div>

                                    <div class="form-check col-2">
                                        <label class="form-check-label" style="color: black; margin-left: 22px ; margin-top: 2.5px ;" for="softlibr">Software Libre</label>
                                        <input class="form-check-input" style="border-color: black; margin-left: 70px; margin-top: 10px;" type="radio" name="tipo" id="softlibr" value="Libre" {{ ($sistema->tipo=="Libre")? "checked" : ""}}>
                                    </div>
    
                                    <div class="col-3">
                                        <label style="color: black;">Nombre del Sistema Operativo (S.O)</label>
                                        <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="{{ isset($sistema->nombre)?$sistema->nombre:'' }}" onkeypress="return sinespacios(event);">
                                    </div>

                                    <div class="col-3">
                                        <label style="color: black;">Versión del Sistema Operativo (S.O)</label>
                                        <input type="text" class="form-control" id="version" name="version" style="background: white;" value="{{ isset($sistema->version)?$sistema->version:'' }}">
                                    </div>
                                </div>

                                <br>
                                <center>
                        
                                <button type="submit" class="btn btn-primary" style="width: 10%; color: black; background: white;">Guardar</button>
                                <a class="btn btn-primary" style="width: 10%; color: black; background: white;" href="{{ url('sistema/') }}"> Regresar </a>
                                </center>
                                        
                            </form>
                        </div>
                    </div> 
                </div>
            </div>

@endsection