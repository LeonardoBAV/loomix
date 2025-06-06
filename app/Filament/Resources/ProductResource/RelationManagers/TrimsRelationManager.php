<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Actions\AttachAction;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\DetachAction;
use Filament\Tables\Actions\DetachBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class TrimsRelationManager extends RelationManager
{
    protected static string $relationship = 'trims';

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('Trims');
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('name')->translateLabel('name'),
                TextColumn::make('quantity')->translateLabel('quantity'),
                TextColumn::make('unit')->translateLabel('unit')->formatStateUsing(fn (string $state): string => __($state)),
                TextColumn::make('total')->translateLabel('total')->money('BRL', locale: 'pt_BR'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                AttachAction::make()
                ->form(fn (AttachAction $action): array => [
                    $action->getRecordSelect(),
                    TextInput::make('quantity')->translateLabel('quantity')->required()->numeric()->step(0.01),
                ]),
            ])
            ->actions([
                DetachAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DetachBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
