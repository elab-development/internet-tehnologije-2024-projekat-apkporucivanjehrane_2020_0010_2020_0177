<?php

namespace Database\Factories;

use App\Models\Porudzbina;
use App\Models\User;
use App\Models\Restoran;
use Illuminate\Database\Eloquent\Factories\Factory;

class PorudzbinaFactory extends Factory
{
    protected $model = Porudzbina::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'restoran_id' => Restoran::factory(),
            'ime_kupca' => fake()->name(),
            'email_kupca' => fake()->safeEmail(),
            'telefon_kupca' => fake()->phoneNumber(),
            'adresa_dostave' => fake()->address(),
            'ukupna_cena' => fake()->randomFloat(2, 500, 5000),
            'status' => fake()->randomElement(['nova', 'u_pripremi', 'na_putu', 'dostavljena', 'otkazana']),
            'napomena' => fake()->optional()->sentence(),
        ];
    }
}
