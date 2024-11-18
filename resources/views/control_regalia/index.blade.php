@extends('layouts.index')

<title>@yield('title') Control Pago de Regalias</title>

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
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Control Pago de Regalias</h2>
                            
                    </div>

                                    {{-- ? TABLA PARA CONTROL DE REGALIA --}}

                    <div class="table-responsive p-3" id="t_Aprovechamiento">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    {{-- <th class="font-weight-bold text-Secondary">Tasa de Regalia</th>
                                    <th class="font-weight-bold text-Secondary">Metodo de pago</th>
                                    <th class="font-weight-bold text-Secondary">Monto</th> --}}
                                    <th class="font-weight-bold text-Secondary">Tipo Licencia</th>
                                    <th class="font-weight-bold text-Secondary">Tipo Solicitante</th>
                                    <th class="font-weight-bold text-Secondary">Solicitante</th>
                                    <th class="font-weight-bold text-Secondary">Fecha de Pago</th>
                                    <th class="font-weight-bold text-Secondary">Fecha de Vecimiento</th>
                                    <th class="font-weight-bold text-Secondary">Estatus</th>
                                    <th class="font-weight-bold text-Secondary"><center>Acciones</center></th>
                                  </tr>
                            </thead>
                            <tbody>
    
                                @foreach ($pago_regalias as $pago_regalia)
                                    <tr>
                                    {{-- <td class="font-weight-bold text-Secondary">

                                    @if ($pago_regalia->regalia)
                                        {{$pago_regalia->regalia->monto }} - {{$pago_regalia->regalia->moneda_longitud }} @else
                                    @endif

                                    </td>
                                    
                                        <td class="font-weight-bold text-Secondary">
                                        @if ($pago_regalia->metodo_apro)
                                            {{ $pago_regalia->metodo_apro }}
                                        @else
                                            {{ $pago_regalia->metodo_pro }}
                                        @endif
                                        </td>

                                        <td class="font-weight-bold text-Secondary">
                                        @if ($pago_regalia->monto_apro)
                                            {{ $pago_regalia->monto_apro }}
                                        @else
                                            {{ $pago_regalia->monto_pro }}
                                        @endif
                                        </td> --}}

                                        <td class="font-weight-bold text-Secondary">
                                            @if ($pago_regalia->licencia->resolucion_apro)
                                                {{ $pago_regalia->licencia->resolucion_apro }}
                                            @else
                                                {{ $pago_regalia->licencia->resolucion_hpc }}
                                            @endif
                                            -
                                            @if ($pago_regalia->licencia->catastro_la)
                                                {{ $pago_regalia->licencia->catastro_la }}
                                            @else
                                                {{ $pago_regalia->licencia->catastro_lp }}
                                            @endif
                                        </td>

                                        <td class="font-weight-bold text-Secondary">{{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->tipo }}</td>

                                        @if ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaNatural)
                                        <!-- Si es una Persona Natural, muestra la cédula, el nombre y el apellido -->
                                        <td class="font-weight-bold text-Secondary">{{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->cedula }} -
                                        {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}</td>

                                        <!-- Verifica si el solicitante es una Persona Jurídica -->
                                        @elseif ($pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaJuridica)
                                            <!-- Si es una Persona Jurídica, muestra el rif, el nombre y el correo -->
                                            <td class="font-weight-bold text-Secondary">{{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->rif }} -
                                            {{ $pago_regalia->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }}</td>
                                        @endif

                                        </td>
                                        <td class="font-weight-bold text-Secondary">{{ date('d/m/Y', strtotime($pago_regalia->fecha_pago)) }}</td>
                                        <td class="font-weight-bold text-Secondary">{{ date('d/m/Y', strtotime($pago_regalia->fecha_venci)) }}</td>
                                        <td class="font-weight-bold text-Secondary">{{ $pago_regalia->estatus_regalia}}</td>

                                        <td> 

                                            <div style="display: flex; justify-content: center;">
                                                <a class="btn btn-warning btn-sm" title="Desea Editar el pago de la regalia" href="{{ route('pago_regalia.edit', $pago_regalia->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg></a>
                                            
                                                <a class="btn btn-info btn-sm" style="margin: 0 3px;" title="Ver Detalles" data-pago_regalia-id='{{ $pago_regalia->id }}' class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16"  style="color: #ffff; cursor: pointer;">
                                                    <path d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                                                    <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM2 1a1 1 0 0 0-1 1v1h14V2a1 1 0 0 0-1-1zM1 4v10a1 1 0 0 0 1 1h2V4zm4 0v11h9a1 1 0 0 0 1-1V4z"/></svg>
                                                </a>
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

            {{-- * FUNCIÓN PARA MOSTRAR DATOS DE LO PAGO REGALÍA EN EL MODAL --}}

    <script>
            $(document).ready(function() {
            $('#t_Aprovechamiento').on('click', '.btn-info', function(event) {
                event.preventDefault();
                var pago_regaliaId = $(this).data('pago_regalia-id');

                $.ajax({
                    url: '/control_regalia/detalles/' + pago_regaliaId,
                    type: 'GET',
                    success: function(data) {
                        console.log(data);
                        let pago_regaliasHtml = '<main>';
                        if (data.tipo_licencia !== "Procesamiento") {
                            pago_regaliasHtml += `
                                <h5 class="font-weight-bold text-primary" style="text-align: center">Detalles del Pago de Regalías</h5>
                                <p><b>Mineral:</b> ${data.nombre_mineral}</p>
                                <p><b>Tipo de Tasa:</b> ${data.tasa_mineral} ${data.id_mineral} $/m³</p>
                                <p><b>Método de Pago:</b> ${data.metodo_apro}</p>
                                <p><b>Cantidad de Metro Cubico:</b> ${data.monto_apro}</p>
                                <p><b>Resultado:</b> ${data.resultado_apro}</p>
                            `;
                        }

                        // Condicionales para mostrar/ocultar datos según el tipo_licencia (Se muestran los datos propios de Procesamiento)
                        if (data.tipo_licencia !== "Aprovechamiento") {
                            pago_regaliasHtml += `
                                <h5 class="font-weight-bold text-primary" style="text-align: center">Detalles del Pago de Regalías</h5>
                                <p><b>Mineral:</b> ${data.nombre_mineral}</p>
                                <p><b>Tipo de Tasa:</b> ${data.tasa_mineral} ${data.id_mineral} $/m³</p>
                                <p><b>Método de Pago:</b> ${data.metodo_pro}</p>
                                <p><b>Cantidad de Metro Cubico:</b> ${data.monto_pro}</p>
                                <p><b>Resultado:</b> ${data.resultado_pro}</p>
                            `;
                        }

                        // Resto del código para mostrar las fotos y el modal
                        pago_regaliasHtml += `
                            <p><b>Fotos:</b></p>
                            <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                        `;

                        // Parsear el JSON de res_fotos
                        let fotos = JSON.parse(data.comprobante);

                        // Itera sobre las fotos y agrégalas al HTML
                        fotos.forEach(function(foto) {
                            pago_regaliasHtml += `<img src="/pdf/${foto}" width="60%" style="width: calc(50% - 10px); margin-bottom: 10px;">`;
                        });

                        pago_regaliasHtml += '</div></main>';

                        $('#exampleModalScrollable .modal-body').html(pago_regaliasHtml);

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