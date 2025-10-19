<?php

namespace Database\Factories;

use App\Models\Restoran;
use App\Models\Kategorija;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RestoranFactory extends Factory
{
    protected $model = Restoran::class;

    public function definition(): array
    {
        $naziv = fake()->company() . ' ' . fake()->randomElement(['Restoran', 'Grill', 'Kitchen', 'Food']);
        
        return [
            'kategorija_id' => Kategorija::factory(),
            'naziv' => $naziv,
            'slug' => Str::slug($naziv) . '-' . fake()->unique()->numberBetween(1, 1000),
            'opis' => fake()->paragraph(),
            'adresa' => fake()->address(),
            'telefon' => fake()->phoneNumber(),
            'email' => fake()->unique()->safeEmail(),
            'slika' => 'https://via.placeholder.com/400x300',
            'cena_dostave' => fake()->randomFloat(2, 0, 500),
            'vreme_dostave' => fake()->numberBetween(15, 60),
            'ocena' => fake()->randomFloat(2, 3.0, 5.0),
            'aktivan' => fake()->boolean(90),
        ];
    }
}
