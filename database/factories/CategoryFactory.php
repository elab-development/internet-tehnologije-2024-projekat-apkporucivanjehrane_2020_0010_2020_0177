<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = [
            ['name' => 'Pizza', 'description' => 'Pizzerije i italijanska hrana'],
            ['name' => 'Burger', 'description' => 'Burgeri i fast food'],
            ['name' => 'Asian', 'description' => 'Azijska kuhinja - sushi, wok, kineski restoran'],
            ['name' => 'Grill', 'description' => 'Roštilj i meso'],
            ['name' => 'Healthy', 'description' => 'Zdrava hrana i salate'],
            ['name' => 'Dessert', 'description' => 'Slatkiši i deserti'],
        ];
        
        $category = fake()->randomElement($categories);
        
        return [
            'name' => $category['name'],
            'slug' => \Illuminate\Support\Str::slug($category['name']),
            'description' => $category['description'],
        ];
    }
}
