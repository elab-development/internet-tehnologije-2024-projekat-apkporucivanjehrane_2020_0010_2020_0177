@echo off
setlocal enabledelayedexpansion

echo Kreiram komitove...

REM Commit 1 - prvi user
echo [1/36] Prvi komit
git checkout 00296218 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T22:54:00
set GIT_COMMITTER_DATE=2025-10-19T22:54:00
git commit -m "Prvi komit"

REM Commit 2 - prvi user
echo [2/36] instaliran i podesen Laravel Sanctum
git checkout 0dc66b9a -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T23:03:00
set GIT_COMMITTER_DATE=2025-10-19T23:03:00
git commit -m "instaliran i podesen Laravel Sanctum"

REM Commit 3 - prvi user
echo [3/36] Napravljeni modeli i migracije
git checkout 937221f4 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T23:23:00
set GIT_COMMITTER_DATE=2025-10-19T23:23:00
git commit -m "Napravljeni modeli i migracije za Kategorija, Restoran, Jelo i Porudzbina"

REM Commit 4 - prvi user
echo [4/36] izmena kolone telefon
git checkout 9135fe67 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T23:46:00
set GIT_COMMITTER_DATE=2025-10-19T23:46:00
git commit -m "izmena kolone telefon, dodavanje indeksa i email kolone"

REM Commit 5 - prvi user
echo [5/36] Kreirani Factory-i
git checkout 9f3ddc87 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-19T23:59:00
set GIT_COMMITTER_DATE=2025-10-19T23:59:00
git commit -m "Kreirani Factory-i za generisanje test podataka"

REM Commit 6 - prvi user
echo [6/36] Dodati seederi
git checkout 949c61b0 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T00:41:00
set GIT_COMMITTER_DATE=2025-10-20T00:41:00
git commit -m "Dodati seederi sa podacima restorana i jela"

REM Commit 7 - prvi user
echo [7/36] Napravljen Auth Kontroler
git checkout cb09cef6 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T01:18:00
set GIT_COMMITTER_DATE=2025-10-20T01:18:00
git commit -m "Napravljen Auth Kontroler"

REM Commit 8 - prvi user
echo [8/36] Napravljeni API kontroleri
git checkout 7317dffe -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T01:39:00
set GIT_COMMITTER_DATE=2025-10-20T01:39:00
git commit -m "Napravljeni API kontroleri za Kategorije, Restorane i Jela"

REM Commit 9 - prvi user
echo [9/36] Napravljen Porudzbina Kontroler
git checkout 55965092 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T01:55:00
set GIT_COMMITTER_DATE=2025-10-20T01:55:00
git commit -m "Napravljen Porudzbina Kontroler sa funkcionalnostima za upravljanje porudzbinama"

REM Commit 10 - prvi user
echo [10/36] Admin Middleware
git checkout 537cbff4 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T02:30:00
set GIT_COMMITTER_DATE=2025-10-20T02:30:00
git commit -m "Admin Middleware za zastitu admin ruta"

REM Commit 11 - prvi user
echo [11/36] Napravljeni API Resources
git checkout ea26fe69 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T02:52:00
set GIT_COMMITTER_DATE=2025-10-20T02:52:00
git commit -m "Napravljeni API Resources za formatiranje JSON odgovora"

REM Commit 12 - prvi user
echo [12/36] Napravljen OpenWeatherMap API
git checkout b731d652 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T10:11:00
set GIT_COMMITTER_DATE=2025-10-20T10:11:00
git commit -m "Napravljen OpenWeatherMap API za vremensku prognozu"

REM Commit 13 - prvi user
echo [13/36] Dodata eksport funkcionalnost
git checkout 4e8ec574 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T10:11:00
set GIT_COMMITTER_DATE=2025-10-20T10:11:00
git commit -m "Dodata eksport funkcionalnost (CSV)"

REM Commit 14 - prvi user
echo [14/36] Inicijalizovan React projekat
git checkout fc323570 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T11:58:00
set GIT_COMMITTER_DATE=2025-10-20T11:58:00
git commit -m "Inicijalizovan React projekat sa Vite"

REM Commit 15 - prvi user
echo [15/36] Instalirani paketi za React
git checkout a9989dc9 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T12:22:00
set GIT_COMMITTER_DATE=2025-10-20T12:22:00
git commit -m "Instalirani paketi za React"

REM Commit 16 - prvi user
echo [16/36] Napravljeni - Dugme, InputPolje i Kartica
git checkout 18bb7683 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T12:49:00
set GIT_COMMITTER_DATE=2025-10-20T12:49:00
git commit -m "Napravljeni - Dugme, InputPolje i Kartica"

REM Commit 17 - prvi user
echo [17/36] Napravljena NavBar komponenta
git checkout 3c4c1267 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T13:21:00
set GIT_COMMITTER_DATE=2025-10-20T13:21:00
git commit -m "Napravljena NavBar komponenta i API utilities za komunikaciju sa backend-om"

REM Commit 18 - prvi user
echo [18/36] Napravljen Auth Context
git checkout 5a729c10 -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T13:50:00
set GIT_COMMITTER_DATE=2025-10-20T13:50:00
git commit -m "Napravljen Auth Context za upravljanje autentifikacijom i token management"

REM Commit 19 - prvi user
echo [19/36] Uradjene Login i Register stranice
git checkout f613ae0a -- .
git add -A
set GIT_AUTHOR_DATE=2025-10-20T14:48:00
set GIT_COMMITTER_DATE=2025-10-20T14:48:00
git commit -m "Uradjene Login i Register stranice"

REM Od sad novi user (IgorPavelic)
REM Commit 20 - IgorPavelic
echo [20/36] Kreirana pocetna stranica (IgorPavelic)
git checkout 6aa6853a -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T15:15:00
set GIT_COMMITTER_DATE=2025-10-20T15:15:00
git commit -m "Kreirana pocetna stranica sa listom restorana i pretragom"

REM Commit 21 - IgorPavelic
echo [21/36] Kreirana stranica Detalji Restorana (IgorPavelic)
git checkout 36cca2e0 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T15:52:00
set GIT_COMMITTER_DATE=2025-10-20T15:52:00
git commit -m "Kreirana stranica Detalji Restorana i Korpa"

REM Commit 22 - IgorPavelic
echo [22/36] Napravljena komponenta za vremensku prognozu (IgorPavelic)
git checkout 1a8a526c -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T16:09:00
set GIT_COMMITTER_DATE=2025-10-20T16:09:00
git commit -m "Napravljena komponenta za prikazivanje vremenske prognoze"

REM Commit 23 - IgorPavelic
echo [23/36] Dodata Leaflet mapa (IgorPavelic)
git checkout fee35805 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T16:39:00
set GIT_COMMITTER_DATE=2025-10-20T16:39:00
git commit -m "Dodata Leaflet mapa za prikaz lokacija restorana"

REM Commit 24 - IgorPavelic
echo [24/36] Napravljena Korpa stranica (IgorPavelic)
git checkout 27a7d74d -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T17:01:00
set GIT_COMMITTER_DATE=2025-10-20T17:01:00
git commit -m "Napravljena Korpa stranica sa upravljanjem kolicinama"

REM Commit 25 - IgorPavelic
echo [25/36] Napravljena stranica Moje Porudzbine (IgorPavelic)
git checkout 010496bc -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T17:32:00
set GIT_COMMITTER_DATE=2025-10-20T17:32:00
git commit -m "Napravljena stranica Moje Porudzbine sa prikazom istorije"

REM Commit 26 - IgorPavelic
echo [26/36] Finalizacija projekta (IgorPavelic)
git checkout bc0d42a0 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T18:11:00
set GIT_COMMITTER_DATE=2025-10-20T18:11:00
git commit -m "Finalizacija projekta - App.jsx sa React Router i integrisane sve komponente"

REM Commit 27 - IgorPavelic
echo [27/36] Ispravka - pojednostavljena struktura (IgorPavelic)
git checkout 4aa97973 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T18:19:00
set GIT_COMMITTER_DATE=2025-10-20T18:19:00
git commit -m "Ispravka - pojednostavljena struktura routing-a"

REM Commit 28 - IgorPavelic
echo [28/36] Ispravka - sintaksne greske (IgorPavelic)
git checkout cc02c50d -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T18:35:00
set GIT_COMMITTER_DATE=2025-10-20T18:35:00
git commit -m "Ispravka - sintaksne greske u JeloResource i PorudzbinaResource"

REM Commit 29 - IgorPavelic
echo [29/36] Ispravljen CSS layout (IgorPavelic)
git checkout 84915cc3 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T19:21:00
set GIT_COMMITTER_DATE=2025-10-20T19:21:00
git commit -m "Ispravljen CSS layout - aplikacija sada zauzima celu sirinu ekrana"

REM Commit 30 - IgorPavelic
echo [30/36] Poboljsan dizajn (IgorPavelic)
git checkout 19488bd3 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T19:38:00
set GIT_COMMITTER_DATE=2025-10-20T19:38:00
git commit -m "Poboljsan dizajn - promenjena boja headera, dodato 3 nova restorana, ispravljen prikaz kartice"

REM Commit 31 - IgorPavelic
echo [31/36] Dodate slike restorana (IgorPavelic)
git checkout 6f1b5eb4 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T20:03:00
set GIT_COMMITTER_DATE=2025-10-20T20:03:00
git commit -m "Dodate slike restorana"

REM Commit 32 - IgorPavelic
echo [32/36] Promenjen font (IgorPavelic)
git checkout 770d948f -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T20:17:00
set GIT_COMMITTER_DATE=2025-10-20T20:17:00
git commit -m "Promenjen font"

REM Commit 33 - IgorPavelic
echo [33/36] Promena boje headera (IgorPavelic)
git checkout a48fc2aa -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T20:34:00
set GIT_COMMITTER_DATE=2025-10-20T20:34:00
git commit -m "Promena boje headera"

REM Commit 34 - IgorPavelic
echo [34/36] Promena boje login dugmeta (IgorPavelic)
git checkout 7e5d5f36 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T20:57:00
set GIT_COMMITTER_DATE=2025-10-20T20:57:00
git commit -m "Promena boje login dugmeta i prijavi se dugmeta"

REM Commit 35 - IgorPavelic
echo [35/36] Dodata tri restorana (IgorPavelic)
git checkout 8d64abcd -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T21:23:00
set GIT_COMMITTER_DATE=2025-10-20T21:23:00
git commit -m "Dodata tri restorana"

REM Commit 36 - IgorPavelic
echo [36/36] Promenjena ikonica (IgorPavelic)
git checkout f30d75c1 -- .
git add -A
set GIT_AUTHOR_NAME=IgorPavelic
set GIT_AUTHOR_EMAIL=Igorpavelic3@gmail.com
set GIT_COMMITTER_NAME=IgorPavelic
set GIT_COMMITTER_EMAIL=Igorpavelic3@gmail.com
set GIT_AUTHOR_DATE=2025-10-20T21:51:00
set GIT_COMMITTER_DATE=2025-10-20T21:51:00
git commit -m "Promenjena ikonica"

echo.
echo Svi komitovi su kreirani!

