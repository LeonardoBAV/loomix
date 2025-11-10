<?php

namespace App\Filament\Resources\ProductionCostResource\Pages;

use App\Filament\Resources\ProductionCostResource;
use App\Filament\Resources\ProductionCostResource\Widgets\CategoryDistributionPieChartWidget;
use App\Filament\Resources\ProductionCostResource\Widgets\ProductionCostPackageStatsWidget;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Livewire\Attributes\On;

class ViewProductionCosts extends ViewRecord
{
    protected static string $resource = ProductionCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('Edit'))->icon('heroicon-o-pencil-square')->color('primary')->button()->slideOver(),
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [
            ProductionCostPackageStatsWidget::class,
            CategoryDistributionPieChartWidget::class,
        ];
    }

    #[On('refresh')]
    public function refresh(): void {}
}
