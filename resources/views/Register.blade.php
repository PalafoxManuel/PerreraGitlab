<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
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
    <div class="form-container bg-dark p-4 rounded">
      <h1 class="text-center text-white mb-4">Registro de Usuario</h1>

      @if ($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul></div>
      @endif

      <form method="POST" action="{{ route('register.post') }}" class="text-start">
        @csrf

        {{-- Nombre de usuario --}}
        <div class="form-group mb-3">
          <label class="register-text">Nombre de Usuario *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user-circle"></i></span>
            <input type="text"
                   name="Nombre_Usuario"
                   class="form-control"
                   placeholder="Nombre de usuario"
                   value="{{ old('Nombre_Usuario') }}"
                   required>
          </div>
        </div>

        {{-- Contraseña --}}
        <div class="form-group mb-3">
          <label class="register-text">Contraseña *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password"
                   name="Contrasena"
                   class="form-control"
                   placeholder="Contraseña"
                   required>
          </div>
        </div>

        {{-- Confirmar contraseña --}}
        <div class="form-group mb-3">
          <label class="register-text">Confirmar Contraseña *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input type="password"
                   name="Contrasena_confirmation"
                   class="form-control"
                   placeholder="Confirmar contraseña"
                   required>
          </div>
        </div>

        {{-- Sólo para admin logeado: rol + perrera --}}
        @if(session('perfil') === 'admin')
          {{-- Selector de rol --}}
          <div class="form-group mb-3">
            <label class="register-text">Rol *</label>
            <select name="rol" class="form-select" required>
              <option value="usuario" {{ old('rol')=='usuario' ? 'selected':'' }}>Cliente</option>
              <option value="admin"   {{ old('rol')=='admin'   ? 'selected':'' }}>Administrador</option>
            </select>
          </div>

          {{-- Selector de perrera --}}
          <div class="form-group mb-3">
            <label class="register-text">Asignar Perrera</label>
            <select name="Id_Perrera" class="form-select">
              <option value="">— Ninguna —</option>
              @foreach($perreras as $p)
                <option value="{{ $p->Id_Perrera }}"
                        {{ old('Id_Perrera')==$p->Id_Perrera ? 'selected':'' }}>
                  {{ $p->Nombre }}
                </option>
              @endforeach
            </select>
          </div>
        @else
          {{-- Invitado/usuario común --}}
          <input type="hidden" name="rol" value="usuario">
          <input type="hidden" name="Id_Perrera" value="">
        @endif

        <button type="submit" class="btn btn-primary btn-block w-100">
          Crear cuenta
        </button>

        <p class="text-center mt-3 text-white">
          ¿Ya tienes cuenta?
          <a href="{{ route('login') }}" class="text-primary">Inicia sesión aquí</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
