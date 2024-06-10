import React from 'react';
import '../rutas/styles/FormField.css';

const FormField = ({ label, type, options, required }) => {
  if (type === 'select') {
    return (
      <div className="form-field">
        <label>{label} {required && '*'}</label>
        <select required={required}>
          {options.map((option, index) => (
            <option key={index} value={option.value}>{option.label}</option>
          ))}
        </select>
      </div>
    );
  }

  return (
    <div className="form-field">
      <label>{label} {required && '*'}</label>
      <input type={type} required={required} />
    </div>
  );
};

export default FormField;
