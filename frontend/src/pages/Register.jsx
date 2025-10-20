import { useState } from 'react';
import { useNavigate, Link } from 'react-router-dom';
import { useAuth } from '../context/AuthContext';
import InputPolje from '../components/InputPolje';
import Dugme from '../components/Dugme';
import './Auth.css';

const Register = () => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
  });
  const [error, setError] = useState('');
  const { register } = useAuth();
  const navigate = useNavigate();

  const handleChange = (e) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError('');

    if (formData.password !== formData.password_confirmation) {
      setError('Lozinke se ne poklapaju');
      return;
    }

    const result = await register(formData);
    
    if (result.success) {
      navigate('/');
    } else {
      setError(result.error);
    }
  };

  return (
    <div className="auth-container auth-container-register">
      <div className="auth-card">
        <h2 className="auth-title">Registracija</h2>
        
        {error && <div className="alert alert-error">{error}</div>}
        
        <form onSubmit={handleSubmit}>
          <InputPolje
            label="Ime i prezime"
            type="text"
            name="name"
            value={formData.name}
            onChange={handleChange}
            placeholder="Mateja Veličkov"
            required
          />

          <InputPolje
            label="Email"
            type="email"
            name="email"
            value={formData.email}
            onChange={handleChange}
            placeholder="vas@email.com"
            required
          />
          
          <InputPolje
            label="Lozinka"
            type="password"
            name="password"
            value={formData.password}
            onChange={handleChange}
            placeholder="••••••••"
            required
          />

          <InputPolje
            label="Potvrdite lozinku"
            type="password"
            name="password_confirmation"
            value={formData.password_confirmation}
            onChange={handleChange}
            placeholder="••••••••"
            required
          />

          <Dugme tip="primary" className="auth-button">
            Registruj se
          </Dugme>
        </form>

        <p className="auth-link">
          Već imate nalog? <Link to="/login">Prijavite se</Link>
        </p>
      </div>
    </div>
  );
};

export default Register;

