<?php

namespace Database\Seeders;

use App\Models\Kategorija;
use App\Models\Restoran;
use App\Models\Jelo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RestoranSeeder extends Seeder
{
    public function run(): void
    {
        // Kreiranje kategorija
        $brzaHrana = Kategorija::create([
            'naziv' => 'Brza hrana',
            'opis' => 'Brza i ukusna hrana za svakodnevne trenutke',
            'slika' => 'https://images.unsplash.com/photo-1561758033-d89a9ad46330?w=300&h=200&fit=crop',
        ]);

        $pizza = Kategorija::create([
            'naziv' => 'Pica',
            'opis' => 'Najbolje pice u gradu',
            'slika' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=300&h=200&fit=crop',
        ]);

        $italijanska = Kategorija::create([
            'naziv' => 'Italijanska kuhinja',
            'opis' => 'Autentična italijanska jela',
            'slika' => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=300&h=200&fit=crop',
        ]);

        $rostilj = Kategorija::create([
            'naziv' => 'Roštilj',
            'opis' => 'Tradicionalni roštilj i mesne specijalitete',
            'slika' => 'https://images.unsplash.com/photo-1555939594-58d7cb561ad1?w=300&h=200&fit=crop',
        ]);

        // Kreiranje restorana
        $restoran1 = Restoran::create([
            'kategorija_id' => $brzaHrana->id,
            'naziv' => 'FastBite',
            'slug' => 'fastbite',
            'opis' => 'Najbolja brza hrana u Beogradu',
            'adresa' => 'Knez Mihailova 25, Beograd',
            'telefon' => '011-1234567',
            'email' => 'info@fastbite.rs',
            'slika' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=400&h=300&fit=crop',
            'cena_dostave' => 250,
            'vreme_dostave' => 25,
            'ocena' => 4.5,
            'aktivan' => true,
        ]);

        $restoran2 = Restoran::create([
            'kategorija_id' => $pizza->id,
            'naziv' => 'Bella Napoli',
            'slug' => 'bella-napoli',
            'opis' => 'Najbolja pica u gradu, pravo iz italijanske peći',
            'adresa' => 'Skadarlija 15, Beograd',
            'telefon' => '011-2345678',
            'email' => 'kontakt@bellanapoli.rs',
            'slika' => 'https://images.unsplash.com/photo-1579751626657-72bc17010498?w=400&h=300&fit=crop',
            'cena_dostave' => 300,
            'vreme_dostave' => 30,
            'ocena' => 4.7,
            'aktivan' => true,
        ]);

        $restoran3 = Restoran::create([
            'kategorija_id' => $rostilj->id,
            'naziv' => 'Roštilj Majstor',
            'slug' => 'rostilj-majstor',
            'opis' => 'Tradicionalni srpski roštilj',
            'adresa' => 'Bulevar kralja Aleksandra 45, Beograd',
            'telefon' => '011-3456789',
            'email' => 'porudzbine@rostiljmajstor.rs',
            'slika' => 'https://images.unsplash.com/photo-1544025162-d76694265947?w=400&h=300&fit=crop',
            'cena_dostave' => 200,
            'vreme_dostave' => 35,
            'ocena' => 4.8,
            'aktivan' => true,
        ]);

        $restoran4 = Restoran::create([
            'kategorija_id' => $italijanska->id,
            'naziv' => 'Pasta Grande',
            'slug' => 'pasta-grande',
            'opis' => 'Domaća pasta i italijanski specijaliteti',
            'adresa' => 'Makedonska 32, Beograd',
            'telefon' => '011-4567890',
            'email' => 'hello@pastagrande.rs',
            'slika' => 'https://images.unsplash.com/photo-1563379926898-05f4575a45d8?w=400&h=300&fit=crop',
            'cena_dostave' => 350,
            'vreme_dostave' => 28,
            'ocena' => 4.6,
            'aktivan' => true,
        ]);

        $azijska = Kategorija::create([
            'naziv' => 'Azijska kuhinja',
            'opis' => 'Autentična azijska jela - sushi, wok, Thai',
            'slika' => 'https://images.unsplash.com/photo-1563612116625-3012372fccce?w=300&h=200&fit=crop',
        ]);

        $desert = Kategorija::create([
            'naziv' => 'Poslastičarnica',
            'opis' => 'Slatke poslastice i deserti',
            'slika' => 'https://images.unsplash.com/photo-1551024506-0bccd828d307?w=300&h=200&fit=crop',
        ]);

        $rostilj2 = Kategorija::create([
            'naziv' => 'Zdravo i organsko',
            'opis' => 'Zdravi obroci, salate i smoothie',
            'slika' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=300&h=200&fit=crop',
        ]);

        // Novi restorani
        $restoran5 = Restoran::create([
            'kategorija_id' => $azijska->id,
            'naziv' => 'Sushi Master',
            'slug' => 'sushi-master',
            'opis' => 'Najbolji sushi u gradu, svež i ukusan',
            'adresa' => 'Terazije 15, Beograd',
            'telefon' => '011-5678901',
            'email' => 'info@sushimaster.rs',
            'slika' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=400&h=300&fit=crop',
            'cena_dostave' => 400,
            'vreme_dostave' => 40,
            'ocena' => 4.9,
            'aktivan' => true,
        ]);

        $restoran6 = Restoran::create([
            'kategorija_id' => $desert->id,
            'naziv' => 'Sweet Dreams',
            'slug' => 'sweet-dreams',
            'opis' => 'Torte, kolači i čokoladni specijaliteti',
            'adresa' => 'Vuka Karadžića 8, Beograd',
            'telefon' => '011-6789012',
            'email' => 'porudzbine@sweetdreams.rs',
            'slika' => 'https://images.unsplash.com/photo-1486427944299-d1955d23e34d?w=400&h=300&fit=crop',
            'cena_dostave' => 200,
            'vreme_dostave' => 20,
            'ocena' => 4.8,
            'aktivan' => true,
        ]);

        $restoran7 = Restoran::create([
            'kategorija_id' => $rostilj2->id,
            'naziv' => 'Green Life',
            'slug' => 'green-life',
            'opis' => 'Zdrave salate, smoothie bowl i organski obroci',
            'adresa' => 'Zmaj Jovina 12, Beograd',
            'telefon' => '011-7890123',
            'email' => 'hello@greenlife.rs',
            'slika' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=400&h=300&fit=crop',
            'cena_dostave' => 250,
            'vreme_dostave' => 25,
            'ocena' => 4.7,
            'aktivan' => true,
        ]);

        // Dodavanje jela za FastBite
        Jelo::create([
            'restoran_id' => $restoran1->id,
            'naziv' => 'Big Burger',
            'opis' => 'Veliki burger sa mesom, sirom i povrćem',
            'cena' => 550,
            'slika' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran1->id,
            'naziv' => 'Pomfrit',
            'opis' => 'Hrskav pomfrit',
            'cena' => 200,
            'slika' => 'https://images.unsplash.com/photo-1573080496219-bb080dd4f877?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Prilog',
        ]);

        // Dodavanje jela za Bella Napoli
        Jelo::create([
            'restoran_id' => $restoran2->id,
            'naziv' => 'Pizza Margherita',
            'opis' => 'Klasična pizza sa paradajzom, mocarelom i bosiljkom',
            'cena' => 850,
            'slika' => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran2->id,
            'naziv' => 'Pizza Quattro Formaggi',
            'opis' => 'Pizza sa četiri vrste sira',
            'cena' => 950,
            'slika' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        // Dodavanje jela za Roštilj Majstor
        Jelo::create([
            'restoran_id' => $restoran3->id,
            'naziv' => 'Ćevapi (10kom)',
            'opis' => 'Tradicionalni ćevapi sa lepinjom i lukom',
            'cena' => 450,
            'slika' => 'https://images.unsplash.com/photo-1607330289024-8768f379d61b?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran3->id,
            'naziv' => 'Pljeskavica',
            'opis' => 'Velika pljeskavica sa kajmakom',
            'cena' => 520,
            'slika' => 'https://images.unsplash.com/photo-1619740455993-8dabb6c8e7d7?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        // Dodavanje jela za Pasta Grande
        Jelo::create([
            'restoran_id' => $restoran4->id,
            'naziv' => 'Carbonara',
            'opis' => 'Pasta sa slaninom, jajima i parmezanom',
            'cena' => 750,
            'slika' => 'https://images.unsplash.com/photo-1612874742237-6526221588e3?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran4->id,
            'naziv' => 'Lasagna',
            'opis' => 'Domaća lazanja sa mesom i bešamel sosom',
            'cena' => 820,
            'slika' => 'https://images.unsplash.com/photo-1574894709920-11b28e7367e3?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        // Dodavanje jela za Sushi Master
        Jelo::create([
            'restoran_id' => $restoran5->id,
            'naziv' => 'California Roll',
            'opis' => 'Sushi rolna sa lososom i avokadom',
            'cena' => 950,
            'slika' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran5->id,
            'naziv' => 'Miso Supa',
            'opis' => 'Tradicionalna japanska supa',
            'cena' => 350,
            'slika' => 'https://images.unsplash.com/photo-1606491956689-2ea866880c84?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Predjelo',
        ]);

        // Dodavanje jela za Sweet Dreams
        Jelo::create([
            'restoran_id' => $restoran6->id,
            'naziv' => 'Čokoladna Torta',
            'opis' => 'Bogata čokoladna torta sa višnjama',
            'cena' => 450,
            'slika' => 'https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Desert',
        ]);

        Jelo::create([
            'restoran_id' => $restoran6->id,
            'naziv' => 'Tiramisu',
            'opis' => 'Klasični italijanski desert',
            'cena' => 380,
            'slika' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Desert',
        ]);

        // Dodavanje jela za Green Life
        Jelo::create([
            'restoran_id' => $restoran7->id,
            'naziv' => 'Caesar Salata',
            'opis' => 'Svež zeleni salat sa piletinom i parmezanom',
            'cena' => 550,
            'slika' => 'https://images.unsplash.com/photo-1546793665-c74683f339c1?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran7->id,
            'naziv' => 'Acai Bowl',
            'opis' => 'Smoothie bowl sa voćem i granolom',
            'cena' => 480,
            'slika' => 'https://images.unsplash.com/photo-1590301157890-4810ed352733?w=300&h=200&fit=crop',
            'dostupno' => true,
            'kategorija_jela' => 'Desert',
        ]);
    }
}
