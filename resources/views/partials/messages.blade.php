<!-- Login o Inicio de Sesion -->

@if(isset ($errors) && count($errors) > 0)
    <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-question-diamond-fill me-2"></i>
            <ul class="list-unstyled mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
@endif

<!-- Registro de Usuario -->

@if(Session::get('success', false))
    <?php $data = Session::get('success'); ?>
    @if (is_array($data))
        @foreach ($data as $msg)
            <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
                <i class="fa fa-check me-2"></i>
                {{ $msg }}
                <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
            </div>
        @endforeach
    @else
        <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
            <i class="fa fa-check me-2"></i>
            {{ $data }}
            <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
        </div>
    @endif
@endif

<!-- Credenciales del Usuario (Perfil) -->

@if ( session('updateClave') )
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="fa fa-check me-2"></i>
        <strong>{{ session('updateClave') }}</strong>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
@endif


@if ( session('name') )
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="fa fa-check me-2"></i>
        <strong>{{ session('name') }} </strong>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
@endif


@if ( session('claveIncorrecta') )
  <div class="alert alert-danger d-flex align-items-center alert-dismissible fade show" role="alert">
    <i class="bi bi-exclamation-triangle-fill me-2"></i>
    <strong>{{ session('claveIncorrecta') }}</strong>
    <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>    
  </div>
@endif


@if ( session('clavemenor') )
    <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-question-diamond-fill me-2"></i>
        <strong>{{ session('clavemenor') }}</strong>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ( session('message') )
    <div class="alert alert-warning d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="bi bi-question-diamond-fill me-2"></i>
        <strong>{{ session('message') }}</strong>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
@endif

@if ( session('validado') )
    <div class="alert alert-success d-flex align-items-center alert-dismissible fade show" role="alert">
        <i class="fa fa-check me-2"></i>
        <strong>{{ session('validado') }} </strong>
        <button type="button" class="btn-close" aria-label="Close" data-bs-dismiss="alert"></button>
    </div>
@endif