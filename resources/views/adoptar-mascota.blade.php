<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registrar Adopción</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
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

  <div class="container my-5" style="max-width:600px;">
    <div class="card shadow">
      <div class="card-body">
        <h2 class="card-title mb-4 text-center">Registrar Adopción</h2>

        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST" action="{{ route('adopciones.store') }}">
          @csrf

          {{-- Mascota sin dueño --}}
          <div class="mb-3">
            <label class="form-label">Mascota *</label>
            <select name="Id_Mascota" class="form-select" required>
              <option value="">— Selecciona una mascota —</option>
              @foreach($mascotas as $m)
                <option
                  value="{{ $m->Id_Mascota }}"
                  {{ old('Id_Mascota') == $m->Id_Mascota ? 'selected':'' }}>
                  {{ $m->Nombre }} ({{ $m->Raza }}, {{ $m->Edad }} años)
                </option>
              @endforeach
            </select>
          </div>

          {{-- Cliente --}}
          @if($isAdmin)
            <div class="mb-3">
              <label class="form-label">Cliente *</label>
              <select name="Id_Cliente" class="form-select" required>
                <option value="">— Selecciona un cliente —</option>
                @foreach($clientes as $c)
                  <option
                    value="{{ $c->Id_Cliente }}"
                    {{ old('Id_Cliente') == $c->Id_Cliente ? 'selected':'' }}>
                    {{ $c->Nombre_Completo }}
                  </option>
                @endforeach
              </select>
            </div>
          @else
            {{-- usuario normal: Id_Cliente fijo --}}
            <input type="hidden" name="Id_Cliente" value="{{ $clienteId }}">
          @endif

          {{-- Fecha --}}
          <div class="mb-3">
            <label class="form-label">Fecha de Adopción *</label>
            <input
              type="date"
              name="Fecha_Adopcion"
              class="form-control"
              value="{{ old('Fecha_Adopcion', date('Y-m-d')) }}"
              required>
          </div>

          {{-- Notas --}}
          <div class="mb-3">
            <label class="form-label">Notas Adicionales</label>
            <textarea
              name="NotasAdicionales"
              class="form-control"
              rows="3">{{ old('NotasAdicionales') }}</textarea>
          </div>

          <button type="submit" class="btn btn-success w-100">
            <i class="fas fa-paw me-2"></i>Registrar Adopción
          </button>
          <a
            href="{{ route('home') }}"
            class="btn btn-secondary w-100 mt-2">
            Volver
          </a>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
