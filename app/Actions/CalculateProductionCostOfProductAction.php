<?php

namespace App\Actions;

use App\Models\Product;
use App\Models\ProductionCost;
use App\Models\ProductionCostProduction;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class CalculateProductionCostOfProductAction
{


    public function execute(ProductionCostProduction $production_cost_production): float
    {
        $expense = $production_cost_production->productionCost->expense;
        
        $total_production_weight = $this->calculateTotalProductionWeight($production_cost_production);
        $current_production_weight = $this->calculatePercentageWeight($production_cost_production);
        $percentage_weight = $this->calculatePercentageExpense($total_production_weight, $current_production_weight);

        $current_expense = ($percentage_weight * $expense) / 100;

        return $current_expense/$production_cost_production->count;
    }

    private function calculateTotalProductionWeight(ProductionCostProduction $production_cost_production): float
    {
        $production_cost = $production_cost_production->productionCost;
        $production_cost_productions = $production_cost->productionCostProductions()->with('product')->get();
        
        $total_production_weight = $production_cost_productions->sum(function (ProductionCostProduction $production_cost_production) {
            return $this->calculatePercentageWeight($production_cost_production);
        });

        //if(!$production_cost_production->exists) {
        //    $total_production_weight += $this->calculatePercentageWeight($production_cost_production);
        //}

        return $total_production_weight;
    }

    private function calculatePercentageWeight(ProductionCostProduction $production_cost_production): float
    {
        return $production_cost_production->product->production_weight * $production_cost_production->count;
    }

    private function calculatePercentageExpense(float $total_production_weight, float $current_production_weight): float
    {
        return ($current_production_weight*100) / $total_production_weight;
    }
}