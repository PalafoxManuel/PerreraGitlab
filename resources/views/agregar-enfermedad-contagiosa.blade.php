@extends('layouts.app')

@section('title', 'Registrar Enfermedad Contagiosa')

@section('content')
<div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">
        <h2 class="text-center mb-4 fw-bold">Registrar Enfermedad a Mascota</h2>

        @if($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Por favor corrige los siguientes campos:
            <ul class="mb-0">
                @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('enfermedades_contagiosas.store') }}" method="POST">
            @csrf

            <div class="mb-3 form-field">
                <label for="Id_Mascota" class="form-field-label">Mascota *</label>
                <select name="Id_Mascota" id="Id_Mascota" class="form-field-select" required>
                    <option value="">— Selecciona —</option>
                    @foreach($mascota as $m)
                    <option value="{{ $m->Id_Mascota }}" {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected' : '' }}>
                        {{ $m->Nombre }} ({{ $m->Raza }})
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 form-field">
                <label for="id_enfermedad" class="form-field-label">Tipo de enfermedad *</label>
                <select name="id_enfermedad" id="id_enfermedad" class="form-field-select">
                    @foreach($enfermedades as $enfermedad)
                    <option value="{{ $enfermedad->id_enfermedad }}">
                        {{ $enfermedad->nombre }}
                    </option>
                    @endforeach
                </select>
            </div>

            <div class="modal-buttons mt-4 d-flex justify-content-between">
                <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
                <button type="submit" class="submit-button btn btn-success">
                    <i class="fas fa-plus-circle me-2"></i>Registrar
                </button>
            </div>

        </form>
    </div>
</div>
@endsection