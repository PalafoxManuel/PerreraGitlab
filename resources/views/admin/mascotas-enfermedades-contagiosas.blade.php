{{-- resources/views/admin/mascotas-enfermedades-contagiosas.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-danger text-white py-2">
    <h6 class="mb-0">Mascotas con Enfermedades Contagiosas</h6>
  </div>

  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 5%;">#</th>
          <th style="width: 20%;">Mascota</th>
          <th style="width: 20%;">Dueño</th>
          <th style="width: 25%;">Enfermedad</th>
          <th style="width: 20%;">Fecha Diagnóstico</th>
          <th style="width: 10%;" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($mascotasContagiosas as $m)
          @foreach($m->enfermedades as $enf)
            <tr>
              {{-- 1) ID de la mascota (solo en la primera fila del grupo) --}}
              <td class="align-middle">
                @if($loop->parent->first && $loop->first)
                  {{ $m->Id_Mascota }}
                @endif
              </td>

              {{-- 2) Nombre de la mascota (solo en la primera fila del grupo) --}}
              <td class="align-middle">
                @if($loop->parent->first && $loop->first)
                  {{ $m->Nombre }}
                @endif
              </td>

              {{-- 3) Nombre del dueño (solo en la primera fila del grupo) --}}
              <td class="align-middle">
                @if($loop->parent->first && $loop->first)
                  {{ $m->usuario->Nombre_Usuario ?? '—' }}
                @endif
              </td>

              {{-- 4) Nombre de la enfermedad contagiosa --}}
              <td class="align-middle">
                {{ $enf->nombre }}
              </td>

              {{-- 5) Fecha de diagnóstico (desde el pivot) --}}
              <td class="align-middle">
                {{ $enf->pivot->fecha_diagnostico ?? '—' }}
              </td>

              {{-- 6) Botón para “Eliminar este diagnóstico” --}}
              <td class="align-middle text-center">
                <form method="POST"
                      action="{{ route('mascota.enfermedad.destroy', [
                        'mascota'   => $m->Id_Mascota,
                        'enfermedad'=> $enf->id_enfermedad
                      ]) }}"
                      class="d-inline"
                      onsubmit="return confirm('¿Eliminar esta enfermedad de la mascota?');">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-danger" title="Eliminar Diagnóstico">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach

          {{-- Separador visual entre mascotas --}}
          <tr class="border-0"><td colspan="6" class="py-0"></td></tr>
        @empty
          <tr>
            <td colspan="6" class="text-center py-3">
              No hay mascotas con enfermedades contagiosas registradas.
            </td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
