<?php

namespace Database\Factories;

use App\Models\Fabric;
use App\Models\Shape;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FabricShape>
 */
class FabricShapeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'fabric_id' => Fabric::factory(),
            'shape_id' => Shape::factory(),
            'usage' => fake()->numberBetween(1, 10),
            'cost' => fake()->randomFloat(4, 1, 100),
            'image' => fake()->imageUrl(),
            'sample' => fake()->boolean(),
        ];
    }
}
