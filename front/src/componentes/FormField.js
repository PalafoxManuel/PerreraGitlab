import React from 'react';
import '../rutas/styles/FormField.css'; // Asegúrate de incluir el archivo CSS para los estilos

const FormField = ({ label, type, required, options, ...props }) => {
  return (
    <div className="form-field">
      <label className="form-field-label">{label}</label>
      {type === 'select' ? (
        <select className="form-field-select" {...props} required={required}>
          {options.map(option => (
            <option key={option.value} value={option.value}>
              {option.label}
            </option>
          ))}
        </select>
      ) : type === 'textarea' ? (
        <textarea className="form-field-textarea" {...props} required={required}></textarea>
      ) : type === 'checkbox' ? (
        <div className="custom-checkbox-container">
          <input type="checkbox" id={label} className="custom-checkbox-input" {...props} required={required} />
          <label htmlFor={label} className="custom-checkbox-label"></label>
        </div>
      ) : (
        <input type={type} className="form-field-input" {...props} required={required} />
      )}
    </div>
  );
};

export default FormField;
