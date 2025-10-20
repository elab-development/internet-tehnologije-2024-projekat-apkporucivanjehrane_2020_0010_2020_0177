import { useState, useEffect } from 'react';
import { vremeAPI } from '../utils/api';
import './VremenskaPrognoza.css';

const VremenskaPrognoza = () => {
  const [vreme, setVreme] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    ucitajVreme();
  }, []);

  const ucitajVreme = async () => {
    try {
      const response = await vremeAPI.getBeograd();
      setVreme(response.data);
    } catch (error) {
      console.error('Greška pri učitavanju vremena:', error);
    } finally {
      setLoading(false);
    }
  };

  if (loading) return <div className="vreme-loading">Učitavanje...</div>;
  if (!vreme) return null;

  return (
    <div className="vremenska-prognoza">
      <h3>🌤️ Vreme u Beogradu</h3>
      <div className="vreme-info">
        <div className="temperatura">{Math.round(vreme.temperatura)}°C</div>
        <div className="opis">{vreme.opis}</div>
        <div className="detalji">
          <span>💧 Vlažnost: {vreme.vlaznost}%</span>
          <span>💨 Vetar: {vreme.vetar} m/s</span>
        </div>
      </div>
    </div>
  );
};

export default VremenskaPrognoza;

