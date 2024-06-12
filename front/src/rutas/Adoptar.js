import React, { useState } from 'react';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'
import './styles/Agregar.css'; // Asegúrate de que este archivo exista y tenga los estilos necesarios

const Adoptar = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(false);

  const toggleOffcanvas = () => {
    setOffcanvasOpen(!isOffcanvasOpen);
  };

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2">
        <div>
            <button className="agregar-button" onClick={toggleOffcanvas}>Adoptar Mascota</button>
          </div>
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={toggleOffcanvas} title="Generar Adopción">
        <form className="adoptar-form">
          <FormField label="Mascota" type="select" options={[{ value: '', label: 'Selecciona la mascota' }]} required={true} />
          <FormField label="Dueño" type="select" options={[{ value: '', label: 'Selecciona un usuario' }]} required={true} />
          <FormField label="Fecha" type="date" required={true} />
          <FormField label="Hora" type="time" required={true} />
          <div className="form-buttons">
            <button type="button" onClick={toggleOffcanvas}>Cancelar</button>
            <button type="submit">Adoptar</button>
          </div>
        </form>
      </Offcanvas>
    </div>
  );
};

export default Adoptar;
