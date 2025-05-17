{{-- resources/views/reservar-servicio.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Reservar Servicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap y FontAwesome -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="back-container d-flex flex-column min-vh-100">

  @include('Components.Header')

  <div class="form-wrapper-2 flex-grow-1 d-flex">
    <div class="container py-5 d-flex justify-content-center">
      <div class="card shadow rounded p-4" style="max-width: 600px;">
        <h2 class="mb-4 text-center">Reservar Servicio</h2>

        <form method="POST" action="{{ route('reserva_servicios.store') }}">
          @csrf

          {{-- 1) Fecha de reserva --}}
          <div class="mb-3">
            <label for="Fecha_Reserva" class="form-label">Fecha de Reserva *</label>
            <input type="date"
                   name="Fecha_Reserva"
                   id="Fecha_Reserva"
                   class="form-control"
                   value="{{ old('Fecha_Reserva', date('Y-m-d')) }}"
                   required>
          </div>

          {{-- Obtengo servicio seleccionado y flag --}}
          @php
            $sel           = $servicios->firstWhere('Id_Servicio', request('service'));
            $esAlojamiento = $sel && $sel->Nombre_Servicio === 'Alojamiento';
          @endphp

          {{-- 2) Duración --}}
          <div class="mb-3">
            <label for="Duracion_Dias" class="form-label">Duración (días) *</label>
            @if($esAlojamiento)
              <input type="number"
                     name="Duracion_Dias"
                     id="Duracion_Dias"
                     class="form-control"
                     value="{{ old('Duracion_Dias', 1) }}"
                     min="1"
                     required>
            @else
              <input type="hidden" name="Duracion_Dias" value="1">
              <input type="text" class="form-control" value="1" disabled>
            @endif
          </div>

          {{-- 3) Servicio --}}
          <input type="hidden" name="Id_Servicio" value="{{ $sel->Id_Servicio }}">
          <div class="mb-3">
            <label class="form-label">Servicio *</label>
            <input type="text" class="form-control" value="{{ $sel->Nombre_Servicio }}" disabled>
          </div>

          {{-- 4) Cupos --}}
          <div class="mb-3">
            <small class="text-muted">
              Cupos disponibles: {{ $disponibilidades[$sel->Id_Servicio] ?? '–' }}
            </small>
          </div>

          {{-- 5) Campos extra para Vacunación --}}
          @if(strtolower($sel->Nombre_Servicio) === 'vacunación' || strtolower($sel->Nombre_Servicio) === 'vacunacion')
            <div class="alert alert-info">Vacunación seleccionada. No olvides traer el carné.</div>

            {{-- Filtrar vacunas por el tipo de la mascota vía JS --}}
            <div class="mb-3">
              <label for="Id_Mascota" class="form-label">Tu mascota *</label>
              <select name="Id_Mascota"
                      id="Id_Mascota"
                      class="form-select"
                      required>
                <option value="">— Selecciona —</option>
                @foreach($mascotas as $m)
                  <option data-tipo="{{ $m->Id_TipoMascota }}"
                          value="{{ $m->Id_Mascota }}"
                          {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected':'' }}>
                    {{ $m->Nombre }} ({{ $m->Raza }})
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="Id_Vacuna" class="form-label">Vacuna *</label>
              <select name="Id_Vacuna"
                      id="Id_Vacuna"
                      class="form-select"
                      required>
                <option value="">— Selecciona una vacuna —</option>
                @foreach($vacunas as $vac)
                  <option data-tipo="{{ $vac->Id_TipoMascota }}"
                          value="{{ $vac->Id_Vacuna }}"
                          {{ old('Id_Vacuna') == $vac->Id_Vacuna ? 'selected':'' }}>
                    {{ $vac->Nombre }}
                  </option>
                @endforeach
              </select>
            </div>

            <div class="mb-3">
              <label for="Numero_Lote" class="form-label">Número de lote *</label>
              <input type="text"
                     name="Numero_Lote"
                     id="Numero_Lote"
                     value="{{ old('Numero_Lote') }}"
                     class="form-control"
                     required>
            </div>

            <div class="mb-3">
              <label for="Dosis" class="form-label">Dosis *</label>
              <input type="text"
                     name="Dosis"
                     id="Dosis"
                     value="{{ old('Dosis') }}"
                     placeholder="Ej. 1 ml"
                     class="form-control"
                     required>
            </div>
          @else
            {{-- Si no es vacunación, muestro mascota aquí --}}
            <div class="mb-3">
              <label for="Id_Mascota" class="form-label">Tu mascota *</label>
              <select name="Id_Mascota"
                      id="Id_Mascota"
                      class="form-select"
                      required>
                <option value="">— Selecciona —</option>
                @foreach($mascotas as $m)
                  <option value="{{ $m->Id_Mascota }}"
                          {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected':'' }}>
                    {{ $m->Nombre }} ({{ $m->Raza }})
                  </option>
                @endforeach
              </select>
            </div>
          @endif

          {{-- 6) Monto --}}
          <input type="hidden" name="Monto" value="{{ $sel->Tarifa }}">
          <div class="mb-4">
            <label class="form-label">Monto a pagar</label>
            <input type="text"
                   class="form-control"
                   value="{{ number_format($sel->Tarifa, 2) }}"
                   disabled>
          </div>

          {{-- 7) Pago --}}
          <div class="mb-4">
            <label for="Metodo_Pago" class="form-label">Método de pago *</label>
            <select name="Metodo_Pago"
                    id="Metodo_Pago"
                    class="form-select"
                    required>
              <option value="efectivo" {{ old('Metodo_Pago')=='efectivo'?'selected':'' }}>Efectivo</option>
              <option value="tarjeta"  {{ old('Metodo_Pago')=='tarjeta'?'selected':'' }}>Tarjeta</option>
              <option value="transferencia" {{ old('Metodo_Pago')=='transferencia'?'selected':'' }}>Transferencia</option>
            </select>
          </div>

          {{-- Botones --}}
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-success me-2">
              Confirmar Reserva
            </button>
            <a href="{{ route('home') }}" class="btn btn-secondary">
              Cancelar
            </a>
          </div>
        </form>
      </div>
    </div>
  </div>

  <script>
    // Filtrar vacunas por tipo de mascota seleccionado
    const mascotaSelect = document.querySelector('#Id_Mascota');
    const vacunaSelect  = document.querySelector('#Id_Vacuna');
    mascotaSelect?.addEventListener('change', () => {
      const tipo = mascotaSelect.selectedOptions[0].dataset.tipo;
      // vacunas: todas las <option> de vacuna
      Array.from(vacunaSelect.options).forEach(opt => {
        opt.hidden = opt.dataset.tipo !== tipo && opt.value !== '';
      });
      vacunaSelect.value = '';
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
