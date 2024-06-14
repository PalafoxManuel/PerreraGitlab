import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css';
import './styles/Agregar.css';

const URI_RESERVA = 'http://api.proyectounipedro.com/reserva';
const URI_DISPONIBILIDAD_SERVICIOS = 'http://api.proyectounipedro.com/disponibilidad-servicio';
const URI_MASCOTAS_USUARIO = 'http://api.proyectounipedro.com/mascota'; // Ruta para obtener mascotas del usuario

const Alojamiento = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);
  const [mascotas, setMascotas] = useState([]);
  const [duracionReserva, setDuracionReserva] = useState(0); // Estado para almacenar la duración en días
  const navigate = useNavigate();

  useEffect(() => {
    const fetchMascotasUsuario = async () => {
      try {
        const userId = localStorage.getItem('userId');
        const response = await axios.get(`${URI_MASCOTAS_USUARIO}/${userId}`);
        console.log('Respuesta del servidor:', response.data); // Verifica la respuesta del servidor
        if (Array.isArray(response.data)) {
          setMascotas(response.data); // Asigna las mascotas obtenidas al estado local
        } else if (typeof response.data === 'object' && response.data !== null) {
          // Si la respuesta es un objeto (una sola mascota), conviértela en un array de una sola mascota
          setMascotas([response.data]);
        } else {
          console.error('La respuesta del servidor no es válida:', response.data);
        }
      } catch (error) {
        console.error('Error al cargar las mascotas del usuario:', error);
      }
    };

    fetchMascotasUsuario();
  }, []);

  const closeOffcanvasAndNavigateHome = () => {
    setOffcanvasOpen(false);
    navigate('/Home');
  };

  const handleFormSubmit = async (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);
  
    const fechaEntrada = formData.get('fechaEntrada');
    const fechaSalida = formData.get('fechaSalida');
    const duracion = calcularDuracionEnDias(fechaEntrada, fechaSalida); // Calcula la duración en días
  
    const nuevaReserva = {
      Id_Mascota: formData.get('mascota'),
      Fecha_Entrada: fechaEntrada,
      Fecha_Salida: fechaSalida,
      Duracion_Dias: duracion,
      Notas_Adicionales: formData.get('notasAdicionales'),
      Fecha_Reserva: new Date().toISOString(), // Fecha de reserva actual
      Id_Perrera: 1, // Id de la perrera seleccionada o algún valor por defecto
      Estado: 'Pendiente', // Aquí puedes establecer el estado inicial, por ejemplo, 'Pendiente'
      Id_Cliente: localStorage.getItem('userId') // Obtener el Id del cliente desde localStorage
    };
  
    try {
      // Verificar disponibilidad de servicios antes de registrar la reserva
      const disponibilidadResponse = await axios.get(`${URI_DISPONIBILIDAD_SERVICIOS}/${nuevaReserva.Id_Mascota}`);
      if (!disponibilidadResponse.data.Disponible) {
        console.log('El servicio no está disponible en las fechas seleccionadas.');
        return;
      }
  
      // Si el servicio está disponible, procedemos a registrar la reserva
      const reservaResponse = await axios.post(URI_RESERVA, nuevaReserva);
      console.log('Respuesta del servidor:', reservaResponse.data);
      closeOffcanvasAndNavigateHome();
    } catch (error) {
      console.error('Error al registrar la reserva:', error);
    }
  };

  // Función para calcular la diferencia en días entre dos fechas
  const calcularDuracionEnDias = (fechaInicio, fechaFin) => {
    const fechaInicioMs = new Date(fechaInicio).getTime();
    const fechaFinMs = new Date(fechaFin).getTime();
    const diferenciaMs = fechaFinMs - fechaInicioMs;
    const dias = Math.ceil(diferenciaMs / (1000 * 60 * 60 * 24));
    return dias;
  };

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2">
          {/* El botón para abrir el offcanvas se ha eliminado */}
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Alojamiento">
        <form className="agregar-form" onSubmit={handleFormSubmit}>
          <FormField
            label="Mascota"
            type="select"
            name="mascota"
            required={true}
            options={mascotas.map(mascota => ({ value: mascota.Id_Mascota, label: mascota.Nombre }))}
          />
          <FormField label="Fecha de Entrada" type="date" name="fechaEntrada" required={true} />
          <FormField label="Fecha de Salida" type="date" name="fechaSalida" required={true} />
          <FormField label="Duración de la Reserva (días)" type="number" value={duracionReserva} readOnly={true} />
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

export default Alojamiento;