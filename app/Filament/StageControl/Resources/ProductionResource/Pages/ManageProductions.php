<?php

namespace App\Filament\StageControl\Resources\ProductionResource\Pages;

use App\Filament\StageControl\Resources\ProductionResource;
use Filament\Resources\Pages\ManageRecords;

class ManageProductions extends ManageRecords
{
    protected static string $resource = ProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
        ];
    }
}
