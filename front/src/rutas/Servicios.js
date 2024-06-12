import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css';
import './styles/Servicios.css';

const Servicios = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(false);
  const [selectedService, setSelectedService] = useState('');
  const navigate = useNavigate();

  const toggleOffcanvas = () => {
    setOffcanvasOpen(!isOffcanvasOpen);
  };

  const handleServiceChange = (event) => {
    setSelectedService(event.target.value);
  };

  const handleSubmit = (event) => {
    event.preventDefault();
    if (selectedService === 'vacunación') {
      navigate('/vacunacion');
    } else if (selectedService === 'alojamiento') {
      navigate('/alojamiento');
    } else {
      // Para otros servicios, simplemente cierra el offcanvas
      toggleOffcanvas();
    }
  };

  // Datos de ejemplo para mascotas
  const mascotas = [
    { value: '1', label: 'Firulais' },
    { value: '2', label: 'Michi' },
    { value: '3', label: 'Max' },
  ];

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2">
          <div>
            <button className="agregar-button" onClick={toggleOffcanvas}>Agregar Servicio</button>
          </div>
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={toggleOffcanvas} title="Agregar Servicio">
        <form className="agregar-form" onSubmit={handleSubmit}>
          <FormField
            label="Mascota"
            type="select"
            options={mascotas}
            required={true}
          />
          <FormField
            label="Nombre del Servicio"
            type="select"
            options={[
              { value: 'baño', label: 'Baño' },
              { value: 'corte_de_uñas', label: 'Corte de Uñas' },
              { value: 'corte_de_pelo', label: 'Corte de Pelo' },
              { value: 'vacunación', label: 'Vacunación' },
              { value: 'alojamiento', label: 'Alojamiento' },
            ]}
            required={true}
            onChange={handleServiceChange}
          />
          <FormField label="Descripción" type="textarea" />
          <FormField label="Tarifa" type="number" step="0.01" required={true} />
          <FormField label="Fecha" type="date" required={true} />
          <FormField label="Hora" type="time" required={true} />
          <FormField label="Notas Adicionales" type="textarea" />
          <div className="form-buttons">
            <button type="button" onClick={toggleOffcanvas}>Cancelar</button>
            <button type="submit">Guardar</button>
          </div>
        </form>
      </Offcanvas>
    </div>
  );
};

export default Servicios;
