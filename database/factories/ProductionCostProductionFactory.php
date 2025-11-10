<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductionCost;
use App\Models\ProductionCostProduction;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionCostProductionFactory extends Factory
{
    protected $model = ProductionCostProduction::class;

    public function definition(): array
    {
        return [
            'production_cost_id' => ProductionCost::factory(),
            'product_id' => Product::factory(),
            'count' => fake()->numberBetween(1, 100),
            'cost' => fake()->randomFloat(4, 0, 9999.9999),
        ];
    }
}
