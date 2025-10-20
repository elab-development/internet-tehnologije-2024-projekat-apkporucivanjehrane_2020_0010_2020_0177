# 🚀 UPUTSTVO ZA POKRETANJE PROJEKTA

## Preduslovni zahtevi
- ✅ XAMPP instaliran (Apache i MySQL)
- ✅ PHP >= 8.2
- ✅ Composer
- ✅ Node.js >= 18

---

## 🔧 KORAK 1: Pokretanje XAMPP-a

1. Otvori **XAMPP Control Panel**
2. Pokreni **Apache** modul (klikni Start)
3. Pokreni **MySQL** modul (klikni Start)

---

## 📦 KORAK 2: Backend Setup

### 2.1 Instalacija Dependencies

Otvori terminal u root folderu projekta:

```bash
cd aplikacija
composer install
```

### 2.2 Podešavanje .env fajla

Ako `.env` ne postoji, kreiraj ga:

```bash
copy .env.example .env
```

Zatim generiši app key:

```bash
php artisan key:generate
```

### 2.3 Kreiranje Baze Podataka

**Opcija A - phpMyAdmin (PREPORUČENO):**
1. Otvori `http://localhost/phpmyadmin`
2. Klikni na "New" (Nova baza)
3. Ime baze: `dostava_hrane`
4. Collation: `utf8mb4_unicode_ci`
5. Klikni "Create"

**Opcija B - MySQL Command Line:**
```bash
mysql -u root -e "CREATE DATABASE dostava_hrane"
```

### 2.4 Provera .env konfiguracije

Otvori `.env` fajl i proveri:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dostava_hrane
DB_USERNAME=root
DB_PASSWORD=
```

### 2.5 Pokretanje Migracija i Seedera

```bash
php artisan migrate:fresh --seed
```

Ova komanda će:
- ✅ Kreirati sve tabele u bazi
- ✅ Popuniti bazu sa test podacima
- ✅ Kreirati 2 korisnika (admin i običan)
- ✅ Dodati 4 restorana sa jelima

### 2.6 Pokretanje Backend Servera

```bash
php artisan serve
```

✅ **Backend je spreman na:** `http://localhost:8000`

**NAPOMENA:** Ostavi ovaj terminal otvoren dok koristiš aplikaciju!

---

## ⚛️ KORAK 3: Frontend Setup

**Otvori NOVI terminal** (prvi terminal mora ostati otvoren za backend):

### 3.1 Instalacija Node Paketa

```bash
cd aplikacija/frontend
npm install
```

Ovo može trajati 1-2 minuta.

### 3.2 Pokretanje Frontend Servera

```bash
npm run dev
```

✅ **Frontend je spreman na:** `http://localhost:5173`

**NAPOMENA:** Ostavi i ovaj terminal otvoren!

---

## 🎯 TESTIRANJE APLIKACIJE

### Otvori u browseru:

```
http://localhost:5173
```

### Test Nalozi:

**Administrator:**
- Email: `admin@dostava.rs`
- Password: `password123`
- Prava: Upravljanje svim resursima

**Običan Korisnik:**
- Email: `marko@example.com`
- Password: `password123`
- Prava: Pregled i kreiranje porudžbina

---

## ✨ Funkcionalnosti koje možeš testirati:

1. **Registracija** - Kreira novi nalog
2. **Prijava** - Login sa test nalogom
3. **Pregled restorana** - Lista svih dostupnih restorana
4. **Pretraga** - Pretraži restorane po nazivu
5. **Detalji restorana** - Klikni na restoran da vidiš meni
6. **Dodavanje u korpu** - Dodaj jela u korpu
7. **Korpa** - Pregledaj i upravljaj korpom
8. **Kreiranje porudžbine** - Naruči hranu
9. **Moje porudžbine** - Vidi istoriju porudžbina
10. **Vremenska prognoza** - Prikazana na početnoj
11. **Mapa** - Lokacije restorana (placeholder)

---

## 🐛 TROUBLESHOOTING

### Problem: "Could not open input file: artisan"
**Rešenje:** Proveri da si u `aplikacija` folderu:
```bash
cd C:\xampp\htdocs\Dostava\aplikacija
```

### Problem: "SQLSTATE connection refused"
**Rešenje:** 
1. Proveri da je MySQL pokrenut u XAMPP-u
2. Proveri .env kredencijale

### Problem: "Database 'dostava_hrane' doesn't exist"
**Rešenje:** Kreiraj bazu u phpMyAdmin (vidi Korak 2.3)

### Problem: Frontend pokazuje "Network Error"
**Rešenje:**
1. Proveri da je backend pokrenut na `http://localhost:8000`
2. Testiraj API endpoint: `http://localhost:8000/api/restorani`

### Problem: "npm ERR!"
**Rešenje:** Obriši `node_modules` i ponovo instaliraj:
```bash
cd frontend
Remove-Item -Recurse -Force node_modules
npm install
```

---

## 📊 API Testiranje (Postman)

Možeš testirati API direktno:

### 1. Register
```
POST http://localhost:8000/api/register
Content-Type: application/json

{
  "name": "Test User",
  "email": "test@test.com",
  "password": "password123",
  "password_confirmation": "password123"
}
```

### 2. Login
```
POST http://localhost:8000/api/login
Content-Type: application/json

{
  "email": "admin@dostava.rs",
  "password": "password123"
}
```

### 3. Lista Restorana
```
GET http://localhost:8000/api/restorani
```

---

## 📞 Kontakt

Za dodatna pitanja ili probleme, pogledaj:
- `README.md` - Kompletna dokumentacija
- GitHub Repository: https://github.com/elab-development/internet-tehnologije-2024-projekat-apkporucivanjehrane_2020_0010_2020_0177

---

**Autor: Student 2020_0010 i 2020_0177**
**Projekat: Internet Tehnologije 2024**

