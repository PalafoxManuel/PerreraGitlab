<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Estilos y scripts con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="back-container d-flex flex-column min-vh-100">

    <div class="logo-container text-center py-3">
        <img class="logo-img" src="{{ Vite::asset('resources/images/Logo.png') }}" alt="Logo">
        <p class="logo-text-login text-white fs-4 fw-bold">Huellitas Felices</p>
    </div>

    <div class="form-wrapper-LogIn flex-grow-1 d-flex">
        <div class="form-container bg-dark text-white p-4 rounded shadow mx-auto">
            <h1 class="text-center mb-4">¡Bienvenido!</h1>

            @if ($errors->has('login'))
            <div class="alert alert-danger text-center">{{ $errors->first('login') }}</div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="Nombre_Usuario" class="form-control"
                            placeholder="Usuario" value="{{ old('Nombre_Usuario') }}" required>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="Contrasena" class="form-control"
                            placeholder="Contraseña" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>

                <p class="text-center mt-3">¿No tienes cuenta?
                    <a href="register" class="text-primary">¡Crea una ahora!</a>
                </p>

                <a href="{{ route('home') }}" class="btn btn-secondary w-100 mt-2">Login Admin</a>
            </form>
        </div>
    </div>

</body>

</html>