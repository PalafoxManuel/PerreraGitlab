import React, { useState, useEffect } from 'react';
import Header from '../componentes/Header';
import '../rutas/styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'
import '../rutas/styles/Reporte.css'; // Importa los nuevos estilos

import Logo from '../img/Logo.png'; // Ajusta la ruta según tu estructura de proyecto

const Agregar = () => {
  const [reportData, setReportData] = useState({
    nombrePropietario: '',
    nombreMascota: '',
    calleNumero: '',
    codigoPostal: '',
    fechaReporte: '',
    descripcionMaltrato: '',
  });

  // Simular una solicitud a la base de datos
  useEffect(() => {
    // Ejemplo de datos obtenidos de una API o base de datos
    const fetchedData = {
      nombrePropietario: 'EDUARDO DIAZ',
      nombreMascota: 'BILLY',
      calleNumero: 'CALLE BANDERITAS 123',
      codigoPostal: '23000',
      fechaReporte: '2024-06-12',
      descripcionMaltrato: 'La mascota se encuentra en mal estado y con signos de abuso físico.',
    };
    setReportData(fetchedData);
  }, []);

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-reporte">
          <div className="comprobante">
            <div className="header">
              <img src={Logo} alt="Logo de la perrera" className="logo" />
              <h1>Reporte de Maltrato</h1>
              <img src={Logo} alt="Logo de huellita" className="logo" />
            </div>
            <hr />
            <p><strong>Nombre del propietario:</strong> {reportData.nombrePropietario}</p>
            <p><strong>Nombre de la mascota:</strong> {reportData.nombreMascota}</p>
            <p><strong>Calle y número:</strong> {reportData.calleNumero}</p>
            <p><strong>Código Postal:</strong> {reportData.codigoPostal}</p>
            <p><strong>Fecha del reporte:</strong> {reportData.fechaReporte}</p>
            <p><strong>Descripción del maltrato:</strong> {reportData.descripcionMaltrato}</p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Agregar;
