import React from 'react';
import PropTypes from 'prop-types';
import '../rutas/styles/CardHistory.css'; // Asegúrate de importar los estilos necesarios
import PerroChico from '../img/PerroChico.png';
import PerroMediano from '../img/PerroMediano.png';
import PerroGrande from '../img/PerroGrande.png';
import Gato from '../img/Gato.png';
import Pajaro from '../img/Pajaro.png';

const CardHistory = ({ servicio }) => {
  const { tipoServicio, mascota, costo, fecha, detalles, raza } = servicio;

  // Función para determinar la imagen según la raza
  const determinarImagen = () => {
    const razaLower = raza.toLowerCase();
    if (razaLower.includes('labrador') || razaLower.includes('bulldog')) {
      return PerroGrande; // Imagen para perros grandes
    } else if (razaLower.includes('golden retriever') || razaLower.includes('pastor alemán')) {
      return PerroMediano; // Imagen para perros medianos
    } else if (razaLower.includes('persa') || razaLower.includes('siamés')) {
      return Gato; // Imagen para gatos
    } else if (razaLower.includes('canario')) {
      return Pajaro; // Imagen para pájaros
    } else {
      return PerroChico; // Imagen por defecto para perros chicos
    }
  };

  return (
    <div className="card-history">
      <img src={determinarImagen()} alt={mascota} className="card-history-image" />
      <div className="card-history-details">
        <h2 className="card-history-title">{mascota}</h2>
        <p><strong>Tipo de Servicio:</strong> {tipoServicio}</p>
        <p><strong>Costo:</strong> ${costo}</p>
        <p><strong>Fecha:</strong> {fecha}</p>
        <p>{detalles}</p>
      </div>
    </div>
  );
};

CardHistory.propTypes = {
  servicio: PropTypes.shape({
    tipoServicio: PropTypes.string.isRequired,
    mascota: PropTypes.string.isRequired,
    costo: PropTypes.number.isRequired,
    fecha: PropTypes.string.isRequired,
    detalles: PropTypes.string.isRequired,
    raza: PropTypes.string.isRequired,
  }).isRequired,
};

export default CardHistory;
