@extends('layouts.app')

@section('title', 'Registrar Peso de Mascota')

@section('content')
<div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">
        <h1 class="text-center mb-4 fw-bold">Registrar Peso de Mascota</h1>

        {{-- Errores --}}
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

        {{-- Mensajes de éxito o error --}}
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

        <form method="POST" action="{{ route('peso_mascota.store') }}">
            @csrf

            <div class="row">
                {{-- Mascota --}}
                <div class="col-md-12 mb-3">
                    <div class="form-field">
                        <label class="form-field-label" for="Id_Mascota">Mascota *</label>
                        <select name="Id_Mascota" id="Id_Mascota" class="form-field-select" required>
                            <option value="">— Selecciona una mascota —</option>
                            @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->Id_Mascota }}" {{ old('Id_Mascota') == $mascota->Id_Mascota ? 'selected' : '' }}>
                                {{ $mascota->Nombre }} ({{ $mascota->Raza }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Peso --}}
                <div class="col-md-12 mb-3">
                    <div class="form-field">
                        <label for="Peso" class="form-field-label">Peso (kg) *</label>
                        <div class="row">
                            <div class="col-auto">
                                <input type="number" step="0.1" min="0.1" max="200" name="Peso" id="Peso"
                                    class="form-field-input" value="{{ old('Peso') }}" required placeholder="Ej. 5.2"
                                    style="width: 150px;">
                            </div>
                            <div class="col-auto d-flex align-items-center" style="padding: 0;">
                                <span class="small-kg">kg</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Doctor --}}
                <div class="col-md-12 mb-3">
                    <div class="form-field">
                        <label for="Doctor" class="form-field-label">Veterinario/Responsable</label>
                        <input type="text" name="Doctor" id="Doctor" class="form-field-input"
                            value="{{ old('Doctor') }}" placeholder="Nombre del profesional">
                    </div>
                </div>

                {{-- Fecha --}}
                <div class="col-md-12 mb-3">
                    <div class="form-field">
                        <label for="Fecha" class="form-field-label">Fecha de registro *</label>
                        <input type="date" name="Fecha" id="Fecha" class="form-field-input"
                            value="{{ old('Fecha', date('Y-m-d')) }}" required>
                    </div>
                </div>
            </div>

            <div class="modal-buttons mt-4 d-flex justify-content-between">
                <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
                <button type="submit" class="submit-button btn btn-success">
                    <i class="fas fa-weight me-2"></i>Registrar Peso
                </button>
            </div>
        </form>
    </div>
</div>
@endsection