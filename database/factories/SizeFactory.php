<?php

namespace Database\Factories;

use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class SizeFactory extends Factory
{
    protected $model = Size::class;

    public function definition(): array
    {
        return [
            'title' => fake()->randomElement(['P', 'M', 'G', 'GG', 'XG', 'PP']),
            'alias' => fake()->randomElement(['Pequeno', 'Médio', 'Grande', 'Extra Grande', 'Extra Pequeno']),
        ];
    }
}
