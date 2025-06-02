{{--  PAGOS  --}}
<div class="card mb-4 shadow">
  <div class="card-header bg-success text-white">
    <h5 class="mb-0">Pagos</h5>
  </div>

  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 10%;">ID</th>
          <th style="width: 15%;">Fecha</th>
          <th style="width: 15%;">Monto</th>
          <th style="width: 20%;">Método</th>
          <th style="width: 20%;">Reserva</th>
          <th style="width: 20%;" class="text-center">Acciones</th>
        </tr>
      </thead>
      <tbody>
        @forelse($pagos as $p)
          <tr>
            <td class="align-middle">{{ $p->Id_Pago }}</td>
            <td class="align-middle">
              {{ $p->reserva?->Fecha_Reserva
                    ? \Carbon\Carbon::parse($p->reserva->Fecha_Reserva)->format('d/m/Y')
                    : '—' }}
            </td>
            <td class="align-middle">${{ number_format($p->Monto, 2) }}</td>
            <td class="align-middle text-capitalize">{{ $p->Metodo_Pago }}</td>
            <td class="align-middle">#{{ $p->Id_Reserva }}</td>
            <td class="align-middle text-center">
              <form action="{{ route('pagos.destroy', $p->Id_Pago) }}" method="POST" class="d-inline">
                @csrf @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar pago?')" title="Eliminar">
                  <i class="fas fa-trash-alt"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr><td colspan="6" class="p-3">No hay pagos registrados.</td></tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
