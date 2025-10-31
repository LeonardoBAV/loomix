<?php

namespace App\Filament\Resources\ProductionResource\Pages;

use App\Filament\Resources\ProductionResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Textarea;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ViewRecord;

class ViewProduction extends ViewRecord
{
    protected static string $resource = ProductionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('note')->label(__('resources.productions.actions.note'))->icon('heroicon-o-document-text')->color('info')->button()->modalHeading(__('resources.productions.actions.note_modal_heading'))
                ->form([
                    Textarea::make('note')
                        ->label(__('resources.productions.form.note'))
                        ->rows(4)
                        ->default(fn() => $this->record->note)
                        ->required(false),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'note' => $data['note'] ?? '',
                    ]);

                    Notification::make()
                        ->title(__('notifications.success'))
                        ->body(__('notifications.body.resources.productions.actions.note_saved'))
                        ->color('success')
                        ->success()
                        ->send();
                }),
            EditAction::make()->label(__('Edit'))->icon('heroicon-o-pencil-square')->color('primary')->button()->slideOver()
        ];
    }
}
