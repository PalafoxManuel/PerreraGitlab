<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap y FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="back-container d-flex flex-column min-vh-100">

    {{-- Header --}}
    @include('Components.Header')

    <div class="form-wrapper-2 flex-grow-1 d-flex">
        <div class="cards-container container py-4">
            <div class="row g-4">
                @php
                $cardsData = [
                [
                'title' => 'Agregar mascota',
                'description' => 'Explora una lista de mascotas adorables que están buscando un hogar amoroso. Encuentra tu compañero perfecto y comienza una nueva aventura juntos.',
                'image' => Vite::asset('resources/images/Agregar.png')
                ],
                [
                'title' => 'Adoptar',
                'description' => '¿Necesitas dejar temporalmente a tu mascota en buenas manos? Encuentra cuidadores confiables dispuestos a cuidar de tu amigo peludo mientras estás fuera.',
                'image' => Vite::asset('resources/images/Adoptar.png')
                ],
                [
                'title' => 'Alojamiento',
                'description' => 'Encuentra alojamiento temporal para tu mascota con cuidadores confiables.',
                'image' => Vite::asset('resources/images/Alojamiento.png')
                ],
                [
                'title' => 'Vacunación',
                'description' => 'Consulta servicios de vacunación para mantener la salud de tu mascota al día.',
                'image' => Vite::asset('resources/images/Vacunacion.png')
                ],
                [
                'title' => 'Baño',
                'description' => 'Busca servicios de baño para mantener a tu mascota limpia y fresca.',
                'image' => Vite::asset('resources/images/Baño.png')
                ],
                [
                'title' => 'Corte de Pelo',
                'description' => 'Encuentra profesionales para el corte de pelo de tu mascota.',
                'image' => Vite::asset('resources/images/CortePelo.png')
                ],
                [
                'title' => 'Corte de Uñas',
                'description' => 'Accede a servicios de corte de uñas para tu mascota.',
                'image' => Vite::asset('resources/images/CorteUñas.png')
                ],
                [
                'title' => 'Historial',
                'description' => 'Mantén un registro detallado de todos los servicios que has utilizado, desde paseos hasta visitas al veterinario.',
                'image' => Vite::asset('resources/images/Historial.png')
                ],
                [
                'title' => 'Generar reporte',
                'description' => 'Reporta preocupaciones como maltrato animal, extravío o vacunación de tu mascota.',
                'image' => Vite::asset('resources/images/Reporte.png')
                ],
                ];
                @endphp

                @foreach ($cardsData as $card)
                <div class="col-md-4">
                    <div class="card h-100 shadow">
                        <img src="{{ $card['image'] }}" class="card-img-top" alt="{{ $card['title'] }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $card['title'] }}</h5>
                            <p class="card-text flex-grow-1">{{ $card['description'] }}</p>
                            <a href="#" class="btn btn-primary mt-2">Ir</a>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>

</body>

</html>