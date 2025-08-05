<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductionResource\Pages;
use App\Filament\Resources\ProductionResource\RelationManagers;
use App\Models\Production;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductionResource extends Resource
{
    protected static ?string $model = Production::class;

    protected static ?string $navigationIcon = '';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __('resources.menu.fabrication');
    }

    public static function getNavigationGroup(): string
    {
        return __('resources.menu.fabrication');
    }

    public static function getModelLabel(): string
    {
        return __('resources.productions.model_label');
    }

    public static function getPluralModelLabel(): string
    {
        return __('resources.productions.plural_model_label');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_id')
                    ->relationship('product', 'name')
                    ->required(),
                Forms\Components\Select::make('cutter_id')
                    ->relationship('cutter', 'name')
                    ->required(),
                Forms\Components\Select::make('client_id')
                    ->relationship('client', 'name')
                    ->required(),
                Forms\Components\Select::make('color_id')
                    ->relationship('color', 'title')
                    ->required(),
                Forms\Components\DatePicker::make('date_started'),
                Forms\Components\DatePicker::make('date_cutting'),
                Forms\Components\DatePicker::make('date_sewing'),
                Forms\Components\DatePicker::make('date_finishing'),
                Forms\Components\DatePicker::make('date_completed'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('product.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('cutter.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('client.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('color.title')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_started')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_cutting')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_sewing')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_finishing')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_completed')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProductions::route('/'),
            'create' => Pages\CreateProduction::route('/create'),
            'edit' => Pages\EditProduction::route('/{record}/edit'),
        ];
    }
}
