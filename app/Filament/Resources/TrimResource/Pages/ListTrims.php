<?php

namespace App\Filament\Resources\TrimResource\Pages;

use App\Filament\Resources\TrimResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrims extends ListRecords
{
    protected static string $resource = TrimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
