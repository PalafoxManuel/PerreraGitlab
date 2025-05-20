{{-- resources/views/mascotas/historial.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Historial de Mascota – Patitas Felices</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap, FontAwesome y tus assets -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
  <style>
    body.back-container {
      background-color: #212121;
      color: #f8f9fa;
    }

    /* Forzar fondo oscuro en las tablas */
    .table-dark {
      background-color: #2c2c2c;
    }

    .table-dark th,
    .table-dark td {
      color: #f8f9fa;
    }
  </style>
</head>

<body class="back-container d-flex flex-column min-vh-100">

  {{-- Navbar / Header --}}
  @include('Components.Header')

  <main class="flex-grow-1">
    <div class="container py-5">
      <h1 class="mb-4 text-white">Historial de Mascota</h1>

      {{-- Selector --}}
      <form method="GET" action="{{ route('mascotas.historial') }}" class="mb-5">
        <div class="row">
          <div class="col-md-6">
            <label for="mascota" class="form-label text-white">Selecciona una mascota</label>
            <select name="mascota" id="mascota"
              class="form-select bg-dark text-white"
              onchange="this.form.submit()">
              <option value="">— Elige —</option>
              @foreach($mascotas as $m)
              <option value="{{ $m->Id_Mascota }}"
                {{ $selected && $selected->Id_Mascota == $m->Id_Mascota ? 'selected' : '' }}>
                {{ $m->Nombre }} ({{ $m->Raza }})
              </option>
              @endforeach
            </select>
          </div>
        </div>
      </form>

      @if($selected)
      <div class="row g-4">
        {{-- Servicios realizados --}}
        <div class="col-12 col-md-6">
          <div class="card shadow bg-dark border-0 h-100">
            <div class="card-header bg-primary text-white">
              <i class="fas fa-concierge-bell me-2"></i>
              Servicios realizados: {{ $selected->Nombre }}
            </div>
            <div class="card-body p-0 bg-dark">
              @if($servicios->isEmpty())
              <p class="m-3 text-light">No hay servicios reservados aún.</p>
              @else
              <div class="table-responsive">
                <table class="table table-dark table-bordered mb-0 responsive-stack">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Servicio</th>
                      <th>Duración (días)</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($servicios as $rs)
                    <tr>
                      <td data-label="Fecha">{{ $rs->reserva->Fecha_Reserva }}</td>
                      <td data-label="Servicio">{{ $rs->servicio->Nombre_Servicio }}</td>
                      <td data-label="Duración (días)">{{ $rs->reserva->Duracion_Dias }}</td>
                      <td data-label="Estado">{{ $rs->reserva->Estado }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
          </div>
        </div>

        {{-- Historial médico general --}}
        <div class="col-12 col-md-6">
          <div class="card shadow bg-dark border-0 h-100">
            <div class="card-header bg-warning text-dark">
              <i class="fas fa-notes-medical me-2"></i>
              Historial médico (General)
            </div>
            <div class="card-body p-0 bg-dark">
              @if($historial->isEmpty())
              <p class="m-3 text-light">Aún no hay registros médicos generales.</p>
              @else
              <div class="table-responsive">
                <table class="table table-dark table-bordered mb-0 responsive-stack">
                  <thead>
                    <tr>
                      <th>Fecha</th>
                      <th>Diagnóstico</th>
                      <th>Tratamiento</th>
                      <th>Observaciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($historial as $h)
                    <tr>
                      <td data-label="Fecha">{{ \Carbon\Carbon::parse($h->Fecha)->format('Y-m-d') }}</td>
                      <td data-label="Diagnóstico">{{ $h->Diagnostico }}</td>
                      <td data-label="Tratamiento">{{ $h->Tratamiento }}</td>
                      <td data-label="Observaciones">{{ $h->Observaciones ?? '—' }}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              @endif
            </div>
          </div>
        </div>
      </div>
      @endif


    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>