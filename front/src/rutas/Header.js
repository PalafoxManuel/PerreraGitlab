import React from 'react';
import './styles/Header.css';
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
          <img src="https://static.vecteezy.com/system/resources/previews/006/470/722/non_2x/pet-shop-logo-design-template-modern-animal-icon-label-for-store-veterinary-clinic-hospital-shelter-business-services-flat-illustration-background-with-dog-cat-and-horse-free-vector.jpg" alt="Logo" />
        </div>
      </nav>
    </header>
  );
};

export default Header;
