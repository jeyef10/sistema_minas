@extends('layouts.index')

<title>@yield('title') Inspecciones</title>

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
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Gestión de Inspecciones</h2>
                            {{-- @can('crear-solicitante')
                                <form action="{{ route('solicitudes.create') }}" method="get" style="display:inline;">
                                    <button type="submit" class="btn btn-primary btn-mb"> <span class="">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                                            <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                                            <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5"/>
                                        </svg>
                                    </span>
                                    <span class="text">Crear</span></button>
                                </form>
                            @endcan --}}
                    </div>
                    <div class="card-body">

                        <div class="row">

                            {{-- <div class="custom-control custom-radio col-1">
                                <input type="radio" id="todos" name="tipo" value="t_todos" class="custom-control-input">
                                <label class="custom-control-label" for="todos">Todos</label>
                            </div>

                            <div class="custom-control custom-radio col-2">
                                <input type="radio" id="aprovechamiento" name="tipo" value="t_Aprovechamiento" class="custom-control-input">
                                <label class="custom-control-label" for="aprovechamiento">Aprovechamiento</label>
                            </div>

                            <div class="custom-control custom-radio col-1">
                                <input type="radio" id="procesamiento" name="tipo" value="t_Procesamiento" class="custom-control-input">
                                <label class="custom-control-label" for="procesamiento">Procesamiento</label>
                            </div> --}}

                        </div>

                    </div>

                                    {{-- ? TABLA PARA TODOS LOS SOLICITANTES --}}

                    <div class="table-responsive p-3" id="t_Aprovechamiento">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-Secondary">Nº</th>
                                    <th class="font-weight-bold text-Secondary">Solicitante</th>
                                    <th class="font-weight-bold text-Secondary">Cédula</th>
                                    <th class="font-weight-bold text-Secondary">Rif</th>
                                    <th class="font-weight-bold text-Secondary">Nombre</th>
                                    <th class="font-weight-bold text-Secondary">Apellido</th>
                                    <th class="font-weight-bold text-Secondary">Correo</th>
                                    <th class="font-weight-bold text-Secondary">Fecha</th>
                                    <th class="font-weight-bold text-Secondary"><center>Acciones</center></th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitudes as $solicitud)
                                <tr>
                                   
                                    <td class="font-weight-bold text-Secondary">{{ $solicitud->id}}</td>

                                        <!-- Muestra el tipo de solicitante (Natural o Jurídico) -->
                                        <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitante->tipo }}</td>

                                        <!-- Verifica si el solicitante es una Persona Natural -->
                                        @if ($solicitud->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaNatural)
                                            <!-- Si es una Persona Natural, muestra la cédula, el nombre y el apellido -->
                                            <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitante->solicitanteEspecifico->cedula }}</td>
                                            <td class="font-weight-bold text-Secondary">No Aplica</td>
                                            <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitante->solicitanteEspecifico->nombre }}</td>
                                            <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitante->solicitanteEspecifico->apellido }}</td>
                                            <td class="font-weight-bold text-Secondary">No Aplica</td>

                                        <!-- Verifica si el solicitante es una Persona Jurídica -->
                                        @elseif ($solicitud->solicitante->solicitanteEspecifico instanceof \App\Models\PersonaJuridica)
                                            <!-- Si es una Persona Jurídica, muestra el rif, el nombre y el correo -->
                                            <td class="font-weight-bold text-Secondary">No Aplica</td>
                                            <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitante->solicitanteEspecifico->rif }}</td>
                                            <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitante->solicitanteEspecifico->nombre }}</td>
                                            <td class="font-weight-bold text-Secondary">No Aplica</td>
                                            <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitante->solicitanteEspecifico->correo }}</td>
                                        @endif

                                        <td class="font-weight-bold text-Secondary">{{ $solicitud->fecha }}</td>   

                                        <td>
                                            <a class="btn btn-secondary btn-sm" title="Inspeccionar" href="{{ route('inspeccion.create', $solicitud->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-incognito" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="m4.736 1.968-.892 3.269-.014.058C2.113 5.568 1 6.006 1 6.5 1 7.328 4.134 8 8 8s7-.672 7-1.5c0-.494-1.113-.932-2.83-1.205l-.014-.058-.892-3.27c-.146-.533-.698-.849-1.239-.734C9.411 1.363 8.62 1.5 8 1.5s-1.411-.136-2.025-.267c-.541-.115-1.093.2-1.239.735m.015 3.867a.25.25 0 0 1 .274-.224c.9.092 1.91.143 2.975.143a30 30 0 0 0 2.975-.143.25.25 0 0 1 .05.498c-.918.093-1.944.145-3.025.145s-2.107-.052-3.025-.145a.25.25 0 0 1-.224-.274M3.5 10h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5m-1.5.5q.001-.264.085-.5H2a.5.5 0 0 1 0-1h3.5a1.5 1.5 0 0 1 1.488 1.312 3.5 3.5 0 0 1 2.024 0A1.5 1.5 0 0 1 10.5 9H14a.5.5 0 0 1 0 1h-.085q.084.236.085.5v1a2.5 2.5 0 0 1-5 0v-.14l-.21-.07a2.5 2.5 0 0 0-1.58 0l-.21.07v.14a2.5 2.5 0 0 1-5 0zm8.5-.5h2a.5.5 0 0 1 .5.5v1a1.5 1.5 0 0 1-3 0v-1a.5.5 0 0 1 .5-.5"/>
                                            </svg></a>

                                            <a class="btn btn-warning btn-sm" title="Desea Editar la Solicitud" href="{{ route('solicitudes.edit', $solicitud->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                            </svg></a>

                                            <a class="btn btn-info btn-sm" title="Ver Los Recaudos" href="{{ route('solicitudes.show', $solicitud->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-layout-text-window-reverse" viewBox="0 0 16 16">
                                                <path d="M13 6.5a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m0 3a.5.5 0 0 0-.5-.5h-5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 .5-.5m-.5 2.5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1z"/>
                                                <path d="M14 0a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zM2 1a1 1 0 0 0-1 1v1h14V2a1 1 0 0 0-1-1zM1 4v10a1 1 0 0 0 1 1h2V4zm4 0v11h9a1 1 0 0 0 1-1V4z"/>
                                            </svg></a>
                                            
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

    {{-- <script>
        function showHideForms() {
            // Selecciona los botones de radio con el nombre "tipo"
            const radios = document.querySelectorAll('input[type="radio"][name="tipo"]'); 
    
            // Selecciona los divs con los ID "Aprovechamiento" y "Procesamiento"
            const divs = document.querySelectorAll('#t_Aprovechamiento, #t_Procesamiento'); 
    
            // Inicialmente oculta ambos divs
            divs[0].style.display = 'none';
            divs[1].style.display = 'none';
    
            // Añade un evento de cambio a los botones de radio
            radios.forEach(radio => {
                radio.addEventListener('change', (event) => {

                    // Obtiene el ID del div a mostrar
                    const selectedDivId = event.target.value; 
    
                    // Recorre todos los divs
                    for (const div of divs) {

                        // Si el ID del div coincide con el ID seleccionado, muestra el div
                        if (div.id === selectedDivId) {
                            div.style.display = 'block';

                            // Establece el valor del campo de tipo en el div seleccionado
                            /* document.querySelector(`#tipo-${selectedDivId.toLowerCase()}`).value = selectedDivId; */
                        } else {
                            
                            // Si no coincide, oculta el div
                            div.style.display = 'none';
                        }
                        
                    }
                }); 
            });
        }
    
        // Añade el evento de carga a la ventana para ejecutar la función showHideForms cuando se carga la página
        window.addEventListener('DOMContentLoaded', showHideForms);
    </script> --}}
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
@endsection