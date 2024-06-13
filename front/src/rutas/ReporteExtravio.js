import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import '../rutas/styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'
import '../rutas/styles/Reporte.css'; // Importa los nuevos estilos
import Logo from '../img/Logo.png'; // Ajusta la ruta según tu estructura de proyecto

const Agregar = () => {
  const [reportData, setReportData] = useState({
    nombreMascota: '',
    fechaExtravio: '',
    fechaActual: '',
    lugarExtravio: '',
    informacionAdicional: '',
  });

  const [mascotas, setMascotas] = useState([]);
  const navigate = useNavigate();

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
    // Handle form submission here, e.g., sending the data to a server.
    console.log('Reporte enviado:', reportData);
    navigate('/Home'); // Redirige a /Home después de enviar el formulario
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
