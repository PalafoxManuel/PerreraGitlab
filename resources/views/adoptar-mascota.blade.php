@extends('layouts.app')

@section('title', 'Registrar Adopción')

@section('content')
<div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
  <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">
    <h1 class="text-center mb-4 fw-bold">Registrar Adopción</h1>

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

    <form method="POST" action="{{ route('adopciones.store') }}">
      @csrf

      <div class="row">
        {{-- Mascota --}}
        <div class="col-md-12 mb-3">
          <div class="form-field">
            <label class="form-field-label" for="Id_Mascota">Mascota *</label>
            <select name="Id_Mascota" id="Id_Mascota" class="form-field-select" required>
              <option value="">— Selecciona una mascota —</option>
              @foreach($mascotas as $m)
              <option value="{{ $m->Id_Mascota }}" {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected' : '' }}>
                {{ $m->Nombre }} ({{ $m->Raza }}, {{ $m->Edad }} años)
              </option>
              @endforeach
            </select>
          </div>
        </div>

        {{-- Cliente --}}
        <div class="col-md-12 mb-3">
          <div class="form-field">
            <label class="form-field-label" for="Id_Cliente">Cliente *</label>
            @if($isAdmin)
            <select name="Id_Cliente" id="Id_Cliente" class="form-field-select" required>
              <option value="">— Selecciona un cliente —</option>
              @foreach($clientes as $c)
              <option value="{{ $c->Id_Cliente }}" {{ old('Id_Cliente') == $c->Id_Cliente ? 'selected' : '' }}>
                {{ $c->Nombre_Completo }}
              </option>
              @endforeach
            </select>
            @else
            <input type="text" class="form-field-input" value="{{ session('usuario_nombre') }}" readonly>
            <input type="hidden" name="Id_Cliente" value="{{ $clienteId }}">
            @endif
          </div>
        </div>

        {{-- Fecha --}}
        <div class="col-md-12 mb-3">
          <div class="form-field">
            <label for="Fecha_Adopcion" class="form-field-label">Fecha de Adopción *</label>
            <input type="date" name="Fecha_Adopcion" id="Fecha_Adopcion" class="form-field-input" value="{{ old('Fecha_Adopcion', date('Y-m-d')) }}" required>
          </div>
        </div>

        {{-- Notas --}}
        <div class="col-md-12 mb-3">
          <div class="form-field">
            <label for="NotasAdicionales" class="form-field-label">Notas Adicionales</label>
            <textarea name="NotasAdicionales" id="NotasAdicionales" class="form-field-textarea" rows="3">{{ old('NotasAdicionales') }}</textarea>
          </div>
        </div>
      </div>

      <div class="modal-buttons mt-4 d-flex justify-content-between">
        <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
        <button type="submit" class="submit-button btn btn-primary">
          <i class="fas fa-paw me-2"></i>Registrar Adopción
        </button>
      </div>
    </form>
  </div>
</div>
@endsection