# 🧪 Uputstvo za Testiranje API-ja u Postman-u

## 📋 Priprema

### 1. Pokretanje servera

```bash
cd aplikacija
php artisan serve
```

Server će biti pokrenut na: `http://localhost:8000`

### 2. Import Postman kolekcije

1. Otvorite Postman
2. Kliknite **Import**
3. Izaberite fajl `Postman_Kolekcija.json`
4. Kolekcija "Dostava Hrane API" će biti dodata

### 3. Podešavanje Environment varijabli

1. U Postman-u, kliknite na **Environments**
2. Kreirajte novi environment "Dostava Local"
3. Dodajte varijable:
   - `base_url` = `http://localhost:8000/api`
   - `token` = (ostavite prazno, popuniće se nakon login-a)

---

## 🔍 Testiranje Endpoints-a

### TEST 1: Health Check ✅

**Request:**
```
GET {{base_url}}/health
```

**Očekivani odgovor (200 OK):**
```json
{
    "success": true,
    "message": "API radi ispravno",
    "timestamp": "2025-10-18 16:00:00"
}
```

**Screenshot:** Snimite ceo ekran sa statusom 200 i odgovorom

---

### TEST 2: Registracija ✅

**Request:**
```
POST {{base_url}}/auth/register
Headers: Accept: application/json
```

**Body (JSON):**
```json
{
    "name": "Marko Marković",
    "email": "marko@test.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Očekivani odgovor (201 Created):**
```json
{
    "success": true,
    "message": "Korisnik uspešno registrovan",
    "user": {
        "id": 13,
        "name": "Marko Marković",
        "email": "marko@test.com"
    },
    "token": "1|abc123xyz...",
    "token_type": "Bearer"
}
```

**VAŽNO:** Kopirajte `token` vrednost i sačuvajte u environment varijablu!

**Screenshot:** Ceo ekran sa Body, Response i statusom 201

---

### TEST 3: Prijava (Login) ✅

**Request:**
```
POST {{base_url}}/auth/login
Headers: Accept: application/json
```

**Body (JSON):**
```json
{
    "email": "admin@dostava.com",
    "password": "admin123"
}
```

**Očekivani odgovor (200 OK):**
```json
{
    "success": true,
    "message": "Uspešna prijava",
    "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@dostava.com"
    },
    "token": "2|xyz789abc...",
    "token_type": "Bearer"
}
```

**VAŽNO:** Sačuvajte admin token za testiranje admin ruta!

**Screenshot:** Ceo ekran

---

### TEST 4: Lista Kategorija (Public) ✅

**Request:**
```
GET {{base_url}}/public/kategorije
```

**Očekivani odgovor (200 OK):**
```json
{
    "success": true,
    "data": [
        {
            "id": 1,
            "name": "Pica",
            "slug": "pica",
            "description": "Pizzerije i italijanska hrana",
            "broj_restorana": 3,
            "created_at": "2025-10-18 14:00:00"
        },
        ...
    ]
}
```

**Screenshot:** Ceo ekran

---

### TEST 5: Lista Restorana sa Paginacijom ✅

**Request:**
```
GET {{base_url}}/public/restorani?per_page=5&page=1
```

**Očekivani odgovor (200 OK):**
```json
{
    "success": true,
    "data": [...],
    "meta": {
        "current_page": 1,
        "last_page": 4,
        "per_page": 5,
        "total": 18
    }
}
```

**Screenshot:** Ceo ekran sa vidljivim meta podacima

---

### TEST 6: Pretraga Restorana ✅

**Request:**
```
GET {{base_url}}/public/restorani?search=tri&category_id=1
```

**Očekivani odgovor (200 OK):**
Samo restorani koji sadrže "tri" u nazivu iz kategorije 1

**Screenshot:** Ceo ekran

---

### TEST 7: Detalji Restorana ✅

**Request:**
```
GET {{base_url}}/public/restorani/1
```

**Očekivani odgovor (200 OK):**
Pun objekat restorana sa kategorijom i proizvodima

**Screenshot:** Ceo ekran

---

### TEST 8: Meni Restorana ✅

**Request:**
```
GET {{base_url}}/public/restorani/1/meni
```

**Očekivani odgovor (200 OK):**
Restoran + svi njegovi proizvodi

**Screenshot:** Ceo ekran

---

### TEST 9: Vremenska Prognoza (Javni API) ✅

**Request:**
```
GET {{base_url}}/public/vremenska-prognoza
```

**Očekivani odgovor (200 OK):**
```json
{
    "success": true,
    "location": {
        "city": "Beograd",
        "country": "Srbija"
    },
    "current": {
        "temperature": 15.5,
        "humidity": 65,
        "description": "Delimično oblačno"
    },
    "message": "Preporuka: Dobri vremenski uslovi..."
}
```

**Screenshot:** Ceo ekran - DOKAZ DA KORISTI JAVNI API!

---

### TEST 10: Kreiranje Porudžbine (AUTH) ✅

**Request:**
```
POST {{base_url}}/porudzbine
Headers: 
  Authorization: Bearer {{token}}
  Accept: application/json
```

**Body (JSON):**
```json
{
    "restoran_id": 1,
    "delivery_address": "Knez Mihailova 12, Beograd",
    "note": "Bez luka",
    "proizvodi": [
        {
            "id": 1,
            "quantity": 2
        },
        {
            "id": 2,
            "quantity": 1
        }
    ]
}
```

**Očekivani odgovor (201 Created):**
```json
{
    "success": true,
    "message": "Porudžbina uspešno kreirana",
    "data": {
        "id": 1,
        "order_number": "ORD-ABC123",
        "total_price": 1850.00,
        "status": "pending",
        ...
    }
}
```

**Screenshot:** Ceo ekran sa Body i Response

---

### TEST 11: Moje Porudžbine (AUTH) ✅

**Request:**
```
GET {{base_url}}/porudzbine
Headers: Authorization: Bearer {{token}}
```

**Očekivani odgovor (200 OK):**
Lista svih porudžbina ulogovanog korisnika

**Screenshot:** Ceo ekran

---

### TEST 12: Moje Statistike (AUTH) ✅

**Request:**
```
GET {{base_url}}/statistika/moje
Headers: Authorization: Bearer {{token}}
```

**Očekivani odgovor (200 OK):**
```json
{
    "success": true,
    "data": {
        "ukupno_porudzbina": 3,
        "zavrsene_porudzbine": 1,
        "ukupno_potroseno": 4500.00,
        "omiljeni_restoran": {...}
    }
}
```

**Screenshot:** Ceo ekran

---

### TEST 13: Popularni Restorani ✅

**Request:**
```
GET {{base_url}}/statistika/popularni-restorani
Headers: Authorization: Bearer {{token}}
```

**Screenshot:** Ceo ekran

---

### TEST 14: Eksport CSV (AUTH) ✅

**Request:**
```
GET {{base_url}}/eksport/moje-porudzbine
Headers: Authorization: Bearer {{token}}
```

**Očekivani rezultat:**
Download CSV fajla sa porudžbinama

**Screenshot:** Ceo ekran + otvoreni CSV fajl

---

### TEST 15: Dodavanje Restorana (ADMIN) ✅

**Request:**
```
POST {{base_url}}/admin/restorani
Headers: 
  Authorization: Bearer {{admin_token}}
  Accept: application/json
```

**Body (JSON):**
```json
{
    "category_id": 1,
    "name": "Novi Restoran",
    "slug": "novi-restoran",
    "description": "Test opis",
    "address": "Terazije 1, Beograd",
    "phone": "+381 11 111 1111",
    "delivery_price": 200,
    "delivery_time": 35,
    "is_active": true
}
```

**Očekivani odgovor (201 Created):**
Kreiran novi restoran

**Screenshot:** Ceo ekran

---

### TEST 16: Pokušaj pristupa admin ruti BEZ admin prava ❌

**Request:**
```
POST {{base_url}}/admin/restorani
Headers: Authorization: Bearer {{obican_user_token}}
```

**Očekivani odgovor (403 Forbidden):**
```json
{
    "success": false,
    "message": "Nemate administratorska prava za pristup ovoj ruti"
}
```

**Screenshot:** Ceo ekran - DOKAZ ZAŠTITE!

---

### TEST 17: Pokušaj pristupa bez tokena ❌

**Request:**
```
GET {{base_url}}/porudzbine
(bez Authorization header-a)
```

**Očekivani odgovor (401 Unauthorized):**
```json
{
    "success": false,
    "message": "Neautorizovan pristup. Morate biti prijavljeni."
}
```

**Screenshot:** Ceo ekran - DOKAZ AUTENTIFIKACIJE!

---

### TEST 18: Odjava ✅

**Request:**
```
POST {{base_url}}/auth/logout
Headers: Authorization: Bearer {{token}}
```

**Očekivani odgovor (200 OK):**
```json
{
    "success": true,
    "message": "Uspešna odjava"
}
```

**Screenshot:** Ceo ekran

---

## 📸 Zahtevi za Screenshot-e

**OBAVEZNO NA SVAKOM SCREENSHOT-u:**
- ✅ **Ceo ekran** (ne samo Postman prozor)
- ✅ **Taskbar sa datumom i vremenom** (dole desno)
- ✅ **URL request-a**
- ✅ **HTTP metod** (GET, POST, PUT, DELETE)
- ✅ **Headers** (ako ima Authorization)
- ✅ **Body** (kod POST/PUT zahteva)
- ✅ **Response** (status kod i JSON odgovor)

## ✅ Checklist za Odbranu

- [ ] Health check radi
- [ ] Registracija kreira korisnika
- [ ] Login vraća token
- [ ] Public rute rade bez tokena
- [ ] Auth rute zahtevaju token
- [ ] Admin rute zahtevaju is_admin=true
- [ ] Paginacija radi
- [ ] Pretraga i filtriranje rade
- [ ] Vremenska prognoza koristi javni API
- [ ] CSV eksport radi
- [ ] Statistike računaju ispravno
- [ ] Validacija sprečava neispravne podatke
- [ ] 401/403/404 statusi se vraćaju korektno

---

## 📊 Priprema za Odbranu

### Pitanja koja mogu postaviti:

1. **Kako funkcioniše Sanctum autentifikacija?**
   - Korisnik se prijavi, dobija token
   - Token se šalje u Authorization header-u
   - Middleware `auth:sanctum` proverava token
   - Token se čuva u `personal_access_tokens` tabeli

2. **Zašto koristimo API Resources?**
   - Kontrola nad JSON formatom odgovora
   - Sakrivanje osetljivih podataka
   - Transformacija Eloquent modela
   - Konzistentnost API odgovora

3. **Kako radi paginacija?**
   - Laravel `paginate()` metod
   - Query parametar `per_page`
   - Meta podaci: current_page, last_page, total

4. **Koje tipove migracija imate?**
   - Kreiranje tabela
   - Dodavanje kolone
   - Izmena kolone (unique constraint)
   - Dodavanje indeksa
   - Spoljni ključevi (foreign keys)

5. **Koje mere bezbednosti ste implementirali?**
   - Hash::make() za lozinke
   - Sanctum tokeni
   - Validacija (FormRequest)
   - Admin middleware
   - Mass assignment zaštita ($fillable)
   - Eloquent ORM (SQL injection zaštita)

6. **Koji javni API koristite?**
   - Open-Meteo API za vremensku prognozu
   - Besplatan, bez API ključa
   - Keširamo podatke 30 minuta (Cache::remember)

7. **Kako rade relacije između modela?**
   - belongsTo (N:1) - proizvod pripada restoranu
   - hasMany (1:N) - restoran ima više proizvoda
   - belongsToMany (M:N) - porudžbina <-> proizvodi (pivot tabela)

---

## 🎯 Red Testiranja

1. Health Check (public)
2. Registracija (public)
3. Login (public)
4. Kategorije (public)
5. Restorani - lista (public)
6. Restorani - pretraga (public)
7. Restorani - detalji (public)
8. Meni restorana (public)
9. Proizvodi (public)
10. Vremenska prognoza (public) - **JAVNI API!**
11. Me - trenutni korisnik (auth)
12. Kreiranje porudžbine (auth)
13. Moje porudžbine (auth)
14. Moje statistike (auth)
15. Eksport CSV (auth)
16. Admin - dodavanje restorana (admin + auth)
17. **Neuspeli zahtevi:**
    - Pristup bez tokena (401)
    - Običan user pokušava admin rutu (403)
    - Nepostojeća ruta (404)
18. Logout (auth)

---

## 💡 Saveti za Odbranu

- **Pokažite kod** - otvorite kontroler i objasnite liniju po liniju
- **Pokažite migracije** - database/migrations foldere
- **Pokažite modele** - app/Models sa relacijama
- **Pokažite rute** - routes/api.php
- **Pokažite bazu** - phpMyAdmin sa tabelama i podacima
- **Pripremite odgovore** na pitanja gore ⬆️

---

## ⚠️ Česte Greške

1. **Token nije poslat** → 401 Unauthorized
2. **Token je pogrešan** → 401
3. **Običan user pristupa admin ruti** → 403 Forbidden
4. **Validacija ne prolazi** → 422 sa error porukama
5. **Proizvod ne pripada restoranu** → 400 Bad Request

---

## 📝 Za Dokumentaciju

Nakon testiranja, **snimite screenshot-e** za:
- Minimum 10 različitih zahteva
- Uključite bar 1 grešku (401/403/422)
- Ceo ekran sa datumom
- Jasno vidljiv URL, metod, body, response

Screenshot-e dodajte u Word dokument sa objašnjenjima!

