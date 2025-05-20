<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Admin</title>
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

  {{-- Navbar --}}
  @include('Components.Header')

  <div class="container py-4 flex-grow-1">

    {{-- Usuarios --}}
    <div class="card mb-4 shadow">
      <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Usuarios</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Usuario</th>
              <th>Email</th>
              <th>Rol</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($usuarios as $u)
            <tr>
              <td>{{ $u->Id_Usuario }}</td>
              <td>{{ $u->Nombre_Usuario }}</td>
              <td>{{ $u->Correo_Electronico ?? '—' }}</td>
              <td>{{ ucfirst($u->rol) }}</td>
              <td>
                <form method="POST"
                      action="{{ route('usuarios.destroy', $u->Id_Usuario) }}"
                      class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Mascotas --}}
    <div class="card mb-4 shadow">
      <div class="card-header bg-success text-white">
        <h5 class="mb-0">Mascotas</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Raza</th>
              <th>Edad</th>
              <th>Dueño</th>
              <th>Tipo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($mascotas as $m)
            <tr>
              <td>{{ $m->Id_Mascota }}</td>
              <td>{{ $m->Nombre }}</td>
              <td>{{ $m->Raza }}</td>
              <td>{{ $m->Edad }}</td>
              <td>{{ $m->usuario->Nombre_Usuario ?? '—' }}</td>
              <td>{{ $m->tipo->Nombre_Tipo ?? '—' }}</td>
              <td>
                <form method="POST"
                      action="{{ route('mascotas.destroy', $m->Id_Mascota) }}"
                      class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Reservaciones --}}
    <div class="card mb-4 shadow">
      <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Reservaciones</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Fecha</th>
              <th>Duración</th>
              <th>Tipo Servicio</th>
              <th>Estado</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($reservas as $r)
            <tr>
              <td>{{ $r->Id_Reserva }}</td>
              <td>{{ $r->Fecha_Reserva }}</td>
              <td>{{ $r->Duracion_Dias }} días</td>
              <td>{{ $r->Tipo_Servicio }}</td>
              <td>{{ $r->Estado }}</td>
              <td>
                @if($r->Estado !== 'Completada')
                  <form method="POST"
                        action="{{ route('reserva.update', $r->Id_Reserva) }}"
                        class="d-inline">
                    @csrf @method('PATCH')
                    <input type="hidden" name="Estado" value="Completada">
                    <button class="btn btn-sm btn-success">
                      <i class="fas fa-check"></i>
                    </button>
                  </form>
                @endif
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Vacunas --}}
    <div class="card mb-4 shadow">
      <div class="card-header bg-info text-white">
        <h5 class="mb-0">Vacunas</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Fabricante</th>
              <th>Tipo Mascota</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($vacunas as $v)
            <tr>
              <td>{{ $v->Id_Vacuna }}</td>
              <td>{{ $v->Nombre }}</td>
              <td>{{ $v->Fabricante }}</td>
              <td>{{ $v->tipoMascota->Nombre_Tipo ?? '—' }}</td>
              <td>
                <form method="POST"
                      action="{{ route('vacunas.destroy', $v->Id_Vacuna) }}"
                      class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Vacunaciones --}}
    <div class="card mb-4 shadow">
      <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Vacunaciones</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Mascota</th>
              <th>Vacuna</th>
              <th>Fecha</th>
              <th>Lote</th>
              <th>Dosis</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($vacunaciones as $vac)
            <tr>
              <td>{{ $vac->Id_Vacunacion }}</td>
              <td>{{ $vac->mascota->Nombre }}</td>
              <td>{{ $vac->vacuna->Nombre }}</td>
              <td>{{ $vac->Fecha_Vacunacion }}</td>
              <td>{{ $vac->Numero_Lote }}</td>
              <td>{{ $vac->Dosis }}</td>
              <td>
                <form method="POST"
                      action="{{ route('vacunacion.destroy', $vac->Id_Vacunacion) }}"
                      class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Tipos de Vacunas --}}
    <div class="card mb-4 shadow">
      <div class="card-header bg-dark text-white">
        <h5 class="mb-0">Tipos de Vacunas</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Tipo</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tiposVacunas as $t)
            <tr>
              <td>{{ $t->Id_TipoMascota }}</td>
              <td>{{ $t->Nombre_Tipo }}</td>
              <td>
                <form method="POST"
                      action="{{ route('tipo_mascotas.destroy', $t->Id_TipoMascota) }}"
                      class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Servicios --}}
    <div class="card mb-4 shadow">
      <div class="card-header bg-light">
        <h5 class="mb-0">Servicios</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Servicio</th>
              <th>Tarifa</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($servicios as $s)
            <tr>
              <td>{{ $s->Id_Servicio }}</td>
              <td>{{ $s->Nombre_Servicio }}</td>
              <td>${{ number_format($s->Tarifa,2) }}</td>
              <td>
                <form method="POST"
                      action="{{ route('servicios.destroy', $s->Id_Servicio) }}"
                      class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

    {{-- Perreras --}}
    <div class="card mb-4 shadow">
      <div class="card-header bg-warning text-dark">
        <h5 class="mb-0">Perreras Registradas</h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Ubicación</th>
              <th>Personal</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody>
            @foreach($perreras as $p)
            <tr>
              <td>{{ $p->Id_Perrera }}</td>
              <td>{{ $p->Nombre }}</td>
              <td>{{ $p->Ubicacion }}</td>
              <td>{{ $p->Tamano_Personal }}</td>
              <td>
                <form method="POST"
                      action="{{ route('perreras.destroy', $p->Id_Perrera) }}"
                      class="d-inline">
                  @csrf @method('DELETE')
                  <button class="btn btn-sm btn-danger">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>

  </div>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js">
  </script>
</body>
</html>
