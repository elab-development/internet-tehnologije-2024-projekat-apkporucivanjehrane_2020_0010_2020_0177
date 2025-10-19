<?php

namespace Database\Factories;

use App\Models\Kategorija;
use Illuminate\Database\Eloquent\Factories\Factory;

class KategorijaFactory extends Factory
{
    protected $model = Kategorija::class;

    public function definition(): array
    {
        $kategorije = ['Brza hrana', 'Italiano', 'Azijska kuhinja', 'Pica', 'Roštilj', 'Salate', 'Desert', 'Piće'];
        
        return [
            'naziv' => fake()->unique()->randomElement($kategorije),
            'opis' => fake()->sentence(10),
            'slika' => 'https://via.placeholder.com/300x200',
        ];
    }
}
