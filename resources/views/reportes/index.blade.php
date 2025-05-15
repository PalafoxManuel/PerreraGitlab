<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reportes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body class="back-container d-flex flex-column min-vh-100">

    {{-- Header --}}
    @include('Components.Header')

    @php
    $reportes = [
    [
    'title' => 'Reporte de maltrato',
    'description' => 'Reporta casos de maltrato animal.',
    'image' => 'ReporteMaltrato.png',
    'route' => route('reporte.create', 1),
    ],
    [
    'title' => 'Reporte de extravio',
    'description' => 'Reporta casos de extravío de una mascota.',
    'image' => 'ReporteExtravio.png',
    'route' => route('reporte.create', 2),
    ],
    ];

    if (session('perfil') === 'admin') {
    $reportes[] = [
    'title' => 'Reporte de vacuna',
    'description' => 'Registra la información de vacunas aplicadas a las mascotas.',
    'image' => 'AdminReporteVacuna.png',
    'route' => route('reporte.create', 3),
    ];
    $reportes[] = [
    'title' => 'Reporte de adopción',
    'description' => 'Informa sobre mascotas disponibles para adopción.',
    'image' => 'AdminReporteAdopcion.png',
    'route' => route('reporte.create', 4),
    ];
    }
    @endphp
    <div class="form-wrapper-2 flex-grow-1 d-flex">
        <div class="cards-container container py-4">
            <div class="row g-4">
                @foreach($reportes as $reporte)
                <div class="col-md-6">
                    <div class="card h-100 shadow">
                        <img src="{{ Vite::asset('resources/images/' . $reporte['image']) }}" class="card-img-top" alt="{{ $reporte['title'] }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $reporte['title'] }}</h5>
                            <p class="card-text flex-grow-1">{{ $reporte['description'] }}</p>
                            <a href="{{ $reporte['route'] }}" class="btn btn-danger mt-2">Generar reporte</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</body>

</html>