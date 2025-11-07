<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Actions\GenerateProductInfoPDFAction;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Widgets\CostProductWidget;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Storage;

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
