@extends('layouts.index')

<title>@yield('title') Comprobante Pago</title>

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
                        <h2 class="font-weight-bold text-primary">Gestión Pago de Licencia</h2>
                            
                    </div>


                                    {{-- ? TABLA PARA LA INSPECCION --}}

                    <div class="table-responsive p-3" id="t_Aprovechamiento">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-Secondary">Tipo de Solicitud</th>
                                    <th class="font-weight-bold text-Secondary">Mineral</th>
                                    <th class="font-weight-bold text-Secondary">Lugar</th>
                                    <th class="font-weight-bold text-Secondary">Fecha de Inspección</th>
                                    <th class="font-weight-bold text-Secondary">Estatus Inspección</th>
                                    <th class="font-weight-bold text-Secondary">Estatus Aprobación</th>
                                    <th class="font-weight-bold text-Secondary"><center>Acciones</center></th>
                                  </tr>
                            </thead>
                            <tbody>
    
                                @foreach ($inspecciones as $inspeccion)
                                    <tr data-inspeccion-id="{{ $inspeccion->id }}">
                                        <td class="font-weight-bold text-Secondary">{{ $inspeccion->planificacion->recepcion->categoria }}</td>
                                        <td class="font-weight-bold text-Secondary">{{ $inspeccion->planificacion->recepcion->mineral->nombre }}</td>
                                        <td class="font-weight-bold text-Secondary">{{ $inspeccion->lugar_direccion}}</td>  
                                        <td class="font-weight-bold text-Secondary">{{ date('d/m/Y', strtotime($inspeccion->fecha_inspeccion)) }}</td>
                                        <td class="font-weight-bold text-Secondary">{{ $inspeccion->estatus}}</td>
                                        <td class="font-weight-bold text-Secondary" id="estatus-{{ $inspeccion->id }}">{{ $inspeccion->estatus_resp}}</td>

                                        <td>

                                            <div style="display: flex; justify-content: center;">
                                                @can('crear-comprobante_pago')
                                                    @if (!$inspeccion->yaComprobado)
                                                    <a class="btn btn-success btn-sm registrar-comprobante" style="display: none;" title="Registar Comprobante" href="{{ route('comprobantepago.create', ['id' => $inspeccion->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
                                                    </svg></a>
                                                
                                                    <a class="btn btn-success btn-sm aprobar-solicitud" style="margin: 0 3px; display: none;" title="Aprobar Solicitud" data-inspeccion-id='{{ $inspeccion->id }}'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16" style="color: #ffff; cursor: pointer; position: center;">
                                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                                        </svg>
                                                    </a>                                            
                                                    
                                                    <meta name="csrf-token" content="{{ csrf_token() }}">

                                                    <a class="btn btn-danger btn-sm negar-solicitud" style="margin: 0 1px; display: none;" title="Negar Solicitud" data-inspeccion-id='{{ $inspeccion->id }}'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16" style="color: #ffff; cursor: pointer; position: center;">
                                                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                    </svg></a>
                                                    @endif
                                                @endcan
                                                
                                                @can('editar-inspeccion')
                                                    <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar la Inspección" href="{{ route('inspeccion.edit', $inspeccion->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                        <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                    </svg></a>
                                                @endcan

                                                <a class="btn btn-info btn-sm" style="margin: 0 1px;" title="Ver Detalles" data-inspeccion-id='{{ $inspeccion->id }}' class="btn btn-primary" data-toggle="modal" data-target="#exampleModalScrollable" id="#modalScroll"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16"  style="color: #ffff; cursor: pointer;">
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

            {{-- Scripts de botones Aprobar, Negar y Registrar Pago de Licencias --}}

            <script>
                        
                document.addEventListener("DOMContentLoaded", function () { // Espera a que el DOM esté completamente cargado
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content'); // Obtiene el token CSRF para las solicitudes

                // Función para ajustar el estatus y botones en la interfaz de usuario
                function ajustarBotones(estatus, inspeccionId) {
                    const estatusActualTd = document.querySelector(`#estatus-${inspeccionId}`); // Selecciona el td correspondiente al estatus actual
                    const btnRegistrarComprobante = document.querySelector(`.registrar-comprobante[href*='${inspeccionId}']`); // Selecciona el botón de "Registrar Comprobante"
                    const btnAprobarSolicitud = document.querySelector(`.aprobar-solicitud[data-inspeccion-id='${inspeccionId}']`); // Selecciona el botón de "Aprobar Solicitud"
                    const btnNegarSolicitud = document.querySelector(`.negar-solicitud[data-inspeccion-id='${inspeccionId}']`); // Selecciona el botón de "Negar Solicitud"

                    // Verifica si los elementos existen antes de intentar acceder a sus propiedades
                    if (estatusActualTd) {
                        estatusActualTd.textContent = estatus; // Actualiza el contenido del td con el estatus actual
                    }

                    if (btnRegistrarComprobante && btnAprobarSolicitud && btnNegarSolicitud) {
                        if (estatus === "Aprobado") { // Si el estatus es "Aprobado"
                            btnRegistrarComprobante.style.display = "inline-block"; // Muestra el botón de "Registrar Comprobante"
                            btnAprobarSolicitud.style.display = "none"; // Oculta el botón de "Aprobar Solicitud"
                            btnNegarSolicitud.style.display = "none"; // Oculta el botón de "Negar Solicitud"
                        } else if (estatus === "Negado") { // Si el estatus es "Negado"
                            btnRegistrarComprobante.style.display = "none"; // Oculta el botón de "Registrar Comprobante"
                            btnAprobarSolicitud.style.display = "none"; // Oculta el botón de "Aprobar Solicitud"
                            btnNegarSolicitud.style.display = "none"; // Oculta el botón de "Negar Solicitud"
                        } else { // Si el estatus es "Pendiente" o cualquier otro valor inicial
                            btnRegistrarComprobante.style.display = "none"; // Oculta el botón de "Registrar Comprobante"
                            btnAprobarSolicitud.style.display = "inline-block"; // Muestra el botón de "Aprobar Solicitud"
                            btnNegarSolicitud.style.display = "inline-block"; // Muestra el botón de "Negar Solicitud"
                        }
                    } else {
                        console.error('No se encontraron los botones para la inspección ID:', inspeccionId);
                    }
                }

                // Función para actualizar el estatus en el servidor y ajustar los botones
                function actualizarEstatus(estatus, inspeccionId) {
                    fetch(`/actualizar-estatus-inspeccion/${inspeccionId}`, { // Hace una solicitud fetch a la URL para actualizar el estatus
                        method: 'POST', // Método HTTP POST
                        headers: {
                            'Content-Type': 'application/json', // Tipo de contenido JSON
                            'X-CSRF-TOKEN': csrfToken // Añade el token CSRF a la cabecera
                        },
                        body: JSON.stringify({ estatus_resp: estatus }) // Convierte el estatus a una cadena JSON y la envía en el cuerpo de la solicitud
                    })
                    .then(response => response.json()) // Convierte la respuesta a JSON
                    .then(data => { // Maneja la respuesta del servidor
                        if (data.success) { // Si la actualización fue exitosa
                            ajustarBotones(estatus, inspeccionId); // Ajusta los botones en la interfaz de usuario
                        } else {
                            console.error('Error al actualizar el estatus:', data.message); // Muestra un error en la consola si la actualización falla
                        }
                    })
                    .catch(error => console.error('Error:', error)); // Muestra un error en la consola si la solicitud falla
                }

                // Añadir los escuchadores de eventos a cada botón de "Aprobar Solicitud"
                document.querySelectorAll(".aprobar-solicitud").forEach(btn => {
                    btn.addEventListener("click", function (event) {
                        event.preventDefault(); // Previene la acción por defecto del clic
                        const inspeccionId = this.getAttribute('data-inspeccion-id'); // Obtiene el ID de la inspección del atributo data-inspeccion-id
                        actualizarEstatus("Aprobado", inspeccionId); // Llama a la función para actualizar el estatus a "Aprobado"
                    });
                });

                // Añadir los escuchadores de eventos a cada botón de "Negar Solicitud"
                document.querySelectorAll(".negar-solicitud").forEach(btn => {
                    btn.addEventListener("click", function (event) {
                        event.preventDefault(); // Previene la acción por defecto del clic
                        const inspeccionId = this.getAttribute('data-inspeccion-id'); // Obtiene el ID de la inspección del atributo data-inspeccion-id
                        actualizarEstatus("Negado", inspeccionId); // Llama a la función para actualizar el estatus a "Negado"
                    });
                });

                // Ajustar los botones según el estatus actual cuando la página se carga
                document.querySelectorAll("tr[data-inspeccion-id]").forEach(row => {
                    const inspeccionId = row.getAttribute('data-inspeccion-id'); // Obtiene el ID de la inspección de la fila
                    const estatus = document.querySelector(`#estatus-${inspeccionId}`).textContent.trim(); // Obtiene el estatus actual del td correspondiente
                    ajustarBotones(estatus, inspeccionId); // Llama a la función para ajustar los botones según el estatus actual
                });
            });
            
        </script>

        
                                            
    {{-- * FUNCIÓN PARA MOSTRAR DATOS DE LA INSPECCIÓN EN EL MODAL --}}

    <script>
        $(document).ready(function() {
    

        $('#t_Aprovechamiento').on('click', '.btn-info', function(event) {
            event.preventDefault();
            var inspeccionId = $(this).data('inspeccion-id');

            $.ajax({
                url: '/comprobantepago/detalles/' + inspeccionId,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    let inspeccionesHtml = '<main>';
                    inspeccionesHtml += `
                        <h5 class="font-weight-bold text-primary" style="text-align: center">Detalles de la Inspección</h5>
                        <p><b>Funcionario Acompañante:</b> ${data.funcionario_acomp}</p>
                        <p><b>Observaciones:</b> ${data.observaciones}</p>
                        <p><b>Conclusiones:</b> ${data.conclusiones}</p>
                        <p><b>Latitud:</b> ${data.latitud}</p>
                        <p><b>Longitud:</b> ${data.longitud}</p>
                        <p><b>UTM Norte:</b> ${data.utm_norte}</p>
                        <p><b>UTM Este:</b> ${data.utm_este}</p>
                    `;

                    // Condicionales para mostrar/ocultar datos según el id_planificacion (Se muestran los datos propios de Aprovechamiento)
                    if (data.id_planificacion !== "Procesamiento") {
                        inspeccionesHtml += `
                            <p><b>Longitud Terreno:</b> ${data.longitud_terreno} mts</p>
                            <p><b>Ancho Máximo:</b> ${data.ancho} mts</p>
                            <p><b>Profundidad Máxima:</b> ${data.profundidad} mts</p>
                            <p><b>Volumen a Extraer:</b> ${data.volumen} m³</p>
                        `;
                    }

                    // Condicionales para mostrar/ocultar datos según el id_planificacion (Se muestran los datos propios de Procesamiento)
                    if (data.id_planificacion !== "Aprovechamiento") {
                        inspeccionesHtml += `
                            <p><b>Lindero Norte:</b> ${data.lindero_norte}</p>
                            <p><b>Lindero Sur:</b> ${data.lindero_sur}</p>
                            <p><b>Lindero Este:</b> ${data.lindero_este}</p>
                            <p><b>Lindero Oeste:</b> ${data.lindero_oeste}</p>
                            <p><b>Superficie:</b> ${data.superficie} ha</p>
                        `;
                    }

                    // Resto del código para mostrar las fotos y el modal
                    inspeccionesHtml += `
                        <p><b>Fotos:</b></p>
                        <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                    `;

                    // Parsear el JSON de res_fotos
                    let fotos = JSON.parse(data.res_fotos);

                    // Itera sobre las fotos y agrégalas al HTML
                    fotos.forEach(function(foto) {
                        inspeccionesHtml += `<img src="/imagen/${foto}" width="60%" style="width: calc(50% - 10px); margin-bottom: 10px;">`;
                    });

                    inspeccionesHtml += '</div></main>';

                    $('#exampleModalScrollable .modal-body').html(inspeccionesHtml);

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

    @if ($errors->any())
        <script>
            var errors = @json($errors->all());
            errors.forEach(function(error) {
                Swal.fire({
                    title: 'Pago de Licencia',
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