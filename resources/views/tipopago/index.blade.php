@extends('layouts.index')

<title>@yield('title') Tipo Pago</title>

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

                        <a href="{{ url('tipopago/pdf') }}" class="btn btn-sm btn-danger" target="_blank" id="pdfButton"> 
                        {{ ('PDF') }}
                        </a>

                        <h2 class="font-weight-bold text-primary" style="margin-left: 6%;">Gestión de Tipo de Pago</h2>
                            @can('crear-tipopago')
                                <form action="{{ route('tipopago.create') }}" method="get" style="display:inline;">
                                    <button type="submit" class="btn btn-primary btn-mb"> <span class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </span>
                                    <span class="text">Crear</span></button>
                                </form>
                            @endcan
                    </div>

                    <div class="table-responsive p-3">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    {{-- <th class="font-weight-bold text-Secondary">Nº</th> --}}
                                    <!-- <th class="font-weight-bold text-Secondary">Nombre del Pago</th> -->
                                    <th class="font-weight-bold text-Secondary">Método de Pago</th>
                                    <th class="font-weight-bold text-Secondary"><center>Acciones</center> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tipo_pagos as $tipo_pago)
                                    <tr>
                                        {{-- <td class="font-weight-bold text-Secondary">{{ $tipo_pago->id}}</td>  --}}
                                        <!-- <td class="font-weight-bold text-Secondary">{{ $tipo_pago->nombre_pago}}</td> -->
                                        <td class="font-weight-bold text-Secondary">{{ $tipo_pago->forma_pago }}</td>
                                       
                                        <td>

                                            <div style="display: flex; justify-content: center;">
                                                @can('editar-tipopago')
                                                    <a class="btn btn-warning btn-sm" href="{{ route('tipopago.edit',$tipo_pago->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                    </svg></a>
                                                @endcan

                                                @can('borrar-tipopago')
                                                    <form action="{{ route('tipopago.destroy', $tipo_pago->id) }}" method="POST" class="sweetalert" style="margin: 0 3px;">
                                                        @csrf
                                                        {{ method_field('DELETE') }}
                                                        <button class="btn btn-danger btn-sm" type="submit" value=""><i class="fas fa-trash"></i></button>
                                                    </form> 
                                                @endcan
                                            </div>
                                            
                                        </td>
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

                <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
                <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

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
                                var pdfUrl = `{{ url('tipopago/pdf') }}?search=${encodeURIComponent(searchTerm)}`;
                                $('#pdfButton').attr('href', pdfUrl);
                            }

                            table.on('search.dt', function () {
                                var searchTerm = table.search();
                                $.ajax({
                                    url: '{{ url('tipopago/pdf') }}',
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
                var errors = @json($errors->all());
                errors.forEach(function(error) {
                    Swal.fire({
                        title: 'Tipo de Pago',
                        text: error,
                        icon: 'warning',
                        showConfirmButton: true,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: '¡OK!',
                    });
                });
            </script>
            @endif
    
@endsection

