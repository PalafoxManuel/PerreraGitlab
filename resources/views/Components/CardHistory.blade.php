@props(['mascota'])

@php
use Illuminate\Support\Str;

$imagen = $mascota->imagen ?? 'resources/images/default.png';
$esRutaVite = Str::startsWith($imagen, 'resources/');
$rutaImagen = $esRutaVite ? Vite::asset($imagen) : asset($imagen);
@endphp

<div class="card-history">
    <div class="history-header">
        <img src="{{ $rutaImagen }}" alt="{{ $mascota->Nombre }}" class="history-image" />

        <div class="history-info">
            <h3 class="history-name">{{ $mascota->Nombre }}</h3>

            @if ($mascota->adopcion)
            <p class="history-fecha">
                Adoptado el {{ \Carbon\Carbon::parse($mascota->adopcion->Fecha_Adopcion)->format('d/m/Y') }}
            </p>
            @endif
        </div>
    </div>

    <div class="history-body">
        <p class="history-description">
            {{ $mascota->Historial_Medico ?? 'Sin historial disponible.' }}
        </p>

        <ul class="mascota-detalles">
            <li><strong>Raza:</strong> {{ $mascota->Raza ?? 'Desconocida' }}</li>
            <li><strong>Edad:</strong> {{ $mascota->Edad ?? 'No especificada' }}</li>
            <li><strong>Género:</strong>
                @switch($mascota->Genero)
                @case('M') Macho @break
                @case('H') Hembra @break
                @default No especificado
                @endswitch
            </li>
            <li><strong>Color:</strong> {{ $mascota->Color ?? 'N/A' }}</li>
            <li><strong>Peso:</strong> {{ $mascota->Peso ? $mascota->Peso . ' kg' : 'No especificado' }}</li>
            <li><strong>Tipo:</strong> {{ $mascota->tipo->Nombre ?? 'No definido' }}</li>
            <li><strong>Rescatado de la calle:</strong> {{ $mascota->RescatadoCalle ? 'Sí' : 'No' }}</li>
            <li><strong>Responsable:</strong> {{ $mascota->usuario->Nombre ?? 'Ninguno asignado' }}</li>
        </ul>
    </div>
</div>