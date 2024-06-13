// Versión 6 de React Router
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
import SignUp from './rutas/SignUp';
import Home from './rutas/Home';
import LogIn from './rutas/LogIn';
import Agregar from './rutas/Agregar';
import Adoptar from './rutas/Adoptar';
import Historial from './rutas/Historial';
import Reporte from './rutas/Reporte';
import AdminLogIn from './rutas/AdminLogIn';
import AdminSignUp from './rutas/AdminSignUp';
import Alojamiento from './rutas/Alojamiento';
import Vacunacion from './rutas/Vacunacion';
import Baño from './rutas/Baño';
import CortePelo from './rutas/CortePelo';
import CorteUñas from './rutas/CorteUñas';
import ReporteExtravio from './rutas/ReporteExtravio';
import ReporteMaltrato from './rutas/ReporteMaltrato';
import AdminHome from './rutas/AdminHome';
import AdminAgregarVacuna from './rutas/AdminAgregarVacuna';
import AdminReporte from './rutas/AdminReporte';
import AdminReporteVacuna from './rutas/AdminReporteVacuna';
import AdminReporteAdopcion from './rutas/AdminReporteAdopcion';
import AdminReporteMaltrato from './rutas/AdminReporteMaltrato';
import AdminReporteExtravio from './rutas/AdminReporteExtravio';
import AdminAgregar from './rutas/AdminAgregar';
import AdminAdoptar from './rutas/AdminAdoptar';
import AdminAlojamiento from './rutas/AdminAlojamiento';
import AdminVacunacion from './rutas/AdminVacunacion';
import AdminBaño from './rutas/AdminBaño';
import AdminCortePelo from './rutas/AdminCortePelo';
import AdminCorteUñas from './rutas/AdminCorteUñas';
import AdminHistorial from './rutas/AdminHistorial';
const Rutas = () => {
    return (
        <Router>
          <Routes>
            <Route path="/" element={<LogIn />} />
            <Route path="/Home" element={<Home />} />
            <Route path="/SignUp" element={<SignUp />} />
            <Route path="/Agregar" element={<Agregar />} />
            <Route path="/Adoptar" element={<Adoptar />} />
            <Route path="/Historial" element={<Historial />} />
            <Route path="/Reporte" element={<Reporte />} />
            <Route path="/AdminLogIn" element={<AdminLogIn />} />
            <Route path="/AdminSignUp" element={<AdminSignUp />} />
            <Route path="/Alojamiento" element={<Alojamiento />} />
            <Route path="/Vacunacion" element={<Vacunacion />} />
            <Route path="/Baño" element={<Baño />} />
            <Route path="/CortePelo" element={<CortePelo />} />
            <Route path="/CorteUñas" element={<CorteUñas />} />
            <Route path="/ReporteExtravio" element={<ReporteExtravio />} />
            <Route path="/ReporteMaltrato" element={<ReporteMaltrato />} />
            <Route path="/AdminHome" element={<AdminHome />} />
            <Route path="/AdminAgregarVacuna" element={<AdminAgregarVacuna />} />
            <Route path="/AdminReporte" element={<AdminReporte />} />
            <Route path="/AdminReporteVacuna" element={<AdminReporteVacuna />} />
            <Route path="/AdminReporteAdopcion" element={<AdminReporteAdopcion />} />
            <Route path="/AdminReporteMaltrato" element={<AdminReporteMaltrato />} />
            <Route path="/AdminReporteExtravio" element={<AdminReporteExtravio />} />
            <Route path="/AdminAgregar" element={<AdminAgregar />} />
            <Route path="/AdminAdoptar" element={<AdminAdoptar />} />
            <Route path="/AdminAlojamiento" element={<AdminAlojamiento />} />
            <Route path="/AdminVacunacion" element={<AdminVacunacion />} />
            <Route path="/AdminBaño" element={<AdminBaño />} />
            <Route path="/AdminCortePelo" element={<AdminCortePelo />} />
            <Route path="/AdminCorteUñas" element={<AdminCorteUñas />} />
            <Route path="/AdminHistorial" element={<AdminHistorial />} />
          </Routes>
        </Router>
      );
};

export default Rutas;
