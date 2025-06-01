{{-- resources/views/admin/partials/perreras.blade.php --}}
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
