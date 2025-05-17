<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Reservar Servicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="back-container d-flex flex-column min-vh-100">

  @include('Components.Header')

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
        @endphp

        <div class="row">
          <div class="col-md-6 mb-3 form-field">
            <label for="Fecha_Reserva" class="form-field-label">Fecha de Reserva *</label>
            <input type="date" name="Fecha_Reserva" id="Fecha_Reserva" class="form-field-input" value="{{ old('Fecha_Reserva', date('Y-m-d')) }}" required>
          </div>

          <div class="col-md-6 mb-3 form-field">
            <label for="Duracion_Dias" class="form-field-label">Duración (días) *</label>
            @if($esAlojamiento)
            <input type="number" name="Duracion_Dias" id="Duracion_Dias" class="form-field-input" value="{{ old('Duracion_Dias', 1) }}" min="1" required>
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
            <option value="">— Selecciona una vacuna —</option>
            @foreach($vacunas as $vac)
            <option data-tipo="{{ $vac->Id_TipoMascota }}" value="{{ $vac->Id_Vacuna }}" {{ old('Id_Vacuna') == $vac->Id_Vacuna ? 'selected' : '' }}>
              {{ $vac->Nombre }}
            </option>
            @endforeach
          </select>
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

  <script>
    const mascotaSelect = document.querySelector('#Id_Mascota');
    const vacunaSelect = document.querySelector('#Id_Vacuna');
    mascotaSelect?.addEventListener('change', () => {
      const tipo = mascotaSelect.selectedOptions[0].dataset.tipo;
      Array.from(vacunaSelect.options).forEach(opt => {
        opt.hidden = opt.dataset.tipo !== tipo && opt.value !== '';
      });
      vacunaSelect.value = '';
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>