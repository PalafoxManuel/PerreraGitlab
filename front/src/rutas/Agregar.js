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
          <FormField label="Agrega nombre de la mascota" type="text" required={true} />
          <FormField label="Edad" type="select" options={[{ value: '1', label: '1 año' }, { value: '2', label: '2 años' }]} required={true} />
          <FormField label="Sexo" type="select" options={[{ value: 'macho', label: 'Macho' }, { value: 'hembra', label: 'Hembra' }]} required={true} />
          <FormField label="Control de vacunación" type="select" options={[{ value: 'si', label: 'Sí' }, { value: 'no', label: 'No' }]} required={true} />
          <FormField label="Raza" type="text" required={true} />
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
