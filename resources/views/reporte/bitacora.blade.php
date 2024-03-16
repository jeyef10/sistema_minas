@extends('layouts.index')

<title>@yield('title') Bitacora</title>

@section('css-datatable')
        <link href="{{ asset ('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3">
                        <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Bitácora</h2>
                    </div>

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th  style="color: black;">id</th>
                                    <th  style="color: black;">Tabla Afectada</th>
                                    <th  style="color: black;">Operación</th>
                                    <th  style="color: black;">Fecha</th>
                                    <th  style="color: black;">Usuario BD</th>
                                    <th  style="color: black;">Usuario</th>
                                    <th  style="color: black;">Datos Nuevos</th>
                                    <th  style="color: black;">Datos Viejos</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bitacora as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="color: black;">{{ $item-> tablaafectada}}</td>
                                            <td style="color: black;">{{ $item-> operacion}}</td>
                                            <td style="color: black;">{{ $item-> fecha}}</td>
                                            <td style="color: black;">{{ $item-> usuario_bd}}</td>
                                            <td style="color: black;">{{ $item-> usuario}}</td>
                                            <td style="color: black;">{{ $item-> datos_nuevos}}</td>
                                            <td style="color: black;">{{ $item-> datos_viejos}}</td>
                                        </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> 

@endsection 

@section('datatable')

    <script src="{{ asset ('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset ('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset ('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                
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