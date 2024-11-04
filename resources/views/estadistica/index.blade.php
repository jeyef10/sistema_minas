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
                        
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Recepciones realizado por mes </h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart"></canvas>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Inspecciones Aprobadas y Pendientes por mes</h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myHorizontalBarChart"></canvas>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card shadow mb-4">

                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                                    <h6 class="m-0 font-weight-bold text-primary">Licencias por Municipios</h6>
                                </div>

                                <div class="card-body">
                                    <div class="chart-bar">
                                        <canvas id="myBarChart1"></canvas>
                                    </div>
                                </div>
                                
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    {{-- <script src="{{ asset ('https://cdn.jsdelivr.net/npm/chart.js')  }}"></script> --}}

    {{-- ? FUNCIÓN PARA MOSTRAR LAS RECEPCIONES POR MES --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() { 
            var ctx = document.getElementById("myBarChart").getContext('2d');
            var data = @json($data_recepcion); 

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 10,
                            right: 25,
                            top: 25,
                            bottom: 0
                        }
                    },
                    scales: {
                        xAxes: [{
                            time: {
                                unit: 'month'
                            },
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 12
                            },
                            maxBarThickness: 25,
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 10, // Ajusta el máximo valor en el eje y para que la barra sea proporcional
                                stepSize: 1, // Ajusta el tamaño del paso para que las marcas incrementen de 1 en 1
                                padding: 10,
                                callback: function(value) {
                                    return value; // Mostrar los valores tal cual sin ningún símbolo extra
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }],
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 1,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + tooltipItem.yLabel; // Mostrar solo el número
                            }
                        }
                    }
                }
            }); 
        });
    </script>

    {{--! FUNCIÓN PARA MOSTRAR LAS LICENCIAS POR MUNICIPIOS  --}}

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("myBarChart1").getContext('2d');
            var licenciasData = @json($data);
            var labels = licenciasData.map(function(licencia) {
                return licencia.municipio;
            });
            var data = licenciasData.map(function(licencia) {
                return licencia.total_licencias;
            });

            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Número de Licencias',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 3
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    layout: {
                        padding: {
                            left: 20,  // Aumenta el espacio de padding izquierdo
                            right: 25,
                            top: 25,
                            bottom: 20  // Aumenta el espacio de padding inferior
                        }
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                                drawBorder: false
                            },
                            ticks: {
                                maxTicksLimit: 14 // Asegura que se muestren todas las categorías
                            },
                            maxBarThickness: 25,
                            barPercentage: 0.6, // Reduce el porcentaje de la barra para añadir espacio entre las barras
                            categoryPercentage: 0.4 // Reduce el porcentaje de la categoría para añadir más espacio
                        }],
                        yAxes: [{
                            ticks: {
                                min: 0,
                                max: 10, // Ajusta el valor máximo en el eje y para que sea 10
                                stepSize: 2, // Aumenta el tamaño del paso a 2 para más espacio entre las líneas
                                padding: 10,
                                callback: function(value) {
                                    return value;
                                }
                            },
                            gridLines: {
                                color: "rgb(234, 236, 244)",
                                zeroLineColor: "rgb(234, 236, 244)",
                                drawBorder: false,
                                borderDash: [2],
                                zeroLineBorderDash: [2]
                            }
                        }]
                    },
                    legend: {
                        display: false
                    },
                    tooltips: {
                        titleMarginBottom: 10,
                        titleFontColor: '#6e707e',
                        titleFontSize: 14,
                        backgroundColor: "rgb(255,255,255)",
                        bodyFontColor: "#858796",
                        borderColor: '#dddfeb',
                        borderWidth: 3,
                        xPadding: 15,
                        yPadding: 15,
                        displayColors: false,
                        caretPadding: 10,
                        callbacks: {
                            label: function(tooltipItem, chart) {
                                var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                                return datasetLabel + ': ' + tooltipItem.yLabel;
                            }
                        }
                    }
                }
            });
        });
    </script>

    {{-- * FUNCION PARA MOSTRAR LAS INSPECCIONES CON EL ESTATUS APROBADAS Y PENDIENTES POR MES --}}

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById("myHorizontalBarChart").getContext('2d');
        var data = @json($data_inspecciones);

        var myHorizontalBarChart = new Chart(ctx, {
            type: 'horizontalBar',
            data: {
                labels: data.labels,
                datasets: data.datasets
            },
            options: {
                responsive: true,
                maintainAspectRatio: false, // Permitir ajuste del tamaño
                legend: {
                    position: 'top'
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            beginAtZero: true,
                            max: Math.max(...data.datasets.flatMap(dataset => dataset.data)) + 9 // Ajustar el máximo dinámicamente
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem, data) {
                            var label = data.labels[tooltipItem.index] || '';
                            var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                            return label + ': ' + value;
                        }
                    }
                }
            }
        });
    });
</script>


@endsection 

