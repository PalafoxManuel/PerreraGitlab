import React, { useState } from 'react';
import '../rutas/styles/Header.css';
import 'bootstrap/dist/css/bootstrap.min.css';
import Logo from '../img/Logo.png';
import { Link } from 'react-router-dom';

const AdminHeader = () => {
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
          <Link to="/AdminHome" className='logo-text-black-link' onClick={toggleSidebar}>
            <p className="logo-text-black">Huellitas Felices</p>
          </Link>
        </div>
        <div className="navbar-logo">
          <img src={Logo} alt="Logo" />
        </div>
      </nav>

      {sidebarOpen && <div className="backdrop" onClick={closeSidebar}></div>}

      <div className={`sidebar ${sidebarOpen ? 'open' : ''}`}>
        <ul className="sidebar-links">
          <li><Link to="/AdminHome" onClick={toggleSidebar}><i className="fas fa-home"></i> Inicio</Link></li>
          <li><Link to="/AdminAgregar" onClick={toggleSidebar}><i className="fas fa-plus-circle"></i> Agregar mascota</Link></li>
          <li><Link to="/AdminAdoptar" onClick={toggleSidebar}><i className="fas fa-paw"></i> Adoptar</Link></li>
          <li><Link to="/AdminAlojamiento" onClick={toggleSidebar}><i className="fas fa-hotel"></i> Alojamiento</Link></li>
          <li><Link to="/AdminVacunacion" onClick={toggleSidebar}><i className="fas fa-syringe"></i> Vacunación</Link></li>
          <li><Link to="/AdminBaño" onClick={toggleSidebar}><i className="fas fa-bath"></i> Baño</Link></li>
          <li><Link to="/AdminCortePelo" onClick={toggleSidebar}><i className="fas fa-cut"></i> Corte de Pelo</Link></li>
          <li><Link to="/AdminCorteUñas" onClick={toggleSidebar}><i className="fas fa-paw"></i> Corte de Uñas</Link></li>
          <li><Link to="/AdminHistorial" onClick={toggleSidebar}><i className="fas fa-history"></i> Historial</Link></li>
          <li><Link to="/AdminReporte" onClick={toggleSidebar}><i className="fas fa-file-alt"></i> Generar reporte</Link></li>
          <li><Link to="/AdminAgregarAdmin" onClick={toggleSidebar}><i className="fas fa-user-plus"></i> Agregar Admin</Link></li>
          <li><Link to="/AdminAgregarVacuna" onClick={toggleSidebar}><i className="fas fa-syringe"></i> Agregar Vacuna</Link></li>
        </ul>
        <ul className="sidebar-footer">
          <li><Link to="/" onClick={toggleSidebar}><i className="fas fa-sign-out-alt"></i> Cerrar sesión</Link></li>
        </ul>
      </div>
    </header>
  );
};

export default AdminHeader;
