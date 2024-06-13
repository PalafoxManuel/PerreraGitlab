import React from 'react';
import { useNavigate } from 'react-router-dom';
import AdminHeader from '../componentes/AdminHeader';
import Offcanvas from '../componentes/Offcanvas';
import FormField from '../componentes/FormField';
import '../rutas/styles/Header.css'; // Asegúrate de importar los estilos necesarios
import '../rutas/styles/Servicios.css'; // Asegúrate de importar los estilos necesarios

const CorteUnas = () => {
  const [isOffcanvasOpen, setOffcanvasOpen] = React.useState(true);
  const navigate = useNavigate();

  const closeOffcanvasAndNavigateHome = () => {
    setOffcanvasOpen(false);
    navigate('/AdminHome');
  };

  const handleFormSubmit = event => {
    event.preventDefault();
    // Aquí manejarías la lógica para enviar los datos a un servidor, etc.
    closeOffcanvasAndNavigateHome();
  };

  return (
    <div>
      <AdminHeader />
      <div className="back-container-admin">
        <div className="form-wrapper">
          {/* No se muestra ningún botón para abrir el offcanvas */}
        </div>
      </div>
      <Offcanvas isOpen={isOffcanvasOpen} onClose={closeOffcanvasAndNavigateHome} title="Servicio de Corte de Uñas">
        <form className="corte-unas-form" onSubmit={handleFormSubmit}>
          <FormField label="Mascota" type="text" required={true} />
          <FormField label="Fecha" type="date" required={true} />
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

export default CorteUnas;
