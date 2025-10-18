import React, { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import api from '../utils/api';
import ProizvodKartica from '../components/ProizvodKartica';
import Loading from '../components/Loading';
import Breadcrumbs from '../components/Breadcrumbs';
import { ImClock, ImLocation, ImPhone } from 'react-icons/im';

const DetaljiRestorana = ({ dodajUKorpu }) => {
  const { id } = useParams();
  const [restoran, setRestoran] = useState(null);
  const [proizvodi, setProizvodi] = useState([]);
  const [ucitavanje, setUcitavanje] = useState(true);

  useEffect(() => {
    ucitajRestoran();
    ucitajMeni();
  }, [id]);

  const ucitajRestoran = async () => {
    try {
      const response = await api.get(`/public/restorani/${id}`);
      if (response.data.success) {
        setRestoran(response.data.data);
      }
    } catch (error) {
      console.error('Greška pri učitavanju restorana:', error);
    }
  };

  const ucitajMeni = async () => {
    try {
      setUcitavanje(true);
      const response = await api.get(`/public/restorani/${id}/meni`);
      if (response.data.success) {
        setProizvodi(response.data.proizvodi);
      }
      setUcitavanje(false);
    } catch (error) {
      console.error('Greška pri učitavanju menija:', error);
      setUcitavanje(false);
    }
  };

  if (!restoran || ucitavanje) {
    return <Loading poruka="Učitavanje restorana..." />;
  }

  return (
    <div className="detalji-restorana-stranica">
      <Breadcrumbs />
      
      <div className="restoran-header">
        <img 
          src={restoran.image || 'https://via.placeholder.com/800x300?text=Restoran'}
          alt={restoran.name}
          className="restoran-cover"
        />
        
        <div className="restoran-info">
          <h1>{restoran.name}</h1>
          <p className="restoran-kategorija">{restoran.category?.name}</p>
          <p className="restoran-opis">{restoran.description}</p>
          
          <div className="restoran-detalji">
            <div className="detalj-item">
              <ImLocation />
              <span>{restoran.address}</span>
            </div>
            <div className="detalj-item">
              <ImPhone />
              <span>{restoran.phone || 'Nema telefona'}</span>
            </div>
            <div className="detalj-item">
              <ImClock />
              <span>Dostava: {restoran.delivery_time} min | {restoran.delivery_price} RSD</span>
            </div>
          </div>
        </div>
      </div>

      <div className="meni-sekcija">
        <h2>Meni</h2>
        
        {proizvodi.length === 0 ? (
          <p>Nema dostupnih proizvoda</p>
        ) : (
          <div className="proizvodi-grid">
            {proizvodi.map(proizvod => (
              <ProizvodKartica 
                key={proizvod.id} 
                proizvod={proizvod}
                dodajUKorpu={dodajUKorpu}
              />
            ))}
          </div>
        )}
      </div>
    </div>
  );
};

export default DetaljiRestorana;

