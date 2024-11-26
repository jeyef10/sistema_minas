<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Planificación de Inspecciones</title>

{{-- Estilo al PDF --}}

<style>

body{
    margin: 0;
	padding: 0;
    background: url(../img/centro1.png);
	background-size: cover;
	font-family: sans-serif;
    font-size: 0.8rem;
    
}

.header{
    background-color: rgb(15, 15, 15);
    color: rgb(231, 227, 225);
}

h1{
    color: rgb(0, 0, 0);
    text-align: center;
    font-family: sans-serif;
}

.table{
    font-size: 20px;
    text-align: center;

}

tbody. tr. td{
    border: 2px solid ;
}

img {

    margin-left: 17.5%;
    width: 600px;
    height: 22px;
  
}

.centro{
    margin-left: 10.5%;
    width: 80%;
    height: 10%; 
  border-radius: 8% 
} 

.footer-image { 
    width: 76%; 
    height: auto; 
    position: absolute;
    bottom: 33px; 
    left: 19%; 
    transform: translateX(-29%); 
}

</style>
{{-- Estilo al PDF --}}

{{-- Index del PDF --}}
    <body> 
            <div class="row">
                <img class="centro" src="../public/img/centro1.png" alt="" >
            </div>
    
        
        <h1>Listado de Planificación de Inspecciones</h1><br>
            <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;font-size:0.6rem !important">
            <thead class="header">
                <tr>
                    <th class="font-weight-bold text-Secondary">Tipo de Solicitud</th>
                    <th class="font-weight-bold text-Secondary">Tipo de Solicitante</th>
                    <th class="font-weight-bold text-Secondary">Cédula/Rif</th>
                    <th class="font-weight-bold text-Secondary">Solicitante</th>
                    <th class="font-weight-bold text-Secondary">Municipio</th>
                    <th class="font-weight-bold text-Secondary">Fecha</th>
                </tr>
            </thead>
            <tbody>

                    @foreach ($recepciones as $recepcion)
                                <tr>
                                        
                                        {{-- <td class="font-weight-bold text-Secondary">{{ $recepcion->id}}</td> --}}

                                        <td class="font-weight-bold text-Secondary">{{ $recepcion->categoria }}</td>

                                            <!-- Muestra el tipo de solicitante (Natural o Jurídico) -->
                                            <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->tipo }}</td>

                                            <!-- Verifica si el solicitante es una Persona Natural -->
                                            @if ($recepcion->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaNatural)
                                                <!-- Si es una Persona Natural, muestra la cédula, el nombre y el apellido -->
                                                <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->solicitanteEspecifico->cedula }}</td>
                                                <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $recepcion->solicitante->solicitanteEspecifico->apellido }}</td>

                                            <!-- Verifica si el solicitante es una Persona Jurídica -->
                                            @elseif ($recepcion->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaJuridica)
                                                <!-- Si es una Persona Jurídica, muestra el rif, el nombre y el correo -->
                                                <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->solicitanteEspecifico->rif }}</td>
                                                <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->solicitanteEspecifico->nombre }}</td>
                                            @endif

                                                <td class="font-weight-bold text-Secondary">
                                                    @if ($recepcion->municipio)
                                                        {{$recepcion->municipio->nom_municipio }} @else
                                                    @endif
                                                </td>

                                                <td class="font-weight-bold text-Secondary">{{ $recepcion->fecha }}</td> 
                                                
                                                @if (!$recepcion->yaPlanificada)
                                                    <a class="btn btn-danger btn-sm" title="Planificar" href="{{ route('planificacion.create', ['id' => $recepcion->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/></svg>
                                                    </a>
                                                @endif

                                </tr>   
                    @endforeach            
            </tbody>
        </table>

        <div class="row">
            <img class="footer-image"  src="../public/img/piepagina.png" alt="Pie de Página">
        </div>

    </body>
{{-- Index del PDF --}}
</html>

