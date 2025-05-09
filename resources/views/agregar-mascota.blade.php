<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Mascota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">

    {{-- Header (si tienes uno global puedes incluirlo aquí con @include) --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="#">Sistema Perrera</a>
            <a href="{{ route('home') }}" class="btn btn-light">← Regresar</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="mb-4">Agregar Nueva Mascota</h2>

        {{-- Errores de validación --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Error!</strong> Por favor corrige los siguientes campos:<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulario --}}
        <form action="{{ route('mascotas.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col">
                    <label for="Nombre" class="form-label">Nombre</label>
                    <input type="text" name="Nombre" class="form-control" value="{{ old('Nombre') }}" required>
                </div>
                <div class="col">
                    <label for="Raza" class="form-label">Raza</label>
                    <input type="text" name="Raza" class="form-control" value="{{ old('Raza') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="Edad" class="form-label">Edad</label>
                    <input type="number" name="Edad" class="form-control" value="{{ old('Edad') }}">
                </div>
                <div class="col">
                    <label for="Genero" class="form-label">Género</label>
                    <select name="Genero" class="form-select">
                        <option value="">Seleccione</option>
                        <option value="M" {{ old('Genero') == 'Macho' ? 'selected' : '' }}>Macho</option>
                        <option value="H" {{ old('Genero') == 'Hembra' ? 'selected' : '' }}>Hembra</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="Color" class="form-label">Color</label>
                    <input type="text" name="Color" class="form-control" value="{{ old('Color') }}">
                </div>
                <div class="col">
                    <label for="Peso" class="form-label">Peso (kg)</label>
                    <input type="number" step="0.01" name="Peso" class="form-control" value="{{ old('Peso') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="Historial_Medico" class="form-label">Historial Médico</label>
                <textarea name="Historial_Medico" class="form-control">{{ old('Historial_Medico') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="Id_Usuario" class="form-label">Usuario Responsable</label>
                <select name="Id_Usuario" class="form-select">
                    <option value="">Sin asignar</option>
                    @foreach ($usuarios as $usuario)
                        <option value="{{ $usuario->Id_Usuario }}" {{ old('Id_Usuario') == $usuario->Id_Usuario ? 'selected' : '' }}>
                            {{ $usuario->Nombre_Usuario }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">¿Rescatado de la calle?</label>
                <div>
                    <label><input type="radio" name="RescatadoCalle" value="1" {{ old('RescatadoCalle') == '1' ? 'checked' : '' }}> Sí</label>
                    <label class="ms-3"><input type="radio" name="RescatadoCalle" value="0" {{ old('RescatadoCalle') == '0' ? 'checked' : '' }}> No</label>
                </div>
            </div>

            <div class="mb-4">
                <label for="Id_TipoMascota" class="form-label">Tipo de Mascota</label>
                <select name="Id_TipoMascota" class="form-select" required>
                    <option value="">Seleccione un tipo</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->Id_TipoMascota }}" {{ old('Id_TipoMascota') == $tipo->Id_TipoMascota ? 'selected' : '' }}>
                            {{ $tipo->Nombre_Tipo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Guardar Mascota</button>
            <a href="{{ route('home') }}" class="btn btn-secondary ms-2">Cancelar</a>
        </form>
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
