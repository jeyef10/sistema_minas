@extends('layouts.index')

<title>@yield('title')Inicio</title>
<link  href="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.css')}}" rel="stylesheet" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
<link rel="stylesheet" href="{{ asset('https://unpkg.com/leaflet/dist/leaflet.css') }}" />
<link rel="stylesheet" href="{{ asset('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css') }}">
<script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js')}}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>


@section('contenido')

                                                       <!-- Container Fluid Contenido Dentro del Cuadro con Fondo Blanco-->
  <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center"></div>

        <div class="row">

                                                              <!-- dasboard persona natural-->
          <div class="col-xl-3 col-md-6 mb-4">
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
          </div>

                                                              <!-- dasboard persona jurídico-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Persona Juridica</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_juridico) }}</div>
                    
                  </div>
                  <div class="col-auto">
                  <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Comisionado</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_comisionado) }}</div>  
                  </div>

                  <div class="col-auto">
                    <i class=" fas fa-user-tie fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                <!-- dasboard minerales -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Mineral</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_mineral) }}</div>    
                  </div>

                  <div class="col-auto">
                  <i class="fas fa-mountain fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                <!-- dasboard solicitante-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Solicitante</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_solicitante) }}</div>
                    
                  </div>
                  <div class="col-auto">
                  <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                <!--dasboard recaudo-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Recaudo</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_recaudo) }}</div>

                    </div>
                  <div class="col-auto">
                  <i class="fa fa-folder-open fa-2x text-info" ></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                    <!-- dasboard Tasa de ragalias -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Tasa de Regalias</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_regalia) }}</div>
                 
                  </div>
                  <div class="col-auto">
                    <i class="far fa-money-bill-alt fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                               <!-- dasboard Plazos de Vigencia-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                  <div class="text-xs font-weight-bold text-uppercase mb-1">Plazos de Vigencia</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_plazo) }}</div>
                 
                  </div>
                  <div class="col-auto">
                    <i class="far fa-calendar-alt fa-2x text-warning"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                <!-- dasboard Mapa de las Inspecciones-->
                                                          
          <!-- Area Chart -->
          <div class="col-xl-8 col-lg-7">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Ver:</div>
                    <a class="dropdown-item" href="#">Recepciones de recaudos</a>
                    <a class="dropdown-item" href="#">Inspecciones</a>
                    {{-- <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a> --}}
                  </div>
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
          <div class="col-xl-4 col-lg-5">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                {{-- <div class="h5 mb-0 font-weight-bold text-gray-800">{{ ($count_recepcion) }}</div> --}}
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle btn btn-primary btn-sm" href="#" role="button" id="dropdownMenuLink"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Month <i class="fas fa-chevron-down"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Select Periode</div>
                    <a class="dropdown-item" href="#">Today</a>
                    <a class="dropdown-item" href="#">Week</a>
                    <a class="dropdown-item active" href="#">Month</a>
                    <a class="dropdown-item" href="#">This Year</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="mb-3">
                  <div class="small text-gray-500">Oblong T-Shirt
                    <div class="small float-right"><b>600 of 800 Items</b></div>
                  </div>
                  <div class="progress" style="height: 12px;">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: 80%" aria-valuenow="80"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="small text-gray-500">Gundam 90'Editions
                    <div class="small float-right"><b>500 of 800 Items</b></div>
                  </div>
                  <div class="progress" style="height: 12px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 70%" aria-valuenow="70"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="small text-gray-500">Rounded Hat
                    <div class="small float-right"><b>455 of 800 Items</b></div>
                  </div>
                  <div class="progress" style="height: 12px;">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 55%" aria-valuenow="55"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="small text-gray-500">Indomie Goreng
                    <div class="small float-right"><b>400 of 800 Items</b></div>
                  </div>
                  <div class="progress" style="height: 12px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="small text-gray-500">Remote Control Car Racing
                    <div class="small float-right"><b>200 of 800 Items</b></div>
                  </div>
                  <div class="progress" style="height: 12px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 30%" aria-valuenow="30"
                      aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
              <div class="card-footer text-center">
                <a class="m-0 small text-primary card-link" href="#">View More <i
                    class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </div>
        
        </div>
      </div>
      

                                                                  <!-- Area Chart Cuadro de Estadisticas -->
          {{-- <div class="col-xl-12 col-lg-7">
            <div class="card mb-4">
              <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">Monthly Recap Report</h6>
                <div class="dropdown no-arrow">
                  <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                    aria-labelledby="dropdownMenuLink">
                    <div class="dropdown-header">Dropdown Header:</div>
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </div>
                </div>
              </div>
              <div class="card-body">
                <div class="chart-area">
                  <canvas id="myAreaChart"></canvas>
                </div>
              </div>
          </div> --}}

    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
    <script src="{{ asset('path/to/bootstrap-datepicker.es.min.js')}}"></script>
    <script src="{{ asset('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js') }}" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('https://unpkg.com/leaflet/dist/leaflet.js') }}"></script>
    


          {{-- * FUNCION PARA EL MAPA Y PARA CAPTURAR LOS DATOS DE LA LATITUD Y LONGITUD --}}

   
    <script>

      const map = L.map('mapa').setView([10.2825,-68.7222], 9.6); // Latitud y longitud iniciales de Yaracuy

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      var recepciones = @json($mapa_recepciones);
      var inspecciones = @json($mapa_inspecciones);


      recepciones.forEach(function(recepcion) {
          if (recepcion.latitud && recepcion.longitud) {
              L.marker([recepcion.latitud, recepcion.longitud]).addTo(map)
                  .bindPopup('Recepción');
          }
      });

      inspecciones.forEach(function(inspeccion) {
          if (inspeccion.latitud && inspecion.longitud) {
              L.marker([inspeccion.latitud, inspecion.longitud]).addTo(map)
                  .bindPopup('Inspección');
          }
      });


    </script>

    {{-- <script>
       const map = L.map('mapa').setView([10.2825,-68.7222], 9.6); // Latitud y longitud iniciales de Yaracuy

      L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);

      var recepciones = @json($mapa_recepciones);
      var inspecciones = @json($mapa_inspecciones);

      // Iconos personalizados
      var iconoRecepcion = L.icon({
          iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34], 
         
          // className: 'marker-recepcion'
          

          
      });

      var iconoInspeccion = L.icon({
          iconUrl: 'https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png',
          iconSize: [25, 41],
          iconAnchor: [12, 41],
          popupAnchor: [1, -34], 
          
          // className: 'marker-inspeccion'

         
        
      });

      // Agregando marcadores con iconos personalizados y estilos
      recepciones.forEach(function(recepcion) {
          if (recepcion.latitud && recepcion.longitud) {
              L.marker([recepcion.latitud, recepcion.longitud], { icon: iconoRecepcion })
                  .addTo(map)
                  .bindPopup('Recepción');
                  
          }
      });

      inspecciones.forEach(function(inspeccion) {
          if (inspeccion.latitud && inspeccion.longitud) {
              L.marker([inspeccion.latitud, inspeccion.longitud], { icon: iconoInspeccion })
                  .addTo(map)
                  .bindPopup('Inspección');
                  
          }
      });
    
    </script> --}}

    {{-- <script>

      document.addEventListener('DOMContentLoaded', function() {
          const map = L.map('mapa').setView([10.2825, -68.7222], 9.6); // Latitud y longitud iniciales de Yaracuy

          L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
          }).addTo(map);

          var recepciones = @json($mapa_recepciones);
          var inspecciones = @json($mapa_inspecciones);

          var iconoRecepcion = L.divIcon({ className: 'marker-recepcion' });
          var iconoInspeccion = L.divIcon({ className: 'marker-inspeccion' });

          // Agregando marcadores con iconos personalizados y estilos
          recepciones.forEach(function(recepcion) {
              if (recepcion.latitud && recepcion.longitud) {
                  L.marker([recepcion.latitud, recepcion.longitud], { icon: iconoRecepcion })
                      .addTo(map)
                      .bindPopup('Recepción');
              }
          });

          inspecciones.forEach(function(inspeccion) {
              if (inspeccion.latitud && inspeccion.longitud) {
                  L.marker([inspeccion.latitud, inspeccion.longitud], { icon: iconoInspeccion })
                      .addTo(map)
                      .bindPopup('Inspección');
              }
          });
      });
  </script> --}}
         

@endsection

