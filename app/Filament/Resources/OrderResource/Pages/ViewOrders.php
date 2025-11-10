<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\OrderResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewOrders extends ViewRecord
{
    protected static string $resource = OrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('Edit'))->icon('heroicon-o-pencil-square')->color('primary')->button()->slideOver(),

        ];
    }
}
