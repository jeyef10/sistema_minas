@extends('layouts.index')

<title>@yield('title') Ver Los Recaudos</title>

@section('css-datatable')
        <link href="{{ asset ('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
        <script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>
@endsection

@section('contenido')

    <h1>Recaudos para la solicitud #{{ $solicitud->id }}</h1>

    <ul>
        @foreach ($recaudos as $recaudo)
            <li>{{ $recaudo->nombre }}</li>
        @endforeach
    </ul>
@endsection
