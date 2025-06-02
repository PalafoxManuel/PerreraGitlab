{{-- resources/views/perfil-usuario.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Mi Perfil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <style>
    .contagious-badge {
      position: absolute;
      top: 10px;
      right: 10px;
    }

    .pet-card {
      position: relative;
    }

    .disease-list {
      max-height: 100px;
      overflow-y: auto;
      font-size: 0.85rem;
    }
  </style>
</head>

<body class="back-container d-flex flex-column min-vh-100">

  {{-- Header --}}
  @include('Components.Header')

  <div class="container my-5">
    <div class="row">
      {{-- Datos personales --}}
      <div class="col-md-4">
        <div class="card shadow mb-4">
          <div class="card-header bg-primary text-white">
            <i class="fas fa-user-circle me-2"></i>Mis datos
          </div>
          <div class="card-body">
            <p><strong>Usuario:</strong> {{ $usuario->Nombre_Usuario }}</p>
            <p><strong>Rol:</strong> {{ ucfirst($usuario->rol) }}</p>
            <hr>
            <p class="mb-1"><strong>Cliente:</strong></p>
            <p class="ms-3">{{ $usuario->cliente->Nombre_Completo }}</p>
            <p class="ms-3">📞 {{ $usuario->cliente->Numero_Contacto ?? '—' }}</p>
            <p class="ms-3">✉️ {{ $usuario->cliente->Correo_Electronico ?? '—' }}</p>
            <p class="ms-3">📍 {{ $usuario->cliente->Calle ?? '—' }}, {{ $usuario->cliente->Codigo_Postal ?? '—' }}</p>
            <hr>
            <p><strong>Perrera asignada:</strong> {{ $usuario->perrera->Nombre ?? '— Ninguna —' }}</p>
          </div>
        </div>
      </div>

      {{-- Mascotas adoptadas --}}
      <div class="col-md-8">
        <div class="card shadow mb-4">
          <div class="card-header bg-success text-white">
            <i class="fas fa-paw me-2"></i>Mis mascotas
            <span class="float-end badge bg-light text-dark">
              Total: {{ $usuario->mascotas->count() }}
            </span>
          </div>
          <div class="card-body">
            @if($usuario->mascotas->isEmpty())
        <div class="alert alert-info">
          No tienes mascotas adoptadas aún.
          <a href="{{ route('mascotas.index') }}" class="alert-link">Ver mascotas disponibles</a>
        </div>
      @else
          <div class="row g-3">
            @foreach($usuario->mascotas as $mascota)
          <div class="col-md-6">
          <div class="card h-100 pet-card">
            @if($mascota->enfermedades->where('es_contagiosa', true)->count() > 0)
          <span class="badge bg-danger contagious-badge" data-bs-toggle="tooltip"
          title="Enfermedad contagiosa - Precaución">
          <i class="fas fa-biohazard"></i> Contagiosa
          </span>
          @endif
            <div class="card-body">
            <h5 class="card-title">
            {{ $mascota->Nombre }}
            <small class="text-muted">({{ $mascota->tipo->Nombre_Tipo ?? 'Sin tipo' }})</small>
            </h5>

            <div class="row">
            <div class="col-md-6">
            <p class="mb-1"><strong>Raza:</strong> {{ $mascota->Raza }}</p>
            <p class="mb-1"><strong>Edad:</strong> {{ $mascota->Edad }} años</p>
            </div>
            <div class="col-md-6">
            <p class="mb-1"><strong>Género:</strong> {{ $mascota->Genero }}</p>
            <p class="mb-1"><strong>Color:</strong> {{ $mascota->Color }}</p>
            </div>
            </div>

            @if($mascota->enfermedades->count() > 0)
          <div class="mt-3">
            <h6 class="border-bottom pb-1">
            <i class="fas fa-file-medical"></i> Historial médico
            </h6>
            <div class="disease-list">
            @foreach($mascota->enfermedades as $enfermedad)
          <div class="d-flex justify-content-between align-items-start mb-1">
            <span>
            <i
            class="fas fa-{{ $enfermedad->es_contagiosa ? 'exclamation-triangle text-danger' : 'info-circle text-info' }} me-1"></i>
            {{ $enfermedad->nombre }}
            </span>
            <small
            class="text-muted">{{ $enfermedad->pivot->fecha_diagnostico ? \Carbon\Carbon::parse($enfermedad->pivot->fecha_diagnostico)->format('d/m/Y') : '' }}</small>
          </div>
          @if($enfermedad->pivot->observaciones)
          <div class="ps-3 mb-2 small text-muted">
          <i class="fas fa-comment-medical"></i> {{ $enfermedad->pivot->observaciones }}
          </div>
          @endif
          @endforeach
            </div>
          </div>
          @else
          <div class="alert alert-success mt-3 mb-0 py-2 small">
          <i class="fas fa-check-circle"></i> Esta mascota no tiene enfermedades registradas
          </div>
          @endif
            </div>
            <div class="card-footer bg-transparent">

            </div>
          </div>
          </div>
        @endforeach
          </div>
      @endif
          </div>
        </div>

        {{-- Historial de servicios --}}
        <div class="card shadow">
          <div class="card-header bg-info text-white">
            <i class="fas fa-history me-2"></i>Historial de servicios
          </div>
          <div class="card-body">
            @if($historial->isEmpty())
        <p class="text-muted">Aún no hay registros de servicios.</p>
      @else
          <div class="table-responsive">
            <table class="table table-hover align-middle">
            <thead class="table-light">
              <tr>
              <th>Fecha</th>
              <th>Servicio</th>
              <th>Mascota</th>
              <th>Duración</th>
              <th>Monto</th>
              <th>Estado</th>
              </tr>
            </thead>
            <tbody>
              @foreach($historial as $reserva)
            @foreach($reserva->reservaServicios as $rs)
          <tr>
          <td>{{ \Carbon\Carbon::parse($reserva->Fecha_Reserva)->format('d/m/Y') }}</td>
          <td>{{ $rs->servicio->Nombre_Servicio }}</td>
          <td>{{ optional($rs->mascota)->Nombre ?? '—' }}</td>
          <td>{{ $reserva->Duracion_Dias }} días</td>
          <td>${{ number_format($reserva->pago->Monto ?? 0, 2) }}</td>
          <td>
            <span
            class="badge bg-{{ $reserva->Estado === 'completado' ? 'success' : ($reserva->Estado === 'cancelado' ? 'danger' : 'warning') }}">
            {{ $reserva->Estado }}
            </span>
          </td>
          </tr>
          @endforeach
          @endforeach
            </tbody>
            </table>
          </div>
      @endif
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Activar tooltips de Bootstrap
    document.addEventListener('DOMContentLoaded', function () {
      var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
      });
    });
  </script>

</body>

</html>