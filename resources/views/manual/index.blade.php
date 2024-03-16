@extends('layouts.index')

<title>@yield('title') Manuales</title>

@section('content')

    <div class="container-fluid" style="margin-top: 11%">
        <div class="p-3" style="background: rgb(255, 253, 253); border-radius: 20px;">
            <div class="d-flex align-items-center justify-content-between mb-2">
                
               
                <a href="{{ url('manual/manual_usuario.pdf') }}" class="btn btn-sm btn-danger" target="_blank">
                {{ ('Manaual de Usuario') }}
                </a>
                
                <h2 style="color: black;">Manuales</h2>
                
            </div>
        </div>
    </div>
@endsection