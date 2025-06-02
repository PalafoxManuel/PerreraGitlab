<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <title>Registro de Perrera</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/Auth.css', 'resources/js/app.js'])
</head>

<body class="back-container">
  <div class="logo-container">
    <img class="logo-img" src="{{ Vite::asset('resources/images/Logo.png') }}" alt="Logo">
    <p class="logo-text-login">Huellitas Felices</p>
  </div>

  <div class="form-wrapper-LogIn d-flex justify-content-center align-items-center">
    <div class="form-container bg-dark p-4 rounded" style="max-width: 500px;">
      <h1 class="text-center text-white mb-4">Registro de Perrera</h1>

      @if($errors->any())
      <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
      @endforeach
      </ul>
      </div>
    @endif

      <form method="POST" action="{{ route('perreras.store') }}" class="text-start" id="perreraForm" novalidate>
        @csrf

        {{-- Nombre --}}
        <div class="form-group mb-3">
          <label class="register-text text-white">Nombre *</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-home"></i>
            </span>
            <input type="text" name="Nombre" id="Nombre" class="form-control @error('Nombre') is-invalid @enderror"
              placeholder="Nombre de la perrera" value="{{ old('Nombre') }}" required minlength="3" maxlength="50">
          </div>
          @error('Nombre')
        <div class="invalid-feedback d-block">
        {{ $message }}
        </div>
      @enderror
          <div class="invalid-feedback" id="nombre-error">
            El nombre debe tener entre 3 y 50 caracteres.
          </div>
        </div>

        {{-- Ubicación --}}
        <div class="form-group mb-3">
          <label class="register-text text-white">Ubicación *</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-map-marker-alt"></i>
            </span>
            <input type="text" name="Ubicacion" id="Ubicacion"
              class="form-control @error('Ubicacion') is-invalid @enderror" placeholder="Ubicación"
              value="{{ old('Ubicacion') }}" required minlength="5" maxlength="100">
          </div>
          @error('Ubicacion')
        <div class="invalid-feedback d-block">
        {{ $message }}
        </div>
      @enderror
          <div class="invalid-feedback" id="ubicacion-error">
            La ubicación debe tener entre 5 y 100 caracteres.
          </div>
        </div>

        {{-- Tamaño personal --}}
        <div class="form-group mb-3">
          <label class="register-text text-white">Tamaño del Personal</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-users"></i>
            </span>
            <input type="number" name="Tamano_Personal" id="Tamano_Personal"
              class="form-control @error('Tamano_Personal') is-invalid @enderror" placeholder="Número de empleados"
              value="{{ old('Tamano_Personal') }}" min="0" max="1000">
          </div>
          @error('Tamano_Personal')
        <div class="invalid-feedback d-block">
        {{ $message }}
        </div>
      @enderror
          <div class="invalid-feedback" id="personal-error">
            El tamaño del personal debe ser entre 0 y 1000.
          </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block w-100 mb-3">
          Crear Perrera
        </button>

        <p class="text-center mt-3 text-white">
          <a href="{{ route('perreras.index') }}" class="text-primary">
            Volver al listado de perreras
          </a>
        </p>
      </form>
    </div>
  </div>

  <script>
    // Validación del lado del cliente
    document.getElementById('perreraForm').addEventListener('submit', function (event) {
      let isValid = true;

      // Validar Nombre
      const nombre = document.getElementById('Nombre');
      if (nombre.value.trim() === '' || nombre.value.length < 3 || nombre.value.length > 50) {
        nombre.classList.add('is-invalid');
        document.getElementById('nombre-error').textContent =
          nombre.value.trim() === '' ?
            'El nombre es requerido.' :
            'El nombre debe tener entre 3 y 50 caracteres.';
        isValid = false;
      } else {
        nombre.classList.remove('is-invalid');
      }

      // Validar Ubicación
      const ubicacion = document.getElementById('Ubicacion');
      if (ubicacion.value.trim() === '' || ubicacion.value.length < 5 || ubicacion.value.length > 100) {
        ubicacion.classList.add('is-invalid');
        document.getElementById('ubicacion-error').textContent =
          ubicacion.value.trim() === '' ?
            'La ubicación es requerida.' :
            'La ubicación debe tener entre 5 y 100 caracteres.';
        isValid = false;
      } else {
        ubicacion.classList.remove('is-invalid');
      }

      // Validar Tamaño Personal
      const personal = document.getElementById('Tamano_Personal');
      if (personal.value !== '' && (personal.value < 0 || personal.value > 1000)) {
        personal.classList.add('is-invalid');
        document.getElementById('personal-error').textContent =
          'El tamaño del personal debe ser entre 0 y 1000.';
        isValid = false;
      } else {
        personal.classList.remove('is-invalid');
      }

      if (!isValid) {
        event.preventDefault();
        event.stopPropagation();
      }
    });

    // Validación en tiempo real para mejor UX
    document.getElementById('Nombre').addEventListener('input', function () {
      if (this.value.length >= 3 && this.value.length <= 50) {
        this.classList.remove('is-invalid');
      }
    });

    document.getElementById('Ubicacion').addEventListener('input', function () {
      if (this.value.length >= 5 && this.value.length <= 100) {
        this.classList.remove('is-invalid');
      }
    });

    document.getElementById('Tamano_Personal').addEventListener('input', function () {
      if (this.value === '' || (this.value >= 0 && this.value <= 1000)) {
        this.classList.remove('is-invalid');
      }
    });
  </script>
</body>

</html>