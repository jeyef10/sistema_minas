@extends('layouts.index')

<title>@yield('title') Planificación</title>

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
                        <h2 class="font-weight-bold text-primary" style="margin-left: 33%;">Planificación de Inspecciones</h2>
                    </div>
                    <div class="card-body">

                        <div class="row">

                        </div>

                    </div>

                    <div class="table-responsive p-3" id="t_Aprovechamiento">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-Secondary">Tipo de Solicitud</th>
                                    <th class="font-weight-bold text-Secondary">Tipo de Solicitante</th>
                                    <th class="font-weight-bold text-Secondary">Cédula/Rif</th>
                                    <th class="font-weight-bold text-Secondary">Solicitante</th>
                                    <th class="font-weight-bold text-Secondary">Municipio</th>
                                    <th class="font-weight-bold text-Secondary">Fecha</th>
                                    <th class="font-weight-bold text-Secondary"><center>Acciones</center></th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($recepciones as $recepcion)
                                <tr>
                                   
                                    {{-- <td class="font-weight-bold text-Secondary">{{ $recepcion->id}}</td> --}}

                                    <td class="font-weight-bold text-Secondary">{{ $recepcion->categoria }}</td>

                                        <!-- Muestra el tipo de solicitante (Natural o Jurídico) -->
                                        <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->tipo }}</td>

                                        <!-- Verifica si el solicitante es una Persona Natural -->
                                        @if ($recepcion->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaNatural)
                                            <!-- Si es una Persona Natural, muestra la cédula, el nombre y el apellido -->
                                            <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->solicitanteEspecifico->cedula }}</td>
                                            <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $recepcion->solicitante->solicitanteEspecifico->apellido }}</td>

                                        <!-- Verifica si el solicitante es una Persona Jurídica -->
                                        @elseif ($recepcion->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaJuridica)
                                            <!-- Si es una Persona Jurídica, muestra el rif, el nombre y el correo -->
                                            <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->solicitanteEspecifico->rif }}</td>
                                            <td class="font-weight-bold text-Secondary">{{ $recepcion->solicitante->solicitanteEspecifico->nombre }}</td>
                                        @endif

                                            <td class="font-weight-bold text-Secondary">
                                                @if ($recepcion->municipio)
                                                    {{$recepcion->municipio->nom_municipio }} @else
                                                @endif
                                            </td>
  
                                            <td class="font-weight-bold text-Secondary">{{ $recepcion->fecha }}</td>   

                                        <td>

                                            <div style="display: flex; justify-content: center;">
                                               
                                                 
                                                @if (!$recepcion->yaPlanificada)
                                                    <a class="btn btn-danger btn-sm" title="Planificar" href="{{ route('planificacion.create', ['id' => $recepcion->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-checklist" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/>
                                                        <path d="M7 5.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 1 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0M7 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5m-1.496-.854a.5.5 0 0 1 0 .708l-1.5 1.5a.5.5 0 0 1-.708 0l-.5-.5a.5.5 0 0 1 .708-.708l.146.147 1.146-1.147a.5.5 0 0 1 .708 0"/></svg>
                                                    </a>
                                                @endif
                                                

                                                <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar la Solicitud" href="{{ route('recepcion.edit',$recepcion->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg></a>

                                                <a class="btn btn-info btn-sm" style="margin: 0 1px;" title="Ver Detalles" data-recepcion-id='{{ $recepcion->id }}' class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16"  style="color: #ffff; cursor: pointer;">
                                                    <path d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                                                    <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM2 1a1 1 0 0 0-1 1v1h14V2a1 1 0 0 0-1-1zM1 4v10a1 1 0 0 0 1 1h2V4zm4 0v11h9a1 1 0 0 0 1-1V4z"/>
                                                </svg></a>
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

    <!-- MODAL PARA VER DETALLES -->
    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body" id="modal-body-content">

                    {{-- ! DATOS CARGADOS POR JS/AJAX --}}
            
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-dismiss="modal"> Cerrar</button>
                </div>

            </div>
        </div>
    </div>

     {{-- ? FUNCIÓN PARA FILTRAR DATOS EN LA TABLA DE RECEPCIÓN --}}

    <script>
        $(document).ready(function() {
            var table = $('#example').DataTable();

            $('input[name="filter"]').change(function() {
                var filterValue = $(this).val();

                if (filterValue === 'todos') {
                    table.search('').draw();
                } else {
                    table.search(filterValue).draw();
                }
            });
        });
    </script>

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


        {{-- * FUNCIÓN PARA MOSTRAR DATOS DE LOS RECAUDOS, MINERAL Y DIRECCIÓN EN EL MODAL --}}

    <script>

        $(document).ready(function() {
            $('#t_Aprovechamiento').on('click', '.btn-info', function(event) {
                event.preventDefault();
                var recepcionId = $(this).data('recepcion-id'); // Obtén el ID de la recepción

                $.ajax({
                    url: '/planificacion/detalles/' + recepcionId,
                    type: 'GET',
                    success: function(data) {
                        let recaudosHtml = '<ul>';

                        if (data.recaudos && data.recaudos.length > 0) {
                            data.recaudos.forEach(function(recepcionRecaudo) {
                                if (recepcionRecaudo.recaudo) {
                                    recaudosHtml += `<li>${recepcionRecaudo.recaudo.nombre}</li>`;
                                } else {
                                    recaudosHtml += `<li>No hay información de recaudo para esta recepción.</li>`;
                                }
                            });
                        } else {
                            recaudosHtml += '<li>No se encontraron recaudos para esta recepción.</li>';
                        }
                        recaudosHtml += '</ul>';

                        $('#exampleModalScrollable .modal-body').html(`
                            <h5 class="font-weight-bold text-primary" style="text-align: center">Recaudos entregados para Recepción #${data.recepcion.id}</h5>
                            ${recaudosHtml}
                            <p><b>Tipo de Solicitud:</b> ${data.recepcion.categoria}</p>
                            <p><b>Latitud:</b> ${data.recepcion.latitud}</p>
                            <p><b>Longitud:</b> ${data.recepcion.longitud}</p>
                            <p><b>Dirección:</b> ${data.recepcion.direccion}</p>
                            <p><b>Mineral:</b> ${data.recepcion.mineral ? data.recepcion.mineral.nombre : 'No especificado'}</p>
                        `);

                        if (!$('#exampleModalScrollable').is(':visible')) {
                            $('#exampleModalScrollable').modal('show');
                        }
                    },
                    error: function(error) {
                        console.error("Error al obtener los datos:", error);
                        alert("Error al cargar los recaudos. Por favor, inténtalo de nuevo.");
                    }
                });
            });
        });

    </script>

@endsection