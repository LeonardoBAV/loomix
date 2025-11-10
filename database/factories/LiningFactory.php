<?php

namespace Database\Factories;

use App\Models\Lining;
use Illuminate\Database\Eloquent\Factories\Factory;

class LiningFactory extends Factory
{
    protected $model = Lining::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'code' => fake()->unique()->regexify('[A-Z]{2}[0-9]{4}'),
            'price' => fake()->randomFloat(2, 0.1, 1000),
        ];
    }
}
