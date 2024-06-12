import React from 'react';
import FormField from '../componentes/FormField'; // Asegúrate de que la ruta sea correcta

const Vacunacion = () => {
  return (
    <div>
      <h1>Vacunación</h1>
      <form>
        <FormField label="Tipo de Vacuna" type="text" required={true} />
        <FormField label="Dosis" type="number" required={true} />
        <button type="submit">Guardar</button>
      </form>
    </div>
  );
};

export default Vacunacion;
