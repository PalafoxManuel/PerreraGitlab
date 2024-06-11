import React from 'react';
import Logo from '../img/Logo.png';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/LogIn.css';

const AdminSignUp = () => {
  return (
    <div className="back-container-admin">
      <div className="logo-container">
        <img src={Logo} alt="Logo" className="logo" />
        <p className="logo-text">Palafox Feliz</p>
      </div>
      <div className="form-wrapper-SignUp-Admin">
        <div className="form-container">
          <h1 className="text-center text-white">Registro</h1>
          <form>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user"></i></span>
                </div>
                <input type="text" className="form-control" placeholder="UserId" />
              </div>
            </div>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-envelope"></i></span>
                </div>
                <input type="email" className="form-control" placeholder="Correo Electrónico" />
              </div>
            </div>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-lock"></i></span>
                </div>
                <input type="password" className="form-control" placeholder="Contraseña" />
              </div>
            </div>
            <button type="submit" className="btn btn-primary btn-block">Crear cuenta</button>
            <p className="text-center mt-3 text-white">¿Ya tienes cuenta? <Link to="/AdminLogIn" className="text-primary">Ingresa aquí</Link></p>
          </form>
        </div>
        <p className="logo-text">¡MODO ADMIN!</p>
      </div>
    </div>
  );
};

export default AdminSignUp;
