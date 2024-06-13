import React, { useState, useEffect } from 'react';
import axios from 'axios';
import Header from '../componentes/Header';
import FormField from '../componentes/FormField';
import Logo from '../img/Logo.png';

const uri_reporte = 'http://localhost:8000/reporte';
const URI_MASCOTA = 'http://localhost:8000/mascota';
const URI_USUARIO = 'http://localhost:8000/usuario';

const Agregar = () => {
  const [idTipoMascota, setIdTipoMascota] = useState('');
  const [idUsuario, setIdUsuario] = useState('');
  const [calleNumero, setCalleNumero] = useState('');
  const [codigoPostal, setCodigoPostal] = useState('');
  const [descripcionMaltrato, setDescripcionMaltrato] = useState('');
  const [fechaReporte, setFechaReporte] = useState('');
  const [usuarios, setUsuarios] = useState([]);
  const [mascota, setMascota] = useState([]);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const responseUsuarios = await axios.get(URI_USUARIO);
        setUsuarios(responseUsuarios.data);

        const responseMascota = await axios.get(URI_MASCOTA);
        setMascota(responseMascota.data);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchData();
  }, []);

  const handleSubmit = async (event) => {
    event.preventDefault();

    try {
      const response = await axios.post(uri_reporte, {
        Id_Tipo_Reporte: 2,
        Id_Mascota: idTipoMascota,
        Id_Usuario: idUsuario,
        Contenido: `${calleNumero}, ${codigoPostal}, ${descripcionMaltrato}`,
        Fecha_Reporte: fechaReporte
      });

      console.log('Reporte enviado:', response.data);

      // Aquí podrías añadir lógica adicional después de enviar el reporte, por ejemplo, limpiar el formulario o mostrar un mensaje de éxito.
      
    } catch (error) {
      console.error('Error al generar reporte:', error);
      // Aquí podrías manejar el error, mostrar un mensaje al usuario, etc.
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
            <form onSubmit={handleSubmit}>
              <FormField 
                label="Nombre del propietario" 
                type="select" 
                name="idUsuario"
                required={true}
                options={usuarios.map(usuario => ({ value: usuario.Id_Usuario, label: usuario.Nombre_Usuario }))}
                value={idUsuario}
                onChange={(e) => setIdUsuario(e.target.value)}
              />
              <FormField 
                label="Nombre de la mascota" 
                type="select" 
                name="idTipoMascota"
                required={true}
                options={mascota.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))}
                value={idTipoMascota}
                onChange={(e) => setIdTipoMascota(e.target.value)}
              />
              <FormField 
                label="Calle y número" 
                type="text" 
                name="calleNumero"
                value={calleNumero}
                onChange={(e) => setCalleNumero(e.target.value)}
                required={true}
              />
              <FormField 
                label="Código Postal" 
                type="text" 
                name="codigoPostal"
                value={codigoPostal}
                onChange={(e) => setCodigoPostal(e.target.value)}
                required={true}
              />
              <FormField 
                label="Fecha del reporte" 
                type="date" 
                name="fechaReporte"
                value={fechaReporte}
                onChange={(e) => setFechaReporte(e.target.value)}
                required={true}
              />
              <FormField 
                label="Descripción del maltrato" 
                type="textarea" 
                name="descripcionMaltrato"
                value={descripcionMaltrato}
                onChange={(e) => setDescripcionMaltrato(e.target.value)}
                required={true}
              />
              <div className="form-buttons">
                <button type="button" onClick={() => console.log('Cancelar')}>Cancelar</button>
                <button type="submit" onClick={handleSubmit}>Guardar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Agregar;






