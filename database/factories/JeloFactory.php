<?php

namespace Database\Factories;

use App\Models\Jelo;
use App\Models\Restoran;
use Illuminate\Database\Eloquent\Factories\Factory;

class JeloFactory extends Factory
{
    protected $model = Jelo::class;

    public function definition(): array
    {
        $jela = [
            'Pljeskavica', 'Ćevapi', 'Piletina', 'Pizza Margarita', 'Carbonara',
            'Tortilje', 'Burger', 'Hot dog', 'Sushi', 'Pad Thai',
            'Caesar salata', 'Šopska salata', 'Tiramisu', 'Panna cotta', 'Coca Cola'
        ];

        $kategorije = ['Glavno jelo', 'Prilog', 'Desert', 'Piće', 'Predjelo'];

        return [
            'restoran_id' => Restoran::factory(),
            'naziv' => fake()->randomElement($jela) . ' ' . fake()->numberBetween(1, 100),
            'opis' => fake()->sentence(),
            'cena' => fake()->randomFloat(2, 300, 2000),
            'slika' => 'https://via.placeholder.com/300x200',
            'dostupno' => fake()->boolean(85),
            'kategorija_jela' => fake()->randomElement($kategorije),
        ];
    }
}
