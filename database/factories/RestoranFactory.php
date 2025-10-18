<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restoran>
 */
class RestoranFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $restorani = [
            'Mala Fabrika Ukusa', 'Tri Šešira', 'Dva Jelena', 'Smokvica', 'Šaran',
            'Kod Goce', 'Pečenjara Željko', 'Restoran Beograd', 'Kafana Stara Ada',
            'Skadarlija', 'Gradska Kafana', 'Kod Mira', 'Zlatni Bokal',
            'Atelje 212', 'Restoran Savski Venac', 'Gostiona Sava', 'Konoba Akustik',
            'Mažestik', 'Franš', 'Salon 1905', 'Ambar', 'Mali Princ',
        ];
        
        $name = fake()->unique()->randomElement($restorani);
        
        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => \Illuminate\Support\Str::slug($name),
            'description' => 'Domaća kuhinja i tradicionalni recepti. ' . fake()->sentence(6),
            'address' => fake()->streetAddress() . ', Beograd',
            'phone' => '+381 ' . fake()->numerify('## ### ####'),
            'image' => null,
            'delivery_price' => fake()->randomFloat(2, 100, 350),
            'delivery_time' => fake()->numberBetween(20, 60),
            'is_active' => fake()->boolean(90),
        ];
    }
}
