import React from 'react';
import Card from '../componentes/Card';
import AdminHeader from '../componentes/AdminHeader';
import RMaltrato from '../img/ReporteMaltrato.png'; // Asegúrate de tener estas imágenes
import RExtravio from '../img/ReporteExtravio.png'; // Asegúrate de tener estas imágenes
import RVacuna from '../img/AdminReporteVacuna.png'; // Asegúrate de tener estas imágenes
import RAdopcion from '../img/AdminReporteAdopcion.png'; // Asegúrate de tener estas imágenes
import '../rutas/styles/Reporte.css';

const Reportes = () => {
  const reportesData = [
    {
      title: 'Reporte de maltrato',
      description: 'Reporta casos de maltrato animal para que podamos tomar acción.',
      image: RMaltrato,
      link: "/AdminReporteMaltrato",
    },
    {
      title: 'Reporte de extravío',
      description: 'Informa sobre mascotas extraviadas para ayudarlas a volver a casa.',
      image: RExtravio,
      link: "/AdminReporteExtravio",
    },
    {
      title: 'Reporte de vacuna',
      description: 'Registra la información de vacunas aplicadas a las mascotas.',
      image: RVacuna,
      link: "/AdminReporteVacuna",
    },
    {
      title: 'Reporte de adopción',
      description: 'Informa sobre mascotas disponibles para adopción.',
      image: RAdopcion,
      link: "/AdminReporteAdopcion",
    }
  ];

  return (
    <div>
      <AdminHeader />
      <div className="back-container-admin">
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
