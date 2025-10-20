import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import 'leaflet/dist/leaflet.css';
import './Mapa.css';

const Mapa = ({ restorani = [] }) => {
  // Centar Beograda
  const center = [44.8176, 20.4633];

  return (
    <div className="mapa-container">
      <MapContainer 
        center={center} 
        zoom={13} 
        style={{ height: '400px', width: '100%', borderRadius: '10px' }}
      >
        <TileLayer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        />
        
        {restorani.map((restoran) => (
          <Marker 
            key={restoran.id} 
            position={[
              44.8176 + (Math.random() - 0.5) * 0.05,
              20.4633 + (Math.random() - 0.5) * 0.05
            ]}
          >
            <Popup>
              <strong>{restoran.naziv}</strong>
              <br />
              {restoran.adresa}
            </Popup>
          </Marker>
        ))}
      </MapContainer>
    </div>
  );
};

export default Mapa;

