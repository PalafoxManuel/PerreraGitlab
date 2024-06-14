import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios'; // Importa Axios para las peticiones HTTP
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import '../rutas/styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'
import '../rutas/styles/Reporte.css'; // Importa los nuevos estilos
import Logo from '../img/Logo.png'; // Ajusta la ruta según tu estructura de proyecto

const uri_reporte = 'http://uri.proyectounipedro.com/reporte';
const URI_MASCOTA = 'http://uri.proyectounipedro.com/mascota';
const URI_USUARIO = 'http://uri.proyectounipedro.com/usuario';

const Agregar = () => {
  const [reportData, setReportData] = useState({
    nombrePropietario: '',
    nombreMascota: '',
    calleNumero: '',
    codigoPostal: '',
    fechaReporte: '',
    descripcionMaltrato: '',
  });

  const [usuarios, setUsuarios] = useState([]);
  const [mascotas, setMascotas] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchUsuarios = async () => {
      try {
        const response = await axios.get(URI_USUARIO);
        setUsuarios(response.data);
      } catch (error) {
        console.error('Error fetching usuarios:', error);
      }
    };

    const fetchMascotas = async () => {
      try {
        const response = await axios.get(URI_MASCOTA);
        setMascotas(response.data);
      } catch (error) {
        console.error('Error fetching mascotas:', error);
      }
    };

    fetchUsuarios();
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
      console.log('Reporte guardado exitosamente:', response.data);
      navigate('/Home'); // Redirige a /Home después de enviar el formulario
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
                type="select" 
                name="nombrePropietario"
                required={true}
                options={usuarios.map(usuario => ({ value: usuario.Id_Usuario, label: usuario.Nombre }))}
                value={reportData.nombrePropietario}
                onChange={handleChange}
              />
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
                label="Calle y número" 
                type="text" 
                name="calleNumero"
                value={reportData.calleNumero}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Código Postal" 
                type="text" 
                name="codigoPostal"
                value={reportData.codigoPostal}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Fecha del reporte" 
                type="date" 
                name="fechaReporte"
                value={reportData.fechaReporte}
                onChange={handleChange}
                required={true}
              />
              <FormField 
                label="Descripción del maltrato" 
                type="textarea" 
                name="descripcionMaltrato"
                value={reportData.descripcionMaltrato}
                onChange={handleChange}
                required={true}
              />
              <div className="form-buttons">
                <button type="button" onClick={() => navigate('/Home')}>Cancelar</button>
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
