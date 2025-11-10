<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Actions\GenerateProductInfoPDFAction;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\ProductResource\Widgets\CostProductWidget;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Storage;

class ViewProduct extends ViewRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderWidgets(): array
    {
        return [
            CostProductWidget::class,
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('Edit'))->icon('heroicon-o-pencil-square')->color('primary')->button()->slideOver(),
            Action::make('cost')->label(__('Cost'))->icon('heroicon-o-currency-dollar')->color('info')->button()
                ->action(function () {}),
            /*Action::make('info')->label(__('Info'))->icon('heroicon-o-clipboard-document-list')->color('info')->button()
            ->action(function () {
                $file_path = (new GenerateProductInfoPDFAction())->execute($this->record);
                return Storage::disk('public')->download($file_path);
            }),*/
        ];
    }
}
