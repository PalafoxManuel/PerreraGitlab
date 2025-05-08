@props([
'imagen' => 'resources/images/default.png', // Ruta relativa dentro de resources
'nombre' => 'Nombre de la Mascota',
'descripcion' => 'Descripción de la mascota. Esta es una breve reseña de su historia o estado.',
'accion' => 'Ver más',
'link' => '#'
])

@php
use Illuminate\Support\Str;

// Si la ruta ya es completa (http o /storage), no aplicar Vite
$esRutaVite = Str::startsWith($imagen, 'resources/');
$rutaImagen = $esRutaVite ? Vite::asset($imagen) : $imagen;
@endphp

<div class="card">
    <div class="image-container">
        <img src="{{ $rutaImagen }}" alt="{{ $nombre }}" class="pet-image" />
    </div>
    <div class="card-content">
        <div class="card-title">{{ $nombre }}</div>
        <p class="card-description">{{ $descripcion }}</p>
        <div class="card-footer">
            <a href="{{ route('mascotas.agregar') }}" class="card-button">{{ $accion }}</a>
        </div>
    </div>
</div>