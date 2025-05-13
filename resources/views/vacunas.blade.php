{{-- resources/views/vacunacion/index.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vacunar Mascota</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tus estilos y scripts con Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-light">
    <div class="container py-5">
        <h1 class="mb-4">Vacunar Mascota</h1>

        {{-- Mensajes de éxito --}}
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Formulario de vacunación --}}
        <form action="{{ route('vacunacion.store') }}" method="POST" class="card p-4 bg-white shadow-sm">
            @csrf

            <div class="mb-3">
                <label for="Id_Mascota" class="form-label">Mascota</label>
                <select name="Id_Mascota" id="Id_Mascota" class="form-select @error('Id_Mascota') is-invalid @enderror" required>
                    <option value="">-- Selecciona una mascota --</option>
                    @foreach($mascotas as $mascota)
                        <option value="{{ $mascota->Id_Mascota }}"
                            {{ old('Id_Mascota') == $mascota->Id_Mascota ? 'selected' : '' }}>
                            {{ $mascota->Nombre }}
                        </option>
                    @endforeach
                </select>
                @error('Id_Mascota')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="Id_Vacuna" class="form-label">Vacuna</label>
                <select name="Id_Vacuna" id="Id_Vacuna" class="form-select @error('Id_Vacuna') is-invalid @enderror" required>
                    <option value="">-- Selecciona una vacuna --</option>
                    @foreach($vacunas as $vacuna)
                        <option value="{{ $vacuna->Id_Vacuna }}"
                            {{ old('Id_Vacuna') == $vacuna->Id_Vacuna ? 'selected' : '' }}>
                            {{ $vacuna->Nombre }}
                        </option>
                    @endforeach
                </select>
                @error('Id_Vacuna')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="Fecha_Vacunacion" class="form-label">Fecha de Vacunación</label>
                    <input type="date"
                           name="Fecha_Vacunacion"
                           id="Fecha_Vacunacion"
                           value="{{ old('Fecha_Vacunacion', now()->toDateString()) }}"
                           class="form-control @error('Fecha_Vacunacion') is-invalid @enderror"
                           required>
                    @error('Fecha_Vacunacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="Numero_Lote" class="form-label">Número de Lote</label>
                    <input type="text"
                           name="Numero_Lote"
                           id="Numero_Lote"
                           value="{{ old('Numero_Lote') }}"
                           class="form-control @error('Numero_Lote') is-invalid @enderror"
                           required>
                    @error('Numero_Lote')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3">
                <label for="Dosis" class="form-label">Dosis</label>
                <input type="text"
                       name="Dosis"
                       id="Dosis"
                       value="{{ old('Dosis') }}"
                       class="form-control @error('Dosis') is-invalid @enderror"
                       placeholder="Ej. 1 ml, 2 ml"
                       required>
                @error('Dosis')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">Vacunar</button>
            </div>
        </form>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
