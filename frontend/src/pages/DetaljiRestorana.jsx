import { useState, useEffect } from 'react';
import { useParams } from 'react-router-dom';
import { restoraniAPI } from '../utils/api';
import { useKorpa } from '../context/KorpaContext';
import Kartica from '../components/Kartica';
import Dugme from '../components/Dugme';
import './DetaljiRestorana.css';

const DetaljiRestorana = () => {
  const { id } = useParams();
  const [restoran, setRestoran] = useState(null);
  const [loading, setLoading] = useState(true);
  const { dodajUKorpu } = useKorpa();

  useEffect(() => {
    ucitajRestoran();
  }, [id]);

  const ucitajRestoran = async () => {
    try {
      const response = await restoraniAPI.getOne(id);
      setRestoran(response.data);
    } catch (error) {
      console.error('Greška:', error);
    } finally {
      setLoading(false);
    }
  };

  if (loading) return <div className="loading">Učitavanje...</div>;
  if (!restoran) return <div>Restoran nije pronađen</div>;

  return (
    <div className="detalji-restorana">
      <div className="restoran-header">
        <img src={restoran.slika} alt={restoran.naziv} />
        <div className="restoran-info">
          <h1>{restoran.naziv}</h1>
          <p>{restoran.opis}</p>
          <div className="restoran-meta">
            <span>⭐ {restoran.ocena}</span>
            <span>🚚 {restoran.vreme_dostave} min</span>
            <span>💰 Dostava: {restoran.cena_dostave} RSD</span>
          </div>
        </div>
      </div>

      <div className="meni-sekcija">
        <h2>Meni</h2>
        <div className="jela-grid">
          {restoran.jela && restoran.jela.map((jelo) => (
            <Kartica
              key={jelo.id}
              slika={jelo.slika}
              naslov={jelo.naziv}
              opis={jelo.opis}
              cena={jelo.cena}
            >
              <Dugme
                onClick={() => dodajUKorpu(jelo, restoran)}
                disabled={!jelo.dostupno}
              >
                {jelo.dostupno ? 'Dodaj u korpu' : 'Nedostupno'}
              </Dugme>
            </Kartica>
          ))}
        </div>
      </div>
    </div>
  );
};

export default DetaljiRestorana;

