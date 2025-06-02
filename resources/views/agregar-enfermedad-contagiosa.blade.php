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

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
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
                    <select name="id_enfermedad" id="id_enfermedad" class="form-field-select" required>
                        <option value="">— Selecciona —</option>
                        @foreach($enfermedades as $enfermedad)
                            <option value="{{ $enfermedad->id_enfermedad }}" {{ old('id_enfermedad') == $enfermedad->id_enfermedad ? 'selected' : '' }}>
                                {{ $enfermedad->nombre }} {{ $enfermedad->es_contagiosa ? '(Contagiosa)' : '' }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 form-field">
                    <label for="fecha_diagnostico" class="form-field-label">Fecha de diagnóstico *</label>
                    <input type="date" name="fecha_diagnostico" id="fecha_diagnostico" class="form-field-input" required
                        min="2000-01-01" max="{{ date('Y-m-d') }}" value="{{ old('fecha_diagnostico', date('Y-m-d')) }}">
                </div>

                <div class="mb-3 form-field">
                    <label for="observaciones" class="form-field-label">Observaciones</label>
                    <textarea name="observaciones" id="observaciones" class="form-field-textarea"
                        rows="3">{{ old('observaciones') }}</textarea>
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