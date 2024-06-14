import React, { useState, useEffect } from 'react';
import axios from 'axios'; // Importa Axios para las peticiones HTTP
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import '../rutas/styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'
import '../rutas/styles/Reporte.css'; // Importa los nuevos estilos
import Logo from '../img/Logo.png'; // Ajusta la ruta según tu estructura de proyecto

const uri_reporte = 'http://uri.proyectounipedro.com/reporte_extravio';
const URI_MASCOTA = 'http://uri.proyectounipedro.com/mascota';

const Agregar = () => {
  const [reportData, setReportData] = useState({
    nombreMascota: '',
    fechaExtravio: '',
    fechaActual: '',
    lugarExtravio: '',
    informacionAdicional: '',
  });

  const [mascotas, setMascotas] = useState([]);

  useEffect(() => {
    const fetchMascotas = async () => {
      try {
        const response = await axios.get(URI_MASCOTA);
        setMascotas(response.data);
      } catch (error) {
        console.error('Error fetching mascotas:', error);
      }
    };

    fetchMascotas();
  }, []);

  const handleChange = (e) => {
    const { name, value } = e.target;
    setReportData({
      ...reportData,
      [name]: value,
    });
  };

  const handleFormSubmit = async (event) => {
    event.preventDefault();
    try {
      const response = await axios.post(uri_reporte, reportData);
      console.log('Reporte de extravío guardado exitosamente:', response.data);
      // Aquí podrías redirigir a una página de éxito o hacer otra acción
    } catch (error) {
      console.error('Error al guardar el reporte de extravío:', error);
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
              <h1>Reporte de Mascota Extraviada</h1>
              <img src={Logo} alt="Logo de huellita" className="logo" />
            </div>
            <hr />
            <form onSubmit={handleFormSubmit}>
              <FormField 
                label="Nombre de la mascota" 
                type="select" 
                name="nombreMascota"
                required={true}
                options={mascotas.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))}
                value={reportData.nombreMascota}
                onChange={handleChange}
              />
              <FormField 
                label="Fecha de extravío" 
                type="date" 
                name="fechaExtravio"
                value={reportData.fechaExtravio}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Fecha actual" 
                type="date" 
                name="fechaActual"
                value={reportData.fechaActual}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Lugar de extravío" 
                type="text" 
                name="lugarExtravio"
                value={reportData.lugarExtravio}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Información adicional" 
                type="textarea" 
                name="informacionAdicional"
                value={reportData.informacionAdicional}
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

export default Agregar;
