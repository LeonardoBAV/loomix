<?php

namespace Database\Factories;

use App\Models\ProductionCost;
use App\Models\ProductionCostExpense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionCostExpenseFactory extends Factory
{
    protected $model = ProductionCostExpense::class;

    public function definition(): array
    {
        return [
            'production_cost_id' => ProductionCost::factory(),
            'title' => fake()->words(2, true),
            'value' => fake()->randomFloat(4, 0, 9999.9999),
        ];
    }
} 