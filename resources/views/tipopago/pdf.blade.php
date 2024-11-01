<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Tipo de Pago</title>
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
    font-size: 25px;
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

</style>
{{-- Estilo al PDF --}}

{{-- Index del PDF --}}
    <body> 
        <div class="row">
            <!-- <img class= "left" src="../public/img/escu.png" alt="">
            <img class="right" src="../public/img/yara.png" alt="" > -->
            <img class="centro" src="../public/img/centro.png" alt="" >
        </div>
    
        
        <h1>Listado de Tipo de Pagos</h1><br>
            <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;font-size:0.6rem !important">
            <thead class="header">
                <tr>
                    <th>Lista</th>
                    <th>Nombre del Pago</th>
                    <th>Metódo de Pago</th>
                    
                </tr>
            </thead>
            <tbody>
            @foreach ($tipo_pagos as $tipo_pago)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $tipo_pago->nombre_pago}} </td>
                    <td>{{ $tipo_pago->forma_pago }}</td>
                   
                </tr>
        @endforeach
            </tbody>
        </table>
    </body>
{{-- Index del PDF --}}

</html>