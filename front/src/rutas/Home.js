// Home.js
import React from 'react';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/Home.css';

const Home = () => {
  return (
    <div className="home-container">
      <div className="form-container">
        <div className="logo-container">
          <img src="logo.png" alt="Logo" className="logo" /> {/* Reemplaza con la ruta correcta a tu logo */}
        </div>
        <h1 className="text-center text-white">Registro</h1>
        <form>
          <div className="form-group">
            <label htmlFor="nombre" className="custom-label text-white">Nombre *</label>
            <div className="input-group">
              <div className="input-group-prepend">
                <span className="input-group-text"><i className="fas fa-user"></i></span>
              </div>
              <input type="text" className="form-control" id="nombre" placeholder="Ingresa tu nombre" />
            </div>
          </div>
          <div className="form-group">
            <label htmlFor="email" className="custom-label text-white">Correo electrónico *</label>
            <div className="input-group">
              <div className="input-group-prepend">
                <span className="input-group-text"><i className="fas fa-envelope"></i></span>
              </div>
              <input type="email" className="form-control" id="email" placeholder="Ingresa tu correo electrónico" />
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
            <label htmlFor="repetirPassword" className="custom-label text-white">Repetir contraseña *</label>
            <div className="input-group">
              <div className="input-group-prepend">
                <span className="input-group-text"><i className="fas fa-lock"></i></span>
              </div>
              <input type="password" className="form-control" id="repetirPassword" placeholder="Repite tu contraseña" />
            </div>
          </div>
          <div className="form-group">
            <label htmlFor="ciudad" className="custom-label text-white">Ciudad de residencia *</label>
            <div className="input-group">
              <div className="input-group-prepend">
                <span className="input-group-text"><i className="fas fa-map-marker-alt"></i></span>
              </div>
              <select className="form-control" id="ciudad">
                <option value="1">Ciudad A</option>
                <option value="2">Ciudad B</option>
                {/* Agrega más opciones según tus necesidades */}
              </select>
            </div>
          </div>
          <div className="form-group">
            <label htmlFor="edad" className="custom-label text-white">Edad *</label>
            <div className="input-group">
              <div className="input-group-prepend">
                <span className="input-group-text"><i className="fas fa-calendar-alt"></i></span>
              </div>
              <input type="number" className="form-control" id="edad" placeholder="Ingresa tu edad" />
            </div>
          </div>
          <div className="form-group">
            <label htmlFor="sexo" className="custom-label text-white">Sexo *</label>
            <div className="input-group">
              <div className="input-group-prepend">
                <span className="input-group-text"><i className="fas fa-venus-mars"></i></span>
              </div>
              <select className="form-control" id="sexo">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
              </select>
            </div>
          </div>
          <div className="form-group">
            <label htmlFor="telefono" className="custom-label text-white">Teléfono</label>
            <div className="input-group">
              <div className="input-group-prepend">
                <span className="input-group-text"><i className="fas fa-phone"></i></span>
              </div>
              <input type="text" className="form-control" id="telefono" placeholder="Ingresa tu teléfono" />
            </div>
          </div>
          <button type="submit" className="btn btn-primary btn-block">Crear cuenta</button>
          <p className="text-center mt-3 text-white">¿Ya tienes cuenta? <Link to="#" className="text-primary">Ingresa aquí</Link></p>
        </form>
      </div>
    </div>
  );
};

export default Home;
