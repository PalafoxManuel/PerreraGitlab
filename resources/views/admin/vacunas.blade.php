{{-- resources/views/admin/vacunas.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-info text-white">
    <h5 class="mb-0">Vacunas</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 10%;">ID</th>
          <th style="width: 30%;">Nombre</th>
          <th style="width: 40%;">Fabricante</th>
          <th style="width: 15%;">Tipo Mascota</th>
          <th style="width: 5%;" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vacunas as $v)
          <tr>
            <td class="align-middle">{{ $v->Id_Vacuna }}</td>
            <td class="align-middle">{{ $v->Nombre }}</td>
            <td class="align-middle">{{ $v->Fabricante }}</td>
            <td class="align-middle">{{ $v->tipoMascota->Nombre_Tipo ?? '—' }}</td>
            <td class="align-middle text-center">
              <form
                method="POST"
                action="{{ route('vacunas.destroy', $v->Id_Vacuna) }}"
                class="d-inline"
                onsubmit="return confirm('¿Eliminar esta vacuna?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" title="Eliminar Vacuna">
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
