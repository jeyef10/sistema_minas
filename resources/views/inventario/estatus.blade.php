@extends('layouts.index')

<title>@yield('title') Inventario</title>

@section('css-datatable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@endsection

@section('content')

    <div class="container-fluid" style="margin-top: 10%">
        <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                
                <h2 style="color: black; margin-left: 38%;">Estatus de los Equipos</h2>
                
                {{-- @can('crear-cargo')
                    <form action="{{ url('asignar/create') }}" method="get">
                        <button type="submit" title="Desea Registrar" class="btn btn-sm btn-light"><i class="bi bi-box-arrow-right"></i></button>
                    </form>
                @endcan --}}

            </div>
            <div class="">
                <table id="asignar" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th  style="color: black;">Persona (Cédula)</th>
                            <th  style="color: black;">Persona (Nombre y Apellido)</th>
                            <th  style="color: black;">Equipo (CPU)</th>
                            <th  style="color: black;">Equipo (Serial)</th>
                            <th  style="color: black;">Equipo (SerialA)</th>
                            <th  style="color: black;">Equipo (S.O)</th>
                            <th  style="color: black;">(Periférico, Marca, Modelo, Serial SerialA)</th>
                            <th  style="color: black;">Estatus</th>
{{--                             <th class="col-2" style="color: black;"><center>Acciones</center></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                
                   @foreach ($asignacionesAgrupadas as $asignacionesGrupo)
                        <tr>
                            <td class="" style="color: black;">{{ $asignacionesGrupo->first()->persona->cedula }}</td>
                            <td class="" style="color: black;">{{ $asignacionesGrupo->first()->persona->nombre }} {{ $asignacionesGrupo->first()->persona->apellido }}</td> 
                            <td class="" style="color: black;">{{ $asignacionesGrupo->first()->equipo->cpu }}</td>
                            <td class="" style="color: black;">{{ $asignacionesGrupo->first()->equipo->serial }}</td>
                            <td class="" style="color: black;">{{ $asignacionesGrupo->first()->equipo->serialA }}</td>
                            <td class="" style="color: black;">{{ $asignacionesGrupo->first()->equipo->sistema->tipo }}</td>
                            <td class="" style="color: black;">{{ $asignacionesGrupo->first()->periferico->tipo_periferico->tipo }}, {{ $asignacionesGrupo->first()->periferico->marca->nombre_marca }}, {{ $asignacionesGrupo->first()->periferico->modelo->nombre_modelo }}, {{ $asignacionesGrupo->first()->periferico->serial }}, {{ $asignacionesGrupo->first()->periferico->serialA }}</td>
                            
                                 
                            <td class="" style="color: black;">{{ $asignacionesGrupo->first()->estatus }}</td>

                            {{-- <td>
                                <a class="btn btn-warning" title="Desea Editar" style="margin-left: 34%;" href="{{ url('/asignar/'.$asignacionesGrupo->first()->persona->id.'/edit') }}"><i class="bi bi-pencil-square"></i></a>
                                @can('')
                                    <form action="{{ url('/asignar/'.$asignacionesGrupo->first()->persona->id.'/desincorporar') }}" method="GET" class="" style="display:inline;">
                                         @csrf
{{--                                         
                                        <button class="btn btn-danger" title="Desea Desiconpoarar" type="submit" value=""><i class="bi bi-box-arrow-left"></i></button>
                                        <br>
                                        <button type="button" style="margin-left: 23%; margin-top:4%;" id='BtnSelector' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Ver Detalle
                                        </button>
                                   
                                    </form>
                                @endcan
                            </td> --}}
                        </tr> 
                     @endforeach

                    {{-- @foreach ($asignacionesAgrupadas as $asignacionesGrupo)
                            <tr>
                                <td class="" style="color: black;">{{ $asignacionesGrupo->first()->persona->cedula }}</td>
                                <td class="" style="color: black;">{{ $asignacionesGrupo->first()->persona->nombre }}</td>
                                <td class="" style="color: black;">{{ $asignacionesGrupo->first()->persona->apellido }}</td>
                                <td class="" style="color: black;">{{ $asignacionesGrupo->first()->equipo->cpu }}</td>
                                <td class="" style="color: black;">{{ $asignacionesGrupo->first()->equipo->serial }}</td>
                                <td class="" style="color: black;">{{ $asignacionesGrupo->first()->equipo->serialA }}</td>
                                <td class="" style="color: black;">{{ $asignacionesGrupo->first()->equipo->sistema->tipo }}</td>

                                <td class="" style="color: black;">
                                    @foreach ($asignacionesGrupo as $asignacion)
                                        {{ $asignacion->periferico->tipo_periferico->tipo }}<br>
                                    @endforeach
                                </td>
                                <td class="" style="color: black;">
                                    @foreach ($asignacionesGrupo as $asignacion)
                                        {{ $asignacion->periferico->marca->nombre_marca }}<br>
                                    @endforeach
                                </td>
                                <td class="" style="color: black;">
                                    @foreach ($asignacionesGrupo as $asignacion)
                                        {{ $asignacion->periferico->modelo->nombre_modelo }}<br>
                                    @endforeach
                                </td>
                                <td class="" style="color: black;">
                                    @foreach ($asignacionesGrupo as $asignacion)
                                        {{ $asignacion->periferico->serial }}<br>
                                    @endforeach
                                </td>
                                <td class="" style="color: black;">
                                    @foreach ($asignacionesGrupo as $asignacion)
                                        {{ $asignacion->periferico->serialA }}<br>
                                    @endforeach
                                </td> 

                                <td class="" style="color: black;">{{ $asignacionesGrupo->first()->estatus }}</td>

                                <td>
                                    <a class="btn btn-warning" style="margin-left: 30%;" href="{{ url('/asignar/'.$asignacionesGrupo->first()->persona->id.'/edit') }}"><i class="bi bi-pencil-square"></i></a>
                                    @can('borrar-cargo') 
                                         <form action="{{ url('/asignar/'.$asignacionesGrupo->first()->id) }}" method="POST" class="sweetalert" style="display:inline;">
                                            @csrf
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-danger" type="submit" value=""><i class="bi bi-trash"></i></button>

                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Ver Detalles
                                            </button>

                                            
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach --}}
                            

                    </tbody>
                </table>
            </div>
        </div>
    </div>
   <!-- Modal -->
   {{-- <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    
        <div class="modal-dialog">

            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel" style="color: black;">Datos de los Perifericos</h5>
                </div>

                    <div class="modal-body">
                        <label for="">Pereferico</label>:
                        <label for="" id='2'></label><br>
                        <label for="">Marca</label>:
                        <label for="" id='3'></label><br>
                        <label for="">Modelo</label>:
                        <label for="" id='4'></label><br>
                        <label for="">Serial</label>:
                        <label for="" id='5'></label><br>
                        <label for="">Serial</label>:
                        <label for="" id='6'></label>                                                    
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
                    </div>

            </div>

        </div>

    </div> --}}

      @section('js-datatable')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
                
        <script>
            $(document).ready(function () {
                $('#asignar').DataTable({
                    
                    responsive: true,
                    autoWidth: false,

                    "language": {       
                        "lengthMenu": "Mostrar " + 
                                        `<select class = 'form-select'>
                                            <option value = '5'>5</option>
                                            <option value = '10'>10</option>
                                            <option value = '15'>15</option>
                                            <option value = '25'>25</option>
                                            <option value = '50'>50</option>
                                            <option value = '100'>100</option>
                                            <option value = '-1'>Todos</option>
                                        </select>` +
                                        " Registros Por Página",
                        "infoEmpty": 'No Hay Registros Disponibles.',
                        "zeroRecords": 'Nada Encontrado Disculpa.',
                        "info": 'Mostrando La Página _PAGE_ de _PAGES_',
                        "infoFiltered": '(Filtrado de _MAX_ Registros Totales)',
                        "search": "Buscar: ",
                        "paginate": {
                            'next': 'Siguiente',
                            'previous': 'Anterior',
                        },
                        decimal: ',',
                        thousands: '.',
                    },
                });
            });
        </script>
    @endsection   

@endsection

{{-- @section('sweetalert')

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   

        @if (session('eliminar') == 'ok')

            <script>
                Swal.fire(
                '¡Eliminado!',
                'Se Eliminó Con Éxito.',
                'success'
                )
            </script>
            
        @endif

            <script>

                $('.sweetalert').submit(function(e){
                    e.preventDefault();

                            Swal.fire({
                            title: '¿Estás Seguro?',
                            text: "Al Hacer Estó Se Eliminará Definitivamente!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: '¡Si, Eliminar!',
                            cancelButtonText: 'Cancelar',
                            }).then((result) => {
                        if (result.isConfirmed) {

                            this.submit();
                        }
                        })
                });

            
            </script>

            <script>
                  $(document).ready(function(){  

$("#asignar").on('click', '#BtnSelector', function () {

     var currentRow = $(this).closest("tr");
     var $d = $(this).parent("td");
     var a = col1 = currentRow.find("td:eq(6)").text();
     var b = col1 = currentRow.find("td:eq(7)").text();
     var c = col1 = currentRow.find("td:eq(8)").text();
     var d = col1 = currentRow.find("td:eq(9)").text();
     var e = col1 = currentRow.find("td:eq(10)").text();
     var f = col1 = currentRow.find("td:eq(11)").text();
    
      
     $("#1").text(a); 
     $("#2").text(b);
     $("#3").text(c); 
     $("#4").text(d); 
     $("#5").text(e);
     $("#6").text(f);       
         

   });

});  
        </script>
    
@endsection --}}