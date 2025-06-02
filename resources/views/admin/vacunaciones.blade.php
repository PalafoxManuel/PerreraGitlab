{{-- resources/views/admin/vacunaciones.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-secondary text-white">
    <h5 class="mb-0">Vacunaciones</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 8%;">ID</th>
          <th style="width: 25%;">Mascota</th>
          <th style="width: 25%;">Vacuna</th>
          <th style="width: 15%;">Fecha</th>
          <th style="width: 12%;">Lote</th>
          <th style="width: 10%;">Dosis</th>
          <th style="width: 5%;" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vacunaciones as $vac)
          <tr>
            <td class="align-middle">{{ $vac->Id_Vacunacion }}</td>
            <td class="align-middle">
              {{ optional($vac->mascota)->Nombre ?? 'Mascota eliminada' }}
            </td>
            <td class="align-middle">
              {{ optional($vac->vacuna)->Nombre ?? '—' }}
            </td>
            <td class="align-middle">{{ $vac->Fecha_Vacunacion }}</td>
            <td class="align-middle">{{ $vac->Numero_Lote }}</td>
            <td class="align-middle">{{ $vac->Dosis }}</td>
            <td class="align-middle text-center">
              <form
                method="POST"
                action="{{ route('vacunacion.destroy', $vac->Id_Vacunacion) }}"
                class="d-inline"
                onsubmit="return confirm('¿Eliminar esta vacunación?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" title="Eliminar Vacunación">
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
