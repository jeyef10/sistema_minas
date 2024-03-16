@extends('layouts.index')

<title>@yield('title')Inicio</title>

@section('contenido')

                                                        <!-- Container Fluid Contenido Dentro del Cuadro con Fondo Blanco-->
    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>

        <div class="row mb-3">

                                                                <!-- Earnings (Monthly) Card Example Primer Cuarito-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Earnings (Monthly)</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                      <span class="text-success mr-2"><i class="fa fa-arrow-up"></i> 3.48%</span>
                      <span>Since last month</span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-calendar fa-2x text-primary"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
                                                                <!-- Earnings (Annual) Card Example Segundo Cuadrito-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Sales</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">650</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
                      <span>Since last years</span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-shopping-cart fa-2x text-success"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
                                                                  <!-- New User Card Example Tercer Cuadrito-->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">New User</div>
                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">366</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                      <span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 20.4%</span>
                      <span>Since last month</span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-users fa-2x text-info"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
                                                                <!-- Pending Requests Card Example Cuarto Cuadrito -->
          <div class="col-xl-3 col-md-6 mb-4">
            <div class="card h-100">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-uppercase mb-1">Pending Requests</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    <div class="mt-2 mb-0 text-muted text-xs">
                      <span class="text-danger mr-2"><i class="fas fa-arrow-down"></i> 1.10%</span>
                      <span>Since yesterday</span>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-comments fa-2x text-warning"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

                                                                  <!-- Area Chart Cuadro de Estadisticas -->
          <div class="col-xl-12 col-lg-7">
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
          </div>
      </div>

@endsection

