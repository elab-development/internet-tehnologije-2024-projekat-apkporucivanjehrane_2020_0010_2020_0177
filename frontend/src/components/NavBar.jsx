import { Link, useNavigate } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import Dugme from './Dugme';
import './NavBar.css';

const NavBar = () => {
  const { user, logout } = useAuth();
  const navigate = useNavigate();

  const handleLogout = () => {
    logout();
    navigate('/login');
  };

  return (
    <nav className="navbar">
      <div className="navbar-container">
        <Link to="/" className="navbar-logo">
          🍔 Dostava Hrane
        </Link>
        
        <div className="navbar-menu">
          <Link to="/" className="navbar-link">Početna</Link>
          {user && (
            <>
              <Link to="/porudzbine" className="navbar-link">Moje Porudžbine</Link>
              <Link to="/korpa" className="navbar-link">
                Korpa 🛒
              </Link>
            </>
          )}
        </div>

        <div className="navbar-actions">
          {user ? (
            <>
              <span className="navbar-user">Zdravo, {user.name}</span>
              <Dugme tip="outline" onClick={handleLogout}>
                Odjavi se
              </Dugme>
            </>
          ) : (
            <>
              <Link to="/login">
                <Dugme tip="secondary">Prijavi se</Dugme>
              </Link>
              <Link to="/register">
                <Dugme>Registruj se</Dugme>
              </Link>
            </>
          )}
        </div>
      </div>
    </nav>
  );
};

export default NavBar;

