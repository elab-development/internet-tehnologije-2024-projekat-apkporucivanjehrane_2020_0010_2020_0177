import { useState } from 'react';
import { useNavigate } from 'react-router-dom';
import { useKorpa } from '../context/KorpaContext';
import { useAuth } from '../context/AuthContext';
import { porudzbineAPI } from '../utils/api';
import InputPolje from '../components/InputPolje';
import Dugme from '../components/Dugme';
import './Narucivanje.css';

const Narucivanje = () => {
  const { stavke, restoran, ukupnaCena, isprazniKorpu } = useKorpa();
  const { user } = useAuth();
  const navigate = useNavigate();

  const [formData, setFormData] = useState({
    ime_kupca: user?.name || '',
    email_kupca: user?.email || '',
    telefon_kupca: '',
    adresa_dostave: '',
    napomena: '',
  });

  const [loading, setLoading] = useState(false);
  const [error, setError] = useState('');

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handlePotvrdi = async (e) => {
    e.preventDefault();
    setLoading(true);
    setError('');

    try {
      const porudzbinaData = {
        restoran_id: restoran.id,
        ime_kupca: formData.ime_kupca,
        email_kupca: formData.email_kupca,
        telefon_kupca: formData.telefon_kupca,
        adresa_dostave: formData.adresa_dostave,
        napomena: formData.napomena,
        jela: stavke.map(stavka => ({
          id: stavka.id,
          kolicina: stavka.kolicina
        }))
      };

      const response = await porudzbineAPI.create(porudzbinaData);
      
      if (response.data) {
        isprazniKorpu();
        alert('Porudžbina uspešno kreirana!');
        navigate('/porudzbine');
      }
    } catch (err) {
      console.error('Greška pri kreiranju porudžbine:', err);
      setError(err.response?.data?.message || 'Greška pri kreiranju porudžbine');
    } finally {
      setLoading(false);
    }
  };

  if (stavke.length === 0) {
    navigate('/korpa');
    return null;
  }

  return (
    <div className="narucivanje-container">
      <h1>Potvrda Porudžbine</h1>

      <div className="narucivanje-pregled">
        <h3>🍽️ {restoran?.naziv}</h3>
        
        <div className="narucivanje-stavke">
          {stavke.map((stavka) => (
            <div key={stavka.id} className="narucivanje-stavka">
              <span>{stavka.naziv} x{stavka.kolicina}</span>
              <span>{stavka.cena * stavka.kolicina} RSD</span>
            </div>
          ))}
        </div>

        <div className="narucivanje-ukupno">
          <strong>Ukupno: {ukupnaCena} RSD</strong>
        </div>
      </div>

      <form onSubmit={handlePotvrdi} className="narucivanje-forma">
        <h3>Podaci za dostavu</h3>

        {error && <div className="error-message">{error}</div>}

        <InputPolje
          label="Ime i prezime"
          type="text"
          name="ime_kupca"
          value={formData.ime_kupca}
          onChange={handleChange}
          required
        />

        <InputPolje
          label="Email"
          type="email"
          name="email_kupca"
          value={formData.email_kupca}
          onChange={handleChange}
          required
        />

        <InputPolje
          label="Telefon"
          type="tel"
          name="telefon_kupca"
          value={formData.telefon_kupca}
          onChange={handleChange}
          placeholder="064-123-4567"
          required
        />

        <InputPolje
          label="Adresa dostave"
          type="text"
          name="adresa_dostave"
          value={formData.adresa_dostave}
          onChange={handleChange}
          placeholder="Knez Mihailova 10, Beograd"
          required
        />

        <div className="form-group">
          <label>Napomena (opciono)</label>
          <textarea
            name="napomena"
            value={formData.napomena}
            onChange={handleChange}
            placeholder="Dodatne napomene za dostavu..."
            rows="3"
          />
        </div>

        <div className="forma-akcije">
          <Dugme type="button" tip="outline" onClick={() => navigate('/korpa')}>
            Nazad
          </Dugme>
          <Dugme type="submit" disabled={loading}>
            {loading ? 'Kreiranje...' : 'Potvrdi porudžbinu'}
          </Dugme>
        </div>
      </form>
    </div>
  );
};

export default Narucivanje;

