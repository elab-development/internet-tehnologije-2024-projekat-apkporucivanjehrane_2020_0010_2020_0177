import { BrowserRouter as Router, Routes, Route, Navigate } from 'react-router-dom';
import { AuthProvider } from './context/AuthContext';
import { KorpaProvider } from './context/KorpaContext';
import NavBar from './components/NavBar';
import Pocetna from './pages/Pocetna';
import Login from './pages/Login';
import Register from './pages/Register';
import DetaljiRestorana from './pages/DetaljiRestorana';
import Korpa from './pages/Korpa';
import MojePorudzbine from './pages/MojePorudzbine';
import VremenskaPrognoza from './components/VremenskaPrognoza';
import Mapa from './components/Mapa';
import './App.css';

function App() {
  return (
    <AuthProvider>
      <KorpaProvider>
        <Router>
          <div className="app">
            <NavBar />
            
            <main className="main-content">
              <Routes>
                <Route path="/" element={<PocetnaWrapper />} />
                <Route path="/login" element={<Login />} />
                <Route path="/register" element={<Register />} />
                <Route path="/restoran/:id" element={<DetaljiRestorana />} />
                <Route path="/korpa" element={<Korpa />} />
                <Route path="/porudzbine" element={<PrivateRoute><MojePorudzbine /></PrivateRoute>} />
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

const PocetnaWrapper = () => {
  return (
    <>
      <VremenskaPrognoza />
      <Pocetna />
      <Mapa restorani={[]} />
    </>
  );
};

const PrivateRoute = ({ children }) => {
  const token = localStorage.getItem('token');
  return token ? children : <Navigate to="/login" />;
};

export default App;
