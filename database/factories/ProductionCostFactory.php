<?php

namespace Database\Factories;

use App\Models\ProductionCost;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionCostFactory extends Factory
{
    protected $model = ProductionCost::class;

    public function definition(): array
    {
        return [
            'title' => fake()->unique()->words(3, true),
            'default' => fake()->boolean(20), // 20% chance of being default
        ];
    }
}
