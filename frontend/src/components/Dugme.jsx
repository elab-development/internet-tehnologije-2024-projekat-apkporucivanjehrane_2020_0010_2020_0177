import React from 'react';

const Dugme = ({ onClick, tekst, ikonica, tip = 'primary', disabled = false, className = '' }) => {
  return (
    <button 
      className={`dugme dugme-${tip} ${className}`}
      onClick={onClick}
      disabled={disabled}
    >
      {ikonica && <span className="dugme-ikonica">{ikonica}</span>}
      {tekst && <span className="dugme-tekst">{tekst}</span>}
    </button>
  );
};

export default Dugme;

