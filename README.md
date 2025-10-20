# 🍔 Aplikacija za Poručivanje Hrane

Veb aplikacija koja omogućava korisnicima da naruče hranu iz najbližih restorana. Projekat je razvijen korišćenjem Laravel backend-a i React frontend-a.

## 📋 Sadržaj

- [Funkcionalnosti](#funkcionalnosti)
- [Tehnologije](#tehnologije)
- [Instalacija](#instalacija)
- [API Dokumentacija](#api-dokumentacija)
- [Korisničke Uloge](#korisničke-uloge)
- [Autori](#autori)

## ✨ Funkcionalnosti

### Korisnički Deo
- ✅ Registracija i prijava korisnika
- ✅ Pregled kategorija restorana
- ✅ Pretraživanje restorana po nazivu
- ✅ Filter restorana po kategoriji
- ✅ Dodavanje jela u korpu
- ✅ Kreiranje porudžbine
- ✅ Pregled istorije porudžbina
- ✅ Provera vremenske prognoze za Beograd
- ✅ Prikaz mape

### Administratorski Deo
- ✅ Upravljanje kategorijama (CRUD)
- ✅ Upravljanje restoranima (CRUD)
- ✅ Upravljanje jelima (CRUD)
- ✅ Ažuriranje statusa porudžbina
- ✅ Eksport podataka u CSV format

## 🛠️ Tehnologije

### Backend
- **Laravel 12** - PHP framework
- **MySQL** - Relaciona baza podataka
- **Laravel Sanctum** - API autentifikacija
- **OpenWeatherMap API** - Vremenska prognoza

### Frontend
- **React 18** - JavaScript biblioteka
- **React Router** - Routing
- **Axios** - HTTP klijent
- **Leaflet** - Mape

## 📦 Instalacija

### Preduslovni
- PHP >= 8.2
- Composer
- MySQL/MariaDB
- Node.js >= 18
- npm

### Backend Setup

1. **Kloniranje repositorijuma**
```bash
git clone https://github.com/elab-development/internet-tehnologije-2024-projekat-apkporucivanjehrane_2020_0010_2020_0177.git
cd internet-tehnologije-2024-projekat-apkporucivanjehrane_2020_0010_2020_0177
```

2. **Instalacija PHP dependencija**
```bash
composer install
```

3. **Konfiguracija okruženja**
```bash
copy .env.example .env
php artisan key:generate
```

4. **Podešavanje baze podataka**
Kreirajte MySQL bazu i ažurirajte `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dostava_hrane
DB_USERNAME=root
DB_PASSWORD=
```

5. **Pokretanje migracija i seedera**
```bash
php artisan migrate:fresh --seed
```

6. **Pokretanje backend servera**
```bash
php artisan serve
```

Backend će biti dostupan na `http://localhost:8000`

### Frontend Setup

1. **Instalacija frontend paketa**
```bash
cd frontend
npm install
```

2. **Pokretanje frontend aplikacije**
```bash
npm start
```

Frontend će biti dostupan na `http://localhost:3000`

## 📚 API Dokumentacija

### Osnovni URL
```
http://localhost:8000/api
```

### Autentifikacija

#### Registracija
```http
POST /api/register
Content-Type: application/json

{
  "name": "Mateja Veličkov",
  "email": "mateja@example.com",
  "password": "mv12345",
  "password_confirmation": "mv12345"
}
```

#### Login
```http
POST /api/login
Content-Type: application/json

{
  "email": "mateja@example.com",
  "password": "mv12345"
}
```

**Response:**
```json
{
  "message": "Uspešno prijavljivanje",
  "user": {...},
  "token": "1|xxxxxxxxxxxx"
}
```

#### Logout
```http
POST /api/logout
Authorization: Bearer {token}
```

### Kategorije

#### Lista kategorija
```http
GET /api/kategorije
```

#### Pojedinačna kategorija
```http
GET /api/kategorije/{id}
```

### Restorani

#### Lista restorana (sa filterima)
```http
GET /api/restorani?pretraga=pizza&kategorija_id=2&per_page=10
```

**Query parametri:**
- `pretraga` - Pretraga po nazivu
- `kategorija_id` - Filter po kategoriji
- `aktivan` - Filter po aktivnosti (true/false)
- `sort_by` - Sortiranje (naziv, ocena, cena_dostave)
- `sort_order` - Redosled (asc/desc)
- `per_page` - Broj stavki po stranici

#### Detalji restorana
```http
GET /api/restorani/{id}
```

### Jela

#### Lista jela
```http
GET /api/jela?restoran_id=1&dostupno=true
```

### Porudžbine

#### Kreiranje porudžbine
```http
POST /api/porudzbine
Authorization: Bearer {token}
Content-Type: application/json

{
  "restoran_id": 1,
  "ime_kupca": "Mateja Veličkov",
  "email_kupca": "mateja@example.com",
  "telefon_kupca": "0641234567",
  "adresa_dostave": "Knez Mihailova 10, Beograd",
  "napomena": "Bez luka",
  "jela": [
    {
      "id": 1,
      "kolicina": 2
    },
    {
      "id": 2,
      "kolicina": 1
    }
  ]
}
```

#### Moje porudžbine
```http
GET /api/porudzbine
Authorization: Bearer {token}
```

### Vremenska Prognoza

#### Vreme za Beograd
```http
GET /api/vreme/beograd
```

#### Vreme za proizvoljni grad
```http
GET /api/vreme?grad=Novi Sad
```

### Eksport (AdminOnly)

#### Eksport porudžbina
```http
GET /api/eksport/porudzbine
Authorization: Bearer {admin-token}
```

#### Eksport restorana
```http
GET /api/eksport/restorani
Authorization: Bearer {admin-token}
```

## 👥 Korisničke Uloge

### Administrator
- Email: `admin@dostava.rs`
- Password: `password123`
- Prava: Puno upravljanje svim resursima

### Obični Korisnik
- Email: `mateja@example.com`
- Password: `mv12345`
- Prava: Pregled i kreiranje porudžbina

## 🧪 Testiranje

Koristi Postman za testiranje API endpointa:

1. Registruj se ili prijavi
2. Skopiraj token iz odgovora
3. Dodaj `Authorization: Bearer {token}` u header za protected rute
4. Testira endpointe

## 📝 Git Verzionisanje

Projekat prati best practices sa smislenim komitovima:
- Backend: 13+ komitova
- Frontend: 16+ komitova
- Ukupno: 30+ komitova

Svi članovi tima su kolaboratori sa komitovima.

## 👨‍💻 Autori

- **Student 1**: 2020_0010
- **Student 2**: 2020_0177

**Projekat**: Internet Tehnologije 2024
**Repozitorijum**: [GitHub](https://github.com/elab-development/internet-tehnologije-2024-projekat-apkporucivanjehrane_2020_0010_2020_0177)

## 📄 Licenca

Ovaj projekat je kreiran za obrazovne svrhe.
