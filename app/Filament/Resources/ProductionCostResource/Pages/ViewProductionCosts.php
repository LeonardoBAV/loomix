<?php

namespace App\Filament\Resources\ProductionCostResource\Pages;

use App\Filament\Resources\ProductionCostResource;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Support\Colors\Color;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;

class ViewProductionCosts extends ViewRecord
{
    protected static string $resource = ProductionCostResource::class;


    protected function getHeaderActions(): array
    {
        return [
            EditAction::make()->label(__('Edit'))->icon('heroicon-o-pencil-square')->color('primary')->button()->slideOver()
        ];
    }

    #[On('refresh')]
    public function refresh(): void
    {
    }
}
