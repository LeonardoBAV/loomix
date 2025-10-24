<?php

namespace App\Filament\Resources\ProductionCostResource\Widgets;

use App\Models\ProductionCost;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Database\Eloquent\Model;

class ProductionCostPackageStatsWidget extends BaseWidget
{
    public ?Model $record = null;

    protected function getStats(): array
    {
        if (!$this->record) {
            return [];
        }

        $total_weight = $this->record->getTotalWeight(); // teste
        $total_pieces = $this->record->getTotalPieces(); // test cover this in action and job
        $total_products = $this->record->productionCostProductions()->count(); // test cover this in action and job

        

        return [
            Stat::make(
                __('resources.production_costs.widgets.stats.total_weight'),
                number_format($total_weight, 0, ',', '.')
            )
                ->description(__('resources.production_costs.widgets.stats.total_weight_description'))
                ->descriptionIcon('heroicon-o-scale')
                ->icon('heroicon-o-scale')
                ->color('success'),

            Stat::make(
                    __('resources.production_costs.widgets.stats.total_pieces'),
                    number_format($total_pieces, 0, ',', '.')
            )
            ->description(__('resources.production_costs.widgets.stats.total_pieces_description'))
            ->descriptionIcon('heroicon-o-cube')
            ->icon('heroicon-o-cube')
            ->color('primary'),   
            
            Stat::make(
                __('resources.production_costs.widgets.stats.total_products'),
                number_format($total_products, 0, ',', '.')
            )
                ->description(__('resources.production_costs.widgets.stats.total_products_description'))
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->icon('heroicon-o-shopping-bag')
                ->color('info'),
        ];
    }

    protected function getColumns(): int
    {
        return 3;
    }
}
