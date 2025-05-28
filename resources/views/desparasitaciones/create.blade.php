@extends('layouts.app')

@section('content')
  <div class="container">
    <h1>Nueva Desparasitación</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $err)
      <li>{{ $err }}</li>
    @endforeach
    </ul>
    </div>
    @endif

    <form action="{{ route('desparasitaciones.store') }}" method="POST">
    @csrf

    {{-- Selección de mascota --}}
    <div class="mb-3">
      <label for="Id_Mascota" class="form-label">Mascota</label>
      <select name="Id_Mascota" id="Id_Mascota" class="form-select" required>
      <option value="">-- Selecciona --</option>
      @foreach ($mascotas as $m)
      <option value="{{ $m->Id_Mascota }}" {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected' : '' }}>
      {{ $m->Nombre }}
      </option>
    @endforeach
      </select>
    </div>

    {{-- Fecha aplicada --}}
    <div class="mb-3">
      <label for="Fecha_Desparasitado" class="form-label">Fecha de Desparasitación</label>
      <input type="date" name="Fecha_Desparasitado" id="Fecha_Desparasitado" class="form-control" required
      value="{{ old('Fecha_Desparasitado') }}">
    </div>

    {{-- Próxima dosis --}}
    <div class="mb-3">
      <label for="Fecha_Proxima" class="form-label">Próxima Fecha</label>
      <input type="date" name="Fecha_Proxima" id="Fecha_Proxima" class="form-control"
      value="{{ old('Fecha_Proxima') }}">
    </div>

    <hr>

    {{-- → Campos para historial médico ← --}}
    <div class="mb-3">
      <label for="Diagnostico" class="form-label">Diagnóstico</label>
      <input type="text" name="Diagnostico" id="Diagnostico" class="form-control"
      value="{{ old('Diagnostico', 'Control de desparasitación') }}">
    </div>

    <div class="mb-3">
      <label for="Tratamiento" class="form-label">Tratamiento</label>
      <input type="text" name="Tratamiento" id="Tratamiento" class="form-control"
      value="{{ old('Tratamiento', 'Desparasitación interna/externa') }}">
    </div>

    {{-- resources/views/desparasitaciones/create.blade.php --}}
    <div class="mb-3">
      <label for="Veterinario" class="form-label">Veterinario</label>
      <input type="text" name="Veterinario" id="Veterinario" class="form-control" value="{{ old('Veterinario') }}"
      required>
      @error('Veterinario')
      <div class="text-danger">{{ $message }}</div>
    @enderror
    </div>


    <div class="mb-3">
      <label for="Observaciones" class="form-label">Observaciones</label>
      <textarea name="Observaciones" id="Observaciones" class="form-control"
      rows="3">{{ old('Observaciones', '') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('home') }}" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
@endsection