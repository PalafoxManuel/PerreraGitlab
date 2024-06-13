import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import AdminHeader from '../componentes/AdminHeader';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css';
import './styles/Agregar.css';

const Vacunacion = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);

  // Hardcoded arrays for mascotas and vacunas
  const mascotas = [
    { Id_Mascota: 1, Nombre: "Firulais" },
    { Id_Mascota: 2, Nombre: "Max" },
    { Id_Mascota: 3, Nombre: "Bella" }
  ];

  const vacunas = [
    { Id_Vacuna: 1, Nombre: "Rabia" },
    { Id_Vacuna: 2, Nombre: "Moquillo" },
    { Id_Vacuna: 3, Nombre: "Parvovirus" }
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
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Vacunación">
        <form className="agregar-form" onSubmit={handleFormSubmit}>
          <FormField
            label="Mascota"
            type="select"
            required={true}
            options={mascotas.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))}
          />
          <FormField
            label="Vacuna"
            type="select"
            required={true}
            options={vacunas.map(vacuna => ({ value: vacuna.Id_Vacuna, label: vacuna.Nombre }))}
          />
          <FormField label="Fecha de Vacunación" type="date" required={true} />
          <FormField label="Número de Lote" type="text" required={true} disabled={true} />
          <FormField label="Dosis" type="text" required={true} disabled={true} />
          <div className="form-buttons">
            <button type="button" onClick={closeOffcanvasAndNavigateHome}>Cancelar</button>
            <button type="submit">Guardar</button>
          </div>
        </form>
      </Offcanvas>
    </div>
  );
};

export default Vacunacion;
