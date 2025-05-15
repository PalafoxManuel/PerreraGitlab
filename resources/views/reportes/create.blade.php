@extends('layouts.app')

@section('title', 'Crear Reporte')

@section('content')
<div class="container">
    <h1 class="mb-4">
        Crear Reporte: {{ $tipoSeleccionado->Nombre ?? 'Selecciona un tipo' }}
    </h1>

    <form action="{{ route('reporte.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Tipo de Reporte (oculto y visible) --}}
        <input type="hidden" name="Id_Tipo_Reporte" value="{{ $tipoSeleccionado->Id_Tipo_Reporte ?? '' }}">
        <div class="mb-3">
            <label class="form-label">Tipo de Reporte</label>
            <input type="text" class="form-control" value="{{ $tipoSeleccionado->Nombre ?? '' }}" disabled>
        </div>

        {{-- Campos comunes --}}
        <div class="mb-3">
            <label class="form-label">Mascota</label>
            <select name="Id_Mascota" class="form-select">
                @foreach($mascotas as $mascota)
                <option value="{{ $mascota->Id_Mascota }}">{{ $mascota->Nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Usuario</label>
            <select name="Id_Usuario" class="form-select">
                @foreach($usuarios as $usuario)
                <option value="{{ $usuario->Id_Usuario }}">{{ $usuario->Nombre }}</option>
                @endforeach
            </select>
        </div>

        {{-- Campos dinámicos según tipo de reporte --}}
        @if($tipoSeleccionado && $tipoSeleccionado->Nombre === 'Maltrato')
        <div class="mb-3">
            <label class="form-label">Descripción del Maltrato</label>
            <textarea name="Contenido" class="form-control" rows="4" placeholder="Describe el maltrato..."></textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Evidencia (opcional)</label>
            <input type="file" name="Evidencia" class="form-control">
        </div>

        @elseif($tipoSeleccionado && $tipoSeleccionado->Nombre === 'Extravío')
        <div class="mb-3">
            <label class="form-label">Última vez visto</label>
            <input type="text" name="Contenido" class="form-control" placeholder="Ej. Parque Central, 5PM...">
        </div>

        @elseif($tipoSeleccionado && $tipoSeleccionado->Nombre === 'Vacunación')
        <div class="mb-3">
            <label class="form-label">Nombre de la Vacuna</label>
            <select name="Contenido" class="form-select">
                @foreach($vacunas as $vacuna)
                <option value="{{ $vacuna->Nombre }}">{{ $vacuna->Nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Fecha de Aplicación</label>
            <input type="date" name="Fecha_Vacuna" class="form-control">
        </div>

        @elseif($tipoSeleccionado && $tipoSeleccionado->Nombre === 'Adopción')
        <div class="mb-3">
            <label class="form-label">Motivo de Adopción</label>
            <textarea name="Contenido" class="form-control" rows="4" placeholder="¿Por qué deseas adoptar esta mascota?"></textarea>
        </div>
        @endif

        {{-- Fecha del Reporte --}}
        <div class="mb-3">
            <label class="form-label">Fecha del Reporte</label>
            <input type="date" name="Fecha_Reporte" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Reporte</button>
    </form>
</div>
@endsection