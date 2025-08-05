<?php

namespace App\Filament\Resources\CutterResource\Pages;

use App\Filament\Resources\CutterResource;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageCutters extends ManageRecords
{
    protected static string $resource = CutterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->slideOver(),
        ];
    }
}
