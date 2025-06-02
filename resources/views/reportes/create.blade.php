@extends('layouts.app')

@section('title', 'Crear Reporte')

@section('content')
<div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">

        <h1 class="text-center mb-4 fw-bold">
            Crear Reporte: {{ $tipoSeleccionado->Nombre ?? 'Selecciona un tipo' }}
        </h1>

        {{-- Errores --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <strong>¡Error!</strong> Corrige los siguientes campos:
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('reporte.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Tipo de Reporte (oculto y visible) --}}
            <input type="hidden" name="Id_Tipo_Reporte" value="{{ $tipoSeleccionado->Id_Tipo_Reporte ?? '' }}">
            <div class="form-field mb-3">
                <label class="form-field-label">Tipo de Reporte</label>
                <input type="text" class="form-field-input" value="{{ $tipoSeleccionado->Nombre ?? '' }}" disabled>
            </div>

            {{-- Campos comunes --}}
            <div class="form-field mb-3">
                <label class="form-field-label">Mascota</label>
                <select name="Id_Mascota" class="form-field-select">
                    @foreach($mascotas as $mascota)
                    <option value="{{ $mascota->Id_Mascota }}">{{ $mascota->Nombre }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-field mb-3">
                <label class="form-field-label">Usuario</label>
                <select name="Id_Usuario" class="form-field-select">
                    @foreach($usuarios as $usuario)
                    <option value="{{ $usuario->Id_Usuario }}">{{ $usuario->Nombre_Usuario }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Campos dinámicos --}}
            @if($tipoSeleccionado && $tipoSeleccionado->Nombre === 'Maltrato')
            <div class="form-field mb-3">
                <label class="form-field-label">Descripción del Maltrato</label>
                <textarea name="Contenido" class="form-field-textarea" rows="4" placeholder="Describe el maltrato..."></textarea>
            </div>

            @elseif($tipoSeleccionado && $tipoSeleccionado->Nombre === 'Extravío')
            <div class="form-field mb-3">
                <label class="form-field-label">Última vez visto</label>
                <input type="text" name="Contenido" class="form-field-input" placeholder="Ej. Parque Central, 5PM...">
            </div>

            @elseif($tipoSeleccionado && $tipoSeleccionado->Nombre === 'Vacunación')
            <div class="form-field mb-3">
                <label class="form-field-label">Nombre de la Vacuna</label>
                <select name="Contenido" class="form-field-select">
                    @foreach($vacunas ?? [] as $vacuna)
                    <option value="{{ $vacuna->Nombre }}">{{ $vacuna->Nombre }} - {{ $vacuna->Fabricante }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-field mb-3">
                <label class="form-field-label">Fecha de Aplicación</label>
                <input type="date" name="Fecha_Vacuna" class="form-field-input">
            </div>

            @elseif($tipoSeleccionado && $tipoSeleccionado->Nombre === 'Adopción')
            <div class="form-field mb-3">
                <label class="form-field-label">Motivo de Adopción</label>
                <textarea name="Contenido" class="form-field-textarea" rows="4" placeholder="¿Por qué deseas adoptar esta mascota?"></textarea>
            </div>
            @endif

            {{-- Fecha del Reporte --}}
            <div class="form-field mb-3">
                <label class="form-field-label">Fecha del Reporte</label>
                <input type="date" name="Fecha_Reporte" class="form-field-input" required>
            </div>

            <div class="modal-buttons mt-4 d-flex justify-content-between">
                <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
                <button type="submit" class="submit-button btn btn-success">
                    <i class="fas fa-folder-open me-2"></i>Generar registro
                </button>
            </div>
        </form>
    </div>
</div>
@endsection