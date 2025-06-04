<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use App\Helpers\UtilHelper;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;
use Filament\Support\Colors\Color;

class CostProductWidget extends BaseWidget
{

    public ?Model $record = null;

    protected function getStats(): array
    {
        return [
            Stat::make(__('Fabric Cost'), UtilHelper::formatMoney($this->record->totalSampleFabricCost))
                ->description(__('Only the fabric cost'))
                ->descriptionIcon('heroicon-o-swatch')
                ->icon('heroicon-o-swatch')
                ->color('info'),

            Stat::make(__('Other Costs'), UtilHelper::formatMoney($this->getOtherCosts()))
                ->description(__('Sum of all other costs'))
                ->descriptionIcon('heroicon-o-clipboard-document-list')
                ->icon('heroicon-o-clipboard-document-list')
                ->color('info'),

            Stat::make(__('Total Cost'), UtilHelper::formatMoney($this->getTotalCost()))
                ->description(__('Sum of all costs'))
                ->descriptionIcon('heroicon-o-calculator')
                ->icon('heroicon-o-calculator')
                ->color('primary')
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

}
