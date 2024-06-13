import React, { useState, useEffect } from 'react';
import AdminHeader from '../componentes/AdminHeader';
import FormField from '../componentes/FormField';
import '../rutas/styles/Header.css'; // Ajuste de la ruta a '../styles/Header.css'
import '../rutas/styles/Reporte.css'; // Importa los nuevos estilos
import Logo from '../img/Logo.png'; // Ajusta la ruta según tu estructura de proyecto

const AgregarReporteVacuna = () => {
  const [reportData, setReportData] = useState({
    mascota: '',
    tipoVacuna: '',
    numeroLote: '',
    fechaAdministracion: '',
    fechaSiguienteDosis: '',
    nombreFabricante: '',
    dosisAdministrada: '',
  });

  const [mascotas, setMascotas] = useState([]);

  // Simular una solicitud a la base de datos para obtener mascotas
  useEffect(() => {
    const fetchedMascotas = [
      { Id_Mascota: 1, Nombre: "Billy" },
      { Id_Mascota: 2, Nombre: "Max" },
      { Id_Mascota: 3, Nombre: "Lola" },
    ];
    setMascotas(fetchedMascotas);
  }, []);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setReportData({
      ...reportData,
      [name]: value,
    });
  };

  const handleFormSubmit = (event) => {
    event.preventDefault();
    // Manejar la lógica de envío del formulario aquí, por ejemplo, enviando los datos a un servidor.
    console.log('Reporte enviado:', reportData);
  };

  return (
    <div>
      <AdminHeader />
      <div className="back-container-admin">
        <div className="form-wrapper-reporte-admin">
          <div className="comprobante">
            <div className="header">
              <img src={Logo} alt="Logo de la perrera" className="logo" />
              <h1>Reporte de Vacunación de Mascota</h1>
              <img src={Logo} alt="Logo de huellita" className="logo" />
            </div>
            <hr />
            <form onSubmit={handleFormSubmit}>
              <FormField 
                label="Nombre de la mascota" 
                type="select" 
                name="mascota"
                required={true}
                options={mascotas.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))}
                value={reportData.mascota}
                onChange={handleChange}
              />
              <FormField 
                label="Tipo de vacuna" 
                type="text" 
                name="tipoVacuna"
                value={reportData.tipoVacuna}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Número de lote" 
                type="text" 
                name="numeroLote"
                value={reportData.numeroLote}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Fecha de administración" 
                type="date" 
                name="fechaAdministracion"
                value={reportData.fechaAdministracion}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Fecha de siguiente dosis" 
                type="date" 
                name="fechaSiguienteDosis"
                value={reportData.fechaSiguienteDosis}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Nombre del fabricante" 
                type="text" 
                name="nombreFabricante"
                value={reportData.nombreFabricante}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Dosis administrada" 
                type="text" 
                name="dosisAdministrada"
                value={reportData.dosisAdministrada}
                onChange={handleChange}
                required={true}
              />
              <div className="form-buttons">
                <button type="button" onClick={() => console.log('Cancelar')}>Cancelar</button>
                <button type="submit">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AgregarReporteVacuna;
