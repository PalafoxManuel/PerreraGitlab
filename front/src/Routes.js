// Versión 6 de React Router
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import SignUp from './rutas/SignUp';
import Home from './rutas/Home';
const Rutas = () => {
    return (
        <Router>
          <Routes>
            <Route path="/" element={<SignUp />} />
            <Route path="/Home" element={<Home />} />
          </Routes>
        </Router>
      );
};

export default Rutas;
