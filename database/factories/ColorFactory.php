<?php

namespace Database\Factories;

use App\Models\Color;
use Illuminate\Database\Eloquent\Factories\Factory;

class ColorFactory extends Factory
{
    protected $model = Color::class;

    public function definition(): array
    {
        return [
            'title' => fake()->randomElement(['Azul', 'Vermelho', 'Preto', 'Branco', 'Verde', 'Amarelo', 'Rosa', 'Cinza']),
            'alias' => fake()->randomElement(['BLU', 'RED', 'BLK', 'WHT', 'GRN', 'YEL', 'PNK', 'GRY']),
        ];
    }
}
