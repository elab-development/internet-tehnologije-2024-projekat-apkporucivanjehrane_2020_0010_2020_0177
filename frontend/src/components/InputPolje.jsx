import React from 'react';

const InputPolje = ({ 
  tip = 'text', 
  placeholder, 
  value, 
  onChange, 
  label,
  required = false,
  ikonica
}) => {
  return (
    <div className="input-grupa">
      {label && <label className="input-label">{label}</label>}
      <div className="input-wrapper">
        {ikonica && <span className="input-ikonica">{ikonica}</span>}
        <input 
          type={tip}
          className={`input-polje ${ikonica ? 'sa-ikonom' : ''}`}
          placeholder={placeholder}
          value={value}
          onChange={onChange}
          required={required}
        />
      </div>
    </div>
  );
};

export default InputPolje;

