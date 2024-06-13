import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import AdminHeader from '../componentes/AdminHeader';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css';
import './styles/Agregar.css';

const Alojamiento = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);

  // Hardcoded array for mascotas
  const mascotas = [
    { Id_Mascota: 1, Nombre: "Firulais" },
    { Id_Mascota: 2, Nombre: "Max" },
    { Id_Mascota: 3, Nombre: "Bella" }
  ];

  const navigate = useNavigate();

  const closeOffcanvasAndNavigateHome = () => {
    setOffcanvasOpen(false);
    navigate('/AdminHome');
  };

  const handleFormSubmit = (event) => {
    event.preventDefault();
    // Handle form submission here, e.g., sending the data to a server.
    closeOffcanvasAndNavigateHome();
  };

  return (
    <div>
      <AdminHeader />
      <div className="back-container-admin">
        <div className="form-wrapper-2">
          {/* The button to open the offcanvas is removed */}
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Alojamiento">
        <form className="agregar-form" onSubmit={handleFormSubmit}>
          <FormField
            label="Mascota"
            type="select"
            required={true}
            options={mascotas.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))}
          />
          <FormField label="Fecha de Entrada" type="date" required={true} />
          <FormField label="Fecha de Salida" type="date" required={true} />
          <FormField label="Notas Adicionales" type="textarea" />
          <div className="form-buttons">
            <button type="button" onClick={closeOffcanvasAndNavigateHome}>Cancelar</button>
            <button type="submit">Guardar</button>
          </div>
        </form>
      </Offcanvas>
    </div>
  );
};

export default Alojamiento;
