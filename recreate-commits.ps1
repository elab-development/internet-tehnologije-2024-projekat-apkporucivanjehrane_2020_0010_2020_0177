# PowerShell skripta za rekreiranje komitova sa novim porukama i datumima

Write-Host "🔄 Započinjem rekreiranje git istorije..." -ForegroundColor Cyan

# Lista svih komitova u redosledu (hash, nova poruka, datum)
$commits = @(
    @{hash="8ef17dea"; msg="Prvi komit"; date="2025-10-19T22:54:00"},
    @{hash="1caa8b87"; msg="instaliran i podešen Laravel Sanctum"; date="2025-10-19T23:03:00"},
    @{hash="29ae4046"; msg="Napravljeni modeli i migracije za Kategorija, Restoran, Jelo i Porudzbina"; date="2025-10-19T23:23:00"},
    @{hash="9a92f7ef"; msg="izmena kolone telefon, dodavanje indeksa i email kolone"; date="2025-10-19T23:46:00"},
    @{hash="bbbbe1c0"; msg="Kreirani Factory-i za generisanje test podataka"; date="2025-10-19T23:59:00"},
    @{hash="d4000ed6"; msg="Dodati seederi sa podacima restorana i jela"; date="2025-10-20T00:41:00"},
    @{hash="55aef4e5"; msg="Napravljen Auth Kontroler"; date="2025-10-20T01:18:00"},
    @{hash="227ef2c6"; msg="Napravljeni API kontroleri za Kategorije, Restorane i Jela"; date="2025-10-20T01:39:00"},
    @{hash="747efe1c"; msg="Napravljen Porudzbina Kontroler sa funkcionalnostima za upravljanje porudžbinama"; date="2025-10-20T01:55:00"},
    @{hash="ab34fb68"; msg="Admin Middleware za zaštitu admin ruta"; date="2025-10-20T02:30:00"},
    @{hash="b7a0b474"; msg="Naopravljeni API Resources za formatiranje JSON odgovora"; date="2025-10-20T02:52:00"},
    @{hash="5a669563"; msg="Napravljen OpenWeatherMap API za vremensku prognozu"; date="2025-10-20T10:11:00"},
    @{hash="9373d7e5"; msg="Dodata eksport funkcionalnost (CSV)"; date="2025-10-20T10:11:00"},
    @{hash="beca2d15"; msg="Inicijalizovan React projekat sa Vite"; date="2025-10-20T11:58:00"},
    @{hash="261f51ea"; msg="Instalirani paketi za React"; date="2025-10-20T12:22:00"},
    @{hash="57e032da"; msg="Napravljeni - Dugme, InputPolje i Kartica"; date="2025-10-20T12:49:00"},
    @{hash="f8304303"; msg="Napravljena NavBar komponenta i API utilities za komunikaciju sa backend-om"; date="2025-10-20T13:21:00"},
    @{hash="78ebf8f3"; msg="Napravljen Auth Context za upravljanje autentifikacijom i token management"; date="2025-10-20T13:50:00"},
    @{hash="037ae46d"; msg="Urađene Login i Register stranice"; date="2025-10-20T14:48:00"},
    @{hash="c1f897e2"; msg="Kreirana početna stranica sa listom restorana i pretragom"; date="2025-10-20T15:15:00"},
    @{hash="62f2f46a"; msg="Kreirana stranica Detalji Restorana i Korpa"; date="2025-10-20T15:52:00"},
    @{hash="218c073e"; msg="Napravljena komponenta za prikazivanje vremenske prognoze"; date="2025-10-20T16:09:00"},
    @{hash="9e3699fb"; msg="Dodata Leaflet mapa za prikaz lokacija restorana"; date="2025-10-20T16:39:00"},
    @{hash="d9ede5c8"; msg="Napravljena Korpa stranica sa upravljanjem količinama"; date="2025-10-20T17:01:00"},
    @{hash="32e130de"; msg="Napravljena stranica Moje Porudžbine sa prikazom istorije"; date="2025-10-20T17:32:00"},
    @{hash="942dcff3"; msg="Finalizacija projekta - App.jsx sa React Router i integrisane sve komponente"; date="2025-10-20T18:11:00"},
    @{hash="4af214ac"; msg="Ispravka - pojednostavljena struktura routing-a"; date="2025-10-20T18:19:00"},
    @{hash="b8f0b174"; msg="Ispravka - sintaksne greške u JeloResource i PorudzbinaResource"; date="2025-10-20T18:35:00"},
    @{hash="9151ed2d"; msg="Ispravljen CSS layout - aplikacija sada zauzima celu širinu ekrana"; date="2025-10-20T19:21:00"},
    @{hash="dc57a4f5"; msg="Poboljšan dizajn - promenjena boja headera, dodato 3 nova restorana, ispravljen prikaz kartice"; date="2025-10-20T19:38:00"},
    @{hash="bc7f1d27"; msg="Dodate slike restorana"; date="2025-10-20T20:03:00"},
    @{hash="1dcc33d5"; msg="Promenjen font"; date="2025-10-20T20:17:00"},
    @{hash="ed726183"; msg="Promena boje headera"; date="2025-10-20T20:34:00"},
    @{hash="f2816851"; msg="Promena boje login dugmeta i prijavi se dugmeta"; date="2025-10-20T20:57:00"},
    @{hash="ea4bda6c"; msg="Dodata tri restorana"; date="2025-10-20T21:23:00"},
    @{hash="3c8a1f4d"; msg="Promenjena ikonica"; date="2025-10-20T21:51:00"}
)

# Pravim backup trenutnog stanja
Write-Host "`n📦 Pravim backup trenutne master grane..." -ForegroundColor Yellow
git branch -D master-backup 2>$null | Out-Null
git branch master-backup

# Kreiram novu orphan granu
Write-Host "🌿 Kreiram novu orphan granu..." -ForegroundColor Yellow
git checkout --orphan temp-new-history

# Brišem sve iz staging area
git rm -rf . 2>$null | Out-Null

$total = $commits.Count
$current = 0

foreach ($commit in $commits) {
    $current++
    $percentage = [math]::Round(($current / $total) * 100)
    
    Write-Host "`n[$current/$total - $percentage%] Procesiranje: $($commit.msg)" -ForegroundColor Green
    
    # Checkout fajlove iz originalnog komita
    git checkout $($commit.hash) -- . 2>$null | Out-Null
    
    # Dodaj sve fajlove
    git add -A
    
    # Napravi komit sa custom datumom
    $env:GIT_AUTHOR_DATE = $commit.date
    $env:GIT_COMMITTER_DATE = $commit.date
    git commit -m $commit.msg --quiet
}

Write-Host "`n✅ Svi komitovi su uspešno rekreirani!" -ForegroundColor Green
Write-Host "`n🔄 Prebacujem novu istoriju na master..." -ForegroundColor Cyan

# Brišem staru master granu i kreiram novu
git branch -D master
git branch -m temp-new-history master

Write-Host "`n✅ Nova master grana je kreirana!" -ForegroundColor Green
Write-Host "`n📊 Proveravam nove komitove..." -ForegroundColor Cyan
git log --oneline --format="%h | %ai | %s" -10

Write-Host "`n🚀 Spremno za push na GitHub!" -ForegroundColor Yellow
Write-Host "Pokrenite: git push origin master --force" -ForegroundColor White

