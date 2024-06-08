import React from 'react';
import Card from '../componentes/Card'; // Ajuste de la ruta a '../componentes/Card'
import './styles/Home.css'; // Ajuste de la ruta a '../styles/Home.css'

const Home = () => {
  const cardsData = [
    {
      title: 'Agregar mascota',
      description: 'Explora una lista de mascotas adorables que están buscando un hogar amoroso. Encuentra tu compañero perfecto y comienza una nueva aventura juntos.',
      image: 'https://static.vecteezy.com/system/resources/previews/006/470/722/non_2x/pet-shop-logo-design-template-modern-animal-icon-label-for-store-veterinary-clinic-hospital-shelter-business-services-flat-illustration-background-with-dog-cat-and-horse-free-vector.jpg', // Reemplaza con la ruta correcta de la imagen
    },
    {
      title: 'Adoptar',
      description: '¿Necesitas dejar temporalmente a tu mascota en buenas manos? Encuentra cuidadores confiables dispuestos a cuidar de tu amigo peludo mientras estás fuera.',
      image: 'ruta-a-la-imagen-2.jpg',
    },
    {
      title: 'Servicios',
      description: 'Explora una variedad de servicios para mascotas, como paseadores de perros, cuidadores de gatos, servicios de alimentación y más. Encuentra profesionales cerca de ti.',
      image: 'ruta-a-la-imagen-3.jpg',
    },
    {
      title: 'Historial',
      description: 'Mantén un registro detallado de todos los servicios que has utilizado, desde paseos hasta visitas al veterinario. Mantén un seguimiento de la salud y el bienestar de tu mascota.',
      image: 'ruta-a-la-imagen-4.jpg',
    },
    {
      title: 'Generar reporte',
      description: 'Reporta preocupaciones como maltrato animal, extravío o vacunación de tu mascota. Solicita ayuda de profesionales en emergencias.',
      image: 'ruta-a-la-imagen-5.jpg',
    },
  ];

  return (
    <div className="back-container">
      <div className="logo-container">
        <img src="https://static.vecteezy.com/system/resources/previews/006/470/722/non_2x/pet-shop-logo-design-template-modern-animal-icon-label-for-store-veterinary-clinic-hospital-shelter-business-services-flat-illustration-background-with-dog-cat-and-horse-free-vector.jpg" alt="Logo" className="logo" /> {/* Reemplaza con la ruta correcta a tu logo */}
      </div>
      <h1 className="text-center text-white">Home</h1>
      <div className="cards-container">
        {cardsData.map((card, index) => (
          <Card 
            key={index}
            title={card.title}
            description={card.description}
            image={card.image}
          />
        ))}
      </div>
    </div>
  );
};

export default Home;
