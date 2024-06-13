import React, { useState } from 'react';
import Logo from '../img/Logo.png';
import axios from 'axios';
import { Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/LogIn.css';

const URI_USUARIO = 'http://localhost:8000/usuario';

const Login = () => {
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [loginError, setLoginError] = useState(false);
  const [errorMessage, setErrorMessage] = useState('');

  const handleFormSubmit = async (event) => {
    event.preventDefault();
    try {
      const response = await axios.get(URI_USUARIO);
      const usuarios = response.data;
      console.log("Usuarios encontrados:");
      console.log(usuarios);

      // Capturar los valores actuales de username y password
      const usernameValue = username.trim(); // Eliminar espacios en blanco adicionales
      const passwordValue = password.trim(); // Eliminar espacios en blanco adicionales

      console.log("Credenciales ingresadas:");
      console.log("Username:", usernameValue);
      console.log("Password:", passwordValue);

      // Verificar si existe un usuario con las credenciales ingresadas
      const usuarioEncontrado = usuarios.find(user => user.nombre === usernameValue && user.password === passwordValue);

      if (usuarioEncontrado) {
        // Aquí podrías redirigir al usuario a la página principal o realizar otras acciones necesarias para un inicio de sesión exitoso
        console.log('Inicio de sesión exitoso para:', usuarioEncontrado.nombre);
        setLoginError(false);
        setErrorMessage('');
        // Aquí podrías redirigir al usuario o hacer otra acción luego del login exitoso
      } else {
        console.log('Credenciales incorrectas');
        setLoginError(true);
        setErrorMessage('Credenciales incorrectas. Por favor, inténtalo de nuevo.');
      }

    } catch (error) {
      console.error('Error al obtener usuarios:', error);
      setLoginError(true);
      setErrorMessage('Error al intentar iniciar sesión. Por favor, inténtalo más tarde.');
    }
  };

  return (
    <div className="back-container">
      <div className="logo-container">
        <img src={Logo} alt="Logo" className="logo" />
        <p className="logo-text">Patitas Felices</p>
      </div>
      <div className="form-wrapper-LogIn">
        <div className="form-container">
          <h1 className="text-center text-white">¡Bienvenido!</h1>
          <form onSubmit={handleFormSubmit}>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user"></i></span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  placeholder="Usuario"
                  value={username}
                  onChange={(e) => setUsername(e.target.value)}
                />
              </div>
            </div>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-lock"></i></span>
                </div>
                <input
                  type="password"
                  className="form-control"
                  placeholder="Contraseña"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                />
              </div>
            </div>
            <button type="submit" className="btn btn-primary btn-block">Iniciar sesión</button>
            {loginError && <p className="text-center text-danger mt-2">{errorMessage}</p>}
            <p className="text-center mt-3 text-white">¿No tienes cuenta? <Link to="/" className="text-primary">¡Crea una ahora!</Link></p>

            <Link to="/AdminLogIn">
              <button type="button" className="btn btn-primary btn-block">LogIn Admin (Temporal)</button>
            </Link>
          </form>
        </div>
      </div>
    </div>
  );
};

export default Login;
