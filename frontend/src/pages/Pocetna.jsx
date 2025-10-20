import { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import { restoraniAPI } from '../utils/api';
import Kartica from '../components/Kartica';
import InputPolje from '../components/InputPolje';
import './Pocetna.css';

const Pocetna = () => {
  const [restorani, setRestorani] = useState([]);
  const [loading, setLoading] = useState(true);
  const [pretraga, setPretraga] = useState('');
  const navigate = useNavigate();

  useEffect(() => {
    ucitajRestorane();
  }, []);

  const ucitajRestorane = async (searchTerm = '') => {
    setLoading(true);
    try {
      const params = searchTerm ? { pretraga: searchTerm } : {};
      const response = await restoraniAPI.getAll(params);
      setRestorani(response.data.data || response.data);
    } catch (error) {
      console.error('Greška pri učitavanju restorana:', error);
    } finally {
      setLoading(false);
    }
  };

  const handleSearch = (e) => {
    const value = e.target.value;
    setPretraga(value);
    ucitajRestorane(value);
  };

  if (loading) {
    return <div className="loading">Učitavanje...</div>;
  }

  return (
    <div className="pocetna">
      <div className="hero">
        <h1>Poručite hranu iz najboljih restorana</h1>
        <p>Brza dostava, ukusna hrana, zadovoljni korisnici</p>
      </div>

      <div className="container">
        <div className="search-section">
          <InputPolje
            placeholder="Pretražite restorane..."
            value={pretraga}
            onChange={handleSearch}
          />
        </div>

        <div className="restorani-grid">
          {restorani.length > 0 ? (
            restorani.map((restoran) => (
              <Kartica
                key={restoran.id}
                slika={restoran.slika}
                naslov={restoran.naziv}
                opis={restoran.opis}
                cena={restoran.cena_dostave}
                ocena={restoran.ocena}
                onClick={() => navigate(`/restoran/${restoran.id}`)}
              />
            ))
          ) : (
            <p className="no-results">Nema pronađenih restorana</p>
          )}
        </div>
      </div>
    </div>
  );
};

export default Pocetna;

