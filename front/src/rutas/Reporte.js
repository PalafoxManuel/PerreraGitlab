import React from 'react';
import Card from '../componentes/Card';
import Header from '../componentes/Header';
import RMaltrato from '../img/ReporteMaltrato.png'; // Asegúrate de tener estas imágenes
import RExtravio from '../img/ReporteExtravio.png'; // Asegúrate de tener estas imágenes
import '../rutas/styles/Reporte.css';

const Reportes = () => {
  const reportesData = [
    {
      title: 'Reporte de maltrato',
      description: 'Reporta casos de maltrato animal para que podamos tomar acción.',
      image: RMaltrato,
      link: "/ReporteMaltrato",
    },
    {
      title: 'Reporte de extravío',
      description: 'Informa sobre mascotas extraviadas para ayudarlas a volver a casa.',
      image: RExtravio,
      link: "/ReporteExtravio",
    }
  ];

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2">
          <div className="cards-container">
            {reportesData.map((reporte, index) => (
              <Card 
                key={index}
                title={reporte.title}
                description={reporte.description}
                image={reporte.image}
                link={reporte.link}
                tipo="reporte" // Agregando el tipo "reporte" aquí
              />
            ))}
          </div>
        </div>
      </div>
    </div>
  );
};

export default Reportes;
