<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro de Usuario</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap y FontAwesome -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet">
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    rel="stylesheet">

  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="back-container d-flex flex-column min-vh-100">

  <div class="logo-container text-center py-3">
    <img class="logo-img" src="{{ Vite::asset('resources/images/Logo.png') }}" alt="Logo">
    <p class="logo-text-login text-white fs-4 fw-bold">Huellitas Felices</p>
  </div>

  <div class="form-wrapper-LogIn flex-grow-1 d-flex">
    <div class="form-container bg-dark text-white p-4 rounded shadow mx-auto" style="max-width:400px;">
      <h1 class="text-center mb-4">Registro de Usuario</h1>

      @if($errors->any())
        <div class="alert alert-danger"><ul class="mb-0">
          @foreach($errors->all() as $e) <li>{{ $e }}</li>@endforeach
        </ul></div>
      @endif

      <form method="POST" action="{{ route('register.post') }}">
        @csrf

        {{-- Usuario --}}
        <div class="mb-3">
          <label class="form-label">Nombre de Usuario *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input
              type="text"
              name="Nombre_Usuario"
              class="form-control"
              value="{{ old('Nombre_Usuario') }}"
              required>
          </div>
        </div>

        {{-- Contraseña --}}
        <div class="mb-3">
          <label class="form-label">Contraseña *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input
              type="password"
              name="Contrasena"
              class="form-control"
              required>
          </div>
        </div>

        {{-- Confirmar Contraseña --}}
        <div class="mb-3">
          <label class="form-label">Confirmar Contraseña *</label>
          <div class="input-group">
            <span class="input-group-text"><i class="fas fa-lock"></i></span>
            <input
              type="password"
              name="Contrasena_confirmation"
              class="form-control"
              required>
          </div>
        </div>

        {{-- Siempre: selección de Sucursal (Id_Perrera) --}}
        <div class="mb-3">
          <label class="form-label">Sucursal *</label>
          <select name="Id_Perrera" class="form-select" required>
            <option value="">— Selecciona una sucursal —</option>
            @foreach($perreras as $p)
              <option
                value="{{ $p->Id_Perrera }}"
                {{ old('Id_Perrera')==$p->Id_Perrera ? 'selected':'' }}>
                {{ $p->Nombre }}
              </option>
            @endforeach
          </select>
          @error('Id_Perrera')<div class="text-danger mt-1">{{ $message }}</div>@enderror
        </div>

        @php
          // El primer admin puede crearse incluso sin sesión
          $adminExists = isset($adminExists) ? $adminExists : false;
          $allowAdmin  = session('perfil')==='admin' || !$adminExists;
        @endphp

        @if($allowAdmin)
          {{-- Rol --}}
          <div class="mb-3">
            <label class="form-label">Rol *</label>
            <select name="rol" id="rol" class="form-select" required>
              <option value="usuario" {{ old('rol')=='usuario'?'selected':'' }}>Cliente</option>
              <option value="admin"   {{ old('rol')=='admin'  ?'selected':'' }}>Administrador</option>
            </select>
          </div>

          {{-- Cliente existente (sólo si rol = usuario) --}}
          <div class="mb-3" id="cliente-section">
            <label class="form-label">Cliente asociado *</label>
            <select name="Id_Cliente" class="form-select">
              <option value="">— Selecciona un cliente —</option>
              @foreach($clientes as $c)
                <option
                  value="{{ $c->Id_Cliente }}"
                  {{ old('Id_Cliente')==$c->Id_Cliente?'selected':'' }}>
                  {{ $c->Nombre_Completo }}
                </option>
              @endforeach
            </select>
            @error('Id_Cliente')<div class="text-danger mt-1">{{ $message }}</div>@enderror
          </div>

          {{-- Script para mostrar/ocultar cliente-section --}}
          <script>
            document.addEventListener('DOMContentLoaded', ()=>{
              const rol = document.getElementById('rol');
              const sec = document.getElementById('cliente-section');
              const toggle = ()=>{
                if(rol.value==='usuario'){
                  sec.style.display='block';
                  sec.querySelector('select').required = true;
                } else {
                  sec.style.display='none';
                  sec.querySelector('select').required = false;
                  sec.querySelector('select').value = '';
                }
              };
              rol.addEventListener('change', toggle);
              toggle();
            });
          </script>
        @else
          {{-- Datos para nuevo cliente --}}
          <h5 class="mt-4">Tus datos</h5>
          <div class="mb-3">
            <label class="form-label">Nombre completo *</label>
            <input
              type="text"
              name="Nombre_Completo"
              class="form-control"
              value="{{ old('Nombre_Completo') }}"
              required>
          </div>
          <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input
              type="text"
              name="Numero_Contacto"
              class="form-control"
              value="{{ old('Numero_Contacto') }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input
              type="email"
              name="Correo_Electronico"
              class="form-control"
              value="{{ old('Correo_Electronico') }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Calle</label>
            <input
              type="text"
              name="Calle"
              class="form-control"
              value="{{ old('Calle') }}">
          </div>
          <div class="mb-3">
            <label class="form-label">Código Postal</label>
            <input
              type="text"
              name="Codigo_Postal"
              class="form-control"
              value="{{ old('Codigo_Postal') }}">
          </div>
        @endif

        <button type="submit" class="btn btn-primary w-100">Crear cuenta</button>

        <p class="text-center mt-3 text-white">
          ¿Ya tienes cuenta?
          <a href="{{ route('login') }}" class="text-primary">Inicia sesión aquí</a>
        </p>
      </form>
    </div>
  </div>
</body>
</html>
