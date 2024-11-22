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
                                    <tr>
                                        <td class="font-weight-bold text-Secondary">{{ $inspeccion->planificacion->recepcion->categoria }}</td>
                                        <td class="font-weight-bold text-Secondary">{{ $inspeccion->planificacion->recepcion->mineral->nombre }}</td>
                                        <td class="font-weight-bold text-Secondary">{{ $inspeccion->lugar_direccion}}</td>  
                                        <td class="font-weight-bold text-Secondary">{{ date('d/m/Y', strtotime($inspeccion->fecha_inspeccion)) }}</td>
                                        <td class="font-weight-bold text-Secondary">{{ $inspeccion->estatus}}</td>
                                        <td class="font-weight-bold text-Secondary">

                                            @if ($inspeccion->estatus == "Aprobado")
                                                {{ $inspeccion->estatus_resp}}
                                            @else
                                                Inspección Negada
                                            @endif
                                            
                                        </td>

                                        <td>

                                            <div style="display: flex; justify-content: center;">
                                                @if (!$inspeccion->yaComprobado)
                                                {{-- <a class="btn btn-success btn-sm" title="Registar Comprobante" href="{{ route('comprobantepago.create', ['id' => $inspeccion->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-currency-dollar" viewBox="0 0 16 16">
                                                <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73z"/>
                                                </svg></a>  --}}
                                                @endif
                                                {{-- <a class="btn btn-danger btn-sm" style="margin: 0 3px;" title="Negar Comprobante"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-square" viewBox="0 0 16 16" style="color: #ffff; cursor: pointer; position: center;">
                                                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                                                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                                                  </svg></a> --}}

                                                <a class="btn btn-dark btn-sm" data-toggle="modal" data-target="#exampleModalLong" id="#modalLong" data-asignacion-id='{{ $inspeccion->id }}'><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"  viewBox="0 0 16 16" style="color: #ffff; cursor: pointer;" class="bi bi-file-check">
                                                    <path d="M10.854 6.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 8.793l2.646-2.647a.5.5 0 0 1 .708 0"/>
                                                    <path d="M4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm0 1h8a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1"/>
                                                    </svg>
                                                </a>
                                                
                                                <a class="btn btn-warning btn-sm" style="margin: 0 3px;" title="Desea Editar la Inspección" href="{{ route('inspeccion.edit', $inspeccion->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg></a>

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

    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document" style="max-width: 70%">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLongTitle">Modal Long</h5> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="marcaForm" method="POST" action="#">
                        @csrf   
                        
                        <h5 class="font-weight-bold text-primary" style="text-align: center">Estatus Aprobación</h5>
                        
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">N° de Oficio</label>
                                    <input type="text" class="form-control" id="num_oficio" name="num_oficio" oninput="capitalizarInput('')"></input>                                 
                                </div>

                                <div class="col-4">                                     
                                    <div class="form-group" id="simple-date1">
                                        <label class="font-weight-bold text-primary" for="simpleDataInput">Fecha Oficio</label>
                                        <div class="input-group date">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                            </div>
                                            <input type="text" id="fecha_oficio" name="fecha_oficio" class="form-control" value="<?php echo date('d/m/Y'); ?>" id="simpleDataInput">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Estatus Oficio</label>
                                    <select class="select2single form-control" name="estatus_oficio" id="estatus_oficio">
                                        <option value="" selected="true" disabled>Seleccione un Estatus</option>
                                        <option value="Aprobado">Aprobado</option>
                                        <option value="Negado">Negado</option>
                                    </select>
                                </div>

                            </div>

                            <div class="card-body" id="inputs_aprovechamiento">

                                <h5 class="font-weight-bold text-primary" style="text-align: center">Asignación de Licencia Aprovechamiento</h5>
                                <br>
                                <div class="row">
                                
                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N° Resolución</label>
                                        <input type="text" class="form-control" id="resolucion_apro" name="resolucion_apro"  oninput="capitalizarInput('')" readonly></input>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Catastro Minero</label>
                                        <input type="text" class="form-control" id="catastro_la" name="catastro_la" oninput="capitalizarInput('')" readonly></input>                                   
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Metodo de Pago</label>
                                        <select class="select2single form-control" name="metodo_licencia_apro" id="metodo_licencia">
                                            <option value="" selected="true" disabled>Seleccione un Metodo de Pago</option>
                                            <option value="Pago unico">Pago unico</option>
                                            <option value="Pago 2 parte">Pago 2 parte</option>
                                            <option value="Pago 3 parte">Pago 3 parte</option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="card-body" id="inputs_procesamiento">

                                <h5 class="font-weight-bold text-primary" style="text-align: center">Asignación de Licencia Procesamiento</h5>
                                <br>
                                <div class="row">

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">N° Resolución</label>
                                        <input type="text" class="form-control" id="resolucion_hpc" name="resolucion_hpc" oninput="capitalizarInput('')" readonly></input>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Catastro Minero</label>
                                        <input type="text" class="form-control" id="catastro_lp" name="catastro_lp" oninput="capitalizarInput('')" readonly></input>
                                    </div>

                                    <div class="col-4">
                                        <label  class="font-weight-bold text-primary">Metodo de Pago</label>
                                        <select class="select2single form-control" name="metodo_licencia_pro" id="metodo_licencia">
                                            <option value="" selected="true" disabled>Seleccione un Metodo de Pago</option>
                                            <option value="Pago cuotas">Pago cuotas</option>
                                        </select>
                                    </div>

                                    @if ($inspeccion->planificacion->recepcion->mineral->nombre == "Roca caliza")
                                    <div class="card-body">
                                        <label class="font-weight-bold text-primary">Modo de control</label>
                                        <div class="row">
                                            <div class="custom-control custom-radio col-1 mr-2"> 
                                                <input class="custom-control-input" type="radio" name="modo_control" id="control_talonario" value="talonario" checked>
                                                <label class="custom-control-label" for="control_talonario">Pendiente</label>
                                            </div>
                                            <div class="custom-control custom-radio col-1 mr-2">
                                                <input class="custom-control-input" type="radio" name="modo_control" id="control_declaracion" value="declaracion">
                                                <label class="custom-control-label" for="control_declaracion">Aprobado</label>
                                            </div>
                                        </div>
                                    </div>
                                    @endif

                                </div>
                            </div>

                        </div>

                        <br>

                        <center>
                            <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                            <span class="text">Guardar</span>
                            </button>
                            <a  class="btn btn-info btn-lg" href="#"><span class="icon text-white-50">
                                <i class="fas fa-info-circle"></i>
                            </span>
                            <span class="text">Regresar</span></a>
                        </center>
                        
                    </form>
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


    <script src="{{ asset('vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js')}}"></script>
    <script src="{{ asset('js/ruang-admin.min.js')}}"></script>


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

    {{-- * FUNCION PARA MOSTRAR LOS INPUTS SEGÚN LA CATEGORÍA EN EL MODAL XD --}}


    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const estatusOficioSelect = document.getElementById('estatus_oficio');
            const inputsAprovechamiento = document.getElementById('inputs_aprovechamiento');
            const inputsProcesamiento = document.getElementById('inputs_procesamiento');
            const categoria = '{{$inspeccion->planificacion->recepcion->categoria}}';
            console.log(categoria);

            // Inicialmente ocultar ambos divs
            inputsAprovechamiento.style.display = 'none';
            inputsProcesamiento.style.display = 'none';
    
            estatusOficioSelect.addEventListener('change', function() {
                const estatus = estatusOficioSelect.value;
    
                if (estatus === 'Negado') {
                    inputsAprovechamiento.style.display = 'none';
                    inputsProcesamiento.style.display = 'none';
                } else if (estatus === 'Aprobado') {
                    console.log(categoria);
                    if (categoria === 'Aprovechamiento') {
                        inputsAprovechamiento.style.display = 'block';
                        inputsProcesamiento.style.display = 'none';
                    } else if (categoria === 'Procesamiento') {
                        inputsAprovechamiento.style.display = 'none';
                        inputsProcesamiento.style.display = 'block';
                    }
                }
            });
        });
    </script> --}}

    {{-- <script>
        document.querySelectorAll('a[data-asignacion-id]').forEach(function(element) {
        element.addEventListener('click', function() {
            const inspeccionId = this.getAttribute('data-asignacion-id');
            
            // Obtener la información de la inspección con inspeccionId
            fetch(`/comprobantepago/asignacion/` + inspeccionId)
                .then(response => response.json())
                .then(data => {
                    console.log("El id es: " + data.id);
                    const categoria = data.planificacion.recepcion;
                    const inputsAprovechamiento = document.getElementById('inputs_aprovechamiento');
                    const inputsProcesamiento = document.getElementById('inputs_procesamiento');

                    inputsAprovechamiento.style.display = 'none';
                    inputsProcesamiento.style.display = 'none';

                    const estatus = document.getElementById('estatus_oficio').value;
                    if (estatus === 'Aprobado') {
                        if (categoria === 'Aprovechamiento') {
                            inputsAprovechamiento.style.display = 'block';
                        } else if (categoria === 'Procesamiento') {
                            inputsProcesamiento.style.display = 'block';
                        }
                    }
                });
        });
    });

    </script> --}}

    {{-- <script>
        document.querySelectorAll('a[data-asignacion-id]').forEach(function(element) {
        element.addEventListener('click', function() {
            const inspeccionId = this.getAttribute('data-asignacion-id');

            $.ajax({
                url: '/comprobantepago/asignacion/' + inspeccionId,
                type: 'GET',
                success: function(data) {
                    console.log("El id es: " + data);
                    const categoria = data;
                    const inputsAprovechamiento = document.getElementById('inputs_aprovechamiento');
                    const inputsProcesamiento = document.getElementById('inputs_procesamiento');

                    inputsAprovechamiento.style.display = 'none';
                    inputsProcesamiento.style.display = 'none';

                    const estatus = document.getElementById('estatus_oficio').value;
                    if (estatus === 'Aprobado') {
                        if (categoria === 'Aprovechamiento') {
                            inputsAprovechamiento.style.display = 'block';
                        } else if (categoria === 'Procesamiento') {
                            inputsProcesamiento.style.display = 'block';
                        }
                    }

                },
                
            });
        });
    });

    </script> --}}

    <script>
        document.getElementById('estatus_oficio').addEventListener('change', function() {
        var estatusOficio = this.value;
        var inspeccionId = document.querySelector('[data-asignacion-id]').getAttribute('data-asignacion-id');
        
        if (estatusOficio === 'Negado') {
            document.getElementById('inputs_aprovechamiento').style.display = 'none';
            document.getElementById('inputs_procesamiento').style.display = 'none';
        } else if (estatusOficio === 'Aprobado') {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/comprobantepago/asignacion/' + inspeccionId, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var categoria = JSON.parse(xhr.responseText).categoria;

                    if (categoria === 'Aprovechamiento') {
                        document.getElementById('inputs_aprovechamiento').style.display = 'block';
                        document.getElementById('inputs_procesamiento').style.display = 'none';
                    } else if (categoria === 'Procesamiento') {
                        document.getElementById('inputs_aprovechamiento').style.display = 'none';
                        document.getElementById('inputs_procesamiento').style.display = 'block';
                    }
                }
            };
            xhr.send();
        }
    });

    </script> 

@endsection