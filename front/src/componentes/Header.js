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

  const closeSidebar = () => {
    setSidebarOpen(false);
  };

  return (
    <header className="header-container">
      <nav className="navbar">
        <div className="navbar-menu" onClick={toggleSidebar}>
          <i className="fas fa-bars"></i>
        </div>
        <div className="navbar-title">
        <Link to="/Home" className='logo-text-black-link' onClick={toggleSidebar}>
          <p className="logo-text-black">huellitas Felices</p>
        </Link>
        </div>
        <div className="navbar-logo">
          <img src={Logo} alt="Logo" />
        </div>
      </nav>

      {sidebarOpen && <div className="backdrop" onClick={closeSidebar}></div>}

      <div className={`sidebar ${sidebarOpen ? 'open' : ''}`}>
        <ul className="sidebar-links">
          <li><Link to="/Home" onClick={toggleSidebar}><i className="fas fa-home"></i> Inicio</Link></li>
          <li><Link to="/Agregar" onClick={toggleSidebar}><i className="fas fa-plus-circle"></i> Agregar mascota</Link></li>
          <li><Link to="/Adoptar" onClick={toggleSidebar}><i className="fas fa-paw"></i> Adoptar</Link></li>
          <li><Link to="/Alojamiento" onClick={toggleSidebar}><i className="fas fa-hotel"></i> Alojamiento</Link></li>
          <li><Link to="/Vacunacion" onClick={toggleSidebar}><i className="fas fa-syringe"></i> Vacunación</Link></li>
          <li><Link to="/Baño" onClick={toggleSidebar}><i className="fas fa-bath"></i> Baño</Link></li>
          <li><Link to="/CortePelo" onClick={toggleSidebar}><i className="fas fa-cut"></i> Corte de Pelo</Link></li>
          <li><Link to="/CorteUñas" onClick={toggleSidebar}><i className="fas fa-paw"></i> Corte de Uñas</Link></li>
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
