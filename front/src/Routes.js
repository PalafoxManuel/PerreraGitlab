// Versión 6 de React Router
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import SignUp from './rutas/SignUp';
import Home from './rutas/Home';
import LogIn from './rutas/LogIn';
import Agregar from './rutas/Agregar';
import Adoptar from './rutas/Adoptar';
import Servicios from './rutas/Servicios';
import Historial from './rutas/Historial';
import Reporte from './rutas/Reporte';
import AdminLogIn from './rutas/AdminLogIn';
import AdminSignUp from './rutas/AdminSignUp';
const Rutas = () => {
    return (
        <Router>
          <Routes>
            <Route path="/" element={<SignUp />} />
            <Route path="/Home" element={<Home />} />
            <Route path="/LogIn" element={<LogIn />} />
            <Route path="/Agregar" element={<Agregar />} />
            <Route path="/Adoptar" element={<Adoptar />} />
            <Route path="/Servicios" element={<Servicios />} />
            <Route path="/Historial" element={<Historial />} />
            <Route path="/Reporte" element={<Reporte />} />
            <Route path="/AdminLogIn" element={<AdminLogIn />} />
            <Route path="/AdminSignUp" element={<AdminSignUp />} />
          </Routes>
        </Router>
      );
};

export default Rutas;
