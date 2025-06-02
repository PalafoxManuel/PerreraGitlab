{{-- resources/views/admin/usuarios.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-primary text-white">
    <h5 class="mb-0">Usuarios</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 10%;">ID</th>
          <th style="width: 30%;">Usuario</th>
          <th style="width: 30%;">Email</th>
          <th style="width: 20%;">Rol</th>
          <th style="width: 10%;" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($usuarios as $u)
          <tr>
            <td class="align-middle">{{ $u->Id_Usuario }}</td>
            <td class="align-middle">{{ $u->Nombre_Usuario }}</td>
            <td class="align-middle">{{ $u->Correo_Electronico ?? '—' }}</td>
            <td class="align-middle">{{ ucfirst($u->rol) }}</td>
            <td class="align-middle text-center">
              <form
                method="POST"
                action="{{ route('usuarios.destroy', $u->Id_Usuario) }}"
                class="d-inline"
                onsubmit="return confirm('¿Eliminar este usuario?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" title="Eliminar Usuario">
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
