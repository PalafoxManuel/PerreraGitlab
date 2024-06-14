import React, { useState } from 'react';
import axios from 'axios';
import Logo from '../img/Logo.png';
import { Link, useNavigate } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/LogIn.css';

const URI_USUARIO = 'http://api.proyectounipedro.com/usuario';

const AdminLogin = () => {
 const [username, setUsername] = useState('');
 const [password, setPassword] = useState('');
 const [loginError, setLoginError] = useState(false);
 const [errorMessage, setErrorMessage] = useState('');
 const navigate = useNavigate();

 const handleFormSubmit = async (event) => {
  event.preventDefault();
  try {
   const response = await axios.get(URI_USUARIO);
   const usuarios = response.data;

   const usernameValue = username.trim();
   const passwordValue = password.trim();

   // Filtrar usuarios administradores cuyo campo `id_cliente` sea null
   const adminUsuarios = usuarios.filter(user => user.Id_Cliente === null);

   // Verificar las credenciales solo para usuarios administradores
   const usuarioEncontrado = adminUsuarios.find(
    user => user.Nombre_Usuario === usernameValue && user.Contrasena === passwordValue
   );

   if (usuarioEncontrado) {
    localStorage.setItem('usuario', JSON.stringify(usuarioEncontrado));
    localStorage.setItem('userId', usuarioEncontrado.Id_Usuario);

    navigate('/AdminHome');
   } else {
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
  <div className="back-container-admin">
   <div className="logo-container">
    <img src={Logo} alt="Logo" className="logo" />
    <p className="logo-text">Patitas Felices</p>
   </div>
   <div className="form-wrapper-LogIn-Admin">
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
         id="userId"
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
         id="password"
         placeholder="Contraseña"
         value={password}
         onChange={(e) => setPassword(e.target.value)}
        />
       </div>
      </div>
      <button type="submit" className="btn btn-primary btn-block">Iniciar sesión</button>
     </form>
     {loginError && <p className="text-danger mt-2">{errorMessage}</p>}
     <p className="text-center mt-3 text-white">¿No eres admin? <Link to="/LogIn" className="text-primary">¡Regresa al modo Usuario!</Link></p>
    </div>
    <p className="logo-text">¡MODO ADMIN!</p>
   </div>
  </div>
 );
};

export default AdminLogin;


