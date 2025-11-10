<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Production;
use App\Models\ProductionItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductionItem>
 */
class ProductionItemFactory extends Factory
{
    protected $model = ProductionItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'production_id' => Production::factory(),
            'product_id' => Product::factory(),
            'count' => $this->faker->numberBetween(1, 500),
        ];
    }
}
