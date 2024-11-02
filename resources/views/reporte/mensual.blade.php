@extends('layouts.index')

<title>@yield('title') Reporte</title>

@section('css-datatable')
        <link href="{{ asset ('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endsection

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h2 class="font-weight-bold text-primary">Reporte Mensual</h2>
                    </div>

<!--                 
                    <div class="card-body">

                        <div class="row d-flex align-items-end">

                            <div class=" col-2">
                                <label for="desde">Desde</label> 
                                <input type="date" id="desde" name="desde" value="{{ request('desde') }}" class="form-control "> 
                            </div>

                            <div class=" col-2">
                                <label for="hasta">Hasta</label> 
                                <input type="date" id="hasta" name="hasta" value="{{ request('hasta') }}" class="form-control"> 
                            </div>  

                            <div class="col-2 d-flex justify-content-start" style="margin-bottom: 4px; margin-left: -10px;"> 
                                <button type="submit" class="btn btn-primary">Filtrar</button>
                            </div>
                            
                        </div>
                     
                    </div> -->


                                    {{-- ? TABLA PARA TODOS LOS SOLICITANTES --}}

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-Secondary">Comisionado Asignado</th>
                                    <th class="font-weight-bold text-Secondary">Municipio</th>
                                    <th class="font-weight-bold text-Secondary">Fecha Inspeccion</th>
                                    <th class="font-weight-bold text-Secondary">Solicitante</th>
                                    <th class="font-weight-bold text-Secondary">Dirección</th>
                                    <th class="font-weight-bold text-Secondary">Vigencia de Licencia</th>
                                    </tr>
                            </thead>
                                <tbody>
                                <!--  -->
                             </tbody>
                        </table>
                    </div>
                </div>   
            </div>
        </div>
    </div>

@endsection 

@section('datatable')

        <script src="{{asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

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
    <script>
        $(document).ready(function () {
            $('#dataTable2').DataTable({
                
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

    <!-- <script>

        function filtrar(){
			let desde = $("#desde").val();
			let hasta = $("#hasta").val();
			location.href="./Beneficiarios_activos.php?desde="+desde+"&hasta="+hasta;
		}

    </script> -->
@endsection

