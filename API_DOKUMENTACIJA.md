# 📡 API Dokumentacija - Dostava Hrane

## 🌐 Base URL
```
http://localhost:8000/api
```

## 🔐 Autentifikacija

API koristi Laravel Sanctum za autentifikaciju. Nakon prijave, dobićete token koji morate slati u svim zaštićenim zahtevima.

**Header za autentifikovane zahteve:**
```
Authorization: Bearer {token}
Accept: application/json
Content-Type: application/json
```

---

## 📍 Endpoints

### 1. Health Check

**GET** `/health`

Provera da li API radi.

**Odgovor:**
```json
{
    "success": true,
    "message": "API radi ispravno",
    "timestamp": "2025-10-18 16:00:00"
}
```

---

### 2. Autentifikacija

#### 2.1 Registracija

**POST** `/auth/register`

**Body:**
```json
{
    "name": "Marko Marković",
    "email": "marko@test.com",
    "password": "password123",
    "password_confirmation": "password123"
}
```

**Odgovor:**
```json
{
    "success": true,
    "message": "Korisnik uspešno registrovan",
    "user": {
        "id": 1,
        "name": "Marko Marković",
        "email": "marko@test.com"
    },
    "token": "1|abc123...",
    "token_type": "Bearer"
}
```

#### 2.2 Prijava

**POST** `/auth/login`

**Body:**
```json
{
    "email": "admin@dostava.com",
    "password": "admin123"
}
```

**Odgovor:**
```json
{
    "success": true,
    "message": "Uspešna prijava",
    "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@dostava.com"
    },
    "token": "2|xyz789...",
    "token_type": "Bearer"
}
```

#### 2.3 Odjava

**POST** `/auth/logout`

**Headers:** `Authorization: Bearer {token}`

**Odgovor:**
```json
{
    "success": true,
    "message": "Uspešna odjava"
}
```

#### 2.4 Trenutni korisnik

**GET** `/auth/me`

**Headers:** `Authorization: Bearer {token}`

**Odgovor:**
```json
{
    "success": true,
    "user": {
        "id": 1,
        "name": "Admin",
        "email": "admin@dostava.com",
        "created_at": "2025-10-18 14:00:00"
    }
}
```

---

### 3. Kategorije (Public)

#### 3.1 Lista svih kategorija

**GET** `/public/kategorije`

**Odgovor:**
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
        }
    ]
}
```

---

### 4. Restorani (Public)

#### 4.1 Lista restorana (sa paginacijom i filtrovanjem)

**GET** `/public/restorani?search=pica&category_id=1&per_page=10&sort_by=name`

**Query parametri:**
- `search` - Pretraga po nazivu
- `category_id` - Filter po kategoriji
- `max_delivery_price` - Maksimalna cena dostave
- `sort_by` - Sortiranje (name, delivery_price, delivery_time)
- `sort_order` - asc ili desc
- `per_page` - Broj po stranici (default: 15)

**Odgovor:**
```json
{
    "success": true,
    "data": [...],
    "meta": {
        "current_page": 1,
        "last_page": 2,
        "per_page": 10,
        "total": 18
    }
}
```

#### 4.2 Detalji restorana

**GET** `/public/restorani/{id}`

**Odgovor:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "Tri Šešira",
        "slug": "tri-sesira",
        "description": "Domaća kuhinja...",
        "address": "Skadarska 29, Beograd",
        "phone": "+381 11 123 4567",
        "delivery_price": 150.00,
        "delivery_time": 30,
        "is_active": true,
        "category": {...}
    }
}
```

#### 4.3 Meni restorana

**GET** `/public/restorani/{id}/meni`

**Odgovor:**
```json
{
    "success": true,
    "restoran": {...},
    "proizvodi": [...]
}
```

---

### 5. Proizvodi (Public)

#### 5.1 Lista proizvoda

**GET** `/public/proizvodi?search=pljeskavica&min_price=500&max_price=1000`

**Query parametri:**
- `search` - Pretraga po nazivu
- `restoran_id` - Filter po restoranu
- `min_price` - Minimalna cena
- `max_price` - Maksimalna cena
- `per_page` - Broj po stranici

---

### 6. Porudžbine (Auth Required)

#### 6.1 Moje porudžbine

**GET** `/porudzbine`

**Headers:** `Authorization: Bearer {token}`

**Odgovor:**
```json
{
    "success": true,
    "data": [...]
}
```

#### 6.2 Kreiranje porudžbine

**POST** `/porudzbine`

**Headers:** `Authorization: Bearer {token}`

**Body:**
```json
{
    "restoran_id": 1,
    "delivery_address": "Knez Mihailova 12, Beograd",
    "note": "Bez luka molim",
    "proizvodi": [
        {
            "id": 1,
            "quantity": 2
        },
        {
            "id": 3,
            "quantity": 1
        }
    ]
}
```

**Odgovor:**
```json
{
    "success": true,
    "message": "Porudžbina uspešno kreirana",
    "data": {
        "id": 1,
        "order_number": "ORD-ABC123",
        "total_price": 1250.00,
        "status": "pending",
        ...
    }
}
```

#### 6.3 Otkazivanje porudžbine

**POST** `/porudzbine/{id}/otkazi`

**Headers:** `Authorization: Bearer {token}`

---

### 7. Vremenska Prognoza (Public)

**GET** `/public/vremenska-prognoza`

Prikazuje trenutnu vremensku prognozu za Beograd koristeći Open-Meteo API.

**Odgovor:**
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
        "wind_speed": 12.3,
        "description": "Delimično oblačno"
    },
    "forecast": {...},
    "message": "Preporuka: Dobri vremenski uslovi - normalno vreme dostave"
}
```

---

### 8. Statistika (Auth Required)

#### 8.1 Moje statistike

**GET** `/statistika/moje`

**Headers:** `Authorization: Bearer {token}`

**Odgovor:**
```json
{
    "success": true,
    "data": {
        "ukupno_porudzbina": 5,
        "zavrsene_porudzbine": 3,
        "ukupno_potroseno": 5450.00,
        "omiljeni_restoran": {
            "naziv": "Tri Šešira",
            "broj_porudzbina": 3
        }
    }
}
```

---

### 9. Eksport (Auth Required)

#### 9.1 Eksport mojih porudžbina

**GET** `/eksport/moje-porudzbine`

**Headers:** `Authorization: Bearer {token}`

**Odgovor:** CSV fajl za download

---

### 10. Admin Endpoints (Auth + Admin)

**Samo korisnici sa `is_admin = true` mogu pristupiti:**

- `POST /api/admin/restorani` - Dodavanje restorana
- `PUT /api/admin/restorani/{id}` - Izmena restorana
- `DELETE /api/admin/restorani/{id}` - Brisanje restorana
- `POST /api/admin/proizvodi` - Dodavanje proizvoda
- `PUT /api/admin/proizvodi/{id}` - Izmena proizvoda
- `DELETE /api/admin/proizvodi/{id}` - Brisanje proizvoda
- `GET /api/admin/eksport/sve-porudzbine` - CSV eksport
- `GET /api/admin/eksport/restorani` - CSV eksport

---

## ⚠️ Status Kodovi

- `200` - OK
- `201` - Created
- `400` - Bad Request
- `401` - Unauthorized
- `403` - Forbidden (admin only)
- `404` - Not Found
- `422` - Validation Error
- `500` - Server Error

---

## 🧪 Testiranje u Postman-u

1. Kreirajte kolekciju "Dostava Hrane API"
2. Dodajte environment varijablu: `base_url = http://localhost:8000/api`
3. Nakon login-a, sačuvajte token u environment: `token`
4. Koristite `{{base_url}}` i `{{token}}` u zahtevima

---

## 📊 Baza podataka - Seedovani podaci

- **12 korisnika** (1 admin + 1 test + 10 random)
- **6 kategorija**
- **~18 restorana**
- **~135 proizvoda**

---

## 🔒 Bezbednost

- ✅ Hashovanje lozinki (bcrypt)
- ✅ Sanctum token autentifikacija
- ✅ Validacija svih input podataka
- ✅ SQL injection zaštita (Eloquent ORM)
- ✅ Mass assignment zaštita ($fillable)
- ✅ Admin middleware za zaštitu admin ruta
- ✅ CORS zaštita

---

## 📖 Dodatne informacije

Za više informacija pogledajte Laravel dokumentaciju:
- https://laravel.com/docs/11.x
- https://laravel.com/docs/11.x/sanctum

