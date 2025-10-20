import { createContext, useState, useContext, useEffect } from 'react';

const KorpaContext = createContext();

export const useKorpa = () => {
  const context = useContext(KorpaContext);
  if (!context) {
    throw new Error('useKorpa mora biti korišćen unutar KorpaProvider-a');
  }
  return context;
};

export const KorpaProvider = ({ children }) => {
  const [stavke, setStavke] = useState([]);
  const [restoran, setRestoran] = useState(null);

  // Učitavanje korpe iz localStorage pri inicijalnom renderovanju
  useEffect(() => {
    const savedKorpa = localStorage.getItem('korpa');
    const savedRestoran = localStorage.getItem('korpa_restoran');
    
    if (savedKorpa) {
      setStavke(JSON.parse(savedKorpa));
    }
    if (savedRestoran) {
      setRestoran(JSON.parse(savedRestoran));
    }
  }, []);

  // Čuvanje korpe u localStorage kada se promeni
  useEffect(() => {
    localStorage.setItem('korpa', JSON.stringify(stavke));
    if (restoran) {
      localStorage.setItem('korpa_restoran', JSON.stringify(restoran));
    }
  }, [stavke, restoran]);

  const dodajUKorpu = (jelo, restoranInfo) => {
    // Provera da li je jelo iz istog restorana
    if (restoran && restoran.id !== restoranInfo.id) {
      if (!window.confirm('Korpa već sadrži jela iz drugog restorana. Želite li da ispraznite korpu?')) {
        return;
      }
      setStavke([]);
    }

    setRestoran(restoranInfo);

    setStavke(prevStavke => {
      const postojeca = prevStavke.find(s => s.id === jelo.id);
      
      if (postojeca) {
        return prevStavke.map(s =>
          s.id === jelo.id ? { ...s, kolicina: s.kolicina + 1 } : s
        );
      }
      
      return [...prevStavke, { ...jelo, kolicina: 1 }];
    });
  };

  const ukloniIzKorpe = (jeloId) => {
    setStavke(prevStavke => {
      const novaKorpa = prevStavke.filter(s => s.id !== jeloId);
      
      if (novaKorpa.length === 0) {
        setRestoran(null);
        localStorage.removeItem('korpa_restoran');
      }
      
      return novaKorpa;
    });
  };

  const promeniKolicinu = (jeloId, novaKolicina) => {
    if (novaKolicina <= 0) {
      ukloniIzKorpe(jeloId);
      return;
    }

    setStavke(prevStavke =>
      prevStavke.map(s =>
        s.id === jeloId ? { ...s, kolicina: novaKolicina } : s
      )
    );
  };

  const isprazniKorpu = () => {
    setStavke([]);
    setRestoran(null);
    localStorage.removeItem('korpa');
    localStorage.removeItem('korpa_restoran');
  };

  const ukupnaCena = stavke.reduce((total, stavka) => total + (stavka.cena * stavka.kolicina), 0);
  const brojStavki = stavke.reduce((total, stavka) => total + stavka.kolicina, 0);

  const value = {
    stavke,
    restoran,
    dodajUKorpu,
    ukloniIzKorpe,
    promeniKolicinu,
    isprazniKorpu,
    ukupnaCena,
    brojStavki,
  };

  return <KorpaContext.Provider value={value}>{children}</KorpaContext.Provider>;
};

