<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro</title>
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
            <h1 class="text-center mb-4">Registro de Usuario</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                {{-- Nombre de usuario --}}
                <div class="mb-3">
                    <label>Nombre de Usuario *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text"
                            name="Nombre_Usuario"
                            class="form-control"
                            placeholder="Nombre de usuario"
                            value="{{ old('Nombre_Usuario') }}"
                            required>
                    </div>
                </div>

                {{-- Contraseña --}}
                <div class="mb-3">
                    <label>Contraseña *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password"
                            name="Contrasena"
                            class="form-control"
                            placeholder="Contraseña"
                            required>
                    </div>
                </div>

                {{-- Confirmar contraseña --}}
                <div class="mb-3">
                    <label>Confirmar Contraseña *</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password"
                            name="Contrasena_confirmation"
                            class="form-control"
                            placeholder="Confirmar contraseña"
                            required>
                    </div>
                </div>

                {{-- Rol y perrera si es admin --}}
                @if(session('perfil') === 'admin')
                <div class="mb-3">
                    <label>Rol *</label>
                    <select name="rol" class="form-select" required>
                        <option value="usuario" {{ old('rol')=='usuario' ? 'selected':'' }}>Cliente</option>
                        <option value="admin" {{ old('rol')=='admin' ? 'selected':'' }}>Administrador</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label>Asignar Perrera</label>
                    <select name="Id_Perrera" class="form-select">
                        <option value="">— Ninguna —</option>
                        @foreach($perreras as $p)
                        <option value="{{ $p->Id_Perrera }}" {{ old('Id_Perrera')==$p->Id_Perrera ? 'selected':'' }}>
                            {{ $p->Nombre }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @else
                <input type="hidden" name="rol" value="usuario">
                <input type="hidden" name="Id_Perrera" value="">
                @endif

                <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>

                <p class="text-center mt-3">¿Ya tienes cuenta?
                    <a href="{{ route('login') }}" class="text-primary">Inicia sesión aquí</a>
                </p>
            </form>
        </div>
    </div>

</body>

</html>