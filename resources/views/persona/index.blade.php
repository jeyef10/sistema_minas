@extends('layouts.index')

<title>@yield('title') Persona</title>

@section('css-datatable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@endsection

@section('content')

    <div class="container-fluid" style="margin-top: 11%">
        <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                
                
                <a href="{{ url('persona/pdf') }}" class="btn btn-sm btn-danger" target="_blank">
                {{ ('PDF') }}
                </a>
              
                
                <h2 style="color: black;">Persona</h2>
                
                @can('crear-persona')
                    <form action="{{ url('persona/create') }}" method="get">
                        <button type="submit" title="Desea Registar a la Persona" class="btn btn-sm btn-light"><i class="bi bi-person-plus-fill"></i></button>
                    </form>
                @endcan

            </div>
            <div class="">
                <table id="personas" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th  style="color: black;">Nombre</th>
                            <th  style="color: black;">Apellido</th>
                            <th  style="color: black;">Cédula</th>
                            <th  style="color: black;">Id.Usuario</th>
                            <th  style="color: black;">Cargo</th>
                            <th  style="color: black;">Teléfono</th>
                            <th style="color: black;">Sede</th>
                            <th style="color: black;">División</th>
                            <th class="col-2" style="color: black;"><center>Acciones</center></th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($personas as $persona)
                                <tr>
                                    <!-- <td style="color: black;">{{ $persona->id}}</td> -->
                                    <td style="color: black;">{{ $persona->nombre }}</td>
                                    <td style="color: black;">{{ $persona->apellido}}</td>
                                    <td style="color: black;">{{ $persona->cedula }}</td>
                                    <td style="color: black;">{{ $persona->id_usuario}}</td>
                                    <td style="color: black;">{{ $persona->cargo->nombre_cargo }}</td>
                                    <td style="color: black;">{{ $persona->telefono }}</td>
                                    <td style="color: black;">
                                        @foreach($persona->divisionesSedes as $divisionSede)
                                            {{ $loop->first ? '' : ', ' }}
                                            {{ $divisionSede->sede->nombre_sede }}
                                        @endforeach
                                    </td>
                                    <td style="color: black;">
                                        @foreach($persona->divisionesSedes as $divisionSede)
                                            {{ $loop->first ? '' : ', ' }}
                                            {{ $divisionSede->division->nombre_division }}
                                        @endforeach
                                    </td>

                                    <td> 
                                        @can('editar-persona')
                                            <a class="btn btn-warning" title="Desea Editar a la Persona" style="margin-left: 30%;" href="{{ url('/persona/'.$persona->id.'/edit') }}"><i class="bi bi-pencil-square"></i></a>
                                        @endcan

                                        @can('borrar-persona')
                                            <form action="{{ url('/persona/'.$persona->id) }}" method="POST" class="sweetalert" style="display: inline; ">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" title="Desea Eliminar a la Persona" type="submit" value=""><i class="bi bi-trash"></i></button>
                                            </form> 
                                        @endcan
                                    </td>
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('js-datatable')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
                
        <script>
            $(document).ready(function () {
                $('#personas').DataTable({
                    
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

@section('sweetalert')

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

@if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        Swal.fire({
                            title: 'Persona',
                            text: " No se puede eliminar la persona debido a que tiene un equipo y perifericos asignados.",
                            icon: 'warning',
                            showconfirmButton: true,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: '¡OK!',
                            
                            }).then((result) => {
                        if (result.isConfirmed) {

                            this.submit();
                        }
                        })
    </script>
@endif
    
@endsection