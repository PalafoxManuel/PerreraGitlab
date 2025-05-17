@extends('layouts.app')

@section('title', 'Agregar Vacuna')

@section('content')
<div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">
        <h1 class="text-center mb-4 fw-bold">Agregar Vacuna</h1>

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

        <form method="POST" action="{{ route('vacunas.store') }}">
            @csrf
            <div class="row">
                {{-- Nombre de la Vacuna --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Nombre" class="form-field-label">Nombre de la Vacuna</label>
                        <input type="text" name="Nombre" id="Nombre" class="form-field-input" value="{{ old('Nombre') }}" required>
                    </div>
                </div>

                {{-- Fabricante --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Fabricante" class="form-field-label">Fabricante</label>
                        <input type="text" name="Fabricante" id="Fabricante" class="form-field-input" value="{{ old('Fabricante') }}" required>
                    </div>
                </div>

                {{-- Tipo de Mascota --}}
                <div class="col-md-6 mb-3">
                    <div class="form-field">
                        <label for="Id_TipoMascota" class="form-field-label">Tipo de Mascota</label>
                        <select name="Id_TipoMascota" id="Id_TipoMascota" class="form-field-select" required>
                            <option value="">Seleccione...</option>
                            <option value="1" {{ old('Id_TipoMascota') == 1 ? 'selected' : '' }}>Perro</option>
                            <option value="2" {{ old('Id_TipoMascota') == 2 ? 'selected' : '' }}>Gato</option>
                            <option value="3" {{ old('Id_TipoMascota') == 3 ? 'selected' : '' }}>Pajaro</option>
                        </select>
                    </div>
                </div>

                {{-- Síntomas Adversos --}}
                <div class="col-md-12 mb-3">
                    <div class="form-field">
                        <label for="Sintomas_Adversos" class="form-field-label">Síntomas Adversos</label>
                        <textarea name="Sintomas_Adversos" id="Sintomas_Adversos" class="form-field-textarea" rows="3" required>{{ old('Sintomas_Adversos') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="modal-buttons mt-4 d-flex justify-content-between">
                <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
                <button type="submit" class="submit-button btn btn-primary">Guardar Vacuna</button>
            </div>
        </form>
    </div>
</div>
@endsection