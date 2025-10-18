import React, { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import api from '../utils/api';
import InputPolje from '../components/InputPolje';
import Dugme from '../components/Dugme';
import { ImMail, ImLock, ImEnter } from 'react-icons/im';

const Login = ({ onLogin }) => {
  const navigate = useNavigate();
  const [email, setEmail] = useState('');
  const [lozinka, setLozinka] = useState('');
  const [ucitavanje, setUcitavanje] = useState(false);
  const [greska, setGreska] = useState('');

  const handleSubmit = async (e) => {
    e.preventDefault();
    setGreska('');

    try {
      setUcitavanje(true);
      
      const response = await api.post('/auth/login', {
        email: email,
        password: lozinka
      });

      if (response.data.success) {
        onLogin(response.data.user, response.data.token);
        navigate('/');
      }
    } catch (error) {
      setGreska(error.response?.data?.message || 'Greška pri prijavi');
      setUcitavanje(false);
    }
  };

  return (
    <div className="auth-stranica">
      <div className="auth-container">
        <div className="auth-header">
          <h1>Prijava</h1>
          <p>Unesite svoje podatke za prijavu</p>
        </div>

        {greska && <div className="alert alert-greska">{greska}</div>}

        <form onSubmit={handleSubmit} className="auth-forma">
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
            placeholder="Unesite lozinku"
            value={lozinka}
            onChange={(e) => setLozinka(e.target.value)}
            ikonica={<ImLock />}
            required={true}
          />

          <Dugme
            tekst={ucitavanje ? 'Prijavljivanje...' : 'Prijavi se'}
            ikonica={<ImEnter />}
            tip="primary"
            disabled={ucitavanje}
            className="auth-dugme"
          />
        </form>

        <div className="auth-footer">
          <p>
            Nemate nalog? <Link to="/register">Registrujte se</Link>
          </p>
          
          <div className="test-kredencijali">
            <p><strong>Test nalozi:</strong></p>
            <p>Admin: admin@dostava.com / admin123</p>
            <p>Korisnik: petar@test.com / password123</p>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Login;

