# 🍕 Aplikacija za Poručivanje Hrane

Full-stack web aplikacija za poručivanje hrane iz lokalnih restorana.

**Seminarski rad - Internet Tehnologije 2024/2025**

**Autori:** 2020_0010, 2020_0177

---

## 📖 Opis Projekta

Aplikacija omogućava korisnicima da pregledaju restorane, vide njihove menije i naručuju hranu online. 
Administratori mogu upravljati restoranima, proizvodima i pratiti porudžbine.

---

## 🏗️ Arhitektura

**Backend:**
- Laravel 12.x REST API
- MySQL baza podataka
- Laravel Sanctum autentifikacija

**Frontend:**
- React 19.2 SPA
- React Router za rutiranje
- Axios za komunikaciju sa API-jem

---

## 📋 Funkcion alnosti

- 🔐 Autentifikacija korisnika (registracija, prijava, odjava)
- 🍽️ Pregled restorana po kategorijama
- 🔍 Pretraživanje i filtriranje restorana
- 📱 Pregled menija restorana
- 🛒 Kreiranje porudžbina
- 📊 Statistika korisnika i sistema
- 📥 Eksport podataka u CSV format
- 🌤️ Vremenska prognoza za Beograd (javni API)
- 👨‍💼 Administratorski panel za upravljanje

## 🛠️ Tehnologije

- Laravel 12.x
- MySQL baza podataka
- Laravel Sanctum (autentifikacija)
- RESTful API arhitektura

## 📦 Instalacija

### Preduslovi

- PHP >= 8.2
- Composer
- MySQL
- XAMPP (preporučeno)

### Koraci za instalaciju

1. **Kloniranje repozitorijuma**
```bash
git clone https://github.com/elab-development/internet-tehnologije-2024-projekat-apkporucivanjehrane_2020_0010_2020_0177.git
cd internet-tehnologije-2024-projekat-apkporucivanjehrane_2020_0010_2020_0177
```

2. **Instalacija zavisnosti**
```bash
composer install
```

3. **Kreiranje .env fajla**
```bash
copy .env.example .env
```

4. **Generisanje aplikacionog ključa**
```bash
php artisan key:generate
```

5. **Podešavanje baze podataka**

Kreirajte bazu `dostava_hrane` u phpMyAdmin-u, zatim u `.env` fajlu podesite:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dostava_hrane
DB_USERNAME=root
DB_PASSWORD=
```

6. **Pokretanje migracija i seedera**
```bash
php artisan migrate:fresh --seed
```

7. **Pokretanje aplikacije**
```bash
php artisan serve
```

Aplikacija će biti dostupna na: `http://localhost:8000`

## 🔑 Test kredencijali

**Administrator:**
- Email: `admin@dostava.com`
- Lozinka: `admin123`

**Običan korisnik:**
- Email: `petar@test.com`
- Lozinka: `password123`

## 📡 API Endpoints

### Autentifikacija (Public)
- `POST /api/auth/register` - Registracija
- `POST /api/auth/login` - Prijava
- `POST /api/auth/logout` - Odjava (auth)
- `GET /api/auth/me` - Trenutni korisnik (auth)

### Restorani (Public)
- `GET /api/public/restorani` - Lista restorana (paginacija, pretraga, filtriranje)
- `GET /api/public/restorani/{id}` - Detalji restorana
- `GET /api/public/restorani/{id}/meni` - Meni restorana

### Kategorije (Public)
- `GET /api/public/kategorije` - Lista kategorija
- `GET /api/public/kategorije/{id}` - Detalji kategorije

### Proizvodi (Public)
- `GET /api/public/proizvodi` - Lista proizvoda (paginacija, filtriranje)
- `GET /api/public/proizvodi/{id}` - Detalji proizvoda

### Porudžbine (Auth Required)
- `GET /api/porudzbine` - Moje porudžbine
- `POST /api/porudzbine` - Kreiranje porudžbine
- `GET /api/porudzbine/{id}` - Detalji porudžbine
- `POST /api/porudzbine/{id}/otkazi` - Otkazivanje porudžbine

### Statistika (Auth Required)
- `GET /api/statistika/moje` - Moje statistike
- `GET /api/statistika/opsta` - Opšta statistika
- `GET /api/statistika/popularni-restorani` - Top restorani
- `GET /api/statistika/po-kategorijama` - Statistika po kategorijama

### Eksport (Auth Required)
- `GET /api/eksport/moje-porudzbine` - CSV eksport mojih porudžbina

### Admin (Auth + Admin Required)
- `POST /api/admin/restorani` - Dodavanje restorana
- `PUT /api/admin/restorani/{id}` - Izmena restorana
- `DELETE /api/admin/restorani/{id}` - Brisanje restorana
- `POST /api/admin/proizvodi` - Dodavanje proizvoda
- `PUT /api/admin/proizvodi/{id}` - Izmena proizvoda
- `DELETE /api/admin/proizvodi/{id}` - Brisanje proizvoda
- `GET /api/admin/eksport/sve-porudzbine` - CSV eksport svih porudžbina
- `GET /api/admin/eksport/restorani` - CSV eksport restorana

### Javni Web Servisi
- `GET /api/public/vremenska-prognoza` - Vremenska prognoza za Beograd

## 📝 Parametri za pretraživanje

### GET /api/public/restorani
- `search` - Pretraga po nazivu
- `category_id` - Filtriranje po kategoriji
- `max_delivery_price` - Maksimalna cena dostave
- `sort_by` - Sortiranje (name, delivery_price, delivery_time, created_at)
- `sort_order` - Redosled (asc, desc)
- `per_page` - Broj rezultata po stranici (default: 15)

### GET /api/public/proizvodi
- `search` - Pretraga po nazivu
- `restoran_id` - Filtriranje po restoranu
- `min_price` - Minimalna cena
- `max_price` - Maksimalna cena
- `per_page` - Broj rezultata po stranici

## 🗃️ Struktura baze podataka

- **users** - Korisnici sistema
- **categories** - Kategorije restorana
- **restorani** - Restorani
- **proizvod_na_menijus** - Proizvodi/jela u menijima
- **porudzbine** - Porudžbine korisnika
- **porudzbina_proizvod** - Pivot tabela (many-to-many)
- **personal_access_tokens** - Sanctum tokeni

## 👥 Autori

- Student 1: 2020_0010
- Student 2: 2020_0177

## 📄 Licenca

Edukacioni projekat - Elektrotehnički fakultet Beograd
