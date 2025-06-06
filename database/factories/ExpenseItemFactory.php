<?php

namespace Database\Factories;

use App\Models\Expense;
use App\Models\ExpenseItem;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseItemFactory extends Factory
{
    protected $model = ExpenseItem::class;

    public function definition(): array
    {
        return [
            'expense_id' => Expense::factory(),
            'description' => fake()->sentence(),
            'cost' => fake()->randomFloat(4, 0, 9999.9999),
        ];
    }
} 