{{-- resources/views/admin/vacunas.blade.php --}}
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
