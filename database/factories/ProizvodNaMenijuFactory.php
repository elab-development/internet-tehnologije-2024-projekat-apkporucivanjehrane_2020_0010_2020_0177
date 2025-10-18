<?php

namespace Database\Factories;

use App\Models\ProizvodNaMeniju;
use App\Models\Restoran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProizvodNaMeniju>
 */
class ProizvodNaMenijuFactory extends Factory
{
    protected $model = ProizvodNaMeniju::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $foods = [
            ['name' => 'Pljeskavica sa kajmakom', 'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300'],
            ['name' => 'Ćevapi u lepinji', 'image' => 'https://images.unsplash.com/photo-1529042410759-befb1204b468?w=300'],
            ['name' => 'Ražnjići od svinjetine', 'image' => 'https://images.unsplash.com/photo-1633237308525-cd587cf71926?w=300'],
            ['name' => 'Karađorđeva šnicla', 'image' => 'https://images.unsplash.com/photo-1432139555190-58524dae6a55?w=300'],
            ['name' => 'Bečka šnicla', 'image' => 'https://images.unsplash.com/photo-1432139555190-58524dae6a55?w=300'],
            ['name' => 'Srpska salata', 'image' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=300'],
            ['name' => 'Šopska salata', 'image' => 'https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?w=300'],
            ['name' => 'Grčka salata', 'image' => 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=300'],
            ['name' => 'Margarita pica', 'image' => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=300'],
            ['name' => 'Kapirćoza', 'image' => 'https://images.unsplash.com/photo-1571997478779-2adcbbe9ab2f?w=300'],
            ['name' => 'Quattro Formaggi', 'image' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?w=300'],
            ['name' => 'Pepperoni pica', 'image' => 'https://images.unsplash.com/photo-1628840042765-356cda07504e?w=300'],
            ['name' => 'Burger sa sirom', 'image' => 'https://images.unsplash.com/photo-1568901346375-23c9450c58cd?w=300'],
            ['name' => 'BBQ burger', 'image' => 'https://images.unsplash.com/photo-1550547660-d9450f859349?w=300'],
            ['name' => 'Piletina burger', 'image' => 'https://images.unsplash.com/photo-1586190848861-99aa4a171e90?w=300'],
            ['name' => 'Suši set', 'image' => 'https://images.unsplash.com/photo-1579584425555-c3ce17fd4351?w=300'],
            ['name' => 'California roll', 'image' => 'https://images.unsplash.com/photo-1564489563601-c53cfc451e93?w=300'],
            ['name' => 'Wok piletina', 'image' => 'https://images.unsplash.com/photo-1585032226651-759b368d7246?w=300'],
            ['name' => 'Palačinke sa nutelom', 'image' => 'https://images.unsplash.com/photo-1593560704563-f176a2eb61db?w=300'],
            ['name' => 'Tiramisu', 'image' => 'https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=300'],
            ['name' => 'Krempita', 'image' => 'https://images.unsplash.com/photo-1464349095431-e9a21285b5f3?w=300'],
            ['name' => 'Sladoled', 'image' => 'https://images.unsplash.com/photo-1563805042-7684c019e1cb?w=300'],
        ];
        
        $odabranoJelo = fake()->randomElement($foods);
        
        return [
            'restoran_id' => Restoran::factory(),
            'name' => $odabranoJelo['name'],
            'description' => 'Ukusno i sveže pripremljeno. ' . fake()->sentence(5),
            'price' => fake()->randomFloat(2, 350, 1800),
            'image' => $odabranoJelo['image'],
            'is_available' => fake()->boolean(85),
        ];
    }
}
