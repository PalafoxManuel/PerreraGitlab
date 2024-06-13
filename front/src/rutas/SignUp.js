import React, { useState } from 'react';
import Logo from '../img/Logo.png';
import { Link } from 'react-router-dom';
import axios from 'axios';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';
import './styles/SignUp.css';

const URI = 'http://localhost:8000/cliente';
const URIU = 'http://localhost:8000/usuario';

const SignUp = () => {
  // Estados para los campos del formulario de registro
  const [Nombre_Completo, setNombre_Completo] = useState('');
  const [Numero_Contacto, setNumero_Contacto] = useState('');
  const [Correo_Electronico, setCorreo_Electronico] = useState('');
  const [Calle, setCalle] = useState('');
  const [Codigo_Postal, setCodigo_Postal] = useState('');

  // Estados para los campos del formulario de creación de usuario
  const [nombreUsuario, setNombreUsuario] = useState('');
  const [contraseña, setContraseña] = useState('');
  const [confirmarContraseña, setConfirmarContraseña] = useState('');

  // Función para manejar el envío del formulario
  const handleSubmit = async (e) => {
    e.preventDefault();
    if (contraseña !== confirmarContraseña) {
      alert('Las contraseñas no coinciden');
      return;
    }
    try {
      // Guardar el cliente
      await axios.post(URI, {
        Nombre_Completo,
        Numero_Contacto,
        Correo_Electronico,
        Calle,
        Codigo_Postal
      });

      // Crear usuario
      await axios.post(URIU, {
        nombreUsuario,
        contraseña
      });

      // Redirigir a la página de inicio u otra página después de la creación exitosa del usuario
      // Aquí puedes usar useHistory o cualquier otra forma de navegación que estés utilizando
      // Por ejemplo, redirigir a '/Home'
      // history.push('/Home');
      alert('Cuenta creada con éxito');
    } catch (error) {
      console.error('Error al crear cuenta:', error);
      // Manejar el error aquí, mostrar un mensaje al usuario, etc.
    }
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
          <form onSubmit={handleSubmit}>
            <div className="form-group">
              <label htmlFor="nombreCompleto" className="custom-label text-white">Nombre Completo *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user"></i></span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="nombreCompleto"
                  placeholder="Ingresa tu nombre completo"
                  value={Nombre_Completo}
                  onChange={(e) => setNombre_Completo(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="numeroCelular" className="custom-label text-white">Número de Celular *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-phone"></i></span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="numeroCelular"
                  placeholder="Ingresa tu número de celular"
                  value={Numero_Contacto}
                  onChange={(e) => setNumero_Contacto(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="email" className="custom-label text-white">Correo Electrónico *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-envelope"></i></span>
                </div>
                <input
                  type="email"
                  className="form-control"
                  id="email"
                  placeholder="Ingresa tu correo electrónico"
                  value={Correo_Electronico}
                  onChange={(e) => setCorreo_Electronico(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="calle" className="custom-label text-white">Calle *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-road"></i></span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="calle"
                  placeholder="Ingresa tu calle"
                  value={Calle}
                  onChange={(e) => setCalle(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="codigoPostal" className="custom-label text-white">Código Postal *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-envelope-open-text"></i></span>
                </div>
                <input
                  type="text"
                  className="form-control"
                  id="codigoPostal"
                  placeholder="Ingresa tu código postal"
                  value={Codigo_Postal}
                  onChange={(e) => setCodigo_Postal(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="nombreUsuario" className="custom-label text-white">Nombre de Usuario *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-user-circle"></i></span>
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
              <label htmlFor="password" className="custom-label text-white">Contraseña *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-lock"></i></span>
                </div>
                <input
                  type="password"
                  className="form-control"
                  id="password"
                  placeholder="Ingresa tu contraseña"
                  value={contraseña}
                  onChange={(e) => setContraseña(e.target.value)}
                  required
                />
              </div>
            </div>
            <div className="form-group">
              <label htmlFor="confirmarPassword" className="custom-label text-white">Confirmar Contraseña *</label>
              <div className="input-group">
                <div className="input-group-prepend">
                  <span className="input-group-text"><i className="fas fa-lock"></i></span>
                </div>
                <input
                  type="password"
                  className="form-control"
                  id="confirmarPassword"
                  placeholder="Confirma tu contraseña"
                  value={confirmarContraseña}
                  onChange={(e) => setConfirmarContraseña(e.target.value)}
                  required
                />
              </div>
            </div>
            <button type="submit" className="btn btn-primary btn-block">Crear cuenta</button>
          </form>
          <p className="text-center mt-3 text-white">¿Ya tienes cuenta? <Link to="/LogIn" className="text-primary">Ingresa aquí</Link></p>
          <Link to="/AdminSignUp">
            <button type="button" className="btn btn-primary btn-block">SignUp Admin (Temporal)</button>
          </Link>
        </div>
      </div>
    </div>
  );
};

export default SignUp;

