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
const URI_ADOPCION = 'http://localhost:8000/adopcion';

const Adoptar = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);
  const [mascotasDisponibles, setMascotasDisponibles] = useState([]);
  const [clientes, setClientes] = useState([]);
  const navigate = useNavigate();

  useEffect(() => {
    const fetchMascotasDisponibles = async () => {
      try {
        const response = await axios.get(URI_MASCOTAS_DISPONIBLES);
        const mascotasFiltradas = response.data.filter(mascota => mascota.Id_Usuario === null);
        setMascotasDisponibles(mascotasFiltradas);
      } catch (error) {
        console.error('Error al cargar mascotas disponibles:', error);
      }
    };

    const fetchClientes = async () => {
      try {
        const response = await axios.get(URI_CLIENTES);
        console.log('Clientes obtenidos:', response.data);
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
      const responseAdopcion = await axios.post(URI_ADOPCION, nuevaAdopcion);
      console.log('Respuesta del servidor:', responseAdopcion.data);

      // Actualizar el Id_Usuario de la mascota
      const mascotaId = formData.get('mascota');
      const clienteId = formData.get('cliente');
      const updateMascota = { Id_Usuario: clienteId };

      const responseMascota = await axios.put(`${URI_MASCOTAS_DISPONIBLES}/${mascotaId}`, updateMascota);
      console.log('Mascota actualizada:', responseMascota.data);

      closeOffcanvasAndNavigateHome();
    } catch (error) {
      console.error('Error al guardar la adopción o actualizar la mascota:', error);
    }
  };

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2"></div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Adopción">
        <form className="agregar-form" onSubmit={handleFormSubmit}>
          <FormField 
            label="Mascota" 
            type="select" 
            name="mascota" 
            required={true} 
            options={mascotasDisponibles.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))} 
          />
          <FormField 
            label="Cliente" 
            type="select" 
            name="cliente" 
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
