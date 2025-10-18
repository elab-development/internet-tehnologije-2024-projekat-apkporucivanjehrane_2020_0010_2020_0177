import React from 'react';
import { ImArrowLeft, ImArrowRight } from 'react-icons/im';

const Paginacija = ({ currentPage, lastPage, onPageChange }) => {
  const stranice = [];
  
  // Prikazujemo maksimalno 5 stranica oko trenutne
  let pocetna = Math.max(1, currentPage - 2);
  let krajnja = Math.min(lastPage, currentPage + 2);

  for (let i = pocetna; i <= krajnja; i++) {
    stranice.push(i);
  }

  return (
    <div className="paginacija">
      <button 
        className="paginacija-dugme"
        onClick={() => onPageChange(currentPage - 1)}
        disabled={currentPage === 1}
      >
        <ImArrowLeft /> Prethodna
      </button>

      {pocetna > 1 && (
        <>
          <button 
            className="paginacija-broj"
            onClick={() => onPageChange(1)}
          >
            1
          </button>
          {pocetna > 2 && <span className="paginacija-tacke">...</span>}
        </>
      )}

      {stranice.map(broj => (
        <button
          key={broj}
          className={`paginacija-broj ${currentPage === broj ? 'active' : ''}`}
          onClick={() => onPageChange(broj)}
        >
          {broj}
        </button>
      ))}

      {krajnja < lastPage && (
        <>
          {krajnja < lastPage - 1 && <span className="paginacija-tacke">...</span>}
          <button 
            className="paginacija-broj"
            onClick={() => onPageChange(lastPage)}
          >
            {lastPage}
          </button>
        </>
      )}

      <button 
        className="paginacija-dugme"
        onClick={() => onPageChange(currentPage + 1)}
        disabled={currentPage === lastPage}
      >
        Sledeća <ImArrowRight />
      </button>
    </div>
  );
};

export default Paginacija;

