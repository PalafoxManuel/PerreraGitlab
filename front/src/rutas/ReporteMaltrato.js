import React, { useState } from 'react';
import axios from 'axios'; // Importa Axios para las peticiones HTTP
import Header from '../componentes/Header';
import FormField from '../componentes/FormField';
import '../rutas/styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'
import '../rutas/styles/Reporte.css'; // Importa los nuevos estilos
import Logo from '../img/Logo.png'; // Ajusta la ruta según tu estructura de proyecto

const uri_reporte = 'http://localhost:8000/reporte';
const URI_MASCOTA = 'http://localhost:8000/mascota';
const URI_USUARIO = 'http://localhost:8000/usuario';

const Agregar = () => {
  const [reportData, setReportData] = useState({
    nombrePropietario: '',
    nombreMascota: '',
    calleNumero: '',
    codigoPostal: '',
    fechaReporte: '',
    descripcionMaltrato: ''
  });

  const handleChange = (event) => {
    const { name, value } = event.target;
    setReportData({ ...reportData, [name]: value });
  };

  const handleFormSubmit = async (event) => {
    event.preventDefault();
    try {
      const response = await axios.post(uri_reporte, reportData);
      console.log('Reporte guardado exitosamente:', response.data);
      // Aquí podrías redirigir a una página de éxito o hacer otra acción
    } catch (error) {
      console.error('Error al guardar el Reporte:', error);
    }
  };

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
            <form onSubmit={handleFormSubmit}>
              <FormField
                label="Nombre del propietario"
                type="text"
                name="nombrePropietario"
                value={reportData.nombrePropietario}
                onChange={handleChange}
                required
              />
              <FormField
                label="Nombre de la mascota"
                type="text"
                name="nombreMascota"
                value={reportData.nombreMascota}
                onChange={handleChange}
                required
              />
              <FormField
                label="Calle y número"
                type="text"
                name="calleNumero"
                value={reportData.calleNumero}
                onChange={handleChange}
                required
              />
              <FormField
                label="Código Postal"
                type="text"
                name="codigoPostal"
                value={reportData.codigoPostal}
                onChange={handleChange}
                required
              />
              <FormField
                label="Fecha del reporte"
                type="date"
                name="fechaReporte"
                value={reportData.fechaReporte}
                onChange={handleChange}
                required
              />
              <FormField
                label="Descripción del maltrato"
                type="textarea"
                name="descripcionMaltrato"
                value={reportData.descripcionMaltrato}
                onChange={handleChange}
                required
              />
              <div className="form-buttons">
                <button type="button" onClick={() => console.log('Cancelar')}>
                  Cancelar
                </button>
                <button type="submit">Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Agregar;