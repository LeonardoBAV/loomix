<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class CountProductsWidget extends BaseWidget
{
    //use InteractsWithPageTable;

    protected function getColumns(): int
    {
        return 3;
    }

    protected function getStats(): array
    {
        return [
            Stat::make(__('Active Products Count'), Product::where('is_active', true)->count())
                ->description(__('Total number of active products'))
                ->descriptionIcon('heroicon-o-check-circle')
                ->icon('heroicon-o-check-circle')
                ->color('primary'),
            Stat::make(__('Inactive Products Count'), Product::where('is_active', false)->count())
                ->description(__('Total number of inactive products'))
                ->descriptionIcon('heroicon-o-x-circle')
                ->icon('heroicon-o-x-circle')
                ->color('gray'),
            Stat::make(__('Products Count'), Product::count())
                ->description(__('Total number of products'))
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->icon('heroicon-o-shopping-bag')
                ->color('info'),
        ];
    }
}
