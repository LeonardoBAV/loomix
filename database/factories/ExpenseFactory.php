<?php

namespace Database\Factories;

use App\Models\Expense;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    protected $model = Expense::class;

    public function definition(): array
    {
        return [
            'date' => fake()->date(),
            'cost' => fake()->randomFloat(4, 0, 9999.9999),
        ];
    }
} 