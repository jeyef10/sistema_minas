<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Reporte</title>
</head>

{{-- Estilo al PDF --}}

<style>

body{
    margin: 0;
	padding: 0;
    background: url(../img/fondo_inces.jpg);
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
    /* width: 100%; */

}
tbody. tr. td{
    border: 2px solid black;
}

img {
  margin-left: 17.5%;
  width: 60%;
  height: 22%;
}

/* .left{
  width: 10%;
  height: 5%;
  margin-left: 1%;
  border: 2px solid black;
  border-radius: 8% 
} */

</style>
{{-- Estilo al PDF --}}

{{-- Index del PDF --}}
    <body>
        {{-- <img class="left" src="../public/img/yaracuy.png" alt=""> --}}
        <img src="../public/img/ce.png" alt="">
        <h1>Listado del Reporte</h1><br>
            <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.4rem;font-size:0.6rem !important">
            <thead class="header">
                <tr>
                    <th>N</th>
                    <th>Cédula</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Id.Usuario</th>
                    <th>División</th>
                    <th>Sede</th>
                    <th>Serial</th>
                    <th>Serial Activo</th>
                    <th>Estatus</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($resultados as $resultado)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $resultado->cedula }}</td>
                    <td>{{ $resultado->nombre }}</td>
                    <td>{{ $resultado->apellido }}</td>
                    <td>{{ $resultado->id_usuario }}</td>
                    <td>{{ $resultado->nombre_division }}</td>
                    <td>{{ $resultado->nombre_sede }}</td>
                    <td>{{ $resultado->serial }}</td>
                    <td>{{ $resultado->serialA }}</td>
                    <td>{{ $resultado->estatus }}</td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </body>
{{-- Index del PDF --}}

</html>