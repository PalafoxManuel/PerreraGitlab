{{-- resources/views/panel-admin.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel Admin</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap y FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="back-container d-flex flex-column min-vh-100">

  {{-- Navbar --}}
  @include('Components.Header')

  <div class="container py-4 flex-grow-1">

    {{-- 1) Mostrar alertas (flash messages) --}}
    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- 2) Aquí incluimos cada sección partial --}}
    @include('admin.usuarios')
    @include('admin.mascotas')
    @include('admin.vacunas')
    @include('admin.vacunaciones')
    @include('admin.reservaciones')
    @include('admin.perreras')
    @include('admin.servicios')

    @include('admin.vacunas-sintomas')

    @include('admin.mascotas-enfermedades-contagiosas')

  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
