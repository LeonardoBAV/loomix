<?php

namespace Database\Factories;

use App\Models\Cutter;
use Illuminate\Database\Eloquent\Factories\Factory;

class CutterFactory extends Factory
{
    protected $model = Cutter::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
        ];
    }
}
