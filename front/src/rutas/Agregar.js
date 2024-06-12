import React, { useState } from 'react';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'
import './styles/Agregar.css'; // Asegúrate de que este archivo exista y tenga los estilos necesarios

const Agregar = () => {
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
            <button className="agregar-button" onClick={toggleOffcanvas}>Agregar Mascota</button>
          </div>
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={toggleOffcanvas} title="Agregar Mascota">
        <form className="agregar-form">
          <FormField label="Nombre" type="text" required={true} />
          <FormField label="Raza" type="text" />
          <FormField label="Edad" type="number" />
          <FormField label="Genero" type="select" options={[{ value: 'macho', label: 'Macho' }, { value: 'hembra', label: 'Hembra' }]} />
          <FormField label="Color" type="text" />
          <FormField label="Peso" type="number" step="0.1" />
          <FormField label="Historial Médico" type="textarea" />
          <FormField label="Rescatado de la Calle" type="checkbox" />
          <div className="form-buttons">
            <button type="button" onClick={toggleOffcanvas}>Cancelar</button>
            <button type="submit">Guardar</button>
          </div>
        </form>
      </Offcanvas>
    </div>
  );
};

export default Agregar;
