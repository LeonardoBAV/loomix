<?php

namespace Database\Factories;

use App\Models\Trim;
use Illuminate\Database\Eloquent\Factories\Factory;

class TrimFactory extends Factory
{
    protected $model = Trim::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'code' => fake()->unique()->regexify('[A-Z]{2}[0-9]{4}'),
            'price' => fake()->randomFloat(2, 0.1, 1000),
            'unit' => fake()->randomElement(Trim::UNITS),
        ];
    }
} 