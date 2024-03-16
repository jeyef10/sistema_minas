<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Persona</title>
</head>

{{-- Estilo al PDF --}}

<style>

body{
    margin: 0;
	padding: 0;
    background: url(../img/fondo_inces.jpg);
	background-size: cover;
	font-family: sans-serif;
    
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
    font-size: 15.2px;
    text-align: center;

}
tbody. tr. td{
    border: 2px solid black;
}

img {
  margin-left: 17.5%;
  width: 60%;
  height: 22%;
}

.left{
  width: 17%;
  height: 15%;
  margin-left: 1%;
  border-radius: 8% 
}

</style>
{{-- Estilo al PDF --}}

{{-- Index del PDF --}}
    <body>
        <img class="left" src="../public/img/logo_pdf.jpg" alt="">
        <br><br>
        <img src="../public/img/ce.png" alt="">
        <h1>Listado de la Persona</h1><br>
        <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.6rem;font-size:0.8rem !important">
            <thead class="header">
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Cédula</th>
                    <th>Id.Usuario</th>
                    <th>Cargo</th>
                    <th>Teléfono</th>
                    <th>Sede</th>
                    <th>División</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($personas as $persona)
                <tr>
                    <td>{{ $persona->nombre }}</td>
                    <td>{{ $persona->apellido}}</td>
                    <td>{{ $persona->cedula }}</td>
                    <td>{{ $persona->id_usuario}}</td>
                    <td>{{ $persona->cargo->nombre_cargo }}</td>
                    <td>{{ $persona->telefono }}</td>
                    <td>
                        @foreach($persona->divisionesSedes as $divisionSede)
                            {{ $loop->first ? '' : ', ' }}
                            {{ $divisionSede->sede->nombre_sede }}
                        @endforeach
                    </td>
                    <td>
                        @foreach($persona->divisionesSedes as $divisionSede)
                            {{ $loop->first ? '' : ', ' }}
                            {{ $divisionSede->division->nombre_division }}
                        @endforeach
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </body>
{{-- Index del PDF --}}

</html>