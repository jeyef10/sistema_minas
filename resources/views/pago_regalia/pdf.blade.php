<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Licencia Resolucion 
        @if ($licencia->resolucion_apro)
            {{ $licencia->resolucion_apro }}
        @else
            {{ $licencia->resolucion_hpc }}
        @endif
    </title>
</head>

{{-- Estilo al PDF --}}
<style>

body{
    margin: 0 2.5rem 0 2.5rem;
	padding: 0;
    background: url(../img/centro.png);
	background-size: cover;
	font-family: sans-serif, Arial;
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

p{
    font-size: 0.95rem;
    margin: 0 0 20px 0;
    text-align: justify;
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
        <!-- {{-- <img class="left" src="../public/img/yaracuy.png" alt=""> --}}
        <img src="../public/img/ce.png" alt=""> -->
        <h2>RESOLUCIÓN 
            @if ($licencia->resolucion_apro)
            {{ $licencia->resolucion_apro }}
        @else
            {{ $licencia->resolucion_hpc }}
        @endif</h2>

        <h3>REGISTRO DE CATASTRO MINERO N° 
            @if ($licencia->catastro_la)
            {{ $licencia->catastro_la }}
        @else
            {{ $licencia->catastro_lp }}
        @endif</h3>

        <br>

        <h2 style="text-align: center;">LCDO. JOSÉ RAFAEL MORALES GUARECUCO SECRETARIO DE DESARROLLO ECONÓMICO DE LA GOBERNACION DEL ESTADO YARACUY </h2>

        <br>

        <p>De conformidad con lo dispuesto en los artículos 3, 4, 5, 6 y en uso de la atribución 
        conferida en numeral 8 del artículo 11 de la <b>Ley Sobre el Régimen, 
        Administración y Aprovechamiento de Minerales No Metálicos del Estado 
        Yaracuy, publicada en Gaceta Oficial del Estado Yaracuy N° 5.084 de fecha 09 
        de mayo del año 2023.</b></p>

        <h3 style="text-align: center; margin: 0 0 20px 0;"><b><u>CONSIDERANDO:</u></b></h3>

        <p>Por cuanto el ciudadano: <b>{{$licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre}} {{$licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido}}</b> titular de la cedula de 
            identidad V-27.699.752 ha cumplido con la Ocupación de Territorio, emanada de la 
            Dirección Región Yaracuy del Ministerio del Poder Popular para el Ecosocialismo, 
            Providencia Administrativa N° 2, de fecha Quince (15) de Septiembre del Dos 
            Mil Veintitrés (2023). </p>


        <div class="row">
            <img class="footer-image"  src="../public/img/piepagina.png" alt="Pie de Página">
        </div>
        
    </body>
{{-- Index del PDF --}}

</html>