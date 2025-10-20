import './Kartica.css';

const Kartica = ({ 
  slika, 
  naslov, 
  opis, 
  cena, 
  ocena,
  onClick,
  children,
  className = '' 
}) => {
  return (
    <div className={`kartica ${className}`} onClick={onClick}>
      {slika && (
        <div className="kartica-slika">
          <img src={slika} alt={naslov} />
        </div>
      )}
      <div className="kartica-sadrzaj">
        <h3 className="kartica-naslov">{naslov}</h3>
        {opis && <p className="kartica-opis">{opis}</p>}
        
        <div className="kartica-footer">
          {cena !== undefined && (
            <div className="kartica-cena">
              <span className="cena-label">Dostava</span>
              <span className="cena-iznos">{cena} RSD</span>
            </div>
          )}
          {ocena && (
            <div className="kartica-ocena">
              <span className="ocena-zvezda">⭐</span>
              <span className="ocena-broj">{ocena}</span>
            </div>
          )}
        </div>
        
        {children && <div className="kartica-actions">{children}</div>}
      </div>
    </div>
  );
};

export default Kartica;

