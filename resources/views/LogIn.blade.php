<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="back-container">

    <div class="logo-container">
        <img class="logo-img" src="{{ Vite::asset('resources/images/Logo.png') }}" alt="Logo">
        <p class="logo-text-login">Patitas Felices</p>
    </div>

    <div class="form-wrapper-LogIn d-flex justify-content-center align-items-center">
        <div class="form-container bg-dark p-4 rounded">
            <h1 class="text-center text-white mb-4">¡Bienvenido!</h1>

            @if ($errors->has('login'))
            <div class="alert alert-danger text-center">{{ $errors->first('login') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="Nombre_Usuario" class="form-control"
                            placeholder="Usuario" value="{{ old('Nombre_Usuario') }}" required>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="Contrasena" class="form-control"
                            placeholder="Contraseña" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block w-100">Iniciar sesión</button>

                <p class="text-center mt-3 text-white">¿No tienes cuenta?
                    <a href="" class="text-primary">¡Crea una ahora!</a>
                </p>

                <a href="" class="btn btn-secondary btn-block w-100 mt-2">Login Admin</a>
            </form>
        </div>
    </div>

</body>

</html>