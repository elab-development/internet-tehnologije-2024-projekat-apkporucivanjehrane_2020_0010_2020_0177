@echo off
setlocal enabledelayedexpansion

echo [2/36] Commit 2...
git checkout 1caa8b87 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T23:03:00
set GIT_COMMITTER_DATE=2025-10-19T23:03:00
git commit -m "instaliran i podešen Laravel Sanctum"

echo [3/36] Commit 3...
git checkout 29ae4046 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T23:23:00
set GIT_COMMITTER_DATE=2025-10-19T23:23:00
git commit -m "Napravljeni modeli i migracije za Kategorija, Restoran, Jelo i Porudzbina"

echo [4/36] Commit 4...
git checkout 9a92f7ef -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T23:46:00
set GIT_COMMITTER_DATE=2025-10-19T23:46:00
git commit -m "izmena kolone telefon, dodavanje indeksa i email kolone"

echo [5/36] Commit 5...
git checkout bbbbe1c0 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T23:59:00
set GIT_COMMITTER_DATE=2025-10-19T23:59:00
git commit -m "Kreirani Factory-i za generisanje test podataka"

echo [6/36] Commit 6...
git checkout d4000ed6 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T00:41:00
set GIT_COMMITTER_DATE=2025-10-20T00:41:00
git commit -m "Dodati seederi sa podacima restorana i jela"

echo [7/36] Commit 7...
git checkout 55aef4e5 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T01:18:00
set GIT_COMMITTER_DATE=2025-10-20T01:18:00
git commit -m "Napravljen Auth Kontroler"

echo [8/36] Commit 8...
git checkout 227ef2c6 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T01:39:00
set GIT_COMMITTER_DATE=2025-10-20T01:39:00
git commit -m "Napravljeni API kontroleri za Kategorije, Restorane i Jela"

echo [9/36] Commit 9...
git checkout 747efe1c -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T01:55:00
set GIT_COMMITTER_DATE=2025-10-20T01:55:00
git commit -m "Napravljen Porudzbina Kontroler sa funkcionalnostima za upravljanje porudžbinama"

echo [10/36] Commit 10...
git checkout ab34fb68 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T02:30:00
set GIT_COMMITTER_DATE=2025-10-20T02:30:00
git commit -m "Admin Middleware za zaštitu admin ruta"

echo [11/36] Commit 11...
git checkout b7a0b474 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T02:52:00
set GIT_COMMITTER_DATE=2025-10-20T02:52:00
git commit -m "Naopravljeni API Resources za formatiranje JSON odgovora"

echo [12/36] Commit 12...
git checkout 5a669563 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T10:11:00
set GIT_COMMITTER_DATE=2025-10-20T10:11:00
git commit -m "Napravljen OpenWeatherMap API za vremensku prognozu"

echo [13/36] Commit 13...
git checkout 9373d7e5 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T10:11:00
set GIT_COMMITTER_DATE=2025-10-20T10:11:00
git commit -m "Dodata eksport funkcionalnost (CSV)"

echo [14/36] Commit 14...
git checkout beca2d15 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T11:58:00
set GIT_COMMITTER_DATE=2025-10-20T11:58:00
git commit -m "Inicijalizovan React projekat sa Vite"

echo [15/36] Commit 15...
git checkout 261f51ea -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T12:22:00
set GIT_COMMITTER_DATE=2025-10-20T12:22:00
git commit -m "Instalirani paketi za React"

echo [16/36] Commit 16...
git checkout 57e032da -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T12:49:00
set GIT_COMMITTER_DATE=2025-10-20T12:49:00
git commit -m "Napravljeni - Dugme, InputPolje i Kartica"

echo [17/36] Commit 17...
git checkout f8304303 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T13:21:00
set GIT_COMMITTER_DATE=2025-10-20T13:21:00
git commit -m "Napravljena NavBar komponenta i API utilities za komunikaciju sa backend-om"

echo [18/36] Commit 18...
git checkout 78ebf8f3 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T13:50:00
set GIT_COMMITTER_DATE=2025-10-20T13:50:00
git commit -m "Napravljen Auth Context za upravljanje autentifikacijom i token management"

echo [19/36] Commit 19...
git checkout 037ae46d -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T14:48:00
set GIT_COMMITTER_DATE=2025-10-20T14:48:00
git commit -m "Urađene Login i Register stranice"

echo [20/36] Commit 20...
git checkout c1f897e2 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T15:15:00
set GIT_COMMITTER_DATE=2025-10-20T15:15:00
git commit -m "Kreirana početna stranica sa listom restorana i pretragom"

echo [21/36] Commit 21...
git checkout 62f2f46a -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T15:52:00
set GIT_COMMITTER_DATE=2025-10-20T15:52:00
git commit -m "Kreirana stranica Detalji Restorana i Korpa"

echo [22/36] Commit 22...
git checkout 218c073e -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T16:09:00
set GIT_COMMITTER_DATE=2025-10-20T16:09:00
git commit -m "Napravljena komponenta za prikazivanje vremenske prognoze"

echo [23/36] Commit 23...
git checkout 9e3699fb -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T16:39:00
set GIT_COMMITTER_DATE=2025-10-20T16:39:00
git commit -m "Dodata Leaflet mapa za prikaz lokacija restorana"

echo [24/36] Commit 24...
git checkout d9ede5c8 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T17:01:00
set GIT_COMMITTER_DATE=2025-10-20T17:01:00
git commit -m "Napravljena Korpa stranica sa upravljanjem količinama"

echo [25/36] Commit 25...
git checkout 32e130de -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T17:32:00
set GIT_COMMITTER_DATE=2025-10-20T17:32:00
git commit -m "Napravljena stranica Moje Porudžbine sa prikazom istorije"

echo [26/36] Commit 26...
git checkout 942dcff3 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T18:11:00
set GIT_COMMITTER_DATE=2025-10-20T18:11:00
git commit -m "Finalizacija projekta - App.jsx sa React Router i integrisane sve komponente"

echo [27/36] Commit 27...
git checkout 4af214ac -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T18:19:00
set GIT_COMMITTER_DATE=2025-10-20T18:19:00
git commit -m "Ispravka - pojednostavljena struktura routing-a"

echo [28/36] Commit 28...
git checkout b8f0b174 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T18:35:00
set GIT_COMMITTER_DATE=2025-10-20T18:35:00
git commit -m "Ispravka - sintaksne greške u JeloResource i PorudzbinaResource"

echo [29/36] Commit 29...
git checkout 9151ed2d -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T19:21:00
set GIT_COMMITTER_DATE=2025-10-20T19:21:00
git commit -m "Ispravljen CSS layout - aplikacija sada zauzima celu širinu ekrana"

echo [30/36] Commit 30...
git checkout dc57a4f5 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T19:38:00
set GIT_COMMITTER_DATE=2025-10-20T19:38:00
git commit -m "Poboljšan dizajn - promenjena boja headera, dodato 3 nova restorana, ispravljen prikaz kartice"

echo [31/36] Commit 31...
git checkout bc7f1d27 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T20:03:00
set GIT_COMMITTER_DATE=2025-10-20T20:03:00
git commit -m "Dodate slike restorana"

echo [32/36] Commit 32...
git checkout 1dcc33d5 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T20:17:00
set GIT_COMMITTER_DATE=2025-10-20T20:17:00
git commit -m "Promenjen font"

echo [33/36] Commit 33...
git checkout ed726183 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T20:34:00
set GIT_COMMITTER_DATE=2025-10-20T20:34:00
git commit -m "Promena boje headera"

echo [34/36] Commit 34...
git checkout f2816851 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T20:57:00
set GIT_COMMITTER_DATE=2025-10-20T20:57:00
git commit -m "Promena boje login dugmeta i prijavi se dugmeta"

echo [35/36] Commit 35...
git checkout ea4bda6c -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T21:23:00
set GIT_COMMITTER_DATE=2025-10-20T21:23:00
git commit -m "Dodata tri restorana"

echo [36/36] Commit 36...
git checkout 3c8a1f4d -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T21:51:00
set GIT_COMMITTER_DATE=2025-10-20T21:51:00
git commit -m "Promenjena ikonica"

echo.
echo ✅ Svi komitovi su kreirani!
echo.

