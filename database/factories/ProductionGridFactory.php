<?php

namespace Database\Factories;

use App\Models\Production;
use App\Models\ProductionGrid;
use App\Models\Size;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductionGridFactory extends Factory
{
    protected $model = ProductionGrid::class;

    public function definition(): array
    {
        return [
            'production_id' => Production::factory(),
            'size_id' => Size::factory(),
            'qty' => fake()->numberBetween(10, 100),
        ];
    }
}
