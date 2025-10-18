import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import api from '../utils/api';
import InputPolje from '../components/InputPolje';
import Dugme from '../components/Dugme';
import { ImMail, ImLock, ImUser, ImUserPlus } from 'react-icons/im';

const Register = () => {
  const navigate = useNavigate();
  const [ime, setIme] = useState('');
  const [email, setEmail] = useState('');
  const [lozinka, setLozinka] = useState('');
  const [potvrdiLozinku, setPotvrdiLozinku] = useState('');
  const [ucitavanje, setUcitavanje] = useState(false);
  const [greska, setGreska] = useState('');
  const [uspeh, setUspeh] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    setGreska('');
    setUspeh('');

    if (lozinka !== potvrdiLozinku) {
      setGreska('Lozinke se ne poklapaju');
      return;
    }

    if (lozinka.length < 8) {
      setGreska('Lozinka mora imati najmanje 8 karaktera');
      return;
    }

    try {
      setUcitavanje(true);
      
      const response = await api.post('/auth/register', {
        name: ime,
        email: email,
        password: lozinka,
        password_confirmation: potvrdiLozinku
      });

      if (response.data.success) {
        setUspeh('Uspešna registracija! Preusmeravamo vas na prijavu...');
        setTimeout(() => {
          navigate('/login');
        }, 2000);
      }
    } catch (error) {
      const poruke = error.response?.data?.errors;
      if (poruke) {
        const svePoruke = Object.values(poruke).flat().join(', ');
        setGreska(svePoruke);
      } else {
        setGreska(error.response?.data?.message || 'Greška pri registraciji');
      }
      setUcitavanje(false);
    }
  };

  return (
    <div className="auth-stranica">
      <div className="auth-container">
        <div className="auth-header">
          <h1>Registracija</h1>
          <p>Kreirajte novi nalog</p>
        </div>

        {greska && <div className="alert alert-greska">{greska}</div>}
        {uspeh && <div className="alert alert-uspeh">{uspeh}</div>}

        <form onSubmit={handleSubmit} className="auth-forma">
          <InputPolje
            tip="text"
            label="Ime i prezime"
            placeholder="Petar Petrović"
            value={ime}
            onChange={(e) => setIme(e.target.value)}
            ikonica={<ImUser />}
            required={true}
          />

          <InputPolje
            tip="email"
            label="Email adresa"
            placeholder="primer@email.com"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            ikonica={<ImMail />}
            required={true}
          />

          <InputPolje
            tip="password"
            label="Lozinka"
            placeholder="Minimum 8 karaktera"
            value={lozinka}
            onChange={(e) => setLozinka(e.target.value)}
            ikonica={<ImLock />}
            required={true}
          />

          <InputPolje
            tip="password"
            label="Potvrdi lozinku"
            placeholder="Ponovite lozinku"
            value={potvrdiLozinku}
            onChange={(e) => setPotvrdiLozinku(e.target.value)}
            ikonica={<ImLock />}
            required={true}
          />

          <Dugme
            tekst={ucitavanje ? 'Registracija...' : 'Registruj se'}
            ikonica={<ImUserPlus />}
            tip="primary"
            disabled={ucitavanje}
            className="auth-dugme"
          />
        </form>

        <div className="auth-footer">
          <p>
            Već imate nalog? <Link to="/login">Prijavite se</Link>
          </p>
        </div>
      </div>
    </div>
  );
};

export default Register;

