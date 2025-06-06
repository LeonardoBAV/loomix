<?php

namespace Database\Seeders;

use App\Models\Expense;
use App\Models\ExpenseItem;
use Illuminate\Database\Seeder;

class ExpenseSeeder extends Seeder
{
    public function run(): void
    {
        Expense::factory()
            ->count(10)
            ->has(
                ExpenseItem::factory()
                    ->count(3)
            )
            ->create();
    }
} 