import axios from 'axios';
import { useState } from 'react';

import React from 'react';
import Logo from '../img/Logo.png';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/SignUp.css';

const URI_CLIENTE = 'http://localhost:8000/cliente';
const URI_USUARIO = 'http://localhost:8000/usuario';

const SignUp = () => {
  const [nombreCompleto, setNombreCompleto] = useState('');
  const [numeroCelular, setNumeroCelular] = useState('');
  const [correoElectronico, setCorreoElectronico] = useState('');
  const [calle, setCalle] = useState('');
  const [codigoPostal, setCodigoPostal] = useState('');
  const [nombreUsuario, setNombreUsuario] = useState('');
  const [password, setPassword] = useState('');
  const [confirmarPassword, setConfirmarPassword] = useState('');

  // Función para guardar el cliente
  const handleClientSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.post(URI_CLIENTE, {
        Nombre_Completo: nombreCompleto,
        Numero_Contacto: numeroCelular,
        Correo_Electronico: correoElectronico,
        Calle: calle,
        Codigo_Postal: codigoPostal
      });
      console.log('Cliente guardado exitosamente.');
    } catch (error) {
      console.error('Error al guardar el cliente:', error);
    }
  };

  // Función para guardar el usuario
  const handleUserSubmit = async (e) => {
    e.preventDefault();
    try {
      await axios.post(URI_USUARIO, {
        nombreUsuario: nombreUsuario,
        contraseña: password
      });
      console.log('Usuario creado exitosamente:', response.data);
    } catch (error) {
      console.error('Error al crear el usuario:', error);
    }
  };

  const handleFormSubmit = async (e) => {
    e.preventDefault();
    await handleClientSubmit(e);
    await handleUserSubmit(e);
    // Puedes agregar aquí lógica adicional después de guardar ambos (si es necesario)
  };

  return (
    <div className="back-container">
      <div className="logo-container">
        <img src={Logo} alt="Logo" className="logo" />
        <p className="logo-text">Patitas Felices</p>
      </div>
      <div className="form-wrapper-SignUp">
        <div className="form-container">
          <h1 className="text-center text-white">Registro</h1>
          <form onSubmit={handleFormSubmit}>
            <div className="form-group">
              <label htmlFor="nombreCompleto" className="custom-label text-white">
                Nombre Completo *
              </label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text">
                    <i className="fas fa-user"></i>
                  </span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="nombreCompleto"
                  placeholder="Ingresa tu nombre completo"
                  value={nombreCompleto}
                  onChange={(e) => setNombreCompleto(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="numeroCelular" className="custom-label text-white">
                Número de Celular *
              </label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text">
                    <i className="fas fa-phone"></i>
                  </span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="numeroCelular"
                  placeholder="Ingresa tu número de celular"
                  value={numeroCelular}
                  onChange={(e) => setNumeroCelular(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="email" className="custom-label text-white">
                Correo Electrónico *
              </label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text">
                    <i className="fas fa-envelope"></i>
                  </span>
                </div>
                <input
                  type="email"
                  className="form-control"
                  id="email"
                  placeholder="Ingresa tu correo electrónico"
                  value={correoElectronico}
                  onChange={(e) => setCorreoElectronico(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="calle" className="custom-label text-white">
                Calle *
              </label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text">
                    <i className="fas fa-road"></i>
                  </span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="calle"
                  placeholder="Ingresa tu calle"
                  value={calle}
                  onChange={(e) => setCalle(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="codigoPostal" className="custom-label text-white">
                Código Postal *
              </label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text">
                    <i className="fas fa-envelope-open-text"></i>
                  </span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="codigoPostal"
                  placeholder="Ingresa tu código postal"
                  value={codigoPostal}
                  onChange={(e) => setCodigoPostal(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="nombreUsuario" className="custom-label text-white">
                Nombre de Usuario *
              </label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text">
                    <i className="fas fa-user-circle"></i>
                  </span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="nombreUsuario"
                  placeholder="Ingresa tu nombre de usuario"
                  value={nombreUsuario}
                  onChange={(e) => setNombreUsuario(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="password" className="custom-label text-white">
                Contraseña *
              </label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text">
                    <i className="fas fa-lock"></i>
                  </span>
                </div>
                <input
                  type="password"
                  className="form-control"
                  id="password"
                  placeholder="Ingresa tu contraseña"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="confirmarPassword" className="custom-label text-white">
                Confirmar Contraseña *
              </label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text">
                    <i className="fas fa-lock"></i>
                  </span>
                </div>
                <input
                  type="password"
                  className="form-control"
                  id="confirmarPassword"
                  placeholder="Confirma tu contraseña"
                  value={confirmarPassword}
                  onChange={(e) => setConfirmarPassword(e.target.value)}
                  required
                />
              </div>
            </div>
            <Link to="/Home">
              <button type="submit" className="btn btn-primary btn-block">Crear cuenta</button>
            </Link>
            <p className="text-center mt-3 text-white">
              ¿Ya tienes cuenta?{' '}
              <Link to="/LogIn" className="text-primary">
                Ingresa aquí
              </Link>
            </p>
          </form>
        </div>
      </div>
    </div>
  );
};

export default SignUp;

