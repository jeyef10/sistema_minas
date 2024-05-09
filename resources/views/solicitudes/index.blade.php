@extends('layouts.index')

<title>@yield('title') Solicitudes</title>

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
                        <h2 class="font-weight-bold text-primary" style="margin-left: 38%;">Gestión de Solicitudes</h2>
                            @can('crear-solicitante')
                                <form action="{{ route('solicitudes.create') }}" method="get" style="display:inline;">
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
                    <div class="card-body">

                        <div class="row">

                            <div class="custom-control custom-radio col-1">
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
                            </div>

                        </div>

                    </div>

                                    {{-- ? TABLA PARA TODOS LOS SOLICITANTES --}}

                    <div class="table-responsive p-3" id="t_Aprovechamiento">
                        <table class="table align-items-center table-flush" id="dataTable">
                            <thead class="thead-light">
                                <tr>
                                    <th class="font-weight-bold text-Secondary">N°</th>
                                    <th class="font-weight-bold text-Secondary">Solicitante</th>
                                    <th class="font-weight-bold text-Secondary">Fecha</th>
                                    <th class="font-weight-bold text-Secondary"><center>Acciones</center></th>
                                  </tr>
                            </thead>
                            <tbody>
                                @foreach ($solicitudes as $solicitud)
                                <tr>
                                    <td class="font-weight-bold text-Secondary">{{ $solicitud->id }}</td> 
                                    <td class="font-weight-bold text-Secondary">{{ $solicitud->fecha->format('d/m/Y') }}</td> 
                                    <td class="font-weight-bold text-Secondary">{{ $solicitud->tipo }}</td>
                          
                                     <!-- Verifica si el solicitante es una Persona Natural -->
                                    @if ($solicitud->solicitanteEspecifico instanceof \App\Models\PersonaNatural)
                                      <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitanteEspecifico->cedula }}</td>
                                      <td class="font-weight-bold text-Secondary">No Aplica</td>
                                      <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitanteEspecifico->nombre }} {{ $solicitud->solicitanteEspecifico->apellido }}</td>
                                    
                                      <!-- Verifica si el solicitante es una Persona Jurídica -->
                                    @elseif ($solicitud->solicitanteEspecifico instanceof \App\Models\PersonaJuridica)
                                      <td class="font-weight-bold text-Secondary">No Aplica</td>
                                      <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitanteEspecifico->rif }}</td>
                                      <td class="font-weight-bold text-Secondary">{{ $solicitud->solicitanteEspecifico->nombre }}</td>

                                    @endif
                                    {{-- <td class="font-weight-bold text-Secondary">{{ $solicitud->mineral->nom_mineral }}</td>
                                    <td class="font-weight-bold text-Secondary">{{ $solicitud->tasa_regalias }}</td>
                                    <td class="font-weight-bold text-Secondary">{{ $solicitud->volumen }}</td>
                                    <td class="font-weight-bold text-Secondary">{{ $solicitud->plazo }}</td> 
                                    <td class="font-weight-bold text-Secondary">{{ $solicitud->estatus }}</td> --}}

                                    {{-- <td>
                                      <a href="{{ route('solicitudes.show', $solicitud->id) }}" class="btn btn-sm btn-info">Ver</a>
                                    </td> --}}

                                  </tr>

                                        <td>
                                            @can('editar-solicitud')
                                                <a class="btn btn-warning btn-sm" style="margin-left: 31%;" href="{{ route('solicitudes.edit',$solicitante->id) }}"><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                                                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z"/>
                                                </svg></a>
                                            @endcan

                                            {{-- @can('borrar-solicitante')       
                                                <form action="{{ route('solicitudes.destroy', $solicitante->id) }}" method="POST" class="sweetalert" style="display:inline;">
                                                    @csrf
                                                    {{ method_field('DELETE') }}
                                                    <button class="btn btn-danger btn-sm" type="submit" value=""><i class="fas fa-trash"></i></button>
                                                </form> 
                                            @endcan --}}
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