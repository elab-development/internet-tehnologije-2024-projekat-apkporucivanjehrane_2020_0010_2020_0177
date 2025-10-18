<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Restoran;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restoran>
 */
class RestoranFactory extends Factory
{
    protected $model = Restoran::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $restorani = [
            ['name' => 'Mala Fabrika Ukusa', 'address' => 'Kraljevića Marka 6, Beograd'],
            ['name' => 'Tri Šešira', 'address' => 'Skadarska 29, Beograd'],
            ['name' => 'Dva Jelena', 'address' => 'Skadarska 32, Beograd'],
            ['name' => 'Smokvica', 'address' => 'Brace Jugovića 8, Beograd'],
            ['name' => 'Šaran', 'address' => 'Skadarska 21, Beograd'],
            ['name' => 'Kod Goce', 'address' => 'Svetogorska 34, Beograd'],
            ['name' => 'Restoran Beograd', 'address' => 'Knez Mihailova 42, Beograd'],
            ['name' => 'Skadarlija', 'address' => 'Skadarska 15, Beograd'],
            ['name' => 'Gradska Kafana', 'address' => 'Kralja Petra 27, Beograd'],
            ['name' => 'Zlatni Bokal', 'address' => 'Vuka Karadžića 12, Beograd'],
            ['name' => 'Salon 1905', 'address' => 'Karađorđeva 2-4, Beograd'],
            ['name' => 'Ambar', 'address' => 'Karađorđeva 2-4, Beograd'],
            ['name' => 'Mažestik', 'address' => 'Obilicev Venac 28, Beograd'],
            ['name' => 'Franš', 'address' => 'Kralja Petra 11, Beograd'],
            ['name' => 'Mali Princ', 'address' => 'Kneza Sime Markovića 13, Beograd'],
            ['name' => 'Kafana Stara Ada', 'address' => 'Bulevar Nikole Tesle 3, Beograd'],
            ['name' => 'Pečenjara Željko', 'address' => 'Takovska 45, Beograd'],
            ['name' => 'Atelje 212', 'address' => 'Svetogorska 21, Beograd'],
            ['name' => 'Gostiona Sava', 'address' => 'Karađorđeva 50, Beograd'],
            ['name' => 'Konoba Akustik', 'address' => 'Skadarska 44, Beograd'],
        ];
        
        $odabranRestoran = fake()->unique()->randomElement($restorani);
        
        // Slike restorana (fiksne URL-ove možete zameniti sa bilo kojim drugim)
        $slikeRestorana = [
            'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=400',
            'https://images.unsplash.com/photo-1555396273-367ea4eb4db5?w=400',
            'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=400',
            'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=400',
            'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=400',
            'https://images.unsplash.com/photo-1578474846511-04ba529f0b88?w=400',
        ];
        
        return [
            'category_id' => Category::factory(),
            'name' => $odabranRestoran['name'],
            'slug' => \Illuminate\Support\Str::slug($odabranRestoran['name']),
            'description' => 'Domaća kuhinja i tradicionalni recepti. ' . fake()->sentence(6),
            'address' => $odabranRestoran['address'],
            'phone' => '+381 ' . fake()->numerify('## ### ####'),
            'image' => fake()->randomElement($slikeRestorana),
            'delivery_price' => fake()->randomFloat(2, 100, 350),
            'delivery_time' => fake()->numberBetween(20, 60),
            'is_active' => fake()->boolean(90),
        ];
    }
}
