<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Cutter;
use App\Models\Product;
use App\Models\Production;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Production>
 */
class ProductionFactory extends Factory
{
    protected $model = Production::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startDate = fake()->dateTimeBetween('-30 days', 'now');

        return [
            'product_id' => Product::factory(),
            'cutter_id' => Cutter::factory(),
            'client_id' => Client::factory(),
            'date_started' => $startDate,
            'date_cutting' => fake()->dateTimeBetween($startDate, '+7 days'),
            'date_sewing' => fake()->dateTimeBetween($startDate, '+14 days'),
            'date_finishing' => fake()->dateTimeBetween($startDate, '+21 days'),
            'date_completed' => fake()->dateTimeBetween($startDate, '+30 days'),
        ];
    }
}
