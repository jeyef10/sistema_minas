@extends('layouts.index')

<title>@yield('title') Inventario</title>

@section('css-datatable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@endsection

@section('content')

    <div class="container-fluid" style="margin-top: 11%">
        <div class="p-3" style="background:rgb(255, 253, 253); border-radius: 20px;">
            <div class="d-flex align-items-center justify-content-between mb-2">

                <h2 style="color: black; margin-left:40%;">Inventario de Equipos</h2>
                
                {{-- @can('crear-equipo')
                    <form action="{{ url('equipo/create') }}" method="get">
                        <button type="submit" title="Desea Registar un nuevo Equipo" class="btn btn-sm btn-light"><i class="bi bi-person-plus-fill"></i></button>
                    </form>
                @endcan --}}

                <form action="{{ url('inventario/estatus') }}" method="get">
                    <button type="submit" class="btn btn-sm btn-light">Estatus</button>
                </form>

            </div>
            <div class="">
                <table id="equipos" class="table text-start align-middle table-bordered table-hover mb-0">
                    <thead>
                        <tr class="text-white">
                            <th  style="color: black;">Marca</th>
                            <th  style="color: black;">Modelo</th>
                            <th  style="color: black;">Serial</th>
                            <th  style="color: black;">Serial Activo</th>
                            <th  style="color: black;">Modelo del CPU</th>
                            <th  style="color: black;">Velocidad del CPU(Mhz)</th>
                            <th  style="color: black;">Memoria Ram(Gb)</th>
                            <th  style="color: black;">Disco Duro(Gb)</th>
                            <th  style="color: black;">Tipo S.O.</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($equipos as $equipo)
                                <tr>
                                    <!-- <td style="color: black;">{{ $equipo->id}}</td> -->
                                    <td style="color: black;">{{ $equipo->marca->nombre_marca }}</td>
                                    <td style="color: black;">{{ $equipo->modelo->nombre_modelo }}</td>
                                    <td style="color: black;">{{ $equipo->serial}}</td>
                                    <td style="color: black;">{{ $equipo->serialA }}</td>
                                    <td style="color: black;">{{ $equipo->cpu}}</td>
                                    <td style="color: black;">{{ $equipo->velocidad }}</td>
                                    <td style="color: black;">{{ $equipo->ram}}</td>
                                    <td style="color: black;">{{ $equipo->disco}}</td>
                                    <td style="color: black;">{{ $equipo->sistema->nombre}}</td>

                                    {{-- <td> 
                                        @can('editar-equipo')
                                            <a class="btn btn-warning" title="Desea Editar el Equipo" style="margin-left: 15%;" href="{{ url('/equipo/'.$equipo->id.'/edit') }}"><i class="bi bi-pencil-square"></i></a>
                                        @endcan
                                        
                                        @can('borrar-equipo')
                                            <form action="{{ url('/equipo/'.$equipo->id) }}" method="POST" class="sweetalert" style="display: inline; ">
                                                @csrf
                                                {{ method_field('DELETE') }}
                                                <button class="btn btn-danger" title="Desea Eliminar el Equipo" type="submit" value=""><i class="bi bi-trash"></i></button>
                                            </form>
                                        @endcan 
                                    </td> --}}
                                </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        alert(errorMessage);
    </script>
@endif      
    @section('js-datatable')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
                
        <script>
            $(document).ready(function () {
                $('#equipos').DataTable({
                    
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
    
@endsection