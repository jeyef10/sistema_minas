@extends('layouts.index')

<title>@yield('title')Inicio</title>

@section('contenido')

                                                        <!-- Container Fluid Contenido Dentro del Cuadro con Fondo Blanco-->
  <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>

        <div class="row mb-3">

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
        
                                                                  <!-- dasboard comisionados-->
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






      </div>
  </div>

                                                                
            

                                                                  <!-- Area Chart Cuadro de Estadisticas -->
          <!-- <div class="col-xl-12 col-lg-7">
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
            </div>
          

@endsection

