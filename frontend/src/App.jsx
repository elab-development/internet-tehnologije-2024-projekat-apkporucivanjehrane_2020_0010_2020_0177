import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider, useAuth } from './context/AuthContext';
import { KorpaProvider } from './context/KorpaContext';
import NavBar from './components/NavBar';
import Pocetna from './pages/Pocetna';
import Login from './pages/Login';
import Register from './pages/Register';
import DetaljiRestorana from './pages/DetaljiRestorana';
import Korpa from './pages/Korpa';
import Narucivanje from './pages/Narucivanje';
import MojePorudzbine from './pages/MojePorudzbine';
import './App.css';

// Private Route komponenta
const PrivateRoute = ({ children }) => {
  const token = localStorage.getItem('token');
  return token ? children : <Navigate to="/login" />;
};

function App() {
  return (
    <AuthProvider>
      <KorpaProvider>
        <Router>
          <div className="app">
            <NavBar />
            
            <main className="main-content">
              <Routes>
                <Route path="/" element={<Pocetna />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/restoran/:id" element={<DetaljiRestorana />} />
                <Route path="/korpa" element={<Korpa />} />
                <Route 
                  path="/narucivanje" 
                  element={
                    <PrivateRoute>
                      <Narucivanje />
                    </PrivateRoute>
                  } 
                />
                <Route 
                  path="/porudzbine" 
                  element={
                    <PrivateRoute>
                      <MojePorudzbine />
                    </PrivateRoute>
                  } 
                />
                <Route path="*" element={<Navigate to="/" />} />
              </Routes>
            </main>

            <footer className="footer">
              <p>&copy; 2025 Dostava Hrane. Sva prava zadržana.</p>
            </footer>
          </div>
        </Router>
      </KorpaProvider>
    </AuthProvider>
  );
}

export default App;
