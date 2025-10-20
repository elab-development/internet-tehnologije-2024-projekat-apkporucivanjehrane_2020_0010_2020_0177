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
            'slika' => 'https://via.placeholder.com/300x200?text=Brza+Hrana',
        ]);

        $pizza = Kategorija::create([
            'naziv' => 'Pica',
            'opis' => 'Najbolje pice u gradu',
            'slika' => 'https://via.placeholder.com/300x200?text=Pizza',
        ]);

        $italijanska = Kategorija::create([
            'naziv' => 'Italijanska kuhinja',
            'opis' => 'Autentična italijanska jela',
            'slika' => 'https://via.placeholder.com/300x200?text=Italiano',
        ]);

        $rostilj = Kategorija::create([
            'naziv' => 'Roštilj',
            'opis' => 'Tradicionalni roštilj i mesne specijalitete',
            'slika' => 'https://via.placeholder.com/300x200?text=Rostilj',
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
            'cena_dostave' => 350,
            'vreme_dostave' => 28,
            'ocena' => 4.6,
            'aktivan' => true,
        ]);

        $azijska = Kategorija::create([
            'naziv' => 'Azijska kuhinja',
            'opis' => 'Autentična azijska jela - sushi, wok, Thai',
            'slika' => 'https://via.placeholder.com/300x200?text=Asian',
        ]);

        $desert = Kategorija::create([
            'naziv' => 'Poslastičarnica',
            'opis' => 'Slatke poslastice i deserti',
            'slika' => 'https://via.placeholder.com/300x200?text=Desert',
        ]);

        $rostilj2 = Kategorija::create([
            'naziv' => 'Zdravo i organsko',
            'opis' => 'Zdravi obroci, salate i smoothie',
            'slika' => 'https://via.placeholder.com/300x200?text=Healthy',
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
            'slika' => 'https://via.placeholder.com/300x200?text=Burger',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran1->id,
            'naziv' => 'Pomfrit',
            'opis' => 'Hrskav pomfrit',
            'cena' => 200,
            'slika' => 'https://via.placeholder.com/300x200?text=Pomfrit',
            'dostupno' => true,
            'kategorija_jela' => 'Prilog',
        ]);

        // Dodavanje jela za Bella Napoli
        Jelo::create([
            'restoran_id' => $restoran2->id,
            'naziv' => 'Pizza Margherita',
            'opis' => 'Klasična pizza sa paradajzom, mocarelom i bosiljkom',
            'cena' => 850,
            'slika' => 'https://via.placeholder.com/300x200?text=Margherita',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran2->id,
            'naziv' => 'Pizza Quattro Formaggi',
            'opis' => 'Pizza sa četiri vrste sira',
            'cena' => 950,
            'slika' => 'https://via.placeholder.com/300x200?text=4+Formaggi',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        // Dodavanje jela za Roštilj Majstor
        Jelo::create([
            'restoran_id' => $restoran3->id,
            'naziv' => 'Ćevapi (10kom)',
            'opis' => 'Tradicionalni ćevapi sa lepinjom i lukom',
            'cena' => 450,
            'slika' => 'https://via.placeholder.com/300x200?text=Cevapi',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran3->id,
            'naziv' => 'Pljeskavica',
            'opis' => 'Velika pljeskavica sa kajmakom',
            'cena' => 520,
            'slika' => 'https://via.placeholder.com/300x200?text=Pljeskavica',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        // Dodavanje jela za Pasta Grande
        Jelo::create([
            'restoran_id' => $restoran4->id,
            'naziv' => 'Carbonara',
            'opis' => 'Pasta sa slaninom, jajima i parmezanom',
            'cena' => 750,
            'slika' => 'https://via.placeholder.com/300x200?text=Carbonara',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran4->id,
            'naziv' => 'Lasagna',
            'opis' => 'Domaća lazanja sa mesom i bešamel sosom',
            'cena' => 820,
            'slika' => 'https://via.placeholder.com/300x200?text=Lasagna',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        // Dodavanje jela za Sushi Master
        Jelo::create([
            'restoran_id' => $restoran5->id,
            'naziv' => 'California Roll',
            'opis' => 'Sushi rolna sa lososom i avokadom',
            'cena' => 950,
            'slika' => 'https://via.placeholder.com/300x200?text=California+Roll',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran5->id,
            'naziv' => 'Miso Supa',
            'opis' => 'Tradicionalna japanska supa',
            'cena' => 350,
            'slika' => 'https://via.placeholder.com/300x200?text=Miso',
            'dostupno' => true,
            'kategorija_jela' => 'Predjelo',
        ]);

        // Dodavanje jela za Sweet Dreams
        Jelo::create([
            'restoran_id' => $restoran6->id,
            'naziv' => 'Čokoladna Torta',
            'opis' => 'Bogata čokoladna torta sa višnjama',
            'cena' => 450,
            'slika' => 'https://via.placeholder.com/300x200?text=Chocolate+Cake',
            'dostupno' => true,
            'kategorija_jela' => 'Desert',
        ]);

        Jelo::create([
            'restoran_id' => $restoran6->id,
            'naziv' => 'Tiramisu',
            'opis' => 'Klasični italijanski desert',
            'cena' => 380,
            'slika' => 'https://via.placeholder.com/300x200?text=Tiramisu',
            'dostupno' => true,
            'kategorija_jela' => 'Desert',
        ]);

        // Dodavanje jela za Green Life
        Jelo::create([
            'restoran_id' => $restoran7->id,
            'naziv' => 'Caesar Salata',
            'opis' => 'Svež zeleni salat sa piletinom i parmezanom',
            'cena' => 550,
            'slika' => 'https://via.placeholder.com/300x200?text=Caesar',
            'dostupno' => true,
            'kategorija_jela' => 'Glavno jelo',
        ]);

        Jelo::create([
            'restoran_id' => $restoran7->id,
            'naziv' => 'Acai Bowl',
            'opis' => 'Smoothie bowl sa voćem i granolom',
            'cena' => 480,
            'slika' => 'https://via.placeholder.com/300x200?text=Acai+Bowl',
            'dostupno' => true,
            'kategorija_jela' => 'Desert',
        ]);
    }
}
