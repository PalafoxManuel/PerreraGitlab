<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Crear Servicio</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="back-container d-flex flex-column min-vh-100">

  @include('Components.Header')

  <div class="container my-5" style="max-width:500px;">
    <div class="card shadow">
      <div class="card-body">
        <h2 class="card-title mb-4 text-center">Nuevo Servicio</h2>

        @if($errors->any())
          <div class="alert alert-danger"><ul class="mb-0">
            @foreach($errors->all() as $e)
              <li>{{ $e }}</li>
            @endforeach
          </ul></div>
        @endif

        <form method="POST" action="{{ route('servicios.store') }}">
          @csrf

          <div class="mb-3">
            <label class="form-label">Nombre del Servicio *</label>
            <input
              type="text"
              name="Nombre_Servicio"
              class="form-control"
              value="{{ old('Nombre_Servicio') }}"
              required>
          </div>

          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea
              name="Descripcion"
              class="form-control"
              rows="3">{{ old('Descripcion') }}</textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Tarifa *</label>
            <input
              type="number"
              name="Tarifa"
              class="form-control"
              step="0.01"
              min="0"
              value="{{ old('Tarifa') }}"
              required>
          </div>

        <div class="mb-3">
            <label class="form-label">Cupos disponibles *</label>
            <input
                type="number"
                name="Disponible"
                class="form-control"
                min="0"
                value="{{ old('Disponible', 1) }}"
                required>
        </div>

          <button type="submit" class="btn btn-success w-100">
            <i class="fas fa-plus me-2"></i>Crear Servicio
          </button>
          <a
            href="{{ route('servicios.index') }}"
            class="btn btn-secondary w-100 mt-2">
            Volver al listado
          </a>
        </form>
      </div>
    </div>
  </div>

</body>
</html>
