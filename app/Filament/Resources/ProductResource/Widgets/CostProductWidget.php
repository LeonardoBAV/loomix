<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Helpers\UtilHelper;
use App\Models\Expense;
use App\Models\ProductionCost;
use Carbon\Carbon;
use Filament\Support\Colors\Color;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class CostProductWidget extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        $supply_cost = $this->record->fabric_cost + $this->record->trims_cost;
        $production_cost = $this->getProductionCost();
        $total_cost = $supply_cost + $production_cost;

        /*$sell_price = $total_cost*1.3;
        $sell_final_price = $sell_price*1.20;
        $profit = $sell_price - $total_cost;
*/

        return [
            Stat::make(__('Supply cost'), UtilHelper::formatMoney($supply_cost))
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

            /*Stat::make(__('Sell price'), UtilHelper::formatMoney($sell_final_price))
                ->description(UtilHelper::formatMoney($sell_price) . ' - ' . UtilHelper::formatMoney($profit))
                ->descriptionIcon('heroicon-o-tag')
                ->icon('heroicon-o-tag')
                ->color('primary'),*/
        ];
    }

    private function getProductionCost(): float
    {
        $production_cost = ProductionCost::whereDefault(true)->first();

        if (is_null($production_cost)) {
            return 0;
        }

        $production_cost_production = $production_cost->productionCostProductions()->whereProductId($this->record->id)->first();

        if (is_null($production_cost_production)) {
            return 0;
        }

        return $production_cost_production->cost;

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

    private function getExpense(Carbon $date): float
    {
        return Expense::whereYear('date', $date->year)
            ->whereMonth('date', $date->month)->first()->cost;
    }
}
