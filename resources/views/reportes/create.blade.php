@extends('layouts.app')

@section('title', 'Crear Reporte')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Crear Reporte</h2>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger">
        <strong>Se encontraron errores:</strong>
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('reporte.store') }}" method="POST">
        @csrf

        {{-- Tipo de Reporte --}}
        <div class="mb-3">
            <label for="Id_Tipo_Reporte" class="form-label">Tipo de Reporte</label>
            <select name="Id_Tipo_Reporte" id="Id_Tipo_Reporte" class="form-select" required>
                <option value="">-- Selecciona un tipo --</option>
                @foreach($tipos as $tipo)
                <option value="{{ $tipo->Id_Tipo_Reporte }}"
                    {{ (old('Id_Tipo_Reporte') == $tipo->Id_Tipo_Reporte || (isset($tipoSeleccionado) && $tipoSeleccionado->Id_Tipo_Reporte == $tipo->Id_Tipo_Reporte)) ? 'selected' : '' }}>
                    {{ $tipo->Nombre }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Mascota --}}
        <div class="mb-3">
            <label for="Id_Mascota" class="form-label">Mascota (opcional)</label>
            <select name="Id_Mascota" id="Id_Mascota" class="form-select">
                <option value="">-- Ninguna --</option>
                @foreach($mascotas as $mascota)
                <option value="{{ $mascota->Id_Mascota }}" {{ old('Id_Mascota') == $mascota->Id_Mascota ? 'selected' : '' }}>
                    {{ $mascota->Nombre }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Usuario --}}
        <div class="mb-3">
            <label for="Id_Usuario" class="form-label">Usuario (opcional)</label>
            <select name="Id_Usuario" id="Id_Usuario" class="form-select">
                <option value="">-- Ninguno --</option>
                @foreach($usuarios as $usuario)
                <option value="{{ $usuario->Id_Usuario }}" {{ old('Id_Usuario') == $usuario->Id_Usuario ? 'selected' : '' }}>
                    {{ $usuario->Nombre }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Contenido --}}
        <div class="mb-3">
            <label for="Contenido" class="form-label">Contenido (opcional)</label>
            <textarea name="Contenido" id="Contenido" class="form-control" rows="4">{{ old('Contenido') }}</textarea>
        </div>

        {{-- Fecha del Reporte --}}
        <div class="mb-3">
            <label for="Fecha_Reporte" class="form-label">Fecha del Reporte</label>
            <input type="date" name="Fecha_Reporte" id="Fecha_Reporte" class="form-control" value="{{ old('Fecha_Reporte', date('Y-m-d')) }}" required>
        </div>

        {{-- Botón de envío --}}
        <button type="submit" class="btn btn-primary">Guardar Reporte</button>
        <a href="{{ route('reporte.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection