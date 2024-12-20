@extends('layouts.index')

<title>@yield('title') Licencias</title>

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
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Gestión de Licencias</h2>
                            
                    </div>

                                    {{-- ? TABLA PARA TODOS LOS SOLICITANTES --}}

                    <div class="table-responsive p-3" id="t_Aprovechamiento">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-Secondary">Tipo de Solicitud</th>
                                    <th class="font-weight-bold text-Secondary">Solicitante</th>
                                    <th class="font-weight-bold text-Secondary">Tipo de Pago</th>
                                    <th class="font-weight-bold text-Secondary">Tipo de banco</th>
                                    <th class="font-weight-bold text-Secondary">Fecha Pago</th>
                                    {{-- <th class="font-weight-bold text-Secondary">Estatus Pago</th> --}}
                                    <th class="font-weight-bold text-Secondary"><center>Acciones</center></th>
                                  </tr>
                            </thead>
                            <tbody>
    
                                @foreach ($comprobante_pagos as $comprobante_pago)
                                    <tr>
                                        <td class="font-weight-bold text-Secondary"> {{$comprobante_pago->inspeccion->planificacion->recepcion->categoria }}</td>

                                        <!-- Verifica si el solicitante es una Persona Natural -->
                                        @if ($comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaNatural)
                                            <!-- Si es una Persona Natural, muestra la cédula, el nombre y el apellido -->
                                            <td class="font-weight-bold text-Secondary">{{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }} -
                                            {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}</td>

                                        <!-- Verifica si el solicitante es una Persona Jurídica -->
                                        @elseif ($comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaJuridica)
                                            <!-- Si es una Persona Jurídica, muestra el rif, el nombre y el correo -->
                                            <td class="font-weight-bold text-Secondary">{{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->rif }} -
                                            {{ $comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}</td>
                                        @endif

                                        <td class="font-weight-bold text-Secondary"> {{$comprobante_pago->tipo_pago->forma_pago }}</td>
                                        <td class="font-weight-bold text-Secondary"> 

                                            @if ($comprobante_pago->tipo_pago->forma_pago != "Efectivo")
                                                {{$comprobante_pago->banco->codigo_banco }} - {{$comprobante_pago->banco->nombre_banco }}
                                            @else
                                                Efectivo
                                            @endif
                                            
                                        </td>

                                        <td class="font-weight-bold text-Secondary"> {{ date('d/m/Y', strtotime($comprobante_pago->fecha_pago)) }}</td>
                                        {{-- <td class="font-weight-bold text-Secondary"> {{$comprobante_pago->estatus_pago }}</td> --}}

                                        <td>

                                            <div style="display: flex; justify-content: center;">
                                                @can('crear-licencia')
                                                    @if (!$comprobante_pago->yaLicenciado)   
                                                        <a class="btn btn-primary btn-sm" title="Registar Licencia" href="{{ route('licencia.create', ['id' => $comprobante_pago->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                                                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5M9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8m1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5m-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96q.04-.245.04-.5M7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0"/></svg>
                                                        </a>
                                                    @endif
                                                @endcan
                                                
                                                @can('editar-comprobante_pago')
                                                    <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar el Comprobante de paago" href="{{ route('comprobantepago.edit', $comprobante_pago->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                    </svg></a>
                                                @endcan
                                            
                                                <a class="btn btn-info btn-sm" style="margin: 0 1px;" title="Ver Detalles" data-comprobante_pago-id='{{ $comprobante_pago->id }}' class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16"  style="color: #ffff; cursor: pointer;">
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

                        {{-- ? FUNCIÓN PARA FILTRAR DATOS EN LA TABLA DE SOLICITUDES --}}

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


    {{-- * FUNCIÓN PARA MOSTRAR DATOS DE LA COMPROBANTE EN EL MODAL --}}


{{-- <script>
    $(document).ready(function() {
        $('#t_Aprovechamiento').on('click', '.btn-info', function(event) {
            event.preventDefault();
            var comprobanteId = $(this).data('comprobante_pago-id'); // Obtén el ID de la recepción

            $.ajax({
                url: '/licencia/detalles/' + comprobanteId,
                type: 'GET',
                success: function(data) {
                    console.log(data);

                    let pdfHtml = '<div style="display: flex; flex-wrap: wrap;">';
                        
                    // Parsear el JSON de res_fotos
                    let fotos = JSON.parse(data.comprobante_pdf);

                    // Itera sobre las fotos y agrégalas al HTML
                    fotos.forEach(function(foto) {
                        pdfHtml += `<img src="/pdf/${foto}" width="60%" style="width: calc(50% - 10px); margin-bottom: 10px;">`;
                    });

                    pdfHtml += '</div></main>';

                    $('#exampleModalScrollable .modal-body').html(`
                    <h5 class="font-weight-bold text-primary" style="text-align: center">Detalles de Pago de Licencia</h5>
                        
                        <p><b>Tipo de Solicitud:</b> ${data.id_inspeccion}</p>
                        <p><b>Número Oficio Aprobación:</b> ${data.nro_oficio}</p>
                        <p><b>Fecha Oficio Aprobación:</b> ${data.fecha_oficio}</p>
                        <p><b>Estatus Oficio Aprobación:</b> ${data.estatus_oficio}</p>
                        <p><b>Titular de Firma:</b> ${data.nombre_firma}</p>
                        <p><b>Tipo de Pago:</b> ${data.forma_pago}</p>
                        <p><b>Tipo de Banco:</b> ${data.codigo_banco} ${data.nombre_banco}</p>
                        <p><b>N° Referencia:</b> ${data.n_referencia}</p>
                        <p><b>Observaciones:</b> ${data.observaciones_com}</p>
                        <p><b>Timbres Fiscales:</b> ${data.timbre_fiscal}</p>
                        <p><b>Observaciones Fiscales:</b> ${data.observaciones_fiscal}</p>
                        ${pdfHtml}
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
</script> --}}

<script>
    $(document).ready(function() {
        $('#t_Aprovechamiento').on('click', '.btn-info', function(event) {
            event.preventDefault();
            var comprobanteId = $(this).data('comprobante_pago-id'); // Obtén el ID de la recepción
    
            $.ajax({
                url: '/licencia/detalles/' + comprobanteId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
    
                    let pdfHtml = '<div style="display: flex; flex-wrap: wrap;">';
                        
                    // Parsear el JSON de res_fotos
                    let fotos = JSON.parse(data.comprobante_pdf);
    
                    // Itera sobre las fotos y agrégalas al HTML
                    fotos.forEach(function(foto) {
                        pdfHtml += `<img src="/pdf/${foto}" width="60%" style="width: calc(50% - 10px); margin-bottom: 10px;">`;
                    });
    
                    pdfHtml += '</div></main>';
    
                    let bancoHtml = '';
                    if (data.forma_pago !== 'Efectivo') {
                        bancoHtml = `
                            <p><b>Tipo de Banco:</b> ${data.codigo_banco ?? 'N/A'} ${data.nombre_banco ?? 'N/A'}</p>
                            <p><b>N° Referencia:</b> ${data.n_referencia ?? 'N/A'}</p>
                        `;
                    }
    
                    $('#exampleModalScrollable .modal-body').html(`
                        <h5 class="font-weight-bold text-primary" style="text-align: center">Detalles de Pago de Licencia</h5>
                        
                        <p><b>Tipo de Solicitud:</b> ${data.id_inspeccion}</p>
                        <p><b>Número Oficio Aprobación:</b> ${data.nro_oficio}</p>
                        <p><b>Fecha Oficio Aprobación:</b> ${data.fecha_oficio}</p>
                        <p><b>Estatus Oficio Aprobación:</b> ${data.estatus_oficio}</p>
                        <p><b>Titular de Firma:</b> ${data.nombre_firma}</p>
                        <p><b>Tipo de Pago:</b> ${data.forma_pago}</p>
                        ${bancoHtml}
                        <p><b>Observaciones:</b> ${data.observaciones_com}</p>
                        <p><b>Timbres Fiscales:</b> ${data.timbre_fiscal}</p>
                        <p><b>Observaciones Fiscales:</b> ${data.observaciones_fiscal}</p>
                        ${pdfHtml}
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