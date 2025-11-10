<?php

namespace App\Filament\Resources\TrimResource\Pages;

use App\Filament\Resources\TrimResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrim extends EditRecord
{
    protected static string $resource = TrimResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
