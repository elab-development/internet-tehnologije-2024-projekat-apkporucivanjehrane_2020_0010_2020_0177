import React, { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import Breadcrumbs from '../components/Breadcrumbs';
import Dugme from '../components/Dugme';
import InputPolje from '../components/InputPolje';
import { ImPlus, ImMinus, ImBin, ImCheckmark } from 'react-icons/im';
import api from '../utils/api';

const Korpa = ({ korpa, dodajUKorpu, ukloniIzKorpe, isprazniKorpu, ukupnaCena, token }) => {
  const navigate = useNavigate();
  const [adresa, setAdresa] = useState('');
  const [napomena, setNapomena] = useState('');
  const [narucivanje, setNarucivanje] = useState(false);

  const handleNaruci = async () => {
    if (!token) {
      alert('Morate biti prijavljeni da biste naručili');
      navigate('/login');
      return;
    }

    if (!adresa.trim()) {
      alert('Molimo unesite adresu dostave');
      return;
    }

    if (korpa.length === 0) {
      alert('Korpa je prazna');
      return;
    }

    // Provera da li svi proizvodi pripadaju istom restoranu
    const restoranId = korpa[0].restoran_id;
    const razlicitiRestorani = korpa.some(item => item.restoran_id !== restoranId);
    
    if (razlicitiRestorani) {
      alert('Možete naručiti samo iz jednog restorana odjednom');
      return;
    }

    try {
      setNarucivanje(true);
      
      const proizvodi = korpa.map(item => ({
        id: item.id,
        quantity: item.kolicina
      }));

      const response = await api.post('/porudzbine', {
        restoran_id: restoranId,
        delivery_address: adresa,
        note: napomena,
        proizvodi: proizvodi
      });

      if (response.data.success) {
        alert('Porudžbina uspešno kreirana! Broj porudžbine: ' + response.data.data.order_number);
        isprazniKorpu();
        navigate('/porudzbine');
      }
    } catch (error) {
      console.error('Greška pri kreiranju porudžbine:', error);
      alert(error.response?.data?.message || 'Greška pri kreiranju porudžbine');
    } finally {
      setNarucivanje(false);
    }
  };

  if (korpa.length === 0) {
    return (
      <div className="korpa-stranica">
        <Breadcrumbs />
        <div className="prazna-korpa">
          <h2>Vaša korpa je prazna</h2>
          <p>Dodajte proizvode iz restorana da biste naručili</p>
          <Dugme 
            tekst="Nazad na početnu"
            onClick={() => navigate('/')}
            tip="primary"
          />
        </div>
      </div>
    );
  }

  return (
    <div className="korpa-stranica">
      <Breadcrumbs />
      
      <h1>Vaša Korpa</h1>

      <div className="korpa-sadrzaj">
        <div className="korpa-proizvodi">
          {korpa.map(item => (
            <div key={item.id} className="korpa-item">
              <img 
                src={item.image || 'https://via.placeholder.com/100'}
                alt={item.name}
                className="korpa-item-slika"
              />
              
              <div className="korpa-item-info">
                <h4>{item.name}</h4>
                <p className="korpa-item-cena">{item.price} RSD</p>
              </div>

              <div className="korpa-item-kolicina">
                <button 
                  className="kolicina-btn"
                  onClick={() => ukloniIzKorpe(item.id)}
                >
                  <ImMinus />
                </button>
                <span className="kolicina-broj">{item.kolicina}</span>
                <button 
                  className="kolicina-btn"
                  onClick={() => dodajUKorpu(item)}
                >
                  <ImPlus />
                </button>
              </div>

              <div className="korpa-item-ukupno">
                {item.price * item.kolicina} RSD
              </div>

              <button 
                className="korpa-item-obrisi"
                onClick={() => {
                  // Ukloni sve iz korpe
                  for (let i = 0; i < item.kolicina; i++) {
                    ukloniIzKorpe(item.id);
                  }
                }}
              >
                <ImBin />
              </button>
            </div>
          ))}
        </div>

        <div className="korpa-rezime">
          <h3>Rezime Porudžbine</h3>
          
          <div className="rezime-red">
            <span>Ukupno proizvoda:</span>
            <span>{korpa.reduce((total, item) => total + item.kolicina, 0)}</span>
          </div>
          
          <div className="rezime-red">
            <span>Cena:</span>
            <span>{ukupnaCena.toFixed(2)} RSD</span>
          </div>

          <div className="rezime-red ukupno">
            <span>UKUPNO:</span>
            <span>{ukupnaCena.toFixed(2)} RSD</span>
          </div>

          <div className="forma-dostava">
            <InputPolje
              tip="text"
              label="Adresa dostave"
              placeholder="Unesite adresu dostave"
              value={adresa}
              onChange={(e) => setAdresa(e.target.value)}
              required={true}
            />

            <InputPolje
              tip="text"
              label="Napomena (opciono)"
              placeholder="Dodatne napomene za restoran"
              value={napomena}
              onChange={(e) => setNapomena(e.target.value)}
            />

            <Dugme
              tekst={narucivanje ? 'Naručivanje...' : 'Naruči'}
              ikonica={<ImCheckmark />}
              onClick={handleNaruci}
              tip="success"
              disabled={narucivanje}
              className="dugme-narucivanje"
            />

            <Dugme
              tekst="Isprazni korpu"
              ikonica={<ImBin />}
              onClick={isprazniKorpu}
              tip="danger"
              className="dugme-isprazni"
            />
          </div>
        </div>
      </div>
    </div>
  );
};

export default Korpa;

