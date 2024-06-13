import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import AdminHeader from '../componentes/AdminHeader';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css';
import './styles/Agregar.css';

const Adoptar = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);

  // Hardcoded arrays for mascotas and clientes
  const mascotas = [
    { Id_Mascota: 1, Nombre: "Firulais" },
    { Id_Mascota: 2, Nombre: "Max" },
    { Id_Mascota: 3, Nombre: "Bella" }
  ];

  const clientes = [
    { Id_Cliente: 1, Nombre: "Juan Perez" },
    { Id_Cliente: 2, Nombre: "Maria Gomez" },
    { Id_Cliente: 3, Nombre: "Carlos Sanchez" }
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
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Adopción">
        <form className="agregar-form" onSubmit={handleFormSubmit}>
          <FormField 
            label="Mascota" 
            type="select" 
            required={true} 
            options={mascotas.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))} 
          />
          <FormField 
            label="Cliente" 
            type="select" 
            required={true} 
            options={clientes.map(cliente => ({ value: cliente.Id_Cliente, label: cliente.Nombre }))} 
          />
          <FormField label="Fecha de Adopción" type="date" required={true} />
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

export default Adoptar;
