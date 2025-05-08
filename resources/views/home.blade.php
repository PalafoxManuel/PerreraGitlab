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
                'image' => 'resources/images/Agregar.png',
                'link' => route('mascotas.agregar')
                ],
                [
                'title' => 'Adoptar',
                'description' => '¿Necesitas dejar temporalmente a tu mascota en buenas manos? Encuentra cuidadores confiables dispuestos a cuidar de tu amigo peludo mientras estás fuera.',
                'image' => 'resources/images/Adoptar.png',
                'link' => route('adoptar')
                ],
                [
                'title' => 'Alojamiento',
                'description' => 'Encuentra alojamiento temporal para tu mascota con cuidadores confiables.',
                'image' => 'resources/images/Alojamiento.png',
                'link' => '#'
                ],
                [
                'title' => 'Vacunación',
                'description' => 'Consulta servicios de vacunación para mantener la salud de tu mascota al día.',
                'image' => 'resources/images/Vacunacion.png',
                'link' => route('vacunacion')
                ],
                [
                'title' => 'Baño',
                'description' => 'Busca servicios de baño para mantener a tu mascota limpia y fresca.',
                'image' => 'resources/images/Baño.png',
                'link' => '#'
                ],
                [
                'title' => 'Corte de Pelo',
                'description' => 'Encuentra profesionales para el corte de pelo de tu mascota.',
                'image' => 'resources/images/CortePelo.png',
                'link' => '#'
                ],
                [
                'title' => 'Corte de Uñas',
                'description' => 'Accede a servicios de corte de uñas para tu mascota.',
                'image' => 'resources/images/CorteUñas.png',
                'link' => '#'
                ],
                [
                'title' => 'Historial',
                'description' => 'Mantén un registro detallado de todos los servicios que has utilizado, desde paseos hasta visitas al veterinario.',
                'image' => 'resources/images/Historial.png',
                'link' => '#'
                ],
                [
                'title' => 'Generar reporte',
                'description' => 'Reporta preocupaciones como maltrato animal, extravío o vacunación de tu mascota.',
                'image' => 'resources/images/Reporte.png',
                'link' => '#'
                ],
                ];
                @endphp

                @foreach ($cardsData as $card)
                <div class="col-md-4">
                    <x-card
                        :imagen="$card['image']"
                        :nombre="$card['title']"
                        :descripcion="$card['description']"
                        :accion="'Ir'"
                        :link="$card['link']" />
                </div>
                @endforeach
                @auth
                <p>Estás logueado como: {{ Auth::user()->Nombre_Usuario }}</p>
                @else
                <p>No estás logueado.</p>
                @endauth
            </div>
        </div>
    </div>
</body>

</html>