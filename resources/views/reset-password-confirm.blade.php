<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Restablecer Contraseña</title>
</head>
<body>

    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    @endif
    
    <form method="POST" action="{{ route('password.update', ['token' => $token]) }}">
        @csrf
        <input type="email" name="email" value="{{ $email }}">
        <input type="text" name="token" placeholder="Ingresa el Código" value="">
        <input type="password" name="password">
        <input type="password" name="password_confirmation">
        <input type="submit" value="Reset Password">
    </form>

</body>
</html>