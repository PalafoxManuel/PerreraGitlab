import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import axios from 'axios';
import Header from '../componentes/Header';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import './styles/Header.css';
import './styles/Agregar.css';

const URI_MASCOTA = 'http://localhost:8000/mascota';
const URI_TIPOS_MASCOTA = 'http://localhost:8000/tipo_mascotas';

const Agregar = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = useState(true);
  const [tiposMascota, setTiposMascota] = useState([]);
  const [userId, setUserId] = useState(null); // Estado para almacenar Id_Usuario
  const navigate = useNavigate();

  useEffect(() => {
    // Obtener userId del localStorage al cargar el componente
    const userIdFromLocalStorage = parseInt(localStorage.getItem('userId'), 10);
    if (userIdFromLocalStorage) {
      setUserId(userIdFromLocalStorage);
    }

    const fetchAndStoreTiposMascota = async () => {
      try {
        let tiposMascotaData = JSON.parse(localStorage.getItem('tiposMascota'));

        if (!tiposMascotaData) {
          const response = await axios.get(URI_TIPOS_MASCOTA);
          tiposMascotaData = response.data;
          localStorage.setItem('tiposMascota', JSON.stringify(tiposMascotaData));
        }

        setTiposMascota(tiposMascotaData);
      } catch (error) {
        console.error('Error al cargar tipos de mascota desde localStorage o API:', error);
      }
    };

    fetchAndStoreTiposMascota();
  }, []);

  const closeOffcanvasAndNavigateHome = () => {
    setOffcanvasOpen(false);
    navigate('/Home');
  };

  const handleFormSubmit = async (event) => {
    event.preventDefault();
    const formData = new FormData(event.target);

    // Convertir el valor seleccionado a número antes de enviarlo
    const tipoMascotaId = parseInt(formData.get('tipoMascota'), 10);
    if (isNaN(tipoMascotaId)) {
      console.error('Tipo de mascota inválido');
      return;
    }

    const newMascota = {
      Nombre: formData.get('nombre'),
      Id_TipoMascota: tipoMascotaId, // Envío correcto de la ID
      Id_Usuario: userId,
      Raza: formData.get('raza'),
      Edad: parseInt(formData.get('edad'), 10),
      Genero: formData.get('genero'),
      Color: formData.get('color'),
      Peso: parseFloat(formData.get('peso')),
      Historial_Medico: formData.get('historialMedico'),
      RescatadoCalle: formData.get('rescatadoCalle') === 'on' ? 1 : 0,
    };

    console.log('Datos de la mascota a enviar:', newMascota);

    try {
      const response = await axios.post(URI_MASCOTA, newMascota);
      console.log('Mascota registrada:', response.data);
      closeOffcanvasAndNavigateHome();
    } catch (error) {
      console.error('Error al registrar la mascota:', error);
      console.error('Detalles del error:', error.response?.data);
    }
  };

  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2">
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Agregar Mascota">
        <form className="agregar-form" onSubmit={handleFormSubmit}>
          <FormField label="Nombre" type="text" name="nombre" required={true} />
          <div className="form-field">
            <label htmlFor="tipoMascota">Tipo de Mascota</label>
            <select id="tipoMascota" name="tipoMascota" required={true}>
              <option value="">Seleccione...</option>
              {tiposMascota.map(tipo => (
                <option key={tipo.Id_TipoMascota} value={tipo.Id_TipoMascota}>
                  {tipo.Nombre_Tipo}
                </option>
              ))}
            </select>
          </div>
          <FormField label="Raza" type="text" name="raza" required={true} />
          <FormField label="Edad" type="number" name="edad" required={true} />
          <FormField
            label="Genero"
            type="select"
            name="genero"
            options={[
              { value: 'macho', label: 'Macho' },
              { value: 'hembra', label: 'Hembra' }
            ]}
            required={true}
          />
          <FormField label="Color" type="text" name="color" required={true} />
          <FormField label="Peso" type="number" name="peso" step="0.1" required={true} />
          <FormField label="Historial Médico" type="textarea" name="historialMedico" required={true} />
          <FormField label="Rescatado de la Calle" type="checkbox" name="rescatadoCalle" required={false} />
          <div className="form-buttons">
            <button type="button" onClick={closeOffcanvasAndNavigateHome}>Cancelar</button>
            <button type="submit">Guardar</button>
          </div>
        </form>
      </Offcanvas>
    </div>
  );
};

export default Agregar;
