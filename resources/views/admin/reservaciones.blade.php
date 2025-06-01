{{-- resources/views/admin/reservaciones.blade.php --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-warning text-dark">
    <h5 class="mb-0">Reservaciones</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th>ID</th>
          <th>Fecha</th>
          <th>Duración</th>
          <th>Tipo Servicio</th>
          <th>Estado</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($reservas as $r)
        <tr>
          <td>{{ $r->Id_Reserva }}</td>
          <td>{{ $r->Fecha_Reserva }}</td>
          <td>{{ $r->Duracion_Dias }} días</td>
          <td>{{ $r->Tipo_Servicio }}</td>
          <td>{{ $r->Estado }}</td>
          <td>
            {{-- Solo mostramos el ✔ si el estado es exactamente "Pendiente" --}}
            @if($r->Estado === 'Pendiente')
              <form method="POST"
                    action="{{ route('reservas.completar', $r->Id_Reserva) }}"
                    class="d-inline">
                @csrf
                @method('PATCH')
                {{-- Al marcar, pasamos "Confirmada" --}}
                <input type="hidden" name="Estado" value="Confirmada">
                <button class="btn btn-sm btn-success">
                  <i class="fas fa-check"></i>
                </button>
              </form>
            @endif
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
