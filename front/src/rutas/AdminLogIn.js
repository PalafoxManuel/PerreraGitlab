import React from 'react';
import Logo from '../img/Logo.png';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/LogIn.css';

const AdminLogin = () => {
  return (
    <div className="back-container-admin">
      <div className="logo-container">
        <img src={Logo} alt="Logo" className="logo" />
        <p className="logo-text">Patitas Felices</p>
      </div>
      <div className="form-wrapper-LogIn-Admin">
        <div className="form-container">
          <h1 className="text-center text-white">¡Bienvenido!</h1>
          <form>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user"></i></span>
                </div>
                <input type="text" className="form-control" id="userId" placeholder="UserId" />
              </div>
            </div>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-lock"></i></span>
                </div>
                <input type="password" className="form-control" id="password" placeholder="Contraseña" />
              </div>
            </div>
            <Link to="/AdminLogIn" className="text-primary">
            <button type="submit" className="btn btn-primary btn-block">Iniciar sesión</button>
            </Link>
            <p className="text-center mt-3 text-white">¿No eres admin? <Link to="/LogIn" className="text-primary">¡Regresa a la TodosSantos!</Link></p>
          </form>
        </div>
        <p className="logo-text">¡MODO ADMIN!</p>
      </div>
    </div>
  );
};

export default AdminLogin;
