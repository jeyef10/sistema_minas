@extends('layouts.index')

<title>@yield('title') Estadistíca</title>

@section('css-datatable')
        <link href="{{ asset ('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <link href="{{ asset ('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset ('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset ('css/ruang-admin.min.css') }}" rel="stylesheet">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endsection

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h2 class="font-weight-bold text-primary">Estadísticas</h2>      
                    </div>

                    <div class="row">
                        
                        <!-- Bar Chart -->
                        <div class="col-lg-8">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Recepciones realizado por mes </h6>
                            </div>
                            <div class="card-body">
                            <div class="chart-bar">
                                <canvas id="myBarChart"></canvas>
                            </div>
                            </div>
                        </div>
                        </div>
                        
                        <div class="col-lg-4">
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                            </div>
                            <div class="card-body">
                            <div class="chart-pie pt-4">
                                <canvas id="myPieChart"></canvas>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div> 

@endsection 



   


