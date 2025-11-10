<?php

namespace Database\Seeders;

use App\Models\ProductionCost;
use App\Models\ProductionCostExpense;
use App\Models\ProductionCostProduction;
use Illuminate\Database\Seeder;

class ProductionCostSeeder extends Seeder
{
    public function run(): void
    {
        ProductionCost::factory()
            ->count(5)
            ->has(
                ProductionCostExpense::factory()
                    ->count(3)
            )
            ->has(
                ProductionCostProduction::factory()
                    ->count(2)
            )
            ->create();
    }
}
