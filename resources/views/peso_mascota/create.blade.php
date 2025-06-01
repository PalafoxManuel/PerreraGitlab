{{-- resources/views/peso_mascota/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Registrar Peso de Mascota')

@section('content')
    <div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
        <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">
            <h2 class="text-center mb-4 fw-bold">Registrar Peso de Mascota</h2>

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

            <form action="{{ route('peso_mascota.store') }}" method="POST">
                @csrf

                <div class="mb-3 form-field">
                    <label for="Id_Mascota" class="form-field-label">Mascota *</label>
                    <select name="Id_Mascota" id="Id_Mascota" class="form-field-select" required>
                        <option value="">— Selecciona —</option>
                        @foreach($mascotas as $mascota)
                            <option value="{{ $mascota->Id_Mascota }}" {{ old('Id_Mascota') == $mascota->Id_Mascota ? 'selected' : '' }}>
                                {{ $mascota->Nombre }} ({{ $mascota->Raza }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 form-field">
                    <label for="Peso" class="form-field-label">Peso (kg) *</label>
                    <div class="input-group">
                        <input type="number" step="0.1" min="0.1" max="200" name="Peso" id="Peso" 
                               class="form-field-input" value="{{ old('Peso') }}" required 
                               placeholder="Ej. 5.2">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>

                <div class="mb-3 form-field">
                    <label for="Doctor" class="form-field-label">Veterinario/Responsable</label>
                    <input type="text" name="Doctor" id="Doctor" class="form-field-input" 
                           value="{{ old('Doctor') }}" placeholder="Nombre del profesional">
                </div>

                <div class="mb-3 form-field">
                    <label for="Fecha" class="form-field-label">Fecha de registro *</label>
                    <input type="date" name="Fecha" id="Fecha" class="form-field-input"
                           value="{{ old('Fecha', date('Y-m-d')) }}" required>
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

    <style>
        .form-wrapper-reporte {
            background-color: #f8f9fa;
        }
        .form-container-reporte {
            background-color: #2c3e50;
            width: 100%;
            max-width: 700px;
        }
        .form-field {
            margin-bottom: 1.5rem;
        }
        .form-field-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        .form-field-input, .form-field-select, .form-field-textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
            background-color: #fff;
            color: #495057;
        }
        .form-field-select {
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%23343a40' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M2 5l6 6 6-6'/%3e%3c/svg%3e");
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 16px 12px;
        }
        .form-field-textarea {
            min-height: 100px;
            resize: vertical;
        }
        .modal-buttons {
            margin-top: 2rem;
        }
        .cancel-button {
            padding: 0.5rem 1.5rem;
        }
        .submit-button {
            padding: 0.5rem 1.5rem;
        }
    </style>
@endsection