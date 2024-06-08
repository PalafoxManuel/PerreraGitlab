// Versión 6 de React Router
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import SignUp from './rutas/SignUp';
import Home from './rutas/Home';
import LogIn from './rutas/LogIn';
const Rutas = () => {
    return (
        <Router>
          <Routes>
            <Route path="/" element={<SignUp />} />
            <Route path="/Home" element={<Home />} />
            <Route path="/LogIn" element={<LogIn />} />
          </Routes>
        </Router>
      );
};

export default Rutas;
