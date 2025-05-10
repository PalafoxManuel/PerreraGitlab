{{-- resources/views/home.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Inicio</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap y FontAwesome -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="back-container d-flex flex-column min-vh-100">

  {{-- Header --}}
  @include('Components.Header')

  @php
    use App\Models\Servicio;
    use Illuminate\Support\Str;

    // 1) Mapa de título → imagen
    $imageMap = [
      'Crear Perrera'    => 'CrearPerrera.png',
      'Agregar mascota'  => 'Agregar.png',
      'Agregar servicio' => 'Pajaro.png',
      'Adoptar'          => 'Adoptar.png',
      'Alojamiento'      => 'Alojamiento.png',
      'Vacunación'       => 'Vacunacion.png',
      'Baño'             => 'Baño.png',
      'Corte de Pelo'    => 'CortePelo.png',
      'Corte de Uñas'    => 'CorteUñas.png',
      'Historial'        => 'Historial.png',
      'Generar reporte'  => 'Reporte.png',
    ];

    // 2) Tus funcionalidades “estáticas”
    $cards = [
      ['title'=>'Agregar mascota','description'=>'Explora una lista de mascotas adorables que están buscando un hogar amoroso.','route'=>route('mascotas.create')],
      ['title'=>'Agregar servicio','description'=>'Define un nuevo servicio (baño, corte, vacunación, etc.) y su tarifa.','route'=>route('servicios.create')],
      ['title'=>'Adoptar','description'=>'Deja temporalmente a tu mascota en buenas manos.','route'=>route('adoptar')],
      ['title'=>'Alojamiento','description'=>'Encuentra alojamiento temporal para tu mascota con cuidadores confiables.','route'=>'#'],
      ['title'=>'Vacunación','description'=>'Consulta servicios de vacunación para mantener la salud de tu mascota al día.','route'=>'#'],
      ['title'=>'Baño','description'=>'Servicios de baño para mantener a tu mascota limpia y fresca.','route'=>'#'],
      ['title'=>'Corte de Pelo','description'=>'Encuentra profesionales para el corte de pelo de tu mascota.','route'=>'#'],
      ['title'=>'Corte de Uñas','description'=>'Corte de uñas seguro y cómodo para tu mascota.','route'=>'#'],
      ['title'=>'Historial','description'=>'Registro detallado de todos los servicios que has utilizado.','route'=>'#'],
      ['title'=>'Generar reporte','description'=>'Reporta maltrato, extravío o necesidades de vacunación de tu mascota.','route'=>'#'],
    ];

    // 3) Creamos un índice de servicios normalizado: sin acentos y en minúscula
    $servByKey = Servicio::all()
      ->mapWithKeys(function($s){
        // ascii quita acentos, lower() para minúsculas
        $key = Str::lower(Str::ascii($s->Nombre_Servicio));
        return [$key => $s];
      });

    // 4) Recorremos $cards y, si su título normalizado existe en $servByKey,
    //    lo convertimos en “Reservar” con su ruta correcta.
    foreach($cards as &$card) {
      $norm = Str::lower(Str::ascii($card['title']));
      if(isset($servByKey[$norm])) {
        $sv = $servByKey[$norm];
        $card['route']      = route('reserva_servicios.create',['service'=>$sv->Id_Servicio]);
        $card['buttonText'] = 'Reservar';
      } else {
        $card['buttonText'] = 'Ir';
      }
    }
    unset($card);
  @endphp

  <div class="form-wrapper-2 flex-grow-1 d-flex">
    <div class="cards-container container py-4">
      <div class="row g-4">

        {{-- A) Tarjeta fija para admin --}}
        @if(session('perfil')==='admin')
          <div class="col-md-4">
            <div class="card h-100 shadow">
              <img src="{{ Vite::asset('resources/images/'.$imageMap['Crear Perrera']) }}"
                   class="card-img-top" alt="Crear Perrera">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">Crear Perrera</h5>
                <p class="card-text flex-grow-1">
                  Da de alta una nueva perrera en el sistema. Solo administradores.
                </p>
                <a href="{{ route('perreras.create') }}" class="btn btn-primary mt-2">Ir</a>
              </div>
            </div>
          </div>
        @endif

        {{-- B) Todas las tarjetas (estáticas + “Reservar”) --}}
        @foreach($cards as $card)
          <div class="col-md-4">
            <div class="card h-100 shadow">
              <img src="{{ Vite::asset('resources/images/' . ($imageMap[$card['title']] ?? 'default.png')) }}"
                   class="card-img-top" alt="{{ $card['title'] }}">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $card['title'] }}</h5>
                <p class="card-text flex-grow-1">{{ $card['description'] }}</p>
                <a href="{{ $card['route'] }}" class="btn btn-primary mt-2">
                  {{ $card['buttonText'] }}
                </a>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>
  </div>

</body>
</html>
