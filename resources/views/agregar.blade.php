<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registrar Mascota</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    <!-- Vite para estilos/scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="back-container d-flex flex-column min-vh-100">

    {{-- Header --}}
    @include('Components.Header')

    <div class="form-wrapper-formField flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="form-container-formField text-white p-4 p-md-5 rounded-4 shadow-lg">
            <h1 class="text-center mb-5 fw-bold">Registrar Mascota</h1>

            {{-- Errores --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <strong>¡Error!</strong> Por favor corrige los siguientes campos:
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
                            <input type="text" name="Nombre" id="Nombre" class="form-field-input" value="{{ old('Nombre') }}" required>
                        </div>

                        <div class="form-field">
                            <label for="Id_TipoMascota" class="form-field-label">Tipo de Mascota</label>
                            <select name="Id_TipoMascota" id="Id_TipoMascota" class="form-field-select" required>
                                <option value="">Seleccione...</option>
                                @foreach ($tipos as $tipo)
                                <option value="{{ $tipo->Id_TipoMascota }}" {{ old('Id_TipoMascota') == $tipo->Id_TipoMascota ? 'selected' : '' }}>
                                    {{ $tipo->Nombre_Tipo }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="Raza" class="form-field-label">Raza</label>
                            <input type="text" name="Raza" id="Raza" class="form-field-input" value="{{ old('Raza') }}">
                        </div>

                        <div class="form-field">
                            <label for="Edad" class="form-field-label">Edad</label>
                            <input type="number" name="Edad" id="Edad" class="form-field-input" min="0" value="{{ old('Edad') }}">
                        </div>

                        <div class="form-field">
                            <label for="Color" class="form-field-label">Color</label>
                            <input type="text" name="Color" id="Color" class="form-field-input" value="{{ old('Color') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-field">
                            <label for="Genero" class="form-field-label">Género</label>
                            <select name="Genero" class="form-select">
                                <option value="">Seleccione</option>
                                <option value="M" {{ old('Genero') === 'M' ? 'selected' : '' }}>Macho</option>
                                <option value="H" {{ old('Genero') === 'H' ? 'selected' : '' }}>Hembra</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label for="Peso" class="form-field-label">Peso (kg)</label>
                            <input type="number" step="0.1" name="Peso" id="Peso" class="form-field-input" min="0" value="{{ old('Peso') }}">
                        </div>

                        <div class="form-field">
                            <label for="Historial_Medico" class="form-field-label">Historial Médico</label>
                            <textarea name="Historial_Medico" id="Historial_Medico" class="form-field-textarea" rows="3">{{ old('Historial_Medico') }}</textarea>
                        </div>

                        <div class="form-field">
                            <label class="form-field-label d-block mb-1">¿Rescatado de la calle?</label>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="RescatadoCalle" id="rescatado_si" value="1" class="form-check-input" {{ old('RescatadoCalle') == '1' ? 'checked' : '' }}>
                                <label for="rescatado_si" class="form-check-label">Sí</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="RescatadoCalle" id="rescatado_no" value="0" class="form-check-input" {{ old('RescatadoCalle') == '0' ? 'checked' : '' }}>
                                <label for="rescatado_no" class="form-check-label">No</label>
                            </div>
                        </div>

                        <div class="form-field">
                            <label for="Id_Usuario" class="form-field-label">Usuario</label>

                            @if(session('perfil') === 'admin')
                                {{-- Admin puede elegir cualquier usuario --}}
                                <select name="Id_Usuario" id="Id_Usuario" class="form-field-select">
                                    <option value="">Seleccione...</option>
                                    @foreach ($usuarios as $usuario)
                                        <option value="{{ $usuario->Id_Usuario }}"
                                            {{ old('Id_Usuario') == $usuario->Id_Usuario ? 'selected' : '' }}>
                                            {{ $usuario->Nombre_Usuario }}
                                        </option>
                                    @endforeach
                                </select>
                            @else
                                {{-- Usuario normal: solo su nombre, no puede cambiarlo --}}
                                <input type="text"
                                       class="form-field-input"
                                       value="{{ session('usuario_nombre') }}"
                                       readonly>
                                <input type="hidden"
                                       name="Id_Usuario"
                                       value="{{ session('usuario_id') }}">
                            @endif
                        </div>
                    </div>
                </div>

                <div class="modal-buttons mt-4 text-center">
                    <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
                    <button type="submit" class="submit-button btn btn-primary ms-2">Guardar Mascota</button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
