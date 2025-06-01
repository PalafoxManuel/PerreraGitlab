{{-- resources/views/admin/usuarios.blade.php --}}
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
