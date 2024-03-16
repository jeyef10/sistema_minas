@extends('layouts.index')

<title>@yield('title') Estadistíca</title>

@section('content')

<div class="container continer-fluid">
    <div class="row">

        <div class="col-sm-6">
            
            <div class="card p-4 m-4">
            <div class="card-body">
                <h5 class="card-title text-dark">Equipos asignados por división</h5>
                
                <div class="bar-chart-vertical">
                    @php $total = $equipos_divisions->sum('cantidad'); @endphp
                    @foreach ($equipos_divisions as $equipo)
                        @php
                            $height = (! is_null($total)) ? $equipo->cantidad / $total: null ;
                            $height = 100 * round($height,2);
                        @endphp
                        <div class="item">
                            <div class="bar" style="height:{{$height}}%">
                                <div class="value text-white small">{{$height}}%</div>
                            </div>
                            <div class="title text-nowrap">{{$equipo->nombre_division}}</div> 
                        </div>
                    @endforeach

                </div>
                
            </div>
            </div>                      
            
        </div>

        <div class="col-sm-6">
            <div class="card p-4 m-4">
                <div class="card-body">
                    <h5 class="card-title text-dark">Equipos asignados por sede</h5>
                    
                    <div class="bar-chart-vertical">
                    @php $total = $equipos_sedes->sum('cantidad'); @endphp
                    @foreach ($equipos_sedes as $equipo)
                        @php
                            $height = (! is_null($total)) ? $equipo->cantidad / $total: null ;
                            $height = 100 * round($height,2);
                        @endphp
                        <div class="item">
                            <div class="bar bg-success" style="height:{{$height}}%">
                                <div class="value text-white small">{{$height}}%</div>
                            </div>
                            <div class="title text-nowrap">{{$equipo->nombre_sede}}</div> 
                        </div>
                    @endforeach  
                    </div>              
                </div>
            </div> 
        </div>
    </div>

    <div class="row">

        <div class="col-sm-4">
            <div class="card p-4 m-4">
                <div class="card-body">
                    <h5 class="card-title text-dark">Equipos por tipo de S.O.</h5>
                    
                    <div class="bar-chart-vertical">
                    @php $total = $equipos_so->sum('cantidad'); @endphp
                    @foreach ($equipos_so as $equipo)
                        @php
                            $height = (! is_null($total)) ? $equipo->cantidad / $total: null ;
                            $height = 100 * round($height,2);
                        @endphp
                        <div class="item">
                            <div class="bar bg-dark" style="height:{{$height}}%">
                                <div class="value text-white small">{{$height}}%</div>
                            </div>
                            <div class="title text-nowrap">{{$equipo->tipo}}</div> 
                        </div>
                    @endforeach  
                    </div>              
                </div>
            </div> 
        </div>
        
        <div class="col-sm-8">
            <div class="card p-4 m-4">
                <div class="card-body">
                    <h5 class="card-title text-dark">Equipos por división y tipo de Sistema Operativo</h5>
                    
                    <div class="bar-chart-vertical">
                    @php $total = $equipos_divisions_so->sum('cantidad'); @endphp
                    @foreach ($equipos_divisions_so as $equipo)
                        @php
                            $height = (! is_null($total)) ? $equipo->cantidad / $total: null ;
                            $height = 100 * round($height,2);
                        @endphp
                        <div class="item">
                            <div class="bar bg-secondary" style="height:{{$height}}%">
                                <div class="value text-white small">{{$height}}%</div>
                            </div>
                            <div class="title text-nowrap">{{$equipo->nombre_division}}<br>S.O. <strong>{{$equipo->tipo}}</strong></div> 
                        </div>
                    @endforeach  
                    </div>              
                </div>
            </div> 
        </div>

        
    </div>
  </div>

@endsection

@section('stylesheet')
    <style>
        .bar-chart-vertical {
        display: flex;
        justify-content: space-evenly;
        align-items: flex-end;
        height: 300px;
        }

        .bar {
        background: #007bff;
        width: 60px;
        display: flex;
        justify-content: center;
        align-items: flex-end;
        border-radius: 5px;
        }

        .title {
        font-weight: bold;
        font-size: 14px;
        text-align: center; 
        width: 60px;
        }

        .value {
        font-size: 14px;
        padding: 5px 0;
        }
    </style>

@endsection
    