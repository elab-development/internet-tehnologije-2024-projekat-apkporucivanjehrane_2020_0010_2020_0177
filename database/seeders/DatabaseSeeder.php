<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Kreiranje admin korisnika
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@dostava.rs',
            'is_admin' => true,
            'password' => bcrypt('password123'),
        ]);

        // Kreiranje običnog korisnika
        User::factory()->create([
            'name' => 'Mateja Veličkov',
            'email' => 'mateja@example.com',
            'is_admin' => false,
            'password' => bcrypt('mv12345'),
        ]);

        // Poziv RestoranSeeder-a
        $this->call([
            RestoranSeeder::class,
        ]);
    }
}
