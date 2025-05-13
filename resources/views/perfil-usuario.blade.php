{{-- resources/views/perfil-usuario.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Mi Perfil</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
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
          </div>
          <div class="card-body">
            @if($usuario->mascotas->isEmpty())
              <p>No tienes mascotas adoptadas aún.</p>
            @else
              <div class="row g-3">
                @foreach($usuario->mascotas as $m)
                  <div class="col-md-6">
                    <div class="card">
                      <div class="card-body">
                        <h5 class="card-title">{{ $m->Nombre }}</h5>
                        <p class="card-text">
                          Raza: {{ $m->Raza }}<br>
                          Edad: {{ $m->Edad }} años<br>
                          Género: {{ $m->Genero }}<br>
                          Color: {{ $m->Color }}
                        </p>
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
                          <td>{{ $reserva->Estado }}</td>
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

</body>
</html>
