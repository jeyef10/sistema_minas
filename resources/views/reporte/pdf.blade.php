<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Reporte Habilitado</title>
</head>

<style>

body{
    margin: 0;
	padding: 0;
    background: url(../img/centro.png);
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
    font-size: 18px;
    text-align: center;

}

tbody. tr. td{
    border: 2px solid black;
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

<body> 

<div class="row">
    <img class="centro" src="../public/img/centro1.png" alt="" >
</div>


<h1>Resumen Habilitado</h1><br>
<table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;font-size:0.6rem !important">
<thead class="header">
    <tr>
    
        <th">Tipo de Licencia</th>
        <th">Catastro Minero</th>
        <th">Mineral</th>
        <th">Solicitante Habilitado</th>
        <th">Dirección</th>
        <th>Forma Pago</th>
        <th>Pago Realizado</th>
        <th>Resultado</th>
                                  
    </tr>
</thead>
<tbody>
       @foreach($resultados as $resultado)
            <tr>
                <td">
                    @if ($resultado->resolucion_apro)
                        {{ $resultado->resolucion_apro }}
                    @else
                        {{ $resultado->resolucion_hpc }}
                    @endif
                    {{ $resultado->categoria }}
                </td>

                <td">
                    @if ($resultado->catastro_la)
                        {{ $resultado->catastro_la }}
                    @else
                        {{ $resultado->catastro_lp }}
                    @endif
                </td>

                <td">{{ $resultado->nombre_mineral }}</td>

                <td">

                    @if($resultado->solicitante_tipo)
                        {{ $resultado->solicitante_cedula }}
                        {{ $resultado->solicitante_nombre_natural }}
                        {{ $resultado->solicitante_apellido }}
                    @endif

                    @if($resultado->solicitante_tipo)
                        {{ $resultado->solicitante_rif }}
                        {{ $resultado->solicitante_nombre_juridico }}
                    @endif
                    
                </td>

                <td">{{ $resultado->direccion }}</td>

                <td>
                    @if ($resultado->metodo_apro)
                        {{ $resultado->metodo_apro }}
                    @else
                        {{ $resultado->metodo_pro }}
                    @endif
                </td>

                <td>{{ $resultado->pago_realizar}}</td>

                <td>
                    @if ($resultado->resultado_apro)
                        {{ $resultado->resultado_apro }}
                    @else
                        {{ $resultado->resultado_pro }}
                    @endif
                </td>
                
                {{-- <td">{{ $resultado->plazo->medida_tiempo}} {{ $resultado->plazo->cantidad}}</td> --}}
            </tr>
        @endforeach
</tbody>
</table>

<div class="row">
<img class="footer-image"  src="../public/img/piepagina.png" alt="Pie de Página">
</div>
</body>
</html>


