import React from 'react';
import { Link } from 'react-router-dom';
import '../rutas/styles/Card.css'; // Ajuste de la ruta a '../rutas/styles/Card.css'

const Card = ({ title, description, image, link, tipo }) => {
  const renderCardContent = () => {
    switch (tipo) {
      case 'reporte':
        return (
          <Link to={link} className="card-link">
            <div className="card reporte">
              <img src={image} alt={title} className="card-image-reporte" />
              <div className="card-body">
                <h2 className="card-title">{title}</h2>
                <p className="card-description">{description}</p>
              </div>
            </div>
          </Link>
        );
      case 'home':
        return (
          <Link to={link} className="card-link">
            <div className="card home">
              <img src={image} alt={title} className="card-image" />
              <div className="card-body">
                <h2 className="card-title">{title}</h2>
                <p className="card-description">{description}</p>
              </div>
            </div>
          </Link>
        );
      default:
        return (
          <Link to={link} className="card-link">
            <div className="card">
              <img src={image} alt={title} className="card-image" />
              <div className="card-body">
                <h2 className="card-title">{title}</h2>
                <p className="card-description">{description}</p>
              </div>
            </div>
          </Link>
        );
    }
  };

  return renderCardContent();
};

export default Card;
