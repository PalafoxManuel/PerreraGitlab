<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Perrera</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet">
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
      rel="stylesheet">
    @vite(['resources/css/Auth.css', 'resources/js/app.js'])
</head>

<body class="back-container">
  <div class="logo-container">
    <img
      class="logo-img"
      src="{{ Vite::asset('resources/images/Logo.png') }}"
      alt="Logo">
    <p class="logo-text-login">Huellitas Felices</p>
  </div>

  <div
    class="form-wrapper-LogIn d-flex justify-content-center align-items-center">
    <div class="form-container bg-dark p-4 rounded">
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

      <form
        method="POST"
        action="{{ route('perreras.store') }}"
        class="text-start">
        @csrf

        {{-- Nombre --}}
        <div class="form-group mb-3">
          <label class="register-text">Nombre *</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-home"></i>
            </span>
            <input
              type="text"
              name="Nombre"
              class="form-control"
              placeholder="Nombre de la perrera"
              value="{{ old('Nombre') }}"
              required>
          </div>
        </div>

        {{-- Ubicación --}}
        <div class="form-group mb-3">
          <label class="register-text">Ubicación *</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-map-marker-alt"></i>
            </span>
            <input
              type="text"
              name="Ubicacion"
              class="form-control"
              placeholder="Ubicación"
              value="{{ old('Ubicacion') }}"
              required>
          </div>
        </div>

        {{-- Tamaño personal --}}
        <div class="form-group mb-3">
          <label class="register-text">Tamaño del Personal</label>
          <div class="input-group">
            <span class="input-group-text">
              <i class="fas fa-users"></i>
            </span>
            <input
              type="number"
              name="Tamano_Personal"
              class="form-control"
              placeholder="Número de empleados"
              value="{{ old('Tamano_Personal') }}">
          </div>
        </div>

        <button
          type="submit"
          class="btn btn-primary btn-block w-100">
          Crear Perrera
        </button>

        <p class="text-center mt-3 text-white">
          <a
            href="{{ route('perreras.index') }}"
            class="text-primary">
            Volver al listado de perreras
          </a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
