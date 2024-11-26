@extends('layouts.index')

<title>@yield('title')Inicio</title>
@section('css-datatable')
        <link href="{{ asset ('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endsection
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="{{ asset('https://unpkg.com/leaflet/dist/leaflet.css') }}" />
<link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css') }}">
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<style>
    @keyframes rotateAnimation {
      0% {
        transform: rotateY(0deg);
      }
      25% {
        transform: rotateY(360deg);
      }
      100% {
        transform: rotateY(360deg);
      }
    }

    @keyframes hoverRotateAnimation {
      from {
        transform: rotateY(0deg);
      }
      to {
        transform: rotateY(360deg);
      }
    }

    .rotate {
      animation: rotateAnimation 5s linear 1;
    }

</style>


@section('contenido')

                                                       <!-- Container Fluid Contenido Dentro del Cuadro con Fondo Blanco-->
  <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center"></div>

        <div class="row">

                                                              <!-- dasboard persona natural-->
          {{-- <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Persona Natural</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_natural) }}</div>
                    
                  </div>
                  <div class="col-auto">
                  <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 rotate hover-rotate">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Persona Natural</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count_natural }}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                              <!-- dasboard persona jurídico-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 rotate hover-rotate">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Persona JurÍdica</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_juridico) }}</div>
                    
                  </div>
                  <div class="col-auto">
                  <i class="fas fa-users fa-2x text-danger"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 rotate hover-rotate">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Comisionado</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_comisionado) }}</div>  
                  </div>

                  <div class="col-auto">
                    <i class=" fas fa-user-tie fa-2x text-secondary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                <!-- dasboard minerales -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 rotate hover-rotate">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Mineral</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_mineral) }}</div>    
                  </div>

                  <div class="col-auto">
                  <i class="fas fa-mountain fa-2x text-warning"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                <!-- dasboard solicitante-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 rotate hover-rotate">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Solicitante</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_solicitante) }}</div>
                    
                  </div>
                  <div class="col-auto">
                  <i class="fas fa-users fa-2x text-primary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                <!--dasboard recaudo-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 rotate hover-rotate">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Recaudo</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_recaudo) }}</div>

                    </div>
                  <div class="col-auto">
                  <i class="fa fa-folder-open fa-2x text-warning" ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                               <!-- dasboard Plazos de Vigencia-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 rotate hover-rotate">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Plazos de Vigencia</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_plazo) }}</div>
                 
                  </div>
                  <div class="col-auto">
                    <i class="far fa-calendar-alt fa-2x text-dark"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                    <!-- dasboard Tipo de Pagos -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100 rotate hover-rotate">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Tipo de Pago</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_tipo_pagos) }}</div>
                 
                  </div>
                  <div class="col-auto">
                    <i class="far fa-money-bill-alt fa-2x text-success"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                <!-- dasboard Mapa de las Inspecciones-->
                                                          
          <!-- Area Chart -->
          <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                <h6 class="m-0 font-weight-bold text-primary">Mapa de Recepciones e Inspecciones</h6>
                <div class="dropdown no-arrow">
                  <!-- <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a> -->
                  <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                     <div class="dropdown-header">Ver:</div>
                    <a class="dropdown-item" href="#">Recepciones de recaudos</a>
                    <a class="dropdown-item" href="#">Inspecciones</a>
                     <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div> -->
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  {{-- <canvas id="myAreaChart"></canvas> --}}
                  <div id="mapa" style="height: 310px; width:100%; display:block;"></div>
                </div>
              </div>
            </div>
          </div>
          <!-- Pie Chart -->
          <div style="width:32.5%; display:block;">
            <div class="card mb-4" style="padding-top: 89.5px; padding-bottom: 89.5px;">
            {{--<div class="card-header py-3 d-flex flex-row align-items-center justify-content-center"> --}}
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                <h6 class="m-0 font-weight-bold text-primary">Estadística de Ubicaciones</h6>
                 <div class="h5 mb-0 font-weight-bol d text-gray-800"></div> 
              </div>

              <div class="card-body">
                <div class="mb-3">
                    <div class="small text-gray-500">Recepciones
                        <div class="small float-right"><b>{{ $count_recepcion }}</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-warning" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-value="{{ $count_recepcion }}"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="small text-gray-500">Inspecciones
                        <div class="small float-right"><b>{{ $count_inspecciones }}</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-info" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-value="{{ $count_inspecciones }}"></div>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="small text-gray-500">Licencias Aprobadas Activas
                        <div class="small float-right"><b>{{ $count_licencia }}</b></div>
                    </div>
                    <div class="progress" style="height: 12px;">
                        <div class="progress-bar bg-success" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-value="{{ $count_licencia }}"></div>
                    </div>
                </div>
              </div>
            </div>
              
            </div>
          </div>

          <!-- Invoice Example -->
          <div class="col-xl-12 col-lg-7">
            <div class="card mb-4">
              <div class="card-header py-3 align-items-center justify-content-center">
                <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">Pagos Vencidos y Pendientes</h6>
                  <div class="table-responsive p-3"> 
                    <table class="table align-items-center table-flush" id="dataTable">
                        <thead class="thead-light">
                            <tr>                                    
                                <th class="font-weight-bold text-Secondary">N° Licencia</th>
                                <th class="font-weight-bold text-Secondary">Tipo Licencia</th>
                                <th class="font-weight-bold text-Secondary">Solicitante Habilitado</th>
                                <th class="font-weight-bold text-Secondary">Fecha Vencimiento</th>
                                <th class="font-weight-bold text-Secondary">Estatus</th>                                                           
                                <th class="font-weight-bold text-Secondary"><center>Acciones</center> </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pagos as $pago)
                                <tr>

                                  @if ($pago->status != "Normal")

                                    <td class="font-weight-bold text-Secondary">
                                
                                      @if ($pago->licencia->resolucion_apro == null)
                                        {{ $pago->licencia->resolucion_hpc }}
                                      @elseif ($pago->licencia->resolucion_hpc == null)
                                        {{ $pago->licencia->resolucion_apro }}
                                      @endif
                                      
                                    </td>
                                    <td class="font-weight-bold text-Secondary">{{ $pago->licencia->comprobante_pago->inspeccion->planificacion->recepcion->categoria }}</td>
                                    <td class="font-weight-bold text-Secondary">
                                      {{ $pago->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->nombre }} 
                                      {{ $pago->licencia->comprobante_pago->inspeccion->planificacion->recepcion->solicitante->solicitanteEspecifico->apellido }}
                                    </td>
                                    <td class="font-weight-bold text-Secondary"> {{ date('d/m/Y', strtotime($pago->fecha_venci)) }} </td>
                                    <td class="font-weight-bold text-Secondary">
                                      
                                      <span class="{{ $pago->statusClass }}">{{ $pago->status }}</span>
                
                                    </td>

                                    <td class="font-weight-bold text-Secondary" style="text-align: center;">
                                      <a href="#" class="btn btn-sm btn-primary">Detail</a>
                                    </td>
                                        
                                    @else
                                  
                                    <td class="font-weight-bold text-Secondary"></td>
                                    <td class="font-weight-bold text-Secondary"></td>
                                    <td class="font-weight- text-Secondary" style="text-align: right;">Nada Encontrado Disculpa.</td>
                                    <td class="font-weight-bold text-Secondary"></td>
                                    <td class="font-weight-bold text-Secondary"></td>
                                    <td class="font-weight-bold text-Secondary"></td>
              
                                  @endif
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      
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

    @endsection

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
    <script src="{{ asset('path/to/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js') }}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('https://unpkg.com/leaflet/dist/leaflet.js') }}"></script>
    
          {{-- * FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

    <script>
        const map = L.map('mapa').setView([10.2825, -68.7222], 9.6); // Latitud y longitud iniciales de Yaracuy

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var recepciones = @json($mapa_recepciones);
        var inspecciones = @json($mapa_inspecciones);
        var licencias = @json($mapa_licencias);

        // Definir iconos personalizados
        var recepcionIcon = L.icon({
            iconUrl: '/icons/mapa1.png', // Ruta al icono de recepcion
            iconSize: [25, 41], // Tamaño del icono
            iconAnchor: [12, 41], // Punto del icono que se corresponde con la posición del marcador
            popupAnchor: [1, -34] // Punto desde el cual se abrirá el popup relativo al icono
        });

        var inspeccionIcon = L.icon({
            iconUrl: '/icons/mapa2.png', // Ruta al icono de inspeccion
            iconSize: [35, 51],
            iconAnchor: [17, 51],
            popupAnchor: [1, -34]
        });


        var licenciaIcon = L.icon({
            iconUrl: '/icons/mapa_licencia.png', // Ruta al icono de recepcion
            iconSize: [25, 41], // Tamaño del icono
            iconAnchor: [12, 41], // Punto del icono que se corresponde con la posición del marcador
            popupAnchor: [1, -34] // Punto desde el cual se abrirá el popup relativo al icono
        });


        recepciones.forEach(function(recepcion) {
            if (recepcion.latitud && recepcion.longitud) {
                L.marker([recepcion.latitud, recepcion.longitud], { icon: recepcionIcon }).addTo(map)
                    .bindPopup('Recepcion');
            }
        });

        inspecciones.forEach(function(inspeccion) {
                if (inspeccion.latitud && inspeccion.longitud) {
                    L.marker([inspeccion.latitud, inspeccion.longitud], { icon: inspeccionIcon }).addTo(map)
                        .bindPopup('Inspeccion');
                }
            });


            // licencias.forEach(function(licencia) {
            //     if (licencia.latitud licencia.longitud) {
            //         L.marker([licencia.latitud, licencia.longitud], { icon: licenciaIcon }).addTo(map)
            //             .bindPopup('Licencia');
            //     }
            // });


            // Datos de licencias del backend
            licencias.forEach(function(licencia) {
                if (licencia.latitud && licencia.longitud) {
                    L.marker([licencia.latitud, licencia.longitud] , { icon: licenciaIcon }).addTo(map).bindPopup('Licencia');
                }
            });

    </script>

    <script>
      document.addEventListener("DOMContentLoaded", function() {
          var progressBars = document.querySelectorAll('.progress-bar');
          progressBars.forEach(function(bar) {
              var value = bar.getAttribute('data-value');
              bar.style.width = '0%';
              setTimeout(function() {
                  bar.style.width = value + '%';
              }, 100); // Añadir un pequeño retraso para empezar la animación
          });
      });
    </script>

@endsection




