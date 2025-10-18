import React, { useState } from 'react';
import { BrowserRouter, Routes, Route } from 'react-router-dom';
import './App.css';

// Komponente
import NavBar from './components/NavBar';

// Stranice
import Pocetna from './pages/Pocetna';
import DetaljiRestorana from './pages/DetaljiRestorana';
import Korpa from './pages/Korpa';
import Login from './pages/Login';
import Register from './pages/Register';
import MojePorudzbine from './pages/MojePorudzbine';

function App() {
  const [korpa, setKorpa] = useState([]);
  const [token, setToken] = useState(localStorage.getItem('token') || null);
  const [user, setUser] = useState(JSON.parse(localStorage.getItem('user')) || null);

  // Dodavanje proizvoda u korpu
  const dodajUKorpu = (proizvod) => {
    const postojiUKorpi = korpa.find(item => item.id === proizvod.id);
    
    if (postojiUKorpi) {
      setKorpa(korpa.map(item => 
        item.id === proizvod.id 
          ? { ...item, kolicina: item.kolicina + 1 }
          : item
      ));
    } else {
      setKorpa([...korpa, { ...proizvod, kolicina: 1 }]);
    }
  };

  // Uklanjanje proizvoda iz korpe
  const ukloniIzKorpe = (proizvodId) => {
    const proizvod = korpa.find(item => item.id === proizvodId);
    
    if (proizvod.kolicina === 1) {
      setKorpa(korpa.filter(item => item.id !== proizvodId));
    } else {
      setKorpa(korpa.map(item =>
        item.id === proizvodId
          ? { ...item, kolicina: item.kolicina - 1 }
          : item
      ));
    }
  };

  // Praznjenje korpe
  const isprazniKorpu = () => {
    setKorpa([]);
  };

  // Ukupan broj proizvoda u korpi
  const ukupnoUKorpi = korpa.reduce((total, item) => total + item.kolicina, 0);

  // Ukupna cena
  const ukupnaCena = korpa.reduce((total, item) => total + (item.price * item.kolicina), 0);

  // Login funkcija
  const handleLogin = (userData, authToken) => {
    setUser(userData);
    setToken(authToken);
    localStorage.setItem('user', JSON.stringify(userData));
    localStorage.setItem('token', authToken);
  };

  // Logout funkcija
  const handleLogout = () => {
    setUser(null);
    setToken(null);
    localStorage.removeItem('user');
    localStorage.removeItem('token');
    setKorpa([]);
  };

  return (
    <BrowserRouter>
      <div className="App">
        <NavBar 
          brojUKorpi={ukupnoUKorpi} 
          user={user} 
          onLogout={handleLogout}
        />
        
        <Routes>
          <Route 
            path="/" 
            element={<Pocetna dodajUKorpu={dodajUKorpu} />} 
          />
          <Route 
            path="/restoran/:id" 
            element={<DetaljiRestorana dodajUKorpu={dodajUKorpu} />} 
          />
          <Route 
            path="/korpa" 
            element={
              <Korpa 
                korpa={korpa}
                dodajUKorpu={dodajUKorpu}
                ukloniIzKorpe={ukloniIzKorpe}
                isprazniKorpu={isprazniKorpu}
                ukupnaCena={ukupnaCena}
                token={token}
              />
            } 
          />
          <Route 
            path="/login" 
            element={<Login onLogin={handleLogin} />} 
          />
          <Route 
            path="/register" 
            element={<Register />} 
          />
          <Route 
            path="/porudzbine" 
            element={<MojePorudzbine token={token} />} 
          />
        </Routes>
      </div>
    </BrowserRouter>
  );
}

export default App;
