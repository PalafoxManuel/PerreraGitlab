<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
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

            <form id="loginForm" method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                        <input type="text" name="Nombre_Usuario" id="Nombre_Usuario" class="form-control"
                            placeholder="Usuario" value="{{ old('Nombre_Usuario') }}" required minlength="4"
                            maxlength="20" pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ]+$"
                            title="Solo letras sin espacios ni números.">
                    </div>
                    <div class="invalid-feedback" id="username-error">
                        Por favor ingrese un nombre de usuario válido (solo letras, sin espacios, 4-20 caracteres).
                    </div>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        <input type="password" name="Contrasena" id="Contrasena" class="form-control"
                            placeholder="Contraseña" required minlength="6" maxlength="30">
                    </div>
                    <div class="invalid-feedback" id="password-error">
                        La contraseña debe tener entre 6 y 30 caracteres.
                    </div>
                </div>

                <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>

                <p class="text-center mt-3">¿No tienes cuenta?
                    <a href="register" class="text-primary">¡Crea una ahora!</a>
                </p>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function (event) {
            let isValid = true;
            const username = document.getElementById('Nombre_Usuario');
            const password = document.getElementById('Contrasena');

            username.classList.remove('is-invalid');
            password.classList.remove('is-invalid');

            const usernameRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ]+$/;

            if (username.value.trim() === '' || username.value.length < 4 ||
                username.value.length > 20 || !usernameRegex.test(username.value)) {
                username.classList.add('is-invalid');
                document.getElementById('username-error').textContent =
                    username.value.trim() === '' ?
                        'El nombre de usuario es requerido.' :
                        (!usernameRegex.test(username.value) ?
                            'El nombre de usuario solo puede contener letras sin espacios ni números.' :
                            'El nombre de usuario debe tener entre 4 y 20 caracteres.');
                isValid = false;
            }

            if (password.value === '' || password.value.length < 6 || password.value.length > 30) {
                password.classList.add('is-invalid');
                document.getElementById('password-error').textContent =
                    password.value === '' ?
                        'La contraseña es requerida.' :
                        'La contraseña debe tener entre 6 y 30 caracteres.';
                isValid = false;
            }

            if (!isValid) {
                event.preventDefault();
                event.stopPropagation();
            }
        });

        document.getElementById('Nombre_Usuario').addEventListener('input', function () {
            const cleaned = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ]/g, '');
            if (this.value !== cleaned) {
                this.value = cleaned;
            }

            if (this.value.length >= 4 && this.value.length <= 20) {
                this.classList.remove('is-invalid');
            }
        });

        document.getElementById('Contrasena').addEventListener('input', function () {
            if (this.value.length >= 6 && this.value.length <= 30) {
                this.classList.remove('is-invalid');
            }
        });
    </script>
</body>

</html>