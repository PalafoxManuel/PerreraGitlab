{{-- resources/views/admin/vacunas-sintomas.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-info text-white py-2">
    <h6 class="mb-0">Vacunas y Síntomas Adversos Asociados</h6>
  </div>

  <div class="table-responsive">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 5%;">#</th>
          <th style="width: 25%;">Vacuna</th>
          <th style="width: 25%;">Síntoma Adverso</th>
          <th style="width: 35%;">Qué Hacer</th>
          <th style="width: 10%;" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($vacunas as $v)
          {{-- Solo mostramos vacunas que tengan al menos un síntoma --}}
          @if(!$v->sintomas->isEmpty())
            @foreach($v->sintomas as $sintoma)
              <tr>
                {{-- 1) ID de la vacuna (solo en la primera fila del grupo) --}}
                <td class="align-middle">
                  @if($loop->first)
                    {{ $v->Id_Vacuna }}
                  @endif
                </td>

                {{-- 2) Nombre de la vacuna (solo en la primera fila del grupo) --}}
                <td class="align-middle">
                  @if($loop->first)
                    {{ $v->Nombre }}
                  @endif
                </td>

                {{-- 3) Nombre del síntoma adverso --}}
                <td class="align-middle">
                  {{ $sintoma->nombre }}
                </td>

                {{-- 4) “Qué Hacer” asociado al síntoma --}}
                <td class="align-middle">
                  {{ $sintoma->que_hacer }}
                </td>

                {{-- 5) Botón “Eliminar asociación” --}}
                <td class="align-middle text-center">
                  <form method="POST"
                        action="{{ route('vacuna.sintoma.destroy', ['vacuna' => $v->Id_Vacuna, 'sintoma' => $sintoma->id_sintoma]) }}"
                        class="d-inline"
                        onsubmit="return confirm('¿Eliminar este síntoma de la vacuna?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" title="Eliminar síntoma">
                      <i class="fas fa-trash"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach

            {{-- Fila separadora opcional entre grupos de vacunas --}}
            <tr class="border-0"><td colspan="5" class="py-0"></td></tr>
          @endif
        @endforeach
      </tbody>
    </table>
  </div>
</div>
