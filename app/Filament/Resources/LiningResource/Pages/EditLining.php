<?php

namespace App\Filament\Resources\LiningResource\Pages;

use App\Filament\Resources\LiningResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLining extends EditRecord
{
    protected static string $resource = LiningResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
} 