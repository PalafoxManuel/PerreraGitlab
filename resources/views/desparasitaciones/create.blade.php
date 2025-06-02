@extends('layouts.app')

@section('title', 'Nueva Desparasitación')

@section('content')
  <div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
    <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">
    <h1 class="text-center mb-4 fw-bold">Nueva Desparasitación</h1>

    {{-- Errores --}}
    @if ($errors->any())
    <div class="alert alert-danger">
      <strong>¡Error!</strong> Por favor corrige los siguientes campos:
      <ul class="mb-0">
      @foreach ($errors->all() as $err)
      <li>{{ $err }}</li>
    @endforeach
      </ul>
    </div>
    @endif

    <form action="{{ route('desparasitaciones.store') }}" method="POST">
      @csrf

      <div class="row">
      {{-- Mascota --}}
      <div class="col-md-12 mb-3">
        <div class="form-field">
        <label for="Id_Mascota" class="form-field-label">Mascota *</label>
        <select name="Id_Mascota" id="Id_Mascota" class="form-field-select" required>
          <option value="">— Selecciona —</option>
          @foreach ($mascotas as $m)
        <option value="{{ $m->Id_Mascota }}" {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected' : '' }}>
        {{ $m->Nombre }}
        </option>
      @endforeach
        </select>
        </div>
      </div>

      {{-- Fecha de desparasitación --}}
      <div class="col-md-12 mb-3">
        <div class="form-field">
        <label for="Fecha_Desparasitado" class="form-field-label">Fecha de Desparasitación *</label>
        <input type="date" name="Fecha_Desparasitado" id="Fecha_Desparasitado" class="form-field-input"
          value="{{ old('Fecha_Desparasitado') }}" min="{{ date('Y-m-d') }}" required>
        </div>
      </div>

      {{-- Próxima dosis --}}
      <div class="col-md-12 mb-3">
        <div class="form-field">
        <label for="Fecha_Proxima" class="form-field-label">Próxima Fecha</label>
        <input type="date" name="Fecha_Proxima" id="Fecha_Proxima" class="form-field-input"
          value="{{ old('Fecha_Proxima') }}" min="{{ date('Y-m-d') }}">
        </div>
      </div>

      {{-- Diagnóstico (fijo) --}}
      <div class="col-md-12 mb-3">
        <div class="form-field">
        <label for="Diagnostico" class="form-field-label">Diagnóstico</label>
        <input type="text" name="Diagnostico" id="Diagnostico" class="form-field-input"
          value="Control de desparasitación" readonly>
        </div>
      </div>

      {{-- Tratamiento (fijo) --}}
      <div class="col-md-12 mb-3">
        <div class="form-field">
        <label for="Tratamiento" class="form-field-label">Tratamiento</label>
        <input type="text" name="Tratamiento" id="Tratamiento" class="form-field-input"
          value="Desparasitación interna/externa" readonly>
        </div>
      </div>

      {{-- Veterinario (fijo) --}}
      <div class="col-md-12 mb-3">
        <div class="form-field">
        <label for="Veterinario" class="form-field-label">Veterinario</label>
        <input type="text" name="Veterinario" id="Veterinario" class="form-field-input" value="Dr. Manuel Eduador Palafox"
          readonly>
        </div>
      </div>

      {{-- Observaciones --}}
      <div class="col-md-12 mb-3">
        <div class="form-field">
        <label for="Observaciones" class="form-field-label">Observaciones</label>
        <textarea name="Observaciones" id="Observaciones" class="form-field-textarea"
          rows="3">{{ old('Observaciones', '') }}</textarea>
        </div>
      </div>
      </div>

      <div class="modal-buttons mt-4 d-flex justify-content-between">
      <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
      <button type="submit" class="submit-button btn btn-success">
        <i class="fas fa-dna me-2"></i>Guardar Desparasitación
      </button>
      </div>
    </form>
    </div>
  </div>
@endsection