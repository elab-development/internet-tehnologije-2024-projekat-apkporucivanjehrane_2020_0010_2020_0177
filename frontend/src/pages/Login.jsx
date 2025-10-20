import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import InputPolje from '../components/InputPolje';
import Dugme from '../components/Dugme';
import './Auth.css';

const Login = () => {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const { login } = useAuth();
  const navigate = useNavigate();

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');

    const result = await login(email, password);
    
    if (result.success) {
      navigate('/');
    } else {
      setError(result.error);
    }
  };

  return (
    <div className="auth-container auth-container-login">
      <div className="auth-card">
        <h2 className="auth-title">Prijava</h2>
        
        {error && <div className="alert alert-error">{error}</div>}
        
        <form onSubmit={handleSubmit}>
          <InputPolje
            label="Email"
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            placeholder="vas@email.com"
            required
          />
          
          <InputPolje
            label="Lozinka"
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            placeholder="••••••••"
            required
          />

          <Dugme tip="primary" className="auth-button">
            Prijavi se
          </Dugme>
        </form>

        <p className="auth-link">
          Nemate nalog? <Link to="/register">Registrujte se</Link>
        </p>

        <div className="demo-credentials">
          <p><strong>Demo nalozi:</strong></p>
          <p>Admin: admin@dostava.rs / password123</p>
          <p>Korisnik: mateja@example.com / mv12345</p>
        </div>
      </div>
    </div>
  );
};

export default Login;

