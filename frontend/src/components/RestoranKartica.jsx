import React from 'react';
import { useNavigate } from 'react-router-dom';
import { ImClock, ImLocation } from 'react-icons/im';

const RestoranKartica = ({ restoran }) => {
  const navigate = useNavigate();

  const handleClick = () => {
    navigate(`/restoran/${restoran.id}`);
  };

  return (
    <div className="restoran-kartica" onClick={handleClick}>
      <div className="kartica-header">
        <img 
          src={restoran.image || 'https://via.placeholder.com/300x200?text=Restoran'}
          alt={restoran.name}
          className="kartica-slika"
        />
        {!restoran.is_active && (
          <div className="kartica-overlay">Trenutno zatvoren</div>
        )}
      </div>
      
      <div className="kartica-body">
        <h3 className="kartica-naziv">{restoran.name}</h3>
        <p className="kartica-kategorija">{restoran.category?.name}</p>
        <p className="kartica-opis">{restoran.description}</p>
        
        <div className="kartica-info">
          <span className="info-item">
            <ImClock /> {restoran.delivery_time} min
          </span>
          <span className="info-item">
            <ImLocation /> {restoran.delivery_price} RSD dostava
          </span>
        </div>
      </div>
    </div>
  );
};

export default RestoranKartica;

