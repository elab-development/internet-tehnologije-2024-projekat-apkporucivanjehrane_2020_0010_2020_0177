import React from 'react';
import { Link } from 'react-router-dom';
import { ImCart, ImUser, ImExit } from 'react-icons/im';

const NavBar = ({ brojUKorpi, user, onLogout }) => {
  return (
    <nav className="navbar">
      <div className="navbar-container">
        <Link to="/" className="navbar-logo">
          🍕 Dostava Hrane
        </Link>
        
        <div className="navbar-menu">
          {user ? (
            <>
              <Link to="/porudzbine" className="navbar-item">
                <ImUser /> {user.name}
              </Link>
              <Link to="/korpa" className="navbar-item cart-link">
                <ImCart />
                {brojUKorpi > 0 && (
                  <span className="cart-badge">{brojUKorpi}</span>
                )}
              </Link>
              <button onClick={onLogout} className="navbar-item logout-btn">
                <ImExit /> Odjava
              </button>
            </>
          ) : (
            <>
              <Link to="/login" className="navbar-item">
                Prijava
              </Link>
              <Link to="/register" className="navbar-item">
                Registracija
              </Link>
              <Link to="/korpa" className="navbar-item cart-link">
                <ImCart />
                {brojUKorpi > 0 && (
                  <span className="cart-badge">{brojUKorpi}</span>
                )}
              </Link>
            </>
          )}
        </div>
      </div>
    </nav>
  );
};

export default NavBar;

