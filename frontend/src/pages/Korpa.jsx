import { useNavigate } from 'react-router-dom';
import { useKorpa } from '../context/KorpaContext';
import { useAuth } from '../context/AuthContext';
import Dugme from '../components/Dugme';
import './Korpa.css';

const Korpa = () => {
  const { stavke, restoran, promeniKolicinu, ukloniIzKorpe, ukupnaCena, isprazniKorpu } = useKorpa();
  const { user } = useAuth();
  const navigate = useNavigate();

  if (stavke.length === 0) {
    return (
      <div className="prazna-korpa">
        <h2>Vaša korpa je prazna</h2>
        <p>Dodajte jela iz restorana</p>
        <Dugme onClick={() => navigate('/')}>Nazad na početnu</Dugme>
      </div>
    );
  }

  const handleNaruci = () => {
    if (!user) {
      navigate('/login');
      return;
    }
    navigate('/narucivanje');
  };

  return (
    <div className="korpa-container">
      <h1>Vaša Korpa</h1>
      
      {restoran && (
        <div className="korpa-restoran">
          <h3>🍽️ {restoran.naziv}</h3>
          <p>{restoran.adresa}</p>
        </div>
      )}

      <div className="korpa-stavke">
        {stavke.map((stavka) => (
          <div key={stavka.id} className="korpa-stavka">
            <img src={stavka.slika} alt={stavka.naziv} />
            <div className="stavka-info">
              <h4>{stavka.naziv}</h4>
              <p className="stavka-cena">{stavka.cena} RSD</p>
            </div>
            
            <div className="stavka-kontrole">
              <button onClick={() => promeniKolicinu(stavka.id, stavka.kolicina - 1)}>-</button>
              <span>{stavka.kolicina}</span>
              <button onClick={() => promeniKolicinu(stavka.id, stavka.kolicina + 1)}>+</button>
            </div>

            <div className="stavka-ukupno">
              {stavka.cena * stavka.kolicina} RSD
            </div>

            <button 
              className="ukloni-btn" 
              onClick={() => ukloniIzKorpe(stavka.id)}
            >
              ✕
            </button>
          </div>
        ))}
      </div>

      <div className="korpa-footer">
        <div className="korpa-ukupno">
          <span>Ukupno:</span>
          <strong>{ukupnaCena} RSD</strong>
        </div>
        
        <div className="korpa-akcije">
          <Dugme tip="outline" onClick={isprazniKorpu}>
            Isprazni korpu
          </Dugme>
          <Dugme onClick={handleNaruci}>
            Naruči
          </Dugme>
        </div>
      </div>
    </div>
  );
};

export default Korpa;

