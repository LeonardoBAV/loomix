<?php

namespace App\Filament\Resources\ProductionCostResource\Pages;

use App\Filament\Resources\ProductionCostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProductionCosts extends ListRecords
{
    protected static string $resource = ProductionCostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
