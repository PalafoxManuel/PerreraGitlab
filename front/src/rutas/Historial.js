import React from 'react';
import Card from '../componentes/Card'; // Ajuste de la ruta a '../componentes/Card'
import Header from '../componentes/Header';
// import './styles/Agregar.css';
import './styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'

const Agregar = () => {

  return (
    <div>
    <Header />
    <div className="back-container">
      <div className="form-wrapper-2">
      <div>
        Historial
      </div>  
      </div>
    </div>
  </div>
  );
};

export default Agregar;
