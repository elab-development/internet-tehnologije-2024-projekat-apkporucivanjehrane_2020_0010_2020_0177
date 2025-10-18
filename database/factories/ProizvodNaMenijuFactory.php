<?php

namespace Database\Factories;

use App\Models\Restoran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProizvodNaMeniju>
 */
class ProizvodNaMenijuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $foods = [
            'Pljeskavica sa kajmakom', 'Ćevapi u lepinji', 'Ražnjići od svinjetine', 'Belo meso u sosu',
            'Karađorđeva šnicla', 'Bečka šnicla', 'Punjena vesalica', 'Rolovana pljeskavica',
            'Srpska salata', 'Šopska salata', 'Grčka salata', 'Cezar salata',
            'Margarita pica', 'Kapričoza', 'Quattro Formaggi', 'Pepperoni pica',
            'Burger sa sirom', 'BBQ burger', 'Piletina burger', 'Veggie burger',
            'Suši set', 'California roll', 'Tempura', 'Wok piletina',
            'Palačinke sa nutelom', 'Tiramisu', 'Krempita', 'Sladoled'
        ];
        
        return [
            'restoran_id' => Restoran::factory(),
            'name' => fake()->randomElement($foods),
            'description' => 'Ukusno i sveže pripremljeno. ' . fake()->sentence(5),
            'price' => fake()->randomFloat(2, 350, 1800),
            'image' => null,
            'is_available' => fake()->boolean(85),
        ];
    }
}
