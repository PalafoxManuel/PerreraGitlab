import React, { useState } from 'react';
import '../rutas/styles/Header.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Logo from '../img/Logo.png';
import { Link } from 'react-router-dom';

const Header = () => {
  const [sidebarOpen, setSidebarOpen] = useState(false);

  const toggleSidebar = () => {
    setSidebarOpen(!sidebarOpen);
  };

  return (
    <header className="header-container">
      <nav className="navbar">
        <div className="navbar-menu" onClick={toggleSidebar}>
          <i className="fas fa-bars"></i>
        </div>
        <div className="navbar-title">
          <h1>LOMNY</h1>
          <span>YOGGN HERE</span>
        </div>
        <div className="navbar-logo">
          <img src={Logo} alt="Logo" />
        </div>
      </nav>

      <div className={`sidebar ${sidebarOpen ? 'open' : ''}`}>
        <ul className="sidebar-links">
          <li><Link to="/" onClick={toggleSidebar}><i className="fas fa-home"></i> Inicio</Link></li>
          <li><Link to="/Agregar" onClick={toggleSidebar}><i className="fas fa-plus-circle"></i> Agregar mascota</Link></li>
          <li><Link to="/Adoptar" onClick={toggleSidebar}><i className="fas fa-paw"></i> Adoptar</Link></li>
          <li><Link to="/Servicios" onClick={toggleSidebar}><i className="fas fa-concierge-bell"></i> Servicios</Link></li>
          <li><Link to="/Historial" onClick={toggleSidebar}><i className="fas fa-history"></i> Historial</Link></li>
          <li><Link to="/Reporte" onClick={toggleSidebar}><i className="fas fa-file-alt"></i> Generar reporte</Link></li>
        </ul>
        <ul className="sidebar-footer">
          <li><Link to="/LogIn" onClick={toggleSidebar}><i className="fas fa-sign-out-alt"></i> Cerrar sesión</Link></li>
        </ul>
      </div>
    </header>
  );
};

export default Header;
