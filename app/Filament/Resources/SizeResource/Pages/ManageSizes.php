<?php

namespace App\Filament\Resources\SizeResource\Pages;

use App\Filament\Resources\SizeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ManageRecords;

class ManageSizes extends ManageRecords
{
    protected static string $resource = SizeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->slideOver(),
        ];
    }
}
