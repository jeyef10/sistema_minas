@extends('layouts.index')

<title>@yield('title')Desincorporar</title>

@section('css-datatable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
@endsection

@section('content')

    <div class="container-fluid" style="margin-top: 10%">
        <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
            <div class="d-flex align-items-center justify-content-between mb-2">

                <h2 style="color: black; margin-left:40%;">Equipos Desincorporados</h2>

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
                            <th class="col-2" style="color: black;"><center>Acciones</center></th>
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

                            <td>
                               
                                {{-- @can('')  --}}
                                    <form action="{{ url('/asignar/'.$asignacionesGrupo->first()->persona->id.'/desincorporar') }}" method="GET" class="" style="display:inline;">
                                        {{-- @csrf --}}
                                        
                                        <button class="btn btn-danger" title="Desea Desiconpoarar" type="submit" value="" style="margin-left: 34%;"><i class="bi bi-box-arrow-left"></i></button>
                                        <br>
                                        {{-- <button type="button" style="margin-left: 23%; margin-top:4%;" id='BtnSelector' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Ver Detalle
                                        </button>  --}}
                                   
                                    </form>
                               {{--  @endcan --}}
                            </td>
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

        <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
                
        <script>
            $(document).ready(function () {
                $('#asignar').DataTable({

                    dom: 'Bfrtip', // Para botones
                    buttons: [ 
                        { 
                            extend: 'pdfHtml5', 
                            orientation: 'landscape',
                            customize: function ( doc ) { 
                                doc.content.splice( 1, 0, 
                                    { 
                                        margin: [ 0, 0, 0, 12 ], 
                                        alignment: 'center', 
                                        image: "data:image/png;base64,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" 
                                    }
                                ); 
                            } 
                        },
                        {
                            extend: "excelHtml5"
                        }
                    ],
                    
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
