import React from 'react';
import Card from '../componentes/Card'; // Adjusted path to '../componentes/Card'
import Header from '../componentes/Header';
import Agregar from '../img/Agregar.png';
import Adoptar from '../img/Adoptar.png';
import Alojamiento from '../img/Alojamiento.png';
import Vacunacion from '../img/Vacunacion.png';
import Baño from '../img/Baño.png';
import CortePelo from '../img/CortePelo.png';
import CorteUñas from '../img/CorteUñas.png';
import Historial from '../img/Historial.png';
import Reporte from '../img/Reporte.png';
import AgregarAdmin from '../img/AgregarAdmin.png'; // Assuming you have these images
import AgregarVacuna from '../img/AgregarVacuna.png'; // Assuming you have these images
import './styles/Home.css'; // Adjusted path to './styles/Home.css'
import './styles/Header.css';
import { Link } from 'react-router-dom';

const Home = () => {
  const cardsData = [
    {
      title: 'Agregar mascota',
      description: 'Explora una lista de mascotas adorables que están buscando un hogar amoroso. Encuentra tu compañero perfecto y comienza una nueva aventura juntos.',
      image: Agregar,
      link: "/Agregar"
    },
    {
      title: 'Adoptar',
      description: '¿Necesitas dejar temporalmente a tu mascota en buenas manos? Encuentra cuidadores confiables dispuestos a cuidar de tu amigo peludo mientras estás fuera.',
      image: Adoptar,
      link: "/Adoptar"
    },
    {
      title: 'Alojamiento',
      description: 'Encuentra alojamiento temporal para tu mascota con cuidadores confiables.',
      image: Alojamiento,
      link: "/Alojamiento"
    },
    {
      title: 'Vacunación',
      description: 'Consulta servicios de vacunación para mantener la salud de tu mascota al día.',
      image: Vacunacion,
      link: "/Vacunacion"
    },
    {
      title: 'Baño',
      description: 'Busca servicios de baño para mantener a tu mascota limpia y fresca.',
      image: Baño,
      link: "/Baño"
    },
    {
      title: 'Corte de Pelo',
      description: 'Encuentra profesionales para el corte de pelo de tu mascota.',
      image: CortePelo,
      link: "/CortePelo"
    },
    {
      title: 'Corte de Uñas',
      description: 'Accede a servicios de corte de uñas para tu mascota.',
      image: CorteUñas,
      link: "/CorteUñas"
    },
    {
      title: 'Historial',
      description: 'Mantén un registro detallado de todos los servicios que has utilizado, desde paseos hasta visitas al veterinario. Mantén un seguimiento de la salud y el bienestar de tu mascota.',
      image: Historial,
      link: "/Historial"
    },
    {
      title: 'Generar reporte',
      description: 'Reporta preocupaciones como maltrato animal, extravío o vacunación de tu mascota. Solicita ayuda de profesionales en emergencias.',
      image: Reporte,
      link: "/AdminReporte"
    },
    {
      title: 'Agregar Admin',
      description: 'Añade nuevos administradores al sistema para gestionar las operaciones.',
      image: AgregarAdmin,
      link: "/AdminSignUp"
    },
    {
      title: 'Agregar Vacuna',
      description: 'Registra nuevas vacunas disponibles para mantener a las mascotas saludables.',
      image: AgregarVacuna,
      link: "/AdminAgregarVacuna"
    },
  ];

  return (
    <div>
      <Header />
      <div className="back-container-admin">
        <div className="form-wrapper-2">
          <div className="cards-container">
            {cardsData.map((card, index) => (
              <Card 
                key={index}
                title={card.title}
                description={card.description}
                image={card.image}
                link={card.link} // Added 'link' prop here
              />
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default Home;
