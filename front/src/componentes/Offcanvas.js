import React from 'react';
import '../rutas/styles/Offcanvas.css';

const Offcanvas = ({ isOpen, onClose, title, children }) => {
  return (
    <div>
      <div className={`backdrop ${isOpen ? 'open' : ''}`} onClick={onClose}></div>
      <div className={`offcanvas ${isOpen ? 'open' : ''}`}>
        <div className="offcanvas-header">
          <h2>{title}</h2>
          <button className="close-button" onClick={onClose}>×</button>
        </div>
        <div className="offcanvas-body">
          {children}
        </div>
      </div>
    </div>
  );
};

export default Offcanvas;
