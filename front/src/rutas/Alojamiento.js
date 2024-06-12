import React from 'react';
import FormField from '../componentes/FormField'; // Asegúrate de que la ruta sea correcta

const Alojamiento = () => {
  return (
    <div>
      <h1>Alojamiento</h1>
      <form>
        <FormField label="Duración (días)" type="number" required={true} />
        <FormField label="Tipo de Habitación" type="select" options={[
          { value: 'estandar', label: 'Estándar' },
          { value: 'lujo', label: 'Lujo' },
        ]} required={true} />
        <button type="submit">Guardar</button>
      </form>
    </div>
  );
};

export default Alojamiento;
