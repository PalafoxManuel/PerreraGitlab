import React from 'react';
import Card from '../componentes/Card'; // Ajuste de la ruta a '../componentes/Card'
import Header from './Header';
import Agregar from '../img/Agregar.png';
import Adoptar from '../img/Adoptar.png';
import Servicios from '../img/Servicios.png';
import Historial from '../img/Historial.png';
import Reporte from '../img/Reporte.png';
import './styles/Home.css'; // Ajuste de la ruta a './styles/Home.css'
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
      title: 'Servicios',
      description: 'Explora una variedad de servicios para mascotas, como paseadores de perros, cuidadores de gatos, servicios de alimentación y más. Encuentra profesionales cerca de ti.',
      image: Servicios,
      link: "/Servicios"
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
      link: "/Reporte"
    },
  ];

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2">
          <div className="cards-container">
            {cardsData.map((card, index) => (
              <Card 
                key={index}
                title={card.title}
                description={card.description}
                image={card.image}
                link={card.link} // Añadir la prop 'link' aquí
              />
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default Home;
