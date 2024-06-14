import React, { useState } from 'react';
import Logo from '../img/Logo.png';
import { Link, useNavigate } from 'react-router-dom'; // Import useNavigate for navigation
import axios from 'axios'; // Import axios for HTTP requests
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/LogIn.css';

const URI_USUARIO = 'http://api.proyectounipedro.com/usuario';

const AdminSignUp = () => {
  const [nombreUsuario, setNombreUsuario] = useState('');
  const [password, setPassword] = useState('');
  const [confirmarPassword, setConfirmarPassword] = useState('');
  const navigate = useNavigate(); // Initialize navigate hook from React Router DOM

  const handleFormSubmit = async (event) => {
    event.preventDefault(); // Prevent default form submission

    try {
      const response = await axios.post(URI_USUARIO, {
        Nombre_Usuario: nombreUsuario,
        Contrasena: password,
        Id_Cliente: null
      });
      console.log('Usuario creado exitosamente:', response.data);
      // Redirect to another page upon successful submission
      navigate('/AdminHome'); // Example: navigate to the home page
    } catch (error) {
      console.error('Error al crear el usuario:', error);
      // Handle error appropriately (e.g., show error message)
    }
  };

  return (
    <div className="back-container-admin">
      <div className="logo-container">
        <img src={Logo} alt="Logo" className="logo" />
        <p className="logo-text">Patitas Felices</p>
      </div>
      <div className="form-wrapper-SignUp-Admin">
        <div className="form-container">
          <h1 className="text-center text-white">Registro</h1>
          <form onSubmit={handleFormSubmit}>
            <div className="form-group">
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user"></i></span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  placeholder="Nombre de usuario"
                  value={nombreUsuario}
                  onChange={(e) => setNombreUsuario(e.target.value)}
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
            <button type="submit" className="btn btn-primary btn-block">Crear cuenta</button>
            <p className="text-center mt-3 text-white">¿No eres admin? <Link to="/LogIn" className="text-primary">¡Regresa a la TodosSantos!</Link></p>
          </form>
        </div>
        <p className="logo-text">¡MODO ADMIN!</p>
      </div>
    </div>
  );
};

export default AdminSignUp;

