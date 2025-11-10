<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CutterResource\Pages\ManageCutters;
use App\Models\Cutter;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CutterResource extends Resource
{
    protected static ?string $model = Cutter::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    protected static ?int $navigationSort = 11;

    public static function getNavigationGroup(): string
    {
        return __('resources.menu.registrations');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources.cutters.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('resources.cutters.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.cutters.plural_model_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label(__('resources.cutters.form.name'))->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('resources.cutters.table.name'))->searchable(),
                TextColumn::make('created_at')->translateLabel()->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->translateLabel()->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageCutters::route('/'),
        ];
    }
}
