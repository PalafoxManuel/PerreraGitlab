import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css';
import './styles/Agregar.css';

const URI_MASCOTAS_DISPONIBLES = 'http://localhost:8000/mascota';
const URI_CLIENTES = 'http://localhost:8000/cliente';

const Adoptar = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);
  const [mascotasDisponibles, setMascotasDisponibles] = useState([]);
  const [clientes, setClientes] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchMascotasDisponibles = async () => {
      try {
        const response = await axios.get(URI_MASCOTAS_DISPONIBLES);
        setMascotasDisponibles(response.data);
      } catch (error) {
        console.error('Error al cargar mascotas disponibles:', error);
      }
    };

    const fetchClientes = async () => {
      try {
        const response = await axios.get(URI_CLIENTES);
        // Verifica la estructura de la respuesta
        console.log('Clientes obtenidos:', response.data);
        
        // Filtra los clientes para excluir los administradores (Id_Cliente null)
        const clientesFiltrados = response.data.filter(cliente => cliente.Id_Cliente !== null);
        setClientes(clientesFiltrados);
      } catch (error) {
        console.error('Error al cargar clientes:', error);
      }
    };

    fetchMascotasDisponibles();
    fetchClientes();
  }, []);

  const closeOffcanvasAndNavigateHome = () => {
    setOffcanvasOpen(false);
    navigate('/Home');
  };

  const handleFormSubmit = async (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);

    const nuevaAdopcion = {
      Id_Mascota: formData.get('mascota'),
      Id_Cliente: formData.get('cliente'),
      Fecha_Adopcion: formData.get('fechaAdopcion'),
      Notas_Adicionales: formData.get('notasAdicionales'),
    };

    try {
      // Aquí podrías enviar la solicitud para guardar la adopción
      console.log('Datos de la adopción a enviar:', nuevaAdopcion);
      closeOffcanvasAndNavigateHome();
    } catch (error) {
      console.error('Error al guardar la adopción:', error);
    }
  };

  return (
    <div>
      <Header />
      <div className="back-container">
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
            options={mascotasDisponibles.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))} 
          />
          <FormField 
            label="Cliente" 
            type="select" 
            required={true} 
            options={clientes.map(cliente => ({ value: cliente.Id_Cliente, label: cliente.Nombre_Completo }))} 
          />
          <FormField label="Fecha de Adopción" type="date" name="fechaAdopcion" required={true} />
          <FormField label="Notas Adicionales" type="textarea" name="notasAdicionales" />
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