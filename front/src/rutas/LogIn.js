import React from 'react';
import Logo from '../img/Logo.png';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/LogIn.css';

const Login = () => {
  return (
    <div className="back-container">
      <div className="logo-container">
        <img src={Logo} alt="Logo" className="logo" />
        <p className="logo-text">Huellitas Felices</p>
      </div>
      <div className="form-wrapper-LogIn">
        <div className="form-container">
          <h1 className="text-center text-white">¡Bienvenido!</h1>
          <form>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user"></i></span>
                </div>
                <input type="text" className="form-control" placeholder="Usuario" />
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
            <button type="submit" className="btn btn-primary btn-block">Iniciar sesión</button>
            <p className="text-center mt-3 text-white">¿No tienes cuenta? <Link to="/" className="text-primary">¡Crea una ahora!</Link></p>

            <Link to="/AdminLogIn">
              <button type="submit" className="btn btn-primary btn-block">LogIn Admin (Temporal)</button>
            </Link>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Login;
