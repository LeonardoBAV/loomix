<?php

namespace App\Filament\Resources\LiningResource\Pages;

use App\Filament\Resources\LiningResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLinings extends ListRecords
{
    protected static string $resource = LiningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
} 