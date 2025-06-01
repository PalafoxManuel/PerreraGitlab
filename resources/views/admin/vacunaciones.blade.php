{{-- resources/views/admin/vacunaciones.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-secondary text-white">
    <h5 class="mb-0">Vacunaciones</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Mascota</th>
          <th>Vacuna</th>
          <th>Fecha</th>
          <th>Lote</th>
          <th>Dosis</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vacunaciones as $vac)
        <tr>
          <td>{{ $vac->Id_Vacunacion }}</td>

          {{-- Si no hay mascota asociada, muestra “—” --}}
          <td>{{ optional($vac->mascota)->Nombre ?? 'Mascota eliminada' }}</td>

          {{-- Si no hay vacuna asociada, muestra “—” --}}
          <td>{{ optional($vac->vacuna)->Nombre  ?? '—' }}</td>

          <td>{{ $vac->Fecha_Vacunacion }}</td>
          <td>{{ $vac->Numero_Lote }}</td>
          <td>{{ $vac->Dosis }}</td>
          <td>
            <form method="POST"
                  action="{{ route('vacunacion.destroy', $vac->Id_Vacunacion) }}"
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
