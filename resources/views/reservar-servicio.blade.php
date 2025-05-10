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

  {{-- Header compartido --}}
  @include('Components.Header')

  <div class="form-wrapper-2 flex-grow-1 d-flex">
    <div class="container py-5 d-flex justify-content-center">
      <div class="card shadow rounded p-4" style="max-width: 600px; width: 100%;">
        <h2 class="mb-4 text-center">Reservar Servicio</h2>

        <form method="POST" action="{{ route('reserva_servicios.store') }}">
          @csrf

          {{-- 1) Fecha de reserva --}}
          <div class="mb-3">
            <label for="Fecha_Reserva" class="form-label">Fecha de Reserva *</label>
            <input
              type="date"
              name="Fecha_Reserva"
              id="Fecha_Reserva"
              class="form-control"
              value="{{ old('Fecha_Reserva', date('Y-m-d')) }}"
              required>
          </div>

          {{-- 2) Duración --}}
          <div class="mb-3">
            <label for="Duracion_Dias" class="form-label">Duración (días) *</label>
            <input
              type="number"
              name="Duracion_Dias"
              id="Duracion_Dias"
              class="form-control"
              value="{{ old('Duracion_Dias', 1) }}"
              min="1"
              required>
          </div>

          {{-- 3) Servicio (solo lectura + hidden) --}}
          @php
            // obtenemos el servicio seleccionado por query ?service=
            $sel = $servicios->firstWhere('Id_Servicio', request('service'));
          @endphp
          <input type="hidden" name="Id_Servicio" value="{{ $sel->Id_Servicio }}">
          <div class="mb-3">
            <label class="form-label">Servicio *</label>
            <input
              type="text"
              class="form-control"
              value="{{ $sel->Nombre_Servicio }}"
              disabled>
          </div>

          {{-- 4) Cupos disponibles --}}
          <div class="mb-3">
            <small class="text-muted">
              Cupos disponibles: {{ $disponibilidades[$sel->Id_Servicio] ?? '–' }}
            </small>
          </div>

          {{-- 5) Fragmentos condicionales --}}
          @switch($sel->Nombre_Servicio)
            @case('Vacunación')
              <div class="alert alert-info">
                Vacunación seleccionada. No olvides traer el carné.
              </div>
            @break

            @case('Baño')
              <div class="mb-3">
                <label for="Tipo_Champu" class="form-label">Tipo de champú</label>
                <select name="Tipo_Champu" id="Tipo_Champu" class="form-select">
                  <option value="normal" {{ old('Tipo_Champu')=='normal'?'selected':'' }}>Normal</option>
                  <option value="antipulgas" {{ old('Tipo_Champu')=='antipulgas'?'selected':'' }}>Antipulgas</option>
                </select>
              </div>
            @break
            {{-- otros casos si hacen falta… --}}
          @endswitch

          {{-- 6) Tu mascota --}}
          <div class="mb-3">
            <label for="Id_Mascota" class="form-label">Tu mascota *</label>
            <select
              name="Id_Mascota"
              id="Id_Mascota"
              class="form-select"
              required>
              <option value="">— Selecciona —</option>
              @foreach($mascotas as $m)
                <option
                  value="{{ $m->Id_Mascota }}"
                  {{ old('Id_Mascota')==$m->Id_Mascota?'selected':'' }}>
                  {{ $m->Nombre }} ({{ $m->Raza }})
                </option>
              @endforeach
            </select>
          </div>

          {{-- 7) Monto (solo lectura + hidden) --}}
          <input type="hidden" name="Monto" value="{{ $sel->Tarifa }}">
          <div class="mb-4">
            <label class="form-label">Monto a pagar</label>
            <input
              type="text"
              class="form-control"
              value="{{ number_format($sel->Tarifa, 2) }}"
              disabled>
          </div>

          {{-- 8) Método de pago --}}
          <div class="mb-4">
            <label for="Metodo_Pago" class="form-label">Método de pago *</label>
            <select
              name="Metodo_Pago"
              id="Metodo_Pago"
              class="form-select"
              required>
              <option value="efectivo" {{ old('Metodo_Pago')=='efectivo'?'selected':'' }}>
                Efectivo
              </option>
              <option value="tarjeta" {{ old('Metodo_Pago')=='tarjeta'?'selected':'' }}>
                Tarjeta
              </option>
              <option value="transferencia" {{ old('Metodo_Pago')=='transferencia'?'selected':'' }}>
                Transferencia
              </option>
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

</body>
</html>
