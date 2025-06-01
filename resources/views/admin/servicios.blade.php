{{-- resources/views/admin/servicios.blade.php --}}
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
