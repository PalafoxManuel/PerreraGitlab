{{-- resources/views/admin/mascotas.blade.php --}}
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
