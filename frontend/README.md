# 🍕 Dostava Hrane - React Frontend

React aplikacija za poručivanje hrane iz lokalnih restorana.

## 🚀 Pokretanje aplikacije

### Preduslovi

- Node.js (verzija 14+)
- npm
- Laravel backend mora biti pokrenut na `http://localhost:8000`

### Instalacija

1. **Instalacija zavisnosti:**
```bash
cd frontend
npm install
```

2. **Pokretanje development servera:**
```bash
npm start
```

Aplikacija će biti dostupna na: `http://localhost:3000`

## 📱 Funkcionalnosti

- ✅ Pregled restorana po kategorijama
- ✅ Pretraga restorana
- ✅ Filtriranje po kategoriji
- ✅ Paginacija
- ✅ Pregled menija restorana
- ✅ Shopping cart (korpa)
- ✅ Autentifikacija (login/register)
- ✅ Kreiranje porudžbina
- ✅ Pregled istorije porudžbina
- ✅ Statistika korisnika
- ✅ CSV eksport porudžbina
- ✅ Breadcrumbs navigacija
- ✅ Responsive dizajn

## 🧩 Struktura Projekta

```
src/
├── components/         # Reusable komponente
│   ├── NavBar.jsx     # Navigacija
│   ├── RestoranKartica.jsx
│   ├── ProizvodKartica.jsx
│   ├── Dugme.jsx
│   ├── InputPolje.jsx
│   ├── Breadcrumbs.jsx
│   ├── Loading.jsx
│   └── Paginacija.jsx
├── pages/             # Stranice
│   ├── Pocetna.jsx
│   ├── DetaljiRestorana.jsx
│   ├── Korpa.jsx
│   ├── Login.jsx
│   ├── Register.jsx
│   └── MojePorudzbine.jsx
├── hooks/             # Custom hooks
│   └── useApi.js
├── utils/             # Utility funkcije
│   └── api.js         # Axios konfiguracija
├── App.js             # Glavna komponenta
├── App.css            # Globalni stilovi
└── index.js           # Entry point
```

## 🎨 Tehnologije

- **React 19.2** - Frontend biblioteka
- **React Router** - Rutiranje
- **Axios** - HTTP klijent
- **React Icons** - Ikonice
- **CSS3** - Stilizovanje

## 🔑 Test Kredencijali

**Admin:**
- Email: `admin@dostava.com`
- Lozinka: `admin123`

**Običan korisnik:**
- Email: `petar@test.com`
- Lozinka: `password123`

## 📝 Napomene

- Backend API mora biti pokrenut pre pokretanja frontend-a
- LocalStorage se koristi za čuvanje tokena i korisnika
- CORS je podešen za `http://localhost:3000`
