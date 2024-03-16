<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF División</title>
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

        <h1>Listado de la División</h1><br>
        <table class="table" cellpadding="1" cellspacing="1" width="100%" style="padding-bottom:0.6rem;font-size:0.8rem !important">
            <thead class="header">
                <tr>
                    <th>División</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($divisions as $division)
                    <tr>
                        <td>{{ $division->nombre_division }}</td>
                    </tr>
            @endforeach
            </tbody>
        </table>
    </body>
{{-- Index del PDF --}}

</html>