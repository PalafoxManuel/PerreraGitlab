import React from 'react';
import Logo from '../img/Logo.png';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/SignUp.css';

const SignUp = () => {
  return (
    <div className="back-container">
      <div className="logo-container">
        <img src={Logo} alt="Logo" className="logo" />
        <p className="logo-text">Palafox Feliz</p>
      </div>
      <div className="form-wrapper-SignUp">
        <div className="form-container">
          <h1 className="text-center text-white">Registro</h1>
          <form>
            <div className="form-group">
              <label htmlFor="nombreCompleto" className="custom-label text-white">Nombre Completo *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user"></i></span>
                </div>
                <input type="text" className="form-control" id="nombreCompleto" placeholder="Ingresa tu nombre completo" />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="numeroCelular" className="custom-label text-white">Número de Celular *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
                <input type="text" className="form-control" id="numeroCelular" placeholder="Ingresa tu número de celular" />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="email" className="custom-label text-white">Correo Electrónico *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-envelope"></i></span>
                </div>
                <input type="email" className="form-control" id="email" placeholder="Ingresa tu correo electrónico" />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="calle" className="custom-label text-white">Calle *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-road"></i></span>
                </div>
                <input type="text" className="form-control" id="calle" placeholder="Ingresa tu calle" />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="codigoPostal" className="custom-label text-white">Código Postal *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-envelope-open-text"></i></span>
                </div>
                <input type="text" className="form-control" id="codigoPostal" placeholder="Ingresa tu código postal" />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="nombreUsuario" className="custom-label text-white">Nombre de Usuario *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user-circle"></i></span>
                </div>
                <input type="text" className="form-control" id="nombreUsuario" placeholder="Ingresa tu nombre de usuario" />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="password" className="custom-label text-white">Contraseña *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-lock"></i></span>
                </div>
                <input type="password" className="form-control" id="password" placeholder="Ingresa tu contraseña" />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="confirmarPassword" className="custom-label text-white">Confirmar Contraseña *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-lock"></i></span>
                </div>
                <input type="password" className="form-control" id="confirmarPassword" placeholder="Confirma tu contraseña" />
              </div>
            </div>
            <Link to="/Home">
              <button type="submit" className="btn btn-primary btn-block">Crear cuenta</button>
            </Link>
            <p className="text-center mt-3 text-white">¿Ya tienes cuenta? <Link to="/LogIn" className="text-primary">Ingresa aquí</Link></p>
          
            <Link to="/AdminSignUp">
              <button type="submit" className="btn btn-primary btn-block">SignUp Admin (Temporal)</button>
            </Link>
          </form>
        </div>
      </div>
    </div>
  );
};

export default SignUp;
