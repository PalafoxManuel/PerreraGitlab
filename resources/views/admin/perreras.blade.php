{{-- resources/views/admin/partials/perreras.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-warning text-dark">
    <h5 class="mb-0">Perreras Registradas</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 10%;">ID</th>
          <th style="width: 40%;">Nombre</th>
          <th style="width: 30%;">Ubicación</th>
          <th style="width: 10%;">Personal</th>
          <th style="width: 10%;" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($perreras as $p)
          <tr>
            <td class="align-middle">{{ $p->Id_Perrera }}</td>
            <td class="align-middle">{{ $p->Nombre }}</td>
            <td class="align-middle">{{ $p->Ubicacion }}</td>
            <td class="align-middle">{{ $p->Tamano_Personal }}</td>
            <td class="align-middle text-center">
              <form
                method="POST"
                action="{{ route('perreras.destroy', $p->Id_Perrera) }}"
                class="d-inline"
                onsubmit="return confirm('¿Eliminar esta perrera?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" title="Eliminar Perrera">
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
