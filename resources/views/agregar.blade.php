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

        <form method="POST" action="{{ route('mascotas.store') }}">
            @csrf

            <div class="row">
                {{-- Fila 1 --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Nombre" class="form-field-label">Nombre</label>
                        <input type="text" name="Nombre" id="Nombre" class="form-field-input"
                            value="{{ old('Nombre') }}"
                            pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ]{2,30}$"
                            title="Solo letras, mínimo 2 y máximo 30 caracteres"
                            required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Genero" class="form-field-label">Género</label>
                        <select name="Genero" id="Genero" class="form-field-select" required>
                            <option value="">Seleccione</option>
                            <option value="M" {{ old('Genero') === 'M' ? 'selected' : '' }}>Macho</option>
                            <option value="H" {{ old('Genero') === 'H' ? 'selected' : '' }}>Hembra</option>
                        </select>
                    </div>
                </div>

                {{-- Fila 2 --}}
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
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Peso" class="form-field-label">Peso (kg)</label>
                        <input type="number" step="0.1" name="Peso" id="Peso" class="form-field-input"
                            min="0.1" max="120" title="Debe ser mayor a 0 y menor o igual a 120"
                            value="{{ old('Peso') }}" required>
                    </div>
                </div>

                {{-- Fila 3 --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Raza" class="form-field-label">Raza</label>
                        <input type="text" name="Raza" id="Raza" class="form-field-input"
                            pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ ]{2,30}$"
                            title="Solo letras y espacios, entre 2 y 30 caracteres"
                            value="{{ old('Raza') }}" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Historial_Medico" class="form-field-label">Historial Médico</label>
                        <textarea name="Historial_Medico" id="Historial_Medico" class="form-field-textarea"
                            rows="3" maxlength="255"
                            placeholder="Describa brevemente el estado médico">{{ old('Historial_Medico') }}</textarea>
                    </div>
                </div>

                {{-- Fila 4 --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Edad" class="form-field-label">Edad</label>
                        <input type="number" name="Edad" id="Edad" class="form-field-input"
                            min="0" max="30" title="Máximo 30 años"
                            value="{{ old('Edad') }}" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label class="form-field-label d-block mb-1">¿Rescatado de la calle?</label>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="RescatadoCalle" id="rescatado_si" value="1"
                                class="form-check-input" {{ old('RescatadoCalle') == '1' ? 'checked' : '' }} required>
                            <label for="rescatado_si" class="form-check-label">Sí</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" name="RescatadoCalle" id="rescatado_no" value="0"
                                class="form-check-input" {{ old('RescatadoCalle') == '0' ? 'checked' : '' }} required>
                            <label for="rescatado_no" class="form-check-label">No</label>
                        </div>
                    </div>
                </div>

                {{-- Fila 5 --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Color" class="form-field-label">Color</label>
                        <input type="text" name="Color" id="Color" class="form-field-input"
                            pattern="^[A-Za-zÁÉÍÓÚáéíóúÑñ ]{2,20}$"
                            title="Solo letras y espacios, entre 2 y 20 caracteres"
                            value="{{ old('Color') }}" required>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Id_Usuario" class="form-field-label">Usuario</label>
                        @if(session('perfil') === 'admin')
                        <select name="Id_Usuario" id="Id_Usuario" class="form-field-select" required>
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
            </div>

            {{-- Fila esterilización --}}
            <div class="row mb-3">
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

            <div class="modal-buttons mt-4 d-flex justify-content-between">
                <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
                <button type="submit" class="submit-button btn btn-primary">Guardar Mascota</button>
            </div>
        </form>
    </div>
</div>
@endsection