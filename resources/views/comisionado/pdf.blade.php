<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Comisionado</title>
</head>

{{-- Estilo al PDF --}}
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
{{-- Estilo al PDF --}}

{{-- Index del PDF --}}
    <body>

            <div class="row">
                <img class="centro" src="../public/img/centro1.png" alt="" >
            </div>
        <!-- {{-- <img class="left" src="../public/img/yaracuy.png" alt=""> --}}
        <img src="../public/img/ce.png" alt=""> -->
        <h1>Listado de Comisionado</h1><br>
            <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;font-size:0.6rem !important">
            <thead class="header">
                <tr>
                    <th>Lista</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Municipio Asignado</th>
                  
                    
                </tr>
            </thead>
            <tbody>
            @foreach ($comisionados as $comisionado)
                <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $comisionado->cedula }}</td>
                <td>{{ $comisionado->nombres }}</td>
                <td>{{ $comisionado->apellidos }}</td>

                <td>
                @if ($comisionado->municipios->count())
                    {{ implode(', ', $comisionado->municipios->pluck('nom_municipio')->toArray()) }}
                @endif
                </td>
                  
                   
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