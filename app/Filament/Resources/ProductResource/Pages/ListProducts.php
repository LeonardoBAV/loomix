<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Widgets\CountProductsWidget;
use Filament\Actions;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CountProductsWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->slideOver(),
        ];
    }
}
