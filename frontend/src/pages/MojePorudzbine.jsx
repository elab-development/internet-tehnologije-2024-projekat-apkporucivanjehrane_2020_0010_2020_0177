import React, { useState, useEffect } from 'react';
import { useNavigate } from 'react-router-dom';
import api from '../utils/api';
import Breadcrumbs from '../components/Breadcrumbs';
import Loading from '../components/Loading';
import Dugme from '../components/Dugme';
import { ImDownload } from 'react-icons/im';

const MojePorudzbine = ({ token }) => {
  const navigate = useNavigate();
  const [porudzbine, setPorudzbine] = useState([]);
  const [statistika, setStatistika] = useState(null);
  const [ucitavanje, setUcitavanje] = useState(true);

  useEffect(() => {
    if (!token) {
      navigate('/login');
      return;
    }
    ucitajPorudzbine();
    ucitajStatistiku();
  }, [token]);

  const ucitajPorudzbine = async () => {
    try {
      const response = await api.get('/porudzbine');
      if (response.data.success) {
        setPorudzbine(response.data.data);
      }
      setUcitavanje(false);
    } catch (error) {
      console.error('Greška pri učitavanju porudžbina:', error);
      setUcitavanje(false);
    }
  };

  const ucitajStatistiku = async () => {
    try {
      const response = await api.get('/statistika/moje');
      if (response.data.success) {
        setStatistika(response.data.data);
      }
    } catch (error) {
      console.error('Greška pri učitavanju statistike:', error);
    }
  };

  const handleEksport = async () => {
    try {
      const response = await api.get('/eksport/moje-porudzbine', {
        responseType: 'blob'
      });
      
      const url = window.URL.createObjectURL(new Blob([response.data]));
      const link = document.createElement('a');
      link.href = url;
      link.setAttribute('download', `moje_porudzbine_${new Date().toISOString().split('T')[0]}.csv`);
      document.body.appendChild(link);
      link.click();
      link.remove();
    } catch (error) {
      console.error('Greška pri eksportu:', error);
      alert('Greška pri preuzimanju CSV fajla');
    }
  };

  const getStatusClass = (status) => {
    const statusMap = {
      'pending': 'status-pending',
      'confirmed': 'status-confirmed',
      'preparing': 'status-preparing',
      'on_delivery': 'status-delivery',
      'delivered': 'status-delivered',
      'cancelled': 'status-cancelled'
    };
    return statusMap[status] || '';
  };

  const getStatusText = (status) => {
    const statusMap = {
      'pending': 'Na čekanju',
      'confirmed': 'Potvrđena',
      'preparing': 'Priprema se',
      'on_delivery': 'U dostavi',
      'delivered': 'Dostavljena',
      'cancelled': 'Otkazana'
    };
    return statusMap[status] || status;
  };

  if (ucitavanje) {
    return <Loading poruka="Učitavanje porudžbina..." />;
  }

  return (
    <div className="porudzbine-stranica">
      <Breadcrumbs />
      
      <div className="porudzbine-header">
        <h1>Moje Porudžbine</h1>
        <Dugme
          tekst="Preuzmi CSV"
          ikonica={<ImDownload />}
          onClick={handleEksport}
          tip="secondary"
        />
      </div>

      {/* Statistika */}
      {statistika && (
        <div className="statistika-grid">
          <div className="statistika-kartica">
            <h3>{statistika.ukupno_porudzbina}</h3>
            <p>Ukupno porudžbina</p>
          </div>
          <div className="statistika-kartica">
            <h3>{statistika.zavrsene_porudzbine}</h3>
            <p>Završene</p>
          </div>
          <div className="statistika-kartica">
            <h3>{statistika.ukupno_potroseno?.toFixed(2)} RSD</h3>
            <p>Ukupno potrošeno</p>
          </div>
          {statistika.omiljeni_restoran && (
            <div className="statistika-kartica">
              <h3>{statistika.omiljeni_restoran.naziv}</h3>
              <p>Omiljeni restoran</p>
            </div>
          )}
        </div>
      )}

      {/* Lista porudžbina */}
      {porudzbine.length === 0 ? (
        <div className="nema-rezultata">
          <h3>Nemate još porudžbina</h3>
          <p>Poručite hranu iz omiljenih restorana</p>
          <Dugme
            tekst="Pregled restorana"
            onClick={() => navigate('/')}
            tip="primary"
          />
        </div>
      ) : (
        <div className="porudzbine-lista">
          {porudzbine.map(porudzbina => (
            <div key={porudzbina.id} className="porudzbina-kartica">
              <div className="porudzbina-header">
                <div>
                  <h3>#{porudzbina.order_number}</h3>
                  <p className="porudzbina-restoran">{porudzbina.restoran?.name}</p>
                </div>
                <span className={`porudzbina-status ${getStatusClass(porudzbina.status)}`}>
                  {getStatusText(porudzbina.status)}
                </span>
              </div>

              <div className="porudzbina-body">
                <p><strong>Adresa:</strong> {porudzbina.delivery_address}</p>
                {porudzbina.note && <p><strong>Napomena:</strong> {porudzbina.note}</p>}
                <p><strong>Datum:</strong> {new Date(porudzbina.created_at).toLocaleString('sr-RS')}</p>
              </div>

              <div className="porudzbina-footer">
                <span className="porudzbina-cena">
                  Ukupno: <strong>{porudzbina.total_price} RSD</strong>
                </span>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
};

export default MojePorudzbine;

