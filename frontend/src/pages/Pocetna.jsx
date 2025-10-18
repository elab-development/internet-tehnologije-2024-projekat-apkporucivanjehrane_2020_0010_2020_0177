import React, { useState, useEffect } from 'react';
import api from '../utils/api';
import RestoranKartica from '../components/RestoranKartica';
import Loading from '../components/Loading';
import InputPolje from '../components/InputPolje';
import Paginacija from '../components/Paginacija';
import { ImSearch } from 'react-icons/im';

const Pocetna = () => {
  const [restorani, setRestorani] = useState([]);
  const [kategorije, setKategorije] = useState([]);
  const [ucitavanje, setUcitavanje] = useState(true);
  const [pretraga, setPretraga] = useState('');
  const [izabranaKategorija, setIzabranaKategorija] = useState('');
  const [trenutnaStranica, setTrenutnaStranica] = useState(1);
  const [meta, setMeta] = useState(null);

  useEffect(() => {
    ucitajKategorije();
  }, []);

  useEffect(() => {
    ucitajRestorane();
  }, [pretraga, izabranaKategorija, trenutnaStranica]);

  const ucitajKategorije = async () => {
    try {
      const response = await api.get('/public/kategorije');
      if (response.data.success) {
        setKategorije(response.data.data);
      }
    } catch (error) {
      console.error('Greška pri učitavanju kategorija:', error);
    }
  };

  const ucitajRestorane = async () => {
    try {
      setUcitavanje(true);
      
      const params = {
        page: trenutnaStranica,
        per_page: 6,
      };
      
      if (pretraga) params.search = pretraga;
      if (izabranaKategorija) params.category_id = izabranaKategorija;

      const response = await api.get('/public/restorani', { params });
      
      if (response.data.success) {
        setRestorani(response.data.data);
        setMeta(response.data.meta);
      }
      setUcitavanje(false);
    } catch (error) {
      console.error('Greška pri učitavanju restorana:', error);
      setUcitavanje(false);
    }
  };

  const handlePretragaChange = (e) => {
    setPretraga(e.target.value);
    setTrenutnaStranica(1); // Reset na prvu stranicu
  };

  const handleKategorijaChange = (kategorijaId) => {
    setIzabranaKategorija(kategorijaId);
    setTrenutnaStranica(1);
  };

  const handlePageChange = (stranica) => {
    setTrenutnaStranica(stranica);
    window.scrollTo({ top: 0, behavior: 'smooth' });
  };

  return (
    <div className="pocetna-stranica">
      <div className="hero-sekcija">
        <h1>🍕 Poručite hranu iz omiljenih restorana</h1>
        <p>Brza dostava, širok izbor, odlične cene!</p>
      </div>

      {/* Pretraga */}
      <div className="pretraga-sekcija">
        <InputPolje
          tip="text"
          placeholder="Pretražite restorane..."
          value={pretraga}
          onChange={handlePretragaChange}
          ikonica={<ImSearch />}
        />
      </div>

      {/* Kategorije */}
      <div className="kategorije-sekcija">
        <button
          className={`kategorija-dugme ${izabranaKategorija === '' ? 'active' : ''}`}
          onClick={() => handleKategorijaChange('')}
        >
          Sve
        </button>
        {kategorije.map(kategorija => (
          <button
            key={kategorija.id}
            className={`kategorija-dugme ${izabranaKategorija === kategorija.id ? 'active' : ''}`}
            onClick={() => handleKategorijaChange(kategorija.id)}
          >
            {kategorija.name}
          </button>
        ))}
      </div>

      {/* Restorani */}
      {ucitavanje ? (
        <Loading poruka="Učitavanje restorana..." />
      ) : (
        <>
          {restorani.length === 0 ? (
            <div className="nema-rezultata">
              <h3>Nema pronađenih restorana</h3>
              <p>Pokušajte sa drugom pretragom ili kategorijom</p>
            </div>
          ) : (
            <>
              <div className="restorani-grid">
                {restorani.map(restoran => (
                  <RestoranKartica key={restoran.id} restoran={restoran} />
                ))}
              </div>

              {/* Paginacija */}
              {meta && meta.last_page > 1 && (
                <Paginacija
                  currentPage={meta.current_page}
                  lastPage={meta.last_page}
                  onPageChange={handlePageChange}
                />
              )}
            </>
          )}
        </>
      )}
    </div>
  );
};

export default Pocetna;

