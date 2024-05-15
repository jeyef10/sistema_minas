@extends('layouts.index')

<title>@yield('title') Registrar Mineral</title>
<script src="{{ asset('js/validaciones.js') }}"></script>
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@11')}}"></script>

@section('contenido')

    <div class="container-fluid" id="container-wrapper">
        <div class="d-sm-flex align-items-center justify-content-between mb-4"></div>
            <div class="col-lg-12">
                <div class="card mb-4">

                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    
                    <h2 class="font-weight-bold text-primary" style="margin-left: 44%;">Registrar Mineral</h2>
    
                    </div>
                

                    <form method="post" action="{{ route('mineral.store') }}" enctype="multipart/form-data" onsubmit="return Mineral(this)">
                        @csrf
                            
                        <div class="card-body">
                            
                            <div class="row">
        
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Tipo</label>
                                    <select class="select2-single form-control" name="tipo" id="tipo">
                                        <option value="0" disabled>Seleccione una Mineral</option>
                                        <option value="No metálicos" selected="true">No metálicos</option>
                                        <{{-- option value="Metálicos">Metálicos</option> --}}
                                    </select>
                                </div>
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Nombre</label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" style="background: white;" value="" placeholder="Ingrese el nombre" autocomplete="off" onkeypress="return soloLetras(event);">
                                </div>
                                <div class="col-4">
                                    <label  class="font-weight-bold text-primary">Categoria</label>
                                    <select class="select2-single form-control" name="categoria" id="categoria">
                                        <option value="" selected="true" disabled>Seleccione una Mineral</option>
                                        <option value="Aprovechamiento">Aprovechamiento</option>
                                        <option value="Procesamiento">Procesamiento</option>
                                    </select>
                                </div>
                                
                            </div>

                        </div>

                            <br>

                            <center>
                                <button type="submit" class="btn btn-success btn-lg"><span class="icon text-white-60"><i class="fas fa-check"></i></span>
                                <span class="text">Guardar</span>
                                </button>
                                <a  class="btn btn-info btn-lg" href="{{ url('mineral/') }}"><span class="icon text-white-50">
                                    <i class="fas fa-info-circle"></i>
                                </span>
                                <span class="text">Regresar</span></a>
                            </center>
                    </form>
                </div>
            </div>    
    </div>  
   
    @if ($errors->any())
    <script>
        var errorMessage = @json($errors->first());
        Swal.fire({
                    title: 'Mineral',
                    text: " Este Mineral Ya Existe.",
                    icon: 'warning',
                    showconfirmButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: '¡OK!',
                    
                    }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
                })
    </script>
@endif
@endsection