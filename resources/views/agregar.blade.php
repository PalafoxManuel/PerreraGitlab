<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Agregar Mascota</title>
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
        <div class="form-container bg-dark text-white p-4 rounded shadow mx-auto" style="max-width: 700px; width: 100%;">
            <h1 class="text-center mb-4">Registrar Mascota</h1>

            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('mascotas.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" name="Nombre" id="Nombre" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="Id_TipoMascota" class="form-label">Tipo de Mascota</label>
                    <select name="Id_TipoMascota" id="Id_TipoMascota" class="form-select" required>
                        <option value="">Seleccione...</option>
                        @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->Id_TipoMascota }}">{{ $tipo->Nombre_Tipo }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Raza" class="form-label">Raza</label>
                    <input type="text" name="Raza" id="Raza" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="Edad" class="form-label">Edad</label>
                    <input type="number" name="Edad" id="Edad" class="form-control" min="0">
                </div>

                <div class="mb-3">
                    <label for="Genero" class="form-label">Género</label>
                    <select name="Genero" id="Genero" class="form-select">
                        <option value="">Seleccione...</option>
                        <option value="M">Macho</option>
                        <option value="H">Hembra</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="Color" class="form-label">Color</label>
                    <input type="text" name="Color" id="Color" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="Peso" class="form-label">Peso (kg)</label>
                    <input type="number" step="0.1" name="Peso" id="Peso" class="form-control" min="0">
                </div>

                <div class="mb-3">
                    <label for="Historial_Medico" class="form-label">Historial Médico</label>
                    <textarea name="Historial_Medico" id="Historial_Medico" class="form-control" rows="3"></textarea>
                </div>

                <div class="mb-3 form-check">
                    <input type="checkbox" name="RescatadoCalle" id="RescatadoCalle" class="form-check-input" value="1">
                    <label for="RescatadoCalle" class="form-check-label">¿Rescatado de la calle?</label>
                </div>

                <div class="mb-3">
                    <label for="Id_Usuario" class="form-label">Usuario</label>
                    <select name="Id_Usuario" id="Id_Usuario" class="form-select">
                        <option value="">Seleccione...</option>
                        @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->Id_Usuario }}">{{ $usuario->Nombre_Usuario }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('mascotas.index') }}" class="btn btn-secondary">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Guardar Mascota</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>