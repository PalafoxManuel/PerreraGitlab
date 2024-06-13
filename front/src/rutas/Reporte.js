import React from 'react';
import Card from '../componentes/Card'; // Ajuste de la ruta a '../componentes/Card'
import Header from '../componentes/Header';
import '../rutas/styles/Header.css'; // Ajuste de la ruta a '../styles/Home.css'
import '../styles/Reportes.css'; // Importa los nuevos estilos

import perreraLogo from '../assets/images/perrera_logo.png'; // Ajusta la ruta según tu estructura de proyecto
// import huellitaLogo from '../assets/images/huellita_logo.png'; // Ajusta la ruta según tu estructura de proyecto

const Agregar = () => {
  return (
    <div>
      <Header />
      <div className="back-container">
        <div className="form-wrapper-2">
          <div className="comprobante">
            <div className="header">
              <img src={perreraLogo} alt="Logo de la perrera" className="logo" />
              <h1>Certificado de Vacunación Antirrábica Canina y Felina</h1>
              <img src={huellitaLogo} alt="Logo de huellita" className="logo" />
            </div>
            <hr />
            <p><strong>Jurisdicción Sanitaria:</strong> 03</p>
            <p><strong>Nombre del propietario:</strong> EDUARDO DIAZ</p>
            <p><strong>Domicilio:</strong> CALLE BANDERITAS</p>
            <hr />
            <p><strong>Sector:</strong> 23</p>
            <p><strong>Municipio:</strong> LA PAZ</p>
            <p><strong>Colonia:</strong> PARAISO DEL SOL</p>
            <p><strong>Fraccionamiento:</strong> ___________ <strong>Manzana:</strong> 222</p>
            <hr />
            <p><strong>Especie:</strong> Perro <input type="checkbox" checked readOnly /> Gato <input type="checkbox" readOnly /></p>
            <p><strong>Nombre:</strong> BILLY</p>
            <p><strong>Color:</strong> CAFÉ</p>
            <p><strong>Edad:</strong> 1 AÑO</p>
            <p><strong>Sexo:</strong> Macho <input type="checkbox" readOnly /> Hembra <input type="checkbox" checked readOnly /></p>
            <hr />
            <p><strong>Fecha de vacunación:</strong> 27/8/22</p>
            <p><strong>Próxima vacuna:</strong> 27/8/23</p>
            <p><strong>1ra. Dosis:</strong> <input type="checkbox" readOnly /> 2da. Dosis: <input type="checkbox" readOnly /></p>
            <p><strong>Lote del biológico:</strong> ___________</p>
            <p><strong>Nombre del vacunador:</strong> ___________</p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Agregar;
