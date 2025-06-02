<div class="card mb-4 shadow">
  <div class="card-header bg-light">
    <h5 class="mb-0">Servicios</h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-striped mb-0">
      <thead class="table-light">
        <tr>
          <th style="width: 10%;">ID</th>
          <th style="width: 75%;">Servicio</th>
          <th style="width: 15%;">Tarifa</th>
        </tr>
      </thead>
      <tbody>
        @foreach($servicios as $s)
          <tr>
            <td class="align-middle">{{ $s->Id_Servicio }}</td>
            <td class="align-middle">{{ $s->Nombre_Servicio }}</td>
            <td class="align-middle">${{ number_format($s->Tarifa, 2) }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
