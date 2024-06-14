import axios from 'axios';
import { Link } from 'react-router-dom';
import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import React from 'react';
import Logo from '../img/Logo.png';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/SignUp.css';

const URI_CLIENTE = 'http://uri.proyectounipedro.com/cliente';

const URI_USUARIO = 'http://uri.proyectounipedro.com/usuario';

const SignUp = () => {
  const [nombreCompleto, setNombreCompleto] = useState('');
  const [numeroCelular, setNumeroCelular] = useState('');
  const [correoElectronico, setCorreoElectronico] = useState('');
  const [calle, setCalle] = useState('');
  const [codigoPostal, setCodigoPostal] = useState('');
  const [nombreUsuario, setNombreUsuario] = useState('');
  const [password, setPassword] = useState('');
  const [confirmarPassword, setConfirmarPassword] = useState('');
  const navigate = useNavigate();

// Función para guardar el cliente
const handleClientSubmit = async () => {
  try {
    const response = await axios.post(URI_CLIENTE, {
      Nombre_Completo: nombreCompleto,
      Numero_Contacto: numeroCelular,
      Correo_Electronico: correoElectronico,
      Calle: calle,
      Codigo_Postal: codigoPostal
    });
    console.log('Cliente guardado exitosamente:', response.data);
    return response.data.Id_Cliente; // Retorna el ID del cliente recién creado
  } catch (error) {
    console.error('Error al guardar el cliente:', error);
    throw error;
  }
};

// Función para guardar el usuario
const handleUserSubmit = async (clienteId) => {
  try {
    const response = await axios.post(URI_USUARIO, {
      Nombre_Usuario: nombreUsuario,
      Contrasena: password,
      Id_Cliente: clienteId ,
      Id_Perrera: 1
    });
    console.log('Usuario creado exitosamente:', response.data);
  } catch (error) {
    console.error('Error al crear el usuario:', error);
    throw error;
  }
};


// Función para manejar el envío del formulario
const handleFormSubmit = async (e) => {
  e.preventDefault();

  try {
    const clienteId = await handleClientSubmit(); // Obtén el ID del cliente

    if (clienteId) {
      await handleUserSubmit(clienteId); // Crea el usuario usando el ID del cliente
      navigate('/'); // Redirige a la página Home después de registrar cliente y usuario
    } else {
      console.error('No se pudo obtener el ID del cliente.');
    }
  } catch (error) {
    console.error('Error en el registro:', error);
  }
};

  return (
    <div className="back-container">
      <div className="logo-container">
        <img src={Logo} alt="Logo" className="logo" />
        <p className="logo-text">Huellitas Felices</p>
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
            <button type="submit" className="btn btn-primary btn-block">Crear cuenta</button>
            <p className="text-center mt-3 text-white">
              ¿Ya tienes cuenta?{' '}
              <Link to="/" className="text-primary">
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
