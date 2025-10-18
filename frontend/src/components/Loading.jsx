import React from 'react';

const Loading = ({ poruka = 'Učitavanje...' }) => {
  return (
    <div className="loading-container">
      <div className="spinner"></div>
      <p className="loading-tekst">{poruka}</p>
    </div>
  );
};

export default Loading;

