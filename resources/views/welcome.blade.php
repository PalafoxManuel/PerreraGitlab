<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <x-Header />

    <main class="content">
        <h2>Mascotas en Adopción</h2>

        <div class="card-grid">
            <x-Card
                nombre="Firulais"
                imagen="resources/images/PerroChico.png"
                descripcion="Un perrito juguetón y cariñoso, esperando un hogar."
                link="{{ route('adoptar') }}"
                accion="Adoptar" />
            <x-Card
                nombre="Firulais"
                imagen="resources/images/PerroMediano.png"
                descripcion="Un perrito juguetón y cariñoso, esperando un hogar."
                link="{{ route('adoptar') }}"
                accion="Adoptar" />
            <x-Card
                nombre="Firulais"
                imagen="resources/images/PerroGrande.png"
                descripcion="Un perrito juguetón y cariñoso, esperando un hogar."
                link="{{ route('adoptar') }}"
                accion="Adoptar" />
            <x-Card
                nombre="Michi"
                imagen="resources/images/Gato.png"
                descripcion="Gatita tranquila, ideal para departamentos."
                link="{{ route('adoptar') }}"
                accion="Adoptar" />
        </div>
        @php
        $mascotas = [
        (object)[
        'Nombre' => 'Luna',
        'imagen' => 'resources/images/PerroGrande.png',
        'Raza' => 'Labrador',
        'Edad' => 4,
        'Genero' => 'H',
        'Color' => 'Dorado',
        'Peso' => 25,
        'RescatadoCalle' => true,
        'Historial_Medico' => 'Vacunada, esterilizada y desparasitada.',
        'tipo' => (object)['Nombre' => 'Perro'],
        'usuario' => (object)['Nombre' => 'María Fernández'],
        'adopcion' => (object)['Fecha_Adopcion' => '2023-11-10']
        ],
        (object)[
        'Nombre' => 'Firulais',
        'imagen' => 'resources/images/PerroChico.png',
        'Raza' => 'Chihuahua',
        'Edad' => 2,
        'Genero' => 'M',
        'Color' => 'Marrón claro',
        'Peso' => 3,
        'RescatadoCalle' => false,
        'Historial_Medico' => 'Vacunado y en tratamiento antipulgas.',
        'tipo' => (object)['Nombre' => 'Perro'],
        'usuario' => (object)['Nombre' => 'Carlos Méndez'],
        'adopcion' => (object)['Fecha_Adopcion' => '2024-05-02']
        ],
        (object)[
        'Nombre' => 'Michi',
        'imagen' => 'resources/images/Gato.png',
        'Raza' => 'Criolla',
        'Edad' => 3,
        'Genero' => 'H',
        'Color' => 'Gris con blanco',
        'Peso' => 4,
        'RescatadoCalle' => true,
        'Historial_Medico' => 'Vacunada, esterilizada y desparasitada.',
        'tipo' => (object)['Nombre' => 'Gato'],
        'usuario' => (object)['Nombre' => 'Laura Soto'],
        'adopcion' => (object)['Fecha_Adopcion' => '2024-08-15']
        ],
        (object)[
        'Nombre' => 'Max',
        'imagen' => 'resources/images/PerroMediano.png',
        'Raza' => 'Border Collie',
        'Edad' => 5,
        'Genero' => 'M',
        'Color' => 'Blanco y negro',
        'Peso' => 18,
        'RescatadoCalle' => false,
        'Historial_Medico' => 'Vacunado. En tratamiento para la piel.',
        'tipo' => (object)['Nombre' => 'Perro'],
        'usuario' => (object)['Nombre' => 'Sandra Ruiz'],
        'adopcion' => (object)['Fecha_Adopcion' => '2024-12-01']
        ],
        ];
        @endphp

        <h2>Historial Médico de Mascotas</h2>
        <br>
        <section class="seccion-historial">

            @foreach ($mascotas as $mascota)
            <x-CardHistory :mascota="$mascota" />
            @endforeach
        </section>
        @php
        $mostrarFormulario = false;
        @endphp

        <!-- Botón para mostrar el modal -->
        <button onclick="document.getElementById('modal-form').classList.remove('hidden')" class="toggle-form-button">
            Añadir Información
        </button>

        <!-- Modal oculto inicialmente -->
        <div id="modal-form" class="modal hidden">
            <!-- Fondo oscuro -->
            <div class="modal-backdrop" onclick="document.getElementById('modal-form').classList.add('hidden')"></div>

            <!-- Contenido del modal centrado -->
            <div class="modal-content">
                <form method="POST" action="/guardar/formulario">
                    @csrf

                    <x-FormField
                        id="info_mascota"
                        label="Información adicional"
                        name="info_mascota"
                        type="textarea"
                        placeholder="Escribe algo..."
                        required />

                    <div class="modal-buttons">
                        <button type="submit" class="submit-button">Guardar</button>
                        <button type="button" onclick="document.getElementById('modal-form').classList.add('hidden')" class="cancel-button">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>

    </main>
</body>

</html>