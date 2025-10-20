import { useState, useEffect } from 'react';
import { porudzbineAPI } from '../utils/api';
import './MojePorudzbine.css';

const MojePorudzbine = () => {
  const [porudzbine, setPorudzbine] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    ucitajPorudzbine();
  }, []);

  const ucitajPorudzbine = async () => {
    try {
      const response = await porudzbineAPI.getAll();
      setPorudzbine(response.data.data || response.data);
    } catch (error) {
      console.error('Greška:', error);
    } finally {
      setLoading(false);
    }
  };

  const getStatusBadge = (status) => {
    const statusMap = {
      'nova': { label: 'Nova', class: 'status-nova' },
      'u_pripremi': { label: 'U pripremi', class: 'status-u-pripremi' },
      'na_putu': { label: 'Na putu', class: 'status-na-putu' },
      'dostavljena': { label: 'Dostavljena', class: 'status-dostavljena' },
      'otkazana': { label: 'Otkazana', class: 'status-otkazana' },
    };

    const statusInfo = statusMap[status] || { label: status, class: '' };
    
    return <span className={`status-badge ${statusInfo.class}`}>{statusInfo.label}</span>;
  };

  if (loading) return <div className="loading">Učitavanje...</div>;

  return (
    <div className="moje-porudzbine">
      <h1>Moje Porudžbine</h1>

      {porudzbine.length === 0 ? (
        <div className="nema-porudzbina">
          <p>Nemate porudžbina</p>
        </div>
      ) : (
        <div className="porudzbine-lista">
          {porudzbine.map((porudzbina) => (
            <div key={porudzbina.id} className="porudzbina-kartica">
              <div className="porudzbina-header">
                <div>
                  <h3>{porudzbina.restoran?.naziv || 'Restoran'}</h3>
                  <p className="datum">{new Date(porudzbina.created_at).toLocaleString('sr-RS')}</p>
                </div>
                {getStatusBadge(porudzbina.status)}
              </div>

              <div className="porudzbina-stavke">
                {porudzbina.jela && porudzbina.jela.map((jelo) => (
                  <div key={jelo.id} className="stavka">
                    <span>{jelo.naziv} x{jelo.kolicina}</span>
                    <span>{jelo.cena_stavke * jelo.kolicina} RSD</span>
                  </div>
                ))}
              </div>

              <div className="porudzbina-footer">
                <strong>Ukupno: {porudzbina.ukupna_cena} RSD</strong>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
};

export default MojePorudzbine;

