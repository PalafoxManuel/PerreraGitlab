import React from 'react';
import './Header.css';
import 'bootstrap/dist/css/bootstrap.min.css';

const Header = () => {
  return (
    <header className="header-container">
      <nav className="navbar">
        <div className="navbar-menu">
          <i className="fas fa-bars"></i>
        </div>
        <div className="navbar-title">
          <h1>LOMNY</h1>
          <span>YOGGN HERE</span>
        </div>
        <div className="navbar-logo">
          <img src="https://example.com/logo.png" alt="Logo" />
        </div>
      </nav>
    </header>
  );
};

export default Header;
