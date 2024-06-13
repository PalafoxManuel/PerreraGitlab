import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css';
import './styles/Agregar.css';

const AdminAgregar = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);
  const navigate = useNavigate();

  const closeOffcanvasAndNavigateHome = () => {
    setOffcanvasOpen(false);
    navigate('/Home');
  };

  const handleFormSubmit = (event) => {
    event.preventDefault();
    // You would typically handle form submission here, e.g., sending the data to a server.
    closeOffcanvasAndNavigateHome();
  };

  useEffect(() => {
    setOffcanvasOpen(true); // Automatically show the offcanvas when the component loads
  }, []);

  return (
    <div>
      <Header />
      <div className="back-container-admin">
        <div className="form-wrapper-2">
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Mascota">
        <form className="agregar-form" onSubmit={handleFormSubmit}>
          <FormField label="Nombre" type="text" required={true} />
          <FormField label="Tipo de Mascota" type="select" options={[{ value: 'perro', label: 'Perro' }, { value: 'gato', label: 'Gato' }, { value: 'pajaro', label: 'Pájaro' }]} required={true} />
          <FormField label="Raza" type="text" required={true} />
          <FormField label="Edad" type="number" required={true}/>
          <FormField label="Genero" type="select" options={[{ value: 'macho', label: 'Macho' }, { value: 'hembra', label: 'Hembra' }]} required={true}/>
          <FormField label="Color" type="text" required={true}/>
          <FormField label="Peso" type="number" step="0.1" required={true}/>
          <FormField label="Historial Médico" type="textarea" required={true}/>
          <FormField label="Rescatado de la Calle" type="checkbox" required={true}/>
          <div className="form-buttons">
            <button type="button" onClick={closeOffcanvasAndNavigateHome}>Cancelar</button>
            <button type="submit">Guardar</button>
          </div>
        </form>
      </Offcanvas>
    </div>
  );
};

export default AdminAgregar;
