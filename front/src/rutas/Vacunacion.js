import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios'; // Asegúrate de importar axios
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import '../rutas/styles/Header.css'; // Asegúrate de importar los estilos necesarios
import '../rutas/styles/Servicios.css'; // Asegúrate de importar los estilos necesarios

const uri_vacuna = 'http://api.proyectounipedro.com/Vacuna';

const AgregarVacuna = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);
  const [nombreVacuna, setNombreVacuna] = useState('');
  const [descripcionVacuna, setDescripcionVacuna] = useState('');
  const [tipoMascota, setTipoMascota] = useState('Perro'); // Valor por defecto
  const [fabricanteVacuna, setFabricanteVacuna] = useState('');
  const [sintomasAdversos, setSintomasAdversos] = useState('');

  const navigate = useNavigate();

  const closeOffcanvasAndNavigateHome = () => {
    setOffcanvasOpen(false);
    navigate('/AdminHome');
  };

  const handleFormSubmit = async (event) => {
    event.preventDefault();
    try {
      let idTipoMascota = 1; // Por defecto para perro
      if (tipoMascota === 'Gato') {
        idTipoMascota = 2;
      }

      const response = await axios.post(uri_vacuna, {
        Nombre: nombreVacuna,
        Descripcion: descripcionVacuna,
        Id_Tipo_Mascota: idTipoMascota, // Enviar el ID correspondiente
        Fabricante: fabricanteVacuna,
        Sintomas_Adversos: sintomasAdversos
      });
      console.log('Vacuna guardada:', response.data); // Puedes mostrar la respuesta del servidor si lo deseas
    } catch (error) {
      console.error('Error al guardar la vacuna:', error);
      // Puedes manejar el error de forma adecuada aquí, por ejemplo, mostrando un mensaje al usuario
    }

    closeOffcanvasAndNavigateHome();
  };

  return (
    <div>
      <Header />
      <div className="back-container-admin">
        <div className="form-wrapper">
          {/* No se muestra ningún botón para abrir el offcanvas */}
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Vacuna">
        <form className="vacuna-form" onSubmit={handleFormSubmit}>
          <FormField 
            label="Nombre de la vacuna" 
            type="text" 
            value={nombreVacuna} 
            onChange={(e) => setNombreVacuna(e.target.value)} 
            required={true} 
          />
          <FormField 
            label="Descripción de la Vacuna" 
            type="textarea" 
            value={descripcionVacuna} 
            onChange={(e) => setDescripcionVacuna(e.target.value)} 
            required={true} 
          />
          <div className="form-group">
            <label htmlFor="tipoMascota" className="custom-label">Tipo de Mascota *</label>
            <select
              id="tipoMascota"
              className="form-control"
              value={tipoMascota}
              onChange={(e) => setTipoMascota(e.target.value)}
              required
            >
              <option value="Perro">Perro</option>
              <option value="Gato">Gato</option>
            </select>
          </div>
          <FormField 
            label="Fabricante de la Vacuna" 
            type="text" 
            value={fabricanteVacuna} 
            onChange={(e) => setFabricanteVacuna(e.target.value)} 
            required={true} 
          />
          <FormField 
            label="Síntomas Adversos" 
            type="textarea" 
            value={sintomasAdversos} 
            onChange={(e) => setSintomasAdversos(e.target.value)} 
            required={true} 
          />
          <div className="form-buttons">
            <button type="button" onClick={closeOffcanvasAndNavigateHome}>Cancelar</button>
            <button type="submit">Guardar</button>
          </div>
        </form>
      </Offcanvas>
    </div>
  );
};

export default AgregarVacuna;