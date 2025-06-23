<?php

namespace App\Actions;

use App\Models\Expense;
use App\Models\Product;
use App\Models\Production;
use Illuminate\Database\Eloquent\Collection;
use Spatie\Browsershot\Browsershot;
use Illuminate\Support\Facades\Storage;

class CalculateMonthCostsAction
{


    public function execute(Production $production, Collection $expenses): array
    {
        $expense = $expenses->first(fn ($expense) => $expense->date->format('m/Y') == $production->date->format('m/Y'));

        $expense_monthly = $expense ? $expense->cost : 0;
        $material_cost = $this->getMaterialCost($production);
        $tax_cost = $this->getTaxCost($production);
        $total_cost = $material_cost + $expense_monthly;

        return [
            'expense_monthly' => $expense_monthly,
            'material_cost' => $material_cost,
            'total_cost' => $total_cost,
        ];
    }

    private function getMaterialCost(Production $production): string
    {
        return $production->productionItems->sum(function ($production_item) {
            return $production_item->product->total_sample_cost * $production_item->count;
        });
    }

    private function getTaxCost(Production $production): string
    {
        return $production->productionItems->sum(function ($production_item) {
            return $production_item->product->total_sample_cost * $production_item->count;
        });
    }

    private function getProductionCost(): float
    {
        $production_item = ProductionItem::getLatestProductionItemInProductionFromProduct($this->record);

        if (is_null($production_item)) {
            return 0;
        }

        $pontuation_product = $production_item->count * $this->record->production_weight;
        
        $pontuation_total = $production_item->production->getTotalPontuation();
        
        $percentage = ($pontuation_product * 100) / $pontuation_total;
        $cost = ($this->getExpense($production_item->production->date)*$percentage)/100;
        
        return $cost/$production_item->count;
    }

    private function getExpense(Carbon $date): float
    {
        return Expense::whereYear('date', $date->year)
        ->whereMonth('date', $date->month)->first()->cost;
    }

} //$material_cost = $this->getTotalCost();