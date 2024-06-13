import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import AdminHeader from '../componentes/AdminHeader';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import '../rutas/styles/Header.css'; // Asegúrate de importar los estilos necesarios
import '../rutas/styles/Servicios.css'; // Asegúrate de importar los estilos necesarios

const AgregarVacuna = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);
  const [nombreMascota, setNombreMascota] = useState('');
  const [descripcionVacuna, setDescripcionVacuna] = useState('');
  const [tipoMascota, setTipoMascota] = useState('Perro');
  const [fabricanteVacuna, setFabricanteVacuna] = useState('');
  const [sintomasAdversos, setSintomasAdversos] = useState('');
  const navigate = useNavigate();

  const closeOffcanvasAndNavigateHome = () => {
    setOffcanvasOpen(false);
    navigate('/AdminHome');
  };

  const handleFormSubmit = (event) => {
    event.preventDefault();
    // Aquí manejarías la lógica para enviar los datos a un servidor, etc.
    console.log({
      nombreMascota,
      descripcionVacuna,
      tipoMascota,
      fabricanteVacuna,
      sintomasAdversos,
    });
    closeOffcanvasAndNavigateHome();
  };

  return (
    <div>
      <AdminHeader />
      <div className="back-container-admin">
        <div className="form-wrapper">
          {/* No se muestra ningún botón para abrir el offcanvas */}
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Vacuna">
        <form className="vacuna-form" onSubmit={handleFormSubmit}>
          <FormField 
            label="Nombre de la Mascota" 
            type="text" 
            value={nombreMascota} 
            onChange={(e) => setNombreMascota(e.target.value)} 
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
              <option value="Pajaro">Pájaro</option>
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
