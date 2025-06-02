{{-- resources/views/admin/mascotas.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-success text-white">
    <h5 class="mb-0">Mascotas</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 8%;">ID</th>
          <th style="width: 24%;">Nombre</th>
          <th style="width: 24%;">Raza</th>
          <th style="width: 10%;">Edad</th>
          <th style="width: 18%;">Dueño</th>
          <th style="width: 11%;">Tipo</th>
          <th style="width: 5%;" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($mascotas as $m)
          <tr>
            <td class="align-middle">{{ $m->Id_Mascota }}</td>
            <td class="align-middle">{{ $m->Nombre }}</td>
            <td class="align-middle">{{ $m->Raza }}</td>
            <td class="align-middle">{{ $m->Edad }}</td>
            <td class="align-middle">{{ $m->usuario->Nombre_Usuario ?? '—' }}</td>
            <td class="align-middle">{{ $m->tipo->Nombre_Tipo ?? '—' }}</td>
            <td class="align-middle text-center">
              <form
                method="POST"
                action="{{ route('mascotas.destroy', $m->Id_Mascota) }}"
                class="d-inline"
                onsubmit="return confirm('¿Eliminar esta mascota?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" title="Eliminar Mascota">
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
