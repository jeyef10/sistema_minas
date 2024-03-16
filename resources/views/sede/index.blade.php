@extends('layouts.index')

<title>@yield('title') Sede</title>

@section('css-datatable')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.bootstrap5.min.css">
@endsection

@section('content')

<!-- Form Start -->

                    <!-- ? Tabla o formulario con sus respectivos campos -->

            <div class="container-fluid" style="margin-top: 11%">
                <div class="p-3" style="background:  rgb(255, 253, 253); border-radius: 20px;">
                    <div class="d-flex align-items-center justify-content-between mb-2">
            
                
               <a href="{{ url('sede/pdf') }}" class="btn btn-sm btn-danger" target="_blank">
                {{ ('PDF') }}
                </a>
                

                <h2 style="color: black;">Sede</h2>
                        
            @can('crear-sede')
                <form action="{{ url('sede/create') }}" method="get">
                    <button type="submit" title="Desea Registar una nueva Sede" class="btn btn-sm btn-light"><i class="bi bi-person-plus-fill"></i></button>
                </form>
            @endcan

        </div>
        <div class="">
            <table id="sedes" class="table text-start align-middle table-bordered table-hover mb-0">
                <thead>
                    <tr class="text-white">
                        <th style="color: black;">Lugar de la Sede</th>
                        <th style="color: black;">División</th>
                        <th class="col-2" style="color: black;"><center>Acciones</center></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sedes as $sede)
                        <tr>
                            <!-- <td style="color: black;">{{ $sede->id}}</td> -->
                            <td class="col-5" style="color: black;">{{ $sede->nombre_sede }}</td>
                            {{-- <td class="col-" style="color: black;">{{ $sede->division->nombre_division }}</td> --}}

                            <td>
                                @foreach ($sede->division as $index => $division)
                                    {{ $division->nombre_division }}
                                    @if ($index < count($sede->division) - 1)
                                    ,
                                    @endif
                                @endforeach
                            </td>
                            
                            <td> 
                                @can('editar-sede')
                                <a class="btn btn-warning" title="Desea Editar la Sede" style="margin-left: 30%;" href="{{ url('/sede/'.$sede->id.'/edit') }}"><i class="bi bi-pencil-square"></i></a>
                                @endcan

                                @can('borrar-sede')
                                    <form action="{{ url('/sede/'.$sede->id) }}" method="POST" class="sweetalert" style="display: inline; ">
                                        @csrf
                                        {{ method_field('DELETE') }}                                 
                                        <button class="btn btn-danger" title="Desea Eliminar la Sede" type="submit" value=""><i class="bi bi-trash"></i></button>
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
                                                
<!-- Form End -->

    @section('js-datatable')
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
                
        <script>
            $(document).ready(function () {
                $('#sedes').DataTable({
                    
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
                            title: 'Sede',
                            text: " No se puede eliminar la sede debido a que tiene divisiones asignadas.",
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