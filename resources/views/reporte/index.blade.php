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
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                        <a href="{{ url('reporte/pdf') }}" class="btn btn-sm btn-danger " target="_blank" id="pdfButton">
                            {{ ('PDF') }}
                         </a>
                            
                      <h2 class="font-weight-bold text-primary" style="margin-right: 35%;">Resumen Habilitado</h2>

                  </div>

                                    {{-- ? TABLA PARA TODOS LOS SOLICITANTES --}}

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-Secondary">Tipo de Licencia</th>
                                    <th class="font-weight-bold text-Secondary">Catastro Minero</th>
                                    <th class="font-weight-bold text-Secondary">Mineral</th>
                                    <th class="font-weight-bold text-Secondary">Solicitante Habilitado</th>
                                    <th class="font-weight-bold text-Secondary">Dirección</th>
                                    <th class="font-weight-bold text-Secondary">Vigencia de Licencia</th>
                                  </tr>
                            </thead>
                            <tbody>
    
                            @foreach($resultados as $resultado)
                                <tr>
                                    <td class="font-weight-bold text-secondary">
                                        @if ($resultado->resolucion_apro)
                                            {{ $resultado->resolucion_apro }}
                                        @else
                                            {{ $resultado->resolucion_hpc }}
                                        @endif
                                        {{ $resultado->categoria }}
                                    </td>

                                    <td class="font-weight-bold text-secondary">
                                        @if ($resultado->catastro_la)
                                            {{ $resultado->catastro_la }}
                                        @else
                                            {{ $resultado->catastro_lp }}
                                        @endif
                                    </td>

                                    <td class="font-weight-bold text-secondary">{{ $resultado->nombre_mineral }}</td>

                                    <td class="font-weight-bold text-secondary">

                                        @if($resultado->solicitante_tipo)
                                            {{ $resultado->solicitante_cedula }}
                                            {{ $resultado->solicitante_nombre_natural }}
                                            {{ $resultado->solicitante_apellido }}
                                        @endif

                                        @if($resultado->solicitante_tipo)
                                            {{ $resultado->solicitante_rif }}
                                            {{ $resultado->solicitante_nombre_juridico }}
                                        @endif
                                        
                                    </td>

                                    <td class="font-weight-bold text-secondary">{{ $resultado->direccion }}</td>
                                   
                                    <td class="font-weight-bold text-Secondary">{{ $resultado->plazo->medida_tiempo}} {{ $resultado->plazo->cantidad}}</td>
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

        <script src="{{asset('vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

        <script>
            $(document).ready(function () {
            var table = $('#dataTable').DataTable({
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar " +
                        `<select class='form-select'>
                            <option value='5'>5</option>
                            <option value='10'>10</option>
                            <option value='15'>15</option>
                            <option value='25'>25</option>
                            <option value='50'>50</option>
                            <option value='100'>100</option>
                            <option value='-1'>Todos</option>
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

            function updatePdfLink() {
                var searchTerm = table.search();
                var pdfUrl = `{{ url('reporte/pdf') }}?search=${encodeURIComponent(searchTerm)}`;
                $('#pdfButton').attr('href', pdfUrl);
            }

            table.on('search.dt', function () {
                var searchTerm = table.search();
                $.ajax({
                    url: '{{ url('recaudo/pdf') }}',
                    method: 'GET',
                    data: { search: searchTerm },
                    success: function(response) {
                        // Aquí puedes manejar la respuesta, si necesitas hacer algo con ella
                        console.log('PDF generado con éxito');
                    },
                    error: function(xhr) {
                        console.error('Error al generar el PDF:', xhr);
                    }
                });
                updatePdfLink();
            });

            updatePdfLink();
            });
    </script>


@endsection

