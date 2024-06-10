import React from 'react';
import { Link } from 'react-router-dom';
import '../rutas/styles/Card.css'; // Ajuste de la ruta a '../rutas/styles/Card.css'

const Card = ({ title, description, image, link }) => {
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
};

export default Card;
