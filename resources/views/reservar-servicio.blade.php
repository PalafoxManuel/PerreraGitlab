@extends('layouts.app')

@section('title', 'Reservar Servicio')

@section('content')
<div class="form-wrapper-reporte flex-grow-1 d-flex align-items-center justify-content-center py-5">
  <div class="form-container-reporte text-white p-4 p-md-5 rounded-4 shadow-lg">
    <h2 class="text-center mb-4 fw-bold">Reservar Servicio</h2>

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

    <form method="POST" action="{{ route('reserva_servicios.store') }}">
      @csrf

      @php
      $sel = $servicios->firstWhere('Id_Servicio', request('service'));
      $esAlojamiento = $sel && $sel->Nombre_Servicio === 'Alojamiento';
      $today = \Carbon\Carbon::today()->format('Y-m-d');
      $maxReserva = \Carbon\Carbon::today()->addMonth()->format('Y-m-d');
      @endphp

      <div class="row">
        <div class="col-md-6 mb-3 form-field">
          <label for="Fecha_Reserva" class="form-field-label">Fecha de Reserva *</label>
          <input type="date" name="Fecha_Reserva" id="Fecha_Reserva" class="form-field-input"
            value="{{ old('Fecha_Reserva', $today) }}"
            min="{{ $today }}" max="{{ $maxReserva }}" required>
        </div>

        <div class="col-md-6 mb-3 form-field">
          <label for="Duracion_Dias" class="form-field-label">Duración (días) *</label>
          @if($esAlojamiento)
          <input type="number" name="Duracion_Dias" id="Duracion_Dias" class="form-field-input"
            value="{{ old('Duracion_Dias', 1) }}" min="1" max="365" required>
          @else
          <input type="hidden" name="Duracion_Dias" value="1">
          <input type="text" class="form-field-input" value="1" disabled>
          @endif
        </div>
      </div>

      <input type="hidden" name="Id_Servicio" value="{{ $sel->Id_Servicio }}">
      <div class="mb-3 form-field">
        <label class="form-field-label">Servicio *</label>
        <input type="text" class="form-field-input" value="{{ $sel->Nombre_Servicio }}" disabled>
      </div>

      <div class="mb-3">
        <strong class="text-light">Cupos disponibles: {{ $disponibilidades[$sel->Id_Servicio] ?? '–' }}</strong>
      </div>

      @if(strtolower($sel->Nombre_Servicio) === 'vacunación' || strtolower($sel->Nombre_Servicio) === 'vacunacion')
      <div class="alert alert-info text-dark">Vacunación seleccionada. No olvides traer el carné.</div>

      <div class="mb-3 form-field">
        <label for="Id_Mascota" class="form-field-label">Tu mascota *</label>
        <select name="Id_Mascota" id="Id_Mascota" class="form-field-select" required>
          <option value="">— Selecciona —</option>
          @foreach($mascotas as $m)
          <option data-tipo="{{ $m->Id_TipoMascota }}" value="{{ $m->Id_Mascota }}" {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected' : '' }}>
            {{ $m->Nombre }} ({{ $m->Raza }})
          </option>
          @endforeach
        </select>
      </div>

      <div class="mb-3 form-field">
        <label for="Id_Vacuna" class="form-field-label">Vacuna *</label>
        <select name="Id_Vacuna" id="Id_Vacuna" class="form-field-select" required>
          <option value="">— Selecciona —</option>
          @foreach($vacunas as $vac)
          <option
            data-tipo="{{ $vac->Id_TipoMascota }}"
            data-sintomas='@json($vac->sintomas)'
            value="{{ $vac->Id_Vacuna }}"
            {{ old('Id_Vacuna') == $vac->Id_Vacuna ? 'selected' : '' }}>
            {{ $vac->Nombre }}
          </option>
          @endforeach
        </select>

        <div id="sintomasAdversosCard" class="alert alert-warning mt-3 d-none rounded-3 px-3 py-2" style="background-color: #ffc107;">
          <strong>Síntomas adversos:</strong>
          <ul id="sintomasTexto" class="mb-0"></ul>
        </div>
      </div>


      <div class="mb-3 form-field">
        <label for="Numero_Lote" class="form-field-label">Número de lote *</label>
        <input type="text" name="Numero_Lote" id="Numero_Lote" value="{{ old('Numero_Lote') }}" class="form-field-input" required>
      </div>

      <div class="mb-3 form-field">
        <label for="Dosis" class="form-field-label">Dosis *</label>
        <input type="text" name="Dosis" id="Dosis" value="{{ old('Dosis') }}" class="form-field-input" placeholder="Ej. 1 ml" required>
      </div>
      @else
      <div class="mb-3 form-field">
        <label for="Id_Mascota" class="form-field-label">Tu mascota *</label>
        <select name="Id_Mascota" id="Id_Mascota" class="form-field-select" required>
          <option value="">— Selecciona —</option>
          @foreach($mascotas as $m)
          <option value="{{ $m->Id_Mascota }}" {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected' : '' }}>
            {{ $m->Nombre }} ({{ $m->Raza }})
          </option>
          @endforeach
        </select>
      </div>
      @endif

      <input type="hidden" name="Monto" value="{{ $sel->Tarifa }}">
      <div class="mb-4 form-field">
        <label class="form-field-label">Monto a pagar</label>
        <input type="text" class="form-field-input" value="{{ number_format($sel->Tarifa, 2) }}" disabled>
      </div>

      <div class="mb-4 form-field">
        <label for="Metodo_Pago" class="form-field-label">Método de pago *</label>
        <select name="Metodo_Pago" id="Metodo_Pago" class="form-field-select" required>
          <option value="efectivo" {{ old('Metodo_Pago')=='efectivo'?'selected':'' }}>Efectivo</option>
          <option value="tarjeta" {{ old('Metodo_Pago')=='tarjeta'?'selected':'' }}>Tarjeta</option>
          <option value="transferencia" {{ old('Metodo_Pago')=='transferencia'?'selected':'' }}>Transferencia</option>
        </select>
      </div>

      <div class="modal-buttons mt-4 d-flex justify-content-between">
        <a href="{{ route('home') }}" class="cancel-button btn btn-light">Cancelar</a>
        <button type="submit" class="submit-button btn btn-success">
          <i class="fas fa-calendar-check me-2"></i>Confirmar Reserva
        </button>
      </div>
    </form>
  </div>
</div>
<!-- Modal para información del síntoma -->
<div class="modal fade" id="modalSintoma" tabindex="-1" aria-labelledby="modalSintomaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content custom-modal-content text-white">
      <div class="modal-header border-0">
        <h5 class="modal-title" id="modalSintomaLabel"></h5>
        <button type="button" class="btn-close btn-close-red" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body" id="modalSintomaBody"></div>
    </div>
  </div>
</div>
<script>
  const mascotaSelect = document.querySelector('#Id_Mascota');
  const vacunaSelect = document.querySelector('#Id_Vacuna');
  const sintomasCard = document.querySelector('#sintomasAdversosCard');
  const sintomasTexto = document.querySelector('#sintomasTexto');

  mascotaSelect?.addEventListener('change', () => {
    const tipo = mascotaSelect.selectedOptions[0]?.dataset.tipo;
    Array.from(vacunaSelect.options).forEach(opt => {
      opt.hidden = opt.dataset.tipo !== tipo && opt.value !== '';
    });
    vacunaSelect.value = '';
    sintomasCard.classList.add('d-none');
  });

  vacunaSelect?.addEventListener('change', () => {
    const selected = vacunaSelect.selectedOptions[0];
    const sintomasRaw = selected?.dataset.sintomas;

    try {
      const sintomas = JSON.parse(sintomasRaw || '[]');
      if (sintomas.length > 0) {
        sintomasTexto.innerHTML = sintomas.map(s => `
    <li>
      <button
        type="button"
        class="btn btn-link p-0 text-decoration-underline text-dark"
        data-nombre="${s.nombre}"
        data-quehacer="${s.que_hacer}">
        ${s.nombre}
      </button>
    </li>
  `).join('');
        sintomasCard.classList.remove('d-none');
      } else {
        sintomasTexto.innerHTML = '';
        sintomasCard.classList.add('d-none');
      }
    } catch (e) {
      console.error('Error al parsear síntomas:', e);
      sintomasTexto.innerHTML = '';
      sintomasCard.classList.add('d-none');
    }
  });

  // Escuchar clicks en los síntomas
  sintomasTexto.addEventListener('click', (e) => {
    const btn = e.target.closest('button[data-nombre]');
    if (!btn) return;

    const nombre = btn.dataset.nombre;
    const queHacer = btn.dataset.quehacer;

    document.querySelector('#modalSintomaLabel').textContent = nombre;
    document.querySelector('#modalSintomaBody').innerHTML = `
    <p><strong>¿Qué hacer?</strong></p>
    <p>${queHacer}</p>
  `;

    const modal = new bootstrap.Modal(document.getElementById('modalSintoma'));
    modal.show();
  });
</script>

@endsection