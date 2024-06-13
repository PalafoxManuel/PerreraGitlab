import React, { useState, useEffect } from 'react';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
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

  const [usuarios, setUsuarios] = useState([]);
  const [mascotas, setMascotas] = useState([]);

  // Simular una solicitud a la base de datos para obtener usuarios y mascotas
  useEffect(() => {
    const fetchedUsuarios = [
      { Id_Usuario: 1, Nombre: "Eduardo Diaz" },
      { Id_Usuario: 2, Nombre: "Ana Torres" },
      { Id_Usuario: 3, Nombre: "Luis Ramirez" },
    ];
    const fetchedMascotas = [
      { Id_Mascota: 1, Nombre: "Billy" },
      { Id_Mascota: 2, Nombre: "Max" },
      { Id_Mascota: 3, Nombre: "Lola" },
    ];
    setUsuarios(fetchedUsuarios);
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
  };

  return (
    <div>
      <Header />
      <div className="back-container-admin">
        <div className="form-wrapper-reporte-admin">
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
