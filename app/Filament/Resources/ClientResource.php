<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages\ManageClients;
use App\Models\Client;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?int $navigationSort = 10;

    public static function getNavigationGroup(): string
    {
        return __('resources.menu.registrations');
    }

    public static function getNavigationLabel(): string
    {
        return __('resources.clients.navigation_label');
    }

    public static function getModelLabel(): string
    {
        return __('resources.clients.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.clients.plural_model_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->label(__('resources.clients.form.name'))->required()->maxLength(255),
                TextInput::make('email')->label(__('resources.clients.form.email'))->email()->required()->maxLength(255),
                TextInput::make('phone')->label(__('resources.clients.form.phone'))->tel()->required()->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label(__('resources.clients.table.name'))->searchable(),
                TextColumn::make('email')->label(__('resources.clients.table.email'))->searchable(),
                TextColumn::make('phone')->label(__('resources.clients.table.phone'))->searchable(),
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
            'index' => ManageClients::route('/'),
        ];
    }
}
