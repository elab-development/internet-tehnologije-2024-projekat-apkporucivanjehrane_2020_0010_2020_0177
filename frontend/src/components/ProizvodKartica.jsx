import React from 'react';
import { ImPlus } from 'react-icons/im';
import Dugme from './Dugme';

const ProizvodKartica = ({ proizvod, dodajUKorpu }) => {
  const handleDodaj = () => {
    dodajUKorpu(proizvod);
  };

  return (
    <div className="proizvod-kartica">
      <img 
        src={proizvod.image || 'https://via.placeholder.com/200?text=Jelo'}
        alt={proizvod.name}
        className="proizvod-slika"
      />
      
      <div className="proizvod-body">
        <h4 className="proizvod-naziv">{proizvod.name}</h4>
        <p className="proizvod-opis">{proizvod.description}</p>
        
        <div className="proizvod-footer">
          <span className="proizvod-cena">{proizvod.price} RSD</span>
          <Dugme 
            onClick={handleDodaj} 
            tekst="Dodaj"
            ikonica={<ImPlus />}
            tip="primary"
            disabled={!proizvod.is_available}
          />
        </div>
        
        {!proizvod.is_available && (
          <div className="proizvod-nedostupan">Trenutno nedostupno</div>
        )}
      </div>
    </div>
  );
};

export default ProizvodKartica;

