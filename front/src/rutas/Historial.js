import React from 'react';
import Header from '../componentes/Header';
import CardHistory from '../componentes/CardHistory';
import '../rutas/styles/Header.css'; // Asegúrate de importar los estilos necesarios
import '../rutas/styles/Home.css'; // Asegúrate de importar los estilos necesarios

const Historial = () => {
  // Ejemplo de datos estáticos para las tarjetas
  const historialServicios = [
    {
      tipoServicio: 'Baño',
      mascota: 'Firulais',
      costo: 25,
      fecha: '2023-06-01',
      detalles: 'Baño completo con corte de uñas.',
      raza: 'Labrador Retriever', // Perro grande
    },
    {
      tipoServicio: 'Vacunación',
      mascota: 'Luna',
      costo: 15,
      fecha: '2023-06-03',
      detalles: 'Vacuna anual y revisión médica.',
      raza: 'Persa', // Gato
    },
    {
      tipoServicio: 'Corte de Pelo',
      mascota: 'Max',
      costo: 30,
      fecha: '2023-06-05',
      detalles: 'Corte de pelo estilo corto y cepillado.',
      raza: 'pastor alemán', // Perro mediano
    },
    {
      tipoServicio: 'Corte de Uñas',
      mascota: 'Milo',
      costo: 20,
      fecha: '2023-06-07',
      detalles: 'Corte de uñas y limpieza.',
      raza: 'Gato Doméstico', // Gato
    },
    {
      tipoServicio: 'Limpieza de Pico',
      mascota: 'Piolín',
      costo: 10,
      fecha: '2023-06-10',
      detalles: 'Limpieza y cuidado del pico.',
      raza: 'Canario', // Pájaro
    },
  ];

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2">
          {historialServicios.map((servicio, index) => (
            <CardHistory key={index} servicio={servicio} />
          ))}
        </div>
      </div>
    </div>
  );
};

export default Historial;
