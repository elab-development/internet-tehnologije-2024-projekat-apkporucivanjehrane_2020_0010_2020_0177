<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\ProizvodNaMeniju;
use App\Models\Restoran;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kreiranje admin korisnika
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@dostava.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
        ]);

        // Kreiranje test korisnika
        User::factory()->create([
            'name' => 'Petar Petrović',
            'email' => 'petar@test.com',
            'password' => Hash::make('password123'),
        ]);

        // Kreiranje običnih korisnika
        User::factory(10)->create();

        // Kreiranje kategorija (bez duplikata)
        $kategorije = [
            ['name' => 'Pica', 'slug' => 'pica', 'description' => 'Pizzerije i italijanska hrana'],
            ['name' => 'Roštilj', 'slug' => 'rostilj', 'description' => 'Roštilj i meso sa roštilja'],
            ['name' => 'Burger', 'slug' => 'burger', 'description' => 'Burgeri i fast food'],
            ['name' => 'Azijska kuhinja', 'slug' => 'azijska-kuhinja', 'description' => 'Suši, wok, kineski restoran'],
            ['name' => 'Zdrava hrana', 'slug' => 'zdrava-hrana', 'description' => 'Zdrava hrana, salate i smoothie'],
            ['name' => 'Deserti', 'slug' => 'deserti', 'description' => 'Slatkiši, kolači i deserti'],
        ];

        foreach ($kategorije as $kategorija) {
            Category::create($kategorija);
        }

        // Kreiranje restorana za svaku kategoriju
        Category::all()->each(function ($kategorija) {
            Restoran::factory(3)->create([
                'category_id' => $kategorija->id,
            ])->each(function ($restoran) {
                // Za svaki restoran, kreiranje 5-10 proizvoda
                ProizvodNaMeniju::factory(rand(5, 10))->create([
                    'restoran_id' => $restoran->id,
                ]);
            });
        });
        
        // Dodavanje realnih restorana sa pravim podacima
        $this->call(RealniRestoranSeeder::class);
    }
}
