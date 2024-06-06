// Versión 6 de React Router
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import Home from './rutas/Home';
// import About from './components/About';
// import Contact from './components/Contact';
const Rutas = () => {
    return (
        <Router>
          <Routes>
            <Route path="/" element={<Home />} />
            {/* <Route path="/about" element={<About />} />
            <Route path="/contact" element={<Contact />} /> */}
          </Routes>
        </Router>
      );
};

export default Rutas;
