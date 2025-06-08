<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use App\Helpers\UtilHelper;
use App\Models\Expense;
use App\Models\Production;
use App\Models\ProductionItem;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Colors\Color;
use Carbon\Carbon;

class CostProductWidget extends BaseWidget
{

    public ?Model $record = null;

    protected function getStats(): array
    {
        $material_cost = $this->getTotalCost();
        $production_cost = $this->getProductionCost();
        $total_cost = $material_cost + $production_cost;
        
        return [
            /*Stat::make(__('Fabric Cost'), UtilHelper::formatMoney($this->record->totalSampleFabricCost))
                ->description(__('Only the fabric cost'))
                ->descriptionIcon('heroicon-o-swatch')
                ->icon('heroicon-o-swatch')
                ->color('info'),

            Stat::make(__('Other Costs'), UtilHelper::formatMoney($this->getOtherCosts()))
                ->description(__('Sum of all other costs'))
                ->descriptionIcon('heroicon-o-clipboard-document-list')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('info'),*/

            
            Stat::make(__('Material cost'), UtilHelper::formatMoney($material_cost))
                ->description(__('fabric + trims'))
                ->descriptionIcon('heroicon-o-rectangle-stack')
                ->icon('heroicon-o-rectangle-stack')
                ->color('primary'),

            Stat::make(__('Production cost'), UtilHelper::formatMoney($production_cost))
                ->description(__('production cost'))
                ->descriptionIcon('heroicon-o-adjustments-horizontal')
                ->icon('heroicon-o-adjustments-horizontal')
                ->color('primary'),

            Stat::make(__('Total cost'), UtilHelper::formatMoney($total_cost))
                ->description(__('total cost'))
                ->descriptionIcon('heroicon-o-calculator')
                ->icon('heroicon-o-calculator')
                ->color('primary'),
        ];
    }

    private function getFabricCost(): float
    {
        return $this->record->fabric_shapes()->whereSample(true)->sum('cost');
    }

    private function getTrimCost(): float
    {
        return $this->record->product_trims()->sum('total');
    }

    private function getLiningCost(): float
    {
        return $this->record->lining_products()->sum('total');
    }

    private function getOtherCosts(): float
    {
        return $this->getTrimCost() + $this->getLiningCost();
    }

    private function getTotalCost(): float
    {
        return $this->getFabricCost() + $this->getOtherCosts();
    }

    private function getProductionCost(): float
    {
        $production_item = ProductionItem::getLatestProductionItemInProductionFromProduct($this->record);
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

}
