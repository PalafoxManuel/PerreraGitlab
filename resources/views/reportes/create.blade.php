@extends('layouts.app')

@section('title', 'Registrar Mascota')

@section('content')
<div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">
        <h1 class="text-center mb-4 fw-bold">Registrar Mascota</h1>

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

        <form method="POST" action="{{ route('mascotas.store') }}" id="mascotaForm">
            @csrf

            <div class="row">
                {{-- Nombre --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Nombre" class="form-field-label">Nombre</label>
                        <input type="text" name="Nombre" id="Nombre" class="form-field-input"
                            value="{{ old('Nombre') }}" required>
                    </div>
                </div>

                {{-- Género --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Genero" class="form-field-label">Género</label>
                        <select name="Genero" id="Genero" class="form-field-select">
                            <option value="">Seleccione</option>
                            <option value="M" {{ old('Genero') === 'M' ? 'selected' : '' }}>Macho</option>
                            <option value="H" {{ old('Genero') === 'H' ? 'selected' : '' }}>Hembra</option>
                        </select>
                    </div>
                </div>

                {{-- Tipo de Mascota --}}
                <div class="col-md-6 mb-3">
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
                </div>

                {{-- Peso --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Peso" class="form-field-label">Peso (kg)</label>
                        <input type="number" step="0.1" name="Peso" id="Peso" class="form-field-input"
                            min="0" value="{{ old('Peso') }}">
                    </div>
                </div>

                {{-- Raza --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Raza" class="form-field-label">Raza</label>
                        <input type="text" name="Raza" id="Raza" class="form-field-input" value="{{ old('Raza') }}">
                    </div>
                </div>

                {{-- Historial Médico --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Historial_Medico" class="form-field-label">Historial Médico</label>
                        <textarea name="Historial_Medico" id="Historial_Medico" class="form-field-textarea" rows="3">{{ old('Historial_Medico') }}</textarea>
                    </div>
                </div>

                {{-- Edad --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Edad" class="form-field-label">Edad</label>
                        <input type="number" name="Edad" id="Edad" class="form-field-input" min="0"
                            value="{{ old('Edad') }}">
                    </div>
                </div>

                {{-- Rescatado de la calle --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label class="form-field-label d-block mb-1">¿Rescatado de la calle?</label>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="RescatadoCalle" id="rescatado_si" value="1"
                                class="form-check-input" {{ old('RescatadoCalle') == '1' ? 'checked' : '' }}>
                            <label for="rescatado_si" class="form-check-label">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="RescatadoCalle" id="rescatado_no" value="0"
                                class="form-check-input" {{ old('RescatadoCalle') == '0' ? 'checked' : '' }}>
                            <label for="rescatado_no" class="form-check-label">No</label>
                        </div>
                    </div>
                </div>

                {{-- Color --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Color" class="form-field-label">Color</label>
                        <input type="text" name="Color" id="Color" class="form-field-input" value="{{ old('Color') }}">
                    </div>
                </div>

                {{-- Usuario --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Id_Usuario" class="form-field-label">Usuario</label>
                        @if(session('perfil') === 'admin')
                        <select name="Id_Usuario" id="Id_Usuario" class="form-field-select">
                            <option value="">Seleccione...</option>
                            @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->Id_Usuario }}" {{ old('Id_Usuario') == $usuario->Id_Usuario ? 'selected' : '' }}>
                                {{ $usuario->Nombre_Usuario }}
                            </option>
                            @endforeach
                        </select>
                        @else
                        <input type="text" class="form-field-input" value="{{ session('usuario_nombre') }}" readonly>
                        <input type="hidden" name="Id_Usuario" value="{{ session('usuario_id') }}">
                        @endif
                    </div>
                </div>

                {{-- Esterilización --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label class="form-field-label d-block mb-1">¿Esterilización?</label>
                        <div class="form-check form-check-inline">
                            <input type="checkbox" name="Esterilizacion" id="Esterilizacion" class="form-check-input"
                                value="1" {{ old('Esterilizacion') ? 'checked' : '' }}>
                            <label for="Esterilizacion" class="form-check-label">Sí</label>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Botones --}}
            <div class="modal-buttons mt-4 d-flex justify-content-between">
                <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
                <button type="submit" class="submit-button btn btn-primary">Guardar Mascota</button>
            </div>
        </form>
    </div>
</div>

{{-- Validación con JS --}}
<script>
    document.getElementById('mascotaForm').addEventListener('submit', function(e) {
        const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ]+$/;
        const nombre = document.getElementById('Nombre').value.trim();
        const raza = document.getElementById('Raza').value.trim();
        const color = document.getElementById('Color').value.trim();
        const peso = parseFloat(document.getElementById('Peso').value);
        const edad = parseInt(document.getElementById('Edad').value);
        const tipo = document.getElementById('Id_TipoMascota').value;

        if (!regexNombre.test(nombre)) {
            alert('El nombre debe contener solo letras, sin espacios ni caracteres especiales.');
            e.preventDefault();
            return;
        }

        if (!regexNombre.test(raza)) {
            alert('La raza debe contener solo letras, sin espacios ni caracteres especiales.');
            e.preventDefault();
            return;
        }

        if (!regexNombre.test(color)) {
            alert('El color debe contener solo letras, sin espacios ni caracteres especiales.');
            e.preventDefault();
            return;
        }

        if (isNaN(peso) || peso <= 0 || peso >= 120) {
            alert('El peso debe ser mayor a 0 y menor a 120 kg.');
            e.preventDefault();
            return;
        }

        let edadMaxima = 100;
        if (tipo == 1) edadMaxima = 25; // Perro
        else if (tipo == 2) edadMaxima = 30; // Gato
        else if (tipo == 3) edadMaxima = 80; // Pájaro

        if (isNaN(edad) || edad < 0 || edad > edadMaxima) {
            alert(`La edad debe ser válida y no mayor a ${edadMaxima} años para este tipo de mascota.`);
            e.preventDefault();
        }
    });
</script>
@endsection