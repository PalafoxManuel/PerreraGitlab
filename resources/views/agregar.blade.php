<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Mascota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Estilos y scripts con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="back-container d-flex flex-column min-vh-100">

    {{-- Header --}}
    @include('Components.Header')

    <div class="form-wrapper-formField flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="form-container-formField text-white p-4 p-md-5 rounded-4 shadow-lg">
            <h1 class="text-center mb-5 fw-bold">Registrar Mascota</h1>

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

                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="form-field">
                            <label for="Nombre" class="form-field-label">Nombre</label>
                            <input type="text" name="Nombre" id="Nombre" class="form-field-input" required>
                        </div>

                        <div class="form-field">
                            <label for="Id_TipoMascota" class="form-field-label">Tipo de Mascota</label>
                            <select name="Id_TipoMascota" id="Id_TipoMascota" class="form-field-select" required>
                                <option value="">Seleccione...</option>
                                @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->Id_TipoMascota }}">{{ $tipo->Nombre_Tipo }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="Raza" class="form-field-label">Raza</label>
                            <input type="text" name="Raza" id="Raza" class="form-field-input">
                        </div>

                        <div class="form-field">
                            <label for="Edad" class="form-field-label">Edad</label>
                            <input type="number" name="Edad" id="Edad" class="form-field-input" min="0">
                        </div>

                        <div class="form-field">
                            <label for="Color" class="form-field-label">Color</label>
                            <input type="text" name="Color" id="Color" class="form-field-input">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-field">
                            <label for="Genero" class="form-field-label">Género</label>
                            <select name="Genero" id="Genero" class="form-field-select">
                                <option value="">Seleccione...</option>
                                <option value="M">Macho</option>
                                <option value="H">Hembra</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="Peso" class="form-field-label">Peso (kg)</label>
                            <input type="number" step="0.1" name="Peso" id="Peso" class="form-field-input" min="0">
                        </div>

                        <div class="form-field">
                            <label for="Historial_Medico" class="form-field-label">Historial Médico</label>
                            <textarea name="Historial_Medico" id="Historial_Medico" class="form-field-textarea" rows="3"></textarea>
                        </div>

                        <div class="form-field form-check d-flex align-items-center">
                            <input type="checkbox" name="RescatadoCalle" id="RescatadoCalle" class="form-check-input" value="1">
                            <label for="RescatadoCalle" class="form-check-label">¿Rescatado de la calle?</label>
                        </div>

                        <div class="form-field">
                            <label for="Id_Usuario" class="form-field-label">Usuario</label>
                            <select name="Id_Usuario" id="Id_Usuario" class="form-field-select">
                                <option value="">Seleccione...</option>
                                @foreach ($usuarios as $usuario)
                                <option value="{{ $usuario->Id_Usuario }}">{{ $usuario->Nombre_Usuario }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="modal-buttons mt-4">
                    <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
                    <button type="submit" class="submit-button btn btn-primary">Guardar Mascota</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>