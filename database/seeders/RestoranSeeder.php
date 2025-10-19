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
    }
}
